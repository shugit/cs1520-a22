<?php print_r($message); ?>

<p><?php echo $this->Html->link('<-Back to message box', array('controller' => 'messages', 'action' => 'index'));?></p>
<h2><?php echo "Messages from uid ".h($message['Message']['from_id']); ?></h2>
<h1><?php echo "Title ".h($message['Message']['title']); ?></h1>
<p><small>Created: <?php echo $message['Message']['created']; ?></small></p>

<p><?php echo "Body ".h($message['Message']['body']); ?></p>
