<?php



/* ================================
 *      ADMIN / ADMIN FORMATTING HELPERS
 ================================== */
/**
 * Prints out a header link when viewing all of one type
 * (e.g. on a module > index.tpl file)
 * Handles creating sort links
 *
 * @param $name        string   The name / description of the column; this is displayed
 * @param null $index           The column name on the model that it should sort by; defaults to lowercase version of the $name
 */
function printAdminHeader($name, $index = null){
    if(!$index) $index = strtolower($name);

    // check if we have page
    $linkParts = [];
    if(Input::get("page")) $linkParts[] = "page=" . Input::get("page");
    $newDirection = Input::get("direction") == "desc" ? "asc" : "desc";
    $linkParts[] = "sort=" . $index;
    $linkParts[] = "direction=" . $newDirection;
    echo '<a href="?'. implode("&", $linkParts) .'">'. $name .'</a>';
}

/**
 * @param $obj
 * @param $only         string[]        News items to only show
 * @param $exclude      string[]        News items to exclude
 */
function printDashboardNews($obj, $only = [], $exclude = []){

    if(isset($obj->news)){
        $html = '';
        foreach($obj->news->news as $section => $data){
            if(count($only)){
                if(in_array($section, $only)) $html .= printDashboardNewsSingle($data);
            } else if(count($exclude)){
                if(!in_array($section, $exclude)) $html .= printDashboardNewsSingle($data);
            } else {
                $html .= printDashboardNewsSingle($data);
            }
        }
        echo $html;
    }
}

/**
 * Prints a single data item for the admin dashboard
 *
 * @param $data
 *
 * @return string
 */
function printDashboardNewsSingle($data){
    if(isset($data->title) && isset($data->text)) {
        $title = $data->title;
        $text = $data->text;

        return '<div class="dashboard-news"><h1>' . $title . '</h1><div>' . $text . '</div></div>';
    } else {
        return '';
    }
}

/**
 * Simply displays an <img> image using dir and image; nothing else.
 *
 * @param $dir
 * @param $image
 *
 * @deprecated  Please use the BaseModel::InputBuilder class to build inputs
 */
function printAdminImage($dir, $image){
    if(strlen($image)){
        echo '<img src="' . $dir . '/' . $image . '" />';
    }
}

/**
 * Displays an object and shows the file input area for a model's image property.
 * Use instead of pritnAdminRow for images.
 * Will also set "delete_$name" so the model can automatically check if this image should be deleted.
 *
 * @param $name         string          The model property name
 * @param $imagePath    string          The path to the image
 * @param $obj          BaseModel       The model
 * @param $required     bool            Whether this image is required or not
 * @param $desc         string          The description of the field
 *
 * @throws Exception
 */
function printAdminMetaImageInput($formName, $obj, $propertyName, $i = -1, $imageDirectory = null, $partialId = 0, $required = null, $desc = "Image", $rolloverFolder = "rollover"){

    $required = $required === null ? $obj->metarequired[$propertyName] : $required;

    if($obj->metaenabled[$propertyName]) {

        echo '<li class="col">';

        // append trailing slash to path
        if (substr($imageDirectory, strlen($imageDirectory) - 1, 1) != "/") {
            $imageDirectory .= '/';
        }

        if ($partialId) {
            // infer delete var
            $rawFormName = str_replace("[]", "", $formName);
            $deleteVar = $rawFormName . '_delete_' . $partialId;
        }

        // make a rollover version
        $parts = explode('/', $imageDirectory);
        $parts[count($parts) - 2] = $rolloverFolder;
        $rolloverPath = implode('/', $parts);

        echo '<label for="' . $formName . '">' . $desc . '</label><br />';

        // show image if exists
        if (isset($obj->meta[$i]->$propertyName) && strlen($obj->meta[$i]->$propertyName)) {
            echo '<div class="admin-image-show"><img class="admin-image-rollover" data-rollover="' . $rolloverPath . $obj->meta[$i]->$propertyName . '" src="' . $imageDirectory . $obj->meta[$i]->$propertyName . '" /></div>';
        }

        // show file input
        //if(strlen($obj->getError($name))) echo '<div class="error">'. $obj->getError($name) .'</div>';
        echo '<input name="' . $formName . '" id="' . $propertyName . $i . '" type="file" />';


        // show delete checkbox
        if ($partialId && !$required && strlen($obj->meta[$i]->$propertyName)) {
            echo '<label class="chbx"><input type="checkbox" name="' . $deleteVar . '" value="1" /> Delete Image</label>';
        }

        echo '</li>';
    }
}


