<?php

namespace AdminController;

use \Controller\AdminController;
use Input;
use Model\Forms\Form;
use Model\Forms\FormField;
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
class Formfields extends AdminController {

    /** @var string The name of the controller in lower case; used for urls */
    protected $controllerName = "formfields";

    /** @var string The name of the directory the templates are in */
    protected $templateDir = "formfields";

    /** @var string The name of the Model  */
    protected $modelName = "Forms\FormField";

    protected $sortBy = "displayorder";
    protected $sortDirection = "asc";

    //protected $nameIndex = "name";

    //protected $sortBy = 'name';
    //protected $sortDirection = 'asc';

    //protected $modelNameSingular = "Example Model";
    //protected $modelNamePlural = "Example Models";

    public function view($formid){
        /** @var Form $form */
        $form = Form::getById($formid);
        $fields = $form->getFields();

        $template = new Template("/pages/formfields/index");
        $template->modules = $this->getAllModules();
        $template->add_link = "/admin/$this->controllerName/add/$formid";
        $template->fields = $fields;

        $this->show([
            "page" => $template
        ], ["page_title" => $form->name . ' form fields']);
    }
    public function add($formid = 0){
        /** @var Form $form */
        $form = Form::getById($formid);

        $modelName = $this->getModelName();

        $template = new Template("pages/$this->templateDir/add");
        $template->{strtolower($this->getModelBaseName())} = new $modelName();
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

    public function edit($id){
        $modelName = $this->getModelName();
        /** @var FormField $formField */
        $formField = FormField::getById($id);

        $template = new Template("pages/$this->templateDir/edit");
        $template->{strtolower($this->getModelBaseName())} = $formField;
        $template->action_url = "/admin/$this->controllerName/save/" . $id;
        $template->editing = true;
        $template->adding = false;
        $template->form = $formField->form();

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
                $model = $modelName::getById($id);
                $model->setValues(\Input::post());
                $model->save();
            } else {
                // create new
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
                $this->redirect("/admin/$this->controllerName/view/$formid");
            }
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