<?php
use Model\Adbanner;
use Model\AdbannerGroup;
use Model\AdbannerSize;
use Model\Forms\Form;
use Model\Forms\FormField;
use Model\Forms\FormResult;
use Model\Popup;

/** @var TemplateContainer $obj */

/** @var FormResult $result */
$result = $obj->result;

/** @var Form $form */
$form = $obj->form;

$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>

<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm form-col">
    <ul>
        <?php
        $form->input("formid")->type("hidden")->value($form->id)->output();
        if($result) $result->input("resultid")->type("hidden")->value($result->id)->output();
        $form->render($result);
            printAdminSubmitCancelRow();
        ?>
    </ul>
</form>