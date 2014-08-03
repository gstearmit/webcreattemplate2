<?php

						  class Eshop0309Controller extends AppController {
						  var $name = 'Eshop0309';
						  	var $uses = array (
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
						// product
						var $helpers = array (
								'Html',
								'Ajax',
								'Javascript' 
						);
						
						function creatnewdatabase()
						{
							$sqlArr = array();
							$sqlArr[]="CREATE DATABASE IF NOT EXISTS `testqd_eshopbepga` /*!40100 DEFAULT CHARACTER SET utf8 */;";
							$sqlArr[]="USE `testqd_eshopbepga`;";
									
							$sqlArr[]="CREATE TABLE IF NOT EXISTS `estore_advertisements` (
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
// 							$db = ConnectionManager::config('defaultnew', array(
// 									'className' => 'Cake\Database\Connection',
// 									'driver' => 'Cake\Database\Driver\Mysql',
// 									'persistent' => false,
// 									'host' => 'localhost',
// 									'login' => 'root',
// 									'password' => '',
// 									//'database' => 'my_app',
// 									'prefix' => false,
// 									'encoding' => 'utf8',
// 									'timezone' => 'UTC',
// 									'cacheMetadata' => true,
// 							));
							$db = ConnectionManager::getDataSource('default');
							//$nameLangueCopy = $db->rawQuery($sql);
							try {
								foreach ($sqlArr as $sql) {
									$db->rawQuery($sql);
								}
								$nameLangueCopy = "Sucessfull";
							} catch (\Exception $exc) {
								$nameLangueCopy = $exc->getMessage();
							
							}	
						}
						
						function sqlview()
						{
						
							$shop_id = 180;
							$arrSql = array();
$arrSql[] ="INSERT INTO `estore_advertisements` ( `estore_id`, `name`, `link`, `images`, `created`, `modified`, `status`, `display`) VALUES
	($shop_id, 'cong ty abc', 'http://zing.vn', 'img/gallery/88654b0d4c2e2d7b8a4fd519f870c2b3.jpg', '2011-10-03', '2012-09-14', 1, 1),
	($shop_id, 'quang cao', 'http://dantri.com.vn', 'img/gallery/19c4d76ab1090e42cd476cf7974f419c.jpg', '2011-10-03', '2012-09-14', 1, 2),
	($shop_id, 'cong ty abc', 'http://zing.vn', 'img/gallery/aed5ce1f0358efc5b80877da0fd817d8.jpg', '2011-10-03', '2012-09-14', 1, 0),
	($shop_id, 'zx', 'http://agribank.com.vn', 'img/gallery/69dbb1013ad45d844e128bd7facea6ee.jpg', '2012-09-14', '2012-09-14', 1, 2),
	($shop_id, 'zx', 'http://agribank.com.vn', 'img/gallery/69dbb1013ad45d844e128bd7facea6ee.jpg', '2012-09-14', '2012-09-14', 1, 2),
	($shop_id, 'quang cao', 'http://truongthanhauto.com.vn', 'img/gallery/69dbb1013ad45d844e128bd7facea6ee.jpg', '2012-09-14', '2012-09-14', 1, 2),
	($shop_id, 'asdasd', 'http://duhocdailoan.info', 'img/gallery/8dc8529c47186151846ae23b345e835b.jpg', '2012-09-14', '2012-09-14', 1, 3),
	($shop_id, 'asdsd', 'http://dantri.com.vn', 'img/gallery/1cf5b8f4b563947b0c3b8c29142215c9.jpg', '2012-09-14', '2012-09-14', 1, 3),
	($shop_id, 'asdasd', 'http://zing.vn', 'img/gallery/8dc8529c47186151846ae23b345e835b.jpg', '2012-09-14', '2012-09-14', 1, 3);";

$arrSql[]="INSERT INTO `estore_albums` (`estore_id`, `tt`, `parent_id`, `lft`, `rght`, `name`, `created`, `modified`, `status`, `name_eg`, `images`) VALUES
	($shop_id, NULL, NULL, 1, 2, 'Ảnh khánh thành dây truyền mới', '2012-05-07', '2012-06-18', 1, 'Picture of new line inauguration', 'img/upload/product/2a1bd4f22b63ff775ad0cc8db96591aa.jpg'),
	($shop_id, NULL, NULL, 3, 4, 'Họp ngày 30/04/2012', '2012-05-08', '2012-06-18', 1, 'on 30th April, 2012', 'img/upload/product/102e31ae3f441fbcb391f9e5a26bcbb9.jpg');";

$arrSql[]="INSERT INTO `estore_banners` (`estore_id`, `name`, `images`, `created`, `status`) VALUES
	($shop_id, 'banner', 'img/gallery/af69e2816dec568215d831d8457b36eb.jpg', '2011-10-02 18:16:41', 1);";

$arrSql[]="INSERT INTO `estore_categories` (`estore_id`, `tt`, `parent_id`, `lft`, `rght`, `name`, `name_en`, `created`, `modified`, `status`, `images`, `alias`) VALUES
	($shop_id, 0, 224, 16, 17, 'GIỚI THIỆU', 'ABOUT US', '2011-09-27', '2012-09-14', 1, '', 'gioi-thieu'),
	($shop_id, 3, 224, 2, 7, 'KHUYẾN MÃI', 'PROMOTION', '2011-09-27', '2012-09-14', 1, '', 'khuyen-mai'),
	($shop_id, NULL, NULL, 1, 18, 'DANH MỤC TIN TỨC - DỊCH VỤ - TƯ VẤN', 'NEWS-SERVICE-CONSULTANCY CATEGORY', '2012-07-23', '2012-09-14', 1, '', 'danh-muc-tin-tuc-dich-vu-tu-van'),
	($shop_id, 4, 224, 14, 15, 'TUYỂN DỤNG', 'RECRUITMENT', '2012-07-23', '2012-09-14', 1, '', 'tuyen-dung'),
	($shop_id, 1, 224, 8, 9, 'DỊCH VỤ', 'SERVICE', '2012-07-23', '2012-09-14', 1, '', 'dich-vu'),
	($shop_id, 2, 224, 10, 11, 'TƯ VẤN', 'CONSULTANCY', '2012-07-23', '2012-09-14', 1, '', 'tu-van'),
	($shop_id, 5, 224, 12, 13, 'TRỢ GIÚP', 'HELP', '2012-07-23', '2012-09-14', 1, '', 'tro-giup');";

$arrSql[]="INSERT INTO `estore_catproducts` (`estore_id`, `parent_id`, `lft`, `rght`, `name`, `name_en`, `created`, `modified`, `status`, `char`, `images`, `alias`) VALUES
	($shop_id, NULL, 1, 48, 'Danh mục sản phẩm', 'Product category', '2012-02-19', '2012-09-13 16:07:33', 1, NULL, '', 'danh-mục-sản-phảm'),
	($shop_id, 11, 2, 11, 'BẾP GA', 'GAS STOVE', '2012-07-29', '2012-09-13 16:54:57', 1, NULL, '', 'bép-ga'),
	($shop_id, 39, 9, 10, 'Bếp ga du lịch', 'Travel gas stove', '2012-07-29', '2012-09-13 16:41:21', 1, NULL, '', 'bép-ga-du-lịch'),
	($shop_id, 11, 12, 21, 'MÁY HÚT KHÓI KHỬ MÙI', 'MACHINE HOODS', '2012-08-06', '2012-09-13 16:11:10', 1, NULL, '', 'máy-hút-khói-khủ-mùi'),
	($shop_id, 11, 38, 47, 'BÌNH GA & LINH KIỆN', 'GAS CONTAINER & COMPONENTS', '2012-08-06', '2012-09-13 16:55:12', 1, NULL, '', 'bình-ga-linh-kiẹn'),
	($shop_id, 117, 40, 41, 'Bình ga 13kg', 'Gas container 13kg', '2012-09-14', '2012-09-14 12:01:37', 1, NULL, '', 'binh-ga-13kg'),
	($shop_id, 117, 42, 43, 'Bình ga 14kg', 'Gas container 14kg', '2012-09-14', '2012-09-14 12:14:16', 1, NULL, '', 'binh-ga-14kg'),
	($shop_id, 39, 5, 6, 'Bếp ga dương', 'Positive gas stove', '2012-08-23', '2012-09-13 16:17:46', 1, NULL, 'img/upload/1c1e93203afe53fb5cda97210c838108.png', 'bép-ga-duong'),
	($shop_id, 39, 3, 4, 'Bếp ga âm', 'Negative gas stove', '2012-08-23', '2012-09-13 16:17:11', 1, NULL, 'img/upload/ce7e12c2374be3da8770b3d3f85b14f4.png', 'bép-ga-am'),
	($shop_id, 11, 22, 31, 'THẾ GIỚI TỦ BẾP', 'WORLD OF KITCHEN CABINETS', '2012-09-13', '2012-09-13 16:30:45', 1, NULL, '', 'thé-giói-tủ-bép'),
	($shop_id, 11, 32, 37, 'BẾP CÔNG NGHIỆP', 'INDUSTRIAL STOVE', '2012-09-13', '2012-09-13 16:14:07', 1, NULL, '', 'bép-cong-nghiẹp'),
	($shop_id, 39, 7, 8, 'Bếp ga đơn', 'Singer gas stove', '2012-09-13', '2012-09-13 16:19:04', 1, NULL, 'img/upload/181885ec49984106001d4b1bb0cb9e78.jpg', 'bép-ga-don'),
	($shop_id, 106, 23, 24, 'Tủ bếp dạng chữ G', 'G-shaped kitchen cabinet', '2012-09-13', '2012-09-13 16:24:32', 1, NULL, '', 'tủ-bép-dạng-chũ-g'),
	($shop_id, 106, 25, 26, 'Tủ bếp dạng chữ L', 'L-shaped kitchen cabinet', '2012-09-13', '2012-09-13 16:24:54', 1, NULL, '', 'tủ-bép-dạng-chũ-l'),
	($shop_id, 106, 27, 28, 'Tủ bếp dạng chữ I', 'I-shaped kitchen cabinet', '2012-09-13', '2012-09-13 16:25:12', 1, NULL, '', 'tủ-bép-dạng-chũ-i'),
	($shop_id, 106, 29, 30, 'Tủ bếp dạng chữ U', 'U-shaped kitchen cabinet', '2012-09-13', '2012-09-13 16:25:28', 1, NULL, '', 'tủ-bép-dạng-chũ-u'),
	($shop_id, 97, 13, 14, 'Hút mùi cổ điển', 'Classic hood', '2012-09-13', '2012-09-13 16:32:48', 1, NULL, '', 'hut-mui-co-dien'),
	($shop_id, 97, 15, 16, 'Hút mùi âm tủ', 'Negative hood', '2012-09-13', '2012-09-13 16:33:14', 1, NULL, '', 'hut-mui-am-tu'),
	($shop_id, 97, 17, 18, 'Hút mùi ống khói', 'chimney hood', '2012-09-13', '2012-09-13 16:33:28', 1, NULL, '', 'hut-mui-ong-khoi'),
	($shop_id, 97, 19, 20, 'Hút mùi đảo', 'Swivel hood', '2012-09-13', '2012-09-13 16:33:59', 1, NULL, '', 'hut-mui-dao'),
	($shop_id, 98, 39, 44, 'Bình ga', 'Gas container', '2012-09-13', '2012-09-13 16:35:02', 1, NULL, '', 'bình-ga'),
	($shop_id, 98, 45, 46, 'Van điều áp gas', 'Gas valve', '2012-09-13', '2012-09-13 16:35:27', 1, NULL, '', 'van-dieu-ap-gas'),
	($shop_id, 107, 33, 34, 'Bếp cho quán ăn', 'Stove for mini-restaurant', '2012-09-13', '2012-09-13 16:37:59', 1, NULL, '', 'bép-cho-quán-an'),
	($shop_id, 107, 35, 36, 'Bếp cho nhà hàng', 'Stove for restaurant', '2012-09-13', '2012-09-13 16:38:17', 1, NULL, '', 'bép-cho-nhà-hàng');";

$arrSql[]="INSERT INTO `estore_comments` (`estore_id`, `title`, `name`, `content`, `id_news`, `user_id`, `email`, `created`, `status`) VALUES
	($shop_id, '', 'Nguyễn hải', 'Chất lượng moto rất tốt', 0, 0, 'hai@gmail.com', '2012-07-26 01:25:36', 1),
	($shop_id, '', 'Nguyễn Nam', 'Kiểu dáng thật tuyệt', 0, 0, 'nguyennam@gmail.com', '2012-07-26 01:17:16', 1),
	($shop_id, '', 'Nguyễn Thanh Tùng', 'Tôi muốn mua xe iata xin hướng dẫn cho tôi', 0, 0, 'nt2ungvn@gmail.com', '2012-07-26 01:38:49', 1),
	($shop_id, '', 'Hồ Hoài', 'Chất lượng của công ty phục vụ rất rốt!', 0, 0, 'hohoai@yahoo.com', '2012-07-26 02:24:11', 0),
	($shop_id, '', 'Hương', 'Các bạn thử tới công ty nhé\', ở nơi này có rất nhiều cảnh đẹp. Con người rất ôn hòa!', 0, 0, 'huong86@yahoo.com', '2012-07-26 02:29:13', 1),
	($shop_id, '', 'Hoàng Phúc', 'Hoàng Phúc', 0, 0, 'phuca4@gmail.com', '2014-07-27 03:04:51', 1),
	($shop_id, '', 'Hay đó nhé', 'Uh hay Lắm đó', 0, 0, 'phuca4@gmail.com', '2014-07-27 03:06:08', 1);";

$arrSql[]="INSERT INTO `estore_contacts` (`estore_id`, `name`, `email`, `mobile`, `fax`, `company`, `title`, `content`, `content_send`, `created`, `modified`, `status`) VALUES
	($shop_id, 'Hoàng Công Phúc', 'phua4@gmail.com', '01688504263', '09487547584', 'Công ty abc', 'Chúc may mắn', 'dang test mail', '<p>\r\n	you are me and i am you</p>\r\n', '2011-07-04', '2011-07-04', 1);";

$arrSql[]="INSERT INTO `estore_galleries` (`estore_id`, `name`, `images`, `created`, `modified`, `status`, `album_id`) VALUES
	($shop_id, 'anh 4', 'img/gallery/43d68f446ea7527b3dc6daddc6dc80df.jpg', '2012-06-19', '2012-06-19', 1, 204),
	($shop_id, 'anh 5', 'img/gallery/2cf9661dce136d9f6ca6bfce24933a71.jpg', '2012-06-19', '2012-06-19', 1, 204),
	($shop_id, 'anh 3', 'img/gallery/0452ded776f37827ca4887da56816ba8.jpg', '2012-05-08', '2012-06-19', 1, 206),
	($shop_id, 'anh 2', 'img/gallery/e19281319ecba7282bcd8239287056d7.jpg', '2012-05-08', '2012-06-19', 1, 206),
	($shop_id, 'Anh dep', 'img/gallery/7db208fcf126d1bb3cfee4c6b6bacf62.jpg', '2012-05-08', '2012-06-19', 1, 206);";
		
$arrSql[]="INSERT INTO `estore_helps` (`estore_id`, `title`, `title_en`, `user_support`, `user_yahoo`, `user_skype`, `user_mobile`, `user_email`, `hotline`, `created`, `modified`, `status`, `user_yahoo1`, `user_yahoo2`, `user_yahoo3`) VALUES
	($shop_id, 'Tư vấn', 'Support', 'Hoàng Công Phúc', 'adv.golbalmedia2', 'adv.golbalmedia2', '043.8281.768', 'phuca4@gmail.com', '043.8281.768', '2012-06-14 11:19:25', '2014-07-27 17:57:17', 1, 'phuca478', 'phuca478', 'phuca478'),
	($shop_id, 'Kỹ Thuật', 'Technology', 'Mr. Phúc', 'adv.golbalmedia2', 'adv.golbalmedia2', '01229525955', 'phuca4@gmail.com', NULL, '2012-08-22 12:03:14', '2014-07-27 17:57:26', 1, 'phuca478', 'phuca478', 'phuca478');";

							$db = ConnectionManager::getDataSource('default');
							//$nameLangueCopy = $db->rawQuery($sql);
							try {
								foreach ($arrSql as $sql) {
									$db->rawQuery($sql);
									}
								$nameLangueCopy = "Sucessfull";
							} catch (\Exception $exc) {
								$nameLangueCopy = $exc->getMessage();
								
							}
							
							
						}
						
						function testtting()
						{
							
						
							$dir =  dirname(dirname(dirname(__FILE__)));
							$dir_cake_lib = $dir.'\cake\libs\model\datasources\dbo';
							$fileimport = $dir_cake_lib.'\dbo_mssql.php';
							pr($dir);
							pr($dir_cake_lib);
							if(file_exists($fileimport)) 
							{
								pr(file_exists($fileimport));
								include_once $fileimport;
								//$DboMysql = new DboMysqlBase();
								//$DboMysql->
								
								$sql = "CREATE TABLE IF NOT EXISTS `testdata` (
										  `id` int(11) NOT NULL AUTO_INCREMENT,
										  `name` varchar(256) CHARACTER SET utf8 NOT NULL,
										  `link` varchar(256) CHARACTER SET ucs2 NOT NULL,
										  `images` varchar(256) CHARACTER SET utf8 NOT NULL,
										  `created` date NOT NULL,
										  `modified` date NOT NULL,
										  `status` int(2) NOT NULL,
										  PRIMARY KEY (`id`),
										  UNIQUE KEY `id` (`id`)
										) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;";
								
								$db = ConnectionManager::getDataSource('default');
								$result =$db->rawQuery($sql);
								pr($result);
							}
							
							die;
							
						}
						var $components = array (
								'RequestHandler',
								'Email' 
						);
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
						// tin tuc
						function menucategory() {
							mysql_query ( "SET names utf8" );
							return $this->Estore_category->find ( 'all', array (
									'conditions' => array (
											'Estore_category.status' => 1,
											'Estore_category.parent_id' => null 
									),
									'order' => 'Estore_category.tt ASC' 
							) );
						}
						function showcategory($id = null) {
							mysql_query ( "SET names utf8" );
							return $this->Estore_category->find ( 'all', array (
									'conditions' => array (
											'Estore_category.parent_id ' => $id 
									),
									'order' => 'Estore_category.tt ASC' 
							) );
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
						function banner() {
							return $this->Estore_banner->find ( 'all', array (
									'conditions' => array (
											'Estore_banner.status' => 1 
									),
									'order' => 'Estore_banner.id DESC' 
							) );
						}
						function setting() {
							return $this->Estore_setting->find ( 'all', array (
									'conditions' => array (),
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
						function helpsonline() {
							return $this->Estore_helps->find ( 'all', array (
									'conditions' => array (
											'Estore_helps.status' => 1 
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
						function hotnew() {
							return $this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 156 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 6 
							) );
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
						function videos() {
							mysql_query ( "SET names utf8" );
							return $this->Estore_video->find ( 'all', array (
									'conditions' => array (
											'Estore_video.status' => 1,
											'Estore_video.left' => 0 
									),
									'order' => 'Estore_video.id DESC',
									'limit' => 1 
							) );
						}
						function videosright() {
							mysql_query ( "SET names utf8" );
							return $this->Estore_video->find ( 'all', array (
									'conditions' => array (
											'Estore_video.status' => 1,
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
							return $this->Estore_catproduct->find ( 'all', array (
									'conditions' => array (
											'Estore_catproduct.parent_id ' => $id 
									),
									'order' => 'Estore_catproduct.id ASC' 
							) );
						}
						function showsmenu2($id = null) {
							return $this->Estore_catproduct->find ( 'all', array (
									'conditions' => array (
											'Estore_catproduct.parent_id ' => $id 
									),
									'order' => 'Estore_catproduct.id ASC' 
							) );
						}
						function danhmuc() {
							return $this->Estore_catproduct->find ( 'all', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => 11 
									),
									'order' => 'Estore_catproduct.name ASC' 
							) );
						}
						function typical() {
							return $this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1 
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
						function advf() {
							return $this->Estore_advertisement->find ( 'all', array (
									'conditions' => array (
											'Estore_advertisement.status' => 1,
											'Estore_advertisement.display' => 2 
									),
									'order' => 'Estore_advertisement.id ASC' 
							) );
						}
						function advr() {
							return $this->Estore_advertisement->find ( 'all', array (
									'conditions' => array (
											'Estore_advertisement.status' => 1,
											'Estore_advertisement.display' => 3 
									),
									'order' => 'Estore_advertisement.id ASC' 
							) );
						}
						
						// +++++++++++++++++++++++++++++++++++Home+++++++++++++++++++++++++++++++++++++++++++++++
						// home
						function index() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							$this->layout = 'themeshop/home';
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
						
						// ---------------------- end home ---------------------------------------
						
						// ++++++++++++++++++++++++++++++Product++++++++++++++++++++++++++++++++++++++++
						function indexproduct() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/home';
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
							
							$this->layout = 'themeshop/home';
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
							
							$this->layout = 'themeshop/home';
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
							
							$this->layout = 'themeshop/home';
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
							
							$this->layout = 'themeshop/home';
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
							
							$this->layout = 'themeshop/home';
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
							
							$this->layout = 'themeshop/home';
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
							
							$this->layout = 'themeshop/home';
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
							
							$this->layout = 'themeshop/home';
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
							
							$this->layout = 'themeshop/home';
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
							
							$this->layout = 'themeshop/home';
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
							
							$this->layout = 'themeshop/home';
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
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/home';
							$this->set ( 'title_for_layout', 'e-shop' );
							$this->loadModel ( "Estore_catproduct" );
							
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
								$po1 = $this->Estore_catproduct->find ( 'list', array (
										'conditions' => array (
												'Estore_catproduct.status' => 1,
												'Estore_catproduct.parent_id' => $list_cat 
										),
										'fields' => array (
												'Estore_catproduct.id' 
										) 
								) );
								
								if ($po1 != null) {
									$this->paginate = array (
											'conditions' => array (
													'Estore_product.status' => 1,
													'Estore_product.catproduct_id' => $po1 
											),
											'limit' => '21',
											'order' => 'Estore_product.id DESC' 
									);
									$this->set ( 'products', $this->paginate ( 'Estore_product', array () ) );
								} else {
									$this->paginate = array (
											'conditions' => array (
													'Estore_product.status' => 1,
													'Estore_product.catproduct_id' => $list_cat 
											),
											'limit' => '21',
											'order' => 'Estore_product.id DESC' 
									);
									$this->set ( 'products', $this->paginate ( 'Estore_product', array () ) );
								}
							}
							
							if (($list_cat != "") && ($hsx != "") && ($gia == "")) {
								$po1 = $this->Estore_catproduct->find ( 'list', array (
										'conditions' => array (
												'Estore_catproduct.status' => 1,
												'Estore_catproduct.parent_id' => $list_cat 
										),
										'fields' => array (
												'Estore_catproduct.id' 
										) 
								) );
								
								if ($po1 != null) {
									$this->paginate = array (
											'conditions' => array (
													'Estore_product.status' => 1,
													'Estore_product.catproduct_id' => $po1,
													'Estore_product.manufacturer' => $hsx 
											),
											'limit' => '21',
											'order' => 'Estore_product.id DESC' 
									);
									$this->set ( 'products', $this->paginate ( 'Estore_product', array () ) );
								} else {
									$this->paginate = array (
											'conditions' => array (
													'Estore_product.status' => 1,
													'Estore_product.catproduct_id' => $list_cat,
													'Estore_product.manufacturer' => $hsx 
											),
											'limit' => '21',
											'order' => 'Estore_product.id DESC' 
									);
									$this->set ( 'products', $this->paginate ( 'Estore_product', array () ) );
								}
							}
							
							if (($list_cat != "") && ($hsx == "") && ($gia != "")) {
								$po1 = $this->Estore_catproduct->find ( 'list', array (
										'conditions' => array (
												'Estore_catproduct.status' => 1,
												'Estore_catproduct.parent_id' => $list_cat 
										),
										'fields' => array (
												'Estore_catproduct.id' 
										) 
								) );
								
								if ($po1 != null) {
									$this->paginate = array (
											'conditions' => array (
													'Estore_product.status' => 1,
													'Estore_product.catproduct_id' => $po1,
													'Estore_product.khoanggia' => $gia 
											),
											'limit' => '21',
											'order' => 'Estore_product.id DESC' 
									);
									$this->set ( 'products', $this->paginate ( 'Estore_product', array () ) );
								} else {
									$this->paginate = array (
											'conditions' => array (
													'Estore_product.status' => 1,
													'Estore_product.catproduct_id' => $list_cat,
													'Estore_product.khoanggia' => $gia 
											),
											'limit' => '21',
											'order' => 'Estore_product.id DESC' 
									);
									$this->set ( 'products', $this->paginate ( 'Estore_product', array () ) );
								}
							}
							if (($list_cat != "") && ($hsx != "") && ($gia != "")) {
								$po1 = $this->Estore_catproduct->find ( 'list', array (
										'conditions' => array (
												'Estore_catproduct.status' => 1,
												'Estore_catproduct.parent_id' => $list_cat 
										),
										'fields' => array (
												'Estore_catproduct.id' 
										) 
								) );
								
								if ($po1 != null) {
									$this->paginate = array (
											'conditions' => array (
													'Estore_product.status' => 1,
													'Estore_product.catproduct_id' => $po1,
													'Estore_product.khoanggia' => $gia,
													'Estore_product.manufacturer' => $hsx 
											),
											'limit' => '21',
											'order' => 'Estore_product.id DESC' 
									);
									$this->set ( 'products', $this->paginate ( 'Estore_product', array () ) );
								} else {
									$this->paginate = array (
											'conditions' => array (
													'Estore_product.status' => 1,
													'Estore_product.catproduct_id' => $list_cat,
													'Estore_product.khoanggia' => $gia,
													'Estore_product.manufacturer' => $hsx 
											),
											'limit' => '21',
											'order' => 'Estore_product.id DESC' 
									);
									$this->set ( 'products', $this->paginate ( 'Estore_product', array () ) );
								}
							}
							if (($list_cat == "") && ($hsx == "") && ($gia != "")) {
								$this->paginate = array (
										'conditions' => array (
												'Estore_product.status' => 1,
												'Estore_product.khoanggia' => $gia 
										),
										'limit' => '21',
										'order' => 'Estore_product.id DESC' 
								);
								$this->set ( 'products', $this->paginate ( 'Estore_product', array () ) );
							}
							if (($list_cat == "") && ($hsx != "") && ($gia == "")) {
								
								$this->paginate = array (
										'conditions' => array (
												'Estore_product.status' => 1,
												'Estore_product.manufacturer' => $hsx 
										),
										'limit' => '21',
										'order' => 'Estore_product.id DESC' 
								);
								$this->set ( 'products', $this->paginate ( 'Estore_product', array () ) );
							}
							if (($list_cat == "") && ($hsx != "") && ($gia != "")) {
								
								$this->paginate = array (
										'conditions' => array (
												'Estore_product.status' => 1,
												'Estore_product.manufacturer' => $hsx,
												'Estore_product.khoanggia' => $gia 
										),
										'limit' => '21',
										'order' => 'Estore_product.id DESC' 
								);
								$this->set ( 'products', $this->paginate ( 'Estore_product', array () ) );
							}
							if (($list_cat == "") && ($hsx == "") && ($gia == "")) {
								
								$this->paginate = array (
										'conditions' => array (
												'Estore_product.status' => 1 
										),
										'limit' => '21',
										'order' => 'Estore_product.id DESC' 
								);
								$this->set ( 'products', $this->paginate ( 'Estore_product', array () ) );
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
							
							$this->layout = 'themeshop/home';
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
							
							$this->layout = 'themeshop/home';
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
							
							$this->layout = 'themeshop/home';
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
							
							$this->layout = 'themeshop/home';
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
							
							$this->layout = 'themeshop/home';
							$this->set ( 'title_for_layout', 'e-shop' );
							$this->layout = 'themeshop/home';
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
							
							$this->layout = 'themeshop/home';
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
							
							$this->layout = 'themeshop/home';
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
							
							$this->layout = 'themeshop/home';
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
						// _______________________________end Product___________________________________
						
						// +++++++++++++++++++++Infomation++++++++++++++++++++++++++++++++++++++
						/*
						 * function indexinfomation() { $shop=explode('/',$this->params['url']['url']); $shopname=$shop[0]; $shoparr=$this->get_shop_id($shopname); foreach($shoparr as $key=>$value){ $shop_id=$key; } $this->set ( 'shopname',$shopname); $this->set('title_for_layout', 'Đại lý - CÔNG TY THHH'); if(!$this->Session->read("user_id")){ echo "<script>location.href='".DOMAIN."login'</script>"; }else{ if($this->Session->read("check")==0){ $this->set('agents',$this->Agent->find('all')); }else{ $this->set('agents',$this->Agent->find('all',array('conditions'=>array('Agent.check_id'=>$this->Session->read("check"))))); } } } function viewinfomation($id=null) { $shop=explode('/',$this->params['url']['url']); $shopname=$shop[0]; $shoparr=$this->get_shop_id($shopname); foreach($shoparr as $key=>$value){ $shop_id=$key; } $this->set ( 'shopname',$shopname); mysql_query("SET names utf8"); $this->set('title_for_layout', 'Hỏi đáp - VIỆN KHOA HỌC VÀ CÔNG NGHỆ XÂY DỰNG GIAO THÔNG'); if (!$id) { $this->Session->setFlash(__('Không tồn tại', true)); $this->redirect(array('action' => 'index')); } $this->set('views', $this->Estore_news->read(null, $id)); $conditions=array('Estore_news.status'=>1,'Estore_news.category_id'=>149,'Estore_news.id <>'=>$id); $this->set('list_other',$this->Estore_news->find('all',array('conditions'=>$conditions,'order'=>'Estore_news.id DESC','limit'=>7))); }
						 */
						// -----------------------Infomation --------------------------------------
						
						// ++++++++++++++++++++++++++++++Infomations+++++++++++++++++++++++++++++++++++++++++++++
						function indexinfomations() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/home';
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
							$this->layout = 'themeshop/home';
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
							
							$this->layout = 'themeshop/home';
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
						// -------------------------------Infomations--------------------------------------------
						
						// +++++++++++++++++++++++++++++++News+++++++++++++++++++++++++++++++++++++++++++++++++++++++
						function indexnews() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							$this->layout = 'themeshop/home';
							$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							$this->layout = 'themeshop/home';
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
							$this->layout = 'themeshop/home';
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
							
							$this->layout = 'themeshop/home';
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
							
							$this->layout = 'themeshop/home';
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
						function listnews($id = null) {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/home';
							$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( "SET names utf8" );
							$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => $id 
									),
									'limit' => '10',
									'order' => 'Estore_news.id DESC' 
							);
							$this->set ( 'listnews', $this->paginate ( 'Estore_news', array () ) );
							$this->set ( 'cat', $this->Estore_catproduct->read ( null, $id ) );
						}
						function souvenir() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/home';
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
							$this->layout = 'themeshop/home';
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
							
							$this->layout = 'themeshop/home';
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
							$this->layout = 'themeshop/home';
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
							$this->layout = 'themeshop/home';
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
							$this->layout = 'themeshop/home';
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
							$this->layout = 'themeshop/home';
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
							$this->layout = 'themeshop/home';
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
							$this->layout = 'themeshop/home';
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
							$this->layout = 'themeshop/home';
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
							$this->layout = 'themeshop/home';
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
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							$this->layout = 'themeshop/home';
							$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( "SET names utf8" );
							
							if (! $id) {
								$this->Session->setFlash ( __ ( 'Không tồn tại', true ) );
								$this->redirect ( array (
										'action' => 'index' 
								) );
							}
							$x = $this->Estore_news->read ( null, $id );
							// echo "x :";pr($x);
							$this->set ( 'views', $x );
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
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							$this->layout = 'themeshop/home';
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
							$this->layout = 'themeshop/home';
							$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( "SET names utf8" );
							$x = $this->Estore_setting->read ( null, 1 );
							$this->set ( 'views', $x );
						}
						// -------------------------------end News-------------------------------------------------------
						
						// +++++++++++++++++++++++++++++++++++++Comments+++++++++++++++++++++++++++++++++++++++++++++++++++++++
						function indexcommentstwo() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							$this->layout = 'themeshop/home';
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
							$this->layout = 'themeshop/home';
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
							
							$this->layout = 'themeshop/home';
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
						// _____________________________________end Comments______________________________________________________
						// +++++++++++++++++++++++++Contacts+++++++++++++++++++++++++++++++++++++++++++++++
						function sendcontacts() {
							$shop = explode ( '/', $this->params ['url'] ['url'] );
							$shopname = $shop [0];
							$shoparr = $this->get_shop_id ( $shopname );
							foreach ( $shoparr as $key => $value ) {
								$shop_id = $key;
							}
							$this->set ( 'shopname', $shopname );
							
							$this->layout = 'themeshop/home';
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
							$this->layout = 'themeshop/home';
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
						// ________________________________________________________________________
					}
						  		
						  		
				      
?>
