<?php
use Model\Pages\Partial;

/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 4/15/2016
 * Time: 11:39 AM
 */
class InputGroupBuilder
{
    protected $model;
    protected $inputBuilders = [];
    protected $label = '';

    /**
     * InputGroupBuilder constructor.
     *
     * @param $model        BaseModel
     * @param $property     string[]
     */
    public function __construct($model, $properties){
        $this->model = $model;
        foreach($properties as $property){
            $this->inputBuilders[] = new InputBuilder($model, $property);
        }

        return $this;
    }

    public function label($label){
        $this->label = $label;
        return $this;
    }

    public function classes($class){
        if(is_string($class)){
            // set this class to all input builders
            /** @var InputBuilder $inputBuilder */
            foreach($this->inputBuilders as $inputBuilder){
                $inputBuilder->classes($class);
            }
        } else if(is_array($class)){
            // set each class to each input builder
            $i = 0;
            /** @var InputBuilder $inputBuilder */
            foreach($this->inputBuilders as $inputBuilder){
                $inputBuilder->classes($class[$i]);
                $i++;
            }
        }

        return $this;
    }

    public function output(){
        echo '<li><div ';
        if(strlen($this->label)) echo ' class="admin-section-t2" ';
        echo '>';
        if(strlen($this->label)) echo '<h2 class="btm-margin col-wrap">'. $this->label . '</h2>';
        echo '<ul class="col-wrap clearfix">';

        /** @var InputBuilder $inputBuilder */
        foreach($this->inputBuilders as $inputBuilder){
            $inputBuilder->output();
        }

        echo '</ul></li>';
    }
}