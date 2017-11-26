<?php
/** @var TemplateContainer $obj */
use Model\FriendlyUrl;
use Model\FriendlyUrlSetting;
use Model\Jobposition;

/** @var FriendlyUrlSetting[] $friendlyUrlSettings */
$friendlyUrlSettings = $obj->friendlyurlsettings;
/** @var string $add_link */
$add_link = $obj->add_link;
?>
<?php echo $obj->pagination; ?>
<p class="floatr"><a href="/inc/core/crons/cleanurls.php" class="btn btm-margin">Clean Friendly URLs</a></p>
<p><a href="/admin/friendlyurls" class="btn btm-margin">&lt; Back to Friendly URLs</a></p>
<p><a href="<?php echo $add_link; ?>" class="btn btm-margin">Add New Friendly URL Setting</a></p>

<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th><?php printAdminHeader("Controller"); ?></th>
        <th><?php printAdminHeader("Model"); ?></th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($friendlyUrlSettings) > 0) { ?>
        <?php
        /** @var FriendlyUrlSetting $friendlyUrlSetting */
        foreach ($friendlyUrlSettings as $friendlyUrlSetting) { ?>
            <tr>
                <td><?php echo $friendlyUrlSetting->controller; ?></td>
                <td><?php echo $friendlyUrlSetting->model; ?></td>
                <td>
                    <a href="/admin/friendlyurlsettings/edit/<?php echo $friendlyUrlSetting->id; ?>" class="button">Edit</a>
                    <a href="/admin/friendlyurlsettings/delete/<?php echo $friendlyUrlSetting->id; ?>" class="button">Delete</a>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                No Friendly URL Settings present. <a href="<?php echo $add_link; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>


