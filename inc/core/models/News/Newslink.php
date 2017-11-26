<?php
/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 12/4/2015
 * Time: 11:21 AM
 */

namespace Model\News;

use BaseModel;

/**
 * Class Redirect
 *
 * @package Model
 * @property string label
 * @property string url
 * @property bool newwindow
 * @property int displayorder
 *
 */
class Newslink extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_module_newsarticle_newslinks";

    /**
     * The model's attributes (aka template's table's columns) and their default values, if applicable.
     * You can also set the "missing error message". Setting this will make the field required and kick back the
     * error message.
     *
     *
     * @var array
     */
    protected $attributes = [
        'label' => ['', 'Please enter a title.'],
        'url' => ['', 'Please upload a link.'],
        'newwindow' => 1,
        'displayorder' => 0
    ];

    /**
     * The attributes that are mass assignable. Effectively this is a whitelist
     * of all the properties (aka table columns) the base model will attempt to fill when saving.
     *
     * @var array
     */
    protected $fillable = [
        'label',
        'url',
        'newwindow',
        'displayorder'
    ];

    /** @var bool Whether this should save friendly urls */
    protected $usesFriendlyURLs = false;
    /** @var string The controller this should route its friendly urls to */
    public $friendlyURLController = "newslink";
    /** @var string The method this should route its friendly urls to */
    protected $friendlyURLMethod = "details";
    /** @var string The index column used  */
    protected $friendlyURLID = "id";
    /** @var string The field to auto-derive friendly urls from */
    public $friendlyURLDeriveFrom = "title";

    public $imageFolder = "events";
}