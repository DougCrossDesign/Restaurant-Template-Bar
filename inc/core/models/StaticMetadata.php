<?php
/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 12/4/2015
 * Time: 11:21 AM
 */

namespace Model;

use BaseModel;
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
class StaticMetadata extends Metadata
{
    public function __construct($title = "The AYC Center", $keywords = "AYC center", $description = "The AYC Center"){
        $this->title = $title;
        $this->keywords = $keywords;
        $this->description = $description;
    }

    public function save(array $options = []){
        throw new \Exception("Cannot save a static metadata model");
    }
}