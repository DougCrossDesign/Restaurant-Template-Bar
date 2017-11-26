<?php
/** @var TemplateContainer $obj */
use Model\StoreHourType;

/** @var StoreHourType[] $type */
$types = $obj->storehourtypes;

/** @var string $add_link */
$add_link = $obj->add_link;
?>
<?php echo $obj->pagination; ?>

<p>
    <a href="/admin/locations" class="btn btm-margin">< Back To Locations</a>
    <a href="<?php echo $add_link; ?>" class="btn btm-margin">Add Store Hours Type</a>

    <a href="/admin/storehourstypes" class="btn btm-margin floatr">Manage Store Hours Types</a>
    <a href="/admin/storehoursdays" class="btn btm-margin floatr">Manage Store Hours Days</a>
</p>

<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th>Name</th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($types) > 0) { ?>
        <?php
        /** @var StoreHourType $type */
        foreach ($types as $type) { ?>
            <tr>
                <td><?php echo $type->name; ?></td>
                <td>
                    <a href="/admin/storehourstypes/edit/<?php echo $type->id; ?>" class="button">Edit</a>
                    <a href="/admin/storehourstypes/delete/<?php echo $type->id; ?>" class="button">Delete</a>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                No store hours types present. <a href="<?php echo $add_link; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>


