<?php
class PostsController extends AppController {
	var $name = 'Posts';
	public $components = array('RequestHandler');
	public $scaffold;
	
	public function index() {
		//die('index');
		$posts = $this->Post->find('all');
		//pr($posts);die;
		$this->set(array(
				'posts' => $posts,
				'_serialize' => array('posts')
		));
		
	}
	
	public function view($id) {
		$post = $this->Post->findById($id);
		$this->set(array(
				'post' => $post,
				'_serialize' => array('post')
		));
	}
	
	public function add() {
		//$this->Post->id = $id;
		if ($this->Post->save($this->request->data)) {
			$message = array(
					'text' => __('Saved'),
					'type' => 'success'
			);
		} else {
			$message = array(
					'text' => __('Error'),
					'type' => 'error'
			);
		}
		$this->set(array(
				'message' => $message,
				'_serialize' => array('message')
		));
	}
	
	public function edit($id) {
		$this->Post->id = $id;
		if ($this->Post->save($this->request->data)) {
			$message = array(
					'text' => __('Saved'),
					'type' => 'success'
			);
		} else {
			$message = array(
					'text' => __('Error'),
					'type' => 'error'
			);
		}
		$this->set(array(
				'message' => $message,
				'_serialize' => array('message')
		));
	}
	
	public function delete($id) {
		if ($this->Post->delete($id)) {
			$message = array(
					'text' => __('Deleted'),
					'type' => 'success'
			);
		} else {
			$message = array(
					'text' => __('Error'),
					'type' => 'error'
			);
		}
		$this->set(array(
				'message' => $message,
				'_serialize' => array('message')
		));
	}
}

?>
