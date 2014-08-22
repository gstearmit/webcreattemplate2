<?php
class AdvertisementsController extends AppController {
	var $name = 'Advertisements';
	var $uses = array (
			'Shop',
			'Advertisement' 
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
		$this->loadModelNew ( 'Advertisement' );
		$this->paginate = array (
				'limit' => '15',
				'order' => 'Advertisement.id DESC' 
		);
		$this->set ( 'Advertisements', $this->paginate ( 'Advertisement', array () ) );
		
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
		$this->loadModelNew ( 'Advertisement' );
		if (! empty ( $this->data )) {
			$this->Advertisement->create ();
			$data ['Advertisement'] = $this->data ['Advertisement'];
			$data ['Advertisement'] ['images'] = $_POST ['userfile'];
			if ($this->Advertisement->save ( $data ['Advertisement'] )) {
				$this->Session->setFlash ( __ ( 'Thêm mới danh mục thành công', true ) );
				$this->redirect ( array (
						'action' => 'index' 
				) );
			} else {
				$this->Session->setFlash ( __ ( 'Thêm mơi danh mục thất bại. Vui long thử lại', true ) );
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
	// close tin tuc
	function close($id = null) {
		$this->account ();
		$this->loadModelNew ( 'Advertisement' );
		if (empty ( $id )) {
			$this->Session->setFlash ( __ ( 'Khôn tồn tại bài viết này', true ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		$data ['Advertisement'] = $this->data ['Advertisement'];
		$data['Advertisement']['id']=$id;
		$data ['Advertisement'] ['status'] = 0;
		if ($this->Advertisement->save ( $data ['Advertisement'] )) {
			$this->Session->setFlash ( __ ( 'Bài viết không được hiển thị', true ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		$this->Session->setFlash ( __ ( 'Bài viết không close được', true ) );
		$this->redirect ( array (
				'action' => 'index' 
		) );
	}
	function search() {
		$keyword = @$_POST ['name'];
		$this->loadModelNew ( 'Advertisement' );
		if ($keyword != "")
			$x ['Advertisement.name like'] = '%' . $keyword . '%';
		$this->paginate = array (
				'conditions' => @$x,
				'limit' => '12',
				'order' => 'Advertisement.id DESC' 
		);
		$this->set ( 'Advertisements', $this->paginate ( 'Advertisement', array () ) );
		
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
	
	// active tin bai viêt
	function active($id = null) {
		$this->account ();
		$this->loadModelNew ( 'Advertisement' );
		if (empty ( $id )) {
			$this->Session->setFlash ( __ ( 'Khôn tồn tại bài viết này', true ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		$data ['Advertisement'] = $this->data ['Advertisement'];
		$data['Advertisement']['id']=$id;
		$data ['Advertisement'] ['status'] = 1;
		if ($this->Advertisement->save ( $data ['Advertisement'] )) {
			$this->Session->setFlash ( __ ( 'Bài viết được hiển thị', true ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		$this->Session->setFlash ( __ ( 'Bài viết không hiển được bài viết', true ) );
		$this->redirect ( array (
				'action' => 'index' 
		) );
	}
	// check ton tai tai khoan
	function delete($id = null) {
		$this->account ();
		$this->loadModelNew ( 'Advertisement' );
		if (empty ( $id )) {
			$this->Session->setFlash ( __ ( 'Khôn tồn tại danh mục này', true ) );
			// $this->redirect(array('action'=>'index'));
		}
		if ($this->Advertisement->delete ( $id )) {
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
		$this->loadModelNew ( 'Advertisement' );
		if (! $id && empty ( $this->data )) {
			$this->Session->setFlash ( __ ( 'Không tồn tại danh mục này', true ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		if (! empty ( $this->data )) {
			$data ['Advertisement'] = $this->data ['Advertisement'];
			$data ['Advertisement'] ['images'] = $_POST ['userfile'];
			if ($this->Advertisement->save ( $data ['Advertisement'] )) {
				$this->Session->setFlash ( __ ( 'Sửa thành công', true ) );
				$this->redirect ( array (
						'action' => 'index' 
				) );
			} else {
				$this->Session->setFlash ( __ ( 'Sủa không thành công. Vui long thử lại', true ) );
			}
		}
		if (empty ( $this->data )) {
			$this->data = $this->Advertisement->read ( null, $id );
			$this->set ( 'edit', $this->Advertisement->read ( null, $id ) );
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
	function _find_list() {
		$this->loadModelNew ( 'Portfolio' );
		return $this->Portfolio->generatetreelist ( null, null, null, '__' );
	}
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