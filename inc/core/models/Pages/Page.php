<?php

namespace Model\Pages;

use \BaseModel;
use Input;
use Model\FriendlyUrl;
use Model\User;

/**
 * Class Page
 *
 * @package Model\Pages
 * @property int id
 * @property string title
 * @property string url
 * @property bool in_sitemap
 * @property bool enabled
 * @property bool searchable
 * @property string header
 * @property string footer
 * @property string bodyclass
 * @property string trackingscripts
 */
class Page extends BaseModel
{

     const ASSIGN_ALL_PARTIALS = false;
     public static $PARTIALS_TO_ASSIGN = [3,24,11,20,5,25,18,32,31,8,1];
     public static $defaultPartialIds = null;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_module_pages";

    /**
     * The model's attributes and their default values, if applicable.
     *
     * @var array
     */
    protected $attributes = [
        'title'      => ['', "Please enter a Title"],
        'in_sitemap' => 1,
        'enabled'    => 1,
        'searchable' => 1,
        'header' => '',
        'footer' => '',
        'bodyclass' => '',
        'trackingscripts' => ''
    ];

    /**
     * The attributes that are mass assignable. Effectively this is a whitelist
     * of all the properties the base model will attempt to fill when saving.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'in_sitemap',
        'enabled',
        'searchable',
        'header',
        'footer',
        'bodyclass',
        'trackingscripts'
    ];


    /** @var bool Whether this should save friendly urls */
    protected $usesFriendlyURLs = true;
    /** @var string The controller this should route its friendly urls to */
    public $friendlyURLController = "page";
    /** @var string The method this should route its friendly urls to */
    protected $friendlyURLMethod = "view";
    /** @var string The index column used */
    protected $friendlyURLID = "id";
    /** @var string The field to auto-derive friendly urls from */
    public $friendlyURLDeriveFrom = "title";

    /**
     * @param $pageid
     * @param $pivotid
     *
     * @deprecated Please use the batch command getPartialDataByIds
     *
     * @return null
     */
    public static function getPartialData($pageid, $pivotid)
    {
        /** @var Page $page */
        $page = Page::getById($pageid);
        $query = $page->partials()->wherePivot("id", "=", $pivotid);
        if ($query->count()) {
            $partial = $query->first();
            $data = $partial->getData();
            $data->parent_title = $partial->pivot->title;

            return $data;
        } else {
            return null;
        }
    }

    /**
     * Returns whether this page is currently accessible by the given group
     *
     * @param $groupid
     * @return bool
     */
    public function groupHasPermission($groupid){
        foreach($this->groups()->getResults() as $row){
            if($row->groupid == $groupid) return true;
        }
        return false;
    }

    /**
     * Attach groups to this Page
     *
     * @param $groups
     */
    public function addGroupPermissions($groups){
        // automatically add permissions less than or equal to this permission
        foreach(User::TYPES() as $label => $value){
            if($value && $value <= \Auth::getUserLevel()) $groups[] = $value;
        }

        // add relationship
        foreach($this->groups()->getResults() as $row){
            $row->delete();
        }

        // now add relationships
        $newRows = [];
        foreach($groups as $groupid){
            $newRows[] = [
                "pageid" => $this->id,
                "groupid" => $groupid
            ];
        }
        $this->groups()->createMany($newRows);
    }

    public function groups(){
        return $this->hasMany("\Model\Pages\PageGroupPermission", "pageid", "id");
    }

    /**
     * Checks if the current logged in user can access this page
     *
     * @return bool
     */
    public function accessibleByCurrentUser(){
        // return true if AYC user
        if(\Auth::isSuperAdmin()) return true;

        // otherwise check if personally added to this
        $allowedPages = \Auth::getAllowedPages();
        if(in_array($this->id, $allowedPages)) return true;

        // if not specifically added personally to this page
        // check the user group can access this page
        if($this->groupHasPermission(\Auth::getUserLevel())) return true;

        // otherwise return false
        return false;

    }


    protected function setCustomValues(){
        $this->searchable = Input::post("searchable") ?: 0;
    }

    /**
     * Retrieves all partial datas for a page of a certain partial type.
     * E.g. use this to retrieve all IMAGE types or something.
     *
     * @param $pageid           int      The Page ID
     * @param $partial_type_id  int      Partial type ID
     *
     * @return array|null
     */
    public static function getPartialDatas($pageid, $partial_type_id)
    {
        /** @var Page $page */
        $page = Page::getById($pageid);
        $query = $page->partials();

        $partials = [];

        if ($query->getResults()) {
            /** @var Partial $partial */
            foreach($query->getResults() as $partial){
                if($partial->pivot->partialid == $partial_type_id) $partials[] = $partial->getData();
            }
            return $partials;
        } else {
            return null;
        }
    }

    /**
     * Improved performance by batch-loading partial data for a certain page all at once.
     * Much faster than separate calls since it does it in one query.
     *
     * @param $pageid               int
     * @param $pivotids       int[]|int
     *
     * @return array|null
     */
    public static function getPartialDataByIds($pageid, $pivotids = [])
    {
        if(!is_array($pivotids)){
            $pivotids = [$pivotids];
        }

        $datas = [];
        foreach($pivotids as $id){
            $datas[$id] = [];
        }

        /** @var Page $page */
        $page = Page::with('partials')->where("id", $pageid)->first();
        $query = $page->partials();
        if ($query->count()) {
            $allPartials = $query->get();
            foreach($allPartials as $partial){
                if(in_array($partial->pivot->id, $pivotids)) $datas[$partial->pivot->id] = $partial->getData();
            }
            return $datas;
        } else {
            return null;
        }
    }

