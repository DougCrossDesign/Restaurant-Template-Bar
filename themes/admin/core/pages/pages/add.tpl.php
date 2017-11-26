<?php
/** @var TemplateContainer $obj */
use Model\Pages\Page;
use Model\Pages\Partial;
use Model\User;

$page_title = $obj->page_title;
$form_action = $obj->action_url;
/** @var Page $page */
$page = $obj->page;
?>
<form action="<?php echo $form_action; ?>" method="POST" enctype="multipart/form-data">
    
    <ul class="form-col">       
        <?php
        if(Auth::isSuperAdmin()) $page->input("admin_key")->label("Admin Key (Note: Must be unique. Will be prepended with 'page-')")->output();
        $page->input("title")->output();
        $page->input("friendlyurl")->friendlyurlPrefix(null)->label("Friendly URL (Note: URL must match controller name if not a page-builder site)")->output();
        ?>
        <li>
            <label>Group Permissions</label>
            <select name="groups[]" multiple="multiple" class="chosen">
                <?php foreach(User::TYPES() as $label => $value){
                    if($value && $value <= Auth::getUserLevel()){
                        echo '<option value="'. $value .'" selected="selected" disabled="disabled">'. $label .'</option>';
                    } else if($value){
                        echo '<option value="'. $value .'" selected="selected">'. $label .'</option>';
                    }
                } ?>
            </select>
        </li>

    <?php if ($obj->adding == false) { ?>

        <?php if (isset($obj->section_templates)) { ?>
            <?php foreach ($obj->section_templates as $section) { ?>
                <?php echo $section; ?>
            <?php } ?>
        <?php } ?>


    <?php }
    printAdminSubmitCancelRow();
     ?>

    </ul>

</form>