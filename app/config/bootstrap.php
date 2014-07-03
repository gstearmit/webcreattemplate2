<?php
define('DOMAINAD','http://'.$_SERVER["HTTP_HOST"].'/websitetemplate/admin/');
define('DOMAIN','http://'.$_SERVER["HTTP_HOST"].'/websitetemplate/');

//define('DOMAINAD','http://'.$_SERVER["HTTP_HOST"].'/admin/');
//define('DOMAIN','http://'.$_SERVER["HTTP_HOST"].'/');

//define('DOCUMENT_ROOT','/home/develop/public_html/websitetemplate/');
//define('GIANHANG','/home/develop/public_html/websitetemplate/app/webroot/img-gianhang/');
define('DOCUMENT_ROOT','E:/xampp/htdocs/websitetemplate/');
define('GIANHANG','E:/xampp/htdocs/websitetemplate/websitetemplate/app/webroot/img-gianhang/');

define('GUSER', 'phuca4@gmail.com');
define('GPWD', 'ngoc875052phuca4');
// Cau hinh thong tin Admin gui mail active thành Viên
//define('ADDRESS_EMAIL_SEND_ACTIVE','gstearit@gmail.com');
define('ADDRESS_EMAIL_SEND_ACTIVE','phuca4@gmail.com');
define('FROM_NAME_EMAIL_ACTIVE','Ban quản tri WEBSITECREAT TEMPLATE');
define('SUBJECT_EMAIL_ACTIVE','Kích hoạt tài khoản thành viên websitetemplate');
define('SUBJECT_EMAIL','Thông báo đăng tin websitetemplate');
define('SUBJECT_EMAIL_NEWS','Xác Nhận đăng tin websitetemplate');
define('SUBJECT_CONFIRM','Xác nhận thông tin WEBSITECREAT tới websitetemplate');
define('SUBJECT_NEWS','Xác Nhận Thông tin kích hoạt tin tiếp tục tới websitetemplate');
define('SUBJECT_SEND_MAIL',' Nội Dung Thư gửi ');
define('SUBJECT_EMAIL_CHANGE_PASS','Hưỡng dãn lấy mật khẩu thành viên');
define('FROM_NAME_EMAIL_SEND','Báo Cáo của  websitetemplate');
define('SUBJECT','Gửi tới bạn');

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

