<?php
use Model\FriendlyUrl;
use Model\Metadata;
use Model\Redirect;
use Model\Siteinfo;

/** @var TemplateContainer $obj */

/** @var \Model\Search\SearchModel $searchmodel */
$searchmodel = $obj->searchmodel;

$chosenmodel = $obj->chosenModel;

$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>

<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm form-col">
        <?php
        $searchmodel->input("name")->options(array_values(Util::getInstalledModels()))->value($chosenmodel ?: null)->output();
        printAdminSubmitCancelRow();
        ?>
</form>