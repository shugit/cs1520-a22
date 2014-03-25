<?php
class CommentsController extends AppController{
	public $helpers = array('Html', 'Form');

	public function index() {
		$this->set('comments', $this->Comment->find('all')); //<-------what is this ‘Post’?
		$this->set('userid', $this->Auth->user('id'));
		$this->set('username', $this->Auth->user('username'));
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
		}


	}

	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException('Invalid post1');
		}

		$comment = $this->Comment->findById($id);
		if (!$review) {
			throw new NotFoundException('Invalid post2');
		}

		$this->set('comment', $comment);
	}
	/*
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

	if ($this->Review->delete($id)) {
	$this->Session->setFlash(
			__('The reviw with id: %s has been deleted.', h($id))
	);
	return $this->redirect(array('action' => 'index'));
	}
	}
	*/
}
?>