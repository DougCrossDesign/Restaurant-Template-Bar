<?php
/** @var TemplateContainer $obj */

/** @var \Model\Partial\PartialModel $originalModel */
$originalModel = $obj->model;

/** @var \Model\Partial\PartialModel[] $partialTranslations */
$partialTranslations = $obj->translatedPartials;

/** @var string $controllerName */
$controllerName = $obj->controllerName;

/** @var string $nameIndex */
$nameIndex = $obj->nameIndex;

$modelNameSingular = $obj->modelNameSingular;
$modelNamePlural = $obj->modelNamePlural;

?>

<?php echo $obj->pagination; ?>

<p>
    <a href="/admin/pages/edit/<?php echo $originalModel->page_id; ?>" class="btn btm-margin">< Back To Page</a>
    <a href="/admin/<?php echo $controllerName; ?>/translate/<?php echo $originalModel->page_id; ?>/<?php echo $originalModel->pivot_id; ?>" class="btn btm-margin floatr">Add New Translation</a>
</p>

<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th>Partial ID</th>
        <th>Partial Name</th>
        <th>Partial Type</th>
        <th><?php printAdminHeader("Language", $nameIndex); ?></th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($partialTranslations)) { ?>
        <?php
        /** @var \Model\Partial\PartialModel $partialTranslation */
        foreach ($partialTranslations as $partialTranslation) {
            $partialData = $partialTranslation->getPartialData();
            $pivotData = $partialTranslation->getPivotData();
            ?>
            <tr>
                <td><?php echo $partialTranslation->id; ?></td>
                <td><?php echo $pivotData->title; ?></td>
                <td><?php echo $partialData->name; ?></td>
                <td>
                    <?php echo \Model\Translate\Language::getLanguageNameById($pivotData->language_id); ?>
                </td>
                <td>

                    <a href="/admin/partials/translate/<?php echo $originalModel->page_id; ?>/<?php echo $originalModel->pivot_id; ?>/<?php echo $pivotData->language_id; ?>" class="button">Edit</a>
                    <a href="/admin/partials/delete/<?php echo $pivotData->pageid; ?>?pivotid=<?php echo $pivotData->id; ?>" class="button">Delete</a>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                No translations present. <a href="/admin/<?php echo $controllerName; ?>/translate/<?php echo $originalModel->page_id; ?>/<?php echo $originalModel->pivot_id; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>


