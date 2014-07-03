<?php
class UserController extends AppController {

	var $name = 'User';
	var $uses =array('User','User_member');
    //var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');

	var $components = array('Global','Email','SmtpEmail','Upload');	
	function index() {


	}
        /* Ham save tai khoan tao ----------------------------------------------------*/
        function add() {


            $ok=0;
            $errot=array();
            if($_POST['user']==''){
                $ok=1;
                $errot['user']='Tên đăng nhập không được để trống';
            }
            if($_POST['password']==''){
                $ok=1;
                $errot['password']='Password không được để trống';
            }
            if($_POST['repassword']==''){
                $ok=1;
                $errot['repassword']='Bạn chưa nhập xác nhận password';
            }

            if($_POST['repassword'] != $_POST['password']){
                $ok=1;
                $errot['repassword']='Mật khẩu không khớp';
            }

            if($_POST['name']==''){
                $ok=1;
                $errot['name']='Bạn chưa nhập vào họ tên';
            }

            if($_POST['month']=='--Tháng --' || $_POST['date']=='--Ngày --' || $_POST['years']=='-- Năm --'){
                $ok=1;
                $errot['date']='Bạn chưa chọn ngày sinh';
            }

            if($_POST['address']==''){
                $ok=1;
                $errot['address']='Bạn chưa nhập vào địa chỉ';
            }


            $pattern = '/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/';
            $mailStr = $_POST['email'];
            if(preg_match($pattern, $mailStr)==0) {
                $ok=1;
                $errot['email']='Email không đúng';
            }

            if($_POST['email']==''){
                $ok=1;
                $errot['email']='Bạn chưa nhập vào email';
            }

            $mail=$this->User_member->findAllByEmail($_POST['email']);
            if(!empty($mail)){
                $ok=1;
                $errot['email']='Email này đã tồn tại';
            }
            if($_POST['phone']==''){
                $ok=1;
                $errot['phone']='Bạn chưa nhập số điện thoại';
            }


            if($_FILES['avata']['size']>1024*1024*1){
                $ok=1;
                $errot['avata']='File quá lớn';
            }

            $rest = substr($_FILES['avata']['name'], -3);



            if($rest='JPG' || $rest='jpg' || $rest='gif' || $rest='GIF' || $rest='png'){
            }else{
                $ok=1;
                $errot['avata']='Định dạng ảnh không đúng hãy kiểm tra lại';
            }
            if($_FILES['avata']['name']==''){
                $ok=1;
                $errot['avata']='Bạn chưa chọn avata';
            }
            if($_POST['security']!= $this->Session->read('security_code')){
                $ok=1;
                $errot['security']='Mã bảo vệ ko đúng';
            }
            if($_POST['security']==''){
                $ok=1;
                $errot['security']='Bạn chưa nhập mã bảo vệ';
            }

            /*----------upload file--------------------------*/
            $site_name = $_SERVER['HTTP_HOST'];
            $url_dir = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
            $url_this =  "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
            $upload_dir = "files/avata/";
            $upload_url = $url_dir."/files/";
            $message = $this->do_upload($upload_dir, $upload_url);
            /*----------upload file--------------------------*/
            if($message[0]==0){
                $ok=1;
                $errot['avata']='Quá trình upload sảy ra lỗi xin hãy thử lại';
            }


          if($ok==1){
              $this->set('errot',$errot);
              $this->render('index');
          }else{
                      if($this->Session->read('security_code')==$_POST['security']){
                          //insert vao db
                          $birth_date=$_POST['date'].'-'.$_POST['month'].'-'.$_POST['years'];
                          $member_register=array(

                                  'user'=>$_POST['user'],
                                  'password'=>md5($_POST['password']),
                                  'name'=>$_POST['name'],
                                  'email'=>$_POST['email'],
                                  'sex'=>$_POST['sex'],
                                  'date_birth'=>$birth_date,
                                  'address'=>$_POST['address'],
                                  'phone'=>$_POST['phone'],
                                  'avata'=>$message[1],
                                  'create'=> date('d-m-Y'),
                                  'status'=>1
                          );
                          if($this->User_member->save($member_register)){
                              echo "<script>alert('".json_encode('Đăng ký thành viên thành công')."');</script>";
                              echo "<script>location.href='".DOMAIN."'</script>";
                          }
                      }
          }
	}
    function do_upload($upload_dir, $upload_url) {
        /*
         * $site_name = $_SERVER['HTTP_HOST'];
              $url_dir = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
              $url_this =  "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

              $upload_dir = "files/avata/";
              $upload_url = $url_dir."/files/"; cho cái đoạn này ra ngoài
         *
         */
        $temp_name = $_FILES['avata']['tmp_name'];
        $exten = substr($_FILES['avata']['name'],-3);
        $file_name =  time().'.'.$exten;// $_FILES['avata']['name'];
        //$file_name = str_replace("\\","",$file_name);
        //$file_name = str_replace("'","",$file_name);
        $file_path = $upload_dir.$file_name;



        $result  =  move_uploaded_file($temp_name, $file_path);
        if (!chmod($file_path,0777))
            $message = 0;
        else
            $message =  1;
        return array($message,$file_name);
    }
	
