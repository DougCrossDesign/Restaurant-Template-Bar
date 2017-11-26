<?php
/** @var TemplateContainer $obj */
use Model\Pages\Page;
use Model\Pages\Partial;

$form_action = $obj->action_url;

$models = $obj->models;
?>
<form action="<?php echo $form_action; ?>" method="POST" enctype="multipart/form-data">

    <h3>Click and drag to reorder items. Press submit to save or cancel to go back.</h3>
    <?php
    if(isset($models) && count($models)){ ?>
        <ul id="sortable" class="partialOrdering">
            <?php
            foreach($models as $model){ ?>
                <li class="order-item"><?php
                    // find the column that this model wants to display
                    echo $model->getOrderManageDisplay();
                    ?><input type="hidden" name="id[]" value="<?php echo $model->id; ?>" /></li>
            <?php } ?>
        </ul>
        <?php
    } else {?>
        There are no items available for ordering.
    <?php } ?>
    <div class="col btm-margin">
        <?php if(isset($models) && count($models)){ ?>
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