/**
 * Displays an object and shows the file input area for a model's image property.
 * Use instead of printAdminRow for images.
 * Will also set "delete_$name" so the model can automatically check if this image should be deleted.
 *
 * @param $name         string          The model property name
 * @param $imagePath    string          The path to the image
 * @param $obj          BaseModel       The model
 * @param $required     bool            Whether this image is required or not
 * @param $desc         string          The description of the field
 *
 * @throws Exception
 * @deprecated  Please use the BaseModel::InputBuilder class to build inputs
 */
function printAdminImageInput($name, $imagePath, $obj, $desc = '', $rolloverFolder = "rollover", $propertyName = ''){
    // infer required or not
    if($propertyName == ''){
        $propertyNameParts = explode("_", $name);
        $required = $obj->required[end($propertyNameParts)];
    } else {
        $required = $obj->required[$propertyName];
    }
    $desc = $desc == '' ? ucfirst($name) : $desc;

    echo '<li class="col">';

    // append trailing slash to path
    $lastCharacter = substr($imagePath, strlen($imagePath) - 1, 1);
    if ($lastCharacter != "/") {
        $imagePath .= '/';
    }

    // make a rollover version
    $parts = explode('/', $imagePath);
    $parts[count($parts) - 2] = $rolloverFolder;
    $rolloverPath = implode('/', $parts);

    echo '<label for="'. $name .'">'. $desc .'</label><br />';

    // show image if exists
    $valueName = $propertyName ?: $name;
    if (isset($obj->$valueName) && strlen($obj->$valueName)) {
        echo '<div class="admin-image-show"><img class="admin-image-rollover" data-rollover="'. $rolloverPath . $obj->$valueName .'" src="' . $imagePath . $obj->$valueName . '" /></div>';
    }

    // show delete checkbox
    if (!$required && strlen($obj->$name)){
        echo '<label class="chbx"><input type="checkbox" name="delete_'. $name .'" value="1" /> Delete Image</label>';
    }

    // show file input
    if(strlen($obj->getError($name))) echo '<div class="error">'. $obj->getError($name) .'</div>';
    echo '<input name="'. $name .'" id="'. $name .'" type="file" />';

    echo '</li>';
}

/**
 * @param $name
 * @param $propName
 * @param $imagePath
 * @param $obj
 * @param $required
 * @param $desc
 * @deprecated  Please use the BaseModel::InputBuilder class to build inputs
 */
function printAdminPartialImageInput($name, $propName, $imagePath, $obj, $required, $desc){
    echo '<li>';

    // append trailing slash to path
    $lastCharacter = substr($imagePath, strlen($imagePath) - 1, 1);
    if ($lastCharacter != "/") {
        $imagePath .= '/';
    }

    echo '<label for="'. $name .'">'. $desc .'</label><br />';

    // show image if exists
    if (isset($obj->$propName) && strlen($obj->$propName)) {
        echo '<img src="' . $imagePath . $obj->$propName . '" />';
    }

    // show delete checkbox
    if (!$required && strlen($obj->$propName)){
        echo '<label class="chbx"><input type="checkbox" name="delete_'. $name .'" value="1" /> Delete Image</label>';
    }

    // show file input
    if(strlen($obj->errors[$propName])) echo '<div class="error">'. $obj->errors[$propName] .'</div>';
    echo '<input name="'. $name .'" id="'. $name .'" type="file" />';
    echo '</li>';
}

