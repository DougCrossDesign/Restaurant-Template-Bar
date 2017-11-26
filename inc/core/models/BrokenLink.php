<?php
/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 4/5/2016
 * Time: 10:37 AM
 */

namespace Model;

use Illuminate\Database\Connection;

class BrokenLink extends \BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_module_broken_links";

    /**
     * The model's attributes (aka template's table's columns) and their default values, if applicable.
     * You can also set the "missing error message". Setting this will make the field required and kick back the
     * error message.
     *
     *
     * @var array
     */
    protected $attributes = [
        'url' => "Please enter the URL where the banner should lead to.",
        'ipaddress' => '',
        "time" => ''
    ];

    /**
     * The attributes that are mass assignable. Effectively this is a whitelist
     * of all the properties (aka table columns) the base model will attempt to fill when saving.
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'ipaddress',
        'time'
    ];

    protected $imageFields = ['image'];
    public $imageFolder = "adbanners";

    public static function createIfIPAddressNotFound(){
        $ip = $_SERVER['REMOTE_ADDR'];
        $url = $_SERVER['REQUEST_URI'];

        // first look for this IP and URL
        $results = static::where("url", "=", $url)->where('ipaddress', '=', $ip);
        if($results->count()) return;

        $record = new static();
        $record->url = $_SERVER['REQUEST_URI'];
        $record->ipaddress = $ip;
        $record->time = time();
        $record->save();
    }

    /**
     * Returns broken links clustered by URL with number of hits
     *
     * @return array
     */
    public static function getClustered($orderBy = 'created_at', $order = 'desc'){
        /** @var \Config $config */
        $config = config();
        /** @var Connection $db */
        $db = config()->getConnection();

        $query = "select id,url, count(id) num, max(created_at) created_at from cms_core_module_broken_links group by url order by $orderBy $order";
        $query = $db->select($query);
        if(count($query)){
            return $query;
        } else {
            return [];
        }



    }

}