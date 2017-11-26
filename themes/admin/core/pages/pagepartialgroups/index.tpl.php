<?php
/** @var TemplateContainer $obj */
use Model\Metadata;
use Model\Pages\PagePartialGroup;
use Model\Redirect;

/** @var PagePartialGroup[] $groups */
$groups = $obj->pagepartialgroups;
/** @var string $add_link */
$add_link = $obj->add_link;
?>
<?php echo $obj->pagination; ?>

<p><a href="<?php echo $add_link; ?>" class="btn btm-margin">Add New Partial Group</a></p>

<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th><?php printAdminHeader("Name"); ?></th>
        <th><?php printAdminHeader("Type"); ?></th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($groups) > 0) { ?>
        <?php
        /** @var PagePartialGroup $group */
        foreach ($groups as $group) { ?>
            <tr>
                <td><?php echo $group->name; ?></td>
                <td><?php echo $group->getTypeName(); ?></td>
                <td>
                    <a href="/admin/pagepartialgroups/edit/<?php echo $group->id; ?>" class="button">Edit</a>
                    <a href="/admin/pagepartialgroups/delete/<?php echo $group->id; ?>" class="button">Delete</a>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                No groups present. <a href="<?php echo $add_link; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>


