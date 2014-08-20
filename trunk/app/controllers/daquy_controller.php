<?php
class DaquyController extends AppController {
	var $name = 'Daquy';
	var $shopname = 'daquy';
	var $components = array('Email');
	var $uses = array (
			'Shop',
            'Eshopdaquycategory2',
 			'Eshopdaquyuser',
		    'Eshopdaquyproduct',
			'Eshopdaquycatproduct',
			'Eshopdaquysetting',
			'Eshopdaquyadvertisement',
			'Eshopdaquycategory',
			'Eshopdaquyslideshow',
			'Eshopdaquyvideo',
			'Eshopdaquyhelps',
			'Eshopdaquynew',
			'Eshopdaquypartner',
 			'Eshopdaquygallery',
 			'Eshopdaquybanner',
			'Eshopdaquypoll',
			'Eshopdaquycontacts',	
		);
	function loadModelNew($Model) {
		// ++++++++++++connection data +++++++++++++++++
		
		//++++++++++++connection data +++++++++++++++++
		$nameeshop = $this->shopname;
		$shop_id = 275; //$this->Session->read("id");
		$shoparr = $this->Shop->find ( 'all', array (
				'conditions' => array (
						'Shop.id' => $shop_id,
						'Shop.name' => $nameeshop,
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
			
		if(is_array($shoparr) and !empty($shoparr))
		{
			foreach($shoparr as $shop){
				$databasename = $shop['Shop']['databasename'];
				$password = $shop['Shop']['password'];
				$username = $shop['Shop']['username'];
				$hostname = $shop['Shop']['hostname'];
				$shop_id = $shop['Shop']['id'];
				$nameproject = $shop['Shop']['name'];           // $nameproject is name Ctronller
				$email = trim($shop['Shop']['email']);
				$userpass = $shop['Shop']['userpass'];
			}
		}
// 		$hostname = 'localhost';
// 		$username = 'root';
// 		$databasename = 'eshopdaquy';
// 		$password = '';
		
		$this->$Model->setDataEshop ( $hostname, $username, $password, $databasename );
	}
	
	// +++++++++++++++Comments+++++++++++++++++++++++++
	function tintucnoibat() {
		$this->loadModelNew('Eshopdaquynew');
		$this->set ( 'shopname', $this->shopname );
		$this->layout = 'themeshop/daquy';
		mysql_query ( "SET names utf8" );
		return $this->Eshopdaquynew->find ( 'all', array (
				'conditions' => array (
						'Eshopdaquynew.status' => 1,
						'Eshopdaquynew.category_id' => 201 
				),
				'order' => 'Eshopdaquynew.id DESC',
				'limit' => 4 
		) );
	}
	function categoryproduct() {
	    $this->set ( 'shopname', $this->shopname );
		//$this->layout = 'themeshop/eshopdaquy';
	    $this->loadModelNew('Eshopdaquycatproduct');
		mysql_query ( "SET names utf8" );
		return $this->Eshopdaquycatproduct->find ( 'all', array (
				'conditions' => array (
						'Eshopdaquycatproduct.status' => 1,
						'Eshopdaquycatproduct.parent_id' => NULL 
				),
				'order' => 'Eshopdaquycatproduct.order ASC' 
		) );
	}
	
	// tin thuoc danh muc
	function submenuproduct($id = null) { 
	    $this->set ( 'shopname', $this->shopname );
		//$this->layout = 'themeshop/eshopdaquy';
	    $this->loadModelNew('Eshopdaquycatproduct');
		return $this->Eshopdaquycatproduct->find ( 'all', array (
				'conditions' => array (
						'Eshopdaquycatproduct.parent_id ' => $id,
						'Eshopdaquycatproduct.status' => 1 
				),
				'order' => 'Eshopdaquycatproduct.order ASC' 
		) );
	}
	
	function submenuproduct1($id = null) {
	    $this->loadModelNew('Eshopdaquycatproduct');
		return $this->Eshopdaquycatproduct->find ( 'all', array (
				'conditions' => array (
						'Eshopdaquycatproduct.parent_id ' => $id,
						'Eshopdaquycatproduct.status' => 1 
				),
				'order' => 'Eshopdaquycatproduct.order ASC' 
		) );
	}
	
	//mapssetting
	function mapssetting() {
		$this->loadModelNew('Eshopdaquysetting');
		return $this->Eshopdaquysetting->find ('all');
	}
	function sanphambanchay() {
	   $this->loadModelNew('Eshopdaquycatproduct');
		mysql_query ( "SET names utf8" );
		return $this->Eshopdaquyproduct->find ( 'all', array (
				'conditions' => array (
						'Eshopdaquyproduct.status' => 1,
						'Eshopdaquyproduct.featuredproducts' => 1 
				),
				'order' => 'Eshopdaquyproduct.order ASC',
				'limit' => 10 
		) );
	}
	
	function sanphamnoibat() {
		$this->loadModelNew('Eshopdaquyproduct');
		mysql_query ( "SET names utf8" );
		return $this->Eshopdaquyproduct->find ( 'all', array (
				'conditions' => array (
						'Eshopdaquyproduct.speproduct' => 1
				),
				'order' => 'Eshopdaquyproduct.id ASC',
				'limit' => 10
		) );
	}
	function phongmau() {
	    $this->loadModelNew('Eshopdaquycatproduct');
		mysql_query ( "SET names utf8" );
		return $this->Eshopdaquycatproduct->find ( 'all', array (
				'conditions' => array (
						'Eshopdaquycatproduct.status' => 1,
						'Eshopdaquycatproduct.parent_id' => '8' 
				),
				'order' => 'Eshopdaquycatproduct.char DESC' 
		) );
	}
	function doitac() {
		$this->loadModelNew('Eshopdaquypartner');
		// return $this->Gallery->find('all',array('conditions'=>array('Gallery.status'=>1),'order'=>'Gallery.id DESC','limit'=>2));
		return $this->Eshopdaquypartner->find ( 'all', array (
				'conditions' => array (
						'Eshopdaquypartner.status' => 1 
				),
				'order' => 'Eshopdaquypartner.id DESC' 
		) );
	}
	function menu_active() {
	    $this->loadModelNew('Eshopdaquycategory2');
		return $this->Eshopdaquycategory2->find ( 'all', array (
				'conditions' => array (
						'Eshopdaquycategory2.parent_id' => 145 
				),
				'order' => 'Eshopdaquycategory2.id ASC' 
		) );
	}
	function helpsonline() {
	    $this->loadModelNew('Eshopdaquyhelps');
		return $this->Eshopdaquyhelps->find ( 'all', array (
				'conditions' => array (
						'Eshopdaquyhelps.status' => 1 
				),
				'order' => 'Eshopdaquyhelps.id DESC',
				'limit' => 4 
		) );
	}
	function id_product($id) {
	    $this->loadModelNew('Eshopdaquyproduct');
		return $this->Eshopdaquyproduct->read ( null, $id );
		// pr($this->Eshopdaquyproduct->read(null,$id));die;
	}
	function getinfo($cat = null) {
	    $this->loadModelNew('Eshopdaquynew');
		return $this->Eshopdaquynew->find ( 'all', array (
				'conditions' => array (
						'Eshopdaquynew.status' => 1,
						'Eshopdaquynew.category_id' => $cat 
				),
				'order' => 'Eshopdaquynew.id DESC',
				'limit' => 3 
		) );
	}
	function Eshopdaquynew_codong($cat = null) {
	    $this->loadModelNew('Eshopdaquynew');
		return $this->Eshopdaquynew->find ( 'all', array (
				'conditions' => array (
						'Eshopdaquynew.status' => 1,
						'Eshopdaquynew.category_id' => $cat 
				),
				'order' => 'Eshopdaquynew.id DESC',
				'limit' => 10 
		) );
	}
	function menucategory() {
	    $this->loadModelNew('Eshopdaquycategory');
		mysql_query ( "SET names utf8" );
		return $this->Eshopdaquycategory->find ( 'all', array (
				'conditions' => array (
						'Eshopdaquycategory.status' => 1,
						'Eshopdaquycategory.parent_id' => null 
				),
				'order' => 'Eshopdaquycategory.order ASC' 
		) );
		$_SESSION ['huong'] = 1;
	}
	function videos1() {
	    $this->loadModelNew('Eshopdaquyvideo');
		mysql_query ( "SET names utf8" );
		return $this->Eshopdaquyvideo->find ( 'all', array (
				'conditions' => array (
						'Eshopdaquyvideo.status' => 1 
				),
				'order' => 'Eshopdaquyvideo.id DESC',
				'limit' => 4 
		) );
	}
	function videoslish() {
	    $this->loadModelNew('Eshopdaquyvideo');
		$video = isset ( $_GET ['video'] ) ? $_GET ['video'] : '';
		mysql_query ( "SET names utf8" );
		return $this->Eshopdaquyvideo->find ( 'all', array (
				'conditions' => array (
						'Eshopdaquyvideo.status' => 1,
						'Eshopdaquyvideo.id' => $video 
				),
				'order' => 'Eshopdaquyvideo.id DESC',
				'limit' => 1 
		) );
	}
	function videoslish1() {
	    $this->loadModelNew('Eshopdaquyvideo');
		$video = isset ( $_GET ['video'] ) ? $_GET ['video'] : '';
		mysql_query ( "SET names utf8" );
		return $this->Eshopdaquyvideo->find ( 'all', array (
				'conditions' => array (),
				'order' => 'Eshopdaquyvideo.id DESC',
				'limit' => 1 
		) );
	}
	function get_video($id = null) {
	    $this->loadModelNew('Eshopdaquyvideo');
		// $id=$_GET['id'];
		$a = $this->Eshopdaquyvideo->findById ( $id );
		// echo json_encode(DOMAINAD.$a['Eshopdaquyvideo']['video']); die;
		// echo DOMAINAD.$a['Eshopdaquyvideo']['video']; die;
		echo '<embed  width="195" height="140" type="application/x-shockwave-flash" src="' . DOMAIN . 'images/mediaplayer.swf" style="" id="playlist" name="playlist" quality="high" allowfullscreen="true" wmode="transparent" flashvars="file=' . DOMAINAD . $a ['Eshopdaquyvideo'] ['video'] . '&amp;displayheight=125&amp;width=195&amp;height=140&amp;"></embed>';
		die ();
	}
	
	// --------------------End Comment ------------------------------------
	// +++++++++++++++++++++homes+++++++++++++++++++++++++++++++++++
	//quang cao left - right
	function advleft(){
		return $this->Eshopdaquyadvertisement->find('all',array('conditions'=>array('Eshopdaquyadvertisement.status'=>1,'Eshopdaquyadvertisement.display'=>0),'order'=>'Eshopdaquyadvertisement.id DESC','limit'=>1));
	}
	function advright(){
		return $this->Eshopdaquyadvertisement->find('all',array('conditions'=>array('Eshopdaquyadvertisement.status'=>1,'Eshopdaquyadvertisement.display'=>1),'order'=>'Eshopdaquyadvertisement.id DESC','limit'=>1));
	}
	
	function slideshow(){
		$this->set ( 'shopname', $this->shopname );
		$this->layout = 'themeshop/daquy';
		mysql_query("SET names utf8");
		return $this->Eshopdaquyslideshow->find('all',array('conditions'=>array('Eshopdaquyslideshow.status'=>1),'order'=>'Eshopdaquyslideshow.id DESC'));
	}
	function search($title=null) {
		$this->set ( 'shopname', $this->shopname );
		$this->layout = 'themeshop/daquy';
		$this->loadModelNew ( 'Eshopdaquyproduct' );
		mysql_query ( "SET names utf8" );
		$this->set ( 'title_for_layout', 'Search ..............' );
		$this->paginate = array (
				'conditions' => array (
						'Eshopdaquyproduct.status' => 1,
						'Eshopdaquyproduct.title like' => '%' . $title . '%' 
				),
				'order' => 'Eshopdaquyproduct.id DESC' 
		);
		$this->set ( 'products', $this->paginate ( 'Eshopdaquyproduct', array () ) );
	}
	function index() {
		$this->set ( 'shopname', $this->shopname );
		$this->layout = 'themeshop/daquy';
		//$this->layout = 'themeshop/home'; //eshopdaquy
		$this->loadModelNew ( 'Eshopdaquyproduct' );
		$this->set ( 'sanphammoi', $this->Eshopdaquyproduct->find ( 'all', array (
				'conditions' => array (
						'Eshopdaquyproduct.status' => 0 
				),
				'limit' => '6',
				'order' => 'Eshopdaquyproduct.id DESC' 
		) ) );
		
		$this->paginate = array (
				'conditions' => array (
						'Eshopdaquyproduct.status' => 1 
				),
				'limit' => '8',
				'order' => 'Eshopdaquyproduct.id DESC' 
		);
		$this->set ( 'sanphamtieubieu', $this->paginate ( 'Eshopdaquyproduct', array () ) );
		
		
	}
	function aboutus() 
	{
		$this->set ( 'shopname', $this->shopname );
		$this->layout = 'themeshop/daquy';
		$this->set ( 'shopname', $this->shopname );
		$this->loadModelNew ( 'Eshopdaquynew' );
		$about =  $this->Eshopdaquynew->find ( 'all', array (
				'conditions' => array (
						'Eshopdaquynew.status' => 1,
						'Eshopdaquynew.id' => 97 
				) 
		) );
		$this->set ( 'about', $about );
	}
	function tranhdaquy() {
		$this->set ( 'shopname', $this->shopname );
		$this->layout = 'themeshop/daquy';
	    $this->loadModelNew('Eshopdaquyproduct');
		$this->set ( 'shopname', $this->shopname );

		$this->paginate = array (
				'conditions' => array (
						'Eshopdaquyproduct.status' => 1,
						'Eshopdaquyproduct.tranhdaquy' => 1 
				),
				'limit' => '8',
				'order' => 'Eshopdaquyproduct.id DESC' 
		);
		$this->set ( 'listproducts', $this->paginate ( 'Eshopdaquyproduct', array () ) );
		
	}
	function daquytho() {
		$this->set ( 'shopname', $this->shopname );
		$this->layout = 'themeshop/daquy';
	   $this->loadModelNew('Eshopdaquyproduct');
		return $this->Eshopdaquyproduct->find ( 'all', array (
				'conditions' => array (
						'Eshopdaquyproduct.status' => 1,
						'Eshopdaquyproduct.daquytho' => 1 
				),
				'limit' => '8',
				'order' => 'Eshopdaquyproduct.id DESC' 
		) );
	}
	function daphongthuy() {
		$this->set ( 'shopname', $this->shopname );
		$this->layout = 'themeshop/daquy';
	    $this->loadModelNew('Eshopdaquyproduct');
		return $this->Eshopdaquyproduct->find ( 'all', array (
				'conditions' => array (
						'Eshopdaquyproduct.status' => 1,
						'Eshopdaquyproduct.daphongthuy' => 1 
				),
				'limit' => '8',
				'order' => 'Eshopdaquyproduct.id DESC' 
		) );
	}
	function trangsuc() {
		$this->set ( 'shopname', $this->shopname );
		$this->layout = 'themeshop/daquy';
	    $this->loadModelNew('Eshopdaquyproduct');
		return $this->Eshopdaquyproduct->find ( 'all', array (
				'conditions' => array (
						'Eshopdaquyproduct.status' => 1,
						'Eshopdaquyproduct.trangsuc' => 1 
				),
				'limit' => '8',
				'order' => 'Eshopdaquyproduct.id DESC' 
		) );
	}
	function add() {
		$this->set ( 'shopname', $this->shopname );
		$this->layout = 'themeshop/daquy';
	    $this->loadModelNew('Eshopdaquycatpoll');
		$ykien = $_POST ['ykien'];
		
		$poll = $this->Eshopdaquycatpoll->find ( 'all', array (
				'Eshopdaquycatpoll.status' => 1 
		) );
		for($i = 0; $i < count ( $poll ); $i ++) {
			if ($poll [$i] ['Eshopdaquycatpoll'] ['id'] == $ykien) {
				$poll [$i] ['Eshopdaquycatpoll'] ['count'] = $poll [$i] ['Eshopdaquycatpoll'] ['count'] + 1;
				$data ['Eshopdaquycatpoll'] = $this->data ['Eshopdaquycatpoll'];
				$data ['Eshopdaquycatpoll'] ['id'] = $ykien;
				$data ['Eshopdaquycatpoll'] ['count'] = $poll [$i] ['Eshopdaquycatpoll'] ['count'];
				if ($this->Eshopdaquycatpoll->save ( $data ['Eshopdaquycatpoll'] )) {
					$this->Session->setFlash ( __ ( 'Up thành công', true ) );
					$this->redirect ( array (
							'action' => 'index' 
					) );
				}
			}
		}
	}
	// ---------------------end homes---------------------------
	// +++++++++++++++++Eshopdaquyproduct+++++++++++++++++++++++++++++
	function indexproduct() {
		 $this->loadModelNew('Eshopdaquyproduct');
		 $this->set ( 'shopname', $this->shopname );
		 $this->layout = 'themeshop/daquy';
		// $portfolio=$this->Eshopdaquycatproduct->find('list',array('conditions'=>array('Eshopdaquycatproduct.parent_id'=>32),'fields' => array('Eshopdaquycatproduct.id')));
		$this->paginate = array (
				'conditions' => array (
						'Eshopdaquyproduct.status' => 1 
				),
				'limit' => '12',
				'order' => 'Eshopdaquyproduct.id DESC' 
		);
		$this->set ( 'listproduct', $this->paginate ( 'Eshopdaquyproduct', array () ) );
	}
	function listproduct($id = null) {
		$this->set ( 'shopname', $this->shopname );
		$this->layout = 'themeshop/daquy';
	    $this->loadModelNew('Eshopdaquycatproduct');
		$portfolio = $this->Eshopdaquycatproduct->find ( 'list', array (
				'conditions' => array (
						'Eshopdaquycatproduct.parent_id' => $id 
				), 
				'fields' => array (
						'Eshopdaquycatproduct.id' 
				)
				) );
		
		$arr [] = $id; // lưu lai id vừa so sánh
		               
		// pr($arr);
		               // pr($id);die;
		               // pr($portfolio);die;
		
		foreach ( $portfolio as $key ) {
			$arr [] = $key;
		}
		$this->loadModelNew('Eshopdaquyproduct');
		$this->paginate = array (
				'conditions' => array (
						'Eshopdaquyproduct.status' => 1,
						'Eshopdaquyproduct.catproduct_id' => $arr 
				),
				'limit' => '12',
				'order' => 'Eshopdaquyproduct.id DESC' 
		);
		$this->set ( 'listproducts', $this->paginate ( 'Eshopdaquyproduct', array () ) );
		$this->loadModelNew('Eshopdaquycatproduct');
		$this->set ( 'cat', $this->Eshopdaquycatproduct->read ( null, $id ) );
	}
	
	function tranhdaquyproduct($id = null) {
		$this->set ( 'shopname', $this->shopname );
		$this->layout = 'themeshop/daquy';
	    $this->loadModelNew('Eshopdaquyproduct');
		$this->paginate = array (
				'conditions' => array (
						'Eshopdaquyproduct.status' => 1,
						'Eshopdaquyproduct.tranhdaquy' => 1 
				),
				'limit' => '12',
				'order' => 'Eshopdaquyproduct.id DESC' 
		);
		$this->set ( 'listproduct', $this->paginate ( 'Eshopdaquyproduct', array () ) );
	}

	function daquythoproduct($id = null) {
		$this->set ( 'shopname', $this->shopname );
		$this->layout = 'themeshop/daquy';
	    $this->loadModelNew('Eshopdaquyproduct');
		$this->paginate = array (
				'conditions' => array (
						'Eshopdaquyproduct.status' => 1,
						'Eshopdaquyproduct.daquytho' => 1 
				),
				'limit' => '12',
				'order' => 'Eshopdaquyproduct.id DESC' 
		);
		$this->set ( 'listproduct', $this->paginate ( 'Eshopdaquyproduct', array () ) );
	}
	function daphongthuyproduct($id = null) {
	    $this->loadModelNew('Eshopdaquyproduct');
	    $this->set ( 'shopname', $this->shopname );
	    $this->layout = 'themeshop/daquy';
		$this->paginate = array (
				'conditions' => array (
						'Eshopdaquyproduct.status' => 1,
						'Eshopdaquyproduct.daphongthuy' => 1 
				),
				'limit' => '12',
				'order' => 'Eshopdaquyproduct.id DESC' 
		);
		$this->set ( 'listproduct', $this->paginate ( 'Eshopdaquyproduct', array () ) );
	}
	function trangsucproduct($id = null) {
	    $this->loadModelNew('Eshopdaquyproduct');
		$this->paginate = array (
				'conditions' => array (
						'Eshopdaquyproduct.status' => 1,
						'Eshopdaquyproduct.trangsuc' => 1 
				),
				'limit' => '12',
				'order' => 'Eshopdaquyproduct.id DESC' 
		);
		$this->set ( 'listproduct', $this->paginate ( 'Eshopdaquyproduct', array () ) );
	}
	function searchproduct($search_product = null) {
		$this->set ( 'shopname', $this->shopname );
		$this->layout = 'themeshop/daquy';
	    $this->loadModelNew('Eshopdaquyproduct');
		// $id = $this->Session->read('id');
		$search_product = $_POST ['search_product'];
		$this->paginate = array (
				'conditions' => array (
						'Eshopdaquyproduct.status' => 1,
						'Eshopdaquyproduct.title like' => '%' . $search_product . '%' 
				),
				'limit' => 9 
		);
		$this->set ( 'listproduct', $this->paginate ( 'Eshopdaquyproduct', array () ) );
	}
	function viewproduct($id = null) {
		$this->set ( 'shopname', $this->shopname );
		$this->layout = 'themeshop/daquy';
	    $this->loadModelNew('Eshopdaquyproduct');
		if (! $id) {
			$this->Session->setFlash ( __ ( 'Không tồn tại', true ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		
		$x = $this->Eshopdaquyproduct->read ( null, $id );
		
		$this->set ( 'views', $x );
		 $this->loadModelNew('Eshopdaquyproduct');
		$this->set ( 'list_others', $this->Eshopdaquyproduct->find ( 'all', array (
				'conditions' => array (
						'Eshopdaquyproduct.status' => 1,
						'Eshopdaquyproduct.catproduct_id' => $x ['Eshopdaquyproduct'] ['catproduct_id'],
						'Eshopdaquyproduct.id <>' => $id 
				),
				'limit' => 10 
		) ) );
	}
	function addshopingcart($id = null) {
		$this->set ( 'shopname', $this->shopname );
		$this->layout = 'themeshop/daquy';
	    $this->loadModelNew('Eshopdaquyproduct');
		$product = $this->Eshopdaquyproduct->read ( null, $id );
		/*
		 * Neu co ma san pham $shopingcart[$id]['name']=$product['Eshopdaquyproduct']['title'];
		 */
		
		if (! isset ( $_SESSION ['shopingcart'] ))
			
			$_SESSION ['shopingcart'] = array ();
		
		if (isset ( $_SESSION ['shopingcart'] )) 

		{
			$shopingcart = $_SESSION ['shopingcart'];
			
			if (isset ( $shopingcart [$id] )) 

			{
				
				echo '<script language="javascript"> if(!confirm("Da co san pham nay trong gio hang. Ban co muon tiep tuc mua san pham nay khong ?")) window.back(); </script>';
				
				$shopingcart [$id] ['sl'] = $shopingcart [$id] ['sl'] + 1;
				
				$shopingcart [$id] ['total'] = $shopingcart [$id] ['price'] * $shopingcart [$id] ['sl'];
				
				$_SESSION ['shopingcart'] = $shopingcart; // pr($_SESSION['shopingcart']); die;
				
				echo '<script language="javascript"> alert("San pham nay da duoc tang so luong them 1 chiec"); window.location.replace("' . DOMAIN . 'hien-gio-hang-cua-mat-hang"); </script>'; // co the thay DOMAIN bang url ban muon chay toi
			} 

			else 

			{
				
				// viet nam
				
				$shopingcart [$id] ['name'] = $product ['Eshopdaquyproduct'] ['title'];
				
				$shopingcart [$id] ['images'] = DOMAINAD . $product ['Eshopdaquyproduct'] ['images'];
				
				$shopingcart [$id] ['sl'] = 1;
				
				$shopingcart [$id] ['price'] = $product ['Eshopdaquyproduct'] ['price'];
				
				$shopingcart [$id] ['total'] = $shopingcart [$id] ['price'];
				
				// tieng anh
				
				$_SESSION ['shopingcart'] = $shopingcart;
				
				echo '<script language="javascript"> alert("Thêm thành công"); window.location.replace("' . DOMAIN . 'hien-gio-hang-cua-mat-hang"); </script>';
			}
		}
	}
	function viewshopingcart() {
		$this->set ( 'shopname', $this->shopname );
		$this->layout = 'themeshop/daquy';
		if (isset ( $_SESSION ['shopingcart'] )) 

		{
			
			$shopingcart = $_SESSION ['shopingcart'];
			
			$this->set ( compact ( 'shopingcart' ) );
		} 

		else 

		{
			
			echo '<script language="javascript"> alert("Chua co san pham nao trong gio hang"); window.location.replace("' . DOMAIN . '"); </script>';
		}
	}
	function deleteshopingcart($id = null) {
		$this->set ( 'shopname', $this->shopname );
		$this->layout = 'themeshop/daquy';
		if (isset ( $_SESSION ['shopingcart'] )) 

		{
			
			$shopingcart = $_SESSION ['shopingcart'];
			
			if (isset ( $shopingcart [$id] ))
				
				unset ( $shopingcart [$id] );
			
			$_SESSION ['shopingcart'] = $shopingcart;
			
			$this->redirect ( 'viewshopingcart' );
		}
	}
	function updateshopingcart($id = null) {
		$this->set ( 'shopname', $this->shopname );
		$this->layout = 'themeshop/daquy';
		if (isset ( $_SESSION ['shopingcart'] )) {
			$shopingcart = $_SESSION ['shopingcart'];
			
			if (isset ( $shopingcart [$id] )) 

			{
				
				$shopingcart [$id] ['sl'] = $_POST ['soluong'];
				
				$shopingcart [$id] ['total'] = $shopingcart [$id] ['sl'] * $shopingcart [$id] ['price'];
			}
			
			$_SESSION ['shopingcart'] = $shopingcart;
			
			$this->redirect ( 'viewshopingcart' );
		}
	}
	function buyproduct() {
		$this->set ( 'shopname', $this->shopname );
		$this->layout = 'themeshop/daquy';
		if (isset ( $_SESSION ['shopingcart'] )) 

		{
			
			$shopingcart = $_SESSION ['shopingcart'];
			
			$this->set ( compact ( 'shopingcart' ) );
		} 

		else 

		{
			
			echo '<script language="javascript"> alert("Chua co san pham nao trong gio hang"); window.location.replace("' . DOMAIN . '"); </script>';
		}
	}
	// _________________End Eshopdaquyproduct__________________________
	
	//++++++++++++++++++++++News++++++++++++++++++++++++++++++++++++++++++++
	function indexnew($id = null) {
		$this->set ( 'shopname', $this->shopname );
		$this->layout = 'themeshop/daquy';
		$this->loadModelNew('Eshopdaquycategory');
		$namenews = $this->Eshopdaquycategory->find ( 'all', array (
									'conditions' => array (
											'Eshopdaquycategory.id' => $id,
											'Eshopdaquycategory.status' => 1
									),
									'fields' => array (
											'Eshopdaquycategory.name'
									)
							) );
		$this->set ( 'namecategory', $namenews);
		$this->loadModelNew('Eshopdaquynew');
		mysql_query ( "SET names utf8" );
		$this->paginate = array (
				'conditions' => array (
						'Eshopdaquynew.status' => 1,
						'Eshopdaquynew.category_id' => $id 
				),
				'limit' => '8',
				'order' => 'Eshopdaquynew.id DESC' 
		);
		
		$this->set ( 'news', $this->paginate ( 'Eshopdaquynew', array () ) );
	}
	function buynew() {
		$this->set ( 'shopname', $this->shopname );
		$this->layout = 'themeshop/daquy';
		$this->loadModelNew('Eshopdaquynew');
		mysql_query ( "SET names utf8" );
		
		$this->paginate = array (
				'conditions' => array (
						'Eshopdaquynew.status' => 1,
						'Eshopdaquynew.category_id' => 207 
				),
				'limit' => '1',
				'order' => 'Eshopdaquynew.id DESC' 
		);
		
		$this->set ( 'news', $this->paginate ( 'Eshopdaquynew', array () ) );
	}
	function address() {
		$this->set ( 'shopname', $this->shopname );
		$this->layout = 'themeshop/daquy';
		$this->loadModelNew('Eshopdaquynew');
		mysql_query ( "SET names utf8" );
		
		$this->paginate = array (
				'conditions' => array (
						'Eshopdaquynew.status' => 1,
						'Eshopdaquynew.category_id' => 208 
				),
				'limit' => '1',
				'order' => 'Eshopdaquynew.id DESC' 
		);
		
		$this->set ( 'news', $this->paginate ( 'Eshopdaquynew', array () ) );
	}
	function baogia() {
		$this->set ( 'shopname', $this->shopname );
		$this->layout = 'themeshop/daquy';
		mysql_query ( "SET names utf8" );
		$this->loadModelNew('Eshopdaquynew');
		$this->paginate = array (
				'conditions' => array (
						'Eshopdaquynew.status' => 1,
						'Eshopdaquynew.category_id' => 206 
				),
				'limit' => '8',
				'order' => 'Eshopdaquynew.id DESC' 
		);
		
		$this->set ( 'baogia', $this->paginate ( 'Eshopdaquynew', array () ) );
	}
	function chinhsach() {
		$this->set ( 'shopname', $this->shopname );
		$this->layout = 'themeshop/daquy';
		mysql_query ( "SET names utf8" );
		$this->loadModelNew('Eshopdaquynew');
		$this->paginate = array (
				'conditions' => array (
						'Eshopdaquynew.status' => 1,
						'Eshopdaquynew.category_id' => 205 
				),
				'limit' => '1',
				'order' => 'Eshopdaquynew.id DESC' 
		);
		
		$this->set ( 'chinhsach', $this->paginate ( 'Eshopdaquynew', array () ) );
	}
	
	
	function listnews($id = null) {
		$this->set ( 'shopname', $this->shopname );
		$this->layout = 'themeshop/daquy';
		mysql_query ( "SET names utf8" );
		$this->loadModelNew('Eshopdaquynew');
		$this->paginate = array (
				'conditions' => array (
						'Eshopdaquynew.status' => 1,
						'Eshopdaquynew.category_id' => $id 
				),
				'limit' => '8',
				'order' => 'Eshopdaquynew.id DESC' 
		);
		
		$this->set ( 'listnews', $this->paginate ( 'Eshopdaquynew', array () ) );
		$this->loadModelNew('Eshopdaquycategory');
		$this->set ( 'cat', $this->Eshopdaquycategory->read ( null, $id ) );
	}
	
	function viewnew($id = null) {
		$this->set ( 'shopname', $this->shopname );
		$this->layout = 'themeshop/daquy';
		mysql_query ( "SET names utf8" );
		$this->loadModelNew('Eshopdaquynew');
		if (! $id) {
			
			$this->Session->setFlash ( __ ( 'Không tồn tại', true ) );
			
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		
		$x = $this->Eshopdaquynew->read ( null, $id );
		
		$this->set ( 'views', $x );
		$this->loadModelNew('Eshopdaquynew');
		$this->set ( 'list_other', $this->Eshopdaquynew->find ( 'all', array (
				'conditions' => array (
						'Eshopdaquynew.status' => 1,
						'Eshopdaquynew.category_id' => $x ['Eshopdaquynew'] ['category_id'],
						'Eshopdaquynew.id <>' => $id 
				),
				'limit' => 10 
		) ) );
	}
	function searchnews($name_search = null) {
		$this->set ( 'shopname', $this->shopname );
		$this->layout = 'themeshop/daquy';
		mysql_query ( "SET names utf8" );
		$this->loadModelNew('Eshopdaquynew');
		$title = $_POST ['name_search'];
		
		$this->set ( 'listsearch', $this->Eshopdaquynew->find ( 'all', array (
				'conditions' => array (
						'Eshopdaquynew.status' => 1,
						'Eshopdaquynew.title LIKE' => '%' . $title . '%' 
				),
				'order' => 'Eshopdaquynew.id DESC',
				'limit' => 7 
		) ) );
	}

	//-----------------------End Eshopdaquynew-------------------------------------------
	//+++++++++++++++++++++Plugin++++++++++++++++++++++++++++++++++
		
  function binhchon(){
		mysql_query("SET names utf8");
			return $this->Eshopdaquycatpoll->find('all',array('conditions'=>array('Eshopdaquycatpoll.status'=>1),'order'=>'Eshopdaquycatpoll.id DESC'));	
		//return $this->Eshopdaquycategorypro->find('all');
	}
	
	function banner(){
		return $this->Eshopdaquybanner->find('all',array('conditions'=>array('Eshopdaquybanner.status'=>1),'order'=>'Eshopdaquybanner.id DESC'));
	}
	
	function setting(){
		return $this->Eshopdaquysetting->find('all',array('conditions'=>array(),'order'=>'Eshopdaquysetting.id DESC'));
	}
	
	function linkwebsite(){
		//return $this->Gallery->find('all',array('conditions'=>array('Gallery.status'=>1),'order'=>'Gallery.id DESC','limit'=>2));
		return $this->Eshopdaquyadvertisement->find('all',array('conditions'=>array('Eshopdaquyadvertisement.status'=>1),'order'=>'Eshopdaquyadvertisement.id DESC'));
	}
	
	
	//cong trinh
	function vanbanphapluat(){
		mysql_query("SET names utf8");
		return $this->Eshopdaquycategory->find('all',array('conditions'=>array('Eshopdaquycategory.status'=>1,'Eshopdaquycategory.parent_id'=>'196'),'order'=>'Eshopdaquycategory.tt DESC'));
	}
	
	function videos(){
		mysql_query("SET names utf8");
		return $this->Eshopdaquyvideo->find('all',array('conditions'=>array('Eshopdaquyvideo.status'=>1),'order'=>'Eshopdaquyvideo.id DESC','limit'=>1));
	}
	//----------------------end Plugin---------------------------------
	
	//+++++++++++++++++++Contact++++++++++++++++++++++++++++
	function sendcontacts()
	{     
	               $nameeshop = $this->shopname;
							$shoparr = $this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => $nameeshop,
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

						
							
							$this->set ( 'shopname', $this->shopname );
							$this->set ( 'shop_id', $shop_id);
		                    $this->layout = 'themeshop/daquy';
							$message= "";
							$this->set('message',$message);
							
							$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( "SET NAMES 'utf8'" );
							mysql_query ( "SET character_set_client=utf8" );
							mysql_query ( "SET character_set_connection=utf8" );
							$this->Eshopdaquysetting->setDataEshop($hostname,$username,$password,$databasename);
							$x = $this->Eshopdaquysetting->read ( null, 1 );
							
							//die;
							if (isset ( $_POST ['name'] )) {
								$name = trim($_POST ['name']);
								$mobile = $_POST ['phone'];
								$email = trim($_POST ['email']);
								$title = trim($_POST ['title']);
								$content = trim($_POST ['content']);
								if($email==='') {
											//echo '<script language="javascript"> alert("gửi mail không thành công"); </script>';
											$this->set('message','Error Mail !!!!');
											//exit;
										}
								$data = array(
										'estore_id'=>$x['Eshopdaquysetting']['estore_id'],
									    'name'=>$name,
										'email'=>$email,
										'title'=>$title,
										'content'=>$content
								);
								
								if(!empty($data)) {
									$this->Eshopdaquycontacts->setDataEshop($hostname,$username,$password,$databasename);
									if($this->Eshopdaquycontacts->save($data))
									{
										$resultemail = $this->smtpmailer($email,'alatcas1@gmail.com','FREEMOBIWEB.MOBI',$x['Eshopdaquysetting']['title'],$content);
										if ($resultemail ==1)
										{
											//echo '<script language="javascript"> alert("Gửi mail thành công"); location.href="' . DOMAIN .$this->shopname. '";</script>';
											$message= "succesfuly";
											$this->set('message',$message);
										}
										else
										{
											//echo '<script language="javascript"> alert("gửi mail không thành công"); </script>';
											$this->set('message',$resultemail);
										}
									}
								}
			                   
								
							}
						}
	
	function smtpmailer($to, $from, $from_name, $subject, $body) {
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
			return false;
		} else {
			$error = 'thư của bạn đã được gởi đi ';
			return true;
		}
	}
	

	
	function dathang()
	{      mysql_query("SET NAMES 'utf8'");
	mysql_query("SET character_set_client=utf8");
	mysql_query("SET character_set_connection=utf8");
	//$x=$this->Helps->read(null,1);
	if(isset($_SESSION['shopingcart']))
	{
		$shopingcart=$_SESSION['shopingcart'];
		$this->set(compact('shopingcart'));
	}
	else
	{
		echo '<script language="javascript"> alert("Chua co san pham nao trong gio hang"); window.location.replace("'.DOMAIN.'"); </script>';
	}
	if(isset($_POST['name']))
	{
		$name=$_POST['name'];
		$mobile=$_POST['phone'];
		$email=$_POST['email'];
		$title=$_POST['title'];
		$content=$_POST['content'];
	
		$images=$_POST['images'];
		$product_name=$_POST['product_name'];
		$product_sl=$_POST['product_sl'];
		$price=$_POST['price'];
		$total=$_POST['total'];
		$this->Email->from = $name.'<'.$email.'>';
		$this->Email->to = 'it.chomai@gmail.com';
		$this->Email->subject = $title;
		$this->Email->template = 'default';
		$this->Email->sendAs = 'both';
		$this->set('name',$name);
		$this->set('mobile',$mobile);
		$this->set('email',$email);
		$this->set('content',$content);
	
		$this->set('images',$images);
		$this->set('product_name',$product_name);
		$this->set('product_sl',$product_sl);
		$this->set('price',$price);
		$this->set('total',$total);
	
		$this->set('sang',array('images','product_name','product_sl','price','total'));
	
		if($this->Email->send())
		{
			$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
			echo '<script language="javascript"> alert("Gửi mail thành công"); </script>';
			unset($_SESSION['shopingcart']);
			echo '<script language="javascript">location.href="'.DOMAIN.'";</script>';
	
		}
		else
			$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
		echo '<script language="javascript"> alert("gửi mail không thành công"); location.href="'.DOMAIN.'";</script>';
	}
	}

	//-------------------End Contacts---------------------------
	
	
}

?>

