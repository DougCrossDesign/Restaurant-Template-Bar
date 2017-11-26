<?php
namespace Controller;

use Model\Adbanner;
use Model\Event;
use Model\Footersitemenu;
use Model\FriendlyUrl;
use Model\Jobposition;
use Model\Meetingspace;
use Model\Metadata;
use Model\SearchIndexItem;
use Model\Seatingchart;
use Model\Siteinfo;
use Model\SitemapItem;
use Model\Sitemenu;
use Model\Sponsor;

/**
 * Test Controller with examples
 *
 * Shows examples of methods and how to use them
 *
 * @package Controller
 */
class Search extends BaseController
{
    /**
     * Every controller should explicitly set whether a page requires login or not
     * @var bool
     */
    protected $requiresLogin = false;

    /**
     * Example of a method with no arguments
     */
    public function index(){
        $type = \Input::get("type");

        $template = null;
        switch($type){
            case "all":
                $template = new \Template("pages/all-search");
                $template->page = $this->renderSearchResults(urldecode(\Input::get("term")));
                break;
            case "events":
                $template = new \Template("pages/events-search");
                $template->events = Event::search(urldecode(\Input::get("term")));
                break;
        }

        $template->sponsorslist = Sponsor::get();
        $banners = Adbanner::getActivesByGroupId([1,4,5]);
        $template->adbannersmedium = $banners[1];
        $template->adbannersmedium2 = $banners[4];
        $template->adbannersfooter = $banners[5];
        $template->sitemenus = Sitemenu::get();
        $template->footersitemenus = Footersitemenu::get();
        $template->submenu = Sitemenu::getChildrenOfCurrentUrl();

        $template->page_meta = Metadata::getByUrlOrInferFromUrl();

        $template->analytics = Siteinfo::getValueByKey("Google Analytics ID");

        $this->show($template);
    }

    protected function renderSearchResults($term){
        $results = SearchIndexItem::where("content", "like", '%'. $term .'%');
        if($results->count()){
            $output = '<ul class="search-results">';
            /** @var SearchIndexItem $result */
            foreach($results->get() as $result){
                $output .= '<li class="search-listing"><div><h2 class="hdr4 btm-margin-sm"><a href="'. $result->url .'">'. $result->title .'</a></h2>' . substr($result->content, 0, 400) . '</div></li>';
            }
            $output .= '</ul>'; 
            return $output;
        } else {
            return 'No Results Found';
        }
    }
}