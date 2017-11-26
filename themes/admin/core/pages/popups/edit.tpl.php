<?php
use Model\Adbanner;
use Model\AdbannerGroup;
use Model\AdbannerSize;
use Model\Popup;

/** @var TemplateContainer $obj */

/** @var Popup $popup */
$popup = $obj->popup;
$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>

<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm form-col">
    <ul>
        <?php
            printAdminRow("title", $popup->title, $popup->getError('title'), "text", '', '', '', '', "col1-1");
            printAdminRow("start", $popup->start ? $popup->formatDate('start') : date("Y-m-d", time()), $popup->getError('start'), "date", 'Start Date','','','',"col1-2");
            printAdminRow("end", $popup->end ? $popup->formatDate('end') : date("Y-m-d", strtotime("+1 month")), $popup->getError('end'), "date", 'End Date','','','',"col1-2");
            printAdminImageInput("image", "/assets/images/popups/thumb", $popup, "Image");
            printAdminRow("imagealt", $popup->imagealt, $popup->getError('imagealt'), "text", "Image Description");
            printAdminRow("link", $popup->link, $popup->getError('link'), "text", "URL");
        ?>
            <li>
                <label class="chbx"><input type="checkbox" name="newwindow" value="1" <?php if($popup->newwindow) echo ' checked="checked" '; ?> /> Open in New Window </label>
            </li>
        <?php
            printAdminSubmitCancelRow();
        ?>
    </ul>
</form>