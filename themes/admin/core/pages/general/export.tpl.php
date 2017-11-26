<?php

/** @var TemplateContainer $obj */

/** @var BaseModel $model */
$model = $obj->model;

$action_url_export = $obj->action_url_export;
$action_url_export_template = $obj->action_url_export_template;
$action_url_import = $obj->action_url_import;

InputErrors::printErrors();


$tabs = [];

$tabs[] = $model->inputTab("Export Data", function() use ($action_url_export, $model) { ?>

    <form action="<?php echo $action_url_export; ?>" method="POST" enctype="multipart/form-data" class="modifyorm form-col">
        <ul>
            <p>Select which datapoints you wish to export:</p>

            <?php

            // If the model has an attribute that requires a dropdown menu, this can't be used as we need to set the options
            foreach($model::getAllAttributes() as $attribute_key => $attribute_value) { ?>
                <?php
                printAdminRow($attribute_value, true, "", "checkbox", $attribute_value);
                ?>
            <?php }
            printAdminSubmitCancelRow("Export");
            ?>
        </ul>
    </form>

<?php });

$tabs[] = $model->inputTab("Export Data Template", function() use ($action_url_export_template, $model) { ?>

    <form action="<?php echo $action_url_export_template; ?>" method="POST" enctype="multipart/form-data" class="modifyorm form-col">
        <ul>
            <p>Export the template used for importing data. </p>

            <?php
            printAdminSubmitCancelRow("Export Template");
            ?>
        </ul>
    </form>

<?php });

$tabs[] = $model->inputTab("Import Data", function() use ($action_url_import, $model) { ?>

    <form action="<?php echo $action_url_import; ?>" method="POST" enctype="multipart/form-data" class="modifyorm form-col">
        <ul>
            <p>Import data based on the template downloadable in the next tab.</p>

            <?php

            printAdminRow("Import CSV", "Import CSV", "", "file");
            printAdminSubmitCancelRow("Import");
            ?>
        </ul>
    </form>

<?php });


$model->inputTabGroup($tabs)->output(); ?>