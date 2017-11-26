<?php

/** @var TemplateContainer $obj */

/** @var Gallery $gallery */
$gallery = $obj->gallery;
$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>

<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm form-col">
    <ul>
        <?php

        if(\Module\GalleryModule::requiresModule("location")) {
            $gallery->input("location_id")->options(\Model\Location\Location::getDropdownOptions())->output();
        } elseif (\Module\GalleryModule::usesModule("location")) {
            $gallery->input("location_id")->options(\Model\Location\Location::getDropdownOptionsWithGeneralLocation())->output();
        }
        $gallery->input("admin_key")->label("Admin Key (Note: Must be unique. Will be prepended with 'form-')")->value($gallery->admin_key)->disabled()->output();
        $gallery->input("name")->output();
        printAdminSubmitCancelRow();
        ?>
    </ul>
</form>