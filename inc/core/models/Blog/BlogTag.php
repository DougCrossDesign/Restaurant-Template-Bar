<?php
/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 12/4/2015
 * Time: 11:21 AM
 */

namespace Model\Blog;

use BaseModel;

/**
 * Class Redirect
 *
 * @package Model
 * @property string name
 *
 */
class BlogTag extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_module_blogpost_tags";

    /**
     * The model's attributes (aka template's table's columns) and their default values, if applicable.
     * You can also set the "missing error message". Setting this will make the field required and kick back the
     * error message.
     *
     *
     * @var array
     */
    protected $attributes = [
        'name' => ['', "Please enter the tag name."]
    ];

    /**
     * The attributes that are mass assignable. Effectively this is a whitelist
     * of all the properties (aka table columns) the base model will attempt to fill when saving.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];


    public static function getByName($name){
        $query = static::where("name", "=", $name);
        if($query->count()){
            return $query->first();
        } else {
            return null;
        }
    }

    /**
     * @return $this|\Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts(){
        return $this->manyToMany("\Model\Blog\BlogPost", "cms_core_module_blogposts_to_tags", "blogtag_id", "blogpost_id", "id");
    }
}