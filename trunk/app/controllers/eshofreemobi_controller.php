<?php

						  class EshofreemobiController extends AppController {
						  var $name = 'Eshofreemobi';
						   var $shopname ='eshofreemobi';
						    var $components = array('Email');
							var $uses = array (
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
							function loadModelNew($Model) {
								$nameeshop = $this->shopname;
								
									$shoparr = $this->Shop->find ( 'all', array (
											'conditions' => array (
													//'Shop.id' => $shop_id,
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
							
									
									$this->$Model->setDataEshop ( $hostname, $username, $password, $databasename );
									//pr($shoparr);
								}
								
								// +++++++++++++++Comments+++++++++++++++++++++++++
								function tintucnoibat() {
									$this->loadModelNew('Estore_news');
									$this->set ( 'shopname', $this->shopname );
									$this->layout = 'themeshop/estoredaquy';
									mysql_query ( "SET names utf8" );
									return $this->Estore_news->find ( 'all', array (
											'conditions' => array (
													'Estore_news.status' => 1,
													'Estore_news.category_id' => 201 
											),
											'order' => 'Estore_news.id DESC',
											'limit' => 4 
									) );
								}
								function categoryproduct() {
								    $this->set ( 'shopname', $this->shopname );
									//$this->layout = 'themeshop/eshopdaquy';
								    $this->loadModelNew('Estore_catproduct');
									mysql_query ( "SET names utf8" );
									return $this->Estore_catproduct->find ( 'all', array (
											'conditions' => array (
													'Estore_catproduct.status' => 1,
													'Estore_catproduct.parent_id' => NULL 
											),
											'order' => 'Estore_catproduct.order ASC' 
									) );
								}
								
								// tin thuoc danh muc
								function submenuproduct($id = null) { 
								    $this->set ( 'shopname', $this->shopname );
									//$this->layout = 'themeshop/eshopdaquy';
								    $this->loadModelNew('Estore_catproduct');
									return $this->Estore_catproduct->find ( 'all', array (
											'conditions' => array (
													'Estore_catproduct.parent_id ' => $id,
													'Estore_catproduct.status' => 1 
											),
											'order' => 'Estore_catproduct.order ASC' 
									) );
								}
								
								function submenuproduct1($id = null) {
								    $this->loadModelNew('Estore_catproduct');
									return $this->Estore_catproduct->find ( 'all', array (
											'conditions' => array (
													'Estore_catproduct.parent_id ' => $id,
													'Estore_catproduct.status' => 1 
											),
											'order' => 'Estore_catproduct.order ASC' 
									) );
								}
								
								//mapssetting
								function mapssetting() {
									$this->loadModelNew('Estore_settings');
									return $this->Estore_settings->find ('all');
								}
								function sanphambanchay() {
								   $this->loadModelNew('Estore_catproduct');
									mysql_query ( "SET names utf8" );
									return $this->Estore_products->find ( 'all', array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.featuredproducts' => 1 
											),
											'order' => 'Estore_products.order ASC',
											'limit' => 10 
									) );
								}
								
								function sanphamnoibat() {
									$this->loadModelNew('Estore_products');
									mysql_query ( "SET names utf8" );
									return $this->Estore_products->find ( 'all', array (
											'conditions' => array (
													'Estore_products.speproduct' => 1
											),
											'order' => 'Estore_products.id ASC',
											'limit' => 10
									) );
								}
								function phongmau() {
								    $this->loadModelNew('Estore_catproduct');
									mysql_query ( "SET names utf8" );
									return $this->Estore_catproduct->find ( 'all', array (
											'conditions' => array (
													'Estore_catproduct.status' => 1,
													'Estore_catproduct.parent_id' => '8' 
											),
											'order' => 'Estore_catproduct.char DESC' 
									) );
								}
								function doitac() {
									$this->loadModelNew('Estore_partner');
									// return $this->Gallery->find('all',array('conditions'=>array('Gallery.status'=>1),'order'=>'Gallery.id DESC','limit'=>2));
									return $this->Estore_partner->find ( 'all', array (
											'conditions' => array (
													'Estore_partner.status' => 1 
											),
											'order' => 'Estore_partner.id DESC' 
									) );
								}
								function menu_active() {
								    $this->loadModelNew('Estore_categories');
									return $this->Estore_categories->find ( 'all', array (
											'conditions' => array (
													'Estore_categories.parent_id' => 145 
											),
											'order' => 'Estore_categories.id ASC' 
									) );
								}
								function helpsonline() {
								    $this->loadModelNew('Estore_helps');
									return $this->Estore_helps->find ( 'all', array (
											'conditions' => array (
													'Estore_helps.status' => 1 
											),
											'order' => 'Estore_helps.id DESC',
											'limit' => 4 
									) );
								}
								function id_product($id) {
								    $this->loadModelNew('Estore_products');
									return $this->Estore_products->read ( null, $id );
									// pr($this->Estore_products->read(null,$id));die;
								}
								function getinfo($cat = null) {
								    $this->loadModelNew('Estore_news');
									return $this->Estore_news->find ( 'all', array (
											'conditions' => array (
													'Estore_news.status' => 1,
													'Estore_news.category_id' => $cat 
											),
											'order' => 'Estore_news.id DESC',
											'limit' => 3 
									) );
								}
								function Estore_news_codong($cat = null) {
								    $this->loadModelNew('Estore_news');
									return $this->Estore_news->find ( 'all', array (
											'conditions' => array (
													'Estore_news.status' => 1,
													'Estore_news.category_id' => $cat 
											),
											'order' => 'Estore_news.id DESC',
											'limit' => 10 
									) );
								}
								function menucategory() {
								    $this->loadModelNew('Estore_category');
									mysql_query ( "SET names utf8" );
									return $this->Estore_category->find ( 'all', array (
											'conditions' => array (
													'Estore_category.status' => 1,
													'Estore_category.parent_id' => null 
											),
											'order' => 'Estore_category.order ASC' 
									) );
									$_SESSION ['huong'] = 1;
								}
								function videos1() {
								    $this->loadModelNew('Estore_video');
									mysql_query ( "SET names utf8" );
									return $this->Estore_video->find ( 'all', array (
											'conditions' => array (
													'Estore_video.status' => 1 
											),
											'order' => 'Estore_video.id DESC',
											'limit' => 4 
									) );
								}
								function videoslish() {
								    $this->loadModelNew('Estore_video');
									$video = isset ( $_GET ['video'] ) ? $_GET ['video'] : '';
									mysql_query ( "SET names utf8" );
									return $this->Estore_video->find ( 'all', array (
											'conditions' => array (
													'Estore_video.status' => 1,
													'Estore_video.id' => $video 
											),
											'order' => 'Estore_video.id DESC',
											'limit' => 1 
									) );
								}
								function videoslish1() {
								    $this->loadModelNew('Estore_video');
									$video = isset ( $_GET ['video'] ) ? $_GET ['video'] : '';
									mysql_query ( "SET names utf8" );
									return $this->Estore_video->find ( 'all', array (
											'conditions' => array (),
											'order' => 'Estore_video.id DESC',
											'limit' => 1 
									) );
								}
								function get_video($id = null) {
								    $this->loadModelNew('Estore_video');
									// $id=$_GET['id'];
									$a = $this->Estore_video->findById ( $id );
									// echo json_encode(DOMAINAD.$a['Estore_video']['video']); die;
									// echo DOMAINAD.$a['Estore_video']['video']; die;
									echo '<embed  width="195" height="140" type="application/x-shockwave-flash" src="' . DOMAIN . 'images/mediaplayer.swf" style="" id="playlist" name="playlist" quality="high" allowfullscreen="true" wmode="transparent" flashvars="file=' . DOMAINAD . $a ['Estore_video'] ['video'] . '&amp;displayheight=125&amp;width=195&amp;height=140&amp;"></embed>';
									die ();
								}
								
								// --------------------End Comment ------------------------------------
								// +++++++++++++++++++++homes+++++++++++++++++++++++++++++++++++
								//quang cao left - right
								function advleft(){
									$this->loadModelNew('Estore_advertisement');
									return $this->Estore_advertisement->find('all',array('conditions'=>array('Estore_advertisement.status'=>1,'Estore_advertisement.display'=>0),'order'=>'Estore_advertisement.id DESC','limit'=>1));
								}
								function advright(){
									$this->loadModelNew('Estore_advertisement');
									return $this->Estore_advertisement->find('all',array('conditions'=>array('Estore_advertisement.status'=>1,'Estore_advertisement.display'=>1),'order'=>'Estore_advertisement.id DESC','limit'=>1));
								}
								
								function slideshow(){
									$this->set ( 'shopname', $this->shopname );
									$this->layout = 'themeshop/estoredaquy';
									mysql_query("SET names utf8");
									$this->loadModelNew('Estore_slideshows');
									return $this->Estore_slideshows->find('all',array('conditions'=>array('Estore_slideshows.status'=>1),'order'=>'Estore_slideshows.id DESC'));
								}
								function search($title=null) {
									$this->set ( 'shopname', $this->shopname );
									$this->layout = 'themeshop/estoredaquy';
									$this->loadModelNew ( 'Estore_products' );
									mysql_query ( "SET names utf8" );
									$this->set ( 'title_for_layout', 'Search ..............' );
									$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.title like' => '%' . $title . '%' 
											),
											'order' => 'Estore_products.id DESC' 
									);
									$this->set ( 'products', $this->paginate ( 'Estore_products', array () ) );
								}
								function index() {
									$this->set ( 'shopname', $this->shopname );
									$this->layout = 'themeshop/estoredaquy';
									//$this->layout = 'themeshop/home'; //eshopdaquy
									$this->loadModelNew ( 'Estore_products' );
// 									pr($this->Estore_products->find ( 'all', array (
// 											'conditions' => array (
// 													'Estore_products.status' => 0 
// 											),
// 											'limit' => '6',
// 											'order' => 'Estore_products.id DESC' 
// 									) ) );die;
									$this->set ( 'sanphammoi', $this->Estore_products->find ( 'all', array (
											'conditions' => array (
													'Estore_products.status' => 0 
											),
											'limit' => '6',
											'order' => 'Estore_products.id DESC' 
									) ) );
									
									$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1 
											),
											'limit' => '8',
											'order' => 'Estore_products.id DESC' 
									);
									$this->set ( 'sanphamtieubieu', $this->paginate ( 'Estore_products', array () ) );
									
									
								}
								function aboutus() 
								{
									$this->set ( 'shopname', $this->shopname );
									$this->layout = 'themeshop/estoredaquy';
									$this->set ( 'shopname', $this->shopname );
									$this->loadModelNew ( 'Estore_news' );
									$about =  $this->Estore_news->find ( 'all', array (
											'conditions' => array (
													'Estore_news.status' => 1,
													'Estore_news.id' => 97 
											) 
									) );
									$this->set ( 'about', $about );
								}
								function tranhdaquy() {
									$this->set ( 'shopname', $this->shopname );
									$this->layout = 'themeshop/estoredaquy';
								    $this->loadModelNew('Estore_products');
									$this->set ( 'shopname', $this->shopname );
							
									$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.tranhdaquy' => 1 
											),
											'limit' => '8',
											'order' => 'Estore_products.id DESC' 
									);
									$this->set ( 'listproducts', $this->paginate ( 'Estore_products', array () ) );
									
								}
								function daquytho() {
									$this->set ( 'shopname', $this->shopname );
									$this->layout = 'themeshop/estoredaquy';
								   $this->loadModelNew('Estore_products');
									return $this->Estore_products->find ( 'all', array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.daquytho' => 1 
											),
											'limit' => '8',
											'order' => 'Estore_products.id DESC' 
									) );
								}
								function daphongthuy() {
									$this->set ( 'shopname', $this->shopname );
									$this->layout = 'themeshop/estoredaquy';
								    $this->loadModelNew('Estore_products');
									return $this->Estore_products->find ( 'all', array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.daphongthuy' => 1 
											),
											'limit' => '8',
											'order' => 'Estore_products.id DESC' 
									) );
								}
								function trangsuc() {
									$this->set ( 'shopname', $this->shopname );
									$this->layout = 'themeshop/estoredaquy';
								    $this->loadModelNew('Estore_products');
									return $this->Estore_products->find ( 'all', array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.trangsuc' => 1 
											),
											'limit' => '8',
											'order' => 'Estore_products.id DESC' 
									) );
								}
								function add() {
									$this->set ( 'shopname', $this->shopname );
									$this->layout = 'themeshop/estoredaquy';
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
								// +++++++++++++++++Estore_products+++++++++++++++++++++++++++++
								function indexproduct() {
									 $this->loadModelNew('Estore_products');
									 $this->set ( 'shopname', $this->shopname );
									 $this->layout = 'themeshop/estoredaquy';
									// $portfolio=$this->Estore_catproduct->find('list',array('conditions'=>array('Estore_catproduct.parent_id'=>32),'fields' => array('Estore_catproduct.id')));
									$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1 
											),
											'limit' => '12',
											'order' => 'Estore_products.id DESC' 
									);
									$this->set ( 'listproduct', $this->paginate ( 'Estore_products', array () ) );
								}
								function listproduct($id = null) {
									$this->set ( 'shopname', $this->shopname );
									$this->layout = 'themeshop/estoredaquy';
								    $this->loadModelNew('Estore_catproduct');
									$portfolio = $this->Estore_catproduct->find ( 'list', array (
											'conditions' => array (
													'Estore_catproduct.parent_id' => $id 
											), 
											'fields' => array (
													'Estore_catproduct.id' 
											)
											) );
									
									$arr [] = $id; // lưu lai id vừa so sánh
									               
									// pr($arr);
									               // pr($id);die;
									               // pr($portfolio);die;
									
									foreach ( $portfolio as $key ) {
										$arr [] = $key;
									}
									$this->loadModelNew('Estore_products');
									$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.catproduct_id' => $arr 
											),
											'limit' => '12',
											'order' => 'Estore_products.id DESC' 
									);
									$this->set ( 'listproducts', $this->paginate ( 'Estore_products', array () ) );
									$this->loadModelNew('Estore_catproduct');
									$this->set ( 'cat', $this->Estore_catproduct->read ( null, $id ) );
								}
								
								function tranhdaquyproduct($id = null) {
									$this->set ( 'shopname', $this->shopname );
									$this->layout = 'themeshop/estoredaquy';
								    $this->loadModelNew('Estore_products');
									$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.tranhdaquy' => 1 
											),
											'limit' => '12',
											'order' => 'Estore_products.id DESC' 
									);
									$this->set ( 'listproduct', $this->paginate ( 'Estore_products', array () ) );
								}
							
								function daquythoproduct($id = null) {
									$this->set ( 'shopname', $this->shopname );
									$this->layout = 'themeshop/estoredaquy';
								    $this->loadModelNew('Estore_products');
									$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.daquytho' => 1 
											),
											'limit' => '12',
											'order' => 'Estore_products.id DESC' 
									);
									$this->set ( 'listproduct', $this->paginate ( 'Estore_products', array () ) );
								}
								function daphongthuyproduct($id = null) {
								    $this->loadModelNew('Estore_products');
								    $this->set ( 'shopname', $this->shopname );
								    $this->layout = 'themeshop/estoredaquy';
									$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.daphongthuy' => 1 
											),
											'limit' => '12',
											'order' => 'Estore_products.id DESC' 
									);
									$this->set ( 'listproduct', $this->paginate ( 'Estore_products', array () ) );
								}
								function trangsucproduct($id = null) {
								    $this->loadModelNew('Estore_products');
									$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.trangsuc' => 1 
											),
											'limit' => '12',
											'order' => 'Estore_products.id DESC' 
									);
									$this->set ( 'listproduct', $this->paginate ( 'Estore_products', array () ) );
								}
								function searchproduct($search_product = null) {
									$this->set ( 'shopname', $this->shopname );
									$this->layout = 'themeshop/estoredaquy';
								    $this->loadModelNew('Estore_products');
									// $id = $this->Session->read('id');
									$search_product = $_POST ['search_product'];
									$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.title like' => '%' . $search_product . '%' 
											),
											'limit' => 9 
									);
									$this->set ( 'listproduct', $this->paginate ( 'Estore_products', array () ) );
								}
								function viewproduct($id = null) {
									$this->set ( 'shopname', $this->shopname );
									$this->layout = 'themeshop/estoredaquy';
								    $this->loadModelNew('Estore_products');
									if (! $id) {
										$this->Session->setFlash ( __ ( 'Không tồn tại', true ) );
										$this->redirect ( array (
												'action' => 'index' 
										) );
									}
									
									$x = $this->Estore_products->read ( null, $id );
									
									$this->set ( 'views', $x );
									 $this->loadModelNew('Estore_products');
									$this->set ( 'list_others', $this->Estore_products->find ( 'all', array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.catproduct_id' => $x ['Estore_products'] ['catproduct_id'],
													'Estore_products.id <>' => $id 
											),
											'limit' => 10 
									) ) );
								}
								function addshopingcart($id = null) {
									$this->set ( 'shopname', $this->shopname );
									$this->layout = 'themeshop/estoredaquy';
								    $this->loadModelNew('Estore_products');
									$product = $this->Estore_products->read ( null, $id );
									/*
									 * Neu co ma san pham $shopingcart[$id]['name']=$product['Estore_products']['title'];
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
											
											$shopingcart [$id] ['name'] = $product ['Estore_products'] ['title'];
											
											$shopingcart [$id] ['images'] = DOMAINAD . $product ['Estore_products'] ['images'];
											
											$shopingcart [$id] ['sl'] = 1;
											
											$shopingcart [$id] ['price'] = $product ['Estore_products'] ['price'];
											
											$shopingcart [$id] ['total'] = $shopingcart [$id] ['price'];
											
											// tieng anh
											
											$_SESSION ['shopingcart'] = $shopingcart;
											
											echo '<script language="javascript"> alert("Thêm thành công"); window.location.replace("' . DOMAIN . 'hien-gio-hang-cua-mat-hang"); </script>';
										}
									}
								}
								function viewshopingcart() {
									$this->set ( 'shopname', $this->shopname );
									$this->layout = 'themeshop/estoredaquy';
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
									$this->layout = 'themeshop/estoredaquy';
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
									$this->layout = 'themeshop/estoredaquy';
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
									$this->layout = 'themeshop/estoredaquy';
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
								// _________________End Estore_products__________________________
								
								//++++++++++++++++++++++News++++++++++++++++++++++++++++++++++++++++++++
								function indexnew($id = null) {
									$this->set ( 'shopname', $this->shopname );
									$this->layout = 'themeshop/estoredaquy';
									$this->loadModelNew('Estore_category');
									$namenews = $this->Estore_category->find ( 'all', array (
																'conditions' => array (
																		'Estore_category.id' => $id,
																		'Estore_category.status' => 1
																),
																'fields' => array (
																		'Estore_category.name'
																)
														) );
									$this->set ( 'namecategory', $namenews);
									$this->loadModelNew('Estore_news');
									mysql_query ( "SET names utf8" );
									$this->paginate = array (
											'conditions' => array (
													'Estore_news.status' => 1,
													'Estore_news.category_id' => $id 
											),
											'limit' => '8',
											'order' => 'Estore_news.id DESC' 
									);
									
									$this->set ( 'news', $this->paginate ( 'Estore_news', array () ) );
								}
								function buynew() {
									$this->set ( 'shopname', $this->shopname );
									$this->layout = 'themeshop/estoredaquy';
									$this->loadModelNew('Estore_news');
									mysql_query ( "SET names utf8" );
									
									$this->paginate = array (
											'conditions' => array (
													'Estore_news.status' => 1,
													'Estore_news.category_id' => 207 
											),
											'limit' => '1',
											'order' => 'Estore_news.id DESC' 
									);
									
									$this->set ( 'news', $this->paginate ( 'Estore_news', array () ) );
								}
								function address() {
									$this->set ( 'shopname', $this->shopname );
									$this->layout = 'themeshop/estoredaquy';
									$this->loadModelNew('Estore_news');
									mysql_query ( "SET names utf8" );
									
									$this->paginate = array (
											'conditions' => array (
													'Estore_news.status' => 1,
													'Estore_news.category_id' => 208 
											),
											'limit' => '1',
											'order' => 'Estore_news.id DESC' 
									);
									
									$this->set ( 'news', $this->paginate ( 'Estore_news', array () ) );
								}
								function baogia() {
									$this->set ( 'shopname', $this->shopname );
									$this->layout = 'themeshop/estoredaquy';
									mysql_query ( "SET names utf8" );
									$this->loadModelNew('Estore_news');
									$this->paginate = array (
											'conditions' => array (
													'Estore_news.status' => 1,
													'Estore_news.category_id' => 206 
											),
											'limit' => '8',
											'order' => 'Estore_news.id DESC' 
									);
									
									$this->set ( 'baogia', $this->paginate ( 'Estore_news', array () ) );
								}
								function chinhsach() {
									$this->set ( 'shopname', $this->shopname );
									$this->layout = 'themeshop/estoredaquy';
									mysql_query ( "SET names utf8" );
									$this->loadModelNew('Estore_news');
									$this->paginate = array (
											'conditions' => array (
													'Estore_news.status' => 1,
													'Estore_news.category_id' => 205 
											),
											'limit' => '1',
											'order' => 'Estore_news.id DESC' 
									);
									
									$this->set ( 'chinhsach', $this->paginate ( 'Estore_news', array () ) );
								}
								
								
								function listnews($id = null) {
									$this->set ( 'shopname', $this->shopname );
									$this->layout = 'themeshop/estoredaquy';
									mysql_query ( "SET names utf8" );
									$this->loadModelNew('Estore_news');
									$this->paginate = array (
											'conditions' => array (
													'Estore_news.status' => 1,
													'Estore_news.category_id' => $id 
											),
											'limit' => '8',
											'order' => 'Estore_news.id DESC' 
									);
									
									$this->set ( 'listnews', $this->paginate ( 'Estore_news', array () ) );
									$this->loadModelNew('Estore_category');
									$this->set ( 'cat', $this->Estore_category->read ( null, $id ) );
								}
								
								function viewnew($id = null) {
									$this->set ( 'shopname', $this->shopname );
									$this->layout = 'themeshop/estoredaquy';
									mysql_query ( "SET names utf8" );
									$this->loadModelNew('Estore_news');
									if (! $id) {
										
										$this->Session->setFlash ( __ ( 'Không tồn tại', true ) );
										
										$this->redirect ( array (
												'action' => 'index' 
										) );
									}
									
									$x = $this->Estore_news->read ( null, $id );
									
									$this->set ( 'views', $x );
									$this->loadModelNew('Estore_news');
									$this->set ( 'list_other', $this->Estore_news->find ( 'all', array (
											'conditions' => array (
													'Estore_news.status' => 1,
													'Estore_news.category_id' => $x ['Estore_news'] ['category_id'],
													'Estore_news.id <>' => $id 
											),
											'limit' => 10 
									) ) );
								}
								function searchnews($name_search = null) {
									$this->set ( 'shopname', $this->shopname );
									$this->layout = 'themeshop/estoredaquy';
									mysql_query ( "SET names utf8" );
									$this->loadModelNew('Estore_news');
									$title = $_POST ['name_search'];
									
									$this->set ( 'listsearch', $this->Estore_news->find ( 'all', array (
											'conditions' => array (
													'Estore_news.status' => 1,
													'Estore_news.title LIKE' => '%' . $title . '%' 
											),
											'order' => 'Estore_news.id DESC',
											'limit' => 7 
									) ) );
								}
							
								//-----------------------End Estore_news-------------------------------------------
								//+++++++++++++++++++++Plugin++++++++++++++++++++++++++++++++++
									
							  function binhchon(){
									mysql_query("SET names utf8");
										return $this->Eshopdaquycatpoll->find('all',array('conditions'=>array('Eshopdaquycatpoll.status'=>1),'order'=>'Eshopdaquycatpoll.id DESC'));	
									//return $this->Estore_categorypro->find('all');
								}
								
								function banner(){
									return $this->Estore_banner->find('all',array('conditions'=>array('Estore_banner.status'=>1),'order'=>'Estore_banner.id DESC'));
								}
								
								function setting(){
									return $this->Estore_settings->find('all',array('conditions'=>array(),'order'=>'Estore_settings.id DESC'));
								}
								
								function linkwebsite(){
									//return $this->Gallery->find('all',array('conditions'=>array('Gallery.status'=>1),'order'=>'Gallery.id DESC','limit'=>2));
									return $this->Estore_advertisement->find('all',array('conditions'=>array('Estore_advertisement.status'=>1),'order'=>'Estore_advertisement.id DESC'));
								}
								
								
								//cong trinh
								function vanbanphapluat(){
									mysql_query("SET names utf8");
									return $this->Estore_category->find('all',array('conditions'=>array('Estore_category.status'=>1,'Estore_category.parent_id'=>'196'),'order'=>'Estore_category.tt DESC'));
								}
								
								function videos(){
									mysql_query("SET names utf8");
									return $this->Estore_video->find('all',array('conditions'=>array('Estore_video.status'=>1),'order'=>'Estore_video.id DESC','limit'=>1));
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
									                    $this->layout = 'themeshop/estoredaquy';
														$message= "";
														$this->set('message',$message);
														
														$this->set ( 'title_for_layout', 'e-shop' );
														mysql_query ( "SET NAMES 'utf8'" );
														mysql_query ( "SET character_set_client=utf8" );
														mysql_query ( "SET character_set_connection=utf8" );
														$this->Estore_settings->setDataEshop($hostname,$username,$password,$databasename);
														$x = $this->Estore_settings->read ( null, 1 );
														
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
																	'estore_id'=>$x['Estore_settings']['estore_id'],
																    'name'=>$name,
																	'email'=>$email,
																	'title'=>$title,
																	'content'=>$content
															);
															
															if(!empty($data)) {
																$this->Estore_contacts->setDataEshop($hostname,$username,$password,$databasename);
																if($this->Estore_contacts->save($data))
																{
																	$resultemail = $this->smtpmailer($email,'alatcas1@gmail.com','FREEMOBIWEB.MOBI',$x['Estore_settings']['title'],$content);
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
