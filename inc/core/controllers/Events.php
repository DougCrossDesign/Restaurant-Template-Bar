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
use Model\Seatingchart;
use Model\Sitemenu;
use Model\Sponsor;
use Model\StaticMetadata;

class Events extends BaseController
{
    public function index(){
        $template = new \Template("pages/events");
            $query = Event::where("date", ">", strtotime("1st of this month"))->where("active", "=", "1")->orderBy("date", "asc");
        $template->events = $query->count() ? $query->get() : [];

        $banners = Adbanner::getActivesByGroupId([1,4,5]);
        $template->adbannersmedium = $banners[1];
        $template->adbannersmedium2 = $banners[4];
        $template->adbannersfooter = $banners[5];
        $template->sitemenus = Sitemenu::get();
        $template->footersitemenus = Footersitemenu::get();
        $template->submenu = Sitemenu::getChildrenOfCurrentUrl();
        $template->show_view_all = false;

        $template->page_meta = Metadata::getByUrlOrInferFromUrl();

        $this->show([
            "page" => $template
        ]);
    }
    public function month($monthname, $year){
        $template = new \Template("pages/events");
        $query = Event::where("date", ">", strtotime($monthname . ' ' . $year))->where("date", "<", strtotime($monthname . ' ' . $year . ' + 1 month'))->where("active", "=", "1")->orderBy("date", "asc");
        $template->events = $query->count() ? $query->get() : [];

        $banners = Adbanner::getActivesByGroupId([1,4,5]);
        $template->adbannersmedium = $banners[1];
        $template->adbannersmedium2 = $banners[4];
        $template->adbannersfooter = $banners[5];
        $template->sitemenus = Sitemenu::get();
        $template->footersitemenus = Footersitemenu::get();
        $template->submenu = Sitemenu::getChildrenOfCurrentUrl();
        $template->show_view_all = true;


        $template->page_meta = Metadata::getByUrlOrInferFromUrl();

        $this->show([
            "page" => $template
        ]);
    }
    public function details($id){
        /** @var Event $event */
        $event = Event::getById($id);

        $template = new \Template("pages/events-details");
            $template->event = $event;

        $banners = Adbanner::getActivesByGroupId([1,4,5]);
        $template->adbannersmedium = $banners[1];
        $template->adbannersmedium2 = $banners[4];
        $template->adbannersfooter = $banners[5];
        $template->sitemenus = Sitemenu::get();
        $template->footersitemenus = Footersitemenu::get();
        $template->submenu = Sitemenu::getChildrenOfCurrentUrl('/events');

        $template->page_meta = Metadata::getByUrlOrUse($event->title, $event->title, $event->summary);

        $this->show([
            "page" => $template
        ]);
    }
    public function calendar(){

        $template = new \Template("pages/events-calendar");
            $query = Event::where("date", ">", strtotime("1st of this month"))->where("active", "=", "1")->orderBy("date", "asc");
        $template->events = $query->count() ? $query->get() : [];

        $banners = Adbanner::getActivesByGroupId([1,4,5]);
        $template->adbannersmedium = $banners[1];
        $template->adbannersmedium2 = $banners[4];
        $template->adbannersfooter = $banners[5];
        $template->sitemenus = Sitemenu::get();
        $template->footersitemenus = Footersitemenu::get();
        $template->submenu = Sitemenu::getChildrenOfCurrentUrl();

        $template->page_meta = Metadata::getByUrlOrInferFromUrl();


        $this->show([
            "page" => $template
        ]);
    }
    public function search(){
        $template = new \Template("pages/events");
        $template->events = Event::search(\Input::get("term"));

        $banners = Adbanner::getActivesByGroupId([1,4,5]);
        $template->adbannersmedium = $banners[1];
        $template->adbannersmedium2 = $banners[4];
        $template->adbannersfooter = $banners[5];
        $template->sitemenus = Sitemenu::get();
        $template->footersitemenus = Footersitemenu::get();
        $template->submenu = Sitemenu::getChildrenOfCurrentUrl();

        $template->page_meta = Metadata::getByUrlOrInferFromUrl();

        $this->show([
            "page" => $template
        ]);
    }
}