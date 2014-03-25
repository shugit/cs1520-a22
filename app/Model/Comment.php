<?php
class Comment extends AppModel {
	var $name = 'Comment';
	public $validate = array(
			'body' => array('rule' => 'notEmpty')
	);
	//var $belongsTo = array('Review'=>array('className'=>'Review'));
	public $belongsTo = 'User';
	//var $hasAndBelongsToMany = array('Review'=>array('className'=>'Review'));
}
?>