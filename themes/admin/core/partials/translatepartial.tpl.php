<?php
/** @var \Model\PartialModel $originalPartial */
$originalPartial = $obj->partial;

/** @var \Model\PartialModel $partial */
$translatedPartial = $obj->translatedPartial;
?>

<div>
    <?php if($obj->hasDisplayOrder){ ?>
        <a class="btn floatr" href="/admin/partials/ordering/<?php echo $obj->pageid . '/' . $obj->pivotid; ?>"><i class="aycicon-hamburger"></i> Manage Ordering</a>
    <?php } ?>
    <h1>Translate Partial <?php echo $originalPartial->schema()->raw->name; ?></h1>
    <hr/>
    <?php InputErrors::printErrors(); ?>
    <form method="post" enctype="multipart/form-data">
        <?php
        $originalPartial->input("language_id")->label("Language")->type("text")->value(\Model\Translate\Language::getById($obj->language_id)->name)->disabled()->output();
        ?>

        <hr/>
        <div class="form_row col1-2 col">
            <h2><?php echo \Model\Translate\Language::getById($obj->language_id)->name; ?> Translation</h2>
        </div>
        <div class="form_row col1-2 col">
            <h2><?php echo \Model\Translate\Language::getDefaultLanguage()->name; ?> Version</h2>
        </div>
        <div style="clear:both"></div>
        <hr/>

        <div class="form_row col1-2 col">
            <?php echo $obj->translateBody; ?>
        </div>
        <div class="form_row col1-2 col disabled">
            <?php echo $obj->originalBody; ?>
        </div>
        <div style="clear:both"></div>
        <div>
            <input type="hidden" name="original_id" value="<?php echo $originalPartial->partial_id; ?>" />
            <input type="hidden" name="original_pivot_id" value="<?php echo $originalPartial->pivot_id; ?>" />
            <input type="submit" name="save" value="Save" />
            <input type="submit" name="cancel" value="Cancel" />
        </div>
    </form>
</div>

<?php insertInclude("log", $obj->log); ?>