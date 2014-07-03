<?php
class DoannamController extends AppController {
	var $name = 'Doannam';
	var $uses = array (
			'Product',
			'Tems',
			'Shop',
			'Newshop',
			'Productshop',
			'Categoryshop',
			'Userscms',
			'Classifiedss',
			'Banner',
			'Background' 
	);
	var $helpers = array (
			'Html',
			'Form',
			'Javascript' 
	);
	function index() {
		$pizza = $_GET ['url'];
		$urlshop = explode ( '/', $pizza );
		$geturl = $urlshop [0];
		
		$sang = $this->Tems->find ( 'all' );
		$this->layout = 'themeshop/template';
		$this->set ( 'title_for_layout', 'Trang chủ' );
		$user = $this->Session->read ( 'id' );
		$temshop = $this->Shop->findAllByName ( $geturl );
		$idshop = $temshop [0] ['Shop'] ['id'];
		$this->Session->write ( 'menu', 'home' );
		// $this->set('menu','home');
		
		$this->paginate = array (
				'conditions' => array (
						'Productshop.status' => 1,
						'Productshop.shop_id' => $idshop 
				),
				'order' => 'Productshop.id DESC',
				'limit' => 9 
		);
		$this->set ( 'productshop', $this->paginate ( 'Productshop', array () ) );
	}
	function tin_tuc() {
		$this->Session->write ( 'menu', 'tintuc' );
		// $this->set('menu','tintuc');
		$pizza = $_GET ['url'];
		$urlshop = explode ( '/', $pizza );
		$geturl = $urlshop [0];
		$temshop = $this->Shop->findAllByName ( $geturl );
		$sang = $this->Tems->find ( 'all' );
		$this->layout = 'themeshop/template';
		$this->set ( 'title_for_layout', 'Tin tức - ' . $temshop [0] ['Shop'] ['namecompany'] );
		$user = $this->Session->read ( 'id' );
		
		$idshop = $temshop [0] ['Shop'] ['id'];
		$this->paginate = array (
				'conditions' => array (
						'Newshop.shop_id' => $idshop,
						'Newshop.categorynewsshop_id' => 219,
						'Newshop.status' => 1 
				),
				'limit' => '8',
				'order' => 'Newshop.id DESC' 
		);
		$this->set ( 'newshop', $this->paginate ( 'Newshop', array () ) );
	}
	function khuyen_mai() {
		$this->Session->write ( 'menu', 'khuyenmai' );
		// $this->set('menu','khuyenmai');
		$pizza = $_GET ['url'];
		$urlshop = explode ( '/', $pizza );
		$geturl = $urlshop [0];
		$temshop = $this->Shop->findAllByName ( $geturl );
		$sang = $this->Tems->find ( 'all' );
		$this->layout = 'themeshop/template';
		$this->set ( 'title_for_layout', 'Tin khuyến mại - ' . $temshop [0] ['Shop'] ['namecompany'] );
		$user = $this->Session->read ( 'id' );
		
		$idshop = $temshop [0] ['Shop'] ['id'];
		$this->paginate = array (
				'conditions' => array (
						'Newshop.shop_id' => $idshop,
						'Newshop.categorynewsshop_id' => 220,
						'Newshop.status' => 1 
				),
				'limit' => '8',
				'order' => 'Newshop.id DESC' 
		);
		$this->set ( 'khuyenmai', $this->paginate ( 'Newshop', array () ) );
	}
	function chi_tiet_tin_tuc($id = null) {
		$sang = $this->Tems->find ( 'all' );
		$this->layout = 'themeshop/template';
		$this->set ( 'title_for_layout', 'Chi tiết tin' );
		if (! $id) {
			$this->Session->setFlash ( __ ( 'Không t?n t?i', true ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		$x = $this->Newshop->read ( null, $id );
		$this->set ( 'views', $x );
		$this->set ( 'list_others', $this->Newshop->find ( 'all', array (
				'conditions' => array (
						'Newshop.status' => 1,
						'Newshop.categorynewsshop_id' => $x ['Newshop'] ['categorynewsshop_id'],
						'Newshop.id <>' => $id 
				),
				'limit' => 10 
		) ) );
	}
	// hien thi san phan trong gian hang
	function san_pham() {
		$this->Session->write ( 'menu', 'sanpham' );
		// $this->set('menu','sanpham');
		$this->set ( 'title_for_layout', 'Sản phẩm' );
		$pizza = $_GET ['url'];
		$urlshop = explode ( '/', $pizza );
		$geturl = $urlshop [0];
		$temshop = $this->Shop->findAllByName ( $geturl );
		$sang = $this->Tems->find ( 'all' );
		$this->layout = 'themeshop/template';
		$this->set ( 'title_for_layout', 'Sản phẩm - ' . $temshop [0] ['Shop'] ['namecompany'] );
		$user = $this->Session->read ( 'id' );
		// ----------------------------------
		
		$idshop = $temshop [0] ['Shop'] ['id'];
		$product_shop = $this->Productshop->find ( 'all', array (
				'conditions' => array (
						'Productshop.status' => 1,
						'Productshop.shop_id' => $idshop 
				),
				'order' => 'Productshop.id DESC',
				'limit' => 9 
		) );
		$this->set ( 'productshop', $product_shop );
	}
	
	// cai dat giao dien
	function bannerheader() {
		$sang = $this->Tems->find ( 'all' );
		$this->layout = 'themeshop/template';
		$sangurl = $_SERVER ['REQUEST_URI'];
		$url = explode ( "/", $sangurl );
		$geturl = $url [2];
		$temshop = $this->Shop->findAllByName ( $geturl );
		$idshop = $temshop [0] ['Shop'] ['user_id'];
		return $this->Banner->find ( 'all', array (
				'conditions' => array (
						'Banner.user_id' => $idshop 
				),
				'order' => 'Banner.id DESC',
				'limit' => 1 
		) );
	}
	function background() {
		$sang = $this->Tems->find ( 'all' );
		$this->layout = 'themeshop/template';
		$sangurl = $_SERVER ['REQUEST_URI'];
		$url = explode ( "/", $sangurl );
		$geturl = $url [2];
		$temshop = $this->Shop->findAllByName ( $geturl );
		$idshop = $temshop [0] ['Shop'] ['user_id'];
		return $this->Background->find ( 'all', array (
				'conditions' => array (
						'Background.user_id' => $idshop 
				),
				'order' => 'Background.id DESC',
				'limit' => 1 
		) );
	}
	function raovatnews() {
		$sang = $this->Tems->find ( 'all' );
		$this->layout = 'themeshop/template';
		$sangurl = $_SERVER ['REQUEST_URI'];
		$url = explode ( '/', $sangurl );
		$geturl = $url [2];
		$temshop = $this->Shop->findAllByName ( $geturl );
		$idshop = $temshop [0] ['Shop'] ['user_id'];
		return $temshop = $this->Classifiedss->find ( 'all', array (
				'conditions' => array (
						'Classifiedss.status' => 1,
						'Classifiedss.user_id' => $idshop 
				),
				'order' => 'Classifiedss.id DESC',
				'limit' => 7 
		) );
	}
	function chi_tiet_rao_vat($id = null) {
		$sang = $this->Tems->find ( 'all' );
		$this->layout = 'themeshop/template';
		if (! $id) {
			$this->Session->setFlash ( __ ( 'Không t?n t?i', true ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		$x = $this->Classifiedss->read ( null, $id );
		$this->set ( 'views', $x );
		$this->set ( 'list_others', $this->Classifiedss->find ( 'all', array (
				'conditions' => array (
						'Classifiedss.status' => 1,
						'Classifiedss.scop_id' => $x ['Classifiedss'] ['scop_id'],
						'Classifiedss.id <>' => $id 
				),
				'limit' => 10 
		) ) );
	}
	function search($search_name = null) {
		$pizza = $_GET ['url'];
		$urlshop = explode ( '/', $pizza );
		$geturl = $urlshop [0];
		
		$sang = $this->Tems->find ( 'all' );
		$this->layout = 'themeshop/template';
		$this->set ( 'title_for_layout', '' );
		$user = $this->Session->read ( 'id' );
		// ----------------------------------
		$temshop = $this->Shop->findAllByName ( $geturl );
		$idshop = $temshop [0] ['Shop'] ['id'];
		$product_shop = $this->Productshop->find ( 'all', array (
				'conditions' => array (
						'Productshop.status' => 1,
						'Productshop.shop_id' => $idshop,
						'Productshop.title like' => '%' . $search_name . '%' 
				),
				'order' => 'Productshop.id DESC',
				'limit' => 9 
		) );
		$this->set ( 'search', $product_shop );
	}
	
	// list product
	function danh_sach_san_pham($id = null) {
		$this->Session->write ( 'menu', 'sanpham' );
		// $this->set('menu','sanpham');
		$pizza = $_GET ['url'];
		$urlshop = explode ( '/', $pizza );
		$geturl = $urlshop [0];
		
		$sang = $this->Tems->find ( 'all' );
		$this->layout = 'themeshop/template';
		$this->set ( 'title_for_layout', 'Danh sách sản phẩm' );
		$user = $this->Session->read ( 'id' );
		$temshop = $this->Shop->findAllByName ( $geturl );
		$idshop = $temshop [0] ['Shop'] ['id'];
		if ($id == null)
			$this->paginate = array (
					'conditions' => array (
							'Productshop.status' => 1,
							'Productshop.shop_id' => $idshop 
					),
					'order' => 'Productshop.id DESC',
					'limit' => 9 
			);
		else
			$this->paginate = array (
					'conditions' => array (
							'Productshop.status' => 1,
							'Productshop.categoryshop_id' => $id,
							'Productshop.shop_id' => $idshop 
					),
					'order' => 'Productshop.id DESC',
					'limit' => 9 
			);
		$this->set ( 'productshop', $this->paginate ( 'Productshop', array () ) );
		
		$cat = $this->Categoryshop->read ( null, $id );
		$this->set ( 'catid', $cat );
	}
	function chi_tiet_san_pham($id = null) {
		$this->Session->write ( 'menu', 'sanpham' );
		// $this->set('menu','sanpham');
		$sang = $this->Tems->find ( 'all' );
		$this->layout = 'themeshop/template';
		$this->set ( 'title_for_layout', 'Chi tiết sản phẩm' );
		if (! $id) {
			$this->Session->setFlash ( __ ( 'Không t?n t?i', true ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		$x = $this->Productshop->read ( null, $id );
		$this->set ( 'views', $x );
		$this->set ( 'list_others', $this->Productshop->find ( 'all', array (
				'conditions' => array (
						'Productshop.status' => 1,
						'Productshop.categoryshop_id' => $x ['Productshop'] ['categoryshop_id'],
						'Productshop.id <>' => $id 
				),
				'limit' => 10 
		) ) );
	}
	function chinh_sach() {
		$sang = $this->Tems->find ( 'all' );
		$this->layout = 'themeshop/template';
		$this->set ( 'title_for_layout', '' );
	}
	function ban_do() {
		$sang = $this->Tems->find ( 'all' );
		$this->layout = 'themeshop/template';
		$this->set ( 'title_for_layout', '' );
	}
	function gioi_thieu() {
		$this->Session->write ( 'menu', 'gioithieu' );
		// $this->set('menu','gioithieu');
		
		$pizza = $_GET ['url'];
		$urlshop = explode ( '/', $pizza );
		$geturl = $urlshop [0];
		$this->set ( 'title_for_layout', 'Giới thiệu' );
		$sang = $this->Tems->find ( 'all' );
		$this->layout = 'themeshop/template';
		
		$temshop = $this->Shop->findAllByName ( $geturl );
		$idshop = $temshop [0] ['Shop'] ['id'];
		$temshop = $this->Shop->find ( 'all', array (
				'conditions' => array (
						'Shop.status' => 1,
						'Shop.id' => $idshop 
				),
				'order' => 'Shop.id DESC' 
		) );
		$this->set ( 'title_for_layout', 'Giới thiệu - ' . $temshop [0] ['Shop'] ['namecompany'] );
		$this->set ( 'gioithoi', $temshop );
	}
	function lien_he() {
		$this->Session->write ( 'menu', 'lienhe' );
		
		$this->set ( 'title_for_layout', 'Liên hệ' );
		$sang = $this->Tems->find ( 'all' );
		$this->layout = 'themeshop/template';
		// hien ti thong tin shop
		$pizza = $_GET ['url'];
		$urlshop = explode ( '/', $pizza );
		$geturl = $urlshop [0];
		$temshop = $this->Shop->findAllByName ( $geturl );
		$idshop = $temshop [0] ['Shop'] ['id'];
		$temshop = $this->Shop->find ( 'all', array (
				'conditions' => array (
						'Shop.status' => 1,
						'Shop.id' => $idshop 
				),
				'order' => 'Shop.id DESC' 
		) );
		$this->set ( 'infomationshop', $temshop );
		$this->set ( 'title_for_layout', 'Liên hệ - ' . $temshop [0] ['Shop'] ['namecompany'] );
	}
	function send() {
		$sang = $this->Tems->find ( 'all' );
		$this->layout = 'themeshop/template';
		// hien ti thong tin shop
		$pizza = $_GET ['url'];
		$urlshop = explode ( '/', $pizza );
		$geturl = $urlshop [0];
		$temshop = $this->Shop->findAllByName ( $geturl );
		$idshop = $temshop [0] ['Shop'] ['id'];
		$temshop = $this->Shop->find ( 'all', array (
				'conditions' => array (
						'Shop.status' => 1,
						'Shop.id' => $idshop 
				),
				'order' => 'Shop.id DESC' 
		) );
		$emailshop = $temshop [0] ['Shop'] ['email'];
		// cau hinh gui mail
		mysql_query ( 'SET NAMES utf8' );
		mysql_query ( 'SET character_set_client=utf8' );
		mysql_query ( 'SET character_set_connection=utf8' );
		if (isset ( $_POST ['name'] )) {
			$name = $_POST ['name'];
			$mobile = $_POST ['phone'];
			$email = $_POST ['email'];
			$title = $_POST ['title'];
			$content = $_POST ['content'];
			
			$this->Email->from = $name . '<' . $email . '>';
			$this->Email->to = $emailshop;
			$this->Email->subject = $title;
			$this->Email->template = 'default';
			$this->Email->sendAs = 'both';
			$this->set ( 'name', $name );
			$this->set ( 'mobile', $mobile );
			$this->set ( 'email', $email );
			$this->set ( 'content', $content );
			
			if ($this->Email->send ()) {
				$this->Session->setFlash ( __ ( 'Thêm m?i danh m?c thành công', true ) );
				echo '<script language="javascript"> alert("G?i email thành công"); location.href=' . DOMAIN . ';</script>';
			} else
				$this->Session->setFlash ( __ ( "Thêm moi danh m?c th?t b?i. Vui long th? l?i", true ) );
			echo '<script language="javascript"> alert("g?i email không thành công"); location.href=' . DOMAIN . ';</script>';
		}
	}
	
	// sidebar phai
	function helponline() {
		$sangurl = $_SERVER ['REQUEST_URI'];
		$url = explode ( '/', $sangurl );
		$geturl = $url [2];
		$temshop = $this->Shop->findAllByName ( $geturl );
		$idshop = $temshop [0] ['Shop'] ['user_id'];
		return $temshop = $this->Userscms->find ( 'all', array (
				'conditions' => array (
						'Userscms.id' => $idshop 
				),
				'order' => 'Userscms.id DESC' 
		) );
	}
	
	// danh muc menu ben trai
	function categoryproduct() {
		$sangurl = $_SERVER ['REQUEST_URI'];
		$url = explode ( '/', $sangurl );
		$geturl = $url [2];
		$temshop = $this->Shop->findAllByName ( $geturl );
		$idshop = $temshop [0] ['Shop'] ['id'];
		return $this->Categoryshop->find ( 'all', array (
				'conditions' => array (
						'Categoryshop.status' => 1,
						'Categoryshop.shop_id' => $idshop 
				),
				'order' => 'Categoryshop.id DESC' 
		) );
	}
	function categoryproductsub($id = null) {
		$sangurl = $_SERVER ['REQUEST_URI'];
		$url = explode ( '/', $sangurl );
		$geturl = $url [2];
		$temshop = $this->Shop->findAllByName ( $geturl );
		$idshop = $temshop [0] ['Shop'] ['id'];
		return $this->Categoryshop->find ( 'all', array (
				'conditions' => array (
						'Categoryshop.status' => 1,
						'Categoryshop.parent_id' => $id,
						'Categoryshop.shop_id' => $idshop 
				),
				'order' => 'Categoryshop.id DESC' 
		) );
	}
}

?>
