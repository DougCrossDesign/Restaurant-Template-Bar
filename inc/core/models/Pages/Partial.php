<?php
/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 12/7/2015
 * Time: 12:02 PM
 */

namespace Model\Pages;

use Illuminate\Database\Eloquent\Model;
use \Model\PartialModel;
use \Template;
use \Util;
use \Input;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * Class Partial
 *
 * @package Model\Pages
 * @property string name
 * @property string directory
 * @property string template
 */
class Partial extends \BaseModel
{
    const PERMISSION_NONE = 0;
    const PERMISSION_ALL = 1;
    const PERMISSION_EDIT_ONLY = 2;
    const PERMISSION_ORDER_ONLY = 3;
    public static $PERMISSIONS = [
        "None Allowed",
        "Allow All",
        "Edit Only",
        "Order Only"
    ];

    public $timestamps = false;

    /** @var  \stdClass */
    public $config;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "cms_core_module_partials";

    /**
     * The model's attributes and their default values, if applicable.
     *
     * @var array
     */
    protected $attributes = [
        'name' => ['', "Please enter the name."],
        'directory' => ['', "Please enter the template directory."],
        'template' => '',
        'default' => 0,
        'autocreate' => 0
    ];

    /**
     * The attributes that are mass assignable. Effectively this is a whitelist
     * of all the properties the base model will attempt to fill when saving.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'directory',
        'template',
        'default',
        'autocreate'
    ];
    public function __construct($attributes = []){
        parent::__construct($attributes);
    }
    public function updateValues($pagePartialId){
        // get table from config
        $this->loadConfig();

        // first check if we have this in our db
        $savableModel = null;
        if($model = $this->getPartialModel()){
            // if yes:
            // we're going to hand-update
            $savableModel = false;
        } else {
            // if not:
            // create a new generic model
            $savableModel = true;
            $model = new PartialModel($this->config->table);
            $model->page_partial_id = $pagePartialId;
        }
        $this->preUpdateModel($model);
        foreach ($this->config->columns as $column => $settings) {
            $type = $settings[0];
            $limit = $settings[1];  // explicitly setting so we know whats in slot 1
            $name = $this->config->name . '_' . $column;

            $value = '';
            switch ($type) {
                case "bool":
                    $value = Input::post($name) ?: 0;
                    break;
                case "youtube":
                    $value = Util::getParsedYoutubeId(Input::post($name));
                    break;
                case "image":
                    // first check for a delete checkbox
                    $deleteVar = "delete_" . $this->config->name . "_" . $column;
                    if(Input::post($deleteVar)){
                        $value = '';
                    } else {
                        // otherwise upload if exists
                        $filename = $this->config->name . '_' . $column;
                        if (isset($_FILES[$filename])) {
                            $imageUpload = new \ImageUpload(SYSTEM_DIR . "/". static::IMAGES_FOLDER ."/partials/" . $this->directory . "/");
                            if ($imageUpload->process($_FILES[$filename])) {
                                $value = $imageUpload->getCurrentName();
                            } else {
                                $value = $model->$column;
                            }
                        }
                    }
                    break;
                case "pdf":
                    // first check for a delete checkbox
                    $deleteVar = "delete_" . $this->config->name . "_" . $column;
                    if(Input::post($deleteVar)){
                        $value = '';
                    } else {
                        // otherwise upload if exists
                        $filename = $this->config->name . '_' . $column;
                        if (isset($_FILES[$filename])) {
                            $fileUpload = new \FileUpload(SYSTEM_DIR . "/". static::DOCUMENTS_FOLDER ."/partials/" . $this->directory . "/");
                            if ($fileUpload->process($_FILES[$filename])) {
                                $value = $fileUpload->getCurrentName();
                            } else {
                                $value = $model->$column;
                            }
                        }
                    }
                    break;
                case "url":
                    $value = Input::post($name);
                    if(strlen($value) && !Util::isValidUrl($value)) $this->errors['url'] = "Please enter a valid URL.";
                    break;
                case "text":
                case "int":
                default:
                    $value = Input::post($name);
                    break;
            }
            // set this column with the value
            $model->$column = $value;
        }

        $this->preSaveModel($model);
        if($savableModel){
            // directly save model
            $model->save();
        } else {
            // parse and update the row
            $values = [];
            foreach($model as $key => $value){
                $values[$key] = $value;
            }
            unset($values["id"]);
            // update all values at once

            $query = DB::table($this->config->table)->where("page_partial_id","=",$this->pivot->id)->update($values);
        }
        $this->postSaveModel($model);

        // save parentid for child meta rows
        $parentid = $model->id;
        // now handle meta if it exists
        $this->updateMeta($this->config, $parentid, $parentid, '');
    }

    /**
     * Checks for a ->meta field in $configObj
     * If found, it will look for post data matching the name of the current level of $configObj
     *
     * @param $configObj        The current level config object
     * @param $parentid         The parent ID to save this new meta to
     * @param $name             The current working post form name prefix starting with a blank for top-level
     */
    protected function updateMeta($configObj, $parentid, $formparentid, $name){
        $origName = $name;
        if (isset($configObj->meta)) {
            // append an underbar
            $name .= $configObj->name . '_';

            // start looping through the item_name[] objects from post data
            $i = $formparentid ?: 0;


            $formColumnArrayNameParts = [];
            $formColumnArrayNameParts[] = $name . $configObj->meta->name . '_';
            if(strlen($origName)) $formColumnArrayNameParts[] = $i . '_';
            $formColumnArrayNameParts[] = 'id';

            $modelColumnArrayNameParts = $formColumnArrayNameParts;
            if(strlen($origName)) unset($modelColumnArrayNameParts[1]);

            $formColumnArrayName = implode("", $formColumnArrayNameParts);

            $ii = 0;
            foreach (Input::post($formColumnArrayName) as $value) {
                // query the db for an existing object first
                $query = DB::table($configObj->meta->table)->where("id", "=", Input::post($formColumnArrayName)[$ii]);
                $savableModel = null;
                $modelIdToSendAsParentId = 0;
                // fetch existing model for update
                if($model = $query->first()) {
                    // check if we have an existing row yet
                    $modelIdToSendAsParentId = $model->id;
                    $savableModel = false;
                } else {
                    // create new one and flag to save directly on model
                    $model = new PartialModel($configObj->meta->table);
                    $savableModel = true;
                }

                // check for delete
                // check if we have a delete call for this
                $deleteField = $name . $configObj->meta->name . '_delete_' . $model->id;
                if(Input::post($deleteField)){
                    // need to delete here
                    if($savableModel){
                        $model->delete();
                    } else {
                        DB::table($configObj->meta->table)->where("id", "=", Input::post($formColumnArrayName)[$ii])->delete();
                    }

                } else {
                    // set values from post form
                    $errors = false;
                    $this->preUpdateMeta($model);
                    foreach ($configObj->meta->columns as $column => $settings) {

                        // in special cases we can't just set the value straight from the form (e.g. files)

                        // build post form name
                        $nameParts = [];
                        $nameParts[] = $name . $configObj->meta->name . '_';
                        if (strlen($origName)) {
                            $nameParts[] = $i . '_';
                        }
                        $nameParts[] = $column;
                        $formName = implode("", $nameParts);

                        switch ($settings[0]) {
                            case "bool":
                                $model->{$column} = Input::post($formName)[$ii] ?: 0;
                                break;
                            case "image":
                                $filename = $formName;
                                $deleteVar = $filename . '_delete_' . $model->id;
                                if(Input::post($deleteVar)) {
                                    $model->{$column} = '';
                                } else if (isset($_FILES[$formName])) {
                                    $file = $_FILES[$filename];
                                    $uploadedFileName = $this->uploadMultiImageInto($file, $ii, $this->directory);
                                    if ($uploadedFileName) {
                                        $model->{$column} = $uploadedFileName;
                                    }
                                }
                                break;
                            case "url":
                                $url = Input::post($formName)[$ii];
                                $model->{$column} = $url;
                                if(strlen($url) && !Util::isValidUrl($url)){
                                    $this->errors[$formName][$ii] = "Please enter a valid URL.";
                                    $errors = true;
                                }
                                break;
                            case "youtube":
                                $model->{$column} = Util::getParsedYoutubeId(Input::post($formName)[$ii]);
                                break;
                            default:
                                $model->{$column} = Input::post($formName)[$ii];
                        }

                        // check required fields
                        if(isset($settings[3]) && $settings[3] == true && !strlen($model->{$column})){
                            // cancel because a required field isn't filled out
                            $this->errors[$formName][$ii] = "This field is required";
                            $errors = true;
                        } else {
                            $this->errors[$formName][$ii] = null;
                        }
                    }
                    $model->parent_id = $parentid;

                    if(!$errors) {
                        // save the new meta obj
                        $this->preSaveMeta($model);
                        if ($savableModel) {
                            // new meta model
                            $model->save();
                        } else {
                            // update existing meta model
                            $values = [];
                            foreach ($model as $key => $value) {
                                $values[$key] = $value;
                            }
                            // remove ID so we don't cause conflicts on hand-update
                            unset($values["id"]);
                            DB::table($configObj->meta->table)->where("id", "=",
                                Input::post($formColumnArrayName)[$ii])->update($values);
                        }
                        $this->postSaveMeta($model);
                        // handle next level of meta if exists
                        // $this->updateMeta($configObj->meta, $model->id, $modelIdToSendAsParentId, $name);
                    }
                }
                $ii++;
            }
        }
    }
    public function getPartialModel(){
        $this->loadConfig();
        if(isset($this->pivot)){
            $pagePartialId = $this->pivot->id;
            $config = $this->config;
            $table = $config->table;
            $db = config()->getConnection();
            $exists = $db->select('SELECT COUNT(*) as `exists`
                FROM information_schema.tables
                WHERE table_name IN (?)
                AND table_schema = database()',[$table]);
            if($exists[0]->exists){
                $query = DB::table($table)->where("page_partial_id","=",$this->pivot->id)->orderBy("id", "desc");
                if($query->count()){
                    return $query->first();
                }
            } else {
                trigger_error("Tried to load a partial that has a missing table: " . $table);
                return false;
            }
        } else {
            die('no pivot!');
        }
    }

    /**
     * Returns this partial data and all child meta data
     *
     * @return \stdClass
     */
    public function getData(){
        $data = new \stdClass();
        $partialModel = $this->getPartialModel();
        if($partialModel) {
            foreach ($this->config->columns as $column => $limit) {
                $data->$column = $partialModel->$column;
            }
            $data->meta = $this->getMeta($this->config, $partialModel->id);
        }
        return $data;
    }

    /**
     * Sets variables from config.json for this partial into the template including
     * - Limits
     * - Types
     * - Enabled
     * - Required
     *
     * @param $template Template
     */
    public function setTemplateVars(&$template){
        if($partialModel = $this->getPartialModel()) {
            $limits = [];
            $types = [];
            $enabled = [];
            $required = [];
            if ($partialModel) {
                foreach ($this->config->columns as $column => $settings) {
                    $template->$column = $partialModel->$column;
                    $types[$column] = $settings[0];
                    $limits[$column] = $settings[1];
                    $enabled[$column] = isset($settings[2]) ? $settings[2] : true;
                    $required[$column] = isset($settings[3]) ? $settings[3] : false;
                }
                $template->meta = $this->getMeta($this->config, $partialModel->id);
                $template->meta_limit = $this->getMetaLimit($this->config, $partialModel->id);
            } else {
                foreach ($this->config->columns as $column => $settings) {
                    $types[$column] = $settings[0];
                    $limits[$column] = $settings[1];
                    $enabled[$column] = isset($settings[2]) ? $settings[2] : true;
                    $required[$column] = isset($settings[3]) ? $settings[3] : false;
                }
            }
            $template->limits = $limits;
            $template->types = $types;
            $template->enabled = $enabled;
            $template->required = $required;
            return true;
        } else {
            return null;
        }
    }
    protected function getMetaLimit($config){
        return (isset($config->meta) && isset($config->meta->limit)) ? $config->meta->limit : 0;
    }
    protected function getMeta($config, $parentid){
        if(isset($config->meta)){
            $templateMeta = [];
            // get existing meta
            $query = DB::table($config->meta->table)->where("parent_id", "=", $parentid);
            if(isset($config->meta->order)){
                $query = $query->orderBy($config->meta->order[0], $config->meta->order[1]);
            } else {
                $query = $query->orderBy("id", "asc");
            }
            if($query->count()){
                foreach($query->get() as $row){
                    $item = [];
                    foreach($config->meta->columns as $column => $limit){
                        $item[$column] = $row->$column;
                    }
                    $item['id'] = $row->id;
                    $item = (object) $item;
                    $item->meta = $this->getMeta($config->meta, $row->id);
                    $templateMeta[] = $item;
                }
            }
            // get POST meta that wasn't successfully saved
            $partialName = $config->name;
            $metaName = $partialName . '_' . $config->meta->name;
            // get first column name
            reset($config->meta->columns);
            $columnPostName = $metaName . '_' . key($config->meta->columns);
            if(Input::post($columnPostName)){
                foreach(Input::post($columnPostName) as $num => $value){
                    $metaItem = [];
                    $errorExists = false;
                    foreach($config->meta->columns as $metaColumn => $settings){
                        $thisColumnPostName = $metaName . '_' . $metaColumn;
                        $metaItem[$metaColumn] = Input::post($thisColumnPostName)[$num];
                        if(isset($this->errors) && array_key_exists($thisColumnPostName, $this->errors) && array_key_exists($num, $this->errors[$thisColumnPostName]) && strlen($this->errors[$thisColumnPostName][$num])) $errorExists = true;
                    }
                    if($errorExists) $templateMeta[] = (object) $metaItem;
                }
            }
        }
        return isset($templateMeta) ? $templateMeta : null;
    }


    /**
     * Injects preUpdate code on partial model if Injector exists
     *
     * @param Partial $model
     * @return null
     */
    public function preUpdateModel($model){
        // look for injector preSave function
        if($this->hasInjector()){
            /** @var \PartialInjector $injectorClass */
            $injectorClass = $this->injector;
            $injectorClass::preUpdate($model);
        }
    }

    /**
     * Injects preSave code on partial model if Injector exists
     *
     * @param Partial $model
     * @return null
     */
    public function preSaveModel($model){
        // look for injector preSave function
        if($this->hasInjector()){
            /** @var \PartialInjector $injectorClass */
            $injectorClass = $this->injector;
            $injectorClass::preSave($model);
        }
    }

    /**
     * Injects postSave code on partial model if Injector exists
     *
     * @param Partial $model
     * @return null
     */
    public function postSaveModel($model){
        if($this->hasInjector()){
            /** @var \PartialInjector $injectorClass */
            $injectorClass = $this->injector;
            $injectorClass::postSave($model);
        }
    }
    /**
     * Injects preUpdate code on partial model if Injector exists
     *
     * @param PartialModel $model
     * @return null
     */
    public function preUpdateMeta($model){
        // look for injector preSave function
        if($this->hasInjector()){
            /** @var \PartialInjector $injectorClass */
            $injectorClass = $this->injector;
            $injectorClass::preUpdateMeta($model);
        }
    }

    /**
     * Injects preSave code on partial model if Injector exists
     *
     * @param PartialModel $model
     * @return null
     */
    public function preSaveMeta($model){
        // look for injector preSave function
        if($this->hasInjector()){
            /** @var \PartialInjector $injectorClass */
            $injectorClass = $this->injector;
            $injectorClass::preSaveMeta($model);
        }
    }

    /**
     * Injects postSave code on partial model if Injector exists
     *
     * @param PartialModel $model
     * @return null
     */
    public function postSaveMeta($model){
        if($this->hasInjector()){
            /** @var \PartialInjector $injectorClass */
            $injectorClass = $this->injector;
            $injectorClass::postSaveMeta($model);
        }
    }

    public function preRender($model){
        if($this->hasInjector()){
            /** @var \PartialInjector $injectorClass */
            $injectorClass = $this->injector;
            $injectorClass::preRender($model);
        }
    }

    public function postRender($model){
        if($this->hasInjector()){
            /** @var \PartialInjector $injectorClass */
            $injectorClass = $this->injector;
            $injectorClass::postRender($model);
        }
    }



    /**
     * Checks if we have a loaded PartialInjector, if we don't, it checks for one and loads it if found
     *
     * @return bool
     */
    protected function hasInjector(){
        if(!isset($this->injector)) {
            $filename = SYSTEM_DIR . "/themes/admin/" . Util::formatPath("partials/" . $this->directory) . "Injector.php";
            if(file_exists($filename)) {
                $tokens = token_get_all(file_get_contents($filename));
                $i = 0;
                foreach($tokens as $data){
                    if($data[0] == T_CLASS){
                        // found the class.. get the class name 2 entries after this one
                        $classname = $tokens[$i + 2][1];
                        // now we can include and call the static methods on this class
                        include($filename);
                        $this->injector = $classname;
                        break;
                    }
                    $i++;
                }
                return true;
            } else {
                return false;
            }
        }
        return true;
    }

    /**
     * Loads the partial config file from /partial/config.json
     */
    public function loadConfig(){
        if(!isset($this->config)) {
            $filename = SYSTEM_DIR . "/themes/admin/" . Util::formatPath("partials/" . $this->directory) . "config.json";
            $file = file_get_contents($filename);
            $this->config = json_decode($file);
        }
    }

    /** Returns a custom Partial type if called for in config */
    public function getCustomModel(){
        $this->loadConfig();
        if(isset($this->config->model)){
            $modelname = 'Model\\Pages\\' . $this->config->model;
            $model = $this->cast($modelname, $this);
            return $model;
        }
        return $this;
    }

    protected function cast($destination, $sourceObject)
    {
        if (is_string($destination)) {
            $destination = new $destination();
        }
        $sourceReflection = new \ReflectionObject($sourceObject);
        $destinationReflection = new \ReflectionObject($destination);
        $sourceProperties = $sourceReflection->getProperties();
        foreach ($sourceProperties as $sourceProperty) {
            $sourceProperty->setAccessible(true);
            $name = $sourceProperty->getName();
            $value = $sourceProperty->getValue($sourceObject);
            if ($destinationReflection->hasProperty($name)) {
                $propDest = $destinationReflection->getProperty($name);
                $propDest->setAccessible(true);
                $propDest->setValue($destination,$value);
            } else {
                $destination->$name = $value;
            }
        }
        return $destination;
    }

    /**
     * This is used when you actually click EDIT on the partial to edit it
     * @return Template
     */
    public function getTemplateEdit(){
        $template = new Template("partials/editpartial");

        $body = $this->getTemplateBackEnd();
        $this->setTemplateVars($body);
        $body->errors = $this->getErrors();
        $body->limits = $this->getLimits();
        $body->types = $this->getTypes();

        $body->metalimits = $this->getMetaLimits();
        $body->metatypes = $this->getMetaTypes();
        $body->metaenabled = $this->getMetaEnabled();
        $body->metarequired = $this->getMetaRequired();
        $body->enabled = $this->getEnabled();
        $body->partial = $this;

        $template->body = $body->render();


        $submit = new Template("partials/submitpartial");
        $template->submit = $submit->render();

        return $template;
    }



    /**
     * Return the errors from our last save attempt.
     *
     * @return array
     */
    public function getErrors() {
        // add an index for each field
        $this->loadConfig();
        foreach($this->config->columns as $key => $value){
            if(!isset($this->errors[$key])) $this->errors[$key] = null;
        }
        return $this->errors;
    }

    /**
     * Returns the types from config.json for this partial
     *
     * @return array
     */
    public function getMetaTypes(){
        $types = [];
        $this->loadConfig();
        if(isset($this->config->meta)){
            foreach($this->config->meta->columns as $key => $data){
                $types[$key] = $data[0];
            }
        }
        return $types;
    }


    public function getEnabled(){
        $enabled = [];
        foreach($this->config->columns as $name => $value){
            $enabled[$name] = $value;
        }
        return $enabled;
    }

    /**
     * Returns whether the meta column is required from config.json for this partial
     *
     * @return array
     */
    public function getMetaRequired(){
        $required = [];
        $this->loadConfig();
        if(isset($this->config->meta)){
            foreach($this->config->meta->columns as $key => $data){
                $required[$key] = isset($data[3]) ? $data[3] : true;
            }
        }
        return $required;
    }

    /**
     * Returns whether the meta column is enabled from config.json for this partial
     *
     * @return array
     */
    public function getMetaEnabled(){
        $enabled = [];
        $this->loadConfig();
        if(isset($this->config->meta)){
            foreach($this->config->meta->columns as $key => $data){
                $enabled[$key] = isset($data[2]) ? $data[2] : true;
            }
        }
        return $enabled;
    }

    /**
     * Returns the types from config.json for this partial
     *
     * @return array
     */
    public function getTypes(){
        $types = [];
        $this->loadConfig();
        foreach($this->config->columns as $key => $data){
            $types[$key] = $data[0];
        }
        return $types;
    }


    /**
     * Returns the input limits from config.json for this partial's meta items
     *
     * @return array
     */
    public function getMetaLimits(){
        $limits = [];
        $this->loadConfig();
        if(isset($this->config->meta)){
            foreach($this->config->meta->columns as $key => $data){
                $limits[$key] = $data[1];
            }
        }
        return $limits;
    }

    /**
     * Returns the input limits from config.json for this partial
     *
     * @return array
     */
    public function getLimits(){
        $limits = [];
        $this->loadConfig();
        foreach($this->config->columns as $key => $data){
            $limits[$key] = $data[1];
        }
        return $limits;
    }

    /**
     * Returns the limit for this property from the config.json
     *
     * @param $property
     *
     * @return int
     */
    public function getLimit($property){
        $this->loadConfig();
        foreach($this->config->columns as $columnName => $data){
            if($columnName == $property) return $data[1];
        }
        return 0;
    }

    /**
     * Returns the type for this property from the config.json
     *
     * @param $property
     *
     * @return int
     */
    public function getType($property){
        $this->loadConfig();
        foreach($this->config->columns as $columnName => $data){
            if($columnName == $property) return $data[0];
        }
        return '';
    }

    /**
     * @return Template
     */
    public function getTemplateFrontEnd(){
        $this->preRender($this);
        $filename = strlen($this->template) ? $this->template : "default";
        $filename = "partials/" . $this->directory . "/" . $filename;
        $template = new Template($filename);
        if($this->setTemplateVars($template)){
            $template->setTheme("site");
            $template->id = $this->pivot->id;
            $template->class = $this->pivot->class;
            $this->postRender($this);
            return $template;
        } else {
            return null;
        }
    }

    public function getPartialName(){
        $this->loadConfig();
        return $this->config->name;
    }
    public function renderFrontEnd(){
        // include the template file
        $template = $this->getTemplateFrontEnd();
        echo $template->render();
    }
    public function getTemplateBackEnd(){
        $filename = strlen($this->template) ? $this->template : "default";
        $filename = "partials/" . $this->directory . "/" . $filename;
        $template = new Template($filename);
        $this->setTemplateVars($template);
        $template->setTheme("admin");
        return $template;
    }
    public function renderBackEnd(){
        // include the template file
        $template = $this->getTemplateBackEnd();
        echo $template->render();
    }
    public static function getDefaultPartials(){
        return Partial::orderBy("name", "asc")->where("default", "=", 1)->get();
    }
}