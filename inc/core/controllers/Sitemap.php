<?php
namespace Controller;

use Model\Adbanner;
use Model\Event;
use Model\Footersitemenu;
use Model\FriendlyUrl;
use Model\Jobposition;
use Model\Meetingspace;
use Model\Metadata;
use Model\News\Newsarticle;
use Model\Seatingchart;
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
class Sitemap extends BaseController
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
        $links = [];
        $str_baseurl = 'http://' . $_SERVER["HTTP_HOST"];

        $links = $this->getSitemenuItems();

        /*
        foreach(FriendlyUrl::getAllActive() as $friendlyUrl){
            $url = $friendlyUrl->friendlyurl;
            if($url[0] == '/'){
                $url = $str_baseurl . $url;
                if(!in_array($url,$links)) $links[] = new SitemapItem($url, $url, []);
            }
        }*/

        $template = new \Template("pages/base-template");
            $template->page = $this->renderSitemap($links);

        $template->sponsorslist = Sponsor::get();
        $banners = Adbanner::getActivesByGroupId([1,4,5]);
        $template->adbannersmedium = $banners[1];
        $template->adbannersmedium2 = $banners[4];
        $template->adbannersfooter = $banners[5];
        $template->sitemenus = Sitemenu::get();
        $template->footersitemenus = Footersitemenu::get();
        $template->submenu = Sitemenu::getChildrenOfCurrentUrl();

        $template->page_meta = Metadata::getByUrlOrInferFromUrl();

        $this->show($template);
    }

    protected function getSitemenuItems(){
        $items = [];
        /** @var Sitemenu $sitemenu */
        foreach(Sitemenu::getChildrenOfParent(1) as $sitemenu){
            $sitemenu->children = $this->getSitemenuChildren($sitemenu->id);
            $sitemapItem = $sitemenu->toSitemapItem();
            switch($sitemenu->title){
                case "Calendar of Events":
                    $this->addEventChildren($sitemapItem);
                    break;
                case "News":
                    $this->addNewsChildren($sitemapItem);
                    break;
                case "Meeting Spaces":
                    //$this->addMeetingSpaceChildren($sitemapItem);
                    break;
                case "Employment":
                    $this->addJobPositionChildren($sitemapItem);
                    break;
            }
            $items[] = $sitemapItem;
        }
        return $items;
    }

    protected function getSitemenuChildren($id){
        $children = [];
        $result = Sitemenu::getChildrenOfParent($id);
        if(!$result) return [];

        /** @var Sitemenu $child */
        foreach($result as $child){
            $child->children = $this->getSitemenuChildren($child->id);
            $sitemapItem = $child->toSitemapItem();
            switch($sitemapItem->title){
                case "Calendar of Events":
                    $this->addEventChildren($sitemapItem);
                    break;
                case "News":
                    $this->addNewsChildren($sitemapItem);
                    break;
                case "Meeting Spaces":
                    //$this->addMeetingSpaceChildren($sitemapItem);
                    break;
                case "Employment":
                    $this->addJobPositionChildren($sitemapItem);
                    break;
            }
            $children[] = $sitemapItem;
        };

        return $children;
    }

    /**
     * @param $sitemapItem SitemapItem
     */
    protected function addJobPositionChildren(&$sitemapItem){
        $jobs = Jobposition::get();

        /** @var Jobposition $job */
        foreach($jobs as $job){
            $sitemapItem->children[] = new SitemapItem($job->title, $job->getFriendlyUrl(), []);
        }
    }

    /**
     * @param $sitemapItem SitemapItem
     */
    protected function addNewsChildren(&$sitemapItem){
        $articles = Newsarticle::orderBy("date", "desc")->get();

        /** @var Newsarticle $article */
        foreach($articles as $article){
            $sitemapItem->children[] = new SitemapItem($article->title, $article->getFriendlyUrl(), []);
        }
    }

    /**
     * @param $sitemapItem SitemapItem
     */
    protected function addMeetingSpaceChildren(&$sitemapItem){
        $meetingSpaces = Meetingspace::get();

        /** @var Meetingspace $meetingSpace */
        foreach($meetingSpaces as $meetingSpace){
            $sitemapItem->children[] = new SitemapItem($meetingSpace->title, $meetingSpace->getFriendlyUrl(), []);
        }
    }

    /**
     * @param $sitemapItem SitemapItem
     */
    protected function addEventChildren(&$sitemapItem){
        $query = Event::where("date", ">", strtotime("1st of this month"))->where("active", "=", "1");
        $events = $query->count() ? $query->get() : [];

        /** @var Event $event */
        foreach($events as $event){
            $sitemapItem->children[] = new SitemapItem($event->title, $event->getFriendlyUrl(), []);
        }
    }



    public function renderSitemap($links){
        $output = '<ul class="sitemap">';
        /** @var SitemapItem $sitemapItem */
        foreach($links as $sitemapItem){
            $output .= $sitemapItem->render();
        }
        $output .= '</ul>';
        return $output;
    }

}