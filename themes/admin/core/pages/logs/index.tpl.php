<?php
/** @var TemplateContainer $obj */

/** @var BaseModel[] $models */
$models = $obj->models;

/** @var string $controllerName */
$controllerName = $obj->controllerName;

/** @var string $nameIndex */
$nameIndex = $obj->nameIndex;

$modelNameSingular = $obj->modelNameSingular;
$modelNamePlural = $obj->modelNamePlural;

?>

<?php if(Auth::isSuperAdmin()){ ?>
    <p>
        <a href="/admin/logs/export" class="btn btm-margin">Export Data</a>
        <a href="/admin/scripts/confirm?script=/inc/core/crons/clearuserlog.php" class="btn btm-margin floatr">Clear Logs</a>
    </p>
<?php } ?>

<?php echo $obj->pagination; ?>

    <table cellspacing="0" cellpadding="0" class="datagrid">

        <thead>
        <tr>
            <th>
                <?php printAdminHeader("Date", "created_at"); ?>
            </th>
            <th>
                <?php printAdminHeader("User", "user_id"); ?>
            </th>
            <th>
                <?php printAdminHeader("IP Address", "ipaddress"); ?>
            </th>
            <th>
                <?php printAdminHeader("URL", "url"); ?>
            </th>
            <th>
                <?php printAdminHeader("Action", "actiontype"); ?>
            </th>
            <th>
                <?php printAdminHeader("Message", "action"); ?>
            </th>
            <th>
                Changes
            </th>
        </tr>
        </thead>
        <tbody>
        <?php if (count($models)) {
            /** @var \Model\UserAction $log */
            foreach ($models as $log) { ?>
                <tr>
                    <td>
                        <?php echo $log->created_at; ?>
                    </td>
                    <td>
                        <?php echo $log->user->username; ?> (<?php echo $log->user->id; ?>)
                    </td>
                    <td>
                        <?php echo $log->ipaddress; ?>
                    </td>
                    <td>
                        <?php echo $log->url; ?>
                    </td>
                    <td>
                        <?php echo $log->actiontype; ?>
                    </td>
                    <td>
                        <?php echo $log->action; ?>
                    </td>
                    <td>
                        <?php
                        /** @var \Model\UserActionChange $change */
                        foreach ($log->changes()->get() as $change) { ?>
                            <strong><?php echo $change->attribute; ?>:</strong> <span
                                class="old"><?php echo strip_tags($change->old); ?></span> => <span
                                class="new"><?php echo strip_tags($change->new); ?></span> <br/>

                        <?php } ?>
                    </td>
                </tr>
            <?php }
        } else { ?>
            <tr>
                <td>No action history.</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>


    <style>
        span.old {
            background-color: #ffe6e6;
        }

        span.new {
            background-color: #ebfaeb;
        }
    </style>
<?php echo $obj->pagination; ?>