	function district(){
		$this->layout= 'ajax';
		$citiesId=$_GET['citiesId'];
		if($citiesId==0){
			$this->set('check',0);
		}else{
			$this->set('check',1);
		}
		$this->District->unbindModel(array('hasMany' => array('Immovablee','User','Ward','Street')));
		$districts = $this->District->find('all',array('conditions'=>array('District.city_id'=>$citiesId,'District.status'=>1),'order'=>'District.number ASC'));
		$this->set('districts',$districts);				
		//$district=$this->District->findAllByCityId($citiesId);		
		//$this->set('districts',$district);
		
	}
        
        /* Ham check mail ton tai khi dang ky thanh vien */
	function ck_mail_register(){
		$this->layout= 'ajax';
		$this->User->unbindModel(array('hasMany' => array('Immovable')));
		$mail=$this->User->findAllByEmail($_GET['email']);
		//pr(count($mail));die();
		if (!preg_match('/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i',$_GET['email'])) {
			echo "<span style='color:#FF0000;padding-left:148px;'> </span>";	
		}
		else {
		if(count($mail)==0){
			echo "<span style='color:#00FF33;padding-left:148px;'>Email hợp lệ ! </span>"; 
		}
		if(count($mail)>0){
			foreach($mail AS $mail1){
				 if($mail1['User']['email'] == 1){
							$check = 1;	
							//break;
				 }
				else
				{
						$check = 0;	
						//break;
				}
			}
				if($check==1){
					echo "<span style='color:#00FF33;padding-left:148px;'>Email hợp lệ </span>";
				}
				elseif($check==0){
					echo "<span style='color:#FF0000;padding-left:148px;'>Email đã tồn tại </span>";
				}
					
		}
		
	}
        }
	
	
	/* Ham action email */
	function action_mail($action_mail,$id){
		$this->User->unbindModel(array('hasMany' => array('Immovable')));		
		$test=$this->User->find('all',array("conditions"=>array("User.active_key"=>$action_mail,"User.id"=>$id)));
	
		if(count($test)==0){
				echo "<script>alert('".json_encode('Kích hoạt tài khoản không thành công !')."');</script>";
				echo "<script>location.href='".DOMAIN."'</script>";
		}
		
		if(($test[0]['User']['active_key']==$action_mail) && ($test[0]['User']['status']==0)){
			$status=array(
				'User'=>array(
					'id'=>$id,
					'status'=>1,
				)
			);
			$this->User->save($status);
			//$this->Session->delete('id');
			//pr($id);die();
			echo "<script>alert('".json_encode('Chúc mừng bạn! tài khoản của bạn đã được kích hoạt bạn hãy đăng nhập để được hưởng những quyền lợi của thành viên ')."');</script>";		
			echo "<script>location.href='".DOMAIN."login'</script>";
		}
		if(($test[0]['User']['active_key']==$action_mail) && ($test[0]['User']['status']==1)){
				 $this->redirect('/home/error');
		}	
		
	}
	
						
	/* Ham khoi tao capcha*/
	function create_image(){
		$md5_hash = md5(rand(0,999));
		$security_code = substr($md5_hash, 15, 5);
		$this->Session->write('security_code',$security_code);
		$width = 80;
		$height = 22;
		$image = ImageCreate($width, $height);
		$black = ImageColorAllocate($image, 37, 170, 226);
		$white = ImageColorAllocate($image, 255, 255, 255);
		ImageFill($image, 0, 0, $black);
		ImageString($image, 5, 18, 3, $security_code, $white);
		header("Content-Type: image/jpeg");
		ImageJpeg($image);
		ImageDestroy($image);
	}	
	function create_image1($random){
		
		$md5_hash = md5(rand(0,999));
		$security_code = substr($md5_hash, 15, 5);
		$this->Session->write('security_code',$security_code);
		$width = 80;
		$height = 22;
		$image = ImageCreate($width, $height);
		$black = ImageColorAllocate($image, 37, 170, 226);
		$white = ImageColorAllocate($image, 255, 255, 255);
		ImageFill($image, 0, 0, $black);
		ImageString($image, 5, 18, 3, $security_code, $white);
		header("Content-Type: image/jpeg");
		ImageJpeg($image);
		ImageDestroy($image);
		
	}
	/* Ham lay lai mat khau */
	function forgot_password(){	
	}
	function ck_email_forgot_pass(){
		$this->layout='ajax';
		$email=$_GET['email_forgot_password'];
		$this->User->unbindModel(array('hasMany' => array('Immovable')));
		$check_mail=$this->User->findByEmail($email);
		if($check_mail['User']['email']){
			echo "<span style='color:#00FF00;margin:150px;'>ok</span>";
		}else{
			echo "<span style='color:#FF0000;margin:150px;font-size:11px;'>Email không đúng</span>";
		}	
	}
	function security_forgot_pass(){
		$this->layout='ajax';
		$security=$_GET['security'];		
		if($security==$this->Session->read('security_code')){
			echo "<span style='color:#00FF00;margin:150px;'>ok</span>";
		}else{
			echo "<span style='color:#FF0000;margin:150px;font-size:11px;'>Mã bảo mật không đúng</span>";
		}
	}
	function processor_forgot_password(){
		$this->User->unbindModel(array('hasMany' => array('Immovable')));
		$email=$this->User->findByEmail($_POST['email']);
		if($_POST['password']!=$this->Session->read('security_code')){
			echo "<script>alert('".json_encode('Mã bảo mật không đúng!')."');</script>";
			echo "<script>location.href='".DOMAIN."user/forgot_password'</script>";	
			
		}else if(empty($email)){
			echo "<script>alert('".json_encode('Email không đúng!')."');</script>";
			echo "<script>location.href='".DOMAIN."user/forgot_password'</script>";	
			
		}else{
			$md5_hash = md5(rand(0,999));
			$new_pass = substr($md5_hash, 15, 10);
			$email=$email['User']['email'];
		    //$this->Session->write('new_pass',$new_pass );
			//$this->Session->write('id',$id);
			$content = "Chào bạn!,<br><br>
				Đây là email giúp bạn lấy lại MẬT KHẨU cho tài khoản theo yêu cầu của bạn. 
				Mật khẩu hiện tại của bạn là: <b>".$new_pass."</b> Vui lòng <a href='".DOMAIN."user/activation/".$email."/".$new_pass."'> <b>click vào đây </b></a> hoặc copy và chạy đường link này : ".DOMAIN."user/activation/".$email."/".$new_pass."  để hoàn thành quá trình lấy lại mật khẩu. <br><br>
				Xin được thứ lỗi nếu bạn nhận được email này do nhầm lẫn của chúng tôi. <br><br>
				Nếu bạn có bất kỳ thắc mắc nào, hãy liên hệ với chúng tôi để nhận được sự hỗ trợ nhanh nhất.<br><br>
				-----------------<br><br>
				<b><i>Trân trọng!</i></b><br><br>
				<b><i>Batdongsanvtm.com</i></b><br><br>
				<b><i>&ldquo;Thông tin chính xác, dịch vụ chu đáo &ldquo;</i></b><br><br>			
				";
				//pr($content);die;
			if ($this->SmtpEmail->smtpmailer($_POST['email'], ADDRESS_EMAIL_SEND_ACTIVE,FROM_NAME_EMAIL_ACTIVE, SUBJECT_EMAIL_CHANGE_PASS,$content)){
					echo "<script>alert('".json_encode('Bạn hãy đăng nhập vào Email của bạn để hoàn thành quá trình lấy lại mật khẩu !')."');</script>";					
					echo "<script>location.href='".DOMAIN."'</script>";
				}
				else{
					$mail =false;
				}	
		}
	}
	function activation($email,$new_pass) {
		$this->User->unbindModel(array('hasMany' => array('Immovable')));
		$test=$this->User->find('all',array("conditions"=>array("User.email"=>$email,"User.ck_admin"=>0)));
		//pr($test);die;
		//pr($test[0]['User']['password']);die();
		if(count($test)==0){
				echo "<script>alert('".json_encode('Thay đổi mật khẩu không thành công !')."');</script>";
				echo "<script>location.href='".DOMAIN."'</script>";
		}
			
		if($test[0]['User']['password']!=Security::hash($new_pass, null, true)){
			$update_pass=array(
			'User'=>array(
				'id'=>$test[0]['User']['id'],
				'password'=>Security::hash($new_pass, null, true),
			)
		);	
		$this->User->save($update_pass);
		echo "<script>alert('".json_encode('Thay đổi mật khẩu thành công ! Bạn hãy đăng nhập để hưởng những quyền lợi của thành viên.')."');</script>";
		echo "<script>location.href='".DOMAIN."login'</script>";	
		}
		if(($test[0]['User']['email']==$email) && $test[0]['User']['password']==Security::hash($new_pass, null, true)){
			 $this->redirect('/home/error');
		}
		
	}
	function profile() {
		$this->checkIfLogged();
		$member_id=$this->Session->read('id');
		$edit=$this->User->findById($member_id);
		$this->set('edit',$edit);
	}

