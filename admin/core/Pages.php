<?php
namespace AdminController;

use Controller\AdminController;
use \Controller\BaseController;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Model\Pages\Partial;
use Model\User;
use \Template;
use \Response\PageTemplate;
use \Response\Redirect;
use \Model\Pages\Page;
use \Input;
use \TemplateCollection;

class Pages extends AdminController {

    const IMAGE_PATH = '/images/pages';
    const UPLOAD_PATH = '/files';

    protected $templateDir = "pages";
    protected $controllerName = 'Pages';
    protected $modelName = 'Pages\Page';

    protected $modelNameSingular = "";
    protected $modelNamePlural = "";

    protected $sortBy = 'title';
    protected $sortDirection = 'asc';

    public function edit($id){
        // first check if user has permission to view this
        /** @var Page $page */
        $page = Page::getById($id);
        if($page->accessibleByCurrentUser()) {
            $template = new Template("pages/$this->templateDir/edit");
            $template->page = $page;
            $template->action_url = "/admin/pages/save/" . $id;

            $this->show([
                "page" => $template
            ], ["page_title" => "Edit Page"]);
        } else {
            $this->show404();
        }
    }
    public function advanced($id){
        // first check if user has permission to view this
        /** @var Page $page */
        $page = Page::getById($id);
        if($page->accessibleByCurrentUser()) {
            $template = new Template("pages/$this->templateDir/advanced");
            $template->page = $page;
            $template->action_url = "/admin/pages/saveadvanced/" . $id;

            $this->show([
                "page" => $template
            ], ["page_title" => "Advanced Page Settings"]);
        } else {
            $this->show404();
        }
    }
    public function partials($pageid){
        // first check if user has permission to view this
        /** @var Page $page */
        $page = Page::getById($pageid);
        if($page->accessibleByCurrentUser()) {
            $template = new Template("pages/pages/partials");
            $template->page = $page;
            $template->action_url = "/admin/pages/savepartials/" . $pageid;

            $this->show([
                "page" => $template
            ], ["page_title" => "Manage Assigned Partials"]);
        } else {
            $this->show404();
        }
    }
    public function savepartials($pageid){
        /** @var Page $page */
        $page = Page::getById($pageid);
        if(Input::post("partialids")){
            $page->availablePartials()->detach();

            foreach(Input::post("partialids") as $partialid){
                $page->availablePartials()->attach($partialid);
            }
        }

        $this->redirect("/admin/pages/edit/" . $pageid);
    }
    public function massassign(){
        if(Input::post("submit")){
            $pageid = Input::post("page_id");
            /** @var Page $page */
            $page = Page::getById($pageid);
            $page->massAssignAllPartials();
        }
        $template = new Template("pages/pages/massassign");

        $this->show([
            "page" => $template
        ], ["page_title" => "Mass Assign Partials"]);
    }
    public function saveadvanced($id = 0){
        if(Input::post('save')){
            if($id){
                /** @var Page $page */
                $page = Page::getById($id);
                $page->header = Input::post("header");
                $page->footer = Input::post("footer");
                $page->bodyclass = Input::post("bodyclass");
                $page->trackingscripts = Input::post("trackingscripts");
                $page->save();
            }
            if($page->hasErrors()){
                $template = new Template("pages/pages/advanced");
                $template->page = $page;
                $this->show([
                    "page" => $template
                ]);
            } else {
                $this->redirect("/admin/pages/edit/$id");
            }
        } else if(Input::post("cancel")){
            $this->redirect("/admin/pages/edit/$id");
        }
    }
    public function save($id = 0){
        if(Input::post("addpartial")){
            /** @var Page $page */
            $page = Page::getById($id);
            $partialid = Input::post("partialid");
            $title = Input::post("section_title");
            $permission = \Auth::isSuperAdmin() ? Partial::PERMISSION_EDIT_ONLY : Partial::PERMISSION_ALL;
            if(strlen($title)) {
                $page->partials()->attach($partialid, ['title' => $title, 'order' => $page->getNextOrder(), 'permission' => $permission]);
                $this->redirect("/admin/pages/edit/" . $id);
            } else {
                $template = new Template("pages/$this->templateDir/edit");
                $template->page = Page::getById($id);
                $template->action_url = "/admin/pages/save/" . $id;
                $template->section_title_error = "Please enter a title for the new section.";

                $this->show([
                    "page" => $template
                ]);
            }
        } else if(Input::post('save')){
            if($id){
                $page = Page::getById($id);
                $page->setValues(Input::post());
                $page->save();
                $page->addGroupPermissions(Input::post("groups"));
            } else {
                $page = new Page();
                $page->setValues(Input::post());
                $page->searchable = 1;
                $page->save();
                $page->addGroupPermissions(Input::post("groups"));
            }

            if($page->hasErrors()){
                $template = new Template("pages/pages/edit");
                $template->page = $page;

                $this->show([
                    "page" => $template
                ]);
            } else {
                $this->redirect("/admin/pages");
            }
        } else if(Input::post("cancel")){
            $this->redirect("/admin/pages");
        }
    }
}