<?php
class CommentsController extends AppController{
	public $helpers = array('Html', 'Form');

	public function index() {
		$this->set('comments', $this->Comment->find('all')); //<-------what is this ‘Post’?
		$this->set('userid', $this->Auth->user('id'));
		$this->set('username', $this->Auth->user('username'));
		/*
		$this->set('comments', $this->Comment->find('all', array(
				//'conditions' => array('Comment.user_id' => $this->Auth->user('id')),
				'joins' => array(
						array(
								'table' => 'users',
								'alias' => 'User',
								'type' => 'left',  //join of your choice left, right, or inner
								'foreignKey' => true,
								'conditions' => array('Comment.user_id=User.id')
						)
				)//,
				//'order' => array('Message.created DESC')
		))
		);*/
		$this->loadModel('User');
		$this->set('users', $this->User->find('all'));
	}

	public function add($id = null) {
		
		$this->Session->setFlash('You are posting comment on review id '.$id);
		if (!$id) {
			throw new NotFoundException(__('Invalid review id'));
		}
		/*
		$review = $this->Review->findById($id);
		if (!$review) {
			throw new NotFoundException(__('Invalid review id'));
		}
		*/
		$this->set('review_id', $id);
		$userid = $this->Auth->user('id');
		if ($userid) {
			if ($this->request->is('post')) {
				$this->request->data['Comment']['user_id'] = $userid;
				$this->request->data['Comment']['review_id'] = $id;
				//$this->comment->review_id = $id;
				//$this->Comment->set(array('review_id'=>$id));
				if ($this->Comment->save($this->request->data)) {
					$this->Session->setFlash('Your comment has been added.');
					//$this->redirect(array('action' => 'index'));
					$this->redirect(array('controller' => 'reviews', 'action' => 'view', $id));
				}
			} else {
				//$this->Session->setFlash('Unable to add your comment.');
			}
		} else {
			$this->Session->setFlash(__('You must be logged in to leave a comment.'));
			//return $this->redirect(array('action' => 'index'));
			return $this->redirect(array('controller' => 'reviews', 'action' => 'view', $id));
		}


	}
	
	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid comment'));
		}
		
		$comment = $this->Comment->findById($id);
		if (!$comment) {
			throw new NotFoundException(__('Invalid comment'));
		}
		$this->set('review_id', $comment['Comment']['review_id']);
		$userid = $this->Auth->user('id');
		if ($comment['Comment']['user_id'] != $userid)
		{
			$this->Session->setFlash(__('You can not edit that comment.'));
			return $this->redirect(array('action' => 'index'));
		}

		if ($this->request->is(array('post', 'put'))) {
			$this->Comment->id = $id;
			if ($this->Comment->save($this->request->data)) {
				$this->Session->setFlash(__('Your Comment has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to update your Comment.'));
		}

		if (!$this->request->data) {
			$this->request->data = $comment;
		}
	}

	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		$comment = $this->Comment->findById($id);
		$review_id = $comment['Comment']['review_id'];
		if ($this->Comment->delete($id)) {
			$this->Session->setFlash(
					__('The comment with id: %s has been deleted.', h($id))
			);
			return $this->redirect(array('controller' => 'reviews', 'action' => 'view',$review_id));
		}
	}
}
?>