<?php /** @var TemplateContainer $obj */ ?>
<div class="form_widget">
    <p>Are you sure you want to run <span class="bold"><?php echo $obj->script; ?></span>? This script may cause loss of data.</p>
</div>

<div class="form_widget">
    <form method="post" action="<?php echo $obj->action; ?>">
        <input type="hidden" name="script" value="<?php echo $obj->script; ?>" />
        <input type="submit" name="run" value="Run Script" class="button" />
        <input type="submit" name="cancel" value="Cancel" class="button" />
    </form>
</div>