<?php
use Model\Adbanner;
use Model\AdbannerGroup;
use Model\AdbannerSize;
/** @var TemplateContainer $obj */

/** @var Adbanner $banner */
$banner = $obj->adbanner;
$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>

<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm form-col">
    <ul>
        <?php
        printAdminRow("name", $banner->name, $banner->getError('name'), "text", '', '', '', '', "col1-2");
        printAdminRow("url", $banner->url, $banner->getError('url'), "text", "URL", '', '', '', "col1-2");
        printAdminImageInput("image", "/assets/images/adbanners/thumb", $banner, "Image");
        ?>
        <li>
            <label class="chbx"><input type="checkbox" name="newwindow" value="1" <?php if($banner->newwindow) echo ' checked="checked" '; ?> /> Open in New Window </label>
        </li>
        <?php
        printAdminRow("imagealt", $banner->imagealt, $banner->getError('imagealt'), "text", "Image Description");
        printAdminRow("start_date", $banner->start_date ? $banner->formatDate('start_date') : date("Y-m-d", time()), $banner->getError('start_date'), "date");
        printAdminRow("end_date", $banner->end_date ? $banner->formatDate('end_date') : date("Y-m-d", strtotime("+1 month")), $banner->getError('end_date'), "date");
        ?>
        <li class="col">
            <label>Banner Size</label>
            <?php echo $banner->getError('size_id'); ?>
            <select name="size_id">
                <option value="">-- Choose Size --</option>
                <?php foreach(AdbannerSize::get() as $adbannersize){
                    echo '<option value="'. $adbannersize->id .'" ';
                    if($adbannersize->id == $banner->size_id) echo ' selected="selected" ';
                    echo '>' . $adbannersize->name . ': '. $adbannersize->width .' x '. $adbannersize->height .'</option>';
                } ?>
            </select>
        </li>

        <li class="col btm-margin">
            <?php if(!$banner->size_id){ ?>
                <label>Please choose a banner size first, then choose the banner positions this ad will belong to.</label>
            <?php } else { ?>
                <?php echo $banner->getError('group_id');
                $availableGroups = AdbannerGroup::getBySize($banner->size_id);
                if($availableGroups && $availableGroups->count()){
                    ?>
                    <label>Banner Position</label>
                    <select data-placeholder="Choose Banner Position" class="chosen" multiple="multiple" name="group[]">
                        <?php
                        $currentGroups = $banner->groups()->get();
                        $currentGroupIds = [];
                        /** @var AdbannerGroup $group */
                        foreach($currentGroups as $group){
                            $currentGroupIds[] = $group->id;
                        }
                        foreach(AdbannerGroup::getBySize($banner->size_id) as $adbannergroup){
                            echo '<option value="'. $adbannergroup->id .'" ';
                            if(in_array($adbannergroup->id, $currentGroupIds)) echo ' selected="selected" ';
                            echo '>' . $adbannergroup->name . '</option>';
                        } ?>
                    </select>
                <?php } else { ?>
                    <label>This ad size has no available positions. Please add an ad position for this size first.</label>
                <?php } ?>
            <?php } ?>
        </li>
        <?php
        printAdminSubmitCancelRow();
        ?>
    </ul>
</form>