<?php
class BannersController extends AppController {

	var $name = 'Banners';
	var $uses = array (
			'Shop',
			'Banner'
	);
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
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
		  $this->loadModelNew ( 'Banner' );
		 // $conditions=array('News.status'=>1);
		  $this->paginate = array('limit' => '15','order' => 'Banner.id DESC');
	      $this->set('banners', $this->paginate('Banner',array()));
	      
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
		$this->loadModelNew ( 'Banner' );
		if (!empty($this->data)) {
			$this->Banner->create();
			$data['Banner'] = $this->data['Banner'];
			$data['Banner']['images']=$_POST['userfile'];
			if ($this->Banner->save($data['Banner'])) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		}
		$this->layout='admin_validate';
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
		$this->loadModelNew ( 'Banner' );
		if (!$id) {
			$this->Session->setFlash(__('Không tồn tại', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('views', $this->Banner->read(null, $id));
	}
	//close tin tuc
	function close($id=null) {
		$this->account();
		$this->loadModelNew ( 'Banner' );
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Banner'] = $this->data['Banner'];
		$data['Banner']['id']=$id;
		$data['Banner']['status']=0;
		if ($this->Banner->save($data['Banner'])) {
			$this->Session->setFlash(__('Bài viết không được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không close được', true));
		$this->redirect(array('action' => 'index'));

	}
	// active tin bai viêt
	function active($id=null) {
		$this->loadModelNew ( 'Banner' );
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Banner'] = $this->data['Banner'];
		$data['Banner']['id']=$id;
		$data['Banner']['status']=1;
		if ($this->Banner->save($data['Banner'])) {
			$this->Session->setFlash(__('Bài viết được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không hiển được bài viết', true));
		$this->redirect(array('action' => 'index'));
	}
	// sua tin da dang
	function edit($id = null) {
		$this->loadModelNew ( 'Banner' );
		$this->account();
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại ', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$data['Banner'] = $this->data['Banner'];
			$data['Banner']['images']=$_POST['userfile'];
			if ($this->Banner->save($data['Banner'])) {
				$this->Session->setFlash(__('Bài viết sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Bài viết này không sửa được vui lòng thử lại.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Banner->read(null, $id);
		}
		$this->set('edit',$this->Banner->findById($id));
		$this->layout='admin_validate';
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
		$this->loadModelNew ( 'Banner' );
		$this->account();		
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Banner->delete($id)) {
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
		$this->layout='adminnew';
	}

}
?>
