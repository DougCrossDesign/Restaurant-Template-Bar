<?php
/** @var TemplateContainer $obj */
use Model\Adbanner;
use Model\Banners\Banner;
use Model\Forms\Form;
use Model\Forms\FormField;
use Model\Popup;

/** @var FormField[] $fields */
$fields = $obj->fields;
/** @var string $add_link */
$add_link = $obj->add_link;

/** @var Form $form */
$form = $obj->form;
?>
<?php echo $obj->pagination; ?>

<p>
    <a href="/admin/forms" class="btn btm-margin">< Back to Forms</a>
    <?php if(!$form->locked){ ?>
        <a href="<?php echo $add_link; ?>" class="btn btm-margin">Add New Field</a></p>
    <?php } ?>

<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th><?php echo printAdminHeader("Name"); ?></th>
        <?php if (Auth::isSuperAdmin()) { ?>
            <th>Admin Form Name</th>
        <?php } ?>
        <th>Type</th>
        <th>Order</th>
        <th>Required</th>
        <th>Show on Results Page</th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($fields) > 0) { ?>
        <?php
        /** @var FormField $field */
        foreach ($fields as $field) { ?>
            <tr>
                <td><?php echo $field->name; ?></td>
                <?php if (Auth::isSuperAdmin()) { ?>
                    <td><?php echo "form_" . str_replace(" ", "_", $field->name); ?></td>
                <?php } ?>
                <td><?php echo $field->type; ?></td>
                <td>
                    <form action="/admin/formfields/order/<?php echo $field->id; ?>">
                        <input type="hidden" name="formid" value="<?php echo $field->formid; ?>" />
                        <select style="padding: 0 10px; height: 20px;" onchange="javascript: this.form.submit();" name="order">
                            <?php for($i = 1; $i <= count($fields); $i++){
                                echo '<option '. ($field->displayorder == $i ? ' selected="selected" ' : '') .' value="'. $i .'">'. $i .'</option>';
                            } ?>
                        </select>
                    </form>
                </td>
                <td><?php echo $field->required ? "Yes" : ""; ?></td>
                <td><?php echo $field->showOnResults ? "Yes" : ""; ?></td>
                <td>
                    <?php if(!$form->locked){ ?>
                        <a href="/admin/formfields/edit/<?php echo $field->id; ?>" class="button">Edit</a>
                        <a href="/admin/formfields/delete/<?php echo $field->id; ?>" class="button">Delete</a>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                No fields present. <a href="<?php echo $add_link; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>


