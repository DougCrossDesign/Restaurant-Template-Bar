<?php

namespace Controller;

use Illuminate\Database\Eloquent\Collection;
use Model\Pages\Page;
use \Template;
use \Input;

/**
 * Class AdminController
 *
 * Controller class that includes all CRUD functionality so you can set up a back-end quickly
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
 * @package Controller
 */
class AdminController extends BaseController {

    /** @var  string The name of the controller e.g. "events" or "users" in lower case. This will be used in the URL. */
    protected $controllerName;
    /** @var  string The directory where the template files are e.g. "Events" or "Users" usually Capitalized */
    protected $templateDir;
    /** @var  string The name of the Model class you will be modifying e.g. "Event" or "User" */
    protected $modelName;
    /** @var string The value to use as the identifying "name" when deleting, etc. This will be set as the $obj->name property when deleting */
    protected $nameIndex = "url";
    protected $requiresLogin = true;

    /** @var string Used when display "Edit XXXX" etc. */
    protected $modelNameSingular = '';
    /** @var string Used when display "XXXXX's" */
    protected $modelNamePlural = '';

    /** The fully qualified prefix to the model */
    const MODEL_PREFIX = '\Model\\';

    /** @var string The default sort column. Doesnt sort if blank. */
    protected $sortBy = '';
    protected $sortDirection = 'desc';

    protected $modelTopText = '';

    protected $useDisplayorder = true;
    protected $displayOrderField = "displayorder";

    public function index(){
        $modelName = $this->getModelName();

        $models = null;
        if(Input::get("sort")){
            $models = $modelName::orderBy(Input::get("sort"), Input::get("direction"))->get();
        } elseif(strlen($this->sortBy)){
            $models = $modelName::orderBy($this->sortBy, $this->sortDirection)->get();
        } else {
            $models = $modelName::get();
        }
        $paginator = new \Paginator($models);

        $template = new Template("pages/$this->templateDir/index");
        $template->{strtolower($this->getModelBaseName()) . 's'} = $paginator->get();
        $template->pagination = $paginator->getHtml();
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
    public function delete($id){
        $modelName = $this->getModelName();

        /** @var \BaseModel $redirect */
        $model = $modelName::getById($id);

        if (getenv('REQUEST_METHOD') === 'POST') {
            // if we're invoked via post, check to see if we've confirmed deletion before proceeding
            if (Input::post('delete')) {
                $model->delete();
            }
            $this->redirect('/admin/'. $this->controllerName);
        } else {
            // invoked via get, render the confirmation template
            $template = new Template("pages/". $this->templateDir ."/delete");
            $template->{$this->nameIndex} = $model->{$this->nameIndex};
            $template->action = "/admin/". $this->controllerName ."/delete/" . $id;

            $this->show([
                'page' => $template,
            ], [
                "page_title" => "Delete " . $this->parseSingularModelName()
            ]);
        }
    }

    public function order($id){
        $newOrder = (int) Input::get("order");

        $modelName = $this->getModelName();
        $model = $modelName::getById($id);
        $model->{$this->displayOrderField} = $newOrder;
        $model->save();

        // now order remaining sitemenus
        $models = $modelName::orderBy($this->displayOrderField, "asc");
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

        $this->redirect("/admin/" . $this->controllerName);
    }

    protected function parseSingularModelName(){
        if(strlen($this->modelNameSingular)) return $this->modelNameSingular;

        $parts = explode("\\", $this->modelName);
        return ucfirst(end($parts));
    }

    protected function parsePluralModelName(){
        if(strlen($this->modelNamePlural)) return $this->modelNamePlural;

        $parts = explode("\\", $this->modelName);
        return ucfirst(end($parts)) . 's';
    }

    /**
     * Returns the fully qualified model name
     * @return string   The fully qualified model name
     */
    protected function getModelName(){
        return static::MODEL_PREFIX . $this->modelName;
    }

    protected function getModelBaseName(){
        $nameParts = explode("\\", $this->modelName);
        return end($nameParts);
    }

    protected function showFull($templates, $vars = []){
        if(!is_array($templates)) $templates = [$templates];
        if(!array_key_exists("modules", $vars)) $vars['modules'] = $this->getAllModules();

        /*
        if(!array_key_exists('metadata',$templates)){
            $templates['metadata'] = Metadata::getTemplateByUrl();
        }*/

        $response = new \Response\PageTemplate($templates);

        $response->render($vars);
        die();
    }

    /**
     * A modification of the show method for admin page use
     *
     * @param \Template[] $templates
     * @param array $vars
     */
    protected function show($templates, $vars = []){
        if(!is_array($templates)) $templates = [$templates];
        if(!array_key_exists("modules", $vars)) $vars['modules'] = $this->getAllModules();
        if(!array_key_exists("modelTopText", $vars)) $vars['modelTopText'] = $this->modelTopText;

        /*
        if(!array_key_exists('metadata',$templates)){
            $templates['metadata'] = Metadata::getTemplateByUrl();
        }*/

        $response = new \Response\PageTemplate($templates);

        $response->renderPart($vars);
        die();
    }

}