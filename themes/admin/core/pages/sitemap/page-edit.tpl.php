<?php
use Model\FriendlyUrl;
use Model\Metadata;
use Model\Redirect;
use Model\Siteinfo;

/** @var TemplateContainer $obj */

/** @var \Model\Sitemap\SitemapPage $sitemappage */
$sitemappage = $obj->sitemappage;

$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>

<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm form-col">
        <?php
        $sitemappage->input("page_id")->options(\Model\Pages\Page::getDropdownValues())->label("Page")->output();

        printAdminSubmitCancelRow();
        ?>
</form>