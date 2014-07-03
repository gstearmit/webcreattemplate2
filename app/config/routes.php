<?php

	Router::connect('/', array('controller' => 'home', 'action' => 'index'));	
    Router::connect('/business-websites', array('controller' => 'home', 'action' => 'businesswebsites'));
    Router::connect('/e-commerce', array('controller' => 'home', 'action' => 'ecommerce'));
    Router::connect('/personal-websites', array('controller' => 'home', 'action' => 'personalwebsites'));
    Router::connect('/sign-in', array('controller' => 'home', 'action' => 'signin'));
    Router::connect('/launch-your-site', array('controller' => 'home', 'action' => 'launchyoursite'));
   
	Router::connect('/home/*', array('controller' => 'home', 'action' => 'index'));
	Router::connect('/dang-ky-email', array('controller' => 'home', 'action' => 'register'));
	Router::connect('/tieu-dung', array('controller' => 'listproduct', 'action' => 'tieudung'));
	Router::connect('/san-pham-con-ban', array('controller' => 'listproduct', 'action' => 'index'));
	Router::connect('/dang-ky', array('controller' => 'userscms', 'action' => 'index'));
	Router::connect('/dang-nhap', array('controller' => 'login', 'action' => 'index'));
	Router::connect('/san-pham/*', array('controller' => 'product', 'action' => 'index'));
	Router::connect('/dat-mua/*', array('controller' => 'product', 'action' => 'datmua'));
	Router::connect('/don-hang', array('controller' => 'product', 'action' => 'datmua3'));
	
	Router::connect('/du-lich', array('controller' => 'listproduct', 'action' => 'dulich'));
	Router::connect('/gian-hang/*', array('controller' => 'gianhang', 'action' => 'index'));
	Router::connect('/gian-hang', array('controller' => 'gianhang', 'action' => 'index'));
	
	Router::connect('/quen-mat-khau.html', array('controller' => 'userscms', 'action' => 'forgot_password'));
	Router::connect('/thanh-vien', array('controller' => 'registrationshop', 'action' => 'account'));
	Router::connect('/dang-ky-mo-gian-hang', array('controller' => 'registrationshop', 'action' => 'index'));
	
	Router::connect('/quen-mat-khau.html', array('controller' => 'userscms', 'action' => 'forgot_password'));
	Router::connect('/gioi-thieu-cong-ty', array('controller' => 'registrationshop', 'action' => 'editshop'));
	Router::connect('/thong-tin-cong-ty', array('controller' => 'registrationshop', 'action' => 'profile'));
	Router::connect('/thay-doi-thong-tin', array('controller' => 'registrationshop', 'action' => 'editshop'));
	Router::connect('/tro-giup', array('controller' => 'introductions', 'action' => 'index'));
	Router::connect('/lien-he', array('controller' => 'contacts', 'action' => 'send'));
	Router::connect('/thanh-vien', array('controller' => 'registrationshop', 'action' => 'account'));
	Router::connect('/dang-ky-mo-gian-hang', array('controller' => 'registrationshop', 'action' => 'index'));
	// Dang ki gian hang
	//Router::connect('/register-department', array('controller' => 'registrationshop', 'action' => 'index'));
	
	// san pham cua gian hang
	Router::connect('/quan-ly-danh-muc-san-pham', array('controller' => 'categoryshop', 'action' => 'index'));
	Router::connect('/sua-danh-muc/*', array('controller' => 'categoryshop', 'action' => 'edit'));
	Router::connect('/quan-ly-san-pham', array('controller' => 'productshop', 'action' => 'index'));
	Router::connect('/them-moi-san-pham/*', array('controller' => 'productshop', 'action' => 'add'));
	Router::connect('/sua-san-pham/*', array('controller' => 'productshop', 'action' => 'edit'));
	//------------tin tuc cua gian hang--------------------
	Router::connect('/tin-tuc-cong-ty', array('controller' => 'newsshop', 'action' => 'index'));
	Router::connect('/them-moi-tin/*', array('controller' => 'newsshop', 'action' => 'add'));
	Router::connect('/them-moi-danh-muc-tin', array('controller' => 'newsshop', 'action' => 'addcategory'));
	Router::connect('/cai-dat-banner', array('controller' => 'banner', 'action' => 'index'));
	Router::connect('/cai-dat-background', array('controller' => 'background', 'action' => 'index'));
	
	Router::connect('/cai-dat-giao-dien', array('controller' => 'temshop', 'action' => 'index'));	
	Router::connect('/quan-ly-tin-rao-vat', array('controller' => 'classifiedss', 'action' => 'index'));
	Router::connect('/thay-doi-mat-khau', array('controller' => 'userscms', 'action' => 'change_pass'));
	Router::connect('/ho-so', array('controller' => 'userscms', 'action' => 'edit_profile'));
	
	Router::connect('/san-pham-gian-hang', array('controller' => 'listproduct', 'action' => 'spgh'));
	
	//-------------------------------------------------------------------------------------------------------------
	Router::connect('/signups', array('controller' => 'signups', 'action' => 'add'));
	//-----------------------------------------store----------------------------------------------------------------------
	Router::connect('/register-store-1', array('controller' => 'registerstore', 'action' => 'index'));
	

	
// 	Router::connect('/packing-and-loanding', array('controller' => 'news', 'action' => 'packing'));
// 	Router::connect('/khuyen-mai', array('controller' => 'news', 'action' => 'khuyenmai'));
// 	Router::connect('/ban-do', array('controller' => 'news', 'action' => 'map'));
// 	Router::connect('/chinh-sach-khach-hang', array('controller' => 'news', 'action' => 'chinhsach'));
// 	Router::connect('/tin-tuc/chi-tiet-tin/*', array('controller' => 'news', 'action' => 'view'));
// 	Router::connect('/gioi-thieu/*', array('controller' => 'introductions', 'action' => 'index'));
// 	Router::connect('/tuyen-dung', array('controller' => 'news', 'action' => 'recruitment'));
// 	Router::connect('/lien-he-mua-hang', array('controller' => 'products', 'action' => 'buy'));
// 	Router::connect('/san-pham', array('controller' => 'products', 'action' => 'index'));
	
// 	Router::connect('/danh-sach-san-pham/*', array('controller' => 'products', 'action' => 'listproduct'));
// 	Router::connect('/chi-tiet-san-pham/*', array('controller' => 'products', 'action' => 'view'));
// 	Router::connect('/mua-hang/*', array('controller' => 'products', 'action' => 'addshopingcart'));
// 	Router::connect('/hien-gio-hang-cua-mat-hang', array('controller' => 'products', 'action' => 'viewshopingcart'));
//     Router::connect('/tim-kiem', array('controller' => 'search', 'action' => 'search'));
// 	Router::connect('/binh-chon', array('controller' => 'polls', 'action' => 'index'));
// 	Router::connect('/thu-vien-anh', array('controller' => 'gallery', 'action' => 'index'));
// 	Router::connect('/dang-ky', array('controller' => 'user', 'action' => 'index'));
// 	Router::connect('/dang-nhap', array('controller' => 'login', 'action' => 'index'));
// 	 Router::connect('/lien-he', array('controller' => 'contacts', 'action' => 'send'));
	 
	
/**products/viewshopingcart

 * ...and connect the rest of 'Pages' controller's urls.
 */
	//Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
