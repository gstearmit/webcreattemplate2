<?php
define('DOMAINAD','http://'.$_SERVER["HTTP_HOST"].'/freemobiweb.mobi/admin/');
define('DOMAINADBUSINISS','http://'.$_SERVER["HTTP_HOST"].'/freemobiweb.mobi/businessadmin/');
define('DOMAINADESTORE','http://'.$_SERVER["HTTP_HOST"].'/freemobiweb.mobi/estoreadmin/');
define('DOMAIN','http://'.$_SERVER["HTTP_HOST"].'/freemobiweb.mobi/');

define('GUSER', 'alatcas1@gmail.com'); // tài khoản đăng nhập Gmail
define('GPWD', '1alatca*@!123'); // mật khẩu cho cái mail này
define('Username', "root"); 
define('Password', ''); 
define('IP_SERVER_TEST', '127.0.0.1'); // 124.158.4.86 : TESTTING
define('Server_ip', "124.158.4.86");
define('Server_login', "admin");
define('server_pass', "86a@86ab");

//
//define('DOMAINAD','http://'.$_SERVER["HTTP_HOST"].'/admin/');
//define('DOMAIN','http://'.$_SERVER["HTTP_HOST"].'/');

//define('DOCUMENT_ROOT','/home/develop/public_html/freemobiweb.mobi/');
//define('GIANHANG','/home/develop/public_html/freemobiweb.mobi/app/webroot/img-gianhang/');
define('DOCUMENT_ROOT','E:/xampp/htdocs/freemobiweb.mobi/');
define('GIANHANG','E:/xampp/htdocs/freemobiweb.mobi/app/webroot/img-gianhang/');

// Cau hinh thong tin Admin gui mail active thành Viên
// //define('ADDRESS_EMAIL_SEND_ACTIVE','gstearit@gmail.com');
// define('ADDRESS_EMAIL_SEND_ACTIVE','phuca4@gmail.com');
// define('FROM_NAME_EMAIL_ACTIVE','Ban quản tri WEBSITECREAT TEMPLATE');
// define('SUBJECT_EMAIL_ACTIVE','Kích hoạt tài khoản thành viên freemobiweb.mobi');
// define('SUBJECT_EMAIL','Thông báo đăng tin freemobiweb.mobi');
// define('SUBJECT_EMAIL_NEWS','Xác Nhận đăng tin freemobiweb.mobi');
// define('SUBJECT_CONFIRM','Xác nhận thông tin WEBSITECREAT tới freemobiweb.mobi');
// define('SUBJECT_NEWS','Xác Nhận Thông tin kích hoạt tin tiếp tục tới freemobiweb.mobi');
// define('SUBJECT_SEND_MAIL',' Nội Dung Thư gửi ');
// define('SUBJECT_EMAIL_CHANGE_PASS','Hưỡng dãn lấy mật khẩu thành viên');
// define('FROM_NAME_EMAIL_SEND','Báo Cáo của  freemobiweb.mobi');
// define('SUBJECT','Gửi tới bạn');

function selectField($array,$name){
	if($name!=null){
		if(isset($array[$name])){
			return $array[$name];
		}else{
			return null;
		}
	}
	else{
		return null;
	}
}

