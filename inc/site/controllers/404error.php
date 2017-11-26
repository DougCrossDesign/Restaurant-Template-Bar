<?php

namespace Controller;
use Controller\BaseController;
use Model\Metadata;
use Model\Siteinfo;
use Template;

class 404error extends BaseController {
    public function index(){
        $this->show(new Template("pages/404error"));
    }
}
