<?php
use Model\Pages\Page;
use Model\User;

/** @var TemplateContainer $obj */

/** @var string $add_link */
$add_link = $obj->add_link;
/** @var Page[] $pages */
$pages = $obj->pages;
?>
<?php echo $obj->pagination; ?>

<?php if(Auth::isSuperAdmin()){ ?>
<p>
    <a href="<?php echo $add_link; ?>" class="btn btm-margin">Add New Page</a>
    <a href="/admin/scripts/cleanurls.php" class="btn btm-margin floatr">Clean up Friendly URLs</a>
</p>
<?php } ?>

<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <?php if(Auth::isSuperAdmin()){ ?><th><?php printAdminHeader("Admin Key", "admin_key"); ?></th><?php } ?>
        <th><?php printAdminHeader("Title"); ?></th>
        <th>URL</th>
        <th>In Sitemap</th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php if (count($pages) > 0) { ?>
        <?php
        /** @var Page $page */
        foreach ($pages as $page) { ?>
            <tr>
                <?php if(Auth::isSuperAdmin()){ ?><td><?php echo $page->admin_key; ?></td><?php } ?>
                <td><?php echo $page->title; ?></td>
                <td><a href="<?php echo $page->getFriendlyUrl(); ?>" target="_blank"><?php echo $page->getFriendlyUrl(); ?></a></td>
                <td><?php echo $page->in_sitemap ? "Yes" : "No"; ?></td>
                <td>
                    <?php if($page->accessibleByCurrentUser()){ ?>
                        <a href="/admin/pages/edit/<?php echo $page->id; ?>" class="button">Edit</a>
                        <a href="/admin/pages/delete/<?php echo $page->id; ?>" class="button">Delete</a>
                        <?php if ($page->supportsMultilingual() && $page->translations()->count()) { ?>
                            <a href="/admin/pages/translations/<?php echo $page->id; ?>" class="button">Manage Translations</a>
                        <?php } ?>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="4">
                No pages present. <a href="<?php echo $add_link; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>


