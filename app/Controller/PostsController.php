<?php
class PostsController extends AppController{
	public $helpers = array('Html', 'Form');

	public function index() {
		$this->set('posts', $this->Post->find('all'));
		$this->set('userid', $this->Auth->user('id'));
		$this->set('username', $this->Auth->user('username'));
	}

	public function add() {
		$userid = $this->Auth->user('id');
		if ($userid) {
        		if ($this->request->is('post')) {
				$this->request->data['Post']['user_id'] = $userid;
            			$this->Post->create();
            			if ($this->Post->save($this->request->data)) {
                			$this->Session->setFlash(__('Your post has been saved.'));
                			return $this->redirect(array('action' => 'index'));
            			}
            			$this->Session->setFlash(__('Unable to add your post.'));
        		}
		}
		else {
			$this->Session->setFlash(__('You must be logged in to add a post.'));
			return $this->redirect(array('action' => 'index'));
		}
    	}

	public function view($id = null) {
		if (!$id) {
           		 throw new NotFoundException('Invalid post1');
        	}

		$post = $this->Post->findById($id);
		if (!$post) {
			 throw new NotFoundException('Invalid post2');
          	}

		$this->set('post', $post);
	}

	public function edit($id = null) {
		if (!$id) {
        		throw new NotFoundException(__('Invalid post'));
    		}

    		$post = $this->Post->findById($id);
    		if (!$post) {
        		throw new NotFoundException(__('Invalid post'));
    		}

		$userid = $this->Auth->user('id');
		if ($post['Post']['user_id'] != $userid)
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

		if ($this->Post->delete($id)) {
        		$this->Session->setFlash(
            		__('The post with id: %s has been deleted.', h($id))
        		);
        		return $this->redirect(array('action' => 'index'));
    		}
	}
}
?>
