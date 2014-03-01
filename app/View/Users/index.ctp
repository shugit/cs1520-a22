<?php
	foreach($users as $user) {
		print_r($user);
		echo "<br />";
	}
?>
<h1>Select a User</h1>

<?php
    echo $this->Html->link('Create New User', array('controller' => 'users', 'action' => 'add'));
?>

<table>
    <tr>
        <th>Id</th>
        <th>Username</th>
	<th>Password</th>
	<th>Created</th>
    </tr>

    <?php foreach ($users as $user): ?>
    <tr>
        <td><?php echo $user['User']['id']; ?></td>
        <td>
            <?php echo $user['User']['username']; ?>
        </td>
        <td>
            <?php echo $user['User']['password']; ?>
        </td>
        <td><?php echo $user['User']['created']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($user); ?>
</table>
