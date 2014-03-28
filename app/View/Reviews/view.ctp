<?php // print_r($review); 
	
	$usernames = array();
	foreach ($users as $user) {
		//print_r($user);
		$usernames[$user['User']['id']] = $user['User']['username'];		
	}
	//print_r($usernames);
	//echo "<br />";
?>
<p></p>
<p><?php echo $this->Html->link('<-Back to index', array('controller' => 'reviews', 'action' => 'index'));?></p>
<h2><?php echo "".h($review['Review']['title']); ?></h2>
<h1><b>By: </b><?php echo h($review['User']['username']); ?></h1>

<p><small><b>Created: </b><?php echo $review['Review']['created']; ?></small></p>
<p><b>Rating: </b><?php echo h($review['Review']['rating']); ?></p>
<p><b>Media: </b><?php echo h($review['Review']['media']); ?></p>
<p><h3><?php echo h($review['Review']['body']); ?></h3></p>
<!--this line need to be edit, for specific user--->
<p><?php echo $this->Html->link('Send a message to '.h($review['User']['username']), array('controller' => 'messages', 'action' => 'add',$review['Review']['user_id']));?></p>
<p>Comments:</P>
<table>
    <tr>
        <th>body</th>
	<th>send by</th>
	<th>Options</th>
        <th>Created</th>
        
    </tr>
<?php foreach ($review['Comment'] as $comment): 
//print_r($comment);

?>
<tr>
<td><?php echo h($comment['body'])?></td>
<td><?php echo $usernames[$comment['user_id']];
?></td> 
<td>
            <?php
		if ($userid == $comment['user_id']) {
                	echo $this->Html->link('Edit', array('controller' => 'comments', 'action' => 'edit', $comment['id']));
                	echo " ";
                	echo $this->Form->postLink('Delete', array('controller' => 'comments','action' => 'delete', $comment['id']), array('confirm' => 'Are you sure?'));
		}
		else {
			echo "&nbsp;";
		}
            ?>
        </td>
<td><?php echo h($comment['created'])?></td>
</tr>
<?php endforeach;?>

<!--<?php echo $this->element('newcomment', array("review_id" => $review['Review']['id']));?>   -->
<!--this line need to be edit, for specific review--->  
<p><?php echo $this->Html->link('Add a new Comment', array('controller' => 'comments', 'action' => 'add',
                                             $review['Review']['id']   ));?></p>
 
