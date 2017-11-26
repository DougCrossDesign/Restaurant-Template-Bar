<?php

namespace AdminController;

use \Controller\AdminController;
use Model\Siteinfogroup;
use \Template;
use \Input;

/**
 * Class Template
 *
 * Copy and modify this controller for default CRUD functionality out of the box.
 *
 * 1. Just extend \AdminController and override:
 * - $controllerName: "events, users"
 * - $templateDir: "Events, Users"
 * - $modelName: "Event, User"
 *
 * 2. Then you'll need to create the template folder and templates
 *
 * 3. And the Model
 *
 * @package AdminController
 */
class Siteinfo extends AdminController {

    /** @var string The name of the controller in lower case; used for urls */
    protected $controllerName = "siteinfo";

    /** @var string The name of the directory the templates are in */
    protected $templateDir = "siteinfo";

    /** @var string The name of the Model  */
    protected $modelName = "Siteinfo";

    protected $nameIndex = "key";


    protected $modelNameSingular = "Site Info";
    protected $modelNamePlural = "Site Info";

    protected $sortBy = 'key';
    protected $sortDirection = 'asc';

    public function index(){
        $groups = Siteinfogroup::get();
        $allGroups = [];
        $groupedInfo = [];
        /** @var Siteinfogroup $group */
        foreach($groups as $group){
            $groupedInfo[$group->name] = $group->siteinfo()->count() ? $group->siteinfo()->get() : [];
            $allGroups[] = [$group->id, $group->name];
        }
        $groupedInfo['Ungrouped'] = \Model\Siteinfo::where('group_id', '=', 0)->get();
        $allGroups[] = [0, 'Ungrouped'];

        $template = new Template("pages/$this->templateDir/index");
        $template->groupedInfo = $groupedInfo;
        $template->allGroups = $allGroups;
        $template->add_link = "/admin/$this->controllerName/add";
        $template->modules = $this->getAllModules();

        $this->show([
            "page" => $template
        ], ["page_title" => $this->parsePluralModelName()]);
    }

    public function saveall(){
        $i = 0;
        if(Input::post("id")) {
            foreach (Input::post("id") as $id) {
                $key = Input::post("key")[$i];
                $value = Input::post("value")[$i];
                $group_id = Input::post("group_id")[$i];

                /** @var \Model\Siteinfo $siteinfo */
                $siteinfo = \Model\Siteinfo::getById($id);
                $siteinfo->key = $key;
                $siteinfo->value = $value;
                $siteinfo->group_id = $group_id;
                $siteinfo->save();

                $i++;
            }
        }

        $this->redirect("/admin/siteinfo");
    }

}