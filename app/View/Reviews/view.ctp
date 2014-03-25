<?php //print_r($review); ?>
<p></p>
<p><?php echo $this->Html->link('<-Back to index', array('controller' => 'reviews', 'action' => 'index'));?></p>
<h2><?php echo "".h($review['Review']['title']); ?></h2>
<h1><b>By: </b><?php echo h($review['User']['username']); ?></h1>

<p><small><b>Created: </b><?php echo $review['Review']['created']; ?></small></p>
<p><b>Rating: </b><?php echo h($review['Review']['rating']); ?></p>
<p><b>Media: </b><?php echo h($review['Review']['media']); ?></p>
<p><?php echo h($review['Review']['body']); ?></p
<!--this line need to be edit, for specific user--->
<p><?php echo $this->Html->link('Send a message to '.h($review['User']['username']), array('controller' => 'messages', 'action' => 'add',$review['Review']['user_id']));?></p>
<p>Comments:</P>
<table>
    <tr>
        <th>body</th>
	<th>send by</th>
        <th>Created</th>
    </tr>
<?php foreach ($review['Comment'] as $comment): ?>
<tr>
<td><?php echo h($comment['body'])?></td>
<td><?php echo h($comment['user_id'])?></td> 
<td><?php echo h($comment['created'])?></td>
</tr>
<?php endforeach;?>

<!--<?php echo $this->element('newcomment', array("review_id" => $review['Review']['id']));?>   -->
<!--this line need to be edit, for specific review--->  
<p><?php echo $this->Html->link('Add a new Comment', array('controller' => 'comments', 'action' => 'add',
                                             $review['Review']['id']   ));?></p>
   <!--          
<p><?php echo $this->Form->create('Comment',array('url' => array('controller' => 'comments', 'action'=>'add'
) )); ?>
<input type="hidden" name="review_id" id="<?php echo h($review['Review']['id']);?>"
    value="0" />
<?php echo $this->Form->end('add');
?>
--->   
