<?php
/** @var TemplateContainer $obj */

/** @var \Model\Sitemenu\Sitemenu $translatedSitemenu */
$translatedSitemenu = $obj->translatedSitemenu;

/** @var \Model\Sitemenu\Sitemenu $originalSitemenu */
$originalSitemenu = $obj->originalSitemenu;

$sitemenus = $originalSitemenu->items;

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
    <a href="/admin/sitemenus" class="btn btm-margin">< Back To Sitemenus</a>
</p>

<style type="text/css">
    .strong {font-weight: bold;
        font-size: 14px;}
</style>
<table cellspacing="0" cellpadding="0" class="datagrid" style="font-size: 11px;">
    <thead>
    <tr>
        <th>Translation Exists</th>
        <th><?php printAdminHeader("Default Name", "key"); ?></th>
        <th><?php printAdminHeader("Default URL"); ?></th>
        <th><?php printAdminHeader("Translated Name", "key"); ?></th>
        <th><?php printAdminHeader("Translated URL"); ?></th>
        <th>Order</th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($sitemenus) > 0) { ?>
        <?php

        // first get root sitemeus
        $sitemenusByParentId = [];
        /** @var Sitemenu $s */
        foreach($sitemenus as $s){
            if(!array_key_exists($s->parent_id, $sitemenusByParentId)) $sitemenusByParentId[$s->parent_id] = [];
            $sitemenusByParentId[$s->parent_id][] = $s;
        }


        /**
         * @param $sitemenusByParentId
         * @param $key
         * @param int $level
         */
        function printChildren(&$sitemenusByParentId, $key, $level = 0, $translatedSitemenu) {
            if(!array_key_exists($key, $sitemenusByParentId)) return;
            $thisLevelSitemenus = $sitemenusByParentId[$key];
            /** @var \Model\Sitemenu\SitemenuItem $s */
            foreach($thisLevelSitemenus as $s){
                /** @var \Model\Sitemenu\SitemenuItem $translatedSitemenuItem */
                $translatedSitemenuItem = $s->getTranslation($translatedSitemenu->language_id);
                ?>
                <tr>
                    <td>
                        <?php echo $translatedSitemenuItem ? "<span style='color:green;'>Translated</span>" : "<span style='color:red;'>Not Translated</span>"; ?>
                    </td>
                    <td><?php for($i = 0; $i < $level; $i++){
                            echo '&nbsp;&nbsp;&nbsp;';
                        }?>
                        <?php
                        echo $s->title; ?></td>
                    <td>
                        <a target="_blank" href="<?php echo $s->getUrl(); ?>"><?php echo Util::chopUrl($s->getUrl(), 50); ?></a>
                    </td>
                    <td><?php for($i = 0; $i < $level; $i++){
                            echo '&nbsp;&nbsp;&nbsp;';
                        }?>
                        <?php
                        echo $translatedSitemenuItem->title; ?></td>
                    <td>
                        <?php if ($translatedSitemenuItem) { ?>
                            <a target="_blank" href="<?php echo $translatedSitemenuItem->getUrl(); ?>"><?php echo Util::chopUrl($translatedSitemenuItem->getUrl(), 50); ?></a>
                        <?php } ?>
                    </td>
                    <td>
                        <?php echo $s->displayorder; ?>
                    </td>
                    <td>
                        <?php if(Auth::isSuperAdmin() || !$s->locked){ ?>
                            <a href="/admin/sitemenuitems/translate/<?php echo $s->id; ?>/<?php echo $translatedSitemenu->language_id; ?>" class="button">Edit Translation</a>
                            <a href="/admin/sitemenuitems/delete/<?php echo $s->id; ?>" class="button">Delete</a>
                        <?php } ?>
                    </td>
                </tr>
                <?php
                printChildren($sitemenusByParentId, $s->id, $level+1, $translatedSitemenu);
            }
        }


        printChildren($sitemenusByParentId, 0, 0, $translatedSitemenu);
    } else { ?>
        <tr>
            <td colspan="5">
                No menu items present. <a href="<?php echo $add_link; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>