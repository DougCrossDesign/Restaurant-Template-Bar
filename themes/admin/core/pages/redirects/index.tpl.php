<?php
/** @var TemplateContainer $obj */
use Model\Redirect;

/** @var Redirect[] $redirects */
$redirects = $obj->redirects;
/** @var string $add_link */
$add_link = $obj->add_link;
?>
<?php echo $obj->pagination; ?>

<p><a href="<?php echo $add_link; ?>" class="btn btm-margin">Add New Redirect</a></p>

<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th><?php printAdminHeader("URL"); ?></th>
        <th><?php printAdminHeader("Destination"); ?></th>
        <th><?php printAdminHeader("Permanent"); ?></th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($redirects) > 0) { ?>
        <?php
        /** @var Redirect $redirect */
        foreach ($redirects as $redirect) { ?>
            <tr>
                <td><a href="<?php echo $redirect->url; ?>" target="_blank"><?php echo $redirect->url; ?></a></td>
                <td><a href="<?php echo $redirect->destination; ?>" target="_blank"><?php echo $redirect->destination; ?></a></td>
                <td><?php echo $redirect->permanent ? '&#x2713;' : 'x'; ?></td>
                <td>
                    <a href="/admin/redirects/edit/<?php echo $redirect->id; ?>" class="button">Edit</a>
                    <a href="/admin/redirects/delete/<?php echo $redirect->id; ?>" class="button">Delete</a>
                </td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="4">
                No redirects present. <a href="<?php echo $add_link; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>


