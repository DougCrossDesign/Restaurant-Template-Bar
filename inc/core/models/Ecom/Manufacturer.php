<?php

namespace Model\Ecom;

use BaseModel;

/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 4/25/2016
 * Time: 5:36 PM
 */
class Manufacturer extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_ecom_manufacturers";

    /**
     * The model's attributes (aka template's table's columns) and their default values, if applicable.
     * You can also set the "missing error message". Setting this will make the field required and kick back the
     * error message.
     *
     *
     * @var array
     */
    protected $attributes = [
        'title' => '',
        'description' => '',
        'active' => 1,
        'featured' => 1,
        'metatitle' => '',
        'metakeywords' => '',
        'metadescription' => '',
        'logo' => '',
        'displayorder' => 0
    ];

    /**
     * The attributes that are mass assignable. Effectively this is a whitelist
     * of all the properties (aka table columns) the base model will attempt to fill when saving.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'active',
        'featured',
        'metatitle',
        'metakeywords',
        'metadescription',
        'logo',
        'displayorder'
    ];

    public function setCustomValues(){
        // maybe handle date?
    }

    protected $imageFields = ['logo'];

    public function castForDatabase(){

    }

    public function postCreate(){

    }

    /** @var bool Whether this should save friendly urls */
    protected $usesFriendlyURLs = true;
    /** @var string The controller this should route its friendly urls to */
    public $friendlyURLController = "manufacturer";
    /** @var string The method this should route its friendly urls to */
    protected $friendlyURLMethod = "details";
    /** @var string The index column used  */
    protected $friendlyURLID = "id";
    /** @var string The field to auto-derive friendly urls from */
    public $friendlyURLDeriveFrom = "title";

    public $imageFolder = "ecom/manufacturers";

    public function getSummary(){
        return \Util::generateSummary($this->description, 100);
    }

    public function postSave()
    {
        parent::postSave();
    }
}