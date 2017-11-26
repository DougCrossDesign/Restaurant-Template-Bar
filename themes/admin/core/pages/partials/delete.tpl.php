<?php /** @var TemplateContainer $obj */ ?>

<div class="form_widget">
    <?php if (!empty($obj->object_title)) { ?>
        <p>Are you sure you want to delete <span class="bold"><?php echo $obj->object_title; ?></span>?</p>
    <?php } elseif (!empty($obj->object_image)) { ?>
        <p>Are you sure you want to delete this image?</p>
        <img src="/assets/images/pages/thumb/<?php echo $obj->object_image; ?>" />
    <?php } elseif (!empty($obj->object_filename)) { ?>
        <p>Are you sure you want to delete the file <span class="bold"><?php echo $obj->object_filename; ?></span>?</p>
    <?php } else { ?>
        <p>Are you sure you want to delete this object?</p>
    <?php } ?>
</div>

<form method="post" action="<?php echo $obj->action; ?>">
    <div class="form_widget">
        <input type="submit" name="delete" value="Delete" class="button" />
        <input type="submit" name="cancel" value="Cancel" class="button" />
    </div>
</form>