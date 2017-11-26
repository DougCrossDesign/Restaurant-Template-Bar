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
 * @property string url         The URL that will redirect elsewhere
 * @property string destination The destination that the URL should redirect to
 * @property bool permanent     Whether this should be a 301 perm. redirect or just a normal 302
 * @property int parent_id      The parent Redirect object id if set
 */
class Example extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_base_example";

    /**
     * The model's attributes (aka template's table's columns) and their default values, if applicable.
     * You can also set the "missing error message". Setting this will make the field required and kick back the
     * error message.
     *
     *
     * @var array
     */
    protected $attributes = [
        'url' => ['', "Please enter the URL"],
        'destination' => ['', "Please enter the Destination"],
        'permanent' => 0,
        'parent_id' => 0
    ];

    /**
     * The attributes that are mass assignable. Effectively this is a whitelist
     * of all the properties (aka table columns) the base model will attempt to fill when saving.
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'destination',
        'parent_id',
        'permanent'
    ];


    protected $imageFields = [];

    /** @var bool Whether this should save friendly urls */
    protected $usesFriendlyURLs = false;
    /** @var string The controller this should route its friendly urls to */
    public $friendlyURLController = "employment";
    /** @var string The method this should route its friendly urls to */
    protected $friendlyURLMethod = "details";
    /** @var string The index column used  */
    protected $friendlyURLID = "id";
    /** @var string The field to auto-derive friendly urls from */
    public $friendlyURLDeriveFrom = "title";

    public $imageFolder = "eventtypes";
}