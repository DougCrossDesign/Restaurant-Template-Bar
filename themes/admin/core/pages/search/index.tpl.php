<?php
/** @var TemplateContainer $obj */
use Model\FriendlyUrl;
use Model\Jobposition;

/** @var \Model\Search\SearchModel[] $searchmodels */
$searchmodels = $obj->searchmodels;

/** @var \Model\Search\SearchPartial[] $searchpartials */
$searchpartials = $obj->searchpartials;

$installedModels = $obj->installedModels;

$installedPartials = $obj->installedPartials;

/** @var string $add_link */
$add_link = $obj->add_link;

$GLOBALS['footerjs'] = '';

$tabs = [];

/** @var BaseModel $model */
$model = new \Model\Metadata();
?>

    <a href="/admin/scripts/confirm?script=/inc/core/crons/searchindex.php" class="btn btm-margin floatr">Run Search Item Indexing</a>
    <div style="clear:both;"></div>
<?php
$tabs[] = $model->inputTab("Models", function() use ($searchmodels, $installedModels, $add_link) { ?>
    <h2 class="admin-header">Models</h2>
    <p>
        Configure which model attributes should be mapped to a searchable item. Only models that have their own page should be configured (ie models that use a FriendlyUrl).
    </p>

    <?php
    if (count($searchmodels) > 0) { ?>
        <hr/>
        <li class="col">
            <h3 class="admin-header">Configured Models</h3>
        </li>
        <table cellspacing="0" cellpadding="0" class="datagrid">
        <thead>
        <tr>
            <th>Model Name</th>
            <?php foreach(Util::getSearchIndexColumns()as $attribute) { ?>
                <th><?php echo ucwords($attribute); ?></th>
            <?php } ?>
            <th>Controls</th>
        </tr>
        </thead>
        <tbody>
        <?php
        /** @var \Model\Search\SearchModel $searchmodel */
        foreach ($searchmodels as $searchmodel) { ?>
            <tr>
                <td><?php echo $searchmodel->name; ?></td>
                <?php foreach(Util::getSearchIndexColumns() as $attribute) { ?>
                    <td><?php
                        $attributes = array();
                        /** @var \Model\Search\SearchModelMapping $mapping */
                        foreach($searchmodel->mappings()->where("column", "=", $attribute)->get() as $mapping) {
                            $attributes[] = ucwords($mapping->attribute);
                        }
                        echo implode(", ", $attributes);
                        ?></td>
                <?php } ?>
                <td>
                    <a href="/admin/search/edit/<?php echo $searchmodel->id; ?>" class="button">Edit</a>
                    <a href="/admin/search/delete/<?php echo $searchmodel->id; ?>" class="button">Delete</a>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                No Search Models present. <a href="<?php echo $add_link; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
    </table>

    <?php if (count($installedModels))  { ?>
        <hr/>
        <li class="col">
            <h3 class="admin-header">Installed Models</h3>
        </li>

        <table cellspacing="0" cellpadding="0" class="datagrid">
            <thead>
            <tr>
                <th>Model Name</th>
                <th>Controls</th>
            </tr>
            </thead>
            <tbody>
            <?php
            /**
             * @var  $installedModel                model name
             * @var  string $model                  model name with namespace
             */
            foreach ($installedModels as $installedModel => $model) { ?>
                <tr>
                    <td><?php echo $model; ?></td>
                    <td>
                        <a href="/admin/search/addNew/<?php echo urlencode($model); ?>" class="button">Configure This Model's Search Settings</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } ?>
<?php });

?>

<?php
$tabs[] = $model->inputTab("Pages/Partials", function() use ($searchpartials, $installedPartials, $add_link) { ?>
    <li class="col">
        <h2 class="admin-header">Partials</h2>
    </li>
    <?php
    if (count($searchpartials) > 0) { ?>
        <hr/>
        <li class="col">
            <h3 class="admin-header">Configured Partials</h3>
        </li>
        <table cellspacing="0" cellpadding="0" class="datagrid">
        <thead>
        <tr>
            <th>Partial Name</th>
            <?php foreach(Util::getSearchIndexColumns() as $attribute) { ?>
                <th><?php echo ucwords($attribute); ?></th>
            <?php } ?>
            <th>Controls</th>
        </tr>
        </thead>
        <tbody>
        <?php
        /** @var \Model\Search\SearchPartial $searchpartial */
        foreach ($searchpartials as $searchpartial) { ?>
            <tr>
                <td><?php echo $searchpartial->name; ?></td>
                <?php foreach(Util::getSearchIndexColumns() as $attribute) { ?>
                    <td><?php
                        $attributes = array();
                        /** @var \Model\Search\SearchPartialMapping $mapping */
                        foreach($searchpartial->mappings()->where("column", "=", $attribute)->get() as $mapping) {
                            $attributes[] = ucwords($mapping->attribute);
                        }
                        /** @var \Model\Search\SearchPartialMetaMapping $mapping */
                        foreach($searchpartial->metamappings()->where("column", "=", $attribute)->get() as $mapping) {
                            $attributes[] = ucwords($mapping->attribute) . " (meta)";
                        }
                        echo implode(", ", $attributes);
                        ?></td>
                <?php } ?>
                <td>
                    <a href="/admin/search/editPartial/<?php echo $searchpartial->id; ?>" class="button">Edit</a>
                    <a href="/admin/search/deletePartial/<?php echo $searchpartial->id; ?>" class="button">Delete</a>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                No Search Models present. <a href="<?php echo $add_link; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
    </table>

    <?php if (count($installedPartials))  { ?>
        <hr/>
        <li class="col">
            <h3 class="admin-header">Installed Partials</h3>
        </li>

        <table cellspacing="0" cellpadding="0" class="datagrid">
            <thead>
            <tr>
                <th>Partial Name</th>
                <th>Controls</th>
            </tr>
            </thead>
            <tbody>
            <?php

            foreach ($installedPartials as $installedPartialName => $installedPartialId) { ?>
                <tr>
                    <td><?php echo $installedPartialName; ?></td>
                    <td>
                        <a href="/admin/search/addNewPartial/<?php echo urlencode($installedPartialName); ?>" class="button">Configure This Partial's Search Settings</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } ?>

<?php }); ?>

<?php
$model->inputTabGroup($tabs)->output();
?>