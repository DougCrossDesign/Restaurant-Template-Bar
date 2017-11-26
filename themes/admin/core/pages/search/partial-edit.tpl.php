<?php
use Model\FriendlyUrl;
use Model\Metadata;
use Model\Redirect;
use Model\Siteinfo;

/** @var TemplateContainer $obj */

/** @var \Model\Search\SearchPartial $searchpartial */
$searchpartial = $obj->searchpartial;

// If a partial is set, get its attributes
if ($searchpartial->partial) {
        /** @var \Model\Pages\Partial $partial */
        $partial = $searchpartial->partial->first();
}
$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>

<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm form-col">
        <?php
        $searchpartial->input("name")->options(Util::getInstalledPartials())->value($searchpartial->name ?: null)->output();
        //$searchpartial->input("partial_id")->value($searchpartial->id ?: null)->output();

        if ($searchpartial->partial) {
                /** @var \Model\Pages\Partial $partial */
                $partial = $searchpartial->partial->first();
                /** @var \Model\Partial\PartialModel $partialModel */
                $partialModel = $partial->model();

                $partialAttributes = $partialModel->schema()->getAttributes();

                $searchpartial->inputChildren("mappings")->options(["attribute" => $partialAttributes, "column" => Util::getSearchIndexColumns()])->order("column")->output();

                if ($partialModel->schema()->rawHasMeta()) {
                        $partialMetaAttributes = $partialModel->schema()->getMetaSchema()->getAttributes();
                        $searchpartial->inputChildren("metamappings")->options(["attribute" => $partialMetaAttributes, "column" => Util::getSearchIndexColumns()])->order("column")->output();
                }

        }
        printAdminSubmitCancelRow();
        ?>
</form>