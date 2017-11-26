<?php

namespace Model;

use BaseModel;

/**
 * Class AdbannerSize
 *
 * @package Model
 * @property string name        The name of the banner
 * @property int width
 * @property int height
 */
class AdbannerSize extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_module_ad_banner_sizes";

    /**
     * The model's attributes (aka template's table's columns) and their default values, if applicable.
     * You can also set the "missing error message". Setting this will make the field required and kick back the
     * error message.
     *
     *
     * @var array
     */
    protected $attributes = [
        'name' => ['', "Please enter the name of the banner size."],
        'width' => [0, "Please enter the width of this banner size."],
        'height' => [0, "Please enter the height of this banner size."]
    ];

    /**
     * The attributes that are mass assignable. Effectively this is a whitelist
     * of all the properties (aka table columns) the base model will attempt to fill when saving.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'width',
        'height'
    ];

    protected $imageFields = [];
    public $imageFolder = "";
}