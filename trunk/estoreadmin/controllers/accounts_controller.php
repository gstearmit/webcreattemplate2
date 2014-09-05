<?php
class AccountsController extends AppController {

	var $name = 'Accounts';
	var $uses=array('Shop','User');
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
	   $this->loadModelNew ( 'User' );
	   $this->set('users',$this->User->find('all'));
	   
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
	function edit_pass($id=null) 
    {
		$this->account();
		$this->loadModelNew ( 'User' );
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại ', true));
			$this->redirect(array('action' => 'index'));
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
		$this->set('edit',$this->User->findById($id));
		//$this->layout='admin_validate';
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
	function check_pass() {
		$this->loadModelNew ( 'User' );
		if (!empty($this->data)){
			$data['User'] = $this->data['User'];
			if($data['User']['pass_old']=='' || $data['User']['pass_new']==''){
				echo "<script>alert('".json_encode('Bạn vui lòng nhập đầy đủ mật khẩu cũ và mật khẩu mới!')."');</script>";
				echo "<script>history.back();</script>";				
			}else{
				$check=$this->User->findById($data['User']['id']);
				if($check['User']['password']!=md5($data['User']['pass_old'])){
					//echo $check['User']['password'];
					echo "<script>alert('".json_encode('Mật khẩu cũ không đúng! Vui lòng thực hiện lại!')."');</script>";
					echo "<script>history.back();</script>";
				}else{
					$data['User']['password']=md5($data['User']['pass_new']);
						if ($this->User->save($data['User'])) {
							echo "<script>alert('".json_encode('Tài khoản của bạn đã thay đổi thành công!')."');</script>";
							echo "<script>location.href='".DOMAINADESTORE."accounts'</script>";
						}
				}
			}
		}
	}
	
	function add(){
		$this->loadModelNew ( 'User' );
		if(!empty($this->data)){
			//pr($this->data);die;
			if($this->data['User']['password']!=$this->data['User']['pass2'])
	         echo '<script language="javascript"> alert("Hai trường password nhập không khớp"); window.history.back(); </script>';
	        $this->data['User']['password']=md5($this->data['User']['password']);
			$this->User->create();
			if($this->User->save($this->data))
			$this->redirect(array('action' => 'index'));
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
	function delete($id=null){
		$this->loadModelNew ( 'User' );
		if(!empty($id))
		$this->User->delete($id);
		$this->redirect(array('action' => 'index'));
	}

	//check ton tai tai khoan
	function account(){
		if(!$this->Session->read("id") || !$this->Session->read("name")){
			$this->redirect('/');
		}
	}
	function beforeFilter(){
		$this->layout='adminnew';
	}

}
?>
