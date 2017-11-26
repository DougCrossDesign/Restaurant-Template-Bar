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
class Footersitemenu extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_module_footersitemenu";

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
        'parent_id' => 0
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
        'parent_id'
    ];

    protected $imageFields = ['image'];
    public $imageFolder = 'footersitemenu';

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

    public static function getChildrenOfParent($Footersitemenuid){
        $query = static::where('parent_id', '=', $Footersitemenuid)->orderBy("displayorder");
        if($query->count()){
            return $query->get();
        } else {
            return null;
        }
    }

    public static function getChildrenOfParentOf($Footersitemenu){
        if($Footersitemenu->parent_id == 1){
            $Footersitemenuid = $Footersitemenu->id;
        } else {
            $Footersitemenuid = $Footersitemenu->parent_id;
        }



        $query = static::where('parent_id', '=', $Footersitemenuid)->orderBy("displayorder");
        if($query->count()){
            return $query->get();
        } else {
            return null;
        }
    }
    public static function getChildrenOfCurrentUrl(){
        // first find a PAGE with this url
        $page = Page::getByUrl($_SERVER["REQUEST_URI"]);
        if($page){
            // if found, find the MENU with this pageid
            /** @var Footersitemenu $Footersitemenu */
            $Footersitemenu = Footersitemenu::getByPageId($page->id);
            if($Footersitemenu){
                $childrenFootersitemenus = static::getChildrenOfParentOf($Footersitemenu);

                $parent = $Footersitemenu->parent_id == 1 ? $Footersitemenu : Footersitemenu::getById($Footersitemenu->parent_id);

                $return = new \stdClass();
                if($parent) {
                    $return->parent = $parent->title;
                    $return->children = $childrenFootersitemenus;
                }
                return $return;
            }
        }

        // else find a MENU with this url
        $url = $_SERVER["REQUEST_URI"];
        $query = static::where("url", "=", $url);
        if($query->count()){
            $Footersitemenu = $query->first();
            $childrenFootersitemenus = static::getChildrenOfParentOf($Footersitemenu);
            if($childrenFootersitemenus){


                $parent = $Footersitemenu->parent_id == 1 ? $Footersitemenu : Footersitemenu::getById($Footersitemenu->parent_id);

                $return = new \stdClass();
                    $return->parent = $parent->title;
                    $return->children = $childrenFootersitemenus;
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
        return new SitemapItem($this->title, $this->url, $this->children ?: []);
    }
}