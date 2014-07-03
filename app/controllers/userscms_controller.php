<?php
class UserscmsController extends AppController {
	var $name = 'Userscms';
	var $uses = array (
			'Userscms',
			'City' 
	);
	var $components = array (
			'Global',
			'Email',
			'SmtpEmail',
			'Upload',
			'Session' 
	);
	function index() {
		$city = $this->City->find ( 'all' );
		$this->set ( 'city', $city );
		
		// pr($this->Session->read('security_code_web'));
		// die;
	}
	
	/* Ham save tai khoan tao */
	function add() {
		if (! empty ( $_POST ['shopname'] )) {
			$shopname = $this->Userscms->findAllByShopname ( $_POST ['shopname'] );
			if (count ( $shopname ) != 0) {
				echo "<script>alert('" . json_encode ( 'Tên đăng nhập đã tồn tại!' ) . "');</script>";
				echo "<script>history.back(-1);</script>";
			}
		}
		
		// if(!empty($_POST['email'])&& (!empty($_POST['security']))){
		if (! empty ( $_POST ['email'] )) {
			$this->Userscms->unbindModel ( array (
					'hasMany' => array (
							'Immovable' 
					) 
			) );
			$mail = $this->Userscms->findAllByEmail ( $_POST ['email'] );
			
			if (count ( $mail ) == 0) {
				//if ($this->Session->read ( 'security_code_web' ) == $_POST ['security']) {
					// insert vao db
					$md5_hash = md5 ( rand ( 0, 999 ) );
					$action_mail = $md5_hash; // substr($md5_hash, 0,50);
					                          // $birth_date=$_POST['date'].'-'.$_POST['month'].'-'.$_POST['years'];
					$member_register = array (
							'Userscms' => array (
									'email' => $_POST ['email'],
									'name' => $_POST ['name'],
									'address' => $_POST ['address'],
									'birth_date' => $_POST ['date'],
									'city' => $_POST ['city'],
									'shopname' => $_POST ['shopname'],
									'slug' => $this->unicode_convert ( $_POST ['shopname'] ),
									'password' => md5 ( $_POST ['password'] ),
									'sex' => $_POST ['sex'],
									'phone' => $_POST ['phone'],
									'role_id' => 2,
									'active_key' => $action_mail,
									'status' => 1 
							// them thanh vien dang ky mo gian hang
														) 
					);
					if ($this->Userscms->save ( $member_register )) {
						echo "<script>alert('" . json_encode ( 'Đăng ký tài khoản thành công' ) . "');</script>";
						echo "<script>location.href='" . DOMAIN . "dang-nhap'</script>";
					}
					/*
					 * $check = $this->Userscms->findByEmail($_POST['email']); $id=$check['Userscms']['id']; $content = "Chào mừng bạn đến với Website: ".DOMAIN."!,<br><br> Chúc mừng bạn đã trở thành thành viên của <b>batdongsanvtm.com</b> .<br><br> Vui lòng click vào đường link này <a href='".DOMAIN."Userscms/action_mail/".$action_mail."/".$id."'> <b>click vào đây </b></a> hoặc copy và chạy đường link này :".DOMAIN."Userscms/action_mail/".$action_mail."/".$id." để kích hoạt tài khoản.<br><br> Nếu bạn có bất kỳ thắc mắc nào, hãy liên hệ với chúng tôi để nhận được sự hỗ trợ nhanh nhất.<br><br> -----------------<br><br> <b><i>Trân trọng!</i></b><br><br> <b><i>Batdongsanvtm.com</i></b><br><br> <b>&ldquo; Thông tin chính xác, dịch vụ chu đáo &ldquo;</b> "; /*if ($this->SmtpEmail->smtpmailer($_POST['email'], ADDRESS_EMAIL_SEND_ACTIVE,FROM_NAME_EMAIL_ACTIVE, SUBJECT_EMAIL_ACTIVE,$content)){ echo "<script>alert('".json_encode('Bạn hãy đăng nhập vào Email của bạn để hoàn thành quá trình đăng ký thành viên với chúng tôi')."');</script>"; echo "<script>location.href='".DOMAIN."'</script>"; } else{ echo "<script>alert('".json_encode('Gửi Email không thành công')."');</script>"; }
					 */
				//}//if ($this->Session->read ( 'security_code_web' ) == $_POST ['security']) {
// 				if ($this->Session->read ( 'security_code_web' ) != $_POST ['security']) {
// 					echo "<script>alert('" . json_encode ( 'Ban nhập không đúng mã bảo vệ !' ) . "');</script>";
// 					echo "<script>history.back(-1);</script>";
// 				}
			} 

			else {
				echo "<script>alert('" . json_encode ( 'Email đã tồn tại!' ) . "');</script>";
				echo "<script>history.back(-1);</script>";
			}
			
			/*
			 * $check = $this->Userscms->find('all',array("conditions"=>array('Userscms.email'=>$_POST['email'],'Userscms.ck_admin'=>0))); $id=$check['0']['Userscms']['id']; $content = "Chào mừng bạn đến với Website: ".DOMAIN."!,<br><br> Chúc mừng bạn đã trở thành thành viên của <b>batdongsanvtm.com</b> .<br><br> Vui lòng click vào đường link này <a href='".DOMAIN."Userscms/action_mail/".$action_mail."/".$id."'> <b>click vào đây </b></a> hoặc copy và chạy đường link này :".DOMAIN."Userscms/action_mail/".$action_mail."/".$id." để kích hoạt tài khoản.<br><br> Nếu bạn có bất kỳ thắc mắc nào, hãy liên hệ với chúng tôi để nhận được sự hỗ trợ nhanh nhất.<br><br> -----------------<br><br> <b><i>Trân trọng!</i></b><br><br> <b><i>Batdongsanvtm.com</i></b><br><br> <b>&ldquo; Thông tin chính xác, dịch vụ chu đáo &ldquo;</b> "; if ($this->SmtpEmail->smtpmailer($_POST['email'], ADDRESS_EMAIL_SEND_ACTIVE,FROM_NAME_EMAIL_ACTIVE, SUBJECT_EMAIL_ACTIVE,$content)){ echo "<script>alert('".json_encode('Bạn hãy đăng nhập vào Email của bạn để hoàn thành quán trình đăng ký thành viên với chúng tôi')."');</script>"; echo "<script>location.href='".DOMAIN."'</script>"; } else{ echo "<script>alert('".json_encode('Gửi Email không thành công')."');</script>"; }
			 */
		}
	}
	function district() {
		$this->layout = 'ajax';
		$citiesId = $_GET ['citiesId'];
		if ($citiesId == 0) {
			$this->set ( 'check', 0 );
		} else {
			$this->set ( 'check', 1 );
		}
		$this->District->unbindModel ( array (
				'hasMany' => array (
						'Immovablee',
						'Userscms',
						'Ward',
						'Street' 
				) 
		) );
		$districts = $this->District->find ( 'all', array (
				'conditions' => array (
						'District.city_id' => $citiesId,
						'District.status' => 1 
				),
				'order' => 'District.number ASC' 
		) );
		$this->set ( 'districts', $districts );
		// $district=$this->District->findAllByCityId($citiesId);
		// $this->set('districts',$district);
	}
	
