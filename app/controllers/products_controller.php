<?php
class ProductsController extends AppController {
	var $name = 'Products';
	public $components = array('RequestHandler');
	public $scaffold;
	var $uses = array (
			'Products',//Catalogueshop
			);
	public function index() {
		//die('index');
		$products = $this->Products->find('all');
		//pr($products);die;
		$this->set(array(
				'products' => $products,
				'_serialize' => array('products')
		));
	
	}
	
	public function view($id) {
		$product = $this->Products->findById($id);
		$this->set(array(
				'product' => $product,
				'_serialize' => array('product')
		));
	}
	
	public function add() {
		//$this->Products->id = $id;
		if ($this->Products->save($this->request->data)) {
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
		$this->Products->id = $id;
		if ($this->Products->save($this->request->data)) {
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
		if ($this->Products->delete($id)) {
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
