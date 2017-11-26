<?php

namespace AdminController;

use ArrayPaginator;
use \Controller\AdminController;
use Input;
use Model\BrokenLink;
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
class Brokenlinks extends AdminController {

    /** @var string The name of the controller in lower case; used for urls */
    protected $controllerName = "brokenlinks";

    /** @var string The name of the directory the templates are in */
    protected $templateDir = "brokenlinks";

    /** @var string The name of the Model  */
    protected $modelName = "BrokenLink";

    //protected $nameIndex = "name";

    protected $sortBy = 'created_at';
    protected $sortDirection = 'desc';

    //protected $modelNameSingular = "Example Model";
    //protected $modelNamePlural = "Example Models";

    public function index(){
        $orderby = \Input::get("sort") ?: $this->sortBy;
        $order = \Input::get("direction") ?: $this->sortDirection;

        $brokenlinks = BrokenLink::getClustered($orderby, $order);
        $paginator = new ArrayPaginator($brokenlinks);

        $template = new Template("pages/$this->templateDir/index");
        $template->{strtolower($this->getModelBaseName()) . 's'} = $paginator->get();
        $template->pagination = $paginator->getHtml();
        $template->add_link = "/admin/$this->controllerName/add";
        $template->modules = $this->getAllModules();

        $this->show([
            "page" => $template
        ], ["page_title" => "Broken Links"]);
    }

    public function delete($id){
        $modelName = $this->getModelName();

        /** @var \BaseModel $redirect */
        $model = $modelName::getById($id);

        if (getenv('REQUEST_METHOD') === 'POST') {
            // if we're invoked via post, check to see if we've confirmed deletion before proceeding
            if (Input::post('delete')) {
                BrokenLink::where("url", '=', $model->url)->delete();
            }
            $this->redirect('/admin/'. $this->controllerName);
        } else {
            // invoked via get, render the confirmation template
            $template = new Template("pages/". $this->templateDir ."/delete");
            $template->url = $model->url;
            $template->action = "/admin/". $this->controllerName ."/delete/" . $id;

            $this->show([
                'page' => $template,
            ], [
                "page_title" => "Delete " . $this->parseSingularModelName()
            ]);
        }
    }
}