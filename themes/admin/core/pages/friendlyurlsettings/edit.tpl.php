<?php
use Model\FriendlyUrlSetting;

/** @var TemplateContainer $obj */
/** @var FriendlyUrlSetting $friendlyUrlSetting */
$friendlyUrlSetting = $obj->friendlyurlsetting;
$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>
    <style type="text/css">
        #models option {
            font-family: Courier, "Courier New", monospace;
        }
    </style>

    <form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm form-col">
        <li class="lbl-hint col btm-margin">
            <label>Model</label>
            <select id="models" name="model">
                <?php
                // get all of the core/site installed controllers
                $model_locations = Util::getAdminControllers(false);

                $modelsWithControllers = [];
                $modelsWithoutControllers = [];

                function addPadding($string, $length){
                    $output = '';
                    for($i = strlen($string); $i < $length; $i++){
                        $output .= '&nbsp;';
                    }
                    return $output;
                }

                // Now get the actual model name and file
                foreach($model_locations as $model_name => $model_location) {
                    // only get php files
                    if (strpos($model_location, ".php") !== false ) {
                        $contents = file_get_contents($model_location);
                        $search_string = 'protected $modelName = "';
                        $start = strpos($contents, $search_string);
                        if ($start) {
                            $contents = substr($contents, $start + strlen($search_string));
                            $end = strpos($contents, '";');
                            $contents = substr($contents, 0, $end);
                            $modelName = "Model\\" . $contents;
                            $controller = (new $modelName)->friendlyURLController;
                            $selected = $friendlyUrlSetting->model == $contents || Input::get("controller") == $controller ? ' selected="selected" ' : '';
                            if($controller != 'basemodel' && strlen($controller)) {
                                $modelsWithControllers[$contents] = '<option value="' . $contents . '" '. $selected .' data-controller="'. $controller .'">' . $contents . addPadding($contents, 25) .'(/' . $controller . '/)</option>';
                            } else {
                                $modelsWithoutControllers[$contents] = '<option value="' . $contents . '" '. $selected .' data-controller="">' . $contents . '</option>';
                            }
                        }
                    }
                }
                ksort($modelsWithControllers);
                ksort($modelsWithoutControllers);
                ?>
                <optgroup label="Models with Controllers">
                    <?php echo implode("", $modelsWithControllers); ?>
                </optgroup>
                <optgroup label="Other Models">
                    <?php echo implode("", $modelsWithoutControllers); ?>
                </optgroup>
            </select>
        </li>
        <?php
        $friendlyUrlSetting->input("controller")->output();

        printAdminSubmitCancelRow();
        ?>
    </form>
<?php
if(!isset($GLOBALS['footerjs'])) $GLOBALS['footerjs'] = '';
$GLOBALS['footerjs'] .= '
    $("#controller").val($("#models").find("option:selected").attr("data-controller"));
    $("#models").change(function(){
        $("#controller").val($(this).find("option:selected").attr("data-controller"));
    });
';
?>