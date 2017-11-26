<?php
/** @var TemplateContainer $obj */
use Model\Pages\Page;
use Model\Pages\Partial;

$form_action = $obj->action_url;

/** @var Partial $partial */
$partial = $obj->partial;
$data = $partial->getData();
$partialModel = $partial->getPartialModel();
$pivot = $partial->pivot;
?>
<form action="<?php echo $form_action; ?>" method="POST" enctype="multipart/form-data">

    <p>If either the Partial Classes or HTML ID exist, the partial will be wrapped in a DIV containing those classes and/or ID.</p>

    <ul>
        <li>
            <label>Template to use:</label>
            <select name="template">
                <?php
                /** @var string $template */
                foreach($partial->getTemplates() as $template){ ?>
                    <option value="<?php echo $template; ?>" <?php if($template == $pivot->template) echo ' selected="selected" '; ?>><?php echo ucfirst($template); ?></option>
                <?php }; ?>
            </select>
        </li>
        <li>
            <label>Partial Class(es):<br />(these classes will go on the div that wraps the partial)</label>
            <input type="text" name="class" value="<?php echo $pivot->class; ?>" />
        </li>
        <li>
            <label>HTML ID:<br />(this ID will go on the div that wraps the partial)</label>
            <input type="text" name="html_id" value="<?php echo $pivot->html_id; ?>" />
        </li>
        <li>
            <label>Init Stack Javascript:<br />(will be inserted right after the partial inside of a SCRIPT tag)</label>
            <textarea name="init_stack"><?php echo $pivot->init_stack; ?></textarea>
        </li>
        <?php printAdminSubmitCancelRow(); ?>

    </ul>

</form>