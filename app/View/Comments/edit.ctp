<h1>Edit Review</h1>
<?php
echo $this->Html->link('<-Back to review', array('controller' => 'reviews', 'action' => 'view',$review_id));
echo $this->Form->create('Comment');
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->input('body', array('rows' => '3'));
echo $this->Form->end('Add Comment');
?>