/**
 * Prints an input row for a partial using values from the partial's config.json settings file
 *
 * @param $formInputName    string      The full name that should be returned as the form input's name
 *                                      e.g. "htmltextarea_title"
 * @param $obj              stdClass    The template object holding data for this partial
 * @param $objPropertyName  string      The property, i.e. the 'column' name from the config.json
 *                                      e.g. "title", "text", "desc"
 * @param $i                int         The current iterator value. Use -1 for "empty" or "new item" items and it will use no value.
 */
function printAdminMetaInput($formInputName, $obj, $objPropertyName, $i = -1, $description = "", $placeholder = "", $beforeInput = "", $classes = ""){
    if($i >= 0) {
        $metaObj = $obj->meta[$i];
    }
    $hasId = isset($metaObj) && isset($metaObj->id) && $metaObj->id >= 1;

    $description = strlen($description) ? $description : ucwords($objPropertyName);
    $placeholder = strlen($placeholder) ? $placeholder : ucwords($objPropertyName);
    if($obj->metaenabled[$objPropertyName]) {
        $rawFormInput = str_replace("[]", "", $formInputName);

        // get error if exists
        if (isset($obj->errors[$rawFormInput]) && array_key_exists(0, $obj->errors[$rawFormInput])) {
            $errors = $obj->errors;
            // pop from front of all errors
            $error = array_shift($errors[$rawFormInput]);
            $obj->errors = $errors;
            if(strlen($error)) echo '<div class="error">' . $error . '</div>';
        }

        if ($i >= 0) {
            // print normal
            printAdminRow($formInputName, $obj->meta[$i]->{$objPropertyName}, "", $obj->metatypes[$objPropertyName],
                $description, $beforeInput, $placeholder, $obj->metalimits[$objPropertyName], $classes,
                $objPropertyName . $i);
        } else {
            // print empty row
            printAdminRow($formInputName, "", "", $obj->metatypes[$objPropertyName], $description, $beforeInput,
                $placeholder, $obj->metalimits[$objPropertyName], $classes, $objPropertyName . $i);
        }
    }
}


/**
 * Generates a dropdown for use in partial admin templates.
 * Takes an array in form of [value => label]
 *
 * @param $formInputName        string      The name of the <select> to send back with the form
 * @param $obj                  stdClass    The $obj holding data being sent to the template
 * @param $objPropertyName      string      The property, i.e. the 'column' name from the config.json
 *                                          e.g. "title", "text"
 * @param $options              array       An array in the form of [value => label] to use for the dropdown options
 * @param $i                    int         The current iterator in the array of meta items
 * @param $description          string      The description of the dropdown
 * @param $classes              string      Optional custom css classes
 */
function printAdminMetaInputSelect($formInputName, $obj, $objPropertyName, $options, $i = -1, $description = "", $classes = "")
{
    $description = strlen($description) ? $description : ucwords($objPropertyName);
    if($obj->metaenabled[$objPropertyName]) {
        echo '<li class="lbl-hint col ' . $classes . ' btm-margin">';
        echo '<label for="' . $formInputName . '">' . $description . '</label>';
        echo '<select name="' . $formInputName . '" id="' . $formInputName . '">';
        foreach ($options as $value => $label) {
            echo '<option ';
            if ($i >= 0 && $value == $obj->meta[$i]->{$objPropertyName}) {
                echo ' selected="selected" ';
            }
            echo ' value="' . $value . '">' . $label . '</option>';
        }
        echo '</select>';
        echo '</li>';
    }
}

