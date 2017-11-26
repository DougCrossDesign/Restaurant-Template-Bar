<?php
use Model\FriendlyUrl;
use Model\Metadata;
use Model\Redirect;
use Model\Siteinfo;
use Model\Sitemap\SitemapModel;

/** @var TemplateContainer $obj */

/** @var SitemapModel $sitemapmodel */
$sitemapmodel = $obj->sitemapmodel;

$chosenmodel = $obj->chosenModel;

$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>

<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm form-col">
        <?php
        $sitemapmodel->input("name")->label("Model Name")->options(Util::getInstalledModelsAsDropdown(false))->value($chosenmodel ?: null)->output();
        $sitemapmodel->input("page_id")->label("Nest Under Page")->options(\Model\Sitemap\SitemapPage::getDropdownValues())->output();

        printAdminSubmitCancelRow();
        ?>
</form>