    public static function getByUrl($url){
        $friendlyUrl = FriendlyUrl::getByUrl($url);
        if($friendlyUrl) {
            $routeParts = array_filter(explode("/", $friendlyUrl->route));
            $controller = current($routeParts);
            if($controller == "page") {
                $id = end($routeParts);

                return static::getById($id);
            }
        }
    }

    public function availablePartials()
    {
        return $this->manyToMany('Model\Pages\Partial', 'cms_core_module_pages_available_partials', 'pageid', 'partialid',
            'id');
    }

    public function partials()
    {
        return $this->manyToMany('Model\Pages\Partial', 'cms_core_module_pages_partials', 'pageid', 'partialid', 'id',
            ['title', 'static', 'id', 'order', 'permission', 'class']);
    }


    /**
     * Returns partials' templates except the main header banner
     * Useful for hybrid pages
     *
     * @return array|string
     */
    public function getTemplatesExceptBanner()
    {
        $results = $this->partials()->get()->sortBy(function($role){ return $role->pivot->order; });
        if ($results->count()) {
            $output = [];
            /** @var Partial $partial */
            foreach ($results as $partial) {
                if($partial->id != 10) $output[] = $partial->getTemplateFrontEnd();
            }

            return $output;
        } else {
            return '';
        }
    }

    /**
     * Returns partials' templates
     *
     * @return array|string
     */
    public function getTemplates()
    {
        $results = $this->partials()->get()->sortBy(function($role){ return $role->pivot->order; });
        if ($results->count()) {
            $output = [];
            /** @var Partial $partial */
            foreach ($results as $partial) {
                if($template = $partial->getTemplateFrontEnd()){
                    $output[] = $template;
                }
            }

            return $output;
        } else {
            return '';
        }
    }


    public function preSave()
    {
        $this->castForDatabase();

        // check if this friendly url is ok to use
        if ($this->usesFriendlyURLs) {
            $friendlyUrlToUse = in_array(Input::post("friendlyurl"),['']) ? $this->{$this->friendlyURLDeriveFrom} : Input::post("friendlyurl");
            $route = implode("/",
                array($this->friendlyURLController, $this->friendlyURLMethod, $this->{$this->friendlyURLID}));
            if (!FriendlyUrl::isURLAvailable($route, $friendlyUrlToUse)) {
                $this->errors['friendlyurl'] = static::ERROR_URL;

                return false;
            }
        }
    }


    public function getNextOrder(){
        return $this->partials()->get()->count() + 1;
    }


    public function postSave() {
        if($this->usesFriendlyURLs){
            $friendlyUrlToUse = in_array(Input::post("friendlyurl"), ['']) ? $this->{$this->friendlyURLDeriveFrom} : Input::post("friendlyurl");
            $route = implode("/", array($this->friendlyURLController, $this->friendlyURLMethod, $this->{$this->friendlyURLID}));
            FriendlyUrl::addOrIgnore($route, $friendlyUrlToUse, $this->friendlyURLController);
        }
    }

    public function postCreate(){
        // attach all partials that have auto create flag on
        /** @var Partial $partial */
        foreach(Partial::where('autocreate', "=", 1)->get() as $partial){
            $data = ["title" => $partial->name, "permission" => Partial::PERMISSION_EDIT_ONLY];
            // now check autofill fields
            $partial->loadConfig();
            if(isset($partial->config->autofill)){
                foreach($partial->config->autofill as $partialProp => $pageProp){
                    $data[$partialProp] = $this->{$partialProp};
                }
            }
            $this->partials()->attach($partial->id, $data);
        }
        $this->massAssignAllPartials();
    }

    public function massAssignAllPartials(){
        $currentPartials = $this->availablePartials()->get();
        $currentPartialIds = [];
        foreach($currentPartials as $partial){
            if(!in_array($partial->id, $currentPartialIds)) $currentPartialIds[] = $partial->id;
        }
        // add all partials
        $defaultPartialIds = static::getDefaultPartialIds();
        /** @var Partial $partial */
        foreach($defaultPartialIds as $partialid){
            if(!in_array($partialid, $currentPartialIds)){
                $this->availablePartials()->attach($partialid);
            }
        }
    }

    /**
     * Returns a list of IDs of partials that should be made available by default
     */
    public static function getDefaultPartialIds(){
        if(!static::$defaultPartialIds) {
            $ids = [];
            foreach (Partial::where("default", "=", 1)->get() as $partial) {
                $ids[] = $partial->id;
            }
            static::$defaultPartialIds = $ids;
        }
        return static::$defaultPartialIds;
    }

    public static function renderPartials($obj, $ignorePivotIds = []){
        if (isset($obj->partials) && is_array($obj->partials)) {
            /** @var Template $template */
            foreach($obj->partials as $template){
                if(!in_array($template->id, $ignorePivotIds))
                    echo $template->render();
            }
        }
    }
}