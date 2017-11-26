<?php

namespace AdminController;

use Controller\AdminController;
use \Input;

use \Model\Redirect;
use \Template;

class Redirects extends AdminController {

    protected $controllerName = "redirects";
    protected $templateDir = "redirects";
    protected $modelName = "Redirect";
    protected $nameIndex = "url";

    protected $modelNameSingular = "";
    protected $modelNamePlural = "";

    protected $sortBy = 'url';
    protected $sortDirection = 'asc';

    public function save($id = 0){

        if(\Input::post('save')){
            if($id){
                // update this user
                $model = Redirect::getById($id);
                $model->setValues(\Input::post());
                $model->permanent = \Input::post("permanent");
                $model->save();
            } else {
                // create new
                $model = new Redirect();
                $model->setValues(\Input::post());
                $model->permanent = \Input::post("permanent");
                $model->save();
            }

            if($model->getErrors()){
                $template = new Template("pages/Redirects/edit");
                $template->redirects = $model;

                $this->show([
                    "page" => $template
                ]);
            } else {
                $this->redirect("/admin/redirects");
            }
        } else if(\Input::post("cancel")){
            $this->redirect("/admin/redirects");
        }
    }
}