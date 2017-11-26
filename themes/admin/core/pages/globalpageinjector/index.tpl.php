<?php
/** @var TemplateContainer $obj */
use Model\EmailAddress;
use Model\EmailList;
use Model\GlobalPageInjection;
use Model\Jobposition;
use Model\Metadata;
use Model\Redirect;
use Model\Siteinfo;

/** @var GlobalPageInjection[] $injectors */
$injectors = $obj->globalpageinjections;

/** @var string $add_link */
$add_link = $obj->add_link;
?>
<?php echo $obj->pagination; ?>

<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th><?php printAdminHeader("Name"); ?></th>
        <th>Controls</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (count($injectors) > 0) { ?>
        <?php
        /** @var GlobalPageInjection $injector */
        foreach ($injectors as $injector) { ?>
            <tr>
                <td><?php echo $injector->name; ?></td>
                <td>
                    <a href="/admin/globalpageinjector/edit/<?php echo $injector->id; ?>" class="button">Edit</a>
                </td>
            </tr>
        <?php } ?>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>


