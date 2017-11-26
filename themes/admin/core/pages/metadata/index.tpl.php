<?php
/** @var TemplateContainer $obj */
use Model\Metadata;
use Model\Redirect;

/** @var Redirect[] $redirects */
$metadatas = $obj->metadatas;
/** @var string $add_link */
$add_link = $obj->add_link;
?>
<?php echo $obj->pagination; ?>

<p><a href="<?php echo $add_link; ?>" class="btn btm-margin">Add New Metadata</a></p>

<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th><?php printAdminHeader("URL"); ?></th>
        <th><?php printAdminHeader("Title"); ?></th>
        <th><?php printAdminHeader("Keywords"); ?></th>
        <th><?php printAdminHeader("Description"); ?></th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($metadatas) > 0) { ?>
        <?php
        /** @var Metadata $metadata */
        foreach ($metadatas as $metadata) { ?>
            <tr>
                <td><a href="<?php echo $metadata->url; ?>" target="_blank"><?php echo $metadata->url; ?></a></td>
                <td><?php echo $metadata->title; ?></td>
                <td><?php echo $metadata->keywords; ?></td>
                <td><?php echo $metadata->description; ?></td>
                <td>
                    <a href="/admin/metadata/edit/<?php echo $metadata->id; ?>" class="button">Edit</a>
                    <a href="/admin/metadata/delete/<?php echo $metadata->id; ?>" class="button">Delete</a>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="5">
                No metadata present. <a href="<?php echo $add_link; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>


