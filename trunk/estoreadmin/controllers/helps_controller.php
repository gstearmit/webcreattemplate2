<?php
class HelpsController extends AppController {
	var $name = 'Helps';
	var $uses = array (
			'Shop',
			'Help' 
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
		$this->loadModelNew ( 'Help' );
		$this->paginate = array (
				'limit' => '5',
				'order' => 'Help.id DESC' 
		);
		$this->set ( 'Helps', $this->paginate ( 'Help', array () ) );
		
		//NGÔN NGỮ
		$urlTmp = $_SERVER['REQUEST_URI'];
			
		if (stripos($urlTmp, "?language"))
		{
			$urlTmp = explode ( "?", $urlTmp );
			$lang = explode ( "=", $urlTmp [1] );
			$lang = $lang [1];
		
			if (isset ( $lang )) {
				//$this->Session->write ( 'language', $lang );
				Configure::write('Config.language', $lang);
			} else {
				$this->Session->delete ( 'language' );
			}
		} else {
		
			$lang = "vie"; // default
			//$this->Session->write ( 'language', $lang );
			Configure::write('Config.language', $lang);
		}
		
		// +++++ check Langue
		$langue = $this->Session->read ( 'language' );
			
		if ($langue == null) {
			$urlTmp = $_SERVER ['REQUEST_URI'];
			if (stripos ( $urlTmp, "?language" )) {
				$urlTmp = explode ( "?", $urlTmp );
				$lang = explode ( "=", $urlTmp [1] );
				$lang = $lang [1];
				if (isset ( $lang )) {
					//$this->Session->write ( 'language', $lang );
					Configure::write('Config.language', $lang);
				} else {
					$this->Session->delete ( 'language' );
				}
			} else {
				$lang = "vie"; // default
				//$this->Session->write ( 'language', $lang );
				Configure::write('Config.language', $lang);
			}
		}
		$this->set ( 'langue', $langue );
	}
	function add() {
		$this->account ();
		$this->loadModelNew ( 'Help' );
		if (! empty ( $this->data )) {
			$this->Help->create ();
			$data ['Help'] = $this->data ['Help'];
			if ($this->Help->save ( $data ['Help'] )) {
				$this->Session->setFlash ( __ ( 'Thêm mới thành công', true ) );
				$this->redirect ( array (
						'action' => 'index' 
				) );
			} else {
				$this->Session->setFlash ( __ ( 'Thêm mới thất bại' ) );
			}
		}
		
		//NGÔN NGỮ
		$urlTmp = $_SERVER['REQUEST_URI'];
			
		if (stripos($urlTmp, "?language"))
		{
			$urlTmp = explode ( "?", $urlTmp );
			$lang = explode ( "=", $urlTmp [1] );
			$lang = $lang [1];
		
			if (isset ( $lang )) {
				//$this->Session->write ( 'language', $lang );
				Configure::write('Config.language', $lang);
			} else {
				$this->Session->delete ( 'language' );
			}
		} else {
		
			$lang = "vie"; // default
			//$this->Session->write ( 'language', $lang );
			Configure::write('Config.language', $lang);
		}
		
		// +++++ check Langue
		$langue = $this->Session->read ( 'language' );
			
		if ($langue == null) {
			$urlTmp = $_SERVER ['REQUEST_URI'];
			if (stripos ( $urlTmp, "?language" )) {
				$urlTmp = explode ( "?", $urlTmp );
				$lang = explode ( "=", $urlTmp [1] );
				$lang = $lang [1];
				if (isset ( $lang )) {
					//$this->Session->write ( 'language', $lang );
					Configure::write('Config.language', $lang);
				} else {
					$this->Session->delete ( 'language' );
				}
			} else {
				$lang = "vie"; // default
				//$this->Session->write ( 'language', $lang );
				Configure::write('Config.language', $lang);
			}
		}
		$this->set ( 'langue', $langue );
	}
	function delete($id = null) {
		$this->account ();
		$this->loadModelNew ( 'Help' );
		if (empty ( $id )) {
			$this->Session->setFlash ( __ ( 'Khôn tồn tại danh mục này', true ) );
			// $this->redirect(array('action'=>'index'));
		}
		if ($this->Help->delete ( $id )) {
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
		$this->loadModelNew ( 'Help' );
		if (! $id && empty ( $this->data )) {
			$this->Session->setFlash ( __ ( 'Không tồn tại danh mục này', true ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		if (! empty ( $this->data )) {
			if ($this->Help->save ( $this->data )) {
				$this->Session->setFlash ( __ ( 'Sửa thành công', true ) );
				$this->redirect ( array (
						'action' => 'edit' 
				) );
			} else {
				$this->Session->setFlash ( __ ( 'Sủa không thành công. Vui long thử lại', true ) );
			}
		}
		if (empty ( $this->data )) {
			$this->data = $this->Help->read ( null, $id );
		}
		
		//NGÔN NGỮ
		$urlTmp = $_SERVER['REQUEST_URI'];
			
		if (stripos($urlTmp, "?language"))
		{
			$urlTmp = explode ( "?", $urlTmp );
			$lang = explode ( "=", $urlTmp [1] );
			$lang = $lang [1];
		
			if (isset ( $lang )) {
				//$this->Session->write ( 'language', $lang );
				Configure::write('Config.language', $lang);
			} else {
				$this->Session->delete ( 'language' );
			}
		} else {
		
			$lang = "vie"; // default
			//$this->Session->write ( 'language', $lang );
			Configure::write('Config.language', $lang);
		}
		
		// +++++ check Langue
		$langue = $this->Session->read ( 'language' );
			
		if ($langue == null) {
			$urlTmp = $_SERVER ['REQUEST_URI'];
			if (stripos ( $urlTmp, "?language" )) {
				$urlTmp = explode ( "?", $urlTmp );
				$lang = explode ( "=", $urlTmp [1] );
				$lang = $lang [1];
				if (isset ( $lang )) {
					//$this->Session->write ( 'language', $lang );
					Configure::write('Config.language', $lang);
				} else {
					$this->Session->delete ( 'language' );
				}
			} else {
				$lang = "vie"; // default
				//$this->Session->write ( 'language', $lang );
				Configure::write('Config.language', $lang);
			}
		}
		$this->set ( 'langue', $langue );
	}
	function close($id = null) {
		// $this->account();
		$this->loadModelNew ( 'Help' );
		if (empty ( $id )) {
			$this->Session->setFlash ( __ ( 'Khôn tồn tại ', true ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		$data ['Help'] = $this->data ['Help'];
		$data ['Help'] ['id'] = $id;
		$data ['Help'] ['status'] = 0;
		if ($this->Help->save ( $data ['Help'] )) {
			$this->Session->setFlash ( __ ( 'Hình ảnh không được hiển thị', true ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		$this->Session->setFlash ( __ ( 'Hình ảnh không close được', true ) );
		$this->redirect ( array (
				'action' => 'index' 
		) );
	}
	function active($id = null) {
		// $this->account();
		$this->loadModelNew ( 'Help' );
		if (empty ( $id )) {
			$this->Session->setFlash ( __ ( 'Khôn tồn tại ', true ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		$data ['Help'] = $this->data ['Help'];
		$data ['Help'] ['id'] = $id;
		$data ['Help'] ['status'] = 1;
		if ($this->Help->save ( $data ['Help'] )) {
			$this->Session->setFlash ( __ ( 'Hình ảnh được hiển thị', true ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		$this->Session->setFlash ( __ ( 'Hình ảnh không active được', true ) );
		$this->redirect ( array (
				'action' => 'index' 
		) );
	}
	function _find_list() {
		$this->loadModelNew ( 'Portfolio' );
		return $this->Portfolio->generatetreelist ( null, null, null, '__' );
	}
	// check ton tai tai khoan
	function account() {
		if (! $this->Session->read ( "id" ) || ! $this->Session->read ( "name" )) {
			$this->redirect ( '/' );
		}
	}
	function beforeFilter() {
		$this->layout = 'admin';
	}
}
?>