<?php
class UsersController extends AppController{
	public $helpers = array('Html', 'Form');

	public function index() {
		$this->set('users', $this->User->find('all'));
	}

	public function add() {
        	if ($this->request->is('post')) {
            	$this->User->create();
            	if ($this->User->save($this->request->data)) {
                	$this->Session->setFlash(__('Your user has been created'));
                	return $this->redirect(array('controller' => 'posts', 'action' => 'index'));
            	}
            	$this->Session->setFlash(__('Unable to create a new user!'));
        	}
    	}

	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirect());
			}
			$this->Session->setFlash(__('Invalid username or password, try again'));
		}
	}

	public function logout() {
		return $this->redirect($this->Auth->logout());
	}
}
?>
