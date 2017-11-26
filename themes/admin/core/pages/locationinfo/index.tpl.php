<?php
/** @var TemplateContainer $obj */
use Model\Jobposition;
use Model\Location;
use Model\Metadata;
use Model\Redirect;
use Model\Siteinfo;
use Module\LocationsModule;

/** @var Location\[] $locations */
$locations = $obj->locations;
/** @var Location\LocationInfo[] $locationinfos */
$locationinfos = $obj->locationinfos;
/** @var string $add_link */
$add_link = $obj->add_link;
?>

<p class="buttons">
    <a href="/admin/locations" class="btn btm-margin">< Back To Locations</a>
</p>

<h2>Modify By Location</h2>
<hr>
<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th>Location</th>
        <th># Location Info</th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($locations) > 0) { ?>
        <?php
        /** @var Location\ $location */
        foreach ($locations as $location) { ?>
            <tr>
                <td><?php echo $location->name; ?></td>
                <td><?php echo count($location->infos); ?></td>
                <td>
                    <a href="/admin/locationinfo/add/<?php echo $location->id; ?>" class="button">Add Info</a>
                    <a href="/admin/locationinfo/edit/<?php echo $location->id; ?>" class="button">Edit Info</a>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                No Location Info present. <a href="<?php echo $add_link; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<hr>
<h2>View All Location Info</h2>
<hr>
<p class="filter">
    <?php echo $obj->pagination; ?>
    <?php
    /** @var Location\Location $location */
    foreach($locations as $location) { ?>
        <a href="/admin/locationinfo?location=<?php echo $location->id; ?>" class="floatr btn btm-margin"><?php echo $location->name; ?></a>
    <?php } ?>
</p>
<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th><?php printAdminHeader("Admin Key", "admin_key"); ?></th>
        <th><?php printAdminHeader("Key", "key"); ?></th>
        <th><?php printAdminHeader("Location", "location_id"); ?></th>
        <th><?php printAdminHeader("Value", "value"); ?></th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($locationinfos) > 0) { ?>
        <?php
        /** @var Location\LocationInfo $locationinfo */
        foreach ($locationinfos as $locationinfo) { ?>
            <tr>
                <td><?php echo $locationinfo->admin_key; ?></td>
                <td><?php echo $locationinfo->key; ?></td>
                <td><?php echo $locationinfo->location->name; ?></td>
                <td><?php echo $locationinfo->value; ?></td>
                <td>
                    <a href="/admin/locationinfo/edit/<?php echo $locationinfo->location->id; ?>/<?php echo $locationinfo->id; ?>" class="button">Edit</a>
                    <a href="/admin/locationinfo/delete/<?php echo $locationinfo->id; ?>" class="button">Delete</a>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                No Location Info present. <a href="<?php echo $add_link; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>