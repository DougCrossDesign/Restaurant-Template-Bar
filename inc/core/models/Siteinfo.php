<?php

namespace Model;

use BaseModel;

/**
 * Class Siteinfo
 *
 * @package Model
 * @property int group_id      The group ID
 * @property string key         The key associated with the data
 * @property string value       The value of the key
 */
class Siteinfo extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_module_siteinfo";

    /**
     * The model's attributes (aka template's table's columns) and their default values, if applicable.
     * You can also set the "missing error message". Setting this will make the field required and kick back the
     * error message.
     *
     *
     * @var array
     */
    protected $attributes = [
        'group_id' => 0,
        'key' => ['', "Please enter the name of the data."],
        'value' => ['', "Please enter value of the data."],
    ];

    /**
     * The attributes that are mass assignable. Effectively this is a whitelist
     * of all the properties (aka table columns) the base model will attempt to fill when saving.
     *
     * @var array
     */
    protected $fillable = [
        'group_id',
        'key',
        'value'
    ];

    /**
     * Returns a Siteinfo model object based on the key
     *
     * @param $key
     *
     * @return mixed|null
     */
    public static function getByKey($key){
        $result = static::get()->where("key", $key);
        return $result->count() ? $result->first() : null;
    }

    /**
     * Directly returns the value of a key or null
     *
     * @param $key string The key
     *
     * @return string|null
     */
    public static function getValueByKey($key){
        $siteinfo = static::getByKey($key);
        return $siteinfo ? $siteinfo->value : '';
    }
}