<?php
/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 12/10/2015
 * Time: 5:04 PM
 */


namespace Controller;

use Model\Adbanner;
use Model\Event;
use Model\Footersitemenu;
use Model\Metadata;
use Model\News\Newsarticle;
use Model\Seatingchart;
use Model\Sitemenu;
use Model\Sponsor;
use Model\StaticMetadata;

class News extends BaseController
{
    public function index(){
        $template = new \Template("pages/news");
            $query = Newsarticle::where("date", "<", time());
        $template->news = $query->count() ? $query->get() : [];

        $template->sponsorslist = Sponsor::get();
        $banners = Adbanner::getActivesByGroupId([1,4,5]);
        $template->adbannersmedium = $banners[1];
        $template->adbannersmedium2 = $banners[4];
        $template->adbannersfooter = $banners[5];
        $template->sitemenus = Sitemenu::get();
        $template->footersitemenus = Footersitemenu::get();

        $template->page_meta = Metadata::getByUrlOrInferFromUrl();
        $template->show_view_all = false;
        $template->chosen_month = null;

        $this->show([
            "page" => $template
        ]);
    }
    public function month($monthname, $year){
        $template = new \Template("pages/news");
        $query = Newsarticle::where("date", ">", strtotime($monthname . ' ' . $year))->where("date", "<", strtotime($monthname . ' ' . $year . ' + 1 month'));
        $template->news = $query->count() ? $query->get() : [];

        $template->sponsorslist = Sponsor::get();
        $banners = Adbanner::getActivesByGroupId([1,4,5]);
        $template->adbannersmedium = $banners[1];
        $template->adbannersmedium2 = $banners[4];
        $template->adbannersfooter = $banners[5];
        $template->sitemenus = Sitemenu::get();
        $template->footersitemenus = Footersitemenu::get();

        $template->page_meta = Metadata::getByUrlOrInferFromUrl();
        $template->show_view_all = true;
        $template->chosen_month = $monthname . '. ' . $year;

        $this->show([
            "page" => $template
        ]);
    }
    public function details($id){
        /** @var Newsarticle $article */
        $article = Newsarticle::getById($id);

        $template = new \Template("pages/news-details");
            $template->article = $article;

        $template->sponsorslist = Sponsor::get();
        $banners = Adbanner::getActivesByGroupId([1,4,5]);
        $template->adbannersmedium = $banners[1];
        $template->adbannersmedium2 = $banners[4];
        $template->adbannersfooter = $banners[5];
        $template->sitemenus = Sitemenu::get();
        $template->footersitemenus = Footersitemenu::get();

        $template->page_meta = Metadata::getByUrlOrUse($article->title, $article->title, $article->summary);

        $this->show([
            "page" => $template
        ]);
    }
    public function calendar(){

        $template = new \Template("pages/events-calendar");
            $query = Event::where("date", ">", strtotime("1st of this month"))->where("active", "=", "1");
        $template->events = $query->count() ? $query->get() : [];

        $template->sponsorslist = Sponsor::get();
        $banners = Adbanner::getActivesByGroupId([1,4,5]);
        $template->adbannersmedium = $banners[1];
        $template->adbannersmedium2 = $banners[4];
        $template->adbannersfooter = $banners[5];
        $template->sitemenus = Sitemenu::get();
        $template->footersitemenus = Footersitemenu::get();

        $template->page_meta = Metadata::getByUrlOrInferFromUrl();


        $this->show([
            "page" => $template
        ]);
    }
    public function search(){
        $template = new \Template("pages/events");
        $template->events = Event::search(\Input::get("term"));

        $template->sponsorslist = Sponsor::get();
        $banners = Adbanner::getActivesByGroupId([1,4,5]);
        $template->adbannersmedium = $banners[1];
        $template->adbannersmedium2 = $banners[4];
        $template->adbannersfooter = $banners[5];
        $template->sitemenus = Sitemenu::get();
        $template->footersitemenus = Footersitemenu::get();

        $template->page_meta = Metadata::getByUrlOrInferFromUrl();

        $this->show([
            "page" => $template
        ]);
    }
}