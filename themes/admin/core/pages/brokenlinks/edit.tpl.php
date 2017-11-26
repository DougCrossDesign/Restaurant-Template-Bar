<?php
use Model\Metadata;
use Model\Redirect;

/** @var TemplateContainer $obj */

/** @var Metadata $metadata */
$metadata = $obj->metadata;
$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>

<form action="<?php echo $action_url; ?>" method="POST" class="modifyorm">
    <ul>
        <?php
        $metadata->input("url")->output();
        $metadata->input("title")->output();
        $metadata->input("keywords")->output();
        $metadata->input("description")->output();
        printAdminSubmitCancelRow();
        ?>
    </ul>

</form>