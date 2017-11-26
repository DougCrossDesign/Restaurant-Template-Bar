<?php

use Model\Location\LocationIcon;
use Module\LocationsModule;

/** @var TemplateContainer $obj */
/** @var Location $location */
$location = $obj->location;
$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();

/**
 *
 *
 * @param $storeHours           StoreHours[]
 * @param $storeHourTypeId      int
 * @param $storeHourDayId       int
 */
function getStoreHourValue($storeHours, $storeHourTypeId, $storeHourDayId){
    foreach($storeHours as $storeHour){
        if($storeHour->storehourdayid == $storeHourDayId && $storeHour->storehourtypeid == $storeHourTypeId){
            return $storeHour->content;
        }
    }
}
?>

<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm">
    <ul>
        <?php
        $location->input("name")->output();
        $location->inputGroup(['address_street', 'address_city'])->columns(2)->output();
        $location->inputGroup(['address_state', 'address_state_abbreviation', 'address_zip'])->columns(3)->output();
        $location->inputGroup(['email', 'phone'])->columns(2)->output();

        if(Auth::isSuperAdmin()) {
            $location->inputGroup(['lat', 'long'])->attributes(["readonly" => "readonly"])->columns(2)->output();
        }

        // If module storehours is installed, use store hours instead
        if( !Module::exists("storehours") ){
            $location->input("hours", "Box Office Hours")->type("textarea_raw")->output();
        }

        $location->input("notes", "Notes (for admin use only)")->type("textarea")->output();
        printAdminSubmitCancelRow();
        ?>
    </ul>

</form>