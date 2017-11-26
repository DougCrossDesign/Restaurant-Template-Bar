<?php
use Model\Pages\Partial;

/**
 * Created by PhpStorm.
 * User: Keith Larson AYC
 * Date: 4/15/2016
 * Time: 11:39 AM
 */
class InputBuilder
{
    protected $model;
    protected $property;
    protected $type = 'text';
    protected $description = '';
    protected $limit = 0;
    protected $beforeInput = '';
    protected $placeholder = '';
    protected $classes = '';
    protected $id = '';
    public $imageFolder = '';
    protected $rolloverFolder = '';
    public $pdfFolder = '';
    protected $value;
    protected $prefix = '';
    protected $options;
    public $isPartial = false;

    /**
     * InputBuilder constructor.
     *
     * @param $model        BaseModel
     * @param $property
     */
    public function __construct($model, $property){
        $this->model = $model;
        $this->property = $property;

        if($this->model instanceof Partial){
            $this->isPartial = true;
            // fetch this property's type if set in config.json
            $this->type = $this->model->getType($this->property);
        }

        switch($property){
            case 'friendlyurl':
                $this->type("friendlyurl");
                break;
        }
    }

    /**
     * Sets the input type.
     * Some types have additional requirements
     * Valid types are:
     *        text
     *        checkbox
     *        image
     *        pdf
     *        file
     *        textarea_raw      (simple textarea)
     *        textarea          (tinymce input)
     *        date              (adds datepicker classes)
     *        time  
     *        hidden
     *        friendlyurl       - Requires use of the friendlyurlPrefix() method to set the auto-infer url prefix
     *        select / dropdown - Requires use of the option() method to set dropdown options
     *
     * @param $type string
     * @return $this
     */
    public function type($type){
        $this->type = $type;
        return $this;
    }

    /**
     * Sets the image folder for image inputs.
     * Defaults to /assets/images/MODEL_NAME/cms/FILE_NAME
     *
     * @param $folder
     *
     * @return $this
     */
    public function imageFolder($folder){
        $this->imageFolder = $folder;
        return $this;
    }

    /**
     * Sets the dropdown / select options
     *
     * @param $options  string[]    Dropdown options as label => value pairs
     *
     * @return $this
     */
    public function options($options){
        $this->options = $options;
        return $this;
    }

    /**
     * Sets the rollover folder for image inputs.
     * Defaults to /assets/images/MODEL_NAME/rollover/FILE_NAME
     *
     * @param $folder
     *
     * @return $this
     */
    public function rolloverFolder($folder){
        $this->rolloverFolder = $folder;
        return $this;
    }

    /**
     * Sets the pdf folder for pdf inputs.
     * Defaults to /assets/pdfs/MODEL_NAME/FILE_NAME
     *
     * @param $folder
     *
     * @return $this
     */
    public function pdfFolder($folder){
        $this->pdfFolder = $folder;
        return $this;
    }

    /**
     * Sets the input description
     *
     * @param $description string
     * @return InputBuilder $this
     */
    public function desc($description){
        $this->description = $description;
        return $this;
    }

    /**
     * Alias for desc($description)
     *
     * @param $label
     *
     * @return InputBuilder
     */
    public function label($label){
        return $this->desc($label);
    }

    /**
     * Sets the input limit
     *
     * @param $limit    int
     * @return InputBuilder $this
     */
    public function limit($limit){
        $this->limit = $limit;
        return $this;
    }

    public function beforeInput($beforeInput){
        $this->beforeInput = $beforeInput;
        return $this;
    }

    public function placeholder($placeholder){
        $this->placeholder = $placeholder;
        return $this;
    }
    public function classes($classes){
        $this->classes = $classes;
        return $this;
    }
    public function id($id){
        $this->id = $id;
        return $this;
    }
    public function value($value){
        $this->value = $value;
        return $this;
    }
    public function friendlyurlPrefix($prefix){
        $this->prefix = $prefix;
        return $this;
    }

