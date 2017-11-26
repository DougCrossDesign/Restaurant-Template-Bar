<?php
/** @var TemplateContainer $obj */
use Model\Metadata;
use Model\Redirect;
use Model\Siteinfo;
use Model\Siteinfogroup;

/** @var Siteinfogroup[] $siteinfogroups */
$siteinfogroups = $obj->siteinfogroups;
/** @var string $add_link */
$add_link = $obj->add_link;
?>
<?php echo $obj->pagination; ?>

<p><a href="/admin/siteinfo" class="btn floatr">Manage Site Info</a></p>
<p><a href="<?php echo $add_link; ?>" class="btn btm-margin">Add New Info Group</a></p>

<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th><?php printAdminHeader("Name", "key"); ?></th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($siteinfogroups) > 0) { ?>
        <?php
        /** @var Siteinfo $siteinfo */
        foreach ($siteinfogroups as $siteinfogroup) { ?>
            <tr>
                <td><?php echo $siteinfogroup->name; ?></td>
                <td>
                    <a href="/admin/siteinfogroups/edit/<?php echo $siteinfogroup->id; ?>" class="button">Edit</a>
                    <a href="/admin/siteinfogroups/delete/<?php echo $siteinfogroup->id; ?>" class="button">Delete</a>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                No info groups present. <a href="<?php echo $add_link; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>


