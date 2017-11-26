<?php

namespace AdminController;

use \Controller\AdminController;
use Input;
use Model\Ecom\Product;
use Model\Ecom\ProductDocument;
use Model\Ecom\ProductImage;
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
class Products extends AdminController {

    /** @var string The name of the controller in lower case; used for urls */
    protected $controllerName = "products";

    /** @var string The name of the directory the templates are in */
    protected $templateDir = "ecom/products";

    /** @var string The name of the Model  */
    protected $modelName = "Ecom\Product";

    //protected $nameIndex = "name";

    protected $sortBy = 'title';
    protected $sortDirection = 'asc';


    public function index(){
        $modelName = $this->getModelName();

        $models = null;
        if(Input::get("sort")){
            $models = $modelName::orderBy(Input::get("sort"), Input::get("direction"))->with("manufacturer")->get();
        } elseif(strlen($this->sortBy)){
            $models = $modelName::orderBy($this->sortBy, $this->sortDirection)->with("manufacturer")->get();
        } else {
            $models = $modelName::with("manufacturer")->get();
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

    public function uploadImage($productId){
        $productImage = new ProductImage();
        $productImage->image = $productImage->uploadImageInto('file', "ecom/products");
        $productImage->product_id = $productId;
        $productImage->displayorder = ProductImage::where("product_id", "=", $productId)->count() + 1;
        $productImage->alttext = $_FILES['file']['name'];
        $productImage->save();

        die(json_encode(["image" => $productImage->image, "id" => $productImage->id, "alttext" => $_FILES['file']['name']]));
    }
    public function saveImageOrder($productId){
        foreach(\Input::get("orders") as $order => $id){
            $productImage = ProductImage::getById($id);
            $productImage->displayorder = $order+1;
            $productImage->save();
        }
    }
    public function deleteImage(){
        $imageId = \Input::get("id");
        $productImage = ProductImage::getById($imageId);
        $productImage->delete();
    }
    public function uploadDocument($productId){
        $productDocument = new ProductDocument();
        $productDocument->document = $productDocument->uploadPdfInto('file', "ecom/products");
        $productDocument->title = $productDocument->document;
        $productDocument->product_id = $productId;
        $productDocument->displayorder = ProductDocument::where("product_id", "=", $productId)->count() + 1;
        $productDocument->save();

        die(json_encode(["url" => $productDocument->document, "id" => $productDocument->id]));
    }
    public function deleteDocument(){
        $imageId = \Input::get("id");
        $productDocument = ProductDocument::getById($imageId);
        $productDocument->delete();
    }
    public function saveDocumentOrder($productId){
        foreach(\Input::get("orders") as $order => $id){
            $doc = ProductDocument::getById($id);
            $doc->displayorder = $order+1;
            $doc->save();
        }
    }
    public function editImage(){
        $id = Input::get("id");
        $alttext = Input::get("alttext");

        $image = ProductImage::getById($id);
        $image->alttext = urldecode($alttext);
        $image->save();
    }

    public function editDocument(){
        $id = Input::get("id");
        $title = Input::get("title");

        $doc = ProductDocument::getById($id);
        $doc->title = urldecode($title);
        $doc->save();
    }
    //protected $modelNameSingular = "Example Model";
    //protected $modelNamePlural = "Example Models";

}