<?php
/** @var TemplateContainer $obj */
use Model\Adbanner;
use Model\Banners\Banner;
use Model\Beer;
use Model\Blog\BlogCategory;
use Model\Blog\BlogPost;

/** @var BlogCategory[] $blogcategories */
$blogcategories = $obj->blogcategorys;

/** @var string $add_link */
$add_link = $obj->add_link;
?>
<?php echo $obj->pagination; ?>
<p class="floatr"><a href="/admin/blogposts" class="btn btm-margin">Manage Blog Posts</a></p>

<p><a href="<?php echo $add_link; ?>" class="btn btm-margin">Add New Category</a></p>

<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th><?php echo printAdminHeader("Name"); ?></th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($blogcategories) > 0) { ?>
        <?php
        /** @var BlogCategory $blogcategory */
        foreach ($blogcategories as $blogcategory) { ?>
            <tr>
                <td><?php echo $blogcategory->name; ?></td>
                <td>
                    <a href="/admin/blogcategories/edit/<?php echo $blogcategory->id; ?>" class="button">Edit</a>
                    <a href="/admin/blogcategories/delete/<?php echo $blogcategory->id; ?>" class="button">Delete</a>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                No categories present. <a href="<?php echo $add_link; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>


