<?php
/** @var TemplateContainer $obj */
use Model\Adbanner;
use Model\Banners\Banner;
use Model\Forms\Form;
use Model\Popup;
use Model\StoreHourDay;
use Model\StoreHours;
use Model\StoreHoursType;

/** @var StoreHourDay[] $days */
$days = $obj->storehourdays;

/** @var string $add_link */
$add_link = $obj->add_link;
?>
<?php echo $obj->pagination; ?>

<p>
    <a href="/admin/locations" class="btn btm-margin">< Back To Locations</a>
    <a href="<?php echo $add_link; ?>" class="btn btm-margin">Add Store Hour Day</a>

    <a href="/admin/storehourstypes" class="btn btm-margin floatr">Manage Store Hours Types</a>
    <a href="/admin/storehoursdays" class="btn btm-margin floatr">Manage Store Hours Days</a>
</p>

<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th>Name</th>
        <th>Order</th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($days) > 0) { ?>
        <?php
        /** @var StoreHourDay $day */
        foreach ($days as $day) { ?>
            <tr>
                <td><?php echo $day->name; ?></td>
                <td><?php printAdminOrderColumn($day, count($days), "storehoursdays"); ?></td>
                <td>
                    <a href="/admin/storehoursdays/edit/<?php echo $day->id; ?>" class="button">Edit</a>
                    <a href="/admin/storehoursdays/delete/<?php echo $day->id; ?>" class="button">Delete</a>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                No store hour days present. <a href="<?php echo $add_link; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>


