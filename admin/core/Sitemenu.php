<?php

namespace AdminController;

use \Controller\AdminController;
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
class Sitemenu extends AdminController {

    /** @var string The name of the controller in lower case; used for urls */
    protected $controllerName = "sitemenu";

    /** @var string The name of the directory the templates are in */
    protected $templateDir = "sitemenu";

    /** @var string The name of the Model  */
    protected $modelName = "Sitemenu";

    protected $nameIndex = "title";

    protected $modelNameSingular = "Site Menu Item";
    protected $modelNamePlural = "Site Menu Items";

    protected $allowNesting = true;


    public function index(){
        $modelName = $this->getModelName();
        $models = $modelName::get();

        $template = new Template("pages/$this->templateDir/index");
        $template->{strtolower($this->getModelBaseName()) . 's'} = $models;
        $template->add_link = "/admin/$this->controllerName/add";
        $template->modules = $this->getAllModules();

        $this->show([
            "page" => $template
        ], ["page_title" => $this->parsePluralModelName()]);
    }


    public function add(){
        $modelName = $this->getModelName();

        $template = new Template("pages/$this->templateDir/add");
        $template->{strtolower($this->getModelBaseName())} = new $modelName();
        $template->action_url = "/admin/$this->controllerName/save";
        $template->editing = false;
        $template->adding = true;
        $template->allowNesting = $this->allowNesting;

        $this->show([
            "page" => $template
        ], [
            "page_title" => "Add New " . $this->parseSingularModelName()
        ]);
    }

    public function edit($id){
        $modelName = $this->getModelName();

        $template = new Template("pages/$this->templateDir/edit");
        $template->{strtolower($this->getModelBaseName())} = $modelName::getById($id);
        $template->action_url = "/admin/$this->controllerName/save/" . $id;
        $template->editing = true;
        $template->adding = false;
        $template->allowNesting = $this->allowNesting;

        $this->show([
            "page" => $template
        ], [
            "page_title" => "Edit " . $this->parseSingularModelName()
        ]);
    }
    public function lock($id){
        $sitemenu = \Model\Sitemenu::getById($id);
        $sitemenu->locked = !$sitemenu->locked;
        $sitemenu->save();

        $this->redirect("/admin/sitemenu");
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
                /** @var \Model\Sitemenu $model */
                $model = new $modelName();
                $model->setValues(\Input::post());
                $sitemenus = \Model\Sitemenu::where("parent_id", "=", $model->parent_id);
                $model->displayOrder = $sitemenus->count() + 1;
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
    public function order($sitemenuid){
        $newOrder = (int) Input::get("order");
        /** @var \Model\Sitemenu $sitemenu */
        $sitemenu = \Model\Sitemenu::getById($sitemenuid);
        $sitemenu->displayorder = $newOrder;
        $sitemenu->save();

        // now order remaining sitemenus
        $sitemenus = \Model\Sitemenu::where("parent_id", "=", $sitemenu->parent_id)->orderBy("displayorder", "asc");
        $i = 1;
        foreach($sitemenus->get() as $othersitemenu){
            if($i == $newOrder){
                $i++;
            }
            if($othersitemenu->id != $sitemenu->id){
                $othersitemenu->displayorder = $i;
                $othersitemenu->save();
            } else {
                continue;
            }
            $i++;
        }

        $this->redirect("/admin/sitemenu");
    }
}