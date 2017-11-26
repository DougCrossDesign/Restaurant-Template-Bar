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

class Test extends BaseController
{
    public function index(){
        $template = new \Template("pages/news");

        $template->sitemenus = Sitemenu::get();
        $template->footersitemenus = Footersitemenu::get();

        $template->page_meta = Metadata::getByUrlOrInferFromUrl();

        $this->show([
            "page" => $template
        ]);
    }
    public function page($pagename){
        $template = new \Template("pages/" . $pagename);

        $template->sitemenus = Sitemenu::get();
        $template->footersitemenus = Footersitemenu::get();
        $template->page_meta = Metadata::getByUrlOrInferFromUrl();
        $template->body_class = Sitemenu::getInferredBodyClass($pagename);

        $this->show([
            "page" => $template
        ]);
    }
}