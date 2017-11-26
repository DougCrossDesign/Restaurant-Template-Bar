<?php
/** @var TemplateContainer $obj */
use Model\Event\Event;

/** @var BaseModel $model */
$model = $obj->model;

/** @var Event[] $redirects */
$events = $obj->events;
/** @var string $add_link */
$add_link = $obj->add_link;
?>

<?php echo $obj->pagination; ?>

<p>
    <?php if ($obj->archive) { ?>
        <a href="/admin/events" class="btn floatr">View Events</a>
    <?php } else { ?>
        <a href="/admin/events/archive" class="btn floatr">View Archived Events</a>
    <?php } ?>

    <?php if ( $model->hasEnabledRelationship("type") ) { ?>
        <a href="/admin/eventtypes" class="btn floatr">Manage Event Types</a>
    <?php } ?>

    <?php if ( $model->hasEnabledRelationship("tag") ) { ?>
        <a href="/admin/eventtags" class="btn floatr">Manage Event Tags</a>
    <?php } ?>

    <?php if ( $model->hasEnabledRelationship("showtimes") ) { ?>
        <a href="/admin/events/add" class="btn btm-margin">Add New Event</a>
    <?php } ?>

    <?php if ( $model->hasEnabledRelationship("recurringevents") ) { ?>
        <a href="/admin/events/addRecurringEvent" class="btn btm-margin">Add New Event</a>
    <?php } ?>
</p>


<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th><?php echo printAdminHeader("Title"); ?></th>
        <th>URL</th>
        <th>Date</th>
        <th>Showtimes / Recurring</th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($events) > 0) { ?>
        <?php
        /** @var Event $event */
        foreach ($events as $event) { ?>
            <tr>
                <td><?php echo $event->title; ?></td>
                <td>
                    <a href="<?php echo $event->getUrl(); ?>" target="_blank"><?php echo $event->getUrl(); ?></a>
                </td>
                <td>
                    <?php echo $event->getRangeDateTimeFormatted(); ?>
                </td>
                <td>
                    <?php if ($event->showtimes()->count()) { ?>
                        <?php echo $event->showtimes()->count() ?> Showtime(s)
                    <?php } elseif ($event->recurringevents()->count()) { ?>
                        <a href="/admin/events/viewChildEvents/<?php echo $event->id; ?>" class="button">Manage Recurring Events (<?php echo $event->recurringevents()->count(); ?>)</a>
                    <?php } else { ?>
                        One-Time Event
                    <?php } ?>
                </td>
                <td>
                    <?php if ($event->showtimes()->count()) { ?>
                        <a href="/admin/events/edit/<?php echo $event->id; ?>" class="button">Edit</a>
                    <?php } else { ?>
                        <a href="/admin/events/editRecurringEvent/<?php echo $event->id; ?>" class="button">Edit</a>
                    <?php } ?>
                    <a href="/admin/events/delete/<?php echo $event->id; ?>" class="button">Delete</a>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                No events present. <a href="/admin/events/addRecurringEvent">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>


