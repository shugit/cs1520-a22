<?php
	foreach ($posts as $post) {
		print_r($post);
		echo "<br />";
	}
?>
<h1>Blog posts</h1>

<?php
	echo $this->Html->link('Add Post', array('controller' => 'posts', 'action' => 'add'));
	echo "<br />";

	if (!$userid) {
		echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login'));
		echo " or ";
		echo $this->Html->link('Create a new user', array('controller' => 'users', 'action' => 'add'));
	}
	else {
		echo "Logged in as " . $username;
		echo "<br />";
		echo $this->Html->link('Log out', array('controller' => 'users', 'action' => 'logout'));
	}
?>

<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
	<th>Options</th>
        <th>Created</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($posts as $post): ?>
    <tr>
        <td><?php echo $post['Post']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($post['Post']['title'], array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?>
        </td>
	<td>
            <?php
		if ($userid == $post['Post']['user_id']) {
                	echo $this->Html->link('Edit', array('action' => 'edit', $post['Post']['id']));
                	echo $this->Form->postLink('Delete', array('action' => 'delete', $post['Post']['id']), array('confirm' => 'Are you sure?'));
		}
		else {
			echo "&nbsp;";
		}
            ?>
        </td>
        <td><?php echo $post['Post']['created']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($post); ?>
</table>
