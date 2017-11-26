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
 * @property string email_addresses
 *
 */
class EmailList extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_module_email_lists";

    /**
     * The model's attributes (aka template's table's columns) and their default values, if applicable.
     * You can also set the "missing error message". Setting this will make the field required and kick back the
     * error message.
     *
     *
     * @var array
     */
    protected $attributes = [
        'name' => ['', "Please enter the email list name."],
        'email_addresses' => ['', 'Please enter at least one destination email address.'],
    ];
    /**
     * The attributes that are mass assignable. Effectively this is a whitelist
     * of all the properties (aka table columns) the base model will attempt to fill when saving.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email_addresses'
    ];

    /**
     * Fetches an EmailList by name
     * Returns null on fail
     *
     * @param $listname
     *
     * @return EmailList|null
     */
    public static function getByListName($listname){
        $query = static::where("name", $listname);
        if($query->count()){
            $emailList = $query->first();
            return $emailList;
        } else {
            return null;
        }
    }
    protected $imageFields = [];

    public function emails(){
        return $this->hasMany("\Model\EmailAddress", "list_id");
    }

    /**
     * Returns an array of string email addresses
     *
     * @return string[]
     */
    public function getEmailAddresses(){
        $addresses = [];
        foreach(explode("\n", $this->email_addresses) as $line){
            foreach(explode(",", $line) as $address){
                $address = trim($address);
                $addresses[] = $address;
            }
        }
        return $addresses;
    }

    /**
     * @param $ids int[]
     */
    public static function getByIds($ids){
        return static::whereIn("id", $ids)->get();
    }

    /** @var bool Whether this should save friendly urls */
    protected $usesFriendlyURLs = false;
    /** @var string The controller this should route its friendly urls to */
    public $friendlyURLController = "emaillists";
    /** @var string The method this should route its friendly urls to */
    protected $friendlyURLMethod = "details";
    /** @var string The index column used  */
    protected $friendlyURLID = "id";
    /** @var string The field to auto-derive friendly urls from */
    public $friendlyURLDeriveFrom = "title";

    public $imageFolder = "events";
}