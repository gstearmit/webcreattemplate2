<?php
class NewsController extends AppController {
	var $name = 'News';
	var $uses = array (
			'News',
			'Category',
			'User' 
	);
	function index($id = null) {
		
		// list danh sach tin tuc
		mysql_query ( "SET names utf8" );
		
		$this->paginate = array (
				'conditions' => array (
						'News.status' => 1,
						'News.category_id' => $id 
				),
				'limit' => '8',
				'order' => 'News.id DESC' 
		);
		
		$this->set ( 'news', $this->paginate ( 'News', array () ) );
	}
	function buy() {
		
		// list danh sach tin tuc
		mysql_query ( "SET names utf8" );
		
		$this->paginate = array (
				'conditions' => array (
						'News.status' => 1,
						'News.category_id' => 207 
				),
				'limit' => '1',
				'order' => 'News.id DESC' 
		);
		
		$this->set ( 'news', $this->paginate ( 'News', array () ) );
	}
	function address() {
		
		// list danh sach tin tuc
		mysql_query ( "SET names utf8" );
		
		$this->paginate = array (
				'conditions' => array (
						'News.status' => 1,
						'News.category_id' => 208 
				),
				'limit' => '1',
				'order' => 'News.id DESC' 
		);
		
		$this->set ( 'news', $this->paginate ( 'News', array () ) );
	}
	function baogia() {
		
		// list danh sach tin tuc
		mysql_query ( "SET names utf8" );
		
		$this->paginate = array (
				'conditions' => array (
						'News.status' => 1,
						'News.category_id' => 206 
				),
				'limit' => '8',
				'order' => 'News.id DESC' 
		);
		
		$this->set ( 'baogia', $this->paginate ( 'News', array () ) );
	}
	function chinhsach() {
		
		// list danh sach tin tuc
		mysql_query ( "SET names utf8" );
		
		$this->paginate = array (
				'conditions' => array (
						'News.status' => 1,
						'News.category_id' => 205 
				),
				'limit' => '1',
				'order' => 'News.id DESC' 
		);
		
		$this->set ( 'chinhsach', $this->paginate ( 'News', array () ) );
	}
	function map() {
	}
	function listnews($id = null) {
		
		// list danh sach tin tuc
		mysql_query ( "SET names utf8" );
		
		$this->paginate = array (
				'conditions' => array (
						'News.status' => 1,
						'News.category_id' => $id 
				),
				'limit' => '8',
				'order' => 'News.id DESC' 
		);
		
		$this->set ( 'listnews', $this->paginate ( 'News', array () ) );
		
		$this->set ( 'cat', $this->Category->read ( null, $id ) );
	}
	function view($id = null) {
		mysql_query ( "SET names utf8" );
		
		if (! $id) {
			
			$this->Session->setFlash ( __ ( 'Không tồn tại', true ) );
			
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		
		$x = $this->News->read ( null, $id );
		
		$this->set ( 'views', $x );
		
		$this->set ( 'list_other', $this->News->find ( 'all', array (
				'conditions' => array (
						'News.status' => 1,
						'News.category_id' => $x ['News'] ['category_id'],
						'News.id <>' => $id 
				),
				'limit' => 10 
		) ) );
	}
	function search($name_search = null) {
		mysql_query ( "SET names utf8" );
		
		$title = $_POST ['name_search'];
		
		$this->set ( 'listsearch', $this->News->find ( 'all', array (
				'conditions' => array (
						'News.status' => 1,
						'News.title LIKE' => '%' . $title . '%' 
				),
				'order' => 'News.id DESC',
				'limit' => 7 
		) ) );
	}
}

?>

