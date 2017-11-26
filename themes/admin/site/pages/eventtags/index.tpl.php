<?php
/** @var TemplateContainer $obj */
use Model\Events\Eventtag;
use Model\Event;
use Model\Metadata;
use Model\Redirect;
use Model\Siteinfo;

/** @var Redirect[] $redirects */
$eventtags = $obj->eventtags;
/** @var string $add_link */
$add_link = $obj->add_link;
?>
<?php /* <a class="btn floatr" href="/admin/eventtypes">Manage Event Types</a>
<a class="btn floatr" href="/admin/events/import">Import Events</a> */ ?>
<?php echo $obj->pagination; ?>
<?php if($obj->archive){ ?>
    <a href="/admin/events" class="btn">View Events</a>
<?php } else { ?>
    <p>
        <a href="/admin/events" class="btn floatr">Manage Events</a>
        <a href="<?php echo $add_link; ?>" class="btn btm-margin">Add New Tag</a>
    </p>
<?php } ?>


<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th><?php echo printAdminHeader("Name"); ?></th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($eventtags) > 0) { ?>
        <?php
        /** @var Eventtag $eventtag */
        foreach ($eventtags as $eventtag) { ?>
            <tr>
                <td><?php echo $eventtag->name; ?></td>
                <td>
                    <a href="/admin/eventtags/edit/<?php echo $eventtag->id; ?>" class="button">Edit</a>
                    <a href="/admin/eventtags/delete/<?php echo $eventtag->id; ?>" class="button">Delete</a>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                No events present. <a href="<?php echo $add_link; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>


