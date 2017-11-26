<?php
// Only show change log if a super admin is logged in
if (Auth::isSuperAdmin()) {?>
<hr class="btm-margin" />
<li class="col">
    <h2 class="admin-header">Change Log</h2>
</li>
<table cellspacing="0" cellpadding="0" class="datagrid">
    <thead>
    <tr>
        <th>
            Date
        </th>
        <th>
            User
        </th>
        <th>
            Action
        </th>
        <th>
            URL
        </th>
        <th>
            Message
        </th>
        <th>
            Changes
        </th>
    </tr>
    </thead>
    <tbody>
    <?php if (count($obj)) {
        /** @var \Model\UserAction $log */
        foreach ($obj as $log) { ?>
            <tr>
                <td>
                    <?php echo $log->created_at; ?>
                </td>
                <td>
                    <?php echo $log->user->username; ?> (<?php echo $log->user->id; ?>)
                </td>
                <td>
                    <?php echo $log->actiontype; ?>
                </td>
                <td>
                    <?php echo $log->url; ?>
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
            <td colspan="6">No action history.</td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php } ?>

<style>
    span.old {
        background-color: #ffe6e6;
    }

    span.new {
        background-color: #ebfaeb;
    }
</style>
