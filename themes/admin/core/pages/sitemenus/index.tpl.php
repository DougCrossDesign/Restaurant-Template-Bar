<?php
/** @var TemplateContainer $obj */
use Model\Sitemenu;

/** @var Sitemenu\Sitemenu[] $sitemenus */
$sitemenus = $obj->sitemenus;
/** @var string $add_link */
$add_link = $obj->add_link;
?>
<?php echo $obj->pagination; ?>

    <p><a href="/admin/sitemenus/add" class="btn btm-margin">Add New Site Menu</a></p>

    <table cellspacing="0" cellpadding="0" class="datagrid">
        <thead>
        <tr>
            <?php if (Auth::isSuperAdmin()) { ?><th><?php printAdminHeader("Admin Key", "admin_key"); ?></th><?php } ?>
            <th><?php printAdminHeader("Name", "name"); ?></th>
            <th>Description</th>
            <th>Sitemenu Items</th>
            <th>Controls</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (count($sitemenus) > 0) { ?>
            <?php
            /** @var Sitemenu\ $sitemenu */
            foreach ($sitemenus as $sitemenu) { ?>
                <tr>
                <?php if (Auth::isSuperAdmin()) { ?><td><?php echo $sitemenu->admin_key; ?></td><?php } ?>
                    <td><?php echo $sitemenu->name; ?></td>
                    <td><?php echo $sitemenu->description; ?></td>
                    <td>
                        <a href="/admin/sitemenuitems/index/<?php echo $sitemenu->id; ?>" class="button">Manage Sitemenu Items (<?php echo $sitemenu->items()->translate()->count(); ?>)</a>
                    </td>
                    <td>
                        <a href="/admin/sitemenus/edit/<?php echo $sitemenu->id; ?>" class="button">Edit</a>
                        <a href="/admin/sitemenus/delete/<?php echo $sitemenu->id; ?>" class="button">Delete</a>
                        <?php if ($sitemenu->supportsMultilingual()) { ?>
                            <a href="/admin/sitemenus/translations/<?php echo $sitemenu->id; ?>" class="button">Manage Translations (<?php echo $sitemenu->translations()->count(); ?>)</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="5">
                    No sitemenus present. <a href="/admin/sitemenus/add">Click here to add one.</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php echo $obj->pagination; ?>