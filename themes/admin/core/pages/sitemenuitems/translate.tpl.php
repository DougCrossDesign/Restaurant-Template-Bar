<?php

/** @var TemplateContainer $obj */
use Model\Pages\Page;

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
            $translation->input("language_id")->label("Language")->type("select")->options(\Model\Translate\Language::getDropdownOptions())->value($translation->language_id)->output();


             ?>

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
                    <?php $translation->input("friendlyurl")->disabled()->label("Friendly URL ")->output(); ?>
                    <a href="<?php echo $translation->getFriendlyUrl(); ?>" target="_blank">link</a>
                </div>
                <div class="form_row col1-2 col">
                    <?php $original->input("friendlyurl")->disabled()->output(); ?>
                    <a href="<?php echo $original->getFriendlyUrl(); ?>" target="_blank">link</a>
                </div>
            <?php } ?>

            <?php
            // If the model has an attribute that requires a dropdown menu, this can't be used as we need to set the options
            foreach($translation::getAllAttributes() as $attribute_key => $attribute_value) {
                // If this attribute is translatable, then display it
                if ($translation->isTranslatableAttribute($attribute_key)) {
                    if ($attribute_key == "page_id") { ?>
                            <div class="form_row col1-2 col">
                                <li class="lbl-hint col  btm-margin">
                                    <label>Select a page to auto-import the URL</label>
                                    <select id="importUrl" onchange="pasteUrl()">
                                        <option value="">--- Select a page to auto-import ---</option>
                                        <?php
                                        /** @var Page $page */
                                        foreach(Page::get() as $page){
                                            echo '<option value="'. $page->getFriendlyUrl() .','. $page->id . '">'. $page->title.'</option>';
                                            if (config()->multilingual) {
                                                /** @var Page $pageTranslation */
                                                foreach ($page->translations as $pageTranslation) {
                                                    if ($pageTranslation->getFriendlyUrl()) {
                                                        echo '<option value="' . $pageTranslation->getFriendlyUrl() . ',' . $pageTranslation->id . '"> - ' . $pageTranslation->title . '</option>';
                                                    }
                                                }
                                            }
                                        } ?>
                                    </select>
                                </li>
                                <input type="hidden" name="page_id" />
                            </div>
                            <div class="form_row col1-2 col">
                                <?php $translation->input("no")->type("text")->value($original->$attribute_key ? Page::getById($original->$attribute_key)->title : "")->disabled()->label(\Model\Translate\Language::getDefaultLanguage()->name . ": Page")->output(); ?>
                            </div>
                            <div style="clear:both"></div>
                        <?php } else { ?>
                            <div class="form_row col1-2 col">
                                <?php $translation->input($attribute_key)->output(); ?>
                            </div>
                            <div class="form_row col1-2 col">
                                <?php $translation->input($attribute_key)->value($original->$attribute_key)->disabled()->label(\Model\Translate\Language::getDefaultLanguage()->name . ": " . ucwords($attribute_key))->output(); ?>
                            </div>
                            <div style="clear:both"></div>
                        <?php } ?>
                    <?php
                    // Otherwise, hide it and take the value of the original
                } else {
                    $translation->input("$attribute_key")->type("hidden")->value($original->$attribute_key)->output();
                }
            } ?>

            <div style="clear:both"></div>
            <?php printAdminSubmitCancelRow();
            ?>
        </ul>
    </form>
    <script type="text/javascript">
        function pasteUrl(){
            var val = $("#importUrl").val();
            var split_values = val.split(",");
            console.log(split_values);
            if(split_values[0].length > 0){
                $("#url").val(split_values[0]);
            }
            if(split_values[1].length > 0){
                $("input[name='page_id']").val(split_values[1]);
            }
        }
    </script>

<?php insertInclude("log", $obj->log); ?>