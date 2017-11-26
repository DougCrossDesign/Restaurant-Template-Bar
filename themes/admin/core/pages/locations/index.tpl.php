<?php
/** @var TemplateContainer $obj */
use Model\Jobposition;
use Model\Location;
use Model\Metadata;
use Model\Redirect;
use Model\Siteinfo;
use Module\LocationsModule;

/** @var Location[] $locations */
$locations = $obj->locations;
/** @var string $add_link */
$add_link = $obj->add_link;
?>
<?php echo $obj->pagination; ?>

<p>
    <?php
    // check to see if the locations module allows more locations to be added
    if(LocationsModule::multiple() || !count($locations)){ ?>
        <a href="<?php echo $add_link; ?>" class="btn btm-margin">Add New Location</a>
    <?php } ?>

    <?php
    if( Module::exists("locationicons") ){ ?>
        <a href="<?php echo LocationIconsModule::url(); ?>" class="floatr btn btm-margin">Manage Location Icons</a>
    <?php } ?>

    <?php
    if( Module::exists("storehours") ){ ?>
        <a href="<?php echo \Module\StoreHoursModule::url(); ?>" class="floatr btn btm-margin">Manage Store Hours</a>
    <?php } ?>

    <?php
    if( Module::exists("locationinfo") ){ ?>
        <a href="<?php echo \Module\LocationInfoModule::url(); ?>" class="floatr btn btm-margin">Manage Location Info</a>
    <?php } ?>
</p>

<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th><?php printAdminHeader("Name"); ?></th>
        <th>Store Hours</th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($locations) > 0) { ?>
        <?php
        /** @var Location $location */
        foreach ($locations as $location) { ?>
            <tr>
                <td><?php echo $location->name; ?></td>
                <td><a href="/admin/storehours/viewgroup/<?php echo $location->storehoursgroup->id; ?>">Manage Store Hours</a></td>
                <td>
                        <a href="/admin/locations/edit/<?php echo $location->id; ?>" class="button">Edit</a>
                    <a href="/admin/locations/delete/<?php echo $location->id; ?>" class="button">Delete</a>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                No locations present. <a href="<?php echo $add_link; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>