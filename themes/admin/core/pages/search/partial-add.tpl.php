<?php
use Model\FriendlyUrl;
use Model\Metadata;
use Model\Redirect;
use Model\Siteinfo;

/** @var TemplateContainer $obj */

/** @var \Model\Search\SearchPartial $searchpartial */
$searchpartial = $obj->searchpartial;

$chosenpartial = $obj->chosenPartial;

$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>

<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm form-col">
        <?php
        $searchpartial->input("name")->options(Util::getInstalledPartials())->value($chosenpartial ?: null)->output();
        $searchpartial->input("partial_id")->value($chosenpartial ? \Model\Pages\Partial::getDropdownOptions()[$chosenpartial] : null)->output();
        printAdminSubmitCancelRow();
        ?>
</form>