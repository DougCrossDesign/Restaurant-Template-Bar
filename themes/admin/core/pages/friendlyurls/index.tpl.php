<?php
/** @var TemplateContainer $obj */
use Model\FriendlyUrl;
use Model\Jobposition;

/** @var FriendlyUrl[] $friendlyurls */
$friendlyurls = $obj->friendlyurls;
/** @var string $add_link */
$add_link = $obj->add_link;
?>
<a class="btn floatr" href="/admin/friendlyurlsettings">Manage Friendly URL Settings</a>
<?php echo $obj->pagination; ?>

<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th><?php printAdminHeader("Friendly URL", "friendlyurl"); ?></th>
        <th><?php printAdminHeader("Route"); ?></th>
        <th><?php printAdminHeader("Redirect"); ?></th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($friendlyurls) > 0) { ?>
        <?php
        /** @var FriendlyUrl $meetingspace */
        foreach ($friendlyurls as $friendlyurl) { ?>
            <tr>
                <td><a target="_blank" href="<?php echo $friendlyurl->friendlyurl; ?>"><?php echo $friendlyurl->friendlyurl; ?></a></td>
                <td><a href="<?php echo $friendlyurl->route; ?>"><?php echo $friendlyurl->route; ?></a> <a href="/admin/friendlyurls?search=<?php echo urlencode($friendlyurl->route); ?>"><i class="aycicon aycicon-magnify"></i> </a> </td>
                <td><?php if(strlen($friendlyurl->redirect)){ ?><a href="<?php echo $friendlyurl->redirect; ?>" target="_blank"><?php echo $friendlyurl->redirect; ?></a><?php } ?></td>
                <td>
                        <a href="/admin/friendlyurls/edit/<?php echo $friendlyurl->id; ?>" class="button">Edit</a>
                    <a href="/admin/friendlyurls/delete/<?php echo $friendlyurl->id; ?>" class="button">Delete</a>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                No Friendly URLs present. <a href="<?php echo $add_link; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>


