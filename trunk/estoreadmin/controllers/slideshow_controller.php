<?php
class SlideshowController extends AppController {

	var $name = 'Slideshow';
	var $uses = array (
			'Shop',
			'Slideshow'
			
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
		  $this->loadModelNew('Slideshow');
		  $this->paginate = array('limit' => '15','order' => 'Slideshow.id DESC');
	      $this->set('slideshow', $this->paginate('Slideshow',array()));
			
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
	
	function add(){
		$this->account();
		$this->loadModelNew('Slideshow');
		if (!empty($this->data)) {
			$this->Slideshow->create();
			$data['Slideshow'] = $this->data['Slideshow'];
            $data['Slideshow']['images'] =$_POST['userfile'];
			if ($this->Slideshow->save($data['Slideshow'])) {
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
	
	function close($id=null) {
		$this->account();
		$this->loadModelNew('Slideshow');
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại ', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Slideshow'] = $this->data['Slideshow'];
		$data['Slideshow']['id']= $id;
		$data['Slideshow']['status']=0;
		if ($this->Slideshow->save($data['Slideshow'])) {
			$this->Session->setFlash(__('Hình ảnh không được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Hình ảnh không close được', true));
		$this->redirect(array('action' => 'index'));

	}
	
	function active($id=null) {
		$this->account();
		$this->loadModelNew('Slideshow');
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại ', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Slideshow'] = $this->data['Slideshow'];
		$data['Slideshow']['id']= $id;
		$data['Slideshow']['status']=1;
		if ($this->Slideshow->save($data['Slideshow'])) {
			$this->Session->setFlash(__('Hình ảnh được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Hình ảnh không active được', true));
		$this->redirect(array('action' => 'index'));

	}

	function edit($id = null) {
		$this->account();
		$this->loadModelNew('Slideshow');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại ', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$data['Slideshow'] = $this->data['Slideshow'];
            $data['Slideshow']['images'] =$_POST['userfile'];
			if ($this->Slideshow->save($data['Slideshow'])) {
				$this->Session->setFlash(__('Bài viết sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Bài viết này không sửa được vui lòng thử lại.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Slideshow->read(null, $id);
		}
		
		$this->set('edit',$this->Slideshow->findById($id));
		
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
	// Xoa hinh anh
	function delete($id = null) {
		$this->account();	
		$this->loadModelNew('Slideshow');
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại hình ảnh này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Slideshow->delete($id)) {
			$this->Session->setFlash(__('Xóa  thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Không xóa được', true));
		$this->redirect(array('action' => 'index'));
	}

	//check ton tai tai khoan
	function account(){
		if(!$this->Session->read("id") || !$this->Session->read("name")){
			$this->redirect('/');
		}
	}
	function beforeFilter(){
		$this->layout='admin';
	}
	
	function search()  {
		$this->loadModelNew('Slideshow');
		$keyword=@$_POST['name'];
		
		if($keyword!="")
			$x['Slideshow.name like']='%'.$keyword.'%';
		$this->paginate = array('conditions'=>@$x,'limit' => '12','order' => 'Slideshow.id DESC');
		$this->set('Slideshow', $this->paginate('Slideshow',array()));
		
		
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
	

}
?>
