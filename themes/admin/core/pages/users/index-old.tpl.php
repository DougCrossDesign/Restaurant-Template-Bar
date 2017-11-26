<?php /** @var TemplateContainer $obj */ ?>

<h1>Users</h1>
<?php echo $obj->pagination; ?>

<p><a href="<?php echo $obj->add_link; ?>" class="button">Add New User</a></p>

<table cellspacing="0" cellpadding="0" class="datalist">
    <thead>
        <tr>
            <th><?php printAdminHeader("Username"); ?></th>
            <th><?php printAdminHeader("Email"); ?></th>
            <th><?php printAdminHeader("Name", "fullname"); ?></th>
            <th>Controls</th>
        </tr>
    </thead>
    <tbody>
    <?php if (count($obj->users) > 0) { ?>
        <?php foreach ($obj->users as $user) { ?>
        <tr>
            <td><?php echo $user['username']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td><?php echo $user['fullname']; ?></td>
            <td>
                <a href="/admin/users/edit/<?php echo $user['id']; ?>" class="button">Edit</a>
                <a href="/admin/users/delete/<?php echo $user['id']; ?>" class="button">Delete</a>
            </td>
        </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="4">
                No user present. <a href="<?php echo $obj->add_link; ?>">Click here to add one.</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo $obj->pagination; ?>

