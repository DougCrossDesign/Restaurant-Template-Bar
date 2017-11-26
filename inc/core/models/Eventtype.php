<?php
/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 12/4/2015
 * Time: 11:21 AM
 */

namespace Model;

use BaseModel;

/**
 * Class Redirect
 *
 * @package Model
 * @property string name
 *
 */
class Eventtype extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_module_event_types";

    /**
     * The model's attributes (aka template's table's columns) and their default values, if applicable.
     * You can also set the "missing error message". Setting this will make the field required and kick back the
     * error message.
     *
     *
     * @var array
     */
    protected $attributes = [
        'name' => ['', "Please enter the event group name"]
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

    protected $imageFields = [];

    /** @var bool Whether this should save friendly urls */
    protected $usesFriendlyURLs = false;
    /** @var string The controller this should route its friendly urls to */
    public $friendlyURLController = "events";
    /** @var string The method this should route its friendly urls to */
    protected $friendlyURLMethod = "details";
    /** @var string The index column used  */
    protected $friendlyURLID = "id";
    /** @var string The field to auto-derive friendly urls from */
    public $friendlyURLDeriveFrom = "name";

    public $imageFolder = "eventtypes";
}