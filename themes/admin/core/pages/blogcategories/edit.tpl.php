<?php
use Model\Adbanner;
use Model\AdbannerGroup;
use Model\AdbannerSize;
use Model\Beer;
use Model\BeerGroup;
use Model\Blog\BlogCategory;
use Model\Blog\BlogPost;

/** @var TemplateContainer $obj */

/** @var BlogCategory $blogCategory */
$blogCategory = $obj->blogcategory;

$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>
<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm form-col">
    <ul>
        <?php
        $blogCategory->input("name")->output();
        printAdminSubmitCancelRow();
        ?>
    </ul>
</form>