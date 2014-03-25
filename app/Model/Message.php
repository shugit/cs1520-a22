<?php
class Message extends AppModel {
	var $name = 'Message';
	public $validate = array(
			'from_id' => array('rule' => 'notEmpty'),
			'to_id' => array('rule' => 'notEmpty'),
			'title' => array('rule' => 'notEmpty'),
			'body' => array('rule' => 'notEmpty')
	);
	var $belongsTo = array('User'=>array('className'=>'User'));
	//public $hasOne = array(	'FromUser' => array('className' => 'User'));
}
?>