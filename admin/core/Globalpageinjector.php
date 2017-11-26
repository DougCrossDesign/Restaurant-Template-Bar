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
class Globalpageinjector extends AdminController {

    /** @var string The name of the controller in lower case; used for urls */
    protected $controllerName = "globalpageinjector";

    /** @var string The name of the directory the templates are in */
    protected $templateDir = "globalpageinjector";

    /** @var string The name of the Model  */
    protected $modelName = "GlobalPageInjection";

    protected $nameIndex = "name";

    protected $sortBy = 'name';
    protected $sortDirection = 'asc';

    protected $modelNameSingular = "Global Page Injection";
    protected $modelNamePlural = "Global Page Injections";

    public function save($id = 0){
        $modelName = $this->getModelName();

        if(\Input::post('save')){
            if($id > 0){
                // update this user
                $model = $modelName::getById($id);
                $model->setValues($_POST);
                $model->save();
            } else {
                // create new
                $model = new $modelName();
                $model->setValues($_POST);
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
}