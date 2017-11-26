<?php

namespace Model;

use BaseModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use stdClass;

/**
 * Class AdbannerImpression
 *
 * @package Model
 * @property int id
 * @property int time
 * @property string ip
 */
class AdbannerImpression extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_module_ad_banner_impressions";

    /**
     * The model's attributes (aka template's table's columns) and their default values, if applicable.
     * You can also set the "missing error message". Setting this will make the field required and kick back the
     * error message.
     *
     *
     * @var array
     */
    protected $attributes = [
        'adbanner_id' => [''],
        'time' => [''],
        'ip' => ['']
    ];

    /**
     * The attributes that are mass assignable. Effectively this is a whitelist
     * of all the properties (aka table columns) the base model will attempt to fill when saving.
     *
     * @var array
     */
    protected $fillable = [
        'adbanner_id',
        'time',
        'ip'
    ];

}