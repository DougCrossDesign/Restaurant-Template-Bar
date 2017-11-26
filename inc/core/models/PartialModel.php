<?php
/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 12/8/2015
 * Time: 1:11 PM
 */

namespace Model;


class PartialModel extends \BaseModel
{
    public function __construct($tableName, $attributes = []){
        parent::__construct($attributes);
        $this->timestamps = false;
        $this->setTable($tableName);
    }
}