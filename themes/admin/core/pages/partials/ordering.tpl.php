<?php
/** @var TemplateContainer $obj */

$form_action = $obj->action_url;

/** @var \Model\Partial\PartialModel $partial */
$partial = $obj->partial;

$orderField = $partial->schema()->getMetaDisplayOrderColumn();
$displayField = $partial->schema()->getMetaDisplayOrderTitle();
$displayFieldType = $partial->schema()->getMetaDisplayOrderColumnType();
?>
<form action="<?php echo $form_action; ?>" method="POST" enctype="multipart/form-data">

    <h3>Click and drag to reorder items. Press submit to save or cancel to go back.</h3>
    <?php
    if(isset($partial->meta) && count($partial->meta)){ ?>
        <ul id="sortable" class="partialOrdering">
            <?php
            /** @var \Model\Partial\PartialMetaModel $meta */
            foreach($partial->meta as $meta) {
                $value = $meta->{$displayField};
                if ($displayFieldType == IB_IMAGE) {
                    $value = "<img src='/assets/images/partials/$partial->directory/cms/$value' />";
                }
                ?>
                <li class="order-item"><?php echo $value; ?><input type="hidden" name="meta_id[]" value="<?php echo $meta->id; ?>" /></li>
            <?php } ?>
        </ul>
        <?php
    } else {?>
        There are no items available for ordering.
    <?php } ?>
    <div class="col btm-margin">
        <?php if(isset($partial->meta) && count($partial->meta)){ ?>
            <input type="submit" name="save" value="Submit" class="btn" />
        <?php } ?>
        <input type="submit" name="cancel" value="Cancel" class="btn2" />
    </div>
</form>
<?php
if(!isset($GLOBALS['footerjs'])) $GLOBALS['footerjs'] = '';
$GLOBALS['footerjs'] .= '
<script type="text/javascript">
    $("#sortable").sortable();
</script>'; ?>
