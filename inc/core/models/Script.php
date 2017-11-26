<?php
/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 3/15/2016
 * Time: 9:46 AM
 */

namespace Model;


class Script
{
    public $title, $description, $url;

    public function __construct($title, $url, $desc){
        $this->title = $title;
        $this->url = $url;
        $this->description = $desc;
    }
}