<?php
use Model\Pages\Page;
use Model\Pages\Partial;

/** @var TemplateContainer $obj */

/** @var string $add_link */
$add_link = $obj->add_link;

$corepartials = $obj->corepartials;
$sitepartials = $obj->sitepartials;
?>
<?php echo $obj->pagination; ?>

<p class="btm-margin"><a href="<?php echo $add_link; ?>" class="btn">Add New Partial</a></p>

<h1 class="hdr3 btm-margin-sm">Site Partials</h1>
<table cellspacing="0" cellpadding="0" class="datagrid btm-margin-lg">
    <thead>
    <tr>
        <th><?php printAdminHeader("Name"); ?></th>
        <th><?php printAdminHeader("Directory"); ?></th>
        <th><?php printAdminHeader("Template"); ?></th>
        <th><?php printAdminHeader("Default"); ?></th>
        <th><?php printAdminHeader("Autocreate"); ?></th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    /** @var Partial $partial */
    foreach ($sitepartials as $partial) { ?>
        <tr>
            <td><?php echo $partial->name; ?></td>
            <td><?php echo $partial->directory; ?></td>
            <td><?php echo $partial->template; ?></td>
            <td><?php echo $partial->getDefaultGroupNames(); ?></td>
            <td><?php echo $partial->getAutocreateGroupNames(); ?></td>
            <td>
                <a href="/admin/partials/editpartial/<?php echo $partial->id; ?>" class="button">Edit</a>
                <a href="/admin/partials/deletepartial/<?php echo $partial->id; ?>" class="button">Delete</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<h1 class="hdr3 btm-margin-sm">Core Partials</h1>
<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th><?php printAdminHeader("Name"); ?></th>
        <th><?php printAdminHeader("Directory"); ?></th>
        <th><?php printAdminHeader("Template"); ?></th>
        <th><?php printAdminHeader("Default"); ?></th>
        <th><?php printAdminHeader("Autocreate"); ?></th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    /** @var Partial $partial */
    foreach ($corepartials as $partial) { ?>
        <tr>
            <td><?php echo $partial->name; ?></td>
            <td><?php echo $partial->directory; ?></td>
            <td><?php echo $partial->template; ?></td>
            <td><?php echo $partial->getDefaultGroupNames(); ?></td>
            <td><?php echo $partial->getAutocreateGroupNames(); ?></td>
            <td>
                <a href="/admin/partials/editpartial/<?php echo $partial->id; ?>" class="button">Edit</a>
                <a href="/admin/partials/deletepartial/<?php echo $partial->id; ?>" class="button">Delete</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>


