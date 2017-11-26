<?php /** @var TemplateContainer $obj */ ?>
<style type="text/css">
.warning {
    font-weight:bold;
    color: red;
}
</style>
<div class="form_widget">
    <p><b>Are you sure you want to delete this partial: <?php echo $obj->partial->name; ?>?</b></p>
    <p>This will delete all associated data from the database.</p>
    <?php if($obj->partial_is_used){ ?>
        <p>
            <span class="warning"> WARNING: This partial is currently being used on <?php echo $obj->partial->pages()->count(); ?> pages:</span>
            <ul>
                <?php foreach($obj->partial->pages as $page){ ?>
                    <li><?php echo $page->title; ?></li>
                <?php } ?>
            </ul>
            <span class="warning">
                By deleting this partial, any instance of this partial will be deleted from each page above.<br />
                If references to this partial have not been removed from Templates, you will see errors and may break the pages above or more.
            </span>
        </p>
    <?php } ?>
</div>

<form method="post" action="<?php echo $obj->action; ?>">
    <div class="form_widget">
        <input type="submit" name="delete" value="Delete" class="button" />
        <input type="submit" name="cancel" value="Cancel" class="button" />
    </div>
</form>