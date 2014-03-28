<?php //print_r($message);
$usernames = array();
	foreach ($users as $user) {
		$usernames[$user['User']['id']] = $user['User']['username'];		
	}
	 ?>

<p><?php echo $this->Html->link('<-Back to message box', array('controller' => 'messages', 'action' => 'index'));?></p>
<h2><?php echo "Messages from  ".$usernames[$message['Message']['from_id']]; ?></h2>
<h1>Title: <?php echo h($message['Message']['title']); ?></h1>
<p><small>Created: <?php echo $message['Message']['created']; ?></small></p>

<p><h3>Body: <?php echo h($message['Message']['body']); ?></h3></p>
<p><?php echo $this->Html->link('Reply to '.h($message['Message']['from_id']), array('controller' => 'messages', 'action' => 'add',h($message['Message']['from_id'])));?></p>