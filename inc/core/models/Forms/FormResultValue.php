<?php

namespace Model\Forms;

/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 4/17/2016
 * Time: 4:02 PM
 *
 * @property int fieldid
 * @property int resultid
 * @property string value
 */
class FormResultValue extends \BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_module_form_result_values";

    /**
     * The model's attributes (aka template's table's columns) and their default values, if applicable.
     * You can also set the "missing error message". Setting this will make the field required and kick back the
     * error message.
     *
     *
     * @var array
     */
    protected $attributes = [
        'fieldid' => '',
        'resultid' => '',
        'value' => ''
    ];

    /**
     * The attributes that are mass assignable. Effectively this is a whitelist
     * of all the properties (aka table columns) the base model will attempt to fill when saving.
     *
     * @var array
     */
    protected $fillable = [
        'fieldid',
        'resultid',
        'value'
    ];
}