<?php

namespace Controller;
use Controller\BaseController;
use Model\Metadata;
use Model\Siteinfo;
use Template;

class Jointeam extends BaseController {
    // this will become www.website.com/example
    public function index(){
        $this->show(new Template("pages/join-our-team"));
    }
}
