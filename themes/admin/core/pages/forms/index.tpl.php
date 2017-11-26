<?php
/** @var TemplateContainer $obj */
use Model\Adbanner;
use Model\Banners\Banner;
use Model\Forms\Form;
use Model\Popup;
use Model\User;
use Module\FormsModule;

/** @var Form[] $forms */
$forms = $obj->forms;
/** @var string $add_link */
$add_link = $obj->add_link;
?>
<?php echo $obj->pagination; ?>
<?php if(Auth::isSuperAdmin()){ ?><p><a href="<?php echo $add_link; ?>" class="btn btm-margin">Add New Form</a></p><?php } ?>

<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <?php if(Auth::isSuperAdmin()){ ?><th><?php printAdminHeader("Admin Key", "admin_key"); ?></th><?php } ?>
        <th><?php printAdminHeader("Name"); ?></th>
        <th><?php printAdminHeader("Emails"); ?></th>
        <th>Fields</th>
        <th>Results</th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($forms) > 0) { ?>
        <?php
        /** @var Form $form */
        foreach ($forms as $form) { ?>
            <tr>
                <?php if(Auth::isSuperAdmin()){ ?><td><?php echo $form->admin_key; ?></td><?php } ?>
                <td><?php if($form->locked) echo '<i class="fa fa-lock"></i> '; ?><?php echo $form->name; ?></td>
                <td><?php echo $form->emails; ?></td>
                <td><a href="/admin/formfields/view/<?php echo $form->id; ?>">Manage Form Fields <?php echo $form->fields()->count() ? '(' . $form->fields()->count() . ')' : ''; ?></a></td>
                <td><a href="/admin/formresults/view/<?php echo $form->id; ?>">Results <?php echo $form->results()->count() ? '(' . $form->results()->count() . ')' : ''; ?></a></td>
                <td>
                    <?php if(!FormsModule::formLockingEnabled() || (FormsModule::formLockingEnabled() && !$form->locked)){ ?>
                        <a href="/admin/forms/edit/<?php echo $form->id; ?>" class="button">Edit</a>
                        <a href="/admin/forms/delete/<?php echo $form->id; ?>" class="button">Delete</a>
                    <?php } ?>
                    <?php if(FormsModule::formLockingEnabled() && in_array(Auth::getUserLevel(), FormsModule::formLockingEditableByLevels())){
                        if($form->locked){ ?>
                            <a href="/admin/forms/lock/<?php echo $form->id; ?>" class="button"><i class="fa fa-unlock"></i> Unlock</a>
                        <?php } else { ?>
                            <a href="/admin/forms/lock/<?php echo $form->id; ?>" class="button"><i class="fa fa-lock"></i> Lock</a>
                        <?php } ?>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                No forms present. <a href="<?php echo $add_link; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>