/**
 * Generates a dropdown for use in partial admin templates.
 * Takes an array in form of [value => label]
 *
 * @param $formInputName        string      The name of the <select> to send back with the form
 * @param $obj                  stdClass    The $obj holding data being sent to the template
 * @param $objPropertyName      string      The property, i.e. the 'column' name from the config.json
 *                                          e.g. "title", "text"
 * @param $options              array       An array in the form of [value => label] to use for the dropdown options
 * @param $description          string      The description of the dropdown
 * @param $classes              string      Optional custom css classes
 * @deprecated  Please use the BaseModel::InputBuilder class to build inputs
 */
function printAdminInputSelect($formInputName, $obj, $objPropertyName, $options, $description = "", $classes = ""){
    $description = strlen($description) ? $description : ucwords($objPropertyName);
    if($obj->enabled[$objPropertyName]) {
        echo '<li class="lbl-hint col ' . $classes . ' btm-margin">';
        if (strlen($obj->errors[$objPropertyName])) {
            echo '<div class="error">' . $obj->errors[$objPropertyName] . '</div>';
        }
        echo '<label for="' . $formInputName . '">' . $description . '</label>';
        echo '<select name="' . $formInputName . '" id="' . $formInputName . '">';
        foreach ($options as $value => $label) {
            echo '<option ' . ($value == $obj->{$objPropertyName} ? 'selected="selected"' : '') . ' value="' . $value . '">' . $label . '</option>';
        }
        echo '</select>';
        echo '</li>';
    }
}

/**
 * Prints an input row for a partial using values from the partial's config.json settings file
 *
 * @param $formInputName    string      The full name that should be returned as the form input's name
 *                                      e.g. "htmltextarea_title"
 * @param $obj              stdClass    The template object holding data for this partial
 * @param $objPropertyName  string      The property, i.e. the 'column' name from the config.json
 *                                      e.g. "title", "text", "desc"
 * @deprecated  Please use the BaseModel::InputBuilder class to build inputs
 */
function printAdminInput($formInputName, $obj, $objPropertyName = '', $description = "", $placeholder = "", $beforeInput = "", $classes = ""){
    if($obj->enabled[$objPropertyName]) {
        $description = strlen($description) ? $description : ucwords($objPropertyName);
        $placeholder = strlen($placeholder) ? $placeholder : ucwords($objPropertyName);
        if ($obj->enabled[$objPropertyName]) {
            printAdminRow($formInputName, $obj->{$objPropertyName}, $obj->errors[$objPropertyName],
                $obj->types[$objPropertyName], $description, $beforeInput, $placeholder, $obj->limits[$objPropertyName],
                $classes);
        }
    }
}


/**
 * Prints an input row when modifying or adding module objects
 * Handles different input types
 *
 * @param $name                     string      name of the model column where data should be stored
 * @param $value                    string      The default value of the input
 * @param $error                    string      An error after validation if exists
 * @param $type                     string      The type of input e.g. "text", "checkbox"
 * @param $desc                string|null      The description of the field; used in the label; defaults to a formatted version of $name
 * @param $beforeInput              string      An optional string that should be displayed immediately before the input
 * @param $placeholder              string      The placeholder for the input; defaults to the description
 * @param $limit                    int
 * @param $classes                  string      Classes to pass to LI holder
 *
 * @deprecated  Please use the BaseModel::InputBuilder class to build inputs
 */
