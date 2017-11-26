<?php

use Model\Location\Location;
use Model\StoreHoursGroup;

/** @var TemplateContainer $obj */

/** @var StoreHoursGroup $storehoursgroup */
$storehoursgroup = $obj->storehoursgroup;
$contents = $obj->contents;

$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>

<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm form-col">
    <ul>
        <?php
            $storehoursgroup->input("name")->output();
            $locations = Location::getSelectValues("name");
            $storehoursgroup->input("location_id")->options($locations)->output();
            printAdminSubmitCancelRow();
        ?>
    </ul>
</form>