	/* Ham check mail ton tai khi dang ky thanh vien */
	function ck_mail_register() {
		$this->layout = 'ajax';
		$this->Userscms->unbindModel ( array (
				'hasMany' => array (
						'Immovable' 
				) 
		) );
		$mail = $this->Userscms->findAllByEmail ( $_GET ['email'] );
		// pr(count($mail));die();
		if (! preg_match ( '/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i', $_GET ['email'] )) {
			echo "<span style='color:#FF0000;padding-left:148px;'> </span>";
		} else {
			if (count ( $mail ) == 0) {
				echo "<span style='color:#00FF33;padding-left:148px;'>Email hợp lệ ! </span>";
			}
			if (count ( $mail ) > 0) {
				foreach ( $mail as $mail1 ) {
					if ($mail1 ['Userscms'] ['email'] == 1) {
						$check = 1;
						// break;
					} else {
						$check = 0;
						// break;
					}
				}
				if ($check == 1) {
					echo "<span style='color:#00FF33;padding-left:148px;'>Email hợp lệ </span>";
				} elseif ($check == 0) {
					echo "<span style='color:#FF0000;padding-left:148px;'>Email đã tồn tại </span>";
				}
			}
		}
	}
	
	/* Ham action email */
	function action_mail($action_mail, $id) {
		$this->Userscms->unbindModel ( array (
				'hasMany' => array (
						'Immovable' 
				) 
		) );
		$test = $this->Userscms->find ( 'all', array (
				"conditions" => array (
						"Userscms.active_key" => $action_mail,
						"Userscms.id" => $id 
				) 
		) );
		
		if (count ( $test ) == 0) {
			echo "<script>alert('" . json_encode ( 'Kích hoạt tài khoản không thành công !' ) . "');</script>";
			echo "<script>location.href='" . DOMAIN . "'</script>";
		}
		
		if (($test [0] ['Userscms'] ['active_key'] == $action_mail) && ($test [0] ['Userscms'] ['status'] == 0)) {
			$status = array (
					'Userscms' => array (
							'id' => $id,
							'status' => 1 
					) 
			);
			$this->Userscms->save ( $status );
			// $this->Session->delete('id');
			// pr($id);die();
			echo "<script>alert('" . json_encode ( 'Chúc mừng bạn! tài khoản của bạn đã được kích hoạt bạn hãy đăng nhập để được hưởng những quyền lợi của thành viên ' ) . "');</script>";
			echo "<script>location.href='" . DOMAIN . "login'</script>";
		}
		if (($test [0] ['Userscms'] ['active_key'] == $action_mail) && ($test [0] ['Userscms'] ['status'] == 1)) {
			$this->redirect ( '/home/error' );
		}
	}
	