function printAdminRow($name, $value, $error, $type = "text", $desc = null, $beforeInput = "", $placeholder = "", $limit = 0, $classes = "", $id = ""){
    $desc = $desc ?: ucwords($name);
    $placeholder = strlen($placeholder) ? $placeholder : $desc;
    $id = strlen($id) ? $id : $name;

    switch($type){
        case "checkbox":
            echo '<li class="lbl-hint col '.$classes.' btm-margin">';
            if(strlen($error)) echo '<div class="error">'. $error .'</div>';
            echo '<label class="chbx" for="'. $name .'">';
            echo '<input name="'. $name .'" id="'. $id .'" type="'. $type .'" placeholder="'. $placeholder .'" value="1"';
            if($value == 1) echo ' checked="checked" ';
            echo ' />';
            echo $desc .'</label>'. $beforeInput;
            echo '</li>';
            break;
        case "image":
        case "pdf":
            $path = $placeholder . $value;
            echo '<li class="lbl-hint col '.$classes.' btm-margin">';
            if(strlen($error)) echo '<div class="error">'. $error .'</div>';
            echo '<label for="'. $name .'">'. $desc;
            if(strlen($value)){
                echo '<br /><a target="_blank" class="btn btm-margin" href="' . $path . '">View PDF</a>';
                echo '<div class="chbx"><input type="checkbox" name="delete_' . $name . '" /> Delete PDF</div>';
            }
            echo '</label>';
            echo $beforeInput;
            echo '<input name="'. $name .'" id="'. $id .'" type="file" /></li>';
            break;
        case "file":
            echo '<li class="lbl-hint col '.$classes.' btm-margin">';
            if(strlen($error)) echo '<div class="error">'. $error .'</div>';
            echo '<label for="'. $name .'">'. $desc .'</label>'. $beforeInput;
            echo '<input name="'. $name .'" id="'. $id .'" type="file" /></li>';
            break;
        case "textarea_raw":
            echo '<li class="lbl-hint col '.$classes.' btm-margin">';
            if(strlen($error)) echo '<div class="error">'. $error .'</div>';
            echo '<label for="'. $name .'">'. $desc .'</label>
                '. $beforeInput .'<textarea ';
            if($limit) echo ' class="LimitChar charLimit_'. $limit .'" ';
            echo 'name="'. $name .'" id="'. $id .'" type="'. $type .'" placeholder="'. $placeholder .'">'. htmlentities($value) .'</textarea>
            </li>';
            break;
        case "textarea":
            echo '<li class="lbl-hint col btm-margin ">';
            if(strlen($error)) echo '<div class="error">'. $error .'</div>';
            echo '<label for="'. $name .'">'. $desc .'</label>
                '. $beforeInput .'<textarea class="tinymce ';
            echo '" name="'. $name .'" id="'. $id .'" type="'. $type .'" placeholder="'. $placeholder .'">'. htmlentities($value) .'</textarea>
            </li>';
            break;
        case "date":
            echo '<li class="lbl-hint col '.$classes.' btm-margin">';
            if(strlen($error)) echo '<div class="error">'. $error .'</div>';
            echo '<label for="'. $name .'">'. $desc .'</label>
                '. $beforeInput .'<input name="'. $name .'" id="'. $id .'" placeholder="'. $placeholder .'" value="'. $value .'" class="datepicker" />
            </li>';
            break;
        case "time":
            echo '<li class="lbl-hint col '.$classes.' btm-margin">';
            if(strlen($error)) echo '<div class="error">'. $error .'</div>';
            echo '<label for="'. $name .'">'. $desc .'</label>
                '. $beforeInput .'<input name="'. $name .'" id="'. $id .'" placeholder="'. $placeholder .'" value="'. $value .'" class="timepicker" />
            </li>';
            break;
        default:
            echo '<li class="lbl-hint col '.$classes.' btm-margin">';
            if(strlen($error)) echo '<div class="error">'. $error .'</div>';
            echo '<label for="'. $name .'">'. $desc .'</label>
                '. $beforeInput .'<input ';
            if($limit) echo ' class="LimitChar charLimit_'. $limit .'" ';
            echo ' name="'. $name .'" id="'. $id .'" type="'. $type .'" placeholder="'. $placeholder .'" value="'. htmlentities($value) .'" />
            </li>';
    }

    echo '<!-- end print admin row ' . $name . ' -->';
}

function printAdminSubmitCancelRow($submitLabel = "Submit", $cancelLabel = "Cancel"){
    echo '<div class="col btm-margin">
            <input type="submit" name="save" value="'. $submitLabel .'" class="btn" />
            <input type="submit" name="cancel" value="'. $cancelLabel .'" class="btn2" />
          </div>';
}