	function edit_profile() {
		$this->checkIfLogged();
		 if(!empty($this->data)){
			$this->User->save($this->data);
			/*$this->redirect('/home'); 
			 $data['User'] = $this->data['User'];		 
		 	  $profile=array(
              'User'=>array(
                    'id'=>$data['User']['id'],
					'email'=>$_POST['email'],
					'images'=>$_POST['images'],
					'name'=>$_POST['name'],
					'password'=>Security::hash($_POST['password'], null, true),
					'phone'=>$_POST['phone'],
					'sex'=>$_POST['sex'],
					'birth_date'=>$birth_date,	
				
        );)
        $this->User->save($profile);*/
        $this->redirect('/home');
		 }
       	}

	function confirm_pass() {
		if(!empty($this->data)){
			$data=$_POST['data'];	
			//pr($data);die();
			// $data['User'] = $this->data['User'];	
			if(($data['User']['password_old']=='') || ($data['User']['password']=='')){
				 echo "<script>alert('".json_encode('Bạn chưa nhập thông tin đầy đủ!')."');</script>";
				 echo "<script>history.back(-1);</script>";
			}else{
			
			$this->set('email',$data['User']['email']);	
			$this->set('password_old',$data['User']['password_old']);	
			$this->set('password',$data['User']['password']);	
			$this->set('id',$data['User']['id']);			
			}
		}
	}

