<?php

namespace AdminController;

use \Controller\AdminController;
use Input;
use Model\Forms\Form;
use Model\Forms\FormResult;
use Template;

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
 * 4. And finally the Module if this is an admin module
 *
 * @package AdminController
 */
class Formresults extends AdminController {

    /** @var string The name of the controller in lower case; used for urls */
    protected $controllerName = "formresults";

    /** @var string The name of the directory the templates are in */
    protected $templateDir = "formresults";

    /** @var string The name of the Model  */
    protected $modelName = "Forms\FormResult";

    protected $sortBy = "date";
    protected $sortDirection = "asc";

    public function view($formid){
        /** @var Form $form */
        $form = Form::getById($formid);
        $results = $form->getResults();

        $template = new Template("/pages/formresults/index");
        $template->modules = $this->getAllModules();
        $template->add_link = "/admin/$this->controllerName/add/$formid";
        $template->results = $results;
        $template->form = $form;

        $this->show([
            "page" => $template
        ], ["page_title" => $form->name . ' form fields']);
    }
    public function add($formid = 0){
        /** @var Form $form */
        $form = Form::getById($formid);

        $modelName = $this->getModelName();

        $template = new Template("pages/$this->templateDir/add");
        $template->action_url = "/admin/$this->controllerName/save";
        $template->editing = false;
        $template->adding = true;
        $template->form = $form;

        $this->show([
            "page" => $template
        ], [
            "page_title" => "Add New " . $this->parseSingularModelName()
        ]);
    }
    public function edit($resultid){
        $result = FormResult::getById($resultid);
        $form = Form::getById($result->formid);

        $template = new Template("pages/$this->templateDir/edit");
        $template->action_url = "/admin/$this->controllerName/save/" . $resultid;
        $template->editing = true;
        $template->adding = false;
        $template->form = $form;
        $template->result = $result;

        $this->show([
            "page" => $template
        ], [
            "page_title" => "Edit " . $this->parseSingularModelName()
        ]);
    }
    public function save($id = 0){
        $modelName = $this->getModelName();

        if(\Input::post('save')){
            $formid = \Input::post("formid");

            if($id > 0){
                // update this user
                /** @var Form $form */
                $form = Form::getById($formid);
                $form->updateResult(Input::post("resultid"), \Input::post());
            } else {
                // create new
                /** @var Form $form */
                $form = Form::getById($formid);
                $form->createResult(\Input::post(), null, false);
            }

            // TODO normalize form input name using all lowercase, remove spaces etc - also means we need to prevent 2 inputs with the same name
            $this->redirect("/admin/$this->controllerName/view/$formid");

        } else if(\Input::post("cancel")){
            $formid = \Input::post("formid");
            $this->redirect("/admin/$this->controllerName/view/$formid");
        }
    }
    public function order($id){
        $newOrder = (int) Input::get("order");

        $modelName = $this->getModelName();
        $model = $modelName::getById($id);
        $model->{$this->displayOrderField} = $newOrder;
        $model->save();

        // now order remaining sitemenus
        $models = $modelName::where("formid", "=", $model->formid)->orderBy($this->displayOrderField, "asc");
        $i = 1;
        foreach($models->get() as $othermodel){
            if($i == $newOrder){
                $i++;
            }
            if($othermodel->id != $model->id){
                $othermodel->{$this->displayOrderField} = $i;
                $othermodel->save();
            } else {
                continue;
            }
            $i++;
        }

        $this->redirect("/admin/" . $this->controllerName . "/view/" . Input::get("formid"));
    }
}