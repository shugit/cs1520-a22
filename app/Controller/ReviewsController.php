<?php
class ReviewsController extends AppController{
	public $helpers = array('Html', 'Form');

	public function index() {
		$this->set('reviews', $this->Review->find('all')); //<-------what is this ‘Post’?
		$this->set('userid', $this->Auth->user('id'));
		$this->set('username', $this->Auth->user('username'));
	}

	public function add() {
		$userid = $this->Auth->user('id');
		if ($userid) {
			if ($this->request->is('post')) {
				$this->request->data['Review']['user_id'] = $userid;
				$this->Review->create();
				if ($this->Review->save($this->request->data)) {
					$this->Session->setFlash(__('Your Review has been saved.'));
					return $this->redirect(array('action' => 'index'));
				}
				$this->Session->setFlash(__('Unable to add your Review.'));
			}
		}
		else {
			$this->Session->setFlash(__('You must be logged in to add a review.'));
			return $this->redirect(array('action' => 'index'));
		}
	}

	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException('Invalid post1');
		}
		//$userid = $this->Auth->user('id');
		$this->set('userid', $this->Auth->user('id'));
		$review = $this->Review->findById($id);
		if (!$review) {
			throw new NotFoundException('Invalid post2');
		}

		$this->set('review', $review);
		$this->loadModel('User');
		$this->set('users', $this->User->find('all'));
	}

	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid review'));
		}

		$review = $this->Review->findById($id);
		if (!$review) {
			throw new NotFoundException(__('Invalid review'));
		}

		$userid = $this->Auth->user('id');
		if ($review['Review']['user_id'] != $userid)
		{
			$this->Session->setFlash(__('You can not edit that review.'));
			return $this->redirect(array('action' => 'index'));
		}

		if ($this->request->is(array('post', 'put'))) {
			$this->Review->id = $id;
			if ($this->Review->save($this->request->data)) {
				$this->Session->setFlash(__('Your Review has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to update your Review.'));
		}

		if (!$this->request->data) {
			$this->request->data = $review;
		}
	}

	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		if ($this->Review->delete($id)) {
			$this->Session->setFlash(
					__('The reviw with id: %s has been deleted.', h($id))
			);
			return $this->redirect(array('action' => 'index'));
		}
	}
}
?>
