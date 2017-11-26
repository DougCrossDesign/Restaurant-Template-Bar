<?php
/** @var TemplateContainer $obj */
use Model\Event\Event;

$model = $obj->model;

/** @var Event $masterEvent */
$masterEvent = $obj->masterEvent;

/** @var Event[] $redirects */
$events = $obj->events;
/** @var string $add_link */
$add_link = $obj->add_link;
?>

<?php echo $obj->pagination; ?>

<p>
    <a href="/admin/events" class="btn">< All Events</a>
    <a href="/admin/events/archive" class="btn floatr">View Archived Events</a>

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
        <a href="/admin/events/addRecurringEvent" class="btn btm-margin">Add New Recurring Event</a>
    <?php } ?>
</p>


<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th>Master Event Title</th>
        <th>URL</th>
        <th>Dates</th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php

    if (!is_null($masterEvent)) { ?>
        <tr>
            <td><?php echo $masterEvent->title; ?></td>
            <td><a href="<?php echo $masterEvent->getUrl(); ?>" target="_blank"><?php echo $masterEvent->getUrl(); ?></a></td>
            <td>
                <?php echo $masterEvent->getRangeDateTimeFormatted(); ?>
            </td>
            <td>
                <a href="/admin/events/editRecurringEvent/<?php echo $masterEvent->id; ?>" class="button">Edit Master Event</a>

            </td>
        </tr>
    <?php } ?>


    <?php
    if (count($events) > 0) { ?>
        <?php
        /** @var \Model\Event\EventRecurring $event */
        foreach ($events as $event) { ?>
            <tr>
                <td></td>
                <td><a href="<?php echo $event->getUrl(); ?>" target="_blank"><?php echo $event->getUrl(); ?></a></td>
                <td>
                    <?php echo $event->getStartDateTimeFormatted(); ?>
                </td>
                <td>
                    <a href="/admin/events/editChildEvent/<?php echo $event->id; ?>" class="button">Edit</a>
                    <a href="/admin/events/delete/<?php echo $event->id; ?>" class="button">Delete</a>
                    <a href="/admin/events/editRecurringEvent/<?php echo $event->parent_id; ?>" class="button">Edit Master Event</a>

                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                No recurrent events present. <a href="<?php echo $add_link; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>


