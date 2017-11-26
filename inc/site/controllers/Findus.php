<?php

namespace Controller;
use Controller\BaseController;
use Model\Metadata;
use Model\Siteinfo;
use Template;

class Findus extends BaseController {
    // this will become www.website.com/example
    public function index(){
        $this->show(new Template("pages/findus"));
    }
}
