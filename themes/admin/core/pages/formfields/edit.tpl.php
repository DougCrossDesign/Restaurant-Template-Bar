<?php
use Model\Adbanner;
use Model\AdbannerGroup;
use Model\AdbannerSize;
use Model\Forms\Form;
use Model\Forms\FormField;
use Model\Popup;

/** @var TemplateContainer $obj */

/** @var FormField $formfield */
$formfield = $obj->formfield;
/** @var Form $form */
$form = $obj->form;

$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>

<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm form-col">
    <ul>
        <?php
        $formfield->input("formid")->type("hidden")->value($form->id)->output();
        $formfield->input("name")->output();
        $formfield->input("type")->type(IB_SELECT)->options(InputBuilder::getInputBuilderTypes())->value(strlen($formfield->type) ? $formfield->type : "text")->output();
        $formfield->input("required")->output();
        $formfield->input("showOnResults")->output();
            printAdminSubmitCancelRow();
        ?>
    </ul>
</form>