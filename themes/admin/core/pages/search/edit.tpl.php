<?php
use Model\FriendlyUrl;
use Model\Metadata;
use Model\Redirect;
use Model\Siteinfo;

/** @var TemplateContainer $obj */

/** @var \Model\Search\SearchModel $searchmodel */
$searchmodel = $obj->searchmodel;

// If a model is set, get its attributes
if ($searchmodel->name) {
        /** @var BaseModel $chosenmodel */
        $chosenmodel = $searchmodel->name;
        $modelattributes = $chosenmodel::getAllAttributes();
}
$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>

<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm form-col">
        <?php
        $searchmodel->input("name")->type("text")->disabled()->output();
        $searchmodel->input("image_path")->placeholder("/assets/images/")->label('Image Path, if indexing images. This is usually in the format of /assets/images/$controllername/searchdetails/')->output();

        $searchmodel->inputChildren("mappings")->options(["attribute" => $chosenmodel::getAllAttributes(), "column" => Util::getSearchIndexColumns()])->order("column")->output();
        printAdminSubmitCancelRow();
        ?>
</form>