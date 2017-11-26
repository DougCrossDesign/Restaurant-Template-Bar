<?php
use Model\FriendlyUrl;
use Model\Pages\Page;
use Model\SearchIndexItem;

include('../../cms.php');

// create table if doesn't exists
$SEARCH_INDEX_TABLE_SQL = '
CREATE TABLE IF NOT EXISTS `cms_base_search_index` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) NOT NULL,
  `url` varchar(2048) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';
$db = config()->getConnection();
echo "Creating table [cms_base_search_index] if doesn't exist... " . ($db->statement($SEARCH_INDEX_TABLE_SQL) ? "OK" : "FAIL") . '<br />';

// if exists: truncate
echo "Truncating table [cms_base_search_index]... " . ($db->statement('TRUNCATE TABLE  cms_base_search_index;') ? "OK" : "FAIL") . '<br />';

// fetch settings
$json = file_get_contents("searchindexsettings.json");
$settings = json_decode($json);
echo "Fetch settings... " . ($settings ? "OK" : "FAIL") . '<br />';

// start parsing
foreach($settings->tables as $tablename => $data){
    echo "Indexing table: " . $tablename . "... ";
    $contentColumns = $data->content;
    if(isset($data->friendlyurl)){
        // we're using friendly urls
        // append this table ID to after $data->friendlyurl
        // and search friendly url table for this "route"
        $query = "select * from " . $tablename;
        if(isset($data->where) && strlen($data->where)) $query .= " where " . $data->where;
        $results = $db->select($query);
        $numSearched = 0;
        if(count($results)){
            foreach($results as $row){
                // check for ignore flags
                $ignore = false;
                if(isset($data->ignore)){
                    foreach($data->ignore as $column => $unallowedValue){
                        if($row->{$column} == $unallowedValue) $ignore = true;
                    }
                }
                if($ignore) continue;

                // get friendly url
                $url = FriendlyUrl::getByRoute($data->friendlyurl . $row->id)->friendlyurl;

                // get title
                $title = $row->{$data->title};

                // get content
                $content = '';
                foreach($contentColumns as $column){
                    if($column == "partials"){
                        $content .= getPartialContent($row->id, true);
                    } else {
                        $content .= $row->$column;
                    }
                }

                // create index item
                $index = new SearchIndexItem(
                    [
                        'title' => $title,
                        'url' => $url,
                        'content' => $content
                    ]
                );
                $index->save();
                $numSearched++;
            }
            echo "OK (" . $numSearched . " entries)";
        } else {
            echo "EMPTY";
        }
    } else {
        // we're not using friendly urls
        // we'll have to use the URL pattern for this
        echo "NO URL";
    }
    echo '<br />';
}

function getPartialContent($pageid, $forsearch = false){
    /** @var Page $page */
    $page = Page::getById($pageid);
    $templates = $page->getTemplatesExceptBanner();
    $output = '';
    if(is_array($templates)) {
        /** @var Template $template */
        foreach ($templates as $template) {
            try {
                $output .= strip_tags($template->render($forsearch));
            } catch (Exception $e){
                $output .= $e;
            }
        }
    }
    return $output;

}