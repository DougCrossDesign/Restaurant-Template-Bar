<?php
/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 3/15/2016
 * Time: 9:41 AM
 */

namespace AdminController;
use Controller\AdminController;
use Model\Script;
use Template;

class Scripts extends AdminController {
    public function index(){
        $scripts = [
            new Script("Clean Friendly Urls", "/inc/core/crons/cleanurls.php", "Looks through the Friendly URLs database and makes sure each URL leads to an existing page. If it doesn't, it deletes it."),
            new Script("Clean User Page and Module Permissions", "/inc/core/crons/pageandmodulepermissions.php", "Makes sure all users, pages, and modules exist in the permissions table."),
            new Script("Empty Redirects", "/inc/core/crons/truncateredirects.php", "Empties (truncates) the redirects table."),
            new Script("Rebuild Search Index", "/inc/core/crons/searchindex.php", "Empties and rebuilds the search index table by rendering and caching all Pages and other modules.")
        ];

        $template = new Template("pages/scripts/index");
        $template->scripts = $scripts;
        $template->modules = $this->getAllModules();

        $this->show([
            "page" => $template
        ], ["page_title" => "Utility Scripts"]);
    }
}