<?php

/** @var TemplateContainer $obj */

/** @var BaseModel $model */
$model = $obj->model;
if (is_null($model)) {
    Error::exception( new Exception("The model doesn't exist!"));
}

$action_url = $obj->action_url;

InputErrors::printErrors();
?>

<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm form-col">
    <ul>
        <?php

        // If the model has an attribute that requires a dropdown menu, this can't be used as we need to set the options
        foreach($model::getAllAttributes() as $attribute_key => $attribute_value) {
            $model->input($attribute_key)->output();
        }

        printAdminSubmitCancelRow();
        ?>
    </ul>
</form>
