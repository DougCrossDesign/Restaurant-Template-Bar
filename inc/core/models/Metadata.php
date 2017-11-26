<?php
/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 12/4/2015
 * Time: 11:21 AM
 */

namespace Model;

use BaseModel;
use Model\Pages\Page;
use \Template;

/**
 * Class Redirect
 *
 * @package Model
 * @property string url         The URL that will redirect elsewhere
 * @property string title       The destination that the URL should redirect to
 * @property string keywords       The destination that the URL should redirect to
 * @property string description       The destination that the URL should redirect to
 */
class Metadata extends BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_module_metadata";

    /**
     * The model's attributes and their default values, if applicable.
     *
     * @var array
     */
    protected $attributes = [
        'url' => ['', "Please enter the URL"],
        'title' => '',
        'keywords' => '',
        'description' => ''
    ];

    /**
     * The attributes that are mass assignable. Effectively this is a whitelist
     * of all the properties the base model will attempt to fill when saving.
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'title',
        'keywords',
        'description'
    ];

    public static function getTemplateByUrl(){
        $template = new Template("partials/metadata");
        /** @var Metadata $metadata */
        $metadata = static::getByUrl();
        if($metadata){
            $template->meta_title = $metadata->title;
            $template->meta_keywords = $metadata->keywords;
            $template->meta_description = $metadata->description;
        }
        return $template;
    }

    /**
     * @return Metadata|null
     */
    public static function getByUrl(){
        $url = $_SERVER['REQUEST_URI'];
        $url = explode("?", $url)[0];
        $results = static::get()->where('url', $url);
        if($results->count()){
            return $results->first();
        } else {
            // try pages table instead
            $page = Page::getByUrl($url);
            if($page){
                return new StaticMetadata($page->title, $page->title, $page->title);
            } else {
                return null;
            }
        }
    }

    public static function getByUrlOrInferFromUrl(){
        $url = $_SERVER["REQUEST_URI"];
        $url = explode("?", $url)[0];
        if(strpos($url, "/") === 0) $url = substr($url, 1, strlen($url) - 1);
        $parts = explode("/", $url);
        $keywordParts = $parts;
        if(count($parts) > 1){
            $parts[0] .= ":";
        }
        foreach($parts as &$part){
            $part = ucwords(str_replace("-", " ", str_replace("_", " ", $part)));
        }
        $inferred = ucwords(implode(" ", $parts));
        return Metadata::getByUrl() ?: new StaticMetadata($inferred, implode(",", $keywordParts), $inferred);
    }

    public static function getByUrlOrUse($title, $keywords, $description){
        return Metadata::getByUrl() ?: new StaticMetadata($title, $keywords, $description);
    }
}