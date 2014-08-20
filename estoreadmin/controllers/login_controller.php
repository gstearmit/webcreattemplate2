<?php
class LoginController extends AppController {

	var $name = 'Login';
	var $uses=array('Estore_user','Shop');
	function index() {

	}
	function encryptIt( $q ) {
		$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
		$qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
		return( $qEncoded );
	}
	
	function decryptIt( $q ) {
		$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
		$qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
		return( $qDecoded );
	}
	
	function login() {
	
		$ipserver = $_SERVER['SERVER_ADDR'];
		$namwserver = $_SERVER['SERVER_NAME'];
		if($namwserver != IP_SERVER_TEST){  // SERVER DIREACT
				
		}elseif($namwserver === IP_SERVER_TEST){  // LOCALHOST
		}
		
	

		$data['Shop'] = $this->data['Shop'];
		if (empty($data['Shop']['email'])) {
			$this->Session->setFlash(__('Please enter your Email.', true));
			$this->redirect(array('action'=>'index'));
		}elseif(empty($data['Shop']['userpass'])){
			$this->Session->setFlash(__('Please enter a password', true));
			$this->redirect(array('action'=>'index'));
		}else{
			//$chek=$this->Shop->findByEmail($data['Shop']['email']);
			$chek=$this->Shop->find ( 'all', array (
									'conditions' => array (
									'Shop.id' => $data['Shop']['id'],
									'Shop.email' => $data['Shop']['email'],
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
		}
			if(is_array($chek) and !empty($chek))
			{
				foreach($chek as $shop){
					$databasename = $shop['Shop']['databasename'];
					$password = $shop['Shop']['password'];
					$username = $shop['Shop']['username'];
					$hostname = $shop['Shop']['hostname'];
					$shop_id = $shop['Shop']['id'];
					$nameproject = $shop['Shop']['name'];           // $nameproject is name Ctronller
					$email = trim($shop['Shop']['email']);
					$userpass = $shop['Shop']['userpass'];
					//pr($chek);die();
				}
			}
			
			
			if($userpass!=$this->encryptIt($data['Shop']['userpass'])){
				
					echo "<script>alert('".json_encode('Incorrect password !')."');</script>";
					echo "<script>location.href='".DOMAINADESTORE."'</script>";
					pr($userpass);die();
				}
			if($email != $data['Shop']['email']){
				echo "<script>alert('".json_encode('Email is not true. Please re-enter!')."');</script>";
				echo "<script>location.href='".DOMAINADESTORE."'</script>";
			}
			//pr($data);die();
			if($userpass===$this->encryptIt($data['Shop']['userpass']) and $email===$data['Shop']['email']){
				//echo "jdfnvjkfdnvlfdjgol";
				$this->Session->write('id',$shop_id);
				$this->Session->write('name',$nameproject);
				$this->redirect('/home');
				
			}
		
		
// 		$data['Estore_user'] = $this->data['Estore_user'];
// 		if (empty($data['Estore_user']['name'])) {
// 			$this->Session->setFlash(__('Xin vui lòng nhập tên đăng nhập', true));
// 			$this->redirect(array('action'=>'index'));
// 		}elseif(empty($data['Estore_user']['password'])){
// 			$this->Session->setFlash(__('Xin vui lòng nhập mật khẩu', true));
// 			$this->redirect(array('action'=>'index'));
// 		}else{
// 			$chek=$this->Estore_user->findByName($data['Estore_user']['name']);
// 			if($chek){
// 				if($chek['Estore_user']['password']==md5($data['Estore_user']['password'])){
// 					$this->Session->write('id',$chek['Estore_user']['id']);
// 					$this->Session->write('name',$chek['Estore_user']['name']);
// 					$this->redirect('/home');
// 				}else{
// 					echo "<script>alert('".json_encode('Mật khẩu không đúng !')."');</script>";
// 					echo "<script>location.href='".DOMAINAD."'</script>";
// 				}			
// 			}else{
// 				echo "<script>alert('".json_encode('Tên đăng nhập không đúng. Xin vui lòng nhập lại !')."');</script>";
// 				echo "<script>location.href='".DOMAINAD."'</script>";
// 			}
// 		}

	}
	//lay lai password
	function password() {
		$this->layout='password';
	}
	function check_pass() {

	}


	//logout ra khoi he thong
	function logout(){
		$this->Session->delete('id');
		$this->Session->delete('name');		
		  unset($_SESSION['shopingcart']);
		$this->redirect(array('action'=>'index'));
	}	

	// chon layout
	function beforeFilter(){
		$this->layout='login';
	}

	}
?>
