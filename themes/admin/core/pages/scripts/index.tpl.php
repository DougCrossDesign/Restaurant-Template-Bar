<?php
/** @var TemplateContainer $obj */
use Model\Adbanner;
use Model\Banners\Banner;
use Model\Script;

$scripts = $obj->scripts;
?>

<?php

$GLOBALS['footerjs'] = '';

$tabs = [];

/** @var BaseModel $model */
$model = new \Model\Metadata();

$tabs[] = $model->inputTab("Core Scripts", function() use ($scripts) { ?>
<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th>Script</th>
        <th>Location</th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($scripts) > 0) { ?>

        <?php
        /** @var Script $script */
        foreach ($scripts->where("core", true) as $script) { ?>
            <tr>
                <td><?php echo $script->title; ?></td>
                <td><?php echo $script->url; ?></td>
                <td><a target="_blank" href="/admin/scripts/confirm?script=<?php echo $script->url; ?>" class="button">Run Script</a></td>
            </tr>
        <?php } ?>
    <?php } ?>
</tbody>
</table>
<?php });

$tabs[] = $model->inputTab("Site Scripts", function() use ($scripts) { ?>
    <table cellspacing="0" cellpadding="0" class="datagrid">
        <thead>
        <tr>
            <th>Script</th>
            <th>Location</th>
            <th>Controls</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (count($scripts) > 0) { ?>

            <?php
            /** @var Script $script */
            foreach ($scripts->where("core", false) as $script) { ?>
                <tr>
                    <td><?php echo $script->title; ?></td>
                    <td><?php echo $script->url; ?></td>
                    <td><a target="_blank" href="/admin/scripts/confirm?script=<?php echo $script->url; ?>" class="button">Run Script</a></td>
                </tr>
            <?php } ?>
        <?php } ?>
        </tbody>
    </table>
<?php });

$model->inputTabGroup($tabs)->output();