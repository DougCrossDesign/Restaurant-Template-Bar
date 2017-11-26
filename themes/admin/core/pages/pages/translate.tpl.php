<?php

/** @var TemplateContainer $obj */
use Model\Pages\Partial;
use Model\User;

/** @var BaseModel $model */
$translation = $obj->translation;

$original = $obj->original;

$action_url = $obj->action_url;

InputErrors::printErrors();
?>
<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm form-col">
    <ul>
        <?php
        // Get the id
        $translation->input("id")->type("hidden")->output();
        $translation->input("language_id")->type("select")->options(\Model\Translate\Language::getDropdownOptions())->value($translation->language_id)->label("Language")->output();
        ?>

        <?php if ($translation->usesFriendlyUrl()) { ?>
        <div class="form_row col1-2 col">
            <li class="lbl-hint col   btm-margin" data-prefix="press" data-derive-from="title"><label for="friendlyurl">Friendly URL </label>
                <input disabled="disabled" name="" id="" type="" placeholder="" value="<?php echo $translation->exists ? $translation->getFriendlyUrl() : "Save to generate friendly URL"; ?>">
            </li>
        </div>
        <div class="form_row col1-2 col">
            <li class="lbl-hint col   btm-margin" data-prefix="press" data-derive-from="title"><label for="friendlyurl">Friendly URL </label>
                <input disabled="disabled" name="" id="" type="" placeholder="" value="<?php echo $original->getFriendlyUrl(); ?>">
            </li>
        </div>
        <?php } ?>

        <?php
        // If the model has an attribute that requires a dropdown menu, this can't be used as we need to set the options
        foreach($translation::getAllAttributes() as $attribute_key => $attribute_value) {
            if ($translation->isTranslatableAttribute($attribute_key)) { ?>
            <div class="form_row col1-2 col">
                <?php $translation->input($attribute_key)->output(); ?>
            </div>
            <div class="form_row col1-2 col">
                <?php $translation
                    ->input($attribute_key)
                    ->value($original->$attribute_key)
                    ->disabled()
                    ->label(\Model\Translate\Language::getDefaultLanguage()->name . ": " . ucwords($attribute_key))
                    ->output(); ?>
            </div>
        <?php }
        } ?>


        <?php
        printAdminSubmitCancelRow();
        ?>
    </ul>
</form>


<?php insertInclude("log", $obj->log); ?>