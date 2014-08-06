<?php

						  class Testcreatwebsite001Controller extends AppController {
						  var $name = 'Testcreatwebsite001';
						  var $shopname ='testcreatwebsite001';
						  	var $uses = array (
						  		'Estore_categories',//Catalogueshop
						  		'Estore_news',//eshop
						  		'Estore_products',//eshop products
								'Estore_category',
								'Estore_comments',
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
						var $paginate = array();
						var $helpers = array (
								'Html',
								'Ajax',
								'Javascript',//'Paginator' 
						);
						var $components = array (
								'RequestHandler',
								'Email' 
						);
						
						function connectiondatabase($sql) {
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
							/*
							$sql = "SELECT estore_catproducts.*
									 FROM  estore_catproducts
									 WHERE estore_catproducts.parent_id= 11 AND estore_catproducts.estore_id =".(int)$shop_id." ORDER BY  estore_catproducts.name ASC ";
							//$resul = $name->rawQuery($sql);
							 * */
							 
							$resul = $name->fetchAll($sql);
								
							//pr($resul);
							return $resul;
								
						}
						
						
						
						function get_shop_id($name) {
							
						
							return $this->Shop->find ( 'all', array (
									'conditions' => array (
											'Shop.name' => $name,
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
							mysql_query ( "SET names utf8" );
							return $this->Estore_infomation->find ( 'all', array (
									'order' => 'Estore_infomation.id DESC' 
							) );
						}
						function getAlbum() {
							mysql_query ( "SET names utf8" );
							return $this->Estore_album->find ( 'all', array (
									'conditions' => array (
											'Estore_album.status' => 1 
									),
									'limit' => '3',
									'order' => 'Estore_album.id ASC' 
							) );
						}
					
						function menucategory() {
							mysql_query ( "SET names utf8" );
							$sql_exc = "SELECT `estore_categories`.`id`, `estore_categories`.`estore_id`, `estore_categories`.`tt`, `estore_categories`.`parent_id`, `estore_categories`.`lft`, `estore_categories`.`rght`, `estore_categories`.`name`, `estore_categories`.`name_en`, `estore_categories`.`created`, `estore_categories`.`modified`, `estore_categories`.`status`, `estore_categories`.`images`, `estore_categories`.`alias` FROM `estore_categories` AS `estore_categories`   WHERE `estore_categories`.`status` = 1 AND `estore_categories`.`parent_id` IS NULL   ORDER BY `estore_categories`.`tt` ASC";
								
							$result = $this->connectiondatabase($sql_exc);
							//pr($result);
							return $result;
							
						}
						function showcategory($id = null) {
							mysql_query ( "SET names utf8" );
							$sql_exc = "SELECT `estore_categories`.`id`, `estore_categories`.`estore_id`,
									           `estore_categories`.`tt`, `estore_categories`.`parent_id`, 
									           `estore_categories`.`lft`, `estore_categories`.`rght`, 
									           `estore_categories`.`name`, `estore_categories`.`name_en`, 
									           `estore_categories`.`created`, `estore_categories`.`modified`,
									           `estore_categories`.`status`, `estore_categories`.`images`,
									           `estore_categories`.`alias` 
									     FROM `estore_categories` AS `estore_categories`  
									     WHERE `estore_categories`.`parent_id` = '".$id."'  
									     ORDER BY `estore_categories`.`tt` ASC";
							$result = $this->connectiondatabase($sql_exc);
							//pr($result);
							return $result;

						}
						function menunews1() {
							mysql_query ( "SET names utf8" );
							return $this->Estore_category->find ( 'all', array (
									'conditions' => array (
											'Estore_category.status' => 1,
											'Estore_category.parent_id' => '156' 
									),
									'order' => 'Estore_category.tt DESC' 
							) );
						}
						
						// gioi thieu
						function menuintroduct() {
							mysql_query ( "SET names utf8" );
							return $this->Estore_category->find ( 'all', array (
									'conditions' => array (
											'Estore_category.status' => 1,
											'Estore_category.parent_id' => '146' 
									),
									'order' => 'Estore_category.tt ASC' 
							) );
						}
						function banner($shop_id=null) {
							$sql_exc = "SELECT estore_banners.*
									 FROM  estore_banners
									 WHERE estore_banners.estore_id =".(int)$shop_id." AND estore_banners.status = 1 ORDER BY  estore_banners.id ASC ";
								
							$result = $this->connectiondatabase($sql_exc);
							//pr($result);
							return $result;
							
						}
						function setting($shop_id=null) {
							return $this->Estore_setting->find ( 'all', array (
									'conditions' => array ('estore_setting.estore_id' =>$shop_id),
									'order' => 'Estore_setting.id DESC' 
									) );
						}
						function adv() {
							// return $this->Gallery->find('all',array('conditions'=>array('Gallery.status'=>1),'order'=>'Gallery.id DESC','limit'=>2));
							return $this->Estore_banner->find ( 'all', array (
									'conditions' => array (
											'Estore_banner.status' => 1 
									),
									'order' => 'Estore_banner.id DESC',
									'limit' => 2 
							) );
						}
						function doitac() {
							// return $this->Gallery->find('all',array('conditions'=>array('Gallery.status'=>1),'order'=>'Gallery.id DESC','limit'=>2));
							return $this->Estore_partner->find ( 'all', array (
									'conditions' => array (
											'Estore_partner.status' => 1 
									),
									'order' => 'Estore_partner.id DESC' 
							) );
						}
						function menu_active() {
							return $this->Categoryestore2->find ( 'all', array (
									'conditions' => array (
											'Categoryestore2.parent_id' => 145 
									),
									'order' => 'Categoryestore2.id ASC' 
							) );
						}
						function helpsonline($shop_id=null) {
							return $this->Estore_helps->find ( 'all', array (
									'conditions' => array (
											'Estore_helps.status' => 1,
											'Estore_helps.estore_id' => $shop_id
									),
									'order' => 'Estore_helps.id DESC' 
							) );
						}
						function id_product($id) {
							return $this->Estore_product->read ( null, $id );
							// pr($this->Estore_product->read(null,$id));die;
						}
						function hot() {
							return $this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 156 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 1 
							) );
						}
						function hotnew($shop_id=null) {
							$sql_exc = "SELECT estore_news.*
									 FROM  estore_news
									 WHERE estore_news.estore_id =".(int)$shop_id." AND estore_news.status = 1 AND estore_news.category_id = 156 ORDER BY  estore_news.id DESC LIMIT 6 ";
								
							$result = $this->connectiondatabase($sql_exc);
							//pr($result);
							
							return $result;
							
						}
						function getinfo($cat = null) {
							return $this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => $cat 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 3 
							) );
						}
						function videos($shop_id=null) {
							mysql_query ( "SET names utf8" );
							$sql_exc_other = "SELECT estore_videos.*
											 FROM  estore_videos
											 WHERE estore_videos.status = 1 AND estore_videos.left= 0 AND estore_videos.estore_id= ".$shop_id." ORDER BY estore_videos.id DESC LIMIT 1";
							$result_video = $this->connectiondatabase($sql_exc_other);
							//pr($result_video);
							
							return $result_video;
						}
						function videosright($shop_id=null) {
							mysql_query ( "SET names utf8" );
							return $this->Estore_video->find ( 'all', array (
									'conditions' => array (
											'Estore_video.status' => 1,
						  					'Estore_video.estore_id' => $shop_id,
											'Estore_video.left' => 1 
									),
									'order' => 'Estore_video.id DESC',
									'limit' => 1 
							) );
						}
						function tintuc() {
							return $this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 156 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 5 
							) );
						}
						function slideshow() {
							mysql_query ( "SET names utf8" );
							return $this->Estore_slideshow->find ( 'all', array (
									'conditions' => array (
											'Estore_slideshow.status' => 1 
									),
									'order' => 'Estore_slideshow.id DESC' 
							) );
						}
						function library_image() {
							return $this->Gallery->find ( 'all', array (
									'conditions' => array (
											'Gallery.status' => 1 
									),
									'order' => 'Gallery.id DESC',
									'limit' => 10 
							) );
						}
						function shows() {
							mysql_query ( "SET names utf8" );
							return $this->Estore_category->find ( 'all', array (
									'conditions' => array (
											'Estore_category.parent_id' => '201' 
									),
									'order' => 'Estore_category.id ASC' 
							) );
						}
						// SẢN PHẨM
						function menuproduct() {
							mysql_query ( "SET names utf8" );
							return $this->Estore_catproduct->find ( 'all', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => '3' 
									),
									'order' => 'Estore_catproduct.id ASC' 
							) );
						}
						function submenuproduct($id = null) {
							return $this->Estore_catproduct->find ( 'all', array (
									'conditions' => array (
											'Estore_catproduct.parent_id ' => $id 
									),
									'order' => 'Estore_catproduct.id ASC' 
							) );
						}
						function showsmenu() {
							mysql_query ( "SET names utf8" );
							return $this->Estore_catproduct->find ( 'all', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => '12' 
									),
									'order' => 'Estore_catproduct.id ASC' 
							) );
						}
						function showsmenu1($id = null) {
							$sql_exc = "SELECT estore_catproducts.*
									 FROM  estore_catproducts
									 WHERE estore_catproducts.parent_id =".(int)$id." ORDER BY  estore_catproducts.id ASC ";
							
							$result = $this->connectiondatabase($sql_exc);
							//pr($result);
							return $result;

						}
						
						
						function showsmenu2($id = null) {
							$sql_exc = "SELECT estore_catproducts.*
									 FROM  estore_catproducts
									 WHERE estore_catproducts.parent_id =".(int)$id." ORDER BY  estore_catproducts.id ASC ";
								
							$result = $this->connectiondatabase($sql_exc);
							//pr($result);
							return $result;
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
									 WHERE estore_catproducts.parent_id= 11 AND estore_catproducts.estore_id =".(int)$shop_id." ORDER BY  estore_catproducts.name ASC ";
							//$resul = $name->rawQuery($sql);
							$resul = $name->fetchAll($sql);
							
							//pr($resul);
							return $resul;
							
						}
						function typical($shop_id = Null) {
							return $this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.estore_id' => $shop_id 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 10 
							) );
						}
						function productnew() {
							return $this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 10 
							) );
						}
						function khuyenmai() {
							return $this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.display' => '1' 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 10 
							) );
						}
						function business() {
							return $this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 218 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 5 
							) );
						}
						function customers() {
							return $this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 219 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 5 
							) );
						}
						function science() {
							return $this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 220 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 5 
							) );
						}
						function help() {
							return $this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 156 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 8 
							) );
						}
						function tinkhuyenmai() {
							return $this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 227 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 5 
							) );
						}
						function tinkhuyenmaile() {
							return $this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 228 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 5 
							) );
						}
						function weblink() {
							return $this->Estore_weblink->find ( 'all', array (
									'conditions' => array (
											'Estore_weblink.status' => 1 
									),
									'order' => 'Estore_weblink.id DESC' 
							) );
						}
						function cat() {
							return $this->Estore_catproduct->find ( 'all', array (
									'conditions' => array (
											'Estore_catproduct.status' => 1 
									) 
							) );
						}
						function hsx() {
							return $this->Estore_manufacturer->find ( 'all', array (
									'conditions' => array (
											'Estore_manufacturer.status' => 1,
											'Estore_manufacturer.parent_id ' => null 
									) 
							) );
						}
						function catcon() {
							return $this->Estore_catproduct->find ( 'all', array (
									'conditions' => array (
											'Estore_catproduct.status' => 1 
									) 
							) );
						}
						function adv1() {
							return $this->Estore_advertisement->find ( 'all', array (
									'conditions' => array (
											'Estore_advertisement.status' => 1,
											'Estore_advertisement.display' => 0 
									),
									'limit' => 1 
							) );
						}
						function adv2() {
							return $this->Estore_advertisement->find ( 'all', array (
									'conditions' => array (
											'Estore_advertisement.status' => 1,
											'Estore_advertisement.display' => 1 
									),
									'limit' => 1 
							) );
						}
						function advf($shop_id= null) {
							$sql_exc_other = "SELECT estore_advertisements.*
											 FROM  estore_advertisements
											 WHERE estore_advertisements.status = 1 AND estore_advertisements.display= 2 AND estore_advertisements.estore_id= ".$shop_id." ORDER BY estore_advertisements.id ";
							$advf = $this->connectiondatabase($sql_exc_other);
							//pr($advf);
								
							return $advf;
							
							
						}
						function advr($shop_id= null) {
							return $this->Estore_advertisement->find ( 'all', array (
									'conditions' => array (
											'Estore_advertisement.status' => 1,
						  					'Estore_advertisement.estore_id' => $shop_id,
											'Estore_advertisement.display' => 3 
									),
									'order' => 'Estore_advertisement.id ASC' 
							) );
						}
						
						// +++++++++++++++++++++++++++++++++++Home+++++++++++++++++++++++++++++++++++++++++++++++
						function index() {
							
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							//pr($shoparr);//die;
							
// 							//++++++++++Connect  data +++++++++++++++++
// 							foreach($shoparr as $shop){
// 								$databasename = $shop['Shop']['databasename'];
// 								$password = $shop['Shop']['password'];
// 								$username = $shop['Shop']['username'];
// 								$hostname = $shop['Shop']['hostname'];
								
// 							}
// 							$db = new ConnectionManager;
// 							$config = array(
// 									//'className' => 'Cake\Database\Connection',
// 									'driver' => 'mysql',
// 									'persistent' => false,
// 									'host' =>$hostname,
// 									'login' =>$username,
// 									'password' =>$password,
// 									'database' =>$databasename,
// 									'prefix' => false,
// 									'encoding' => 'utf8',
// 									'timezone' => 'UTC',
// 									'cacheMetadata' => true
// 							);
// 							$db->create($databasename,$config);
// 							$shop_id = "9999";
// 							$sql= "INSERT INTO `estore_videos` (`estore_id`, `name`, `video`, `LinkUrl`, `created`, `status`, `left`, `right`) VALUES
// 									($shop_id, 'Gala trong ngay', 'video/upload/c67b28f317fe8740ada0a80316a0559c.flv', 'http://www.youtube.com/watch?v=5z7DEE70dEs&feature=related', '2011-10-02 18:51:33', 1, 0, 0),
// 									($shop_id, 'Clip gala Bên phải', 'video/upload/64c23f4052d6626521caef72b1bc067f.flv', 'http://www.youtube.com/watch?v=76ZqkGxe_Mc&feature=g-vrec', '2012-06-14 14:46:38', 1, 1, 0);";
															
// 							$name = ConnectionManager::getDataSource($databasename);
// 							pr($name->config);die;
// 							$resul = $name->rawQuery($sql);

							
// 							pr($resul);
// 							die;
							
// 							pr($name);
// 							echo "99999999999999999</br>";
// 							pr($name->config);
// 							echo "defaulll</br>";
// 							pr($dbdefault->config);
// 							$dbdefault->rawQuery($sql);
// 							die;

							
					/*		
						require_once 'app/Config/database.php';
						$database = new DATABASE_CONFIG;
						try{
						        $dblink = new PDO('mysql:host='.$database->default['host'].';dbname='.$database->default['database'], $database->default['login'],  $database->default['password'], array(PDO::ATTR_PERSISTENT => false));
						        $dblink->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						        $dblink->exec('SET CHARACTER SET '.$database->default['encoding']);
						} catch (Exception $e) {
						        die('DB Error'. $e->getMessage());
						}
						pr($database->default['host']);	
							die;
						
							
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
				*/	
							
							$this->set ( 'shopname', $shopname );
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.spkuyenmai' => 1 
									),
									'limit' => '9',
									'order' => 'Estore_product.id DESC' 
							);
							$this->set ( 'products', $this->paginate ( 'Estore_product', array () ) );
							
							$check1 = $this->Estore_catproduct->find ( 'list', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => 106 
									),
									'fields' => array (
											'Estore_catproduct.id' 
									) 
							) );
							
							$checks = $this->Estore_catproduct->find ( 'list', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => $check1 
									),
									'fields' => array (
											'Estore_catproduct.id' 
									) 
							) );
							
							if ($checks != null) {
								$this->set ( 'tubep', $this->Estore_product->find ( 'all', array (
										'conditions' => array (
												'Estore_product.status' => 1,
												'Estore_product.catproduct_id' => $check1,
												'Estore_product.catproduct_id' => $checks 
										),
										'limit' => 6,
										'order' => 'Estore_product.id DESC' 
								) ) );
							} else {
								$this->set ( 'tubep', $this->Estore_product->find ( 'all', array (
										'conditions' => array (
												'Estore_product.status' => 1,
												'Estore_product.catproduct_id' => $check1 
										),
										'limit' => 6,
										'order' => 'Estore_product.id DESC' 
								) ) );
							}
							$check2 = $this->Estore_catproduct->find ( 'list', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => 107 
									),
									'fields' => array (
											'Estore_catproduct.id' 
									) 
							) );
							
							$checkss = $this->Estore_catproduct->find ( 'list', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => $check2 
									),
									'fields' => array (
											'Estore_catproduct.id' 
									) 
							) );
							
							if ($checkss != null) {
								$this->set ( 'bepcongnghiep', $this->Estore_product->find ( 'all', array (
										'conditions' => array (
												'Estore_product.status' => 1,
												'Estore_product.catproduct_id' => $check2,
												'Estore_product.catproduct_id' => $checkss 
										),
										'limit' => 6,
										'order' => 'Estore_product.id DESC' 
								) ) );
							} else {
								$this->set ( 'bepcongnghiep', $this->Estore_product->find ( 'all', array (
										'conditions' => array (
												'Estore_product.status' => 1,
												'Estore_product.catproduct_id' => $check2 
										),
										'limit' => 6,
										'order' => 'Estore_product.id DESC' 
								) ) );
							}
							$this->set ( 'spvip', $this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.sptieubieu' => '1' 
									),
									'limit' => 6,
									'order' => 'Estore_product.id DESC' 
							) ) );
							
							
						}
						// ++++++++++++++++++++++++++++++Product++++++++++++++++++++++++++++++++++++++++
						function indexproduct() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( "SET names utf8" );
							$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 9 
							);
							$this->set ( 'products', $this->paginate ( 'Estore_product', array () ) );
						}
						function dssanpham($id = null) {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( "SET names utf8" );
							$check = $this->Estore_catproduct->find ( 'list', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => $id 
									),
									'fields' => array (
											'Estore_catproduct.id' 
									) 
							) );
							// var_dump($check); exit();
							if ($check != null) {
								$this->paginate = array (
										'conditions' => array (
												'Estore_catproduct.status' => 1,
												'Estore_catproduct.parent_id' => $id 
										),
										'order' => 'Estore_catproduct.id ASC',
										'limit' => 9 
								);
								$this->set ( 'catproduct', $this->paginate ( 'Estore_catproduct', array () ) );
								$this->set ( 'cat', $this->Estore_catproduct->read ( null, $id ) );
							} else {
								$this->paginate = array (
										'conditions' => array (
												'Estore_product.status' => 1,
												'Estore_product.catproduct_id' => $id 
										),
										'order' => 'Estore_product.id DESC',
										'limit' => 9 
								);
								$this->set ( 'products', $this->paginate ( 'Estore_product', array () ) );
								$this->set ( 'cat', $this->Estore_catproduct->read ( null, $id ) );
							}
						}
						function all($id = null) {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( "SET names utf8" );
							$check = $this->Estore_catproduct->find ( 'list', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => $id 
									),
									'fields' => array (
											'Estore_catproduct.id' 
									) 
							) );
							// var_dump($check); exit();
							if ($check != null) {
								$this->paginate = array (
										'conditions' => array (
												'Estore_product.status' => 1,
												'Estore_product.catproduct_id' => $check 
										),
										'order' => 'Estore_product.id DESC',
										'limit' => 18 
								);
								$this->set ( 'products', $this->paginate ( 'Estore_product', array () ) );
								$this->set ( 'cat', $this->Estore_catproduct->read ( null, $id ) );
							} else {
								$this->paginate = array (
										'conditions' => array (
												'Estore_product.status' => 1,
												'Estore_product.catproduct_id' => $id 
										),
										'order' => 'Estore_product.id DESC',
										'limit' => 18 
								);
								$this->set ( 'products', $this->paginate ( 'Estore_product', array () ) );
								$this->set ( 'cat', $this->Estore_catproduct->read ( null, $id ) );
							}
						}
						function khuyenmaiproduct() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( "SET names utf8" );
							
							$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.spkuyenmai' => 1 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 18 
							);
							$this->set ( 'products', $this->paginate ( 'Estore_product', array () ) );
							$this->set ( 'cat', 'Sản phẩm khuyến mãi' );
						}
						function vip() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( "SET names utf8" );
							
							$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.sptieubieu' => 1 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 18 
							);
							$this->set ( 'products', $this->paginate ( 'Estore_product', array () ) );
							$this->set ( 'cat', 'Sản phẩm trung & cao cấp' );
						}
						function vpp() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( "SET names utf8" );
							$dem = $this->Estore_catproduct->find ( 'list', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => '21' 
									),
									'fields' => array (
											'Estore_catproduct.id' 
									) 
							) );
							$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => $dem 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 12 
							);
							$this->set ( 'products', $this->paginate ( 'Estore_product', array () ) );
							$this->set ( 'newsproducts', $this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => $dem,
											'Estore_product.sptieubieu' => '1' 
									),
									'limit' => 16,
									'order' => 'Estore_product.id DESC' 
							) ) );
						}
						function thietbivp() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( "SET names utf8" );
							$dem = $this->Estore_catproduct->find ( 'list', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => '22' 
									),
									'fields' => array (
											'Estore_catproduct.id' 
									) 
							) );
							$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => $dem 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 12 
							);
							$this->set ( 'products', $this->paginate ( 'Estore_product', array () ) );
							$this->set ( 'newsproducts', $this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => $dem,
											'Estore_product.sptieubieu' => '1' 
									),
									'limit' => 16,
									'order' => 'Estore_product.id DESC' 
							) ) );
						}
						function thietbicntt() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( "SET names utf8" );
							$dem = $this->Estore_catproduct->find ( 'list', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => '23' 
									),
									'fields' => array (
											'Estore_catproduct.id' 
									) 
							) );
							$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => $dem 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 12 
							);
							$this->set ( 'products', $this->paginate ( 'Estore_product', array () ) );
							$this->set ( 'newsproducts', $this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => $dem,
											'Estore_product.sptieubieu' => '1' 
									),
									'limit' => 16,
									'order' => 'Estore_product.id DESC' 
							) ) );
						}
						function listproduct($id = null) {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc Catproduct
							mysql_query ( "SET names utf8" );
							$this->set ( 'newsproducts', $this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => $id,
											'Estore_product.sptieubieu' => '1' 
									),
									'limit' => 9,
									'order' => 'Estore_product.id DESC' 
							) ) );
							$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => $id 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 9 
							);
							$this->set ( 'products', $this->paginate ( 'Estore_product', array () ) );
							$this->set ( 'cat', $this->Estore_catproduct->read ( null, $id ) );
						}
						function listsp1($id = null) {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( "SET names utf8" );
							$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => $id 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 9 
							);
							$this->set ( 'products', $this->paginate ( 'Estore_product', array () ) );
							$this->set ( 'cat', $this->Estore_catproduct->read ( null, $id ) );
						}
						function listsp12($id = null) {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( "SET names utf8" );
							$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => $id 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 10 
							);
							$this->set ( 'products', $this->paginate ( 'Estore_product', array () ) );
							$this->set ( 'cat', $this->Estore_catproduct->read ( null, $id ) );
						}
						function listsp2($id = null) {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( "SET names utf8" );
							$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => $id 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 10 
							);
							$this->set ( 'products', $this->paginate ( 'Estore_product', array () ) );
							$this->set ( 'cat', $this->Estore_catproduct->read ( null, $id ) );
						}
						function search() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
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
							
							$this->Estore_categories->setDataEshop($hostname,$username,$password,$databasename);
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							//$this->loadModel ( "Estore_catproducts" );
							
							if (isset ( $_POST ['system'] )) {
								$list_cat = $_POST ['system'];
							} else
								$list_cat = "";
							if (isset ( $_POST ['hsx'] )) {
								$hsx = $_POST ['hsx'];
							} else
								$hsx = "";
							if (isset ( $_POST ['gia'] )) {
								$gia = $_POST ['gia'];
							} else
								$gia = "";
							
							
							
							if (($list_cat != "") && ($hsx == "") && ($gia == "")) {
								$this->Estore_categories->setDataEshop($hostname,$username,$password,$databasename);
								$po1 = $this->Estore_categories->find ( 'list', array (
										'conditions' => array (
												'Estore_categories.status' => 1,
												'Estore_categories.parent_id' => $list_cat 
										),
										'fields' => array (
												'Estore_categories.id' 
										) 
								) );
								
								if ($po1 != null) {
									$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.catproduct_id' => $po1 
											),
											'limit' => '21',
											'order' => 'Estore_products.id DESC' 
									);
									$this->Estore_products->setDataEshop($hostname,$username,$password,$databasename);
									$this->set ( 'products', $this->paginate ( 'Estore_products', array () ) );
								} else {
									$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.catproduct_id' => $list_cat 
											),
											'limit' => '21',
											'order' => 'Estore_products.id DESC' 
									);
									$this->Estore_products->setDataEshop($hostname,$username,$password,$databasename);
									$this->set ( 'products', $this->paginate ( 'Estore_products', array () ) );
								}
							}
							
							if (($list_cat != "") && ($hsx != "") && ($gia == "")) {
								$this->Estore_categories->setDataEshop($hostname,$username,$password,$databasename);
								$po1 = $this->Estore_categories->find ( 'list', array (
										'conditions' => array (
												'Estore_categories.status' => 1,
												'Estore_categories.parent_id' => $list_cat 
										),
										'fields' => array (
												'Estore_categories.id' 
										) 
								) );
								
								if ($po1 != null) {
									$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.catproduct_id' => $po1,
													'Estore_products.manufacturer' => $hsx 
											),
											'limit' => '21',
											'order' => 'Estore_products.id DESC' 
									);
									$this->Estore_products->setDataEshop($hostname,$username,$password,$databasename);
									$this->set ( 'products', $this->paginate ( 'Estore_products', array () ) );
								} else {
									$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.catproduct_id' => $list_cat,
													'Estore_products.manufacturer' => $hsx 
											),
											'limit' => '21',
											'order' => 'Estore_products.id DESC' 
									);
									$this->Estore_products->setDataEshop($hostname,$username,$password,$databasename);
									$this->set ( 'products', $this->paginate ( 'Estore_products', array () ) );
								}
							}
							
							if (($list_cat != "") && ($hsx == "") && ($gia != "")) {
								$this->Estore_categories->setDataEshop($hostname,$username,$password,$databasename);
								$po1 = $this->Estore_categories->find ( 'list', array (
										'conditions' => array (
												'Estore_categories.status' => 1,
												'Estore_categories.parent_id' => $list_cat 
										),
										'fields' => array (
												'Estore_categories.id' 
										) 
								) );
								
								if ($po1 != null) {
									$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.catproduct_id' => $po1,
													'Estore_products.khoanggia' => $gia 
											),
											'limit' => '21',
											'order' => 'Estore_products.id DESC' 
									);
									$this->Estore_products->setDataEshop($hostname,$username,$password,$databasename);
									$this->set ( 'products', $this->paginate ( 'Estore_products', array () ) );
								} else {
									$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.catproduct_id' => $list_cat,
													'Estore_products.khoanggia' => $gia 
											),
											'limit' => '21',
											'order' => 'Estore_products.id DESC' 
									);
									$this->Estore_products->setDataEshop($hostname,$username,$password,$databasename);
									$this->set ( 'products', $this->paginate ( 'Estore_products', array () ) );
								}
							}
							if (($list_cat != "") && ($hsx != "") && ($gia != "")) {
								$this->Estore_categories->setDataEshop($hostname,$username,$password,$databasename);
								$po1 = $this->Estore_categories->find ( 'list', array (
										'conditions' => array (
												'Estore_categories.status' => 1,
												'Estore_categories.parent_id' => $list_cat 
										),
										'fields' => array (
												'Estore_categories.id' 
										) 
								) );
								
								if ($po1 != null) {
									$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.catproduct_id' => $po1,
													'Estore_products.khoanggia' => $gia,
													'Estore_products.manufacturer' => $hsx 
											),
											'limit' => '21',
											'order' => 'Estore_products.id DESC' 
									);
									$this->Estore_products->setDataEshop($hostname,$username,$password,$databasename);
									$this->set ( 'products', $this->paginate ( 'Estore_products', array () ) );
								} else {
									$this->paginate = array (
											'conditions' => array (
													'Estore_products.status' => 1,
													'Estore_products.catproduct_id' => $list_cat,
													'Estore_products.khoanggia' => $gia,
													'Estore_products.manufacturer' => $hsx 
											),
											'limit' => '21',
											'order' => 'Estore_products.id DESC' 
									);
									$this->Estore_products->setDataEshop($hostname,$username,$password,$databasename);
									$this->set ( 'products', $this->paginate ( 'Estore_products', array () ) );
								}
							}
							if (($list_cat == "") && ($hsx == "") && ($gia != "")) {
								$this->paginate = array (
										'conditions' => array (
												'Estore_products.status' => 1,
												'Estore_products.khoanggia' => $gia 
										),
										'limit' => '21',
										'order' => 'Estore_products.id DESC' 
								);
								$this->Estore_products->setDataEshop($hostname,$username,$password,$databasename);
								$this->set ( 'products', $this->paginate ( 'Estore_products', array () ) );
							}
							if (($list_cat == "") && ($hsx != "") && ($gia == "")) {
								
								$this->paginate = array (
										'conditions' => array (
												'Estore_products.status' => 1,
												'Estore_products.manufacturer' => $hsx 
										),
										'limit' => '21',
										'order' => 'Estore_products.id DESC' 
								);
								$this->Estore_products->setDataEshop($hostname,$username,$password,$databasename);
								$this->set ( 'products', $this->paginate ( 'Estore_products', array () ) );
							}
							if (($list_cat == "") && ($hsx != "") && ($gia != "")) {
								
								$this->paginate = array (
										'conditions' => array (
												'Estore_products.status' => 1,
												'Estore_products.manufacturer' => $hsx,
												'Estore_products.khoanggia' => $gia 
										),
										'limit' => '21',
										'order' => 'Estore_products.id DESC' 
								);
								$this->Estore_products->setDataEshop($hostname,$username,$password,$databasename);
								$this->set ( 'products', $this->paginate ( 'Estore_products', array () ) );
							}
							if (($list_cat == "") && ($hsx == "") && ($gia == "")) {
								
								$this->paginate = array (
										'conditions' => array (
												'Estore_products.status' => 1 
										),
										'limit' => '21',
										'order' => 'Estore_products.id DESC' 
								);
								$this->Estore_products->setDataEshop($hostname,$username,$password,$databasename);
								$this->set ( 'products', $this->paginate ( 'Estore_products', array () ) );
							}
							
							
						}
						function view($id = null) {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							// var_dump($id);die;
							mysql_query ( "SET names utf8" );
							if (! $id) {
								$this->Session->setFlash ( __ ( 'Không tồn tại', true ) );
								$this->redirect ( array (
										'action' => 'index' 
								) );
							}
							$this->set ( 'views', $this->Estore_product->read ( null, $id ) );
							$this->set ( 'news', $this->Estore_catproduct->read ( null, $id ) );
							$name = $this->Estore_product->read ( null, $id );
							
							$this->set ( 'views', $name );
							$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => $name ['Estore_product'] ['catproduct_id'],
											'Estore_product.id <>' => $name ['Estore_product'] ['id'] 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 8 
							);
							$this->set ( 'sanphamkhac', $this->paginate ( 'Estore_product', array () ) );
						}
						
						// shopping
						function addshopingcart($id = null) {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							
							$product = $this->Estore_product->read ( null, $id );
							
							if (! isset ( $_SESSION ['shopingcart'] )) {
								$_SESSION ['shopingcart'] = array ();
							}
							;
							
							if (isset ( $_SESSION ['shopingcart'] )) {
								
								$shopingcart = $_SESSION ['shopingcart'];
								if (isset ( $shopingcart [$id] )) {
									$shopingcart [$id] ['sl'] = $shopingcart [$id] ['sl'] + 1;
									$shopingcart [$id] ['total'] = $shopingcart [$id] ['price'] * $shopingcart [$id] ['sl'];
									$_SESSION ['shopingcart'] = $shopingcart;
									echo '<script language="javascript"> alert("Thêm thành công"); window.location.replace("' . DOMAIN .$shopname . '/viewshopingcart"); </script>';
								} else {
									$shopingcart [$id] ['pid'] = $id;
									$shopingcart [$id] ['name'] = $product ['Estore_product'] ['title'];
									$shopingcart [$id] ['images'] = $product ['Estore_product'] ['images'];
									$shopingcart [$id] ['sl'] = 1;
									$shopingcart [$id] ['price'] = $product ['Estore_product'] ['price'];
									$shopingcart [$id] ['total'] = $product ['Estore_product'] ['price'] * $shopingcart [$id] ['sl'];
									$_SESSION ['shopingcart'] = $shopingcart;
									echo '<script language="javascript" type="text/javascript"> alert("Thêm giỏ hàng thành công"); window.location.replace("' . DOMAIN .$shopname . '/viewshopingcart"); </script>';
								}
							}
						}
						function deleteshopingcart($id = null) {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							if (isset ( $_SESSION ['shopingcart'] )) {
								$shopingcart = $_SESSION ['shopingcart'];
								if (isset ( $shopingcart [$id] ))
									unset ( $shopingcart [$id] );
								$_SESSION ['shopingcart'] = $shopingcart;
								$this->redirect ( 'viewshopingcart' );
							}
						}
						function order($id = null) {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( "SET names utf8" );
							if (! $id) {
								$this->Session->setFlash ( __ ( 'Không tồn tại', true ) );
								$this->redirect ( array (
										'action' => 'index' 
								) );
							}
							$this->set ( 'buy', $this->Estore_news->read ( null, $id ) );
						}
						function viewshopingcart() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop View Shopping' );
							if (isset ( $_SESSION ['shopingcart'] )) {
								$shopingcart = $_SESSION ['shopingcart'];
								$this->set ( compact ( 'shopingcart' ) );
							} else {
								echo '<script language="javascript"> alert("Chua co san pham nao trong gio hang"); window.location.replace("' . DOMAIN .$shopname . '/index"); </script>';
							}
						}
						function updateshopingcart($id = null) {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							if (isset ( $_SESSION ['shopingcart'] )) {
								$shopingcart = $_SESSION ['shopingcart'];
								if (isset ( $shopingcart [$id] )) {
									$shopingcart [$id] ['sl'] = $_POST ['soluong'];
									$shopingcart [$id] ['total'] = $shopingcart [$id] ['sl'] * $shopingcart [$id] ['price'];
								}
								$_SESSION ['shopingcart'] = $shopingcart;
								
								$this->redirect ( 'viewshopingcart' );
							}
						}
						function buy() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							if (isset ( $_SESSION ['shopingcart'] )) {
								$shopingcart = $_SESSION ['shopingcart'];
								$this->set ( compact ( 'shopingcart' ) );
							} else {
								echo '<script language="javascript"> alert("Không có sản phẩm nào trong giỏ hàng của bạn"); window.location.replace("' . DOMAIN . '"); </script>';
							}
						}
						function category($id = null) {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( "SET names utf8" );
							if (! $id) {
								$this->Session->setFlash ( __ ( 'Không tồn tại', true ) );
								$this->redirect ( array (
										'action' => 'index' 
								) );
							}
							$this->set ( 'products', $this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'category_id' => $id 
									),
									'order' => 'Estore_product.id DESC' 
							) ) );
						}
						function getproduct($id = null) {
							return $this->Estore_product->read ( null, $id );
						}
						// +++++++++++++++++++++Infomation++++++++++++++++++++++++++++++++++++++
						/*
						 * function indexinfomation() { $shop=explode('/',$this->params['url']['url']); $shopname=$shop[0]; $shoparr=$this->get_shop_id($shopname); foreach($shoparr as $key=>$value){ $shop_id=$key; } $this->set ( 'shopname',$shopname); $this->set('title_for_layout', 'Đại lý - CÔNG TY THHH'); if(!$this->Session->read("user_id")){ echo "<script>location.href='".DOMAIN."login'</script>"; }else{ if($this->Session->read("check")==0){ $this->set('agents',$this->Agent->find('all')); }else{ $this->set('agents',$this->Agent->find('all',array('conditions'=>array('Agent.check_id'=>$this->Session->read("check"))))); } } } function viewinfomation($id=null) { $shop=explode('/',$this->params['url']['url']); $shopname=$shop[0]; $shoparr=$this->get_shop_id($shopname); foreach($shoparr as $key=>$value){ $shop_id=$key; } $this->set ( 'shopname',$shopname); mysql_query("SET names utf8"); $this->set('title_for_layout', 'Hỏi đáp - VIỆN KHOA HỌC VÀ CÔNG NGHỆ XÂY DỰNG GIAO THÔNG'); if (!$id) { $this->Session->setFlash(__('Không tồn tại', true)); $this->redirect(array('action' => 'index')); } $this->set('views', $this->Estore_news->read(null, $id)); $conditions=array('Estore_news.status'=>1,'Estore_news.category_id'=>149,'Estore_news.id <>'=>$id); $this->set('list_other',$this->Estore_news->find('all',array('conditions'=>$conditions,'order'=>'Estore_news.id DESC','limit'=>7))); }
						 */
						// ++++++++++++++++++++++++++++++Infomations+++++++++++++++++++++++++++++++++++++++++++++
						function indexinfomations() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							
							if (! $this->Session->read ( "email" )) {
								echo "<script>location.href='" . DOMAIN . "login'</script>";
							} else {
								
								$this->set ( 'infomations', $this->Estore_infomation->find ( 'all', array (
										'conditions' => array (
												'Estore_infomation.user_id' => $this->Session->read ( "id" ) 
										),
										'limit' => 10 
								) ) );
							}
						}
						function addinfomations() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							$uid = "id" . rand ( 1, 1000000 );
							$data ['Estore_infomation'] ['user_id'] = ($this->Session->read ( "id" ) != '' ? $this->Session->read ( "id" ) : $uid);
							$data ['Estore_infomation'] ['mobile'] = $_POST ['phone'];
							$data ['Estore_infomation'] ['address'] = $_POST ['address'];
							$data ['Estore_infomation'] ['email'] = $_POST ['email'];
							$data ['Estore_infomation'] ['name'] = $_POST ['name'];
							$data ['Estore_infomation'] ['phone'] = $_POST ['phone'];
							$data ['Estore_infomation'] ['total'] = $_POST ['total'];
							$this->Estore_infomation->save ( $data ['Estore_infomation'] );
							
							$info_id = $this->Estore_infomation->getLastInsertId ();
							
							$shopingcart = $_SESSION ['shopingcart'];
							// print_r($shopingcart);exit;
							$i = 0;
							foreach ( $shopingcart as $key ) {
								$this->Estore_infomationdetail->create ();
								$data ['Estore_infomationdetail'] ['infomations_id'] = $info_id;
								$data ['Estore_infomationdetail'] ['product_id'] = $key ['pid'];
								$data ['Estore_infomationdetail'] ['name'] = $key ['name'];
								$data ['Estore_infomationdetail'] ['images'] = $key ['images'];
								$data ['Estore_infomationdetail'] ['quantity'] = $key ['sl'];
								$data ['Estore_infomationdetail'] ['price'] = $key ['price'];
								$this->Estore_infomationdetail->save ( $data ['Estore_infomationdetail'] );
								$i ++;
							}
							
							unset ( $_SESSION ['shopingcart'] );
							echo '<script language="javascript">alert("cảm ơn bạn đã đặt hàng  chúng tôi sẽ liên hệ với bạn trong vòng 24h"); location.href="' . DOMAIN .$shopname . '/index";</script>';
						}
						function deleteinfomations($id = null) {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							if (empty ( $id )) {
								$this->Session->setFlash ( __ ( 'Khôn tồn tại danh mục này', true ) );
								// $this->redirect(array('action'=>'index'));
							}
							if ($this->Infomations->delete ( $id )) {
								$this->Session->setFlash ( __ ( 'Xóa danh mục thành công', true ) );
								$this->redirect ( array (
										'action' => 'indexinfomations' 
								) );
							}
							$this->Session->setFlash ( __ ( 'Danh mục không xóa được', true ) );
							$this->redirect ( array (
									'action' => 'indexinfomations' 
							) );
						}
						// +++++++++++++++++++++++++++++++News+++++++++++++++++++++++++++++++++++++++++++++++++++++++
						function indexnews() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( "SET names utf8" );
							$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 156 
									),
									'limit' => '5',
									'order' => 'Estore_news.id DESC' 
							);
							$this->set ( 'news', $this->paginate ( 'Estore_news', array () ) );
						}
						function tintucnoibat() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( "SET names utf8" );
							$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 221 
									),
									'limit' => '6',
									'order' => 'Estore_news.id DESC' 
							);
							$this->set ( 'news', $this->paginate ( 'Estore_news', array () ) );
						}
						function promotion() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( "SET names utf8" );
							$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 222 
									),
									'limit' => '6',
									'order' => 'Estore_news.id DESC' 
							);
							$this->set ( 'news', $this->paginate ( 'Estore_news', array () ) );
						}
						function danceclass() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( "SET names utf8" );
							$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 223 
									),
									'limit' => '6',
									'order' => 'Estore_news.id DESC' 
							);
							$this->set ( 'news', $this->paginate ( 'Estore_news', array () ) );
						}
						
						function listnews($id=null) {
							//layout
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							
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
							
							$this->Estore_news->setDataEshop($hostname,$username,$password,$databasename);
							
							//$Estoreshopnews = $this->Estore_news->find('all');
							//pr($Estoreshopnews);
							
							mysql_query("SET names utf8");
							$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => $id 
									),
									'limit' => '10',
											'order' => 'Estore_news.id DESC' 
									);

							$this->set('listnews', $this->paginate('Estore_news',array()));
							
							$this->Estore_categories->setDataEshop($hostname,$username,$password,$databasename);
							$this->set('cat',$this->Estore_categories->read(null,$id));
						}

						function getmodolnews()
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
							
							$this->Estore_news->setDataEshop($hostname,$username,$password,$databasename);
							
							$Estoreshopnews = $this->Estore_news->find('all');
							
							pr($Estoreshopnews);
							$this->set('Estoreshopnews', $Estoreshopnews);
						}
						
						function souvenir() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( "SET names utf8" );
							$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 213 
									),
									'limit' => '5',
									'order' => 'Estore_news.id DESC' 
							);
							$this->set ( 'news', $this->paginate ( 'Estore_news', array () ) );
						}
						function recruitment() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( "SET names utf8" );
							$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 220 
									),
									'limit' => '5',
									'order' => 'Estore_news.id DESC' 
							);
							$this->set ( 'news', $this->paginate ( 'Estore_news', array () ) );
						}
						function services() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( "SET names utf8" );
							$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 227 
									),
									'limit' => '7',
									'order' => 'Estore_news.id DESC' 
							);
							$this->set ( 'news', $this->paginate ( 'Estore_news', array () ) );
						}
						function dichvu() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( "SET names utf8" );
							$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 224 
									),
									'limit' => '7',
									'order' => 'Estore_news.id DESC' 
							);
							$this->set ( 'news', $this->paginate ( 'Estore_news', array () ) );
						}
						function ticket() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach ve may bay
							mysql_query ( "SET names utf8" );
							$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 214 
									),
									'limit' => '8',
									'order' => 'Estore_news.id DESC' 
							);
							$this->set ( 'ticket', $this->paginate ( 'Estore_news', array () ) );
						}
						function hotel() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach khach san
							mysql_query ( "SET names utf8" );
							$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 215 
									),
									'limit' => '8',
									'order' => 'Estore_news.id DESC' 
							);
							$this->set ( 'hotel', $this->paginate ( 'Estore_news', array () ) );
						}
						function carnews() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach xe du lich
							mysql_query ( "SET names utf8" );
							$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 216 
									),
									'limit' => '8',
									'order' => 'Estore_news.id DESC' 
							);
							$this->set ( 'car', $this->paginate ( 'Estore_news', array () ) );
						}
						function visa() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach ho chieu
							mysql_query ( "SET names utf8" );
							$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 217 
									),
									'limit' => '8',
									'order' => 'Estore_news.id DESC' 
							);
							$this->set ( 'visa', $this->paginate ( 'Estore_news', array () ) );
						}
						function capacity() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( "SET names utf8" );
							$news = $this->Category->find ( 'list', array (
									'conditions' => array (
											'Category.parent_id' => 171 
									),
									'fields' => array (
											'Category.id' 
									) 
							) );
							$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => $news 
									),
									'limit' => '8',
									'order' => 'Estore_news.id DESC' 
							);
							$this->set ( 'capacity', $this->paginate ( 'Estore_news', array () ) );
						}
						function addview($id = null) {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							// var_dump($this->data);die;
							$data = $this->Estore_news->read ( null, $_POST ['id'] );
							$data ['Estore_news'] ['view'] = $data ['Estore_news'] ['view'] + 1;
							$this->Estore_news->save ( $data ['Estore_news'] );
						}
						function view1($id = null) {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( "SET names utf8" );
							$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => $id 
									),
									'limit' => '1',
									'order' => 'Estore_news.id DESC' 
							);
							$this->set ( 'recruitment', $this->paginate ( 'Estore_news', array () ) );
							$this->set ( 'cat', $this->Category->read ( null, $id ) );
						}
						function viewnews($id = null) {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							//pr($shopname);
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $value['Shop']['id'];
							}
							$this->set ( 'shopname', $shopname );
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( "SET names utf8" );
							
							if (! $id) {
								$this->Session->setFlash ( __ ( 'Không tồn tại', true ) );
								$this->redirect ( array (
										'action' => 'index' 
								) );
							}
