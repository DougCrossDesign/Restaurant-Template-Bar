<?php
/** @var TemplateContainer $obj */
use Model\Adbanner;
use Model\Banners\Banner;
use Model\Forms\Form;
use Model\Forms\FormField;
use Model\Forms\FormResult;
use Model\Popup;

/** @var FormResult[] $results */
$results = $obj->results;
/** @var Form $form */
$form = $obj->form;
/** @var string $add_link */
$add_link = $obj->add_link;
?>

<?php echo $obj->pagination; ?>

<p>
    <?php if ( Auth::isSuperAdmin() ) { ?>
        <a class="floatr btn" href="/admin/formresults/exportcsv/<?php echo $form->id; ?>"><i class="fa fa-download"></i> Export to CSV</a>
    <?php } ?>
    <a href="/admin/forms" class="btn btm-margin">< Back to Forms</a>
    <a href="<?php echo $add_link; ?>" class="btn btm-margin">Add New Result</a>
</p>
<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th><?php echo printAdminHeader("Date", "created_at"); ?></th>
        <?php
        /** @var FormField $field */
        foreach($form->getFields() as $field){ ?>
            <th><?php echo printAdminHeader($field->name, $field->name); ?></th>
        <?php } ?>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($results) > 0) { ?>
        <?php
        /** @var FormResult $result */
        foreach ($results as $result) { ?>
            <tr>
                <td><?php echo $result->formatDate("created_at", false); ?></td>
                <?php
                /** @var FormField $field */
                foreach($form->getFields() as $field){ ?>
                    <td><?php echo $result->renderValueByFieldId($field->id); ?></td>
                <?php } ?>
                <td>
                    <a href="/admin/formresults/edit/<?php echo $result->id; ?>" class="button">Edit</a>
                    <a href="/admin/formresults/delete/<?php echo $result->id; ?>" class="button">Delete</a>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                No results present. <a href="<?php echo $add_link; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>


