<?php
namespace AdminController;

use \Controller\BaseController;
use \Template;
use \Response\PageTemplate;

class Dashboard extends BaseController {

    const NEWS_URL = "http://intranet.aycmedia.com/dashboard";

    protected $requiresLogin = true;

    public function index() {
        $template = new \Template('pages/base-template');
            $template->setTheme("admin");
            $template->view_link = DOMAIN;
            $template->news = json_decode(file_get_contents(static::NEWS_URL));
            $template->modules = $this->getAllModules();

        $this->show([
            "page" => $template
        ]);
    }
}