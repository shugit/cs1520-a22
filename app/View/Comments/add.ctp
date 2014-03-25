<h1>Add Comment</h1>
<?php
echo $this->Form->create('Comment');
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->input('body', array('rows' => '3'));
echo $this->Form->end('Add Comment');
?>
