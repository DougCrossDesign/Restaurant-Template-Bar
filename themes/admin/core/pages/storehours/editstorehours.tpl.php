<?php
use Model\Adbanner;
use Model\AdbannerGroup;
use Model\AdbannerSize;
use Model\Forms\Form;
use Model\Popup;
use Model\StoreHourDay;
use Model\StoreHours;
use Model\StoreHourType;

/** @var TemplateContainer $obj */

/** @var StoreHours $storeHours */
$storeHours = $obj->storehours;

if ($storeHours->count()) {
    $storeHour = $storeHours->first();
} else {
    $storeHour = new StoreHours();
}


$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>

<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm form-col">
    <ul>
        <?php
            $storeHour->input("group_id")->type(IB_HIDDEN)->value($obj->groupid)->output();
        ?>
        <li class="btm-margin">
            <label>Day</label>

            <?php if ( $obj->storehourdayid > 0 ) {
                $storeHour->input("storehourdayid")->type(IB_HIDDEN)->value($obj->storehourdayid)->output();
             } ?>

            <select name="storehourdayid" <?php if ( $obj->storehourdayid > 0 ) { echo "disabled"; } ?>>
                <?php
                /** @var StoreHourDay $day */
                foreach(StoreHourDay::get() as $day){
                    $hasHours = $day->hasHours($obj->groupid);

                    echo '<option value="'. $day->id .'" ';
                    if($obj->storehourdayid == $day->id){
                        echo ' selected="selected" ';
                    } else if($hasHours){
                        echo ' disabled="disabled" ';
                    }
                    echo '>' . $day->name . '</option>';
                }
                ?>
            </select>
        </li>
        <?php
        /** @var StoreHourType $type */
        foreach(StoreHourType::get() as $type) {

            if ($storeHours instanceof \Illuminate\Database\Eloquent\Collection) {
                $storeHourWithType = $storeHours->filter(function ($storehour) use ($type) {
                    return $storehour->storehourtypeid == $type->id;
                })->first();
            }
                ?>

            <li class="btm-margin">
                <label><?php echo $type->name; ?></label>
                <input type="hidden" name="storehourtypeid[]" value="<?php echo $type->id; ?>" />
                <textarea name="storehourtypecontent[]"><?php
                    if( $storeHourWithType instanceof  StoreHours ){
                        echo $storeHourWithType->content;
                    }
                    ?></textarea>
            </li>
            <?php
        }
        ?>
        <input type="hidden" name="displayorder" value="<?php  echo $storeHours->displayorder; ?>" />
        <?php
            printAdminSubmitCancelRow();
        ?>
    </ul>
</form>