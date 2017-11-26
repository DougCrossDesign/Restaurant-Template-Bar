<?php
/** @var TemplateContainer $obj */
use Model\Adbanner;
use Model\Banners\Banner;
use Model\Beer;
use Model\Blog\BlogPost;

/** @var BlogPost $blogposts */
$blogposts = $obj->blogposts;

/** @var string $add_link */
$add_link = $obj->add_link;
?>
<?php echo $obj->pagination; ?>
<p class="floatr"><a href="/admin/blogcategories" class="btn btm-margin">Manage Blog Categories</a></p>

<p><a href="<?php echo $add_link; ?>" class="btn btm-margin">Add New Post</a></p>

<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th><?php echo printAdminHeader("Title"); ?></th>
        <th>URL</th>
        <th><?php echo printAdminHeader("Date"); ?></th>
        <th>Tags</th>
        <th>Categories</th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($blogposts) > 0) { ?>
        <?php
        /** @var BlogPost $blogpost */
        foreach ($blogposts as $blogpost) { ?>
            <tr>
                <td><?php echo $blogpost->title; ?></td>
                <td><a href="<?php echo $blogpost->getFriendlyUrl(); ?>" target="_blank"><?php echo $blogpost->getFriendlyUrl(); ?></a> </td>
                <td><?php echo $blogpost->formatDate(); ?></td>
                <td><?php echo $blogpost->getTags(); ?></td>
                <td><?php echo $blogpost->getCategories(); ?></td>
                <td>
                    <a href="/admin/blogposts/edit/<?php echo $blogpost->id; ?>" class="button">Edit</a>
                    <a href="/admin/blogposts/delete/<?php echo $blogpost->id; ?>" class="button">Delete</a>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                No posts present. <a href="<?php echo $add_link; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>


