<?php
/** @var TemplateContainer $obj */

/** @var BaseModel[] $models */
$models = $obj->models;

/** @var string $controllerName */
$controllerName = $obj->controllerName;

/** @var string $nameIndex */
$nameIndex = $obj->nameIndex;

$modelNameSingular = $obj->modelNameSingular;
$modelNamePlural = $obj->modelNamePlural;

/** @var array $displayAttributes */
$displayAttributes = array();

$staticModel = count($models) ? $models[0] : null;
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

<p><a href="/admin/<?php echo $controllerName; ?>/add" class="btn btm-margin">Add New <?php echo $modelNameSingular; ?></a></p>

<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th><?php printAdminHeader(ucwords($nameIndex), $nameIndex); ?></th>
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
    if (count($models) > 0) { ?>
        <?php
        /** @var BaseModel $model */
        foreach ($models as $model) { ?>
            <tr>
                <td><?php echo $model->{$nameIndex}; ?></td>
                <?php foreach($displayAttributes as $displayAttribute) {
                    if($displayAttribute !== $nameIndex){ ?>
                        <td><?php $model->render($displayAttribute); ?></td>
                    <?php } ?>
                <?php } ?>
                <?php if ( $staticModel && $staticModel::hasOrderEditableDropdown() ) { ?>
                    <td><?php echo printAdminOrderColumn($model, count($models), $controllerName); ?></td>
                <?php } ?>
                <td>
                    <a href="/admin/<?php echo $controllerName; ?>/edit/<?php echo $model->id; ?>" class="button">Edit</a>
                    <a href="/admin/<?php echo $controllerName; ?>/delete/<?php echo $model->id; ?>" class="button">Delete</a>
                    <?php if ($model->supportsMultilingual()) { ?>
                        <a href="/admin/<?php echo $controllerName; ?>/translations/<?php echo $model->id; ?>" class="button">Manage Translations (<?php echo $model->translations()->count(); ?>)</a>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                No <?php echo $modelNamePlural; ?> present. <a href="/admin/<?php echo $controllerName; ?>/add">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>


