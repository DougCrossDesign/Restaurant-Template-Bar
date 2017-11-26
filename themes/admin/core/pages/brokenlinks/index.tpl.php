<?php
/** @var TemplateContainer $obj */
use Model\BrokenLink;
use Model\Metadata;

/** @var BrokenLink[] $brokenlinks */
$brokenlinks = $obj->brokenlinks;
/** @var string $add_link */
$add_link = $obj->add_link;
?>
<?php echo $obj->pagination; ?>

<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th><?php printAdminHeader("URL", 'url'); ?></th>
        <th><?php printAdminHeader("First Occurance", 'first_instance'); ?></th>
        <th><?php printAdminHeader("Last Occurance", 'last_instance'); ?></th>
        <th><?php printAdminHeader("Number of Occurances", 'number'); ?></th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($brokenlinks) > 0) { ?>
        <?php
        foreach ($brokenlinks as $brokenlink) { ?>
            <tr>
                <td><a href="<?php echo $brokenlink->url; ?>" target="_blank"><?php echo $brokenlink->url; ?></a></td>
                <td><?php echo date("m/d/y @ g:i:s", $brokenlink->first_instance); ?></td>
                <td><?php echo date("m/d/y @ g:i:s", $brokenlink->last_instance); ?></td>
                <td><?php echo $brokenlink->number; ?></td>
                <td>
                    <a href="/admin/brokenlinks/delete/<?php echo $brokenlink->id; ?>" class="button">Delete</a>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                No broken links found.
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>


