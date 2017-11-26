<?php
/** @var TemplateContainer $obj */

/** @var BaseModel[] $originalModel */
$originalModel = $obj->model;

/** @var string $controllerName */
$controllerName = $obj->controllerName;

/** @var string $nameIndex */
$nameIndex = $obj->nameIndex;

$modelNameSingular = $obj->modelNameSingular;
$modelNamePlural = $obj->modelNamePlural;

/** @var array $displayAttributes */
$displayAttributes = array();

$staticModel = $originalModel ?: null;
if ($staticModel) {
    $displayAttributes = $staticModel::getDisplayAttributes();
    // unset the name attribute
    if (in_array($nameIndex, $displayAttributes)) unset($displayAttributes[$nameIndex]);
    // unset other bad attributes
    $badAttributes = ["image"];
    foreach($displayAttributes as $displayAttribute) {
        if (in_array($displayAttribute, $badAttributes)) unset($displayAttributes[$displayAttribute]);
    }
}
?>

<?php echo $obj->pagination; ?>

<p>
    <a href="/admin/<?php echo $controllerName; ?>" class="btn btm-margin">< Back</a>
    <a href="/admin/<?php echo $controllerName; ?>/translate/<?php echo $originalModel->id; ?>" class="btn btm-margin floatr">Add New Translation</a>
</p>

<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th><?php printAdminHeader(ucwords($nameIndex), $nameIndex); ?></th>
        <th><?php echo printAdminHeader("Friendly URL"); ?></th>
        <th><?php printAdminHeader("Language", $nameIndex); ?></th>
        <?php foreach($displayAttributes as $displayAttribute) {
            if($displayAttribute !== $nameIndex){ ?>
                <th><?php printAdminHeader(ucwords($displayAttribute), $displayAttribute); ?></th>
            <?php } ?>
        <?php } ?>
        <?php if ( $staticModel && $staticModel::hasOrderEditableDropdown() ) { ?>
            <th><Order</th>
        <?php } ?>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if ($originalModel->translations()->count()) { ?>
        <?php
        /** @var BaseModel $model */
        foreach ($originalModel->translations as $model) { ?>
            <tr>
                <td><?php echo $model->{$nameIndex}; ?></td>
                <td><a href="<?php echo $model->getFriendlyUrl(); ?>" target="_blank"><?php echo $model->getFriendlyUrl(); ?></a></td>
                <?php foreach($displayAttributes as $displayAttribute) {
                    if($displayAttribute !== $nameIndex){ ?>
                        <td><?php $model->render($displayAttribute); ?></td>
                    <?php } ?>
                <?php } ?>
                <td>
                    <?php echo \Model\Translate\Language::getLanguageNameById($model->language_id); ?>
                </td>
                <td>
                    <a href="/admin/<?php echo $controllerName; ?>/delete/<?php echo $model->id; ?>" class="button">Delete</a>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                No translations present. <a href="/admin/<?php echo $controllerName; ?>/translate/<?php echo $originalModel->id; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>


