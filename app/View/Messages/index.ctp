<?php
	foreach ($messages as $message) {
		//print_r($message);
		//echo "<br />";
	}
	
	foreach ($users as $user) {
		//print_r($user);
		//echo "<br />";
	}
	$usernames = array();
	foreach ($users as $user) {
		//print_r($user);
		$usernames[$user['User']['id']] = $user['User']['username'];		
	}
	//print_r($usernames);
	//echo "<br />";
	
	
	
?>
<p><?php echo $this->Html->link('<-Back to review index', array('controller' => 'reviews', 'action' => 'index'));?></p>
<h1>You Messages</h1>

<?php
	
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
        <th>Title</th>
        <th>From</th>
	<th>Options</th>
        <th>Created</th>
    </tr>

    <?php foreach ($messages as $message): ?>
    <?php 
//$users = $this['User'];
//print_r($users);

?>
    <tr>
     <td>
            <?php echo $this->Html->link($message['Message']['title'], array('controller' => 'messages', 'action' => 'view', $message['Message']['id'])); ?>
        </td>
        <td>
        <?php echo $usernames[$message['Message']['from_id']]; 
        
        
        ?>
        </td>
       
	<td>
            <?php
		if ($userid == $message['Message']['user_id']) {
                	echo $this->Form->postLink('Delete', array('action' => 'delete', $message['Message']['id']), array('confirm' => 'Are you sure?'));
		}
		else {
			echo "&nbsp;";
		}
            ?>
        </td>
        <td><?php echo $message['Message']['created']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($message); ?>
</table>
