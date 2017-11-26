<?php
use Model\Pages\Page;
use Model\Sitemenu;

/** @var TemplateContainer $obj */

/** @var Sitemenu\SitemenuItem $sitemenu */
$sitemenu = $obj->sitemenuitem;
$menu_id = $obj->menu_id;
$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();

?>

<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm">
    <ul>
        <?php
        $sitemenu->input("group_id")->value($sitemenu->group_id ?: $menu_id)->output();
        $sitemenu->input("title")->output();
        $sitemenu->input("image")->output();
        $sitemenu->input("url")->output();
        ?>
        <li class="lbl-hint col  btm-margin">
            <label>Select a page to auto-import the URL</label>
            <select id="importUrl" onchange="pasteUrl()">
                <option value="">--- Select a page to auto-import ---</option>
                <?php
                /** @var Page $page */
                foreach(Page::get() as $page){
                    echo '<option value="'. $page->getFriendlyUrl() .','. $page->id .','. $page->title . '">'. $page->title.'</option>';
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
        <?php
        if($obj->allowNesting) {
            $sitemenu->input("parent_id")->label("Nest Under")->options(Sitemenu\SitemenuItem::getNestedSitemenuItemsForDropdown($sitemenu->group_id ?: $menu_id))->output();
        }
        $sitemenu->input("newwindow")->output();
        printAdminSubmitCancelRow();
        ?>
    </ul>
</form>
<script type="text/javascript">
    function pasteUrl(){
        var val = $("#importUrl").val();
        var split_values = val.split(",");
        if(split_values[0].length > 0){
            $("#url").val(split_values[0]);
        }
        if(split_values[1].length > 0){
            $("input[name='page_id']").val(split_values[1]);
        }
        if(split_values[2].length > 0){
            $("input[name='title']").val(split_values[2]);
        }
    }
</script>
</form>