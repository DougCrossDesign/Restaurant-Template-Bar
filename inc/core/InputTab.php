<?php

/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 4/26/2016
 * Time: 11:04 AM
 */
class InputTab
{
    protected $function;
    public $tabName;
    protected $model;

    /**
     * InputTabBuilder constructor.
     *
     * @param $model        BaseModel       The ORm object
     * @param $tabName      string          The name of the tab
     * @param $function     callable        The function to run inside the tab
     */
    public function __construct($model, $tabName, $function){
        $this->model = $model;
        $this->tabName = $tabName;
        $this->function = $function;
    }

    public function output(){
        $function = $this->function;
        $function($this->model);
    }
}