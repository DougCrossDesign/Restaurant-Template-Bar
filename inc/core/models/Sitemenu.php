<?php
/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 12/4/2015
 * Time: 11:21 AM
 */

namespace Model;

use BaseModel;
use Input;
use Model\Pages\Page;

/**
 * Class Redirect
 *
 * @package Model
 * @property string title
 * @property string url
 * @property string image
 * @property int page_id
 * @property int parent_id
 */
class Sitemenu extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_module_sitemenu";

    /**
     * The model's attributes (aka template's table's columns) and their default values, if applicable.
     * You can also set the "missing error message". Setting this will make the field required and kick back the
     * error message.
     *
     *
     * @var array
     */
    protected $attributes = [
        'title' => ['', "Please enter the menu item title"],
        'url' => '',
        'newwindow' => 0,
        'image' => '',
        'page_id' => 0,
        'parent_id' => 0,
        'locked' => 0
    ];

    /**
     * The attributes that are mass assignable. Effectively this is a whitelist
     * of all the properties (aka table columns) the base model will attempt to fill when saving.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'url',
        'newwindow',
        'image',
        'page_id',
        'parent_id',
        'locked'
    ];

    protected $imageFields = ['image'];
    public $imageFolder = 'sitemenu';

    /** @var bool Whether this should save friendly urls */
    protected $usesFriendlyURLs = false;

    protected function setCustomValues(){
        if(!$this->page_id){
            if(in_array($this->url,['','/'])){
                $this->url = $this->title;
            }

            if(substr($this->url, 0, 4) != "http") {
                $this->url = FriendlyUrl::prepFriendlyUrl($this->url);
            }
        }

        $this->newwindow = Input::post('newwindow') ?: 0;
    }

    public static function getInferredBodyClass($default = ''){
        $output = [];

        $thisUrl = \Util::getCurrentCleanUrl();

        // get this site menu obj first
        $thisSiteMenu = null;
        /** @var Sitemenu $sitemenu */
        foreach(Sitemenu::get() as $sitemenu){
            if($sitemenu->getUrl() == $thisUrl){
                $thisSiteMenu = $sitemenu;
            }
        }
        if($thisSiteMenu){
            $parentid = $thisSiteMenu->parent_id;
            if($parentid != 0){
                /** @var Sitemenu $parent */
                $parent = Sitemenu::getById($parentid);
                $output['site_section'] = "sct_" . \Util::getCleanUrl($parent->title);
                $output['page'] = "pg_" . \Util::getCleanUrl($thisSiteMenu->title);
            }
        } else{
            $output['site_section'] = "sct_" . $default;
            $output['page'] = "pg_" . $default;
        }

        return $output;
    }

    public static function get(){
        return static::orderBy("displayorder")->get();
    }

    public function getUrl(){
        if($this->page_id && $page = Page::getById($this->page_id)){
            return $page->getFriendlyUrl();
        } else {
            return $this->url;
        }
    }

    public static function getChildrenOfParent($sitemenuid){
        $query = static::where('parent_id', '=', $sitemenuid)->orderBy("displayorder");
        if($query->count()){
            return $query->get();
        } else {
            return null;
        }
    }

    public static function getChildrenOfParentOf($sitemenu){
        if($sitemenu->parent_id == 1){
            $sitemenuid = $sitemenu->id;
        } else {
            $sitemenuid = $sitemenu->parent_id;
        }



        $query = static::where('parent_id', '=', $sitemenuid)->orderBy("displayorder");
        if($query->count()){
            return $query->get();
        } else {
            return null;
        }
    }


    public static function getChildrenOfCurrentUrl($pagename = null){
        $pagename = $pagename ?: $_SERVER['REQUEST_URI'];

        // first find a PAGE with this url
        $page = Page::getByUrl($pagename);
        if($page){
            // if found, find the MENU with this pageid
            /** @var Sitemenu $sitemenu */
            $sitemenu = Sitemenu::getByPageId($page->id);
            if($sitemenu){
                $childrenSiteMenus = static::getChildrenOfParentOf($sitemenu);

                $parent = $sitemenu->parent_id == 1 ? $sitemenu : Sitemenu::getById($sitemenu->parent_id);

                $return = new \stdClass();
                if($parent) {
                    $return->parent = $parent->title;
                    $return->children = $childrenSiteMenus;
                }
                return $return;
            }
        }

        // else find a MENU with this url
        $url = $pagename;
        $query = static::where("url", "=", $url);
        if($query->count()){
            $sitemenu = $query->first();
            $childrenSiteMenus = static::getChildrenOfParentOf($sitemenu);
            if($childrenSiteMenus){


                $parent = $sitemenu->parent_id == 1 ? $sitemenu : Sitemenu::getById($sitemenu->parent_id);

                $return = new \stdClass();
                    $return->parent = $parent->title;
                    $return->children = $childrenSiteMenus;
                return $return;
            }
        } else {
            return null;
        }
    }

    public static function getByPageId($pageid){
        $query = static::where("page_id", "=", $pageid);
        if($query->count()){
            return $query->first();
        } else {
            return null;
        }
    }

    public function toSitemapItem(){
        $url = strlen($this->url) ? $this->url : $this->getUrl();
        return new SitemapItem($this->title, $url, $this->children ?: []);
    }
}