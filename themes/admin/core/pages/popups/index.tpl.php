<?php
/** @var TemplateContainer $obj */
use Model\Adbanner;
use Model\Banners\Banner;
use Model\Popup;

/** @var Popup[] $popups */
$popups = $obj->popups;
/** @var string $add_link */
$add_link = $obj->add_link;
?>
<?php echo $obj->pagination; ?>
<p><a href="<?php echo $add_link; ?>" class="btn btm-margin">Add New Popup</a></p>

<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th><?php echo printAdminHeader("Title"); ?></th>
        <th><?php echo printAdminHeader("Start Date", "start"); ?></th>
        <th><?php echo printAdminHeader("End Date", "end"); ?></th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($popups) > 0) { ?>
        <?php
        /** @var Popup $popup */
        foreach ($popups as $popup) { ?>
            <tr>
                <td><?php echo $popup->title; ?></td>
                <td><?php echo $popup->formatDate('start', false); ?></td>
                <td><?php echo $popup->formatDate('end', false); ?></td>
                <td>
                    <a href="/admin/popups/edit/<?php echo $popup->id; ?>" class="button">Edit</a>
                    <a href="/admin/popups/delete/<?php echo $popup->id; ?>" class="button">Delete</a>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                No popups present. <a href="<?php echo $add_link; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>


