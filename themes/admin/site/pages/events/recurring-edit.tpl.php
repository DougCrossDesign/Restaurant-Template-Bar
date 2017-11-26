<?php

/** @var TemplateContainer $obj */
use Model\Event\EventTag;
use Model\Event\EventType;
use Model\FloorPlan;
use Model\Location\Location;

/** @var \Model\Event\Event $event */
$event = $obj->event;
$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>

<p>
    <?php if ($event->parent_id) { ?>
        <strong>Notice: </strong> You are editing a child event. Changes made to the master event will over-ride any of these changes.
    <?php } elseif ($count = $event->recurringevents()->count()) { ?>
        <strong>Notice: </strong> You are editing a master event. Changes made to this event will also effect the <?php echo $count; ?> recurring events.
    <?php } ?>
</p>

<p>
    <a href="/admin/events" class="btn">< Back To Events</a>
</p>

<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm event <?php echo $event->id ? '' : 'new'; ?>">
    <ul>
        <?php
        $event->input("active")->output();

        if ($event->parent_id) {
            $event->input("parent_id")->value($event->parent_id)->type(IB_HIDDEN)->output();
        }

        if ( $event->hasRequiredRelationship("location") ) {
            $event->input("location_id")->options(Location::getDropdownOptions())->onchange("loadLocationFloorplans()")->output();
        } elseif ( $event->hasEnabledRelationship("location") ) {
            $event->input("location_id")->options(Location::getDropdownOptionsWithNone())->onchange("loadLocationFloorplans")->output();
        }

        if ( $event->hasRequiredRelationship("type") ) {
            $event->input("event_type_id")->options(EventType::getDropdownOptions())->output();
        } elseif ( $event->hasEnabledRelationship("type") ) {
            $event->input("event_type_id")->options(EventType::getDropdownOptionsWithNone())->output();
        }


        $event->input("title")->output();
        $event->input("friendlyurl")->output();
        $event->input("text")->output();
        $event->input("summary")->type("textarea_raw")->limit(250)->output();

        if ($event->hasEnabledRelationship("tags")) {
            $event->input("tags")->label("Tags")->type(IB_MULTI_SELECT)->values($event->getTagIds())->options(EventTag::getDropdownOptions())->output();
        }

        $event->input("ticket_link")->output();
        $event->input("ticket_label")->output();
        $event->input("ticket_newwindow")->output();

        if (class_exists("FloorPlan")) {
            $floorplanOptions = FloorPlan::getDropdownOptions();
            if (count($floorplanOptions) && $event->hasRequiredRelationship("floorplan")) {
                $event->input("floor_plan_id")->options($floorplanOptions)->onchange("loadLocationFloorplans()")->output();
            } elseif ($event->hasEnabledRelationship("floorplan")) {
                $event->input("floor_plan_id")->options(FloorPlan::getDropdownOptionsWithNone())->onchange("loadLocationFloorplans()")->output();
                $event->input("floor_plan_image", "Floor Plan Image Upload")->isRequired(true)->output();
            }
        }

        $event->input("image")->output();
        $event->input("image_alt")->output();
        $event->input("video")->output();

        $event->input("start_date")->isRequired(true)->output();
        $event->input("start_time")->output();
        //$event->input("end_date")->output();
        $event->input("end_time")->output();

        if (!$event->parent_id) { ?>

            <li>
                <div class="admin-section">
                    <h2 class="admin-header">Recurring Event</h2>
                    <ul>
                        <li class="admin-section-t2">
                            <label class="radio"><input type="radio" name="recursion_type"
                                                        value="<?php echo EVENT_RECURSION_SINGLE; ?>" <?php if ($event->recursion_type == EVENT_RECURSION_SINGLE || !$event->recursion_type) echo ' checked="checked" '; ?> />
                                One-Time Event Only</label>
                        </li>
                        <li class="admin-section-t2">
                            <label class="radio"><input type="radio" name="recursion_type"
                                                        value="<?php echo EVENT_RECURSION_WEEKLY; ?>" <?php if ($event->recursion_type == EVENT_RECURSION_WEEKLY)  echo ' checked="checked" '; ?> />
                                Weekly</label>
                            <label for="repeat_weekly_num_weeks">Number of weeks to repeat:</label>
                            <select name="repeat_weekly_num_weeks">
                                <?php for ($i = 1; $i <= 52; $i++) { ?>
                                    <option
                                        value="<?php echo $i; ?>" <?php if ($event->recursion_type == EVENT_RECURSION_WEEKLY && $event->recursion_number == $i) echo ' selected="selected" '; ?>><?php echo $i; ?>
                                        Weeks
                                    </option>
                                <?php } ?>
                            </select>
                            <ul>
                                <?php
                                foreach (["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"] as $index => $day) { ?>
                                    <li><label class="chbx" for="repeat_weekly_<?php echo $day; ?>"><input
                                                id="repeat_weekly_<?php echo $day; ?>" value="<?php echo $index; ?>"
                                                type="checkbox"
                                                name="repeat_weekly_days[]" <?php if (($event->recursion_type == EVENT_RECURSION_WEEKLY) && in_array($index, unserialize($event->recursion_other))) echo ' checked="checked" '; ?> /><?php echo $day; ?>
                                        </label></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li class="admin-section-t2">
                            <label class="radio"><input type="radio" name="recursion_type"
                                                        value="<?php echo EVENT_RECURSION_BIWEEKLY; ?>" <?php if ($event->recursion_type == EVENT_RECURSION_BIWEEKLY) echo ' checked="checked" '; ?> />
                                Bi-Weekly</label>
                            <label for="repeat_biweekly_num_weeks">Number of weeks to repeat:</label>
                            <select name="repeat_biweekly_num_weeks">
                                <?php for ($i = 1; $i <= 52; $i++) { ?>
                                    <option
                                        value="<?php echo $i; ?>" <?php if ($event->recursion_type == EVENT_RECURSION_BIWEEKLY && $event->recursion_number == $i) echo ' selected="selected" '; ?>><?php echo $i; ?>
                                        Weeks
                                    </option>
                                <?php } ?>
                            </select>
                        </li>
                        <li class="admin-section-t2">
                            <label class="radio"><input type="radio" name="recursion_type"
                                                        value="<?php echo EVENT_RECURSION_MONTHLY; ?>" <?php if ($event->recursion_type == EVENT_RECURSION_MONTHLY) echo ' checked="checked" '; ?> />
                                Monthly</label>
                            <label for="repeat_monthly_num_months">Number of months to repeat:</label>
                            <select id="repeat_monthly_num_months" name="repeat_monthly_num_months">
                                <?php for ($i = 1; $i <= 12; $i++) { ?>
                                    <option
                                        value="<?php echo $i; ?>" <?php if ($event->recursion_type == EVENT_RECURSION_MONTHLY && $event->recursion_number == $i) echo ' selected="selected" '; ?>><?php echo $i; ?>
                                        Months
                                    </option>
                                <?php } ?>
                            </select>
                            <label for="repeat_monthly_frequency">Frequency:</label>
                            <select id="repeat_monthly_frequency" name="repeat_monthly_frequency">
                                <?php foreach ([
                                                   'Same date (e.g. every 27th)',
                                                   'Same day, same week (e.g. fourth Wednesday)',
                                                   '1st and 3rd week (e.g. 1st and 3rd Wednesday)',
                                                   '2nd and 4th week (e.g. 2nd and 4th Wednesday)'
                                               ] as $index => $type) { ?>
                                    <option
                                        value="<?php echo $index; ?>" <?php if ($event->recursion_type == EVENT_RECURSION_MONTHLY && in_array($index, unserialize($event->recursion_other)))echo ' selected="selected" '; ?>><?php echo $type; ?></option>
                                <?php } ?>
                            </select>
                        </li>
                    </ul>
                </div>
            </li>

            <?php
        }

        if ( $event->hasEnabledRelationship("links") ) {
            $event->inputChildren("links")->order("displayorder")->orderingManageable("events")->output();
        }

        if ( $event->hasEnabledRelationship("videos") ) {
            $event->inputChildren("videos")->order("displayorder")->orderingManageable("events")->output();
        }

        if ( $event->hasEnabledRelationship("pdfs") ) {
            $event->inputChildren("pdfs")->order("displayorder")->orderingManageable("events")->output();
        }

        printAdminSubmitCancelRow();
        ?>
    </ul>
</form>

<script type="text/javascript">
    function loadLocationFloorplans(){
        location_id = $("#location_id option:selected").val();
        $.get( "/admin/cevents/getFloorplanOptions/" + location_id, function (data) {
            datas = $.parseJSON(data);
            $("#floor_plan_id").empty();
            $.each(datas, function (value, index) {
                $("#floor_plan_id").append("<option value='"+index+"'>"+value+"</option>");
            });
        })
    }

    // todo: need to run the function on page load
    loadLocationFloorplans();
</script>