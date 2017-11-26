<?php

namespace Model\Forms;

/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 4/17/2016
 * Time: 4:02 PM
 *
 * @property int formid
 * @property string name
 * @property string type
 * @property int displayorder
 */
class FormField extends \BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_module_form_fields";

    /**
     * The model's attributes (aka template's table's columns) and their default values, if applicable.
     * You can also set the "missing error message". Setting this will make the field required and kick back the
     * error message.
     *
     *
     * @var array
     */
    protected $attributes = [
        'formid' => [0, 'Please select a form.'],
        'name' => ['', "Please enter the form name."],
        'type' => ['', 'Please choose an input type.'],
        'displayorder' => 0
    ];

    /**
     * The attributes that are mass assignable. Effectively this is a whitelist
     * of all the properties (aka table columns) the base model will attempt to fill when saving.
     *
     * @var array
     */
    protected $fillable = [
        'formid',
        'name',
        'type',
        'displayorder'
    ];

    /** Sets this model to the last in its group by ordering by $displayOrderField */
    public function setOrderToLast($displayOrderField){
        if(isset($this->$displayOrderField) && strlen($this->$displayOrderField)) {
            $this->{$displayOrderField} = static::where("formid", "=", $this->formid)->count() + 1;
        }
    }

    public function form(){
        return $this->hasOne("\Model\Forms\Form", "id", "formid")->getResults();
    }
}