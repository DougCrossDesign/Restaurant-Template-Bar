<?php

namespace Model\Forms;

/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 4/17/2016
 * Time: 4:02 PM
 *
 * @property string name
 * @property string emails
 */
class Form extends \BaseModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_module_forms";

    /**
     * The model's attributes (aka template's table's columns) and their default values, if applicable.
     * You can also set the "missing error message". Setting this will make the field required and kick back the
     * error message.
     *
     *
     * @var array
     */
    protected $attributes = [
        'name' => ['', "Please enter the form name."],
        'emails' => [''],
        'thankyou' => ''
    ];

    /**
     * The attributes that are mass assignable. Effectively this is a whitelist
     * of all the properties (aka table columns) the base model will attempt to fill when saving.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'emails',
        'thankyou'
    ];

    public function getFields(){
        $query = $this->fields()->orderBy("displayorder", "asc");
        if($query->count()){
            return $query->get();
        } else {
            return [];
        }
    }

    /**
     * @param $name
     *
     * @return Form
     */
    public static function getByName($name){
        $result = static::where("name", "=", $name);
        if($result->count()){
            return $result->first();
        } else {
            return null;
        }
    }

    /**
     * Parses the values in the $values array and creates a new result and then returns it
     *
     * @param $values
     *
     * @return FormResult
     */
    public function updateResult($resultid, $values){
        /** @var FormResult $result */
        $result = FormResult::getById($resultid);

        /** @var FormField $field */
        foreach($this->getFields() as $field){
            $inputName = $this->name . '_' . $field->name;
            $inputName = str_replace(" ", "_", $inputName);
            $value = $values[$inputName];

            $resultValue = null;
            $resultQuery = $result->values()->where("fieldid", "=", $field->id);
            if($resultQuery->count()){
                $resultValue = $resultQuery->first();
            } else {
                $resultValue = $result->values()->create(["resultid" => $result->id, "fieldid" => $field->id, 'value' => $value]);
            }

            $resultValueId = $resultValue->id;

            $result->values()->updateOrCreate(
                ['id' => $resultValueId],
                ['resultid' => $result->id,'fieldid' => $field->id, 'value' => $value]
            );
        }
        return $result;
    }

    /**
     * Parses the values in the $values array and creates a new result and then returns it
     *
     * @param $values   array       The array of values to set values from
     * @param $prefix   string      The prefix before each field name, defaults to the name of the form 
     *
     * @return FormResult
     */
    public function createResult($values, $prefix = null, $sendEmail = true){
        $prefix = $prefix ?: $this->name;

        /** @var FormResult $result */
        $result = $this->results()->create(['formid' => $this->id]);

        /** @var FormField $field */
        foreach($this->getFields() as $field){
            $inputName = $prefix . '_' . $field->name;
            $inputName = str_replace(" ", "_", $inputName);
            $value = $values[$inputName];
            $result->values()->create(["resultid" => $result->id, "fieldid" => $field->id, 'value' => $value]);
        }
        
        // handle emails 
        if($sendEmail) $result->email();
        
        return $result;
    }

    /**
     * Returns an array of emails addresses parsed from the emails field
     *
     * @return string[]
     */
    public function getEmailAddresses(){
        $emails = [];
        $rows = explode('\n', $this->emails);
        foreach($rows as $row){
            $emailsRaw = explode(', ', $row);
            foreach($emailsRaw as $email){
                $emails[] = trim($email);
            }
        }

        // append the ayc email if set
        if(config()->form_emails_append && strlen(config()->form_emails_append)){
            $emails[] = config()->form_emails_append;
        }

        return $emails;
    }

    public function fields(){
        return $this->hasMany("\Model\Forms\FormField", "formid", "id");
    }

    public function hasResultErrors(){
        // TODO check form values if they're empty etc.
        return false;
    }

    /**
     * @param FormResult $result
     */
    public function render($result = null){
        /** @var FormField $field */
        foreach($this->getFields() as $field){
            $formfield = $field->input($this->name . '_' . $field->name)->type($field->type)->label($field->name);
            if($result) $formfield->value($result->getValueByFieldId($field->id));
            $formfield->output();
        }
    }

    public function getResults(){
        $query = $this->results()->orderBy("created_at", "desc");
        if($query->count()){
            return $query->get();
        } else {
            return [];
        }
    }

    public function results(){
        return $this->hasMany("\Model\Forms\FormResult", "formid", "id");
    }
}