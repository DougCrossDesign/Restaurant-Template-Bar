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
class Redirect extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_module_redirects";

    /**
     * The model's attributes and their default values, if applicable.
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
     * of all the properties the base model will attempt to fill when saving.
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'destination',
        'parent_id',
        'permanent'
    ];

    public function validate(){
        // check if this url is being used as friendlyurl OR redirect
        if(FriendlyUrl::getByUrl($this->url, false, true)){
            $this->errors['url'] = static::ERROR_URL;
            return false;
        }

        // check for other redirects with this url
        if(static::getByUrl($this->url)){
            $redirect = static::getByUrl($this->url);
            if($redirect->id != $this->id) {
                $this->errors['url'] = static::ERROR_URL;

                return false;
            }
        }

        return parent::validate();
    }

    public static function getByUrl($url = null, $removeGetVars = true){
        if($removeGetVars){
            $url = $url ?: explode("?", $_SERVER["REQUEST_URI"])[0];
        } else {
            $url = $url ?: $_SERVER["REQUEST_URI"];
        }
        $results = static::where("url", '=', $url);
        if($results->count()){
            return $results->first();
        } else {
            return null;
        }
    }
}