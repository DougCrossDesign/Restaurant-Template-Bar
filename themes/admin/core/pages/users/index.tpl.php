<a href="<?php use Model\User;

echo $obj->add_link; ?>" class="btn btm-margin">Add New User</a>

<table cellspacing="0" cellpadding="0" class="datagrid">
	<thead>
	<tr>
		<th><?php printAdminHeader("Username"); ?></th>
		<th><?php printAdminHeader("Name", "fullname"); ?></th>
		<th><?php printAdminHeader("Email"); ?></th>
		<th><?php printAdminHeader("User Level", "userlevel"); ?></th>
		<th>Controls</th>
	</tr>
	</thead>
	<tbody>
	<?php if (count($obj->users) > 0) { ?>
		<?php
		/** @var User $user */
		foreach ($obj->users as $user) {
			// skip client users being able to see ayc users
			if(Auth::userIsInLevel([User::TYPE_AYC_ADMIN, User::TYPE_AYC_USER]) == false && $user->userIsInLevel([User::TYPE_AYC_ADMIN, User::TYPE_AYC_USER]) == true) continue;

			?>
			<tr>
				<td><?php echo $user['username']; ?></td>
				<td><?php echo $user['fullname']; ?></td>
				<td><?php echo $user['email']; ?></td>
				<td><?php echo User::getUserLevelName($user->userlevel); ?></td>
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
