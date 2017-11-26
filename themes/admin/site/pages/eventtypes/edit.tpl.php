<?php
use Model\Events\Eventtype;

/** @var TemplateContainer $obj */

/** @var Eventtype $eventtype */
$eventtype = $obj->eventtype;
$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>

<form action="<?php echo $action_url; ?>" method="POST" class="modifyorm">
    <ul>
        <?php
        $eventtype->input("name")->output();
        $eventtype->input("icon")->output();

        printAdminSubmitCancelRow();
        ?>
    </ul>

</form>