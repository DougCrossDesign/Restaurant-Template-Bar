<?php

/** @var TemplateContainer $obj */
use Model\Event\EventTag;
use Model\Event\EventType;
use Model\Location\Location;

/** @var \Model\Event\Event $event */
$event = $obj->event;
$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>

<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm event <?php echo $event->id ? '' : 'new'; ?>">
    <ul>
        <?php
        $event->input("active")->output();

        if ( $event->hasRequiredRelationship("location") ) {
            $event->input("location_id")->options(Location::getDropdownOptions())->onchange("loadLocationFloorplans()")->output();
        } elseif ( $event->hasEnabledRelationship("location") ) {
            $event->input("location_id")->options(Location::getDropdownOptionsWithNone())->onchange("loadLocationFloorplans")->output();
        }

        if ( $event->hasRequiredRelationship("type") ) {
            $event->input("event_type_id")->options(EventType::getDropdownOptions())->onchange("loadLocationFloorplans()")->output();
        } elseif ( $event->hasEnabledRelationship("type") ) {
            $event->input("event_type_id")->options(EventType::getDropdownOptionsWithNone())->onchange("loadLocationFloorplans")->output();
        }


        $event->input("title")->output();
        $event->input("friendlyurl")->output();
        $event->input("text")->output();
        $event->input("summary")->type("textarea_raw")->limit(250)->output();

        if ( $event->hasRequiredRelationship("location") ) {
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

        // recursion type is none by definition
        $event->input("recursion_type")->value(EVENT_RECURSION_NONE)->type(IB_HIDDEN)->output();

        // showtimes are always required
        $event->inputChildren("showtimes")->output();

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