<h1>Add Comment</h1>
<?php
echo $this->Form->create('Comment',array('action' => 'add',
                                             'url' => array($review_id)));
echo $this->Form->input('body', array('rows' => '3'));
echo $this->Form->end('Add comment');
?>