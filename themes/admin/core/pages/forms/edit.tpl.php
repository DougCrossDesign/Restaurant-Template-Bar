<?php
use Model\Adbanner;
use Model\AdbannerGroup;
use Model\AdbannerSize;
use Model\Forms\Form;
use Model\Popup;
use Model\User;

/** @var TemplateContainer $obj */

/** @var Form $form */
$form = $obj->form;

$button_label = $obj->button_label ?: "Submit";
$action_url = $obj->action_url;

InputErrors::printErrors();
?>

<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm form-col">
    <ul>
        <?php

            if(Auth::isSuperAdmin()) {
                if ($form->admin_key) {
                    $form->input("admin_key")->label("Admin Key (Note: Must be unique. Will be prepended with 'form-')")->value($form->admin_key)->disabled()->output();
                } else {
                    $form->input("admin_key")->label("Admin Key (Note: Must be unique. Will be prepended with 'form-')")->output();
                }
            }

            $form->input("name")->output();
            $form->input("emails")->label("")->type("textarea_raw")->output();
            $form->input("thankyou")->label("Thank you message")->type("textarea")->output();
            printAdminSubmitCancelRow();
        ?>
    </ul>
</form>

<?php insertInclude("log", $obj->log); ?>