    public function output(){
        $desc = $this->description ?: ucwords($this->property);
        $placeholder = strlen($this->property) ? $this->placeholder : $desc;

        $error = $this->model->getError($this->property);

        // set value
        $value = null;
        if($this->value === null) {
            switch ($this->property) {
                case 'friendlyurl':
                    $value = $this->model->getFriendlyUrl();
                    $this->classes .= ' generate-url ';
                    $dataDeriveFrom = $this->model->friendlyURLDeriveFrom;
                    $dataPrefix = strlen($this->prefix) ? $this->prefix : $this->model->friendlyURLController;
                    break;
                default:
                    if($this->isPartial){
                        $model = $this->model->getPartialModel();
                        $value = $model->{$this->property};
                    } else {
                        $value = $this->value ?: $this->model->{$this->property};
                    }

            }
        } else {
            $value = $this->value;
        }

        // IF PARTIAL
        // fetch limits from config.json
        if($this->isPartial && !$this->limit) $this->limit = $this->model->getLimit($this->property);
        // prepend partial name for input name
        if($this->isPartial) $this->property = $this->model->getPartialName() . "_" . $this->property;
        $id = strlen($this->id) ? $this->id : $this->property;

        // now render
        switch($this->type){
            case "checkbox":
                echo '<li class="lbl-hint col '.$this->classes.' btm-margin">';
                if(strlen($error)) echo '<div class="error">'. $error .'</div>';
                echo '<label class="chbx" for="'. $this->property .'">';
                echo '<input name="'. $this->property .'" id="'. $id .'" type="'. $this->type .'" placeholder="'. $this->placeholder .'" value="1"';
                if($value == 1) echo ' checked="checked" ';
                echo ' />';
                echo $desc .'</label>'. $this->beforeInput;
                echo '</li>';
                break;
            case "image":
                $imageFolder = strlen($this->imageFolder) ? $this->imageFolder :
                    ($this->isPartial ?
                        "/assets/images/partials/" . $this->model->directory . "/cms/":
                        "/assets/images/" . $this->model->imageFolder . '/cms/');
                $rolloverFolder = strlen($this->rolloverFolder) ? $this->rolloverFolder :
                    ($this->isPartial ?
                        "/assets/images/partials/" . $this->model->directory . "/rollover/":
                        "/assets/images/" . $this->model->imageFolder . '/rollover/');
                echo '<li class="lbl-hint col '.$this->classes.' btm-margin">';
                if(strlen($error)) echo '<div class="error">'. $error .'</div>';
                echo '<label for="'. $this->property.'">'. $desc;
                if(strlen($value)) echo '<div class="admin-image-show"><img class="admin-image-rollover" data-rollover="'. $rolloverFolder . $value .'" src="' . $imageFolder . $value . '" /></div>';
                echo '</label>'. $this->beforeInput;
                echo '<input name="'. $this->property.'" id="'. $id .'" type="file" /></li>';
                break;
            case "pdf":
                $pdfFolder = strlen($this->pdfFolder) ? $this->pdfFolder : "/assets/documents/" . $this->model->pdfFolder;
                // add trailing slash
                $pdfFolder = Util::addTrailingSlash($pdfFolder);
                echo '<li class="lbl-hint col '.$this->classes.' btm-margin">';
                if(strlen($error)) echo '<div class="error">'. $error .'</div>';
                echo '<label for="'. $this->property.'">'. $desc;
                if(strlen($value)) echo '<br /><a target="_blank" class="btn" href="'. $pdfFolder . $value . '">View PDF</a>';
                echo '</label>'. $this->beforeInput;
                echo '<input name="'. $this->property.'" id="'. $id .'" type="file" /></li>';
                break;
            case "file":
                echo '<li class="lbl-hint col '.$this->classes.' btm-margin">';
                if(strlen($error)) echo '<div class="error">'. $error .'</div>';
                echo '<label for="'. $this->property.'">'. $desc .'</label>'. $this->beforeInput;
                echo '<input name="'. $this->property.'" id="'. $id .'" type="file" /></li>';
                break;
            case "textarea_raw":
                echo '<li class="lbl-hint col '.$this->classes.' btm-margin">';
                if(strlen($error)) echo '<div class="error">'. $error .'</div>';
                echo '<label for="'. $this->property.'">'. $desc .'</label>
                '. $this->beforeInput .'<textarea ';
                if($this->limit) echo ' class="LimitChar charLimit_'. $this->limit .'" ';
                echo 'name="'. $this->property.'" id="'. $id .'" type="'. $this->type .'" placeholder="'. $placeholder .'">'. htmlentities($value) .'</textarea></li>';
                break;
            case "textarea":
                echo '<li class="lbl-hint col btm-margin ">';
                if(strlen($error)) echo '<div class="error">'. $error .'</div>';
                echo '<label for="'. $this->property.'">'. $desc .'</label>
                '. $this->beforeInput .'<textarea class="tinymce ';
                echo '" name="'. $this->property.'" id="'. $id .'" type="'. $this->type .'" placeholder="'. $placeholder .'">'. htmlentities($value) .'</textarea></li>';
                break;
            case "date":
                echo '<li class="lbl-hint col '.$this->classes.' datepicker btm-margin">';
                if(strlen($error)) echo '<div class="error">'. $error .'</div>';
                echo '<label for="'. $this->property.'">'. $desc .'</label>
                '. $this->beforeInput .'<input name="'. $this->property.'" id="'. $id .'" placeholder="'. $placeholder .'" value="'. $value .'" class="datepicker" /></li>';
                break;
            case "time":
                echo '<li class="lbl-hint col '.$this->classes.' btm-margin">';
                if(strlen($error)) echo '<div class="error">'. $error .'</div>';
                echo '<label for="'. $this->property.'">'. $desc .'</label>
                '. $this->beforeInput .'<input name="'. $this->property.'" id="'. $id .'" placeholder="'. $placeholder .'" value="'. $value .'" class="timepicker" /></li>';
                break;
            case "hidden":
                echo '<input type="hidden" name="' . $this->property . '" value="'. $value . '" />';
                break;
            case "friendlyurl":
                echo '<li class="lbl-hint col '.$this->classes.' btm-margin" data-prefix="'. $dataPrefix .'" data-derive-from="'. $dataDeriveFrom .'">';
                if(strlen($error)) echo '<div class="error">'. $error .'</div>';
                echo '<label for="'. $this->property.'">'. $desc .'</label>
                '. $this->beforeInput .'<input ';
                if($this->limit) echo ' class="LimitChar charLimit_'. $this->limit .'" ';
                echo ' name="'. $this->property.'" id="'. $id .'" type="'. $this->type .'" placeholder="'. $placeholder .'" value="'. htmlentities($value) .'" /></li>';
                break;
            case "select":
            case "dropdown":
                echo '<li class="lbl-hint col '.$this->classes.' btm-margin">';
                if(strlen($error)) echo '<div class="error">'. $error .'</div>';
                echo '<label for="'. $this->property.'">'. $desc .'</label>
                    '. $this->beforeInput;
                echo '<select name="'. $this->property.'" id="'. $id .'">';
                foreach($this->options as $label => $val){
                    echo '<option value="' . $val . '" ';
                    if($value == $val) echo ' selected="selected" ';
                    echo '>' . $label . '</option>';
                }
                echo '</select></li>';
                break;
            default:
                echo '<li class="lbl-hint col '.$this->classes.' btm-margin">';
                if(strlen($error)) echo '<div class="error">'. $error .'</div>';
                echo '<label for="'. $this->property.'">'. $desc .'</label>
                '. $this->beforeInput .'<input ';
                if($this->limit) echo ' class="LimitChar charLimit_'. $this->limit .'" ';
                echo ' name="'. $this->property.'" id="'. $id .'" type="'. $this->type .'" placeholder="'. $placeholder .'" value="'. htmlentities($value) .'" /></li>';
        }

        echo '<!-- end print admin row ' . $this->property. ' -->';
    }
}