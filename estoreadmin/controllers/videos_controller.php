<?php
class VideosController extends AppController {

	var $name = 'Videos';
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
	var $uses = array (
			'Shop',
			'Video'
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
		  $this->account();
		  $this->loadModelNew ( 'Video' );
		 // $conditions=array('News.status'=>1);
		  $this->paginate = array('limit' => '15','order' => 'Video.id DESC');
	      $this->set('videos', $this->paginate('Video',array()));
	      

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
	//Them bai viet
	function add() {
		$this->account();
		$this->loadModelNew ( 'Video' );
		if (!empty($this->data)) {
			$this->Video->create();
			$data['Video'] = $this->data['Video'];
			if ($this->Video->save($data['Video'])) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
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
	//view mot tin 
	function view($id = null) {
		$this->loadModelNew ( 'Video' );
		if (!$id) {
			$this->Session->setFlash(__('Không tồn tại', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('views', $this->Video->read(null, $id));
	}
	//close tin tuc
	function close($id=null) {
		$this->account();
		$this->loadModelNew ( 'Video' );
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Video'] = $this->data['Video'];
		$data['Video']['id']=$id;
		$data['Video']['status']=0;
		if ($this->Video->save($data['Video'])) {
			$this->Session->setFlash(__('Bài viết không được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không close được', true));
		$this->redirect(array('action' => 'index'));

	}
	// active tin bai viêt
	function active($id=null) {
		$this->account();
		$this->loadModelNew ( 'Video' );
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Video'] = $this->data['Video'];
		$data['Video']['status']=1;
		$data['Video']['id']=$id;
		if ($this->Video->save($data['Video'])) {
			$this->Session->setFlash(__('Bài viết được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không hiển được bài viết', true));
		$this->redirect(array('action' => 'index'));
	}
	// sua tin da dang
	function edit($id = null) {
		$this->account();
		$this->loadModelNew ( 'Video' );
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại ', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$data['Video'] = $this->data['Video'];
			if ($this->Video->save($data['Video'])) {
				$this->Session->setFlash(__('Bài viết sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Bài viết này không sửa được vui lòng thử lại.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Video->read(null, $id);
		}
		$this->set('edit',$this->Video->findById($id));
		
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
	// Xoa cac dang
	function delete($id = null) {
		$this->account();	
		$this->loadModelNew ( 'Video' );
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Video->delete($id)) {
			$this->Session->setFlash(__('Xóa bài viết thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không xóa được', true));
		$this->redirect(array('action' => 'index'));
	}
	function _find_list() {
		$this->loadModelNew ( 'Category' );
		return $this->Category->generatetreelist(null, null, null, '__');
	}
	//check ton tai tai khoan
	function account(){
		if(!$this->Session->read("id") || !$this->Session->read("name")){
			$this->redirect('/');
		}
	}
	// chon layout
	function beforeFilter(){
		$this->layout='admin';
	}

}
?>
