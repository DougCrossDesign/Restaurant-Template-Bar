<?php

namespace Model;

use BaseModel;

/**
 * Class AdbannerGroup
 *
 * @package Model
 * @property string name        The name of the banner
 * @property int width
 * @property int height
 */
class AdbannerToGroup extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_module_ad_banner_to_groups";

    /**
     * The model's attributes (aka template's table's columns) and their default values, if applicable.
     * You can also set the "missing error message". Setting this will make the field required and kick back the
     * error message.
     *
     *
     * @var array
     */
    protected $attributes = [
        'banner_id' => [0, "Please enter the banner ID."],
        'group_id' => [0, "Please enter the group ID."]
    ];

    /**
     * The attributes that are mass assignable. Effectively this is a whitelist
     * of all the properties (aka table columns) the base model will attempt to fill when saving.
     *
     * @var array
     */
    protected $fillable = [
        'banner_id',
        'group_id'
    ];

    protected $imageFields = [];
    public $imageFolder = "";
}