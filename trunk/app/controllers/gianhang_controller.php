<?php
class GianhangController extends AppController {
	var $name = 'Gianhang';
	var $uses = array (
			'Shop',
			'Userscms',
			'Productshop',
			'Newshop' 
	);
	function index($categoryshop_id = null) {
		$this->layout = 'homegianhang';
		if ($categoryshop_id == null)
			$categoryshop_id = 110;
		$this->set ( 'Shop', $this->Shop->find ( 'all', array (
				'conditions' => array (
						'Shop.loai' => 1,
						'Shop.status' => 1 
				) 
		) ) );
		$shop = $this->Shop->find ( 'list', array (
				'conditions' => array (
						'Shop.loai' => 1,
						'Shop.status' => 1 
				),
				'fields' => array (
						'id' 
				) 
		) );
		$this->paginate = array (
				'conditions' => array (
						'Productshop.status' => 1,
						'Productshop.category_id' => $categoryshop_id 
				),
				'order' => 'Productshop.id DESC',
				'limit' => 9 
		);
		$this->set ( 'productshop', $this->paginate ( 'Productshop', array () ) );
	}
	function kt_shop($id = null) {
		return $this->Shop->find ( 'list', array (
				'conditions' => array (
						'Shop.id' => $id,
						'Shop.status' => 1 
				),
				'fields' => array (
						'loai' 
				),
				'limit' => 1 
		) );
	}
	function danhsach() {
		$this->layout = 'homegianhang';
		$this->paginate = array (
				'conditions' => array (
						'Shop.status' => 1 
				),
				'order' => 'Shop.id DESC',
				'limit' => 20 
		);
		$this->set ( 'shopnb', $this->paginate ( 'Shop', array () ) );
	}
}


