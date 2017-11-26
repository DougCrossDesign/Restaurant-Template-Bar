<?php
use Model\Metadata;
use Model\Pages\Page;
use Model\Redirect;
use Model\Siteinfo;
use Model\Sitemenu;

/** @var TemplateContainer $obj */

/** @var Sitemenu\ $sitemenu */
$sitemenu = $obj->sitemenu;
$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>

<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm">
    <ul>
        <?php
        if(Auth::isSuperAdmin()) $sitemenu->input("admin_key")->label("Admin Key (Note: Must be unique. Will be prepended with 'sitemenu-')")->value($sitemenu->admin_key)->output();
        $sitemenu->input("name")->output();
        $sitemenu->input("description")->output();
        printAdminSubmitCancelRow();
        ?>
    </ul>
</form>
