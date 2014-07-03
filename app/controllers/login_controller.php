<?php
@session_start();
class LoginController extends AppController {

	var $name = 'Login';
	var $uses =array('Userscms','Setting');
	
	function index() {
	}
	function check_login() {	
	
		//echo $_COOKIE["url"];
		//die;
		//$a=$this->Setting->findById(1);
		//pr($this->Setting->findById(1)); die;
		//$link=$a['Setting']['link'];
		$link = DOMAIN;
		if ($this->Session->check('link'))
			$link = DOMAIN.$this->Session->read('link');
	
		if(!empty($_POST['shopname']) && !empty($_POST['password'])){
			$check=$this->Userscms->findByShopname($_POST['shopname']);
			
			if($check){
				if($check['Userscms']['password']==md5($_POST['password']) && $check['Userscms']['status']==1){
					$this->Session->write('id',$check['Userscms']['id']);
					$this->Session->write('shopname',$check['Userscms']['shopname']);
					$this->Session->write('nameuser',$check['Userscms']['shopname']);
					$this->Session->write('email',$check['Userscms']['email']);
					$this->Session->write('slug',$check['Userscms']['slug']);
					echo "<script>alert('".json_encode('Chúc mừng bạn đã đăng nhập thành công !')."');</script>";
					//echo $link; die;
					//echo $this->Session->read('nameuser');  die;
					echo "<script>location.href='".$link."'</script>";
					
				
					
				}
				else {
						echo "<script>alert('".json_encode('Mật khẩu không đúng hoặc tài khoản của bạn đã bị khóa!')."');</script>";
						
						echo "<script>location.href='".$link."'</script>";
				}
			}else{
				echo "<script>alert('".json_encode('Tên đăng nhập không đúng !')."');</script>";
				echo "<script>location.href='".$link."'</script>";
			}
			
		}
	}
	function login_email() {
	$data=$this->Session->read('thongtin');
	$data['email']=$_POST['email'];
	$this->Session->write('thongtin',$data);
	echo "<script>location.href='".DOMAIN."don-hang'</script>";
	}
	
	function logout() {
		$this->Session->delete('Userscms');
		$this->Session->delete('id');
		
		$this->Session->delete('nameuser');
		
		$this->Session->delete('shopname');
		$this->Session->delete('phone');
		$this->Session->delete('userscms');
		$this->Session->delete('sex');
		$this->Session->delete('birth_date');
		$this->Session->delete('productid');
				$link = DOMAIN;
		if ($this->Session->check('link'))
			$link = DOMAIN.$this->Session->read('link');
		echo "<script>location.href='".$link."'</script>";
	}


}
?>
