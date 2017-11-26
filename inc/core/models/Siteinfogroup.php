<?php

namespace Model;

use BaseModel;

/**
 * Class Siteinfo
 *
 * @package Model
 * @property string name         The name of the group
 */
class Siteinfogroup extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_module_siteinfogroups";

    /**
     * The model's attributes (aka template's table's columns) and their default values, if applicable.
     * You can also set the "missing error message". Setting this will make the field required and kick back the
     * error message.
     *
     *
     * @var array
     */
    protected $attributes = [
        'name' => ['', "Please enter the name of the group."]
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

    public function siteinfo(){
        return $this->hasMany("\Model\Siteinfo", "group_id");
    }
}