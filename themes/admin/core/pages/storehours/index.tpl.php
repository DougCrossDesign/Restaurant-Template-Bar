<?php
/** @var TemplateContainer $obj */

use Model\Location\Location;
use Model\StoreHoursGroup;

/** @var StoreHoursGroup[] $storehoursgroups */
$storehoursgroups = $obj->storehoursgroups;

/** @var string $add_link */
$add_link = $obj->add_link;
?>
<?php echo $obj->pagination; ?>

<p>
    <a href="/admin/locations" class="btn btm-margin">< Back To Locations</a>

    <a href="/admin/storehourstypes" class="btn btm-margin floatr">Manage Store Hours Types</a>
    <a href="/admin/storehoursdays" class="btn btm-margin floatr">Manage Store Hours Days</a>
</p>


<?php if(StoreHoursGroup::count() < Location::count()){ ?>
    <p><a href="<?php echo $add_link; ?>" class="btn btm-margin">Add Store Hour Group</a></p>
<?php } ?>


<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th>Name</th>
        <th>Location</th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($storehoursgroups) > 0) { ?>
        <?php
        /** @var StoreHoursGroup $group */
        foreach ($storehoursgroups as $group) { ?>
            <tr>
                <td><a href="/admin/storehours/viewgroup/<?php echo $group->id; ?>" class="button"><?php echo $group->name; ?></a></td>
                <td><?php echo $group->location->name; ?></td>
                <td>
                    <a href="/admin/storehours/editgroup/<?php echo $group->id; ?>" class="button">Edit This Group</a>
                    <a href="/admin/storehours/viewgroup/<?php echo $group->id; ?>" class="button">Manage Store Hours</a>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                <?php if(StoreHoursGroup::count() < Location::count()){ ?>
                    No store hours present. <a href="<?php echo $add_link; ?>">Click here to add one.</a>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>


