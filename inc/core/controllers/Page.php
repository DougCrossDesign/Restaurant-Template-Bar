<?php
/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 12/10/2015
 * Time: 5:08 PM
 */

namespace Controller;

use Model\Footersitemenu;
use Model\Metadata;
// using an alias here because php gets annoyed since Page model has the same name as Page controller
use \Model\Pages\Page as PageModel;
use Model\Sitemenu;
use \Template;

class Page extends BaseController
{
    public function index(){
        die('page index');
    }
    public function view($id){
        /** @var PageModel $page */
        $page = PageModel::getById($id);
        if($page){
            $template = new Template("pages/page");
                $template->page_title = $page->title;
                $template->partial_templates = $page->getTemplates();

            $this->showPart([
                "page" => $template
            ],[
                "page_title" => $page->title,                   
                "sitemenus" => Sitemenu::get(),
                "footersitemenus" => Footersitemenu::get(),
                "submenu" => Sitemenu::getChildrenOfCurrentUrl(),
                "page_meta" => Metadata::getByUrlOrInferFromUrl(),
                "body_class" => Sitemenu::getInferredBodyClass(),
                "header" => $page->header,
                "footer" => $page->footer,
                "bodyclass" => $page->bodyclass,
                "trackingscripts" => $page->trackingscripts
            ]);
        } else {
            $this->show404();
        }
    }
}