<?php
class RestproductsController extends AppController {
	var $name = 'Restproducts';
	public $components = array('RequestHandler');
	public $scaffold;
// 	var $uses = array (
// //			'Estore_products',
// //			'Estore_categories',//Catalogueshop
// 			//'Estore_news',//eshop
// 			'Restproducts',//eshop products
// //			'Estore_catproducts',// eshop Estorecatproducts
// // 			'Estore_manufacturers',// eshop Estore_manufacturers
// // 			'Estore_advertisements',//eshop Estore_advertisements
// // 			'Estore_slideshows', //eshop Estore_slideshows
// // 			'Estore_partners', // eshop Estore_partners
// // 			'Estore_infomations',//eshop Estore_infomations
// // 			'Estore_albums',//eshop Estore_albums
// // 			'Estore_settings',//eshop Estore_settings
// // 			'Estore_banners',//eshop Estore_banners
// // 			'Estore_category',
// // 			'Estore_comments',//eshop Estore_comments
// // 			'Estore_contacts',//eshop Estore_contacts
// // 			'Estore_user',
// // 			'Estore_news',
// // 			'Estore_infomation',
// // 			'Estore_order',
// // 			'Estore_infomationdetail',
// // 			'Estore_gallery',
// // 			'Estore_album',
// // 			'Estore_banner',
// // 			'Estore_helps',
// // 			'Estore_setting',
// // 			'Estore_video',
// // 			'Estore_slideshow',
// // 			'Estore_partner',
// // 			'Estore_advertisement',
// // 			'Estore_catproduct',
// // 			'Restproducts',
// // 			'Estore_weblink',
// // 			'Estore_manufacturer',
// //			'Shop'
// 	);
// // 	function loadModelNew($Model) {
// // 		// ++++++++++++connection data +++++++++++++++++
// // 		$nameeshop = $this->Session->read ( "name" );
// // 		$shop_id = $this->Session->read ( "id" );
// // 		$shoparr = $this->Shop->find ( 'all', array (
// // 				'conditions' => array (
// // 						'Shop.id' => $shop_id,
// // 						'Shop.name' => $nameeshop,
// // 						'Shop.status' => 1
// // 				),
// // 				'fields' => array (
// // 						'Shop.id',
// // 						'Shop.created',
// // 						'Shop.databasename',
// // 						'Shop.username',
// // 						'Shop.password',
// // 						'Shop.hostname',
// // 						'Shop.name',
// // 						'Shop.email',
// // 						'Shop.userpass',
// // 						'Shop.ipserver'
// // 				)
// // 		) );
	
// // 		if (is_array ( $shoparr ) and ! empty ( $shoparr )) {
// // 			foreach ( $shoparr as $shop ) {
// // 				$databasename = $shop ['Shop'] ['databasename'];
// // 				$password = $shop ['Shop'] ['password'];
// // 				$username = $shop ['Shop'] ['username'];
// // 				$hostname = $shop ['Shop'] ['hostname'];
// // 				$shop_id = $shop ['Shop'] ['id'];
// // 				$nameproject = $shop ['Shop'] ['name']; // $nameproject is name Ctronller
// // 				$email = trim ( $shop ['Shop'] ['email'] );
// // 				$userpass = $shop ['Shop'] ['userpass'];
// // 			}
// // 		}
// // 		$this->$Model->setDataEshop ( $hostname, $username, $password, $databasename );
// // 	}
	public function index() {
		//die('index');
		$Restproducts = $this->Restproducts->find('all');
		//pr($Restproducts);die;
		$this->set(array(
				'Restproducts' => $Restproducts,
				'_serialize' => array('Restproducts')
		));
		
	}
	
	public function view($id) {
		$Restproducts = $this->Restproducts->findById($id);
		$this->set(array(
				'Restproduct' => $Restproduct,
				'_serialize' => array('Restproduct')
		));
	}
	
	public function add() {
		//$this->Restproducts->id = $id;
		if ($this->Restproducts->save($this->request->data)) {
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
		$this->Restproducts->id = $id;
		if ($this->Restproducts->save($this->request->data)) {
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
		if ($this->Restproducts->delete($id)) {
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
