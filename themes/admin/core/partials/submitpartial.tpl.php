<div>
    <h1>Edit Section</h1>
    <form method="post" enctype="multipart/form-data">
        <?php echo $obj->body; ?>
        <div>
            <input type="submit" name="submit" value="Save" />
            <input type="submit" name="cancel" value="Cancel" />
        </div>
    </form>
</div>