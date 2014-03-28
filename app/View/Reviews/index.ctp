<?php
	foreach ($reviews as $review) {
		//print_r($review);
		//echo "<br />";
	}
?>
<h1>Reviews</h1>

<?php
	echo $this->Html->link('Add Review', array('controller' => 'reviews', 'action' => 'add'));
	echo "<br />";

	if (!$userid) {
		echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login'));
		echo " or ";
		echo $this->Html->link('Create a new user', array('controller' => 'users', 'action' => 'add'));
	}
	else {
		echo "Logged in as " . $username;
		echo "<br />";
		echo $this->Html->link('View your messages', array('controller' => 'messages', 'action' => 'index'));
		echo "<br />";
		echo $this->Html->link('Log out', array('controller' => 'users', 'action' => 'logout'));
	}
?>

<table>
    <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Rating</th>
	<th>Media</th>
	<th>Options</th>	
        <th>Created</th>
    </tr>

    <!-- Here is where we loop through our $reviews array, printing out review info -->

    <?php foreach ($reviews as $review): ?>
    <tr>
       
        <td>
            <?php echo $this->Html->link($review['Review']['title'], array('controller' => 'reviews', 'action' => 'view', $review['Review']['id'])); ?>
        </td>
         <td><?php echo $review['User']['username']; ?></td>
        <td>
            <?php echo $review['Review']['rating']; ?>
        </td>
        <td>
            <?php echo $review['Review']['media']; ?>
        </td>
	<td>
            <?php
		if ($userid == $review['Review']['user_id']) {
                	echo $this->Html->link('Edit', array('action' => 'edit', $review['Review']['id']));
                	echo " ";
                	echo $this->Form->postLink('Delete', array('action' => 'delete', $review['Review']['id']), array('confirm' => 'Are you sure?'));
		}
		else {
			echo "&nbsp;";
		}
            ?>
        </td>
        <td><?php echo $review['Review']['created']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($review); ?>
</table>
