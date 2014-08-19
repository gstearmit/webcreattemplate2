<?php
class LoginController extends AppController {

	var $name = 'Login';
	var $uses=array('EshopdaquyEshopdaquyUser');
	function index() {

	}
	// chekh dang nhap
	function login() {
		$data['EshopdaquyUser'] = $this->data['EshopdaquyUser'];
		if (empty($data['EshopdaquyUser']['name'])) {
			$this->Session->setFlash(__('Xin vui lòng nhập tên đăng nhập', true));
			$this->redirect(array('action'=>'index'));
		}elseif(empty($data['EshopdaquyUser']['password'])){
			$this->Session->setFlash(__('Xin vui lòng nhập mật khẩu', true));
			$this->redirect(array('action'=>'index'));
		}else{
			$chek=$this->EshopdaquyUser->findByName($data['EshopdaquyUser']['name']);
			if($chek){
				if($chek['EshopdaquyUser']['password']==md5($data['EshopdaquyUser']['password'])){
					$this->Session->write('id',$chek['EshopdaquyUser']['id']);
					$this->Session->write('name',$chek['EshopdaquyUser']['name']);
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
		$this->redirect(array('action'=>'index'));
	}	

	// chon layout
	function beforeFilter(){
		$this->layout='login';
	}

}
?>
