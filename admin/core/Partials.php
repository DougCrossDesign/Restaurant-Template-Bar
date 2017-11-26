<?php

namespace AdminController;

use \Controller\AdminController;
use \Template;
use \Input;
use \Model\Pages\Page;
use \Model\Pages\Partial;

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
class Partials extends AdminController {

    /** @var string The name of the controller in lower case; used for urls */
    protected $controllerName = "partials";

    /** @var string The name of the directory the templates are in */
    protected $templateDir = "partials";

    /** @var string The name of the Model  */
    protected $modelName = "Pages\Partial";

    protected $nameIndex = "name";

    protected $modelNameSingular = "";
    protected $modelNamePlural = "";

    protected $sortBy = 'name';
    protected $sortDirection = 'asc';

    public function index(){
        $modelName = $this->getModelName();

        $models = null;
        if(strlen($this->sortBy)){
            $core = $modelName::where("directory", 'like', "%core_%")->orderBy($this->sortBy, $this->sortDirection)->get();
            $site = $modelName::where("directory", 'like', "%site_%")->orderBy($this->sortBy, $this->sortDirection)->get();
        } else {
            $core = $modelName::where("directory", 'like', "%core_%")->get();
            $site = $modelName::where("directory", 'like', "%site_%")->get();
        }

        $template = new Template("pages/$this->templateDir/index");
        $template->corepartials = $core;
        $template->sitepartials = $site;
        $template->add_link = "/admin/$this->controllerName/add";
        $template->modules = $this->getAllModules();

        $this->show([
            "page" => $template
        ], ["page_title" => $this->parsePluralModelName()]);
    }


    public function editpartial($id){
        $modelName = $this->getModelName();

        $template = new Template("pages/$this->templateDir/modify");
        $template->{strtolower($this->getModelBaseName())} = $modelName::getById($id);
        $template->action_url = "/admin/$this->controllerName/save/" . $id;
        $template->editing = true;
        $template->adding = false;

        $this->show([
            "page" => $template
        ], [
            "page_title" => "Edit " . $this->parseSingularModelName()
        ]);
    }

    public function save($id = 0){
        $modelName = $this->getModelName();

        if(\Input::post('save')){
            if($id > 0){
                // update this user
                $model = $modelName::getById($id);
                $model->setValues(\Input::post());
                $model->save();
            } else {
                // create new
                /** @var Partial $model */
                $model = new $modelName();
                $model->setValues(\Input::post());
                if($this->useDisplayorder) $model->setOrderToLast($this->displayOrderField);
                $model->save();
            }

            if($model->hasErrors()){
                $template = new Template("pages/$this->templateDir/edit");
                $template->{strtolower($this->getModelBaseName())} = $model;

                $this->show([
                    "page" => $template
                ]);
            } else {
                $this->redirect("/admin/$this->controllerName");
            }
        } else if(\Input::post("cancel")){
            $this->redirect("/admin/$this->controllerName");
        }
    }

    public function delete($pageid){
        $pivotid = Input::get("pivotid");
        /** @var Page $page */
        $page = Page::getById($pageid);
        /** @var Partial $partial */
        $partial = $page->partials()->wherePivot("id", "=", $pivotid)->first();

        if (getenv('REQUEST_METHOD') === 'POST') {
            // if we're invoked via post, check to see if we've confirmed deletion before proceeding
            if (Input::post('delete')) {
                $page->partials()->wherePivot("id", "=", $pivotid)->detach();
            }
            $this->redirect("/admin/pages/edit/$pageid");
        } else {
            // invoked via get, render the confirmation template
            $template = new Template("pages/". $this->templateDir ."/delete");
            $template->object_title = $partial->pivot->title;
            $template->action = "/admin/partials/delete/$pageid?pivotid=$pivotid";

            $this->show([
                'page' => $template
            ]);
        }
    }

    public function permission($pageid, $pivotid){
        $permission = Input::get("permission");

        /** @var Page $page */
        $page = Page::getById($pageid);

        /** @var Partial $partial */
        $partial = $page->partials()->wherePivot("id", "=", $pivotid)->first();

        // order the chosen partial pivot
        $page->partials()->wherePivot("id", "=", $pivotid)->updateExistingPivot($partial->id, ["permission" => $permission]);

        $this->redirect("/admin/pages/edit/" . $pageid);
    }

    public function order($pageid, $pivotid = 0){
        $newOrder = Input::get("order");

        /** @var Page $page */
        $page = Page::getById($pageid);

        /** @var Partial $partial */
        $partial = $page->partials()->wherePivot("id", "=", $pivotid)->first();

        // order the chosen partial pivot
        $page->partials()->wherePivot("id", "=", $pivotid)->updateExistingPivot($partial->id, ["order" => $newOrder]);

        // now order the remaining ones around it
        $i = 1;
        foreach($page->partials()->get() as $partial){
            if($i == $newOrder){
                $i++;
            }
            if($partial->pivot->id != $pivotid){
                $page->partials()->wherePivot("id", "=", $partial->pivot->id)->updateExistingPivot($partial->id, ["order" => $i]);
            } else {
                continue;
            }
            $i++;
        }

        $this->redirect("/admin/pages/edit/" . $pageid);
    }

    public function advanced($pageid, $pivotid){
        /** @var Page $page */
        $page = Page::getById($pageid);
        /** @var Partial $partial */
        $partial = $page->partials()->wherePivot("id", "=", $pivotid)->first()->getCustomModel();
        

        if(Input::post("save")){
            $class = Input::post("class");
            $page->partials()->wherePivot("id", "=", $pivotid)->updateExistingPivot($partial->id, ["class" => $class]);
            $this->redirect("/admin/partials/edit/$pageid?pivotid=$pivotid");
        } else if(Input::post("cancel")){
            $this->redirect("/admin/partials/edit/$pageid?pivotid=$pivotid");
        } else {
            $template = new Template("pages/partials/advanced");
            $template->partial = $partial;
            $template->action_url = "/admin/partials/advanced/$pageid/$pivotid";
            $this->show(['page' => $template],[
                "page_title" => "Advanced Settings"
            ]);
        }
    }

    public function edit($pageid){
        $pivotid = Input::get("pivotid");
        /** @var Page $page */
        $page = Page::getById($pageid);
        /** @var Partial $partial */
        $partial = $page->partials()->wherePivot("id", "=", $pivotid)->first()->getCustomModel();
        if (getenv('REQUEST_METHOD') === 'POST') {
            // if we're invoked via post, check to see if we've confirmed deletion before proceeding
            if (Input::post('cancel')) {
                //$partial = $page->partials()->wherePivot("id", "=", $pivotid)->detach();
                $this->redirect("/admin/pages/edit/$pageid");
            } else if(Input::post("submit")){
                $partial->updateValues($partial->pivot->id);
                if(!$partial->hasErrors()){
                    $this->redirect("/admin/pages/edit/$pageid");
                } else {
                    $template = $partial->getTemplateEdit();
                    $template->errors = $partial->getErrors();
                    $this->show([
                        'page' => $template
                    ]);
                }
            }
        } else {
            $template = $partial->getTemplateEdit();
                $template->pageid = $pageid;
                $template->pivotid = $pivotid;
            $this->show([
                'page' => $template
            ]);
        }
    }

}