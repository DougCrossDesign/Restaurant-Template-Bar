<?php
/** @var \Model\PartialModel $partial */
$partial = $obj->partial;
?>

<div>
    <?php if(Auth::isSuperAdmin()){ ?>
        <a class="btn floatr" href="/admin/partials/advanced/<?php echo $obj->pageid . '/' . $obj->pivotid; ?>"><i class="aycicon-gear"></i> Advanced Settings</a>
    <?php } ?>
    <?php if($partial->schema()->hasMetaDisplayOrder()){ ?>
        <a class="btn floatr" href="/admin/partials/ordering/<?php echo $obj->pageid . '/' . $obj->pivotid; ?>"><i class="aycicon-hamburger"></i> Manage Ordering</a>
    <?php } ?>
    <h1>Edit Section <?php echo $partial->schema()->getName(); ?></h1>
    <?php InputErrors::printErrors(); ?>
    <form method="post" enctype="multipart/form-data">
        <?php echo $obj->body; ?>
        <div>
            <input type="submit" name="submit" value="Save" />
            <input type="submit" name="cancel" value="Cancel" />
        </div>
    </form>
</div>

<?php insertInclude("log", $obj->log); ?>