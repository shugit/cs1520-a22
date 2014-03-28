<?php
class MessagesController extends AppController{
	public $helpers = array('Html', 'Form');

	public function index() {
		$this->set('userid', $this->Auth->user('id'));
		$this->set('username', $this->Auth->user('username'));
		//$this->set('messages', $this->Message->find('all')); //<-------what is this ‘Post’?
		
		$this->set('messages', $this->Message->find('all', array(
				'conditions' => array('Message.user_id' => $this->Auth->user('id')),
				'joins' => array(
						array(
								'table' => 'users',
								'alias' => 'FromUser',
								'type' => 'left',  //join of your choice left, right, or inner
								'foreignKey' => true,
								'conditions' => array('Message.from_id=FromUser.id')
						),
				),
				'order' => array('Message.created DESC')
		))
		);
		$this->loadModel('User');
		$this->set('users', $this->User->find('all'));
		
	}

	public function add($id = null) {
		$userid = $this->Auth->user('id');//Message->from_id
		$this->Session->setFlash('You are sending messages to user_id '.$id); //Message->user_id
		if (!$id) {
			throw new NotFoundException(__('Invalid to user user_id'));
		}
		if ($userid) {
			if ($this->request->is('post')) {
				$this->request->data['Message']['from_id'] = $userid;
				//$this->Comment->set(array('to_id'=>$id));
				$this->request->data['Message']['user_id'] = $id;
				$this->Message->create();
				if ($this->Message->save($this->request->data)) {
					$this->Session->setFlash(__('Your message has been send.'));
					//return $this->redirect(array('action' => 'index'));
					return $this->redirect(array('controller' => 'reviews', 'action' => 'index'));
				}
				$this->Session->setFlash(__('Unable to send your message.'));
			}
		}
		else {
			$this->Session->setFlash(__('You must be logged in to send a message.'));
			//return $this->redirect(array('action' => 'index'));
			return $this->redirect(array('controller' => 'reviews', 'action' => 'index'));
		}
	}

	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException('Invalid id '.$id);
		}
		
		$message = $this->Message->findById($id);
		
		
		if (!$message) {
			throw new NotFoundException('Invalid message'.$message);
		}
		//$this->Session->setFlash(__('message from '.$message->FromUser['username']));
		$this->set('message', $message);
		$this->loadModel('User');
		$this->set('users', $this->User->find('all'));
	}

	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid post'));
		}

		$review = $this->Review->findById($id);
		if (!$review) {
			throw new NotFoundException(__('Invalid post'));
		}

		$userid = $this->Auth->user('id');
		if ($review['Review']['user_id'] != $userid)
		{
			$this->Session->setFlash(__('You can not edit that post.'));
			return $this->redirect(array('action' => 'index'));
		}

		if ($this->request->is(array('post', 'put'))) {
			$this->Post->id = $id;
			if ($this->Post->save($this->request->data)) {
				$this->Session->setFlash(__('Your post has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to update your post.'));
		}

		if (!$this->request->data) {
			$this->request->data = $post;
		}
	}

	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		if ($this->Message->delete($id)) {
			$this->Session->setFlash(
					__('The messgae with id: %s has been deleted.', h($id))
			);
			return $this->redirect(array('action' => 'index'));
		}
	}
}
?>
