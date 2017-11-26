<?php
use Model\FriendlyUrl;
use Model\Metadata;
use Model\Redirect;
use Model\Siteinfo;

/** @var TemplateContainer $obj */
/** @var FriendlyUrl $friendlyurl */
$friendlyurl = $obj->friendlyurl;
$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>

<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm form-col">
        <?php
        $friendlyurl->input("friendlyurl")->output();
        $friendlyurl->input("route")->output();
        $friendlyurl->input("redirect")->output();

        printAdminSubmitCancelRow();
        ?>
</form>