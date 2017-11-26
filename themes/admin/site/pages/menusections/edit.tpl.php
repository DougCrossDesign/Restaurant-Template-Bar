<?php
use Model\Menus\MenuItem;
use Model\Menus\MenuSection;

/** @var TemplateContainer $obj */

/** @var MenuSection $menusection */
$menusection = $obj->menusection;
$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>

<h1 class="btm-margin"><?php echo $obj->menuname; ?></h1>

<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm form-col">
    <input type="hidden" name="menu_id" value="<?php echo $obj->menuid; ?>">
    <ul>
        <?php
        $menusection->input("menu_id")->value($menusection->menu_id ?: $obj->menuid)->output();
        $menusection->input("title")->output();
        $menusection->input("service")->output();

        if($menusection->id){

            $menusection->inputChildren("items")->orderingManageable("menusections")->output();

        } else { ?>
            <li>
                Please create your menu section before adding items.
            </li>
        <?php }
        printAdminSubmitCancelRow(); ?>

    </ul>
</form>