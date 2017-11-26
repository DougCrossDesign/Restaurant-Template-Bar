<?php

/** @var TemplateContainer $obj */

/** @var \Model\Event\Event $event */
$event = $obj->event;

$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>

<a href="/admin/events/editRecurringEvent/<?php echo $event->parent_id; ?>" class="btn">Edit Master Event</a>
<p>
    <strong>Note: </strong> Edits made to this event will be disregarded if changes are made to the master event!
</p>
<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th>Title</th>
        <th>URL</th>
        <th>Dates</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?php echo $event->master->title; ?></td>
        <td><a href="<?php echo $event->getUrl(); ?>" target="_blank"><?php echo $event->getUrl(); ?></a></td>
        <td><?php echo $event->getStartDateTimeFormatted(); ?></td>
    </tr>
    </tbody>
</table>

<hr/>

<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm event <?php echo $event->id ? '' : 'new'; ?>">
    <ul>

        <?php

        $event->input("active")->output();
        $event->input("text")->output();
        $event->input("summary")->output();
        $event->input("ticket_link")->output();
        $event->input("ticket_label")->output();
        $event->input("ticket_newwindow")->output();
        $event->input("image")->output();
        $event->input("image_alt")->output();
        $event->input("video")->output();

        printAdminSubmitCancelRow();
        ?>
    </ul>
</form>
