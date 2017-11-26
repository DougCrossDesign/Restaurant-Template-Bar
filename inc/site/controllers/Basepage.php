<?php
/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 12/16/2015
 * Time: 4:54 PM
 */

namespace Controller;

use Model\Adbanner;
use Model\EmailAddress;
use Model\EmailList;
use Model\Footersitemenu;
use Model\Metadata;
use Model\Pages\Page;
use Model\Pages\Partial;
use Model\Siteinfo;
use Model\Sitemenu;
use Model\Sponsor;
use \Template;

class Basepage extends BaseController
{
    public function index(){
        $template = new Template("pages/basepage");
   
        $template->sitemenus = Sitemenu::get();
        $template->footersitemenus = Footersitemenu::get();
        $template->submenu = Sitemenu::getChildrenOfCurrentUrl(); 
        $template->page_meta = Metadata::getByUrlOrInferFromUrl();

        /** @var Page $page */
        $page = Page::getById(47);
        $template->partials = $page->getTemplates();
        
        $template->htmlText = Page::getPartialData(47,209);

        $template->pagetitle = $page->title;


        $this->show($template);
    }
}