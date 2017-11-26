<?php
use Model\EmailList;

/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 12/21/2015
 * Time: 1:55 PM
 */
class Emailer
{
    protected $values = [];
    protected $errors = [];

    protected $hasError = false;

    /** @var EmailList */
    protected $emailList;

    public function __construct($listid){
        $this->emailList = EmailList::getById($listid);
    }

    /**
     * Returns an email list by name
     *
     * @param $listname
     *
     * @return Emailer|null
     */
    public static function getByListName($listname){
        $emailList = EmailList::getByListName($listname);
        return $emailList ? new Emailer($emailList->id) : null;
    }

    public function add($name, $postName, $required){
        $formValue = \Input::post($postName);

        $error = '';
        if($required && !strlen($formValue)){
            $error = 'Please enter your ' . $name . '.';
            $this->hasError = true;
        }
        $this->errors[$postName] = $error;

        $this->values[$postName] = [$name, $formValue];
    }
    public function addManually($name, $value){
        $this->values[$name] = [$name, $value];
    }
    public function send(){
        $messageParts = ["You've received a new form submission to list: " . $this->emailList->name, ''];

        foreach($this->values as $postName => $data){
            $name = $data[0];
            $value = $data[1];

            $messageParts[] = $name . ': ' . $value;
        }
        $message = implode(PHP_EOL, $messageParts);

        $headers = "From: no-reply@" . $_SERVER["HTTP_HOST"] . "\r\n";
        $headers .= "Reply-To: no-reply@" . $_SERVER["HTTP_HOST"] . "\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        $subject = "New email: " . $this->emailList->name;

        foreach($this->emailList->getEmailAddresses() as $emailAddress){
            mail($emailAddress, $subject, $message, $headers);
        }
    }
    public function getMessage(){
        foreach($this->values as $postName => $data){
            $name = $data[0];
            $value = $data[1];

            $messageParts[] = $name . ': ' . $value;
        }
        return implode(PHP_EOL, $messageParts);
    }
    public function hasErrors(){
        return $this->hasError;
    }
    public function getErrors(){
        return $this->errors;
    }
    public function printErrors(){
        if(count($this->errors)){
            $output = '<a name="emailresponse" style="display: block; margin-bottom: 180px;"></a><div class="errmsg"><div><h3>Please confirm the following and try submitting again.</h3><ul>';
            foreach($this->errors as $section => $error){
                if(strlen($error)) $output .= '<li>' . $error . '</li>';
            }
            $output .= '</ul></div></div>';
            return $output;
        } else {
            return '';
        }
    }
}