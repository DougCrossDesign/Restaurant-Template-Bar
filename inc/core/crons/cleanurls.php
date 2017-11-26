<?php
use Model\FriendlyUrl;
use Model\Pages\Page;
use Model\SearchIndexItem;

include('../../cms.php');

$ROUTE_MODELS = [
    "employment" => "\Model\Jobposition",
    "events" => "\Model\Event",
    "news" => "\Model\News\Newsarticle",
    "page" => "\Model\Pages\Page",
    "tap" => "\Model\Beer",
    "private-events" => "\Model\Galleryalbum",
    "announcements" => "\Model\News\Newsarticle",
    "blog" => "\Model\Blog\BlogPost"
];

$db = config()->getConnection();


// check friendly urls first
$friendlyUrls = FriendlyUrl::get();
echo '<h3>1. Checking that FriendlyURL pages exist</h3>';
echo 'Found ' . $friendlyUrls->count() . ' urls... <br>';
echo '<table><th>ID</th><th>URL</th><th>Route</th><th>Status</th>';
/** @var FriendlyUrl $friendlyUrl */
foreach($friendlyUrls as $friendlyUrl){
    if($controller = $friendlyUrl->getController()){
        echo '<tr><td>'. $friendlyUrl->id .'</td><td>' . $friendlyUrl->friendlyurl . '</td><td>' . $friendlyUrl->route . '</td><td>';

        if(!array_key_exists($controller, $ROUTE_MODELS)){
            echo 'Model NOT FOUND for controller: ' . $controller . '... Please update script';
            echo '</td></tr>';
            continue;
        }

        $ModelClass = $ROUTE_MODELS[$controller];


        if($ModelClass::getById($friendlyUrl->getId())){
            // we're good, we found our end point
            echo 'ok';
        } else {
            // we're not good, we didnt find our end point... report this!!
            echo 'BROKEN';
            if($friendlyUrl->delete()){
                echo '...DELETED';
            };

        }
        echo '</td></tr>';
    }
}
echo '</table>';


// now check that all pages_partials rows go to real pages, same with available pages
echo '<h3>2. Checking that Partials exist on Pages that exist</h3>';
echo '<table><th>ID</th><th>Partial ID</th><th>Page ID</th><th>Status</th>';
foreach($db->select("select * from cms_core_module_pages_partials") as $row){
    echo '<tr><td>'. $row->id .'</td><td>'. $row->partialid .'</td><td>'. $row->pageid .'</td>';
    if($page = Page::getById($row->pageid)){
        echo '<td>ok</td>';
    } else {
        echo '<td>BROKEN';
        $db->delete("delete from cms_core_module_pages_partials where id = ?", [$row->id]);
        echo '...DELETED';
        echo '</td>';
    }
    echo '</tr>';
}
echo '</table>';


// now check that all pages_available_partials rows go to real pages, same with available pages
echo '<h3>3. Checking that Partials are allowed to be created on Pages that exist</h3>';
echo '<table><th>ID</th><th>Partial ID</th><th>Page ID</th><th>Status</th>';
foreach($db->select("select * from cms_core_module_pages_available_partials") as $row){
    echo '<tr><td>'. $row->id .'</td><td>'. $row->partialid .'</td><td>'. $row->pageid .'</td>';
    if($page = Page::getById($row->pageid)){
        echo '<td>ok</td>';
    } else {
        echo '<td>BROKEN';
        $db->delete("delete from cms_core_module_pages_available_partials where id = ?", [$row->id]);
        echo '...DELETED';
        echo '</td>';
    }
    echo '</tr>';
}
echo '</table>';