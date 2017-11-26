<?php
/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 4/12/2016
 * Time: 1:47 PM
 */

namespace Model\Pages;

use BaseModel;


/**
 * Class PageGroupPermission
 *
 * Defines a relationship between a page and a user permission group from the User::TYPES array.
 *
 * @package Model\Pages
 * @property int id
 * @property int pageid
 * @property int groupid
 * @property int created_at
 * @property int updated_at
 */
class PageGroupPermission extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_module_pages_group_permissions";

    /**
     * The model's attributes (aka template's table's columns) and their default values, if applicable.
     * You can also set the "missing error message". Setting this will make the field required and kick back the
     * error message.
     *
     *
     * @var array
     */
    protected $attributes = [
        'pageid' => [0, "Please enter the page id."],
        'groupid' => [0, 'Please enter the group id.']
    ];

    /**
     * The attributes that are mass assignable. Effectively this is a whitelist
     * of all the properties (aka table columns) the base model will attempt to fill when saving.
     *
     * @var array
     */
    protected $fillable = [
        'pageid',
        'groupid'
    ];

    protected $imageFields = [];

    /** @var bool Whether this should save friendly urls */
    protected $usesFriendlyURLs = false;
    /** @var string The controller this should route its friendly urls to */
    public $friendlyURLController = "";
    /** @var string The method this should route its friendly urls to */
    protected $friendlyURLMethod = "";
    /** @var string The index column used  */
    protected $friendlyURLID = "";
    /** @var string The field to auto-derive friendly urls from */
    public $friendlyURLDeriveFrom = "";

    public $imageFolder = "";

    public function page(){
        return Page::getById($this->pageid);
    }

    public function group(){
        return $this->groupid;
    }
}