/* ================================
 *      INPUT / OUTPUT / FORMATTING HELPERS
 ================================== */
/**
 * Convert special characters to HTML safe entities.
 *
 * @param string $string to encode
 * @return string
 */
function escape($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'utf-8');
}

/**
 * Alias for Input::get($key)
 *
 * @param $key
 *
 * @return mixed
 * @deprecated  This is just here for backward compatability; avoid usage. This will probably be removed soon.
 */
function getvar($key){
    return Input::get($key);
}
/**
 * Alias for Input::post($key)
 *
 * @param $key
 *
 * @return mixed
 * @deprecated  This is just here for backward compatability; avoid usage. This will probably be removed soon.
 */
function postvar($key){
    return Input::post($key);
}


/* ================================
 *      CONFIG
 ================================== */
/**
 * Return our site-wide configuration object.
 *
 * @return Config
 */
function config() {
    static $config = null;
    if ($config === null)
        $config = new Config();
    return $config;
}



/* ================================
 *      REPORTING
 ================================== */
/**
 * Renders an array of errors into a formatted block of HTML and returns it.
 *
 * @param $array
 *
 * @return string
 */
function errmsg($array){
    if(count($array)){
        $output = '<a style="display: block;"></a><div class="errmsg"><div><h3>Please confirm the following and try submitting again.</h3><ul>';
        foreach($array as $partialname => $section){
            $error = $section[0];
            if(strlen($error)) $output .= '<li>' . $partialname . ': ' . $error . '</li>';
        }
        $output .= '</ul></div></div>';
        return $output;
    } else {
        return '';
    }
}
/**
 * Write to the application log file using error_log
 *
 * @param string $message to save
 * @param int $level error priority level (0-4)
 * @return bool
 */
function log_error($message, $level) {
    $path = CMS_SYSTEM_DIR . '/storage/errors/' . date('Y-m-d') . '.log';

    $config = config();
    $level_min = $config->error_level_min;
    $level_max = $config->error_level_max;

    if ($level >= $level_min && $level <= $level_max) {
        // Append date and IP to log message
        return error_log(date('H:i:s ') . getenv('REMOTE_ADDR') . "Error level {$level}: {$message}\n", 3, $path);
    }
}
/**
 * Echo given variable(s) surrounded by "pre" tags. You can pass any number
 * of variables (of any type) to this function.
 *
 * @param mixed
 */
function dump() {
    foreach (func_get_args() as $value) {
        print var_info($value);
    }
}
/**
 * Return an HTML safe dump of the given variable surrounded by "pre" tags.
 *
 * @param mixed
 * @return string
 */
function var_info($var) {
    return '<pre>' . escape($var === null ? 'NULL' : (is_scalar($var) ? var_export($var, true) : print_r($var, true))) . "</pre>\n";
}


/* ================================
 *      MISC Utility Functions
 ================================== */
function timerStart(){
    global $MICRO_TIMER;
    global $MICRO_TIMER_INTERVALS;
    $MICRO_TIMER = microtime(true);
    $MICRO_TIMER_INTERVALS = [];
}
function timerRecordInterval($desc = ''){
    global $MICRO_TIMER;
    global $MICRO_TIMER_INTERVALS;
    if(!$MICRO_TIMER) $MICRO_TIMER = microtime(true);
    $MICRO_TIMER_INTERVALS[] = strval(microtime(true)) . ': ' . $desc;
}
function timerEnd(){
    global $MICRO_TIMER;
    global $MICRO_TIMER_INTERVALS;
    $MICRO_TIMER_INTERVALS[] = strval(microtime(true)) . ': Timer Finish';
    $MICRO_TIMER_INTERVALS[] = "Total: " . (microtime(true) - $MICRO_TIMER);
}
function timerPrint(){
    global $MICRO_TIMER;
    global $MICRO_TIMER_INTERVALS;

    echo '<!-- ';
    dump($MICRO_TIMER_INTERVALS);
    echo '-->';
}