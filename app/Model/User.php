<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel{
	public $validate = array(
		'username' => array('rule' => 'notEmpty'),
		'password' => array('rule' => 'notEmpty')
	);
	public $hasMany = 'Post';

	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new BlowfishPasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
		}
		return true;
	}
}
?>
