<?php
/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 12/9/2015
 * Time: 4:37 PM
 */

namespace Model;
use Illuminate\Database\Capsule\Manager as DB;
use \Route;

/**
 * Class FriendlyUrl
 *
 * @package Model
 * @property string route
 * @property string friendlyurl
 * @property int created
 * @property bool active
 * @property string redirect
 */
class FriendlyUrl extends \BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_module_friendly_urls";

    /**
     * The model's attributes (aka template's table's columns) and their default values, if applicable.
     * You can also set the "missing error message". Setting this will make the field required and kick back the
     * error message.
     *
     *
     * @var array
     */
    protected $attributes = [
        'route' => ['', "Please enter the route"],
        'friendlyurl' => ['', "Please enter the friendly url"],
        'created' => 0,
        'active' => 1,
        'redirect' => ""
    ];

    /**
     * The attributes that are mass assignable. Effectively this is a whitelist
     * of all the properties (aka table columns) the base model will attempt to fill when saving.
     *
     * @var array
     */
    protected $fillable = [
        'route',
        'friendlyurl',
        'active',
        'redirect'
    ];

    public $timestamps = false;

    /**
     * Deactivates a route's friendlyurls
     * By setting active to 0
     * and setting a redirect to the parent controller
     *
     * @param $route
     * @param $controller
     */
    public static function deactivate($route, $controller){
        $results = static::get()->where("route", $route);
        if($results->count()){
            /** @var FriendlyUrl $friendlyurl */
            foreach($results as $friendlyurl){
                $friendlyurl->active = 0;
                $friendlyurl->redirect = "/" . $controller;
                $friendlyurl->save();
            }
        }
    }

    /**
     * Uses the current URL to find a friendly url
     * and returns an object, not a model
     * @return array
     */
    public static function getActiveFromURL(){
        $url = $_SERVER['REQUEST_URI'];
        return static::getByUrl($url, false);
    }

    /**
     * Uses the current URL to find a friendly url
     * and returns an object, not a model
     * @return array
     */
    public static function getRedirectFromURL(){
        $url = $_SERVER['REQUEST_URI'];
        return static::getByUrl($url, false, false);
    }

    /**
     * Checks whether a URL is currently available for use
     *
     * @param $route
     * @param $friendlyurl
     *
     * @return bool
     */
    public static function isURLAvailable($route, $friendlyurl){
        $friendlyurl = static::prepFriendlyUrl($friendlyurl);
        $route = static::prepFriendlyUrl($route);

        // make sure we're not overwriting some important files
        if(!static::isValidUrl($friendlyurl)) return false;

        // check if this url already exists
        /** @var FriendlyUrl $result */
        $result = static::getByUrl($friendlyurl);
        if($result) {
            // now check...
            // if this [returned row]'s route is NOT the same
            // it means we have a conflict
            // and need to tell them to explicitly choose a different url
            if($result){
                if ($result->route != $route) {
                    // this is a different url with the same route and url...
                    // check if this is an expired event
                    if(!$result->isExpiredEvent()){
                        // if its not, then yeah, we can't use this
                        return false;
                    }
                }
            }
        }

        // now check redirect
        $result = Redirect::getByUrl($friendlyurl);
        if(count($result)){
            return false;
        }

        return true;
    }

    /**
     * Checks if this url is valid
     *
     * @param $friendlyurl
     */
    public static function isValidUrl($friendlyurl)
    {
        $necessaryPrefixes = ['/'];     // necessary prefixes
        $badExactMatches = ['/admin', '/../', '/index.php', '/router.php'];    // exact names that aren't allowed
        $badPrefixes = ['/../', '/admin/']; // prefixes that are not allowed

        foreach($necessaryPrefixes as $prefix){
            if(strpos($friendlyurl,$prefix) !== 0) return false;
        }
        foreach($badExactMatches as $term){
            if($friendlyurl == $term) return false;
        }
        foreach($badPrefixes as $prefix){
            if(strpos($friendlyurl, $prefix) === 0) return false;
        }

        return true;
    }

    /**
     * Tries to add a new friendlyurl with the set route and friendlyurl
     * If this url is not available, it returns false.
     *
     * @param $route
     * @param $friendlyurl
     *
     * @return bool
     */
    public static function addOrIgnore($route, $friendlyurl){
        // check if url exists and is active
        if(static::isURLAvailable($route, $friendlyurl)){
            // safe to save
            $model = new FriendlyUrl();
            $model->created = time();
            $model->route = static::prepFriendlyUrl($route);
            $model->friendlyurl = static::prepFriendlyUrl($friendlyurl);
            $model->save();
        } else {
            return false;
        }
    }

    /**
     * Checks whether this friendly url leads to an expired event
     * @return bool
     */
    public function isExpiredEvent(){
        // check if this route leads to an event
        $routeParts = explode("/", $this->route);
        if(($routeParts[1]) != 'events') return false;

        // check if this event date has passed already
        $eventId = end($routeParts);
        /** @var Event $event */
        $event = Event::getById($eventId);
        if($event){
            if($event->date < time()) return true;
        } else {
            return false;
        }

    }

    /**
     * Prepares a friendly url by replacing common punctuation with underscores.
     *
     * @param $url
     *
     * @return mixed|string
     */
    public static function prepFriendlyUrl($url){
        $toDash = [" ", ",", ".", "=", "+"];     // convert to dashes
        $remove = ["'", '"', '�', '&'];              // remove - also handling microsoft office quotes
        $toAnd = ["amp;"];                          // convert to the word "and"

        foreach($toDash as $char){
            $url = str_replace($char,"-", $url);
        }
        foreach($remove as $char){
            $url = str_replace($char, "", $url);
        }
        foreach($toAnd as $char){
            $url = str_replace($char, "and", $url);
        }
        if(substr($url,0,1) != "/") $url = "/" . $url;
        $url = strtolower($url);
        return iconv('UTF-8', 'ASCII//TRANSLIT', $url);
    }

    /**
     * Returns a FriendlyUrl model by looking for an existing friendly url
     *
     * @param $friendlyurl
     *
     * @return FriendlyUrl|null
     */
    public static function getByUrl($url, $prep = true, $active = true){
        if($prep) $url = static::prepFriendlyUrl($url);

        $db = config()->getConnection();
        $result = $db->select("select * from (select * from `cms_core_module_friendly_urls`
          where active = :active order by created desc) as tmp_table where friendlyurl = :url group by route", ['url' => $url, 'active' => $active ? 1 : 0]);
        if(count($result)){
            return FriendlyUrl::getById(current($result)->id);
        } else {
            return null;
        }
    }

    public static function getAllActive(){
        $db = config()->getConnection();
        $result = $db->select("select * from (select * from `cms_core_module_friendly_urls`
          where active = 1 order by created desc) as tmp_table group by route");
        if(count($result)){
            return FriendlyUrl::getById(current($result)->id);
        } else {
            return null;
        }
    }

    public function getRoute(){
        return Route::fromString($this->route);
    }

    /**
     * Returns the most recent model based on the route
     * Or null if not found
     *
     * @param $route
     *
     * @return FriendlyUrl|null
     */
    public static function getByRoute($route){
        $route = static::prepFriendlyUrl($route);
        $result = static::where("route", $route)->orderBy("created", "desc");
        if($result->count()){
            return $result->first();
        } else {
            return null;
        }
    }

    /**
     * Checks if the parsed parts of the route are set in this model
     * If not, it sets them and returns true
     * If so, it returns true
     *
     * @return bool
     */
    protected function hasParts(){
        if($this->parts) return true;
        if(strlen($this->route)){
            $this->parts = array_values(array_filter(explode("/", $this->route)));
            return true;
        }
        return false;
    }

    /**
     * Returns the controller (first) part of this url's route or null if it doesn't exist
     *
     * @return string|null
     */
    public function getController(){
        if($this->hasParts()){
            return $this->parts[0];
        }
        return null;
    }
    /**
     * Returns the method (second) part of this url's route or null if it doesn't exist
     *
     * @return string|null
     */
    public function getMethod(){
        if($this->hasParts()){
            return $this->parts[1];
        }
        return null;
    }
    /**
     * Returns the id (third) part of this url's route or null if it doesn't exist
     *
     * @return string|null
     */
    public function getId(){
        if($this->hasParts()){
            return $this->parts[2];
        }
        return null;
    }
}