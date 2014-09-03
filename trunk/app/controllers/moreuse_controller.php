<?php
class MoreuseController extends AppController {
	var $name = 'Moreuse';
	var $uses = array (
			'Category',
			'Categoryshop',
			'News',
			'Setting',
			'Slideshow',
			'Partner',
			'Catproduct',
			'Product',
			'Tem',
			'Productshop',
			'Helps',
			'Gallery',
			'Video',
			'City',
			'Classifiedss',
			'Shop',
			'Newshop',
			'Banner',
			'Background',
			'Userscm',
			'Order' 
	);
	
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
	function rand_string( $length ) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$str ='';
		$size = strlen ( $chars );
		for($i = 0; $i < $length; $i ++) {
			$str .= $chars [rand ( 0, $size - 1 )];
		}
		return $str;
	}
	function randpassword( $length ) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789+-*#&@!?";
		$size = strlen ( $chars );
		$str ='';
		for($i = 0; $i < $length; $i ++) {
			$str .= $chars [rand ( 0, $size - 1 )];
		}
		return $str;
	}
	
	function finish() {
		$this->layout = 'ajax';
		$result_finish = array();
		if (isset ( $_POST ['wizard'] )) {
			$this->log("/**************************************************************/", 'debug');
			$wizard = unserialize ( $_POST ['wizard'] );
			//pr($wizard);
			$Eshop = $this->Session->read ( 'Eshop' );
			$userpass = $Eshop['userpass'];
			
			$Store = array ();
			$slug = $this->unicode_convert( $wizard ['project_name'] );
			$Store ['slug'] = @strtolower($slug);                    // chuyen het thanh ki tu thuong 
			$slug_lower =  @strtolower($slug);                    // $slug is subdomain
			
			$subname = @substr($slug_lower, 0, 4);              //substr('abcdef', 0, 4);  // abcd
		                                                 //substr('abcdef', 0, 4);  // abcd

			
			$namctoller = $this->rand_string(6);
			$nameController = @strtolower($subname.$namctoller);
			$Store ['name'] = $nameController;           // $Store ['name'] : is name controller
														 // $nameController : is name controller
	
			$Store ['company_slogan'] = $wizard ['company_slogan'];
			$Store ['namecompany'] = $wizard ['project_name']; // name cong ty
			$Store ['address'] = $wizard ['contact_street'];
			$Store ['city'] = $wizard ['contact_city'];
			$Store ['namecity'] = $wizard ['contact_city'];
			$Store ['contact_zip'] = $wizard ['contact_zip'];
			$Store ['contact_country'] = $wizard ['contact_country']; // Quốc Gia
			$Store ['contact_state'] = $wizard ['contact_state']; // ma so buu dien
			
			$Store ['language'] = trim($wizard ['language']);
			$Store ['branch_type'] = $wizard ['branch_type']; // ????
			$Store ['contact_ic'] = $wizard ['contact_ic']; // ma so thue VAT 3232223 : Maz số đăng kí kinh doanh
			$Store ['currency_id'] = $wizard ['currency_id']; // currency_id : ma don vi tien te
			$Store ['taxes'] = $wizard ['currency_id']; // taxes :yes ==> la doi tuong nop thue
			$Store ['country_id'] = $wizard ['country_id']; // vn : ma nuoc dang ki
			$Store ['moduleType'] = $wizard ['moduleType']; // eshop : gian hang , kinhdoanh : ? , Ca nhan : ? // loai web nao e-shop ,cty hay ca nhan
			$Store ['business'] = $wizard ['moduleType'];
			$Store ['layout'] = trim($wizard ['layout']); // 50001036 : ma Id cua lay out gian hang
			$Store ['socialNetworking'] = $wizard ['layout'];
			$Store ['pages'] = array (); // array tham so khac lien quan
			
			$Store ['mobile'] = $wizard ['contact_tel'];
			$Store ['phone'] = $wizard ['contact_tel'];
			$Store ['fax'] = '';
			$Store ['email'] = $wizard ['contact_email'];
			$Store ['user_id'] = 999; // 999 ma khach hang dang ki
			$Store ['link'] = 'http://'.$slug_lower.'.freemobiweb.mobi';
			$Store ['images'] = 'img/upload/9d564d3cc9dcf18171f1dc84ebc09e0b.png';
			$Store ['ckshops'] = 1;
			$Store ['status'] = 1;
			
			//$namedatabase = $slug_lower.'_'.$Store ['layout'];
			$ipserver = $_SERVER['SERVER_ADDR'];
			$namwserver = $_SERVER['SERVER_NAME'];
			//++++++++++creat data base +++++++
			$dbname = $this->rand_string(5); // get ramdom 5 string not get 6 string form $slug : web1234
			$dbuser = $dbname;
			$namedatabase = 'admin_'.$dbname;
			$dbpass = $this->randpassword(15); //"123456@123";
			$dbpass_validate = $dbpass; // validate directadmin
		 
			
			
			if($namwserver != IP_SERVER_TEST)
			{  // SERVER DIREACT
				//++++++++++++++creatsubdomainfreemobile+++++++++++++++++++++++++
				$this->log("log creatsubdomainfreemobile  in SERVER DIREACT ", 'debug');
				$subdoamin = $this->creatsubdomainfreemobile($slug_lower);
				if($subdoamin === true)
				{
					$logsubdoamin = true;
					//+++++++++++copyhtacess++++++++++++++++
					 $this->log("log copyhtacess  in SERVER DIREACT ", 'debug');
					 $logCopyhtcess = $this->copyhtacess($slug_lower,$nameController);
				}else $logsubdoamin = $subdoamin;
				
				//++++++++++++creatdatanamefreemobile++++++++++++++++++
				//$creatdatabasename = false;	
				$creatdatabasename = $this->creatdatanamefreemobile($dbuser, $dbname, $dbpass, $dbpass_validate);
				$this->log("log creatdatanamefreemobile  in SERVER DIREACT ".$creatdatabasename, 'debug');
				if($creatdatabasename === true)
				{
					$logcreatdataba = true;
				}else $logcreatdataba = $creatdatabasename;
			
				if($subdoamin === true and  $creatdatabasename === true)
				{
					$Store ['username'] = 'admin_'.$dbuser;     //$dbuser = "datest";
					$Store ['password'] = $dbpass;     //$dbname = "datest";
					$Store ['databasename'] = $namedatabase; // 'admin_datest'
					//+++++++++++++++not need++++++++++++++++++++++++
					$Store ['userpass'] = $userpass;
					$Store ['hostname'] = 'localhost'; ////$namwserver;
					$Store ['ipserver'] = $ipserver;
					//$logcreatdataba = "Not use";         // if($subdoamin === true ) not use $creatdatabasename === true
				  }else die("Ooops! We can't Creat subdomain and creat database . Error : creat data".$logcreatdataba." Error subdomain".$logsubdoamin );
			}elseif ($namwserver ===IP_SERVER_TEST) {
				
				$this->log("Moi truong localhost - not creat subdomain", 'debug');
				$Store ['userpass'] = $userpass;
				$Store ['databasename'] = $namedatabase;
				$Store ['username'] = "root";       //Username
				$Store ['password'] = '';          //Password
				$Store ['hostname'] = 'localhost'; //$namwserver;
				$Store ['ipserver'] = $ipserver;
				
				//+++++log++++++++
				$logsubdoamin = false;
				$logcreatdataba= false;
				$logCopyhtcess = false;
				
			}	
		
			// $Store['user_id']=$this->Session->read("id");
			
			 $this->Shop->save($Store);
			 $shop_id = $this->Shop->getLastInsertId();
			 
			if($shop_id<0) { die("Oop! Error Save data! Please try again !!!");}
			 
			 //Send mail Acout Estore
			 $shoparr = $this->Shop->find ( 'all', array (
			 		'conditions' => array (
			 				'Shop.id' => $shop_id,
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
			 				'Shop.ipserver'
			 		)
			 ) );
			 if(is_array($shoparr) and empty($shoparr))
			 {
			 	$result_finish ="Error Not get data eshop";
			 	return  $result_finish ; //exit;
			 }
			
			if(is_array($shoparr) and !empty($shoparr))
			{
			  foreach($shoparr as $shop){
			 	$databasename = $shop['Shop']['databasename'];
			 	$password = $shop['Shop']['password'];
			 	$username = $shop['Shop']['username'];
			 	$hostname = $shop['Shop']['hostname'];
			 	$shop_id = $shop['Shop']['id'];
			 	$nameproject = $shop['Shop']['name'];           // $nameproject is name Ctronller 
			 	$email = trim($shop['Shop']['email']);}
			}
			
// 			echo "lay tu database len</br>";
// 			echo "username";pr($username);
// 			echo "password";pr($password);
// 			//return  $shoparr ; exit;
			
			// $this->sendacountEshop($Store ['email'],$username,$password);
			 $body = "Cảm ơn bạn đã đăng ký gian hàng Tại FREEMOBIWEB.MOBI  .";
			 $body.= "\nĐường dẫn tới gian hàng của bạn : http://freemobiweb.mobi/".$nameproject;
			 $body.= "\n    .Hoặc Đường dẫn tới gian hàng của bạn : http://".$slug_lower.".freemobiweb.mobi";
			 $body.= "\n     .Bạn có thể truy cập vào trang quản trị của gian hàng theo đường dẫn : http://freemobiweb.mobi/estoreadmin";
			 $body.= "\n     .STT Eshop :".$shop_id;
			 $body.= "\n     .User name :".$email;
			 $body.="\n      .Password:".$this->decryptIt($userpass);
			 $body.= "\n Xin cảm ơn!";
			 
			 $linkadmin="http://".$slug_lower.".freemobiweb.mobi/";
			 $linkweb="http://freemobiweb.mobi/".$nameproject;
			 
			 $this->log("linkadmin: ".$linkadmin, 'debug');
			 $this->log("linkweb: ".$linkweb, 'debug');
			 
		     $resultemail = $this->smtpmailereshop($email,'alatcas1@gmail.com','FREEMOBIWEB.MOBI','REGISTER FREEMOBIWEB',$body);
		     $this->log("resultemail: ".$resultemail, 'debug');
			
			// creat Eshop
			if($namwserver != IP_SERVER_TEST){  
				// SERVER DIREACT
			  $flagConnecting = "Use Connectingnew";
			  $this->log(" /** Creat Eshop In SERVER DIREACT: ******************/", 'debug');
			  $result = $this->registerEshop ($namedatabase, $nameController, $Store ['layout'], $Store ['language'], $shop_id,$flagConnecting,$username ,$password);
			  $this->log(" /** end Creat Eshop In SERVER DIREACT: ******************/", 'debug');
			}elseif($namwserver === IP_SERVER_TEST){  
				// LOCALHOST
			  $flagConnecting =  '';
			  $username ='';
			  $password='';
			  $this->log(" /** Creat Eshop In Localhost: ******************/", 'debug');
			  $result = $this->registerEshop ($namedatabase, $nameController, $Store ['layout'], $Store ['language'], $shop_id ,$flagConnecting,$username ,$password);
			  $this->log(" /** end Creat Eshop In Localhost: ******************/", 'debug');
			}
			//pr($result);
// 			// deburg 			
// 			$result_finish12 = array(
// 					'subdoamin'=>$logsubdoamin,
// 					'logCopyhtcess'=>$logCopyhtcess,
// 					'creatdatabase'=>$logcreatdataba,
// 					'nameeshop'=>$nameproject,
// 					'shopid'=>$shop_id,
// 					'resultemail'=>$resultemail,  // result send email
// 					'detailemailarray'=>$detailemailarray,
// 					'registerEshop'=>$result
// 			);
// 			$result_finish = array(
// 					'data'=>$result_finish12
// 			);

// // 			pr(json_encode($result_finish,true));
// 			return  print_r(json_encode($result_finish,true));
// 			//end deburg
			
			
			$this->log("creatdatabase: ".$logcreatdataba, 'debug');
			$this->log("nameeshop: ".$nameproject, 'debug');
			$this->log("shopid: ".$shop_id, 'debug');
			
			
			$this->log("registerEshop: ".$result, 'debug');
			$this->log("result: result:1", 'debug');
		//	not deburg
			$sresult = 'result:1';
			return print $sresult;
			
		} else {
		   $sresult='result:reload';
			return   print $sresult;
		}
	die ();
	}

	function creatsubdomainfreemobile($subdomain) {
		//++++++++ include PhpMailler +++++++++++
		$libfreemobile = ROOT.'/libfreemobile/';
		$filename = $libfreemobile.'httpsocket.php';
		if(file_exists($filename))
			include($filename);
		global $error;
		$server_ip = Server_ip; // IP that User is assigned to
		$server_login = Server_login;
		$server_pass = server_pass;
		$server_host = Server_ip; // where the API connects to
		$server_ssl = "N";
		$server_port = 2222;
		
		$sock = new HTTPSocket ();
		if ($server_ssl == 'Y') {
			$sock->connect ( "ssl://" . $server_host, $server_port );
		} else {
			$sock->connect ( $server_host, $server_port );
		}
		
		$sock->set_login ( $server_login, $server_pass );
		
		$sock->query ( '/CMD_API_SUBDOMAINS', array (
				'action' => 'create',
				'domain' => 'freemobiweb.mobi',
				'subdomain' => $subdomain,
				'create' => 'Create' 
		) );
		$result = $sock->fetch_parsed_body ();
		// echo $result;
		// echo "<pre>";
		// print_r($result);
		// echo "</pre>";
		
		if ($result ['error'] != "0") {
			$error = "<b>Error Creating Subdomain  on server $server_ip:<br>\n";
			$error .= $result ['text'] . "<br>\n";
			$error .= $result ['details'] . "<br></b>\n";
			return $error;
			CakeLog::write('debug', 'creatsubdomainfreemobile : '.$error);
		} else {
			
			$error = "Subdomain  created on server $server_ip<br>\n";
			CakeLog::write('debug', 'creatsubdomainfreemobile : '.$error);
			return true;
		}
		
		exit ( 0 );
		$error = "Will connect to: " . ($server_ssl == "Y" ? "https" : "http") . "://" . $server_host . ":" . $server_port . "<br>\n";
		CakeLog::write('debug', 'creatsubdomainfreemobile : '.$error);
	}
	
	function copyhtacess($slug_lower,$nameController)
	{
		global $error;
		$subdomain = $slug_lower;
		//add .htacess inner subdomain
		$dirhtacess = ROOT.'/htacess/.htaccess';
		$dirSourceCopy = ROOT.'/htacess/'.$subdomain.'/';
		$filenamehtacess = $dirhtacess;
		if(file_exists($filenamehtacess))
		{
			//+++++++copy+++++
			$myFile = $dirhtacess;
			$fh = fopen ( $myFile, 'w' ) or die ( "can't open file" );
			$stringData = "";
			$stringData .= "<IfModule mod_rewrite.c> \n";
			$stringData .= "RewriteEngine On \n";
			$stringData .= "RewriteCond %{HTTP_HOST} ^".$subdomain.".freemobiweb.mobi$ [OR] \n";
			$stringData .= "RewriteCond %{HTTP_HOST} ^www.".$subdomain.".freemobiweb.mobi$ \n";
			$stringData .= "RewriteRule (.*)$ http://freemobiweb.mobi/".$nameController."$1 [R=301,L] \n";
			$stringData .= "</IfModule>\n";
			fwrite ( $fh, $stringData );
			fclose ( $fh );
		
			$fromfile = $dirhtacess;
			$tofile = ROOT.'/'.$subdomain.'/';
			$tofilesoure = ROOT.'/'.$subdomain.'/.htaccess';
		   if(is_dir($tofile))
			{
				if (file_exists ( $tofilesoure )) {
					return $error = "htaccess already is use!";
					//exit ();
				}
				copy ( $fromfile, $tofilesoure );
				$fileindexhtml = $tofile.'/index.html';
				if (file_exists ( $fileindexhtml )) {
					unlink($fileindexhtml);
				}
				return true;
			}else {
				CakeLog::write('debug', "copyhtacess : Not creat directory ".$subdomain);
				return $error = "Not creat directory ".$subdomain;
			}
		}else
		{   
			CakeLog::write('debug', "file .htacess not axits in ".$filenamehtacess);
			return $error = "file .htacess not axits in ".$filenamehtacess;}
	}
	
	function creatdatanamefreemobile($dbuser,$dbname,$dbpass,$dbpass_validate) {
		/*
		$libcreatdatanamefreemobile = ROOT.'/libfreemobile/';
		$filename23 = $libcreatdatanamefreemobile.'httpsocket.php';
		if(file_exists($filename23))
		{	include($filename23);}
	    */	
		global $error;
		$server_ip = Server_ip; // IP that User is assigned to
		$server_login = Server_login;
		$server_pass = server_pass;
		$server_host = Server_ip; // where the API connects to
		$server_ssl = "N";
		$server_port = 2222;
// 		$dbuser = "datest";
// 		$dbname = "datest";
// 		$dbpass = "123456@123";
// 		$dbpass_validate = "123456@123";
		
		$sock = new HTTPSocket ();
		if ($server_ssl == 'Y') {
			$sock->connect ( "ssl://" . $server_host, $server_port );
		} else {
			$sock->connect ( $server_host, $server_port );
		}
		
		$sock->set_login ( $server_login, $server_pass );
		
		$sock->query ( '/CMD_API_DATABASES', array (
				'action' => 'create',
				'name' => $dbname,
				'user' => $dbuser,
				'passwd' => $dbpass,
				'passwd2' => $dbpass_validate 
		) );
		
	
		$result = $sock->fetch_parsed_body ();
		// echo $result;
		// echo "<pre>";
		// print_r($result);
		// echo "</pre>";
	
		if ($result ['error'] != "0") {
			$error = "<b>Error Creating database  on server $server_ip:<br>\n";
			$error .= $result ['text'] . "<br>\n";
			$error .= $result ['details'] . "<br></b>\n";
			return $error;
		} else {
		$error = "database  created on server $server_ip<br>\n";
		return true;
		}
	
		exit ( 0 );
		$error = "Will connect to: " . ($server_ssl == "Y" ? "https" : "http") . "://" . $server_host . ":" . $server_port . "<br>\n";
	
	}
	
	
	//++++++ Register Website Creat++++++++++++++++++++
	function registerEshop($namedatabase,$nameController,$layout_code,$language_code,$shop_id,$flagConnecting,$username ,$password) {
		$result_code;
		// 		$name = $this->Shop->findAllByName( $project_name); // pr(count($name));die;
		// 		if (count ( $name ) == 1) {
		// 			return $result_code = -1 ; // -1 :'Tên gian hàng đã tồn tại!';
		// 		} else {
	
			$nameController_Copy = $this->checkLayoutCode($nameController,$layout_code);
			CakeLog::write('debug', 'nameController_Copy :'.$nameController_Copy);
			$databaseCreat = 'Not subject to yet . Note ceatdata base';
			  if($flagConnecting !='')
			  {	
			  	// SERVER DERECTADMIN
			  	CakeLog::write('debug', 'flagConnecting : khac rong tren direacadmin');
			  	CakeLog::write('debug', 'creat database in SERVER DERECTADMIN ');
			  	CakeLog::write('debug', 'database name SERVER DERECTADMIN : '.$databaseCreat);
			  	$databaseCreat = $this->checkLanguageCode($namedatabase,$nameController,$language_code,$layout_code,$shop_id,$username ,$password);
			  	
			  }elseif($flagConnecting ===''){
			  	// SERVER localhost
			  	CakeLog::write('debug', 'creat database in SERVER localhost ');
			  	CakeLog::write('debug', 'flagConnecting : rong');
			  	$databaseCreat = $this->checkLanguageCode($namedatabase,$nameController,$language_code,$layout_code,$shop_id,$username ,$password);
			  
			  }	
				
			$dir_and_name_estoreViewCopy = $this->checkLayoutCodeReturnCodeTheme($nameController,$layout_code);
		    CakeLog::write('debug', 'dir_and_name_estoreViewCopy :'.$dir_and_name_estoreViewCopy);
		    
			return $result_code= array(
					'nameController_Copy'=>$nameController_Copy,
					'database'=>$databaseCreat,
					'dir_and_name_estoreViewCopy'=>$dir_and_name_estoreViewCopy,
			);
				
				
			//}
		}
		
		
		function sendacountEshop($nameproject,$email,$user_name,$password,$subdomain) 
		 {
		 	$body = "Cảm ơn bạn đã đăng ký gian hàng Tại FREEMOBIWEB.MOBI";
		 	$body.= "Đường dẫn tới gian hàng của bạn : http://freemobiweb.mobi/".$nameproject;
		 	$body.= "Hoặc Đường dẫn tới gian hàng của bạn : http://".$nameproject."/freemobiweb.mobi/";
		 	$body.= "Bạn có thể truy cập vào trang quản trị của gian hàng theo đường dẫn : http://freemobiweb.mobi/estoreadmin";
		 		
		 	$body.= "User name:".$user_name;
		 	$body.=" Password:".$password;
		 	$body.= "Xin cảm ơn!";
		 		
		 	$this->smtpmailereshop($email,'alatcas1@gmail.com','FREEMOBIWEB.MOBI','REGISTER FREEMOBIWEB',$body);
		 	if ($resultemail ==1)
		 	{
				// echo '<script language="javascript"> alert("'.$body.'"); location.href="' . DOMAIN .$this->shopname. '";</script>';
			$message = "succesfuly";
			return $message;
		 			
		 	}
		 	else
		 	{
		 		//echo '<script language="javascript"> alert("gửi mail không thành công"); </script>';
		 		return $resultemail;
		 	}
		 }
		
		
		function smtpmailereshop($to, $from, $from_name, $subject, $body) {
			//++++++++ include PhpMailler +++++++++++
			$libraryPhpMailer = ROOT.'/PhpMailer/';
			$filename = $libraryPhpMailer.'class.phpmailer.php';
			if(file_exists($filename))
				include($filename);
			global $error;
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->CharSet = "utf-8";
			$mail->SMTPDebug = 0;
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = 'ssl';
			$mail->Host = 'smtp.gmail.com';
			$mail->Port = 465;
			$mail->Username = GUSER;
			$mail->Password = GPWD;
			$mail->SetFrom($from, $from_name);
			$mail->Subject = $subject;
			$mail->Body = $body;
			$mail->AddAddress($to);
			if (!$mail->Send()) {
				$error = 'Gởi mail bị lỗi: ' . $mail->ErrorInfo;
				CakeLog::write('debug', 'Gởi mail bị lỗi: ' . $mail->ErrorInfo);
				return false;
			} else {
				$error = 'thư của bạn đã được gởi đi ';
				CakeLog::write('debug','thư của bạn đã được gởi đi ');
				return true;
			}
		}		
		
	//++++++++++++++++++++++++++++++++++++
	/*
	 * CheckLayoutcode 
	 * Return : Controller name estore and code 
	 * copy Controller by name controller new
	 */
	function checkLayoutCode($project_name,$layout_code)
	{
		$controller_estore ;
		switch ($layout_code) 
		{
			case 50000568:
				{    $myFile = DOCUMENT_ROOT . 'app/controllers/creativeeshopcopy_controller.php';
					$fh = fopen ( $myFile, 'w' ) or die ( "can't open file" );
					$stringData = "";
					$stringData .= "<?php\n";
					$stringData .= "
						  class " . ucfirst ( $project_name) . "Controller extends AppController {
						  var \$name = '" . ucfirst ( $project_name) . "';
						   var \$shopname ='".$project_name."';
						   var \$uses = array (
						  		'Estore_categories',//Catalogueshop
						  		'Estore_news',//eshop
						  		'Estore_products',//eshop products
						  		'Estore_catproducts',// eshop Estorecatproducts
						  		'Estore_manufacturers',// eshop Estore_manufacturers
						  		'Estore_advertisements',//eshop Estore_advertisements
						  		'Estore_slideshows', //eshop Estore_slideshows
						  		'Estore_partners', // eshop Estore_partners
						  		'Estore_infomations',//eshop Estore_infomations
								'Estore_albums',//eshop Estore_albums
						  		'Estore_settings',//eshop Estore_settings
								'Estore_banners',//eshop Estore_banners
								'Estore_category',
								'Estore_comments',//eshop Estore_comments
								'Estore_contacts',//eshop Estore_contacts
								'Estore_user',
								'Estore_news',
								'Estore_infomation',
								'Estore_order',
								'Estore_infomationdetail',
								'Estore_gallery',
								'Estore_album',
								'Estore_banner',
								'Estore_helps',
								'Estore_setting',
								'Estore_video',
								'Estore_slideshow',
								'Estore_partner',
								'Estore_advertisement',
								'Estore_catproduct',
								'Estore_product',
								'Estore_weblink',
								'Estore_manufacturer',
								'Shop' 
						);
						var \$paginate = array();
						var \$helpers = array (
								'Html',
								'Ajax',
								'Javascript',//'Paginator' 
						);
						var \$components = array (
								'RequestHandler',
								'Email' 
						);
						function loadModelNew(\$Model) {
							// ++++++++++++connection data +++++++++++++++++
						
							//++++++++++++connection data +++++++++++++++++
							\$nameeshop = \$this->shopname;
							
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											//'Shop.id' => \$shop_id,
											'Shop.name' => \$nameeshop,
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
								
							if(is_array(\$shoparr) and !empty(\$shoparr))
							{
								foreach(\$shoparr as \$shop){
									\$databasename = \$shop['Shop']['databasename'];
									\$password = \$shop['Shop']['password'];
									\$username = \$shop['Shop']['username'];
									\$hostname = \$shop['Shop']['hostname'];
									\$shop_id = \$shop['Shop']['id'];
									\$nameproject = \$shop['Shop']['name'];           // \$nameproject is name Ctronller
									\$email = trim(\$shop['Shop']['email']);
									\$userpass = \$shop['Shop']['userpass'];
								}
							}
							\$this->\$Model->setDataEshop ( \$hostname, \$username, \$password, \$databasename );
						}
						function connectiondatabase(\$sql) {
							\$nameeshop = \$this->shopname;	
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
						
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							\$db = new ConnectionManager;
							\$config = array(
									//'className' => 'Cake\Database\Connection',
									'driver' => 'mysql',
									'persistent' => false,
									'host' =>\$hostname,
									'login' =>\$username,
									'password' =>\$password,
									'database' =>\$databasename,
									'prefix' => false,
									'encoding' => 'utf8',
									'timezone' => 'UTC',
									'cacheMetadata' => true
							);
							\$db->create(\$databasename,\$config);
							\$name = ConnectionManager::getDataSource(\$databasename);
							
							\$resul = \$name->fetchAll(\$sql);
								
							//pr(\$resul);
							return \$resul;
								
						}
						
						
						
						function get_shop_id(\$name) {
							
						
							return \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$name,
											'Shop.status' => 1 
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username', 
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									) 
							) );
						}
						
					
						
						function getOrder() {
							mysql_query ( \"SET names utf8\" );
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							//set data news eshop	
							\$this->Estore_infomations->setDataEshop(\$hostname,\$username,\$password,\$databasename);
						
							return \$this->Estore_infomations->find ( 'all', array (
									'order' => 'Estore_infomations.id DESC' 
							) );
						}
						function getAlbum() {
							mysql_query ( \"SET names utf8\" );
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							//set data news eshop	
							\$this->Estore_albums->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							return \$this->Estore_albums->find ( 'all', array (
									'conditions' => array (
											'Estore_albums.status' => 1 
									),
									'limit' => '3',
									'order' => 'Estore_albums.id ASC' 
							) );
						}
					
						function menucategory() {
							mysql_query ( \"SET names utf8\" );
							\$sql_exc = \"SELECT `estore_categories`.`id`, `estore_categories`.`estore_id`, `estore_categories`.`tt`, `estore_categories`.`parent_id`, `estore_categories`.`lft`, `estore_categories`.`rght`, `estore_categories`.`name`, `estore_categories`.`name_en`, `estore_categories`.`created`, `estore_categories`.`modified`, `estore_categories`.`status`, `estore_categories`.`images`, `estore_categories`.`alias` FROM `estore_categories` AS `estore_categories`   WHERE `estore_categories`.`status` = 1 AND `estore_categories`.`parent_id` IS NULL   ORDER BY `estore_categories`.`tt` ASC\";
								
							\$result = \$this->connectiondatabase(\$sql_exc);
							//pr(\$result);
							return \$result;
							
						}
						function showcategory(\$id = null) {
							mysql_query ( \"SET names utf8\" );
							\$sql_exc = \"SELECT `estore_categories`.`id`, `estore_categories`.`estore_id`,
									           `estore_categories`.`tt`, `estore_categories`.`parent_id`, 
									           `estore_categories`.`lft`, `estore_categories`.`rght`, 
									           `estore_categories`.`name`, `estore_categories`.`name_en`, 
									           `estore_categories`.`created`, `estore_categories`.`modified`,
									           `estore_categories`.`status`, `estore_categories`.`images`,
									           `estore_categories`.`alias` 
									     FROM `estore_categories` AS `estore_categories`  
									     WHERE `estore_categories`.`parent_id` = '\".\$id.\"'  
									     ORDER BY `estore_categories`.`tt` ASC\";
							\$result = \$this->connectiondatabase(\$sql_exc);
							//pr(\$result);
							return \$result;

						}
						
						function banner(\$shop_id=null) {
							\$sql_exc = \"SELECT estore_banners.*
									 FROM  estore_banners
									 WHERE estore_banners.estore_id =\".(int)\$shop_id.\" AND estore_banners.status = 1 ORDER BY  estore_banners.id ASC \";
								
							\$result = \$this->connectiondatabase(\$sql_exc);
							//pr(\$result);
							return \$result;
							
						}
						function setting(\$shop_id=null) {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_settings->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							return \$this->Estore_settings->find ( 'all', array (
									'conditions' => array ('Estore_settings.estore_id' =>\$shop_id),
									'order' => 'Estore_settings.id DESC' 
									) );
						}
						function adv() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_banners->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							return \$this->Estore_banners->find ( 'all', array (
									'conditions' => array (
											'Estore_banners.status' => 1 
									),
									'order' => 'Estore_banners.id DESC',
									'limit' => 2 
							) );
						}
						function doitac() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_partners->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							
						    return \$this->Estore_partners->find ( 'all', array (
									'conditions' => array (
											'Estore_partners.status' => 1 
									),
									'order' => 'Estore_partners.id DESC' 
							) );
						}
						function menu_active() {
							return \$this->Categoryestore2->find ( 'all', array (
									'conditions' => array (
											'Categoryestore2.parent_id' => 145 
									),
									'order' => 'Categoryestore2.id ASC' 
							) );
						}
						function helpsonline() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_helps->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							
							return \$this->Estore_helps->find ( 'all', array (
									'conditions' => array (
											'Estore_helps.status' => 1,
											'Estore_helps.estore_id' => \$shop_id
									),
									'order' => 'Estore_helps.id DESC' 
							) );
						}
						function id_product(\$id) {
							return \$this->Estore_product->read ( null, \$id );
							// pr(\$this->Estore_product->read(null,\$id));die;
						}
						function hot() {
							return \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 156 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 1 
							) );
						}
						function hotnew(\$shop_id=null) {
							\$sql_exc = \"SELECT estore_news.*
									 FROM  estore_news
									 WHERE estore_news.estore_id =\".(int)\$shop_id.\" AND estore_news.status = 1 AND estore_news.category_id = 156 ORDER BY  estore_news.id DESC LIMIT 6 \";
								
							\$result = \$this->connectiondatabase(\$sql_exc);
							//pr(\$result);
							
							return \$result;
							
						}
						function getinfo(\$cat = null) {
							return \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => \$cat 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 3 
							) );
						}
						function videos(\$shop_id=null) {
							mysql_query ( \"SET names utf8\" );
							\$sql_exc_other = \"SELECT estore_videos.*
											 FROM  estore_videos
											 WHERE estore_videos.status = 1 AND estore_videos.left= 0 AND estore_videos.estore_id= \".\$shop_id.\" ORDER BY estore_videos.id DESC LIMIT 1\";
							\$result_video = \$this->connectiondatabase(\$sql_exc_other);
							//pr(\$result_video);
							
							return \$result_video;
						}
						function videosright() {
							mysql_query ( \"SET names utf8\" );
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_video->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							
							return \$this->Estore_video->find ( 'all', array (
									'conditions' => array (
											'Estore_video.status' => 1,
						  					'Estore_video.estore_id' => \$shop_id,
											'Estore_video.left' => 1 
									),
									'order' => 'Estore_video.id DESC',
									'limit' => 1 
							) );
						}
						function tintuc() {
							return \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 156 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 5 
							) );
						}
						function slideshow() {
							mysql_query ( \"SET names utf8\" );
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_slideshows->setDataEshop(\$hostname,\$username,\$password,\$databasename);
						
							return \$this->Estore_slideshows->find ( 'all', array (
									'conditions' => array (
											'Estore_slideshows.status' => 1 
									),
									'order' => 'Estore_slideshows.id DESC' 
							) );
						}
						function library_image() {
							return \$this->Gallery->find ( 'all', array (
									'conditions' => array (
											'Gallery.status' => 1 
									),
									'order' => 'Gallery.id DESC',
									'limit' => 10 
							) );
						}
						function shows() {
							mysql_query ( \"SET names utf8\" );
							return \$this->Estore_category->find ( 'all', array (
									'conditions' => array (
											'Estore_category.parent_id' => '201' 
									),
									'order' => 'Estore_category.id ASC' 
							) );
						}
						// SẢN PHẨM
						function menuproduct() {
							mysql_query ( \"SET names utf8\" );
							return \$this->Estore_catproduct->find ( 'all', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => '3' 
									),
									'order' => 'Estore_catproduct.id ASC' 
							) );
						}
						function submenuproduct(\$id = null) {
							return \$this->Estore_catproduct->find ( 'all', array (
									'conditions' => array (
											'Estore_catproduct.parent_id ' => \$id 
									),
									'order' => 'Estore_catproduct.id ASC' 
							) );
						}
						function showsmenu() {
							mysql_query ( \"SET names utf8\" );
							return \$this->Estore_catproduct->find ( 'all', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => '12' 
									),
									'order' => 'Estore_catproduct.id ASC' 
							) );
						}
						function showsmenu1(\$id = null) {
							\$sql_exc = \"SELECT estore_catproducts.*
									 FROM  estore_catproducts
									 WHERE estore_catproducts.parent_id =\".(int)\$id.\" AND estore_catproducts.status = 1 ORDER BY  estore_catproducts.id ASC \";
							
							\$result = \$this->connectiondatabase(\$sql_exc);
							//pr(\$result);
							return \$result;

						}
						
						
						function showsmenu2(\$id = null) {
							\$sql_exc = \"SELECT estore_catproducts.*
									 FROM  estore_catproducts
									 WHERE estore_catproducts.parent_id =\".(int)\$id.\" AND estore_catproducts.status = 1 ORDER BY  estore_catproducts.id ASC \";
								
							\$result = \$this->connectiondatabase(\$sql_exc);
							//pr(\$result);
							return \$result;
						}
						
						function danhmuc(\$shopname) {
						
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$shopname,
											'Shop.status' => 1 
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username', 
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									) 
							) );

							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
							
							}
							\$db = new ConnectionManager;
							\$config = array(
									//'className' => 'Cake\Database\Connection',
									'driver' => 'mysql',
									'persistent' => false,
									'host' =>\$hostname,
									'login' =>\$username,
									'password' =>\$password,
									'database' =>\$databasename,
									'prefix' => false,
									'encoding' => 'utf8',
									'timezone' => 'UTC',
									'cacheMetadata' => true
							);
							\$db->create(\$databasename,\$config);
							\$name = ConnectionManager::getDataSource(\$databasename);
// 							                                    echo \"99999999</br>\";
// 							                                    pr(\$name->config);die;
							\$sql = \"SELECT estore_catproducts.*
									 FROM  estore_catproducts
									 WHERE estore_catproducts.parent_id= 0 AND estore_catproducts.estore_id =\".(int)\$shop_id.\" ORDER BY  estore_catproducts.name ASC \";
							//\$resul = \$name->rawQuery(\$sql);
							\$resul = \$name->fetchAll(\$sql);
							
							//pr(\$resul);
							return \$resul;
							
						}
						function typical(\$shop_id = Null) {
							return \$this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.estore_id' => \$shop_id 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 10 
							) );
						}
						function productnew() {
							return \$this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 10 
							) );
						}
						function khuyenmai() {
							return \$this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.display' => '1' 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 10 
							) );
						}
						function business() {
							return \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 218 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 5 
							) );
						}
						function customers() {
							return \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 219 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 5 
							) );
						}
						function science() {
							return \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 220 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 5 
							) );
						}
						function help() {
							return \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 156 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 8 
							) );
						}
						function tinkhuyenmai() {
							return \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 227 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 5 
							) );
						}
						function tinkhuyenmaile() {
							return \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 228 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 5 
							) );
						}
						function weblink() {
							return \$this->Estore_weblink->find ( 'all', array (
									'conditions' => array (
											'Estore_weblink.status' => 1 
									),
									'order' => 'Estore_weblink.id DESC' 
							) );
						}
						function cat() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_catproducts->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$prff = \$this->Estore_catproducts->find ( 'all', array (
									'conditions' => array (
											'Estore_catproducts.status' => 1 
									) 
							) );
						//	echo \"xzxzx\";
						//pr(\$prff);
							return \$prff;
							
						}
						function hsx() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->Estore_manufacturers->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$manufacturer =\$this->Estore_manufacturers->find ( 'all', array (
									'conditions' => array (
											'Estore_manufacturers.status' => 1,
											'Estore_manufacturers.parent_id ' => null 
									) 
							) );
							
// 							pr(\$manufacturer);
							return \$manufacturer;
// 							return \$this->Estore_manufacturer->find ( 'all', array (
// 									'conditions' => array (
// 											'Estore_manufacturer.status' => 1,
// 											'Estore_manufacturer.parent_id ' => null 
// 									) 
// 							) );
						}
						function catcon() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->Estore_catproducts->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$prff = \$this->Estore_catproducts->find ( 'all', array (
									'conditions' => array (
											'Estore_catproducts.status' => 1
									)
							) );
							//	echo \"xzxzx\";
							//pr(\$prff);
							return \$prff;

						}
						function adv1() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_advertisements->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							
							return \$this->Estore_advertisements->find ( 'all', array (
									'conditions' => array (
											'Estore_advertisements.status' => 1,
											'Estore_advertisements.display' => 0 
									),
									'limit' => 1 
							) );
						}
						function adv2() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->Estore_advertisements->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								
							return \$this->Estore_advertisements->find ( 'all', array (
									'conditions' => array (
											'Estore_advertisements.status' => 1,
											'Estore_advertisements.display' => 1 
									),
									'limit' => 1 
							) );
						}
						function advf(\$shop_id= null) {
							\$sql_exc_other = \"SELECT estore_advertisements.*
											 FROM  estore_advertisements
											 WHERE estore_advertisements.status = 1 AND estore_advertisements.display= 2 AND estore_advertisements.estore_id= \".\$shop_id.\" ORDER BY estore_advertisements.id \";
							\$advf = \$this->connectiondatabase(\$sql_exc_other);
							//pr(\$advf);
								
							return \$advf;
							
							
						}
						function advr() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							
							\$this->Estore_advertisements->setDataEshop(\$hostname,\$username,\$password,\$databasename);
						  
							return \$this->Estore_advertisements->find ( 'all', array (
									'conditions' => array (
											'Estore_advertisements.status' => 1,
						  					'Estore_advertisements.estore_id' => \$shop_id,
											'Estore_advertisements.display' => 3 
									),
									'order' => 'Estore_advertisements.id ASC' 
							 ));
						}
						
						function advapp() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
								
							\$this->Estore_advertisements->setDataEshop(\$hostname,\$username,\$password,\$databasename);
						
							
							return \$this->Estore_advertisements->find ( 'all', array (
									'conditions' => array (
											'Estore_advertisements.status' => 1,
											'Estore_advertisements.estore_id' => \$shop_id,
											'Estore_advertisements.display' => 3
									),
									'order' => 'rand()',
									'limit' => 3
							));
						}
						
						// +++++++++++++++++++++++++++++++++++Home+++++++++++++++++++++++++++++++++++++++++++++++
						function index() {
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
						
							\$this->set ( 'shopname', \$nameeshop );
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							\$this->paginate = array (
									'conditions' => array (
											'Estore_products.status' => 1,
											'Estore_products.spkuyenmai' => 1 
									),
									'limit' => '9',
									'order' => 'Estore_products.id DESC' 
							);
							\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
							
							\$this->Estore_catproducts->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$check1 = \$this->Estore_catproducts->find ( 'list', array (
									'conditions' => array (
											'Estore_catproducts.parent_id' => 106 
									),
									'fields' => array (
											'Estore_catproducts.id' 
									) 
							) );
							
							\$this->Estore_catproducts->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$checks = \$this->Estore_catproducts->find ( 'list', array (
									'conditions' => array (
											'Estore_catproducts.parent_id' => \$check1 
									),
									'fields' => array (
											'Estore_catproducts.id' 
									) 
							) );
							
							if (\$checks != null) {
								\$this->set ( 'tubep', \$this->Estore_products->find ( 'all', array (
										'conditions' => array (
												'Estore_products.status' => 1,
												'Estore_products.catproduct_id' => \$check1,
												'Estore_products.catproduct_id' => \$checks 
										),
										'limit' => 6,
										'order' => 'Estore_products.id DESC' 
								) ) );
							} else {
								\$this->set ( 'tubep', \$this->Estore_products->find ( 'all', array (
										'conditions' => array (
												'Estore_products.status' => 1,
												'Estore_products.catproduct_id' => \$check1 
										),
										'limit' => 6,
										'order' => 'Estore_products.id DESC' 
								) ) );
							}
							
							\$check2 = \$this->Estore_catproducts->find ( 'list', array (
									'conditions' => array (
											'Estore_catproducts.parent_id' => 107 
									),
									'fields' => array (
											'Estore_catproducts.id' 
									) 
							) );
							
							\$checkss = \$this->Estore_catproducts->find ( 'list', array (
									'conditions' => array (
											'Estore_catproducts.parent_id' => \$check2 
									),
									'fields' => array (
											'Estore_catproducts.id' 
									) 
							) );
							
							if (\$checkss != null) {
								\$this->set ( 'bepcongnghiep', \$this->Estore_products->find ( 'all', array (
										'conditions' => array (
												'Estore_products.status' => 1,
												'Estore_products.catproduct_id' => \$check2,
												'Estore_products.catproduct_id' => \$checkss 
										),
										'limit' => 6,
										'order' => 'Estore_products.id DESC' 
								) ) );
							} else {
								
								\$this->set ( 'bepcongnghiep', \$this->Estore_products->find ( 'all', array (
										'conditions' => array (
												'Estore_products.status' => 1,
												'Estore_products.catproduct_id' => \$check2 
										),
										'limit' => 6,
										'order' => 'Estore_products.id DESC' 
								) ) );
							}
							\$this->set ( 'spvip', \$this->Estore_products->find ( 'all', array (
									'conditions' => array (
											'Estore_products.status' => 1,
											'Estore_products.sptieubieu' => '1' 
									),
									'limit' => 6,
									'order' => 'Estore_products.id DESC' 
							) ) );
							
							
						}
						// ++++++++++++++++++++++++++++++Product++++++++++++++++++++++++++++++++++++++++
						function indexproduct() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							
							\$this->set ( 'shopname', \$nameeshop );
							
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_products.status' => 1 
									),
									'order' => 'Estore_products.id DESC',
									'limit' => 9 
							);
							\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
						}
						function dssanpham(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$check = \$this->Estore_catproduct->find ( 'list', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => \$id 
									),
									'fields' => array (
											'Estore_catproduct.id' 
									) 
							) );
							// var_dump(\$check); exit();
							if (\$check != null) {
								\$this->paginate = array (
										'conditions' => array (
												'Estore_catproduct.status' => 1,
												'Estore_catproduct.parent_id' => \$id 
										),
										'order' => 'Estore_catproduct.id ASC',
										'limit' => 9 
								);
								\$this->set ( 'catproduct', \$this->paginate ( 'Estore_catproduct', array () ) );
								\$this->set ( 'cat', \$this->Estore_catproduct->read ( null, \$id ) );
							} else {
								\$this->paginate = array (
										'conditions' => array (
												'Estore_product.status' => 1,
												'Estore_product.catproduct_id' => \$id 
										),
										'order' => 'Estore_product.id DESC',
										'limit' => 9 
								);
								\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
								\$this->set ( 'cat', \$this->Estore_catproduct->read ( null, \$id ) );
							}
						}
						function all(\$id = null) {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->set ( 'shopname', \$nameeshop );
							
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$this->Estore_catproducts->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$check = \$this->Estore_catproducts->find ( 'list', array (
									'conditions' => array (
											'Estore_catproducts.parent_id' => \$id 
									),
									'fields' => array (
											'Estore_catproducts.id' 
									) 
							) );
							
							if (\$check != null) {
								\$this->paginate = array (
										'conditions' => array (
												'Estore_products.status' => 1,
												'Estore_products.catproduct_id' => \$check 
										),
										'order' => 'Estore_products.id DESC',
										'limit' => 18 
								);
								\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								\$this->Estore_catproducts->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
								\$this->set ( 'cat', \$this->Estore_catproducts->read ( null, \$id ) );
							} else {
								\$this->paginate = array (
										'conditions' => array (
												'Estore_products.status' => 1,
												'Estore_products.catproduct_id' => \$id 
										),
										'order' => 'Estore_products.id DESC',
										'limit' => 18 
								);
								\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								\$this->Estore_catproducts->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
								\$this->set ( 'cat', \$this->Estore_catproducts->read ( null, \$id ) );
							}
						}
						function khuyenmaiproduct() {
							
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							
							\$this->set ( 'shopname', \$nameeshop );
							
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							
							\$this->paginate = array (
									'conditions' => array (
											'Estore_products.status' => 1,
											'Estore_products.spkuyenmai' => 1 
									),
									'order' => 'Estore_products.id DESC',
									'limit' => 18 
							);
							\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
							\$this->set ( 'cat', 'Sản phẩm khuyến mãi' );
						}
						function vip() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							
							\$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.sptieubieu' => 1 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 18 
							);
							\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
							\$this->set ( 'cat', 'Sản phẩm trung & cao cấp' );
						}
						function vpp() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$dem = \$this->Estore_catproduct->find ( 'list', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => '21' 
									),
									'fields' => array (
											'Estore_catproduct.id' 
									) 
							) );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => \$dem 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 12 
							);
							\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
							\$this->set ( 'newsproducts', \$this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => \$dem,
											'Estore_product.sptieubieu' => '1' 
									),
									'limit' => 16,
									'order' => 'Estore_product.id DESC' 
							) ) );
						}
						function thietbivp() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$dem = \$this->Estore_catproduct->find ( 'list', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => '22' 
									),
									'fields' => array (
											'Estore_catproduct.id' 
									) 
							) );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => \$dem 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 12 
							);
							\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
							\$this->set ( 'newsproducts', \$this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => \$dem,
											'Estore_product.sptieubieu' => '1' 
									),
									'limit' => 16,
									'order' => 'Estore_product.id DESC' 
							) ) );
						}
						function thietbicntt() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$dem = \$this->Estore_catproduct->find ( 'list', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => '23' 
									),
									'fields' => array (
											'Estore_catproduct.id' 
									) 
							) );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => \$dem 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 12 
							);
							\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
							\$this->set ( 'newsproducts', \$this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => \$dem,
											'Estore_product.sptieubieu' => '1' 
									),
									'limit' => 16,
									'order' => 'Estore_product.id DESC' 
							) ) );
						}
						function listproduct(\$id = null) {
							
							\$this->set ( 'shopname', \$this->shopname );
							
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							
							mysql_query ( \"SET names utf8\" );
							\$this->loadModelNew('Estore_products');
							\$this->set ( 'newsproducts', \$this->Estore_products->find ( 'all', array (
									'conditions' => array (
											'Estore_products.status' => 1,
											'Estore_products.catproduct_id' => \$id,
											'Estore_products.sptieubieu' => '1' 
									),
									'limit' => 9,
									'order' => 'Estore_products.id DESC' 
							) ) );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_products.status' => 1,
											'Estore_products.catproduct_id' => \$id 
									),
									'order' => 'Estore_products.id DESC',
									'limit' => 9 
							);
							\$this->loadModelNew('Estore_products');
							\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
							\$this->loadModelNew('Estore_catproducts');
							\$this->set ( 'cat', \$this->Estore_catproducts->read ( null, \$id ) );
						}
						function validatesearch() {
							\$this->set ( 'shopname', \$this->shopname );
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
								
							mysql_query ( \"SET names utf8\" );
							\$this->loadModelNew('Estore_products');
							\$getallprod = \$this->Estore_products->find ( 'all', array () );
							
							return \$getallprod;
							
						}
						function listsp1(\$id = null) {
							\$this->set ( 'shopname', \$this->shopname );
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							
							mysql_query ( \"SET names utf8\" );
							
							\$this->paginate = array (
									'conditions' => array (
											'Estore_products.status' => 1,
											'Estore_products.catproduct_id' => \$id 
									),
									'order' => 'Estore_products.id DESC',
									'limit' => 9 
							);
							\$this->loadModelNew('Estore_products');
							\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
							pr(\$this->paginate ( 'Estore_products', array () ));
							\$this->loadModelNew('Estore_catproducts');
							\$this->set ( 'cat', \$this->Estore_catproducts->read ( null, \$id ) );
						}
						function listsp12(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => \$id 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 10 
							);
							\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
							\$this->set ( 'cat', \$this->Estore_catproduct->read ( null, \$id ) );
						}
						function listsp2(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => \$id 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 10 
							);
							\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
							\$this->set ( 'cat', \$this->Estore_catproduct->read ( null, \$id ) );
						}
						function search() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_categories->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							//\$this->loadModel ( \"Estore_catproducts\" );
							
							if (isset ( \$_POST ['query'] )) {
								\$query = \$_POST ['query'];
							} else
								\$query = \"\";
							
							if ((\$query == \"\")) {
								
								\$this->paginate = array (
										'conditions' => array (
												'Estore_products.status' => 1 
										),
										'limit' => '21',
										'order' => 'Estore_products.id DESC' 
								);
								\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
							}else {
								\$this->paginate = array (
										'conditions' => array (
												'Estore_products.status' => 1,
												'Estore_products.title' =>\$query
										),
										'limit' => '21',
										'order' => 'Estore_products.id DESC'
								);
								\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
							}
							
							
						}
						function view(\$id = null) {
							
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							\$this->set ( 'shopname', \$nameeshop );
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							mysql_query ( \"SET names utf8\" );
							if (! \$id) {
								\$this->Session->setFlash ( __ ( 'Không tồn tại', true ) );
								\$this->redirect ( array (
										'action' => 'index' 
								) );
							}
							\$this->set ( 'views', \$this->Estore_products->read ( null, \$id ) );
							\$this->Estore_catproducts->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$this->set ( 'news', \$this->Estore_catproducts->read ( null, \$id ) );
							
							\$name = \$this->Estore_products->read ( null, \$id );
							
							\$this->set ( 'views', \$name );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_products.status' => 1,
											'Estore_products.catproduct_id' => \$name ['Estore_products'] ['catproduct_id'],
											'Estore_products.id <>' => \$name ['Estore_products'] ['id'] 
									),
									'order' => 'Estore_products.id DESC',
									'limit' => 8 
							);
							\$this->set ( 'sanphamkhac', \$this->paginate ( 'Estore_products', array () ) );
						}
						function loginregister(){
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->set ( 'shopname', \$nameeshop );
								
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							
						}
						// shopping
						function addshopingcart(\$id = null) {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->set ( 'shopname', \$nameeshop );
							
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$product = \$this->Estore_products->read ( null, \$id );
							
							if (! isset ( \$_SESSION ['shopingcart'] )) {
								\$_SESSION ['shopingcart'] = array ();
							}
							;
							
							if (isset ( \$_SESSION ['shopingcart'] )) {
								
								\$shopingcart = \$_SESSION ['shopingcart'];
								if (isset ( \$shopingcart [\$id] )) {
									\$shopingcart [\$id] ['sl'] = \$shopingcart [\$id] ['sl'] + 1;
									\$shopingcart [\$id] ['total'] = \$shopingcart [\$id] ['price'] * \$shopingcart [\$id] ['sl'];
									\$_SESSION ['shopingcart'] = \$shopingcart;
									//echo '<script language=\"javascript\"> alert(\"Thêm thành công\"); window.location.replace(\"' . DOMAIN .\$this->shopname. '/viewshopingcart\"); </script>';
									echo '<script language=\"javascript\"> window.location.replace(\"' . DOMAIN .\$this->shopname. '/viewshopingcart\"); </script>';
										
								} else {
									\$shopingcart [\$id] ['pid'] = \$id;
									\$shopingcart [\$id] ['name'] = \$product ['Estore_products'] ['title'];
									\$shopingcart [\$id] ['images'] = \$product ['Estore_products'] ['images'];
									\$shopingcart [\$id] ['sl'] = 1;
									\$shopingcart [\$id] ['price'] = \$product ['Estore_products'] ['price'];
									\$shopingcart [\$id] ['total'] = \$product ['Estore_products'] ['price'] * \$shopingcart [\$id] ['sl'];
									\$_SESSION ['shopingcart'] = \$shopingcart;
									//echo '<script language=\"javascript\" type=\"text/javascript\"> alert(\"Thêm giỏ hàng thành công\"); window.location.replace(\"' . DOMAIN .\$this->shopname . '/viewshopingcart\"); </script>';
									echo '<script language=\"javascript\" type=\"text/javascript\"> window.location.replace(\"' . DOMAIN .\$this->shopname . '/viewshopingcart\"); </script>';
									
								}
							}
						}
						function deleteshopingcart(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							if (isset ( \$_SESSION ['shopingcart'] )) {
								\$shopingcart = \$_SESSION ['shopingcart'];
								if (isset ( \$shopingcart [\$id] ))
									unset ( \$shopingcart [\$id] );
								\$_SESSION ['shopingcart'] = \$shopingcart;
								\$this->redirect ( 'viewshopingcart' );
							}
						}
						function order(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							if (! \$id) {
								\$this->Session->setFlash ( __ ( 'Không tồn tại', true ) );
								\$this->redirect ( array (
										'action' => 'index' 
								) );
							}
							\$this->set ( 'buy', \$this->Estore_news->read ( null, \$id ) );
						}
						function viewshopingcart() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							//\$this->Estore_news->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								
							\$this->set ( 'shopname', \$nameeshop );
							
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop View Shopping' );
							if (isset ( \$_SESSION ['shopingcart'] )) {
								\$shopingcart = \$_SESSION ['shopingcart'];
								\$this->set ( compact ( 'shopingcart' ) );
							} else {
								\$shopingcart = '';
								\$this->set ( 'shopingcart',\$shopingcart );
								//echo '<script language=\"javascript\"> alert(\"Chua co san pham nao trong gio hang\"); window.location.replace(\"' . DOMAIN .\$this->shopname . '/index\"); </script>';
							}
						}
						function updateshopingcart(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							if (isset ( \$_SESSION ['shopingcart'] )) {
								\$shopingcart = \$_SESSION ['shopingcart'];
								if (isset ( \$shopingcart [\$id] )) {
									\$shopingcart [\$id] ['sl'] = \$_POST ['soluong'];
									\$shopingcart [\$id] ['total'] = \$shopingcart [\$id] ['sl'] * \$shopingcart [\$id] ['price'];
								}
								\$_SESSION ['shopingcart'] = \$shopingcart;
								
								\$this->redirect ( 'viewshopingcart' );
							}
						}
						function buy() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->set ( 'shopname', \$nameeshop );
							
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							if (isset ( \$_SESSION ['shopingcart'] )) {
								\$shopingcart = \$_SESSION ['shopingcart'];
								\$this->set ( compact ( 'shopingcart' ) );
							} else {
								\$shopingcart = '';
								\$this->set ( 'shopingcart',\$shopingcart );
								//echo '<script language=\"javascript\"> alert(\"Không có sản phẩm nào trong giỏ hàng của bạn\"); window.location.replace(\"' . DOMAIN .\$this->shopname.'\"); </script>';
							}
							
							if(!isset(\$_SESSION['shopingcart'])){
								\$shopingcart = '';
								\$this->set ( 'shopingcart',\$shopingcart );
							}
						}
						function category(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							if (! \$id) {
								\$this->Session->setFlash ( __ ( 'Không tồn tại', true ) );
								\$this->redirect ( array (
										'action' => 'index' 
								) );
							}
							\$this->set ( 'products', \$this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'category_id' => \$id 
									),
									'order' => 'Estore_product.id DESC' 
							) ) );
						}
						function getproduct(\$id = null) {
							return \$this->Estore_product->read ( null, \$id );
						}
						// +++++++++++++++++++++Infomation++++++++++++++++++++++++++++++++++++++
						/*
						 * function indexinfomation() { \$shop=explode('/',\$this->params['url']['url']); \$shopname=\$shop[0]; \$shoparr=\$this->get_shop_id(\$shopname); foreach(\$shoparr as \$key=>\$value){ \$shop_id=\$key; } \$this->set ( 'shopname',\$shopname); \$this->set('title_for_layout', 'Đại lý - CÔNG TY THHH'); if(!\$this->Session->read(\"user_id\")){ echo \"<script>location.href='\".DOMAIN.\"login'</script>\"; }else{ if(\$this->Session->read(\"check\")==0){ \$this->set('agents',\$this->Agent->find('all')); }else{ \$this->set('agents',\$this->Agent->find('all',array('conditions'=>array('Agent.check_id'=>\$this->Session->read(\"check\"))))); } } } function viewinfomation(\$id=null) { \$shop=explode('/',\$this->params['url']['url']); \$shopname=\$shop[0]; \$shoparr=\$this->get_shop_id(\$shopname); foreach(\$shoparr as \$key=>\$value){ \$shop_id=\$key; } \$this->set ( 'shopname',\$shopname); mysql_query(\"SET names utf8\"); \$this->set('title_for_layout', 'Hỏi đáp - VIỆN KHOA HỌC VÀ CÔNG NGHỆ XÂY DỰNG GIAO THÔNG'); if (!\$id) { \$this->Session->setFlash(__('Không tồn tại', true)); \$this->redirect(array('action' => 'index')); } \$this->set('views', \$this->Estore_news->read(null, \$id)); \$conditions=array('Estore_news.status'=>1,'Estore_news.category_id'=>149,'Estore_news.id <>'=>\$id); \$this->set('list_other',\$this->Estore_news->find('all',array('conditions'=>\$conditions,'order'=>'Estore_news.id DESC','limit'=>7))); }
						 */
						// ++++++++++++++++++++++++++++++Infomations+++++++++++++++++++++++++++++++++++++++++++++
						function indexinfomations() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							
							if (! \$this->Session->read ( \"email\" )) {
								echo \"<script>location.href='\" . DOMAIN . \"login'</script>\";
							} else {
								
								\$this->set ( 'infomations', \$this->Estore_infomation->find ( 'all', array (
										'conditions' => array (
												'Estore_infomation.user_id' => \$this->Session->read ( \"id\" ) 
										),
										'limit' => 10 
								) ) );
							}
						}
						function addinfomations() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->set ( 'shopname', \$nameeshop );
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
					if(isset(\$_SESSION ['shopingcart'])){		
							\$uid = \"id\" . rand ( 1, 1000000 );
							\$data ['Estore_infomations'] ['user_id'] = (\$this->Session->read ( \"id\" ) != '' ? \$this->Session->read ( \"id\" ) : \$uid);
							\$data ['Estore_infomations'] ['mobile'] = \$_POST ['phone'];
							\$data ['Estore_infomations'] ['address'] = \$_POST ['address'];
							\$data ['Estore_infomations'] ['email'] = \$_POST ['email'];
							\$data ['Estore_infomations'] ['name'] = \$_POST ['name'];
							\$data ['Estore_infomations'] ['phone'] = \$_POST ['phone'];
							\$data ['Estore_infomations'] ['total'] = \$_POST ['total'];
							\$data ['Estore_infomations'] ['estore_id'] = \$shop_id;
							
							\$this->Estore_infomations->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$this->Estore_infomations->save ( \$data ['Estore_infomations'] );
							
							\$info_id = \$this->Estore_infomations->getLastInsertId ();
							
							\$shopingcart = \$_SESSION ['shopingcart'];
							// print_r(\$shopingcart);exit;
							\$i = 0;
							foreach ( \$shopingcart as \$key ) {
								\$this->Estore_infomationdetail->create ();
								\$data ['Estore_infomationdetail'] ['infomations_id'] = \$info_id;
								\$data ['Estore_infomationdetail'] ['product_id'] = \$key ['pid'];
								\$data ['Estore_infomationdetail'] ['name'] = \$key ['name'];
								\$data ['Estore_infomationdetail'] ['images'] = \$key ['images'];
								\$data ['Estore_infomationdetail'] ['quantity'] = \$key ['sl'];
								\$data ['Estore_infomationdetail'] ['price'] = \$key ['price'];
								\$this->Estore_infomationdetail->save ( \$data ['Estore_infomationdetail'] );
								\$i ++;
							}
							
							unset ( \$_SESSION ['shopingcart'] );
							\$textstring = 'Oder inprocess in 24h . Thank you!';//cảm ơn bạn đã đặt hàng  chúng tôi sẽ liên hệ với bạn trong vòng 24h
							\$this->set ( 'textstring', \$textstring );
							//echo '<script language=\"javascript\">alert(\"cảm ơn bạn đã đặt hàng  chúng tôi sẽ liên hệ với bạn trong vòng 24h\"); location.href=\"' . DOMAIN .\$this->shopname . '/index\";</script>';
					}else {
						//\$shopingcart = '';
						//\$this->set ( 'shopingcart',\$shopingcart );
// 						\$textstring = 'Oder inprocess in 24h . Thank you!';//cảm ơn bạn đã đặt hàng  chúng tôi sẽ liên hệ với bạn trong vòng 24h
// 						\$this->set ( 'textstring', \$textstring );
 						echo '<script language=\"javascript\">location.href=\"' . DOMAIN .\$this->shopname . '/index\";</script>';
					}

// 					\$shopingcart = '';
// 					\$this->set ( 'shopingcart',\$shopingcart );
// 					\$textstring = 'Oder inprocess in 24h . Thank you!';//cảm ơn bạn đã đặt hàng  chúng tôi sẽ liên hệ với bạn trong vòng 24h
// 					\$this->set ( 'textstring', \$textstring );
					
					
						}
						function deleteinfomations(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							if (empty ( \$id )) {
								\$this->Session->setFlash ( __ ( 'Khôn tồn tại danh mục này', true ) );
								// \$this->redirect(array('action'=>'index'));
							}
							if (\$this->Infomations->delete ( \$id )) {
								\$this->Session->setFlash ( __ ( 'Xóa danh mục thành công', true ) );
								\$this->redirect ( array (
										'action' => 'indexinfomations' 
								) );
							}
							\$this->Session->setFlash ( __ ( 'Danh mục không xóa được', true ) );
							\$this->redirect ( array (
									'action' => 'indexinfomations' 
							) );
						}
						// +++++++++++++++++++++++++++++++News+++++++++++++++++++++++++++++++++++++++++++++++++++++++
						function indexnews() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->set ( 'shopname', \$nameeshop );
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							\$this->Estore_news->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 156 
									),
									'limit' => '5',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'news', \$this->paginate ( 'Estore_news', array () ) );
						}
						function tintucnoibat() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 221 
									),
									'limit' => '6',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'news', \$this->paginate ( 'Estore_news', array () ) );
						}
						function promotion() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 222 
									),
									'limit' => '6',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'news', \$this->paginate ( 'Estore_news', array () ) );
						}
						function danceclass() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 223 
									),
									'limit' => '6',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'news', \$this->paginate ( 'Estore_news', array () ) );
						}
						
						function listnews(\$id=null) {
							//layout
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_news->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							
							//\$Estoreshopnews = \$this->Estore_news->find('all');
							//pr(\$Estoreshopnews);
							
							mysql_query(\"SET names utf8\");
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => \$id 
									),
									'limit' => '10',
											'order' => 'Estore_news.id DESC' 
									);

				      \$this->set('listnews', \$this->paginate('Estore_news',array()));
							
							\$this->Estore_categories->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$this->set('cat',\$this->Estore_categories->read(null,\$id));
						}

						function getmodolnews()
						{
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_news->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							
							\$Estoreshopnews = \$this->Estore_news->find('all');
							
							pr(\$Estoreshopnews);
							\$this->set('Estoreshopnews', \$Estoreshopnews);
						}
						
						function souvenir() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 213 
									),
									'limit' => '5',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'news', \$this->paginate ( 'Estore_news', array () ) );
						}
						function recruitment() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 220 
									),
									'limit' => '5',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'news', \$this->paginate ( 'Estore_news', array () ) );
						}
						function services() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 227 
									),
									'limit' => '7',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'news', \$this->paginate ( 'Estore_news', array () ) );
						}
						function dichvu() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 224 
									),
									'limit' => '7',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'news', \$this->paginate ( 'Estore_news', array () ) );
						}
						function ticket() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach ve may bay
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 214 
									),
									'limit' => '8',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'ticket', \$this->paginate ( 'Estore_news', array () ) );
						}
						function hotel() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach khach san
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 215 
									),
									'limit' => '8',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'hotel', \$this->paginate ( 'Estore_news', array () ) );
						}
						function carnews() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach xe du lich
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 216 
									),
									'limit' => '8',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'car', \$this->paginate ( 'Estore_news', array () ) );
						}
						function visa() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach ho chieu
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 217 
									),
									'limit' => '8',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'visa', \$this->paginate ( 'Estore_news', array () ) );
						}
						function capacity() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$news = \$this->Category->find ( 'list', array (
									'conditions' => array (
											'Category.parent_id' => 171 
									),
									'fields' => array (
											'Category.id' 
									) 
							) );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => \$news 
									),
									'limit' => '8',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'capacity', \$this->paginate ( 'Estore_news', array () ) );
						}
						function addview(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// var_dump(\$this->data);die;
							\$data = \$this->Estore_news->read ( null, \$_POST ['id'] );
							\$data ['Estore_news'] ['view'] = \$data ['Estore_news'] ['view'] + 1;
							\$this->Estore_news->save ( \$data ['Estore_news'] );
						}
						function view1(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => \$id 
									),
									'limit' => '1',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'recruitment', \$this->paginate ( 'Estore_news', array () ) );
							\$this->set ( 'cat', \$this->Category->read ( null, \$id ) );
						}
						function viewnews(\$id = null) {
						
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->set ( 'shopname', \$nameeshop );
							  \$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							
							if (! \$id) {
								\$this->Session->setFlash ( __ ( 'Không tồn tại', true ) );
								\$this->redirect ( array (
										'action' => 'index' 
								) );
							}
							\$this->Estore_news->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$x = \$this->Estore_news->read ( null, \$id );
							\$this->set ( 'views', \$x );
							\$this->Estore_news->setDataEshop(\$hostname,\$username,\$password,\$databasename);
						
							\$this->set ( 'list_other', \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => \$x ['Estore_news'] ['category_id'],
											'Estore_news.id <>' => \$id 
									),
									'limit' => 10 
							) ) );
						
						}
						function searchnews(\$name_search = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							//set data news eshop	
							\$this->Estore_news->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							\$title = \$_POST ['name_search'];
							
							\$this->set ( 'listsearch', \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.title LIKE' => '%' . \$title . '%' 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 7 
							) ) );
						}
						function thongtin() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->set ( 'shopname', \$nameeshop );
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$this->Estore_settings->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$x = \$this->Estore_settings->read ( null, 1 );
// 							pr(\$x);
							\$this->set ( 'views', \$x );
						}
                        // +++++++++++++++++++++++++++++++++++++Comments+++++++++++++++++++++++++++++++++++++++++++++++++++++++
						function indexcommentstwo() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_comments.status' => 1 
									),
									'limit' => '4',
									'order' => 'Estore_comments.id DESC' 
							);
							\$this->set ( 'comment', \$this->paginate ( 'Estore_comments', array () ) );
						}
						function indexcomments() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->set ( 'shopname', \$nameeshop );
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							\$this->Estore_comments->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								
							\$this->paginate = array (
									'conditions' => array (
											'Estore_comments.status' => 1 
									),
									'limit' => '4',
									'order' => 'Estore_comments.id DESC' 
							);
							\$this->set ( 'comment', \$this->paginate ( 'Estore_comments', array () ) );
						}
						
						function addcomments() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							if (! empty ( \$this->data )) {
								// if(\$this->Session->read('security_code')==\$_POST['security']){
								
								\$data ['Estore_comments'] = \$this->data ['Estore_comments'];
								if (\$this->Estore_comments->save ( \$data ['Estore_comments'] )) {
									\$this->Session->setFlash ( __ ( 'Thêm mới comments thành công', true ) );
									// \$this->redirect(array('action' => 'index'));
									echo '<script language=\"javascript\"> location.href=\"' . DOMAIN .\$this->shopname . '/indexcomments\";</script>';
								} else {
									\$this->Session->setFlash ( __ ( 'Thêm mơi comments thất bại. Vui long thử lại', true ) );
								}
								
								// }
								/*
								 * if(\$this->Session->read('security_code')!=\$_POST['security']){ echo \"<script>alert('\".json_encode('Ban nhập không đúng mã bảo vệ !').\"');</script>\"; echo \"<script>history.back(-1);</script>\"; }
								 */
							}
						}
						// +++++++++++++++++++++++++Contacts+++++++++++++++++++++++++++++++++++++++++++++++
						function sendcontacts() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->set ( 'shopname', \$nameeshop );
							\$message= \"\";
							\$this->set('message',\$message);
							
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET NAMES 'utf8'\" );
							mysql_query ( \"SET character_set_client=utf8\" );
							mysql_query ( \"SET character_set_connection=utf8\" );
							\$this->Estore_settings->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$x = \$this->Estore_settings->read ( null, 1 );
							
							
							//pr(\$_POST);die;
							
							if (isset ( \$_POST ['name'] )) {
								\$name = trim(\$_POST ['name']);
								//\$mobile = \$_POST ['phone'];
								\$email = trim(\$_POST ['email']);
								\$title = trim(\$_POST ['title']);
								\$content = trim(\$_POST ['content']);
								
								\$data = array(
										'estore_id'=>\$x['Estore_settings']['estore_id'],
									    'name'=>\$name,
										'email'=>\$email,
										'title'=>\$title,
										'content'=>\$content
								);
								
								if(!empty(\$data)) {
									\$this->Estore_contacts->setDataEshop(\$hostname,\$username,\$password,\$databasename);
									if(\$this->Estore_contacts->save(\$data))
									{
										\$resultemail = \$this->smtpmailer(\$email,'alatcas1@gmail.com','FREEMOBIWEB.MOBI',\$x['Estore_settings']['title'],\$content);
										if (\$resultemail ==1)
										{
											//echo '<script language=\"javascript\"> alert(\"Gửi mail thành công\"); location.href=\"' . DOMAIN .\$this->shopname. '\";</script>';
											\$message= \"succesfuly\";
											\$this->set('message',\$message);
										}
										else
										{
											//echo '<script language=\"javascript\"> alert(\"gửi mail không thành công\"); </script>';
											\$this->set('message',\$resultemail);
										}
									}
								}
			                   
								
							}
						}
						
				  function smtpmailer(\$to, \$from, \$from_name, \$subject, \$body) {
					       //++++++++ include PhpMailler +++++++++++
							\$libraryPhpMailer = ROOT.'/PhpMailer/';
							\$filename = \$libraryPhpMailer.'class.phpmailer.php';
							if(file_exists(\$filename))
							   include(\$filename);
							global \$error;
					        \$mail = new PHPMailer();
					        \$mail->IsSMTP();
					        \$mail->CharSet = \"utf-8\";
					        \$mail->SMTPDebug = 0;
					        \$mail->SMTPAuth = true;
					        \$mail->SMTPSecure = 'ssl';
					        \$mail->Host = 'smtp.gmail.com';
					        \$mail->Port = 465;
					        \$mail->Username = GUSER;
					        \$mail->Password = GPWD;
					        \$mail->SetFrom(\$from, \$from_name);
					        \$mail->Subject = \$subject;
					        \$mail->Body = \$body;
					        \$mail->AddAddress(\$to);
					        if (!\$mail->Send()) {
					            \$error = 'Gởi mail bị lỗi: ' . \$mail->ErrorInfo;
					            return false;
					        } else {
					            \$error = 'thư của bạn đã được gởi đi ';
					            return true;
					        }
					    }
						
						
						
						function dathangcontacts() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/creativemarket';
							\$this->set ( 'title_for_layout', 'e-shop' );
							
							mysql_query ( \"SET NAMES 'utf8'\" );
							mysql_query ( \"SET character_set_client=utf8\" );
							mysql_query ( \"SET character_set_connection=utf8\" );
							// \$x=\$this->Helps->read(null,1);
							if (isset ( \$_SESSION ['shopingcart'] )) {
								\$shopingcart = \$_SESSION ['shopingcart'];
								\$this->set ( compact ( 'shopingcart' ) );
							} else {
								echo '<script language=\"javascript\"> alert(\"Chua co san pham nao trong gio hang\"); window.location.replace(\"' . DOMAIN . '\"); </script>';
							}
							if (isset ( \$_POST ['name'] )) {
								\$name = \$_POST ['name'];
								\$mobile = \$_POST ['phone'];
								\$email = \$_POST ['email'];
								\$title = \$_POST ['title'];
								\$content = \$_POST ['content'];
								
								\$images = \$_POST ['images'];
								\$product_name = \$_POST ['product_name'];
								\$product_sl = \$_POST ['product_sl'];
								\$price = \$_POST ['price'];
								\$total = \$_POST ['total'];
								\$this->Email->from = \$name . '<' . \$email . '>';
								\$this->Email->to = '';
								\$this->Email->subject = \$title;
								\$this->Email->template = 'default';
								\$this->Email->sendAs = 'both';
								\$this->set ( 'name', \$name );
								\$this->set ( 'mobile', \$mobile );
								\$this->set ( 'email', \$email );
								\$this->set ( 'content', \$content );
								
								\$this->set ( 'images', \$images );
								\$this->set ( 'product_name', \$product_name );
								\$this->set ( 'product_sl', \$product_sl );
								\$this->set ( 'price', \$price );
								\$this->set ( 'total', \$total );
								
								\$this->set ( 'sang', array (
										'images',
										'product_name',
										'product_sl',
										'price',
										'total' 
								) );
								
								if (\$this->Email->send ()) {
									\$this->Session->setFlash ( __ ( 'Thêm mới danh mục thành công', true ) );
									echo '<script language=\"javascript\"> alert(\"Gửi mail thành công\"); </script>';
									unset ( \$_SESSION ['shopingcart'] );
									echo '<script language=\"javascript\">location.href=\"' . DOMAIN . '\";</script>';
								} else
									\$this->Session->setFlash ( __ ( 'Thêm mơi danh mục thất bại. Vui long thử lại', true ) );
								echo '<script language=\"javascript\"> alert(\"gửi mail không thành công\"); location.href=\"' . DOMAIN . '\";</script>';
							}
						}
					 }		
				   \n";
						$stringData .= "?>\n";
						fwrite ( $fh, $stringData );
						fclose ( $fh );
						
						$fromfile = DOCUMENT_ROOT . 'app/controllers/creativeeshopcopy_controller.php';
						$tofile = DOCUMENT_ROOT . 'app/controllers/' . $project_name. '_controller.php';
							
						if (file_exists ( $tofile )) {
							return $dir_and_name_estore = "Tên gian hàng đã tồn tại";
							//exit ();
						}
						copy ( $fromfile, $tofile );
							
						return $controller_estore ="SucessFullController".$layout_code;
						break;		   
					//end 50000568
				}
			case 50000567:
				{
					
					$myFile = DOCUMENT_ROOT . 'app/controllers/clotfzakju_controllercopy.php';
					$fh = fopen ( $myFile, 'w' ) or die ( "can't open file" );
					$stringData = "";
					$stringData .= "<?php\n";
					$stringData .= "
						  class " . ucfirst ( $project_name) . "Controller extends AppController {
						  var \$name = '" . ucfirst ( $project_name) . "';
						   var \$shopname ='".$project_name."';
						   	var \$uses = array (
						  		'Estore_categories',//Catalogueshop
						  		'Estore_news',//eshop
						  		'Estore_products',//eshop products
						  		'Estore_catproducts',// eshop Estorecatproducts
						  		'Estore_manufacturers',// eshop Estore_manufacturers
						  		'Estore_advertisements',//eshop Estore_advertisements
						  		'Estore_slideshows', //eshop Estore_slideshows
						  		'Estore_partners', // eshop Estore_partners
						  		'Estore_infomations',//eshop Estore_infomations
								'Estore_albums',//eshop Estore_albums
						  		'Estore_settings',//eshop Estore_settings
								'Estore_banners',//eshop Estore_banners
								'Estore_category',
								'Estore_comments',//eshop Estore_comments
								'Estore_contacts',//eshop Estore_contacts
								'Estore_user',
								'Estore_news',
								'Estore_infomation',
								'Estore_order',
								'Estore_infomationdetail',
								'Estore_gallery',
								'Estore_album',
								'Estore_banner',
								'Estore_helps',
								'Estore_setting',
								'Estore_video',
								'Estore_slideshow',
								'Estore_partner',
								'Estore_advertisement',
								'Estore_catproduct',
								'Estore_product',
								'Estore_weblink',
								'Estore_manufacturer',
								'Shop' 
						);
						var \$paginate = array();
						var \$helpers = array (
								'Html',
								'Ajax',
								'Javascript',//'Paginator' 
						);
						var \$components = array (
								'RequestHandler',
								'Email' 
						);
						function loadModelNew(\$Model) {
							// ++++++++++++connection data +++++++++++++++++
						
							//++++++++++++connection data +++++++++++++++++
							\$nameeshop = \$this->shopname;
							//\$shop_id = 276; //\$this->Session->read(\"id\");
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											//'Shop.id' => \$shop_id,
											'Shop.name' => \$nameeshop,
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
								
							if(is_array(\$shoparr) and !empty(\$shoparr))
							{
								foreach(\$shoparr as \$shop){
									\$databasename = \$shop['Shop']['databasename'];
									\$password = \$shop['Shop']['password'];
									\$username = \$shop['Shop']['username'];
									\$hostname = \$shop['Shop']['hostname'];
									\$shop_id = \$shop['Shop']['id'];
									\$nameproject = \$shop['Shop']['name'];           // \$nameproject is name Ctronller
									\$email = trim(\$shop['Shop']['email']);
									\$userpass = \$shop['Shop']['userpass'];
								}
							}
							// 		\$hostname = 'localhost';
							// 		\$username = 'root';
							// 		\$databasename = 'eshopdaquy';
							// 		\$password = '';
						
							\$this->\$Model->setDataEshop ( \$hostname, \$username, \$password, \$databasename );
						}
						function connectiondatabase(\$sql) {
							\$nameeshop = \$this->shopname;	
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
						
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							\$db = new ConnectionManager;
							\$config = array(
									//'className' => 'Cake\Database\Connection',
									'driver' => 'mysql',
									'persistent' => false,
									'host' =>\$hostname,
									'login' =>\$username,
									'password' =>\$password,
									'database' =>\$databasename,
									'prefix' => false,
									'encoding' => 'utf8',
									'timezone' => 'UTC',
									'cacheMetadata' => true
							);
							\$db->create(\$databasename,\$config);
							\$name = ConnectionManager::getDataSource(\$databasename);
							// 							                                    echo \"99999999</br>\";
							// 							                                    pr(\$name->config);die;
							/*
							\$sql = \"SELECT estore_catproducts.*
									 FROM  estore_catproducts
									 WHERE estore_catproducts.parent_id= 11 AND estore_catproducts.estore_id =\".(int)\$shop_id.\" ORDER BY  estore_catproducts.name ASC \";
							//\$resul = \$name->rawQuery(\$sql);
							 * */
							 
							\$resul = \$name->fetchAll(\$sql);
								
							//pr(\$resul);
							return \$resul;
								
						}
						
						
						
						function get_shop_id(\$name) {
							
						
							return \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$name,
											'Shop.status' => 1 
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username', 
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									) 
							) );
						}
						
					
						
						function getOrder() {
							mysql_query ( \"SET names utf8\" );
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							//set data news eshop	
							\$this->Estore_infomations->setDataEshop(\$hostname,\$username,\$password,\$databasename);
						
							return \$this->Estore_infomations->find ( 'all', array (
									'order' => 'Estore_infomations.id DESC' 
							) );
						}
						function getAlbum() {
							mysql_query ( \"SET names utf8\" );
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							//set data news eshop	
							\$this->Estore_albums->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							return \$this->Estore_albums->find ( 'all', array (
									'conditions' => array (
											'Estore_albums.status' => 1 
									),
									'limit' => '3',
									'order' => 'Estore_albums.id ASC' 
							) );
						}
					
						function menucategory() {
							mysql_query ( \"SET names utf8\" );
							\$sql_exc = \"SELECT `estore_categories`.`id`, `estore_categories`.`estore_id`, `estore_categories`.`tt`, `estore_categories`.`parent_id`, `estore_categories`.`lft`, `estore_categories`.`rght`, `estore_categories`.`name`, `estore_categories`.`name_en`, `estore_categories`.`created`, `estore_categories`.`modified`, `estore_categories`.`status`, `estore_categories`.`images`, `estore_categories`.`alias` FROM `estore_categories` AS `estore_categories`   WHERE `estore_categories`.`status` = 1 AND `estore_categories`.`parent_id` IS NULL   ORDER BY `estore_categories`.`tt` ASC\";
								
							\$result = \$this->connectiondatabase(\$sql_exc);
							//pr(\$result);
							return \$result;
							
						}
						function showcategory(\$id = null) {
							mysql_query ( \"SET names utf8\" );
							\$sql_exc = \"SELECT `estore_categories`.`id`, `estore_categories`.`estore_id`,
									           `estore_categories`.`tt`, `estore_categories`.`parent_id`, 
									           `estore_categories`.`lft`, `estore_categories`.`rght`, 
									           `estore_categories`.`name`, `estore_categories`.`name_en`, 
									           `estore_categories`.`created`, `estore_categories`.`modified`,
									           `estore_categories`.`status`, `estore_categories`.`images`,
									           `estore_categories`.`alias` 
									     FROM `estore_categories` AS `estore_categories`  
									     WHERE `estore_categories`.`parent_id` = '\".\$id.\"'  
									     ORDER BY `estore_categories`.`tt` ASC\";
							\$result = \$this->connectiondatabase(\$sql_exc);
							//pr(\$result);
							return \$result;

						}
						
						function banner(\$shop_id=null) {
							\$sql_exc = \"SELECT estore_banners.*
									 FROM  estore_banners
									 WHERE estore_banners.estore_id =\".(int)\$shop_id.\" AND estore_banners.status = 1 ORDER BY  estore_banners.id ASC \";
								
							\$result = \$this->connectiondatabase(\$sql_exc);
							//pr(\$result);
							return \$result;
							
						}
						function setting(\$shop_id=null) {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_settings->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							return \$this->Estore_settings->find ( 'all', array (
									'conditions' => array ('Estore_settings.estore_id' =>\$shop_id),
									'order' => 'Estore_settings.id DESC' 
									) );
						}
						function adv() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_banners->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							return \$this->Estore_banners->find ( 'all', array (
									'conditions' => array (
											'Estore_banners.status' => 1 
									),
									'order' => 'Estore_banners.id DESC',
									'limit' => 2 
							) );
						}
						function doitac() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_partners->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							
						    return \$this->Estore_partners->find ( 'all', array (
									'conditions' => array (
											'Estore_partners.status' => 1 
									),
									'order' => 'Estore_partners.id DESC' 
							) );
						}
						function menu_active() {
							return \$this->Categoryestore2->find ( 'all', array (
									'conditions' => array (
											'Categoryestore2.parent_id' => 145 
									),
									'order' => 'Categoryestore2.id ASC' 
							) );
						}
						function helpsonline() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_helps->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							
							return \$this->Estore_helps->find ( 'all', array (
									'conditions' => array (
											'Estore_helps.status' => 1,
											'Estore_helps.estore_id' => \$shop_id
									),
									'order' => 'Estore_helps.id DESC' 
							) );
						}
						function id_product(\$id) {
							return \$this->Estore_product->read ( null, \$id );
							// pr(\$this->Estore_product->read(null,\$id));die;
						}
						function hot() {
							return \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 156 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 1 
							) );
						}
						function hotnew(\$shop_id=null) {
							\$sql_exc = \"SELECT estore_news.*
									 FROM  estore_news
									 WHERE estore_news.estore_id =\".(int)\$shop_id.\" AND estore_news.status = 1 AND estore_news.category_id = 156 ORDER BY  estore_news.id DESC LIMIT 6 \";
								
							\$result = \$this->connectiondatabase(\$sql_exc);
							//pr(\$result);
							
							return \$result;
							
						}
						function getinfo(\$cat = null) {
							return \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => \$cat 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 3 
							) );
						}
						function videos(\$shop_id=null) {
							mysql_query ( \"SET names utf8\" );
							\$sql_exc_other = \"SELECT estore_videos.*
											 FROM  estore_videos
											 WHERE estore_videos.status = 1 AND estore_videos.left= 0 AND estore_videos.estore_id= \".\$shop_id.\" ORDER BY estore_videos.id DESC LIMIT 1\";
							\$result_video = \$this->connectiondatabase(\$sql_exc_other);
							//pr(\$result_video);
							
							return \$result_video;
						}
						function videosright() {
							mysql_query ( \"SET names utf8\" );
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_video->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							
							return \$this->Estore_video->find ( 'all', array (
									'conditions' => array (
											'Estore_video.status' => 1,
						  					'Estore_video.estore_id' => \$shop_id,
											'Estore_video.left' => 1 
									),
									'order' => 'Estore_video.id DESC',
									'limit' => 1 
							) );
						}
						function tintuc() {
							return \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 156 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 5 
							) );
						}
						function slideshow() {
							mysql_query ( \"SET names utf8\" );
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_slideshows->setDataEshop(\$hostname,\$username,\$password,\$databasename);
						
							return \$this->Estore_slideshows->find ( 'all', array (
									'conditions' => array (
											'Estore_slideshows.status' => 1 
									),
									'order' => 'Estore_slideshows.id DESC' 
							) );
						}
						function library_image() {
							return \$this->Gallery->find ( 'all', array (
									'conditions' => array (
											'Gallery.status' => 1 
									),
									'order' => 'Gallery.id DESC',
									'limit' => 10 
							) );
						}
						function shows() {
							mysql_query ( \"SET names utf8\" );
							return \$this->Estore_category->find ( 'all', array (
									'conditions' => array (
											'Estore_category.parent_id' => '201' 
									),
									'order' => 'Estore_category.id ASC' 
							) );
						}
						// SẢN PHẨM
						function menuproduct() {
							mysql_query ( \"SET names utf8\" );
							return \$this->Estore_catproduct->find ( 'all', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => '3' 
									),
									'order' => 'Estore_catproduct.id ASC' 
							) );
						}
						function submenuproduct(\$id = null) {
							return \$this->Estore_catproduct->find ( 'all', array (
									'conditions' => array (
											'Estore_catproduct.parent_id ' => \$id 
									),
									'order' => 'Estore_catproduct.id ASC' 
							) );
						}
						function showsmenu() {
							mysql_query ( \"SET names utf8\" );
							return \$this->Estore_catproduct->find ( 'all', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => '12' 
									),
									'order' => 'Estore_catproduct.id ASC' 
							) );
						}
						function showsmenu1(\$id = null) {
							\$sql_exc = \"SELECT estore_catproducts.*
									 FROM  estore_catproducts
									 WHERE estore_catproducts.parent_id =\".(int)\$id.\" AND estore_catproducts.status = 1 ORDER BY  estore_catproducts.id ASC \";
							
							\$result = \$this->connectiondatabase(\$sql_exc);
							//pr(\$result);
							return \$result;

						}
						
						
						function showsmenu2(\$id = null) {
							\$sql_exc = \"SELECT estore_catproducts.*
									 FROM  estore_catproducts
									 WHERE estore_catproducts.parent_id =\".(int)\$id.\" AND estore_catproducts.status = 1 ORDER BY  estore_catproducts.id ASC \";
								
							\$result = \$this->connectiondatabase(\$sql_exc);
							//pr(\$result);
							return \$result;
						}
						
						function danhmuc(\$shopname) {
							
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$shopname,
											'Shop.status' => 1 
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username', 
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									) 
							) );

							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
							
							}
							\$db = new ConnectionManager;
							\$config = array(
									//'className' => 'Cake\Database\Connection',
									'driver' => 'mysql',
									'persistent' => false,
									'host' =>\$hostname,
									'login' =>\$username,
									'password' =>\$password,
									'database' =>\$databasename,
									'prefix' => false,
									'encoding' => 'utf8',
									'timezone' => 'UTC',
									'cacheMetadata' => true
							);
							\$db->create(\$databasename,\$config);
							\$name = ConnectionManager::getDataSource(\$databasename);
// 							                                    echo \"99999999</br>\";
// 							                                    pr(\$name->config);die;
							\$sql = \"SELECT estore_catproducts.*
									 FROM  estore_catproducts
									 WHERE estore_catproducts.parent_id= 0 AND estore_catproducts.estore_id =\".(int)\$shop_id.\" ORDER BY  estore_catproducts.name ASC \";
							//\$resul = \$name->rawQuery(\$sql);
							\$resul = \$name->fetchAll(\$sql);
							
							//pr(\$resul);
							return \$resul;
							
						}
						function typical(\$shop_id = Null) {
							return \$this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.estore_id' => \$shop_id 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 10 
							) );
						}
						function productnew() {
							return \$this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 10 
							) );
						}
						function khuyenmai() {
							return \$this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.display' => '1' 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 10 
							) );
						}
						function business() {
							return \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 218 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 5 
							) );
						}
						function customers() {
							return \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 219 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 5 
							) );
						}
						function science() {
							return \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 220 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 5 
							) );
						}
						function help() {
							return \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 156 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 8 
							) );
						}
						function tinkhuyenmai() {
							return \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 227 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 5 
							) );
						}
						function tinkhuyenmaile() {
							return \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 228 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 5 
							) );
						}
						function weblink() {
							return \$this->Estore_weblink->find ( 'all', array (
									'conditions' => array (
											'Estore_weblink.status' => 1 
									),
									'order' => 'Estore_weblink.id DESC' 
							) );
						}
						function cat() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_catproducts->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$prff = \$this->Estore_catproducts->find ( 'all', array (
									'conditions' => array (
											'Estore_catproducts.status' => 1 
									) 
							) );
						//	echo \"xzxzx\";
						//pr(\$prff);
							return \$prff;
							
						}
						function hsx() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->Estore_manufacturers->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$manufacturer =\$this->Estore_manufacturers->find ( 'all', array (
									'conditions' => array (
											'Estore_manufacturers.status' => 1,
											'Estore_manufacturers.parent_id ' => null 
									) 
							) );
							
// 							pr(\$manufacturer);
							return \$manufacturer;
// 							return \$this->Estore_manufacturer->find ( 'all', array (
// 									'conditions' => array (
// 											'Estore_manufacturer.status' => 1,
// 											'Estore_manufacturer.parent_id ' => null 
// 									) 
// 							) );
						}
						function catcon() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->Estore_catproducts->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$prff = \$this->Estore_catproducts->find ( 'all', array (
									'conditions' => array (
											'Estore_catproducts.status' => 1
									)
							) );
							//	echo \"xzxzx\";
							//pr(\$prff);
							return \$prff;

						}
						function adv1() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_advertisements->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							
							return \$this->Estore_advertisements->find ( 'all', array (
									'conditions' => array (
											'Estore_advertisements.status' => 1,
											'Estore_advertisements.display' => 0 
									),
									'limit' => 1 
							) );
						}
						function adv2() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->Estore_advertisements->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								
							return \$this->Estore_advertisements->find ( 'all', array (
									'conditions' => array (
											'Estore_advertisements.status' => 1,
											'Estore_advertisements.display' => 1 
									),
									'limit' => 1 
							) );
						}
						function advf(\$shop_id= null) {
							\$sql_exc_other = \"SELECT estore_advertisements.*
											 FROM  estore_advertisements
											 WHERE estore_advertisements.status = 1 AND estore_advertisements.display= 2 AND estore_advertisements.estore_id= \".\$shop_id.\" ORDER BY estore_advertisements.id \";
							\$advf = \$this->connectiondatabase(\$sql_exc_other);
							//pr(\$advf);
								
							return \$advf;
							
							
						}
						function advr() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							
							\$this->Estore_advertisements->setDataEshop(\$hostname,\$username,\$password,\$databasename);
						  
							return \$this->Estore_advertisements->find ( 'all', array (
									'conditions' => array (
											'Estore_advertisements.status' => 1,
						  					'Estore_advertisements.estore_id' => \$shop_id,
											'Estore_advertisements.display' => 3 
									),
									'order' => 'Estore_advertisements.id ASC' 
							 ));
						}
						
						function advapp() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
								
							\$this->Estore_advertisements->setDataEshop(\$hostname,\$username,\$password,\$databasename);
						
							
							return \$this->Estore_advertisements->find ( 'all', array (
									'conditions' => array (
											'Estore_advertisements.status' => 1,
											'Estore_advertisements.estore_id' => \$shop_id,
											'Estore_advertisements.display' => 3
									),
									'order' => 'rand()',
									'limit' => 3
							));
						}
						
						// +++++++++++++++++++++++++++++++++++Home+++++++++++++++++++++++++++++++++++++++++++++++
						function index() {
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
						
							\$this->set ( 'shopname', \$nameeshop );
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							\$this->paginate = array (
									'conditions' => array (
											'Estore_products.status' => 1,
											'Estore_products.spkuyenmai' => 1 
									),
									'limit' => '9',
									'order' => 'Estore_products.id DESC' 
							);
							\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
							
							\$this->Estore_catproducts->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$check1 = \$this->Estore_catproducts->find ( 'list', array (
									'conditions' => array (
											'Estore_catproducts.parent_id' => 106 
									),
									'fields' => array (
											'Estore_catproducts.id' 
									) 
							) );
							
							\$this->Estore_catproducts->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$checks = \$this->Estore_catproducts->find ( 'list', array (
									'conditions' => array (
											'Estore_catproducts.parent_id' => \$check1 
									),
									'fields' => array (
											'Estore_catproducts.id' 
									) 
							) );
							
							if (\$checks != null) {
								\$this->set ( 'tubep', \$this->Estore_products->find ( 'all', array (
										'conditions' => array (
												'Estore_products.status' => 1,
												'Estore_products.catproduct_id' => \$check1,
												'Estore_products.catproduct_id' => \$checks 
										),
										'limit' => 6,
										'order' => 'Estore_products.id DESC' 
								) ) );
							} else {
								\$this->set ( 'tubep', \$this->Estore_products->find ( 'all', array (
										'conditions' => array (
												'Estore_products.status' => 1,
												'Estore_products.catproduct_id' => \$check1 
										),
										'limit' => 6,
										'order' => 'Estore_products.id DESC' 
								) ) );
							}
							
							\$check2 = \$this->Estore_catproducts->find ( 'list', array (
									'conditions' => array (
											'Estore_catproducts.parent_id' => 107 
									),
									'fields' => array (
											'Estore_catproducts.id' 
									) 
							) );
							
							\$checkss = \$this->Estore_catproducts->find ( 'list', array (
									'conditions' => array (
											'Estore_catproducts.parent_id' => \$check2 
									),
									'fields' => array (
											'Estore_catproducts.id' 
									) 
							) );
							
							if (\$checkss != null) {
								\$this->set ( 'bepcongnghiep', \$this->Estore_products->find ( 'all', array (
										'conditions' => array (
												'Estore_products.status' => 1,
												'Estore_products.catproduct_id' => \$check2,
												'Estore_products.catproduct_id' => \$checkss 
										),
										'limit' => 6,
										'order' => 'Estore_products.id DESC' 
								) ) );
							} else {
								
								\$this->set ( 'bepcongnghiep', \$this->Estore_products->find ( 'all', array (
										'conditions' => array (
												'Estore_products.status' => 1,
												'Estore_products.catproduct_id' => \$check2 
										),
										'limit' => 6,
										'order' => 'Estore_products.id DESC' 
								) ) );
							}
							\$this->set ( 'spvip', \$this->Estore_products->find ( 'all', array (
									'conditions' => array (
											'Estore_products.status' => 1,
											'Estore_products.sptieubieu' => '1' 
									),
									'limit' => 6,
									'order' => 'Estore_products.id DESC' 
							) ) );
							
							
						}
						// ++++++++++++++++++++++++++++++Product++++++++++++++++++++++++++++++++++++++++
						function indexproduct() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							
							\$this->set ( 'shopname', \$nameeshop );
							
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_products.status' => 1 
									),
									'order' => 'Estore_products.id DESC',
									'limit' => 9 
							);
							\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
						}
						function dssanpham(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$check = \$this->Estore_catproduct->find ( 'list', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => \$id 
									),
									'fields' => array (
											'Estore_catproduct.id' 
									) 
							) );
							// var_dump(\$check); exit();
							if (\$check != null) {
								\$this->paginate = array (
										'conditions' => array (
												'Estore_catproduct.status' => 1,
												'Estore_catproduct.parent_id' => \$id 
										),
										'order' => 'Estore_catproduct.id ASC',
										'limit' => 9 
								);
								\$this->set ( 'catproduct', \$this->paginate ( 'Estore_catproduct', array () ) );
								\$this->set ( 'cat', \$this->Estore_catproduct->read ( null, \$id ) );
							} else {
								\$this->paginate = array (
										'conditions' => array (
												'Estore_product.status' => 1,
												'Estore_product.catproduct_id' => \$id 
										),
										'order' => 'Estore_product.id DESC',
										'limit' => 9 
								);
								\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
								\$this->set ( 'cat', \$this->Estore_catproduct->read ( null, \$id ) );
							}
						}
						function all(\$id = null) {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->set ( 'shopname', \$nameeshop );
							
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$this->Estore_catproducts->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$check = \$this->Estore_catproducts->find ( 'list', array (
									'conditions' => array (
											'Estore_catproducts.parent_id' => \$id 
									),
									'fields' => array (
											'Estore_catproducts.id' 
									) 
							) );
							
							if (\$check != null) {
								\$this->paginate = array (
										'conditions' => array (
												'Estore_products.status' => 1,
												'Estore_products.catproduct_id' => \$check 
										),
										'order' => 'Estore_products.id DESC',
										'limit' => 18 
								);
								\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								\$this->Estore_catproducts->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
								\$this->set ( 'cat', \$this->Estore_catproducts->read ( null, \$id ) );
							} else {
								\$this->paginate = array (
										'conditions' => array (
												'Estore_products.status' => 1,
												'Estore_products.catproduct_id' => \$id 
										),
										'order' => 'Estore_products.id DESC',
										'limit' => 18 
								);
								\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								\$this->Estore_catproducts->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
								\$this->set ( 'cat', \$this->Estore_catproducts->read ( null, \$id ) );
							}
						}
						function khuyenmaiproduct() {
							
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							
							\$this->set ( 'shopname', \$nameeshop );
							
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							
							\$this->paginate = array (
									'conditions' => array (
											'Estore_products.status' => 1,
											'Estore_products.spkuyenmai' => 1 
									),
									'order' => 'Estore_products.id DESC',
									'limit' => 18 
							);
							\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
							\$this->set ( 'cat', 'Sản phẩm khuyến mãi' );
						}
						function vip() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							
							\$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.sptieubieu' => 1 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 18 
							);
							\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
							\$this->set ( 'cat', 'Sản phẩm trung & cao cấp' );
						}
						function vpp() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$dem = \$this->Estore_catproduct->find ( 'list', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => '21' 
									),
									'fields' => array (
											'Estore_catproduct.id' 
									) 
							) );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => \$dem 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 12 
							);
							\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
							\$this->set ( 'newsproducts', \$this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => \$dem,
											'Estore_product.sptieubieu' => '1' 
									),
									'limit' => 16,
									'order' => 'Estore_product.id DESC' 
							) ) );
						}
						function thietbivp() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$dem = \$this->Estore_catproduct->find ( 'list', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => '22' 
									),
									'fields' => array (
											'Estore_catproduct.id' 
									) 
							) );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => \$dem 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 12 
							);
							\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
							\$this->set ( 'newsproducts', \$this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => \$dem,
											'Estore_product.sptieubieu' => '1' 
									),
									'limit' => 16,
									'order' => 'Estore_product.id DESC' 
							) ) );
						}
						function thietbicntt() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$dem = \$this->Estore_catproduct->find ( 'list', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => '23' 
									),
									'fields' => array (
											'Estore_catproduct.id' 
									) 
							) );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => \$dem 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 12 
							);
							\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
							\$this->set ( 'newsproducts', \$this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => \$dem,
											'Estore_product.sptieubieu' => '1' 
									),
									'limit' => 16,
									'order' => 'Estore_product.id DESC' 
							) ) );
						}
						function listproduct(\$id = null) {
							
							\$this->set ( 'shopname', \$this->shopname );
							
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							
							mysql_query ( \"SET names utf8\" );
							\$this->loadModelNew('Estore_products');
							\$this->set ( 'newsproducts', \$this->Estore_products->find ( 'all', array (
									'conditions' => array (
											'Estore_products.status' => 1,
											'Estore_products.catproduct_id' => \$id,
											'Estore_products.sptieubieu' => '1' 
									),
									'limit' => 9,
									'order' => 'Estore_products.id DESC' 
							) ) );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_products.status' => 1,
											'Estore_products.catproduct_id' => \$id 
									),
									'order' => 'Estore_products.id DESC',
									'limit' => 9 
							);
							\$this->loadModelNew('Estore_products');
							\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
							\$this->loadModelNew('Estore_catproducts');
							\$this->set ( 'cat', \$this->Estore_catproducts->read ( null, \$id ) );
						}
						function validatesearch() {
							\$this->set ( 'shopname', \$this->shopname );
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
								
							mysql_query ( \"SET names utf8\" );
							\$this->loadModelNew('Estore_products');
							\$getallprod = \$this->Estore_products->find ( 'all', array () );
							
							return \$getallprod;
							
						}
						function listsp1(\$id = null) {
							\$this->set ( 'shopname', \$this->shopname );
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							
							mysql_query ( \"SET names utf8\" );
							
							\$this->paginate = array (
									'conditions' => array (
											'Estore_products.status' => 1,
											'Estore_products.catproduct_id' => \$id 
									),
									'order' => 'Estore_products.id DESC',
									'limit' => 9 
							);
							\$this->loadModelNew('Estore_products');
							\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
							pr(\$this->paginate ( 'Estore_products', array () ));
							\$this->loadModelNew('Estore_catproducts');
							\$this->set ( 'cat', \$this->Estore_catproducts->read ( null, \$id ) );
						}
						function listsp12(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => \$id 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 10 
							);
							\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
							\$this->set ( 'cat', \$this->Estore_catproduct->read ( null, \$id ) );
						}
						function listsp2(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => \$id 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 10 
							);
							\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
							\$this->set ( 'cat', \$this->Estore_catproduct->read ( null, \$id ) );
						}
						function search() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_categories->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							//\$this->loadModel ( \"Estore_catproducts\" );
							
							if (isset ( \$_POST ['query'] )) {
								\$query = \$_POST ['query'];
							} else
								\$query = \"\";
							
							if ((\$query == \"\")) {
								
								\$this->paginate = array (
										'conditions' => array (
												'Estore_products.status' => 1 
										),
										'limit' => '21',
										'order' => 'Estore_products.id DESC' 
								);
								\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
							}else {
								\$this->paginate = array (
										'conditions' => array (
												'Estore_products.status' => 1,
												'Estore_products.title' =>\$query
										),
										'limit' => '21',
										'order' => 'Estore_products.id DESC'
								);
								\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
							}
							
							
						}
						function view(\$id = null) {
							
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							\$this->set ( 'shopname', \$nameeshop );
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							mysql_query ( \"SET names utf8\" );
							if (! \$id) {
								\$this->Session->setFlash ( __ ( 'Không tồn tại', true ) );
								\$this->redirect ( array (
										'action' => 'index' 
								) );
							}
							\$this->set ( 'views', \$this->Estore_products->read ( null, \$id ) );
							\$this->Estore_catproducts->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$this->set ( 'news', \$this->Estore_catproducts->read ( null, \$id ) );
							
							\$name = \$this->Estore_products->read ( null, \$id );
							
							\$this->set ( 'views', \$name );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_products.status' => 1,
											'Estore_products.catproduct_id' => \$name ['Estore_products'] ['catproduct_id'],
											'Estore_products.id <>' => \$name ['Estore_products'] ['id'] 
									),
									'order' => 'Estore_products.id DESC',
									'limit' => 8 
							);
							\$this->set ( 'sanphamkhac', \$this->paginate ( 'Estore_products', array () ) );
						}
						function loginregister(){
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->set ( 'shopname', \$nameeshop );
								
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							
						}
						// shopping
						function addshopingcart(\$id = null) {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->set ( 'shopname', \$nameeshop );
							
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$product = \$this->Estore_products->read ( null, \$id );
							
							if (! isset ( \$_SESSION ['shopingcart'] )) {
								\$_SESSION ['shopingcart'] = array ();
							}
							;
							
							if (isset ( \$_SESSION ['shopingcart'] )) {
								
								\$shopingcart = \$_SESSION ['shopingcart'];
								if (isset ( \$shopingcart [\$id] )) {
									\$shopingcart [\$id] ['sl'] = \$shopingcart [\$id] ['sl'] + 1;
									\$shopingcart [\$id] ['total'] = \$shopingcart [\$id] ['price'] * \$shopingcart [\$id] ['sl'];
									\$_SESSION ['shopingcart'] = \$shopingcart;
									//echo '<script language=\"javascript\"> alert(\"Thêm thành công\"); window.location.replace(\"' . DOMAIN .\$this->shopname. '/viewshopingcart\"); </script>';
									echo '<script language=\"javascript\"> window.location.replace(\"' . DOMAIN .\$this->shopname. '/viewshopingcart\"); </script>';
										
								} else {
									\$shopingcart [\$id] ['pid'] = \$id;
									\$shopingcart [\$id] ['name'] = \$product ['Estore_products'] ['title'];
									\$shopingcart [\$id] ['images'] = \$product ['Estore_products'] ['images'];
									\$shopingcart [\$id] ['sl'] = 1;
									\$shopingcart [\$id] ['price'] = \$product ['Estore_products'] ['price'];
									\$shopingcart [\$id] ['total'] = \$product ['Estore_products'] ['price'] * \$shopingcart [\$id] ['sl'];
									\$_SESSION ['shopingcart'] = \$shopingcart;
									//echo '<script language=\"javascript\" type=\"text/javascript\"> alert(\"Thêm giỏ hàng thành công\"); window.location.replace(\"' . DOMAIN .\$this->shopname . '/viewshopingcart\"); </script>';
									echo '<script language=\"javascript\" type=\"text/javascript\"> window.location.replace(\"' . DOMAIN .\$this->shopname . '/viewshopingcart\"); </script>';
									
								}
							}
						}
						function deleteshopingcart(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							if (isset ( \$_SESSION ['shopingcart'] )) {
								\$shopingcart = \$_SESSION ['shopingcart'];
								if (isset ( \$shopingcart [\$id] ))
									unset ( \$shopingcart [\$id] );
								\$_SESSION ['shopingcart'] = \$shopingcart;
								\$this->redirect ( 'viewshopingcart' );
							}
						}
						function order(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							if (! \$id) {
								\$this->Session->setFlash ( __ ( 'Không tồn tại', true ) );
								\$this->redirect ( array (
										'action' => 'index' 
								) );
							}
							\$this->set ( 'buy', \$this->Estore_news->read ( null, \$id ) );
						}
						function viewshopingcart() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							//\$this->Estore_news->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								
							\$this->set ( 'shopname', \$nameeshop );
							
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop View Shopping' );
							if (isset ( \$_SESSION ['shopingcart'] )) {
								\$shopingcart = \$_SESSION ['shopingcart'];
								\$this->set ( compact ( 'shopingcart' ) );
							} else {
								\$shopingcart = '';
								\$this->set ( 'shopingcart',\$shopingcart );
								//echo '<script language=\"javascript\"> alert(\"Chua co san pham nao trong gio hang\"); window.location.replace(\"' . DOMAIN .\$this->shopname . '/index\"); </script>';
							}
						}
						function updateshopingcart(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							if (isset ( \$_SESSION ['shopingcart'] )) {
								\$shopingcart = \$_SESSION ['shopingcart'];
								if (isset ( \$shopingcart [\$id] )) {
									\$shopingcart [\$id] ['sl'] = \$_POST ['soluong'];
									\$shopingcart [\$id] ['total'] = \$shopingcart [\$id] ['sl'] * \$shopingcart [\$id] ['price'];
								}
								\$_SESSION ['shopingcart'] = \$shopingcart;
								
								\$this->redirect ( 'viewshopingcart' );
							}
						}
						function buy() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->set ( 'shopname', \$nameeshop );
							
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							if (isset ( \$_SESSION ['shopingcart'] )) {
								\$shopingcart = \$_SESSION ['shopingcart'];
								\$this->set ( compact ( 'shopingcart' ) );
							} else {
								\$shopingcart = '';
								\$this->set ( 'shopingcart',\$shopingcart );
								//echo '<script language=\"javascript\"> alert(\"Không có sản phẩm nào trong giỏ hàng của bạn\"); window.location.replace(\"' . DOMAIN .\$this->shopname.'\"); </script>';
							}
							
							if(!isset(\$_SESSION['shopingcart'])){
								\$shopingcart = '';
								\$this->set ( 'shopingcart',\$shopingcart );
							}
						}
						function category(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							if (! \$id) {
								\$this->Session->setFlash ( __ ( 'Không tồn tại', true ) );
								\$this->redirect ( array (
										'action' => 'index' 
								) );
							}
							\$this->set ( 'products', \$this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'category_id' => \$id 
									),
									'order' => 'Estore_product.id DESC' 
							) ) );
						}
						function getproduct(\$id = null) {
							return \$this->Estore_product->read ( null, \$id );
						}
						// +++++++++++++++++++++Infomation++++++++++++++++++++++++++++++++++++++
						/*
						 * function indexinfomation() { \$shop=explode('/',\$this->params['url']['url']); \$shopname=\$shop[0]; \$shoparr=\$this->get_shop_id(\$shopname); foreach(\$shoparr as \$key=>\$value){ \$shop_id=\$key; } \$this->set ( 'shopname',\$shopname); \$this->set('title_for_layout', 'Đại lý - CÔNG TY THHH'); if(!\$this->Session->read(\"user_id\")){ echo \"<script>location.href='\".DOMAIN.\"login'</script>\"; }else{ if(\$this->Session->read(\"check\")==0){ \$this->set('agents',\$this->Agent->find('all')); }else{ \$this->set('agents',\$this->Agent->find('all',array('conditions'=>array('Agent.check_id'=>\$this->Session->read(\"check\"))))); } } } function viewinfomation(\$id=null) { \$shop=explode('/',\$this->params['url']['url']); \$shopname=\$shop[0]; \$shoparr=\$this->get_shop_id(\$shopname); foreach(\$shoparr as \$key=>\$value){ \$shop_id=\$key; } \$this->set ( 'shopname',\$shopname); mysql_query(\"SET names utf8\"); \$this->set('title_for_layout', 'Hỏi đáp - VIỆN KHOA HỌC VÀ CÔNG NGHỆ XÂY DỰNG GIAO THÔNG'); if (!\$id) { \$this->Session->setFlash(__('Không tồn tại', true)); \$this->redirect(array('action' => 'index')); } \$this->set('views', \$this->Estore_news->read(null, \$id)); \$conditions=array('Estore_news.status'=>1,'Estore_news.category_id'=>149,'Estore_news.id <>'=>\$id); \$this->set('list_other',\$this->Estore_news->find('all',array('conditions'=>\$conditions,'order'=>'Estore_news.id DESC','limit'=>7))); }
						 */
						// ++++++++++++++++++++++++++++++Infomations+++++++++++++++++++++++++++++++++++++++++++++
						function indexinfomations() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							
							if (! \$this->Session->read ( \"email\" )) {
								echo \"<script>location.href='\" . DOMAIN . \"login'</script>\";
							} else {
								
								\$this->set ( 'infomations', \$this->Estore_infomation->find ( 'all', array (
										'conditions' => array (
												'Estore_infomation.user_id' => \$this->Session->read ( \"id\" ) 
										),
										'limit' => 10 
								) ) );
							}
						}
						function addinfomations() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->set ( 'shopname', \$nameeshop );
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
					if(isset(\$_SESSION ['shopingcart'])){		
							\$uid = \"id\" . rand ( 1, 1000000 );
							\$data ['Estore_infomations'] ['user_id'] = (\$this->Session->read ( \"id\" ) != '' ? \$this->Session->read ( \"id\" ) : \$uid);
							\$data ['Estore_infomations'] ['mobile'] = \$_POST ['phone'];
							\$data ['Estore_infomations'] ['address'] = \$_POST ['address'];
							\$data ['Estore_infomations'] ['email'] = \$_POST ['email'];
							\$data ['Estore_infomations'] ['name'] = \$_POST ['name'];
							\$data ['Estore_infomations'] ['phone'] = \$_POST ['phone'];
							\$data ['Estore_infomations'] ['total'] = \$_POST ['total'];
							\$data ['Estore_infomations'] ['estore_id'] = \$shop_id;
							
							\$this->Estore_infomations->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$this->Estore_infomations->save ( \$data ['Estore_infomations'] );
							
							\$info_id = \$this->Estore_infomations->getLastInsertId ();
							
							\$shopingcart = \$_SESSION ['shopingcart'];
							// print_r(\$shopingcart);exit;
							\$i = 0;
							foreach ( \$shopingcart as \$key ) {
								\$this->Estore_infomationdetail->create ();
								\$data ['Estore_infomationdetail'] ['infomations_id'] = \$info_id;
								\$data ['Estore_infomationdetail'] ['product_id'] = \$key ['pid'];
								\$data ['Estore_infomationdetail'] ['name'] = \$key ['name'];
								\$data ['Estore_infomationdetail'] ['images'] = \$key ['images'];
								\$data ['Estore_infomationdetail'] ['quantity'] = \$key ['sl'];
								\$data ['Estore_infomationdetail'] ['price'] = \$key ['price'];
								\$this->Estore_infomationdetail->save ( \$data ['Estore_infomationdetail'] );
								\$i ++;
							}
							
							unset ( \$_SESSION ['shopingcart'] );
							\$textstring = 'Oder inprocess in 24h . Thank you!';//cảm ơn bạn đã đặt hàng  chúng tôi sẽ liên hệ với bạn trong vòng 24h
							\$this->set ( 'textstring', \$textstring );
							//echo '<script language=\"javascript\">alert(\"cảm ơn bạn đã đặt hàng  chúng tôi sẽ liên hệ với bạn trong vòng 24h\"); location.href=\"' . DOMAIN .\$this->shopname . '/index\";</script>';
					}else {
						//\$shopingcart = '';
						//\$this->set ( 'shopingcart',\$shopingcart );
// 						\$textstring = 'Oder inprocess in 24h . Thank you!';//cảm ơn bạn đã đặt hàng  chúng tôi sẽ liên hệ với bạn trong vòng 24h
// 						\$this->set ( 'textstring', \$textstring );
 						echo '<script language=\"javascript\">location.href=\"' . DOMAIN .\$this->shopname . '/index\";</script>';
					}

// 					\$shopingcart = '';
// 					\$this->set ( 'shopingcart',\$shopingcart );
// 					\$textstring = 'Oder inprocess in 24h . Thank you!';//cảm ơn bạn đã đặt hàng  chúng tôi sẽ liên hệ với bạn trong vòng 24h
// 					\$this->set ( 'textstring', \$textstring );
					
					
						}
						function deleteinfomations(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							if (empty ( \$id )) {
								\$this->Session->setFlash ( __ ( 'Khôn tồn tại danh mục này', true ) );
								// \$this->redirect(array('action'=>'index'));
							}
							if (\$this->Infomations->delete ( \$id )) {
								\$this->Session->setFlash ( __ ( 'Xóa danh mục thành công', true ) );
								\$this->redirect ( array (
										'action' => 'indexinfomations' 
								) );
							}
							\$this->Session->setFlash ( __ ( 'Danh mục không xóa được', true ) );
							\$this->redirect ( array (
									'action' => 'indexinfomations' 
							) );
						}
						// +++++++++++++++++++++++++++++++News+++++++++++++++++++++++++++++++++++++++++++++++++++++++
						function indexnews() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->set ( 'shopname', \$nameeshop );
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							\$this->Estore_news->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 156 
									),
									'limit' => '5',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'news', \$this->paginate ( 'Estore_news', array () ) );
						}
						function tintucnoibat() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 221 
									),
									'limit' => '6',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'news', \$this->paginate ( 'Estore_news', array () ) );
						}
						function promotion() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 222 
									),
									'limit' => '6',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'news', \$this->paginate ( 'Estore_news', array () ) );
						}
						function danceclass() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 223 
									),
									'limit' => '6',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'news', \$this->paginate ( 'Estore_news', array () ) );
						}
						
						function listnews(\$id=null) {
							//layout
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_news->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							
							//\$Estoreshopnews = \$this->Estore_news->find('all');
							//pr(\$Estoreshopnews);
							
							mysql_query(\"SET names utf8\");
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => \$id 
									),
									'limit' => '10',
											'order' => 'Estore_news.id DESC' 
									);

				      \$this->set('listnews', \$this->paginate('Estore_news',array()));
							
							\$this->Estore_categories->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$this->set('cat',\$this->Estore_categories->read(null,\$id));
						}

						function getmodolnews()
						{
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_news->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							
							\$Estoreshopnews = \$this->Estore_news->find('all');
							
							pr(\$Estoreshopnews);
							\$this->set('Estoreshopnews', \$Estoreshopnews);
						}
						
						function souvenir() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 213 
									),
									'limit' => '5',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'news', \$this->paginate ( 'Estore_news', array () ) );
						}
						function recruitment() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 220 
									),
									'limit' => '5',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'news', \$this->paginate ( 'Estore_news', array () ) );
						}
						function services() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 227 
									),
									'limit' => '7',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'news', \$this->paginate ( 'Estore_news', array () ) );
						}
						function dichvu() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 224 
									),
									'limit' => '7',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'news', \$this->paginate ( 'Estore_news', array () ) );
						}
						function ticket() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach ve may bay
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 214 
									),
									'limit' => '8',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'ticket', \$this->paginate ( 'Estore_news', array () ) );
						}
						function hotel() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach khach san
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 215 
									),
									'limit' => '8',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'hotel', \$this->paginate ( 'Estore_news', array () ) );
						}
						function carnews() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach xe du lich
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 216 
									),
									'limit' => '8',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'car', \$this->paginate ( 'Estore_news', array () ) );
						}
						function visa() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach ho chieu
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 217 
									),
									'limit' => '8',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'visa', \$this->paginate ( 'Estore_news', array () ) );
						}
						function capacity() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$news = \$this->Category->find ( 'list', array (
									'conditions' => array (
											'Category.parent_id' => 171 
									),
									'fields' => array (
											'Category.id' 
									) 
							) );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => \$news 
									),
									'limit' => '8',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'capacity', \$this->paginate ( 'Estore_news', array () ) );
						}
						function addview(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// var_dump(\$this->data);die;
							\$data = \$this->Estore_news->read ( null, \$_POST ['id'] );
							\$data ['Estore_news'] ['view'] = \$data ['Estore_news'] ['view'] + 1;
							\$this->Estore_news->save ( \$data ['Estore_news'] );
						}
						function view1(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => \$id 
									),
									'limit' => '1',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'recruitment', \$this->paginate ( 'Estore_news', array () ) );
							\$this->set ( 'cat', \$this->Category->read ( null, \$id ) );
						}
						function viewnews(\$id = null) {
						
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->set ( 'shopname', \$nameeshop );
							  \$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							
							if (! \$id) {
								\$this->Session->setFlash ( __ ( 'Không tồn tại', true ) );
								\$this->redirect ( array (
										'action' => 'index' 
								) );
							}
							\$this->Estore_news->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$x = \$this->Estore_news->read ( null, \$id );
							\$this->set ( 'views', \$x );
							\$this->Estore_news->setDataEshop(\$hostname,\$username,\$password,\$databasename);
						
							\$this->set ( 'list_other', \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => \$x ['Estore_news'] ['category_id'],
											'Estore_news.id <>' => \$id 
									),
									'limit' => 10 
							) ) );
						
						}
						function searchnews(\$name_search = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							//set data news eshop	
							\$this->Estore_news->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							\$title = \$_POST ['name_search'];
							
							\$this->set ( 'listsearch', \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.title LIKE' => '%' . \$title . '%' 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 7 
							) ) );
						}
						function thongtin() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->set ( 'shopname', \$nameeshop );
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$this->Estore_settings->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$x = \$this->Estore_settings->read ( null, 1 );
// 							pr(\$x);
							\$this->set ( 'views', \$x );
						}
                        // +++++++++++++++++++++++++++++++++++++Comments+++++++++++++++++++++++++++++++++++++++++++++++++++++++
						function indexcommentstwo() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_comments.status' => 1 
									),
									'limit' => '4',
									'order' => 'Estore_comments.id DESC' 
							);
							\$this->set ( 'comment', \$this->paginate ( 'Estore_comments', array () ) );
						}
						function indexcomments() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->set ( 'shopname', \$nameeshop );
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							\$this->Estore_comments->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								
							\$this->paginate = array (
									'conditions' => array (
											'Estore_comments.status' => 1 
									),
									'limit' => '4',
									'order' => 'Estore_comments.id DESC' 
							);
							\$this->set ( 'comment', \$this->paginate ( 'Estore_comments', array () ) );
						}
						
						function addcomments() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							if (! empty ( \$this->data )) {
								// if(\$this->Session->read('security_code')==\$_POST['security']){
								
								\$data ['Estore_comments'] = \$this->data ['Estore_comments'];
								if (\$this->Estore_comments->save ( \$data ['Estore_comments'] )) {
									\$this->Session->setFlash ( __ ( 'Thêm mới comments thành công', true ) );
									// \$this->redirect(array('action' => 'index'));
									echo '<script language=\"javascript\"> location.href=\"' . DOMAIN .\$this->shopname . '/indexcomments\";</script>';
								} else {
									\$this->Session->setFlash ( __ ( 'Thêm mơi comments thất bại. Vui long thử lại', true ) );
								}
								
								// }
								/*
								 * if(\$this->Session->read('security_code')!=\$_POST['security']){ echo \"<script>alert('\".json_encode('Ban nhập không đúng mã bảo vệ !').\"');</script>\"; echo \"<script>history.back(-1);</script>\"; }
								 */
							}
						}
						// +++++++++++++++++++++++++Contacts+++++++++++++++++++++++++++++++++++++++++++++++
						function sendcontacts() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->set ( 'shopname', \$nameeshop );
							\$message= \"\";
							\$this->set('message',\$message);
							
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET NAMES 'utf8'\" );
							mysql_query ( \"SET character_set_client=utf8\" );
							mysql_query ( \"SET character_set_connection=utf8\" );
							\$this->Estore_settings->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$x = \$this->Estore_settings->read ( null, 1 );
							
							
							//pr(\$_POST);die;
							
							if (isset ( \$_POST ['name'] )) {
								\$name = trim(\$_POST ['name']);
								//\$mobile = \$_POST ['phone'];
								\$email = trim(\$_POST ['email']);
								\$title = trim(\$_POST ['title']);
								\$content = trim(\$_POST ['content']);
								
								\$data = array(
										'estore_id'=>\$x['Estore_settings']['estore_id'],
									    'name'=>\$name,
										'email'=>\$email,
										'title'=>\$title,
										'content'=>\$content
								);
								
								if(!empty(\$data)) {
									\$this->Estore_contacts->setDataEshop(\$hostname,\$username,\$password,\$databasename);
									if(\$this->Estore_contacts->save(\$data))
									{
										\$resultemail = \$this->smtpmailer(\$email,'alatcas1@gmail.com','FREEMOBIWEB.MOBI',\$x['Estore_settings']['title'],\$content);
										if (\$resultemail ==1)
										{
											//echo '<script language=\"javascript\"> alert(\"Gửi mail thành công\"); location.href=\"' . DOMAIN .\$this->shopname. '\";</script>';
											\$message= \"succesfuly\";
											\$this->set('message',\$message);
										}
										else
										{
											//echo '<script language=\"javascript\"> alert(\"gửi mail không thành công\"); </script>';
											\$this->set('message',\$resultemail);
										}
									}
								}
			                   
								
							}
						}
						
				  function smtpmailer(\$to, \$from, \$from_name, \$subject, \$body) {
					       //++++++++ include PhpMailler +++++++++++
							\$libraryPhpMailer = ROOT.'/PhpMailer/';
							\$filename = \$libraryPhpMailer.'class.phpmailer.php';
							if(file_exists(\$filename))
							   include(\$filename);
							global \$error;
					        \$mail = new PHPMailer();
					        \$mail->IsSMTP();
					        \$mail->CharSet = \"utf-8\";
					        \$mail->SMTPDebug = 0;
					        \$mail->SMTPAuth = true;
					        \$mail->SMTPSecure = 'ssl';
					        \$mail->Host = 'smtp.gmail.com';
					        \$mail->Port = 465;
					        \$mail->Username = GUSER;
					        \$mail->Password = GPWD;
					        \$mail->SetFrom(\$from, \$from_name);
					        \$mail->Subject = \$subject;
					        \$mail->Body = \$body;
					        \$mail->AddAddress(\$to);
					        if (!\$mail->Send()) {
					            \$error = 'Gởi mail bị lỗi: ' . \$mail->ErrorInfo;
					            return false;
					        } else {
					            \$error = 'thư của bạn đã được gởi đi ';
					            return true;
					        }
					    }
						
						
						
						function dathangcontacts() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							
							mysql_query ( \"SET NAMES 'utf8'\" );
							mysql_query ( \"SET character_set_client=utf8\" );
							mysql_query ( \"SET character_set_connection=utf8\" );
							// \$x=\$this->Helps->read(null,1);
							if (isset ( \$_SESSION ['shopingcart'] )) {
								\$shopingcart = \$_SESSION ['shopingcart'];
								\$this->set ( compact ( 'shopingcart' ) );
							} else {
								echo '<script language=\"javascript\"> alert(\"Chua co san pham nao trong gio hang\"); window.location.replace(\"' . DOMAIN . '\"); </script>';
							}
							if (isset ( \$_POST ['name'] )) {
								\$name = \$_POST ['name'];
								\$mobile = \$_POST ['phone'];
								\$email = \$_POST ['email'];
								\$title = \$_POST ['title'];
								\$content = \$_POST ['content'];
								
								\$images = \$_POST ['images'];
								\$product_name = \$_POST ['product_name'];
								\$product_sl = \$_POST ['product_sl'];
								\$price = \$_POST ['price'];
								\$total = \$_POST ['total'];
								\$this->Email->from = \$name . '<' . \$email . '>';
								\$this->Email->to = '';
								\$this->Email->subject = \$title;
								\$this->Email->template = 'default';
								\$this->Email->sendAs = 'both';
								\$this->set ( 'name', \$name );
								\$this->set ( 'mobile', \$mobile );
								\$this->set ( 'email', \$email );
								\$this->set ( 'content', \$content );
								
								\$this->set ( 'images', \$images );
								\$this->set ( 'product_name', \$product_name );
								\$this->set ( 'product_sl', \$product_sl );
								\$this->set ( 'price', \$price );
								\$this->set ( 'total', \$total );
								
								\$this->set ( 'sang', array (
										'images',
										'product_name',
										'product_sl',
										'price',
										'total' 
								) );
								
								if (\$this->Email->send ()) {
									\$this->Session->setFlash ( __ ( 'Thêm mới danh mục thành công', true ) );
									echo '<script language=\"javascript\"> alert(\"Gửi mail thành công\"); </script>';
									unset ( \$_SESSION ['shopingcart'] );
									echo '<script language=\"javascript\">location.href=\"' . DOMAIN . '\";</script>';
								} else
									\$this->Session->setFlash ( __ ( 'Thêm mơi danh mục thất bại. Vui long thử lại', true ) );
								echo '<script language=\"javascript\"> alert(\"gửi mail không thành công\"); location.href=\"' . DOMAIN . '\";</script>';
							}
						}
					 }	
						   		
					       \n ";
											$stringData .= "?>\n";
											fwrite ( $fh, $stringData );
											fclose ( $fh );
											
											$fromfile = DOCUMENT_ROOT . 'app/controllers/clotfzakju_controllercopy.php';
											$tofile = DOCUMENT_ROOT . 'app/controllers/' . $project_name. '_controller.php';
												
											if (file_exists ( $tofile )) {
												return $dir_and_name_estore = "Tên gian hàng đã tồn tại";
												//exit ();
											}
											copy ( $fromfile, $tofile );
												
											return $controller_estore ="SucessFullController".$layout_code;
											break;		   
					//end 50000567
				}
			  case 50000566:
				 {
					$myFile = DOCUMENT_ROOT . 'app/controllers/estoredaquycp_controller.php';
					$fh = fopen ( $myFile, 'w' ) or die ( "can't open file" );
					$stringData = "";
					$stringData .= "<?php\n";
					$stringData .= "
						  class " . ucfirst ( $project_name) . "Controller extends AppController {
						  var \$name = '" . ucfirst ( $project_name) . "';
						   var \$shopname ='".$project_name."';
						    var \$components = array('Email');
							var \$uses = array (
									'Shop',
									'Estore_categories',
									'Estore_user',
									'Estore_products',
									'Estore_catproduct',
									'Estore_settings',
									'Estore_advertisement',
									'Estore_category',
									'Estore_slideshows',
									'Estore_video',
									'Estore_helps',
									'Estore_news',
									'Estore_partner',
									'Estore_gallery',
									'Estore_banner',
									'Estore_poll',
									'Estore_contacts'
								);
							function loadModelNew(\$Model) {
								\$nameeshop = \$this->shopname;
								
									\$shoparr = \$this->Shop->find ( 'all', array (
											'conditions' => array (
													//'Shop.id' => \$shop_id,
													'Shop.name' => \$nameeshop,
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
										
									if(is_array(\$shoparr) and !empty(\$shoparr))
									{
										foreach(\$shoparr as \$shop){
											\$databasename = \$shop['Shop']['databasename'];
											\$password = \$shop['Shop']['password'];
											\$username = \$shop['Shop']['username'];
											\$hostname = \$shop['Shop']['hostname'];
											\$shop_id = \$shop['Shop']['id'];
											\$nameproject = \$shop['Shop']['name'];           // \$nameproject is name Ctronller
											\$email = trim(\$shop['Shop']['email']);
											\$userpass = \$shop['Shop']['userpass'];
										}
									}
							
									
									\$this->\$Model->setDataEshop ( \$hostname, \$username, \$password, \$databasename );
									//pr(\$shoparr);
								}
								
								// +++++++++++++++Comments+++++++++++++++++++++++++
								function tintucnoibat() {
									\$this->loadModelNew('Estore_news');
									\$this->set ( 'shopname', \$this->shopname );
									\$this->layout = 'themeshop/estoredaquy';
									mysql_query ( \"SET names utf8\" );
									return \$this->Estore_news->find ( 'all', array (
											'conditions' => array (
													'Estore_news.status' => 1,
													'Estore_news.category_id' => 201 
											),
											'order' => 'Estore_news.id DESC',
											'limit' => 4 
									) );
								}
								function categoryproduct() {
								    \$this->set ( 'shopname', \$this->shopname );
									//\$this->layout = 'themeshop/eshopdaquy';
								    \$this->loadModelNew('Estore_catproduct');
									mysql_query ( \"SET names utf8\" );
									return \$this->Estore_catproduct->find ( 'all', array (
											'conditions' => array (
													'Estore_catproduct.status' => 1,
													'Estore_catproduct.parent_id' => NULL 
											),
											'order' => 'Estore_catproduct.order ASC' 
									) );
								}
								
								// tin thuoc danh muc
								function submenuproduct(\$id = null) { 
								    \$this->set ( 'shopname', \$this->shopname );
									//\$this->layout = 'themeshop/eshopdaquy';
								    \$this->loadModelNew('Estore_catproduct');
									return \$this->Estore_catproduct->find ( 'all', array (
											'conditions' => array (
													'Estore_catproduct.parent_id ' => \$id,
													'Estore_catproduct.status' => 1 
											),
											'order' => 'Estore_catproduct.order ASC' 
									) );
								}
								
								function submenuproduct1(\$id = null) {
								    \$this->loadModelNew('Estore_catproduct');
									return \$this->Estore_catproduct->find ( 'all', array (
											'conditions' => array (
													'Estore_catproduct.parent_id ' => \$id,
													'Estore_catproduct.status' => 1 
											),
											'order' => 'Estore_catproduct.order ASC' 
									) );
								}
								
								//mapssetting
								function mapssetting() {
									\$this->loadModelNew('Estore_settings');
									return \$this->Estore_settings->find ('all');
								}
								function sanphambanchay() {
								   \$this->loadModelNew('Estore_catproduct');
									mysql_query ( \"SET names utf8\" );
									return \$this->Estore_products->find ( 'all', array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.featuredproducts' => 1 
											),
											'order' => 'Estore_products.order ASC',
											'limit' => 10 
									) );
								}
								
								function sanphamnoibat() {
									\$this->loadModelNew('Estore_products');
									mysql_query ( \"SET names utf8\" );
									return \$this->Estore_products->find ( 'all', array (
											'conditions' => array (
													'Estore_products.speproduct' => 1
											),
											'order' => 'Estore_products.id ASC',
											'limit' => 10
									) );
								}
								function phongmau() {
								    \$this->loadModelNew('Estore_catproduct');
									mysql_query ( \"SET names utf8\" );
									return \$this->Estore_catproduct->find ( 'all', array (
											'conditions' => array (
													'Estore_catproduct.status' => 1,
													'Estore_catproduct.parent_id' => '8' 
											),
											'order' => 'Estore_catproduct.char DESC' 
									) );
								}
								function doitac() {
									\$this->loadModelNew('Estore_partner');
									// return \$this->Gallery->find('all',array('conditions'=>array('Gallery.status'=>1),'order'=>'Gallery.id DESC','limit'=>2));
									return \$this->Estore_partner->find ( 'all', array (
											'conditions' => array (
													'Estore_partner.status' => 1 
											),
											'order' => 'Estore_partner.id DESC' 
									) );
								}
								function menu_active() {
								    \$this->loadModelNew('Estore_categories');
									return \$this->Estore_categories->find ( 'all', array (
											'conditions' => array (
													'Estore_categories.parent_id' => 145 
											),
											'order' => 'Estore_categories.id ASC' 
									) );
								}
								function helpsonline() {
								    \$this->loadModelNew('Estore_helps');
									return \$this->Estore_helps->find ( 'all', array (
											'conditions' => array (
													'Estore_helps.status' => 1 
											),
											'order' => 'Estore_helps.id DESC',
											'limit' => 4 
									) );
								}
								function id_product(\$id) {
								    \$this->loadModelNew('Estore_products');
									return \$this->Estore_products->read ( null, \$id );
									// pr(\$this->Estore_products->read(null,\$id));die;
								}
								function getinfo(\$cat = null) {
								    \$this->loadModelNew('Estore_news');
									return \$this->Estore_news->find ( 'all', array (
											'conditions' => array (
													'Estore_news.status' => 1,
													'Estore_news.category_id' => \$cat 
											),
											'order' => 'Estore_news.id DESC',
											'limit' => 3 
									) );
								}
								function Estore_news_codong(\$cat = null) {
								    \$this->loadModelNew('Estore_news');
									return \$this->Estore_news->find ( 'all', array (
											'conditions' => array (
													'Estore_news.status' => 1,
													'Estore_news.category_id' => \$cat 
											),
											'order' => 'Estore_news.id DESC',
											'limit' => 10 
									) );
								}
								function menucategory() {
								    \$this->loadModelNew('Estore_category');
									mysql_query ( \"SET names utf8\" );
									return \$this->Estore_category->find ( 'all', array (
											'conditions' => array (
													'Estore_category.status' => 1,
													'Estore_category.parent_id' => null 
											),
											'order' => 'Estore_category.order ASC' 
									) );
									\$_SESSION ['huong'] = 1;
								}
								function videos1() {
								    \$this->loadModelNew('Estore_video');
									mysql_query ( \"SET names utf8\" );
									return \$this->Estore_video->find ( 'all', array (
											'conditions' => array (
													'Estore_video.status' => 1 
											),
											'order' => 'Estore_video.id DESC',
											'limit' => 4 
									) );
								}
								function videoslish() {
								    \$this->loadModelNew('Estore_video');
									\$video = isset ( \$_GET ['video'] ) ? \$_GET ['video'] : '';
									mysql_query ( \"SET names utf8\" );
									return \$this->Estore_video->find ( 'all', array (
											'conditions' => array (
													'Estore_video.status' => 1,
													'Estore_video.id' => \$video 
											),
											'order' => 'Estore_video.id DESC',
											'limit' => 1 
									) );
								}
								function videoslish1() {
								    \$this->loadModelNew('Estore_video');
									\$video = isset ( \$_GET ['video'] ) ? \$_GET ['video'] : '';
									mysql_query ( \"SET names utf8\" );
									return \$this->Estore_video->find ( 'all', array (
											'conditions' => array (),
											'order' => 'Estore_video.id DESC',
											'limit' => 1 
									) );
								}
								function get_video(\$id = null) {
								    \$this->loadModelNew('Estore_video');
									// \$id=\$_GET['id'];
									\$a = \$this->Estore_video->findById ( \$id );
									// echo json_encode(DOMAINAD.\$a['Estore_video']['video']); die;
									// echo DOMAINAD.\$a['Estore_video']['video']; die;
									echo '<embed  width=\"195\" height=\"140\" type=\"application/x-shockwave-flash\" src=\"' . DOMAIN . 'images/mediaplayer.swf\" style=\"\" id=\"playlist\" name=\"playlist\" quality=\"high\" allowfullscreen=\"true\" wmode=\"transparent\" flashvars=\"file=' . DOMAINAD . \$a ['Estore_video'] ['video'] . '&amp;displayheight=125&amp;width=195&amp;height=140&amp;\"></embed>';
									die ();
								}
								
								// --------------------End Comment ------------------------------------
								// +++++++++++++++++++++homes+++++++++++++++++++++++++++++++++++
								//quang cao left - right
								function advleft(){
									\$this->loadModelNew('Estore_advertisement');
									return \$this->Estore_advertisement->find('all',array('conditions'=>array('Estore_advertisement.status'=>1,'Estore_advertisement.display'=>0),'order'=>'Estore_advertisement.id DESC','limit'=>1));
								}
								function advright(){
									\$this->loadModelNew('Estore_advertisement');
									return \$this->Estore_advertisement->find('all',array('conditions'=>array('Estore_advertisement.status'=>1,'Estore_advertisement.display'=>1),'order'=>'Estore_advertisement.id DESC','limit'=>1));
								}
								
								function slideshow(){
									\$this->set ( 'shopname', \$this->shopname );
									\$this->layout = 'themeshop/estoredaquy';
									mysql_query(\"SET names utf8\");
									\$this->loadModelNew('Estore_slideshows');
									return \$this->Estore_slideshows->find('all',array('conditions'=>array('Estore_slideshows.status'=>1),'order'=>'Estore_slideshows.id DESC'));
								}
								function search(\$title=null) {
									\$this->set ( 'shopname', \$this->shopname );
									\$this->layout = 'themeshop/estoredaquy';
									\$this->loadModelNew ( 'Estore_products' );
									mysql_query ( \"SET names utf8\" );
									\$this->set ( 'title_for_layout', 'Search ..............' );
									\$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.title like' => '%' . \$title . '%' 
											),
											'order' => 'Estore_products.id DESC' 
									);
									\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
								}
								function index() {
									\$this->set ( 'shopname', \$this->shopname );
									\$this->layout = 'themeshop/estoredaquy';
									//\$this->layout = 'themeshop/home'; //eshopdaquy
									\$this->loadModelNew ( 'Estore_products' );
// 									pr(\$this->Estore_products->find ( 'all', array (
// 											'conditions' => array (
// 													'Estore_products.status' => 0 
// 											),
// 											'limit' => '6',
// 											'order' => 'Estore_products.id DESC' 
// 									) ) );die;
									\$this->set ( 'sanphammoi', \$this->Estore_products->find ( 'all', array (
											'conditions' => array (
													'Estore_products.status' => 0 
											),
											'limit' => '6',
											'order' => 'Estore_products.id DESC' 
									) ) );
									
									\$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1 
											),
											'limit' => '8',
											'order' => 'Estore_products.id DESC' 
									);
									\$this->set ( 'sanphamtieubieu', \$this->paginate ( 'Estore_products', array () ) );
									
									
								}
								function aboutus() 
								{
									\$this->set ( 'shopname', \$this->shopname );
									\$this->layout = 'themeshop/estoredaquy';
									\$this->set ( 'shopname', \$this->shopname );
									\$this->loadModelNew ( 'Estore_news' );
									\$about =  \$this->Estore_news->find ( 'all', array (
											'conditions' => array (
													'Estore_news.status' => 1,
													'Estore_news.id' => 97 
											) 
									) );
									\$this->set ( 'about', \$about );
								}
								function tranhdaquy() {
									\$this->set ( 'shopname', \$this->shopname );
									\$this->layout = 'themeshop/estoredaquy';
								    \$this->loadModelNew('Estore_products');
									\$this->set ( 'shopname', \$this->shopname );
							
									\$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.tranhdaquy' => 1 
											),
											'limit' => '8',
											'order' => 'Estore_products.id DESC' 
									);
									\$this->set ( 'listproducts', \$this->paginate ( 'Estore_products', array () ) );
									
								}
								function daquytho() {
									\$this->set ( 'shopname', \$this->shopname );
									\$this->layout = 'themeshop/estoredaquy';
								   \$this->loadModelNew('Estore_products');
									return \$this->Estore_products->find ( 'all', array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.daquytho' => 1 
											),
											'limit' => '8',
											'order' => 'Estore_products.id DESC' 
									) );
								}
								function daphongthuy() {
									\$this->set ( 'shopname', \$this->shopname );
									\$this->layout = 'themeshop/estoredaquy';
								    \$this->loadModelNew('Estore_products');
									return \$this->Estore_products->find ( 'all', array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.daphongthuy' => 1 
											),
											'limit' => '8',
											'order' => 'Estore_products.id DESC' 
									) );
								}
								function trangsuc() {
									\$this->set ( 'shopname', \$this->shopname );
									\$this->layout = 'themeshop/estoredaquy';
								    \$this->loadModelNew('Estore_products');
									return \$this->Estore_products->find ( 'all', array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.trangsuc' => 1 
											),
											'limit' => '8',
											'order' => 'Estore_products.id DESC' 
									) );
								}
								function add() {
									\$this->set ( 'shopname', \$this->shopname );
									\$this->layout = 'themeshop/estoredaquy';
								    \$this->loadModelNew('Eshopdaquycatpoll');
									\$ykien = \$_POST ['ykien'];
									
									\$poll = \$this->Eshopdaquycatpoll->find ( 'all', array (
											'Eshopdaquycatpoll.status' => 1 
									) );
									for(\$i = 0; \$i < count ( \$poll ); \$i ++) {
										if (\$poll [\$i] ['Eshopdaquycatpoll'] ['id'] == \$ykien) {
											\$poll [\$i] ['Eshopdaquycatpoll'] ['count'] = \$poll [\$i] ['Eshopdaquycatpoll'] ['count'] + 1;
											\$data ['Eshopdaquycatpoll'] = \$this->data ['Eshopdaquycatpoll'];
											\$data ['Eshopdaquycatpoll'] ['id'] = \$ykien;
											\$data ['Eshopdaquycatpoll'] ['count'] = \$poll [\$i] ['Eshopdaquycatpoll'] ['count'];
											if (\$this->Eshopdaquycatpoll->save ( \$data ['Eshopdaquycatpoll'] )) {
												\$this->Session->setFlash ( __ ( 'Up thành công', true ) );
												\$this->redirect ( array (
														'action' => 'index' 
												) );
											}
										}
									}
								}
								// ---------------------end homes---------------------------
								// +++++++++++++++++Estore_products+++++++++++++++++++++++++++++
								function indexproduct() {
									 \$this->loadModelNew('Estore_products');
									 \$this->set ( 'shopname', \$this->shopname );
									 \$this->layout = 'themeshop/estoredaquy';
									// \$portfolio=\$this->Estore_catproduct->find('list',array('conditions'=>array('Estore_catproduct.parent_id'=>32),'fields' => array('Estore_catproduct.id')));
									\$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1 
											),
											'limit' => '12',
											'order' => 'Estore_products.id DESC' 
									);
									\$this->set ( 'listproduct', \$this->paginate ( 'Estore_products', array () ) );
								}
								function listproduct(\$id = null) {
									\$this->set ( 'shopname', \$this->shopname );
									\$this->layout = 'themeshop/estoredaquy';
								    \$this->loadModelNew('Estore_catproduct');
									\$portfolio = \$this->Estore_catproduct->find ( 'list', array (
											'conditions' => array (
													'Estore_catproduct.parent_id' => \$id 
											), 
											'fields' => array (
													'Estore_catproduct.id' 
											)
											) );
									
									\$arr [] = \$id; // lưu lai id vừa so sánh
									               
									// pr(\$arr);
									               // pr(\$id);die;
									               // pr(\$portfolio);die;
									
									foreach ( \$portfolio as \$key ) {
										\$arr [] = \$key;
									}
									\$this->loadModelNew('Estore_products');
									\$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.catproduct_id' => \$arr 
											),
											'limit' => '12',
											'order' => 'Estore_products.id DESC' 
									);
									\$this->set ( 'listproducts', \$this->paginate ( 'Estore_products', array () ) );
									\$this->loadModelNew('Estore_catproduct');
									\$this->set ( 'cat', \$this->Estore_catproduct->read ( null, \$id ) );
								}
								
								function tranhdaquyproduct(\$id = null) {
									\$this->set ( 'shopname', \$this->shopname );
									\$this->layout = 'themeshop/estoredaquy';
								    \$this->loadModelNew('Estore_products');
									\$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.tranhdaquy' => 1 
											),
											'limit' => '12',
											'order' => 'Estore_products.id DESC' 
									);
									\$this->set ( 'listproduct', \$this->paginate ( 'Estore_products', array () ) );
								}
							
								function daquythoproduct(\$id = null) {
									\$this->set ( 'shopname', \$this->shopname );
									\$this->layout = 'themeshop/estoredaquy';
								    \$this->loadModelNew('Estore_products');
									\$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.daquytho' => 1 
											),
											'limit' => '12',
											'order' => 'Estore_products.id DESC' 
									);
									\$this->set ( 'listproduct', \$this->paginate ( 'Estore_products', array () ) );
								}
								function daphongthuyproduct(\$id = null) {
								    \$this->loadModelNew('Estore_products');
								    \$this->set ( 'shopname', \$this->shopname );
								    \$this->layout = 'themeshop/estoredaquy';
									\$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.daphongthuy' => 1 
											),
											'limit' => '12',
											'order' => 'Estore_products.id DESC' 
									);
									\$this->set ( 'listproduct', \$this->paginate ( 'Estore_products', array () ) );
								}
								function trangsucproduct(\$id = null) {
								    \$this->loadModelNew('Estore_products');
									\$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.trangsuc' => 1 
											),
											'limit' => '12',
											'order' => 'Estore_products.id DESC' 
									);
									\$this->set ( 'listproduct', \$this->paginate ( 'Estore_products', array () ) );
								}
								function searchproduct(\$search_product = null) {
									\$this->set ( 'shopname', \$this->shopname );
									\$this->layout = 'themeshop/estoredaquy';
								    \$this->loadModelNew('Estore_products');
									// \$id = \$this->Session->read('id');
									\$search_product = \$_POST ['search_product'];
									\$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.title like' => '%' . \$search_product . '%' 
											),
											'limit' => 9 
									);
									\$this->set ( 'listproduct', \$this->paginate ( 'Estore_products', array () ) );
								}
								function viewproduct(\$id = null) {
									\$this->set ( 'shopname', \$this->shopname );
									\$this->layout = 'themeshop/estoredaquy';
								    \$this->loadModelNew('Estore_products');
									if (! \$id) {
										\$this->Session->setFlash ( __ ( 'Không tồn tại', true ) );
										\$this->redirect ( array (
												'action' => 'index' 
										) );
									}
									
									\$x = \$this->Estore_products->read ( null, \$id );
									
									\$this->set ( 'views', \$x );
									 \$this->loadModelNew('Estore_products');
									\$this->set ( 'list_others', \$this->Estore_products->find ( 'all', array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.catproduct_id' => \$x ['Estore_products'] ['catproduct_id'],
													'Estore_products.id <>' => \$id 
											),
											'limit' => 10 
									) ) );
								}
								function addshopingcart(\$id = null) {
									\$this->set ( 'shopname', \$this->shopname );
									\$this->layout = 'themeshop/estoredaquy';
								    \$this->loadModelNew('Estore_products');
									\$product = \$this->Estore_products->read ( null, \$id );
									/*
									 * Neu co ma san pham \$shopingcart[\$id]['name']=\$product['Estore_products']['title'];
									 */
									
									if (! isset ( \$_SESSION ['shopingcart'] ))
										
										\$_SESSION ['shopingcart'] = array ();
									
									if (isset ( \$_SESSION ['shopingcart'] )) 
							
									{
										\$shopingcart = \$_SESSION ['shopingcart'];
										
										if (isset ( \$shopingcart [\$id] )) 
							
										{
											
											echo '<script language=\"javascript\"> if(!confirm(\"Da co san pham nay trong gio hang. Ban co muon tiep tuc mua san pham nay khong ?\")) window.back(); </script>';
											
											\$shopingcart [\$id] ['sl'] = \$shopingcart [\$id] ['sl'] + 1;
											
											\$shopingcart [\$id] ['total'] = \$shopingcart [\$id] ['price'] * \$shopingcart [\$id] ['sl'];
											
											\$_SESSION ['shopingcart'] = \$shopingcart; // pr(\$_SESSION['shopingcart']); die;
											
											echo '<script language=\"javascript\"> alert(\"San pham nay da duoc tang so luong them 1 chiec\"); window.location.replace(\"' . DOMAIN . 'hien-gio-hang-cua-mat-hang\"); </script>'; // co the thay DOMAIN bang url ban muon chay toi
										} 
							
										else 
							
										{
											
											// viet nam
											
											\$shopingcart [\$id] ['name'] = \$product ['Estore_products'] ['title'];
											
											\$shopingcart [\$id] ['images'] = DOMAINAD . \$product ['Estore_products'] ['images'];
											
											\$shopingcart [\$id] ['sl'] = 1;
											
											\$shopingcart [\$id] ['price'] = \$product ['Estore_products'] ['price'];
											
											\$shopingcart [\$id] ['total'] = \$shopingcart [\$id] ['price'];
											
											// tieng anh
											
											\$_SESSION ['shopingcart'] = \$shopingcart;
											
											echo '<script language=\"javascript\"> alert(\"Thêm thành công\"); window.location.replace(\"' . DOMAIN . 'hien-gio-hang-cua-mat-hang\"); </script>';
										}
									}
								}
								function viewshopingcart() {
									\$this->set ( 'shopname', \$this->shopname );
									\$this->layout = 'themeshop/estoredaquy';
									if (isset ( \$_SESSION ['shopingcart'] )) 
							
									{
										
										\$shopingcart = \$_SESSION ['shopingcart'];
										
										\$this->set ( compact ( 'shopingcart' ) );
									} 
							
									else 
							
									{
										
										echo '<script language=\"javascript\"> alert(\"Chua co san pham nao trong gio hang\"); window.location.replace(\"' . DOMAIN . '\"); </script>';
									}
								}
								function deleteshopingcart(\$id = null) {
									\$this->set ( 'shopname', \$this->shopname );
									\$this->layout = 'themeshop/estoredaquy';
									if (isset ( \$_SESSION ['shopingcart'] )) 
							
									{
										
										\$shopingcart = \$_SESSION ['shopingcart'];
										
										if (isset ( \$shopingcart [\$id] ))
											
											unset ( \$shopingcart [\$id] );
										
										\$_SESSION ['shopingcart'] = \$shopingcart;
										
										\$this->redirect ( 'viewshopingcart' );
									}
								}
								function updateshopingcart(\$id = null) {
									\$this->set ( 'shopname', \$this->shopname );
									\$this->layout = 'themeshop/estoredaquy';
									if (isset ( \$_SESSION ['shopingcart'] )) {
										\$shopingcart = \$_SESSION ['shopingcart'];
										
										if (isset ( \$shopingcart [\$id] )) 
							
										{
											
											\$shopingcart [\$id] ['sl'] = \$_POST ['soluong'];
											
											\$shopingcart [\$id] ['total'] = \$shopingcart [\$id] ['sl'] * \$shopingcart [\$id] ['price'];
										}
										
										\$_SESSION ['shopingcart'] = \$shopingcart;
										
										\$this->redirect ( 'viewshopingcart' );
									}
								}
								function buyproduct() {
									\$this->set ( 'shopname', \$this->shopname );
									\$this->layout = 'themeshop/estoredaquy';
									if (isset ( \$_SESSION ['shopingcart'] )) 
							
									{
										
										\$shopingcart = \$_SESSION ['shopingcart'];
										
										\$this->set ( compact ( 'shopingcart' ) );
									} 
							
									else 
							
									{
										
										echo '<script language=\"javascript\"> alert(\"Chua co san pham nao trong gio hang\"); window.location.replace(\"' . DOMAIN . '\"); </script>';
									}
								}
								// _________________End Estore_products__________________________
								
								//++++++++++++++++++++++News++++++++++++++++++++++++++++++++++++++++++++
								function indexnew(\$id = null) {
									\$this->set ( 'shopname', \$this->shopname );
									\$this->layout = 'themeshop/estoredaquy';
									\$this->loadModelNew('Estore_category');
									\$namenews = \$this->Estore_category->find ( 'all', array (
																'conditions' => array (
																		'Estore_category.id' => \$id,
																		'Estore_category.status' => 1
																),
																'fields' => array (
																		'Estore_category.name'
																)
														) );
									\$this->set ( 'namecategory', \$namenews);
									\$this->loadModelNew('Estore_news');
									mysql_query ( \"SET names utf8\" );
									\$this->paginate = array (
											'conditions' => array (
													'Estore_news.status' => 1,
													'Estore_news.category_id' => \$id 
											),
											'limit' => '8',
											'order' => 'Estore_news.id DESC' 
									);
									
									\$this->set ( 'news', \$this->paginate ( 'Estore_news', array () ) );
								}
								function buynew() {
									\$this->set ( 'shopname', \$this->shopname );
									\$this->layout = 'themeshop/estoredaquy';
									\$this->loadModelNew('Estore_news');
									mysql_query ( \"SET names utf8\" );
									
									\$this->paginate = array (
											'conditions' => array (
													'Estore_news.status' => 1,
													'Estore_news.category_id' => 207 
											),
											'limit' => '1',
											'order' => 'Estore_news.id DESC' 
									);
									
									\$this->set ( 'news', \$this->paginate ( 'Estore_news', array () ) );
								}
								function address() {
									\$this->set ( 'shopname', \$this->shopname );
									\$this->layout = 'themeshop/estoredaquy';
									\$this->loadModelNew('Estore_news');
									mysql_query ( \"SET names utf8\" );
									
									\$this->paginate = array (
											'conditions' => array (
													'Estore_news.status' => 1,
													'Estore_news.category_id' => 208 
											),
											'limit' => '1',
											'order' => 'Estore_news.id DESC' 
									);
									
									\$this->set ( 'news', \$this->paginate ( 'Estore_news', array () ) );
								}
								function baogia() {
									\$this->set ( 'shopname', \$this->shopname );
									\$this->layout = 'themeshop/estoredaquy';
									mysql_query ( \"SET names utf8\" );
									\$this->loadModelNew('Estore_news');
									\$this->paginate = array (
											'conditions' => array (
													'Estore_news.status' => 1,
													'Estore_news.category_id' => 206 
											),
											'limit' => '8',
											'order' => 'Estore_news.id DESC' 
									);
									
									\$this->set ( 'baogia', \$this->paginate ( 'Estore_news', array () ) );
								}
								function chinhsach() {
									\$this->set ( 'shopname', \$this->shopname );
									\$this->layout = 'themeshop/estoredaquy';
									mysql_query ( \"SET names utf8\" );
									\$this->loadModelNew('Estore_news');
									\$this->paginate = array (
											'conditions' => array (
													'Estore_news.status' => 1,
													'Estore_news.category_id' => 205 
											),
											'limit' => '1',
											'order' => 'Estore_news.id DESC' 
									);
									
									\$this->set ( 'chinhsach', \$this->paginate ( 'Estore_news', array () ) );
								}
								
								
								function listnews(\$id = null) {
									\$this->set ( 'shopname', \$this->shopname );
									\$this->layout = 'themeshop/estoredaquy';
									mysql_query ( \"SET names utf8\" );
									\$this->loadModelNew('Estore_news');
									\$this->paginate = array (
											'conditions' => array (
													'Estore_news.status' => 1,
													'Estore_news.category_id' => \$id 
											),
											'limit' => '8',
											'order' => 'Estore_news.id DESC' 
									);
									
									\$this->set ( 'listnews', \$this->paginate ( 'Estore_news', array () ) );
									\$this->loadModelNew('Estore_category');
									\$this->set ( 'cat', \$this->Estore_category->read ( null, \$id ) );
								}
								
								function viewnew(\$id = null) {
									\$this->set ( 'shopname', \$this->shopname );
									\$this->layout = 'themeshop/estoredaquy';
									mysql_query ( \"SET names utf8\" );
									\$this->loadModelNew('Estore_news');
									if (! \$id) {
										
										\$this->Session->setFlash ( __ ( 'Không tồn tại', true ) );
										
										\$this->redirect ( array (
												'action' => 'index' 
										) );
									}
									
									\$x = \$this->Estore_news->read ( null, \$id );
									
									\$this->set ( 'views', \$x );
									\$this->loadModelNew('Estore_news');
									\$this->set ( 'list_other', \$this->Estore_news->find ( 'all', array (
											'conditions' => array (
													'Estore_news.status' => 1,
													'Estore_news.category_id' => \$x ['Estore_news'] ['category_id'],
													'Estore_news.id <>' => \$id 
											),
											'limit' => 10 
									) ) );
								}
								function searchnews(\$name_search = null) {
									\$this->set ( 'shopname', \$this->shopname );
									\$this->layout = 'themeshop/estoredaquy';
									mysql_query ( \"SET names utf8\" );
									\$this->loadModelNew('Estore_news');
									\$title = \$_POST ['name_search'];
									
									\$this->set ( 'listsearch', \$this->Estore_news->find ( 'all', array (
											'conditions' => array (
													'Estore_news.status' => 1,
													'Estore_news.title LIKE' => '%' . \$title . '%' 
											),
											'order' => 'Estore_news.id DESC',
											'limit' => 7 
									) ) );
								}
							
								//-----------------------End Estore_news-------------------------------------------
								//+++++++++++++++++++++Plugin++++++++++++++++++++++++++++++++++
									
							  function binhchon(){
									mysql_query(\"SET names utf8\");
										return \$this->Eshopdaquycatpoll->find('all',array('conditions'=>array('Eshopdaquycatpoll.status'=>1),'order'=>'Eshopdaquycatpoll.id DESC'));	
									//return \$this->Estore_categorypro->find('all');
								}
								
								function banner(){
									return \$this->Estore_banner->find('all',array('conditions'=>array('Estore_banner.status'=>1),'order'=>'Estore_banner.id DESC'));
								}
								
								function setting(){
									return \$this->Estore_settings->find('all',array('conditions'=>array(),'order'=>'Estore_settings.id DESC'));
								}
								
								function linkwebsite(){
									//return \$this->Gallery->find('all',array('conditions'=>array('Gallery.status'=>1),'order'=>'Gallery.id DESC','limit'=>2));
									return \$this->Estore_advertisement->find('all',array('conditions'=>array('Estore_advertisement.status'=>1),'order'=>'Estore_advertisement.id DESC'));
								}
								
								
								//cong trinh
								function vanbanphapluat(){
									mysql_query(\"SET names utf8\");
									return \$this->Estore_category->find('all',array('conditions'=>array('Estore_category.status'=>1,'Estore_category.parent_id'=>'196'),'order'=>'Estore_category.tt DESC'));
								}
								
								function videos(){
									mysql_query(\"SET names utf8\");
									return \$this->Estore_video->find('all',array('conditions'=>array('Estore_video.status'=>1),'order'=>'Estore_video.id DESC','limit'=>1));
								}
								//----------------------end Plugin---------------------------------
								
								//+++++++++++++++++++Contact++++++++++++++++++++++++++++
								function sendcontacts()
								{     
								               \$nameeshop = \$this->shopname;
														\$shoparr = \$this->Shop->find ( 'all', array (
																'conditions' => array (
																		'Shop.name' => \$nameeshop,
																		'Shop.status' => 1
																),
																'fields' => array (
																		'Shop.id',
																		'Shop.created',
																		'Shop.databasename',
																		'Shop.username',
																		'Shop.password',
																		'Shop.hostname',
																		'Shop.ipserver'
																)
														) );
															
														//++++++++++Connect  data +++++++++++++++++
														foreach(\$shoparr as \$shop){
															\$databasename = \$shop['Shop']['databasename'];
															\$password = \$shop['Shop']['password'];
															\$username = \$shop['Shop']['username'];
															\$hostname = \$shop['Shop']['hostname'];
															\$shop_id = \$shop['Shop']['id'];
																
														}
							
													
														
														\$this->set ( 'shopname', \$this->shopname );
														\$this->set ( 'shop_id', \$shop_id);
									                    \$this->layout = 'themeshop/estoredaquy';
														\$message= \"\";
														\$this->set('message',\$message);
														
														\$this->set ( 'title_for_layout', 'e-shop' );
														mysql_query ( \"SET NAMES 'utf8'\" );
														mysql_query ( \"SET character_set_client=utf8\" );
														mysql_query ( \"SET character_set_connection=utf8\" );
														\$this->Estore_settings->setDataEshop(\$hostname,\$username,\$password,\$databasename);
														\$x = \$this->Estore_settings->read ( null, 1 );
														
														//die;
														if (isset ( \$_POST ['name'] )) {
															\$name = trim(\$_POST ['name']);
															\$mobile = \$_POST ['phone'];
															\$email = trim(\$_POST ['email']);
															\$title = trim(\$_POST ['title']);
															\$content = trim(\$_POST ['content']);
															if(\$email==='') {
																		//echo '<script language=\"javascript\"> alert(\"gửi mail không thành công\"); </script>';
																		\$this->set('message','Error Mail !!!!');
																		//exit;
																	}
															\$data = array(
																	'estore_id'=>\$x['Estore_settings']['estore_id'],
																    'name'=>\$name,
																	'email'=>\$email,
																	'title'=>\$title,
																	'content'=>\$content
															);
															
															if(!empty(\$data)) {
																\$this->Estore_contacts->setDataEshop(\$hostname,\$username,\$password,\$databasename);
																if(\$this->Estore_contacts->save(\$data))
																{
																	\$resultemail = \$this->smtpmailer(\$email,'alatcas1@gmail.com','FREEMOBIWEB.MOBI',\$x['Estore_settings']['title'],\$content);
																	if (\$resultemail ==1)
																	{
																		//echo '<script language=\"javascript\"> alert(\"Gửi mail thành công\"); location.href=\"' . DOMAIN .\$this->shopname. '\";</script>';
																		\$message= \"succesfuly\";
																		\$this->set('message',\$message);
																	}
																	else
																	{
																		//echo '<script language=\"javascript\"> alert(\"gửi mail không thành công\"); </script>';
																		\$this->set('message',\$resultemail);
																	}
																}
															}
										                   
															
														}
													}
								
								function smtpmailer(\$to, \$from, \$from_name, \$subject, \$body) {
									//++++++++ include PhpMailler +++++++++++
									\$libraryPhpMailer = ROOT.'/PhpMailer/';
									\$filename = \$libraryPhpMailer.'class.phpmailer.php';
									if(file_exists(\$filename))
										include(\$filename);
									global \$error;
									\$mail = new PHPMailer();
									\$mail->IsSMTP();
									\$mail->CharSet = \"utf-8\";
									\$mail->SMTPDebug = 0;
									\$mail->SMTPAuth = true;
									\$mail->SMTPSecure = 'ssl';
									\$mail->Host = 'smtp.gmail.com';
									\$mail->Port = 465;
									\$mail->Username = GUSER;
									\$mail->Password = GPWD;
									\$mail->SetFrom(\$from, \$from_name);
									\$mail->Subject = \$subject;
									\$mail->Body = \$body;
									\$mail->AddAddress(\$to);
									if (!\$mail->Send()) {
										\$error = 'Gởi mail bị lỗi: ' . \$mail->ErrorInfo;
										return false;
									} else {
										\$error = 'thư của bạn đã được gởi đi ';
										return true;
									}
								}
								
							
								
								function dathang()
								{      mysql_query(\"SET NAMES 'utf8'\");
								mysql_query(\"SET character_set_client=utf8\");
								mysql_query(\"SET character_set_connection=utf8\");
								//\$x=\$this->Helps->read(null,1);
								if(isset(\$_SESSION['shopingcart']))
								{
									\$shopingcart=\$_SESSION['shopingcart'];
									\$this->set(compact('shopingcart'));
								}
								else
								{
									echo '<script language=\"javascript\"> alert(\"Chua co san pham nao trong gio hang\"); window.location.replace(\"'.DOMAIN.'\"); </script>';
								}
								if(isset(\$_POST['name']))
								{
									\$name=\$_POST['name'];
									\$mobile=\$_POST['phone'];
									\$email=\$_POST['email'];
									\$title=\$_POST['title'];
									\$content=\$_POST['content'];
								
									\$images=\$_POST['images'];
									\$product_name=\$_POST['product_name'];
									\$product_sl=\$_POST['product_sl'];
									\$price=\$_POST['price'];
									\$total=\$_POST['total'];
									\$this->Email->from = \$name.'<'.\$email.'>';
									\$this->Email->to = 'it.chomai@gmail.com';
									\$this->Email->subject = \$title;
									\$this->Email->template = 'default';
									\$this->Email->sendAs = 'both';
									\$this->set('name',\$name);
									\$this->set('mobile',\$mobile);
									\$this->set('email',\$email);
									\$this->set('content',\$content);
								
									\$this->set('images',\$images);
									\$this->set('product_name',\$product_name);
									\$this->set('product_sl',\$product_sl);
									\$this->set('price',\$price);
									\$this->set('total',\$total);
								
									\$this->set('sang',array('images','product_name','product_sl','price','total'));
								
									if(\$this->Email->send())
									{
										\$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
										echo '<script language=\"javascript\"> alert(\"Gửi mail thành công\"); </script>';
										unset(\$_SESSION['shopingcart']);
										echo '<script language=\"javascript\">location.href=\"'.DOMAIN.'\";</script>';
								
									}
									else
										\$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
									echo '<script language=\"javascript\"> alert(\"gửi mail không thành công\"); location.href=\"'.DOMAIN.'\";</script>';
								}
								}
					
						//-------------------End Contacts---------------------------
					}
				        \n";
						$stringData .= "?>\n";
						fwrite ( $fh, $stringData );
						fclose ( $fh );
						
						$fromfile = DOCUMENT_ROOT . 'app/controllers/estoredaquycp_controller.php';
						$tofile = DOCUMENT_ROOT . 'app/controllers/' . $project_name. '_controller.php';
							
						if (file_exists ( $tofile )) {
							return $dir_and_name_estore = "Tên gian hàng đã tồn tại";
							//exit ();
						}
						copy ( $fromfile, $tofile );
							
						return $controller_estore ="SucessFullController".$layout_code;
						break;
					}	
				//end 50000566
					   
				case 50000565:
					{
						$myFile = DOCUMENT_ROOT . 'app/controllers/estore_controller.php';
						// $myFile = DOMAIN.'app/controllers/bepga_controller.php';
						// pr($myFile);die;
						$fh = fopen ( $myFile, 'w' ) or die ( "can't open file" );
						$stringData = "";
						$stringData .= "<?php\n";
						$stringData .= "
						 class " . ucfirst ( $project_name) . "Controller extends AppController {
						  var \$name = '" . ucfirst ( $project_name) . "';
						   var \$shopname ='".$project_name."';
						  	var \$uses = array (
						  		'Estore_categories',//Catalogueshop
						  		'Estore_news',//eshop
						  		'Estore_products',//eshop products
						  		'Estore_catproducts',// eshop Estorecatproducts
						  		'Estore_manufacturers',// eshop Estore_manufacturers
						  		'Estore_advertisements',//eshop Estore_advertisements
						  		'Estore_slideshows', //eshop Estore_slideshows
						  		'Estore_partners', // eshop Estore_partners
						  		'Estore_infomations',//eshop Estore_infomations
								'Estore_albums',//eshop Estore_albums
						  		'Estore_settings',//eshop Estore_settings
								'Estore_banners',//eshop Estore_banners
								'Estore_category',
								'Estore_comments',//eshop Estore_comments
								'Estore_contacts',//eshop Estore_contacts
								'Estore_user',
								'Estore_news',
								'Estore_infomation',
								'Estore_order',
								'Estore_infomationdetail',
								'Estore_gallery',
								'Estore_album',
								'Estore_banner',
								'Estore_helps',
								'Estore_setting',
								'Estore_video',
								'Estore_slideshow',
								'Estore_partner',
								'Estore_advertisement',
								'Estore_catproduct',
								'Estore_product',
								'Estore_weblink',
								'Estore_manufacturer',
								'Shop' 
						);
						var \$paginate = array();
						var \$helpers = array (
								'Html',
								'Ajax',
								'Javascript',//'Paginator' 
						);
						var \$components = array (
								'RequestHandler',
								'Email' 
						);
						function loadModelNew(\$Model) {
							// ++++++++++++connection data +++++++++++++++++
						
							//++++++++++++connection data +++++++++++++++++
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											//'Shop.id' => \$shop_id,
											'Shop.name' => \$nameeshop,
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
								
							if(is_array(\$shoparr) and !empty(\$shoparr))
							{
								foreach(\$shoparr as \$shop){
									\$databasename = \$shop['Shop']['databasename'];
									\$password = \$shop['Shop']['password'];
									\$username = \$shop['Shop']['username'];
									\$hostname = \$shop['Shop']['hostname'];
									\$shop_id = \$shop['Shop']['id'];
									\$nameproject = \$shop['Shop']['name'];           // \$nameproject is name Ctronller
									\$email = trim(\$shop['Shop']['email']);
									\$userpass = \$shop['Shop']['userpass'];
								}
							}
						
							\$this->\$Model->setDataEshop ( \$hostname, \$username, \$password, \$databasename );
						}
						function connectiondatabase(\$sql) {
							\$nameeshop = \$this->shopname;	
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
						
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							\$db = new ConnectionManager;
							\$config = array(
									//'className' => 'Cake\Database\Connection',
									'driver' => 'mysql',
									'persistent' => false,
									'host' =>\$hostname,
									'login' =>\$username,
									'password' =>\$password,
									'database' =>\$databasename,
									'prefix' => false,
									'encoding' => 'utf8',
									'timezone' => 'UTC',
									'cacheMetadata' => true
							);
							\$db->create(\$databasename,\$config);
							\$name = ConnectionManager::getDataSource(\$databasename);
							// 							                                    echo \"99999999</br>\";
							// 							                                    pr(\$name->config);die;
							/*
							\$sql = \"SELECT estore_catproducts.*
									 FROM  estore_catproducts
									 WHERE estore_catproducts.parent_id= 0 AND estore_catproducts.estore_id =\".(int)\$shop_id.\" ORDER BY  estore_catproducts.name ASC \";
							//\$resul = \$name->rawQuery(\$sql);
							 * */
							 
							\$resul = \$name->fetchAll(\$sql);
								
							//pr(\$resul);
							return \$resul;
								
						}
						
						
						
						function get_shop_id(\$name) {
							
						
							return \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$name,
											'Shop.status' => 1 
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username', 
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									) 
							) );
						}
						
					
						
						function getOrder() {
							mysql_query ( \"SET names utf8\" );
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							//set data news eshop	
							\$this->Estore_infomations->setDataEshop(\$hostname,\$username,\$password,\$databasename);
						
							return \$this->Estore_infomations->find ( 'all', array (
									'order' => 'Estore_infomations.id DESC' 
							) );
						}
						function getAlbum() {
							mysql_query ( \"SET names utf8\" );
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							//set data news eshop	
							\$this->Estore_albums->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							return \$this->Estore_albums->find ( 'all', array (
									'conditions' => array (
											'Estore_albums.status' => 1 
									),
									'limit' => '3',
									'order' => 'Estore_albums.id ASC' 
							) );
						}
					
						function menucategory() {
							mysql_query ( \"SET names utf8\" );
							\$sql_exc = \"SELECT `estore_categories`.`id`, `estore_categories`.`estore_id`, `estore_categories`.`tt`, `estore_categories`.`parent_id`, `estore_categories`.`lft`, `estore_categories`.`rght`, `estore_categories`.`name`, `estore_categories`.`name_en`, `estore_categories`.`created`, `estore_categories`.`modified`, `estore_categories`.`status`, `estore_categories`.`images`, `estore_categories`.`alias` FROM `estore_categories` AS `estore_categories`   WHERE `estore_categories`.`status` = 1 AND `estore_categories`.`parent_id` IS NULL   ORDER BY `estore_categories`.`tt` ASC\";
								
							\$result = \$this->connectiondatabase(\$sql_exc);
							//pr(\$result);
							return \$result;
							
						}
						function showcategory(\$id = null) {
							mysql_query ( \"SET names utf8\" );
							\$sql_exc = \"SELECT `estore_categories`.`id`, `estore_categories`.`estore_id`,
									           `estore_categories`.`tt`, `estore_categories`.`parent_id`, 
									           `estore_categories`.`lft`, `estore_categories`.`rght`, 
									           `estore_categories`.`name`, `estore_categories`.`name_en`, 
									           `estore_categories`.`created`, `estore_categories`.`modified`,
									           `estore_categories`.`status`, `estore_categories`.`images`,
									           `estore_categories`.`alias` 
									     FROM `estore_categories` AS `estore_categories`  
									     WHERE `estore_categories`.`parent_id` = '\".\$id.\"'  
									     ORDER BY `estore_categories`.`tt` ASC\";
							\$result = \$this->connectiondatabase(\$sql_exc);
							//pr(\$result);
							return \$result;

						}
						
						function banner(\$shop_id=null) {
							\$sql_exc = \"SELECT estore_banners.*
									 FROM  estore_banners
									 WHERE estore_banners.estore_id =\".(int)\$shop_id.\" AND estore_banners.status = 1 ORDER BY  estore_banners.id ASC \";
								
							\$result = \$this->connectiondatabase(\$sql_exc);
							//pr(\$result);
							return \$result;
							
						}
						function setting(\$shop_id=null) {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_settings->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							return \$this->Estore_settings->find ( 'all', array (
									'conditions' => array ('Estore_settings.estore_id' =>\$shop_id),
									'order' => 'Estore_settings.id DESC' 
									) );
						}
						function adv() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_banners->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							return \$this->Estore_banners->find ( 'all', array (
									'conditions' => array (
											'Estore_banners.status' => 1 
									),
									'order' => 'Estore_banners.id DESC',
									'limit' => 2 
							) );
						}
						function doitac() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_partners->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							
						    return \$this->Estore_partners->find ( 'all', array (
									'conditions' => array (
											'Estore_partners.status' => 1 
									),
									'order' => 'Estore_partners.id DESC' 
							) );
						}
						function menu_active() {
							return \$this->Categoryestore2->find ( 'all', array (
									'conditions' => array (
											'Categoryestore2.parent_id' => 145 
									),
									'order' => 'Categoryestore2.id ASC' 
							) );
						}
						function helpsonline() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_helps->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							
							return \$this->Estore_helps->find ( 'all', array (
									'conditions' => array (
											'Estore_helps.status' => 1,
											'Estore_helps.estore_id' => \$shop_id
									),
									'order' => 'Estore_helps.id DESC' 
							) );
						}
						function id_product(\$id) {
							return \$this->Estore_product->read ( null, \$id );
							// pr(\$this->Estore_product->read(null,\$id));die;
						}
						function hot() {
							return \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 156 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 1 
							) );
						}
						function hotnew(\$shop_id=null) {
							\$sql_exc = \"SELECT estore_news.*
									 FROM  estore_news
									 WHERE estore_news.estore_id =\".(int)\$shop_id.\" AND estore_news.status = 1 AND estore_news.category_id = 156 ORDER BY  estore_news.id DESC LIMIT 6 \";
								
							\$result = \$this->connectiondatabase(\$sql_exc);
							//pr(\$result);
							
							return \$result;
							
						}
						function getinfo(\$cat = null) {
							return \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => \$cat 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 3 
							) );
						}
						function videos(\$shop_id=null) {
							mysql_query ( \"SET names utf8\" );
							\$sql_exc_other = \"SELECT estore_videos.*
											 FROM  estore_videos
											 WHERE estore_videos.status = 1 AND estore_videos.left= 0 AND estore_videos.estore_id= \".\$shop_id.\" ORDER BY estore_videos.id DESC LIMIT 1\";
							\$result_video = \$this->connectiondatabase(\$sql_exc_other);
							//pr(\$result_video);
							
							return \$result_video;
						}
						function videosright() {
							mysql_query ( \"SET names utf8\" );
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_video->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							
							return \$this->Estore_video->find ( 'all', array (
									'conditions' => array (
											'Estore_video.status' => 1,
						  					'Estore_video.estore_id' => \$shop_id,
											'Estore_video.left' => 1 
									),
									'order' => 'Estore_video.id DESC',
									'limit' => 1 
							) );
						}
						function tintuc() {
							return \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 156 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 5 
							) );
						}
						function slideshow() {
							mysql_query ( \"SET names utf8\" );
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_slideshows->setDataEshop(\$hostname,\$username,\$password,\$databasename);
						
							return \$this->Estore_slideshows->find ( 'all', array (
									'conditions' => array (
											'Estore_slideshows.status' => 1 
									),
									'order' => 'Estore_slideshows.id DESC' 
							) );
						}
						function library_image() {
							return \$this->Gallery->find ( 'all', array (
									'conditions' => array (
											'Gallery.status' => 1 
									),
									'order' => 'Gallery.id DESC',
									'limit' => 10 
							) );
						}
						function shows() {
							mysql_query ( \"SET names utf8\" );
							return \$this->Estore_category->find ( 'all', array (
									'conditions' => array (
											'Estore_category.parent_id' => '201' 
									),
									'order' => 'Estore_category.id ASC' 
							) );
						}
						// SẢN PHẨM
						function menuproduct() {
							mysql_query ( \"SET names utf8\" );
							return \$this->Estore_catproduct->find ( 'all', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => '3' 
									),
									'order' => 'Estore_catproduct.id ASC' 
							) );
						}
						function submenuproduct(\$id = null) {
							return \$this->Estore_catproduct->find ( 'all', array (
									'conditions' => array (
											'Estore_catproduct.parent_id ' => \$id 
									),
									'order' => 'Estore_catproduct.id ASC' 
							) );
						}
						function showsmenu() {
							mysql_query ( \"SET names utf8\" );
							return \$this->Estore_catproduct->find ( 'all', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => '12' 
									),
									'order' => 'Estore_catproduct.id ASC' 
							) );
						}
						function showsmenu1(\$id = null) {
							\$sql_exc = \"SELECT estore_catproducts.*
									 FROM  estore_catproducts
									 WHERE estore_catproducts.parent_id =\".(int)\$id.\" AND estore_catproducts.status = 1 ORDER BY  estore_catproducts.id ASC \";
							
							\$result = \$this->connectiondatabase(\$sql_exc);
							//pr(\$result);
							return \$result;

						}
						
						
						function showsmenu2(\$id = null) {
							\$sql_exc = \"SELECT estore_catproducts.*
									 FROM  estore_catproducts
									 WHERE estore_catproducts.parent_id =\".(int)\$id.\" AND estore_catproducts.status = 1 ORDER BY  estore_catproducts.id ASC \";
								
							\$result = \$this->connectiondatabase(\$sql_exc);
							//pr(\$result);
							return \$result;
						}
						
						function danhmuc(\$shopname) {
							
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$shopname,
											'Shop.status' => 1 
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username', 
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									) 
							) );

							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
							
							}
							\$db = new ConnectionManager;
							\$config = array(
									//'className' => 'Cake\Database\Connection',
									'driver' => 'mysql',
									'persistent' => false,
									'host' =>\$hostname,
									'login' =>\$username,
									'password' =>\$password,
									'database' =>\$databasename,
									'prefix' => false,
									'encoding' => 'utf8',
									'timezone' => 'UTC',
									'cacheMetadata' => true
							);
							\$db->create(\$databasename,\$config);
							\$name = ConnectionManager::getDataSource(\$databasename);
// 							                                    echo \"99999999</br>\";
// 							                                    pr(\$name->config);die;
							\$sql = \"SELECT estore_catproducts.*
									 FROM  estore_catproducts
									 WHERE estore_catproducts.parent_id= 0 AND estore_catproducts.estore_id =\".(int)\$shop_id.\" ORDER BY  estore_catproducts.name ASC \";
							//\$resul = \$name->rawQuery(\$sql);
							\$resul = \$name->fetchAll(\$sql);
							
							//pr(\$resul);
							return \$resul;
							
						}
						function typical(\$shop_id = Null) {
							return \$this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.estore_id' => \$shop_id 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 10 
							) );
						}
						function productnew() {
							return \$this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 10 
							) );
						}
						function khuyenmai() {
							return \$this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.display' => '1' 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 10 
							) );
						}
						function business() {
							return \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 218 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 5 
							) );
						}
						function customers() {
							return \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 219 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 5 
							) );
						}
						function science() {
							return \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 220 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 5 
							) );
						}
						function help() {
							return \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 156 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 8 
							) );
						}
						function tinkhuyenmai() {
							return \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 227 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 5 
							) );
						}
						function tinkhuyenmaile() {
							return \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 228 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 5 
							) );
						}
						function weblink() {
							return \$this->Estore_weblink->find ( 'all', array (
									'conditions' => array (
											'Estore_weblink.status' => 1 
									),
									'order' => 'Estore_weblink.id DESC' 
							) );
						}
						function cat() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_catproducts->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$prff = \$this->Estore_catproducts->find ( 'all', array (
									'conditions' => array (
											'Estore_catproducts.status' => 1 
									) 
							) );
						//	echo \"xzxzx\";
						//pr(\$prff);
							return \$prff;
							
						}
						function hsx() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->Estore_manufacturers->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$manufacturer =\$this->Estore_manufacturers->find ( 'all', array (
									'conditions' => array (
											'Estore_manufacturers.status' => 1,
											'Estore_manufacturers.parent_id ' => null 
									) 
							) );
							
// 							pr(\$manufacturer);
							return \$manufacturer;
// 							return \$this->Estore_manufacturer->find ( 'all', array (
// 									'conditions' => array (
// 											'Estore_manufacturer.status' => 1,
// 											'Estore_manufacturer.parent_id ' => null 
// 									) 
// 							) );
						}
						function catcon() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->Estore_catproducts->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$prff = \$this->Estore_catproducts->find ( 'all', array (
									'conditions' => array (
											'Estore_catproducts.status' => 1
									)
							) );
							//	echo \"xzxzx\";
							//pr(\$prff);
							return \$prff;

						}
						function adv1() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_advertisements->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							
							return \$this->Estore_advertisements->find ( 'all', array (
									'conditions' => array (
											'Estore_advertisements.status' => 1,
											'Estore_advertisements.display' => 0 
									),
									'limit' => 1 
							) );
						}
						function adv2() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->Estore_advertisements->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								
							return \$this->Estore_advertisements->find ( 'all', array (
									'conditions' => array (
											'Estore_advertisements.status' => 1,
											'Estore_advertisements.display' => 1 
									),
									'limit' => 1 
							) );
						}
						
						function advapp() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
								
							\$this->Estore_advertisements->setDataEshop(\$hostname,\$username,\$password,\$databasename);
						
							
							return \$this->Estore_advertisements->find ( 'all', array (
									'conditions' => array (
											'Estore_advertisements.status' => 1,
											'Estore_advertisements.estore_id' => \$shop_id,
											'Estore_advertisements.display' => 3
									),
									'order' => 'rand()',
									'limit' => 3
							));
						}
						function advf(\$shop_id= null) {
							\$sql_exc_other = \"SELECT estore_advertisements.*
											 FROM  estore_advertisements
											 WHERE estore_advertisements.status = 1 AND estore_advertisements.display= 2 AND estore_advertisements.estore_id= \".\$shop_id.\" ORDER BY estore_advertisements.id \";
							\$advf = \$this->connectiondatabase(\$sql_exc_other);
							//pr(\$advf);
								
							return \$advf;
							
							
						}
						function advr() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							
							\$this->Estore_advertisements->setDataEshop(\$hostname,\$username,\$password,\$databasename);
						  
							return \$this->Estore_advertisements->find ( 'all', array (
									'conditions' => array (
											'Estore_advertisements.status' => 1,
						  					'Estore_advertisements.estore_id' => \$shop_id,
											'Estore_advertisements.display' => 3 
									),
									'order' => 'Estore_advertisements.id ASC' 
							 ));
						}
						
						// +++++++++++++++++++++++++++++++++++Home+++++++++++++++++++++++++++++++++++++++++++++++
						function index() {
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
						
							\$this->set ( 'shopname', \$nameeshop );
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							\$this->paginate = array (
									'conditions' => array (
											'Estore_products.status' => 1,
											'Estore_products.spkuyenmai' => 1 
									),
									'limit' => '9',
									'order' => 'Estore_products.id DESC' 
							);
							\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
							
							\$this->Estore_catproducts->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$check1 = \$this->Estore_catproducts->find ( 'list', array (
									'conditions' => array (
											'Estore_catproducts.parent_id' => 106 
									),
									'fields' => array (
											'Estore_catproducts.id' 
									) 
							) );
							
							\$this->Estore_catproducts->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$checks = \$this->Estore_catproducts->find ( 'list', array (
									'conditions' => array (
											'Estore_catproducts.parent_id' => \$check1 
									),
									'fields' => array (
											'Estore_catproducts.id' 
									) 
							) );
							
							if (\$checks != null) {
								\$this->set ( 'tubep', \$this->Estore_products->find ( 'all', array (
										'conditions' => array (
												'Estore_products.status' => 1,
												'Estore_products.catproduct_id' => \$check1,
												'Estore_products.catproduct_id' => \$checks 
										),
										'limit' => 6,
										'order' => 'Estore_products.id DESC' 
								) ) );
							} else {
								\$this->set ( 'tubep', \$this->Estore_products->find ( 'all', array (
										'conditions' => array (
												'Estore_products.status' => 1,
												'Estore_products.catproduct_id' => \$check1 
										),
										'limit' => 6,
										'order' => 'Estore_products.id DESC' 
								) ) );
							}
							
							\$check2 = \$this->Estore_catproducts->find ( 'list', array (
									'conditions' => array (
											'Estore_catproducts.parent_id' => 107 
									),
									'fields' => array (
											'Estore_catproducts.id' 
									) 
							) );
							
							\$checkss = \$this->Estore_catproducts->find ( 'list', array (
									'conditions' => array (
											'Estore_catproducts.parent_id' => \$check2 
									),
									'fields' => array (
											'Estore_catproducts.id' 
									) 
							) );
							
							if (\$checkss != null) {
								\$this->set ( 'bepcongnghiep', \$this->Estore_products->find ( 'all', array (
										'conditions' => array (
												'Estore_products.status' => 1,
												'Estore_products.catproduct_id' => \$check2,
												'Estore_products.catproduct_id' => \$checkss 
										),
										'limit' => 6,
										'order' => 'Estore_products.id DESC' 
								) ) );
							} else {
								
								\$this->set ( 'bepcongnghiep', \$this->Estore_products->find ( 'all', array (
										'conditions' => array (
												'Estore_products.status' => 1,
												'Estore_products.catproduct_id' => \$check2 
										),
										'limit' => 6,
										'order' => 'Estore_products.id DESC' 
								) ) );
							}
							\$this->set ( 'spvip', \$this->Estore_products->find ( 'all', array (
									'conditions' => array (
											'Estore_products.status' => 1,
											'Estore_products.sptieubieu' => '1' 
									),
									'limit' => 6,
									'order' => 'Estore_products.id DESC' 
							) ) );
							
							
						}
						// ++++++++++++++++++++++++++++++Product++++++++++++++++++++++++++++++++++++++++
						function indexproduct() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							
							\$this->set ( 'shopname', \$nameeshop );
							
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_products.status' => 1 
									),
									'order' => 'Estore_products.id DESC',
									'limit' => 9 
							);
							\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
						}
						function dssanpham(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$check = \$this->Estore_catproduct->find ( 'list', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => \$id 
									),
									'fields' => array (
											'Estore_catproduct.id' 
									) 
							) );
							// var_dump(\$check); exit();
							if (\$check != null) {
								\$this->paginate = array (
										'conditions' => array (
												'Estore_catproduct.status' => 1,
												'Estore_catproduct.parent_id' => \$id 
										),
										'order' => 'Estore_catproduct.id ASC',
										'limit' => 9 
								);
								\$this->set ( 'catproduct', \$this->paginate ( 'Estore_catproduct', array () ) );
								\$this->set ( 'cat', \$this->Estore_catproduct->read ( null, \$id ) );
							} else {
								\$this->paginate = array (
										'conditions' => array (
												'Estore_product.status' => 1,
												'Estore_product.catproduct_id' => \$id 
										),
										'order' => 'Estore_product.id DESC',
										'limit' => 9 
								);
								\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
								\$this->set ( 'cat', \$this->Estore_catproduct->read ( null, \$id ) );
							}
						}
						function all(\$id = null) {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->set ( 'shopname', \$nameeshop );
							
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$this->Estore_catproducts->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$check = \$this->Estore_catproducts->find ( 'list', array (
									'conditions' => array (
											'Estore_catproducts.parent_id' => \$id 
									),
									'fields' => array (
											'Estore_catproducts.id' 
									) 
							) );
							
							if (\$check != null) {
								\$this->paginate = array (
										'conditions' => array (
												'Estore_products.status' => 1,
												'Estore_products.catproduct_id' => \$check 
										),
										'order' => 'Estore_products.id DESC',
										'limit' => 18 
								);
								\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								\$this->Estore_catproducts->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
								\$this->set ( 'cat', \$this->Estore_catproducts->read ( null, \$id ) );
							} else {
								\$this->paginate = array (
										'conditions' => array (
												'Estore_products.status' => 1,
												'Estore_products.catproduct_id' => \$id 
										),
										'order' => 'Estore_products.id DESC',
										'limit' => 18 
								);
								\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								\$this->Estore_catproducts->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
								\$this->set ( 'cat', \$this->Estore_catproducts->read ( null, \$id ) );
							}
						}
						function khuyenmaiproduct() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							
							\$this->set ( 'shopname', \$nameeshop );
							
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							
							\$this->paginate = array (
									'conditions' => array (
											'Estore_products.status' => 1,
											'Estore_products.spkuyenmai' => 1 
									),
									'order' => 'Estore_products.id DESC',
									'limit' => 18 
							);
							\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
							
							\$this->set ( 'cat', 'Sản phẩm khuyến mãi' );
						}
						function vip() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							
							\$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.sptieubieu' => 1 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 18 
							);
							\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
							\$this->set ( 'cat', 'Sản phẩm trung & cao cấp' );
						}
						function vpp() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$dem = \$this->Estore_catproduct->find ( 'list', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => '21' 
									),
									'fields' => array (
											'Estore_catproduct.id' 
									) 
							) );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => \$dem 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 12 
							);
							\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
							\$this->set ( 'newsproducts', \$this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => \$dem,
											'Estore_product.sptieubieu' => '1' 
									),
									'limit' => 16,
									'order' => 'Estore_product.id DESC' 
							) ) );
						}
						function thietbivp() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$dem = \$this->Estore_catproduct->find ( 'list', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => '22' 
									),
									'fields' => array (
											'Estore_catproduct.id' 
									) 
							) );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => \$dem 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 12 
							);
							\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
							\$this->set ( 'newsproducts', \$this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => \$dem,
											'Estore_product.sptieubieu' => '1' 
									),
									'limit' => 16,
									'order' => 'Estore_product.id DESC' 
							) ) );
						}
						function thietbicntt() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$dem = \$this->Estore_catproduct->find ( 'list', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => '23' 
									),
									'fields' => array (
											'Estore_catproduct.id' 
									) 
							) );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => \$dem 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 12 
							);
							\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
							\$this->set ( 'newsproducts', \$this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => \$dem,
											'Estore_product.sptieubieu' => '1' 
									),
									'limit' => 16,
									'order' => 'Estore_product.id DESC' 
							) ) );
						}
						function listproduct(\$id = null) {
							
							\$this->set ( 'shopname', \$this->shopname );
							
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
							
							mysql_query ( \"SET names utf8\" );
							\$this->loadModelNew('Estore_products');
							\$this->set ( 'newsproducts', \$this->Estore_products->find ( 'all', array (
									'conditions' => array (
											'Estore_products.status' => 1,
											'Estore_products.catproduct_id' => \$id,
											'Estore_products.sptieubieu' => '1' 
									),
									'limit' => 9,
									'order' => 'Estore_products.id DESC' 
							) ) );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_products.status' => 1,
											'Estore_products.catproduct_id' => \$id 
									),
									'order' => 'Estore_products.id DESC',
									'limit' => 9 
							);
							\$this->loadModelNew('Estore_products');
							\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
							\$this->loadModelNew('Estore_catproducts');
							\$this->set ( 'cat', \$this->Estore_catproducts->read ( null, \$id ) );
						}
						   function validatesearch() {
							\$this->set ( 'shopname', \$this->shopname );
							\$this->layout = 'themeshop/clothingstore';
							\$this->set ( 'title_for_layout', 'e-shop' );
								
							mysql_query ( \"SET names utf8\" );
							\$this->loadModelNew('Estore_products');
							\$getallprod = \$this->Estore_products->find ( 'all', array () );
							
							return \$getallprod;
							
						}
						function listsp1(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => \$id 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 9 
							);
							\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
							\$this->set ( 'cat', \$this->Estore_catproduct->read ( null, \$id ) );
						}
						function listsp12(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => \$id 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 10 
							);
							\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
							\$this->set ( 'cat', \$this->Estore_catproduct->read ( null, \$id ) );
						}
						function listsp2(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => \$id 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 10 
							);
							\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
							\$this->set ( 'cat', \$this->Estore_catproduct->read ( null, \$id ) );
						}
						function search() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_categories->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							//\$this->loadModel ( \"Estore_catproducts\" );
							
							if (isset ( \$_POST ['system'] )) {
								\$list_cat = \$_POST ['system'];
							} else
								\$list_cat = \"\";
							if (isset ( \$_POST ['hsx'] )) {
								\$hsx = \$_POST ['hsx'];
							} else
								\$hsx = \"\";
							if (isset ( \$_POST ['gia'] )) {
								\$gia = \$_POST ['gia'];
							} else
								\$gia = \"\";
							
							
							
							if ((\$list_cat != \"\") && (\$hsx == \"\") && (\$gia == \"\")) {
								\$this->Estore_categories->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								\$po1 = \$this->Estore_categories->find ( 'list', array (
										'conditions' => array (
												'Estore_categories.status' => 1,
												'Estore_categories.parent_id' => \$list_cat 
										),
										'fields' => array (
												'Estore_categories.id' 
										) 
								) );
								
								if (\$po1 != null) {
									\$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.catproduct_id' => \$po1 
											),
											'limit' => '21',
											'order' => 'Estore_products.id DESC' 
									);
									\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
									\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
								} else {
									\$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.catproduct_id' => \$list_cat 
											),
											'limit' => '21',
											'order' => 'Estore_products.id DESC' 
									);
									\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
									\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
								}
							}
							
							if ((\$list_cat != \"\") && (\$hsx != \"\") && (\$gia == \"\")) {
								\$this->Estore_categories->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								\$po1 = \$this->Estore_categories->find ( 'list', array (
										'conditions' => array (
												'Estore_categories.status' => 1,
												'Estore_categories.parent_id' => \$list_cat 
										),
										'fields' => array (
												'Estore_categories.id' 
										) 
								) );
								
								if (\$po1 != null) {
									\$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.catproduct_id' => \$po1,
													'Estore_products.manufacturer' => \$hsx 
											),
											'limit' => '21',
											'order' => 'Estore_products.id DESC' 
									);
									\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
									\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
								} else {
									\$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.catproduct_id' => \$list_cat,
													'Estore_products.manufacturer' => \$hsx 
											),
											'limit' => '21',
											'order' => 'Estore_products.id DESC' 
									);
									\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
									\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
								}
							}
							
							if ((\$list_cat != \"\") && (\$hsx == \"\") && (\$gia != \"\")) {
								\$this->Estore_categories->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								\$po1 = \$this->Estore_categories->find ( 'list', array (
										'conditions' => array (
												'Estore_categories.status' => 1,
												'Estore_categories.parent_id' => \$list_cat 
										),
										'fields' => array (
												'Estore_categories.id' 
										) 
								) );
								
								if (\$po1 != null) {
									\$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.catproduct_id' => \$po1,
													'Estore_products.khoanggia' => \$gia 
											),
											'limit' => '21',
											'order' => 'Estore_products.id DESC' 
									);
									\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
									\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
								} else {
									\$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.catproduct_id' => \$list_cat,
													'Estore_products.khoanggia' => \$gia 
											),
											'limit' => '21',
											'order' => 'Estore_products.id DESC' 
									);
									\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
									\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
								}
							}
							if ((\$list_cat != \"\") && (\$hsx != \"\") && (\$gia != \"\")) {
								\$this->Estore_categories->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								\$po1 = \$this->Estore_categories->find ( 'list', array (
										'conditions' => array (
												'Estore_categories.status' => 1,
												'Estore_categories.parent_id' => \$list_cat 
										),
										'fields' => array (
												'Estore_categories.id' 
										) 
								) );
								
								if (\$po1 != null) {
									\$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.catproduct_id' => \$po1,
													'Estore_products.khoanggia' => \$gia,
													'Estore_products.manufacturer' => \$hsx 
											),
											'limit' => '21',
											'order' => 'Estore_products.id DESC' 
									);
									\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
									\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
								} else {
									\$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.catproduct_id' => \$list_cat,
													'Estore_products.khoanggia' => \$gia,
													'Estore_products.manufacturer' => \$hsx 
											),
											'limit' => '21',
											'order' => 'Estore_products.id DESC' 
									);
									\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
									\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
								}
							}
							if ((\$list_cat == \"\") && (\$hsx == \"\") && (\$gia != \"\")) {
								\$this->paginate = array (
										'conditions' => array (
												'Estore_products.status' => 1,
												'Estore_products.khoanggia' => \$gia 
										),
										'limit' => '21',
										'order' => 'Estore_products.id DESC' 
								);
								\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
							}
							if ((\$list_cat == \"\") && (\$hsx != \"\") && (\$gia == \"\")) {
								
								\$this->paginate = array (
										'conditions' => array (
												'Estore_products.status' => 1,
												'Estore_products.manufacturer' => \$hsx 
										),
										'limit' => '21',
										'order' => 'Estore_products.id DESC' 
								);
								\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
							}
							if ((\$list_cat == \"\") && (\$hsx != \"\") && (\$gia != \"\")) {
								
								\$this->paginate = array (
										'conditions' => array (
												'Estore_products.status' => 1,
												'Estore_products.manufacturer' => \$hsx,
												'Estore_products.khoanggia' => \$gia 
										),
										'limit' => '21',
										'order' => 'Estore_products.id DESC' 
								);
								\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
							}
							if ((\$list_cat == \"\") && (\$hsx == \"\") && (\$gia == \"\")) {
								
								\$this->paginate = array (
										'conditions' => array (
												'Estore_products.status' => 1 
										),
										'limit' => '21',
										'order' => 'Estore_products.id DESC' 
								);
								\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								\$this->set ( 'products', \$this->paginate ( 'Estore_products', array () ) );
							}
							
							
						}
						function view(\$id = null) {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							\$this->set ( 'shopname', \$nameeshop );
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							mysql_query ( \"SET names utf8\" );
							if (! \$id) {
								\$this->Session->setFlash ( __ ( 'Không tồn tại', true ) );
								\$this->redirect ( array (
										'action' => 'index' 
								) );
							}
							\$this->set ( 'views', \$this->Estore_products->read ( null, \$id ) );
							\$this->set ( 'news', \$this->Estore_catproducts->read ( null, \$id ) );
							\$name = \$this->Estore_products->read ( null, \$id );
							
							\$this->set ( 'views', \$name );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_products.status' => 1,
											'Estore_products.catproduct_id' => \$name ['Estore_products'] ['catproduct_id'],
											'Estore_products.id <>' => \$name ['Estore_products'] ['id'] 
									),
									'order' => 'Estore_products.id DESC',
									'limit' => 8 
							);
							\$this->set ( 'sanphamkhac', \$this->paginate ( 'Estore_products', array () ) );
						}
						
						// shopping
						function addshopingcart(\$id = null) {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->set ( 'shopname', \$nameeshop );
							
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							\$this->Estore_products->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$product = \$this->Estore_products->read ( null, \$id );
							
							if (! isset ( \$_SESSION ['shopingcart'] )) {
								\$_SESSION ['shopingcart'] = array ();
							}
							;
							
							if (isset ( \$_SESSION ['shopingcart'] )) {
								
								\$shopingcart = \$_SESSION ['shopingcart'];
								if (isset ( \$shopingcart [\$id] )) {
									\$shopingcart [\$id] ['sl'] = \$shopingcart [\$id] ['sl'] + 1;
									\$shopingcart [\$id] ['total'] = \$shopingcart [\$id] ['price'] * \$shopingcart [\$id] ['sl'];
									\$_SESSION ['shopingcart'] = \$shopingcart;
									echo '<script language=\"javascript\">  window.location.replace(\"' . DOMAIN .\$this->shopname. '/viewshopingcart\"); </script>';
								} else {
									\$shopingcart [\$id] ['pid'] = \$id;
									\$shopingcart [\$id] ['name'] = \$product ['Estore_products'] ['title'];
									\$shopingcart [\$id] ['images'] = \$product ['Estore_products'] ['images'];
									\$shopingcart [\$id] ['sl'] = 1;
									\$shopingcart [\$id] ['price'] = \$product ['Estore_products'] ['price'];
									\$shopingcart [\$id] ['total'] = \$product ['Estore_products'] ['price'] * \$shopingcart [\$id] ['sl'];
									\$_SESSION ['shopingcart'] = \$shopingcart;
									echo '<script language=\"javascript\" type=\"text/javascript\">  window.location.replace(\"' . DOMAIN .\$this->shopname . '/viewshopingcart\"); </script>';
								}
							}
						}
						function deleteshopingcart(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							if (isset ( \$_SESSION ['shopingcart'] )) {
								\$shopingcart = \$_SESSION ['shopingcart'];
								if (isset ( \$shopingcart [\$id] ))
									unset ( \$shopingcart [\$id] );
								\$_SESSION ['shopingcart'] = \$shopingcart;
								\$this->redirect ( 'viewshopingcart' );
							}
						}
						function order(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							if (! \$id) {
								\$this->Session->setFlash ( __ ( 'Không tồn tại', true ) );
								\$this->redirect ( array (
										'action' => 'index' 
								) );
							}
							\$this->set ( 'buy', \$this->Estore_news->read ( null, \$id ) );
						}
						function viewshopingcart() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							//\$this->Estore_news->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								
							\$this->set ( 'shopname', \$nameeshop );
							
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop View Shopping' );
							if (isset ( \$_SESSION ['shopingcart'] )) {
								\$shopingcart = \$_SESSION ['shopingcart'];
								\$this->set ( compact ( 'shopingcart' ) );
							} else {
								echo '<script language=\"javascript\"> alert(\"Chua co san pham nao trong gio hang\"); window.location.replace(\"' . DOMAIN .\$this->shopname . '/index\"); </script>';
							}
						}
						function updateshopingcart(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							if (isset ( \$_SESSION ['shopingcart'] )) {
								\$shopingcart = \$_SESSION ['shopingcart'];
								if (isset ( \$shopingcart [\$id] )) {
									\$shopingcart [\$id] ['sl'] = \$_POST ['soluong'];
									\$shopingcart [\$id] ['total'] = \$shopingcart [\$id] ['sl'] * \$shopingcart [\$id] ['price'];
								}
								\$_SESSION ['shopingcart'] = \$shopingcart;
								
								\$this->redirect ( 'viewshopingcart' );
							}
						}
						function buy() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->set ( 'shopname', \$nameeshop );
							
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							if (isset ( \$_SESSION ['shopingcart'] )) {
								\$shopingcart = \$_SESSION ['shopingcart'];
								\$this->set ( compact ( 'shopingcart' ) );
							} else {
								echo '<script language=\"javascript\"> alert(\"Không có sản phẩm nào trong giỏ hàng của bạn\"); window.location.replace(\"' . DOMAIN .\$this->shopname.'\"); </script>';
							}
						}
						function category(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							if (! \$id) {
								\$this->Session->setFlash ( __ ( 'Không tồn tại', true ) );
								\$this->redirect ( array (
										'action' => 'index' 
								) );
							}
							\$this->set ( 'products', \$this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'category_id' => \$id 
									),
									'order' => 'Estore_product.id DESC' 
							) ) );
						}
						function getproduct(\$id = null) {
							return \$this->Estore_product->read ( null, \$id );
						}
						// +++++++++++++++++++++Infomation++++++++++++++++++++++++++++++++++++++
						/*
						 * function indexinfomation() { \$shop=explode('/',\$this->params['url']['url']); \$shopname=\$shop[0]; \$shoparr=\$this->get_shop_id(\$shopname); foreach(\$shoparr as \$key=>\$value){ \$shop_id=\$key; } \$this->set ( 'shopname',\$shopname); \$this->set('title_for_layout', 'Đại lý - CÔNG TY THHH'); if(!\$this->Session->read(\"user_id\")){ echo \"<script>location.href='\".DOMAIN.\"login'</script>\"; }else{ if(\$this->Session->read(\"check\")==0){ \$this->set('agents',\$this->Agent->find('all')); }else{ \$this->set('agents',\$this->Agent->find('all',array('conditions'=>array('Agent.check_id'=>\$this->Session->read(\"check\"))))); } } } function viewinfomation(\$id=null) { \$shop=explode('/',\$this->params['url']['url']); \$shopname=\$shop[0]; \$shoparr=\$this->get_shop_id(\$shopname); foreach(\$shoparr as \$key=>\$value){ \$shop_id=\$key; } \$this->set ( 'shopname',\$shopname); mysql_query(\"SET names utf8\"); \$this->set('title_for_layout', 'Hỏi đáp - VIỆN KHOA HỌC VÀ CÔNG NGHỆ XÂY DỰNG GIAO THÔNG'); if (!\$id) { \$this->Session->setFlash(__('Không tồn tại', true)); \$this->redirect(array('action' => 'index')); } \$this->set('views', \$this->Estore_news->read(null, \$id)); \$conditions=array('Estore_news.status'=>1,'Estore_news.category_id'=>149,'Estore_news.id <>'=>\$id); \$this->set('list_other',\$this->Estore_news->find('all',array('conditions'=>\$conditions,'order'=>'Estore_news.id DESC','limit'=>7))); }
						 */
						// ++++++++++++++++++++++++++++++Infomations+++++++++++++++++++++++++++++++++++++++++++++
						function indexinfomations() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							
							if (! \$this->Session->read ( \"email\" )) {
								echo \"<script>location.href='\" . DOMAIN . \"login'</script>\";
							} else {
								
								\$this->set ( 'infomations', \$this->Estore_infomation->find ( 'all', array (
										'conditions' => array (
												'Estore_infomation.user_id' => \$this->Session->read ( \"id\" ) 
										),
										'limit' => 10 
								) ) );
							}
						}
						function addinfomations() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->set ( 'shopname', \$nameeshop );
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							\$uid = \"id\" . rand ( 1, 1000000 );
							\$data ['Estore_infomations'] ['user_id'] = (\$this->Session->read ( \"id\" ) != '' ? \$this->Session->read ( \"id\" ) : \$uid);
							\$data ['Estore_infomations'] ['mobile'] = \$_POST ['phone'];
							\$data ['Estore_infomations'] ['address'] = \$_POST ['address'];
							\$data ['Estore_infomations'] ['email'] = \$_POST ['email'];
							\$data ['Estore_infomations'] ['name'] = \$_POST ['name'];
							\$data ['Estore_infomations'] ['phone'] = \$_POST ['phone'];
							\$data ['Estore_infomations'] ['total'] = \$_POST ['total'];
							\$data ['Estore_infomations'] ['estore_id'] = \$shop_id;
							
							\$this->Estore_infomations->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$this->Estore_infomations->save ( \$data ['Estore_infomations'] );
							
							\$info_id = \$this->Estore_infomations->getLastInsertId ();
							
							\$shopingcart = \$_SESSION ['shopingcart'];
							// print_r(\$shopingcart);exit;
							\$i = 0;
							foreach ( \$shopingcart as \$key ) {
								\$this->Estore_infomationdetail->create ();
								\$data ['Estore_infomationdetail'] ['infomations_id'] = \$info_id;
								\$data ['Estore_infomationdetail'] ['product_id'] = \$key ['pid'];
								\$data ['Estore_infomationdetail'] ['name'] = \$key ['name'];
								\$data ['Estore_infomationdetail'] ['images'] = \$key ['images'];
								\$data ['Estore_infomationdetail'] ['quantity'] = \$key ['sl'];
								\$data ['Estore_infomationdetail'] ['price'] = \$key ['price'];
								\$this->Estore_infomationdetail->save ( \$data ['Estore_infomationdetail'] );
								\$i ++;
							}
							
							unset ( \$_SESSION ['shopingcart'] );
							echo '<script language=\"javascript\">alert(\"cảm ơn bạn đã đặt hàng  chúng tôi sẽ liên hệ với bạn trong vòng 24h\"); location.href=\"' . DOMAIN .\$this->shopname . '/index\";</script>';
						}
						function deleteinfomations(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							if (empty ( \$id )) {
								\$this->Session->setFlash ( __ ( 'Khôn tồn tại danh mục này', true ) );
								// \$this->redirect(array('action'=>'index'));
							}
							if (\$this->Infomations->delete ( \$id )) {
								\$this->Session->setFlash ( __ ( 'Xóa danh mục thành công', true ) );
								\$this->redirect ( array (
										'action' => 'indexinfomations' 
								) );
							}
							\$this->Session->setFlash ( __ ( 'Danh mục không xóa được', true ) );
							\$this->redirect ( array (
									'action' => 'indexinfomations' 
							) );
						}
						// +++++++++++++++++++++++++++++++News+++++++++++++++++++++++++++++++++++++++++++++++++++++++
						function indexnews() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->set ( 'shopname', \$nameeshop );
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							\$this->Estore_news->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 156 
									),
									'limit' => '5',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'news', \$this->paginate ( 'Estore_news', array () ) );
						}
						function tintucnoibat() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 221 
									),
									'limit' => '6',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'news', \$this->paginate ( 'Estore_news', array () ) );
						}
						function promotion() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 222 
									),
									'limit' => '6',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'news', \$this->paginate ( 'Estore_news', array () ) );
						}
						function danceclass() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 223 
									),
									'limit' => '6',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'news', \$this->paginate ( 'Estore_news', array () ) );
						}
						
						function listnews(\$id=null) {
							//layout
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_news->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							
							//\$Estoreshopnews = \$this->Estore_news->find('all');
							//pr(\$Estoreshopnews);
							
							mysql_query(\"SET names utf8\");
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => \$id 
									),
									'limit' => '10',
											'order' => 'Estore_news.id DESC' 
									);

				      \$this->set('listnews', \$this->paginate('Estore_news',array()));
							
							\$this->Estore_categories->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$this->set('cat',\$this->Estore_categories->read(null,\$id));
						}

						function getmodolnews()
						{
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
							
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							
							\$this->Estore_news->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							
							\$Estoreshopnews = \$this->Estore_news->find('all');
							
							pr(\$Estoreshopnews);
							\$this->set('Estoreshopnews', \$Estoreshopnews);
						}
						
						function souvenir() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 213 
									),
									'limit' => '5',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'news', \$this->paginate ( 'Estore_news', array () ) );
						}
						function recruitment() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 220 
									),
									'limit' => '5',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'news', \$this->paginate ( 'Estore_news', array () ) );
						}
						function services() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 227 
									),
									'limit' => '7',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'news', \$this->paginate ( 'Estore_news', array () ) );
						}
						function dichvu() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 224 
									),
									'limit' => '7',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'news', \$this->paginate ( 'Estore_news', array () ) );
						}
						function ticket() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach ve may bay
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 214 
									),
									'limit' => '8',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'ticket', \$this->paginate ( 'Estore_news', array () ) );
						}
						function hotel() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach khach san
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 215 
									),
									'limit' => '8',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'hotel', \$this->paginate ( 'Estore_news', array () ) );
						}
						function carnews() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach xe du lich
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 216 
									),
									'limit' => '8',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'car', \$this->paginate ( 'Estore_news', array () ) );
						}
						function visa() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach ho chieu
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 217 
									),
									'limit' => '8',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'visa', \$this->paginate ( 'Estore_news', array () ) );
						}
						function capacity() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$news = \$this->Category->find ( 'list', array (
									'conditions' => array (
											'Category.parent_id' => 171 
									),
									'fields' => array (
											'Category.id' 
									) 
							) );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => \$news 
									),
									'limit' => '8',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'capacity', \$this->paginate ( 'Estore_news', array () ) );
						}
						function addview(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// var_dump(\$this->data);die;
							\$data = \$this->Estore_news->read ( null, \$_POST ['id'] );
							\$data ['Estore_news'] ['view'] = \$data ['Estore_news'] ['view'] + 1;
							\$this->Estore_news->save ( \$data ['Estore_news'] );
						}
						function view1(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => \$id 
									),
									'limit' => '1',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'recruitment', \$this->paginate ( 'Estore_news', array () ) );
							\$this->set ( 'cat', \$this->Category->read ( null, \$id ) );
						}
						function viewnews(\$id = null) {
						
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->set ( 'shopname', \$nameeshop );
							  \$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							
							if (! \$id) {
								\$this->Session->setFlash ( __ ( 'Không tồn tại', true ) );
								\$this->redirect ( array (
										'action' => 'index' 
								) );
							}
							\$this->Estore_news->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$x = \$this->Estore_news->read ( null, \$id );
							\$this->set ( 'views', \$x );
							\$this->Estore_news->setDataEshop(\$hostname,\$username,\$password,\$databasename);
						
							\$this->set ( 'list_other', \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => \$x ['Estore_news'] ['category_id'],
											'Estore_news.id <>' => \$id 
									),
									'limit' => 10 
							) ) );
						
						}
						function searchnews(\$name_search = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
							//set data news eshop	
							\$this->Estore_news->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							\$title = \$_POST ['name_search'];
							
							\$this->set ( 'listsearch', \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.title LIKE' => '%' . \$title . '%' 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 7 
							) ) );
						}
						function thongtin() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->set ( 'shopname', \$nameeshop );
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$this->Estore_settings->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$x = \$this->Estore_settings->read ( null, 1 );
// 							pr(\$x);
							\$this->set ( 'views', \$x );
						}
                        // +++++++++++++++++++++++++++++++++++++Comments+++++++++++++++++++++++++++++++++++++++++++++++++++++++
						function indexcommentstwo() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_comments.status' => 1 
									),
									'limit' => '4',
									'order' => 'Estore_comments.id DESC' 
							);
							\$this->set ( 'comment', \$this->paginate ( 'Estore_comments', array () ) );
						}
						function indexcomments() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->set ( 'shopname', \$nameeshop );
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							\$this->Estore_comments->setDataEshop(\$hostname,\$username,\$password,\$databasename);
								
							\$this->paginate = array (
									'conditions' => array (
											'Estore_comments.status' => 1 
									),
									'limit' => '4',
									'order' => 'Estore_comments.id DESC' 
							);
							\$this->set ( 'comment', \$this->paginate ( 'Estore_comments', array () ) );
						}
						
						function addcomments() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							if (! empty ( \$this->data )) {
								// if(\$this->Session->read('security_code')==\$_POST['security']){
								
								\$data ['Estore_comments'] = \$this->data ['Estore_comments'];
								if (\$this->Estore_comments->save ( \$data ['Estore_comments'] )) {
									\$this->Session->setFlash ( __ ( 'Thêm mới comments thành công', true ) );
									// \$this->redirect(array('action' => 'index'));
									echo '<script language=\"javascript\"> location.href=\"' . DOMAIN .\$this->shopname . '/indexcomments\";</script>';
								} else {
									\$this->Session->setFlash ( __ ( 'Thêm mơi comments thất bại. Vui long thử lại', true ) );
								}
								
								// }
								/*
								 * if(\$this->Session->read('security_code')!=\$_POST['security']){ echo \"<script>alert('\".json_encode('Ban nhập không đúng mã bảo vệ !').\"');</script>\"; echo \"<script>history.back(-1);</script>\"; }
								 */
							}
						}
						// +++++++++++++++++++++++++Contacts+++++++++++++++++++++++++++++++++++++++++++++++
						function sendcontacts() {
							\$nameeshop = \$this->shopname;
							\$shoparr = \$this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => \$nameeshop,
											'Shop.status' => 1
									),
									'fields' => array (
											'Shop.id',
											'Shop.created',
											'Shop.databasename',
											'Shop.username',
											'Shop.password',
											'Shop.hostname',
											'Shop.ipserver'
									)
							) );
								
							//++++++++++Connect  data +++++++++++++++++
							foreach(\$shoparr as \$shop){
								\$databasename = \$shop['Shop']['databasename'];
								\$password = \$shop['Shop']['password'];
								\$username = \$shop['Shop']['username'];
								\$hostname = \$shop['Shop']['hostname'];
								\$shop_id = \$shop['Shop']['id'];
									
							}
								
							\$this->set ( 'shopname', \$nameeshop );
							\$message= \"\";
							\$this->set('message',\$message);
							
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET NAMES 'utf8'\" );
							mysql_query ( \"SET character_set_client=utf8\" );
							mysql_query ( \"SET character_set_connection=utf8\" );
							\$this->Estore_settings->setDataEshop(\$hostname,\$username,\$password,\$databasename);
							\$x = \$this->Estore_settings->read ( null, 1 );
							
							if (isset ( \$_POST ['name'] )) {
								\$name = trim(\$_POST ['name']);
								\$mobile = \$_POST ['phone'];
								\$email = trim(\$_POST ['email']);
								\$title = trim(\$_POST ['title']);
								\$content = trim(\$_POST ['content']);
								
								\$data = array(
										'estore_id'=>\$x['Estore_settings']['estore_id'],
									    'name'=>\$name,
										'email'=>\$email,
										'title'=>\$title,
										'content'=>\$content
								);
								
								if(!empty(\$data)) {
									\$this->Estore_contacts->setDataEshop(\$hostname,\$username,\$password,\$databasename);
									if(\$this->Estore_contacts->save(\$data))
									{
										\$resultemail = \$this->smtpmailer(\$email,'alatcas1@gmail.com','FREEMOBIWEB.MOBI',\$x['Estore_settings']['title'],\$content);
										if (\$resultemail ==1)
										{
											//echo '<script language=\"javascript\"> alert(\"Gửi mail thành công\"); location.href=\"' . DOMAIN .\$this->shopname. '\";</script>';
											\$message= \"succesfuly\";
											\$this->set('message',\$message);
										}
										else
										{
											//echo '<script language=\"javascript\"> alert(\"gửi mail không thành công\"); </script>';
											\$this->set('message',\$resultemail);
										}
									}
								}
			                   
								
							}
						}
						
				  function smtpmailer(\$to, \$from, \$from_name, \$subject, \$body) {
					       //++++++++ include PhpMailler +++++++++++
							\$libraryPhpMailer = ROOT.'/PhpMailer/';
							\$filename = \$libraryPhpMailer.'class.phpmailer.php';
							if(file_exists(\$filename))
							   include(\$filename);
							global \$error;
					        \$mail = new PHPMailer();
					        \$mail->IsSMTP();
					        \$mail->CharSet = \"utf-8\";
					        \$mail->SMTPDebug = 0;
					        \$mail->SMTPAuth = true;
					        \$mail->SMTPSecure = 'ssl';
					        \$mail->Host = 'smtp.gmail.com';
					        \$mail->Port = 465;
					        \$mail->Username = GUSER;
					        \$mail->Password = GPWD;
					        \$mail->SetFrom(\$from, \$from_name);
					        \$mail->Subject = \$subject;
					        \$mail->Body = \$body;
					        \$mail->AddAddress(\$to);
					        if (!\$mail->Send()) {
					            \$error = 'Gởi mail bị lỗi: ' . \$mail->ErrorInfo;
					            return false;
					        } else {
					            \$error = 'thư của bạn đã được gởi đi ';
					            return true;
					        }
					    }
						
						
						
						function dathangcontacts() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/estorecreatnanedata';
							\$this->set ( 'title_for_layout', 'e-shop' );
							
							mysql_query ( \"SET NAMES 'utf8'\" );
							mysql_query ( \"SET character_set_client=utf8\" );
							mysql_query ( \"SET character_set_connection=utf8\" );
							// \$x=\$this->Helps->read(null,1);
							if (isset ( \$_SESSION ['shopingcart'] )) {
								\$shopingcart = \$_SESSION ['shopingcart'];
								\$this->set ( compact ( 'shopingcart' ) );
							} else {
								echo '<script language=\"javascript\"> alert(\"Chua co san pham nao trong gio hang\"); window.location.replace(\"' . DOMAIN . '\"); </script>';
							}
							if (isset ( \$_POST ['name'] )) {
								\$name = \$_POST ['name'];
								\$mobile = \$_POST ['phone'];
								\$email = \$_POST ['email'];
								\$title = \$_POST ['title'];
								\$content = \$_POST ['content'];
								
								\$images = \$_POST ['images'];
								\$product_name = \$_POST ['product_name'];
								\$product_sl = \$_POST ['product_sl'];
								\$price = \$_POST ['price'];
								\$total = \$_POST ['total'];
								\$this->Email->from = \$name . '<' . \$email . '>';
								\$this->Email->to = '';
								\$this->Email->subject = \$title;
								\$this->Email->template = 'default';
								\$this->Email->sendAs = 'both';
								\$this->set ( 'name', \$name );
								\$this->set ( 'mobile', \$mobile );
								\$this->set ( 'email', \$email );
								\$this->set ( 'content', \$content );
								
								\$this->set ( 'images', \$images );
								\$this->set ( 'product_name', \$product_name );
								\$this->set ( 'product_sl', \$product_sl );
								\$this->set ( 'price', \$price );
								\$this->set ( 'total', \$total );
								
								\$this->set ( 'sang', array (
										'images',
										'product_name',
										'product_sl',
										'price',
										'total' 
								) );
								
								if (\$this->Email->send ()) {
									\$this->Session->setFlash ( __ ( 'Thêm mới danh mục thành công', true ) );
									echo '<script language=\"javascript\"> alert(\"Gửi mail thành công\"); </script>';
									unset ( \$_SESSION ['shopingcart'] );
									echo '<script language=\"javascript\">location.href=\"' . DOMAIN . '\";</script>';
								} else
									\$this->Session->setFlash ( __ ( 'Thêm mơi danh mục thất bại. Vui long thử lại', true ) );
								echo '<script language=\"javascript\"> alert(\"gửi mail không thành công\"); location.href=\"' . DOMAIN . '\";</script>';
							}
						}
					 }
				           \n";
						$stringData .= "?>\n";
						fwrite ( $fh, $stringData );
						fclose ( $fh );
						
						$fromfile = DOCUMENT_ROOT . 'app/controllers/estore_controller.php';
						$tofile = DOCUMENT_ROOT . 'app/controllers/' . $project_name. '_controller.php';
							
						if (file_exists ( $tofile )) {
							return $dir_and_name_estore = "Tên gian hàng đã tồn tại";
							//exit ();
						}
						copy ( $fromfile, $tofile );
							
						return $controller_estore ="SucessFullController".$layout_code;
						break;
					}
			
			default:
				{
				       return $controller_estore = Null;
						break;
				}
		}
	}
	
	//++++++++++++++++++++++++++++++++++++
	/*
	 * checkLanguageCode :$language_code 
	 * Return : $sql + langue 
	*/
	function checkLanguageCode($namedatabase,$project_name,$language_code,$layout_code,$shop_id,$username ,$password)
	{
		$sql_langue = Null ;
		//$namedatabase = $project_name.'_'.$layout_code;
		$languagecode_layoutcode = $layout_code.'_'.$language_code;
		
// 		CakeLog::write('debug', '/**********start function checkLanguageCode *************/');
// 		CakeLog::write('debug', 'namedatabase: '.$namedatabase);
// 		CakeLog::write('debug', 'project_name: '.$project_name);
// 		CakeLog::write('debug', 'language_code: '.$language_code);
// 		CakeLog::write('debug', 'languagecode_layoutcode: '.$languagecode_layoutcode);
// 		CakeLog::write('debug', 'layout_code: '.$layout_code);
// 		CakeLog::write('debug', 'shop_id: '.$shop_id);
// 		CakeLog::write('debug', 'username: '.$username);
// 		CakeLog::write('debug', 'password: '.$password);
// 		CakeLog::write('debug', '/**********end function checkLanguageCode *************/');
				
		
		if($languagecode_layoutcode !='')
		{
			switch ($languagecode_layoutcode)
			{  
				case "50000568_vi" :
				case "50000568_en" :
					{
						$arrSql = array();
						if($username ==='' and $password === '' )
						{
							$arrSql[]="CREATE DATABASE IF NOT EXISTS `".$namedatabase."` /*!40100 DEFAULT CHARACTER SET utf8 */;";
							$arrSql[]="USE `".$namedatabase."`;";
							CakeLog::write('debug', 'creat datbase in localhost password :'.$password.'va username :'.$username);
						}
						
						$arrSql = array();
						if($username ==='' and $password === '' )
						{
							$arrSql[]="CREATE DATABASE IF NOT EXISTS `".$namedatabase."` /*!40100 DEFAULT CHARACTER SET utf8 */;";
							$arrSql[]="USE `".$namedatabase."`;";
						}
						
						
						$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_advertisements` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `name` varchar(256) CHARACTER SET utf8 NOT NULL,
  `link` varchar(256) CHARACTER SET ucs2 NOT NULL,
  `images` varchar(256) CHARACTER SET utf8 NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `status` int(2) NOT NULL,
  `display` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;";
						
						
						$arrSql[] ="INSERT INTO `estore_advertisements` (`id`, `estore_id`, `name`, `link`, `images`, `created`, `modified`, `status`, `display`) VALUES
						(25,$shop_id, 'cong ty abc', 'http://zing.vn', 'img/gallery/88654b0d4c2e2d7b8a4fd519f870c2b3.jpg', '2011-10-03', '2012-09-14', 1, 1),
						(24,$shop_id, 'quang cao', 'http://dantri.com.vn', 'img/gallery/19c4d76ab1090e42cd476cf7974f419c.jpg', '2011-10-03', '2012-09-14', 1, 2),
						(26,$shop_id, 'cong ty abc', 'http://zing.vn', 'img/gallery/aed5ce1f0358efc5b80877da0fd817d8.jpg', '2011-10-03', '2012-09-14', 1, 0),
						(27,$shop_id, 'zx', 'http://agribank.com.vn', 'img/gallery/69dbb1013ad45d844e128bd7facea6ee.jpg', '2012-09-14', '2012-09-14', 1, 2),
						(28,$shop_id, 'zx', 'http://agribank.com.vn', 'img/gallery/69dbb1013ad45d844e128bd7facea6ee.jpg', '2012-09-14', '2012-09-14', 1, 2),
						(29,$shop_id, 'quang cao', 'http://truongthanhauto.com.vn', 'img/gallery/69dbb1013ad45d844e128bd7facea6ee.jpg', '2012-09-14', '2012-09-14', 1, 2),
						(30,$shop_id, 'asdasd', 'http://duhocdailoan.info', 'img/gallery/8dc8529c47186151846ae23b345e835b.jpg', '2012-09-14', '2012-09-14', 1, 3),
						(31,$shop_id, 'asdsd', 'http://dantri.com.vn', 'img/gallery/1cf5b8f4b563947b0c3b8c29142215c9.jpg', '2012-09-14', '2012-09-14', 1, 3),
						(32,$shop_id, 'asdasd', 'http://zing.vn', 'img/gallery/8dc8529c47186151846ae23b345e835b.jpg', '2012-09-14', '2012-09-14', 1, 3);";
						
						$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_albums` (
  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
  `tt` int(10) DEFAULT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `status` int(2) NOT NULL,
  `name_eg` varchar(255) DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=207 DEFAULT CHARSET=utf8;";
						
						$arrSql[] ="INSERT INTO `estore_albums` (`id`, `estore_id`, `tt`, `parent_id`, `lft`, `rght`, `name`, `created`, `modified`, `status`, `name_eg`, `images`) VALUES
						(204,$shop_id, NULL, NULL, 1, 2, 'Ảnh khánh thành dây truyền mới', '2012-05-07', '2012-06-18', 1, 'Picture of new line inauguration', 'img/upload/product/2a1bd4f22b63ff775ad0cc8db96591aa.jpg'),
						(206,$shop_id, NULL, NULL, 3, 4, 'Họp ngày 30/04/2012', '2012-05-08', '2012-06-18', 1, 'on 30th April, 2012', 'img/upload/product/102e31ae3f441fbcb391f9e5a26bcbb9.jpg');";
						
						$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_answerquestions` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `name` varchar(256) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `mobile` varchar(256) CHARACTER SET utf8 NOT NULL,
  `address` varchar(225) CHARACTER SET utf8 NOT NULL,
  `title` varchar(225) CHARACTER SET utf8 NOT NULL,
  `introduction` text CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `answer` text CHARACTER SET utf8 NOT NULL,
  `created` datetime NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;";
						
						
						$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_banners` (
  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
  `name` varchar(250) NOT NULL,
  `images` varchar(250) NOT NULL,
  `created` datetime NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;";
						
						
						$arrSql[] ="INSERT INTO `estore_banners` (`id`, `estore_id`, `name`, `images`, `created`, `status`) VALUES
						(1,$shop_id, 'banner', 'img/gallery/af69e2816dec568215d831d8457b36eb.jpg', '2011-10-02 18:16:41', 1);";
						
						$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_categories` (
  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
  `tt` int(10) DEFAULT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `name_en` varchar(256) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `status` int(2) NOT NULL,
  `images` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=229 DEFAULT CHARSET=utf8;";
						
						
						$arrSql[] ="INSERT INTO `estore_categories` (`id`, `estore_id`, `tt`, `parent_id`, `lft`, `rght`, `name`, `name_en`, `created`, `modified`, `status`, `images`, `alias`) VALUES
						(146,$shop_id, 0, 224, 16, 17, 'GIỚI THIỆU', 'ABOUT US', '2011-09-27', '2012-09-14', 1, '', 'gioi-thieu'),
						(156,$shop_id, 3, 224, 2, 7, 'KHUYẾN MÃI', 'PROMOTION', '2011-09-27', '2012-09-14', 1, '', 'khuyen-mai'),
						(224,$shop_id, NULL, NULL, 1, 18, 'SẢN PHẨM', 'PRODUCT', '2012-07-23', '2012-09-14', 1, '', 'danh-muc-tin-tuc-dich-vu-tu-van'),
						(225,$shop_id, 4, 224, 14, 15, 'TUYỂN DỤNG', 'RECRUITMENT', '2012-07-23', '2012-09-14', 1, '', 'tuyen-dung'),
						(226,$shop_id, 1, 224, 8, 9, 'DỊCH VỤ', 'SERVICE', '2012-07-23', '2012-09-14', 1, '', 'dich-vu'),
						(227,$shop_id, 2, 224, 10, 11, 'TƯ VẤN', 'CONSULTANCY', '2012-07-23', '2012-09-14', 1, '', 'tu-van'),
						(228,$shop_id, 5, 224, 12, 13, 'TRỢ GIÚP', 'HELP', '2012-07-23', '2012-09-14', 1, '', 'tro-giup');";
						
						$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_catproducts` (
  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
  `parent_id` int(10) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `name_en` varchar(250) CHARACTER SET ucs2 NOT NULL,
  `created` date NOT NULL,
  `modified` datetime NOT NULL,
  `status` int(2) NOT NULL,
  `char` int(10) DEFAULT NULL,
  `images` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=143 DEFAULT CHARSET=latin1;";
						
						$arrSql[] ="INSERT INTO `estore_catproducts` (`id`, `estore_id`, `parent_id`, `lft`, `rght`, `name`, `name_en`, `created`, `modified`, `status`, `char`, `images`, `alias`) VALUES
						(141,$shop_id, 140, 5, 6, 'cap3', '', '2014-08-29', '2014-08-29 13:20:46', 1, NULL, '', 'cap3'),
						(139,$shop_id, 124, 3, 8, 'cap 1', '', '2014-08-29', '2014-08-29 13:20:21', 1, NULL, '', 'cap-1'),
						(140,$shop_id, 139, 4, 7, 'cap2', '', '2014-08-29', '2014-08-29 13:20:35', 1, NULL, '', 'cap2'),
						(136,$shop_id, 130, 32, 33, 'Accesories', 'Accesories', '2014-08-27', '2014-08-27 10:49:16', 1, NULL, '', 'accesories'),
						(134,$shop_id, 130, 28, 29, 'Shoes', 'Shoes', '2014-08-27', '2014-08-27 10:48:42', 1, NULL, '', 'shoes'),
						(135,$shop_id, 130, 30, 31, 'Shirts', 'Shirts', '2014-08-27', '2014-08-27 10:48:54', 1, NULL, '', 'shirts'),
						(133,$shop_id, 130, 26, 27, 'Jumpers', 'Jumpers', '2014-08-27', '2014-08-27 10:48:28', 1, NULL, '', 'jumpers'),
						(132,$shop_id, 130, 24, 25, 'Jackets', 'Jackets', '2014-08-27', '2014-08-27 10:48:15', 1, NULL, '', 'jackets'),
						(130,$shop_id, 0, 21, 34, 'Mens', 'Mens', '2014-08-27', '2014-08-27 10:47:30', 1, NULL, '', 'mens'),
						(131,$shop_id, 130, 22, 23, 'T-Shirts', 'T-Shirts', '2014-08-27', '2014-08-27 10:47:58', 1, NULL, '', 't-shirts'),
						(129,$shop_id, 123, 18, 19, 'Accessories', 'Accessories', '2014-08-27', '2014-08-27 10:46:15', 1, NULL, '', 'accessories'),
						(128,$shop_id, 123, 16, 17, 'Tops', 'Tops', '2014-08-27', '2014-08-27 10:46:04', 1, NULL, '', 'tops'),
						(127,$shop_id, 123, 14, 15, 'Trousers', 'Trousers', '2014-08-27', '2014-08-27 10:45:54', 1, NULL, '', 'trousers'),
						(125,$shop_id, 123, 10, 11, 'Dresses', 'Dresses', '2014-08-27', '2014-08-27 10:45:26', 1, NULL, '', 'dresses'),
						(126,$shop_id, 123, 12, 13, 'Bags', 'Bags', '2014-08-27', '2014-08-27 10:45:42', 1, NULL, '', 'bags'),
						(123,$shop_id, 0, 1, 20, 'Womens', 'Womens', '2014-08-27', '2014-08-27 10:34:33', 1, NULL, '', 'womens'),
						(124,$shop_id, 123, 2, 9, 'Shoes', 'Shoes', '2014-08-27', '2014-08-27 10:34:54', 1, NULL, '', 'shoes'),
						(142,$shop_id, 0, 35, 36, 'Gường Ngủ', 'Bedroom', '2014-09-02', '2014-09-02 03:40:26', 1, NULL, '', 'guong-ngu');";
						
						$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `id_news` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;";
						
						
						$arrSql[] ="INSERT INTO `estore_comments` (`id`, `estore_id`, `title`, `name`, `content`, `id_news`, `user_id`, `email`, `created`, `status`) VALUES
						(67,$shop_id, '', 'Nguyễn hải', 'Chất lượng moto rất tốt', 0, 0, 'hai@gmail.com', '2012-07-26 01:25:36', 1),
						(66,$shop_id, '', 'Nguyễn Nam', 'Kiểu dáng thật tuyệt', 0, 0, 'nguyennam@gmail.com', '2012-07-26 01:17:16', 1),
						(68,$shop_id, '', 'Nguyễn Thanh Tùng', 'Tôi muốn mua xe iata xin hướng dẫn cho tôi', 0, 0, 'nt2ungvn@gmail.com', '2012-07-26 01:38:49', 1),
						(69,$shop_id, '', 'Hồ Hoài', 'Chất lượng của công ty phục vụ rất rốt!', 0, 0, 'hohoai@yahoo.com', '2012-07-26 02:24:11', 0),
						(70,$shop_id, '', 'Hương', 'Các bạn thử tới công ty nhé\', ở nơi này có rất nhiều cảnh đẹp. Con người rất ôn hòa!', 0, 0, 'huong86@yahoo.com', '2012-07-26 02:29:13', 1),
						(73,$shop_id, '', 'Hoàng Phúc', 'Hoàng Phúc', 0, 0, 'phuca4@gmail.com', '2014-07-27 03:04:51', 1),
						(74,$shop_id, '', 'Hay đó nhé', 'Uh hay Lắm đó', 0, 0, 'phuca4@gmail.com', '2014-07-27 03:06:08', 1);";
						
						$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_contacts` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `company` varchar(200) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `content_send` text,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;";
						
						
						$arrSql[] ="INSERT INTO `estore_contacts` (`id`, `estore_id`, `name`, `email`, `mobile`, `fax`, `company`, `title`, `content`, `content_send`, `created`, `modified`, `status`) VALUES
						(4,$shop_id, 'Hoàng Công Phúc', 'phua4@gmail.com', '01688504263', '09487547584', 'Công ty abc', 'Chúc may mắn', 'dang test mail', '<p>\r\n	you are me and i am you</p>\r\n', '2011-07-04', '2011-07-04', 1),
						(5,$shop_id, 'hoang conm phuc', 'phuca4@gmail.com', '', NULL, NULL, 'testting mail', '', NULL, '2014-08-29', '2014-08-29', 0),
						(6,$shop_id, 'hosddffdf', 'phuca4@gmail.com', '', NULL, NULL, 'cvvcvc', '', NULL, '2014-08-29', '2014-08-29', 0),
						(7,$shop_id, 'hosddffdf', 'phuca4@gmail.com', '', NULL, NULL, 'cvvcvc', '', NULL, '2014-08-29', '2014-08-29', 0),
						(8,$shop_id, 'hoang conm phuc', 'phuca4@gmail.com', '', NULL, NULL, 'testfasasas', 'sdssdsdsds', NULL, '2014-08-29', '2014-08-29', 0),
						(9,$shop_id, 'tttttt', 'phuca4@gmail.com', '', NULL, NULL, 'tttttttt', 'rrrrrrrrrrrrrrrrrrrrrr', NULL, '2014-08-29', '2014-08-29', 0),
						(10,$shop_id, '', '', '', NULL, NULL, '', '', NULL, '2014-08-29', '2014-08-29', 0),
						(11,$shop_id, '', '', '', NULL, NULL, '', '', NULL, '2014-08-29', '2014-08-29', 0),
						(12,$shop_id, 'tetsststsas', 'phuca4@gmail.com', '', NULL, NULL, 'dsdsdsds', 'dsdsdsdsd', NULL, '2014-08-29', '2014-08-29', 0);";
						
						$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_galleries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `images` varchar(255) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `status` int(1) NOT NULL,
  `album_id` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;";
						
						
						$arrSql[] ="INSERT INTO `estore_galleries` (`id`, `estore_id`, `name`, `images`, `created`, `modified`, `status`, `album_id`) VALUES
						(67,$shop_id, 'anh 4', 'img/gallery/43d68f446ea7527b3dc6daddc6dc80df.jpg', '2012-06-19', '2012-06-19', 1, 204),
						(68,$shop_id, 'anh 5', 'img/gallery/2cf9661dce136d9f6ca6bfce24933a71.jpg', '2012-06-19', '2012-06-19', 1, 204),
						(64,$shop_id, 'anh 3', 'img/gallery/0452ded776f37827ca4887da56816ba8.jpg', '2012-05-08', '2012-06-19', 1, 206),
						(65,$shop_id, 'anh 2', 'img/gallery/e19281319ecba7282bcd8239287056d7.jpg', '2012-05-08', '2012-06-19', 1, 206),
						(66,$shop_id, 'Anh dep', 'img/gallery/7db208fcf126d1bb3cfee4c6b6bacf62.jpg', '2012-05-08', '2012-06-19', 1, 206);";
						
						$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_helps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `title` varchar(200) NOT NULL,
  `title_en` varchar(200) NOT NULL,
  `user_support` varchar(200) DEFAULT NULL,
  `user_yahoo` varchar(200) DEFAULT NULL,
  `user_skype` varchar(200) DEFAULT NULL,
  `user_mobile` varchar(20) DEFAULT NULL,
  `user_email` varchar(30) DEFAULT NULL,
  `hotline` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `user_yahoo1` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_yahoo2` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_yahoo3` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;";
						
						
						$arrSql[] ="INSERT INTO `estore_helps` (`id`, `estore_id`, `title`, `title_en`, `user_support`, `user_yahoo`, `user_skype`, `user_mobile`, `user_email`, `hotline`, `created`, `modified`, `status`, `user_yahoo1`, `user_yahoo2`, `user_yahoo3`) VALUES
						(7,$shop_id, 'Tư vấn', 'Support', 'Hoàng Công Phúc', 'adv.golbalmedia2', 'adv.golbalmedia2', '043.8281.768', 'phuca4@gmail.com', '043.8281.768', '2012-06-14 11:19:25', '2014-07-27 17:57:17', 1, 'phuca478', 'phuca478', 'phuca478'),
						(8,$shop_id, 'Kỹ Thuật', 'Technology', 'Mr. Phúc', 'adv.golbalmedia2', 'adv.golbalmedia2', '01229525955', 'phuca4@gmail.com', NULL, '2012-08-22 12:03:14', '2014-07-27 17:57:26', 1, 'phuca478', 'phuca478', 'phuca478');";
						
						$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_helpsd` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `name` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `name1` varchar(256) CHARACTER SET utf8 NOT NULL,
  `name2` varchar(256) CHARACTER SET utf8 NOT NULL,
  `title` varchar(256) CHARACTER SET utf8 NOT NULL,
  `sdt` varchar(20) DEFAULT NULL,
  `sdt1` varchar(20) NOT NULL,
  `sdt2` varchar(20) NOT NULL,
  `yahoo` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `yahoo1` varchar(256) CHARACTER SET utf8 NOT NULL,
  `yahoo2` varchar(256) NOT NULL,
  `skype` varchar(256) DEFAULT NULL,
  `skype1` varchar(256) CHARACTER SET utf8 NOT NULL,
  `skype2` varchar(256) CHARACTER SET utf8 NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;";
						
						$arrSql[] ="INSERT INTO `estore_helpsd` (`id`, `estore_id`, `name`, `name1`, `name2`, `title`, `sdt`, `sdt1`, `sdt2`, `yahoo`, `yahoo1`, `yahoo2`, `skype`, `skype1`, `skype2`, `created`, `modified`, `status`) VALUES
						(22,$shop_id, 'Kỹ thuật 1', '', '', '', NULL, '04 38515107', '09 38515108', NULL, 'vulamnguyen', 'vulamnguyen', 'haihs26', '', '', '2011-12-06 10:08:49', '2012-06-14 10:25:11', 1);";
						
						$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_infomationdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `infomations_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `images` varchar(250) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;";
						
						
						$arrSql[] ="INSERT INTO `estore_infomationdetails` (`id`, `estore_id`, `infomations_id`, `product_id`, `name`, `images`, `quantity`, `price`) VALUES
						(5,$shop_id, 36, 19, 'sp14', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_27.jpg', 1, 200),
						(6,$shop_id, 36, 20, 'sp13', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 1, 400),
						(7,$shop_id, 37, 20, 'sp13', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 2, 400),
						(8,$shop_id, 37, 19, 'sp14', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_27.jpg', 1, 200),
						(9,$shop_id, 38, 21, 'sp2', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_17.jpg', 1,$shop_id),
						(10,$shop_id, 38, 27, 'sp3', '/khieuvu/estoreadmin/webroot/upload/image/files/3.jpg', 1, 200),
						(11,$shop_id, 39, 27, 'sp3', '/khieuvu/estoreadmin/webroot/upload/image/files/3.jpg', 23, 200),
						(12,$shop_id, 40, 25, 'sp1', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_09.jpg', 3, 120),
						(13,$shop_id, 40, 26, 'sp43', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 1, 120000),
						(14,$shop_id, 41, 21, 'sp2', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_17.jpg', 2,$shop_id),
						(15,$shop_id, 41, 19, 'sp14', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_27.jpg', 1, 200),
						(16,$shop_id, 41, 26, 'sp43', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 1, 120000),
						(17,$shop_id, 42, 26, 'sp43', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 5, 120000),
						(18,$shop_id, 43, 32, 'sp565', '/khieuvu/estoreadmin/webroot/upload/image/files/bg_menu_20.jpg', 2, 20000),
						(19,$shop_id, 44, 64, 'sp5', '/estoreadmin/webroot/upload/image/files/vietsys_53.jpg', 1, 40000),
						(20,$shop_id, 44, 48, 'sp4', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1,$shop_id000),
						(21,$shop_id, 44, 61, 'sp2', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1,$shop_id000),
						(22,$shop_id, 44, 49, 'sp5', '/estoreadmin/webroot/upload/image/files/vietsys_53.jpg', 1, 40000),
						(23,$shop_id, 45, 63, 'sp4', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1,$shop_id000),
						(24,$shop_id, 46, 49, 'sp5', '/estoreadmin/webroot/upload/image/files/vietsys_53.jpg', 1, 40000),
						(25,$shop_id, 46, 50, 'sp6', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1,$shop_id000),
						(26,$shop_id, 47, 64, 'sp5', '/estoreadmin/webroot/upload/image/files/vietsys_53.jpg', 1, 40000),
						(27,$shop_id, 47, 78, 'sp4', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1,$shop_id000),
						(28,$shop_id, 48, 73, 'sp4', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1,$shop_id000),
						(29,$shop_id, 51, 243, 'Tủ chữ L nhiều ngăn', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', 1, 4500000),
						(30,$shop_id, 51, 245, 'Bếp cho quán ăn vừa và nhỏ', 'img/upload/3007b340574bcfd67cc42fd18c74d9b0.jpg', 1, 160000),
						(31,$shop_id, 52, 243, 'Tủ chữ L nhiều ngăn', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', 1, 4500000),
						(32,$shop_id, 52, 232, 'Bếp trung bình chữ I', 'img/upload/06e0bd26dd69280f9c14e247b49a3ec6.jpg', 2, 2300000),
						(33,$shop_id, 53, 218, 'Bến nhà hàng', 'img/upload/3007b340574bcfd67cc42fd18c74d9b0.jpg', 3, 3500000),
						(34,$shop_id, 53, 243, 'Tủ chữ L nhiều ngăn', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', 1, 4500000),
						(35,$shop_id, 54, 243, 'Tủ chữ L nhiều ngăn', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', 1, 4500000),
						(36,$shop_id, 54, 231, 'Bếp trung bình chữ I', 'img/upload/06e0bd26dd69280f9c14e247b49a3ec6.jpg', 3, 2300000);";
						
						$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_infomations` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `idnew` int(10) NOT NULL,
  `user_id` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT 'null',
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `address` varchar(300) CHARACTER SET utf8 NOT NULL,
  `mobile` int(15) DEFAULT NULL,
  `comment` varchar(300) CHARACTER SET utf8 NOT NULL,
  `deal` text CHARACTER SET utf8,
  `company` varchar(255) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `fax` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `country` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `datereturn` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `fullname_male` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `fullname_female` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `questions_day` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `wedding_day` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `title_question` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `wedding_title` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `name_product` varchar(250) NOT NULL,
  `images` varchar(250) NOT NULL,
  `sl` varchar(250) NOT NULL,
  `price` varchar(250) NOT NULL,
  `total` varchar(250) NOT NULL,
  `orther` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `created` datetime NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;";
						
						$arrSql[] ="INSERT INTO `estore_infomations` (`id`, `estore_id`, `idnew`, `user_id`, `name`, `email`, `address`, `mobile`, `comment`, `deal`, `company`, `phone`, `fax`, `country`, `datereturn`, `fullname_male`, `fullname_female`, `questions_day`, `wedding_day`, `title_question`, `wedding_title`, `name_product`, `images`, `sl`, `price`, `total`, `orther`, `created`, `status`) VALUES
						(71,$shop_id, 0, 'id395142', '', '', '', NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '58000', NULL, '2014-08-31 18:04:15', 0),
						(70,$shop_id, 0, '17', 'admin', '', '', NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '58000', NULL, '2014-08-31 18:01:40', 0),
						(68,$shop_id, 0, '17', 'admin', '', '', NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '499000', NULL, '2014-08-31 16:09:52', 0),
						(69,$shop_id, 0, '17', 'admin', '', '', NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '58000', NULL, '2014-08-31 16:11:57', 0),
						(67,$shop_id, 0, '17', 'admin', '', '', NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '58000', NULL, '2014-08-31 16:05:06', 0),
						(66,$shop_id, 0, '17', 'admin', '', '', NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '38000', NULL, '2014-08-31 16:01:21', 0),
						(65,$shop_id, 0, 'id474793', 'zxzx', 'zxz', 'xzxz', NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '72000', NULL, '2014-08-31 15:59:42', 0),
						(64,$shop_id, 0, 'id770539', '', '', '', NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '140000', NULL, '2014-08-31 15:59:02', 0),
						(63,$shop_id, 0, 'id674042', 'phuassdn', 'phuca4@gmail.com', 'Ha Noi', 978656787, '', NULL, '', '0978656787', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '228000', NULL, '2014-08-30 12:13:07', 0),
						(62,$shop_id, 0, 'id730652', 'ghh', 'phuca4@gmail.com', 'Ha Noi', 997787878, '', NULL, '', '0997787878', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '174000', NULL, '2014-08-30 11:50:49', 0);";
						
						$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_manufacturers` (
  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
  `parent_id` int(10) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `created` date NOT NULL,
  `modified` datetime NOT NULL,
  `status` int(2) NOT NULL,
  `char` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=271 DEFAULT CHARSET=latin1;";
						
						$arrSql[] ="INSERT INTO `estore_manufacturers` (`id`, `estore_id`, `parent_id`, `lft`, `rght`, `name`, `created`, `modified`, `status`, `char`) VALUES
						(135,$shop_id, NULL, 1, 28, 'Rigth', '2012-05-18', '2012-09-13 17:55:06', 1, NULL),
						(136,$shop_id, NULL, 29, 62, 'Toyota', '2012-05-18', '2012-06-04 06:57:18', 1, NULL),
						(137,$shop_id, NULL, 63, 80, 'Daewoo', '2012-05-18', '2012-06-21 06:25:09', 1, NULL),
						(138,$shop_id, NULL, 81, 92, 'Ford', '2012-05-18', '2012-06-19 13:11:22', 1, NULL),
						(139,$shop_id, NULL, 93, 116, 'BMW', '2012-05-18', '2012-05-18 13:50:13', 1, NULL),
						(140,$shop_id, NULL, 117, 130, 'Nissan', '2012-05-18', '2012-05-18 13:50:25', 1, NULL),
						(141,$shop_id, NULL, 131, 144, 'Suzuki', '2012-05-18', '2012-05-18 13:50:51', 1, NULL),
						(142,$shop_id, NULL, 145, 168, 'Audi', '2012-05-24', '2012-05-24 08:07:17', 1, NULL),
						(143,$shop_id, NULL, 169, 184, 'Mitsubishi', '2012-05-24', '2012-05-24 08:08:10', 1, NULL),
						(144,$shop_id, NULL, 185, 200, 'Kia', '2012-05-24', '2014-07-27 10:05:08', 1, NULL),
						(145,$shop_id, NULL, 201, 214, 'Ford', '2012-05-24', '2012-06-21 06:11:02', 0, NULL),
						(146,$shop_id, NULL, 215, 230, 'Hyundai', '2012-05-24', '2012-06-19 13:00:19', 1, NULL),
						(148,$shop_id, NULL, 231, 244, 'Mercedes ', '2012-05-28', '2012-05-28 07:49:40', 1, NULL);";
						
						$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_news` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `title_en` varchar(256) NOT NULL,
  `introduction` text NOT NULL,
  `introduction_en` text NOT NULL,
  `content` text,
  `content_en` text NOT NULL,
  `images` varchar(256) NOT NULL,
  `images_en` varchar(256) NOT NULL,
  `category_id` int(11) NOT NULL,
  `source` varchar(200) NOT NULL,
  `view` int(50) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` int(1) DEFAULT '0',
  `hotnew` tinyint(4) DEFAULT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=128 DEFAULT CHARSET=utf8;";
						
						
						$arrSql[] ="INSERT INTO `estore_news` (`id`, `estore_id`, `user_id`, `title`, `title_en`, `introduction`, `introduction_en`, `content`, `content_en`, `images`, `images_en`, `category_id`, `source`, `view`, `created`, `modified`, `status`, `hotnew`, `alias`) VALUES
						(115,$shop_id, 0, 'Cách thanh toán', 'Method of payment', '<p>\r\n	sfsdf</p>\r\n', '', '<p>\r\n	sdfsdf</p>\r\n', '', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', '', 156, '', 0, '2012-07-09 13:55:44', '2012-08-22 11:57:00', 1, NULL, ''),
						(95,$shop_id, 0, 'Đèn trung thu', 'Mid-autumn lamp', '<p>\r\n	<span style=\"font-size:14px;\">Những chiếc đ&egrave;n b&agrave;n trang tr&iacute; n&agrave;y l&agrave; sự kết hợp giữa chất liệu vả của chụp đ&egrave;n v&agrave; <a href=\"http://www.webhangdoc.com/hang-doc/gom-phong-thuy.html\" target=\"_blank\">gốm</a> sứ của phần th&acirc;n đ&egrave;n mang lại vẻ đẹp trang trọng, hiện đại v&agrave; tinh tế cho căn ph&ograve;ng của bạn. Bạn c&oacute; thể đặt đ&egrave;n trang tr&iacute; ở nhiều kh&ocirc;ng gian trong ng&ocirc;i nh&agrave;, từ ph&ograve;ng ngủ, ph&ograve;ng kh&aacute;ch đến ph&ograve;ng đọc s&aacute;ch, ph&ograve;ng giải tr&iacute; cho gia đ&igrave;nh. Đ&acirc;y l&agrave; một c&aacute;ch trang tr&iacute; nh&agrave; rất s&aacute;ng tạo thể hiện thẩm mỹ cao của gia chủ.<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	Đ&egrave;n trang tr&iacute; - <a href=\"http://www.shopdentrangtri.com/\" target=\"_blank\" title=\"\"><em><strong>den trang tri</strong></em></a> c&oacute; nhiều kiểu d&aacute;ng mẫu m&atilde; phần th&acirc;n đ&egrave;n cho bạn lựa chọn. C&aacute;c chất liệu <a href=\"http://www.webhangdoc.com/hang-doc/gom-phong-thuy.html\" target=\"_blank\">gốm</a> sứ l&agrave;m n&ecirc;n đ&egrave;n cũng kh&aacute; <a href=\"http://www.webhangdoc.com/\" target=\"_blank\">độc đ&aacute;o</a> v&agrave; lạ mắt. C&oacute; những chiếc đ&egrave;n c&oacute; phần th&acirc;n l&agrave; b&igrave;nh gốm x&ugrave; x&igrave; th&ocirc; mộc nhưng lại mang n&eacute;t c&aacute; t&iacute;nh v&agrave; phong c&aacute;ch. Cũng c&oacute; những chiếc đ&egrave;n c&oacute; phần th&acirc;n được l&agrave;m từ sứ cao cấp với m&agrave;u sắc tươi s&aacute;ng, trong trẻo. Độc đ&aacute;o hơn với những chiếc b&igrave;nh với v&acirc;n đ&aacute; rất đẹp v&agrave; sang trọng.</span></p>\r\n', '<p>\r\n	Những chiếc đ&egrave;n b&agrave;n trang tr&iacute; n&agrave;y l&agrave; sự kết hợp giữa chất liệu vả của chụp đ&egrave;n v&agrave; <a href=\"http://www.webhangdoc.com/hang-doc/gom-phong-thuy.html\" target=\"_blank\">gốm</a> sứ của phần th&acirc;n đ&egrave;n mang lại vẻ đẹp trang trọng, hiện đại v&agrave; tinh tế cho căn ph&ograve;ng của bạn. Bạn c&oacute; thể đặt đ&egrave;n trang tr&iacute; ở nhiều kh&ocirc;ng gian trong ng&ocirc;i nh&agrave;, từ ph&ograve;ng ngủ, ph&ograve;ng kh&aacute;ch đến ph&ograve;ng đọc s&aacute;ch, ph&ograve;ng giải tr&iacute; cho gia đ&igrave;nh. Đ&acirc;y l&agrave; một c&aacute;ch trang tr&iacute; nh&agrave; rất s&aacute;ng tạo thể hiện thẩm mỹ cao của gia chủ.</p>\r\n', '<p>\r\n	<span style=\"font-size:14px;\">Những chiếc đ&egrave;n b&agrave;n trang tr&iacute; n&agrave;y l&agrave; sự kết hợp giữa chất liệu vả của chụp đ&egrave;n v&agrave; <a href=\"http://www.webhangdoc.com/hang-doc/gom-phong-thuy.html\" target=\"_blank\">gốm</a> sứ của phần th&acirc;n đ&egrave;n mang lại vẻ đẹp trang trọng, hiện đại v&agrave; tinh tế cho căn ph&ograve;ng của bạn. Bạn c&oacute; thể đặt đ&egrave;n trang tr&iacute; ở nhiều kh&ocirc;ng gian trong ng&ocirc;i nh&agrave;, từ ph&ograve;ng ngủ, ph&ograve;ng kh&aacute;ch đến ph&ograve;ng đọc s&aacute;ch, ph&ograve;ng giải tr&iacute; cho gia đ&igrave;nh. Đ&acirc;y l&agrave; một c&aacute;ch trang tr&iacute; nh&agrave; rất s&aacute;ng tạo thể hiện thẩm mỹ cao của gia chủ.<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	Đ&egrave;n trang tr&iacute; - <a href=\"http://www.shopdentrangtri.com/\" target=\"_blank\" title=\"\"><em><strong>den trang tri</strong></em></a> c&oacute; nhiều kiểu d&aacute;ng mẫu m&atilde; phần th&acirc;n đ&egrave;n cho bạn lựa chọn. C&aacute;c chất liệu <a href=\"http://www.webhangdoc.com/hang-doc/gom-phong-thuy.html\" target=\"_blank\">gốm</a> sứ l&agrave;m n&ecirc;n đ&egrave;n cũng kh&aacute; <a href=\"http://www.webhangdoc.com/\" target=\"_blank\">độc đ&aacute;o</a> v&agrave; lạ mắt. C&oacute; những chiếc đ&egrave;n c&oacute; phần th&acirc;n l&agrave; b&igrave;nh gốm x&ugrave; x&igrave; th&ocirc; mộc nhưng lại mang n&eacute;t c&aacute; t&iacute;nh v&agrave; phong c&aacute;ch. Cũng c&oacute; những chiếc đ&egrave;n c&oacute; phần th&acirc;n được l&agrave;m từ sứ cao cấp với m&agrave;u sắc tươi s&aacute;ng, trong trẻo. Độc đ&aacute;o hơn với những chiếc b&igrave;nh với v&acirc;n đ&aacute; rất đẹp v&agrave; sang trọng.</span></p>\r\n', '<p>\r\n	Những chiếc đ&egrave;n b&agrave;n trang tr&iacute; n&agrave;y l&agrave; sự kết hợp giữa chất liệu vả của chụp đ&egrave;n v&agrave; <a href=\"http://www.webhangdoc.com/hang-doc/gom-phong-thuy.html\" target=\"_blank\">gốm</a> sứ của phần th&acirc;n đ&egrave;n mang lại vẻ đẹp trang trọng, hiện đại v&agrave; tinh tế cho căn ph&ograve;ng của bạn. Bạn c&oacute; thể đặt đ&egrave;n trang tr&iacute; ở nhiều kh&ocirc;ng gian trong ng&ocirc;i nh&agrave;, từ ph&ograve;ng ngủ, ph&ograve;ng kh&aacute;ch đến ph&ograve;ng đọc s&aacute;ch, ph&ograve;ng giải tr&iacute; cho gia đ&igrave;nh. Đ&acirc;y l&agrave; một c&aacute;ch trang tr&iacute; nh&agrave; rất s&aacute;ng tạo thể hiện thẩm mỹ cao của gia chủ.<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	Đ&egrave;n trang tr&iacute; - <a href=\"http://www.shopdentrangtri.com/\" target=\"_blank\" title=\"\"><em><strong>den trang tri</strong></em></a> c&oacute; nhiều kiểu d&aacute;ng mẫu m&atilde; phần th&acirc;n đ&egrave;n cho bạn lựa chọn. C&aacute;c chất liệu <a href=\"http://www.webhangdoc.com/hang-doc/gom-phong-thuy.html\" target=\"_blank\">gốm</a> sứ l&agrave;m n&ecirc;n đ&egrave;n cũng kh&aacute; <a href=\"http://www.webhangdoc.com/\" target=\"_blank\">độc đ&aacute;o</a> v&agrave; lạ mắt. C&oacute; những chiếc đ&egrave;n c&oacute; phần th&acirc;n l&agrave; b&igrave;nh gốm x&ugrave; x&igrave; th&ocirc; mộc nhưng lại mang n&eacute;t c&aacute; t&iacute;nh v&agrave; phong c&aacute;ch. Cũng c&oacute; những chiếc đ&egrave;n c&oacute; phần th&acirc;n được l&agrave;m từ sứ cao cấp với m&agrave;u sắc tươi s&aacute;ng, trong trẻo. Độc đ&aacute;o hơn với những chiếc b&igrave;nh với v&acirc;n đ&aacute; rất đẹp v&agrave; sang trọng.</p>\r\n', '/estoreadmin/webroot/upload/image/files/vietsys_71.jpg', 'img/upload/076e3caed758a1c18c91a0e9cae3368f.jpg', 156, '', 1, '2011-12-06 09:16:42', '2012-07-23 15:21:30', 1, NULL, NULL),
						(96,$shop_id, 0, 'Lộng lẫy đèn chùm', 'Splendid chandelier', '<p>\r\n	<b><span id=\"ctl00_ContentPlaceHolder1_NewsDetail1_lblSubContent\">Với kiểu d&aacute;ng thiết kế mới lạ, đ&egrave;n ch&ugrave;m ng&agrave;y nay mang lại vẻ mềm mại, sang trọng cho ng&ocirc;i nh&agrave;. Hầu hết c&aacute;c mẫu đ&egrave;n được thiết kế cầu kỳ với nhiều lớp đ&egrave;n, đ&aacute; trang tr&iacute;. Loại n&agrave;y gồm một b&oacute;ng ch&iacute;nh ở giữa s&aacute;ng nhất, c&aacute;c đ&egrave;n phụ được thiết kế xung quanh.</span></b></p>\r\n', '<p>\r\n	Enable luck with crystal chandeliersEnable luck with crystal chandeliers</p>\r\n', '<p>\r\n	<b><span id=\"ctl00_ContentPlaceHolder1_NewsDetail1_lblSubContent\">Với kiểu d&aacute;ng thiết kế mới lạ, đ&egrave;n ch&ugrave;m ng&agrave;y nay mang lại vẻ mềm mại, sang trọng cho ng&ocirc;i nh&agrave;. Hầu hết c&aacute;c mẫu đ&egrave;n được thiết kế cầu kỳ với nhiều lớp đ&egrave;n, đ&aacute; trang tr&iacute;. Loại n&agrave;y gồm một b&oacute;ng ch&iacute;nh ở giữa s&aacute;ng nhất, c&aacute;c đ&egrave;n phụ được thiết kế xung quanh.</span> </b></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<img alt=\"\" height=\"431\" src=\"http://www.denchum.net/Images/News/Sub/images/Picture1.jpg\" width=\"500\" /></p>\r\n<div>\r\n	Đ&egrave;n ch&ugrave;m rực rỡ với t&iacute;nh thẩm mỹ cao gi&uacute;p bạn t&ocirc; điểm cho ng&ocirc;i nh&agrave;</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	Tuy nhi&ecirc;n, thỉnh thoảng bạn vẫn bắt gặp kiểu đ&egrave;n ch&ugrave;m khổng lồ chỉ c&oacute; một b&oacute;ng. C&ograve;n lại l&agrave; phụ liệu đ&iacute;nh k&egrave;m, chủ yếu mang t&iacute;nh trang tr&iacute;. C&aacute;c kiểu đ&egrave;n n&agrave;y gi&uacute;p căn ph&ograve;ng trở n&ecirc;n duy&ecirc;n d&aacute;ng v&agrave; sang trọng hơn.</div>\r\n<div>\r\n	Đặc biệt chất liệu tạo n&ecirc;n c&aacute;c ch&ugrave;m đ&egrave;n rất quan trọng v&igrave; n&oacute; quyết định sự mềm mại v&agrave; n&eacute;t ri&ecirc;ng của từng kiểu đ&egrave;n. &Aacute;nh s&aacute;ng chỉ l&agrave; yếu tố phụ n&ecirc;n bạn phải thiết k&ecirc; th&ecirc;m c&aacute;c đ&egrave;n kh&aacute;c để lấy &aacute;nh s&aacute;ng cho ph&ograve;ng kh&aacute;ch.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<strong>Những lưu &yacute; khi lắp đặt đ&egrave;n ch&ugrave;m</strong></div>\r\n<div>\r\n	<img alt=\"\" height=\"267\" src=\"http://www.denchum.net/Images/News/Sub/images/Picture2.jpg\" width=\"500\" /></div>\r\n<div>\r\n	Đa dạng về kiểu d&aacute;ng, mẫu m&atilde;</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	Muốn bố tr&iacute; đ&egrave;n ch&ugrave;m, trần nh&agrave; phải cao từ 3m trở l&ecirc;n để kh&ocirc;ng g&acirc;y cảm gi&aacute;c vướng v&iacute;u, nặng nề. Kiểu đ&egrave;n cũng cần h&agrave;i ho&agrave; với c&aacute;c đ&egrave;n chiếu s&aacute;ng kh&aacute;c trong ph&ograve;ng.</div>\r\n<div>\r\n	Theo quan niệm phong thuỷ, kh&ocirc;ng n&ecirc;n lắp đ&egrave;n ch&ugrave;m trong ph&ograve;ng ngủ, nhất l&agrave; ph&iacute;a tr&ecirc;n giường. Nếu đ&egrave;n bằng chất liệu pha l&ecirc;, đ&aacute; thuỷ tinh, tốt nhất n&ecirc;n treo ở trung t&acirc;m nh&agrave; để t&iacute;ch tụ năng lượng dương cho căn ph&ograve;ng.</div>\r\n<div>\r\n	Theo Netfile</div>\r\n', '<p>\r\n	Enable luck with crystal chandeliersEnable luck with crystal chandeliersEnable luck with crystal chandeliersEnable luck with crystal chandeliersEnable luck with crystal chandeliers</p>\r\n', '/estoreadmin/webroot/upload/image/files/vietsys_68.jpg', 'img/upload/8969288f4245120e7c3870287cce0ff3.jpg', 156, '', 0, '2011-12-06 09:42:09', '2012-07-23 15:25:27', 1, NULL, NULL),
						(116,$shop_id, 0, 'About', 'About', '<p>\r\n	<span id=\"result_box\" lang=\"en\"><span title=\"Công ty TNHH thiết bị y tế và khoa học kỹ thuật Hà Nội được thành lập năm 2002 với lĩnh vực kinh doanh chính là: thiết bị y tế, thiết bị thẩm mỹ, thiết bị khoa học kỹ thuật, công nghệ và môi trường.\">Medical Equipment Co., Ltd. technical and scientific Hanoi was established in 2002 with main business areas are: medical device, aesthetic equipment, scientific equipment, technology and the environment.</span><br />\r\n	<br />\r\n	<span title=\"Tôn chỉ của chúng tôi:\">Our guiding principles:</span><br />\r\n	<br />\r\n	<span title=\"- Cung cấp tới tận tay khách hàng các sản phẩm có chất lượng và kỹ thuật cao trong ngành y tế và khoa học công nghệ môi trường với giá cả cạnh tranh nhất.\">- Provide end-customers with quality products and high technology in the health sector and environmental science and technology with the most competitive price.</span><br />\r\n	<br />\r\n	<span title=\"- Xây dựng và đào tạo một mạng lưới dịch vụ kỹ thuật sau bán hàng một cách hoàn hảo.\">- Develop and train a network of after-sales technical service perfectly.</span><br />\r\n	<br />\r\n	<span title=\"- Luôn giữ chữ “tín” và lấy lợi ích của khách hàng làm trọng.\">- Always keep the words &quot;credit&quot; and get the benefits of important customer.</span><br />\r\n	<br />\r\n	<span title=\"Sản phẩm Công ty cung cấp:\">The company offers products:</span><br />\r\n	<br />\r\n	<span title=\"- Máy soi cổ tử cung kỹ thuật số, monitor sản khoa, monitor theo dõi bệnh nhân đa thông số, hệ thống monitor trung tâm, máy cắt đốt cổ tử cung chuyên dụng, máy đo nồng độ bão hòa ô xy trong máu, bơm\">- Portable digital colposcopy, obstetrics monitor, monitor multi-parameter patient monitor, central monitor system, dedicated cervical ablation, measuring oxygen saturation in the blood, the pump </span><span title=\"tiêm điện, máy truyền dịch tự động của hãng GOLDWAY (US).,INC.\">power injection, its automatic infusion Goldway (U.S.)., INC.</span><br />\r\n	<br />\r\n	<span title=\"- Máy siêu âm đen trắng, siêu màu 4D các loại của hãng Fukuda- Nhật Bản\">- Ultrasound in black and white, super color 4D Its kind Fukuda, Japan</span><br />\r\n	<br />\r\n	<span title=\"- Máy áp lạnh cổ tử cung\">- Air pressure cervical cold</span><br />\r\n	<br />\r\n	<span title=\"- Điện não VIDEO EEG, DIGITAL EEG, điện tim của Tây Ban Nha\">- Electrical brain EEG VIDEO, DIGITAL EEG, ECG of Spain</span><br />\r\n	<br />\r\n	<span title=\"- Máy đo thính lực chuyên dụng của Tây Ban Nha\">- Dedicated audiometric of Spain</span><br />\r\n	<br />\r\n	<span title=\"- Máy đo bilirubin, hemoglobin sản xuất tại Nhật Bản\">- Bilirubin meter, hemoglobin production in Japan</span><br />\r\n	<br />\r\n	<span title=\"- Máy gây mê, máy thở, máy nghe tim thai, nội soi, điện tim, máy phát hiện vàng da.\">- Anesthesia machine, ventilator, fetal player, endoscopy, ECG, jaundice detector.</span><br />\r\n	<br />\r\n	<span title=\"- Máy xét nghiệm sinh hóa (bán tự động, tự động, tổng hợp), ELISA, dao mổ điện sản xuất tại Mỹ\">- Machine biochemical tests (semi-automatic, automatic, synthesis), ELISA, scalpels electricity produced in the U.S.</span><br />\r\n	<br />\r\n	<span title=\"- Máy xét nghiệm nước tiểu Cybow, Clinitek Status (Hàn Quốc, Anh)\">- Machine test urine Cybow, Clinitek Status (Korean, English)</span><br />\r\n	<br />\r\n	<span title=\"- Máy quang phổ UV/VIS - Nhật, tủ bảo quản dược phẩm, tủ trữ máu của Đức.\">- UV Spectrometer / VIS - Japan, pharmaceutical storage cabinets, storage cabinets German blood.</span><br />\r\n	<br />\r\n	<span title=\"- Đèn mổ (Thụy Sĩ), tủ sấy, nồi hấp (Đài Loan)...\">- Lamp (Switzerland), oven, autoclave (Taiwan) ...</span><br />\r\n	<br />\r\n	<span title=\"- Các loại thiết bị khoa học kỹ thuật chuyên dụng của Anh, Mỹ, Đức.\">- The specialized scientific and technical equipment in the UK, USA, Germany.</span><br />\r\n	<br />\r\n	<span title=\"- Các linh kiện thay thế cho các loại monitor theo dõi bệnh nhân, monitor sản khoa\">- The replacement parts for the type of monitor patient monitor, monitor obstetric</span><br />\r\n	<br />\r\n	<span title=\"Công ty có đội ngũ kỹ sư được đào tạo đúng chuyên ngành thiết bị y tế ở trong và ngoài nước.\">The company has a team of engineers who have been properly trained in medical equipment at home and abroad. </span><span title=\"Đội ngũ này không ngừng được nâng cao tay nghề thông qua các khoá đào tạo của các nhà sản xuất...\">This team constantly upgrade their skills through training of producers ...</span><br />\r\n	<br />\r\n	<span title=\"Với thế mạnh của mình, chúng tôi hy vọng rằng trong một tương lai gần, Công ty Công nghệ Quang Anh sẽ trở thành một đối tác truyền thống của Quý khách hàng với tư cách là một nhà cung cấp thiết bị y tế có giá cả\">With its strength, we hope that in the near future, the British Optical Technology Company will become a traditional partner of customers as a supplier of medical equipment pricing </span><span title=\"hợp lý nhất, chất lượng tốt nhất và dịch vụ sau bán hàng hoàn hảo.\">most affordable, best quality and perfect after-sales service.</span><br />\r\n	<br />\r\n	<span title=\"Khi cần mua thiết bị y tế- Đến với Công ty thiết bị y tế &amp; khoa học hà nội\">The need for a new medical device-Coming to medical &amp; scientific equipment hanoi</span></span></p>\r\n', '<p>\r\n	<span id=\"result_box\" lang=\"en\"><span title=\"Công ty TNHH thiết bị y tế và khoa học kỹ thuật Hà Nội được thành lập năm 2002 với lĩnh vực kinh doanh chính là: thiết bị y tế, thiết bị thẩm mỹ, thiết bị khoa học kỹ thuật, công nghệ và môi trường.\">Co., Ltd. medical equipment and scientific and technical Hanoi was established in 2002 with the main business areas: medical equipment, beauty equipment, scientific equipment, technology and environment.</span><br />\r\n	<br />\r\n	<span title=\"Tôn chỉ của chúng tôi:\">Our guiding principles:<br />\r\n	<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Cung cấp tới tận tay khách hàng các sản phẩm có chất lượng và kỹ thuật cao trong ngành y tế và khoa học công nghệ môi trường với giá cả cạnh tranh nhất.\">Hand to provide customers with quality products and high technology in the health and environmental science and technology with the most competitive prices.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Xây dựng và đào tạo một mạng lưới dịch vụ kỹ thuật sau bán hàng một cách hoàn hảo.\">Develop and train a network of technical service after the sale perfectly.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Luôn giữ chữ “tín” và lấy lợi ích của khách hàng làm trọng.\">Always keep the word &quot;credit&quot; and get the benefit of customer-focused.</span><br />\r\n	<br />\r\n	<span title=\"Sản phẩm Công ty cung cấp:\">Products The company offers:<br />\r\n	<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy soi cổ tử cung kỹ thuật số, monitor sản khoa, monitor theo dõi bệnh nhân đa thông số, hệ thống monitor trung tâm, máy cắt đốt cổ tử cung chuyên dụng, máy đo nồng độ bão hòa ô xy trong máu, bơm tiêm\">Colposcopy machine digital, monitor anesthesia, monitor patient monitor multiple parameters, the central monitor system, cervical ablation machine dedicated machine measurements of oxygen saturation levels in blood, syringes </span><span title=\"điện, máy truyền dịch tự động của hãng GOLDWAY (US).,INC.\">electric machine company infusion of automated GOLDWAY (U.S.)., INC.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy siêu âm đen trắng, siêu màu 4D các loại của hãng Fukuda- Nhật Bản\">Ultrasound machine black &amp; white, color 4D super types of firms Fukuda, Japan<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy áp lạnh cổ tử cung\">Machine cold pressure of the cervix<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Điện não VIDEO EEG, DIGITAL EEG, điện tim của Tây Ban Nha\">EEG EEG VIDEO, DIGITAL EEG, ECG of Spain<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy đo thính lực chuyên dụng của Tây Ban Nha\">Machinery specialized hearing test in Spain<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy đo bilirubin, hemoglobin sản xuất tại Nhật Bản\">Gauge bilirubin, hemoglobin production in Japan<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy gây mê, máy thở, máy nghe tim thai, nội soi, điện tim, máy phát hiện vàng da.\">Anesthesia machines, ventilators, air auscultation, endoscopy, ECG, jaundice detector.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy xét nghiệm sinh hóa (bán tự động, tự động, tổng hợp), ELISA, dao mổ điện sản xuất tại Mỹ\">Biochemical machine (semi-automatic, automatic, general), ELISA, electric knife made in USA<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy xét nghiệm nước tiểu Cybow, Clinitek Status (Hàn Quốc, Anh)\">Machine Cybow urine, Clinitek Status (Korean, English)<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy quang phổ UV/VIS - Nhật, tủ bảo quản dược phẩm, tủ trữ máu của Đức.\">Spectrophotometer UV / VIS - Japanese pharmaceutical storage cabinets, storage cabinets of German blood.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Đèn mổ (Thụy Sĩ), tủ sấy, nồi hấp (Đài Loan)...\">Lights (Switzerland), oven, steamer (Taiwan) ...<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Các loại thiết bị khoa học kỹ thuật chuyên dụng của Anh, Mỹ, Đức.\">The type of equipment dedicated science and technology in the UK, U.S., Germany.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Các linh kiện thay thế cho các loại monitor theo dõi bệnh nhân, monitor sản khoa\">Replacement parts for the type of monitor to track patients, monitor obstetric</span><br />\r\n	<br />\r\n	<span title=\"Công ty có đội ngũ kỹ sư được đào tạo đúng chuyên ngành thiết bị y tế ở trong và ngoài nước.\">The company has a team of engineers are properly trained specialized medical equipment at home and abroad. </span><span title=\"Đội ngũ này không ngừng được nâng cao tay nghề thông qua các khoá đào tạo của các nhà sản xuất...\">This team is constantly improving skills through training of manufacturers ...</span><br />\r\n	<br />\r\n	<span title=\"Với thế mạnh của mình, chúng tôi hy vọng rằng trong một tương lai gần, Công ty Công nghệ Quang Anh sẽ trở thành một đối tác truyền thống của Quý khách hàng với tư cách là một nhà cung cấp thiết bị y tế có giá cả\">With its strength, we hope that in the near future, Quang Anh Technology Company will become a traditional partner of customers as a supplier of medical equipment priced </span><span title=\"hợp lý nhất, chất lượng tốt nhất và dịch vụ sau bán hàng hoàn hảo.\">most logical, best quality and after sales service perfect.</span><br />\r\n	<br />\r\n	<span title=\"Khi cần mua thiết bị y tế- Đến với Công ty thiết bị y tế Quang Anh\">When you need to buy medical equipment-to the medical device company Quang Anh</span></span></p>\r\n', '<p>\r\n	<span id=\"result_box\" lang=\"en\"><span title=\"Công ty TNHH thiết bị y tế và khoa học kỹ thuật Hà Nội được thành lập năm 2002 với lĩnh vực kinh doanh chính là: thiết bị y tế, thiết bị thẩm mỹ, thiết bị khoa học kỹ thuật, công nghệ và môi trường.\">Medical Equipment Co., Ltd. technical and scientific Hanoi was established in 2002 with main business areas are: medical device, aesthetic equipment, scientific equipment, technology and the environment.</span><br />\r\n	<br />\r\n	<span title=\"Tôn chỉ của chúng tôi:\">Our guiding principles:</span><br />\r\n	<br />\r\n	<span title=\"- Cung cấp tới tận tay khách hàng các sản phẩm có chất lượng và kỹ thuật cao trong ngành y tế và khoa học công nghệ môi trường với giá cả cạnh tranh nhất.\">- Provide end-customers with quality products and high technology in the health sector and environmental science and technology with the most competitive price.</span><br />\r\n	<br />\r\n	<span title=\"- Xây dựng và đào tạo một mạng lưới dịch vụ kỹ thuật sau bán hàng một cách hoàn hảo.\">- Develop and train a network of after-sales technical service perfectly.</span><br />\r\n	<br />\r\n	<span title=\"- Luôn giữ chữ “tín” và lấy lợi ích của khách hàng làm trọng.\">- Always keep the words &quot;credit&quot; and get the benefits of important customer.</span><br />\r\n	<br />\r\n	<span title=\"Sản phẩm Công ty cung cấp:\">The company offers products:</span><br />\r\n	<br />\r\n	<span title=\"- Máy soi cổ tử cung kỹ thuật số, monitor sản khoa, monitor theo dõi bệnh nhân đa thông số, hệ thống monitor trung tâm, máy cắt đốt cổ tử cung chuyên dụng, máy đo nồng độ bão hòa ô xy trong máu, bơm\">- Portable digital colposcopy, obstetrics monitor, monitor multi-parameter patient monitor, central monitor system, dedicated cervical ablation, measuring oxygen saturation in the blood, the pump </span><span title=\"tiêm điện, máy truyền dịch tự động của hãng GOLDWAY (US).,INC.\">power injection, its automatic infusion Goldway (U.S.)., INC.</span><br />\r\n	<br />\r\n	<span title=\"- Máy siêu âm đen trắng, siêu màu 4D các loại của hãng Fukuda- Nhật Bản\">- Ultrasound in black and white, super color 4D Its kind Fukuda, Japan</span><br />\r\n	<br />\r\n	<span title=\"- Máy áp lạnh cổ tử cung\">- Air pressure cervical cold</span><br />\r\n	<br />\r\n	<span title=\"- Điện não VIDEO EEG, DIGITAL EEG, điện tim của Tây Ban Nha\">- Electrical brain EEG VIDEO, DIGITAL EEG, ECG of Spain</span><br />\r\n	<br />\r\n	<span title=\"- Máy đo thính lực chuyên dụng của Tây Ban Nha\">- Dedicated audiometric of Spain</span><br />\r\n	<br />\r\n	<span title=\"- Máy đo bilirubin, hemoglobin sản xuất tại Nhật Bản\">- Bilirubin meter, hemoglobin production in Japan</span><br />\r\n	<br />\r\n	<span title=\"- Máy gây mê, máy thở, máy nghe tim thai, nội soi, điện tim, máy phát hiện vàng da.\">- Anesthesia machine, ventilator, fetal player, endoscopy, ECG, jaundice detector.</span><br />\r\n	<br />\r\n	<span title=\"- Máy xét nghiệm sinh hóa (bán tự động, tự động, tổng hợp), ELISA, dao mổ điện sản xuất tại Mỹ\">- Machine biochemical tests (semi-automatic, automatic, synthesis), ELISA, scalpels electricity produced in the U.S.</span><br />\r\n	<br />\r\n	<span title=\"- Máy xét nghiệm nước tiểu Cybow, Clinitek Status (Hàn Quốc, Anh)\">- Machine test urine Cybow, Clinitek Status (Korean, English)</span><br />\r\n	<br />\r\n	<span title=\"- Máy quang phổ UV/VIS - Nhật, tủ bảo quản dược phẩm, tủ trữ máu của Đức.\">- UV Spectrometer / VIS - Japan, pharmaceutical storage cabinets, storage cabinets German blood.</span><br />\r\n	<br />\r\n	<span title=\"- Đèn mổ (Thụy Sĩ), tủ sấy, nồi hấp (Đài Loan)...\">- Lamp (Switzerland), oven, autoclave (Taiwan) ...</span><br />\r\n	<br />\r\n	<span title=\"- Các loại thiết bị khoa học kỹ thuật chuyên dụng của Anh, Mỹ, Đức.\">- The specialized scientific and technical equipment in the UK, USA, Germany.</span><br />\r\n	<br />\r\n	<span title=\"- Các linh kiện thay thế cho các loại monitor theo dõi bệnh nhân, monitor sản khoa\">- The replacement parts for the type of monitor patient monitor, monitor obstetric</span><br />\r\n	<br />\r\n	<span title=\"Công ty có đội ngũ kỹ sư được đào tạo đúng chuyên ngành thiết bị y tế ở trong và ngoài nước.\">The company has a team of engineers who have been properly trained in medical equipment at home and abroad. </span><span title=\"Đội ngũ này không ngừng được nâng cao tay nghề thông qua các khoá đào tạo của các nhà sản xuất...\">This team constantly upgrade their skills through training of producers ...</span><br />\r\n	<br />\r\n	<span title=\"Với thế mạnh của mình, chúng tôi hy vọng rằng trong một tương lai gần, Công ty Công nghệ Quang Anh sẽ trở thành một đối tác truyền thống của Quý khách hàng với tư cách là một nhà cung cấp thiết bị y tế có giá cả\">With its strength, we hope that in the near future, the British Optical Technology Company will become a traditional partner of customers as a supplier of medical equipment pricing </span><span title=\"hợp lý nhất, chất lượng tốt nhất và dịch vụ sau bán hàng hoàn hảo.\">most affordable, best quality and perfect after-sales service.</span><br />\r\n	<br />\r\n	<span title=\"Khi cần mua thiết bị y tế- Đến với Công ty thiết bị y tế &amp; khoa học hà nội\">The need for a new medical device-Coming to medical &amp; scientific equipment hanoi</span></span></p>\r\n', '<p>\r\n	<span id=\"result_box\" lang=\"en\"><span title=\"Công ty TNHH thiết bị y tế và khoa học kỹ thuật Hà Nội được thành lập năm 2002 với lĩnh vực kinh doanh chính là: thiết bị y tế, thiết bị thẩm mỹ, thiết bị khoa học kỹ thuật, công nghệ và môi trường.\">Co., Ltd. medical equipment and scientific and technical Hanoi was established in 2002 with the main business areas: medical equipment, beauty equipment, scientific equipment, technology and environment.</span><br />\r\n	<br />\r\n	<span title=\"Tôn chỉ của chúng tôi:\">Our guiding principles:<br />\r\n	<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Cung cấp tới tận tay khách hàng các sản phẩm có chất lượng và kỹ thuật cao trong ngành y tế và khoa học công nghệ môi trường với giá cả cạnh tranh nhất.\">Hand to provide customers with quality products and high technology in the health and environmental science and technology with the most competitive prices.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Xây dựng và đào tạo một mạng lưới dịch vụ kỹ thuật sau bán hàng một cách hoàn hảo.\">Develop and train a network of technical service after the sale perfectly.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Luôn giữ chữ “tín” và lấy lợi ích của khách hàng làm trọng.\">Always keep the word &quot;credit&quot; and get the benefit of customer-focused.</span><br />\r\n	<br />\r\n	<span title=\"Sản phẩm Công ty cung cấp:\">Products The company offers:<br />\r\n	<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy soi cổ tử cung kỹ thuật số, monitor sản khoa, monitor theo dõi bệnh nhân đa thông số, hệ thống monitor trung tâm, máy cắt đốt cổ tử cung chuyên dụng, máy đo nồng độ bão hòa ô xy trong máu, bơm tiêm\">Colposcopy machine digital, monitor anesthesia, monitor patient monitor multiple parameters, the central monitor system, cervical ablation machine dedicated machine measurements of oxygen saturation levels in blood, syringes </span><span title=\"điện, máy truyền dịch tự động của hãng GOLDWAY (US).,INC.\">electric machine company infusion of automated GOLDWAY (U.S.)., INC.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy siêu âm đen trắng, siêu màu 4D các loại của hãng Fukuda- Nhật Bản\">Ultrasound machine black &amp; white, color 4D super types of firms Fukuda, Japan<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy áp lạnh cổ tử cung\">Machine cold pressure of the cervix<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Điện não VIDEO EEG, DIGITAL EEG, điện tim của Tây Ban Nha\">EEG EEG VIDEO, DIGITAL EEG, ECG of Spain<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy đo thính lực chuyên dụng của Tây Ban Nha\">Machinery specialized hearing test in Spain<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy đo bilirubin, hemoglobin sản xuất tại Nhật Bản\">Gauge bilirubin, hemoglobin production in Japan<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy gây mê, máy thở, máy nghe tim thai, nội soi, điện tim, máy phát hiện vàng da.\">Anesthesia machines, ventilators, air auscultation, endoscopy, ECG, jaundice detector.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy xét nghiệm sinh hóa (bán tự động, tự động, tổng hợp), ELISA, dao mổ điện sản xuất tại Mỹ\">Biochemical machine (semi-automatic, automatic, general), ELISA, electric knife made in USA<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy xét nghiệm nước tiểu Cybow, Clinitek Status (Hàn Quốc, Anh)\">Machine Cybow urine, Clinitek Status (Korean, English)<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy quang phổ UV/VIS - Nhật, tủ bảo quản dược phẩm, tủ trữ máu của Đức.\">Spectrophotometer UV / VIS - Japanese pharmaceutical storage cabinets, storage cabinets of German blood.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Đèn mổ (Thụy Sĩ), tủ sấy, nồi hấp (Đài Loan)...\">Lights (Switzerland), oven, steamer (Taiwan) ...<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Các loại thiết bị khoa học kỹ thuật chuyên dụng của Anh, Mỹ, Đức.\">The type of equipment dedicated science and technology in the UK, U.S., Germany.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Các linh kiện thay thế cho các loại monitor theo dõi bệnh nhân, monitor sản khoa\">Replacement parts for the type of monitor to track patients, monitor obstetric</span><br />\r\n	<br />\r\n	<span title=\"Công ty có đội ngũ kỹ sư được đào tạo đúng chuyên ngành thiết bị y tế ở trong và ngoài nước.\">The company has a team of engineers are properly trained specialized medical equipment at home and abroad. </span><span title=\"Đội ngũ này không ngừng được nâng cao tay nghề thông qua các khoá đào tạo của các nhà sản xuất...\">This team is constantly improving skills through training of manufacturers ...</span><br />\r\n	<br />\r\n	<span title=\"Với thế mạnh của mình, chúng tôi hy vọng rằng trong một tương lai gần, Công ty Công nghệ Quang Anh sẽ trở thành một đối tác truyền thống của Quý khách hàng với tư cách là một nhà cung cấp thiết bị y tế có giá cả\">With its strength, we hope that in the near future, Quang Anh Technology Company will become a traditional partner of customers as a supplier of medical equipment priced </span><span title=\"hợp lý nhất, chất lượng tốt nhất và dịch vụ sau bán hàng hoàn hảo.\">most logical, best quality and after sales service perfect.</span><br />\r\n	<br />\r\n	<span title=\"Khi cần mua thiết bị y tế- Đến với Công ty thiết bị y tế Quang Anh\">When you need to buy medical equipment-to the medical device company Quang Anh</span></span></p>\r\n', 'img/upload/076e3caed758a1c18c91a0e9cae3368f.jpg', '', 146, '', 0, '2012-07-23 14:38:15', '2012-08-23 17:51:27', 1, NULL, 'about'),
						(117,$shop_id, 0, 'Hướng dẫn mua hàng qua điện thoại', 'Method of purchases via phones', '<p>\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Hướng dẫn mua h&agrave;ng qua điện thoại</span></p>\r\n', '', '<br />\r\n<p style=\"line-height: 150%\">\r\n	<span style=\"font-weight: bold; font-family: Arial; color: rgb(0, 102, 255); \"><a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#mh1\" id=\"mh1\" name=\"mh1\">I/ Đặt h&agrave;ng qua Điện thoại</a><span style=\"font-size: 10pt; \"><a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#top\" style=\"text-decoration: none\"><span style=\"color: rgb(0, 102, 255); \">(L&ecirc;n tr&ecirc;n </span></a></span></span><a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#top\" style=\"text-decoration: none\"><span style=\"text-decoration: none; font-weight: bold; font-size: 10pt; color: rgb(0, 102, 255); \">&uarr;</span><span style=\"text-decoration: none; font-weight: bold; font-family: Arial; font-size: 10pt; color: rgb(0, 102, 255); \">)</span></a><br />\r\n	&nbsp;</p>\r\n<p style=\"line-height: 150%\">\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Qu&yacute; kh&aacute;ch gọi điện thoại trực tiếp đến Ph&ograve;ng B&aacute;n h&agrave;ng Online theo số m&aacute;y <span style=\"font-weight: bold; \">04.32888999</span> hoặc <span style=\"font-weight: bold; \">04.85821888</span>.<br />\r\n	<br />\r\n	</span></p>\r\n<p style=\"line-height: 150%\">\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">H&agrave;ng ng&agrave;y từ 8h30 &ndash; 21h30 kể cả Thứ bảy, Chủ Nhật v&agrave; c&aacute;c ng&agrave;y Lễ, nh&acirc;n vi&ecirc;n b&aacute;n h&agrave;ng trực tuyến của TOPCARE lu&ocirc;n sẵn s&agrave;ng phục vụ.<br />\r\n	<br />\r\n	</span><br />\r\n	<span style=\"font-weight: bold; font-family: Arial; color: rgb(0, 102, 255); \"> <a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#mh2\" id=\"mh2\">II/ Đặt h&agrave;ng qua Chương tr&igrave;nh Chat Yahoo hoặc Skype</a><span style=\"font-size: 10pt; \"><a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#top\" style=\"text-decoration: none\"><span style=\"color: rgb(0, 102, 255); \">(L&ecirc;n tr&ecirc;n </span></a></span></span><a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#top\" style=\"text-decoration: none\"><span style=\"font-weight: bold; font-size: 10pt; color: rgb(0, 102, 255); \">&uarr;</span><span style=\"font-weight: bold; font-family: Arial; font-size: 10pt; color: rgb(0, 102, 255); \">)</span></a></p>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Khi Qu&yacute; kh&aacute;ch truy cập trang <a href=\"http://www.topcare.vn\">www.topcare.vn</a> c&oacute; thể chat v&agrave; đăng k&yacute; mua h&agrave;ng với c&aacute;c nick Yahoo, Skype hiển thị s&aacute;ng tr&ecirc;n Website ch&iacute;nh thức của ch&uacute;ng t&ocirc;i:<br />\r\n	<br />\r\n	</span></p>\r\n<p align=\"center\" style=\"line-height: 150%\">\r\n	<img border=\"1\" height=\"29\" src=\"http://topcare.vn/Images/anh/yahoo_skype.jpg\" width=\"145\" /></p>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Nhấn v&agrave;o biểu tượng mặt cười, cửa sổ chương tr&igrave;nh Yahoo! Messenger hoặc Skype sẽ tự động bật l&ecirc;n.</span></p>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Chat với nh&acirc;n vi&ecirc;n b&aacute;n h&agrave;ng trực tuyến của TOPCARE, Qu&yacute; kh&aacute;ch sẽ được tư vấn v&agrave; c&oacute; thể y&ecirc;u cầu đặt h&agrave;ng ngay. Nh&acirc;n vi&ecirc;n Topcare sẽ gọi điện thoại cho Qu&yacute; kh&aacute;ch để x&aacute;c nhận đơn h&agrave;ng v&agrave; x&aacute;c nhận địa chỉ giao h&agrave;ng (nếu cần).<br />\r\n	<br />\r\n	</span><br />\r\n	<span style=\"font-weight: bold; font-family: Arial; color: rgb(0, 102, 255); \"> <a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#mh3\" id=\"mh3\">III/ Đăng k&yacute; mua h&agrave;ng qua website www.topcare.vn</a><a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#top\" style=\"text-decoration: none\"><span style=\"font-size: 10pt; color: rgb(0, 102, 255); \">(L&ecirc;n tr&ecirc;n </span></a></span><a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#top\" style=\"text-decoration: none\"><span style=\"font-weight: bold; font-size: 10pt; color: rgb(0, 102, 255); \">&uarr;</span><span style=\"font-weight: bold; font-family: Arial; font-size: 10pt; color: rgb(0, 102, 255); \">)</span></a></p>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Việc đăng k&yacute; mua h&agrave;ng qua website cũng cực kỳ đơn giản, Qu&yacute; kh&aacute;ch c&oacute; thể l&agrave;m theo c&aacute;c hướng dẫn dưới đ&acirc;y:</span></p>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-weight: bold; font-family: Arial; font-size: 10pt; \">Bước 1: Qu&yacute; kh&aacute;ch chọn sản phẩm v&agrave;o &quot;giỏ h&agrave;ng&quot; bằng nhiều c&aacute;ch</span></p>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">V&iacute; dụ như v&agrave;o danh mục h&agrave;ng tương ứng, chọn theo h&atilde;ng, chọn theo gi&aacute;, chọn theo chức năng, chọn theo t&iacute;nh năng, nhập m&atilde; h&agrave;ng v&agrave;o &ocirc; t&igrave;m kiếm&hellip;<br />\r\n	Sau khi đ&atilde; chọn được sản phẩm cần mua, Qu&yacute; kh&aacute;ch nhấn n&uacute;t <img align=\"top\" border=\"0\" height=\"20\" src=\"http://topcare.vn/Images/btn_cart_small.jpg\" width=\"88\" /> tại khung hiển thị của sản phẩm đ&oacute;.</span></p>\r\n<p align=\"left\" style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Ngay lập tức tr&ecirc;n website sẽ xuất hiện <span style=\"font-weight: bold; \">Khung giỏ h&agrave;ng</span> với những sản phẩm Qu&yacute; kh&aacute;ch vừa chọn:<br />\r\n	<br />\r\n	</span></p>\r\n<p align=\"center\" style=\"line-height: 150%\">\r\n	<span style=\"font-family: Arial; font-size: 10pt; \"><img border=\"1\" height=\"256\" src=\"http://topcare.vn/Images/anh/cart_1_small.jpg\" width=\"575\" /></span></p>\r\n<p align=\"left\" style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Tại <span style=\"font-weight: bold; \">Khung giỏ h&agrave;ng</span> n&agrave;y đ&atilde; c&oacute; hướng dẫn chi tiết để Qu&yacute; kh&aacute;ch chọn số lượng sản phẩm m&igrave;nh cần mua, hoặc bỏ kh&ocirc;ng chọn sản phẩm n&agrave;y nữa m&agrave; thay bằng chọn sản phẩm kh&aacute;c.</span></p>\r\n<ul>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Nếu Qu&yacute; kh&aacute;ch muốn bỏ mua mặt h&agrave;ng n&agrave;o đ&oacute;, chỉ cần bấm v&agrave;o n&uacute;t <img align=\"top\" border=\"0\" height=\"20\" src=\"http://topcare.vn/Images/anh/DeleteRed.jpg\" width=\"20\" />&nbsp;<span style=\"color: rgb(0, 0, 255); \">Loại bỏ</span> c&ugrave;ng h&agrave;ng với sản phẩm đ&oacute;<br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Nếu Qu&yacute; kh&aacute;ch muốn chọn mua th&ecirc;m những sản phẩm kh&aacute;c, bấm v&agrave;o n&uacute;t <img align=\"middle\" border=\"0\" height=\"32\" src=\"http://topcare.vn/Images/anh/btn_more.jpg\" width=\"233\" />, <span style=\"font-weight: bold; \">Khung giỏ h&agrave;ng</span> sẽ tạm thời ẩn đi để Qu&yacute; kh&aacute;ch chọn sản phẩm kh&aacute;c v&agrave;o Giỏ h&agrave;ng.<br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Sau khi đ&atilde; chọn xong sản phẩm cần mua, Qu&yacute; kh&aacute;ch kiểm tra lại th&ocirc;ng tin sản phẩm trong giỏ h&agrave;ng 1 lần nữa như: T&ecirc;n sản phẩm, số lượng, đơn gi&aacute;, tổng số tiền phải thanh to&aacute;n... Qu&yacute; kh&aacute;ch nhấn n&uacute;t <img align=\"middle\" border=\"0\" height=\"32\" src=\"http://topcare.vn/Images/anh/continue_button.jpg\" width=\"95\" /> để chuyển sang bước 2</span></li>\r\n</ul>\r\n', '', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', '', 156, '', 0, '2012-07-23 14:45:38', '2012-08-22 11:56:58', 1, NULL, ''),
						(118,$shop_id, 0, 'Cách thanh toán qua cổng trực tuyến', 'Method of online payment', '<p>\r\n	sfsdf</p>\r\n', '', '<p>\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Ở bước n&agrave;y Qu&yacute; kh&aacute;ch sẽ nhập c&aacute;c th&ocirc;ng tin cần thiết như <span style=\"font-weight: bold; \">Họ t&ecirc;n, Số điện thoại, Địa chỉ nhận h&agrave;ng, Email</span> (để Topcare gửi th&ocirc;ng tin đơn h&agrave;ng cho Qu&yacute; kh&aacute;ch), hoặc c&oacute; thể bổ sung th&ecirc;m v&agrave;i th&ocirc;ng tin kh&aacute;c m&agrave; Qu&yacute; kh&aacute;ch cảm thấy cần thiết trong &ocirc; <span style=\"font-weight: bold; \">&quot;Ch&uacute; th&iacute;ch th&ecirc;m&quot;</span> (hướng dẫn Topcare giao h&agrave;ng, y&ecirc;u cầu viết ho&aacute; đơn VAT cho c&ocirc;ng ty...)</span></p>\r\n<p align=\"left\" style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Sau khi điền đủ c&aacute;c th&ocirc;ng tin, Qu&yacute; kh&aacute;ch cần điền th&ecirc;m<span style=\"font-weight: bold; \"> &ldquo;Nhập m&atilde; bảo vệ&rdquo;</span> (để tr&aacute;nh t&igrave;nh trạng SPAM, gửi h&agrave;ng loạt đơn h&agrave;ng), m&atilde; Qu&yacute; kh&aacute;ch phải nhập kh&ocirc;ng ph&acirc;n biệt chữ hoa, chữ thường. Nếu Qu&yacute; kh&aacute;ch kh&ocirc;ng nh&igrave;n r&otilde; m&atilde; bảo vệ đ&oacute;, Qu&yacute; kh&aacute;ch c&oacute; thể bấm <img align=\"top\" border=\"0\" height=\"20\" src=\"http://topcare.vn/Images/anh/iconcopy.jpg\" width=\"20\" />&nbsp;<span style=\"font-weight: bold; color: rgb(0, 102, 255); \">Chọn m&atilde; kh&aacute;c</span>. Rồi bấm <img align=\"middle\" border=\"0\" height=\"32\" src=\"http://topcare.vn/Images/anh/cart_finish.jpg\" width=\"92\" /> v&agrave; chờ v&agrave;i gi&acirc;y để đơn h&agrave;ng được gửi tới hệ thống của Topcare.</span></p>\r\n<p align=\"left\" style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Hệ thống sẽ kiểm tra những th&ocirc;ng tin của Qu&yacute; kh&aacute;ch đ&atilde; cung cấp 1 lần nữa, nếu th&ocirc;ng tin đơn h&agrave;ng hợp lệ, khung đặt h&agrave;ng sẽ hiện l&ecirc;n th&ocirc;ng b&aacute;o ho&agrave;n tất quy tr&igrave;nh mua h&agrave;ng như h&igrave;nh dưới đ&acirc;y:<br />\r\n	<br />\r\n	</span></p>\r\n<p align=\"center\" style=\"line-height: 150%\">\r\n	<img border=\"1\" height=\"256\" src=\"http://topcare.vn/Images/anh/cartfinish.jpg\" width=\"575\" /></p>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Sau đ&oacute; nh&acirc;n vi&ecirc;n của Topcare sẽ xử l&yacute; đơn đặt h&agrave;ng v&agrave; li&ecirc;n lạc lại với Qu&yacute; kh&aacute;ch để x&aacute;c nhận v&agrave; thống nhất việc mua h&agrave;ng.<br />\r\n	<br />\r\n	</span></p>\r\n<p style=\"line-height: 150%\">\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Qu&yacute; kh&aacute;ch cũng c&oacute; thể li&ecirc;n lạc với Ph&ograve;ng B&aacute;n h&agrave;ng Online để nhận hỗ trợ:</span></p>\r\n<ul>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Hỗ trợ th&ocirc;ng tin qua Email: <a href=\"mailto:banhang.online@topcare.vn\">banhang.online@topcare.vn</a><br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Điện thoại : <span style=\"font-weight: bold; \">(04).32888999</span> hoặc <span style=\"font-weight: bold; \">(04).85821888</span></span></li>\r\n</ul>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"text-decoration: underline; \"><span style=\"font-weight: bold; font-family: Arial; color: rgb(0, 102, 255); \">Một số lưu &yacute;:</span></span></p>\r\n<ul>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Topcare chỉ chấp nhận những Đơn đặt h&agrave;ng khi cung cấp đủ th&ocirc;ng tin ch&iacute;nh x&aacute;c về địa chỉ, số điện thoại &hellip; Sau khi Qu&yacute; kh&aacute;ch đặt h&agrave;ng, TOPCARE sẽ gọi điện cho Qu&yacute; kh&aacute;ch để x&aacute;c nhận th&ocirc;ng tin v&agrave; trao đổi việc thực hiện đơn h&agrave;ng.<br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; line-height: 24px; font-size: small; \">Hiện tại Topcare chỉ phục vụ b&aacute;n h&agrave;ng Online đối với kh&aacute;ch h&agrave;ng H&agrave; Nội v&agrave; c&aacute;c tỉnh th&agrave;nh kh&aacute;c thuộc nước Việt Nam.<br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; line-height: 24px; font-size: small; \">Địa chỉ giao h&agrave;ng phải c&oacute; th&ocirc;ng tin người nhận h&agrave;ng, địa chỉ, số điện thoại ch&iacute;nh x&aacute;c, r&otilde; r&agrave;ng. Ch&uacute;ng t&ocirc;i kh&ocirc;ng chịu tr&aacute;ch nhiệm khi qu&yacute; kh&aacute;ch ghi sai th&ocirc;ng tin người nhận.<br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Topcare kh&ocirc;ng b&aacute;n sản phẩm cho người dưới 13 tuổi. Nếu qu&yacute; kh&aacute;ch dưới 13 tuổi, Qu&yacute; kh&aacute;ch được y&ecirc;u cầu phải c&oacute; sự đồng &yacute; của cha mẹ hoặc người gi&aacute;m hộ để thực hiện mua h&agrave;ng từ website <a href=\"http://www.topcare.vn\">www.topcare.vn</a></span></li>\r\n</ul>\r\n', '', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', '', 156, '', 0, '2012-07-23 14:46:20', '2012-08-22 11:56:53', 1, NULL, ''),
						(119,$shop_id, 0, 'Hướng dẫn đặt hàng', 'Method of order', '', '', '<p>\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Ở bước n&agrave;y Qu&yacute; kh&aacute;ch sẽ nhập c&aacute;c th&ocirc;ng tin cần thiết như <span style=\"font-weight: bold; \">Họ t&ecirc;n, Số điện thoại, Địa chỉ nhận h&agrave;ng, Email</span> (để Topcare gửi th&ocirc;ng tin đơn h&agrave;ng cho Qu&yacute; kh&aacute;ch), hoặc c&oacute; thể bổ sung th&ecirc;m v&agrave;i th&ocirc;ng tin kh&aacute;c m&agrave; Qu&yacute; kh&aacute;ch cảm thấy cần thiết trong &ocirc; <span style=\"font-weight: bold; \">&quot;Ch&uacute; th&iacute;ch th&ecirc;m&quot;</span> (hướng dẫn Topcare giao h&agrave;ng, y&ecirc;u cầu viết ho&aacute; đơn VAT cho c&ocirc;ng ty...)</span></p>\r\n<p align=\"left\" style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Sau khi điền đủ c&aacute;c th&ocirc;ng tin, Qu&yacute; kh&aacute;ch cần điền th&ecirc;m<span style=\"font-weight: bold; \"> &ldquo;Nhập m&atilde; bảo vệ&rdquo;</span> (để tr&aacute;nh t&igrave;nh trạng SPAM, gửi h&agrave;ng loạt đơn h&agrave;ng), m&atilde; Qu&yacute; kh&aacute;ch phải nhập kh&ocirc;ng ph&acirc;n biệt chữ hoa, chữ thường. Nếu Qu&yacute; kh&aacute;ch kh&ocirc;ng nh&igrave;n r&otilde; m&atilde; bảo vệ đ&oacute;, Qu&yacute; kh&aacute;ch c&oacute; thể bấm <img align=\"top\" border=\"0\" height=\"20\" src=\"http://topcare.vn/Images/anh/iconcopy.jpg\" width=\"20\" />&nbsp;<span style=\"font-weight: bold; color: rgb(0, 102, 255); \">Chọn m&atilde; kh&aacute;c</span>. Rồi bấm <img align=\"middle\" border=\"0\" height=\"32\" src=\"http://topcare.vn/Images/anh/cart_finish.jpg\" width=\"92\" /> v&agrave; chờ v&agrave;i gi&acirc;y để đơn h&agrave;ng được gửi tới hệ thống của Topcare.</span></p>\r\n<p align=\"left\" style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Hệ thống sẽ kiểm tra những th&ocirc;ng tin của Qu&yacute; kh&aacute;ch đ&atilde; cung cấp 1 lần nữa, nếu th&ocirc;ng tin đơn h&agrave;ng hợp lệ, khung đặt h&agrave;ng sẽ hiện l&ecirc;n th&ocirc;ng b&aacute;o ho&agrave;n tất quy tr&igrave;nh mua h&agrave;ng như h&igrave;nh dưới đ&acirc;y:<br />\r\n	<br />\r\n	</span></p>\r\n<p align=\"center\" style=\"line-height: 150%\">\r\n	<img border=\"1\" height=\"256\" src=\"http://topcare.vn/Images/anh/cartfinish.jpg\" width=\"575\" /></p>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Sau đ&oacute; nh&acirc;n vi&ecirc;n của Topcare sẽ xử l&yacute; đơn đặt h&agrave;ng v&agrave; li&ecirc;n lạc lại với Qu&yacute; kh&aacute;ch để x&aacute;c nhận v&agrave; thống nhất việc mua h&agrave;ng.<br />\r\n	<br />\r\n	</span></p>\r\n<p style=\"line-height: 150%\">\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Qu&yacute; kh&aacute;ch cũng c&oacute; thể li&ecirc;n lạc với Ph&ograve;ng B&aacute;n h&agrave;ng Online để nhận hỗ trợ:</span></p>\r\n<ul>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Hỗ trợ th&ocirc;ng tin qua Email: <a href=\"mailto:banhang.online@topcare.vn\">banhang.online@topcare.vn</a><br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Điện thoại : <span style=\"font-weight: bold; \">(04).32888999</span> hoặc <span style=\"font-weight: bold; \">(04).85821888</span></span></li>\r\n</ul>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"text-decoration: underline; \"><span style=\"font-weight: bold; font-family: Arial; color: rgb(0, 102, 255); \">Một số lưu &yacute;:</span></span></p>\r\n<ul>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Topcare chỉ chấp nhận những Đơn đặt h&agrave;ng khi cung cấp đủ th&ocirc;ng tin ch&iacute;nh x&aacute;c về địa chỉ, số điện thoại &hellip; Sau khi Qu&yacute; kh&aacute;ch đặt h&agrave;ng, TOPCARE sẽ gọi điện cho Qu&yacute; kh&aacute;ch để x&aacute;c nhận th&ocirc;ng tin v&agrave; trao đổi việc thực hiện đơn h&agrave;ng.<br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; line-height: 24px; font-size: small; \">Hiện tại Topcare chỉ phục vụ b&aacute;n h&agrave;ng Online đối với kh&aacute;ch h&agrave;ng H&agrave; Nội v&agrave; c&aacute;c tỉnh th&agrave;nh kh&aacute;c thuộc nước Việt Nam.<br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; line-height: 24px; font-size: small; \">Địa chỉ giao h&agrave;ng phải c&oacute; th&ocirc;ng tin người nhận h&agrave;ng, địa chỉ, số điện thoại ch&iacute;nh x&aacute;c, r&otilde; r&agrave;ng. Ch&uacute;ng t&ocirc;i kh&ocirc;ng chịu tr&aacute;ch nhiệm khi qu&yacute; kh&aacute;ch ghi sai th&ocirc;ng tin người nhận.<br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Topcare kh&ocirc;ng b&aacute;n sản phẩm cho người dưới 13 tuổi. Nếu qu&yacute; kh&aacute;ch dưới 13 tuổi, Qu&yacute; kh&aacute;ch được y&ecirc;u cầu phải c&oacute; sự đồng &yacute; của cha mẹ hoặc người gi&aacute;m hộ để thực hiện mua h&agrave;ng từ website <a href=\"http://www.topcare.vn\">www.topcare.vn</a></span></li>\r\n</ul>\r\n', '', '/estoreadmin/webroot/upload/image/images/13.jpg', '', 156, '', 0, '2012-07-23 14:47:22', '2012-08-22 11:56:42', 1, NULL, ''),
						(126,$shop_id, 0, 'Sáng nay giá vàng giảm 500 nghìn/1 lượng', 'The price of gold has decreased by 500 thousand VND this morning ', '<p>\r\n	S&aacute;ng nay gi&aacute; v&agrave;ng giảm 500 ngh&igrave;n/1 lượng, mọi người đổ x&ocirc; ra c&aacute;c tiệm v&agrave;ng để b&aacute;n, v&igrave; lo sợ gi&aacute; v&agrave;ng tiếp tục giảm</p>\r\n', '<p>\r\n	update</p>\r\n', '<p>\r\n	S&aacute;ng nay gi&aacute; v&agrave;ng giảm 500 ngh&igrave;n/1 lượng, mọi người đổ x&ocirc; ra c&aacute;c tiệm v&agrave;ng để b&aacute;n, v&igrave; lo sợ gi&aacute; v&agrave;ng tiếp tục giảm</p>\r\n', '<p>\r\n	update..</p>\r\n', 'img/upload/17e72a27ea8728adf98fd4cc99c4db82.jpg', '', 156, '', 0, '2012-07-29 16:43:23', '2012-07-29 16:43:23', 1, NULL, 'sang-nay-gia-vang-giam-500-nghin-1-luong'),
						(127,$shop_id, 0, 'Công ty TNHH thiết bị y tế mới nhập 1 lô sản phẩm y tế', 'Medical Equipment Co., Ltd has just imported a new batch of medical products', '<p>\r\n	Đ&acirc;y&nbsp; lo h&agrave;ng ống nước hiện đại nhất thế giới, được sản xuất theo c&ocirc;ng nghệ của mỹ , ti&ecirc;n tiến nhất hiện nay</p>\r\n', '<p>\r\n	<span id=\"result_box\" lang=\"en\"><span class=\"hps\">This</span> <span class=\"hps\">concerns</span> <span class=\"hps\">the most modern</span> <span class=\"hps\">water</span> <span class=\"hps\">pipe</span> <span class=\"hps\">in the world,</span> <span class=\"hps\">is produced by</span> <span class=\"hps\">the</span> <span class=\"hps\">U.S.</span> <span class=\"hps\">technology</span><span>,</span> <span class=\"hps\">today&#39;s most</span> <span class=\"hps\">advanced</span></span></p>\r\n', '<p>\r\n	Đ&acirc;y&nbsp; lo h&agrave;ng ống nước hiện đại nhất thế giới, được sản xuất theo c&ocirc;ng nghệ của mỹ , ti&ecirc;n tiến nhất hiện nay</p>\r\n', '<p>\r\n	<span id=\"result_box\" lang=\"en\"><span class=\"hps\">This</span> <span class=\"hps\">concerns</span> <span class=\"hps\">the most modern</span> <span class=\"hps\">water</span> <span class=\"hps\">pipe</span> <span class=\"hps\">in the world,</span> <span class=\"hps\">is produced by</span> <span class=\"hps\">the</span> <span class=\"hps\">U.S.</span> <span class=\"hps\">technology</span><span>,</span> <span class=\"hps\">today&#39;s most</span> <span class=\"hps\">advanced</span></span></p>\r\n', 'img/upload/ab9459f38a75e382e4c2fa044f39fc10.jpg', '', 156, '', 0, '2012-07-29 16:45:58', '2012-08-06 12:45:44', 1, NULL, 'cong-ty-tnhh-thiet-bi-y-te-moi-nhap-1-lo-san-pham-y-te');";
						
						$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_orders` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `user_id` varchar(200) NOT NULL,
  `pid` int(11) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `images` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;";
						
						
						$arrSql[] ="INSERT INTO `estore_orders` (`id`, `estore_id`, `user_id`, `pid`, `pname`, `images`, `quantity`, `price`, `total_price`) VALUES
						(1,$shop_id, 'id366822', 21, 'Ống công nghiệp inox ', '/tana/estoreadmin/webroot/upload/image/images/index_29.jpg', 1,$shop_id,$shop_id),
						(2,$shop_id, 'id366822', 20, 'Ống công nghiệp inox', '/tana/estoreadmin/webroot/upload/image/images/index_33.jpg', 1, 400, 400),
						(3,$shop_id, 'id366822', 19, 'Ống công nghiệp inox ', '/tana/estoreadmin/webroot/upload/image/images/index_31.jpg', 1, 200, 200),
						(4,$shop_id, 'id47761', 25, 'Ống công nghiệp inox ', '/tana/estoreadmin/webroot/upload/image/images/index_27.jpg', 5, 120, 600),
						(5,$shop_id, 'id47761', 20, 'Ống công nghiệp inox', '/tana/estoreadmin/webroot/upload/image/images/index_33.jpg', 5, 400, 2000),
						(6,$shop_id, 'id717636', 25, 'sp1', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_09.jpg', 1, 120, 120),
						(7,$shop_id, 'id881866', 21, 'sp2', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_17.jpg', 1,$shop_id,$shop_id),
						(8,$shop_id, 'id503470', 26, 'sp43', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 1, 120000, 120000),
						(9,$shop_id, 'id67517', 27, 'sp3', '/khieuvu/estoreadmin/webroot/upload/image/files/3.jpg', 1, 200, 200);";
						
						$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_partners` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `name` varchar(256) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(256) NOT NULL,
  `website` varchar(256) DEFAULT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `address` varchar(256) NOT NULL,
  `images` varchar(256) NOT NULL,
  `content` text,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;";
						
						$arrSql[] ="INSERT INTO `estore_partners` (`id`, `estore_id`, `name`, `phone`, `email`, `website`, `fax`, `address`, `images`, `content`, `created`, `modified`, `status`) VALUES
						(19,$shop_id, 'Công ty bcds', '', '', 'http://google.com', NULL, '', 'img/upload/a26d66b1322c320201a5a6c01e9f004f.jpg', NULL, '2012-07-29', '2012-07-29', 1),
						(18,$shop_id, 'Công ty bcd', '', '', 'http://google.com', NULL, '', 'img/upload/aded75138b945d987476ee4beaa48400.jpg', NULL, '2012-07-29', '2012-07-29', 1),
						(17,$shop_id, 'Công ty dcb', '', '', 'http://google.com', NULL, '', 'img/upload/65756cba90775ab2b30a744199a7c84a.jpg', NULL, '2012-07-29', '2012-07-29', 1),
						(16,$shop_id, 'Công ty abc', '', '', 'http://eximbank.com.vn', NULL, '', 'img/upload/61c692bbd3e8c4f8cb24ca87e9ff3d92.jpg', NULL, '2012-07-29', '2012-07-29', 1),
						(20,$shop_id, 'ádasd', '', '', 'http://google.com', NULL, '', 'img/upload/36e21b2e6d68b65741d004886e5223cb.jpg', NULL, '2012-09-16', '2012-09-16', 1),
						(21,$shop_id, 'hhhh', '', '', 'http://google.com', NULL, '', 'img/upload/97fea11d1a80d7ccfad25eccdd7d031e.jpg', NULL, '2012-09-16', '2012-09-16', 1),
						(22,$shop_id, 'hhh', '', '', 'http://google.com', NULL, '', 'img/upload/f6c03d67fe500b1ac80f32c87c60ec59.jpg', NULL, '2012-09-16', '2012-09-16', 1),
						(23,$shop_id, 'h', '', '', 'http://google.com', NULL, '', 'img/upload/8f9fa526eff662129d81b1fb55d07676.jpg', NULL, '2012-09-16', '2012-09-16', 1),
						(24,$shop_id, 'hhh', '', '', 'http://google.com', NULL, '', 'img/upload/74b21a268eb187c89772e79f91895d62.jpg', NULL, '2012-09-16', '2012-09-16', 1),
						(25,$shop_id, 'á', '', '', 'http://google.com', NULL, '', 'img/upload/ff76a40ba32dfb0687988e0bdbc15765.jpg', NULL, '2012-09-16', '2012-09-16', 1),
						(26,$shop_id, 'ádas', '', '', 'http://google.com', NULL, '', 'img/upload/cb18c77ef1e964033f5e9b33c991411d.jpg', NULL, '2012-09-16', '2012-09-16', 1);";
						
						$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_products` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `title` varchar(256) NOT NULL,
  `title_en` varchar(256) NOT NULL,
  `price` int(30) DEFAULT NULL,
  `manufacturer` varchar(256) NOT NULL COMMENT 'hang sx',
  `introduction` text NOT NULL COMMENT 'mo ta chung',
  `content` text NOT NULL,
  `content_en` text NOT NULL,
  `images` varchar(256) NOT NULL,
  `images_en` varchar(256) NOT NULL,
  `images1` varchar(250) DEFAULT NULL,
  `images2` varchar(250) DEFAULT NULL,
  `images3` varchar(250) NOT NULL,
  `images4` varchar(250) DEFAULT NULL,
  `catproduct_id` int(10) NOT NULL,
  `display` int(2) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `sptieubieu` tinyint(2) NOT NULL,
  `status` int(2) NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `kichthuoc` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `chatlieu` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `khoanggia` int(20) DEFAULT NULL,
  `spkuyenmai` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=269 DEFAULT CHARSET=utf8;";
						
						
						$arrSql[] ="INSERT INTO `estore_products` (`id`, `estore_id`, `title`, `title_en`, `price`, `manufacturer`, `introduction`, `content`, `content_en`, `images`, `images_en`, `images1`, `images2`, `images3`, `images4`, `catproduct_id`, `display`, `created`, `modified`, `sptieubieu`, `status`, `alias`, `code`, `kichthuoc`, `chatlieu`, `khoanggia`, `spkuyenmai`) VALUES
						(262,$shop_id, 'Navy Linen Blazer', '', 228000, '136', '', '<p>\r\n	Navy Linen Blazer</p>\r\n', '', 'img/upload/29575124b67b535acfe68e46c0083f0f.jpg', '', 'img/upload/73c8c1e7d181721cf29bdae0caeb85f8.jpg', '', '', '', 129, 0, '2014-08-28 06:51:12', '2014-08-28 06:51:12', 1, 1, 'navy-linen-blazer', '', NULL, NULL, 0, 1),
						(261,$shop_id, 'Amelia Tote', '', 58000, '138', '', '<p>\r\n	Amelia Tote</p>\r\n', '', 'img/upload/240608816ab0e344a26bfb6b1823d39b.jpg', '', 'img/upload/cab6ef09275fd88f1e4da7eca67fc7f5.jpg', '', '', '', 129, 0, '2014-08-28 06:49:28', '2014-08-28 06:49:28', 1, 1, 'amelia-tote', '', NULL, NULL, 1, 1),
						(260,$shop_id, 'Marais Dress', '', 58000, '138', '', '<p>\r\n	Marais Dress</p>\r\n', '', 'img/upload/dffab3907044d81bfd3ce3423b6104fa.jpg', '', 'img/upload/a5502dcd1368f21a0a85c0e04d35e49f.jpg', '', '', '', 129, 0, '2014-08-28 06:48:04', '2014-08-28 06:48:04', 1, 1, 'marais-dress', '', NULL, NULL, 0, 1),
						(259,$shop_id, 'Bay Blocker', '', 72000, '137', '', '', '', 'img/upload/c6baaf2af5b7fa7ac8c1b1849a53ab53.jpg', '', '', '', '', '', 129, 0, '2014-08-28 06:47:07', '2014-08-28 06:47:07', 1, 1, 'bay-blocker', '', NULL, NULL, 1, 1),
						(258,$shop_id, 'El Paso Tank', '', 38000, '136', '', '<p>\r\n	El Paso Tank</p>\r\n', '', 'img/upload/1538b2670005dd0271138a9894bfbad3.jpg', '', 'img/upload/1af8b0077f219a23ebeda8a0172837e4.jpg', '', '', '', 129, 0, '2014-08-28 06:46:09', '2014-08-28 06:46:09', 1, 1, 'el-paso-tank', '', NULL, NULL, 0, 1),
						(257,$shop_id, 'Classic Glasgow in Silver', '', 499000, '137', '', '<p>\r\n	Classic Glasgow in Silver</p>\r\n', '', 'img/upload/6a6ecba468d3265a94fa153fa9134aae.jpg', '', 'img/upload/916d9769dec53c429a3ba6770f237f12.jpg', '', '', '', 129, 0, '2014-08-28 06:44:53', '2014-08-28 06:44:53', 1, 1, 'classic-glasgow-in-silver', '', NULL, NULL, 0, 1),
						(256,$shop_id, 'Carstensen', '', 140000, '137', '', '<p>\r\n	Carstensen</p>\r\n', '', 'img/upload/5147a6f6a6921be62a2e467afdf0a0da.jpg', '', 'img/upload/d05bb6c12fb186024669e1e9f9d872bd.jpg', '', '', '', 129, 0, '2014-08-28 06:43:15', '2014-08-28 06:43:15', 1, 1, 'carstensen', '', NULL, NULL, 1, 1),
						(254,$shop_id, 'Nep Pocket Tee', '', 50000, '', '', '<p>\r\n	Nep Pocket Tee</p>\r\n', '', 'img/upload/41c97551f9f8b2e72b0a8c7acb8de741.jpg', '', '', '', '', '', 129, 0, '2014-08-28 06:41:16', '2014-08-28 06:41:16', 1, 1, 'nep-pocket-tee', '', NULL, NULL, 5, 1),
						(255,$shop_id, 'Dustbowl Snapback', '', 380000, '', '', '<p>\r\n	Dustbowl Snapback</p>\r\n', '', 'img/upload/2d50c92c5b2ae11c422c6015ebe9880c.jpg', '', 'img/upload/fe509d2dde947dee1cdd8aa4fd591edf.jpg', '', '', '', 129, 0, '2014-08-28 06:42:10', '2014-08-28 06:42:10', 1, 1, 'dustbowl-snapback', '', NULL, NULL, NULL, 1),
						(253,$shop_id, 'Babar Afrique', '', 330000, '', '', '<p>\r\n	Babar AfriqueBabar AfriqueBabar AfriqueBabar Afrique</p>\r\n', '', 'img/upload/223d1bc92c28c97ae944bbc773a37761.jpg', '', 'img/upload/fe66f3aec44086ad02bcecf3c2aea6e2.jpg', '', '', '', 125, 0, '2014-08-28 06:37:13', '2014-08-28 06:37:13', 1, 1, 'babar-afrique', '', NULL, NULL, 6, 1),
						(252,$shop_id, 'Babar Soul', '', 70000, '137', '', '<p>\r\n	Babar Soul</p>\r\n', '', 'img/upload/30fbb2b0f4627963b9bc0ffa571f3373.jpg', '', 'img/upload/be437fff31c23caaabf0141477071190.jpg', '', '', '', 129, 0, '2014-08-28 06:36:02', '2014-08-28 06:36:02', 1, 1, 'babar-soul', '', NULL, NULL, 1, 1),
						(251,$shop_id, 'Malta Dress', '', 88000, '137', '', '<p>\r\n	Malta Dress Malta Dress</p>\r\n', '', 'img/upload/4e8d0e834005885727e5aa5b14c0384a.jpg', '', 'img/upload/06670ede507bf70f5f5a2688a8d3a179.jpg', '', '', '', 129, 0, '2014-08-28 06:34:46', '2014-08-28 06:34:46', 1, 1, 'malta-dress', '', NULL, NULL, 2, 1),
						(250,$shop_id, 'El Silencio', '', 58, '', '', '<p>\r\n	El Silencio</p>\r\n', '', 'img/upload/096b0945ddd12ad0e8aecba517d7fee4.jpg', '', 'img/upload/1d5e4cd2a86e61bc97e14d052d6ed862.jpg', '', '', '', 129, 0, '2014-08-28 06:16:05', '2014-08-28 06:16:05', 1, 1, 'el-silencio', '', NULL, NULL, 1, 1),
						(249,$shop_id, 'Lisette Dress', '', 450000, '137', '', '<p>\r\n	Lisette Dress</p>\r\n', '', 'img/upload/6271f2fc7cc153451d192d9ccce171aa.jpg', '', 'img/upload/a0fbedfddde239ad2281e26d91177d80.jpg', '', 'img/upload/6271f2fc7cc153451d192d9ccce171aa.jpg', 'img/upload/a0fbedfddde239ad2281e26d91177d80.jpg', 129, 0, '2014-08-28 05:46:13', '2014-08-28 05:46:13', 1, 1, 'lisette-dress', '', NULL, NULL, 1, 0),
						(248,$shop_id, 'Lisette Dress', '', 58000, '135', '', '<p>\r\n	Lisette Dress</p>\r\n', '', 'img/upload/a0fbedfddde239ad2281e26d91177d80.jpg', '', NULL, NULL, '', NULL, 124, 0, '2014-08-28 04:27:46', '2014-08-28 04:27:46', 1, 1, 'lisette-dress', '', NULL, NULL, 1, 1),
						(263,$shop_id, 'Name 01', '', 455666, '135', '', '', '', 'img/upload/f010a373027eeb52690a4e0ab2cdc6aa.jpg', '', '', '', '', '', 129, 0, '2014-09-02 03:38:46', '2014-09-02 03:38:46', 1, 1, 'name-01', '', NULL, NULL, 2, 1),
						(264,$shop_id, 'product1', '', 56000, '135', '', '', '', 'img/upload/7fc4408d1127372a8eed5706965a36b7.jpg', '', '', '', '', '', 142, 0, '2014-09-02 03:41:49', '2014-09-02 03:41:49', 1, 1, 'product1', '', NULL, NULL, 0, 1),
						(265,$shop_id, 'product2', '', 600000, '', '', '', '', 'img/upload/641c2b3d76f07b3520e6252f5f83be1d.jpg', '', '', '', '', '', 142, 0, '2014-09-02 03:42:46', '2014-09-02 03:42:46', 1, 1, 'product2', '', NULL, NULL, 2, 1),
						(266,$shop_id, 'product3', '', 4500000, '136', '', '', '', 'img/upload/1606399728082147fa87af6ec84a46a2.jpg', '', '', '', '', '', 142, 0, '2014-09-02 03:43:30', '2014-09-02 03:43:30', 1, 1, 'product3', '', NULL, NULL, 1, 1),
						(267,$shop_id, 'product4', '', 350000, '138', '', '', '', 'img/upload/1c6c5e73764bf4da25212799b336bfd2.jpg', '', '', '', '', '', 142, 0, '2014-09-02 03:45:03', '2014-09-02 03:45:03', 1, 1, 'product4', '', NULL, NULL, 0, 1),
						(268,$shop_id, 'product5', '', 34444, '137', '', '<p>\r\n	4444</p>\r\n', '', 'img/upload/f5b849da489177087754d3d978c09b1d.jpg', '', '', '', '', '', 142, 0, '2014-09-02 03:45:50', '2014-09-02 03:45:50', 1, 1, 'product5', '', NULL, NULL, 0, 1);";
						
						$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_settings` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `name` varchar(256) CHARACTER SET utf8 NOT NULL,
  `map` text CHARACTER SET utf8 NOT NULL,
  `title` varchar(250) CHARACTER SET utf8 NOT NULL,
  `info_other` varchar(250) CHARACTER SET utf8 NOT NULL,
  `address` varchar(256) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(256) NOT NULL,
  `server` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `username` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `url` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `keyword` varchar(500) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8,
  `created` date NOT NULL,
  `modified` text NOT NULL,
  `name_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_eg` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `descriptions` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `footer` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;";
						
						$arrSql[] ="INSERT INTO `estore_settings` (`id`, `estore_id`, `name`, `map`, `title`, `info_other`, `address`, `phone`, `mobile`, `email`, `server`, `username`, `password`, `url`, `keyword`, `description`, `content`, `created`, `modified`, `name_en`, `address_eg`, `title_en`, `descriptions`, `footer`) VALUES
						(1,$shop_id, 'Công ty cổ phần Demo', '<iframe width=\"100%\" height=\"144\" frameborder=\"0\" src=\"https://maps.google.co.uk/?ie=UTF8&amp;t=m&amp;ll=52.204004,0.122824&amp;spn=0.005865,0.014677&amp;z=11&amp;output=embed\" marginwidth=\"0\" marginheight=\"0\" scrolling=\"no\"></iframe>', 'CÔNG TY TNHH DEMO', 'Copyright © 2011 Bản quyền thuộc Vinaconex 12', 'Nguyễn Văn Linh - Q. Long Biên - Hà Nội', '04.38517532', '0979 644 688', 'servic@demo.vn', 'localhost', 'root', NULL, 'demo.vn', 'CONG TY TNHH  DEMO', 'CONG TY TNHH  DEMO', '', '0000-00-00', '1409714098', 'CÔNG TY TNHH DEMO', '', 'CONG TY TNHH  DEMO', '', '<div class=\"col-md-3 column\">\r\n	<h3>\r\n		ONLINE SHOP</h3>\r\n	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque mattis tortor arcu, quis molestie tortor dictum et.</div>\r\n<div class=\"col-md-3 column\">\r\n	<h3>\r\n		FOLLOW US</h3>\r\n	<a href=\"#\"><span class=\"fa-stack fa-lg\"> </span> Twitter</a><br />\r\n	<a href=\"#\"><span class=\"fa-stack fa-lg\"> </span> Facebook</a><br />\r\n	<a href=\"#\"><span class=\"fa-stack fa-lg\"> </span> Google+</a></div>\r\n<div class=\"col-md-3 column\">\r\n	<h3>\r\n		CONTACT INFO</h3>\r\n	1 The Street, Alpha Road, Gamma Town, Countrysville, X43 32A<br />\r\n	<br />\r\n	<strong>Telephone:</strong> 0909 111 2233<br />\r\n	<strong>E-Mail:</strong> sales@theshop.com</div>\r\n<div class=\"col-md-3 column\">\r\n	<h3>\r\n		MAILING LIST</h3>\r\n	<form action=\"#\" method=\"post\">\r\n		<div class=\"input-prepend\">\r\n			<input id=\"email\" name=\"\" placeholder=\"your@email.com\" type=\"text\" /></div>\r\n		<br />\r\n		<input class=\"btn\" type=\"submit\" value=\"Subscribe Now!\" />&nbsp;</form>\r\n</div>\r\n');";
						
						$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_slideshows` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `images` varchar(250) CHARACTER SET utf8 NOT NULL,
  `created` datetime NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;";
						
						$arrSql[] ="INSERT INTO `estore_slideshows` (`id`, `estore_id`, `name`, `images`, `created`, `status`) VALUES
						(20,$shop_id, 'slide4', 'img/gallery/360e64d229ff7266513e02463e04f9e4.png', '2012-07-29 15:36:03', 1),
						(22,$shop_id, 'slide', 'img/gallery/847202f6972291a09cd233c1b971cb32.png', '2012-09-13 12:52:02', 1),
						(23, 0, 'slider 3', 'img/gallery/ddca1f0d015c70fa6a90b22a763f4abd.png', '2014-08-27 08:33:36', 1),
						(24, 0, 'slider 4', 'img/gallery/89e890a4205aa74fbdc8debfe7e6ce7d.png', '2014-08-27 08:33:58', 1);";
						
						$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_users` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `password` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(15) NOT NULL,
  `birth_date` varchar(200) NOT NULL,
  `sex` varchar(20) NOT NULL,
  `images` varchar(256) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `active_key` varchar(50) DEFAULT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;";
						
						
						$arrSql[] ="INSERT INTO `estore_users` (`id`, `estore_id`, `password`, `name`, `email`, `phone`, `birth_date`, `sex`, `images`, `created`, `modified`, `active_key`, `status`) VALUES
						(17,$shop_id, 'e10adc3949ba59abbe56e057f20f883e', 'admin', 'estoreadmin@estoreadmin', 2147483647, '18-11-1968', '1', '', '2011-05-17 14:33:04', '2012-07-08 10:07:43', '70c639df5e30bdee440e4cdf599fec2b', 1),
						(39,$shop_id, 'e10adc3949ba59abbe56e057f20f883e', 'phuc', 'phuca4@gmail.com', 972943090, '2012-07-18', '1', '', '2012-07-10 08:56:46', '2012-07-10 08:56:46', 'd58072be2820e8682c0a27c0518e805e', 0);";
						
						$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `video` varchar(250) CHARACTER SET utf8 NOT NULL,
  `LinkUrl` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `status` int(2) NOT NULL,
  `left` int(2) NOT NULL,
  `right` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;";
						
$arrSql[] ="INSERT INTO `estore_videos` (`id`, `estore_id`, `name`, `video`, `LinkUrl`, `created`, `status`, `left`, `right`) VALUES
						(1,$shop_id, 'Gala trong ngay', 'video/upload/c67b28f317fe8740ada0a80316a0559c.flv', 'http://www.youtube.com/watch?v=5z7DEE70dEs&feature=related', '2011-10-02 18:51:33', 1, 0, 0),
						(2,$shop_id, 'Clip gala Bên phải', 'video/upload/64c23f4052d6626521caef72b1bc067f.flv', 'http://www.youtube.com/watch?v=76ZqkGxe_Mc&feature=g-vrec', '2012-06-14 14:46:38', 1, 1, 0);";
						
						$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_wards` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `name` varchar(256) CHARACTER SET utf8 NOT NULL,
  `district_id` int(10) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
						
						
$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_weblinks` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `name` varchar(256) CHARACTER SET utf8 NOT NULL,
  `link` varchar(256) CHARACTER SET ucs2 NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;";
						
						
$arrSql[] ="INSERT INTO `estore_weblinks` (`id`, `estore_id`, `name`, `link`, `created`, `modified`, `status`) VALUES
						(8,$shop_id, 'Google', 'http://google.vn', '0000-00-00', '0000-00-00', 1),
						(9,$shop_id, 'Dân trí', 'http://dantri.com.vn', '0000-00-00', '2012-08-04', 1),
						(10,$shop_id, '24h', 'http://24h.com.vn', '2012-08-04', '2012-08-04', 1),
						(11,$shop_id, 'quản trị mạng', 'http://quantrimang.com.vn', '2012-08-04', '2012-08-04', 1);";
						
						
						if($username ==='' and $password === '' )
						{
							$db = ConnectionManager::getDataSource('default');
							//$nameLangueCopy = $db->rawQuery($sql);
							try {
								foreach ($arrSql as $sql) {
									$db->rawQuery($sql);
								}
								$result = "Sucessfull";
							} catch (\Exception $exc) {
								$result = $exc->getMessage();
									
							}
							CakeLog::write('debug', 'Excute sql database localhost'.$result);
						}
							
						if($username !='' and $password != '' )
						{
							$db = new ConnectionManager;
							$config = array(
									//'className' => 'Cake\Database\Connection',
									'driver' => 'mysql',
									'persistent' => false,
									'host' =>'localhost',
									'login' =>$username,
									'password' =>$password,
									'database' =>$namedatabase,
									'prefix' => false,
									'encoding' => 'utf8',
									'timezone' => 'UTC',
									'cacheMetadata' => true
							);
							$db->create($namedatabase,$config);
							$name = ConnectionManager::getDataSource($namedatabase);
							try {
								foreach ($arrSql as $sql) {
									$name->rawQuery($sql);
								}
								$result = "Sucessfull";
							} catch (\Exception $exc) {
								$result = $exc->getMessage();
						
							}
							CakeLog::write('debug', 'Excute sql database derecadmin'.$result);
						}
						
						return $result;
						break;
					}
				// end 	50000568_en
				
				case "50000567_vi" :
				case "50000567_en" :
					{
						$arrSql = array();
						if($username ==='' and $password === '' )
						{
							$arrSql[]="CREATE DATABASE IF NOT EXISTS `".$namedatabase."` /*!40100 DEFAULT CHARACTER SET utf8 */;";
							$arrSql[]="USE `".$namedatabase."`;";
						}
						
						
						$arrSql[]="CREATE TABLE IF NOT EXISTS `estore_advertisements` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `name` varchar(256) CHARACTER SET utf8 NOT NULL,
  `link` varchar(256) CHARACTER SET ucs2 NOT NULL,
  `images` varchar(256) CHARACTER SET utf8 NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `status` int(2) NOT NULL,
  `display` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;";
						
						$arrSql[]="INSERT INTO `estore_advertisements` (`id`, `estore_id`, `name`, `link`, `images`, `created`, `modified`, `status`, `display`) VALUES
						(25,$shop_id, 'cong ty abc', 'http://zing.vn', 'img/gallery/88654b0d4c2e2d7b8a4fd519f870c2b3.jpg', '2011-10-03', '2012-09-14', 1, 1),
						(24,$shop_id, 'quang cao', 'http://dantri.com.vn', 'img/gallery/19c4d76ab1090e42cd476cf7974f419c.jpg', '2011-10-03', '2012-09-14', 1, 2),
						(26,$shop_id, 'cong ty abc', 'http://zing.vn', 'img/gallery/aed5ce1f0358efc5b80877da0fd817d8.jpg', '2011-10-03', '2012-09-14', 1, 0),
						(27,$shop_id, 'zx', 'http://agribank.com.vn', 'img/gallery/69dbb1013ad45d844e128bd7facea6ee.jpg', '2012-09-14', '2012-09-14', 1, 2),
						(28,$shop_id, 'zx', 'http://agribank.com.vn', 'img/gallery/69dbb1013ad45d844e128bd7facea6ee.jpg', '2012-09-14', '2012-09-14', 1, 2),
						(29,$shop_id, 'quang cao', 'http://truongthanhauto.com.vn', 'img/gallery/69dbb1013ad45d844e128bd7facea6ee.jpg', '2012-09-14', '2012-09-14', 1, 2),
						(30,$shop_id, 'asdasd', 'http://duhocdailoan.info', 'img/gallery/8dc8529c47186151846ae23b345e835b.jpg', '2012-09-14', '2012-09-14', 1, 3),
						(31,$shop_id, 'asdsd', 'http://dantri.com.vn', 'img/gallery/1cf5b8f4b563947b0c3b8c29142215c9.jpg', '2012-09-14', '2012-09-14', 1, 3),
						(32,$shop_id, 'asdasd', 'http://zing.vn', 'img/gallery/8dc8529c47186151846ae23b345e835b.jpg', '2012-09-14', '2012-09-14', 1, 3);";
						
						$arrSql[]="CREATE TABLE IF NOT EXISTS `estore_albums` (
  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
  `tt` int(10) DEFAULT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `status` int(2) NOT NULL,
  `name_eg` varchar(255) DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=207 DEFAULT CHARSET=utf8;";
						
						$arrSql[]="INSERT INTO `estore_albums` (`id`, `estore_id`, `tt`, `parent_id`, `lft`, `rght`, `name`, `created`, `modified`, `status`, `name_eg`, `images`) VALUES
						(204,$shop_id, NULL, NULL, 1, 2, 'Ảnh khánh thành dây truyền mới', '2012-05-07', '2012-06-18', 1, 'Picture of new line inauguration', 'img/upload/product/2a1bd4f22b63ff775ad0cc8db96591aa.jpg'),
						(206,$shop_id, NULL, NULL, 3, 4, 'Họp ngày 30/04/2012', '2012-05-08', '2012-06-18', 1, 'on 30th April, 2012', 'img/upload/product/102e31ae3f441fbcb391f9e5a26bcbb9.jpg');";
						
						$arrSql[]="CREATE TABLE IF NOT EXISTS `estore_answerquestions` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `name` varchar(256) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `mobile` varchar(256) CHARACTER SET utf8 NOT NULL,
  `address` varchar(225) CHARACTER SET utf8 NOT NULL,
  `title` varchar(225) CHARACTER SET utf8 NOT NULL,
  `introduction` text CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `answer` text CHARACTER SET utf8 NOT NULL,
  `created` datetime NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;";
						
						$arrSql[]="CREATE TABLE IF NOT EXISTS `estore_banners` (
  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
  `name` varchar(250) NOT NULL,
  `images` varchar(250) NOT NULL,
  `created` datetime NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;";
						
						$arrSql[]="INSERT INTO `estore_banners` (`id`, `estore_id`, `name`, `images`, `created`, `status`) VALUES
						(1,$shop_id, 'banner', 'img/gallery/af69e2816dec568215d831d8457b36eb.jpg', '2011-10-02 18:16:41', 1);";
						
						$arrSql[]="CREATE TABLE IF NOT EXISTS `estore_categories` (
  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
  `tt` int(10) DEFAULT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `name_en` varchar(256) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `status` int(2) NOT NULL,
  `images` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=229 DEFAULT CHARSET=utf8;";
						
						$arrSql[]="INSERT INTO `estore_categories` (`id`, `estore_id`, `tt`, `parent_id`, `lft`, `rght`, `name`, `name_en`, `created`, `modified`, `status`, `images`, `alias`) VALUES
						(146,$shop_id, 0, 224, 16, 17, 'GIỚI THIỆU', 'ABOUT US', '2011-09-27', '2012-09-14', 1, '', 'gioi-thieu'),
						(156,$shop_id, 3, 224, 2, 7, 'KHUYẾN MÃI', 'PROMOTION', '2011-09-27', '2012-09-14', 1, '', 'khuyen-mai'),
						(224,$shop_id, NULL, NULL, 1, 18, 'SẢN PHẨM', 'PRODUCT', '2012-07-23', '2012-09-14', 1, '', 'danh-muc-tin-tuc-dich-vu-tu-van'),
						(225,$shop_id, 4, 224, 14, 15, 'TUYỂN DỤNG', 'RECRUITMENT', '2012-07-23', '2012-09-14', 1, '', 'tuyen-dung'),
						(226,$shop_id, 1, 224, 8, 9, 'DỊCH VỤ', 'SERVICE', '2012-07-23', '2012-09-14', 1, '', 'dich-vu'),
						(227,$shop_id, 2, 224, 10, 11, 'TƯ VẤN', 'CONSULTANCY', '2012-07-23', '2012-09-14', 1, '', 'tu-van'),
						(228,$shop_id, 5, 224, 12, 13, 'TRỢ GIÚP', 'HELP', '2012-07-23', '2012-09-14', 1, '', 'tro-giup');";
						
						$arrSql[]="CREATE TABLE IF NOT EXISTS `estore_catproducts` (
  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
  `parent_id` int(10) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `name_en` varchar(250) CHARACTER SET ucs2 NOT NULL,
  `created` date NOT NULL,
  `modified` datetime NOT NULL,
  `status` int(2) NOT NULL,
  `char` int(10) DEFAULT NULL,
  `images` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=142 DEFAULT CHARSET=latin1;";
						
						$arrSql[]="INSERT INTO `estore_catproducts` (`id`, `estore_id`, `parent_id`, `lft`, `rght`, `name`, `name_en`, `created`, `modified`, `status`, `char`, `images`, `alias`) VALUES
						(141,$shop_id, 140, 5, 6, 'cap3', '', '2014-08-29', '2014-08-29 13:20:46', 1, NULL, '', 'cap3'),
						(139,$shop_id, 124, 3, 8, 'cap 1', '', '2014-08-29', '2014-08-29 13:20:21', 1, NULL, '', 'cap-1'),
						(140,$shop_id, 139, 4, 7, 'cap2', '', '2014-08-29', '2014-08-29 13:20:35', 1, NULL, '', 'cap2'),
						(136,$shop_id, 130, 32, 33, 'Accesories', 'Accesories', '2014-08-27', '2014-08-27 10:49:16', 1, NULL, '', 'accesories'),
						(134,$shop_id, 130, 28, 29, 'Shoes', 'Shoes', '2014-08-27', '2014-08-27 10:48:42', 1, NULL, '', 'shoes'),
						(135,$shop_id, 130, 30, 31, 'Shirts', 'Shirts', '2014-08-27', '2014-08-27 10:48:54', 1, NULL, '', 'shirts'),
						(133,$shop_id, 130, 26, 27, 'Jumpers', 'Jumpers', '2014-08-27', '2014-08-27 10:48:28', 1, NULL, '', 'jumpers'),
						(132,$shop_id, 130, 24, 25, 'Jackets', 'Jackets', '2014-08-27', '2014-08-27 10:48:15', 1, NULL, '', 'jackets'),
						(130,$shop_id, 0, 21, 34, 'Mens', 'Mens', '2014-08-27', '2014-08-27 10:47:30', 1, NULL, '', 'mens'),
						(131,$shop_id, 130, 22, 23, 'T-Shirts', 'T-Shirts', '2014-08-27', '2014-08-27 10:47:58', 1, NULL, '', 't-shirts'),
						(129,$shop_id, 123, 18, 19, 'Accessories', 'Accessories', '2014-08-27', '2014-08-27 10:46:15', 1, NULL, '', 'accessories'),
						(128,$shop_id, 123, 16, 17, 'Tops', 'Tops', '2014-08-27', '2014-08-27 10:46:04', 1, NULL, '', 'tops'),
						(127,$shop_id, 123, 14, 15, 'Trousers', 'Trousers', '2014-08-27', '2014-08-27 10:45:54', 1, NULL, '', 'trousers'),
						(125,$shop_id, 123, 10, 11, 'Dresses', 'Dresses', '2014-08-27', '2014-08-27 10:45:26', 1, NULL, '', 'dresses'),
						(126,$shop_id, 123, 12, 13, 'Bags', 'Bags', '2014-08-27', '2014-08-27 10:45:42', 1, NULL, '', 'bags'),
						(123,$shop_id, 0, 1, 20, 'Womens', 'Womens', '2014-08-27', '2014-08-27 10:34:33', 1, NULL, '', 'womens'),
						(124,$shop_id, 123, 2, 9, 'Shoes', 'Shoes', '2014-08-27', '2014-08-27 10:34:54', 1, NULL, '', 'shoes');";
						
						$arrSql[]="CREATE TABLE IF NOT EXISTS `estore_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `id_news` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;";
						
						$arrSql[]="INSERT INTO `estore_comments` (`id`, `estore_id`, `title`, `name`, `content`, `id_news`, `user_id`, `email`, `created`, `status`) VALUES
						(67,$shop_id, '', 'Nguyễn hải', 'Chất lượng moto rất tốt', 0, 0, 'hai@gmail.com', '2012-07-26 01:25:36', 1),
						(66,$shop_id, '', 'Nguyễn Nam', 'Kiểu dáng thật tuyệt', 0, 0, 'nguyennam@gmail.com', '2012-07-26 01:17:16', 1),
						(68,$shop_id, '', 'Nguyễn Thanh Tùng', 'Tôi muốn mua xe iata xin hướng dẫn cho tôi', 0, 0, 'nt2ungvn@gmail.com', '2012-07-26 01:38:49', 1),
						(69,$shop_id, '', 'Hồ Hoài', 'Chất lượng của công ty phục vụ rất rốt!', 0, 0, 'hohoai@yahoo.com', '2012-07-26 02:24:11', 0),
						(70,$shop_id, '', 'Hương', 'Các bạn thử tới công ty nhé\', ở nơi này có rất nhiều cảnh đẹp. Con người rất ôn hòa!', 0, 0, 'huong86@yahoo.com', '2012-07-26 02:29:13', 1),
						(73,$shop_id, '', 'Hoàng Phúc', 'Hoàng Phúc', 0, 0, 'phuca4@gmail.com', '2014-07-27 03:04:51', 1),
						(74,$shop_id, '', 'Hay đó nhé', 'Uh hay Lắm đó', 0, 0, 'phuca4@gmail.com', '2014-07-27 03:06:08', 1);";
						
						$arrSql[]="CREATE TABLE IF NOT EXISTS `estore_contacts` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `company` varchar(200) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `content_send` text,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;";
						
						
						$arrSql[]="INSERT INTO `estore_contacts` (`id`, `estore_id`, `name`, `email`, `mobile`, `fax`, `company`, `title`, `content`, `content_send`, `created`, `modified`, `status`) VALUES
						(4,$shop_id, 'Hoàng Công Phúc', 'phua4@gmail.com', '01688504263', '09487547584', 'Công ty abc', 'Chúc may mắn', 'dang test mail', '<p>\r\n	you are me and i am you</p>\r\n', '2011-07-04', '2011-07-04', 1),
						(5,$shop_id, 'hoang conm phuc', 'phuca4@gmail.com', '', NULL, NULL, 'testting mail', '', NULL, '2014-08-29', '2014-08-29', 0),
						(6,$shop_id, 'hosddffdf', 'phuca4@gmail.com', '', NULL, NULL, 'cvvcvc', '', NULL, '2014-08-29', '2014-08-29', 0),
						(7,$shop_id, 'hosddffdf', 'phuca4@gmail.com', '', NULL, NULL, 'cvvcvc', '', NULL, '2014-08-29', '2014-08-29', 0),
						(8,$shop_id, 'hoang conm phuc', 'phuca4@gmail.com', '', NULL, NULL, 'testfasasas', 'sdssdsdsds', NULL, '2014-08-29', '2014-08-29', 0),
						(9,$shop_id, 'tttttt', 'phuca4@gmail.com', '', NULL, NULL, 'tttttttt', 'rrrrrrrrrrrrrrrrrrrrrr', NULL, '2014-08-29', '2014-08-29', 0),
						(10,$shop_id, '', '', '', NULL, NULL, '', '', NULL, '2014-08-29', '2014-08-29', 0),
						(11,$shop_id, '', '', '', NULL, NULL, '', '', NULL, '2014-08-29', '2014-08-29', 0),
						(12,$shop_id, 'tetsststsas', 'phuca4@gmail.com', '', NULL, NULL, 'dsdsdsds', 'dsdsdsdsd', NULL, '2014-08-29', '2014-08-29', 0);";
						
						$arrSql[]="CREATE TABLE IF NOT EXISTS `estore_galleries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `images` varchar(255) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `status` int(1) NOT NULL,
  `album_id` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;";
						
						
						$arrSql[]="INSERT INTO `estore_galleries` (`id`, `estore_id`, `name`, `images`, `created`, `modified`, `status`, `album_id`) VALUES
						(67,$shop_id, 'anh 4', 'img/gallery/43d68f446ea7527b3dc6daddc6dc80df.jpg', '2012-06-19', '2012-06-19', 1, 204),
						(68,$shop_id, 'anh 5', 'img/gallery/2cf9661dce136d9f6ca6bfce24933a71.jpg', '2012-06-19', '2012-06-19', 1, 204),
						(64,$shop_id, 'anh 3', 'img/gallery/0452ded776f37827ca4887da56816ba8.jpg', '2012-05-08', '2012-06-19', 1, 206),
						(65,$shop_id, 'anh 2', 'img/gallery/e19281319ecba7282bcd8239287056d7.jpg', '2012-05-08', '2012-06-19', 1, 206),
						(66,$shop_id, 'Anh dep', 'img/gallery/7db208fcf126d1bb3cfee4c6b6bacf62.jpg', '2012-05-08', '2012-06-19', 1, 206);";
						
						$arrSql[]="CREATE TABLE IF NOT EXISTS `estore_helps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `title` varchar(200) NOT NULL,
  `title_en` varchar(200) NOT NULL,
  `user_support` varchar(200) DEFAULT NULL,
  `user_yahoo` varchar(200) DEFAULT NULL,
  `user_skype` varchar(200) DEFAULT NULL,
  `user_mobile` varchar(20) DEFAULT NULL,
  `user_email` varchar(30) DEFAULT NULL,
  `hotline` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `user_yahoo1` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_yahoo2` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_yahoo3` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;";
						
						
						$arrSql[]="INSERT INTO `estore_helps` (`id`, `estore_id`, `title`, `title_en`, `user_support`, `user_yahoo`, `user_skype`, `user_mobile`, `user_email`, `hotline`, `created`, `modified`, `status`, `user_yahoo1`, `user_yahoo2`, `user_yahoo3`) VALUES
						(7,$shop_id, 'Tư vấn', 'Support', 'Hoàng Công Phúc', 'adv.golbalmedia2', 'adv.golbalmedia2', '043.8281.768', 'phuca4@gmail.com', '043.8281.768', '2012-06-14 11:19:25', '2014-07-27 17:57:17', 1, 'phuca478', 'phuca478', 'phuca478'),
						(8,$shop_id, 'Kỹ Thuật', 'Technology', 'Mr. Phúc', 'adv.golbalmedia2', 'adv.golbalmedia2', '01229525955', 'phuca4@gmail.com', NULL, '2012-08-22 12:03:14', '2014-07-27 17:57:26', 1, 'phuca478', 'phuca478', 'phuca478');";
						
						$arrSql[]="CREATE TABLE IF NOT EXISTS `estore_helpsd` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `name` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `name1` varchar(256) CHARACTER SET utf8 NOT NULL,
  `name2` varchar(256) CHARACTER SET utf8 NOT NULL,
  `title` varchar(256) CHARACTER SET utf8 NOT NULL,
  `sdt` varchar(20) DEFAULT NULL,
  `sdt1` varchar(20) NOT NULL,
  `sdt2` varchar(20) NOT NULL,
  `yahoo` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `yahoo1` varchar(256) CHARACTER SET utf8 NOT NULL,
  `yahoo2` varchar(256) NOT NULL,
  `skype` varchar(256) DEFAULT NULL,
  `skype1` varchar(256) CHARACTER SET utf8 NOT NULL,
  `skype2` varchar(256) CHARACTER SET utf8 NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;";
						
						$arrSql[]="INSERT INTO `estore_helpsd` (`id`, `estore_id`, `name`, `name1`, `name2`, `title`, `sdt`, `sdt1`, `sdt2`, `yahoo`, `yahoo1`, `yahoo2`, `skype`, `skype1`, `skype2`, `created`, `modified`, `status`) VALUES
						(22,$shop_id, 'Kỹ thuật 1', '', '', '', NULL, '04 38515107', '09 38515108', NULL, 'vulamnguyen', 'vulamnguyen', 'haihs26', '', '', '2011-12-06 10:08:49', '2012-06-14 10:25:11', 1);";
						
						$arrSql[]="CREATE TABLE IF NOT EXISTS `estore_infomationdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `infomations_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `images` varchar(250) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;";
						
						$arrSql[]="INSERT INTO `estore_infomationdetails` (`id`, `estore_id`, `infomations_id`, `product_id`, `name`, `images`, `quantity`, `price`) VALUES
						(5,$shop_id, 36, 19, 'sp14', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_27.jpg', 1, 200),
						(6,$shop_id, 36, 20, 'sp13', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 1, 400),
						(7,$shop_id, 37, 20, 'sp13', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 2, 400),
						(8,$shop_id, 37, 19, 'sp14', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_27.jpg', 1, 200),
						(9,$shop_id, 38, 21, 'sp2', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_17.jpg', 1, 300),
						(10,$shop_id, 38, 27, 'sp3', '/khieuvu/estoreadmin/webroot/upload/image/files/3.jpg', 1, 200),
						(11,$shop_id, 39, 27, 'sp3', '/khieuvu/estoreadmin/webroot/upload/image/files/3.jpg', 23, 200),
						(12,$shop_id, 40, 25, 'sp1', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_09.jpg', 3, 120),
						(13,$shop_id, 40, 26, 'sp43', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 1, 120000),
						(14,$shop_id, 41, 21, 'sp2', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_17.jpg', 2, 300),
						(15,$shop_id, 41, 19, 'sp14', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_27.jpg', 1, 200),
						(16,$shop_id, 41, 26, 'sp43', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 1, 120000),
						(17,$shop_id, 42, 26, 'sp43', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 5, 120000),
						(18,$shop_id, 43, 32, 'sp565', '/khieuvu/estoreadmin/webroot/upload/image/files/bg_menu_20.jpg', 2, 20000),
						(19,$shop_id, 44, 64, 'sp5', '/estoreadmin/webroot/upload/image/files/vietsys_53.jpg', 1, 40000),
						(20,$shop_id, 44, 48, 'sp4', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
						(21,$shop_id, 44, 61, 'sp2', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
						(22,$shop_id, 44, 49, 'sp5', '/estoreadmin/webroot/upload/image/files/vietsys_53.jpg', 1, 40000),
						(23,$shop_id, 45, 63, 'sp4', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
						(24,$shop_id, 46, 49, 'sp5', '/estoreadmin/webroot/upload/image/files/vietsys_53.jpg', 1, 40000),
						(25,$shop_id, 46, 50, 'sp6', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
						(26,$shop_id, 47, 64, 'sp5', '/estoreadmin/webroot/upload/image/files/vietsys_53.jpg', 1, 40000),
						(27,$shop_id, 47, 78, 'sp4', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
						(28,$shop_id, 48, 73, 'sp4', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
						(29,$shop_id, 51, 243, 'Tủ chữ L nhiều ngăn', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', 1, 4500000),
						(30,$shop_id, 51, 245, 'Bếp cho quán ăn vừa và nhỏ', 'img/upload/3007b340574bcfd67cc42fd18c74d9b0.jpg', 1, 160000),
						(31,$shop_id, 52, 243, 'Tủ chữ L nhiều ngăn', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', 1, 4500000),
						(32,$shop_id, 52, 232, 'Bếp trung bình chữ I', 'img/upload/06e0bd26dd69280f9c14e247b49a3ec6.jpg', 2, 2300000),
						(33,$shop_id, 53, 218, 'Bến nhà hàng', 'img/upload/3007b340574bcfd67cc42fd18c74d9b0.jpg', 3, 3500000),
						(34,$shop_id, 53, 243, 'Tủ chữ L nhiều ngăn', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', 1, 4500000),
						(35,$shop_id, 54, 243, 'Tủ chữ L nhiều ngăn', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', 1, 4500000),
						(36,$shop_id, 54, 231, 'Bếp trung bình chữ I', 'img/upload/06e0bd26dd69280f9c14e247b49a3ec6.jpg', 3, 2300000);";
						
						$arrSql[]="CREATE TABLE IF NOT EXISTS `estore_infomations` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `idnew` int(10) NOT NULL,
  `user_id` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT 'null',
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `address` varchar(300) CHARACTER SET utf8 NOT NULL,
  `mobile` int(15) DEFAULT NULL,
  `comment` varchar(300) CHARACTER SET utf8 NOT NULL,
  `deal` text CHARACTER SET utf8,
  `company` varchar(255) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `fax` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `country` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `datereturn` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `fullname_male` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `fullname_female` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `questions_day` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `wedding_day` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `title_question` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `wedding_title` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `name_product` varchar(250) NOT NULL,
  `images` varchar(250) NOT NULL,
  `sl` varchar(250) NOT NULL,
  `price` varchar(250) NOT NULL,
  `total` varchar(250) NOT NULL,
  `orther` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `created` datetime NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;";
						
						$arrSql[]="INSERT INTO `estore_infomations` (`id`, `estore_id`, `idnew`, `user_id`, `name`, `email`, `address`, `mobile`, `comment`, `deal`, `company`, `phone`, `fax`, `country`, `datereturn`, `fullname_male`, `fullname_female`, `questions_day`, `wedding_day`, `title_question`, `wedding_title`, `name_product`, `images`, `sl`, `price`, `total`, `orther`, `created`, `status`) VALUES
						(71,$shop_id, 0, 'id395142', '', '', '', NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '58000', NULL, '2014-08-31 18:04:15', 0),
						(70,$shop_id, 0, '17', 'admin', '', '', NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '58000', NULL, '2014-08-31 18:01:40', 0),
						(68,$shop_id, 0, '17', 'admin', '', '', NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '499000', NULL, '2014-08-31 16:09:52', 0),
						(69,$shop_id, 0, '17', 'admin', '', '', NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '58000', NULL, '2014-08-31 16:11:57', 0),
						(67,$shop_id, 0, '17', 'admin', '', '', NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '58000', NULL, '2014-08-31 16:05:06', 0),
						(66,$shop_id, 0, '17', 'admin', '', '', NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '38000', NULL, '2014-08-31 16:01:21', 0),
						(65,$shop_id, 0, 'id474793', 'zxzx', 'zxz', 'xzxz', NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '72000', NULL, '2014-08-31 15:59:42', 0),
						(64,$shop_id, 0, 'id770539', '', '', '', NULL, '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '140000', NULL, '2014-08-31 15:59:02', 0),
						(63,$shop_id, 0, 'id674042', 'phuassdn', 'phuca4@gmail.com', 'Ha Noi', 978656787, '', NULL, '', '0978656787', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '228000', NULL, '2014-08-30 12:13:07', 0),
						(62,$shop_id, 0, 'id730652', 'ghh', 'phuca4@gmail.com', 'Ha Noi', 997787878, '', NULL, '', '0997787878', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '174000', NULL, '2014-08-30 11:50:49', 0);";
						
						$arrSql[]="CREATE TABLE IF NOT EXISTS `estore_manufacturers` (
  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
  `parent_id` int(10) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `created` date NOT NULL,
  `modified` datetime NOT NULL,
  `status` int(2) NOT NULL,
  `char` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=271 DEFAULT CHARSET=latin1;";
						
						$arrSql[]="INSERT INTO `estore_manufacturers` (`id`, `estore_id`, `parent_id`, `lft`, `rght`, `name`, `created`, `modified`, `status`, `char`) VALUES
						(135,$shop_id, NULL, 1, 28, 'Rigth', '2012-05-18', '2012-09-13 17:55:06', 1, NULL),
						(136,$shop_id, NULL, 29, 62, 'Toyota', '2012-05-18', '2012-06-04 06:57:18', 1, NULL),
						(137,$shop_id, NULL, 63, 80, 'Daewoo', '2012-05-18', '2012-06-21 06:25:09', 1, NULL),
						(138,$shop_id, NULL, 81, 92, 'Ford', '2012-05-18', '2012-06-19 13:11:22', 1, NULL),
						(139,$shop_id, NULL, 93, 116, 'BMW', '2012-05-18', '2012-05-18 13:50:13', 1, NULL),
						(140,$shop_id, NULL, 117, 130, 'Nissan', '2012-05-18', '2012-05-18 13:50:25', 1, NULL),
						(141,$shop_id, NULL, 131, 144, 'Suzuki', '2012-05-18', '2012-05-18 13:50:51', 1, NULL),
						(142,$shop_id, NULL, 145, 168, 'Audi', '2012-05-24', '2012-05-24 08:07:17', 1, NULL),
						(143,$shop_id, NULL, 169, 184, 'Mitsubishi', '2012-05-24', '2012-05-24 08:08:10', 1, NULL),
						(144,$shop_id, NULL, 185, 200, 'Kia', '2012-05-24', '2014-07-27 10:05:08', 1, NULL),
						(145,$shop_id, NULL, 201, 214, 'Ford', '2012-05-24', '2012-06-21 06:11:02', 0, NULL),
						(146,$shop_id, NULL, 215, 230, 'Hyundai', '2012-05-24', '2012-06-19 13:00:19', 1, NULL),
						(148,$shop_id, NULL, 231, 244, 'Mercedes ', '2012-05-28', '2012-05-28 07:49:40', 1, NULL);";
						
						$arrSql[]="CREATE TABLE IF NOT EXISTS `estore_news` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `title_en` varchar(256) NOT NULL,
  `introduction` text NOT NULL,
  `introduction_en` text NOT NULL,
  `content` text,
  `content_en` text NOT NULL,
  `images` varchar(256) NOT NULL,
  `images_en` varchar(256) NOT NULL,
  `category_id` int(11) NOT NULL,
  `source` varchar(200) NOT NULL,
  `view` int(50) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` int(1) DEFAULT '0',
  `hotnew` tinyint(4) DEFAULT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=128 DEFAULT CHARSET=utf8;";
						
						$arrSql[]="INSERT INTO `estore_news` (`id`, `estore_id`, `user_id`, `title`, `title_en`, `introduction`, `introduction_en`, `content`, `content_en`, `images`, `images_en`, `category_id`, `source`, `view`, `created`, `modified`, `status`, `hotnew`, `alias`) VALUES
						(115,$shop_id, 0, 'Cách thanh toán', 'Method of payment', '<p>\r\n	sfsdf</p>\r\n', '', '<p>\r\n	sdfsdf</p>\r\n', '', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', '', 156, '', 0, '2012-07-09 13:55:44', '2012-08-22 11:57:00', 1, NULL, ''),
						(95,$shop_id, 0, 'Đèn trung thu', 'Mid-autumn lamp', '<p>\r\n	<span style=\"font-size:14px;\">Những chiếc đ&egrave;n b&agrave;n trang tr&iacute; n&agrave;y l&agrave; sự kết hợp giữa chất liệu vả của chụp đ&egrave;n v&agrave; <a href=\"http://www.webhangdoc.com/hang-doc/gom-phong-thuy.html\" target=\"_blank\">gốm</a> sứ của phần th&acirc;n đ&egrave;n mang lại vẻ đẹp trang trọng, hiện đại v&agrave; tinh tế cho căn ph&ograve;ng của bạn. Bạn c&oacute; thể đặt đ&egrave;n trang tr&iacute; ở nhiều kh&ocirc;ng gian trong ng&ocirc;i nh&agrave;, từ ph&ograve;ng ngủ, ph&ograve;ng kh&aacute;ch đến ph&ograve;ng đọc s&aacute;ch, ph&ograve;ng giải tr&iacute; cho gia đ&igrave;nh. Đ&acirc;y l&agrave; một c&aacute;ch trang tr&iacute; nh&agrave; rất s&aacute;ng tạo thể hiện thẩm mỹ cao của gia chủ.<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	Đ&egrave;n trang tr&iacute; - <a href=\"http://www.shopdentrangtri.com/\" target=\"_blank\" title=\"\"><em><strong>den trang tri</strong></em></a> c&oacute; nhiều kiểu d&aacute;ng mẫu m&atilde; phần th&acirc;n đ&egrave;n cho bạn lựa chọn. C&aacute;c chất liệu <a href=\"http://www.webhangdoc.com/hang-doc/gom-phong-thuy.html\" target=\"_blank\">gốm</a> sứ l&agrave;m n&ecirc;n đ&egrave;n cũng kh&aacute; <a href=\"http://www.webhangdoc.com/\" target=\"_blank\">độc đ&aacute;o</a> v&agrave; lạ mắt. C&oacute; những chiếc đ&egrave;n c&oacute; phần th&acirc;n l&agrave; b&igrave;nh gốm x&ugrave; x&igrave; th&ocirc; mộc nhưng lại mang n&eacute;t c&aacute; t&iacute;nh v&agrave; phong c&aacute;ch. Cũng c&oacute; những chiếc đ&egrave;n c&oacute; phần th&acirc;n được l&agrave;m từ sứ cao cấp với m&agrave;u sắc tươi s&aacute;ng, trong trẻo. Độc đ&aacute;o hơn với những chiếc b&igrave;nh với v&acirc;n đ&aacute; rất đẹp v&agrave; sang trọng.</span></p>\r\n', '<p>\r\n	Những chiếc đ&egrave;n b&agrave;n trang tr&iacute; n&agrave;y l&agrave; sự kết hợp giữa chất liệu vả của chụp đ&egrave;n v&agrave; <a href=\"http://www.webhangdoc.com/hang-doc/gom-phong-thuy.html\" target=\"_blank\">gốm</a> sứ của phần th&acirc;n đ&egrave;n mang lại vẻ đẹp trang trọng, hiện đại v&agrave; tinh tế cho căn ph&ograve;ng của bạn. Bạn c&oacute; thể đặt đ&egrave;n trang tr&iacute; ở nhiều kh&ocirc;ng gian trong ng&ocirc;i nh&agrave;, từ ph&ograve;ng ngủ, ph&ograve;ng kh&aacute;ch đến ph&ograve;ng đọc s&aacute;ch, ph&ograve;ng giải tr&iacute; cho gia đ&igrave;nh. Đ&acirc;y l&agrave; một c&aacute;ch trang tr&iacute; nh&agrave; rất s&aacute;ng tạo thể hiện thẩm mỹ cao của gia chủ.</p>\r\n', '<p>\r\n	<span style=\"font-size:14px;\">Những chiếc đ&egrave;n b&agrave;n trang tr&iacute; n&agrave;y l&agrave; sự kết hợp giữa chất liệu vả của chụp đ&egrave;n v&agrave; <a href=\"http://www.webhangdoc.com/hang-doc/gom-phong-thuy.html\" target=\"_blank\">gốm</a> sứ của phần th&acirc;n đ&egrave;n mang lại vẻ đẹp trang trọng, hiện đại v&agrave; tinh tế cho căn ph&ograve;ng của bạn. Bạn c&oacute; thể đặt đ&egrave;n trang tr&iacute; ở nhiều kh&ocirc;ng gian trong ng&ocirc;i nh&agrave;, từ ph&ograve;ng ngủ, ph&ograve;ng kh&aacute;ch đến ph&ograve;ng đọc s&aacute;ch, ph&ograve;ng giải tr&iacute; cho gia đ&igrave;nh. Đ&acirc;y l&agrave; một c&aacute;ch trang tr&iacute; nh&agrave; rất s&aacute;ng tạo thể hiện thẩm mỹ cao của gia chủ.<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	Đ&egrave;n trang tr&iacute; - <a href=\"http://www.shopdentrangtri.com/\" target=\"_blank\" title=\"\"><em><strong>den trang tri</strong></em></a> c&oacute; nhiều kiểu d&aacute;ng mẫu m&atilde; phần th&acirc;n đ&egrave;n cho bạn lựa chọn. C&aacute;c chất liệu <a href=\"http://www.webhangdoc.com/hang-doc/gom-phong-thuy.html\" target=\"_blank\">gốm</a> sứ l&agrave;m n&ecirc;n đ&egrave;n cũng kh&aacute; <a href=\"http://www.webhangdoc.com/\" target=\"_blank\">độc đ&aacute;o</a> v&agrave; lạ mắt. C&oacute; những chiếc đ&egrave;n c&oacute; phần th&acirc;n l&agrave; b&igrave;nh gốm x&ugrave; x&igrave; th&ocirc; mộc nhưng lại mang n&eacute;t c&aacute; t&iacute;nh v&agrave; phong c&aacute;ch. Cũng c&oacute; những chiếc đ&egrave;n c&oacute; phần th&acirc;n được l&agrave;m từ sứ cao cấp với m&agrave;u sắc tươi s&aacute;ng, trong trẻo. Độc đ&aacute;o hơn với những chiếc b&igrave;nh với v&acirc;n đ&aacute; rất đẹp v&agrave; sang trọng.</span></p>\r\n', '<p>\r\n	Những chiếc đ&egrave;n b&agrave;n trang tr&iacute; n&agrave;y l&agrave; sự kết hợp giữa chất liệu vả của chụp đ&egrave;n v&agrave; <a href=\"http://www.webhangdoc.com/hang-doc/gom-phong-thuy.html\" target=\"_blank\">gốm</a> sứ của phần th&acirc;n đ&egrave;n mang lại vẻ đẹp trang trọng, hiện đại v&agrave; tinh tế cho căn ph&ograve;ng của bạn. Bạn c&oacute; thể đặt đ&egrave;n trang tr&iacute; ở nhiều kh&ocirc;ng gian trong ng&ocirc;i nh&agrave;, từ ph&ograve;ng ngủ, ph&ograve;ng kh&aacute;ch đến ph&ograve;ng đọc s&aacute;ch, ph&ograve;ng giải tr&iacute; cho gia đ&igrave;nh. Đ&acirc;y l&agrave; một c&aacute;ch trang tr&iacute; nh&agrave; rất s&aacute;ng tạo thể hiện thẩm mỹ cao của gia chủ.<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	Đ&egrave;n trang tr&iacute; - <a href=\"http://www.shopdentrangtri.com/\" target=\"_blank\" title=\"\"><em><strong>den trang tri</strong></em></a> c&oacute; nhiều kiểu d&aacute;ng mẫu m&atilde; phần th&acirc;n đ&egrave;n cho bạn lựa chọn. C&aacute;c chất liệu <a href=\"http://www.webhangdoc.com/hang-doc/gom-phong-thuy.html\" target=\"_blank\">gốm</a> sứ l&agrave;m n&ecirc;n đ&egrave;n cũng kh&aacute; <a href=\"http://www.webhangdoc.com/\" target=\"_blank\">độc đ&aacute;o</a> v&agrave; lạ mắt. C&oacute; những chiếc đ&egrave;n c&oacute; phần th&acirc;n l&agrave; b&igrave;nh gốm x&ugrave; x&igrave; th&ocirc; mộc nhưng lại mang n&eacute;t c&aacute; t&iacute;nh v&agrave; phong c&aacute;ch. Cũng c&oacute; những chiếc đ&egrave;n c&oacute; phần th&acirc;n được l&agrave;m từ sứ cao cấp với m&agrave;u sắc tươi s&aacute;ng, trong trẻo. Độc đ&aacute;o hơn với những chiếc b&igrave;nh với v&acirc;n đ&aacute; rất đẹp v&agrave; sang trọng.</p>\r\n', '/estoreadmin/webroot/upload/image/files/vietsys_71.jpg', 'img/upload/076e3caed758a1c18c91a0e9cae3368f.jpg', 156, '', 1, '2011-12-06 09:16:42', '2012-07-23 15:21:30', 1, NULL, NULL),
						(96,$shop_id, 0, 'Lộng lẫy đèn chùm', 'Splendid chandelier', '<p>\r\n	<b><span id=\"ctl00_ContentPlaceHolder1_NewsDetail1_lblSubContent\">Với kiểu d&aacute;ng thiết kế mới lạ, đ&egrave;n ch&ugrave;m ng&agrave;y nay mang lại vẻ mềm mại, sang trọng cho ng&ocirc;i nh&agrave;. Hầu hết c&aacute;c mẫu đ&egrave;n được thiết kế cầu kỳ với nhiều lớp đ&egrave;n, đ&aacute; trang tr&iacute;. Loại n&agrave;y gồm một b&oacute;ng ch&iacute;nh ở giữa s&aacute;ng nhất, c&aacute;c đ&egrave;n phụ được thiết kế xung quanh.</span></b></p>\r\n', '<p>\r\n	Enable luck with crystal chandeliersEnable luck with crystal chandeliers</p>\r\n', '<p>\r\n	<b><span id=\"ctl00_ContentPlaceHolder1_NewsDetail1_lblSubContent\">Với kiểu d&aacute;ng thiết kế mới lạ, đ&egrave;n ch&ugrave;m ng&agrave;y nay mang lại vẻ mềm mại, sang trọng cho ng&ocirc;i nh&agrave;. Hầu hết c&aacute;c mẫu đ&egrave;n được thiết kế cầu kỳ với nhiều lớp đ&egrave;n, đ&aacute; trang tr&iacute;. Loại n&agrave;y gồm một b&oacute;ng ch&iacute;nh ở giữa s&aacute;ng nhất, c&aacute;c đ&egrave;n phụ được thiết kế xung quanh.</span> </b></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<img alt=\"\" height=\"431\" src=\"http://www.denchum.net/Images/News/Sub/images/Picture1.jpg\" width=\"500\" /></p>\r\n<div>\r\n	Đ&egrave;n ch&ugrave;m rực rỡ với t&iacute;nh thẩm mỹ cao gi&uacute;p bạn t&ocirc; điểm cho ng&ocirc;i nh&agrave;</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	Tuy nhi&ecirc;n, thỉnh thoảng bạn vẫn bắt gặp kiểu đ&egrave;n ch&ugrave;m khổng lồ chỉ c&oacute; một b&oacute;ng. C&ograve;n lại l&agrave; phụ liệu đ&iacute;nh k&egrave;m, chủ yếu mang t&iacute;nh trang tr&iacute;. C&aacute;c kiểu đ&egrave;n n&agrave;y gi&uacute;p căn ph&ograve;ng trở n&ecirc;n duy&ecirc;n d&aacute;ng v&agrave; sang trọng hơn.</div>\r\n<div>\r\n	Đặc biệt chất liệu tạo n&ecirc;n c&aacute;c ch&ugrave;m đ&egrave;n rất quan trọng v&igrave; n&oacute; quyết định sự mềm mại v&agrave; n&eacute;t ri&ecirc;ng của từng kiểu đ&egrave;n. &Aacute;nh s&aacute;ng chỉ l&agrave; yếu tố phụ n&ecirc;n bạn phải thiết k&ecirc; th&ecirc;m c&aacute;c đ&egrave;n kh&aacute;c để lấy &aacute;nh s&aacute;ng cho ph&ograve;ng kh&aacute;ch.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<strong>Những lưu &yacute; khi lắp đặt đ&egrave;n ch&ugrave;m</strong></div>\r\n<div>\r\n	<img alt=\"\" height=\"267\" src=\"http://www.denchum.net/Images/News/Sub/images/Picture2.jpg\" width=\"500\" /></div>\r\n<div>\r\n	Đa dạng về kiểu d&aacute;ng, mẫu m&atilde;</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	Muốn bố tr&iacute; đ&egrave;n ch&ugrave;m, trần nh&agrave; phải cao từ 3m trở l&ecirc;n để kh&ocirc;ng g&acirc;y cảm gi&aacute;c vướng v&iacute;u, nặng nề. Kiểu đ&egrave;n cũng cần h&agrave;i ho&agrave; với c&aacute;c đ&egrave;n chiếu s&aacute;ng kh&aacute;c trong ph&ograve;ng.</div>\r\n<div>\r\n	Theo quan niệm phong thuỷ, kh&ocirc;ng n&ecirc;n lắp đ&egrave;n ch&ugrave;m trong ph&ograve;ng ngủ, nhất l&agrave; ph&iacute;a tr&ecirc;n giường. Nếu đ&egrave;n bằng chất liệu pha l&ecirc;, đ&aacute; thuỷ tinh, tốt nhất n&ecirc;n treo ở trung t&acirc;m nh&agrave; để t&iacute;ch tụ năng lượng dương cho căn ph&ograve;ng.</div>\r\n<div>\r\n	Theo Netfile</div>\r\n', '<p>\r\n	Enable luck with crystal chandeliersEnable luck with crystal chandeliersEnable luck with crystal chandeliersEnable luck with crystal chandeliersEnable luck with crystal chandeliers</p>\r\n', '/estoreadmin/webroot/upload/image/files/vietsys_68.jpg', 'img/upload/8969288f4245120e7c3870287cce0ff3.jpg', 156, '', 0, '2011-12-06 09:42:09', '2012-07-23 15:25:27', 1, NULL, NULL),
						(116,$shop_id, 0, 'About', 'About', '<p>\r\n	<span id=\"result_box\" lang=\"en\"><span title=\"Công ty TNHH thiết bị y tế và khoa học kỹ thuật Hà Nội được thành lập năm 2002 với lĩnh vực kinh doanh chính là: thiết bị y tế, thiết bị thẩm mỹ, thiết bị khoa học kỹ thuật, công nghệ và môi trường.\">Medical Equipment Co., Ltd. technical and scientific Hanoi was established in 2002 with main business areas are: medical device, aesthetic equipment, scientific equipment, technology and the environment.</span><br />\r\n	<br />\r\n	<span title=\"Tôn chỉ của chúng tôi:\">Our guiding principles:</span><br />\r\n	<br />\r\n	<span title=\"- Cung cấp tới tận tay khách hàng các sản phẩm có chất lượng và kỹ thuật cao trong ngành y tế và khoa học công nghệ môi trường với giá cả cạnh tranh nhất.\">- Provide end-customers with quality products and high technology in the health sector and environmental science and technology with the most competitive price.</span><br />\r\n	<br />\r\n	<span title=\"- Xây dựng và đào tạo một mạng lưới dịch vụ kỹ thuật sau bán hàng một cách hoàn hảo.\">- Develop and train a network of after-sales technical service perfectly.</span><br />\r\n	<br />\r\n	<span title=\"- Luôn giữ chữ “tín” và lấy lợi ích của khách hàng làm trọng.\">- Always keep the words &quot;credit&quot; and get the benefits of important customer.</span><br />\r\n	<br />\r\n	<span title=\"Sản phẩm Công ty cung cấp:\">The company offers products:</span><br />\r\n	<br />\r\n	<span title=\"- Máy soi cổ tử cung kỹ thuật số, monitor sản khoa, monitor theo dõi bệnh nhân đa thông số, hệ thống monitor trung tâm, máy cắt đốt cổ tử cung chuyên dụng, máy đo nồng độ bão hòa ô xy trong máu, bơm\">- Portable digital colposcopy, obstetrics monitor, monitor multi-parameter patient monitor, central monitor system, dedicated cervical ablation, measuring oxygen saturation in the blood, the pump </span><span title=\"tiêm điện, máy truyền dịch tự động của hãng GOLDWAY (US).,INC.\">power injection, its automatic infusion Goldway (U.S.)., INC.</span><br />\r\n	<br />\r\n	<span title=\"- Máy siêu âm đen trắng, siêu màu 4D các loại của hãng Fukuda- Nhật Bản\">- Ultrasound in black and white, super color 4D Its kind Fukuda, Japan</span><br />\r\n	<br />\r\n	<span title=\"- Máy áp lạnh cổ tử cung\">- Air pressure cervical cold</span><br />\r\n	<br />\r\n	<span title=\"- Điện não VIDEO EEG, DIGITAL EEG, điện tim của Tây Ban Nha\">- Electrical brain EEG VIDEO, DIGITAL EEG, ECG of Spain</span><br />\r\n	<br />\r\n	<span title=\"- Máy đo thính lực chuyên dụng của Tây Ban Nha\">- Dedicated audiometric of Spain</span><br />\r\n	<br />\r\n	<span title=\"- Máy đo bilirubin, hemoglobin sản xuất tại Nhật Bản\">- Bilirubin meter, hemoglobin production in Japan</span><br />\r\n	<br />\r\n	<span title=\"- Máy gây mê, máy thở, máy nghe tim thai, nội soi, điện tim, máy phát hiện vàng da.\">- Anesthesia machine, ventilator, fetal player, endoscopy, ECG, jaundice detector.</span><br />\r\n	<br />\r\n	<span title=\"- Máy xét nghiệm sinh hóa (bán tự động, tự động, tổng hợp), ELISA, dao mổ điện sản xuất tại Mỹ\">- Machine biochemical tests (semi-automatic, automatic, synthesis), ELISA, scalpels electricity produced in the U.S.</span><br />\r\n	<br />\r\n	<span title=\"- Máy xét nghiệm nước tiểu Cybow, Clinitek Status (Hàn Quốc, Anh)\">- Machine test urine Cybow, Clinitek Status (Korean, English)</span><br />\r\n	<br />\r\n	<span title=\"- Máy quang phổ UV/VIS - Nhật, tủ bảo quản dược phẩm, tủ trữ máu của Đức.\">- UV Spectrometer / VIS - Japan, pharmaceutical storage cabinets, storage cabinets German blood.</span><br />\r\n	<br />\r\n	<span title=\"- Đèn mổ (Thụy Sĩ), tủ sấy, nồi hấp (Đài Loan)...\">- Lamp (Switzerland), oven, autoclave (Taiwan) ...</span><br />\r\n	<br />\r\n	<span title=\"- Các loại thiết bị khoa học kỹ thuật chuyên dụng của Anh, Mỹ, Đức.\">- The specialized scientific and technical equipment in the UK, USA, Germany.</span><br />\r\n	<br />\r\n	<span title=\"- Các linh kiện thay thế cho các loại monitor theo dõi bệnh nhân, monitor sản khoa\">- The replacement parts for the type of monitor patient monitor, monitor obstetric</span><br />\r\n	<br />\r\n	<span title=\"Công ty có đội ngũ kỹ sư được đào tạo đúng chuyên ngành thiết bị y tế ở trong và ngoài nước.\">The company has a team of engineers who have been properly trained in medical equipment at home and abroad. </span><span title=\"Đội ngũ này không ngừng được nâng cao tay nghề thông qua các khoá đào tạo của các nhà sản xuất...\">This team constantly upgrade their skills through training of producers ...</span><br />\r\n	<br />\r\n	<span title=\"Với thế mạnh của mình, chúng tôi hy vọng rằng trong một tương lai gần, Công ty Công nghệ Quang Anh sẽ trở thành một đối tác truyền thống của Quý khách hàng với tư cách là một nhà cung cấp thiết bị y tế có giá cả\">With its strength, we hope that in the near future, the British Optical Technology Company will become a traditional partner of customers as a supplier of medical equipment pricing </span><span title=\"hợp lý nhất, chất lượng tốt nhất và dịch vụ sau bán hàng hoàn hảo.\">most affordable, best quality and perfect after-sales service.</span><br />\r\n	<br />\r\n	<span title=\"Khi cần mua thiết bị y tế- Đến với Công ty thiết bị y tế &amp; khoa học hà nội\">The need for a new medical device-Coming to medical &amp; scientific equipment hanoi</span></span></p>\r\n', '<p>\r\n	<span id=\"result_box\" lang=\"en\"><span title=\"Công ty TNHH thiết bị y tế và khoa học kỹ thuật Hà Nội được thành lập năm 2002 với lĩnh vực kinh doanh chính là: thiết bị y tế, thiết bị thẩm mỹ, thiết bị khoa học kỹ thuật, công nghệ và môi trường.\">Co., Ltd. medical equipment and scientific and technical Hanoi was established in 2002 with the main business areas: medical equipment, beauty equipment, scientific equipment, technology and environment.</span><br />\r\n	<br />\r\n	<span title=\"Tôn chỉ của chúng tôi:\">Our guiding principles:<br />\r\n	<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Cung cấp tới tận tay khách hàng các sản phẩm có chất lượng và kỹ thuật cao trong ngành y tế và khoa học công nghệ môi trường với giá cả cạnh tranh nhất.\">Hand to provide customers with quality products and high technology in the health and environmental science and technology with the most competitive prices.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Xây dựng và đào tạo một mạng lưới dịch vụ kỹ thuật sau bán hàng một cách hoàn hảo.\">Develop and train a network of technical service after the sale perfectly.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Luôn giữ chữ “tín” và lấy lợi ích của khách hàng làm trọng.\">Always keep the word &quot;credit&quot; and get the benefit of customer-focused.</span><br />\r\n	<br />\r\n	<span title=\"Sản phẩm Công ty cung cấp:\">Products The company offers:<br />\r\n	<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy soi cổ tử cung kỹ thuật số, monitor sản khoa, monitor theo dõi bệnh nhân đa thông số, hệ thống monitor trung tâm, máy cắt đốt cổ tử cung chuyên dụng, máy đo nồng độ bão hòa ô xy trong máu, bơm tiêm\">Colposcopy machine digital, monitor anesthesia, monitor patient monitor multiple parameters, the central monitor system, cervical ablation machine dedicated machine measurements of oxygen saturation levels in blood, syringes </span><span title=\"điện, máy truyền dịch tự động của hãng GOLDWAY (US).,INC.\">electric machine company infusion of automated GOLDWAY (U.S.)., INC.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy siêu âm đen trắng, siêu màu 4D các loại của hãng Fukuda- Nhật Bản\">Ultrasound machine black &amp; white, color 4D super types of firms Fukuda, Japan<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy áp lạnh cổ tử cung\">Machine cold pressure of the cervix<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Điện não VIDEO EEG, DIGITAL EEG, điện tim của Tây Ban Nha\">EEG EEG VIDEO, DIGITAL EEG, ECG of Spain<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy đo thính lực chuyên dụng của Tây Ban Nha\">Machinery specialized hearing test in Spain<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy đo bilirubin, hemoglobin sản xuất tại Nhật Bản\">Gauge bilirubin, hemoglobin production in Japan<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy gây mê, máy thở, máy nghe tim thai, nội soi, điện tim, máy phát hiện vàng da.\">Anesthesia machines, ventilators, air auscultation, endoscopy, ECG, jaundice detector.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy xét nghiệm sinh hóa (bán tự động, tự động, tổng hợp), ELISA, dao mổ điện sản xuất tại Mỹ\">Biochemical machine (semi-automatic, automatic, general), ELISA, electric knife made in USA<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy xét nghiệm nước tiểu Cybow, Clinitek Status (Hàn Quốc, Anh)\">Machine Cybow urine, Clinitek Status (Korean, English)<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy quang phổ UV/VIS - Nhật, tủ bảo quản dược phẩm, tủ trữ máu của Đức.\">Spectrophotometer UV / VIS - Japanese pharmaceutical storage cabinets, storage cabinets of German blood.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Đèn mổ (Thụy Sĩ), tủ sấy, nồi hấp (Đài Loan)...\">Lights (Switzerland), oven, steamer (Taiwan) ...<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Các loại thiết bị khoa học kỹ thuật chuyên dụng của Anh, Mỹ, Đức.\">The type of equipment dedicated science and technology in the UK, U.S., Germany.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Các linh kiện thay thế cho các loại monitor theo dõi bệnh nhân, monitor sản khoa\">Replacement parts for the type of monitor to track patients, monitor obstetric</span><br />\r\n	<br />\r\n	<span title=\"Công ty có đội ngũ kỹ sư được đào tạo đúng chuyên ngành thiết bị y tế ở trong và ngoài nước.\">The company has a team of engineers are properly trained specialized medical equipment at home and abroad. </span><span title=\"Đội ngũ này không ngừng được nâng cao tay nghề thông qua các khoá đào tạo của các nhà sản xuất...\">This team is constantly improving skills through training of manufacturers ...</span><br />\r\n	<br />\r\n	<span title=\"Với thế mạnh của mình, chúng tôi hy vọng rằng trong một tương lai gần, Công ty Công nghệ Quang Anh sẽ trở thành một đối tác truyền thống của Quý khách hàng với tư cách là một nhà cung cấp thiết bị y tế có giá cả\">With its strength, we hope that in the near future, Quang Anh Technology Company will become a traditional partner of customers as a supplier of medical equipment priced </span><span title=\"hợp lý nhất, chất lượng tốt nhất và dịch vụ sau bán hàng hoàn hảo.\">most logical, best quality and after sales service perfect.</span><br />\r\n	<br />\r\n	<span title=\"Khi cần mua thiết bị y tế- Đến với Công ty thiết bị y tế Quang Anh\">When you need to buy medical equipment-to the medical device company Quang Anh</span></span></p>\r\n', '<p>\r\n	<span id=\"result_box\" lang=\"en\"><span title=\"Công ty TNHH thiết bị y tế và khoa học kỹ thuật Hà Nội được thành lập năm 2002 với lĩnh vực kinh doanh chính là: thiết bị y tế, thiết bị thẩm mỹ, thiết bị khoa học kỹ thuật, công nghệ và môi trường.\">Medical Equipment Co., Ltd. technical and scientific Hanoi was established in 2002 with main business areas are: medical device, aesthetic equipment, scientific equipment, technology and the environment.</span><br />\r\n	<br />\r\n	<span title=\"Tôn chỉ của chúng tôi:\">Our guiding principles:</span><br />\r\n	<br />\r\n	<span title=\"- Cung cấp tới tận tay khách hàng các sản phẩm có chất lượng và kỹ thuật cao trong ngành y tế và khoa học công nghệ môi trường với giá cả cạnh tranh nhất.\">- Provide end-customers with quality products and high technology in the health sector and environmental science and technology with the most competitive price.</span><br />\r\n	<br />\r\n	<span title=\"- Xây dựng và đào tạo một mạng lưới dịch vụ kỹ thuật sau bán hàng một cách hoàn hảo.\">- Develop and train a network of after-sales technical service perfectly.</span><br />\r\n	<br />\r\n	<span title=\"- Luôn giữ chữ “tín” và lấy lợi ích của khách hàng làm trọng.\">- Always keep the words &quot;credit&quot; and get the benefits of important customer.</span><br />\r\n	<br />\r\n	<span title=\"Sản phẩm Công ty cung cấp:\">The company offers products:</span><br />\r\n	<br />\r\n	<span title=\"- Máy soi cổ tử cung kỹ thuật số, monitor sản khoa, monitor theo dõi bệnh nhân đa thông số, hệ thống monitor trung tâm, máy cắt đốt cổ tử cung chuyên dụng, máy đo nồng độ bão hòa ô xy trong máu, bơm\">- Portable digital colposcopy, obstetrics monitor, monitor multi-parameter patient monitor, central monitor system, dedicated cervical ablation, measuring oxygen saturation in the blood, the pump </span><span title=\"tiêm điện, máy truyền dịch tự động của hãng GOLDWAY (US).,INC.\">power injection, its automatic infusion Goldway (U.S.)., INC.</span><br />\r\n	<br />\r\n	<span title=\"- Máy siêu âm đen trắng, siêu màu 4D các loại của hãng Fukuda- Nhật Bản\">- Ultrasound in black and white, super color 4D Its kind Fukuda, Japan</span><br />\r\n	<br />\r\n	<span title=\"- Máy áp lạnh cổ tử cung\">- Air pressure cervical cold</span><br />\r\n	<br />\r\n	<span title=\"- Điện não VIDEO EEG, DIGITAL EEG, điện tim của Tây Ban Nha\">- Electrical brain EEG VIDEO, DIGITAL EEG, ECG of Spain</span><br />\r\n	<br />\r\n	<span title=\"- Máy đo thính lực chuyên dụng của Tây Ban Nha\">- Dedicated audiometric of Spain</span><br />\r\n	<br />\r\n	<span title=\"- Máy đo bilirubin, hemoglobin sản xuất tại Nhật Bản\">- Bilirubin meter, hemoglobin production in Japan</span><br />\r\n	<br />\r\n	<span title=\"- Máy gây mê, máy thở, máy nghe tim thai, nội soi, điện tim, máy phát hiện vàng da.\">- Anesthesia machine, ventilator, fetal player, endoscopy, ECG, jaundice detector.</span><br />\r\n	<br />\r\n	<span title=\"- Máy xét nghiệm sinh hóa (bán tự động, tự động, tổng hợp), ELISA, dao mổ điện sản xuất tại Mỹ\">- Machine biochemical tests (semi-automatic, automatic, synthesis), ELISA, scalpels electricity produced in the U.S.</span><br />\r\n	<br />\r\n	<span title=\"- Máy xét nghiệm nước tiểu Cybow, Clinitek Status (Hàn Quốc, Anh)\">- Machine test urine Cybow, Clinitek Status (Korean, English)</span><br />\r\n	<br />\r\n	<span title=\"- Máy quang phổ UV/VIS - Nhật, tủ bảo quản dược phẩm, tủ trữ máu của Đức.\">- UV Spectrometer / VIS - Japan, pharmaceutical storage cabinets, storage cabinets German blood.</span><br />\r\n	<br />\r\n	<span title=\"- Đèn mổ (Thụy Sĩ), tủ sấy, nồi hấp (Đài Loan)...\">- Lamp (Switzerland), oven, autoclave (Taiwan) ...</span><br />\r\n	<br />\r\n	<span title=\"- Các loại thiết bị khoa học kỹ thuật chuyên dụng của Anh, Mỹ, Đức.\">- The specialized scientific and technical equipment in the UK, USA, Germany.</span><br />\r\n	<br />\r\n	<span title=\"- Các linh kiện thay thế cho các loại monitor theo dõi bệnh nhân, monitor sản khoa\">- The replacement parts for the type of monitor patient monitor, monitor obstetric</span><br />\r\n	<br />\r\n	<span title=\"Công ty có đội ngũ kỹ sư được đào tạo đúng chuyên ngành thiết bị y tế ở trong và ngoài nước.\">The company has a team of engineers who have been properly trained in medical equipment at home and abroad. </span><span title=\"Đội ngũ này không ngừng được nâng cao tay nghề thông qua các khoá đào tạo của các nhà sản xuất...\">This team constantly upgrade their skills through training of producers ...</span><br />\r\n	<br />\r\n	<span title=\"Với thế mạnh của mình, chúng tôi hy vọng rằng trong một tương lai gần, Công ty Công nghệ Quang Anh sẽ trở thành một đối tác truyền thống của Quý khách hàng với tư cách là một nhà cung cấp thiết bị y tế có giá cả\">With its strength, we hope that in the near future, the British Optical Technology Company will become a traditional partner of customers as a supplier of medical equipment pricing </span><span title=\"hợp lý nhất, chất lượng tốt nhất và dịch vụ sau bán hàng hoàn hảo.\">most affordable, best quality and perfect after-sales service.</span><br />\r\n	<br />\r\n	<span title=\"Khi cần mua thiết bị y tế- Đến với Công ty thiết bị y tế &amp; khoa học hà nội\">The need for a new medical device-Coming to medical &amp; scientific equipment hanoi</span></span></p>\r\n', '<p>\r\n	<span id=\"result_box\" lang=\"en\"><span title=\"Công ty TNHH thiết bị y tế và khoa học kỹ thuật Hà Nội được thành lập năm 2002 với lĩnh vực kinh doanh chính là: thiết bị y tế, thiết bị thẩm mỹ, thiết bị khoa học kỹ thuật, công nghệ và môi trường.\">Co., Ltd. medical equipment and scientific and technical Hanoi was established in 2002 with the main business areas: medical equipment, beauty equipment, scientific equipment, technology and environment.</span><br />\r\n	<br />\r\n	<span title=\"Tôn chỉ của chúng tôi:\">Our guiding principles:<br />\r\n	<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Cung cấp tới tận tay khách hàng các sản phẩm có chất lượng và kỹ thuật cao trong ngành y tế và khoa học công nghệ môi trường với giá cả cạnh tranh nhất.\">Hand to provide customers with quality products and high technology in the health and environmental science and technology with the most competitive prices.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Xây dựng và đào tạo một mạng lưới dịch vụ kỹ thuật sau bán hàng một cách hoàn hảo.\">Develop and train a network of technical service after the sale perfectly.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Luôn giữ chữ “tín” và lấy lợi ích của khách hàng làm trọng.\">Always keep the word &quot;credit&quot; and get the benefit of customer-focused.</span><br />\r\n	<br />\r\n	<span title=\"Sản phẩm Công ty cung cấp:\">Products The company offers:<br />\r\n	<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy soi cổ tử cung kỹ thuật số, monitor sản khoa, monitor theo dõi bệnh nhân đa thông số, hệ thống monitor trung tâm, máy cắt đốt cổ tử cung chuyên dụng, máy đo nồng độ bão hòa ô xy trong máu, bơm tiêm\">Colposcopy machine digital, monitor anesthesia, monitor patient monitor multiple parameters, the central monitor system, cervical ablation machine dedicated machine measurements of oxygen saturation levels in blood, syringes </span><span title=\"điện, máy truyền dịch tự động của hãng GOLDWAY (US).,INC.\">electric machine company infusion of automated GOLDWAY (U.S.)., INC.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy siêu âm đen trắng, siêu màu 4D các loại của hãng Fukuda- Nhật Bản\">Ultrasound machine black &amp; white, color 4D super types of firms Fukuda, Japan<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy áp lạnh cổ tử cung\">Machine cold pressure of the cervix<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Điện não VIDEO EEG, DIGITAL EEG, điện tim của Tây Ban Nha\">EEG EEG VIDEO, DIGITAL EEG, ECG of Spain<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy đo thính lực chuyên dụng của Tây Ban Nha\">Machinery specialized hearing test in Spain<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy đo bilirubin, hemoglobin sản xuất tại Nhật Bản\">Gauge bilirubin, hemoglobin production in Japan<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy gây mê, máy thở, máy nghe tim thai, nội soi, điện tim, máy phát hiện vàng da.\">Anesthesia machines, ventilators, air auscultation, endoscopy, ECG, jaundice detector.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy xét nghiệm sinh hóa (bán tự động, tự động, tổng hợp), ELISA, dao mổ điện sản xuất tại Mỹ\">Biochemical machine (semi-automatic, automatic, general), ELISA, electric knife made in USA<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy xét nghiệm nước tiểu Cybow, Clinitek Status (Hàn Quốc, Anh)\">Machine Cybow urine, Clinitek Status (Korean, English)<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy quang phổ UV/VIS - Nhật, tủ bảo quản dược phẩm, tủ trữ máu của Đức.\">Spectrophotometer UV / VIS - Japanese pharmaceutical storage cabinets, storage cabinets of German blood.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Đèn mổ (Thụy Sĩ), tủ sấy, nồi hấp (Đài Loan)...\">Lights (Switzerland), oven, steamer (Taiwan) ...<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Các loại thiết bị khoa học kỹ thuật chuyên dụng của Anh, Mỹ, Đức.\">The type of equipment dedicated science and technology in the UK, U.S., Germany.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Các linh kiện thay thế cho các loại monitor theo dõi bệnh nhân, monitor sản khoa\">Replacement parts for the type of monitor to track patients, monitor obstetric</span><br />\r\n	<br />\r\n	<span title=\"Công ty có đội ngũ kỹ sư được đào tạo đúng chuyên ngành thiết bị y tế ở trong và ngoài nước.\">The company has a team of engineers are properly trained specialized medical equipment at home and abroad. </span><span title=\"Đội ngũ này không ngừng được nâng cao tay nghề thông qua các khoá đào tạo của các nhà sản xuất...\">This team is constantly improving skills through training of manufacturers ...</span><br />\r\n	<br />\r\n	<span title=\"Với thế mạnh của mình, chúng tôi hy vọng rằng trong một tương lai gần, Công ty Công nghệ Quang Anh sẽ trở thành một đối tác truyền thống của Quý khách hàng với tư cách là một nhà cung cấp thiết bị y tế có giá cả\">With its strength, we hope that in the near future, Quang Anh Technology Company will become a traditional partner of customers as a supplier of medical equipment priced </span><span title=\"hợp lý nhất, chất lượng tốt nhất và dịch vụ sau bán hàng hoàn hảo.\">most logical, best quality and after sales service perfect.</span><br />\r\n	<br />\r\n	<span title=\"Khi cần mua thiết bị y tế- Đến với Công ty thiết bị y tế Quang Anh\">When you need to buy medical equipment-to the medical device company Quang Anh</span></span></p>\r\n', 'img/upload/076e3caed758a1c18c91a0e9cae3368f.jpg', '', 146, '', 0, '2012-07-23 14:38:15', '2012-08-23 17:51:27', 1, NULL, 'about'),
						(117,$shop_id, 0, 'Hướng dẫn mua hàng qua điện thoại', 'Method of purchases via phones', '<p>\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Hướng dẫn mua h&agrave;ng qua điện thoại</span></p>\r\n', '', '<br />\r\n<p style=\"line-height: 150%\">\r\n	<span style=\"font-weight: bold; font-family: Arial; color: rgb(0, 102, 255); \"><a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#mh1\" id=\"mh1\" name=\"mh1\">I/ Đặt h&agrave;ng qua Điện thoại</a><span style=\"font-size: 10pt; \"><a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#top\" style=\"text-decoration: none\"><span style=\"color: rgb(0, 102, 255); \">(L&ecirc;n tr&ecirc;n </span></a></span></span><a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#top\" style=\"text-decoration: none\"><span style=\"text-decoration: none; font-weight: bold; font-size: 10pt; color: rgb(0, 102, 255); \">&uarr;</span><span style=\"text-decoration: none; font-weight: bold; font-family: Arial; font-size: 10pt; color: rgb(0, 102, 255); \">)</span></a><br />\r\n	&nbsp;</p>\r\n<p style=\"line-height: 150%\">\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Qu&yacute; kh&aacute;ch gọi điện thoại trực tiếp đến Ph&ograve;ng B&aacute;n h&agrave;ng Online theo số m&aacute;y <span style=\"font-weight: bold; \">04.32888999</span> hoặc <span style=\"font-weight: bold; \">04.85821888</span>.<br />\r\n	<br />\r\n	</span></p>\r\n<p style=\"line-height: 150%\">\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">H&agrave;ng ng&agrave;y từ 8h30 &ndash; 21h30 kể cả Thứ bảy, Chủ Nhật v&agrave; c&aacute;c ng&agrave;y Lễ, nh&acirc;n vi&ecirc;n b&aacute;n h&agrave;ng trực tuyến của TOPCARE lu&ocirc;n sẵn s&agrave;ng phục vụ.<br />\r\n	<br />\r\n	</span><br />\r\n	<span style=\"font-weight: bold; font-family: Arial; color: rgb(0, 102, 255); \"> <a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#mh2\" id=\"mh2\">II/ Đặt h&agrave;ng qua Chương tr&igrave;nh Chat Yahoo hoặc Skype</a><span style=\"font-size: 10pt; \"><a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#top\" style=\"text-decoration: none\"><span style=\"color: rgb(0, 102, 255); \">(L&ecirc;n tr&ecirc;n </span></a></span></span><a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#top\" style=\"text-decoration: none\"><span style=\"font-weight: bold; font-size: 10pt; color: rgb(0, 102, 255); \">&uarr;</span><span style=\"font-weight: bold; font-family: Arial; font-size: 10pt; color: rgb(0, 102, 255); \">)</span></a></p>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Khi Qu&yacute; kh&aacute;ch truy cập trang <a href=\"http://www.topcare.vn\">www.topcare.vn</a> c&oacute; thể chat v&agrave; đăng k&yacute; mua h&agrave;ng với c&aacute;c nick Yahoo, Skype hiển thị s&aacute;ng tr&ecirc;n Website ch&iacute;nh thức của ch&uacute;ng t&ocirc;i:<br />\r\n	<br />\r\n	</span></p>\r\n<p align=\"center\" style=\"line-height: 150%\">\r\n	<img border=\"1\" height=\"29\" src=\"http://topcare.vn/Images/anh/yahoo_skype.jpg\" width=\"145\" /></p>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Nhấn v&agrave;o biểu tượng mặt cười, cửa sổ chương tr&igrave;nh Yahoo! Messenger hoặc Skype sẽ tự động bật l&ecirc;n.</span></p>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Chat với nh&acirc;n vi&ecirc;n b&aacute;n h&agrave;ng trực tuyến của TOPCARE, Qu&yacute; kh&aacute;ch sẽ được tư vấn v&agrave; c&oacute; thể y&ecirc;u cầu đặt h&agrave;ng ngay. Nh&acirc;n vi&ecirc;n Topcare sẽ gọi điện thoại cho Qu&yacute; kh&aacute;ch để x&aacute;c nhận đơn h&agrave;ng v&agrave; x&aacute;c nhận địa chỉ giao h&agrave;ng (nếu cần).<br />\r\n	<br />\r\n	</span><br />\r\n	<span style=\"font-weight: bold; font-family: Arial; color: rgb(0, 102, 255); \"> <a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#mh3\" id=\"mh3\">III/ Đăng k&yacute; mua h&agrave;ng qua website www.topcare.vn</a><a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#top\" style=\"text-decoration: none\"><span style=\"font-size: 10pt; color: rgb(0, 102, 255); \">(L&ecirc;n tr&ecirc;n </span></a></span><a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#top\" style=\"text-decoration: none\"><span style=\"font-weight: bold; font-size: 10pt; color: rgb(0, 102, 255); \">&uarr;</span><span style=\"font-weight: bold; font-family: Arial; font-size: 10pt; color: rgb(0, 102, 255); \">)</span></a></p>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Việc đăng k&yacute; mua h&agrave;ng qua website cũng cực kỳ đơn giản, Qu&yacute; kh&aacute;ch c&oacute; thể l&agrave;m theo c&aacute;c hướng dẫn dưới đ&acirc;y:</span></p>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-weight: bold; font-family: Arial; font-size: 10pt; \">Bước 1: Qu&yacute; kh&aacute;ch chọn sản phẩm v&agrave;o &quot;giỏ h&agrave;ng&quot; bằng nhiều c&aacute;ch</span></p>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">V&iacute; dụ như v&agrave;o danh mục h&agrave;ng tương ứng, chọn theo h&atilde;ng, chọn theo gi&aacute;, chọn theo chức năng, chọn theo t&iacute;nh năng, nhập m&atilde; h&agrave;ng v&agrave;o &ocirc; t&igrave;m kiếm&hellip;<br />\r\n	Sau khi đ&atilde; chọn được sản phẩm cần mua, Qu&yacute; kh&aacute;ch nhấn n&uacute;t <img align=\"top\" border=\"0\" height=\"20\" src=\"http://topcare.vn/Images/btn_cart_small.jpg\" width=\"88\" /> tại khung hiển thị của sản phẩm đ&oacute;.</span></p>\r\n<p align=\"left\" style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Ngay lập tức tr&ecirc;n website sẽ xuất hiện <span style=\"font-weight: bold; \">Khung giỏ h&agrave;ng</span> với những sản phẩm Qu&yacute; kh&aacute;ch vừa chọn:<br />\r\n	<br />\r\n	</span></p>\r\n<p align=\"center\" style=\"line-height: 150%\">\r\n	<span style=\"font-family: Arial; font-size: 10pt; \"><img border=\"1\" height=\"256\" src=\"http://topcare.vn/Images/anh/cart_1_small.jpg\" width=\"575\" /></span></p>\r\n<p align=\"left\" style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Tại <span style=\"font-weight: bold; \">Khung giỏ h&agrave;ng</span> n&agrave;y đ&atilde; c&oacute; hướng dẫn chi tiết để Qu&yacute; kh&aacute;ch chọn số lượng sản phẩm m&igrave;nh cần mua, hoặc bỏ kh&ocirc;ng chọn sản phẩm n&agrave;y nữa m&agrave; thay bằng chọn sản phẩm kh&aacute;c.</span></p>\r\n<ul>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Nếu Qu&yacute; kh&aacute;ch muốn bỏ mua mặt h&agrave;ng n&agrave;o đ&oacute;, chỉ cần bấm v&agrave;o n&uacute;t <img align=\"top\" border=\"0\" height=\"20\" src=\"http://topcare.vn/Images/anh/DeleteRed.jpg\" width=\"20\" />&nbsp;<span style=\"color: rgb(0, 0, 255); \">Loại bỏ</span> c&ugrave;ng h&agrave;ng với sản phẩm đ&oacute;<br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Nếu Qu&yacute; kh&aacute;ch muốn chọn mua th&ecirc;m những sản phẩm kh&aacute;c, bấm v&agrave;o n&uacute;t <img align=\"middle\" border=\"0\" height=\"32\" src=\"http://topcare.vn/Images/anh/btn_more.jpg\" width=\"233\" />, <span style=\"font-weight: bold; \">Khung giỏ h&agrave;ng</span> sẽ tạm thời ẩn đi để Qu&yacute; kh&aacute;ch chọn sản phẩm kh&aacute;c v&agrave;o Giỏ h&agrave;ng.<br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Sau khi đ&atilde; chọn xong sản phẩm cần mua, Qu&yacute; kh&aacute;ch kiểm tra lại th&ocirc;ng tin sản phẩm trong giỏ h&agrave;ng 1 lần nữa như: T&ecirc;n sản phẩm, số lượng, đơn gi&aacute;, tổng số tiền phải thanh to&aacute;n... Qu&yacute; kh&aacute;ch nhấn n&uacute;t <img align=\"middle\" border=\"0\" height=\"32\" src=\"http://topcare.vn/Images/anh/continue_button.jpg\" width=\"95\" /> để chuyển sang bước 2</span></li>\r\n</ul>\r\n', '', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', '', 156, '', 0, '2012-07-23 14:45:38', '2012-08-22 11:56:58', 1, NULL, ''),
						(118,$shop_id, 0, 'Cách thanh toán qua cổng trực tuyến', 'Method of online payment', '<p>\r\n	sfsdf</p>\r\n', '', '<p>\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Ở bước n&agrave;y Qu&yacute; kh&aacute;ch sẽ nhập c&aacute;c th&ocirc;ng tin cần thiết như <span style=\"font-weight: bold; \">Họ t&ecirc;n, Số điện thoại, Địa chỉ nhận h&agrave;ng, Email</span> (để Topcare gửi th&ocirc;ng tin đơn h&agrave;ng cho Qu&yacute; kh&aacute;ch), hoặc c&oacute; thể bổ sung th&ecirc;m v&agrave;i th&ocirc;ng tin kh&aacute;c m&agrave; Qu&yacute; kh&aacute;ch cảm thấy cần thiết trong &ocirc; <span style=\"font-weight: bold; \">&quot;Ch&uacute; th&iacute;ch th&ecirc;m&quot;</span> (hướng dẫn Topcare giao h&agrave;ng, y&ecirc;u cầu viết ho&aacute; đơn VAT cho c&ocirc;ng ty...)</span></p>\r\n<p align=\"left\" style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Sau khi điền đủ c&aacute;c th&ocirc;ng tin, Qu&yacute; kh&aacute;ch cần điền th&ecirc;m<span style=\"font-weight: bold; \"> &ldquo;Nhập m&atilde; bảo vệ&rdquo;</span> (để tr&aacute;nh t&igrave;nh trạng SPAM, gửi h&agrave;ng loạt đơn h&agrave;ng), m&atilde; Qu&yacute; kh&aacute;ch phải nhập kh&ocirc;ng ph&acirc;n biệt chữ hoa, chữ thường. Nếu Qu&yacute; kh&aacute;ch kh&ocirc;ng nh&igrave;n r&otilde; m&atilde; bảo vệ đ&oacute;, Qu&yacute; kh&aacute;ch c&oacute; thể bấm <img align=\"top\" border=\"0\" height=\"20\" src=\"http://topcare.vn/Images/anh/iconcopy.jpg\" width=\"20\" />&nbsp;<span style=\"font-weight: bold; color: rgb(0, 102, 255); \">Chọn m&atilde; kh&aacute;c</span>. Rồi bấm <img align=\"middle\" border=\"0\" height=\"32\" src=\"http://topcare.vn/Images/anh/cart_finish.jpg\" width=\"92\" /> v&agrave; chờ v&agrave;i gi&acirc;y để đơn h&agrave;ng được gửi tới hệ thống của Topcare.</span></p>\r\n<p align=\"left\" style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Hệ thống sẽ kiểm tra những th&ocirc;ng tin của Qu&yacute; kh&aacute;ch đ&atilde; cung cấp 1 lần nữa, nếu th&ocirc;ng tin đơn h&agrave;ng hợp lệ, khung đặt h&agrave;ng sẽ hiện l&ecirc;n th&ocirc;ng b&aacute;o ho&agrave;n tất quy tr&igrave;nh mua h&agrave;ng như h&igrave;nh dưới đ&acirc;y:<br />\r\n	<br />\r\n	</span></p>\r\n<p align=\"center\" style=\"line-height: 150%\">\r\n	<img border=\"1\" height=\"256\" src=\"http://topcare.vn/Images/anh/cartfinish.jpg\" width=\"575\" /></p>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Sau đ&oacute; nh&acirc;n vi&ecirc;n của Topcare sẽ xử l&yacute; đơn đặt h&agrave;ng v&agrave; li&ecirc;n lạc lại với Qu&yacute; kh&aacute;ch để x&aacute;c nhận v&agrave; thống nhất việc mua h&agrave;ng.<br />\r\n	<br />\r\n	</span></p>\r\n<p style=\"line-height: 150%\">\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Qu&yacute; kh&aacute;ch cũng c&oacute; thể li&ecirc;n lạc với Ph&ograve;ng B&aacute;n h&agrave;ng Online để nhận hỗ trợ:</span></p>\r\n<ul>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Hỗ trợ th&ocirc;ng tin qua Email: <a href=\"mailto:banhang.online@topcare.vn\">banhang.online@topcare.vn</a><br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Điện thoại : <span style=\"font-weight: bold; \">(04).32888999</span> hoặc <span style=\"font-weight: bold; \">(04).85821888</span></span></li>\r\n</ul>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"text-decoration: underline; \"><span style=\"font-weight: bold; font-family: Arial; color: rgb(0, 102, 255); \">Một số lưu &yacute;:</span></span></p>\r\n<ul>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Topcare chỉ chấp nhận những Đơn đặt h&agrave;ng khi cung cấp đủ th&ocirc;ng tin ch&iacute;nh x&aacute;c về địa chỉ, số điện thoại &hellip; Sau khi Qu&yacute; kh&aacute;ch đặt h&agrave;ng, TOPCARE sẽ gọi điện cho Qu&yacute; kh&aacute;ch để x&aacute;c nhận th&ocirc;ng tin v&agrave; trao đổi việc thực hiện đơn h&agrave;ng.<br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; line-height: 24px; font-size: small; \">Hiện tại Topcare chỉ phục vụ b&aacute;n h&agrave;ng Online đối với kh&aacute;ch h&agrave;ng H&agrave; Nội v&agrave; c&aacute;c tỉnh th&agrave;nh kh&aacute;c thuộc nước Việt Nam.<br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; line-height: 24px; font-size: small; \">Địa chỉ giao h&agrave;ng phải c&oacute; th&ocirc;ng tin người nhận h&agrave;ng, địa chỉ, số điện thoại ch&iacute;nh x&aacute;c, r&otilde; r&agrave;ng. Ch&uacute;ng t&ocirc;i kh&ocirc;ng chịu tr&aacute;ch nhiệm khi qu&yacute; kh&aacute;ch ghi sai th&ocirc;ng tin người nhận.<br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Topcare kh&ocirc;ng b&aacute;n sản phẩm cho người dưới 13 tuổi. Nếu qu&yacute; kh&aacute;ch dưới 13 tuổi, Qu&yacute; kh&aacute;ch được y&ecirc;u cầu phải c&oacute; sự đồng &yacute; của cha mẹ hoặc người gi&aacute;m hộ để thực hiện mua h&agrave;ng từ website <a href=\"http://www.topcare.vn\">www.topcare.vn</a></span></li>\r\n</ul>\r\n', '', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', '', 156, '', 0, '2012-07-23 14:46:20', '2012-08-22 11:56:53', 1, NULL, ''),
						(119,$shop_id, 0, 'Hướng dẫn đặt hàng', 'Method of order', '', '', '<p>\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Ở bước n&agrave;y Qu&yacute; kh&aacute;ch sẽ nhập c&aacute;c th&ocirc;ng tin cần thiết như <span style=\"font-weight: bold; \">Họ t&ecirc;n, Số điện thoại, Địa chỉ nhận h&agrave;ng, Email</span> (để Topcare gửi th&ocirc;ng tin đơn h&agrave;ng cho Qu&yacute; kh&aacute;ch), hoặc c&oacute; thể bổ sung th&ecirc;m v&agrave;i th&ocirc;ng tin kh&aacute;c m&agrave; Qu&yacute; kh&aacute;ch cảm thấy cần thiết trong &ocirc; <span style=\"font-weight: bold; \">&quot;Ch&uacute; th&iacute;ch th&ecirc;m&quot;</span> (hướng dẫn Topcare giao h&agrave;ng, y&ecirc;u cầu viết ho&aacute; đơn VAT cho c&ocirc;ng ty...)</span></p>\r\n<p align=\"left\" style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Sau khi điền đủ c&aacute;c th&ocirc;ng tin, Qu&yacute; kh&aacute;ch cần điền th&ecirc;m<span style=\"font-weight: bold; \"> &ldquo;Nhập m&atilde; bảo vệ&rdquo;</span> (để tr&aacute;nh t&igrave;nh trạng SPAM, gửi h&agrave;ng loạt đơn h&agrave;ng), m&atilde; Qu&yacute; kh&aacute;ch phải nhập kh&ocirc;ng ph&acirc;n biệt chữ hoa, chữ thường. Nếu Qu&yacute; kh&aacute;ch kh&ocirc;ng nh&igrave;n r&otilde; m&atilde; bảo vệ đ&oacute;, Qu&yacute; kh&aacute;ch c&oacute; thể bấm <img align=\"top\" border=\"0\" height=\"20\" src=\"http://topcare.vn/Images/anh/iconcopy.jpg\" width=\"20\" />&nbsp;<span style=\"font-weight: bold; color: rgb(0, 102, 255); \">Chọn m&atilde; kh&aacute;c</span>. Rồi bấm <img align=\"middle\" border=\"0\" height=\"32\" src=\"http://topcare.vn/Images/anh/cart_finish.jpg\" width=\"92\" /> v&agrave; chờ v&agrave;i gi&acirc;y để đơn h&agrave;ng được gửi tới hệ thống của Topcare.</span></p>\r\n<p align=\"left\" style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Hệ thống sẽ kiểm tra những th&ocirc;ng tin của Qu&yacute; kh&aacute;ch đ&atilde; cung cấp 1 lần nữa, nếu th&ocirc;ng tin đơn h&agrave;ng hợp lệ, khung đặt h&agrave;ng sẽ hiện l&ecirc;n th&ocirc;ng b&aacute;o ho&agrave;n tất quy tr&igrave;nh mua h&agrave;ng như h&igrave;nh dưới đ&acirc;y:<br />\r\n	<br />\r\n	</span></p>\r\n<p align=\"center\" style=\"line-height: 150%\">\r\n	<img border=\"1\" height=\"256\" src=\"http://topcare.vn/Images/anh/cartfinish.jpg\" width=\"575\" /></p>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Sau đ&oacute; nh&acirc;n vi&ecirc;n của Topcare sẽ xử l&yacute; đơn đặt h&agrave;ng v&agrave; li&ecirc;n lạc lại với Qu&yacute; kh&aacute;ch để x&aacute;c nhận v&agrave; thống nhất việc mua h&agrave;ng.<br />\r\n	<br />\r\n	</span></p>\r\n<p style=\"line-height: 150%\">\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Qu&yacute; kh&aacute;ch cũng c&oacute; thể li&ecirc;n lạc với Ph&ograve;ng B&aacute;n h&agrave;ng Online để nhận hỗ trợ:</span></p>\r\n<ul>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Hỗ trợ th&ocirc;ng tin qua Email: <a href=\"mailto:banhang.online@topcare.vn\">banhang.online@topcare.vn</a><br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Điện thoại : <span style=\"font-weight: bold; \">(04).32888999</span> hoặc <span style=\"font-weight: bold; \">(04).85821888</span></span></li>\r\n</ul>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"text-decoration: underline; \"><span style=\"font-weight: bold; font-family: Arial; color: rgb(0, 102, 255); \">Một số lưu &yacute;:</span></span></p>\r\n<ul>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Topcare chỉ chấp nhận những Đơn đặt h&agrave;ng khi cung cấp đủ th&ocirc;ng tin ch&iacute;nh x&aacute;c về địa chỉ, số điện thoại &hellip; Sau khi Qu&yacute; kh&aacute;ch đặt h&agrave;ng, TOPCARE sẽ gọi điện cho Qu&yacute; kh&aacute;ch để x&aacute;c nhận th&ocirc;ng tin v&agrave; trao đổi việc thực hiện đơn h&agrave;ng.<br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; line-height: 24px; font-size: small; \">Hiện tại Topcare chỉ phục vụ b&aacute;n h&agrave;ng Online đối với kh&aacute;ch h&agrave;ng H&agrave; Nội v&agrave; c&aacute;c tỉnh th&agrave;nh kh&aacute;c thuộc nước Việt Nam.<br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; line-height: 24px; font-size: small; \">Địa chỉ giao h&agrave;ng phải c&oacute; th&ocirc;ng tin người nhận h&agrave;ng, địa chỉ, số điện thoại ch&iacute;nh x&aacute;c, r&otilde; r&agrave;ng. Ch&uacute;ng t&ocirc;i kh&ocirc;ng chịu tr&aacute;ch nhiệm khi qu&yacute; kh&aacute;ch ghi sai th&ocirc;ng tin người nhận.<br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Topcare kh&ocirc;ng b&aacute;n sản phẩm cho người dưới 13 tuổi. Nếu qu&yacute; kh&aacute;ch dưới 13 tuổi, Qu&yacute; kh&aacute;ch được y&ecirc;u cầu phải c&oacute; sự đồng &yacute; của cha mẹ hoặc người gi&aacute;m hộ để thực hiện mua h&agrave;ng từ website <a href=\"http://www.topcare.vn\">www.topcare.vn</a></span></li>\r\n</ul>\r\n', '', '/estoreadmin/webroot/upload/image/images/13.jpg', '', 156, '', 0, '2012-07-23 14:47:22', '2012-08-22 11:56:42', 1, NULL, ''),
						(126,$shop_id, 0, 'Sáng nay giá vàng giảm 500 nghìn/1 lượng', 'The price of gold has decreased by 500 thousand VND this morning ', '<p>\r\n	S&aacute;ng nay gi&aacute; v&agrave;ng giảm 500 ngh&igrave;n/1 lượng, mọi người đổ x&ocirc; ra c&aacute;c tiệm v&agrave;ng để b&aacute;n, v&igrave; lo sợ gi&aacute; v&agrave;ng tiếp tục giảm</p>\r\n', '<p>\r\n	update</p>\r\n', '<p>\r\n	S&aacute;ng nay gi&aacute; v&agrave;ng giảm 500 ngh&igrave;n/1 lượng, mọi người đổ x&ocirc; ra c&aacute;c tiệm v&agrave;ng để b&aacute;n, v&igrave; lo sợ gi&aacute; v&agrave;ng tiếp tục giảm</p>\r\n', '<p>\r\n	update..</p>\r\n', 'img/upload/17e72a27ea8728adf98fd4cc99c4db82.jpg', '', 156, '', 0, '2012-07-29 16:43:23', '2012-07-29 16:43:23', 1, NULL, 'sang-nay-gia-vang-giam-500-nghin-1-luong'),
						(127,$shop_id, 0, 'Công ty TNHH thiết bị y tế mới nhập 1 lô sản phẩm y tế', 'Medical Equipment Co., Ltd has just imported a new batch of medical products', '<p>\r\n	Đ&acirc;y&nbsp; lo h&agrave;ng ống nước hiện đại nhất thế giới, được sản xuất theo c&ocirc;ng nghệ của mỹ , ti&ecirc;n tiến nhất hiện nay</p>\r\n', '<p>\r\n	<span id=\"result_box\" lang=\"en\"><span class=\"hps\">This</span> <span class=\"hps\">concerns</span> <span class=\"hps\">the most modern</span> <span class=\"hps\">water</span> <span class=\"hps\">pipe</span> <span class=\"hps\">in the world,</span> <span class=\"hps\">is produced by</span> <span class=\"hps\">the</span> <span class=\"hps\">U.S.</span> <span class=\"hps\">technology</span><span>,</span> <span class=\"hps\">today&#39;s most</span> <span class=\"hps\">advanced</span></span></p>\r\n', '<p>\r\n	Đ&acirc;y&nbsp; lo h&agrave;ng ống nước hiện đại nhất thế giới, được sản xuất theo c&ocirc;ng nghệ của mỹ , ti&ecirc;n tiến nhất hiện nay</p>\r\n', '<p>\r\n	<span id=\"result_box\" lang=\"en\"><span class=\"hps\">This</span> <span class=\"hps\">concerns</span> <span class=\"hps\">the most modern</span> <span class=\"hps\">water</span> <span class=\"hps\">pipe</span> <span class=\"hps\">in the world,</span> <span class=\"hps\">is produced by</span> <span class=\"hps\">the</span> <span class=\"hps\">U.S.</span> <span class=\"hps\">technology</span><span>,</span> <span class=\"hps\">today&#39;s most</span> <span class=\"hps\">advanced</span></span></p>\r\n', 'img/upload/ab9459f38a75e382e4c2fa044f39fc10.jpg', '', 156, '', 0, '2012-07-29 16:45:58', '2012-08-06 12:45:44', 1, NULL, 'cong-ty-tnhh-thiet-bi-y-te-moi-nhap-1-lo-san-pham-y-te');";
						
						$arrSql[]="CREATE TABLE IF NOT EXISTS `estore_orders` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `user_id` varchar(200) NOT NULL,
  `pid` int(11) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `images` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;";
						
						$arrSql[]="INSERT INTO `estore_orders` (`id`, `estore_id`, `user_id`, `pid`, `pname`, `images`, `quantity`, `price`, `total_price`) VALUES
						(1,$shop_id, 'id366822', 21, 'Ống công nghiệp inox ', '/tana/estoreadmin/webroot/upload/image/images/index_29.jpg', 1, 300, 300),
						(2,$shop_id, 'id366822', 20, 'Ống công nghiệp inox', '/tana/estoreadmin/webroot/upload/image/images/index_33.jpg', 1, 400, 400),
						(3,$shop_id, 'id366822', 19, 'Ống công nghiệp inox ', '/tana/estoreadmin/webroot/upload/image/images/index_31.jpg', 1, 200, 200),
						(4,$shop_id, 'id47761', 25, 'Ống công nghiệp inox ', '/tana/estoreadmin/webroot/upload/image/images/index_27.jpg', 5, 120, 600),
						(5,$shop_id, 'id47761', 20, 'Ống công nghiệp inox', '/tana/estoreadmin/webroot/upload/image/images/index_33.jpg', 5, 400, 2000),
						(6,$shop_id, 'id717636', 25, 'sp1', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_09.jpg', 1, 120, 120),
						(7,$shop_id, 'id881866', 21, 'sp2', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_17.jpg', 1, 300, 300),
						(8,$shop_id, 'id503470', 26, 'sp43', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 1, 120000, 120000),
						(9,$shop_id, 'id67517', 27, 'sp3', '/khieuvu/estoreadmin/webroot/upload/image/files/3.jpg', 1, 200, 200);";
						
						$arrSql[]="CREATE TABLE IF NOT EXISTS `estore_partners` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `name` varchar(256) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(256) NOT NULL,
  `website` varchar(256) DEFAULT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `address` varchar(256) NOT NULL,
  `images` varchar(256) NOT NULL,
  `content` text,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;";
						
						$arrSql[]="INSERT INTO `estore_partners` (`id`, `estore_id`, `name`, `phone`, `email`, `website`, `fax`, `address`, `images`, `content`, `created`, `modified`, `status`) VALUES
						(19,$shop_id, 'Công ty bcds', '', '', 'http://google.com', NULL, '', 'img/upload/a26d66b1322c320201a5a6c01e9f004f.jpg', NULL, '2012-07-29', '2012-07-29', 1),
						(18,$shop_id, 'Công ty bcd', '', '', 'http://google.com', NULL, '', 'img/upload/aded75138b945d987476ee4beaa48400.jpg', NULL, '2012-07-29', '2012-07-29', 1),
						(17,$shop_id, 'Công ty dcb', '', '', 'http://google.com', NULL, '', 'img/upload/65756cba90775ab2b30a744199a7c84a.jpg', NULL, '2012-07-29', '2012-07-29', 1),
						(16,$shop_id, 'Công ty abc', '', '', 'http://eximbank.com.vn', NULL, '', 'img/upload/61c692bbd3e8c4f8cb24ca87e9ff3d92.jpg', NULL, '2012-07-29', '2012-07-29', 1),
						(20,$shop_id, 'ádasd', '', '', 'http://google.com', NULL, '', 'img/upload/36e21b2e6d68b65741d004886e5223cb.jpg', NULL, '2012-09-16', '2012-09-16', 1),
						(21,$shop_id, 'hhhh', '', '', 'http://google.com', NULL, '', 'img/upload/97fea11d1a80d7ccfad25eccdd7d031e.jpg', NULL, '2012-09-16', '2012-09-16', 1),
						(22,$shop_id, 'hhh', '', '', 'http://google.com', NULL, '', 'img/upload/f6c03d67fe500b1ac80f32c87c60ec59.jpg', NULL, '2012-09-16', '2012-09-16', 1),
						(23,$shop_id, 'h', '', '', 'http://google.com', NULL, '', 'img/upload/8f9fa526eff662129d81b1fb55d07676.jpg', NULL, '2012-09-16', '2012-09-16', 1),
						(24,$shop_id, 'hhh', '', '', 'http://google.com', NULL, '', 'img/upload/74b21a268eb187c89772e79f91895d62.jpg', NULL, '2012-09-16', '2012-09-16', 1),
						(25,$shop_id, 'á', '', '', 'http://google.com', NULL, '', 'img/upload/ff76a40ba32dfb0687988e0bdbc15765.jpg', NULL, '2012-09-16', '2012-09-16', 1),
						(26,$shop_id, 'ádas', '', '', 'http://google.com', NULL, '', 'img/upload/cb18c77ef1e964033f5e9b33c991411d.jpg', NULL, '2012-09-16', '2012-09-16', 1);";
						
						$arrSql[]="CREATE TABLE IF NOT EXISTS `estore_products` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `title` varchar(256) NOT NULL,
  `title_en` varchar(256) NOT NULL,
  `price` int(30) DEFAULT NULL,
  `manufacturer` varchar(256) NOT NULL COMMENT 'hang sx',
  `introduction` text NOT NULL COMMENT 'mo ta chung',
  `content` text NOT NULL,
  `content_en` text NOT NULL,
  `images` varchar(256) NOT NULL,
  `images_en` varchar(256) NOT NULL,
  `images1` varchar(250) DEFAULT NULL,
  `images2` varchar(250) DEFAULT NULL,
  `images3` varchar(250) NOT NULL,
  `images4` varchar(250) DEFAULT NULL,
  `catproduct_id` int(10) NOT NULL,
  `display` int(2) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `sptieubieu` tinyint(2) NOT NULL,
  `status` int(2) NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `kichthuoc` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `chatlieu` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `khoanggia` int(20) DEFAULT NULL,
  `spkuyenmai` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=264 DEFAULT CHARSET=utf8;";
						
						$arrSql[]="INSERT INTO `estore_products` (`id`, `estore_id`, `title`, `title_en`, `price`, `manufacturer`, `introduction`, `content`, `content_en`, `images`, `images_en`, `images1`, `images2`, `images3`, `images4`, `catproduct_id`, `display`, `created`, `modified`, `sptieubieu`, `status`, `alias`, `code`, `kichthuoc`, `chatlieu`, `khoanggia`, `spkuyenmai`) VALUES
						(263,$shop_id, 'new product', '', 455666, '135', '', '<p>\r\n	vcv</p>\r\n', '', '', '', '', '', '', '', 129, 0, '2014-09-02 03:25:02', '2014-09-02 03:25:02', 1, 1, 'new-product', '', NULL, NULL, 4, 1),
						(262,$shop_id, 'Navy Linen Blazer', '', 228000, '136', '', '<p>\r\n	Navy Linen Blazer</p>\r\n', '', 'img/upload/29575124b67b535acfe68e46c0083f0f.jpg', '', 'img/upload/73c8c1e7d181721cf29bdae0caeb85f8.jpg', '', '', '', 129, 0, '2014-08-28 06:51:12', '2014-08-28 06:51:12', 1, 1, 'navy-linen-blazer', '', NULL, NULL, 0, 1),
						(261,$shop_id, 'Amelia Tote', '', 58000, '138', '', '<p>\r\n	Amelia Tote</p>\r\n', '', 'img/upload/240608816ab0e344a26bfb6b1823d39b.jpg', '', 'img/upload/cab6ef09275fd88f1e4da7eca67fc7f5.jpg', '', '', '', 129, 0, '2014-08-28 06:49:28', '2014-08-28 06:49:28', 1, 1, 'amelia-tote', '', NULL, NULL, 1, 1),
						(260,$shop_id, 'Marais Dress', '', 58000, '138', '', '<p>\r\n	Marais Dress</p>\r\n', '', 'img/upload/dffab3907044d81bfd3ce3423b6104fa.jpg', '', 'img/upload/a5502dcd1368f21a0a85c0e04d35e49f.jpg', '', '', '', 129, 0, '2014-08-28 06:48:04', '2014-08-28 06:48:04', 1, 1, 'marais-dress', '', NULL, NULL, 0, 1),
						(259,$shop_id, 'Bay Blocker', '', 72000, '137', '', '', '', 'img/upload/c6baaf2af5b7fa7ac8c1b1849a53ab53.jpg', '', '', '', '', '', 129, 0, '2014-08-28 06:47:07', '2014-08-28 06:47:07', 1, 1, 'bay-blocker', '', NULL, NULL, 1, 1),
						(258,$shop_id, 'El Paso Tank', '', 38000, '136', '', '<p>\r\n	El Paso Tank</p>\r\n', '', 'img/upload/1538b2670005dd0271138a9894bfbad3.jpg', '', 'img/upload/1af8b0077f219a23ebeda8a0172837e4.jpg', '', '', '', 129, 0, '2014-08-28 06:46:09', '2014-08-28 06:46:09', 1, 1, 'el-paso-tank', '', NULL, NULL, 0, 1),
						(257,$shop_id, 'Classic Glasgow in Silver', '', 499000, '137', '', '<p>\r\n	Classic Glasgow in Silver</p>\r\n', '', 'img/upload/6a6ecba468d3265a94fa153fa9134aae.jpg', '', 'img/upload/916d9769dec53c429a3ba6770f237f12.jpg', '', '', '', 129, 0, '2014-08-28 06:44:53', '2014-08-28 06:44:53', 1, 1, 'classic-glasgow-in-silver', '', NULL, NULL, 0, 1),
						(256,$shop_id, 'Carstensen', '', 140000, '137', '', '<p>\r\n	Carstensen</p>\r\n', '', 'img/upload/5147a6f6a6921be62a2e467afdf0a0da.jpg', '', 'img/upload/d05bb6c12fb186024669e1e9f9d872bd.jpg', '', '', '', 129, 0, '2014-08-28 06:43:15', '2014-08-28 06:43:15', 1, 1, 'carstensen', '', NULL, NULL, 1, 1),
						(254,$shop_id, 'Nep Pocket Tee', '', 50000, '', '', '<p>\r\n	Nep Pocket Tee</p>\r\n', '', 'img/upload/41c97551f9f8b2e72b0a8c7acb8de741.jpg', '', '', '', '', '', 129, 0, '2014-08-28 06:41:16', '2014-08-28 06:41:16', 1, 1, 'nep-pocket-tee', '', NULL, NULL, 5, 1),
						(255,$shop_id, 'Dustbowl Snapback', '', 380000, '', '', '<p>\r\n	Dustbowl Snapback</p>\r\n', '', 'img/upload/2d50c92c5b2ae11c422c6015ebe9880c.jpg', '', 'img/upload/fe509d2dde947dee1cdd8aa4fd591edf.jpg', '', '', '', 129, 0, '2014-08-28 06:42:10', '2014-08-28 06:42:10', 1, 1, 'dustbowl-snapback', '', NULL, NULL, NULL, 1),
						(253,$shop_id, 'Babar Afrique', '', 330000, '', '', '<p>\r\n	Babar AfriqueBabar AfriqueBabar AfriqueBabar Afrique</p>\r\n', '', 'img/upload/223d1bc92c28c97ae944bbc773a37761.jpg', '', 'img/upload/fe66f3aec44086ad02bcecf3c2aea6e2.jpg', '', '', '', 125, 0, '2014-08-28 06:37:13', '2014-08-28 06:37:13', 1, 1, 'babar-afrique', '', NULL, NULL, 6, 1),
						(252,$shop_id, 'Babar Soul', '', 70000, '137', '', '<p>\r\n	Babar Soul</p>\r\n', '', 'img/upload/30fbb2b0f4627963b9bc0ffa571f3373.jpg', '', 'img/upload/be437fff31c23caaabf0141477071190.jpg', '', '', '', 129, 0, '2014-08-28 06:36:02', '2014-08-28 06:36:02', 1, 1, 'babar-soul', '', NULL, NULL, 1, 1),
						(251,$shop_id, 'Malta Dress', '', 88000, '137', '', '<p>\r\n	Malta Dress Malta Dress</p>\r\n', '', 'img/upload/4e8d0e834005885727e5aa5b14c0384a.jpg', '', 'img/upload/06670ede507bf70f5f5a2688a8d3a179.jpg', '', '', '', 129, 0, '2014-08-28 06:34:46', '2014-08-28 06:34:46', 1, 1, 'malta-dress', '', NULL, NULL, 2, 1),
						(250,$shop_id, 'El Silencio', '', 58, '', '', '<p>\r\n	El Silencio</p>\r\n', '', 'img/upload/096b0945ddd12ad0e8aecba517d7fee4.jpg', '', 'img/upload/1d5e4cd2a86e61bc97e14d052d6ed862.jpg', '', '', '', 129, 0, '2014-08-28 06:16:05', '2014-08-28 06:16:05', 1, 1, 'el-silencio', '', NULL, NULL, 1, 1),
						(249,$shop_id, 'Lisette Dress', '', 450000, '137', '', '<p>\r\n	Lisette Dress</p>\r\n', '', 'img/upload/6271f2fc7cc153451d192d9ccce171aa.jpg', '', 'img/upload/a0fbedfddde239ad2281e26d91177d80.jpg', '', 'img/upload/6271f2fc7cc153451d192d9ccce171aa.jpg', 'img/upload/a0fbedfddde239ad2281e26d91177d80.jpg', 129, 0, '2014-08-28 05:46:13', '2014-08-28 05:46:13', 1, 1, 'lisette-dress', '', NULL, NULL, 1, 0),
						(248,$shop_id, 'Lisette Dress', '', 58000, '135', '', '<p>\r\n	Lisette Dress</p>\r\n', '', 'img/upload/a0fbedfddde239ad2281e26d91177d80.jpg', '', NULL, NULL, '', NULL, 124, 0, '2014-08-28 04:27:46', '2014-08-28 04:27:46', 1, 1, 'lisette-dress', '', NULL, NULL, 1, 1);";
						
						$arrSql[]="CREATE TABLE IF NOT EXISTS `estore_settings` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `name` varchar(256) CHARACTER SET utf8 NOT NULL,
  `map` text CHARACTER SET utf8 NOT NULL,
  `title` varchar(250) CHARACTER SET utf8 NOT NULL,
  `info_other` varchar(250) CHARACTER SET utf8 NOT NULL,
  `address` varchar(256) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(256) NOT NULL,
  `server` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `username` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `url` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `keyword` varchar(500) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8,
  `created` date NOT NULL,
  `modified` text NOT NULL,
  `name_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_eg` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `descriptions` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `footer` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;";
						
						$arrSql[]="INSERT INTO `estore_settings` (`id`, `estore_id`, `name`, `map`, `title`, `info_other`, `address`, `phone`, `mobile`, `email`, `server`, `username`, `password`, `url`, `keyword`, `description`, `content`, `created`, `modified`, `name_en`, `address_eg`, `title_en`, `descriptions`, `footer`) VALUES
						(1,$shop_id, 'Công ty cổ phần Demo', '<iframe width=\"100%\" height=\"144\" frameborder=\"0\" src=\"https://maps.google.co.uk/?ie=UTF8&amp;t=m&amp;ll=52.204004,0.122824&amp;spn=0.005865,0.014677&amp;z=11&amp;output=embed\" marginwidth=\"0\" marginheight=\"0\" scrolling=\"no\"></iframe>', 'CÔNG TY TNHH DEMO', 'Copyright © 2011 Bản quyền thuộc Vinaconex 12', 'Nguyễn Văn Linh - Q. Long Biên - Hà Nội', '04.38517532', '0979 644 688', 'servic@demo.vn', 'localhost', 'root', NULL, 'demo.vn', 'CONG TY TNHH  DEMO', 'CONG TY TNHH  DEMO', '<p>\r\n	<span style=\"font-size:14px;\"><tt>Hoặc vui l&ograve;ng điền đầy đủ th&ocirc;ng tin v&agrave;o đơn h&agrave;ng, sau khi ho&agrave;n th&agrave;nh qu&yacute; kh&aacute;ch lick &quot;Gửi đơn h&agrave;ng&quot;<br />\r\n	Sau khi nhận được đơn h&agrave;ng, trong v&ograve;ng 24h ch&uacute;ng t&ocirc;i sẽ li&ecirc;n hệ với qu&yacute; kh&aacute;ch để x&aacute;c nhận. </tt></span></p>\r\n', '0000-00-00', '1406477611', 'CÔNG TY TNHH DEMO', '', 'CONG TY TNHH  DEMO', '<p>\r\n	đang cập nhật</p>\r\n', '<p style=\"text-align: center; \">\r\n	&nbsp;</p>\r\n<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" style=\"width: 980px; \">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n				<div>\r\n					<span style=\"color: rgb(255, 255, 255); \">Head office: 4A No, Lang Ha street - Ba Dinh district - HN City</span></div>\r\n				<div>\r\n					<span style=\"color: rgb(255, 255, 255); \">Showroom 1: 128C No, Dai La street - HN City</span></div>\r\n				<div>\r\n					<span style=\"color: rgb(255, 255, 255); \">Tel: (+84) 4 37 53 3004 - (+84) 4 59 22 27 - Fax: (+84) 4 37 53 3004</span></div>\r\n			</td>\r\n			<td>\r\n				<div>\r\n					<span style=\"color: rgb(255, 255, 255); \">Showroom 2: 128c ,street &nbsp;- Dong Tam district - HN City</span></div>\r\n				<div>\r\n					<span style=\"color: rgb(255, 255, 255); \">Tel: (+84) 4 36 74 1073 &nbsp;- Fax: (+84) 4 37 59 3004</span></div>\r\n				<div>\r\n					<span style=\"color: rgb(255, 215, 0); \">Website: www.alatca.vn</span></div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p style=\"text-align: center; \">\r\n	&nbsp;</p>\r\n');";
						
						$arrSql[]="CREATE TABLE IF NOT EXISTS `estore_slideshows` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `images` varchar(250) CHARACTER SET utf8 NOT NULL,
  `created` datetime NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;";
						
						$arrSql[]="INSERT INTO `estore_slideshows` (`id`, `estore_id`, `name`, `images`, `created`, `status`) VALUES
						(20,$shop_id, 'slide4', 'img/gallery/124e848ab890c0d97f81b184f15e2040.jpg', '2012-07-29 15:36:03', 1),
						(22,$shop_id, 'slide', 'img/gallery/cbfca728257c11a45b14b22dda9709e3.jpg', '2012-09-13 12:52:02', 1),
						(23, 0, 'slider 3', 'img/gallery/39df8eb06fbef883b2e2f02e6c7c0f44.jpg', '2014-08-27 08:33:36', 1),
						(24, 0, 'slider 4', 'img/gallery/cf91fa399693c2219f1cf9573e0b3c8f.jpg', '2014-08-27 08:33:58', 1);";
						
						$arrSql[]="CREATE TABLE IF NOT EXISTS `estore_users` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `password` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(15) NOT NULL,
  `birth_date` varchar(200) NOT NULL,
  `sex` varchar(20) NOT NULL,
  `images` varchar(256) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `active_key` varchar(50) DEFAULT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;";
						
						$arrSql[]="INSERT INTO `estore_users` (`id`, `estore_id`, `password`, `name`, `email`, `phone`, `birth_date`, `sex`, `images`, `created`, `modified`, `active_key`, `status`) VALUES
						(17,$shop_id, 'e10adc3949ba59abbe56e057f20f883e', 'admin', 'estoreadmin@estoreadmin', 2147483647, '18-11-1968', '1', '', '2011-05-17 14:33:04', '2012-07-08 10:07:43', '70c639df5e30bdee440e4cdf599fec2b', 1),
						(39,$shop_id, 'e10adc3949ba59abbe56e057f20f883e', 'phuc', 'phuca4@gmail.com', 972943090, '2012-07-18', '1', '', '2012-07-10 08:56:46', '2012-07-10 08:56:46', 'd58072be2820e8682c0a27c0518e805e', 0);";
						
						$arrSql[]="CREATE TABLE IF NOT EXISTS `estore_videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `video` varchar(250) CHARACTER SET utf8 NOT NULL,
  `LinkUrl` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `status` int(2) NOT NULL,
  `left` int(2) NOT NULL,
  `right` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;";
						
$arrSql[]="INSERT INTO `estore_videos` (`id`, `estore_id`, `name`, `video`, `LinkUrl`, `created`, `status`, `left`, `right`) VALUES
						(1,$shop_id, 'Gala trong ngay', 'video/upload/c67b28f317fe8740ada0a80316a0559c.flv', 'http://www.youtube.com/watch?v=5z7DEE70dEs&feature=related', '2011-10-02 18:51:33', 1, 0, 0),
						(2,$shop_id, 'Clip gala Bên phải', 'video/upload/64c23f4052d6626521caef72b1bc067f.flv', 'http://www.youtube.com/watch?v=76ZqkGxe_Mc&feature=g-vrec', '2012-06-14 14:46:38', 1, 1, 0);";
						
						$arrSql[]="CREATE TABLE IF NOT EXISTS `estore_wards` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `name` varchar(256) CHARACTER SET utf8 NOT NULL,
  `district_id` int(10) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
						
$arrSql[]="CREATE TABLE IF NOT EXISTS `estore_weblinks` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `estore_id` int(50) NOT NULL DEFAULT '0',
  `name` varchar(256) CHARACTER SET utf8 NOT NULL,
  `link` varchar(256) CHARACTER SET ucs2 NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;";
						
$arrSql[]="INSERT INTO `estore_weblinks` (`id`, `estore_id`, `name`, `link`, `created`, `modified`, `status`) VALUES
						(8,$shop_id, 'Google', 'http://google.vn', '0000-00-00', '0000-00-00', 1),
						(9,$shop_id, 'Dân trí', 'http://dantri.com.vn', '0000-00-00', '2012-08-04', 1),
						(10,$shop_id, '24h', 'http://24h.com.vn', '2012-08-04', '2012-08-04', 1),
						(11,$shop_id, 'quản trị mạng', 'http://quantrimang.com.vn', '2012-08-04', '2012-08-04', 1);";

						if($username ==='' and $password === '' )
						{
							$db = ConnectionManager::getDataSource('default');
							//$nameLangueCopy = $db->rawQuery($sql);
							try {
								foreach ($arrSql as $sql) {
									$db->rawQuery($sql);
								}
								$result = "Sucessfull";
							} catch (\Exception $exc) {
								$result = $exc->getMessage();
									
							}
						}
							
						if($username !='' and $password != '' )
						{
							$db = new ConnectionManager;
							$config = array(
									//'className' => 'Cake\Database\Connection',
									'driver' => 'mysql',
									'persistent' => false,
									'host' =>'localhost',
									'login' =>$username,
									'password' =>$password,
									'database' =>$namedatabase,
									'prefix' => false,
									'encoding' => 'utf8',
									'timezone' => 'UTC',
									'cacheMetadata' => true
							);
							$db->create($namedatabase,$config);
							$name = ConnectionManager::getDataSource($namedatabase);
							try {
								foreach ($arrSql as $sql) {
									$name->rawQuery($sql);
								}
								$result = "Sucessfull";
							} catch (\Exception $exc) {
								$result = $exc->getMessage();
						
							}
						
						}
						
						return $result;
						break;
					}
				// end 	50000567_en
				// theme 50000566 : daquy estore
					case "50000566_vi" :
					case "50000566_en" :
						{

							$arrSql = array();
							if($username ==='' and $password === '' )
							{
								$arrSql[]="CREATE DATABASE IF NOT EXISTS `".$namedatabase."` /*!40100 DEFAULT CHARACTER SET utf8 */;";
								$arrSql[]="USE `".$namedatabase."`;";
							}
							
							$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_infomationdetails` (
							  `id` int(11) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `infomations_id` int(11) NOT NULL,
							  `product_id` int(11) NOT NULL,
							  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
							  `images` varchar(250) NOT NULL,
							  `quantity` int(11) NOT NULL,
							  `price` int(11) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;";
							
							$arrSql[]="INSERT INTO `estore_infomationdetails` (`id`, `estore_id`, `infomations_id`, `product_id`, `name`, `images`, `quantity`, `price`) VALUES
							(5,$shop_id, 36, 19, 'sp14', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_27.jpg', 1, 200),
							(6,$shop_id, 36, 20, 'sp13', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 1, 400),
							(7,$shop_id, 37, 20, 'sp13', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 2, 400),
							(8,$shop_id, 37, 19, 'sp14', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_27.jpg', 1, 200),
							(9,$shop_id, 38, 21, 'sp2', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_17.jpg', 1, 300),
							(10,$shop_id, 38, 27, 'sp3', '/khieuvu/estoreadmin/webroot/upload/image/files/3.jpg', 1, 200),
							(11,$shop_id, 39, 27, 'sp3', '/khieuvu/estoreadmin/webroot/upload/image/files/3.jpg', 23, 200),
							(12,$shop_id, 40, 25, 'sp1', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_09.jpg', 3, 120),
							(13,$shop_id, 40, 26, 'sp43', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 1, 120000),
							(14,$shop_id, 41, 21, 'sp2', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_17.jpg', 2, 300),
							(15,$shop_id, 41, 19, 'sp14', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_27.jpg', 1, 200),
							(16,$shop_id, 41, 26, 'sp43', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 1, 120000),
							(17,$shop_id, 42, 26, 'sp43', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 5, 120000),
							(18,$shop_id, 43, 32, 'sp565', '/khieuvu/estoreadmin/webroot/upload/image/files/bg_menu_20.jpg', 2, 20000),
							(19,$shop_id, 44, 64, 'sp5', '/estoreadmin/webroot/upload/image/files/vietsys_53.jpg', 1, 40000),
							(20,$shop_id, 44, 48, 'sp4', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
							(21,$shop_id, 44, 61, 'sp2', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
							(22,$shop_id, 44, 49, 'sp5', '/estoreadmin/webroot/upload/image/files/vietsys_53.jpg', 1, 40000),
							(23,$shop_id, 45, 63, 'sp4', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
							(24,$shop_id, 46, 49, 'sp5', '/estoreadmin/webroot/upload/image/files/vietsys_53.jpg', 1, 40000),
							(25,$shop_id, 46, 50, 'sp6', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
							(26,$shop_id, 47, 64, 'sp5', '/estoreadmin/webroot/upload/image/files/vietsys_53.jpg', 1, 40000),
							(27,$shop_id, 47, 78, 'sp4', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
							(28,$shop_id, 48, 73, 'sp4', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
							(29,$shop_id, 51, 243, 'Tủ chữ L nhiều ngăn', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', 1, 4500000),
							(30,$shop_id, 51, 245, 'Bếp cho quán ăn vừa và nhỏ', 'img/upload/3007b340574bcfd67cc42fd18c74d9b0.jpg', 1, 160000),
							(31,$shop_id, 52, 243, 'Tủ chữ L nhiều ngăn', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', 1, 4500000),
							(32,$shop_id, 52, 232, 'Bếp trung bình chữ I', 'img/upload/06e0bd26dd69280f9c14e247b49a3ec6.jpg', 2, 2300000),
							(33,$shop_id, 53, 218, 'Bến nhà hàng', 'img/upload/3007b340574bcfd67cc42fd18c74d9b0.jpg', 3, 3500000),
							(34,$shop_id, 53, 243, 'Tủ chữ L nhiều ngăn', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', 1, 4500000),
							(35,$shop_id, 54, 243, 'Tủ chữ L nhiều ngăn', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', 1, 4500000),
							(36,$shop_id, 54, 231, 'Bếp trung bình chữ I', 'img/upload/06e0bd26dd69280f9c14e247b49a3ec6.jpg', 3, 2300000);";
							
							$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_infomations` (
							  `id` int(50) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `idnew` int(10) NOT NULL,
							  `user_id` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT 'null',
							  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
							  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
							  `address` varchar(300) CHARACTER SET utf8 NOT NULL,
							  `mobile` int(15) DEFAULT NULL,
							  `comment` varchar(300) CHARACTER SET utf8 NOT NULL,
							  `deal` text CHARACTER SET utf8,
							  `company` varchar(255) CHARACTER SET utf8 NOT NULL,
							  `phone` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
							  `fax` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
							  `country` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
							  `datereturn` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
							  `fullname_male` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
							  `fullname_female` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
							  `questions_day` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
							  `wedding_day` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
							  `title_question` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
							  `wedding_title` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
							  `name_product` varchar(250) NOT NULL,
							  `images` varchar(250) NOT NULL,
							  `sl` varchar(250) NOT NULL,
							  `price` varchar(250) NOT NULL,
							  `total` varchar(250) NOT NULL,
							  `orther` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
							  `created` datetime NOT NULL,
							  `status` int(2) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;";
							
							$arrSql[]="INSERT INTO `estore_infomations` (`id`, `estore_id`, `idnew`, `user_id`, `name`, `email`, `address`, `mobile`, `comment`, `deal`, `company`, `phone`, `fax`, `country`, `datereturn`, `fullname_male`, `fullname_female`, `questions_day`, `wedding_day`, `title_question`, `wedding_title`, `name_product`, `images`, `sl`, `price`, `total`, `orther`, `created`, `status`) VALUES
							(52,$shop_id, 0, 'id173768', 'Hoang Cong Phuc', 'phuca4@gmail.com', 'Ha Noi', 2147483647, '', NULL, '', '84972607988', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '9100000', NULL, '2014-07-25 08:57:55', 0),
							(53,$shop_id, 0, 'id98603', 'Hoang Phuc', 'phuca4@gmail.com', 'Ha Noi', 2147483647, '', NULL, '', '84972607988', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '15000000', NULL, '2014-07-25 09:04:11', 0),
							(54,$shop_id, 0, 'id686188', 'Hoang Cong Phuc', 'phuca4@gmail.com', 'Ha Noi', 2147483647, '', NULL, '', '84972607988', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '11400000', NULL, '2014-07-25 09:10:40', 0);";
								
							$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_manufacturers` (
							  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
							  `parent_id` int(10) DEFAULT NULL,
							  `lft` int(10) DEFAULT NULL,
							  `rght` int(10) DEFAULT NULL,
							  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
							  `created` date NOT NULL,
							  `modified` datetime NOT NULL,
							  `status` int(2) NOT NULL,
							  `char` int(10) DEFAULT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=271 DEFAULT CHARSET=latin1;";
							
							$arrSql[]="INSERT INTO `estore_manufacturers` (`id`, `estore_id`, `parent_id`, `lft`, `rght`, `name`, `created`, `modified`, `status`, `char`) VALUES
							(135,$shop_id, NULL, 1, 28, 'Rigth', '2012-05-18', '2012-09-13 17:55:06', 1, NULL),
							(136,$shop_id, NULL, 29, 62, 'Toyota', '2012-05-18', '2012-06-04 06:57:18', 1, NULL),
							(137,$shop_id, NULL, 63, 80, 'Daewoo', '2012-05-18', '2012-06-21 06:25:09', 1, NULL),
							(138,$shop_id, NULL, 81, 92, 'Ford', '2012-05-18', '2012-06-19 13:11:22', 1, NULL),
							(139,$shop_id, NULL, 93, 116, 'BMW', '2012-05-18', '2012-05-18 13:50:13', 1, NULL),
							(140,$shop_id, NULL, 117, 130, 'Nissan', '2012-05-18', '2012-05-18 13:50:25', 1, NULL),
							(141,$shop_id, NULL, 131, 144, 'Suzuki', '2012-05-18', '2012-05-18 13:50:51', 1, NULL),
							(142,$shop_id, NULL, 145, 168, 'Audi', '2012-05-24', '2012-05-24 08:07:17', 1, NULL),
							(143,$shop_id, NULL, 169, 184, 'Mitsubishi', '2012-05-24', '2012-05-24 08:08:10', 1, NULL),
							(144,$shop_id, NULL, 185, 200, 'Kia', '2012-05-24', '2014-07-27 10:05:08', 1, NULL),
							(145,$shop_id, NULL, 201, 214, 'Ford', '2012-05-24', '2012-06-21 06:11:02', 0, NULL),
							(146,$shop_id, NULL, 215, 230, 'Hyundai', '2012-05-24', '2012-06-19 13:00:19', 1, NULL),
							(148,$shop_id, NULL, 231, 244, 'Mercedes ', '2012-05-28', '2012-05-28 07:49:40', 1, NULL);";
							
							$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_advertisements` (
							  `id` int(11) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `name` varchar(256) CHARACTER SET utf8 NOT NULL,
							  `link` varchar(256) CHARACTER SET ucs2 NOT NULL,
							  `images` varchar(256) CHARACTER SET utf8 NOT NULL,
							  `display` int(2) NOT NULL,
							  `created` date NOT NULL,
							  `modified` date NOT NULL,
							  `status` int(2) NOT NULL,
							  PRIMARY KEY (`id`),
							  UNIQUE KEY `id` (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;";
														
														$arrSql[] ="INSERT INTO `estore_advertisements` (`id`, `estore_id`, `name`, `link`, `images`, `display`, `created`, `modified`, `status`) VALUES
														(37,$shop_id, '2', '', 'img/data/b6531b0ef70a4edace2c11242596d0dd.png', 0, '2012-10-15', '2014-08-13', 0),
														(36,$shop_id, '1', '', 'img/data/b6531b0ef70a4edace2c11242596d0dd.png', 1, '2012-10-15', '2014-08-13', 0);";
														
														$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_answerquestions` (
							  `id` int(11) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `name` varchar(256) CHARACTER SET utf8 NOT NULL,
							  `name_en` varchar(256) NOT NULL,
							  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
							  `mobile` varchar(256) CHARACTER SET utf8 NOT NULL,
							  `address` varchar(225) CHARACTER SET utf8 NOT NULL,
							  `title` varchar(225) CHARACTER SET utf8 NOT NULL,
							  `introduction` text CHARACTER SET utf8 NOT NULL,
							  `content` text CHARACTER SET utf8 NOT NULL,
							  `content_en` text NOT NULL,
							  `answer` text CHARACTER SET utf8 NOT NULL,
							  `created` datetime NOT NULL,
							  `status` int(2) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;";
														
							$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_backgrounds` (
							  `id` int(11) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `color` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
							  `images` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
							  `display` int(2) NOT NULL,
							  `created` date NOT NULL,
							  `status` int(2) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;";
														
							$arrSql[] ="INSERT INTO `estore_backgrounds` (`id`, `estore_id`, `color`, `images`, `display`, `created`, `status`) VALUES
														(4,$shop_id, '7f003f', '/businessadmin/webroot/upload/image/files/Hydrangeas.jpg', 0, '2012-05-23', 0);";
														
							$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_banners` (
							  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
							  `name` varchar(250) NOT NULL,
							  `images` varchar(250) NOT NULL,
							  `created` datetime NOT NULL,
							  `status` int(2) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;";
														
							$arrSql[] ="INSERT INTO `estore_banners` (`id`, `estore_id`, `name`, `images`, `created`, `status`) VALUES
														(1,$shop_id, 'Banner', 'img/gallery/96e1d7f83e9ce43860e265916ed9c6e6.swf', '2011-10-02 18:16:41', 0);";
														
							$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_bgmenus` (
							  `id` int(11) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `color` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
							  `images` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
							  `width` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
							  `height` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
							  `created` date NOT NULL,
							  `status` int(2) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;";
														
						    $arrSql[] ="INSERT INTO `estore_bgmenus` (`id`, `estore_id`, `color`, `images`, `width`, `height`, `created`, `status`) VALUES
														(5,$shop_id, 'aa8a8a', '/businessadmin/webroot/upload/image/files/Lighthouse.jpg', '10px', '10px', '2012-05-23', 1);";
														
							$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_cartmanagements` (
							  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
							  `product_name` varchar(250) CHARACTER SET utf8 NOT NULL,
							  `images` varchar(250) CHARACTER SET utf8 NOT NULL,
							  `price` int(20) NOT NULL,
							  `total` int(20) NOT NULL,
							  `number` int(20) NOT NULL,
							  `name` varchar(100) NOT NULL,
							  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
							  `phone` varchar(20) CHARACTER SET utf8 NOT NULL,
							  `address` varchar(250) CHARACTER SET utf8 NOT NULL,
							  `title` varchar(250) CHARACTER SET utf8 NOT NULL,
							  `content` varchar(400) CHARACTER SET utf8 NOT NULL,
							  `created` date NOT NULL,
							  `status` int(2) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
														
							$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_categories` (
							  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
							  `order` int(10) DEFAULT NULL,
							  `tt` int(10) DEFAULT NULL,
							  `images` varchar(50) DEFAULT NULL,
							  `alias` varchar(250) NOT NULL,
							  `parent_id` int(10) DEFAULT NULL,
							  `lft` int(10) DEFAULT NULL,
							  `rght` int(10) DEFAULT NULL,
							  `name` varchar(255) DEFAULT NULL,
							  `name_en` varchar(255) DEFAULT NULL,
							  `title` varchar(250) NOT NULL,
							  `title_en` varchar(250) NOT NULL,
							  `description` varchar(250) NOT NULL,
							  `description_en` varchar(250) NOT NULL,
							  `keywords` varchar(250) NOT NULL,
							  `created` date NOT NULL,
							  `modified` date NOT NULL,
							  `status` int(2) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=214 DEFAULT CHARSET=utf8;";
														
							$arrSql[] ="INSERT INTO `estore_categories` (`id`, `estore_id`, `order`, `tt`, `images`, `alias`, `parent_id`, `lft`, `rght`, `name`, `name_en`, `title`, `title_en`, `description`, `description_en`, `keywords`, `created`, `modified`, `status`) VALUES
														(201,$shop_id, 0, NULL, NULL, '', NULL, 3, 6, 'Tin tức', 'News', 'Tranh da Quy', 'Gemstone Paintings', 'Tranh da Quy', 'Gemstone Paintings', 'Tranh da Quy', '2011-11-23', '2012-10-17', 1),
														(200,$shop_id, NULL, NULL, NULL, '', NULL, 1, 2, 'Giới thiệu', 'Introduction', '', '', '', '', '', '2011-11-22', '2012-10-12', 0),
														(210,$shop_id, 0, NULL, NULL, 'co-so-san-xuat', NULL, 9, 10, 'CƠ SỞ SẢN XUẤT', 'Production facilities', '', '', '', '', '', '2012-10-12', '2012-10-12', 1),
														(209,$shop_id, 0, NULL, NULL, 'dich-vu', NULL, 7, 8, 'DỊCH VỤ', 'Services', '', '', '', '', '', '2012-10-12', '2012-10-12', 1),
														(211,$shop_id, 0, NULL, NULL, 'tu-van-phong-thuy', NULL, 11, 12, 'TƯ VẤN PHONG THỦY', 'Feng shui consultant', '', '', '', '', '', '2012-10-12', '2012-10-12', 1),
														(212,$shop_id, 0, NULL, NULL, 'tuyen-dung', NULL, 13, 14, 'TUYỂN DỤNG', 'Recruitment', 'Tranh da Quy', 'Gemstone Paintings', 'Tranh da quy', 'Gemstone Paintings', 'Tranh da Quy', '2012-10-12', '2012-10-17', 1),
														(213,$shop_id, 0, NULL, NULL, 'tranh-da-quy-ns', 201, 4, 5, 'Tranh Đá Quý  ', ' Gemstone Paintings', 'tranh da Quy', 'Gemstone Paintings', 'tranh da quy', 'Gemstone Paintings', 'tranh da quy ', '2012-10-17', '2012-10-17', 1);";
														
							$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_catproducts` (
							  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
							  `parent_id` int(10) DEFAULT NULL,
							  `lft` int(10) DEFAULT NULL,
							  `rght` int(10) DEFAULT NULL,
							  `images` char(250) DEFAULT NULL,
							  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
							  `name_en` varchar(250) NOT NULL,
							  `title_seo` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
							  `char` int(3) DEFAULT NULL,
							  `alias` varchar(250) CHARACTER SET utf8 NOT NULL,
							  `created` date NOT NULL,
							  `modified` datetime NOT NULL,
							  `status` int(2) NOT NULL,
							  `order` int(11) NOT NULL DEFAULT '0',
							  `level` int(10) NOT NULL DEFAULT '0',
							  `meta_key` mediumtext CHARACTER SET utf8,
							  `meta_des` mediumtext CHARACTER SET utf8,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;";
														
							$arrSql[] ="INSERT INTO `estore_catproducts` (`id`, `estore_id`, `parent_id`, `lft`, `rght`, `images`, `name`, `name_en`, `title_seo`, `char`, `alias`, `created`, `modified`, `status`, `order`, `level`, `meta_key`, `meta_des`) VALUES
														(70,$shop_id, NULL, 1, 12, NULL, 'TRANH ĐÁ QUÝ', 'Gemstone Painting', NULL, NULL, 'tranh-da-quy', '2012-10-12', '2012-10-12 15:03:57', 1, 0, 0, NULL, NULL),
														(71,$shop_id, NULL, 13, 16, NULL, 'ĐÁ QUÝ THÔ', 'Crude Gemstone', NULL, NULL, 'da-quy-tho', '2012-10-12', '2012-10-12 15:04:13', 1, 0, 0, NULL, NULL),
														(72,$shop_id, NULL, 17, 20, NULL, 'ĐÁ PHONG THỦY', 'Feng Shui Gemstone', NULL, NULL, 'da-phong-thuy', '2012-10-12', '2012-10-12 15:04:29', 1, 0, 0, NULL, NULL),
														(73,$shop_id, NULL, 21, 26, NULL, 'TRANG SỨC', 'Jewelry', NULL, NULL, 'trang-suc', '2012-10-12', '2012-10-12 15:04:39', 1, 0, 0, NULL, NULL),
														(74,$shop_id, 70, 2, 3, NULL, 'Phong cảnh', 'Scenery  Painting', NULL, NULL, 'phong-canh', '2012-10-12', '2012-10-12 15:06:19', 1, 0, 0, NULL, NULL),
														(75,$shop_id, 70, 4, 5, NULL, 'Tranh chân dung', 'Portrait Painting', NULL, NULL, 'tranh-chan-dung', '2012-10-12', '2012-10-12 15:06:36', 1, 0, 0, NULL, NULL),
														(76,$shop_id, 70, 6, 7, NULL, 'Tranh chữ', 'Calligraphy Painting', NULL, NULL, 'tranh-chu', '2012-10-12', '2012-10-12 15:06:49', 1, 0, 0, NULL, NULL),
														(77,$shop_id, 70, 8, 9, NULL, 'Tranh hoa', 'Flowers Painting', NULL, NULL, 'tranh-hoa', '2012-10-12', '2012-10-12 15:07:00', 1, 0, 0, NULL, NULL),
														(78,$shop_id, 70, 10, 11, NULL, 'Tranh muông thú', 'Animals Painting', NULL, NULL, 'tranh-muong-thu', '2012-10-12', '2012-10-12 15:07:18', 1, 0, 0, NULL, NULL),
														(79,$shop_id, 71, 14, 15, NULL, 'Ngọc Miên Điện', 'Myanmar Gem', NULL, NULL, 'ngoc-mien-dien', '2012-10-16', '2012-10-16 18:20:49', 1, 0, 0, NULL, NULL),
														(80,$shop_id, 72, 18, 19, NULL, 'Bát tự bảo', 'Quartz and Aagate', NULL, NULL, 'bat-tu-bao', '2012-10-16', '2012-10-16 18:25:56', 1, 0, 0, NULL, NULL),
														(81,$shop_id, 73, 22, 23, NULL, 'Lắc Tay', 'Bangle', NULL, NULL, 'lac-tay', '2012-10-16', '2012-10-16 18:29:02', 1, 0, 0, NULL, NULL),
														(82,$shop_id, 73, 24, 25, NULL, 'Mặt dây', 'Pendant', NULL, NULL, 'mat-day', '2012-10-16', '2012-10-16 18:29:23', 1, 0, 0, NULL, NULL),
														(83,$shop_id, NULL, 27, 30, NULL, 'TRANH ĐỒNG ', 'Copper Embossed Painting', NULL, NULL, 'tranh-dong', '2012-12-11', '2012-12-11 17:17:06', 1, 4, 0, NULL, NULL),
														(84,$shop_id, 83, 28, 29, NULL, 'Tranh đồng đá quý', 'Gemstone-Copper  Painting', NULL, NULL, 'tranh-dong-da-quy', '2012-12-11', '2012-12-11 17:21:59', 1, 1, 0, NULL, NULL);";
														
							$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_comments` (
							  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
							  `name` varchar(50) NOT NULL,
 							  `user_id` int(10) NOT NULL,
							  `title` varchar(100) NOT NULL,
							  `content` text NOT NULL,
							  `id_news` int(10) NOT NULL,
							  `email` varchar(50) NOT NULL,
							  `created` datetime NOT NULL,
							  `status` int(2) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;";
														
							$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_contacts` (
							  `id` int(11) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `name` varchar(50) NOT NULL,
							  `email` varchar(50) NOT NULL,
							  `mobile` varchar(20) NOT NULL,
							  `fax` varchar(20) DEFAULT NULL,
							  `company` varchar(200) DEFAULT NULL,
							  `title` varchar(200) NOT NULL,
							  `content` text NOT NULL,
							  `content_send` text,
							  `created` date NOT NULL,
							  `modified` date NOT NULL,
							  `status` int(1) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;";
														
								$arrSql[] ="INSERT INTO `estore_contacts` (`id`, `estore_id`, `name`, `email`, `mobile`, `fax`, `company`, `title`, `content`, `content_send`, `created`, `modified`, `status`) VALUES
														(4,$shop_id, 'Hoang Phuc', 'phuca4@gmail.com', '01688504263', '09487547584', 'Công ty abc', 'Chúc may mắn', 'dang test mail', '<p>\r\n	you are me and i am you</p>\r\n', '2011-07-04', '2011-07-04', 1);";
														
								$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_galleries` (
							  `id` int(11) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `name` varchar(50) DEFAULT NULL,
							  `display` int(2) NOT NULL,
							  `images` varchar(255) NOT NULL,
							  `created` date NOT NULL,
							  `modified` date NOT NULL,
							  `status` int(1) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;";
														
								$arrSql[] ="INSERT INTO `estore_galleries` (`id`, `estore_id`, `name`, `display`, `images`, `created`, `modified`, `status`) VALUES
														(51,$shop_id, 'Anh 1', 0, 'img/gallery/4535d3077435975b6369e71da356bd5c.jpg', '2012-03-25', '2012-03-26', 1),
														(52,$shop_id, 'Anh 2', 0, 'img/gallery/8831b9719b67a0585e1fd4943325375c.jpg', '2012-03-25', '2012-03-26', 1);";
														
								$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_helps` (
							  `id` int(10) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `name` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
							  `title` varchar(256) CHARACTER SET utf8 NOT NULL,
							  `title_en` varchar(256) NOT NULL,
							  `sdt` varchar(20) DEFAULT NULL,
							  `yahoo` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
							  `hotline` varchar(256) DEFAULT NULL,
							  `user_support` varchar(256) DEFAULT NULL,
							  `user_yahoo` varchar(256) DEFAULT NULL,
							  `user_mobile` varchar(256) DEFAULT NULL,
							  `user_email` varchar(256) DEFAULT NULL,
							  `user_skype` varchar(256) DEFAULT NULL,
							  `skype` varchar(256) DEFAULT NULL,
							  `created` datetime NOT NULL,
							  `modified` datetime NOT NULL,
							  `status` int(1) NOT NULL,
							  `email` varchar(50) DEFAULT NULL,
							  `user_yahoo1` varchar(50) DEFAULT NULL,
							  `user_yahoo2` varchar(50) DEFAULT NULL,
							  `user_yahoo3` varchar(50) DEFAULT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;";
														
								$arrSql[] ="INSERT INTO `estore_helps` (`id`, `estore_id`, `name`, `title`, `title_en`, `sdt`, `yahoo`, `hotline`, `user_support`, `user_yahoo`, `user_mobile`, `user_email`, `user_skype`, `skype`, `created`, `modified`, `status`, `email`, `user_yahoo1`, `user_yahoo2`, `user_yahoo3`) VALUES
														(28,$shop_id, 'Tư Vấn 1', '', '', '0983933518', 'phuca478', '0972607988', 'phuca478', 'phuca478', 'phuca478', 'phuca478', 'phuca478', 'adv.globalmedia2', '2012-05-27 15:52:25', '2012-10-17 14:27:44', 1, 'phuca4@gmail.com', NULL, NULL, NULL);";
														
								$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_menus` (
							  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
							  `name` varchar(250) NOT NULL,
							  `name_en` varchar(250) NOT NULL,
							  `alias` varchar(250) NOT NULL,
							  `title` varchar(300) NOT NULL,
							  `title_en` varchar(300) NOT NULL,
							  `description` varchar(300) NOT NULL,
							  `description_en` varchar(300) NOT NULL,
							  `parent_id` int(10) DEFAULT NULL,
							  `lft` int(10) DEFAULT NULL,
							  `rght` int(11) DEFAULT NULL,
							  `keywords` varchar(250) NOT NULL,
							  `menu_id` int(11) NOT NULL,
							  `order` int(11) NOT NULL,
							  `created` date NOT NULL,
							  `status` int(2) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;";
														
								$arrSql[] ="INSERT INTO `estore_menus` (`id`, `estore_id`, `name`, `name_en`, `alias`, `title`, `title_en`, `description`, `description_en`, `parent_id`, `lft`, `rght`, `keywords`, `menu_id`, `order`, `created`, `status`) VALUES
														(7,$shop_id, 'Tin tức & Sự kiện', 'News & Events', 'tin-tuc', '', '', '', '', NULL, 1, 2, '', 0, 2, '2012-05-29', 1),
														(8,$shop_id, 'Khách hàng', 'Custommer', 'khach-hang', '', '', '', '', NULL, 3, 4, '', 0, 3, '2012-05-29', 1),
														(12,$shop_id, 'Liên hệ', 'Contact', 'lien-he', '', '', '', '', NULL, 5, 6, '', 0, 4, '2012-05-30', 1);";
														
								$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_modules` (
							  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
							  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
							  `name_en` varchar(250) NOT NULL,
							  `display` int(2) NOT NULL,
							  `status` int(2) NOT NULL,
							  `created` date NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;";
														
								$arrSql[] ="INSERT INTO `estore_modules` (`id`, `estore_id`, `name`, `name_en`, `display`, `status`, `created`) VALUES
														(1,$shop_id, 'Giỏ hàng', 'Shopping cart', 0, 1, '2012-05-27'),
														(2,$shop_id, 'Thống kê truy cập', 'Visitor Statistics', 0, 1, '2012-05-27');";
														
								$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_news` (
							  `id` int(11) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `title` varchar(256) NOT NULL,
							  `user_id` int(2) NOT NULL,
							  `title_en` varchar(256) NOT NULL,
							  `alias` varchar(250) NOT NULL,
							  `introduction` text NOT NULL,
							  `introduction_en` text NOT NULL,
							  `content` text,
							  `images_en` varchar(250) DEFAULT NULL,
							  `hotnew` tinyint(2) DEFAULT NULL,
							  `content_en` text,
							  `images` varchar(256) NOT NULL,
							  `category_id` int(11) NOT NULL,
							  `source` varchar(200) NOT NULL,
							  `view` int(50) NOT NULL,
							  `meta_key` varchar(300) NOT NULL,
							  `meta_des` varchar(300) NOT NULL,
							  `homenews` int(2) NOT NULL,
							  `news` int(2) NOT NULL,
							  `created` date NOT NULL,
							  `modified` datetime NOT NULL,
							  `status` int(1) DEFAULT '0',
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=utf8;";
														
														$arrSql[] ="INSERT INTO `estore_news` (`id`, `estore_id`, `title`, `user_id`, `title_en`, `alias`, `introduction`, `introduction_en`, `content`, `images_en`, `hotnew`, `content_en`, `images`, `category_id`, `source`, `view`, `meta_key`, `meta_des`, `homenews`, `news`, `created`, `modified`, `status`) VALUES
														(100,$shop_id, 'TRANH ĐÁ QUÝ ', 0, 'Gemstone Paintings', 'tranh-da-quy-ngoc-son', '<p>\r\n	tranh đ&aacute; qu&yacute;  </p>\r\n', ' Gemstone Paintings', '<p style=\"text-align: center;\">\r\n	<img alt=\"tranh da quy ngoc son\" src=\"/admin/webroot/upload/image/images/tranh da quy (1).jpg\" style=\"width: 500px; height: 250px;\" /></p>\r\n<h2>\r\n	Với th&acirc;m ni&ecirc;n 20 năm trong nghề đ&aacute;!</h2>\r\n<p>\r\n	Từ những ng&agrave;y đầu th&agrave;nh lập, <a href=\"http://freemobileweb.mobi/\">tranh da quy </a> chỉ hoạt động tr&ecirc;n c&aacute;c mỏ đ&aacute; qu&yacute;, đến nay đ&atilde; mở rộng hệ thống cửa h&agrave;ng ra khắp c&aacute;c tỉnh th&agrave;nh trong nước v&agrave; cũng đ&atilde; mở rộng ra nước ngo&agrave;i. Văn ph&ograve;ng c&ocirc;ng ty tại: Số 6 Phạm Ngũ L&atilde;o - Ho&agrave;n Kiếm - H&agrave; Nội.</p>\r\n<h2>\r\n	<a href=\"http://freemobileweb.mobi/\">TRANH Đ&Aacute; QU&Yacute;  </a>&nbsp;c&oacute; 2 mục ti&ecirc;u ch&iacute;nh:</h2>\r\n<p>\r\n	Thứ nhất, trở th&agrave;nh một trong những nh&agrave; cung cấp đ&aacute; qu&yacute; lớn nhất Việt Nam, v&agrave; tạo điều kiện cho mỗi người y&ecirc;u đ&aacute; c&oacute; một vật hộ mệnh bằng đ&aacute;.<br />\r\n	Thứ hai, đưa t&agrave;i nguy&ecirc;n đ&aacute; qu&yacute; v&agrave; b&aacute;n qu&yacute; đến tay người ti&ecirc;u d&ugrave;ng Việt Nam, với ti&ecirc;u ch&iacute; &quot;người Việt ưu ti&ecirc;n d&ugrave;ng h&agrave;ng Việt&quot; để tr&aacute;nh chảy m&aacute;u t&agrave;i nguy&ecirc;n sang nước ngo&agrave;i.</p>\r\n<h2>\r\n	Tổng quan</h2>\r\n<p>\r\n	<a href=\"http://freemobileweb.mobi/\">tranh da quy choi &ndash; &ldquo;Tranh đ&aacute; qu&yacute;   &rdquo;</a></p>\r\n<p>\r\n	l&agrave; hệ thống cửa h&agrave;ng đ&aacute; phong thủy c&oacute; những sản phẩm v&agrave; dịch vụ sau:</p>\r\n<p>\r\n	Đ&aacute; cảnh phong thủy Đ&aacute; qu&yacute; hộ mệnh Tư vấn phong thủy miễn ph&iacute; Đặt h&agrave;ng VIP theo y&ecirc;u cầu Đ&aacute; qu&yacute; của <a href=\"http://freemobileweb.mobi/\">tranh da quy choi &ndash; &ldquo;Tranh đ&aacute; qu&yacute;   &rdquo;</a> đa số l&agrave; những tinh thể nguy&ecirc;n bản tourmaline v&agrave; aquamarine. Ch&uacute;ng t&ocirc;i cũng c&oacute; rất nhiều ruby, saphire, topaz, amethyst, v.v... đ&atilde; m&agrave;i th&agrave;nh mặt đ&aacute; trang sức.<br />\r\n	Ng&ograve;ai ra <a href=\"http://freemobileweb.mobi/\">tranh da quy choi &ndash; &ldquo;Tranh đ&aacute; qu&yacute;   &rdquo;</a></p>\r\n<p>\r\n	&nbsp;c&ograve;n c&oacute; rất nhiều c&aacute;c loại đ&aacute; b&aacute;n qu&yacute; như thạch anh (đủ loại), m&atilde; n&atilde;o, chalcedony, gỗ h&oacute;a thạch, v.v... Những sản phẩm n&agrave;y c&oacute; từ th&ocirc;, cảnh, tới những bức tượng được chế t&aacute;c từ ch&iacute;nh b&agrave;n tay nghệ thuật của nghệ nh&acirc;n Việt Nam.<br />\r\n	Tranh đ&aacute; qu&yacute;   &nbsp;b&aacute;n nhiều loại đ&aacute; qu&yacute; từ những vi&ecirc;n ngọc đ&atilde; m&agrave;i sẵn để l&agrave;m trang sức, đến những vi&ecirc;n đ&aacute; th&ocirc;, những vi&ecirc;n đ&aacute; cảnh, đ&aacute; phong thủy, đến những bức tranh đ&aacute; qu&yacute; đầy t&iacute;nh nghệ thuật. Ngo&agrave;i ra cửa h&agrave;ng c&ograve;n c&oacute; một bộ sưu tập Đ&ocirc;ng dược qu&yacute; hiếm như c&aacute;c loại cao xương, mật, rươu thuốc, v&agrave; sừng.</p>\r\n<p>\r\n	&nbsp;</p>\r\n', NULL, NULL, NULL, 'img/upload/b669888a8bf311ec64efa07bad501d34.jpg', 201, '', 0, 'tranh da quy ', 'tranh da quy ', 0, 0, '2012-10-17', '2012-10-17 14:27:27', 1),
														(101,$shop_id, 'đá quý  ', 0, ' Gemstone', 'da-quy-ns', '<p>\r\n	tranh da quy ngoc son</p>\r\n', 'gemstone paintings', '<p style=\"text-align: center;\">\r\n	tranh d&aacute; qu&yacute;  </p>\r\n<p style=\"text-align: center;\">\r\n	<img alt=\"tranh da quy ngoc son\" src=\"/admin/webroot/upload/image/images/tranh da quy .jpg\" style=\"width: 500px; height: 250px;\" /></p>\r\n<p>\r\n	&nbsp;</p>\r\n', NULL, NULL, NULL, 'img/upload/b669888a8bf311ec64efa07bad501d34.jpg', 201, '', 0, 'tranh da quy ', 'tranh da quy', 0, 0, '2012-10-17', '2012-10-17 14:23:33', 1),
														(102,$shop_id, 'Cơ sở 1', 0, 'Production facilities No.1', 'co-so-1', '<p>tranh đa Quy</p>\r\n', 'Gemstone Paintings', '<p>tranh da Quy</p>\r\n', NULL, NULL, NULL, 'img/upload/b669888a8bf311ec64efa07bad501d34.jpg', 210, '', 0, 'tranh da quy', 'tranh da quy', 0, 0, '2012-10-17', '2012-10-17 14:31:10', 1),
														(103,$shop_id, 'Đang Cập Nhập', 0, 'Updating', 'dang-cap-nhap', '<p>tranh da quy</p>\r\n', 'Gemstone Paintings', '<p>tranh da quy</p>\r\n', NULL, NULL, NULL, 'img/upload/b669888a8bf311ec64efa07bad501d34.jpg', 212, '', 0, 'tranh da quy', 'tranh da quy', 0, 0, '2012-10-17', '2012-10-17 14:29:25', 1),
														(104,$shop_id, 'Đang Cập Nhập', 0, 'Updating', 'dang-cap-nhap', '<p>\r\n	tranh da quy ngoc son</p>\r\n', 'gemstone paintings', '<p>\r\n	tranh da quy ngoc son</p>\r\n', NULL, NULL, NULL, 'img/upload/b669888a8bf311ec64efa07bad501d34.jpg', 209, '', 0, 'tranh da quy', 'tranh da quy ', 0, 0, '2012-10-17', '2012-10-17 14:28:03', 1),
														(97,$shop_id, 'Giới thiệu tranh đá quý  ', 0, 'Introduction about  Gemstone Paintings', 'gioi-thieu-tranh-da-quy-ns', '<p>\r\n	Từ những ng&agrave;y đầu th&agrave;nh lập, Tranh da quy &nbsp;chỉ hoạt động tr&ecirc;n c&aacute;c mỏ đ&aacute; qu&yacute;, đến nay đ&atilde; mở rộng hệ thống cửa h&agrave;ng ra khắp c&aacute;c tỉnh th&agrave;nh trong nước v&agrave; cũng đ&atilde; mở rộng ra nước ngo&agrave;i. Văn ph&ograve;ng c&ocirc;ng ty tại: Số 6 Phạm Ngũ L&atilde;o - Ho&agrave;n Kiếm - H&agrave; Nội</p>\r\n', 'Since the early days, ngocsonchoithu Gemstone Paintings has only worked in the gemstone mines, now we have expanded  our store system to all provinces in Vietnam and overseas market also. Company headquarters: No.6, Pham Ngu Lao Street, Hoan Kiem District, Hanoi.', '<div class=\"content\">\r\n	<h2>\r\n		&nbsp;</h2>\r\n	<h2>\r\n		<span style=\"font-family: Arial;\">Với th&acirc;m ni&ecirc;n 20 năm trong nghề đ&aacute;!<o:p></o:p></span></h2>\r\n	<p>\r\n		<span style=\"font-size: 13pt; font-family: Arial;\">Từ những ng&agrave;y đầu th&agrave;nh lập, </span><span style=\"font-size:13.0pt;\r\nfont-family:Tahoma;color:black\"><a href=\"http://freemobileweb.mobi/\">tranh da quy </a> </span><span style=\"font-size: 13pt; font-family: Arial;\">chỉ hoạt động tr&ecirc;n c&aacute;c mỏ đ&aacute; qu&yacute;, đến nay đ&atilde; mở rộng hệ thống cửa h&agrave;ng ra khắp c&aacute;c tỉnh th&agrave;nh trong nước v&agrave; cũng đ&atilde; mở rộng ra nước ngo&agrave;i. Văn ph&ograve;ng c&ocirc;ng ty tại: Số 6 Phạm Ngũ L&atilde;o - Ho&agrave;n Kiếm - H&agrave; Nội.<o:p></o:p></span></p>\r\n	<h2>\r\n		<span style=\"font-size:13.0pt;font-family:Tahoma;\r\ncolor:black\"><a href=\"http://freemobileweb.mobi/\">TRANH Đ&Aacute; QU&Yacute;  </a>&nbsp;</span><span style=\"font-family: Arial;\">c&oacute; 2 mục ti&ecirc;u ch&iacute;nh:<o:p></o:p></span></h2>\r\n	<p>\r\n		<span style=\"font-size: 13pt; font-family: Arial;\">Thứ nhất, trở th&agrave;nh một trong những nh&agrave; cung cấp đ&aacute; qu&yacute; lớn nhất Việt <st1:country-region w:st=\"on\"><st1:place w:st=\"on\">Nam</st1:place></st1:country-region>, v&agrave; tạo điều kiện cho mỗi người y&ecirc;u đ&aacute; c&oacute; một vật hộ mệnh bằng đ&aacute;.<br />\r\n		Thứ hai, đưa t&agrave;i nguy&ecirc;n đ&aacute; qu&yacute; v&agrave; b&aacute;n qu&yacute; đến tay người ti&ecirc;u d&ugrave;ng Việt Nam, với ti&ecirc;u ch&iacute; &quot;người Việt ưu ti&ecirc;n d&ugrave;ng h&agrave;ng Việt&quot; để tr&aacute;nh chảy m&aacute;u t&agrave;i nguy&ecirc;n sang nước ngo&agrave;i.<o:p></o:p></span></p>\r\n	<h2>\r\n		<span style=\"font-family: Arial;\">Tổng quan<o:p></o:p></span></h2>\r\n	<p style=\"margin:0in;margin-bottom:.0001pt;line-height:19.35pt\">\r\n		<span style=\"font-size:13.0pt;font-family:Tahoma;color:black\"><a href=\"http://freemobileweb.mobi/\">tranh da quy choi &ndash; &ldquo;Tranh đ&aacute; qu&yacute;   &rdquo;</a><o:p></o:p></span></p>\r\n	<p>\r\n		<span style=\"font-size: 13pt; font-family: Arial;\">l&agrave; hệ thống cửa h&agrave;ng đ&aacute; phong thủy c&oacute; những sản phẩm v&agrave; dịch vụ sau:<o:p></o:p></span></p>\r\n	<p style=\"margin:0in;margin-bottom:.0001pt;line-height:19.35pt\">\r\n		<span style=\"font-size: 13pt; font-family: Arial;\">Đ&aacute; cảnh phong thủy Đ&aacute; qu&yacute; hộ mệnh Tư vấn phong thủy miễn ph&iacute; Đặt h&agrave;ng VIP theo y&ecirc;u cầu Đ&aacute; qu&yacute; của </span><span style=\"font-size:13.0pt;font-family:Tahoma;color:black\"><a href=\"http://freemobileweb.mobi/\">tranh da quy choi &ndash; &ldquo;Tranh đ&aacute; qu&yacute;   &rdquo;</a> </span><span style=\"font-size: 13pt; font-family: Arial;\">đa số l&agrave; những tinh thể nguy&ecirc;n bản tourmaline v&agrave; aquamarine. Ch&uacute;ng t&ocirc;i cũng c&oacute; rất nhiều ruby, saphire, topaz, amethyst, v.v... đ&atilde; m&agrave;i th&agrave;nh mặt đ&aacute; trang sức.<br />\r\n		Ng&ograve;ai ra </span><span style=\"font-size:13.0pt;font-family:Tahoma;color:black\"><a href=\"http://freemobileweb.mobi/\">tranh da quy choi &ndash; &ldquo;Tranh đ&aacute; qu&yacute;   &rdquo;</a><o:p></o:p></span></p>\r\n	<p style=\"margin:0in;margin-bottom:.0001pt;line-height:19.35pt\">\r\n		<span style=\"font-size: 13pt; font-family: Arial;\">&nbsp;c&ograve;n c&oacute; rất nhiều c&aacute;c loại đ&aacute; b&aacute;n qu&yacute; như thạch anh (đủ loại), m&atilde; n&atilde;o, chalcedony, gỗ h&oacute;a thạch, v.v... Những sản phẩm n&agrave;y c&oacute; từ th&ocirc;, cảnh, tới những bức tượng được chế t&aacute;c từ ch&iacute;nh b&agrave;n tay nghệ thuật của nghệ nh&acirc;n Việt <st1:country-region w:st=\"on\"><st1:place w:st=\"on\">Nam</st1:place></st1:country-region>.<br />\r\n		Tranh đ&aacute; qu&yacute;   &nbsp;b&aacute;n nhiều loại đ&aacute; qu&yacute; từ những vi&ecirc;n ngọc đ&atilde; m&agrave;i sẵn để l&agrave;m trang sức, đến những vi&ecirc;n đ&aacute; th&ocirc;, những vi&ecirc;n đ&aacute; cảnh, đ&aacute; phong thủy, đến những bức tranh đ&aacute; qu&yacute; đầy t&iacute;nh nghệ thuật. Ngo&agrave;i ra cửa h&agrave;ng c&ograve;n c&oacute; một bộ sưu tập Đ&ocirc;ng dược qu&yacute; hiếm như c&aacute;c loại cao xương, mật, rươu thuốc, v&agrave; sừng.</span><span style=\"font-size:13.0pt;\r\nfont-family:Tahoma;color:black\"><o:p></o:p></span></p>\r\n</div>\r\n', NULL, NULL, NULL, 'img/upload/b669888a8bf311ec64efa07bad501d34.jpg', 200, '', 0, 'Tranh da quy ', 'Tranh Đá Quý ', 1, 1, '2012-10-12', '2012-10-17 14:31:23', 1),
														(99,$shop_id, 'TRANH ĐÁ QUÝ  ', 0, 'GEMSTONE PAINTINGS', 'tranh-da-quy-ns', '<p>\r\n	TRANH Đ&Aacute; QU&Yacute;   - tranh da quy </p>\r\n', ' GEMSTONE PAINTINGS', '<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<strong>GIỚI THIỆU VỀ TRANH Đ&Aacute; QU&Yacute;  </strong></p>\r\n<p>\r\n	K&iacute;nh gửi qu&yacute; kh&aacute;ch h&agrave;ng!</p>\r\n<p>\r\n	<strong>TRANH Đ&Aacute; QU&Yacute;  </strong>&nbsp;xin được giới thiệu với qu&yacute; kh&aacute;ch một loại tranh nghệ thuật v&ocirc; c&ugrave;ng đặc sắc được tạo n&ecirc;n từ chất liệu rất đặc biệt,đ&oacute; l&agrave; đ&aacute; qu&yacute; thi&ecirc;n nhi&ecirc;n được lấy trực tiếp từ v&ugrave;ng mỏ Lục Y&ecirc;n của tỉnh Y&ecirc;n B&aacute;i.</p>\r\n<p>\r\n	<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;Dưới b&agrave;n tay kh&eacute;o l&eacute;o v&agrave; tinh tế <a href=\"http://freemobileweb.mobi/\">tranh da quy </a>, những vi&ecirc;n đ&aacute; &oacute;ng &aacute;nh lung linh với mu&ocirc;n v&agrave;n sắc m&agrave;u kỳ diệu đ&atilde; được dệt l&ecirc;n th&agrave;nh những bức tranh tuyệt mỹ. Sản phẩm tranh đ&aacute; qu&yacute; của ch&uacute;ng t&ocirc;i được l&agrave;m ho&agrave;n to&agrave;n từ đ&aacute; qu&yacute; thi&ecirc;n nhi&ecirc;n với sự kết hợp tuyệt vời của c&aacute;c lọai đ&aacute; qu&yacute; v&agrave; đ&aacute; b&aacute;n qu&yacute; như: ruby, sapphire,tourmaline,opal,garmet&hellip;<a href=\"http://freemobileweb.mobi/\">tranh da quy </a> n&ecirc;n tranh c&oacute; m&agrave;u sắc vĩnh cửu kh&ocirc;ng bị t&aacute;c động bởi m&ocirc;i trường v&agrave; nhiệt độ.</p>\r\n<p>\r\n	<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;Quy tr&igrave;nh l&agrave;m tranh phải trải qua nhiều c&ocirc;ng đọan phức tạp v&agrave; tinh tế như: đập đ&aacute; ,ph&acirc;n lọai ,tẩy rửa, s&agrave;ng sẩy ,vẽ tranh v&agrave; cuối c&ugrave;ng l&agrave; gắn đ&aacute;.Do đ&oacute; n&eacute;t độc d&aacute;o của tranh kh&ocirc;ng chỉ ở chất liệu qu&yacute; bền l&acirc;u c&ugrave;ng thời gian m&agrave; c&ograve;n ở gi&aacute; trị sức lao động nghệ thuật kết tinh trong tranh.</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;Sản phẩm của ch&uacute;ng t&ocirc;i đạt chất lượng v&agrave; thẩm mỹ của những người khắt khe nhất. tranh da quy choi &ndash; &ldquo;<a href=\"http://freemobileweb.mobi/\">Tranh đ&aacute; qu&yacute;  </a> &rdquo;</p>\r\n<p>\r\n	<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;tranh da quy choi &ndash; &ldquo;Tranh đ&aacute; qu&yacute;   &rdquo;</p>\r\n<p>\r\n	&nbsp;nhận chế t&aacute;c tranh theo y&ecirc;u cầu của qu&yacute; kh&aacute;ch. Hy vọng rằng qu&yacute; kh&aacute;ch h&agrave;ng sẽ chọn được những bức tranh v&ocirc; c&ugrave;ng &yacute; ngĩa để d&agrave;nh tặng cho gia đ&igrave;nh ,người th&acirc;n v&agrave; bạn b&egrave; m&igrave;nh.</p>\r\n<p>\r\n	Xin ch&acirc;n th&agrave;nh cảm ơn. <a href=\"http://freemobileweb.mobi/\">tranh da quy choi &ndash; &ldquo;Tranh đ&aacute; qu&yacute;   &rdquo;</a></p>\r\n<p>\r\n	TRANH Đ&Aacute; QU&Yacute;  .</p>\r\n<p>\r\n	&nbsp;</p>\r\n', NULL, NULL, NULL, 'img/upload/b669888a8bf311ec64efa07bad501d34.jpg', 201, '', 0, 'tranh da quy', 'tranh da quy  - TRANH ĐÁ QUÝ  ', 1, 1, '2012-10-17', '2012-10-17 14:31:44', 1);";
														
														$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_partners` (
							  `id` int(10) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `name` varchar(256) NOT NULL,
							  `phone` varchar(15) NOT NULL,
							  `email` varchar(256) NOT NULL,
							  `website` varchar(256) DEFAULT NULL,
							  `fax` varchar(15) DEFAULT NULL,
							  `address` varchar(256) NOT NULL,
							  `images` varchar(256) NOT NULL,
							  `content` text,
							  `created` date NOT NULL,
							  `modified` date NOT NULL,
							  `status` int(1) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;";
														
														$arrSql[] ="INSERT INTO `estore_partners` (`id`, `estore_id`, `name`, `phone`, `email`, `website`, `fax`, `address`, `images`, `content`, `created`, `modified`, `status`) VALUES
														(18,$shop_id, 'Quảng cáo vip', '0912 211 945', 'trung vip@gmail.com', 'dsf.com', NULL, 'Hà Nội', 'img/gallery/b669888a8bf311ec64efa07bad501d34.jpg', NULL, '2012-05-27', '2012-10-17', 1),
														(19,$shop_id, 'phuc', '0912 211 945', 'phucaagas@gmail.com', 'http://freemobileweb.mobi', NULL, 'Phú Viên', 'img/gallery/b669888a8bf311ec64efa07bad501d34.jpg', NULL, '2012-10-17', '2012-10-17', 1);";
														
														$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_polls` (
							  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
							  `count` int(10) NOT NULL,
							  `name` varchar(250) NOT NULL,
							  `created` date NOT NULL,
							  `status` int(2) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;";
														
														$arrSql[] ="INSERT INTO `estore_polls` (`id`, `estore_id`, `count`, `name`, `created`, `status`) VALUES
														(1,$shop_id, 13, '   Rất Xấu', '2011-12-01', 1),
														(2,$shop_id, 1, 'Xấu', '2011-12-01', 1),
														(3,$shop_id, 3, '   Bình thường', '2011-12-01', 1),
														(4,$shop_id, 15, 'Đẹp', '2011-12-01', 1),
														(6,$shop_id, 1, 'Quá đẹp', '2012-05-27', 1);";
														
														$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_products` (
							  `id` int(10) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `title` varchar(256) NOT NULL,
							  `title_en` varchar(256) NOT NULL,
							  `alias` varchar(250) NOT NULL,
							  `order` int(11) DEFAULT NULL,
							  `price` varchar(20) DEFAULT NULL,
							  `manufacturer` varchar(256) NOT NULL COMMENT 'hang sx',
							  `introduction` text NOT NULL,
							  `kichthuoc` varchar(50) NOT NULL,
							  `chatlieu` varchar(50) NOT NULL,
							  `khoanggia` int(11) NOT NULL,
							  `content` text NOT NULL,
							  `content_en` text NOT NULL,
							  `images` varchar(256) DEFAULT NULL,
							  `spkuyenmai` int(11) DEFAULT NULL,
							  `images_en` varchar(256) DEFAULT NULL,
							  `images1` varchar(250) DEFAULT NULL,
							  `images2` varchar(250) DEFAULT NULL,
							  `images3` varchar(250) NOT NULL,
							  `images4` varchar(250) DEFAULT NULL,
							  `detail` varchar(400) DEFAULT NULL,
							  `catproduct_id` int(10) NOT NULL,
							  `display` int(10) NOT NULL,
							  `code` varchar(50) NOT NULL,
							  `homeproduct` int(2) NOT NULL,
							  `newsproduct` int(2) NOT NULL COMMENT 'san pham moi',
							  `featuredproducts` int(2) NOT NULL COMMENT 'sp tieu bieu',
							  `saleoff` int(2) NOT NULL,
							  `meta_key` varchar(250) DEFAULT NULL,
							  `meta_des` varchar(250) DEFAULT NULL,
							  `created` datetime DEFAULT NULL,
							  `modified` datetime DEFAULT NULL,
							  `sptieubieu` tinyint(4) DEFAULT NULL,
							  `status` int(2) NOT NULL,
							  `speproduct` int(2) DEFAULT NULL,
							  `tranhdaquy` int(2) DEFAULT NULL,
							  `daquytho` int(2) DEFAULT NULL,
							  `daphongthuy` int(2) DEFAULT NULL,
							  `trangsuc` int(2) DEFAULT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;";
														
														$arrSql[] ="INSERT INTO `estore_products` (`id`, `estore_id`, `title`, `title_en`, `alias`, `order`, `price`, `manufacturer`, `introduction`, `kichthuoc`, `chatlieu`, `khoanggia`, `content`, `content_en`, `images`, `spkuyenmai`, `images_en`, `images1`, `images2`, `images3`, `images4`, `detail`, `catproduct_id`, `display`, `code`, `homeproduct`, `newsproduct`, `featuredproducts`, `saleoff`, `meta_key`, `meta_des`, `created`, `modified`, `sptieubieu`, `status`, `speproduct`, `tranhdaquy`, `daquytho`, `daphongthuy`, `trangsuc`) VALUES
														(32,$shop_id, 'Hạc trắng', 'White crane', 'hac-trang', NULL, '', '', '', '', '', 0, '<div class=\"content left\">\r\n	<div class=\"info_p\">\r\n		<div class=\"tr\">\r\n			<span style=\"color:#ff0000;\"><span>&diams; M&atilde; sản phẩm: </span>#1</span></div>\r\n		<div class=\"tr\">\r\n			<span style=\"color:#ff0000;\"><span>&diams; Gi&aacute; sản phẩm: </span> Li&ecirc;n hệ</span></div>\r\n		<div class=\"tr\">\r\n			<span style=\"color:#ff0000;\"><span>&diams; Trong kho: </span><span>Hết h&agrave;ng</span></span></div>\r\n		<div class=\"tr\">\r\n			<span style=\"color:#ff0000;\"><span>&diams; Th&ocirc;ng tin: </span></span></div>\r\n	</div>\r\n</div>\r\n', '', 'img/upload/bd0b4508ffc932e2b349707332889171.jpg', NULL, NULL, '', '', '', '', NULL, 74, 0, '', 0, 0, 0, 0, NULL, NULL, '2012-10-12 15:09:03', '2012-10-15 14:47:54', NULL, 1, 0, 1, 1, 1, 1),
														(33,$shop_id, 'Đôi chim công', 'Two peacocks', 'doi-chim-cong', NULL, '', '', '', '', '', 0, '<div class=\"content left\">\r\n	<div class=\"info_p\">\r\n		<div class=\"tr\">\r\n			<span>&diams; M&atilde; sản phẩm: </span>#2</div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Gi&aacute; sản phẩm: </span> Li&ecirc;n hệ</div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Trong kho: </span><span>Hết h&agrave;ng</span></div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Th&ocirc;ng tin: </span></div>\r\n	</div>\r\n</div>\r\n', '', 'img/upload/12f2fcfede7445d8de9bdb494a2ab5b2.jpg', NULL, NULL, '', '', '', '', NULL, 74, 0, '', 0, 0, 0, 0, NULL, NULL, '2012-10-12 15:09:46', '2012-10-12 16:06:23', NULL, 1, 1, 1, 0, 0, 0),
														(34,$shop_id, 'Thác hạc', 'Fall - cranes', 'thac-hac', NULL, '', '', '', '', '', 0, '<div class=\"content left\">\r\n	<div class=\"info_p\">\r\n		<div class=\"tr\">\r\n			<span>&diams; M&atilde; sản phẩm: </span>#12</div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Gi&aacute; sản phẩm: </span> Li&ecirc;n hệ</div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Trong kho: </span><span>Hết h&agrave;ng</span></div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Th&ocirc;ng tin: </span></div>\r\n	</div>\r\n</div>\r\n', '', 'img/upload/3d262c53f145536bd80fdecc7e29fc6a.jpg', NULL, NULL, '', '', '', '', NULL, 74, 0, '', 0, 0, 0, 0, NULL, NULL, '2012-10-12 15:10:21', '2012-10-12 16:06:31', NULL, 1, 1, 1, 0, 0, 0),
														(35,$shop_id, 'Vịnh', 'Bay', 'vinh', NULL, '', '', '', '', '', 0, '<div class=\"content left\">\r\n	<div class=\"info_p\">\r\n		<div class=\"tr\">\r\n			<span>&diams; M&atilde; sản phẩm: </span>#12</div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Gi&aacute; sản phẩm: </span> Li&ecirc;n hệ</div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Trong kho: </span><span>Hết h&agrave;ng</span></div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Th&ocirc;ng tin: </span></div>\r\n	</div>\r\n</div>\r\n', '', 'img/upload/9085e8a9b725acb1765610a8b48af6c0.jpg', NULL, NULL, '', '', '', '', NULL, 74, 0, '', 0, 0, 0, 0, NULL, NULL, '2012-10-12 15:11:00', '2012-10-12 16:06:39', NULL, 1, 1, 1, 0, 0, 0),
														(36,$shop_id, 'Tranh đá quý', 'Gemstone painting', 'tranh-da-quy', NULL, '', '', '', '', '', 0, '<div class=\"content left\">\r\n	<div class=\"info_p\">\r\n		<div class=\"tr\">\r\n			<span>&diams; M&atilde; sản phẩm: </span>#12</div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Gi&aacute; sản phẩm: </span> Li&ecirc;n hệ</div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Trong kho: </span><span>Hết h&agrave;ng</span></div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Th&ocirc;ng tin: </span></div>\r\n	</div>\r\n</div>\r\n', '', 'img/upload/f88487b1babf04c4dd4d62c8cc465a72.jpg', NULL, NULL, '', '', '', '', NULL, 74, 0, '', 0, 0, 0, 0, NULL, NULL, '2012-10-12 15:11:33', '2012-10-12 16:06:47', NULL, 1, 1, 1, 0, 0, 0),
														(37,$shop_id, 'Rừng cây lá đỏ', 'Red-leaved forest', 'rung-cay-la-do', NULL, '', '', '', '', '', 0, '<div class=\"content left\">\r\n	<div class=\"info_p\">\r\n		<div class=\"tr\">\r\n			<span>&diams; M&atilde; sản phẩm: </span>#12</div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Gi&aacute; sản phẩm: </span> Li&ecirc;n hệ</div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Trong kho: </span><span>Hết h&agrave;ng</span></div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Th&ocirc;ng tin: </span></div>\r\n	</div>\r\n</div>\r\n', '', 'img/upload/bbda08fdcee568a700c85c18e4f7db28.jpg', NULL, NULL, '', '', '', '', NULL, 74, 0, '', 0, 0, 0, 0, NULL, NULL, '2012-10-12 15:12:05', '2012-10-12 16:06:54', NULL, 1, 1, 1, 0, 0, 0),
														(38,$shop_id, 'Tranh đá quý', 'Gemstone painting', 'tranh-da-quy', NULL, '', '', '', '', '', 0, '<div class=\"content left\">\r\n	<div class=\"info_p\">\r\n		<div class=\"tr\">\r\n			<span>&diams; M&atilde; sản phẩm: </span>#12</div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Gi&aacute; sản phẩm: </span> Li&ecirc;n hệ</div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Trong kho: </span><span>Hết h&agrave;ng</span></div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Th&ocirc;ng tin: </span></div>\r\n	</div>\r\n</div>\r\n', '', 'img/upload/6fd88997cfb57b9fa3adaa098e3ff5cf.jpg', NULL, NULL, '', '', '', '', NULL, 74, 0, '', 0, 0, 0, 0, NULL, NULL, '2012-10-12 15:12:43', '2012-10-12 16:07:01', NULL, 1, 1, 1, 0, 0, 0),
														(39,$shop_id, 'Tranh đá quý', 'Gemstone painting', 'tranh-da-quy', NULL, '', '', '', '', '', 0, '<div class=\"content left\">\r\n	<div class=\"info_p\">\r\n		<div class=\"tr\">\r\n			<span>&diams; M&atilde; sản phẩm: </span>#12</div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Gi&aacute; sản phẩm: </span> Li&ecirc;n hệ</div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Trong kho: </span><span>Hết h&agrave;ng</span></div>\r\n		<div class=\"tr\">\r\n			<span>&diams; Th&ocirc;ng tin: </span></div>\r\n	</div>\r\n</div>\r\n', '', 'img/upload/84ab5ecfca2ab94e3d78acc0516eb9fd.jpg', NULL, NULL, '', '', '', '', NULL, 74, 0, '', 0, 0, 0, 0, NULL, NULL, '2012-10-12 15:13:19', '2012-10-12 15:13:19', NULL, 0, 0, 0, 1, 0, 1),
														(40,$shop_id, 'Tranh đá quý', 'Gemstone painting', 'tranh-da-quy', NULL, '', '', '', '', '', 0, '<p>\r\n	sdfsdf</p>\r\n', '', 'img/upload/9085e8a9b725acb1765610a8b48af6c0.jpg', NULL, NULL, '', '', '', '', NULL, 74, 0, '', 0, 0, 0, 0, NULL, NULL, '2012-10-12 15:47:23', '2012-10-12 16:07:08', NULL, 1, 1, 1, 0, 0, 0),
														(41,$shop_id, 'Tranh đá quý', 'Gemstone painting', 'tranh-da-quy', NULL, '', '', '', '', '', 0, '<p>\r\n	sdcvbcvb cvbcvb</p>\r\n', '', 'img/upload/bd0b4508ffc932e2b349707332889171.jpg', NULL, NULL, 'img/upload/12f2fcfede7445d8de9bdb494a2ab5b2.jpg', 'img/upload/bd0b4508ffc932e2b349707332889171.jpg', 'img/upload/12f2fcfede7445d8de9bdb494a2ab5b2.jpg', 'img/upload/bd0b4508ffc932e2b349707332889171.jpg', NULL, 74, 0, '', 0, 0, 0, 0, NULL, NULL, '2012-10-12 15:49:33', '2012-10-12 16:07:15', NULL, 1, 1, 1, 0, 0, 0),
														(42,$shop_id, 'Tranh đá quý', 'Gemstone painting', 'tranh-da-quy', NULL, '', '', '', '', '', 0, '<p>\r\n	sdfcv xcvxcvxc</p>\r\n', '', 'img/upload/84ab5ecfca2ab94e3d78acc0516eb9fd.jpg', NULL, NULL, '', '', '', '', NULL, 74, 0, '', 0, 0, 0, 0, NULL, NULL, '2012-10-12 15:50:07', '2012-10-12 15:50:07', NULL, 1, 1, 1, 0, 0, 0),
														(43,$shop_id, 'Rừng cây lá đỏ', 'Red-leaved forest', 'rung-cay-la-do', NULL, 'Liên Hệ', '', '', '', '', 0, '<p>\r\n	<strong>Rừng c&acirc;y l&aacute; đỏ</strong></p>\r\n<p>\r\n	<strong>&diams;</strong><strong>M&atilde; sản phẩm:&nbsp;</strong>#66</p>\r\n<p>\r\n	<strong>&diams;</strong><strong>Trong kho:&nbsp;Hết h&agrave;ng</strong></p>\r\n<p>\r\n	<strong>&diams;</strong><strong>Th&ocirc;ng tin:&nbsp;</strong>k&iacute;ch thước: 70*100(cm)</p>\r\n<p>\r\n	Tranh da quy - <a href=\"http:// ngocsonchoithu.com.vn\"><strong>Tranh đ&aacute; qu&yacute; </strong></a></p>\r\n', '', 'img/upload/5f2e58be0aef2fac48d8cffd95961cfe.png', NULL, NULL, '', '', '', '', NULL, 74, 0, '', 0, 0, 0, 0, NULL, NULL, '2012-10-15 14:37:16', '2012-10-15 14:48:01', NULL, 1, 1, 0, 0, 0, 0),
														(44,$shop_id, 'Tranh đồng quý', ' Gemstone - copper  painting', 'tranh-dong-quy', NULL, 'liên hệ', '', '', '', '', 0, '<p>\r\n	đang cap nhat</p>\r\n', '', 'img/upload/11f3afe30cdd8c5bd2414ce4aaf67388.jpg', NULL, NULL, '', '', '', '', NULL, 83, 0, '', 0, 0, 0, 0, NULL, NULL, '2012-12-11 17:18:53', '2012-12-11 17:18:53', NULL, 1, 1, 0, 0, 0, 0),
														(45,$shop_id, 'Tranh đồng đá quý Loại 1', 'Gemstone - copper  painting type 1', 'tranh-dong-da-quy-loai-1', NULL, '10000000', '', '', '', '', 0, '<p>\r\n	sản phẩm đang cạp nhật &nbsp;.&nbsp;sản phẩm đang cạp nhật &nbsp;.&nbsp;sản phẩm đang cạp nhật .&nbsp;sản phẩm đang cạp nhật .&nbsp;sản phẩm đang cạp nhật&nbsp;</p>\r\n<p>\r\n	sản phẩm đang cạp nhật .&nbsp;sản phẩm đang cạp nhật .&nbsp;sản phẩm đang cạp nhật .&nbsp;sản phẩm đang cạp nhật .&nbsp;sản phẩm đang cạp nhật&nbsp;</p>\r\n', '', 'img/upload/665b15ef86abe35eb0302901d300b376.jpg', NULL, NULL, '', '', '', '', NULL, 84, 0, '', 0, 0, 0, 0, NULL, NULL, '2012-12-11 17:23:40', '2012-12-11 17:23:40', NULL, 1, 1, 0, 0, 0, 0),
														(46,$shop_id, 'tranh da thu hoang phuc', 'Thu Hoang Phuc gemstone painting', 'tranh-da-thu-hoang-phuc', NULL, '306000', '', '', '', '', 0, '', '', 'img/upload/3b20e17a4e19e318b5aa9a7b80518b85.jpg', NULL, NULL, '', '', '', '', NULL, 70, 0, '', 0, 0, 0, 0, NULL, NULL, '2012-12-11 20:23:14', '2012-12-11 20:23:14', NULL, 1, 0, 1, 0, 0, 0);";
														
														$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_settings` (
							  `id` int(10) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `name` varchar(256) CHARACTER SET utf8 NOT NULL,
							  `map` text CHARACTER SET utf8 NOT NULL,
							  `name_en` varchar(256) NOT NULL,
							  `title` varchar(250) CHARACTER SET utf8 NOT NULL,
							  `title_en` varchar(250) NOT NULL,
							  `introduction` text CHARACTER SET utf8 NOT NULL,
							  `introduction_en` text NOT NULL,
							  `address` varchar(256) CHARACTER SET utf8 NOT NULL,
							  `address_eg` varchar(256) NOT NULL,
							  `info_other` varchar(256) NOT NULL,
							  `server` varchar(256) NOT NULL,
							  `phone` varchar(100) NOT NULL,
							  `mobile` varchar(15) NOT NULL,
							  `email` varchar(256) CHARACTER SET utf8 NOT NULL,
							  `username` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
							  `password` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
							  `url` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
							  `keyword` varchar(500) CHARACTER SET utf8 NOT NULL,
							  `content` text CHARACTER SET utf8 NOT NULL,
							  `content_en` text NOT NULL,
							  `description` text CHARACTER SET utf8 NOT NULL,
							  `descriptions` text NOT NULL,
							  `created` date NOT NULL,
							  `modified` text NOT NULL,
							  `footer` text NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;";
														
														$arrSql[] ="INSERT INTO `estore_settings` (`id`, `estore_id`, `name`, `map`, `name_en`, `title`, `title_en`, `introduction`, `introduction_en`, `address`, `address_eg`, `info_other`, `server`, `phone`, `mobile`, `email`, `username`, `password`, `url`, `keyword`, `content`, `content_en`, `description`, `descriptions`, `created`, `modified`, `footer`) VALUES
														(1,$shop_id, 'CÔNG TY ĐÁ QUÝ ', '<iframe width=\"260\" height=\"200\" frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\" src=\"https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=vi&amp;geocode=&amp;q=128c+dai+lav-+ha+noi&amp;aq=&amp;sll=33.989561,-118.108582&amp;sspn=0.370629,0.617294&amp;ie=UTF8&amp;hq=&amp;hnear=128+%C4%90%E1%BA%A1i+La,+%C4%90%E1%BB%93ng+T%C3%A2m,+Hai+B%C3%A0+Tr%C6%B0ng,+H%C3%A0+N%E1%BB%99i,+Vi%E1%BB%87t+Nam&amp;t=m&amp;z=14&amp;ll=20.997202,105.842956&amp;output=embed\"></iframe><br /><small><a href=\"https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=vi&amp;geocode=&amp;q=128c+dai+lav-+ha+noi&amp;aq=&amp;sll=33.989561,-118.108582&amp;sspn=0.370629,0.617294&amp;ie=UTF8&amp;hq=&amp;hnear=128+%C4%90%E1%BA%A1i+La,+%C4%90%E1%BB%93ng+T%C3%A2m,+Hai+B%C3%A0+Tr%C6%B0ng,+H%C3%A0+N%E1%BB%99i,+Vi%E1%BB%87t+Nam&amp;t=m&amp;z=14&amp;ll=20.997202,105.842956\" style=\"color:#0000FF;text-align:left\">Xem Bản đồ cỡ lớn hơn</a></small>', 'Gemstone Company', 'Tranh Đá Quý ', ' Gemstone Paintings ', '<div class=\"info_company\">\r\n	<div style=\"font-size:17px; font-weight:bold; color:#F00\">\r\n		C&Ocirc;NG TY Đ&Aacute; QU&Yacute;</div>\r\n	<div>\r\n		<span style=\"color:#000000;\">ĐC:&nbsp;</span>ĐC: Số nh&agrave; 6 &nbsp;- Long Bi&ecirc;n - H&agrave; Nội</div>\r\n	<div>\r\n		<span style=\"color: rgb(0, 0, 0);\">ĐT:&nbsp;</span>099878890 - 09090989</div>\r\n	<div>\r\n		<span style=\"color: rgb(0, 0, 0);\">Email:&nbsp;</span>phuca4@gmail.com<span style=\"color: rgb(0, 0, 0);\">&nbsp;Website:&nbsp;</span>http://daquydep.com.vn</div>\r\n	<div>\r\n		&nbsp;</div>\r\n	<div>\r\n		&nbsp;</div>\r\n</div>\r\n', 'GEMSTONE COMPANY Address: 236-218 Phu Vien Street, Long Bien District, Hanoi Telephone number:  Le Van Choi: 0912.211.945 0983933518 NguyenThi Thu: 0973.986.673 Email: lengoc29992@gmail.com Website: ngocsonchoithu.com.vn  ', 'ĐC: Số nhà 6  - Long Biên - Hà Nội', 'Address: 236-218 Phu Vien Street, Long Bien District, Hanoi', '', '', '099878890 - 09090989', '0912 217890', 'phuca4@gmail.com', NULL, NULL, 'http://daquydep.com.vn', 'tranh da quy ngoc son', '<div style=\"font-size: 17px; font-weight: bold; color: rgb(255, 0, 0);\">\r\n	C&Ocirc;NG TY Đ&Aacute; QU&Yacute;</div>\r\n<div>\r\n	<span style=\"color: rgb(0, 0, 0);\">ĐC:&nbsp;</span>ĐC: Số nh&agrave; 6 &nbsp;- Long Bi&ecirc;n - H&agrave; Nội</div>\r\n<div>\r\n	<span style=\"color: rgb(0, 0, 0);\">ĐT:&nbsp;</span>099878890 - 09090989</div>\r\n<div>\r\n	<span style=\"color: rgb(0, 0, 0);\">Email:&nbsp;</span>phuca4@gmail.com<span style=\"color: rgb(0, 0, 0);\">&nbsp;Website:&nbsp;</span>http://daquydep.com.vn</div>\r\n', '', 'tranh da quy  ', '', '2012-06-05', '1407923019', '');";
														
														$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_slideshows` (
							  `id` int(10) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
							  `name_en` varchar(250) NOT NULL,
							  `images` varchar(250) CHARACTER SET utf8 NOT NULL,
							  `created` datetime NOT NULL,
							  `status` int(2) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;";
														
														$arrSql[] ="INSERT INTO `estore_slideshows` (`id`, `estore_id`, `name`, `name_en`, `images`, `created`, `status`) VALUES
														(23,$shop_id, 'tranh đá quý ', '', 'img/gallery/e34c16f993ef4eaf31658bf43760c20d.jpg', '2012-06-05 12:12:59', 1),
														(28,$shop_id, 'tranh đá quý ', '', 'img/gallery/5e0cbe848f02a23657eecb9001ae8b5d.jpg', '2012-10-14 10:25:30', 1),
														(29,$shop_id, 'tranh da quy-newwshop ', '', 'img/gallery/17a612d3863369eb766af9e91896ae52.jpg', '2012-10-16 08:59:41', 1);";
														
														$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_templates` (
							  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
							  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
							  `url` varchar(250) CHARACTER SET utf8 NOT NULL,
							  `images` varchar(250) CHARACTER SET utf8 NOT NULL,
							  `created` date NOT NULL,
							  `display` int(2) NOT NULL,
							  `status` int(2) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
														
														$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_users` (
							  `id` int(11) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `password` varchar(200) NOT NULL,
							  `name` varchar(200) NOT NULL,
							  `email` varchar(50) NOT NULL,
							  `phone` int(15) NOT NULL,
							  `birth_date` varchar(200) NOT NULL,
							  `sex` varchar(20) NOT NULL,
							  `images` varchar(256) NOT NULL,
							  `created` datetime NOT NULL,
							  `modified` datetime NOT NULL,
							  `active_key` varchar(50) DEFAULT NULL,
							  `status` int(1) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;";
														
														$arrSql[] ="INSERT INTO `estore_users` (`id`, `estore_id`, `password`, `name`, `email`, `phone`, `birth_date`, `sex`, `images`, `created`, `modified`, `active_key`, `status`) VALUES
														(17,$shop_id, '61c303060b45b10eb2335be80d2b854a', 'admin', 'admin@admin.com', 2147483647, '18-11-1968', '1', '', '2011-05-17 14:33:04', '2012-10-18 14:59:59', '70c639df5e30bdee440e4cdf599fec2b', 1),
														(41,$shop_id, '61c303060b45b10eb2335be80d2b854a', 'phuca4', 'phuca4@gmail.com', 0, '', '', '', '2012-10-18 15:15:20', '2012-10-18 15:15:20', NULL, 0),
														(40,$shop_id, 'e3bab86dfa204eba2bfa8fd06884621d', 'hoangthang', 'hoangthangacer87@gmail.com', 0, '', '', '', '2012-10-18 14:59:34', '2012-10-18 14:59:34', NULL, 0);";
														
														$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_videos` (
							  `id` int(11) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
							  `name_en` varchar(250) NOT NULL,
							  `video` varchar(250) CHARACTER SET utf8 NOT NULL,
							  `created` datetime NOT NULL,
							  `LinkUrl` varchar(250) NOT NULL,
							  `status` int(2) NOT NULL,
							  `left` int(2) NOT NULL,
							  `right` int(2) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;";
														
														$arrSql[] ="INSERT INTO `estore_videos` (`id`, `estore_id`, `name`, `name_en`, `video`, `created`, `LinkUrl`, `status`, `left`, `right`) VALUES
														(2,$shop_id, 'Tranh đá quý', '', 'video/upload/d1cf85d0be87844bb3ff5144fe45c00a.flv', '2012-10-11 12:25:30', '', 1, 0, 0),
														(3,$shop_id, 'New tranh da quy', '', 'video/upload/d1cf85d0be87844bb3ff5144fe45c00a.flv', '2012-10-18 08:38:09', '', 1, 0, 0);";
														
														$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_wards` (
							  `id` int(10) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `name` varchar(256) CHARACTER SET utf8 NOT NULL,
							  `district_id` int(10) NOT NULL,
							  `status` int(1) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
														
														$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_weblinks` (
							  `id` int(11) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `name` varchar(256) CHARACTER SET utf8 NOT NULL,
							  `link` varchar(256) CHARACTER SET ucs2 NOT NULL,
							  `created` date NOT NULL,
							  `modified` date NOT NULL,
							  `status` int(2) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;";
							
							$arrSql[] ="INSERT INTO `estore_weblinks` (`id`, `estore_id`, `name`, `link`, `created`, `modified`, `status`) VALUES
							(8,$shop_id, 'Google', 'http://google.vn', '0000-00-00', '0000-00-00', 1),
							(9,$shop_id, 'dantri', 'http://dantri.com.vn', '0000-00-00', '0000-00-00', 1);";
							
						if($username ==='' and $password === '' )
							{
							    $db = ConnectionManager::getDataSource('default');
								//$nameLangueCopy = $db->rawQuery($sql);
								try {
									foreach ($arrSql as $sql) {
										$db->rawQuery($sql);
										}
									$result = "Sucessfull";
								} catch (\Exception $exc) {
									$result = $exc->getMessage();
									
								}
							}
							
							if($username !='' and $password != '' )
							{
								$db = new ConnectionManager;
								$config = array(
										//'className' => 'Cake\Database\Connection',
										'driver' => 'mysql',
										'persistent' => false,
										'host' =>'localhost',
										'login' =>$username,
										'password' =>$password,
										'database' =>$namedatabase,
										'prefix' => false,
										'encoding' => 'utf8',
										'timezone' => 'UTC',
										'cacheMetadata' => true
								);
								$db->create($namedatabase,$config);
								$name = ConnectionManager::getDataSource($namedatabase);
								try {
									foreach ($arrSql as $sql) {
										$name->rawQuery($sql);
									}
									$result = "Sucessfull";
								} catch (\Exception $exc) {
									$result = $exc->getMessage();
										
								}
								
							}
								
							return $result;
							break;
						}
					case "50000566_fr":
						{
							// insert recode all form table
							return $sql_langue ="Chu Viet nam";
							break;
						}
					case "50000566_ru":
						{
							;
							return $sql_langue ="Chu Tieng anh";
							break;
						}
						
				//-------------end 50000566------------------		
				// theme 50000565 : bepga eshop
					case "50000565_vi" :
					case "50000565_en" :
						{   
						$arrSql = array();
						if($username ==='' and $password === '' )
						{	
							$arrSql[]="CREATE DATABASE IF NOT EXISTS `".$namedatabase."` /*!40100 DEFAULT CHARACTER SET utf8 */;";
							$arrSql[]="USE `".$namedatabase."`;";	
						}	
						$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_advertisements` (
										  `id` int(50) NOT NULL AUTO_INCREMENT,
										  `estore_id` int(50) NOT NULL DEFAULT '0',
										  `name` varchar(256) CHARACTER SET utf8 NOT NULL,
										  `link` varchar(256) CHARACTER SET ucs2 NOT NULL,
										  `images` varchar(256) CHARACTER SET utf8 NOT NULL,
										  `created` date NOT NULL,
										  `modified` date NOT NULL,
										  `status` int(2) NOT NULL,
										  `display` int(2) DEFAULT NULL,
										  PRIMARY KEY (`id`),
										  UNIQUE KEY `id` (`id`)
										) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;";
							
							$arrSql[] ="INSERT INTO `estore_advertisements` (`id`, `estore_id`, `name`, `link`, `images`, `created`, `modified`, `status`, `display`) VALUES
										(25,$shop_id, 'cong ty abc', 'http://zing.vn', 'img/gallery/88654b0d4c2e2d7b8a4fd519f870c2b3.jpg', '2011-10-03', '2012-09-14', 1, 1),
										(24,$shop_id, 'quang cao', 'http://dantri.com.vn', 'img/gallery/19c4d76ab1090e42cd476cf7974f419c.jpg', '2011-10-03', '2012-09-14', 1, 2),
										(26,$shop_id, 'cong ty abc', 'http://zing.vn', 'img/gallery/aed5ce1f0358efc5b80877da0fd817d8.jpg', '2011-10-03', '2012-09-14', 1, 0),
										(27,$shop_id, 'zx', 'http://agribank.com.vn', 'img/gallery/69dbb1013ad45d844e128bd7facea6ee.jpg', '2012-09-14', '2012-09-14', 1, 2),
										(28,$shop_id, 'zx', 'http://agribank.com.vn', 'img/gallery/69dbb1013ad45d844e128bd7facea6ee.jpg', '2012-09-14', '2012-09-14', 1, 2),
										(29,$shop_id, 'quang cao', 'http://truongthanhauto.com.vn', 'img/gallery/69dbb1013ad45d844e128bd7facea6ee.jpg', '2012-09-14', '2012-09-14', 1, 2),
										(30,$shop_id, 'asdasd', 'http://duhocdailoan.info', 'img/gallery/8dc8529c47186151846ae23b345e835b.jpg', '2012-09-14', '2012-09-14', 1, 3),
										(31,$shop_id, 'asdsd', 'http://dantri.com.vn', 'img/gallery/1cf5b8f4b563947b0c3b8c29142215c9.jpg', '2012-09-14', '2012-09-14', 1, 3),
										(32,$shop_id, 'asdasd', 'http://zing.vn', 'img/gallery/8dc8529c47186151846ae23b345e835b.jpg', '2012-09-14', '2012-09-14', 1, 3);";
							
																						
							$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_albums` (
										  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
										  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
										  `tt` int(10) DEFAULT NULL,
										  `parent_id` int(10) DEFAULT NULL,
										  `lft` int(10) DEFAULT NULL,
										  `rght` int(10) DEFAULT NULL,
										  `name` varchar(255) DEFAULT NULL,
										  `created` date NOT NULL,
										  `modified` date NOT NULL,
										  `status` int(2) NOT NULL,
										  `name_eg` varchar(255) DEFAULT NULL,
										  `images` varchar(255) DEFAULT NULL,
										  PRIMARY KEY (`id`)
										) ENGINE=MyISAM AUTO_INCREMENT=207 DEFAULT CHARSET=utf8;";
							
							$arrSql[]="INSERT INTO `estore_albums` (`id`, `estore_id`, `tt`, `parent_id`, `lft`, `rght`, `name`, `created`, `modified`, `status`, `name_eg`, `images`) VALUES
										(204,$shop_id, NULL, NULL, 1, 2, 'Ảnh khánh thành dây truyền mới', '2012-05-07', '2012-06-18', 1, 'Picture of new line inauguration', 'img/upload/product/2a1bd4f22b63ff775ad0cc8db96591aa.jpg'),
										(206,$shop_id, NULL, NULL, 3, 4, 'Họp ngày 30/04/2012', '2012-05-08', '2012-06-18', 1, 'on 30th April, 2012', 'img/upload/product/102e31ae3f441fbcb391f9e5a26bcbb9.jpg');";
													
						     $arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_answerquestions` (
										  `id` int(50) NOT NULL AUTO_INCREMENT,
										  `estore_id` int(50) NOT NULL DEFAULT '0',
										  `name` varchar(256) CHARACTER SET utf8 NOT NULL,
										  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
										  `mobile` varchar(256) CHARACTER SET utf8 NOT NULL,
										  `address` varchar(225) CHARACTER SET utf8 NOT NULL,
										  `title` varchar(225) CHARACTER SET utf8 NOT NULL,
										  `introduction` text CHARACTER SET utf8 NOT NULL,
										  `content` text CHARACTER SET utf8 NOT NULL,
										  `answer` text CHARACTER SET utf8 NOT NULL,
										  `created` datetime NOT NULL,
										  `status` int(2) NOT NULL,
										  PRIMARY KEY (`id`)
										) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;";
																	
									$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_banners` (
										  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
										  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
										  `name` varchar(250) NOT NULL,
										  `images` varchar(250) NOT NULL,
										  `created` datetime NOT NULL,
										  `status` int(2) NOT NULL,
										  PRIMARY KEY (`id`)
										) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;";
																	
									$arrSql[]="INSERT INTO `estore_banners` (`id`, `estore_id`, `name`, `images`, `created`, `status`) VALUES
												(1,$shop_id, 'banner', 'img/gallery/af69e2816dec568215d831d8457b36eb.jpg', '2011-10-02 18:16:41', 1);";
										
									$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_categories` (
										  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
										  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
										  `tt` int(10) DEFAULT NULL,
										  `parent_id` int(10) DEFAULT NULL,
										  `lft` int(10) DEFAULT NULL,
										  `rght` int(10) DEFAULT NULL,
										  `name` varchar(255) DEFAULT NULL,
										  `name_en` varchar(256) NOT NULL,
										  `created` date NOT NULL,
										  `modified` date NOT NULL,
										  `status` int(2) NOT NULL,
										  `images` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
										  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
										  PRIMARY KEY (`id`)
										) ENGINE=MyISAM AUTO_INCREMENT=229 DEFAULT CHARSET=utf8;";
																	
									$arrSql[]="INSERT INTO `estore_categories` (`id`, `estore_id`, `tt`, `parent_id`, `lft`, `rght`, `name`, `name_en`, `created`, `modified`, `status`, `images`, `alias`) VALUES
												(146,$shop_id, 0, 224, 16, 17, 'GIỚI THIỆU', 'ABOUT US', '2011-09-27', '2012-09-14', 1, '', 'gioi-thieu'),
												(156,$shop_id, 3, 224, 2, 7, 'KHUYẾN MÃI', 'PROMOTION', '2011-09-27', '2012-09-14', 1, '', 'khuyen-mai'),
												(224,$shop_id, NULL, NULL, 1, 18, 'DANH MỤC TIN TỨC - DỊCH VỤ - TƯ VẤN', 'NEWS-SERVICE-CONSULTANCY CATEGORY', '2012-07-23', '2012-09-14', 1, '', 'danh-muc-tin-tuc-dich-vu-tu-van'),
												(225,$shop_id, 4, 224, 14, 15, 'TUYỂN DỤNG', 'RECRUITMENT', '2012-07-23', '2012-09-14', 1, '', 'tuyen-dung'),
												(226,$shop_id, 1, 224, 8, 9, 'DỊCH VỤ', 'SERVICE', '2012-07-23', '2012-09-14', 1, '', 'dich-vu'),
												(227,$shop_id, 2, 224, 10, 11, 'TƯ VẤN', 'CONSULTANCY', '2012-07-23', '2012-09-14', 1, '', 'tu-van'),
												(228,$shop_id, 5, 224, 12, 13, 'TRỢ GIÚP', 'HELP', '2012-07-23', '2012-09-14', 1, '', 'tro-giup');";
										
									$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_catproducts` (
										  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
										  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
										  `parent_id` int(10) DEFAULT NULL,
										  `lft` int(10) DEFAULT NULL,
										  `rght` int(10) DEFAULT NULL,
										  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
										  `name_en` varchar(250) CHARACTER SET ucs2 NOT NULL,
										  `created` date NOT NULL,
										  `modified` datetime NOT NULL,
										  `status` int(2) NOT NULL,
										  `char` int(10) DEFAULT NULL,
										  `images` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
										  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
										  PRIMARY KEY (`id`)
										) ENGINE=MyISAM AUTO_INCREMENT=123 DEFAULT CHARSET=latin1;";
																	
										$arrSql[]="INSERT INTO `estore_catproducts` (`id`, `estore_id`, `parent_id`, `lft`, `rght`, `name`, `name_en`, `created`, `modified`, `status`, `char`, `images`, `alias`) VALUES
												(11,$shop_id, NULL, 1, 48, 'Danh mục sản phẩm', 'Product category', '2012-02-19', '2012-09-13 16:07:33', 1, NULL, '', 'danh-mục-sản-phảm'),
												(39,$shop_id, 11, 2, 11, 'BẾP GA', 'GAS STOVE', '2012-07-29', '2012-09-13 16:54:57', 1, NULL, '', 'bép-ga'),
												(40,$shop_id, 39, 9, 10, 'Bếp ga du lịch', 'Travel gas stove', '2012-07-29', '2012-09-13 16:41:21', 1, NULL, '', 'bép-ga-du-lịch'),
												(97,$shop_id, 11, 12, 21, 'MÁY HÚT KHÓI KHỬ MÙI', 'MACHINE HOODS', '2012-08-06', '2012-09-13 16:11:10', 1, NULL, '', 'máy-hút-khói-khủ-mùi'),
												(98,$shop_id, 11, 38, 47, 'BÌNH GA & LINH KIỆN', 'GAS CONTAINER & COMPONENTS', '2012-08-06', '2012-09-13 16:55:12', 1, NULL, '', 'bình-ga-linh-kiẹn'),
												(121,$shop_id, 117, 40, 41, 'Bình ga 13kg', 'Gas container 13kg', '2012-09-14', '2012-09-14 12:01:37', 1, NULL, '', 'binh-ga-13kg'),
												(122,$shop_id, 117, 42, 43, 'Bình ga 14kg', 'Gas container 14kg', '2012-09-14', '2012-09-14 12:14:16', 1, NULL, '', 'binh-ga-14kg'),
												(105,$shop_id, 39, 5, 6, 'Bếp ga dương', 'Positive gas stove', '2012-08-23', '2012-09-13 16:17:46', 1, NULL, 'img/upload/1c1e93203afe53fb5cda97210c838108.png', 'bép-ga-duong'),
												(104,$shop_id, 39, 3, 4, 'Bếp ga âm', 'Negative gas stove', '2012-08-23', '2012-09-13 16:17:11', 1, NULL, 'img/upload/ce7e12c2374be3da8770b3d3f85b14f4.png', 'bép-ga-am'),
												(106,$shop_id, 11, 22, 31, 'THẾ GIỚI TỦ BẾP', 'WORLD OF KITCHEN CABINETS', '2012-09-13', '2012-09-13 16:30:45', 1, NULL, '', 'thé-giói-tủ-bép'),
												(107,$shop_id, 11, 32, 37, 'BẾP CÔNG NGHIỆP', 'INDUSTRIAL STOVE', '2012-09-13', '2012-09-13 16:14:07', 1, NULL, '', 'bép-cong-nghiẹp'),
												(108,$shop_id, 39, 7, 8, 'Bếp ga đơn', 'Singer gas stove', '2012-09-13', '2012-09-13 16:19:04', 1, NULL, 'img/upload/181885ec49984106001d4b1bb0cb9e78.jpg', 'bép-ga-don'),
												(109,$shop_id, 106, 23, 24, 'Tủ bếp dạng chữ G', 'G-shaped kitchen cabinet', '2012-09-13', '2012-09-13 16:24:32', 1, NULL, '', 'tủ-bép-dạng-chũ-g'),
												(110,$shop_id, 106, 25, 26, 'Tủ bếp dạng chữ L', 'L-shaped kitchen cabinet', '2012-09-13', '2012-09-13 16:24:54', 1, NULL, '', 'tủ-bép-dạng-chũ-l'),
												(111,$shop_id, 106, 27, 28, 'Tủ bếp dạng chữ I', 'I-shaped kitchen cabinet', '2012-09-13', '2012-09-13 16:25:12', 1, NULL, '', 'tủ-bép-dạng-chũ-i'),
												(112,$shop_id, 106, 29, 30, 'Tủ bếp dạng chữ U', 'U-shaped kitchen cabinet', '2012-09-13', '2012-09-13 16:25:28', 1, NULL, '', 'tủ-bép-dạng-chũ-u'),
												(113,$shop_id, 97, 13, 14, 'Hút mùi cổ điển', 'Classic hood', '2012-09-13', '2012-09-13 16:32:48', 1, NULL, '', 'hut-mui-co-dien'),
												(114,$shop_id, 97, 15, 16, 'Hút mùi âm tủ', 'Negative hood', '2012-09-13', '2012-09-13 16:33:14', 1, NULL, '', 'hut-mui-am-tu'),
												(115,$shop_id, 97, 17, 18, 'Hút mùi ống khói', 'chimney hood', '2012-09-13', '2012-09-13 16:33:28', 1, NULL, '', 'hut-mui-ong-khoi'),
												(116,$shop_id, 97, 19, 20, 'Hút mùi đảo', 'Swivel hood', '2012-09-13', '2012-09-13 16:33:59', 1, NULL, '', 'hut-mui-dao'),
												(117,$shop_id, 98, 39, 44, 'Bình ga', 'Gas container', '2012-09-13', '2012-09-13 16:35:02', 1, NULL, '', 'bình-ga'),
												(118,$shop_id, 98, 45, 46, 'Van điều áp gas', 'Gas valve', '2012-09-13', '2012-09-13 16:35:27', 1, NULL, '', 'van-dieu-ap-gas'),
												(119,$shop_id, 107, 33, 34, 'Bếp cho quán ăn', 'Stove for mini-restaurant', '2012-09-13', '2012-09-13 16:37:59', 1, NULL, '', 'bép-cho-quán-an'),
												(120,$shop_id, 107, 35, 36, 'Bếp cho nhà hàng', 'Stove for restaurant', '2012-09-13', '2012-09-13 16:38:17', 1, NULL, '', 'bép-cho-nhà-hàng');";
																									
											$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_comments` (
												  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
												  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
												  `title` varchar(100) NOT NULL,
												  `name` varchar(50) NOT NULL,
												  `content` text NOT NULL,
												  `id_news` int(10) NOT NULL,
												  `user_id` int(10) NOT NULL,
												  `email` varchar(50) NOT NULL,
												  `created` datetime NOT NULL,
												  `status` int(2) NOT NULL,
												  PRIMARY KEY (`id`)
												) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;";
									
							
							$arrSql[]="INSERT INTO `estore_comments` (`id`, `estore_id`, `title`, `name`, `content`, `id_news`, `user_id`, `email`, `created`, `status`) VALUES
										(67,$shop_id, '', 'Nguyễn hải', 'Chất lượng moto rất tốt', 0, 0, 'hai@gmail.com', '2012-07-26 01:25:36', 1),
										(66,$shop_id, '', 'Nguyễn Nam', 'Kiểu dáng thật tuyệt', 0, 0, 'nguyennam@gmail.com', '2012-07-26 01:17:16', 1),
										(68,$shop_id, '', 'Nguyễn Thanh Tùng', 'Tôi muốn mua xe iata xin hướng dẫn cho tôi', 0, 0, 'nt2ungvn@gmail.com', '2012-07-26 01:38:49', 1),
										(69,$shop_id, '', 'Hồ Hoài', 'Chất lượng của công ty phục vụ rất rốt!', 0, 0, 'hohoai@yahoo.com', '2012-07-26 02:24:11', 0),
										(70,$shop_id, '', 'Hương', 'Các bạn thử tới công ty nhé\', ở nơi này có rất nhiều cảnh đẹp. Con người rất ôn hòa!', 0, 0, 'huong86@yahoo.com', '2012-07-26 02:29:13', 1),
										(73,$shop_id, '', 'Hoàng Phúc', 'Hoàng Phúc', 0, 0, 'phuca4@gmail.com', '2014-07-27 03:04:51', 1),
										(74,$shop_id, '', 'Hay đó nhé', 'Uh hay Lắm đó', 0, 0, 'phuca4@gmail.com', '2014-07-27 03:06:08', 1);";
												
							$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_contacts` (
							  `id` int(50) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `name` varchar(50) NOT NULL,
							  `email` varchar(50) NOT NULL,
							  `mobile` varchar(20) NOT NULL,
							  `fax` varchar(20) DEFAULT NULL,
							  `company` varchar(200) DEFAULT NULL,
							  `title` varchar(200) NOT NULL,
							  `content` text NOT NULL,
							  `content_send` text,
							  `created` date NOT NULL,
							  `modified` date NOT NULL,
							  `status` int(1) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;";
							
							$arrSql[]="INSERT INTO `estore_contacts` (`id`, `estore_id`, `name`, `email`, `mobile`, `fax`, `company`, `title`, `content`, `content_send`, `created`, `modified`, `status`) VALUES
							(4,$shop_id, 'Hoàng Công Phúc', 'phua4@gmail.com', '01688504263', '09487547584', 'Công ty abc', 'Chúc may mắn', 'dang test mail', '<p>\r\n	you are me and i am you</p>\r\n', '2011-07-04', '2011-07-04', 1);";
							
							$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_galleries` (
							  `id` int(11) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `name` varchar(50) DEFAULT NULL,
							  `images` varchar(255) NOT NULL,
							  `created` date NOT NULL,
							  `modified` date NOT NULL,
							  `status` int(1) NOT NULL,
							  `album_id` int(50) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;";
							
							$arrSql[]="INSERT INTO `estore_galleries` (`id`, `estore_id`, `name`, `images`, `created`, `modified`, `status`, `album_id`) VALUES
									(67,$shop_id, 'anh 4', 'img/gallery/43d68f446ea7527b3dc6daddc6dc80df.jpg', '2012-06-19', '2012-06-19', 1, 204),
									(68,$shop_id, 'anh 5', 'img/gallery/2cf9661dce136d9f6ca6bfce24933a71.jpg', '2012-06-19', '2012-06-19', 1, 204),
									(64,$shop_id, 'anh 3', 'img/gallery/0452ded776f37827ca4887da56816ba8.jpg', '2012-05-08', '2012-06-19', 1, 206),
									(65,$shop_id, 'anh 2', 'img/gallery/e19281319ecba7282bcd8239287056d7.jpg', '2012-05-08', '2012-06-19', 1, 206),
									(66,$shop_id, 'Anh dep', 'img/gallery/7db208fcf126d1bb3cfee4c6b6bacf62.jpg', '2012-05-08', '2012-06-19', 1, 206);";
							
							$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_helps` (
							  `id` int(11) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `title` varchar(200) NOT NULL,
							  `title_en` varchar(200) NOT NULL,
							  `user_support` varchar(200) DEFAULT NULL,
							  `user_yahoo` varchar(200) DEFAULT NULL,
							  `user_skype` varchar(200) DEFAULT NULL,
							  `user_mobile` varchar(20) DEFAULT NULL,
							  `user_email` varchar(30) DEFAULT NULL,
							  `hotline` varchar(20) DEFAULT NULL,
							  `created` datetime DEFAULT NULL,
							  `modified` datetime DEFAULT NULL,
							  `status` tinyint(4) DEFAULT '1',
							  `user_yahoo1` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
							  `user_yahoo2` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
							  `user_yahoo3` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;";
														
							$arrSql[]="INSERT INTO `estore_helps` (`id`, `estore_id`, `title`, `title_en`, `user_support`, `user_yahoo`, `user_skype`, `user_mobile`, `user_email`, `hotline`, `created`, `modified`, `status`, `user_yahoo1`, `user_yahoo2`, `user_yahoo3`) VALUES
								(7,$shop_id, 'Tư vấn', 'Support', 'Hoàng Công Phúc', 'adv.golbalmedia2', 'adv.golbalmedia2', '043.8281.768', 'phuca4@gmail.com', '043.8281.768', '2012-06-14 11:19:25', '2014-07-27 17:57:17', 1, 'phuca478', 'phuca478', 'phuca478'),
								(8,$shop_id, 'Kỹ Thuật', 'Technology', 'Mr. Phúc', 'adv.golbalmedia2', 'adv.golbalmedia2', '01229525955', 'phuca4@gmail.com', NULL, '2012-08-22 12:03:14', '2014-07-27 17:57:26', 1, 'phuca478', 'phuca478', 'phuca478');";
														
							$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_helpsd` (
							  `id` int(10) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `name` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
							  `name1` varchar(256) CHARACTER SET utf8 NOT NULL,
							  `name2` varchar(256) CHARACTER SET utf8 NOT NULL,
							  `title` varchar(256) CHARACTER SET utf8 NOT NULL,
							  `sdt` varchar(20) DEFAULT NULL,
							  `sdt1` varchar(20) NOT NULL,
							  `sdt2` varchar(20) NOT NULL,
							  `yahoo` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
							  `yahoo1` varchar(256) CHARACTER SET utf8 NOT NULL,
							  `yahoo2` varchar(256) NOT NULL,
							  `skype` varchar(256) DEFAULT NULL,
							  `skype1` varchar(256) CHARACTER SET utf8 NOT NULL,
							  `skype2` varchar(256) CHARACTER SET utf8 NOT NULL,
							  `created` datetime NOT NULL,
							  `modified` datetime NOT NULL,
							  `status` int(1) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;";
														
							$arrSql[]="INSERT INTO `estore_helpsd` (`id`, `estore_id`, `name`, `name1`, `name2`, `title`, `sdt`, `sdt1`, `sdt2`, `yahoo`, `yahoo1`, `yahoo2`, `skype`, `skype1`, `skype2`, `created`, `modified`, `status`) VALUES
								(22,$shop_id, 'Kỹ thuật 1', '', '', '', NULL, '04 38515107', '09 38515108', NULL, 'vulamnguyen', 'vulamnguyen', 'haihs26', '', '', '2011-12-06 10:08:49', '2012-06-14 10:25:11', 1);";
							
							$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_infomationdetails` (
							  `id` int(11) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `infomations_id` int(11) NOT NULL,
							  `product_id` int(11) NOT NULL,
							  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
							  `images` varchar(250) NOT NULL,
							  `quantity` int(11) NOT NULL,
							  `price` int(11) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;";
														
						$arrSql[]="INSERT INTO `estore_infomationdetails` (`id`, `estore_id`, `infomations_id`, `product_id`, `name`, `images`, `quantity`, `price`) VALUES
							(5,$shop_id, 36, 19, 'sp14', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_27.jpg', 1, 200),
							(6,$shop_id, 36, 20, 'sp13', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 1, 400),
							(7,$shop_id, 37, 20, 'sp13', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 2, 400),
							(8,$shop_id, 37, 19, 'sp14', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_27.jpg', 1, 200),
							(9,$shop_id, 38, 21, 'sp2', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_17.jpg', 1, 300),
							(10,$shop_id, 38, 27, 'sp3', '/khieuvu/estoreadmin/webroot/upload/image/files/3.jpg', 1, 200),
							(11,$shop_id, 39, 27, 'sp3', '/khieuvu/estoreadmin/webroot/upload/image/files/3.jpg', 23, 200),
							(12,$shop_id, 40, 25, 'sp1', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_09.jpg', 3, 120),
							(13,$shop_id, 40, 26, 'sp43', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 1, 120000),
							(14,$shop_id, 41, 21, 'sp2', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_17.jpg', 2, 300),
							(15,$shop_id, 41, 19, 'sp14', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_27.jpg', 1, 200),
							(16,$shop_id, 41, 26, 'sp43', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 1, 120000),
							(17,$shop_id, 42, 26, 'sp43', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 5, 120000),
							(18,$shop_id, 43, 32, 'sp565', '/khieuvu/estoreadmin/webroot/upload/image/files/bg_menu_20.jpg', 2, 20000),
							(19,$shop_id, 44, 64, 'sp5', '/estoreadmin/webroot/upload/image/files/vietsys_53.jpg', 1, 40000),
							(20,$shop_id, 44, 48, 'sp4', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
							(21,$shop_id, 44, 61, 'sp2', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
							(22,$shop_id, 44, 49, 'sp5', '/estoreadmin/webroot/upload/image/files/vietsys_53.jpg', 1, 40000),
							(23,$shop_id, 45, 63, 'sp4', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
							(24,$shop_id, 46, 49, 'sp5', '/estoreadmin/webroot/upload/image/files/vietsys_53.jpg', 1, 40000),
							(25,$shop_id, 46, 50, 'sp6', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
							(26,$shop_id, 47, 64, 'sp5', '/estoreadmin/webroot/upload/image/files/vietsys_53.jpg', 1, 40000),
							(27,$shop_id, 47, 78, 'sp4', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
							(28,$shop_id, 48, 73, 'sp4', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
							(29,$shop_id, 51, 243, 'Tủ chữ L nhiều ngăn', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', 1, 4500000),
							(30,$shop_id, 51, 245, 'Bếp cho quán ăn vừa và nhỏ', 'img/upload/3007b340574bcfd67cc42fd18c74d9b0.jpg', 1, 160000),
							(31,$shop_id, 52, 243, 'Tủ chữ L nhiều ngăn', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', 1, 4500000),
							(32,$shop_id, 52, 232, 'Bếp trung bình chữ I', 'img/upload/06e0bd26dd69280f9c14e247b49a3ec6.jpg', 2, 2300000),
							(33,$shop_id, 53, 218, 'Bến nhà hàng', 'img/upload/3007b340574bcfd67cc42fd18c74d9b0.jpg', 3, 3500000),
							(34,$shop_id, 53, 243, 'Tủ chữ L nhiều ngăn', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', 1, 4500000),
							(35,$shop_id, 54, 243, 'Tủ chữ L nhiều ngăn', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', 1, 4500000),
							(36,$shop_id, 54, 231, 'Bếp trung bình chữ I', 'img/upload/06e0bd26dd69280f9c14e247b49a3ec6.jpg', 3, 2300000);";
								
							$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_infomations` (
							  `id` int(50) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `idnew` int(10) NOT NULL,
							  `user_id` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT 'null',
							  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
							  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
							  `address` varchar(300) CHARACTER SET utf8 NOT NULL,
							  `mobile` int(15) DEFAULT NULL,
							  `comment` varchar(300) CHARACTER SET utf8 NOT NULL,
							  `deal` text CHARACTER SET utf8,
							  `company` varchar(255) CHARACTER SET utf8 NOT NULL,
							  `phone` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
							  `fax` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
							  `country` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
							  `datereturn` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
							  `fullname_male` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
							  `fullname_female` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
							  `questions_day` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
							  `wedding_day` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
							  `title_question` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
							  `wedding_title` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
							  `name_product` varchar(250) NOT NULL,
							  `images` varchar(250) NOT NULL,
							  `sl` varchar(250) NOT NULL,
							  `price` varchar(250) NOT NULL,
							  `total` varchar(250) NOT NULL,
							  `orther` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
							  `created` datetime NOT NULL,
							  `status` int(2) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;";
														
							$arrSql[]="INSERT INTO `estore_infomations` (`id`, `estore_id`, `idnew`, `user_id`, `name`, `email`, `address`, `mobile`, `comment`, `deal`, `company`, `phone`, `fax`, `country`, `datereturn`, `fullname_male`, `fullname_female`, `questions_day`, `wedding_day`, `title_question`, `wedding_title`, `name_product`, `images`, `sl`, `price`, `total`, `orther`, `created`, `status`) VALUES
									(52,$shop_id, 0, 'id173768', 'Hoang Cong Phuc', 'phuca4@gmail.com', 'Ha Noi', 2147483647, '', NULL, '', '84972607988', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '9100000', NULL, '2014-07-25 08:57:55', 0),
									(53,$shop_id, 0, 'id98603', 'Hoang Phuc', 'phuca4@gmail.com', 'Ha Noi', 2147483647, '', NULL, '', '84972607988', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '15000000', NULL, '2014-07-25 09:04:11', 0),
									(54,$shop_id, 0, 'id686188', 'Hoang Cong Phuc', 'phuca4@gmail.com', 'Ha Noi', 2147483647, '', NULL, '', '84972607988', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '11400000', NULL, '2014-07-25 09:10:40', 0);";
							
							$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_manufacturers` (
							  `id` int(50) unsigned NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) unsigned NOT NULL DEFAULT '0',
							  `parent_id` int(10) DEFAULT NULL,
							  `lft` int(10) DEFAULT NULL,
							  `rght` int(10) DEFAULT NULL,
							  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
							  `created` date NOT NULL,
							  `modified` datetime NOT NULL,
							  `status` int(2) NOT NULL,
							  `char` int(10) DEFAULT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=271 DEFAULT CHARSET=latin1;";
														
							$arrSql[]="INSERT INTO `estore_manufacturers` (`id`, `estore_id`, `parent_id`, `lft`, `rght`, `name`, `created`, `modified`, `status`, `char`) VALUES
									(135,$shop_id, NULL, 1, 28, 'Rigth', '2012-05-18', '2012-09-13 17:55:06', 1, NULL),
									(136,$shop_id, NULL, 29, 62, 'Toyota', '2012-05-18', '2012-06-04 06:57:18', 1, NULL),
									(137,$shop_id, NULL, 63, 80, 'Daewoo', '2012-05-18', '2012-06-21 06:25:09', 1, NULL),
									(138,$shop_id, NULL, 81, 92, 'Ford', '2012-05-18', '2012-06-19 13:11:22', 1, NULL),
									(139,$shop_id, NULL, 93, 116, 'BMW', '2012-05-18', '2012-05-18 13:50:13', 1, NULL),
									(140,$shop_id, NULL, 117, 130, 'Nissan', '2012-05-18', '2012-05-18 13:50:25', 1, NULL),
									(141,$shop_id, NULL, 131, 144, 'Suzuki', '2012-05-18', '2012-05-18 13:50:51', 1, NULL),
									(142,$shop_id, NULL, 145, 168, 'Audi', '2012-05-24', '2012-05-24 08:07:17', 1, NULL),
									(143,$shop_id, NULL, 169, 184, 'Mitsubishi', '2012-05-24', '2012-05-24 08:08:10', 1, NULL),
									(144,$shop_id, NULL, 185, 200, 'Kia', '2012-05-24', '2014-07-27 10:05:08', 1, NULL),
									(145,$shop_id, NULL, 201, 214, 'Ford', '2012-05-24', '2012-06-21 06:11:02', 0, NULL),
									(146,$shop_id, NULL, 215, 230, 'Hyundai', '2012-05-24', '2012-06-19 13:00:19', 1, NULL),
									(148,$shop_id, NULL, 231, 244, 'Mercedes ', '2012-05-28', '2012-05-28 07:49:40', 1, NULL);";
							
							$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_news` (
							  `id` int(50) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `user_id` int(11) NOT NULL,
							  `title` varchar(256) NOT NULL,
							  `title_en` varchar(256) NOT NULL,
							  `introduction` text NOT NULL,
							  `introduction_en` text NOT NULL,
							  `content` text,
							  `content_en` text NOT NULL,
							  `images` varchar(256) NOT NULL,
							  `images_en` varchar(256) NOT NULL,
							  `category_id` int(11) NOT NULL,
							  `source` varchar(200) NOT NULL,
							  `view` int(50) NOT NULL,
							  `created` datetime NOT NULL,
							  `modified` datetime NOT NULL,
							  `status` int(1) DEFAULT '0',
							  `hotnew` tinyint(4) DEFAULT NULL,
							  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=128 DEFAULT CHARSET=utf8;";
														
							$arrSql[] ="INSERT INTO `estore_news` (`id`, `estore_id`, `user_id`, `title`, `title_en`, `introduction`, `introduction_en`, `content`, `content_en`, `images`, `images_en`, `category_id`, `source`, `view`, `created`, `modified`, `status`, `hotnew`, `alias`) VALUES
										(115,$shop_id, 0, 'Cách thanh toán', 'Method of payment', '<p>\r\n	sfsdf</p>\r\n', '', '<p>\r\n	sdfsdf</p>\r\n', '', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', '', 156, '', 0, '2012-07-09 13:55:44', '2012-08-22 11:57:00', 1, NULL, ''),
										(95,$shop_id, 0, 'Đèn trung thu', 'Mid-autumn lamp', '<p>\r\n	<span style=\"font-size:14px;\">Những chiếc đ&egrave;n b&agrave;n trang tr&iacute; n&agrave;y l&agrave; sự kết hợp giữa chất liệu vả của chụp đ&egrave;n v&agrave; <a href=\"http://www.webhangdoc.com/hang-doc/gom-phong-thuy.html\" target=\"_blank\">gốm</a> sứ của phần th&acirc;n đ&egrave;n mang lại vẻ đẹp trang trọng, hiện đại v&agrave; tinh tế cho căn ph&ograve;ng của bạn. Bạn c&oacute; thể đặt đ&egrave;n trang tr&iacute; ở nhiều kh&ocirc;ng gian trong ng&ocirc;i nh&agrave;, từ ph&ograve;ng ngủ, ph&ograve;ng kh&aacute;ch đến ph&ograve;ng đọc s&aacute;ch, ph&ograve;ng giải tr&iacute; cho gia đ&igrave;nh. Đ&acirc;y l&agrave; một c&aacute;ch trang tr&iacute; nh&agrave; rất s&aacute;ng tạo thể hiện thẩm mỹ cao của gia chủ.<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	Đ&egrave;n trang tr&iacute; - <a href=\"http://www.shopdentrangtri.com/\" target=\"_blank\" title=\"\"><em><strong>den trang tri</strong></em></a> c&oacute; nhiều kiểu d&aacute;ng mẫu m&atilde; phần th&acirc;n đ&egrave;n cho bạn lựa chọn. C&aacute;c chất liệu <a href=\"http://www.webhangdoc.com/hang-doc/gom-phong-thuy.html\" target=\"_blank\">gốm</a> sứ l&agrave;m n&ecirc;n đ&egrave;n cũng kh&aacute; <a href=\"http://www.webhangdoc.com/\" target=\"_blank\">độc đ&aacute;o</a> v&agrave; lạ mắt. C&oacute; những chiếc đ&egrave;n c&oacute; phần th&acirc;n l&agrave; b&igrave;nh gốm x&ugrave; x&igrave; th&ocirc; mộc nhưng lại mang n&eacute;t c&aacute; t&iacute;nh v&agrave; phong c&aacute;ch. Cũng c&oacute; những chiếc đ&egrave;n c&oacute; phần th&acirc;n được l&agrave;m từ sứ cao cấp với m&agrave;u sắc tươi s&aacute;ng, trong trẻo. Độc đ&aacute;o hơn với những chiếc b&igrave;nh với v&acirc;n đ&aacute; rất đẹp v&agrave; sang trọng.</span></p>\r\n', '<p>\r\n	Những chiếc đ&egrave;n b&agrave;n trang tr&iacute; n&agrave;y l&agrave; sự kết hợp giữa chất liệu vả của chụp đ&egrave;n v&agrave; <a href=\"http://www.webhangdoc.com/hang-doc/gom-phong-thuy.html\" target=\"_blank\">gốm</a> sứ của phần th&acirc;n đ&egrave;n mang lại vẻ đẹp trang trọng, hiện đại v&agrave; tinh tế cho căn ph&ograve;ng của bạn. Bạn c&oacute; thể đặt đ&egrave;n trang tr&iacute; ở nhiều kh&ocirc;ng gian trong ng&ocirc;i nh&agrave;, từ ph&ograve;ng ngủ, ph&ograve;ng kh&aacute;ch đến ph&ograve;ng đọc s&aacute;ch, ph&ograve;ng giải tr&iacute; cho gia đ&igrave;nh. Đ&acirc;y l&agrave; một c&aacute;ch trang tr&iacute; nh&agrave; rất s&aacute;ng tạo thể hiện thẩm mỹ cao của gia chủ.</p>\r\n', '<p>\r\n	<span style=\"font-size:14px;\">Những chiếc đ&egrave;n b&agrave;n trang tr&iacute; n&agrave;y l&agrave; sự kết hợp giữa chất liệu vả của chụp đ&egrave;n v&agrave; <a href=\"http://www.webhangdoc.com/hang-doc/gom-phong-thuy.html\" target=\"_blank\">gốm</a> sứ của phần th&acirc;n đ&egrave;n mang lại vẻ đẹp trang trọng, hiện đại v&agrave; tinh tế cho căn ph&ograve;ng của bạn. Bạn c&oacute; thể đặt đ&egrave;n trang tr&iacute; ở nhiều kh&ocirc;ng gian trong ng&ocirc;i nh&agrave;, từ ph&ograve;ng ngủ, ph&ograve;ng kh&aacute;ch đến ph&ograve;ng đọc s&aacute;ch, ph&ograve;ng giải tr&iacute; cho gia đ&igrave;nh. Đ&acirc;y l&agrave; một c&aacute;ch trang tr&iacute; nh&agrave; rất s&aacute;ng tạo thể hiện thẩm mỹ cao của gia chủ.<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	Đ&egrave;n trang tr&iacute; - <a href=\"http://www.shopdentrangtri.com/\" target=\"_blank\" title=\"\"><em><strong>den trang tri</strong></em></a> c&oacute; nhiều kiểu d&aacute;ng mẫu m&atilde; phần th&acirc;n đ&egrave;n cho bạn lựa chọn. C&aacute;c chất liệu <a href=\"http://www.webhangdoc.com/hang-doc/gom-phong-thuy.html\" target=\"_blank\">gốm</a> sứ l&agrave;m n&ecirc;n đ&egrave;n cũng kh&aacute; <a href=\"http://www.webhangdoc.com/\" target=\"_blank\">độc đ&aacute;o</a> v&agrave; lạ mắt. C&oacute; những chiếc đ&egrave;n c&oacute; phần th&acirc;n l&agrave; b&igrave;nh gốm x&ugrave; x&igrave; th&ocirc; mộc nhưng lại mang n&eacute;t c&aacute; t&iacute;nh v&agrave; phong c&aacute;ch. Cũng c&oacute; những chiếc đ&egrave;n c&oacute; phần th&acirc;n được l&agrave;m từ sứ cao cấp với m&agrave;u sắc tươi s&aacute;ng, trong trẻo. Độc đ&aacute;o hơn với những chiếc b&igrave;nh với v&acirc;n đ&aacute; rất đẹp v&agrave; sang trọng.</span></p>\r\n', '<p>\r\n	Những chiếc đ&egrave;n b&agrave;n trang tr&iacute; n&agrave;y l&agrave; sự kết hợp giữa chất liệu vả của chụp đ&egrave;n v&agrave; <a href=\"http://www.webhangdoc.com/hang-doc/gom-phong-thuy.html\" target=\"_blank\">gốm</a> sứ của phần th&acirc;n đ&egrave;n mang lại vẻ đẹp trang trọng, hiện đại v&agrave; tinh tế cho căn ph&ograve;ng của bạn. Bạn c&oacute; thể đặt đ&egrave;n trang tr&iacute; ở nhiều kh&ocirc;ng gian trong ng&ocirc;i nh&agrave;, từ ph&ograve;ng ngủ, ph&ograve;ng kh&aacute;ch đến ph&ograve;ng đọc s&aacute;ch, ph&ograve;ng giải tr&iacute; cho gia đ&igrave;nh. Đ&acirc;y l&agrave; một c&aacute;ch trang tr&iacute; nh&agrave; rất s&aacute;ng tạo thể hiện thẩm mỹ cao của gia chủ.<br />\r\n	<br />\r\n	<br />\r\n	<br />\r\n	Đ&egrave;n trang tr&iacute; - <a href=\"http://www.shopdentrangtri.com/\" target=\"_blank\" title=\"\"><em><strong>den trang tri</strong></em></a> c&oacute; nhiều kiểu d&aacute;ng mẫu m&atilde; phần th&acirc;n đ&egrave;n cho bạn lựa chọn. C&aacute;c chất liệu <a href=\"http://www.webhangdoc.com/hang-doc/gom-phong-thuy.html\" target=\"_blank\">gốm</a> sứ l&agrave;m n&ecirc;n đ&egrave;n cũng kh&aacute; <a href=\"http://www.webhangdoc.com/\" target=\"_blank\">độc đ&aacute;o</a> v&agrave; lạ mắt. C&oacute; những chiếc đ&egrave;n c&oacute; phần th&acirc;n l&agrave; b&igrave;nh gốm x&ugrave; x&igrave; th&ocirc; mộc nhưng lại mang n&eacute;t c&aacute; t&iacute;nh v&agrave; phong c&aacute;ch. Cũng c&oacute; những chiếc đ&egrave;n c&oacute; phần th&acirc;n được l&agrave;m từ sứ cao cấp với m&agrave;u sắc tươi s&aacute;ng, trong trẻo. Độc đ&aacute;o hơn với những chiếc b&igrave;nh với v&acirc;n đ&aacute; rất đẹp v&agrave; sang trọng.</p>\r\n', '/estoreadmin/webroot/upload/image/files/vietsys_71.jpg', 'img/upload/076e3caed758a1c18c91a0e9cae3368f.jpg', 156, '', 1, '2011-12-06 09:16:42', '2012-07-23 15:21:30', 1, NULL, NULL),
										(96,$shop_id, 0, 'Lộng lẫy đèn chùm', 'Splendid chandelier', '<p>\r\n	<b><span id=\"ctl00_ContentPlaceHolder1_NewsDetail1_lblSubContent\">Với kiểu d&aacute;ng thiết kế mới lạ, đ&egrave;n ch&ugrave;m ng&agrave;y nay mang lại vẻ mềm mại, sang trọng cho ng&ocirc;i nh&agrave;. Hầu hết c&aacute;c mẫu đ&egrave;n được thiết kế cầu kỳ với nhiều lớp đ&egrave;n, đ&aacute; trang tr&iacute;. Loại n&agrave;y gồm một b&oacute;ng ch&iacute;nh ở giữa s&aacute;ng nhất, c&aacute;c đ&egrave;n phụ được thiết kế xung quanh.</span></b></p>\r\n', '<p>\r\n	Enable luck with crystal chandeliersEnable luck with crystal chandeliers</p>\r\n', '<p>\r\n	<b><span id=\"ctl00_ContentPlaceHolder1_NewsDetail1_lblSubContent\">Với kiểu d&aacute;ng thiết kế mới lạ, đ&egrave;n ch&ugrave;m ng&agrave;y nay mang lại vẻ mềm mại, sang trọng cho ng&ocirc;i nh&agrave;. Hầu hết c&aacute;c mẫu đ&egrave;n được thiết kế cầu kỳ với nhiều lớp đ&egrave;n, đ&aacute; trang tr&iacute;. Loại n&agrave;y gồm một b&oacute;ng ch&iacute;nh ở giữa s&aacute;ng nhất, c&aacute;c đ&egrave;n phụ được thiết kế xung quanh.</span> </b></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<img alt=\"\" height=\"431\" src=\"http://www.denchum.net/Images/News/Sub/images/Picture1.jpg\" width=\"500\" /></p>\r\n<div>\r\n	Đ&egrave;n ch&ugrave;m rực rỡ với t&iacute;nh thẩm mỹ cao gi&uacute;p bạn t&ocirc; điểm cho ng&ocirc;i nh&agrave;</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	Tuy nhi&ecirc;n, thỉnh thoảng bạn vẫn bắt gặp kiểu đ&egrave;n ch&ugrave;m khổng lồ chỉ c&oacute; một b&oacute;ng. C&ograve;n lại l&agrave; phụ liệu đ&iacute;nh k&egrave;m, chủ yếu mang t&iacute;nh trang tr&iacute;. C&aacute;c kiểu đ&egrave;n n&agrave;y gi&uacute;p căn ph&ograve;ng trở n&ecirc;n duy&ecirc;n d&aacute;ng v&agrave; sang trọng hơn.</div>\r\n<div>\r\n	Đặc biệt chất liệu tạo n&ecirc;n c&aacute;c ch&ugrave;m đ&egrave;n rất quan trọng v&igrave; n&oacute; quyết định sự mềm mại v&agrave; n&eacute;t ri&ecirc;ng của từng kiểu đ&egrave;n. &Aacute;nh s&aacute;ng chỉ l&agrave; yếu tố phụ n&ecirc;n bạn phải thiết k&ecirc; th&ecirc;m c&aacute;c đ&egrave;n kh&aacute;c để lấy &aacute;nh s&aacute;ng cho ph&ograve;ng kh&aacute;ch.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<strong>Những lưu &yacute; khi lắp đặt đ&egrave;n ch&ugrave;m</strong></div>\r\n<div>\r\n	<img alt=\"\" height=\"267\" src=\"http://www.denchum.net/Images/News/Sub/images/Picture2.jpg\" width=\"500\" /></div>\r\n<div>\r\n	Đa dạng về kiểu d&aacute;ng, mẫu m&atilde;</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	Muốn bố tr&iacute; đ&egrave;n ch&ugrave;m, trần nh&agrave; phải cao từ 3m trở l&ecirc;n để kh&ocirc;ng g&acirc;y cảm gi&aacute;c vướng v&iacute;u, nặng nề. Kiểu đ&egrave;n cũng cần h&agrave;i ho&agrave; với c&aacute;c đ&egrave;n chiếu s&aacute;ng kh&aacute;c trong ph&ograve;ng.</div>\r\n<div>\r\n	Theo quan niệm phong thuỷ, kh&ocirc;ng n&ecirc;n lắp đ&egrave;n ch&ugrave;m trong ph&ograve;ng ngủ, nhất l&agrave; ph&iacute;a tr&ecirc;n giường. Nếu đ&egrave;n bằng chất liệu pha l&ecirc;, đ&aacute; thuỷ tinh, tốt nhất n&ecirc;n treo ở trung t&acirc;m nh&agrave; để t&iacute;ch tụ năng lượng dương cho căn ph&ograve;ng.</div>\r\n<div>\r\n	Theo Netfile</div>\r\n', '<p>\r\n	Enable luck with crystal chandeliersEnable luck with crystal chandeliersEnable luck with crystal chandeliersEnable luck with crystal chandeliersEnable luck with crystal chandeliers</p>\r\n', '/estoreadmin/webroot/upload/image/files/vietsys_68.jpg', 'img/upload/8969288f4245120e7c3870287cce0ff3.jpg', 156, '', 0, '2011-12-06 09:42:09', '2012-07-23 15:25:27', 1, NULL, NULL),
										(116,$shop_id, 0, 'About', 'About', '<p>\r\n	<span id=\"result_box\" lang=\"en\"><span title=\"Công ty TNHH thiết bị y tế và khoa học kỹ thuật Hà Nội được thành lập năm 2002 với lĩnh vực kinh doanh chính là: thiết bị y tế, thiết bị thẩm mỹ, thiết bị khoa học kỹ thuật, công nghệ và môi trường.\">Medical Equipment Co., Ltd. technical and scientific Hanoi was established in 2002 with main business areas are: medical device, aesthetic equipment, scientific equipment, technology and the environment.</span><br />\r\n	<br />\r\n	<span title=\"Tôn chỉ của chúng tôi:\">Our guiding principles:</span><br />\r\n	<br />\r\n	<span title=\"- Cung cấp tới tận tay khách hàng các sản phẩm có chất lượng và kỹ thuật cao trong ngành y tế và khoa học công nghệ môi trường với giá cả cạnh tranh nhất.\">- Provide end-customers with quality products and high technology in the health sector and environmental science and technology with the most competitive price.</span><br />\r\n	<br />\r\n	<span title=\"- Xây dựng và đào tạo một mạng lưới dịch vụ kỹ thuật sau bán hàng một cách hoàn hảo.\">- Develop and train a network of after-sales technical service perfectly.</span><br />\r\n	<br />\r\n	<span title=\"- Luôn giữ chữ “tín” và lấy lợi ích của khách hàng làm trọng.\">- Always keep the words &quot;credit&quot; and get the benefits of important customer.</span><br />\r\n	<br />\r\n	<span title=\"Sản phẩm Công ty cung cấp:\">The company offers products:</span><br />\r\n	<br />\r\n	<span title=\"- Máy soi cổ tử cung kỹ thuật số, monitor sản khoa, monitor theo dõi bệnh nhân đa thông số, hệ thống monitor trung tâm, máy cắt đốt cổ tử cung chuyên dụng, máy đo nồng độ bão hòa ô xy trong máu, bơm\">- Portable digital colposcopy, obstetrics monitor, monitor multi-parameter patient monitor, central monitor system, dedicated cervical ablation, measuring oxygen saturation in the blood, the pump </span><span title=\"tiêm điện, máy truyền dịch tự động của hãng GOLDWAY (US).,INC.\">power injection, its automatic infusion Goldway (U.S.)., INC.</span><br />\r\n	<br />\r\n	<span title=\"- Máy siêu âm đen trắng, siêu màu 4D các loại của hãng Fukuda- Nhật Bản\">- Ultrasound in black and white, super color 4D Its kind Fukuda, Japan</span><br />\r\n	<br />\r\n	<span title=\"- Máy áp lạnh cổ tử cung\">- Air pressure cervical cold</span><br />\r\n	<br />\r\n	<span title=\"- Điện não VIDEO EEG, DIGITAL EEG, điện tim của Tây Ban Nha\">- Electrical brain EEG VIDEO, DIGITAL EEG, ECG of Spain</span><br />\r\n	<br />\r\n	<span title=\"- Máy đo thính lực chuyên dụng của Tây Ban Nha\">- Dedicated audiometric of Spain</span><br />\r\n	<br />\r\n	<span title=\"- Máy đo bilirubin, hemoglobin sản xuất tại Nhật Bản\">- Bilirubin meter, hemoglobin production in Japan</span><br />\r\n	<br />\r\n	<span title=\"- Máy gây mê, máy thở, máy nghe tim thai, nội soi, điện tim, máy phát hiện vàng da.\">- Anesthesia machine, ventilator, fetal player, endoscopy, ECG, jaundice detector.</span><br />\r\n	<br />\r\n	<span title=\"- Máy xét nghiệm sinh hóa (bán tự động, tự động, tổng hợp), ELISA, dao mổ điện sản xuất tại Mỹ\">- Machine biochemical tests (semi-automatic, automatic, synthesis), ELISA, scalpels electricity produced in the U.S.</span><br />\r\n	<br />\r\n	<span title=\"- Máy xét nghiệm nước tiểu Cybow, Clinitek Status (Hàn Quốc, Anh)\">- Machine test urine Cybow, Clinitek Status (Korean, English)</span><br />\r\n	<br />\r\n	<span title=\"- Máy quang phổ UV/VIS - Nhật, tủ bảo quản dược phẩm, tủ trữ máu của Đức.\">- UV Spectrometer / VIS - Japan, pharmaceutical storage cabinets, storage cabinets German blood.</span><br />\r\n	<br />\r\n	<span title=\"- Đèn mổ (Thụy Sĩ), tủ sấy, nồi hấp (Đài Loan)...\">- Lamp (Switzerland), oven, autoclave (Taiwan) ...</span><br />\r\n	<br />\r\n	<span title=\"- Các loại thiết bị khoa học kỹ thuật chuyên dụng của Anh, Mỹ, Đức.\">- The specialized scientific and technical equipment in the UK, USA, Germany.</span><br />\r\n	<br />\r\n	<span title=\"- Các linh kiện thay thế cho các loại monitor theo dõi bệnh nhân, monitor sản khoa\">- The replacement parts for the type of monitor patient monitor, monitor obstetric</span><br />\r\n	<br />\r\n	<span title=\"Công ty có đội ngũ kỹ sư được đào tạo đúng chuyên ngành thiết bị y tế ở trong và ngoài nước.\">The company has a team of engineers who have been properly trained in medical equipment at home and abroad. </span><span title=\"Đội ngũ này không ngừng được nâng cao tay nghề thông qua các khoá đào tạo của các nhà sản xuất...\">This team constantly upgrade their skills through training of producers ...</span><br />\r\n	<br />\r\n	<span title=\"Với thế mạnh của mình, chúng tôi hy vọng rằng trong một tương lai gần, Công ty Công nghệ Quang Anh sẽ trở thành một đối tác truyền thống của Quý khách hàng với tư cách là một nhà cung cấp thiết bị y tế có giá cả\">With its strength, we hope that in the near future, the British Optical Technology Company will become a traditional partner of customers as a supplier of medical equipment pricing </span><span title=\"hợp lý nhất, chất lượng tốt nhất và dịch vụ sau bán hàng hoàn hảo.\">most affordable, best quality and perfect after-sales service.</span><br />\r\n	<br />\r\n	<span title=\"Khi cần mua thiết bị y tế- Đến với Công ty thiết bị y tế &amp; khoa học hà nội\">The need for a new medical device-Coming to medical &amp; scientific equipment hanoi</span></span></p>\r\n', '<p>\r\n	<span id=\"result_box\" lang=\"en\"><span title=\"Công ty TNHH thiết bị y tế và khoa học kỹ thuật Hà Nội được thành lập năm 2002 với lĩnh vực kinh doanh chính là: thiết bị y tế, thiết bị thẩm mỹ, thiết bị khoa học kỹ thuật, công nghệ và môi trường.\">Co., Ltd. medical equipment and scientific and technical Hanoi was established in 2002 with the main business areas: medical equipment, beauty equipment, scientific equipment, technology and environment.</span><br />\r\n	<br />\r\n	<span title=\"Tôn chỉ của chúng tôi:\">Our guiding principles:<br />\r\n	<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Cung cấp tới tận tay khách hàng các sản phẩm có chất lượng và kỹ thuật cao trong ngành y tế và khoa học công nghệ môi trường với giá cả cạnh tranh nhất.\">Hand to provide customers with quality products and high technology in the health and environmental science and technology with the most competitive prices.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Xây dựng và đào tạo một mạng lưới dịch vụ kỹ thuật sau bán hàng một cách hoàn hảo.\">Develop and train a network of technical service after the sale perfectly.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Luôn giữ chữ “tín” và lấy lợi ích của khách hàng làm trọng.\">Always keep the word &quot;credit&quot; and get the benefit of customer-focused.</span><br />\r\n	<br />\r\n	<span title=\"Sản phẩm Công ty cung cấp:\">Products The company offers:<br />\r\n	<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy soi cổ tử cung kỹ thuật số, monitor sản khoa, monitor theo dõi bệnh nhân đa thông số, hệ thống monitor trung tâm, máy cắt đốt cổ tử cung chuyên dụng, máy đo nồng độ bão hòa ô xy trong máu, bơm tiêm\">Colposcopy machine digital, monitor anesthesia, monitor patient monitor multiple parameters, the central monitor system, cervical ablation machine dedicated machine measurements of oxygen saturation levels in blood, syringes </span><span title=\"điện, máy truyền dịch tự động của hãng GOLDWAY (US).,INC.\">electric machine company infusion of automated GOLDWAY (U.S.)., INC.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy siêu âm đen trắng, siêu màu 4D các loại của hãng Fukuda- Nhật Bản\">Ultrasound machine black &amp; white, color 4D super types of firms Fukuda, Japan<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy áp lạnh cổ tử cung\">Machine cold pressure of the cervix<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Điện não VIDEO EEG, DIGITAL EEG, điện tim của Tây Ban Nha\">EEG EEG VIDEO, DIGITAL EEG, ECG of Spain<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy đo thính lực chuyên dụng của Tây Ban Nha\">Machinery specialized hearing test in Spain<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy đo bilirubin, hemoglobin sản xuất tại Nhật Bản\">Gauge bilirubin, hemoglobin production in Japan<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy gây mê, máy thở, máy nghe tim thai, nội soi, điện tim, máy phát hiện vàng da.\">Anesthesia machines, ventilators, air auscultation, endoscopy, ECG, jaundice detector.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy xét nghiệm sinh hóa (bán tự động, tự động, tổng hợp), ELISA, dao mổ điện sản xuất tại Mỹ\">Biochemical machine (semi-automatic, automatic, general), ELISA, electric knife made in USA<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy xét nghiệm nước tiểu Cybow, Clinitek Status (Hàn Quốc, Anh)\">Machine Cybow urine, Clinitek Status (Korean, English)<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy quang phổ UV/VIS - Nhật, tủ bảo quản dược phẩm, tủ trữ máu của Đức.\">Spectrophotometer UV / VIS - Japanese pharmaceutical storage cabinets, storage cabinets of German blood.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Đèn mổ (Thụy Sĩ), tủ sấy, nồi hấp (Đài Loan)...\">Lights (Switzerland), oven, steamer (Taiwan) ...<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Các loại thiết bị khoa học kỹ thuật chuyên dụng của Anh, Mỹ, Đức.\">The type of equipment dedicated science and technology in the UK, U.S., Germany.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Các linh kiện thay thế cho các loại monitor theo dõi bệnh nhân, monitor sản khoa\">Replacement parts for the type of monitor to track patients, monitor obstetric</span><br />\r\n	<br />\r\n	<span title=\"Công ty có đội ngũ kỹ sư được đào tạo đúng chuyên ngành thiết bị y tế ở trong và ngoài nước.\">The company has a team of engineers are properly trained specialized medical equipment at home and abroad. </span><span title=\"Đội ngũ này không ngừng được nâng cao tay nghề thông qua các khoá đào tạo của các nhà sản xuất...\">This team is constantly improving skills through training of manufacturers ...</span><br />\r\n	<br />\r\n	<span title=\"Với thế mạnh của mình, chúng tôi hy vọng rằng trong một tương lai gần, Công ty Công nghệ Quang Anh sẽ trở thành một đối tác truyền thống của Quý khách hàng với tư cách là một nhà cung cấp thiết bị y tế có giá cả\">With its strength, we hope that in the near future, Quang Anh Technology Company will become a traditional partner of customers as a supplier of medical equipment priced </span><span title=\"hợp lý nhất, chất lượng tốt nhất và dịch vụ sau bán hàng hoàn hảo.\">most logical, best quality and after sales service perfect.</span><br />\r\n	<br />\r\n	<span title=\"Khi cần mua thiết bị y tế- Đến với Công ty thiết bị y tế Quang Anh\">When you need to buy medical equipment-to the medical device company Quang Anh</span></span></p>\r\n', '<p>\r\n	<span id=\"result_box\" lang=\"en\"><span title=\"Công ty TNHH thiết bị y tế và khoa học kỹ thuật Hà Nội được thành lập năm 2002 với lĩnh vực kinh doanh chính là: thiết bị y tế, thiết bị thẩm mỹ, thiết bị khoa học kỹ thuật, công nghệ và môi trường.\">Medical Equipment Co., Ltd. technical and scientific Hanoi was established in 2002 with main business areas are: medical device, aesthetic equipment, scientific equipment, technology and the environment.</span><br />\r\n	<br />\r\n	<span title=\"Tôn chỉ của chúng tôi:\">Our guiding principles:</span><br />\r\n	<br />\r\n	<span title=\"- Cung cấp tới tận tay khách hàng các sản phẩm có chất lượng và kỹ thuật cao trong ngành y tế và khoa học công nghệ môi trường với giá cả cạnh tranh nhất.\">- Provide end-customers with quality products and high technology in the health sector and environmental science and technology with the most competitive price.</span><br />\r\n	<br />\r\n	<span title=\"- Xây dựng và đào tạo một mạng lưới dịch vụ kỹ thuật sau bán hàng một cách hoàn hảo.\">- Develop and train a network of after-sales technical service perfectly.</span><br />\r\n	<br />\r\n	<span title=\"- Luôn giữ chữ “tín” và lấy lợi ích của khách hàng làm trọng.\">- Always keep the words &quot;credit&quot; and get the benefits of important customer.</span><br />\r\n	<br />\r\n	<span title=\"Sản phẩm Công ty cung cấp:\">The company offers products:</span><br />\r\n	<br />\r\n	<span title=\"- Máy soi cổ tử cung kỹ thuật số, monitor sản khoa, monitor theo dõi bệnh nhân đa thông số, hệ thống monitor trung tâm, máy cắt đốt cổ tử cung chuyên dụng, máy đo nồng độ bão hòa ô xy trong máu, bơm\">- Portable digital colposcopy, obstetrics monitor, monitor multi-parameter patient monitor, central monitor system, dedicated cervical ablation, measuring oxygen saturation in the blood, the pump </span><span title=\"tiêm điện, máy truyền dịch tự động của hãng GOLDWAY (US).,INC.\">power injection, its automatic infusion Goldway (U.S.)., INC.</span><br />\r\n	<br />\r\n	<span title=\"- Máy siêu âm đen trắng, siêu màu 4D các loại của hãng Fukuda- Nhật Bản\">- Ultrasound in black and white, super color 4D Its kind Fukuda, Japan</span><br />\r\n	<br />\r\n	<span title=\"- Máy áp lạnh cổ tử cung\">- Air pressure cervical cold</span><br />\r\n	<br />\r\n	<span title=\"- Điện não VIDEO EEG, DIGITAL EEG, điện tim của Tây Ban Nha\">- Electrical brain EEG VIDEO, DIGITAL EEG, ECG of Spain</span><br />\r\n	<br />\r\n	<span title=\"- Máy đo thính lực chuyên dụng của Tây Ban Nha\">- Dedicated audiometric of Spain</span><br />\r\n	<br />\r\n	<span title=\"- Máy đo bilirubin, hemoglobin sản xuất tại Nhật Bản\">- Bilirubin meter, hemoglobin production in Japan</span><br />\r\n	<br />\r\n	<span title=\"- Máy gây mê, máy thở, máy nghe tim thai, nội soi, điện tim, máy phát hiện vàng da.\">- Anesthesia machine, ventilator, fetal player, endoscopy, ECG, jaundice detector.</span><br />\r\n	<br />\r\n	<span title=\"- Máy xét nghiệm sinh hóa (bán tự động, tự động, tổng hợp), ELISA, dao mổ điện sản xuất tại Mỹ\">- Machine biochemical tests (semi-automatic, automatic, synthesis), ELISA, scalpels electricity produced in the U.S.</span><br />\r\n	<br />\r\n	<span title=\"- Máy xét nghiệm nước tiểu Cybow, Clinitek Status (Hàn Quốc, Anh)\">- Machine test urine Cybow, Clinitek Status (Korean, English)</span><br />\r\n	<br />\r\n	<span title=\"- Máy quang phổ UV/VIS - Nhật, tủ bảo quản dược phẩm, tủ trữ máu của Đức.\">- UV Spectrometer / VIS - Japan, pharmaceutical storage cabinets, storage cabinets German blood.</span><br />\r\n	<br />\r\n	<span title=\"- Đèn mổ (Thụy Sĩ), tủ sấy, nồi hấp (Đài Loan)...\">- Lamp (Switzerland), oven, autoclave (Taiwan) ...</span><br />\r\n	<br />\r\n	<span title=\"- Các loại thiết bị khoa học kỹ thuật chuyên dụng của Anh, Mỹ, Đức.\">- The specialized scientific and technical equipment in the UK, USA, Germany.</span><br />\r\n	<br />\r\n	<span title=\"- Các linh kiện thay thế cho các loại monitor theo dõi bệnh nhân, monitor sản khoa\">- The replacement parts for the type of monitor patient monitor, monitor obstetric</span><br />\r\n	<br />\r\n	<span title=\"Công ty có đội ngũ kỹ sư được đào tạo đúng chuyên ngành thiết bị y tế ở trong và ngoài nước.\">The company has a team of engineers who have been properly trained in medical equipment at home and abroad. </span><span title=\"Đội ngũ này không ngừng được nâng cao tay nghề thông qua các khoá đào tạo của các nhà sản xuất...\">This team constantly upgrade their skills through training of producers ...</span><br />\r\n	<br />\r\n	<span title=\"Với thế mạnh của mình, chúng tôi hy vọng rằng trong một tương lai gần, Công ty Công nghệ Quang Anh sẽ trở thành một đối tác truyền thống của Quý khách hàng với tư cách là một nhà cung cấp thiết bị y tế có giá cả\">With its strength, we hope that in the near future, the British Optical Technology Company will become a traditional partner of customers as a supplier of medical equipment pricing </span><span title=\"hợp lý nhất, chất lượng tốt nhất và dịch vụ sau bán hàng hoàn hảo.\">most affordable, best quality and perfect after-sales service.</span><br />\r\n	<br />\r\n	<span title=\"Khi cần mua thiết bị y tế- Đến với Công ty thiết bị y tế &amp; khoa học hà nội\">The need for a new medical device-Coming to medical &amp; scientific equipment hanoi</span></span></p>\r\n', '<p>\r\n	<span id=\"result_box\" lang=\"en\"><span title=\"Công ty TNHH thiết bị y tế và khoa học kỹ thuật Hà Nội được thành lập năm 2002 với lĩnh vực kinh doanh chính là: thiết bị y tế, thiết bị thẩm mỹ, thiết bị khoa học kỹ thuật, công nghệ và môi trường.\">Co., Ltd. medical equipment and scientific and technical Hanoi was established in 2002 with the main business areas: medical equipment, beauty equipment, scientific equipment, technology and environment.</span><br />\r\n	<br />\r\n	<span title=\"Tôn chỉ của chúng tôi:\">Our guiding principles:<br />\r\n	<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Cung cấp tới tận tay khách hàng các sản phẩm có chất lượng và kỹ thuật cao trong ngành y tế và khoa học công nghệ môi trường với giá cả cạnh tranh nhất.\">Hand to provide customers with quality products and high technology in the health and environmental science and technology with the most competitive prices.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Xây dựng và đào tạo một mạng lưới dịch vụ kỹ thuật sau bán hàng một cách hoàn hảo.\">Develop and train a network of technical service after the sale perfectly.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Luôn giữ chữ “tín” và lấy lợi ích của khách hàng làm trọng.\">Always keep the word &quot;credit&quot; and get the benefit of customer-focused.</span><br />\r\n	<br />\r\n	<span title=\"Sản phẩm Công ty cung cấp:\">Products The company offers:<br />\r\n	<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy soi cổ tử cung kỹ thuật số, monitor sản khoa, monitor theo dõi bệnh nhân đa thông số, hệ thống monitor trung tâm, máy cắt đốt cổ tử cung chuyên dụng, máy đo nồng độ bão hòa ô xy trong máu, bơm tiêm\">Colposcopy machine digital, monitor anesthesia, monitor patient monitor multiple parameters, the central monitor system, cervical ablation machine dedicated machine measurements of oxygen saturation levels in blood, syringes </span><span title=\"điện, máy truyền dịch tự động của hãng GOLDWAY (US).,INC.\">electric machine company infusion of automated GOLDWAY (U.S.)., INC.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy siêu âm đen trắng, siêu màu 4D các loại của hãng Fukuda- Nhật Bản\">Ultrasound machine black &amp; white, color 4D super types of firms Fukuda, Japan<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy áp lạnh cổ tử cung\">Machine cold pressure of the cervix<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Điện não VIDEO EEG, DIGITAL EEG, điện tim của Tây Ban Nha\">EEG EEG VIDEO, DIGITAL EEG, ECG of Spain<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy đo thính lực chuyên dụng của Tây Ban Nha\">Machinery specialized hearing test in Spain<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy đo bilirubin, hemoglobin sản xuất tại Nhật Bản\">Gauge bilirubin, hemoglobin production in Japan<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy gây mê, máy thở, máy nghe tim thai, nội soi, điện tim, máy phát hiện vàng da.\">Anesthesia machines, ventilators, air auscultation, endoscopy, ECG, jaundice detector.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy xét nghiệm sinh hóa (bán tự động, tự động, tổng hợp), ELISA, dao mổ điện sản xuất tại Mỹ\">Biochemical machine (semi-automatic, automatic, general), ELISA, electric knife made in USA<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy xét nghiệm nước tiểu Cybow, Clinitek Status (Hàn Quốc, Anh)\">Machine Cybow urine, Clinitek Status (Korean, English)<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Máy quang phổ UV/VIS - Nhật, tủ bảo quản dược phẩm, tủ trữ máu của Đức.\">Spectrophotometer UV / VIS - Japanese pharmaceutical storage cabinets, storage cabinets of German blood.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Đèn mổ (Thụy Sĩ), tủ sấy, nồi hấp (Đài Loan)...\">Lights (Switzerland), oven, steamer (Taiwan) ...<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Các loại thiết bị khoa học kỹ thuật chuyên dụng của Anh, Mỹ, Đức.\">The type of equipment dedicated science and technology in the UK, U.S., Germany.<br />\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</span><span title=\"Các linh kiện thay thế cho các loại monitor theo dõi bệnh nhân, monitor sản khoa\">Replacement parts for the type of monitor to track patients, monitor obstetric</span><br />\r\n	<br />\r\n	<span title=\"Công ty có đội ngũ kỹ sư được đào tạo đúng chuyên ngành thiết bị y tế ở trong và ngoài nước.\">The company has a team of engineers are properly trained specialized medical equipment at home and abroad. </span><span title=\"Đội ngũ này không ngừng được nâng cao tay nghề thông qua các khoá đào tạo của các nhà sản xuất...\">This team is constantly improving skills through training of manufacturers ...</span><br />\r\n	<br />\r\n	<span title=\"Với thế mạnh của mình, chúng tôi hy vọng rằng trong một tương lai gần, Công ty Công nghệ Quang Anh sẽ trở thành một đối tác truyền thống của Quý khách hàng với tư cách là một nhà cung cấp thiết bị y tế có giá cả\">With its strength, we hope that in the near future, Quang Anh Technology Company will become a traditional partner of customers as a supplier of medical equipment priced </span><span title=\"hợp lý nhất, chất lượng tốt nhất và dịch vụ sau bán hàng hoàn hảo.\">most logical, best quality and after sales service perfect.</span><br />\r\n	<br />\r\n	<span title=\"Khi cần mua thiết bị y tế- Đến với Công ty thiết bị y tế Quang Anh\">When you need to buy medical equipment-to the medical device company Quang Anh</span></span></p>\r\n', 'img/upload/076e3caed758a1c18c91a0e9cae3368f.jpg', '', 146, '', 0, '2012-07-23 14:38:15', '2012-08-23 17:51:27', 1, NULL, 'about'),
										(117,$shop_id, 0, 'Hướng dẫn mua hàng qua điện thoại', 'Method of purchases via phones', '<p>\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Hướng dẫn mua h&agrave;ng qua điện thoại</span></p>\r\n', '', '<br />\r\n<p style=\"line-height: 150%\">\r\n	<span style=\"font-weight: bold; font-family: Arial; color: rgb(0, 102, 255); \"><a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#mh1\" id=\"mh1\" name=\"mh1\">I/ Đặt h&agrave;ng qua Điện thoại</a><span style=\"font-size: 10pt; \"><a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#top\" style=\"text-decoration: none\"><span style=\"color: rgb(0, 102, 255); \">(L&ecirc;n tr&ecirc;n </span></a></span></span><a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#top\" style=\"text-decoration: none\"><span style=\"text-decoration: none; font-weight: bold; font-size: 10pt; color: rgb(0, 102, 255); \">&uarr;</span><span style=\"text-decoration: none; font-weight: bold; font-family: Arial; font-size: 10pt; color: rgb(0, 102, 255); \">)</span></a><br />\r\n	&nbsp;</p>\r\n<p style=\"line-height: 150%\">\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Qu&yacute; kh&aacute;ch gọi điện thoại trực tiếp đến Ph&ograve;ng B&aacute;n h&agrave;ng Online theo số m&aacute;y <span style=\"font-weight: bold; \">04.32888999</span> hoặc <span style=\"font-weight: bold; \">04.85821888</span>.<br />\r\n	<br />\r\n	</span></p>\r\n<p style=\"line-height: 150%\">\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">H&agrave;ng ng&agrave;y từ 8h30 &ndash; 21h30 kể cả Thứ bảy, Chủ Nhật v&agrave; c&aacute;c ng&agrave;y Lễ, nh&acirc;n vi&ecirc;n b&aacute;n h&agrave;ng trực tuyến của TOPCARE lu&ocirc;n sẵn s&agrave;ng phục vụ.<br />\r\n	<br />\r\n	</span><br />\r\n	<span style=\"font-weight: bold; font-family: Arial; color: rgb(0, 102, 255); \"> <a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#mh2\" id=\"mh2\">II/ Đặt h&agrave;ng qua Chương tr&igrave;nh Chat Yahoo hoặc Skype</a><span style=\"font-size: 10pt; \"><a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#top\" style=\"text-decoration: none\"><span style=\"color: rgb(0, 102, 255); \">(L&ecirc;n tr&ecirc;n </span></a></span></span><a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#top\" style=\"text-decoration: none\"><span style=\"font-weight: bold; font-size: 10pt; color: rgb(0, 102, 255); \">&uarr;</span><span style=\"font-weight: bold; font-family: Arial; font-size: 10pt; color: rgb(0, 102, 255); \">)</span></a></p>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Khi Qu&yacute; kh&aacute;ch truy cập trang <a href=\"http://www.topcare.vn\">www.topcare.vn</a> c&oacute; thể chat v&agrave; đăng k&yacute; mua h&agrave;ng với c&aacute;c nick Yahoo, Skype hiển thị s&aacute;ng tr&ecirc;n Website ch&iacute;nh thức của ch&uacute;ng t&ocirc;i:<br />\r\n	<br />\r\n	</span></p>\r\n<p align=\"center\" style=\"line-height: 150%\">\r\n	<img border=\"1\" height=\"29\" src=\"http://topcare.vn/Images/anh/yahoo_skype.jpg\" width=\"145\" /></p>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Nhấn v&agrave;o biểu tượng mặt cười, cửa sổ chương tr&igrave;nh Yahoo! Messenger hoặc Skype sẽ tự động bật l&ecirc;n.</span></p>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Chat với nh&acirc;n vi&ecirc;n b&aacute;n h&agrave;ng trực tuyến của TOPCARE, Qu&yacute; kh&aacute;ch sẽ được tư vấn v&agrave; c&oacute; thể y&ecirc;u cầu đặt h&agrave;ng ngay. Nh&acirc;n vi&ecirc;n Topcare sẽ gọi điện thoại cho Qu&yacute; kh&aacute;ch để x&aacute;c nhận đơn h&agrave;ng v&agrave; x&aacute;c nhận địa chỉ giao h&agrave;ng (nếu cần).<br />\r\n	<br />\r\n	</span><br />\r\n	<span style=\"font-weight: bold; font-family: Arial; color: rgb(0, 102, 255); \"> <a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#mh3\" id=\"mh3\">III/ Đăng k&yacute; mua h&agrave;ng qua website www.topcare.vn</a><a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#top\" style=\"text-decoration: none\"><span style=\"font-size: 10pt; color: rgb(0, 102, 255); \">(L&ecirc;n tr&ecirc;n </span></a></span><a href=\"http://topcare.vn/content/cc7c5215-0e85-4f4d-97cc-d12782e5fd43/Huong_dan_mua_hang_online.aspx#top\" style=\"text-decoration: none\"><span style=\"font-weight: bold; font-size: 10pt; color: rgb(0, 102, 255); \">&uarr;</span><span style=\"font-weight: bold; font-family: Arial; font-size: 10pt; color: rgb(0, 102, 255); \">)</span></a></p>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Việc đăng k&yacute; mua h&agrave;ng qua website cũng cực kỳ đơn giản, Qu&yacute; kh&aacute;ch c&oacute; thể l&agrave;m theo c&aacute;c hướng dẫn dưới đ&acirc;y:</span></p>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-weight: bold; font-family: Arial; font-size: 10pt; \">Bước 1: Qu&yacute; kh&aacute;ch chọn sản phẩm v&agrave;o &quot;giỏ h&agrave;ng&quot; bằng nhiều c&aacute;ch</span></p>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">V&iacute; dụ như v&agrave;o danh mục h&agrave;ng tương ứng, chọn theo h&atilde;ng, chọn theo gi&aacute;, chọn theo chức năng, chọn theo t&iacute;nh năng, nhập m&atilde; h&agrave;ng v&agrave;o &ocirc; t&igrave;m kiếm&hellip;<br />\r\n	Sau khi đ&atilde; chọn được sản phẩm cần mua, Qu&yacute; kh&aacute;ch nhấn n&uacute;t <img align=\"top\" border=\"0\" height=\"20\" src=\"http://topcare.vn/Images/btn_cart_small.jpg\" width=\"88\" /> tại khung hiển thị của sản phẩm đ&oacute;.</span></p>\r\n<p align=\"left\" style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Ngay lập tức tr&ecirc;n website sẽ xuất hiện <span style=\"font-weight: bold; \">Khung giỏ h&agrave;ng</span> với những sản phẩm Qu&yacute; kh&aacute;ch vừa chọn:<br />\r\n	<br />\r\n	</span></p>\r\n<p align=\"center\" style=\"line-height: 150%\">\r\n	<span style=\"font-family: Arial; font-size: 10pt; \"><img border=\"1\" height=\"256\" src=\"http://topcare.vn/Images/anh/cart_1_small.jpg\" width=\"575\" /></span></p>\r\n<p align=\"left\" style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Tại <span style=\"font-weight: bold; \">Khung giỏ h&agrave;ng</span> n&agrave;y đ&atilde; c&oacute; hướng dẫn chi tiết để Qu&yacute; kh&aacute;ch chọn số lượng sản phẩm m&igrave;nh cần mua, hoặc bỏ kh&ocirc;ng chọn sản phẩm n&agrave;y nữa m&agrave; thay bằng chọn sản phẩm kh&aacute;c.</span></p>\r\n<ul>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Nếu Qu&yacute; kh&aacute;ch muốn bỏ mua mặt h&agrave;ng n&agrave;o đ&oacute;, chỉ cần bấm v&agrave;o n&uacute;t <img align=\"top\" border=\"0\" height=\"20\" src=\"http://topcare.vn/Images/anh/DeleteRed.jpg\" width=\"20\" />&nbsp;<span style=\"color: rgb(0, 0, 255); \">Loại bỏ</span> c&ugrave;ng h&agrave;ng với sản phẩm đ&oacute;<br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Nếu Qu&yacute; kh&aacute;ch muốn chọn mua th&ecirc;m những sản phẩm kh&aacute;c, bấm v&agrave;o n&uacute;t <img align=\"middle\" border=\"0\" height=\"32\" src=\"http://topcare.vn/Images/anh/btn_more.jpg\" width=\"233\" />, <span style=\"font-weight: bold; \">Khung giỏ h&agrave;ng</span> sẽ tạm thời ẩn đi để Qu&yacute; kh&aacute;ch chọn sản phẩm kh&aacute;c v&agrave;o Giỏ h&agrave;ng.<br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Sau khi đ&atilde; chọn xong sản phẩm cần mua, Qu&yacute; kh&aacute;ch kiểm tra lại th&ocirc;ng tin sản phẩm trong giỏ h&agrave;ng 1 lần nữa như: T&ecirc;n sản phẩm, số lượng, đơn gi&aacute;, tổng số tiền phải thanh to&aacute;n... Qu&yacute; kh&aacute;ch nhấn n&uacute;t <img align=\"middle\" border=\"0\" height=\"32\" src=\"http://topcare.vn/Images/anh/continue_button.jpg\" width=\"95\" /> để chuyển sang bước 2</span></li>\r\n</ul>\r\n', '', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', '', 156, '', 0, '2012-07-23 14:45:38', '2012-08-22 11:56:58', 1, NULL, ''),
										(118,$shop_id, 0, 'Cách thanh toán qua cổng trực tuyến', 'Method of online payment', '<p>\r\n	sfsdf</p>\r\n', '', '<p>\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Ở bước n&agrave;y Qu&yacute; kh&aacute;ch sẽ nhập c&aacute;c th&ocirc;ng tin cần thiết như <span style=\"font-weight: bold; \">Họ t&ecirc;n, Số điện thoại, Địa chỉ nhận h&agrave;ng, Email</span> (để Topcare gửi th&ocirc;ng tin đơn h&agrave;ng cho Qu&yacute; kh&aacute;ch), hoặc c&oacute; thể bổ sung th&ecirc;m v&agrave;i th&ocirc;ng tin kh&aacute;c m&agrave; Qu&yacute; kh&aacute;ch cảm thấy cần thiết trong &ocirc; <span style=\"font-weight: bold; \">&quot;Ch&uacute; th&iacute;ch th&ecirc;m&quot;</span> (hướng dẫn Topcare giao h&agrave;ng, y&ecirc;u cầu viết ho&aacute; đơn VAT cho c&ocirc;ng ty...)</span></p>\r\n<p align=\"left\" style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Sau khi điền đủ c&aacute;c th&ocirc;ng tin, Qu&yacute; kh&aacute;ch cần điền th&ecirc;m<span style=\"font-weight: bold; \"> &ldquo;Nhập m&atilde; bảo vệ&rdquo;</span> (để tr&aacute;nh t&igrave;nh trạng SPAM, gửi h&agrave;ng loạt đơn h&agrave;ng), m&atilde; Qu&yacute; kh&aacute;ch phải nhập kh&ocirc;ng ph&acirc;n biệt chữ hoa, chữ thường. Nếu Qu&yacute; kh&aacute;ch kh&ocirc;ng nh&igrave;n r&otilde; m&atilde; bảo vệ đ&oacute;, Qu&yacute; kh&aacute;ch c&oacute; thể bấm <img align=\"top\" border=\"0\" height=\"20\" src=\"http://topcare.vn/Images/anh/iconcopy.jpg\" width=\"20\" />&nbsp;<span style=\"font-weight: bold; color: rgb(0, 102, 255); \">Chọn m&atilde; kh&aacute;c</span>. Rồi bấm <img align=\"middle\" border=\"0\" height=\"32\" src=\"http://topcare.vn/Images/anh/cart_finish.jpg\" width=\"92\" /> v&agrave; chờ v&agrave;i gi&acirc;y để đơn h&agrave;ng được gửi tới hệ thống của Topcare.</span></p>\r\n<p align=\"left\" style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Hệ thống sẽ kiểm tra những th&ocirc;ng tin của Qu&yacute; kh&aacute;ch đ&atilde; cung cấp 1 lần nữa, nếu th&ocirc;ng tin đơn h&agrave;ng hợp lệ, khung đặt h&agrave;ng sẽ hiện l&ecirc;n th&ocirc;ng b&aacute;o ho&agrave;n tất quy tr&igrave;nh mua h&agrave;ng như h&igrave;nh dưới đ&acirc;y:<br />\r\n	<br />\r\n	</span></p>\r\n<p align=\"center\" style=\"line-height: 150%\">\r\n	<img border=\"1\" height=\"256\" src=\"http://topcare.vn/Images/anh/cartfinish.jpg\" width=\"575\" /></p>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Sau đ&oacute; nh&acirc;n vi&ecirc;n của Topcare sẽ xử l&yacute; đơn đặt h&agrave;ng v&agrave; li&ecirc;n lạc lại với Qu&yacute; kh&aacute;ch để x&aacute;c nhận v&agrave; thống nhất việc mua h&agrave;ng.<br />\r\n	<br />\r\n	</span></p>\r\n<p style=\"line-height: 150%\">\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Qu&yacute; kh&aacute;ch cũng c&oacute; thể li&ecirc;n lạc với Ph&ograve;ng B&aacute;n h&agrave;ng Online để nhận hỗ trợ:</span></p>\r\n<ul>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Hỗ trợ th&ocirc;ng tin qua Email: <a href=\"mailto:banhang.online@topcare.vn\">banhang.online@topcare.vn</a><br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Điện thoại : <span style=\"font-weight: bold; \">(04).32888999</span> hoặc <span style=\"font-weight: bold; \">(04).85821888</span></span></li>\r\n</ul>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"text-decoration: underline; \"><span style=\"font-weight: bold; font-family: Arial; color: rgb(0, 102, 255); \">Một số lưu &yacute;:</span></span></p>\r\n<ul>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Topcare chỉ chấp nhận những Đơn đặt h&agrave;ng khi cung cấp đủ th&ocirc;ng tin ch&iacute;nh x&aacute;c về địa chỉ, số điện thoại &hellip; Sau khi Qu&yacute; kh&aacute;ch đặt h&agrave;ng, TOPCARE sẽ gọi điện cho Qu&yacute; kh&aacute;ch để x&aacute;c nhận th&ocirc;ng tin v&agrave; trao đổi việc thực hiện đơn h&agrave;ng.<br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; line-height: 24px; font-size: small; \">Hiện tại Topcare chỉ phục vụ b&aacute;n h&agrave;ng Online đối với kh&aacute;ch h&agrave;ng H&agrave; Nội v&agrave; c&aacute;c tỉnh th&agrave;nh kh&aacute;c thuộc nước Việt Nam.<br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; line-height: 24px; font-size: small; \">Địa chỉ giao h&agrave;ng phải c&oacute; th&ocirc;ng tin người nhận h&agrave;ng, địa chỉ, số điện thoại ch&iacute;nh x&aacute;c, r&otilde; r&agrave;ng. Ch&uacute;ng t&ocirc;i kh&ocirc;ng chịu tr&aacute;ch nhiệm khi qu&yacute; kh&aacute;ch ghi sai th&ocirc;ng tin người nhận.<br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Topcare kh&ocirc;ng b&aacute;n sản phẩm cho người dưới 13 tuổi. Nếu qu&yacute; kh&aacute;ch dưới 13 tuổi, Qu&yacute; kh&aacute;ch được y&ecirc;u cầu phải c&oacute; sự đồng &yacute; của cha mẹ hoặc người gi&aacute;m hộ để thực hiện mua h&agrave;ng từ website <a href=\"http://www.topcare.vn\">www.topcare.vn</a></span></li>\r\n</ul>\r\n', '', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', '', 156, '', 0, '2012-07-23 14:46:20', '2012-08-22 11:56:53', 1, NULL, ''),
										(119,$shop_id, 0, 'Hướng dẫn đặt hàng', 'Method of order', '', '', '<p>\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Ở bước n&agrave;y Qu&yacute; kh&aacute;ch sẽ nhập c&aacute;c th&ocirc;ng tin cần thiết như <span style=\"font-weight: bold; \">Họ t&ecirc;n, Số điện thoại, Địa chỉ nhận h&agrave;ng, Email</span> (để Topcare gửi th&ocirc;ng tin đơn h&agrave;ng cho Qu&yacute; kh&aacute;ch), hoặc c&oacute; thể bổ sung th&ecirc;m v&agrave;i th&ocirc;ng tin kh&aacute;c m&agrave; Qu&yacute; kh&aacute;ch cảm thấy cần thiết trong &ocirc; <span style=\"font-weight: bold; \">&quot;Ch&uacute; th&iacute;ch th&ecirc;m&quot;</span> (hướng dẫn Topcare giao h&agrave;ng, y&ecirc;u cầu viết ho&aacute; đơn VAT cho c&ocirc;ng ty...)</span></p>\r\n<p align=\"left\" style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Sau khi điền đủ c&aacute;c th&ocirc;ng tin, Qu&yacute; kh&aacute;ch cần điền th&ecirc;m<span style=\"font-weight: bold; \"> &ldquo;Nhập m&atilde; bảo vệ&rdquo;</span> (để tr&aacute;nh t&igrave;nh trạng SPAM, gửi h&agrave;ng loạt đơn h&agrave;ng), m&atilde; Qu&yacute; kh&aacute;ch phải nhập kh&ocirc;ng ph&acirc;n biệt chữ hoa, chữ thường. Nếu Qu&yacute; kh&aacute;ch kh&ocirc;ng nh&igrave;n r&otilde; m&atilde; bảo vệ đ&oacute;, Qu&yacute; kh&aacute;ch c&oacute; thể bấm <img align=\"top\" border=\"0\" height=\"20\" src=\"http://topcare.vn/Images/anh/iconcopy.jpg\" width=\"20\" />&nbsp;<span style=\"font-weight: bold; color: rgb(0, 102, 255); \">Chọn m&atilde; kh&aacute;c</span>. Rồi bấm <img align=\"middle\" border=\"0\" height=\"32\" src=\"http://topcare.vn/Images/anh/cart_finish.jpg\" width=\"92\" /> v&agrave; chờ v&agrave;i gi&acirc;y để đơn h&agrave;ng được gửi tới hệ thống của Topcare.</span></p>\r\n<p align=\"left\" style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Hệ thống sẽ kiểm tra những th&ocirc;ng tin của Qu&yacute; kh&aacute;ch đ&atilde; cung cấp 1 lần nữa, nếu th&ocirc;ng tin đơn h&agrave;ng hợp lệ, khung đặt h&agrave;ng sẽ hiện l&ecirc;n th&ocirc;ng b&aacute;o ho&agrave;n tất quy tr&igrave;nh mua h&agrave;ng như h&igrave;nh dưới đ&acirc;y:<br />\r\n	<br />\r\n	</span></p>\r\n<p align=\"center\" style=\"line-height: 150%\">\r\n	<img border=\"1\" height=\"256\" src=\"http://topcare.vn/Images/anh/cartfinish.jpg\" width=\"575\" /></p>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Sau đ&oacute; nh&acirc;n vi&ecirc;n của Topcare sẽ xử l&yacute; đơn đặt h&agrave;ng v&agrave; li&ecirc;n lạc lại với Qu&yacute; kh&aacute;ch để x&aacute;c nhận v&agrave; thống nhất việc mua h&agrave;ng.<br />\r\n	<br />\r\n	</span></p>\r\n<p style=\"line-height: 150%\">\r\n	<span style=\"font-family: Arial; font-size: 10pt; \">Qu&yacute; kh&aacute;ch cũng c&oacute; thể li&ecirc;n lạc với Ph&ograve;ng B&aacute;n h&agrave;ng Online để nhận hỗ trợ:</span></p>\r\n<ul>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Hỗ trợ th&ocirc;ng tin qua Email: <a href=\"mailto:banhang.online@topcare.vn\">banhang.online@topcare.vn</a><br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Điện thoại : <span style=\"font-weight: bold; \">(04).32888999</span> hoặc <span style=\"font-weight: bold; \">(04).85821888</span></span></li>\r\n</ul>\r\n<p style=\"line-height: 150%\">\r\n	<br />\r\n	<span style=\"text-decoration: underline; \"><span style=\"font-weight: bold; font-family: Arial; color: rgb(0, 102, 255); \">Một số lưu &yacute;:</span></span></p>\r\n<ul>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Topcare chỉ chấp nhận những Đơn đặt h&agrave;ng khi cung cấp đủ th&ocirc;ng tin ch&iacute;nh x&aacute;c về địa chỉ, số điện thoại &hellip; Sau khi Qu&yacute; kh&aacute;ch đặt h&agrave;ng, TOPCARE sẽ gọi điện cho Qu&yacute; kh&aacute;ch để x&aacute;c nhận th&ocirc;ng tin v&agrave; trao đổi việc thực hiện đơn h&agrave;ng.<br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; line-height: 24px; font-size: small; \">Hiện tại Topcare chỉ phục vụ b&aacute;n h&agrave;ng Online đối với kh&aacute;ch h&agrave;ng H&agrave; Nội v&agrave; c&aacute;c tỉnh th&agrave;nh kh&aacute;c thuộc nước Việt Nam.<br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; line-height: 24px; font-size: small; \">Địa chỉ giao h&agrave;ng phải c&oacute; th&ocirc;ng tin người nhận h&agrave;ng, địa chỉ, số điện thoại ch&iacute;nh x&aacute;c, r&otilde; r&agrave;ng. Ch&uacute;ng t&ocirc;i kh&ocirc;ng chịu tr&aacute;ch nhiệm khi qu&yacute; kh&aacute;ch ghi sai th&ocirc;ng tin người nhận.<br />\r\n		<br />\r\n		</span></li>\r\n	<li>\r\n		<span class=\"Apple-style-span\" style=\"font-family: Arial; font-size: 13px; line-height: 24px; \">Topcare kh&ocirc;ng b&aacute;n sản phẩm cho người dưới 13 tuổi. Nếu qu&yacute; kh&aacute;ch dưới 13 tuổi, Qu&yacute; kh&aacute;ch được y&ecirc;u cầu phải c&oacute; sự đồng &yacute; của cha mẹ hoặc người gi&aacute;m hộ để thực hiện mua h&agrave;ng từ website <a href=\"http://www.topcare.vn\">www.topcare.vn</a></span></li>\r\n</ul>\r\n', '', '/estoreadmin/webroot/upload/image/images/13.jpg', '', 156, '', 0, '2012-07-23 14:47:22', '2012-08-22 11:56:42', 1, NULL, ''),
										(126,$shop_id, 0, 'Sáng nay giá vàng giảm 500 nghìn/1 lượng', 'The price of gold has decreased by 500 thousand VND this morning ', '<p>\r\n	S&aacute;ng nay gi&aacute; v&agrave;ng giảm 500 ngh&igrave;n/1 lượng, mọi người đổ x&ocirc; ra c&aacute;c tiệm v&agrave;ng để b&aacute;n, v&igrave; lo sợ gi&aacute; v&agrave;ng tiếp tục giảm</p>\r\n', '<p>\r\n	update</p>\r\n', '<p>\r\n	S&aacute;ng nay gi&aacute; v&agrave;ng giảm 500 ngh&igrave;n/1 lượng, mọi người đổ x&ocirc; ra c&aacute;c tiệm v&agrave;ng để b&aacute;n, v&igrave; lo sợ gi&aacute; v&agrave;ng tiếp tục giảm</p>\r\n', '<p>\r\n	update..</p>\r\n', 'img/upload/17e72a27ea8728adf98fd4cc99c4db82.jpg', '', 156, '', 0, '2012-07-29 16:43:23', '2012-07-29 16:43:23', 1, NULL, 'sang-nay-gia-vang-giam-500-nghin-1-luong'),
										(127,$shop_id, 0, 'Công ty TNHH thiết bị y tế mới nhập 1 lô sản phẩm y tế', 'Medical Equipment Co., Ltd has just imported a new batch of medical products', '<p>\r\n	Đ&acirc;y&nbsp; lo h&agrave;ng ống nước hiện đại nhất thế giới, được sản xuất theo c&ocirc;ng nghệ của mỹ , ti&ecirc;n tiến nhất hiện nay</p>\r\n', '<p>\r\n	<span id=\"result_box\" lang=\"en\"><span class=\"hps\">This</span> <span class=\"hps\">concerns</span> <span class=\"hps\">the most modern</span> <span class=\"hps\">water</span> <span class=\"hps\">pipe</span> <span class=\"hps\">in the world,</span> <span class=\"hps\">is produced by</span> <span class=\"hps\">the</span> <span class=\"hps\">U.S.</span> <span class=\"hps\">technology</span><span>,</span> <span class=\"hps\">today&#39;s most</span> <span class=\"hps\">advanced</span></span></p>\r\n', '<p>\r\n	Đ&acirc;y&nbsp; lo h&agrave;ng ống nước hiện đại nhất thế giới, được sản xuất theo c&ocirc;ng nghệ của mỹ , ti&ecirc;n tiến nhất hiện nay</p>\r\n', '<p>\r\n	<span id=\"result_box\" lang=\"en\"><span class=\"hps\">This</span> <span class=\"hps\">concerns</span> <span class=\"hps\">the most modern</span> <span class=\"hps\">water</span> <span class=\"hps\">pipe</span> <span class=\"hps\">in the world,</span> <span class=\"hps\">is produced by</span> <span class=\"hps\">the</span> <span class=\"hps\">U.S.</span> <span class=\"hps\">technology</span><span>,</span> <span class=\"hps\">today&#39;s most</span> <span class=\"hps\">advanced</span></span></p>\r\n', 'img/upload/ab9459f38a75e382e4c2fa044f39fc10.jpg', '', 156, '', 0, '2012-07-29 16:45:58', '2012-08-06 12:45:44', 1, NULL, 'cong-ty-tnhh-thiet-bi-y-te-moi-nhap-1-lo-san-pham-y-te');";							
																
							$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_orders` (
							  `id` int(50) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `user_id` varchar(200) NOT NULL,
							  `pid` int(11) NOT NULL,
							  `pname` varchar(255) NOT NULL,
							  `images` varchar(255) DEFAULT NULL,
							  `quantity` int(11) NOT NULL,
							  `price` int(11) NOT NULL,
							  `total_price` int(11) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;";
														
							$arrSql[]="INSERT INTO `estore_orders` (`id`, `estore_id`, `user_id`, `pid`, `pname`, `images`, `quantity`, `price`, `total_price`) VALUES
								(1,$shop_id, 'id366822', 21, 'Ống công nghiệp inox ', '/tana/estoreadmin/webroot/upload/image/images/index_29.jpg', 1, 300, 300),
								(2,$shop_id, 'id366822', 20, 'Ống công nghiệp inox', '/tana/estoreadmin/webroot/upload/image/images/index_33.jpg', 1, 400, 400),
								(3,$shop_id, 'id366822', 19, 'Ống công nghiệp inox ', '/tana/estoreadmin/webroot/upload/image/images/index_31.jpg', 1, 200, 200),
								(4,$shop_id, 'id47761', 25, 'Ống công nghiệp inox ', '/tana/estoreadmin/webroot/upload/image/images/index_27.jpg', 5, 120, 600),
								(5,$shop_id, 'id47761', 20, 'Ống công nghiệp inox', '/tana/estoreadmin/webroot/upload/image/images/index_33.jpg', 5, 400, 2000),
								(6,$shop_id, 'id717636', 25, 'sp1', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_09.jpg', 1, 120, 120),
								(7,$shop_id, 'id881866', 21, 'sp2', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_17.jpg', 1, 300, 300),
								(8,$shop_id, 'id503470', 26, 'sp43', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 1, 120000, 120000),
								(9,$shop_id, 'id67517', 27, 'sp3', '/khieuvu/estoreadmin/webroot/upload/image/files/3.jpg', 1, 200, 200);";
														
							$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_partners` (
							  `id` int(50) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `name` varchar(256) NOT NULL,
							  `phone` varchar(15) NOT NULL,
							  `email` varchar(256) NOT NULL,
							  `website` varchar(256) DEFAULT NULL,
							  `fax` varchar(15) DEFAULT NULL,
							  `address` varchar(256) NOT NULL,
							  `images` varchar(256) NOT NULL,
							  `content` text,
							  `created` date NOT NULL,
							  `modified` date NOT NULL,
							  `status` int(1) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;";
														
							$arrSql[]="INSERT INTO `estore_partners` (`id`, `estore_id`, `name`, `phone`, `email`, `website`, `fax`, `address`, `images`, `content`, `created`, `modified`, `status`) VALUES
									(19,$shop_id, 'Công ty bcds', '', '', 'http://google.com', NULL, '', 'img/upload/a26d66b1322c320201a5a6c01e9f004f.jpg', NULL, '2012-07-29', '2012-07-29', 1),
									(18,$shop_id, 'Công ty bcd', '', '', 'http://google.com', NULL, '', 'img/upload/aded75138b945d987476ee4beaa48400.jpg', NULL, '2012-07-29', '2012-07-29', 1),
									(17,$shop_id, 'Công ty dcb', '', '', 'http://google.com', NULL, '', 'img/upload/65756cba90775ab2b30a744199a7c84a.jpg', NULL, '2012-07-29', '2012-07-29', 1),
									(16,$shop_id, 'Công ty abc', '', '', 'http://eximbank.com.vn', NULL, '', 'img/upload/61c692bbd3e8c4f8cb24ca87e9ff3d92.jpg', NULL, '2012-07-29', '2012-07-29', 1),
									(20,$shop_id, 'ádasd', '', '', 'http://google.com', NULL, '', 'img/upload/36e21b2e6d68b65741d004886e5223cb.jpg', NULL, '2012-09-16', '2012-09-16', 1),
									(21,$shop_id, 'hhhh', '', '', 'http://google.com', NULL, '', 'img/upload/97fea11d1a80d7ccfad25eccdd7d031e.jpg', NULL, '2012-09-16', '2012-09-16', 1),
									(22,$shop_id, 'hhh', '', '', 'http://google.com', NULL, '', 'img/upload/f6c03d67fe500b1ac80f32c87c60ec59.jpg', NULL, '2012-09-16', '2012-09-16', 1),
									(23,$shop_id, 'h', '', '', 'http://google.com', NULL, '', 'img/upload/8f9fa526eff662129d81b1fb55d07676.jpg', NULL, '2012-09-16', '2012-09-16', 1),
									(24,$shop_id, 'hhh', '', '', 'http://google.com', NULL, '', 'img/upload/74b21a268eb187c89772e79f91895d62.jpg', NULL, '2012-09-16', '2012-09-16', 1),
									(25,$shop_id, 'á', '', '', 'http://google.com', NULL, '', 'img/upload/ff76a40ba32dfb0687988e0bdbc15765.jpg', NULL, '2012-09-16', '2012-09-16', 1),
									(26,$shop_id, 'ádas', '', '', 'http://google.com', NULL, '', 'img/upload/cb18c77ef1e964033f5e9b33c991411d.jpg', NULL, '2012-09-16', '2012-09-16', 1);";							
							$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_products` (
							  `id` int(50) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `title` varchar(256) NOT NULL,
							  `title_en` varchar(256) NOT NULL,
							  `price` int(30) DEFAULT NULL,
							  `manufacturer` varchar(256) NOT NULL COMMENT 'hang sx',
							  `introduction` text NOT NULL COMMENT 'mo ta chung',
							  `content` text NOT NULL,
							  `content_en` text NOT NULL,
							  `images` varchar(256) NOT NULL,
							  `images_en` varchar(256) NOT NULL,
							  `images1` varchar(250) DEFAULT NULL,
							  `images2` varchar(250) DEFAULT NULL,
							  `images3` varchar(250) NOT NULL,
							  `images4` varchar(250) DEFAULT NULL,
							  `catproduct_id` int(10) NOT NULL,
							  `display` int(2) NOT NULL,
							  `created` datetime DEFAULT NULL,
							  `modified` datetime DEFAULT NULL,
							  `sptieubieu` tinyint(2) NOT NULL,
							  `status` int(2) NOT NULL,
							  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
							  `code` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
							  `kichthuoc` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
							  `chatlieu` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
							  `khoanggia` int(20) DEFAULT NULL,
							  `spkuyenmai` int(2) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=248 DEFAULT CHARSET=utf8;";
														
							$arrSql[]="INSERT INTO `estore_products` (`id`, `estore_id`, `title`, `title_en`, `price`, `manufacturer`, `introduction`, `content`, `content_en`, `images`, `images_en`, `catproduct_id`, `display`, `created`, `modified`, `sptieubieu`, `status`, `alias`, `code`, `kichthuoc`, `chatlieu`, `khoanggia`, `spkuyenmai`) VALUES
							(211,$shop_id, 'Bến chữ U cho bếp rộng', 'U-shaped cabinet for large kitchen', 12500000, '144', '', '<p>\r\n	đang cập nhật</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '', 'img/upload/434d3a69764058750f0f6b59e7c2e0e3.jpg', '', 112, 0, '2012-08-23 10:30:03', '2012-09-14 10:58:18', 1, 1, 'ben-chu-u-cho-bep-rong', 'able 02', '30 x 30 cm ', 'Cây cọ', 10, 0),
							(212,$shop_id, 'Tủ chữ L', 'L-shaped kitchen cabinet', 4500000, '', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', '', 110, 0, '2012-08-23 10:55:17', '2012-09-14 10:55:27', 1, 1, 'tu-chu-l', 'h4322', '20 x 40 cm', 'Mây, Tre', 5, 1),
							(215,$shop_id, 'kids product 123', 'kids product 123', 210000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/7aa2d4c620cba46145faf03c72afb234.jpg', '', 105, 0, '2012-08-23 11:11:53', '2012-08-23 18:17:45', 1, 1, 'kids-product-123', '123123', '30 x 30 cm', 'gỗ', NULL, 0),
							(216,$shop_id, 'adults product 12', 'adults product 12', 321000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/a024674425c52d5d93bcfa308f9dc244.png', '', 104, 0, '2012-08-23 11:13:56', '2012-08-23 11:13:56', 1, 1, 'adults-product 12', '5645', '30 x 30 cm', 'da', NULL, 0),
							(223,$shop_id, 'Máy khử mùi Nsaka', 'Nsaka machine hood', 120000, '', '', '<p>\r\n	đang cập nhật</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '', 'img/upload/de7ed01c7b9dbb1bbdb2711a21176e49.jpg', '', 114, 0, '2012-08-23 10:30:03', '2012-09-14 10:51:51', 1, 1, 'may-khu-mui-nsaka', 'able 02', '30 x 30 cm ', 'Cây cọ', 1, 0),
							(222,$shop_id, 'Bình + Van 14kg', 'Gas Container + Valve 14kg', 400000, '148', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/00687fc01e05574a7182ab1761b81ab3.jpg', '', 118, 0, '2012-08-23 10:55:17', '2012-09-14 10:53:32', 1, 1, 'bình-van-14kg', 'BV1232', '20 x 40 cm', 'Mây, Tre', 0, 1),
							(218,$shop_id, 'Bến nhà hàng', 'Gas stove for restaurant', 3500000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/3007b340574bcfd67cc42fd18c74d9b0.jpg', '', 119, 0, '2012-08-23 11:11:53', '2012-09-13 18:39:19', 1, 1, 'bén-nhà-hàng', 'B1123', '100 x 200 m', 'gỗ', 2, 0),
							(217,$shop_id, 'adults product 2', 'adults product 2', 321000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/de76e83506ffb367e04f84696b80c962.jpg', '', 104, 0, '2012-08-23 11:13:56', '2012-08-23 18:17:15', 1, 1, 'adults-product 12', '564500', '30 x 30 cm', 'da', NULL, 0),
							(224,$shop_id, 'Bếp nướng Mỹ', 'American Grill Stove', 5000000, '145', '', '<p>\r\n	đang cập nhật</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '', 'img/upload/872b06396ec7593b99032bd001c8a508.jpg', '', 120, 0, '2012-08-23 10:30:03', '2012-09-14 10:50:06', 1, 1, 'bep-nuong-my', 'able 02', '30 x 30 cm ', 'Cây cọ', 6, 0),
							(225,$shop_id, 'Bình 13kg', 'Gas container 13kg', 312000, '144', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/d9745f770c64999ec1cd9111f2031fc6.jpg', '', 117, 0, '2012-08-23 10:55:17', '2012-09-14 10:52:55', 0, 1, 'bình-13kg', 'B123', '100 x 40 cm', 'Mây, Tre', 0, 0),
							(229,$shop_id, 'Bếp ga RinNight', 'RinNight gas stove', 900000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/06e53cdfec18eaa1af6e79a1d3231a15.jpg', '', 105, 0, '2012-08-23 11:11:53', '2012-09-13 18:34:42', 1, 1, 'bép-ga-rinnight', 'R123123', '300 x 300 cm', 'gỗ', 0, 0),
							(230,$shop_id, 'Bếp ga âm Hàn Quốc', 'Korean negative gas stove', 1500000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/face1fafd07a42b87dfe77dd92f048c4.jpg', '', 104, 0, '2012-08-23 11:13:56', '2012-09-14 10:24:36', 1, 1, 'bép-ga-am-hàn-quóc', 'HQ5645', '30 x 30 cm', '', 1, 1),
							(231,$shop_id, 'Bếp trung bình chữ I', 'I-shaped medium gas stove', 2300000, '139', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/06e0bd26dd69280f9c14e247b49a3ec6.jpg', '', 111, 0, '2012-09-14 10:57:02', '2012-09-14 10:57:02', 1, 1, 'bep-trung-binh-chu-i', 'B56I', NULL, NULL, 2, 0),
							(244,$shop_id, 'Bến chữ U đẹp', 'U-shaped gas stove', 12500000, '144', '', '<p>\r\n	đang cập nhật</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '', 'img/upload/434d3a69764058750f0f6b59e7c2e0e3.jpg', '', 112, 0, '2012-08-23 10:30:03', '2012-09-14 10:58:18', 1, 1, 'ben-chu-u-cho-bep-rong', 'able 02', '30 x 30 cm ', 'Cây cọ', 10, 0),
							(243,$shop_id, 'Tủ chữ L nhiều ngăn', 'L-shaped gas stove with drawers', 4500000, '', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', '', 110, 0, '2012-08-23 10:55:17', '2012-09-14 10:55:27', 1, 1, 'tu-chu-l', 'h4322', '20 x 40 cm', 'Mây, Tre', 5, 1),
							(242,$shop_id, 'kids product 123', 'kids product 123', 21, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/7aa2d4c620cba46145faf03c72afb234.jpg', '', 105, 0, '2012-08-23 11:11:53', '2012-08-23 18:17:45', 1, 1, 'kids-product-123', '123123', '30 x 30 cm', 'gỗ', NULL, 0),
							(241,$shop_id, 'adults product 12', 'adults product 12', 321000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/a024674425c52d5d93bcfa308f9dc244.png', '', 104, 0, '2012-08-23 11:13:56', '2012-08-23 11:13:56', 1, 1, 'adults-product 12', '5645', '30 x 30 cm', 'da', NULL, 0),
							(240,$shop_id, 'Máy khử mùi Nsaka', 'Nsaka machine hood', 120000, '', '', '<p>\r\n	đang cập nhật</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '', 'img/upload/de7ed01c7b9dbb1bbdb2711a21176e49.jpg', '', 114, 0, '2012-08-23 10:30:03', '2012-09-14 10:51:51', 1, 1, 'may-khu-mui-nsaka', 'able 02', '30 x 30 cm ', 'Cây cọ', 1, 0),
							(239,$shop_id, 'Bình + Van 14kg', 'Gas Container + Valve 14kg', 400000, '148', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/00687fc01e05574a7182ab1761b81ab3.jpg', '', 118, 0, '2012-08-23 10:55:17', '2012-09-14 10:53:32', 1, 1, 'bình-van-14kg', 'BV1232', '20 x 40 cm', 'Mây, Tre', 0, 1),
							(238,$shop_id, 'Bến nhà hàng', 'Gas stove for restaurant', 3500000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/3007b340574bcfd67cc42fd18c74d9b0.jpg', '', 119, 0, '2012-08-23 11:11:53', '2012-09-13 18:39:19', 1, 1, 'bén-nhà-hàng', 'B1123', '100 x 200 m', 'gỗ', 2, 0),
							(237,$shop_id, 'adults product 2', 'adults product 2', 321000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/de76e83506ffb367e04f84696b80c962.jpg', '', 104, 0, '2012-08-23 11:13:56', '2012-08-23 18:17:15', 1, 1, 'adults-product 12', '5645', '30 x 30 cm', 'da', NULL, 0),
							(236,$shop_id, 'Bếp nướng Mỹ', 'American Grill Stove', 5000000, '145', '', '<p>\r\n	đang cập nhật</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '', 'img/upload/872b06396ec7593b99032bd001c8a508.jpg', '', 120, 0, '2012-08-23 10:30:03', '2012-09-14 10:50:06', 1, 1, 'bep-nuong-my', 'able 02', '30 x 30 cm ', 'Cây cọ', 6, 0),
							(235,$shop_id, 'Bình 13kg', 'Gas container 13kg', 312000, '144', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/d9745f770c64999ec1cd9111f2031fc6.jpg', '', 117, 0, '2012-08-23 10:55:17', '2012-09-14 10:52:55', 0, 1, 'bình-13kg', 'B123', '100 x 40 cm', 'Mây, Tre', 0, 0),
							(234,$shop_id, 'Bếp ga RinNight', 'RinNight gas stove', 900000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/06e53cdfec18eaa1af6e79a1d3231a15.jpg', '', 105, 0, '2012-08-23 11:11:53', '2012-09-13 18:34:42', 1, 1, 'bép-ga-rinnight', 'R123123', '300 x 300 cm', 'gỗ', 0, 0),
							(233,$shop_id, 'Bếp ga âm Hàn Quốc', 'Korean negative gas stove', 1500000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/face1fafd07a42b87dfe77dd92f048c4.jpg', '', 104, 0, '2012-08-23 11:13:56', '2012-09-14 10:24:36', 1, 1, 'bép-ga-am-hàn-quóc', 'HQ5645', '30 x 30 cm', '', 1, 1),
							(232,$shop_id, 'Bếp trung bình chữ I', 'I-shaped medium gas stove', 2300000, '139', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/06e0bd26dd69280f9c14e247b49a3ec6.jpg', '', 111, 0, '2012-09-14 10:57:02', '2012-09-14 10:57:02', 1, 1, 'bep-trung-binh-chu-i', 'B56I', NULL, NULL, 2, 0),
							(245,$shop_id, 'Bếp cho quán ăn vừa và nhỏ', 'Gas stove for small and medium restaurant', 160000, '141', '', '<p>\r\n	đang c&acirc;p nhật</p>\r\n', '', 'img/upload/3007b340574bcfd67cc42fd18c74d9b0.jpg', '', 119, 0, '2012-09-14 11:33:00', '2012-09-14 11:33:00', 0, 1, 'bep-cho-quan-an-vua-va-nho', 'B912', NULL, NULL, 1, 1),
							(246,$shop_id, 'Bếp nấu ăn nhà hàng 5 sao', 'Gas stove for 5-star restaurant', 17500000, '', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/92cecb0fc068b89020e492ecf4c673ea.jpg', '', 120, 0, '2012-09-14 11:34:37', '2012-09-14 11:34:37', 0, 1, 'bep-nau-an-nha-hang-5-sao', 'Vi89', NULL, NULL, 10, 1),
							(247,$shop_id, 'Tủ chữ L', 'L-shaped kitchen cabinet', 4500000, '', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', '', 110, 0, '2012-08-23 10:55:17', '2012-09-14 10:55:27', 1, 1, 'tu-chu-l', 'h4322', '20 x 40 cm', 'Mây, Tre', 5, 1);";
							
							$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_settings` (
							  `id` int(50) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `name` varchar(256) CHARACTER SET utf8 NOT NULL,
							  `map` text CHARACTER SET utf8 NOT NULL,
							  `title` varchar(250) CHARACTER SET utf8 NOT NULL,
							  `info_other` varchar(250) CHARACTER SET utf8 NOT NULL,
							  `address` varchar(256) CHARACTER SET utf8 NOT NULL,
							  `phone` varchar(100) NOT NULL,
							  `mobile` varchar(15) NOT NULL,
							  `email` varchar(256) NOT NULL,
							  `server` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
							  `username` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
							  `password` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
							  `url` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
							  `keyword` varchar(500) CHARACTER SET utf8 NOT NULL,
							  `description` text CHARACTER SET utf8 NOT NULL,
							  `content` text CHARACTER SET utf8,
							  `created` date NOT NULL,
							  `modified` text NOT NULL,
							  `name_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
							  `address_eg` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
							  `title_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
							  `descriptions` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
							  `footer` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;";
														
							$arrSql[]="INSERT INTO `estore_settings` (`id`, `estore_id`, `name`, `title`, `info_other`, `address`, `phone`, `mobile`, `email`, `server`, `username`, `password`, `url`, `keyword`, `description`, `content`, `created`, `modified`, `name_en`, `address_eg`, `title_en`, `descriptions`, `footer`) VALUES
								(1,$shop_id, 'Công ty cổ phần Demo', 'CÔNG TY TNHH DEMO', 'Copyright © 2011 Bản quyền thuộc Vinaconex 12', 'Nguyễn Văn Linh - Q. Long Biên - Hà Nội', '04.38517532', '0979 644 688', 'servic@demo.vn', 'localhost', 'root', NULL, 'demo.vn', 'CONG TY TNHH  DEMO', 'CONG TY TNHH  DEMO', '<p>\r\n	<span style=\"font-size:14px;\"><tt>Hoặc vui l&ograve;ng điền đầy đủ th&ocirc;ng tin v&agrave;o đơn h&agrave;ng, sau khi ho&agrave;n th&agrave;nh qu&yacute; kh&aacute;ch lick &quot;Gửi đơn h&agrave;ng&quot;<br />\r\n	Sau khi nhận được đơn h&agrave;ng, trong v&ograve;ng 24h ch&uacute;ng t&ocirc;i sẽ li&ecirc;n hệ với qu&yacute; kh&aacute;ch để x&aacute;c nhận. </tt></span></p>\r\n', '0000-00-00', '1406477611', 'CONG TY TNHH DAU TU THUONG MAI & DICH VỤ VIET NAM TOAN CAU', '', 'CONG TY TNHH  DEMO', '<p>\r\n	đang cập nhật</p>\r\n', '<p style=\"text-align: center; \">\r\n	&nbsp;</p>\r\n<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" style=\"width: 980px; \">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n				<div>\r\n					<span style=\"color: rgb(255, 255, 255); \">Head office: 4A No, Lang Ha street - Ba Dinh district - HN City</span></div>\r\n				<div>\r\n					<span style=\"color: rgb(255, 255, 255); \">Showroom 1: 128C No, Dai La street - HN City</span></div>\r\n				<div>\r\n					<span style=\"color: rgb(255, 255, 255); \">Tel: (+84) 4 37 53 3004 - (+84) 4 59 22 27 - Fax: (+84) 4 37 53 3004</span></div>\r\n			</td>\r\n			<td>\r\n				<div>\r\n					<span style=\"color: rgb(255, 255, 255); \">Showroom 2: 128c ,street &nbsp;- Dong Tam district - HN City</span></div>\r\n				<div>\r\n					<span style=\"color: rgb(255, 255, 255); \">Tel: (+84) 4 36 74 1073 &nbsp;- Fax: (+84) 4 37 59 3004</span></div>\r\n				<div>\r\n					<span style=\"color: rgb(255, 215, 0); \">Website: www.alatca.vn</span></div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p style=\"text-align: center; \">\r\n	&nbsp;</p>\r\n');";
							
														
							$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_slideshows` (
							  `id` int(50) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
							  `images` varchar(250) CHARACTER SET utf8 NOT NULL,
							  `created` datetime NOT NULL,
							  `status` int(2) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;";

							$arrSql[]="INSERT INTO `estore_slideshows` (`id`, `estore_id`, `name`, `images`, `created`, `status`) VALUES
									(20,$shop_id, 'slide4', 'img/gallery/529ef1813f7eb5638314a9814bdf4371.png', '2012-07-29 15:36:03', 1),
									(22,$shop_id, 'slide', 'img/gallery/784197959d177a4062b681bcda56ebe0.jpg', '2012-09-13 12:52:02', 1);";
							
							$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_users` (
							  `id` int(50) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `password` varchar(200) NOT NULL,
							  `name` varchar(200) NOT NULL,
							  `email` varchar(50) NOT NULL,
							  `phone` int(15) NOT NULL,
							  `birth_date` varchar(200) NOT NULL,
							  `sex` varchar(20) NOT NULL,
							  `images` varchar(256) NOT NULL,
							  `created` datetime NOT NULL,
							  `modified` datetime NOT NULL,
							  `active_key` varchar(50) DEFAULT NULL,
							  `status` int(1) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;";
														
							$arrSql[] ="INSERT INTO `estore_users` (`id`, `estore_id`, `password`, `name`, `email`, `phone`, `birth_date`, `sex`, `images`, `created`, `modified`, `active_key`, `status`) VALUES
								(17,$shop_id, 'e10adc3949ba59abbe56e057f20f883e', 'admin', 'estoreadmin@estoreadmin', 2147483647, '18-11-1968', '1', '', '2011-05-17 14:33:04', '2012-07-08 10:07:43', '70c639df5e30bdee440e4cdf599fec2b', 1),
								(39,$shop_id, 'e10adc3949ba59abbe56e057f20f883e', 'phuc', 'phuca4@gmail.com', 972943090, '2012-07-18', '1', '', '2012-07-10 08:56:46', '2012-07-10 08:56:46', 'd58072be2820e8682c0a27c0518e805e', 0);";
														
							$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_videos` (
							  `id` int(11) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
							  `video` varchar(250) CHARACTER SET utf8 NOT NULL,
							  `LinkUrl` varchar(255) DEFAULT NULL,
							  `created` datetime NOT NULL,
							  `status` int(2) NOT NULL,
							  `left` int(2) NOT NULL,
							  `right` int(2) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;";
														
							$arrSql[]="INSERT INTO `estore_videos` (`id`, `estore_id`, `name`, `video`, `LinkUrl`, `created`, `status`, `left`, `right`) VALUES
							(1,$shop_id, 'Gala trong ngay', 'video/upload/c67b28f317fe8740ada0a80316a0559c.flv', 'http://www.youtube.com/watch?v=5z7DEE70dEs&feature=related', '2011-10-02 18:51:33', 1, 0, 0),
							(2,$shop_id, 'Clip gala Bên phải', 'video/upload/64c23f4052d6626521caef72b1bc067f.flv', 'http://www.youtube.com/watch?v=76ZqkGxe_Mc&feature=g-vrec', '2012-06-14 14:46:38', 1, 1, 0);";
							
							$arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_wards` (
							  `id` int(50) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `name` varchar(256) CHARACTER SET utf8 NOT NULL,
							  `district_id` int(10) NOT NULL,
							  `status` int(1) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
														
						 $arrSql[] ="CREATE TABLE IF NOT EXISTS `estore_weblinks` (
							  `id` int(50) NOT NULL AUTO_INCREMENT,
							  `estore_id` int(50) NOT NULL DEFAULT '0',
							  `name` varchar(256) CHARACTER SET utf8 NOT NULL,
							  `link` varchar(256) CHARACTER SET ucs2 NOT NULL,
							  `created` date NOT NULL,
							  `modified` date NOT NULL,
							  `status` int(2) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;";
														
							$arrSql[]="INSERT INTO `estore_weblinks` (`id`, `estore_id`, `name`, `link`, `created`, `modified`, `status`) VALUES
							(8,$shop_id, 'Google', 'http://google.vn', '0000-00-00', '0000-00-00', 1),
							(9,$shop_id, 'Dân trí', 'http://dantri.com.vn', '0000-00-00', '2012-08-04', 1),
							(10,$shop_id, '24h', 'http://24h.com.vn', '2012-08-04', '2012-08-04', 1),
							(11,$shop_id, 'quản trị mạng', 'http://quantrimang.com.vn', '2012-08-04', '2012-08-04', 1);";
							
						if($username ==='' and $password === '' )
							{
							    $db = ConnectionManager::getDataSource('default');
								//$nameLangueCopy = $db->rawQuery($sql);
								try {
									foreach ($arrSql as $sql) {
										$db->rawQuery($sql);
										}
									$result = "Sucessfull";
								} catch (\Exception $exc) {
									$result = $exc->getMessage();
									
								}
							}
							
							if($username !='' and $password != '' )
							{
								$db = new ConnectionManager;
								$config = array(
										//'className' => 'Cake\Database\Connection',
										'driver' => 'mysql',
										'persistent' => false,
										'host' =>'localhost',
										'login' =>$username,
										'password' =>$password,
										'database' =>$namedatabase,
										'prefix' => false,
										'encoding' => 'utf8',
										'timezone' => 'UTC',
										'cacheMetadata' => true
								);
								$db->create($namedatabase,$config);
								$name = ConnectionManager::getDataSource($namedatabase);
								try {
									foreach ($arrSql as $sql) {
										$name->rawQuery($sql);
									}
									$result = "Sucessfull";
								} catch (\Exception $exc) {
									$result = $exc->getMessage();
										
								}
								
							}
								
							return $result;
							break;
						}
					case "50000565_fr":
						{
							// insert recode all form table
							return $sql_langue ="Chu Viet nam";
							break;
						}
					case "50000565_ru":
						{
							;
							return $sql_langue ="Chu Tieng anh";
							break;
						}
						
				// theme 50000565 : theme 1 cong ty 
						case "50000564_vi" :
						case "50000564_en" :
							{
								// Truong hop dau tien nen tao 2 ngon ngu co san
								//return $sql_langue ="Chu Viet nam";
								break;
							}
						case "50000564_fr":
							{
								;
								return $sql_langue ="Chu Viet nam";
								break;
							}
						case "50000564_ru":
							{
								;
								return $sql_langue ="Chu Tieng anh";
								break;
							}
						
				default:
					{
						return $sql_langue = Null;
						break;
					}
			}
		}else
		{
		   $sql_langue ="Error By Laycode".$layout_code." is Null and Langcode ".$language_code." is Null";
		   return $sql_langue;
		}
	}
	
	//++++++++++++++++++++++++++++++++++++
	/*
	 * checkLayoutCodeReturnCodeTheme :$layout_code
	 * Return :copy  Name view of controller + dir of theme
	*/
	function checkLayoutCodeReturnCodeTheme($project_name,$layout_code)
	{
		$dir_and_name_estore = Null ;
		switch ($layout_code)
		{
			case 50000568:
				{
					// Copy views shops to views
						
					$source = DOCUMENT_ROOT . 'app/views/creativeeshop/';
					$destination = DOCUMENT_ROOT . 'app/views/' . $project_name;
					mkdir ( $destination, 0777 );
					$dir_handle = @opendir ( $source ) ;//or die ( "Unable to open" );
					while ( $file = readdir ( $dir_handle ) ) {
						if ($file != "." && $file != ".." && ! is_dir ( "$source/$file" ))
							copy ( "$source/$file", "$destination/$file" );
					}
					closedir ( $dir_handle );
						
					$structure = GIANHANG . $project_name. '/';
					if (!mkdir( $structure, 0, true )) {
						return $dir_and_name_estore = 0 ; // 1 :'Bạn đăng ký không thành công';
						//echo "<script language='javascript'>alert('Bạn đăng ký không thành công, xem lại');window.location.back(-1);</script>";
					} else {
					//echo "<script language='javascript'>alert('Chúc mừng bạn đăng ký gian hàng công');window.location.replace('" . DOMAIN . "thanh-vien');</script>";
						chmod ( $structure, 0777 );
						return $dir_and_name_estore = 1 ; // 1 :'Chúc mừng bạn đăng ký gian hàng công';
					}
					return $dir_and_name_estore ="CreativeeshopSucessfull";
					break;
				}
			case 50000567:
				{
					// Copy views shops to views
						
					$source = DOCUMENT_ROOT . 'app/views/clotfzakju/';
					$destination = DOCUMENT_ROOT . 'app/views/' . $project_name;
					mkdir ( $destination, 0777 );
					$dir_handle = @opendir ( $source ) ;//or die ( "Unable to open" );
					while ( $file = readdir ( $dir_handle ) ) {
						if ($file != "." && $file != ".." && ! is_dir ( "$source/$file" ))
							copy ( "$source/$file", "$destination/$file" );
					}
					closedir ( $dir_handle );
						
					$structure = GIANHANG . $project_name. '/';
					if (!mkdir( $structure, 0, true )) {
						return $dir_and_name_estore = 0 ; // 1 :'Bạn đăng ký không thành công';
						//echo "<script language='javascript'>alert('Bạn đăng ký không thành công, xem lại');window.location.back(-1);</script>";
					} else {
					//echo "<script language='javascript'>alert('Chúc mừng bạn đăng ký gian hàng công');window.location.replace('" . DOMAIN . "thanh-vien');</script>";
						chmod ( $structure, 0777 );
						return $dir_and_name_estore = 1 ; // 1 :'Chúc mừng bạn đăng ký gian hàng công';
					}
					return $dir_and_name_estore ="ClothingstoreSucessfull";
					break;
				} 
			case 50000566:
				{
					// Copy views shops to views
			
					$source = DOCUMENT_ROOT . 'app/views/estoredaquycp/';
					$destination = DOCUMENT_ROOT . 'app/views/' . $project_name;
					mkdir ( $destination, 0777 ); 
					$dir_handle = @opendir ( $source ) ;//or die ( "Unable to open" );
					while ( $file = readdir ( $dir_handle ) ) {
						if ($file != "." && $file != ".." && ! is_dir ( "$source/$file" ))
							copy ( "$source/$file", "$destination/$file" );
					}
					closedir ( $dir_handle );
			
					$structure = GIANHANG . $project_name. '/';
					if (!mkdir( $structure, 0, true )) {
						return $dir_and_name_estore = 0 ; // 1 :'Bạn đăng ký không thành công';
						//echo "<script language='javascript'>alert('Bạn đăng ký không thành công, xem lại');window.location.back(-1);</script>";
					} else {
					//echo "<script language='javascript'>alert('Chúc mừng bạn đăng ký gian hàng công');window.location.replace('" . DOMAIN . "thanh-vien');</script>";
						chmod ( $structure, 0777 );
						return $dir_and_name_estore = 1 ; // 1 :'Chúc mừng bạn đăng ký gian hàng công';
					}
					return $dir_and_name_estore ="daquySucessfull";
					break;
				}
			
			case 50000565:
				{
					// Copy views shops to views
						
					$source = DOCUMENT_ROOT . 'app/views/estore/';
					$destination = DOCUMENT_ROOT . 'app/views/' . $project_name;
					mkdir ( $destination, 0777 ); // so you get the sticky bit set
					$dir_handle = @opendir ( $source ) ;//or die ( "Unable to open" );
					while ( $file = readdir ( $dir_handle ) ) {
						if ($file != "." && $file != ".." && ! is_dir ( "$source/$file" ))
							copy ( "$source/$file", "$destination/$file" );
					}
					closedir ( $dir_handle );
						
					$structure = GIANHANG . $project_name. '/';
					if (!mkdir( $structure, 0, true )) {
						return $dir_and_name_estore = 0 ; // 1 :'Bạn đăng ký không thành công';
						//echo "<script language='javascript'>alert('Bạn đăng ký không thành công, xem lại');window.location.back(-1);</script>";
					} else {
					//echo "<script language='javascript'>alert('Chúc mừng bạn đăng ký gian hàng công');window.location.replace('" . DOMAIN . "thanh-vien');</script>";
						chmod ( $structure, 0777 );
						return $dir_and_name_estore = 1 ; // 1 :'Chúc mừng bạn đăng ký gian hàng công';
					}
					return $dir_and_name_estore ="begaSucessfull";
					break;
				}
				
			case 50000564:
				{
					// Copy views shops to views
					
					$source = DOCUMENT_ROOT . 'app/views/shops/';
					$destination = DOCUMENT_ROOT . 'app/views/' . $project_name;
					// $source = DOMAIN.'app/views/shops/';
					// $destination = DOMAIN.'app/views/'.$_POST['tengianhang'];
					mkdir ( $destination, 0777 ); // so you get the sticky bit set
					$dir_handle = @opendir ( $source ) ;//or die ( "Unable to open" );
					while ( $file = readdir ( $dir_handle ) ) {
						if ($file != "." && $file != ".." && ! is_dir ( "$source/$file" ))
							copy ( "$source/$file", "$destination/$file" );
					}
					closedir ( $dir_handle );
					
					$structure = GIANHANG . $project_name. '/';
					if (! mkdir ( $structure, 0, true )) {
						return $dir_and_name_estore = 0 ; // 1 :'Bạn đăng ký không thành công';
						//echo "<script language='javascript'>alert('Bạn đăng ký không thành công, xem lại');window.location.back(-1);</script>";
					} else {
						//echo "<script language='javascript'>alert('Chúc mừng bạn đăng ký gian hàng công');window.location.replace('" . DOMAIN . "thanh-vien');</script>";
						chmod ( $structure, 0777 );
						return $dir_and_name_estore = 1 ; // 1 :'Chúc mừng bạn đăng ký gian hàng công';
					}
					return $dir_and_name_estore ="Sucessfull";
					break;
				}
					
			default:
				{
					return $dir_and_name_estore = Null;
					break;
				}
		}
	}
	
	function danhmuc($shopname) {
			
		$shoparr = $this->Shop->find ( 'all', array (
				'conditions' => array (
						'Shop.name' => $shopname,
						'Shop.status' => 1
				),
				'fields' => array (
						'Shop.id',
						'Shop.created',
						'Shop.databasename',
						'Shop.username',
						'Shop.password',
						'Shop.hostname',
						'Shop.ipserver'
				)
		) );
	
		//++++++++++Connect  data +++++++++++++++++
		foreach($shoparr as $shop){
			$databasename = $shop['Shop']['databasename'];
			$password = $shop['Shop']['password'];
			$username = $shop['Shop']['username'];
			$hostname = $shop['Shop']['hostname'];
			$shop_id = $shop['Shop']['id'];
				
		}
		$db = new ConnectionManager;
		$config = array(
				//'className' => 'Cake\Database\Connection',
				'driver' => 'mysql',
				'persistent' => false,
				'host' =>$hostname,
				'login' =>$username,
				'password' =>$password,
				'database' =>$databasename,
				'prefix' => false,
				'encoding' => 'utf8',
				'timezone' => 'UTC',
				'cacheMetadata' => true
		);
		$db->create($databasename,$config);
		$name = ConnectionManager::getDataSource($databasename);
		// 							                                    echo "99999999</br>";
		// 							                                    pr($name->config);die;
		$sql = "SELECT estore_catproducts.*
									 FROM  estore_catproducts
									 WHERE estore_catproducts.parent_id= 0 AND estore_catproducts.estore_id =".(int)$shop_id." ORDER BY  estore_catproducts.name ASC ";
		//$resul = $name->rawQuery($sql);
		$resul = $name->fetchAll($sql);
			
		return $resul;
			
	}
	
	function unicode_convert($str) {
		if (! $str)
			return false;
		$unicode = array(
				'a'=>array('á','à','ả','ã','ạ','ă','ắ','ặ', 'ằ','ẳ','ẵ','â','ấ','ầ','ẩ','ẫ','ậ','� �'),
				'A'=>array('Á','À','Ả','Ã','Ạ','Ă','Ắ','Ặ', 'Ằ','Ẳ','Ẵ','Â','Ấ','Ầ','Ẩ','Ẫ','Ậ','� �'),
				'd'=>array('đ'),
				'D'=>array('Đ'),
				'e'=>array('é','è','ẻ','ẽ','ẹ','ê','ế','ề' ,'ể','ễ','ệ'),
				'E'=>array('É','È','Ẻ','Ẽ','Ẹ','Ê','Ế','Ề' ,'Ể','Ễ','Ệ'),
				'i'=>array('í','ì','ỉ','ĩ','ị'),
				'I'=>array('Í','Ì','Ỉ','Ĩ','Ị'),
				'o'=>array('ó','ò','ỏ','õ','ọ','ô','ố','ồ', 'ổ','ỗ','ộ','ơ','ớ','ờ','ở','ỡ','� �'),
				'0'=>array('Ó','Ò','Ỏ','Õ','Ọ','Ô','Ố','Ồ', 'Ổ','Ỗ','Ộ','Ơ','Ớ','Ờ','Ở','Ỡ','� �'),
				'u'=>array('ú','ù','ủ','ũ','ụ','ư','ứ','ừ', 'ử','ữ','ự'),
				'U'=>array('Ú','Ù','Ủ','Ũ','Ụ','Ư','Ứ','Ừ', 'Ử','Ữ','Ự'),
				'y'=>array('ý','ỳ','ỷ','ỹ','ỵ'),
				'Y'=>array('Ý','Ỳ','Ỷ','Ỹ','Ỵ'),
				'-'=>array(' ','&','?')
		);
	
		foreach($unicode as $nonUnicode=>$uni){
			foreach($uni as $value)
				$str = str_replace($value,$nonUnicode,$str);
		}
		return $str;
	}
	function tintucnoibat() {
		mysql_query ( "SET names utf8" );
		return $this->News->find ( 'all', array (
				'conditions' => array (
						'News.status' => 1,
						'News.category_id' => 201 
				),
				'order' => 'News.id DESC',
				'limit' => 5 
		) );
	}
	function showroom() {
		return $this->Gallery->find ( 'all', array (
				'conditions' => array (
						'Gallery.status' => 1 
				),
				'order' => 'Gallery.id DESC',
				'limit' => 4 
		) );
	}
	// tin tuc
	function advleft() {
		return $this->Gallery->find ( 'all', array (
				'order' => 'Gallery.id DESC' 
		) );
	}
	function advright() {
		return $this->Gallery->find ( 'all', array (
				'conditions' => array (
						'Gallery.status' => 1,
						'Gallery.display' => 2 
				),
				'order' => 'Gallery.id DESC',
				'limit' => 1 
		) );
	}
	function catproduct() {
		mysql_query ( "SET names utf8" );
		return $this->Catproduct->find ( 'all', array (
				'conditions' => array (
						'Catproduct.status' => 1 
				),
				'order' => 'Catproduct.char ASC' 
		) );
	}
	function submenuproduct($id = null) {
		return $this->Catproduct->find ( 'all', array (
				'conditions' => array (
						'Catproduct.parent_id ' => $id 
				),
				'order' => 'Catproduct.id DESC' 
		) );
	}
	function sanphammoi() {
		mysql_query ( "SET names utf8" );
		return $this->Product->find ( 'all', array (
				'conditions' => array (
						'Product.status' => 1,
						'Product.newsproduct' => '1' 
				),
				'order' => 'Product.id DESC',
				'limit' => 10 
		) );
	}
	function phongmau() {
		mysql_query ( "SET names utf8" );
		return $this->Catproduct->find ( 'all', array (
				'conditions' => array (
						'Catproduct.status' => 1,
						'Catproduct.parent_id' => '8' 
				),
				'order' => 'Catproduct.char DESC' 
		) );
	}
	function binhchon() {
		mysql_query ( "SET names utf8" );
		return $this->Poll->find ( 'all', array (
				'conditions' => array (
						'Poll.status' => 1 
				),
				'order' => 'Poll.id DESC' 
		) );
		// return $this->Categorypro->find('all');
	}
	function banner() {
		return $this->Banner->find ( 'all', array (
				'conditions' => array (
						'Banner.status' => 1 
				),
				'order' => 'Banner.id DESC' 
		) );
	}
	function setting() {
		return $this->Setting->find ( 'all', array (
				'conditions' => array (),
				'order' => 'Setting.id DESC' 
		) );
	}
	function adv() {
		// return $this->Gallery->find('all',array('conditions'=>array('Gallery.status'=>1),'order'=>'Gallery.id DESC','limit'=>2));
		return $this->Banner->find ( 'all', array (
				'conditions' => array (
						'Banner.status' => 1 
				),
				'order' => 'Banner.id DESC',
				'limit' => 2 
		) );
	}
	function linkwebsite() {
		// return $this->Gallery->find('all',array('conditions'=>array('Gallery.status'=>1),'order'=>'Gallery.id DESC','limit'=>2));
		return $this->Advertisement->find ( 'all', array (
				'conditions' => array (
						'Advertisement.status' => 1 
				),
				'order' => 'Advertisement.id DESC' 
		) );
	}
	function doitac() {
		// return $this->Gallery->find('all',array('conditions'=>array('Gallery.status'=>1),'order'=>'Gallery.id DESC','limit'=>2));
		return $this->Partner->find ( 'all', array (
				'conditions' => array (
						'Partner.status' => 1 
				),
				'order' => 'Partner.id DESC' 
		) );
	}
	
	// cong trinh
	function vanbanphapluat() {
		mysql_query ( "SET names utf8" );
		return $this->Category->find ( 'all', array (
				'conditions' => array (
						'Category.status' => 1,
						'Category.parent_id' => '196' 
				),
				'order' => 'Category.tt DESC' 
		) );
	}
	function menu_active() {
		return $this->Category2->find ( 'all', array (
				'conditions' => array (
						'Category2.parent_id' => 145 
				),
				'order' => 'Category2.id ASC' 
		) );
	}
	function helpsonline() {
		return $this->Helps->find ( 'all', array (
				'conditions' => array (
						'Helps.status' => 1 
				),
				'order' => 'Helps.id DESC',
				'limit' => 2 
		) );
	}
	function id_product($catproduct_id) {
		return $this->Product->read ( null, $catproduct_id );
		// pr($this->Product->read(null,$id));die;
	}
	function manshoes() {
		mysql_query ( "SET names utf8" );
		return $this->Category->find ( 'all', array (
				'conditions' => array (
						'Category.status' => 1,
						'Category.parent_id' => '143' 
				),
				'order' => 'Category.id ASC' 
		) );
		// pr($this->Category->find('all',array('conditions'=>array('Category.status'=>1,'Category.parent_id'=>'143'),'order'=>'Category.id ASC')));die;
	}
	function mensandals() {
		mysql_query ( "SET names utf8" );
		return $this->Category->find ( 'all', array (
				'conditions' => array (
						'Category.status' => 1,
						'Category.parent_id' => '142' 
				),
				'order' => 'Category.id ASC' 
		) );
	}
	function getinfo($cat = null) {
		return $this->News->find ( 'all', array (
				'conditions' => array (
						'News.status' => 1,
						'News.category_id' => $cat 
				),
				'order' => 'News.id DESC',
				'limit' => 3 
		) );
	}
	function news_codong($cat = null) {
		return $this->News->find ( 'all', array (
				'conditions' => array (
						'News.status' => 1,
						'News.category_id' => $cat 
				),
				'order' => 'News.id DESC',
				'limit' => 10 
		) );
	}
	function videos() {
		mysql_query ( "SET names utf8" );
		return $this->Video->find ( 'all', array (
				'conditions' => array (
						'Video.status' => 1 
				),
				'order' => 'Video.id DESC',
				'limit' => 1 
		) );
	}
	function slideshow() {
		mysql_query ( "SET names utf8" );
		return $this->Slideshow->find ( 'all', array (
				'conditions' => array (
						'Slideshow.status' => 1 
				),
				'order' => 'Slideshow.id DESC' 
		) );
	}
	function about() {
		return $this->About->find ( 'all', array (
				'conditions' => array (
						'About.status' => '1' 
				),
				'order' => 'About.char ASC' 
		) );
	}
	function tinmoi() {
		mysql_query ( "SET names utf8" );
		return $this->News->find ( 'all', array (
				'order' => 'News.id DESC',
				'limit' => 3 
		) );
	}
	function category() {
		mysql_query ( "SET names utf8" );
		return $this->Category->find ( 'all', array (
				'order' => 'Category.tt ASC' 
		) );
	}
	function product($catproduct_id = null) {
		mysql_query ( "SET names utf8" );
		$this->paginate = array (
				'conditions' => array (
						'Product.catproduct_id' => $catproduct_id,
						'Product.status' => 1 
				),
				'limit' => 2,
				'order' => 'Product.created DESC' 
		);
		return $this->paginate ( 'Product', array () );
	}
	function get_name_catproduct($id) {
		return $this->Catproduct->find ( 'all', array (
				'conditions' => array (
						'Catproduct.id' => $id,
						'Catproduct.status' => 1 
				) 
		) );
	}
	function gallery($id) {
		return $this->Gallery->find ( 'all', array (
				'conditions' => array (
						'Gallery.product_id' => $id,
						'Gallery.status' => 1 
				) 
		) );
	}
	function city($id = null) {
		return $this->City->find ( 'all', array (
				'conditions' => array (
						'City.status' => 1,
						'City.id' => $id 
				),
				'order' => 'City.char ASC' 
		) );
	}
	function city2($id = null) {
		return $this->City->find ( 'all', array (
				'conditions' => array (
						'City.status' => 1,
						'City.id <>' => $id 
				),
				'order' => 'City.char ASC' 
		) );
	}
	function sp_conban() {
		return $this->Product->find ( 'all', array (
				'conditions' => array (
						'Product.conlai > 0' 
				),
				'limit' => 4,
				'order' => 'Product.created DESC' 
		) );
	}
	function categorygianhang($id = null) {
		mysql_query ( "SET names utf8" );
		return $this->Categoryshop->find ( 'all', array (
				'conditions' => array (
						'Categoryshop.status' => 1,
						'Categoryshop.parent_id' => NULL,
						'Categoryshop.shop_id' => $id 
				),
				'order' => 'Categoryshop.order ASC' 
		) );
	}
	function categorygianhang1() {
		mysql_query ( "SET names utf8" );
		return $this->Categoryshop->find ( 'all', array (
				'conditions' => array (
						'Categoryshop.status' => 1,
						'Categoryshop.parent_id' => NULL 
				),
				'order' => 'Categoryshop.id ASC' 
		) );
	}
	function categorygianhangchild1($id = null) {
		mysql_query ( "SET names utf8" );
		return $this->Categoryshop->find ( 'all', array (
				'conditions' => array (
						'Categoryshop.status' => 1,
						'Categoryshop.parent_id' => $id 
				),
				'order' => 'Categoryshop.id ASC' 
		) );
	}
	function categorygianhangchild($id = null) {
		mysql_query ( "SET names utf8" );
		
		return $this->Categoryshop->find ( 'all', array (
				'conditions' => array (
						'Categoryshop.status' => 1,
						'Categoryshop.parent_id' => $id 
				),
				'order' => 'Categoryshop.order ASC' 
		) );
	}
	// --------------------------------
	function cities() {
		mysql_query ( "SET names utf8" );
		return $this->Cities->find ( 'all', array (
				'conditions' => array (
						'Cities.status' => 1 
				),
				'order' => 'Cities.id ASC' 
		) );
	}
	function categoryproductchildfull() {
		mysql_query ( "SET names utf8" );
		
		return $this->Catproduct->find ( 'all', array (
				'conditions' => array (
						'Catproduct.status' => 1,
						'Catproduct.parent_id' > 1 
				),
				'order' => 'Catproduct.id ASC' 
		) );
	}
	function classifiedss($id = null) {
		mysql_query ( "SET names utf8" );
		return $this->Classifiedss->find ( 'all', array (
				'conditions' => array (
						'Classifiedss.status' => 1,
						'Classifiedss.scop_id' => $id 
				),
				'order' => 'Classifiedss.id ASC' 
		) );
	}
	function newsraovat_userid() {
		mysql_query ( "SET names utf8" );
		
		$user = $this->Session->read ( 'id' );
		
		return $this->Classifiedss->find ( 'all', array (
				'conditions' => array (
						'Classifiedss.status' => 1,
						'Classifiedss.user_id' => $user 
				),
				'order' => 'Classifiedss.id ASC' 
		) );
	}
	function newsraovatother() {
		mysql_query ( "SET names utf8" );
		return $this->Classifiedss->find ( 'all', array (
				'conditions' => array (
						'Classifiedss.status' => 1 
				),
				'limit' => 6,
				'order' => 'Classifiedss.id ASC' 
		) );
	}
	function shops() {
		$user = $this->Session->read ( 'id' );
		return $this->Shop->find ( 'all', array (
				'conditions' => array (
						'Shop.user_id' => $user 
				),
				'order' => 'Shop.id DESC' 
		) );
	}
	function categoryshop() {
		return $this->Categoryshop->find ( 'all', array (
				'conditions' => array (
						'Categoryshop.status' => 1,
						'Categoryshop.parent_id' => null 
				),
				'order' => 'Categoryshop.order ASC' 
		) );
	}
	function categoryshop_child($parent_id = null) {
		return $this->Categoryshop->find ( 'all', array (
				'conditions' => array (
						'Categoryshop.parent_id' => $parent_id,
						'Categoryshop.status' => 1 
				),
				'order' => 'Categoryshop.order ASC' 
		) );
	}
	function productshop($id = null) {
		return $this->Productshop->find ( 'all', array (
				'conditions' => array (
						'Productshop.categoryshop_id' => $id 
				),
				'order' => 'Productshop.id DESC' 
		) );
	}
	function tinkhuyenmai($shop_id = null) {
		if ($shop_id == null)
			return $this->Newshop->find ( 'all', array (
					'conditions' => array (
							'Newshop.categorynewsshop_id' => 220,
							'Newshop.status' => 1 
					),
					'order' => 'Newshop.created DESC' 
			) );
		
		return $this->Newshop->find ( 'all', array (
				'conditions' => array (
						'Newshop.shop_id' => $shop_id,
						'Newshop.categorynewsshop_id' => 220,
						'Newshop.status' => 1 
				),
				'order' => 'Newshop.created DESC' 
		) );
	}
	function getnameproduct($id = null) {
		mysql_query ( "SET names utf8" );
		return $this->Catproduct->find ( 'all', array (
				'conditions' => array (
						'Catproduct.status' => 1,
						'Catproduct.id' => $id 
				),
				'order' => 'Catproduct.id ASC' 
		) );
	}
	function categoryproduct() {
		mysql_query ( "SET names utf8" );
		return $this->Catproduct->find ( 'all', array (
				'conditions' => array (
						'Catproduct.status' => 1,
						'Catproduct.parent_id' => NULL 
				),
				'order' => 'Catproduct.id ASC' 
		) );
	}
	function categoryproductchild($id = null) {
		mysql_query ( "SET names utf8" );
		return $this->Catproduct->find ( 'all', array (
				'conditions' => array (
						'Catproduct.status' => 1,
						'Catproduct.parent_id' => $id 
				),
				'order' => 'Catproduct.id ASC' 
		) );
	}
	function get_shop_id($name) {
		return $this->Shop->find ( 'list', array (
				'conditions' => array (
						'Shop.name' => $name,
						'Shop.status' => 1 
				),
				'fields' => array (
						'id',
						'created' 
				) 
		) );
	}
	function raovat($shop_id = null) {
		if ($shop_id == null)
			return $this->Newshop->find ( 'all', array (
					'conditions' => array (
							'Newshop.categorynewsshop_id' => 221,
							'Newshop.status' => 1 
					),
					'order' => 'Newshop.id DESC' 
			) );
		
		return $this->Newshop->find ( 'all', array (
				'conditions' => array (
						'Newshop.shop_id' => $shop_id,
						'Newshop.categorynewsshop_id' => 221,
						'Newshop.status' => 1 
				),
				'limit' => 3,
				'order' => 'Newshop.id DESC' 
		) );
	}
	function get_user_id($shop_id) {
		
		
		
		return $this->Shop->find ( 'all', array (
				'conditions' => array (
						'Shop.id' => $shop_id,
						'Shop.status' => 1 
				) 
		) );
	}
	function get_banner($user_id = null) {
		return $this->Banner->find ( 'all', array (
				'conditions' => array (
						'Banner.user_id' => $user_id 
				),
				'limit' => 1,
				'order' => 'Banner.id DESC' 
		) );
	}
	function get_tem($user_id = null) {
		return $this->Tem->find ( 'all', array (
				'conditions' => array (
						'Tem.user_id' => $user_id 
				),
				'limit' => 1 
		) );
	}
	function gianhang_nb() {
		return $this->Shop->find ( 'all', array (
				'conditions' => array (
						'Shop.loai' => 1 
				),
				'order' => 'Shop.created DESC' 
		) );
	}
	function sp_gianhang_nb($shop_id = null) {
		return $this->Productshop->find ( 'all', array (
				'conditions' => array (
						'Productshop.shop_id' => $shop_id 
				),
				'limit' => 1,
				'order' => 'Productshop.created' 
		) );
	}
	function kt_shop($id = null) {
		$this->Shop->find ( 'all', array (
				'conditions' => array (
						'Shop.id' => $id,
						'Shop.status' => 1,
						'Shop.loai' => 1 
				),
				'limit' => 1 
		) );
		return $this->Shop->getNumrows ();
	}
	function get_name_shop($id = null) {
		return $this->Shop->find ( 'list', array (
				'conditions' => array (
						'Shop.id' => $id,
						'Shop.status' => 1 
				),
				'limit' => 1,
				'fields' => array (
						'name' 
				) 
		) );
	}
	function get_shop_theo_ten($name) {
		return $this->Shop->find ( 'all', array (
				'conditions' => array (
						'Shop.name' => $name,
						'Shop.status' => 1 
				) 
		) );
	}
	function gianhangnoibat() {
		return $this->Shop->find ( 'all', array (
				'conditions' => array (
						'Shop.loai' => 1,
						'Shop.status' => 1 
				),
				'limit' => 10 
		) );
	}
	function get_product($id = null) {
		return $this->Product->findById ( $id );
	}
	function get_user($name = null) {
		return $this->Userscm->findByShopname ( $name );
	}
	function giohang($name = null) {
		return count ( $this->Order->find ( 'all', array (
				'conditions' => array (
						'Order.nameuser' => $name 
				) 
		) ) );
	}
	function check_shop($user) {
		// pr($this->Shop->findByUser_id($user)); die;
		$a = $this->Shop->find ( 'all', array (
				'conditions' => array (
						'Shop.user_id' => $user 
				) 
		) );
		if (count ( $a ) == 0)
			return 0;
		return 1;
	}
}

?>
