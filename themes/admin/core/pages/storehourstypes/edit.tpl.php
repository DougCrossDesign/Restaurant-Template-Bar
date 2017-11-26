<?php
use Model\StoreHourType;

/** @var TemplateContainer $obj */

/** @var StoreHourType $type */
$type = $obj->storehourtype;

$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>

<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm form-col">
    <ul>
        <?php
            $type->input("name")->output();
            printAdminSubmitCancelRow();
        ?>
    </ul>
</form>