// 							$x = $this->Estore_news->read ( null, $id );
							//$this->set ( 'views', $x );
							
							$sql_exc = "SELECT estore_news.*
									 FROM  estore_news
									 WHERE estore_news.id = ".(int)$id." AND estore_news.status = 1 AND estore_news.category_id= 156  LIMIT 10";
							$result = $this->connectiondatabase($sql_exc);
							$this->set ( 'views', $result );
							
							//+++ get new other - lien quan
							$sql_exc_other = "SELECT estore_news.*
									 FROM  estore_news
									 WHERE estore_news.status = 1 AND estore_news.category_id= 156  LIMIT 10";
							$result_other = $this->connectiondatabase($sql_exc_other);
// 							echo "Other news </br>";
// 							pr($result_other);
							$this->set ( 'list_other', $result_other);
						}
						function searchnews($name_search = null) {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
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
							//set data news eshop	
							$this->Estore_news->setDataEshop($hostname,$username,$password,$databasename);
							
							$this->set ( 'shopname', $shopname );
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( "SET names utf8" );
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
						function thongtin() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( "SET names utf8" );
							$x = $this->Estore_setting->read ( null, 1 );
							$this->set ( 'views', $x );
						}
                        // +++++++++++++++++++++++++++++++++++++Comments+++++++++++++++++++++++++++++++++++++++++++++++++++++++
						function indexcommentstwo() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							$this->paginate = array (
									'conditions' => array (
											'Estore_comments.status' => 1 
									),
									'limit' => '4',
									'order' => 'Estore_comments.id DESC' 
							);
							$this->set ( 'comment', $this->paginate ( 'Estore_comments', array () ) );
						}
						function indexcomments() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							$this->paginate = array (
									'conditions' => array (
											'Estore_comments.status' => 1 
									),
									'limit' => '4',
									'order' => 'Estore_comments.id DESC' 
							);
							$this->set ( 'comment', $this->paginate ( 'Estore_comments', array () ) );
						}
						// them danh muc moi
						function addcomments() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							if (! empty ( $this->data )) {
								// if($this->Session->read('security_code')==$_POST['security']){
								
								$data ['Estore_comments'] = $this->data ['Estore_comments'];
								if ($this->Estore_comments->save ( $data ['Estore_comments'] )) {
									$this->Session->setFlash ( __ ( 'Thêm mới comments thành công', true ) );
									// $this->redirect(array('action' => 'index'));
									echo '<script language="javascript"> location.href="' . DOMAIN .$shopname . '/indexcomments";</script>';
								} else {
									$this->Session->setFlash ( __ ( 'Thêm mơi comments thất bại. Vui long thử lại', true ) );
								}
								
								// }
								/*
								 * if($this->Session->read('security_code')!=$_POST['security']){ echo "<script>alert('".json_encode('Ban nhập không đúng mã bảo vệ !')."');</script>"; echo "<script>history.back(-1);</script>"; }
								 */
							}
						}
						// +++++++++++++++++++++++++Contacts+++++++++++++++++++++++++++++++++++++++++++++++
						function sendcontacts() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( "SET NAMES 'utf8'" );
							mysql_query ( "SET character_set_client=utf8" );
							mysql_query ( "SET character_set_connection=utf8" );
							$x = $this->Estore_setting->read ( null, 1 );
							if (isset ( $_POST ['name'] )) {
								$name = $_POST ['name'];
								
								$mobile = $_POST ['phone'];
								$email = $_POST ['email'];
								$title = $_POST ['title'];
								$content = $_POST ['content'];
								
								$this->Email->from = $name . '<' . $email . '>';
								$this->Email->to = $x ['Estore_setting'] ['email'];
								$this->Email->subject = $title;
								$this->Email->template = 'default';
								$this->Email->sendAs = 'both';
								$this->set ( 'name', $name );
								$this->set ( 'mobile', $mobile );
								$this->set ( 'email', $email );
								$this->set ( 'content', $content );
								
								// pr($this->Email->send());die;
								if ($this->Email->send ()) {
									// $this->Session->setFlash(__('Thêm mới danh mục thành công', true));
									echo '<script language="javascript"> alert("Gửi mail thành công"); location.href="' . DOMAIN . '";</script>';
								} else
									// $this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
									// echo '<script language="javascript"> alert("gửi mail không thành công"); //location.href="'.DOMAIN.'";</script>';
									echo '<script language="javascript"> alert("gửi mail không thành công"); </script>';
							}
						}
						function dathangcontacts() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							$this->layout = 'themeshop/estorecreatnanedata';
							$this->set ( 'title_for_layout', 'e-shop' );
							
							mysql_query ( "SET NAMES 'utf8'" );
							mysql_query ( "SET character_set_client=utf8" );
							mysql_query ( "SET character_set_connection=utf8" );
							// $x=$this->Helps->read(null,1);
							if (isset ( $_SESSION ['shopingcart'] )) {
								$shopingcart = $_SESSION ['shopingcart'];
								$this->set ( compact ( 'shopingcart' ) );
							} else {
								echo '<script language="javascript"> alert("Chua co san pham nao trong gio hang"); window.location.replace("' . DOMAIN . '"); </script>';
							}
							if (isset ( $_POST ['name'] )) {
								$name = $_POST ['name'];
								$mobile = $_POST ['phone'];
								$email = $_POST ['email'];
								$title = $_POST ['title'];
								$content = $_POST ['content'];
								
								$images = $_POST ['images'];
								$product_name = $_POST ['product_name'];
								$product_sl = $_POST ['product_sl'];
								$price = $_POST ['price'];
								$total = $_POST ['total'];
								$this->Email->from = $name . '<' . $email . '>';
								$this->Email->to = '';
								$this->Email->subject = $title;
								$this->Email->template = 'default';
								$this->Email->sendAs = 'both';
								$this->set ( 'name', $name );
								$this->set ( 'mobile', $mobile );
								$this->set ( 'email', $email );
								$this->set ( 'content', $content );
								
								$this->set ( 'images', $images );
								$this->set ( 'product_name', $product_name );
								$this->set ( 'product_sl', $product_sl );
								$this->set ( 'price', $price );
								$this->set ( 'total', $total );
								
								$this->set ( 'sang', array (
										'images',
										'product_name',
										'product_sl',
										'price',
										'total' 
								) );
								
								if ($this->Email->send ()) {
									$this->Session->setFlash ( __ ( 'Thêm mới danh mục thành công', true ) );
									echo '<script language="javascript"> alert("Gửi mail thành công"); </script>';
									unset ( $_SESSION ['shopingcart'] );
									echo '<script language="javascript">location.href="' . DOMAIN . '";</script>';
								} else
									$this->Session->setFlash ( __ ( 'Thêm mơi danh mục thất bại. Vui long thử lại', true ) );
								echo '<script language="javascript"> alert("gửi mail không thành công"); location.href="' . DOMAIN . '";</script>';
							}
						}
					 }
?>
