<?php
use Model\Metadata;
use Model\Redirect;
use Model\Siteinfo;

/** @var TemplateContainer $obj */

/** @var Siteinfo $siteinfo */
$siteinfo = $obj->siteinfo;
$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>

<form action="<?php echo $action_url; ?>" method="POST" class="modifyorm">
    <ul>
        <?php
        $siteinfo->input("key")->output();
        $siteinfo->input("value")->output();
        $siteinfo->input("group_id")->options(\Model\Siteinfogroup::getDropdownOptions())->value($siteinfo->group_id)->output();
        $siteinfo->input("permission")->options(array_flip(\Model\Siteinfo::$CLIENT_PERMISSION_LEVELS))->value($siteinfo->group_id)->output();

        printAdminSubmitCancelRow();
        ?>
    </ul>
</form>