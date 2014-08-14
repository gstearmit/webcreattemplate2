<?php
class WeblinksController extends AppController {
	var $name = 'Weblinks';
	var $uses = array (
			'Weblink','Shop', 
	);
	var $helpers = array (
			'Html',
			'Javascript' 
	);
	function loadModelNew($Model) {
		// ++++++++++++connection data +++++++++++++++++
		$nameeshop = $this->Session->read ( "name" );
		$shop_id = $this->Session->read ( "id" );
		$shoparr = $this->Shop->find ( 'all', array (
				'conditions' => array (
						'Shop.id' => $shop_id,
						'Shop.name' => $nameeshop,
						'Shop.status' => 1 
				),
				'fields' => array (
						'Shop.id',
						'Shop.created',
						'Shop.databasename',
						'Shop.username',
						'Shop.password',
						'Shop.hostname',
						'Shop.name',
						'Shop.email',
						'Shop.userpass',
						'Shop.ipserver' 
				) 
		) );
		
		if (is_array ( $shoparr ) and ! empty ( $shoparr )) {
			foreach ( $shoparr as $shop ) {
				$databasename = $shop ['Shop'] ['databasename'];
				$password = $shop ['Shop'] ['password'];
				$username = $shop ['Shop'] ['username'];
				$hostname = $shop ['Shop'] ['hostname'];
				$shop_id = $shop ['Shop'] ['id'];
				$nameproject = $shop ['Shop'] ['name']; // $nameproject is name Ctronller
				$email = trim ( $shop ['Shop'] ['email'] );
				$userpass = $shop ['Shop'] ['userpass'];
			}
		}
		$this->$Model->setDataEshop ( $hostname, $username, $password, $databasename );
	}
	function index() {
		$this->account ();
		$this->loadModelNew ( 'Weblink' );
		$this->paginate = array (
				'order' => 'Weblink.id DESC' 
		);
		$this->set ( 'weblinks', $this->paginate ( 'Weblink', array () ) );
	}
	function add() {
		$this->account ();
		$this->loadModelNew ( 'Weblink' );
		if (! empty ( $this->data )) {
			$this->Weblink->create ();
			$data ['Weblink'] = $this->data ['Weblink'];
			if ($this->Weblink->save ( $data ['Weblink'] )) {
				$this->Session->setFlash ( __ ( 'Thêm mới thành công', true ) );
				$this->redirect ( array (
						'action' => 'index' 
				) );
			} else {
				$this->Session->setFlash ( __ ( 'Thêm mới thất bại' ) );
			}
		}
	}
	function delete($id = null) {
		$this->account ();
		$this->loadModelNew ( 'Weblink' );
		if (empty ( $id )) {
			$this->Session->setFlash ( __ ( 'Khôn tồn tại danh mục này', true ) );
			// $this->redirect(array('action'=>'index'));
		}
		if ($this->Weblink->delete ( $id )) {
			$this->Session->setFlash ( __ ( 'Xóa danh mục thành công', true ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		$this->Session->setFlash ( __ ( 'Danh mục không xóa được', true ) );
		$this->redirect ( array (
				'action' => 'index' 
		) );
	}
	function edit($id = null) {
		$this->account ();
		$this->loadModelNew ( 'Weblink' );
		if (! $id && empty ( $this->data )) {
			$this->Session->setFlash ( __ ( 'Không tồn tại danh mục này', true ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		if (! empty ( $this->data )) {
			if ($this->Weblink->save ( $this->data )) {
				$this->Session->setFlash ( __ ( 'Sửa thành công', true ) );
				$this->redirect ( array (
						'action' => 'index' 
				) );
			} else {
				$this->Session->setFlash ( __ ( 'Sủa không thành công. Vui long thử lại', true ) );
			}
		}
		if (empty ( $this->data )) {
			$this->data = $this->Weblink->read ( null, $id );
		}
	}
	function _find_list() {
		$this->loadModelNew ( 'Weblink' );
		return $this->Weblink->generatetreelist ( null, null, null, '__' );
	}
	// check ton tai tai khoan
	function account() {
		if (! $this->Session->read ( "id" ) || ! $this->Session->read ( "name" )) {
			$this->redirect ( '/' );
		}
	}
	function active($id = null) {
		 $this->account();
		$this->loadModelNew('Weblink');
		if (empty ( $id )) {
			$this->Session->setFlash ( __ ( 'Khôn tồn tại danh mục này', true ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		$data ['Weblink'] = $this->data ['Weblink'];
		$data ['Weblink'] ['id'] = $id;
		$data ['Weblink'] ['status'] = 1;
		if ($this->Weblink->save ( $data ['Weblink'] )) {
			$this->Session->setFlash ( __ ( 'Danh mục kích hoạt thành công', true ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		$this->Session->setFlash ( __ ( 'Danh mục không kich hoạt được', true ) );
		$this->redirect ( array (
				'action' => 'index' 
		) );
	}
	function view($id = null) {
		$this->loadModelNew('Weblink');
		if (! $id) {
			$this->Session->setFlash ( __ ( 'Không tồn tại', true ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		$this->set ( 'views', $this->Weblink->read ( null, $id ) );
	}
	function close($id = null) {
		//$this->account();
		$this->loadModelNew('Weblink');
		if (empty ( $id )) {
			$this->Session->setFlash ( __ ( 'Khôn tồn tại danh mục này', true ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		$data ['Weblink'] = $this->data ['Weblink'];
		$data ['Weblink'] ['id'] = $id;
		$data ['Weblink'] ['status'] = 0;
		if ($this->Weblink->save ( $data ['Weblink'] )) {
			$this->Session->setFlash ( __ ( 'Danh mục không được hiển thị', true ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		$this->Session->setFlash ( __ ( 'Danh mục không close được', true ) );
		$this->redirect ( array (
				'action' => 'index' 
		) );
	}
	function beforeFilter() {
		$this->layout = 'admin';
	}
}
?>