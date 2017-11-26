<?php
/** @var TemplateContainer $obj */
use Model\Events\Eventtype;
use Model\Siteinfo;

/** @var Eventtype[] $redirects */
$eventtypes = $obj->eventtypes;
/** @var string $add_link */
$add_link = $obj->add_link;
?>
<?php echo $obj->pagination; ?>

<p><a href="/admin/events" class="btn floatr">Manage Events</a></p>
<p><a href="<?php echo $add_link; ?>" class="btn btm-margin">Add New Event Type</a></p>

<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th><?php printAdminHeader("name"); ?></th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($eventtypes) > 0) { ?>
        <?php
        /** @var Siteinfo $siteinfo */
        foreach ($eventtypes as $eventtype) { ?>
            <tr>
                <td><?php echo $eventtype->name; ?></td>
                <td>
                    <a href="/admin/eventtypes/edit/<?php echo $eventtype->id; ?>" class="button">Edit</a>
                    <a href="/admin/eventtypes/delete/<?php echo $eventtype->id; ?>" class="button">Delete</a>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                No information present. <a href="<?php echo $add_link; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>


