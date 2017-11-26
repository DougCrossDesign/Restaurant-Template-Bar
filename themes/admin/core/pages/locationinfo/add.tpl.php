<?php

use Model\Siteinfo;

/** @var TemplateContainer $obj */

/** @var \Model\Location\Location $location */
$location = $obj->location;
/** @var \Model\Location\LocationInfo $locationinfo */
$locationinfo = $obj->locationinfo;
$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>

<form action="<?php echo $action_url; ?>" method="POST" class="modifyorm">
    <ul>
        <?php
        $locationinfo->input("location_id")->options(\Model\Location\Location::getDropdownOptions())->value($location->id)->output();
        $locationinfo->input("admin_key")->dataPrefix("location-info-" . Util::getSlug($location->name))->output();
        $locationinfo->input("key")->output();
        $locationinfo->input("value")->output();
        $locationinfo->input("permission")->options(array_flip(\Model\Siteinfo::$CLIENT_PERMISSION_LEVELS))->output();

        printAdminSubmitCancelRow();
        ?>
    </ul>
</form>