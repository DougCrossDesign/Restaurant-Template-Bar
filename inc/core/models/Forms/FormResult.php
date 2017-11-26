<?php

namespace Model\Forms;

/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 4/17/2016
 * Time: 4:02 PM
 */
class FormResult extends \BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_module_form_results";

    /**
     * The model's attributes (aka template's table's columns) and their default values, if applicable.
     * You can also set the "missing error message". Setting this will make the field required and kick back the
     * error message.
     *
     *
     * @var array
     */
    protected $attributes = [
        'formid' => [0, 'Please select a form.']
    ];

    /**
     * The attributes that are mass assignable. Effectively this is a whitelist
     * of all the properties (aka table columns) the base model will attempt to fill when saving.
     *
     * @var array
     */
    protected $fillable = [
        'formid'
    ];

    public function getValueByFieldId($fieldid){
        $query = $this->values()->where("fieldid", "=", $fieldid);
        if($query->count()){
            return $query->first()->value;
        } else {
            return '';
        }
    }



    /**
     * Emails the results of this form to the email addresses on file and optionally an AYC email address
     */
    public function email(){
        /** @var Form $form */
        $form = $this->form;

        if(!strlen($form->emails) && !strlen(config()->form_emails_append)) return;

        $br = '<br />';

        $subject = "New form submission for " . $form->name . " on " . $_SERVER['HTTP_HOST'];

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= "From: no-reply@" . $_SERVER["HTTP_HOST"] . "\r\n";
        $headers .= "Reply-To: no-reply@" . $_SERVER["HTTP_HOST"] . "\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        $body = '<h3>New form submission for ' . $form->name . '</h3>';


        /** @var FormField $field */
        $i = 0;
        foreach($form->getFields() as $field){
            $body .= '<b>' . $field->name . ': </b>' . $this->values[$i]->value . $br;
            $i++;
        }

        foreach($form->getEmailAddresses() as $emailAddress){
            mail($emailAddress, $subject, $body, $headers);
        }
    }

    public function getResultPreview($length = 255){
        $output = [];
        /** @var FormResultValue $value */
        foreach($this->values()->get() as $value){
            $output[] = $value->value;
        }
        $output = implode(", ", $output);
        if($length && strlen($output) > $length){
            return substr($output, 0, 100) . '...';
        } else {
            return $output;
        }

    }
    
    public function form(){
        return $this->hasOne("\Model\Forms\Form", "id", "formid");
    }

    public function values(){
        return $this->hasMany("\Model\Forms\FormResultValue", "resultid", "id");
    }
}