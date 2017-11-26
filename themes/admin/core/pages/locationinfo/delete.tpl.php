<?php /** @var TemplateContainer $obj */ ?>

<div class="form_widget">
    <p>Are you sure you want to delete <span class="bold"><?php echo $obj->key; ?></span>?</p>
</div>

<div class="form_widget">
    <form method="post" action="<?php echo $obj->action; ?>">
        <input type="submit" name="delete" value="Delete" class="button" />
        <input type="submit" name="cancel" value="Cancel" class="button" />
    </form>
</div>