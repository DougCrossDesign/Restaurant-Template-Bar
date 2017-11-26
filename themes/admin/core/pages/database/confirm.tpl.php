<?php /** @var TemplateContainer $obj */ ?>
<div class="form_widget">
    <p>Are you sure you want to run this script? This script may cause loss of data.</p>

    <p><code><?php echo $obj->script; ?></code></p>
</div>

<div class="form_widget">
    <form method="post" action="<?php echo $obj->action; ?>">
        <input type="hidden" name="partial" value="<?php echo $obj->partial ?: ""; ?>" />
        <input type="hidden" name="model" value="<?php echo $obj->model ?: ""; ?>" />
        <input type="submit" name="run" value="Run Script" class="button" />
        <input type="submit" name="cancel" value="Cancel" class="button" />
    </form>
</div>