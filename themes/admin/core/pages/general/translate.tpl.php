<?php

/** @var TemplateContainer $obj */

/** @var BaseModel $model */
$translation = $obj->translation;
if (is_null($translation)) {
    Error::exception( new Exception("The translation model doesn't exist!"));
}

$original = $obj->original;
if (is_null($original)) {
    Error::exception( new Exception("The original model doesn't exist!"));
}

$action_url = $obj->action_url;

InputErrors::printErrors();
?>
    <form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm form-col">
        <ul>

            <?php
            // Get the id
            $translation->input("id")->type("hidden")->output();

            if ($translation->exists) {
                $translation->input("language_id")->label("Language")->type("text")->value(\Model\Translate\Language::getById($translation->language_id)->name)->disabled()->output();
            } else {
                $translation->input("language_id")->label("Language")->type("select")->options(\Model\Translate\Language::getDropdownOptions())->value($translation->language_id)->output();
            } ?>

            <hr/>
            <div class="form_row col1-2 col">
            <h2><?php echo \Model\Translate\Language::getById($translation->language_id)->name; ?> Translation</h2>
            </div>
            <div class="form_row col1-2 col">
                <h2><?php echo \Model\Translate\Language::getDefaultLanguage()->name; ?> Version</h2>
            </div>
            <div style="clear:both"></div>
            <hr/>

            <?php

            if ($translation->usesFriendlyUrl()) { ?>
                <div class="form_row col1-2 col">
                    <li class="lbl-hint col   btm-margin" data-prefix="press" data-derive-from="title"><label for="friendlyurl">Friendly URL
                            <?php if ($translation->exists) { ?> - <a href="<?php echo $translation->getFriendlyUrl(); ?>" target="_blank">Link</a><?php } ?></label>
                        <input disabled="disabled" name="" id="" type="" placeholder="" value="<?php echo $translation->exists ? $translation->getFriendlyUrl() : "Save to generate friendly URL"; ?>">
                    </li>
                </div>
                <div class="form_row col1-2 col">
                    <li class="lbl-hint col   btm-margin" data-prefix="press" data-derive-from="title"><label for="friendlyurl">Friendly URL
                            <?php if ($original->exists) { ?> - <a href="<?php echo $original->getFriendlyUrl(); ?>" target="_blank">Link</a><?php } ?></label>
                        </label>
                        <input disabled="disabled" name="" id="" type="" placeholder="" value="<?php echo $original->getFriendlyUrl(); ?>">
                    </li>
                </div>
            <?php }

            // If the model has an attribute that requires a dropdown menu, this can't be used as we need to set the options
            foreach($translation::getAllAttributes() as $attribute_key => $attribute_value) {
                // If this attribute is translatable, then display it
                if ($translation->isTranslatableAttribute($attribute_key)) { ?>
                    <div class="form_row col1-2 col">
                        <?php $translation->input($attribute_key)->output(); ?>
                    </div>
                    <div class="form_row col1-2 col">
                        <?php $translation->input($attribute_key)->value($original->$attribute_key)->disabled()->label(\Model\Translate\Language::getDefaultLanguage()->name . ": " . ucwords($attribute_key))->output(); ?>
                    </div>
                    <div style="clear:both"></div>
                    <?php
                    // Otherwise, hide it and take the value of the original
                } else {
                    $translation->input("$attribute_key")->type("hidden")->value($original->$attribute_key)->output();
                }
            }

            if ($translation->hasChildRelationships()) {
                foreach ($translation->getChildRelationships() as $relationship) { ?>
                    <div class="form_row col1-2 col">
                        <?php $translation->inputChildren($relationship)->output(); ?>
                    </div>
                    <div class="form_row col1-2 col">
                        <?php $original->inputChildren($relationship)->disabled()->output(); ?>
                    </div>
                    <div style="clear:both"></div>
                <?php }
            } ?>

            <div style="clear:both"></div>
            <?php printAdminSubmitCancelRow();
            ?>
        </ul>
    </form>


<?php insertInclude("log", $obj->log); ?>