<?php

/** @var TemplateContainer $obj */
use Model\Pages\Partial;
use Model\User;

/** @var BaseModel $model */
$translation = $obj->translation;

$original = $obj->original;

$action_url = $obj->action_url;

InputErrors::printErrors();
?>
<form action="<?php echo $action_url; ?>" method="POST" enctype="multipart/form-data" class="modifyorm form-col">
    <ul>
        <?php
        // Get the id
        $translation->input("id")->type("hidden")->output();
        $translation->input("language_id")->type("select")->options(\Model\Translate\Language::getDropdownOptions())->value($translation->language_id)->label("Language")->output();
        ?>

        <div class="form_row col1-2 col">
            URL: <?php echo $translation->getFriendlyUrl(); ?>
        </div>
        <div class="form_row col1-2 col">
            URL: <?php echo $original->getFriendlyUrl(); ?>
        </div>

        <?php
        // If the model has an attribute that requires a dropdown menu, this can't be used as we need to set the options
        foreach($translation::getAllAttributes() as $attribute_key => $attribute_value) {
            if ($translation->isTranslatableAttribute($attribute_key)) { ?>
            <div class="form_row col1-2 col">
                <?php $translation->input($attribute_key)->output(); ?>
            </div>
            <div class="form_row col1-2 col">
                <?php $translation
                    ->input($attribute_key)
                    ->value($original->$attribute_key)
                    ->disabled()
                    ->label(\Model\Translate\Language::getDefaultLanguage()->name . ": " . ucwords($attribute_key))
                    ->output(); ?>
            </div>
        <?php }
        } ?>
        <hr class="btm-margin" />
        <h2>Partials</h2>
        <div class="form_row col1-2 col">
            <table cellspacing="0" cellpadding="0" class="datagrid">
                <thead>
                <tr>
                    <?php if (Auth::getUserLevel() == User::TYPE_AYC_ADMIN) {?>
                        <th>
                            ID
                        </th>
                        <th>
                            Admin Key
                        </th>
                    <?php } ?>
                    <th>
                        Partial Name
                    </th>
                    <th>
                        Partial Type
                    </th>
                    <th>
                        Controls
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php if ($translation->partials()->orderBy("order")->count()) { ?>
                    <?php foreach($translation->partials()->orderBy("order")->get() as $partial) {
                        /** @var \Model\Partial\PartialModel $partialModel */
                        $partialModel = $partial->model(); ?>
                        <tr>
                            <?php if (Auth::getUserLevel() == User::TYPE_AYC_ADMIN) {?>
                            <td>
                                <?php echo $partialModel->data->id; ?>
                            </td>
                            <td>
                                <?php echo $partialModel->data->admin_key; ?>
                                <?php } ?>
                            </td>
                            <td>
                                <?php echo $partialModel->data->title; ?>
                            </td>
                            <td>
                                <?php echo $partialModel->partial->name; ?>
                            </td>
                            <td>
                                <?php if(Auth::isSuperAdmin() || in_array($partial->pivot->permission, [Partial::PERMISSION_ALL, Partial::PERMISSION_EDIT_ONLY])) { ?>
                                    <a class="button" href="/admin/partials/edit/<?php echo $partialModel->data->pageid; ?>?pivotid=<?php echo $partialModel->data->id; ?>">Edit</a>
                                <?php } ?>
                                <?php if(Auth::isSuperAdmin() ||in_array($partial->pivot->permission, [Partial::PERMISSION_ALL, Partial::PERMISSION_ORDER_ONLY])){ ?>
                                    <a class="button" href="/admin/partials/delete/<?php echo $partialModel->data->pageid; ?>?pivotid=<?php echo $partialModel->data->id; ?>">Delete</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="7">No partials exist on this page.</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="form_row col1-2 col">
            <table cellspacing="0" cellpadding="0" class="datagrid">
                <thead>
                <tr>
                    <?php if (Auth::getUserLevel() == User::TYPE_AYC_ADMIN) {?>
                        <th>
                            ID
                        </th>
                        <th>
                            Admin Key
                        </th>
                    <?php } ?>
                    <th>
                        Partial Name
                    </th>
                    <th>
                        Partial Type
                    </th>
                    <th>
                        Controls
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php if ($original->partials()->orderBy("order")->count()) { ?>
                    <?php foreach($original->partials()->orderBy("order")->get() as $partial) {
                        /** @var \Model\Partial\PartialModel $partialModel */
                        $partialModel = $partial->model(); ?>
                        <tr>
                            <?php if (Auth::getUserLevel() == User::TYPE_AYC_ADMIN) {?>
                            <td>
                                <?php echo $partialModel->data->id; ?>
                            </td>
                            <td>
                                <?php echo $partialModel->data->admin_key; ?>
                                <?php } ?>
                            </td>
                            <td>
                                <?php echo $partialModel->data->title; ?>
                            </td>
                            <td>
                                <?php echo $partialModel->partial->name; ?>
                            </td>
                            <td>
                                <?php if(Auth::isSuperAdmin() || in_array($partial->pivot->permission, [Partial::PERMISSION_ALL, Partial::PERMISSION_EDIT_ONLY])) { ?>
                                    <a class="button" href="/admin/partials/edit/<?php echo $partialModel->data->pageid; ?>?pivotid=<?php echo $partialModel->data->id; ?>">Edit</a>
                                <?php } ?>
                                <?php if(Auth::isSuperAdmin() ||in_array($partial->pivot->permission, [Partial::PERMISSION_ALL, Partial::PERMISSION_ORDER_ONLY])){ ?>
                                    <a class="button" href="/admin/partials/delete/<?php echo $partialModel->data->pageid; ?>?pivotid=<?php echo $partialModel->data->id; ?>">Delete</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="7">No partials exist on this page.</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

        <?php
        printAdminSubmitCancelRow();
        ?>
    </ul>
</form>


<?php insertInclude("log", $obj->log); ?>