	/* Ham khoi tao capcha */
	function create_image() {
		$md5_hash = md5 ( rand ( 0, 999 ) );
		$security_code = substr ( $md5_hash, 15, 5 );
		$this->Session->write ( 'security_code_web', $security_code );
		
		pr ( $this->Session->read ( "security_code_web" ) );
		// die;
		
		$width = 80;
		$height = 22;
		$image = @ImageCreate ( $width, $height ) or die ( 'Cannot initialize new GD image stream' );
		$black = ImageColorAllocate ( $image, 37, 170, 226 );
		$white = ImageColorAllocate ( $image, 255, 255, 255 );
		ImageFill ( $image, 0, 0, $black );
		ImageString ( $image, 5, 18, 3, $security_code, $white );
		header ( "Content-Type: image/jpeg" );
		ImageJpeg ( $image );
		ImageDestroy ( $image );
	}
	function create_image2($random) {
		$md5_hash = md5 ( rand ( 0, 999 ) );
		$security_code = substr ( $md5_hash, 15, 5 );
		$this->Session->write ( 'security_code_web', $security_code );
		
		$width = 80;
		$height = 22;
		$image = @ImageCreate ( $width, $height );
		$black = ImageColorAllocate ( $image, 37, 170, 226 );
		$white = ImageColorAllocate ( $image, 255, 255, 255 );
		ImageFill ( $image, 0, 0, $black );
		ImageString ( $image, 5, 18, 3, $security_code, $white );
		
		header ( "Content-Type: image/jpeg" );
		ImageJpeg ( $image );
		ImageDestroy ( $image );
	}
	/* Ham lay lai mat khau */
	function forgot_password() {
		$this->layout = 'home2';
	}
	function ck_email_forgot_pass() {
		$this->layout = 'ajax';
		$email = $_GET ['email_forgot_password'];
		$this->Userscms->unbindModel ( array (
				'hasMany' => array (
						'Immovable' 
				) 
		) );
		$check_mail = $this->Userscms->findByEmail ( $email );
		if ($check_mail ['Userscms'] ['email']) {
			echo "<span style='color:#00FF00;margin:150px;'>ok</span>";
		} else {
			echo "<span style='color:#FF0000;margin:150px;font-size:11px;'>Email không đúng</span>";
		}
	}
	function security_forgot_pass() {
		$this->layout = 'ajax';
		$security = $_GET ['security'];
		if ($security == $this->Session->read ( 'security_code_web' )) {
			echo "<span style='color:#00FF00;margin:150px;'>ok</span>";
		} else {
			echo "<span style='color:#FF0000;margin:150px;font-size:11px;'>Mã bảo mật không đúng</span>";
		}
	}
	function processor_forgot_password() {
		$this->Userscms->unbindModel ( array (
				'hasMany' => array (
						'Userscms' 
				) 
		) );
		$email = $this->Userscms->findByEmail ( $_POST ['email'] );
		if ($_POST ['security'] != $this->Session->read ( 'security_code_web' )) {
			echo "<script>alert('" . json_encode ( 'Mã bảo mật không đúng!' ) . "');</script>";
			echo "<script>location.href='" . DOMAIN . "userscms/forgot_password'</script>";
		} else if (empty ( $email )) {
			echo "<script>alert('" . json_encode ( 'Email không đúng!' ) . "');</script>";
			echo "<script>location.href='" . DOMAIN . "userscms/forgot_password'</script>";
		} else {
			$md5_hash = md5 ( rand () );
			$new_pass = substr ( $md5_hash, 15, 10 );
			// pr($md5_hash);die;
			$email = $email ['Userscms'] ['email'];
			// $this->Session->write('new_pass',$new_pass );
			// $this->Session->write('id',$id);
			$content = "Chào bạn!,<br><br>
				Đây là email giúp bạn lấy lại MẬT KHẨU cho tài khoản theo yêu cầu của bạn. 
				Mật khẩu hiện tại của bạn là: <b>" . $new_pass . "</b> Vui lòng <a href='" . DOMAIN . "userscms/activation/" . $email . "/" . $new_pass . "'> <b>click vào đây </b></a> hoặc copy và chạy đường link này : " . DOMAIN . "userscms/activation/" . $email . "/" . $new_pass . "  để hoàn thành quá trình lấy lại mật khẩu. <br><br>
				Xin được thứ lỗi nếu bạn nhận được email này do nhầm lẫn của chúng tôi. <br><br>
				Nếu bạn có bất kỳ thắc mắc nào, hãy liên hệ với chúng tôi để nhận được sự hỗ trợ nhanh nhất.<br><br>
				-----------------<br><br>
				<b><i>Trân trọng!</i></b><br><br>
				<b><i>Vinamax.com</i></b><br><br>
				<b><i>&ldquo;Thông tin chính xác, dịch vụ chu đáo &ldquo;</i></b><br><br>			
				";
			// pr($content);die;
			if ($this->SmtpEmail->smtpmailer ( $_POST ['email'], ADDRESS_EMAIL_SEND_ACTIVE, FROM_NAME_EMAIL_ACTIVE, SUBJECT_EMAIL_CHANGE_PASS, $content )) {
				echo "<script>alert('" . json_encode ( 'Bạn hãy đăng nhập vào Email của bạn để hoàn thành quá trình lấy lại mật khẩu !' ) . "');</script>";
				echo "<script>location.href='" . DOMAIN . "'</script>";
			} else {
				$mail = false;
			}
		}
	}
	function activation($email, $new_pass) {
		$this->Userscms->unbindModel ( array (
				'hasMany' => array (
						'Userscms' 
				) 
		) );
		$test = $this->Userscms->find ( 'all', array (
				"conditions" => array (
						"Userscms.email" => $email 
				) 
		) );
		
		// pr($test[0]['Userscms']['password']);die();
		if (count ( $test ) == 0) {
			echo "<script>alert('" . json_encode ( 'Thay đổi mật khẩu không thành công !' ) . "');</script>";
			echo "<script>location.href='" . DOMAIN . "'</script>";
		}
		
		if ($test [0] ['Userscms'] ['password'] != Security::hash ( $new_pass, null, true )) {
			$update_pass = array (
					'Userscms' => array (
							'id' => $test [0] ['Userscms'] ['id'],
							'password' => Security::hash ( $new_pass, null, true ) 
					) 
			);
			$this->Userscms->save ( $update_pass );
			echo "<script>alert('" . json_encode ( 'Thay đổi mật khẩu thành công ! Bạn hãy đăng nhập để hưởng những quyền lợi của thành viên.' ) . "');</script>";
			echo "<script>location.href='" . DOMAIN . "login'</script>";
		}
		if (($test [0] ['Userscms'] ['email'] == $email) && $test [0] ['Userscms'] ['password'] == Security::hash ( $new_pass, null, true )) {
			$this->redirect ( '/home/error' );
		}
	}
	function profile() {
		$this->checkIfLogged ();
		$member_id = $this->Session->read ( 'id' );
		$edit = $this->Userscms->findById ( $member_id );
		$this->set ( 'edit', $edit );
	}
	function edit_profile() {
		$this->checkIfLogged ();
		$city = $this->City->find ( 'all' );
		$this->set ( 'city', $city );
		$id = $this->Session->read ( 'id' );
		if (isset ( $_POST ['name'] ) && isset ( $_POST ['email'] )) {
			// $this->Userscms->save($this->data);
			// $this->redirect('/home');
			$data ['Userscms'] = $this->data ['Userscms'];
			
			$profile = array (
					'Userscms' => array (
							'id' => $data ['Userscms'] ['id'],
							'shopname' => $data ['Userscms'] ['shopname'],
							'password' => $data ['Userscms'] ['password'],
							
							'yahoo' => $data ['Userscms'] ['yahoo'],
							'skype' => $data ['Userscms'] ['skype'],
							'email' => $_POST ['email'],
							
							'name' => $_POST ['name'],
							
							'phone' => $data ['Userscms'] ['phone'],
							'sex' => $_POST ['sex'],
							'city' => $_POST ['city'],
							'birth_date' => $_POST ['date'] 
					)
					 
			);
			$this->Userscms->save ( $profile );
		}
		$this->set ( 'edit', $this->Userscms->findById ( $id ) );
	}
	function confirm_pass() {
		if (! empty ( $this->data )) {
			$data = $_POST ['data'];
			// pr($data);die();
			// $data['Userscms'] = $this->data['Userscms'];
			if (($data ['Userscms'] ['password_old'] == '') || ($data ['Userscms'] ['password'] == '')) {
				echo "<script>alert('" . json_encode ( 'Bạn chưa nhập thông tin đầy đủ!' ) . "');</script>";
				echo "<script>history.back(-1);</script>";
			} else {
				
				$this->set ( 'email', $data ['Userscms'] ['email'] );
				$this->set ( 'password_old', $data ['Userscms'] ['password_old'] );
				$this->set ( 'password', $data ['Userscms'] ['password'] );
				$this->set ( 'id', $data ['Userscms'] ['id'] );
			}
		}
	}
	function change_pass() {
		if (! empty ( $this->data )) {
			$data = $_POST ['data'];
			// $data['Userscms'] = $this->data['Userscms'];
			if ($data ['Userscms'] ['password'] == '' && $data ['Userscms'] ['password_old'] == '') {
				$this->redirect ( '/home' );
			}
			if ($data ['Userscms'] ['password'] != '' && $data ['Userscms'] ['password_old'] != '') {
				$ck_pass = $this->Userscms->findById ( $data ['Userscms'] ['id'] );
				
				if ($ck_pass ['Userscms'] ['password'] == md5 ( $data ['Userscms'] ['password_old'] )) {
					$change_passarray = array (
							'Userscms' => array (
									'id' => $data ['Userscms'] ['id'],
									'password' => md5 ( $data ['Userscms'] ['password'] ) 
							) 
					);
					$this->Userscms->save ( $change_passarray );
					
					echo "<script>alert('" . json_encode ( 'Thay đổi mật khẩu thành công !' ) . "');</script>";
					echo "<script>location.href='" . DOMAIN . "'</script>";
				} else {
					echo "<script>alert('" . json_encode ( 'Bạn nhập mật khẩu cũ không đúng !' ) . "');</script>";
					echo "<script>history.back(-1);</script>";
				}
			}
		}
		$member_id = $this->Session->read ( 'id' );
		$this->set ( 'edit', $edit = $this->Userscms->findById ( $member_id ) );
	}
	function checkIfLogged() {
		if (! $this->Session->read ( "shopname" ) || ! $this->Session->read ( "id" )) {
			$this->redirect ( '/login' );
		}
	}
	function logout() {
		$this->Session->delete ( 'id' );
		// $this->Session->delete('name');
		$this->Session->delete ( 'shopname' );
		echo "<script>location.href='" . DOMAIN . "gian-hang'</script>";
	}
	function unicode_convert($str) {
		if (! $str)
			return false;
		$unicode = array (
				'a' => array (
						'á',
						'à',
						'ả',
						'ã',
						'ạ',
						'ă',
						'ắ',
						'ặ',
						'ằ',
						'ẳ',
						'ẵ',
						'â',
						'ấ',
						'ầ',
						'ẩ',
						'ẫ',
						'ậ',
						'� �' 
				),
				'a' => array (
						'Á',
						'À',
						'Ả',
						'Ã',
						'Ạ',
						'Ă',
						'Ắ',
						'Ặ',
						'Ằ',
						'Ẳ',
						'Ẵ',
						'Â',
						'Ấ',
						'Ầ',
						'Ẩ',
						'Ẫ',
						'Ậ',
						'� �' 
				),
				'd' => array (
						'đ' 
				),
				'd' => array (
						'Đ' 
				),
				'e' => array (
						'é',
						'è',
						'ẻ',
						'ẽ',
						'ẹ',
						'ê',
						'ế',
						'ề',
						'ể',
						'ễ',
						'ệ' 
				),
				'e' => array (
						'É',
						'È',
						'Ẻ',
						'Ẽ',
						'Ẹ',
						'Ê',
						'Ế',
						'Ề',
						'Ể',
						'Ễ',
						'Ệ' 
				),
				'i' => array (
						'í',
						'ì',
						'ỉ',
						'ĩ',
						'ị' 
				),
				'i' => array (
						'Í',
						'Ì',
						'Ỉ',
						'Ĩ',
						'Ị' 
				),
				'o' => array (
						'ó',
						'ò',
						'ỏ',
						'õ',
						'ọ',
						'ô',
						'ố',
						'ồ',
						'ổ',
						'ỗ',
						'ộ',
						'ơ',
						'ớ',
						'ờ',
						'ở',
						'ỡ',
						'� �' 
				),
				'0' => array (
						'Ó',
						'Ò',
						'Ỏ',
						'Õ',
						'Ọ',
						'Ô',
						'Ố',
						'Ồ',
						'Ổ',
						'Ỗ',
						'Ộ',
						'Ơ',
						'Ớ',
						'Ờ',
						'Ở',
						'Ỡ',
						'� �' 
				),
				'u' => array (
						'ú',
						'ù',
						'ủ',
						'ũ',
						'ụ',
						'ư',
						'ứ',
						'ừ',
						'ử',
						'ữ',
						'ự' 
				),
				'u' => array (
						'Ú',
						'Ù',
						'Ủ',
						'Ũ',
						'Ụ',
						'Ư',
						'Ứ',
						'Ừ',
						'Ử',
						'Ữ',
						'Ự' 
				),
				'y' => array (
						'ý',
						'ỳ',
						'ỷ',
						'ỹ',
						'ỵ' 
				),
				'Y' => array (
						'Ý',
						'Ỳ',
						'Ỷ',
						'Ỹ',
						'Ỵ' 
				),
				'' => array (
						' ',
						'&',
						'?' 
				),
				'' => array (
						'-' 
				) 
		);
		
		foreach ( $unicode as $nonUnicode => $uni ) {
			foreach ( $uni as $value )
				$str = str_replace ( $value, $nonUnicode, $str );
		}
		return $str;
	}
	function get_namecity($id = null) {
		return $this->City->find ( 'all', array (
				"conditions" => array (
						"City.id" => $id 
				),
				'limit' => 1 
		) );
	}
}
?>
