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
        <th><?php printAdminHeader("Language", $nameIndex); ?></th>
        <?php foreach($displayAttributes as $displayAttribute) {
            if($displayAttribute !== $nameIndex){ ?>
                <th><?php printAdminHeader(ucwords($displayAttribute), $displayAttribute); ?></th>
            <?php } ?>
        <?php } ?>
        <th>Sitemenu Items</th>
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
                <?php foreach($displayAttributes as $displayAttribute) {
                    if($displayAttribute !== $nameIndex){ ?>
                        <td><?php $model->render($displayAttribute); ?></td>
                    <?php } ?>
                <?php } ?>
                <td>
                    <?php echo \Model\Translate\Language::getLanguageNameById($model->language_id); ?>
                </td>
                <td>
                    <a href="/admin/sitemenuitems/translations/<?php echo $model->id; ?>" class="button">Manage Sitemenu Items (<?php echo \Model\Sitemenu\SitemenuItem::query()->where("group_id","=",$originalModel->id)->where("language_id", "=", $model->language_id)->count(); ?>)</a>
                </td>
                <td>
                    <?php if ($model instanceof \Model\Pages\Page) { ?>
                        <a href="/admin/pages/edit/<?php echo $model->id; ?>" class="button">Edit</a>
                    <?php } else { ?>
                        <a href="/admin/<?php echo $controllerName; ?>/translate/<?php echo $originalModel->id; ?>/<?php echo $model->language_id; ?>" class="button">Edit</a>
                    <?php } ?>
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