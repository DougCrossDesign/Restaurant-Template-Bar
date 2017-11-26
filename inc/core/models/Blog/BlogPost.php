<?php
/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 12/4/2015
 * Time: 11:21 AM
 */

namespace Model\Blog;
use Illuminate\Database\Capsule\Manager as DB;

use BaseModel;
use Input;

/**
 * Class Redirect
 *
 * @package Model
 *
 * @property string title
 * @property string author
 * @property int date
 * @property string content
 *
 */
class BlogPost extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_module_blogposts";

    /**
     * The model's attributes (aka template's table's columns) and their default values, if applicable.
     * You can also set the "missing error message". Setting this will make the field required and kick back the
     * error message.
     *
     *
     * @var array
     */
    protected $attributes = [
        'title' => ['', "Please enter the title."],
        'author' => '',
        'date' => ['', "Please enter the date."],
        'content' => ''
    ];

    /**
     * The attributes that are mass assignable. Effectively this is a whitelist
     * of all the properties (aka table columns) the base model will attempt to fill when saving.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'author',
        'date',
        'content'
    ];

    public function setCustomValues(){
        // maybe handle date?
    }

    protected $imageFields = ['image', 'video_image'];

    public function castForDatabase(){
        if(!isset($this->rawInput) || $this->rawInput == false) {
            $this->date = is_numeric($this->date) ? $this->date : strtotime($this->date);
        }
    }

    public function postCreate(){
        $this->date = date("m/d/Y", $this->date);
    }

    /** @var bool Whether this should save friendly urls */
    protected $usesFriendlyURLs = true;
    /** @var string The controller this should route its friendly urls to */
    public $friendlyURLController = "blog";
    /** @var string The method this should route its friendly urls to */
    protected $friendlyURLMethod = "details";
    /** @var string The index column used  */
    protected $friendlyURLID = "id";
    /** @var string The field to auto-derive friendly urls from */
    public $friendlyURLDeriveFrom = "title";

    public $imageFolder = "blog";

    public function getSummary(){
        return \Util::generateSummary($this->content, 100);
    }

    public function postSave()
    {
        parent::postSave();

        $this->categories()->detach();
        if(Input::post("categories")){
            foreach(Input::post("categories") as $catid){
                $this->categories()->attach($catid);
            }
        }

        $this->tags()->detach();
        if(strlen(Input::post("tags"))){
            $tags = explode(',', Input::post("tags"));
            foreach($tags as $tagname){
                $tagname = ucfirst(trim($tagname));
                $tag = BlogTag::firstOrCreate(["name" => $tagname]);
                $this->tags()->attach($tag->id);
            }
        }
    }

    /**
     * @return $this|\Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories(){
        return $this->manyToMany("\Model\Blog\BlogCategory", "cms_core_module_blogposts_to_categories", "blogpost_id", "blogcategory_id", "id");
    }

    /**
     * @return $this|\Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags(){
        return $this->manyToMany("\Model\Blog\BlogTag", "cms_core_module_blogposts_to_tags", "blogpost_id", "blogtag_id", "id");
    }

    public function isInCategory($categoryId){
        if($this->categories()->count()){
            foreach($this->categories()->get() as $category){
                if($category->id == $categoryId) return true;
            }
            return false;
        } else {
            return false;
        }
    }

    public function getTags(){
        if($this->tags()->count()){
            $output = [];
            foreach($this->tags()->orderBy("name", "asc")->get() as $tag){
                $output[] = $tag->name;
            }
            return implode(', ', $output);
        } else {
            return '';
        }
    }

    public function getCategories(){
        if($this->categories()->count()){
            $output = [];
            foreach($this->categories()->orderBy("name", "asc")->get() as $category){
                $output[] = $category->name;
            }
            return implode(', ', $output);
        } else {
            return '';
        }
    }
}