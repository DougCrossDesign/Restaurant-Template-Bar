<?php

namespace AdminController;


use \Controller\AdminController;
use Model\Gallery;
use Model\Galleryalbum;
use Model\Galleryimage;
use Model\Menu;
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
class Galleryalbums extends AdminController {

    /** @var string The name of the controller in lower case; used for urls */
    protected $controllerName = "galleryalbums";

    /** @var string The name of the directory the templates are in */
    protected $templateDir = "galleryalbums";

    /** @var string The name of the Model  */
    protected $modelName = "Galleryalbum";

    protected $nameIndex = "name";

    protected $sortBy = 'displayorder';
    protected $sortDirection = 'asc';

    protected $usesDisplayOrder = true;


    protected $modelNameSingular = "Album";
    protected $modelNamePlural = "Albums";


    public function addtogallery($galleryid){
        /** @var Gallery $gallery */
        $gallery = Gallery::getById($galleryid);

        $modelName = $this->getModelName();

        $template = new Template("pages/$this->templateDir/add");
        $template->{strtolower($this->getModelBaseName())} = new $modelName();
        $template->action_url = "/admin/$this->controllerName/save";
        $template->menuname = $gallery->name;
        $template->galleryid = $gallery->id;
        $template->editing = false;
        $template->adding = true;

        $this->show([
            "page" => $template
        ], [
            "page_title" => "Add New " . $this->parseSingularModelName()
        ]);
    }

    public function massupload($albumid){

        $image = new Galleryimage();
            $image->gallery_album_id = $albumid;
            $result = $image->uploadSingleFileInto($_FILES, "file", "galleries");
            $image->image = $result;
            $image->setOrderToLast("displayorder");
            $image->save();

        $output = $result . ',' . $image->displayorder;

        die($output);
    }
    public function editordering($albumid){
        $album = Galleryalbum::getById($albumid);

        $template = new Template("pages/galleryalbums/editordering");
        $template->album = $album;
        $template->modules = $this->getAllModules();

        $this->show([
            "page" => $template
        ], ["page_title" => "Manage Ordering"]);
    }
    public function save($id = 0){
        $galleryid = Input::post("gallery_id");

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
                $this->redirect("/admin/galleryalbums/view/$galleryid");
            }
        } else if(\Input::post("cancel")){
            $this->redirect("/admin/galleryalbums/");
        }
    }
    public function view($galleryid){
        /** @var Gallery $gallery */
        $gallery = Gallery::getById($galleryid);

        $albums = $gallery->albums()->count() ? $gallery->albums()->orderBy("displayorder", "asc")->get() : [];

        $template = new Template("pages/galleryalbums/index");
        $template->galleryname = $gallery->name;
        $template->albums = $albums;
        $template->add_link = "/admin/galleryalbums/addtogallery/$galleryid";
        $template->modules = $this->getAllModules();

        $this->show([
            "page" => $template
        ], ["page_title" => $this->parsePluralModelName()]);
    }


    public function edit($albumid){
        /** @var Galleryalbum $album */
        $album = Galleryalbum::getById($albumid);

        $template = new Template("pages/$this->templateDir/edit");
        $template->{strtolower($this->getModelBaseName())} = $album;
        $template->galleryid = $album->gallery_id;
        $template->action_url = "/admin/$this->controllerName/save/" . $albumid;
        $template->editing = true;
        $template->adding = false;

        $this->show([
            "page" => $template
        ], [
            "page_title" => "Edit " . $this->parseSingularModelName()
        ]);
    }

    public function order($id){
        $newOrder = (int) Input::get("order");

        $modelName = $this->getModelName();
        /** @var Galleryalbum $model */
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
        $this->redirect("/admin/" . $this->controllerName . '/view/' . $model->gallery_id);
    }

    public function orderimage($id){
        $newOrder = (int) Input::get("order");

        /** @var Galleryimage $model */
        $image = Galleryimage::getById($id);
        $image->{$this->displayOrderField} = $newOrder;
        $image->save();

        // now order remaining sitemenus
        $images = Galleryimage::where("gallery_album_id",'=',$image->gallery_album_id)->orderBy($this->displayOrderField, "asc");
        $i = 1;
        foreach($images->get() as $othermodel){
            if($i == $newOrder){
                $i++;
            }
            if($othermodel->id != $image->id){
                $othermodel->{$this->displayOrderField} = $i;
                $othermodel->save();
            } else {
                continue;
            }
            $i++;
        }
        $this->redirect("/admin/galleryalbums/editordering/" . $image->gallery_album_id);
    }


    public function delete($id){
        $modelName = $this->getModelName();

        /** @var Galleryalbum $model */
        $model = $modelName::getById($id);

        if (getenv('REQUEST_METHOD') === 'POST') {
            // if we're invoked via post, check to see if we've confirmed deletion before proceeding
            $modelGalleryId = $model->gallery_id;
            if (Input::post('delete')) {
                $model->delete();
            }
            $this->redirect('/admin/galleryalbums/view/'. $modelGalleryId);
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
}