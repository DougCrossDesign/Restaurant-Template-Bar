<?php
/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 1/18/2016
 * Time: 11:31 AM
 */

namespace Model;

/**
 * Class SearchIndexItem
 *
 * @package Model
 * @property string title
 * @property string url
 * @property string content
 */
class SearchIndexItem extends \BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_base_search_index";

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
        'url' => ['', "Please enter the URL."],
        'content' => ['', "Please enter the content."]
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
        'content'
    ];

    public $timestamps = false;
}