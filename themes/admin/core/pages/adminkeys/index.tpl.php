<?php
/** @var TemplateContainer $obj */
use Model\Adbanner;
use Model\Banners\Banner;
use Model\Script;

/** @var \Illuminate\Database\Eloquent\Collection[] $keys */
$keys = $obj->keys;
?>

<?php

$GLOBALS['footerjs'] = '';

$tabs = [];

/** @var BaseModel $model */
$model = new \Model\Metadata();

foreach($keys as $keyName => $keyCollections) {

    $tabs[] = $model->inputTab("$keyName", function() use ($keyCollections) { ?>
        <table cellspacing="0" cellpadding="0" class="datagrid">
            <thead>
            <tr>
                <th>ID</th>
                <th>Admin Key</th>
                <th>Name</th>
                <th>Controls</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (count($keyCollections) > 0) { ?>

                <?php
                /** @var BaseModel $keyCollection */
                foreach ($keyCollections as $keyCollection) { ?>
                    <tr>
                        <td><?php echo $keyCollection->id; ?></td>
                        <td><?php echo $keyCollection->admin_key; ?></td>
                        <td><?php echo ucfirst($keyCollection::getStaticNameIndex()) . ":\t" . $keyCollection->{$keyCollection::getStaticNameIndex()}; ?></td>
                        <td>
                            <?php if ($keyCollection->getFriendlyUrl()) {; ?><a href="<?php echo $keyCollection->getFriendlyUrl(); ?>">View Page</a><?php } ?>
                            <a href="/admin/<?php echo strtolower($keyCollection::getStaticModelName()) . "s"; ?>/edit/<?php echo $keyCollection->id; ?>">Manage <?php echo $keyCollection::getStaticNameIndex(); ?></a>
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
            </tbody>
        </table>
    <?php });

}


$model->inputTabGroup($tabs)->output();