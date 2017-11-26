<?php
use Model\Metadata;
use Model\Redirect;
use Model\Siteinfo;
use Model\Siteinfogroup;

/** @var TemplateContainer $obj */

/** @var Siteinfogroup $siteinfogroup */
$siteinfogroup = $obj->siteinfogroup;
$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>

<form action="<?php echo $action_url; ?>" method="POST" class="modifyorm">
    <ul>
        <?php
        $siteinfogroup->input("name")->output();

        printAdminSubmitCancelRow();
        ?>
    </ul>
</form>