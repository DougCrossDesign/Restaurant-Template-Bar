<?php
/** @var TemplateContainer $obj */
use Model\Adbanner;
use Model\Banners\Banner;
use Model\Script;

/** @var \Model\Pages\Partial $partials */
$partials = $obj->partials;

$models = $obj->models;
?>

<p>
    <a href="/admin/scripts/confirm?script=/inc/core/crons/updatedatabase.php" class="btn btm-margin floatr">Run All Migrations</a>
    Database migration scripts are: <strong><?php echo config()->automated_schema_update ? "On" : "Off"; ?></strong><br/>
    The following actions will be performed where possible: <?php echo implode(" ", config()->automated_schema_update_levels); ?>
</p>

<?php

$GLOBALS['footerjs'] = '';

$tabs = [];

/** @var BaseModel $model */
$model = new \Model\Metadata();


$tabs[] = $model->inputTab("Models", function() use($models)  { ?>
    <table cellspacing="0" cellpadding="0" class="datagrid">
        <thead>
        <tr>
            <th>Model</th>
            <th>Config Schema</th>
            <th>Database Schema</th>
            <th>Errors</th>
            <th>Controls</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (count($models) > 0) { ?>
            <?php
            /**
             * @var string $modelName
             * @var \BaseModel $modelInstance
             */
            foreach ($models as $modelName => $modelInstance) {
                /** @var \Model\Schema\DatabaseSchema $partialDatabaseSchema */
                $modelDatabaseSchema = $modelInstance->schema()->getDatabaseSchema();

                /** @var array $errors */
                $errors = $modelDatabaseSchema->getDiff();
                ?>
                <tr>
                    <td><?php echo get_class($modelInstance); ?></td>
                    <td>
                        <code>
                            <?php echo $modelDatabaseSchema->getCreateTableSql(); ?>
                        </code>

                        <?php if ($modelDatabaseSchema->metaDatabaseSchema) { ?>
                            <code><br/><br/>
                                <?php echo $modelDatabaseSchema->metaDatabaseSchema->getCreateTableSql(); ?>
                            </code>
                        <?php } ?>

                    </td>

                    <td>
                        <code>
                            <?php echo $modelDatabaseSchema->getSchemaFromDatabase() ? $modelDatabaseSchema->getSchemaFromDatabase()->getCreateTableSql() : ""; ?>
                        </code>

                        <?php if ($modelDatabaseSchema->metaDatabaseSchema) { ?>
                            <code><br/><br/>
                                <?php echo $modelDatabaseSchema->metaDatabaseSchema->getSchemaFromDatabase()->getCreateTableSql(); ?>
                            </code>
                        <?php } ?>

                    </td>
                    <td><?php
                        if (count($errors)) {
                            foreach($errors as $column => $error) {
                                echo $column . ": ". $error . "<br/>";
                            }
                        } else {
                            echo "Schema and database match.";
                        }

                        ?></td>
                    <td><?php
                        if (count($errors) && strlen($modelDatabaseSchema->getMigrateScript())) { ?>
                            <a href="/admin/database/confirm?model=<?php echo get_class($modelInstance); ?>" class="button">Fix Table</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        <?php } ?>
        </tbody>
    </table>
<?php });



$tabs[] = $model->inputTab("Partials", function() use($partials)  { ?>
    <table cellspacing="0" cellpadding="0" class="datagrid">
        <thead>
        <tr>
            <th>Partial</th>
            <th>Config Schema</th>
            <th>Database Schema</th>
            <th>Errors</th>
            <th>Controls</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (count($partials) > 0) { ?>
            <?php
            /** @var \Model\Pages\Partial $partial */
            foreach ($partials as $partial) {

                /** @var \Model\Schema\DatabaseSchema $partialDatabaseSchema */
                $partialDatabaseSchema = $partial->model()->schema()->getDatabaseSchema();

                /** @var array $errors */
                $errors = $partialDatabaseSchema->getDiff();
                ?>
                <tr>
                    <td><?php echo $partial->name; ?></td>
                    <td>
                        <code>
                            <?php echo $partialDatabaseSchema->getCreateTableSql(); ?>
                        </code>

                        <?php if ($partialDatabaseSchema->metaDatabaseSchema) { ?>
                        <code><br/><br/>
                            <?php echo $partialDatabaseSchema->metaDatabaseSchema->getCreateTableSql(); ?>
                        </code>
                        <?php } ?>

                    </td>

                    <td>
                        <code>
                            <?php echo $partialDatabaseSchema->getSchemaFromDatabase()->getCreateTableSql(); ?>
                        </code>

                        <?php if ($partialDatabaseSchema->metaDatabaseSchema) { ?>
                            <code><br/><br/>
                                <?php echo $partialDatabaseSchema->metaDatabaseSchema->getSchemaFromDatabase()->getCreateTableSql(); ?>
                            </code>
                        <?php } ?>

                    </td>
                    <td><?php
                                if (count($errors)) {
                                    foreach($errors as $column => $error) {
                                        echo $column . ": ". $error . "<br/>";
                                    }
                                } else {
                                    echo "Schema and database match.";
                                }

                        ?></td>
                    <td><?php
                        if (count($errors) && strlen($partialDatabaseSchema->getMigrateScript())) { ?>
                            <a href="/admin/database/confirm?partial=<?php echo $partial->id; ?>" class="button">Fix Table</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        <?php } ?>
        </tbody>
    </table>
<?php });




$model->inputTabGroup($tabs)->output();