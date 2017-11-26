<?php

namespace AdminController;

use \Controller\AdminController;
use Input;
use Model\Ecom\Category;
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
class Productcategories extends AdminController {

    /** @var string The name of the controller in lower case; used for urls */
    protected $controllerName = "productcategories";

    /** @var string The name of the directory the templates are in */
    protected $templateDir = "ecom/categories";

    /** @var string The name of the Model  */
    protected $modelName = "Ecom\Category";

    //protected $nameIndex = "name";

    //protected $sortBy = 'name';
    //protected $sortDirection = 'asc';

    protected $modelNameSingular = "Product Category";
    protected $modelNamePlural = "Product Categories";

    public function index(){
        $modelName = $this->getModelName();

        $models = null;
        $models = Category::getNestedExcept(0);
        $paginator = new \ArrayPaginator($models);

        $template = new Template("pages/$this->templateDir/index");
        $template->{strtolower($this->getModelBaseName()) . 's'} = $paginator->get();
        $template->pagination = $paginator->getHtml();
        $template->add_link = "/admin/$this->controllerName/add";
        $template->modules = $this->getAllModules();

        $this->show([
            "page" => $template
        ], ["page_title" => $this->parsePluralModelName()]);
    }

    public function order($categoryid){
        $newOrder = (int) Input::get("order");
        /** @var Category $category */
        $category = Category::getById($categoryid);
        $category->displayorder = $newOrder;
        $category->save();

        // now order remaining sitemenus
        $categorys = Category::where("parent_id", "=", $category->parent_id)->orderBy("displayorder", "asc");
        $i = 1;
        foreach($categorys->get() as $otherCategory){
            if($i == $newOrder){
                $i++;
            }
            if($otherCategory->id != $category->id){
                $otherCategory->displayorder = $i;
                $otherCategory->save();
            } else {
                continue;
            }
            $i++;
        }

        $this->redirect("/admin/productcategories");
    }
}