<?php

namespace Model\Ecom;

use BaseModel;

/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 4/25/2016
 * Time: 5:36 PM
 *
 * @property string title
 * @property int parent_id
 * @property string description
 * @property string metatitle
 * @property string metakeywords
 * @property string metadescription
 * @property bool deleted
 * @property int displayorder
 * @property string searchterms
 */
class Category extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_ecom_categories";

    /**
     * The model's attributes (aka template's table's columns) and their default values, if applicable.
     * You can also set the "missing error message". Setting this will make the field required and kick back the
     * error message.
     *
     *
     * @var array
     */
    protected $attributes = [
        'parent_id' => 0,
        'title' => '',
        'description' => '',
        'metatitle' => '',
        'metakeywords' => '',
        'metadescription' => '',
        'deleted' => 0,
        'displayorder' => 0,
        'searchterms' => ''
    ];

    /**
     * The attributes that are mass assignable. Effectively this is a whitelist
     * of all the properties (aka table columns) the base model will attempt to fill when saving.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'title',
        'description',
        'metatitle',
        'metakeywords',
        'metadescription',
        'deleted',
        'displayorder',
        'searchterms'
    ];

    public function setCustomValues(){
        // maybe handle date?
    }

    protected $imageFields = [];

    public function castForDatabase(){

    }

    public function postCreate(){

    }

    public static function getNestedExcept($excludeId){
        $output = [];
        foreach(Category::where("parent_id", "=", 0)->orderBy("displayorder", "asc")->get() as $category){
            $categoryId = $category->id;
            if($categoryId != $excludeId){
                $category->children = static::getCategoryChildren($category->id, $excludeId);
                $output[] = $category;
            }
        }
        return $output;
    }
    public static function getCategoryChildren($parentCategoryId, $excludeId = null){
        $output = [];
        $query = Category::where("parent_id", "=", $parentCategoryId);
        if($query->count()){
            foreach($query->get() as $category){
                if($excludeId && $category->id == $excludeId) {
                    // dont include
                } else {
                    $category->children = static::getCategoryChildren($category->id, $excludeId);
                    $output[] = $category;
                }
            }
        }
        return $output;
    }
    public static function getNestedDropdown(){
        return static::getNestedDropdownExcept(0);
    }
    public static function getNestedDropdownExcept($excludeId){
        $output = ["None" => 0];
        $nested = static::getNestedExcept($excludeId);
        /** @var Category $category */
        foreach($nested as $category){
            if($category->id != $excludeId) {
                $output[$category->title] = $category->id;
                static::addNestedChildren($output, $category, 1, $excludeId);
            }
        }
        return $output;
    }
    public static function addNestedChildren(&$array, $category, $level, $excludeId = null){
        $spaces = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        $frontSpaces = "";
        for($i = 0; $i < $level; $i++){
            $frontSpaces .= $spaces;
        }

        /** @var Category $childCategory */
        foreach($category->children as $childCategory){
            if($childCategory->id != $excludeId) {
                $array[$frontSpaces . $childCategory->title] = $childCategory->id;
                static::addNestedChildren($array, $childCategory, $level + 1);
            }
        }
    }

    /** @var bool Whether this should save friendly urls */
    protected $usesFriendlyURLs = true;
    /** @var string The controller this should route its friendly urls to */
    public $friendlyURLController = "products";
    /** @var string The method this should route its friendly urls to */
    protected $friendlyURLMethod = "category";
    /** @var string The index column used  */
    protected $friendlyURLID = "id";
    /** @var string The field to auto-derive friendly urls from */
    public $friendlyURLDeriveFrom = "title";

    public $imageFolder = "";

    public function getSummary(){
        return \Util::generateSummary($this->description, 100);
    }

    public function postSave()
    {
        parent::postSave();
    }
}