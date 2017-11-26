<?php
/** @var TemplateContainer $obj */
use Model\Adbanner;
use Model\Banners\Banner;
use Model\Forms\Form;
use Model\Popup;
use Model\StoreHourDay;
use Model\StoreHours;

/** @var StoreHours[] $storehours */
$storehours = $obj->storehours;

/** @var string $add_link */
$add_link = $obj->add_link;
?>

<p>
    <a href="/admin/locations" class="btn btm-margin">< Back To Locations</a>
    <a href="<?php echo $add_link; ?>" class="btn btm-margin">+ Add Store Hours</a>

    <a href="/admin/storehourstypes" class="btn btm-margin floatr">Manage Store Hours Types</a>
    <a href="/admin/storehoursdays" class="btn btm-margin floatr">Manage Store Hours Days</a>
</p>

<?php
/** @var StoreHourDay $day */
foreach (StoreHourDay::get() as $day) { ?>
    <hr/>
    <h2><?php echo $day->name; ?></h2>
    <hr/>
    <table cellspacing="0" cellpadding="0" class="datagrid">
        <thead>
        <tr>
            <th>Type</th>
            <th>Day</th>
            <th>Description</th>
            <th>Order</th>
            <th>Controls</th>
        </tr>
        </thead>
        <tbody>
        <?php

        $storeHoursWithThisDay = $storehours->filter(function($storehour) use ($day) {
            if ($storehour->storehourdayid == $day->id) {
                return true;
            } else {
                return false;
            }
        })->all();

        if (count($storeHoursWithThisDay) > 0) { ?>
            <?php
            /** @var StoreHours $storehour */
            foreach ($storeHoursWithThisDay as $storehour) { ?>
                <tr>
                    <td><?php echo $storehour->getType(); ?></td>
                    <td><?php echo $storehour->getDay(); ?></td>
                    <td><?php echo $storehour->content; ?></td>
                    <td>
                        <form action="/admin/storehours/order/<?php echo $storehour->id; ?>">
                            <select style="padding: 0 0px; width: 50px; height: 20px;" onchange="javascript: this.form.submit();" name="order">
                                <?php for($i = 1; $i <= count($storeHoursWithThisDay); $i++){
                                    echo '<option '. ($storehour->displayorder == $i ? ' selected="selected" ' : '') .' value="'. $i .'">'. $i .'</option>';
                                } ?>
                            </select>
                        </form>
                    </td>
                    <td>
                        <a href="/admin/storehours/edit/<?php echo $obj->group_id; ?>/<?php echo $storehour->storehourdayid; ?>" class="button">Edit This Day</a>
                        <a href="/admin/storehours/deletehours/<?php echo $storehour->id; ?>" class="button">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="5">
                    No store hours present. <a href="/admin/storehours/edit/<?php echo $obj->group_id; ?>/<?php echo $day->id; ?>">Click here to add one.</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } ?>
