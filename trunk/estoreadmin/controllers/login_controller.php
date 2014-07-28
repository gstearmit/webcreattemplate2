<?php
class LoginController extends AppController {

	var $name = 'Login';
	var $uses=array('Estore_user');
	function index() {

	}
	// chekh dang nhap
	function login() {
		$data['Estore_user'] = $this->data['Estore_user'];
		if (empty($data['Estore_user']['name'])) {
			$this->Session->setFlash(__('Xin vui lòng nhập tên đăng nhập', true));
			$this->redirect(array('action'=>'index'));
		}elseif(empty($data['Estore_user']['password'])){
			$this->Session->setFlash(__('Xin vui lòng nhập mật khẩu', true));
			$this->redirect(array('action'=>'index'));
		}else{
			$chek=$this->Estore_user->findByName($data['Estore_user']['name']);
			if($chek){
				if($chek['Estore_user']['password']==md5($data['Estore_user']['password'])){
					$this->Session->write('id',$chek['Estore_user']['id']);
					$this->Session->write('name',$chek['Estore_user']['name']);
					$this->redirect('/home');
				}else{
					echo "<script>alert('".json_encode('Mật khẩu không đúng !')."');</script>";
					echo "<script>location.href='".DOMAINAD."'</script>";
				}			
			}else{
				echo "<script>alert('".json_encode('Tên đăng nhập không đúng. Xin vui lòng nhập lại !')."');</script>";
				echo "<script>location.href='".DOMAINAD."'</script>";
			}
		}

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
