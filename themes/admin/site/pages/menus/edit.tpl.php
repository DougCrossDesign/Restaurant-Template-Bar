<?php
use Model\Adbanner;
use Model\AdbannerGroup;
use Model\AdbannerSize;
use Model\Employee;
use Model\Forms\Form;
use Model\Menu;
use Model\Popup;

/** @var TemplateContainer $obj */

/** @var Menu $menu */
$menu = $obj->menu;

$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>

<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm form-col">
    <ul>
        <?php
        $menu->input("title")->output();
        $menu->input("text")->output();
        $menu->input("service")->output();
        $menu->input("pdf")->output();
        $menu->input("label")->output();
        $menu->input("bottom")->output();
        printAdminSubmitCancelRow();
        ?>
    </ul>
</form>