	function change_pass() {		
		 if(!empty($this->data)){  
		 	$data=$_POST['data'];	
			// $data['User'] = $this->data['User'];						
			if($data['User']['password_new']=='' && $data['User']['password_old']==''){
				$this->redirect('/home');
			}
			if($data['User']['password_new']!='' && $data['User']['password_old']!='') {
				$ck_pass=$this->User->findById($data['User']['id']);

			if( $ck_pass['User']['password']==md5($data['User']['password_old'])){
					$change_passarray=array(
					'User'=>array(
							'id'=>$data['User']['id'],
							'password'=>md5($data['User']['password_new']),					
						)
					);
					$this->User->save($change_passarray);
					
					echo "<script>alert('".json_encode('Thay đổi mật khẩu thành công !')."');</script>";
					echo "<script>location.href='".DOMAIN."'</script>";
				
			 }
			 else{
			 	echo "<script>alert('".json_encode('Bạn nhập mật khẩu cũ không đúng !')."');</script>";
				echo "<script>history.back(-1);</script>";
			 }
		 }
		 }
		$member_id=$this->Session->read('id');
		$this->set('edit',$edit=$this->User->findById($member_id));
	}
	

  function checkIfLogged(){
		if(!$this->Session->read("email") || !$this->Session->read("id")){
			 $this->redirect('/login');
		}
	}
	function logout(){
	$this->Session->delete('id');
	$this->Session->delete('name');
	$this->redirect('/login');	
	}
}
?>
