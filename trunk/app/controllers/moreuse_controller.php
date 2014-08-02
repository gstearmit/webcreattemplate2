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
	
	
	
	
	function finish() {
		// $string = unserialize('a:21:{s:12:"project_name";s:6:"cxcxcx";s:14:"company_slogan";s:8:"cxcxcxcx";s:8:"language";s:2:"vi";s:11:"branch_type";s:0:"";s:12:"contact_name";s:6:"cxcxcx";s:14:"contact_street";s:12:"cxcxcxcccxcx";s:12:"contact_city";s:4:"cxcx";s:11:"contact_zip";s:7:"xxcxcxx";s:15:"contact_country";s:2:"vn";s:13:"contact_state";s:0:"";s:11:"contact_tel";s:8:"cxcxcxcx";s:13:"contact_email";s:8:"xcxcxcxc";s:10:"contact_ic";s:0:"";s:11:"currency_id";s:0:"";s:5:"taxes";s:3:"yes";s:10:"country_id";s:2:"vn";s:10:"moduleType";s:5:"eshop";s:6:"layout";s:8:"50001014";s:5:"email";s:8:"xcxcxcxc";s:16:"socialNetworking";i:1;s:5:"pages";a:4:{s:7:"aboutUs";s:7:"aboutUs";s:7:"contact";s:7:"contact";s:9:"newsEshop";s:9:"newsEshop";s:15:"termsConditions";s:15:"termsConditions";}}');
		
		// echo "<pre>";
		// print_r($string['project_name']);
		// echo "</pre>";
		
		// echo $string['project_name'];
		if (isset ( $_POST ['wizard'] )) {
			$wizard = unserialize ( $_POST ['wizard'] );
			
// 			echo "<pre>";
// 			print_r ( $wizard );
// 			echo "</pre>";
			
			/*
			 * Array
				(
				    [project_name] => gianhang
				    [company_slogan] => xzxzxzx
				    [language] => vi
				    [branch_type] => 
				    [contact_name] => gianhang
				    [contact_street] => Ha Noi
				    [contact_city] => Ha Noi
				    [contact_zip] => 65656
				    [contact_country] => vn
				    [contact_state] => 
				    [contact_tel] => 565656656565
				    [contact_email] => phuca4@gmail.com
				    [contact_ic] => 3232223
				    [currency_id] => 
				    [taxes] => yes
				    [country_id] => vn
				    [moduleType] => eshop
				    [layout] => 50000103
				    [email] => phuca4@gmail.com
				    [socialNetworking] => 1
				    [pages] => Array
				        (
				            [aboutUs] => aboutUs
				            [contact] => contact
				            [newsEshop] => newsEshop
				            [termsConditions] => termsConditions
				        )
				
				)
			  */
			
			$Store = array ();
			$Store ['name'] = $wizard ['project_name'];
			$slug = $this->unicode_convert( $wizard ['project_name'] );
			$Store ['slug'] = $slug;
			
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
			$Store ['link'] = 'http://'.$slug.'.freemobiweb.mobi';
			$Store ['images'] = 'img/upload/9d564d3cc9dcf18171f1dc84ebc09e0b.png';
			$Store ['ckshops'] = 1;
			$Store ['status'] = 1;
			// $Store['user_id']=$this->Session->read("id");
			
			pr ( $Store );
// 			die ();
			
			 $this->Shop->save($Store);
			 $shop_id = $this->Shop->getLastInsertId();
			 pr($shop_id);
			 // creat Eshop
			 //$Store ['language']
			 //$Store ['layout'] //: id = 50000565 ma eshop bep ga 

			 $result = $this->registerEshop($slug,$Store ['layout'],$Store ['language'],$shop_id);
			 pr($result);
		} else {
			$result = Null;
		}
		die ();
	}
	//++++++ Register Website Creat++++++++++++++++++++
	function registerEshop($project_name,$layout_code,$language_code,$shop_id) {
		$result_code;
		// 		$name = $this->Shop->findAllByName( $project_name); // pr(count($name));die;
		// 		if (count ( $name ) == 1) {
		// 			return $result_code = -1 ; // -1 :'Tên gian hàng đã tồn tại!';
		// 		} else {
	
			$nameController_Copy = $this->checkLayoutCode($project_name,$layout_code);
			
			$nameLangueCopy = $this->checkLanguageCode($project_name,$language_code,$layout_code,$shop_id);
			
			$dir_and_name_estoreViewCopy = $this->checkLayoutCodeReturnCodeTheme($project_name,$layout_code);
				
			// 			pr($nameController_Copy);
			// 			pr($nameLangueCopy);
			// 			pr($dir_and_name_estoreViewCopy);
			return $result_code= array(
					'nameController_Copy'=>$nameController_Copy,
					'nameLangueCopy'=>$nameLangueCopy,
					'dir_and_name_estoreViewCopy'=>$dir_and_name_estoreViewCopy,
			);
				
				
			//}
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
						  	var \$uses = array (
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
						var \$helpers = array (
								'Html',
								'Ajax',
								'Javascript' 
						);
						var \$components = array (
								'RequestHandler',
								'Email' 
						);
						function get_shop_id(\$name) {
							return \$this->Shop->find ( 'list', array (
									'conditions' => array (
											'Shop.name' => \$name,
											'Shop.status' => 1 
									),
									'fields' => array (
											'id',
											'created' 
									) 
							) );
						}
						function getOrder() {
							mysql_query ( \"SET names utf8\" );
							return \$this->Estore_infomation->find ( 'all', array (
									'order' => 'Estore_infomation.id DESC' 
							) );
						}
						function getAlbum() {
							mysql_query ( \"SET names utf8\" );
							return \$this->Estore_album->find ( 'all', array (
									'conditions' => array (
											'Estore_album.status' => 1 
									),
									'limit' => '3',
									'order' => 'Estore_album.id ASC' 
							) );
						}
						// tin tuc
						function menucategory() {
							mysql_query ( \"SET names utf8\" );
							return \$this->Estore_category->find ( 'all', array (
									'conditions' => array (
											'Estore_category.status' => 1,
											'Estore_category.parent_id' => null 
									),
									'order' => 'Estore_category.tt ASC' 
							) );
						}
						function showcategory(\$id = null) {
							mysql_query ( \"SET names utf8\" );
							return \$this->Estore_category->find ( 'all', array (
									'conditions' => array (
											'Estore_category.parent_id ' => \$id 
									),
									'order' => 'Estore_category.tt ASC' 
							) );
						}
						function menunews1() {
							mysql_query ( \"SET names utf8\" );
							return \$this->Estore_category->find ( 'all', array (
									'conditions' => array (
											'Estore_category.status' => 1,
											'Estore_category.parent_id' => '156' 
									),
									'order' => 'Estore_category.tt DESC' 
							) );
						}
						
						// gioi thieu
						function menuintroduct() {
							mysql_query ( \"SET names utf8\" );
							return \$this->Estore_category->find ( 'all', array (
									'conditions' => array (
											'Estore_category.status' => 1,
											'Estore_category.parent_id' => '146' 
									),
									'order' => 'Estore_category.tt ASC' 
							) );
						}
						function banner() {
							return \$this->Estore_banner->find ( 'all', array (
									'conditions' => array (
											'Estore_banner.status' => 1 
									),
									'order' => 'Estore_banner.id DESC' 
							) );
						}
						function setting() {
							return \$this->Estore_setting->find ( 'all', array (
									'conditions' => array (),
									'order' => 'Estore_setting.id DESC' 
							) );
						}
						function adv() {
							// return \$this->Gallery->find('all',array('conditions'=>array('Gallery.status'=>1),'order'=>'Gallery.id DESC','limit'=>2));
							return \$this->Estore_banner->find ( 'all', array (
									'conditions' => array (
											'Estore_banner.status' => 1 
									),
									'order' => 'Estore_banner.id DESC',
									'limit' => 2 
							) );
						}
						function doitac() {
							// return \$this->Gallery->find('all',array('conditions'=>array('Gallery.status'=>1),'order'=>'Gallery.id DESC','limit'=>2));
							return \$this->Estore_partner->find ( 'all', array (
									'conditions' => array (
											'Estore_partner.status' => 1 
									),
									'order' => 'Estore_partner.id DESC' 
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
							return \$this->Estore_helps->find ( 'all', array (
									'conditions' => array (
											'Estore_helps.status' => 1 
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
						function hotnew() {
							return \$this->Estore_news->find ( 'all', array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => 156 
									),
									'order' => 'Estore_news.id DESC',
									'limit' => 6 
							) );
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
						function videos() {
							mysql_query ( \"SET names utf8\" );
							return \$this->Estore_video->find ( 'all', array (
									'conditions' => array (
											'Estore_video.status' => 1,
											'Estore_video.left' => 0 
									),
									'order' => 'Estore_video.id DESC',
									'limit' => 1 
							) );
						}
						function videosright() {
							mysql_query ( \"SET names utf8\" );
							return \$this->Estore_video->find ( 'all', array (
									'conditions' => array (
											'Estore_video.status' => 1,
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
							return \$this->Estore_slideshow->find ( 'all', array (
									'conditions' => array (
											'Estore_slideshow.status' => 1 
									),
									'order' => 'Estore_slideshow.id DESC' 
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
							return \$this->Estore_catproduct->find ( 'all', array (
									'conditions' => array (
											'Estore_catproduct.parent_id ' => \$id 
									),
									'order' => 'Estore_catproduct.id ASC' 
							) );
						}
						function showsmenu2(\$id = null) {
							return \$this->Estore_catproduct->find ( 'all', array (
									'conditions' => array (
											'Estore_catproduct.parent_id ' => \$id 
									),
									'order' => 'Estore_catproduct.id ASC' 
							) );
						}
						function danhmuc() {
							return \$this->Estore_catproduct->find ( 'all', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => 11 
									),
									'order' => 'Estore_catproduct.name ASC' 
							) );
						}
						function typical() {
							return \$this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1 
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
							return \$this->Estore_catproduct->find ( 'all', array (
									'conditions' => array (
											'Estore_catproduct.status' => 1 
									) 
							) );
						}
						function hsx() {
							return \$this->Estore_manufacturer->find ( 'all', array (
									'conditions' => array (
											'Estore_manufacturer.status' => 1,
											'Estore_manufacturer.parent_id ' => null 
									) 
							) );
						}
						function catcon() {
							return \$this->Estore_catproduct->find ( 'all', array (
									'conditions' => array (
											'Estore_catproduct.status' => 1 
									) 
							) );
						}
						function adv1() {
							return \$this->Estore_advertisement->find ( 'all', array (
									'conditions' => array (
											'Estore_advertisement.status' => 1,
											'Estore_advertisement.display' => 0 
									),
									'limit' => 1 
							) );
						}
						function adv2() {
							return \$this->Estore_advertisement->find ( 'all', array (
									'conditions' => array (
											'Estore_advertisement.status' => 1,
											'Estore_advertisement.display' => 1 
									),
									'limit' => 1 
							) );
						}
						function advf() {
							return \$this->Estore_advertisement->find ( 'all', array (
									'conditions' => array (
											'Estore_advertisement.status' => 1,
											'Estore_advertisement.display' => 2 
									),
									'order' => 'Estore_advertisement.id ASC' 
							) );
						}
						function advr() {
							return \$this->Estore_advertisement->find ( 'all', array (
									'conditions' => array (
											'Estore_advertisement.status' => 1,
											'Estore_advertisement.display' => 3 
									),
									'order' => 'Estore_advertisement.id ASC' 
							) );
						}
						
						// +++++++++++++++++++++++++++++++++++Home+++++++++++++++++++++++++++++++++++++++++++++++
						function index() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/home';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							\$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.spkuyenmai' => 1 
									),
									'limit' => '9',
									'order' => 'Estore_product.id DESC' 
							);
							\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
							
							\$check1 = \$this->Estore_catproduct->find ( 'list', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => 106 
									),
									'fields' => array (
											'Estore_catproduct.id' 
									) 
							) );
							
							\$checks = \$this->Estore_catproduct->find ( 'list', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => \$check1 
									),
									'fields' => array (
											'Estore_catproduct.id' 
									) 
							) );
							
							if (\$checks != null) {
								\$this->set ( 'tubep', \$this->Estore_product->find ( 'all', array (
										'conditions' => array (
												'Estore_product.status' => 1,
												'Estore_product.catproduct_id' => \$check1,
												'Estore_product.catproduct_id' => \$checks 
										),
										'limit' => 6,
										'order' => 'Estore_product.id DESC' 
								) ) );
							} else {
								\$this->set ( 'tubep', \$this->Estore_product->find ( 'all', array (
										'conditions' => array (
												'Estore_product.status' => 1,
												'Estore_product.catproduct_id' => \$check1 
										),
										'limit' => 6,
										'order' => 'Estore_product.id DESC' 
								) ) );
							}
							\$check2 = \$this->Estore_catproduct->find ( 'list', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => 107 
									),
									'fields' => array (
											'Estore_catproduct.id' 
									) 
							) );
							
							\$checkss = \$this->Estore_catproduct->find ( 'list', array (
									'conditions' => array (
											'Estore_catproduct.parent_id' => \$check2 
									),
									'fields' => array (
											'Estore_catproduct.id' 
									) 
							) );
							
							if (\$checkss != null) {
								\$this->set ( 'bepcongnghiep', \$this->Estore_product->find ( 'all', array (
										'conditions' => array (
												'Estore_product.status' => 1,
												'Estore_product.catproduct_id' => \$check2,
												'Estore_product.catproduct_id' => \$checkss 
										),
										'limit' => 6,
										'order' => 'Estore_product.id DESC' 
								) ) );
							} else {
								\$this->set ( 'bepcongnghiep', \$this->Estore_product->find ( 'all', array (
										'conditions' => array (
												'Estore_product.status' => 1,
												'Estore_product.catproduct_id' => \$check2 
										),
										'limit' => 6,
										'order' => 'Estore_product.id DESC' 
								) ) );
							}
							\$this->set ( 'spvip', \$this->Estore_product->find ( 'all', array (
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
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/home';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 9 
							);
							\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
						}
						function dssanpham(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/home';
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
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/home';
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
												'Estore_product.status' => 1,
												'Estore_product.catproduct_id' => \$check 
										),
										'order' => 'Estore_product.id DESC',
										'limit' => 18 
								);
								\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
								\$this->set ( 'cat', \$this->Estore_catproduct->read ( null, \$id ) );
							} else {
								\$this->paginate = array (
										'conditions' => array (
												'Estore_product.status' => 1,
												'Estore_product.catproduct_id' => \$id 
										),
										'order' => 'Estore_product.id DESC',
										'limit' => 18 
								);
								\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
								\$this->set ( 'cat', \$this->Estore_catproduct->read ( null, \$id ) );
							}
						}
						function khuyenmaiproduct() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/home';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							
							\$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.spkuyenmai' => 1 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 18 
							);
							\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
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
							
							\$this->layout = 'themeshop/home';
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
							
							\$this->layout = 'themeshop/home';
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
							
							\$this->layout = 'themeshop/home';
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
							
							\$this->layout = 'themeshop/home';
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
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/home';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc Catproduct
							mysql_query ( \"SET names utf8\" );
							\$this->set ( 'newsproducts', \$this->Estore_product->find ( 'all', array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => \$id,
											'Estore_product.sptieubieu' => '1' 
									),
									'limit' => 9,
									'order' => 'Estore_product.id DESC' 
							) ) );
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
						function listsp1(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/home';
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
							
							\$this->layout = 'themeshop/home';
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
							
							\$this->layout = 'themeshop/home';
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
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/home';
							\$this->set ( 'title_for_layout', 'e-shop' );
							\$this->loadModel ( \"Estore_catproduct\" );
							
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
								\$po1 = \$this->Estore_catproduct->find ( 'list', array (
										'conditions' => array (
												'Estore_catproduct.status' => 1,
												'Estore_catproduct.parent_id' => \$list_cat 
										),
										'fields' => array (
												'Estore_catproduct.id' 
										) 
								) );
								
								if (\$po1 != null) {
									\$this->paginate = array (
											'conditions' => array (
													'Estore_product.status' => 1,
													'Estore_product.catproduct_id' => \$po1 
											),
											'limit' => '21',
											'order' => 'Estore_product.id DESC' 
									);
									\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
								} else {
									\$this->paginate = array (
											'conditions' => array (
													'Estore_product.status' => 1,
													'Estore_product.catproduct_id' => \$list_cat 
											),
											'limit' => '21',
											'order' => 'Estore_product.id DESC' 
									);
									\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
								}
							}
							
							if ((\$list_cat != \"\") && (\$hsx != \"\") && (\$gia == \"\")) {
								\$po1 = \$this->Estore_catproduct->find ( 'list', array (
										'conditions' => array (
												'Estore_catproduct.status' => 1,
												'Estore_catproduct.parent_id' => \$list_cat 
										),
										'fields' => array (
												'Estore_catproduct.id' 
										) 
								) );
								
								if (\$po1 != null) {
									\$this->paginate = array (
											'conditions' => array (
													'Estore_product.status' => 1,
													'Estore_product.catproduct_id' => \$po1,
													'Estore_product.manufacturer' => \$hsx 
											),
											'limit' => '21',
											'order' => 'Estore_product.id DESC' 
									);
									\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
								} else {
									\$this->paginate = array (
											'conditions' => array (
													'Estore_product.status' => 1,
													'Estore_product.catproduct_id' => \$list_cat,
													'Estore_product.manufacturer' => \$hsx 
											),
											'limit' => '21',
											'order' => 'Estore_product.id DESC' 
									);
									\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
								}
							}
							
							if ((\$list_cat != \"\") && (\$hsx == \"\") && (\$gia != \"\")) {
								\$po1 = \$this->Estore_catproduct->find ( 'list', array (
										'conditions' => array (
												'Estore_catproduct.status' => 1,
												'Estore_catproduct.parent_id' => \$list_cat 
										),
										'fields' => array (
												'Estore_catproduct.id' 
										) 
								) );
								
								if (\$po1 != null) {
									\$this->paginate = array (
											'conditions' => array (
													'Estore_product.status' => 1,
													'Estore_product.catproduct_id' => \$po1,
													'Estore_product.khoanggia' => \$gia 
											),
											'limit' => '21',
											'order' => 'Estore_product.id DESC' 
									);
									\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
								} else {
									\$this->paginate = array (
											'conditions' => array (
													'Estore_product.status' => 1,
													'Estore_product.catproduct_id' => \$list_cat,
													'Estore_product.khoanggia' => \$gia 
											),
											'limit' => '21',
											'order' => 'Estore_product.id DESC' 
									);
									\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
								}
							}
							if ((\$list_cat != \"\") && (\$hsx != \"\") && (\$gia != \"\")) {
								\$po1 = \$this->Estore_catproduct->find ( 'list', array (
										'conditions' => array (
												'Estore_catproduct.status' => 1,
												'Estore_catproduct.parent_id' => \$list_cat 
										),
										'fields' => array (
												'Estore_catproduct.id' 
										) 
								) );
								
								if (\$po1 != null) {
									\$this->paginate = array (
											'conditions' => array (
													'Estore_product.status' => 1,
													'Estore_product.catproduct_id' => \$po1,
													'Estore_product.khoanggia' => \$gia,
													'Estore_product.manufacturer' => \$hsx 
											),
											'limit' => '21',
											'order' => 'Estore_product.id DESC' 
									);
									\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
								} else {
									\$this->paginate = array (
											'conditions' => array (
													'Estore_product.status' => 1,
													'Estore_product.catproduct_id' => \$list_cat,
													'Estore_product.khoanggia' => \$gia,
													'Estore_product.manufacturer' => \$hsx 
											),
											'limit' => '21',
											'order' => 'Estore_product.id DESC' 
									);
									\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
								}
							}
							if ((\$list_cat == \"\") && (\$hsx == \"\") && (\$gia != \"\")) {
								\$this->paginate = array (
										'conditions' => array (
												'Estore_product.status' => 1,
												'Estore_product.khoanggia' => \$gia 
										),
										'limit' => '21',
										'order' => 'Estore_product.id DESC' 
								);
								\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
							}
							if ((\$list_cat == \"\") && (\$hsx != \"\") && (\$gia == \"\")) {
								
								\$this->paginate = array (
										'conditions' => array (
												'Estore_product.status' => 1,
												'Estore_product.manufacturer' => \$hsx 
										),
										'limit' => '21',
										'order' => 'Estore_product.id DESC' 
								);
								\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
							}
							if ((\$list_cat == \"\") && (\$hsx != \"\") && (\$gia != \"\")) {
								
								\$this->paginate = array (
										'conditions' => array (
												'Estore_product.status' => 1,
												'Estore_product.manufacturer' => \$hsx,
												'Estore_product.khoanggia' => \$gia 
										),
										'limit' => '21',
										'order' => 'Estore_product.id DESC' 
								);
								\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
							}
							if ((\$list_cat == \"\") && (\$hsx == \"\") && (\$gia == \"\")) {
								
								\$this->paginate = array (
										'conditions' => array (
												'Estore_product.status' => 1 
										),
										'limit' => '21',
										'order' => 'Estore_product.id DESC' 
								);
								\$this->set ( 'products', \$this->paginate ( 'Estore_product', array () ) );
							}
							
							
						}
						function view(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/home';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// var_dump(\$id);die;
							mysql_query ( \"SET names utf8\" );
							if (! \$id) {
								\$this->Session->setFlash ( __ ( 'Không tồn tại', true ) );
								\$this->redirect ( array (
										'action' => 'index' 
								) );
							}
							\$this->set ( 'views', \$this->Estore_product->read ( null, \$id ) );
							\$this->set ( 'news', \$this->Estore_catproduct->read ( null, \$id ) );
							\$name = \$this->Estore_product->read ( null, \$id );
							
							\$this->set ( 'views', \$name );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_product.status' => 1,
											'Estore_product.catproduct_id' => \$name ['Estore_product'] ['catproduct_id'],
											'Estore_product.id <>' => \$name ['Estore_product'] ['id'] 
									),
									'order' => 'Estore_product.id DESC',
									'limit' => 8 
							);
							\$this->set ( 'sanphamkhac', \$this->paginate ( 'Estore_product', array () ) );
						}
						
						// shopping
						function addshopingcart(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/home';
							\$this->set ( 'title_for_layout', 'e-shop' );
							
							\$product = \$this->Estore_product->read ( null, \$id );
							
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
									echo '<script language=\"javascript\"> alert(\"Thêm thành công\"); window.location.replace(\"' . DOMAIN .\$shopname . '/viewshopingcart\"); </script>';
								} else {
									\$shopingcart [\$id] ['pid'] = \$id;
									\$shopingcart [\$id] ['name'] = \$product ['Estore_product'] ['title'];
									\$shopingcart [\$id] ['images'] = \$product ['Estore_product'] ['images'];
									\$shopingcart [\$id] ['sl'] = 1;
									\$shopingcart [\$id] ['price'] = \$product ['Estore_product'] ['price'];
									\$shopingcart [\$id] ['total'] = \$product ['Estore_product'] ['price'] * \$shopingcart [\$id] ['sl'];
									\$_SESSION ['shopingcart'] = \$shopingcart;
									echo '<script language=\"javascript\" type=\"text/javascript\"> alert(\"Thêm giỏ hàng thành công\"); window.location.replace(\"' . DOMAIN .\$shopname . '/viewshopingcart\"); </script>';
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
							
							\$this->layout = 'themeshop/home';
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
							
							\$this->layout = 'themeshop/home';
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
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/home';
							\$this->set ( 'title_for_layout', 'e-shop' );
							\$this->layout = 'themeshop/home';
							\$this->set ( 'title_for_layout', 'e-shop View Shopping' );
							if (isset ( \$_SESSION ['shopingcart'] )) {
								\$shopingcart = \$_SESSION ['shopingcart'];
								\$this->set ( compact ( 'shopingcart' ) );
							} else {
								echo '<script language=\"javascript\"> alert(\"Chua co san pham nao trong gio hang\"); window.location.replace(\"' . DOMAIN .\$shopname . '/index\"); </script>';
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
							
							\$this->layout = 'themeshop/home';
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
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/home';
							\$this->set ( 'title_for_layout', 'e-shop' );
							if (isset ( \$_SESSION ['shopingcart'] )) {
								\$shopingcart = \$_SESSION ['shopingcart'];
								\$this->set ( compact ( 'shopingcart' ) );
							} else {
								echo '<script language=\"javascript\"> alert(\"Không có sản phẩm nào trong giỏ hàng của bạn\"); window.location.replace(\"' . DOMAIN . '\"); </script>';
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
							
							\$this->layout = 'themeshop/home';
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
							
							\$this->layout = 'themeshop/home';
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
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/home';
							\$this->set ( 'title_for_layout', 'e-shop' );
							\$uid = \"id\" . rand ( 1, 1000000 );
							\$data ['Estore_infomation'] ['user_id'] = (\$this->Session->read ( \"id\" ) != '' ? \$this->Session->read ( \"id\" ) : \$uid);
							\$data ['Estore_infomation'] ['mobile'] = \$_POST ['phone'];
							\$data ['Estore_infomation'] ['address'] = \$_POST ['address'];
							\$data ['Estore_infomation'] ['email'] = \$_POST ['email'];
							\$data ['Estore_infomation'] ['name'] = \$_POST ['name'];
							\$data ['Estore_infomation'] ['phone'] = \$_POST ['phone'];
							\$data ['Estore_infomation'] ['total'] = \$_POST ['total'];
							\$this->Estore_infomation->save ( \$data ['Estore_infomation'] );
							
							\$info_id = \$this->Estore_infomation->getLastInsertId ();
							
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
							echo '<script language=\"javascript\">alert(\"cảm ơn bạn đã đặt hàng  chúng tôi sẽ liên hệ với bạn trong vòng 24h\"); location.href=\"' . DOMAIN .\$shopname . '/index\";</script>';
						}
						function deleteinfomations(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/home';
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
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/home';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							\$this->layout = 'themeshop/home';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
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
							\$this->layout = 'themeshop/home';
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
							
							\$this->layout = 'themeshop/home';
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
							
							\$this->layout = 'themeshop/home';
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
						function listnews(\$id = null) {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/home';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							\$this->paginate = array (
									'conditions' => array (
											'Estore_news.status' => 1,
											'Estore_news.category_id' => \$id 
									),
									'limit' => '10',
									'order' => 'Estore_news.id DESC' 
							);
							\$this->set ( 'listnews', \$this->paginate ( 'Estore_news', array () ) );
							\$this->set ( 'cat', \$this->Estore_catproduct->read ( null, \$id ) );
						}
						function souvenir() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/home';
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
							\$this->layout = 'themeshop/home';
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
							
							\$this->layout = 'themeshop/home';
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
							\$this->layout = 'themeshop/home';
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
							\$this->layout = 'themeshop/home';
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
							\$this->layout = 'themeshop/home';
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
							\$this->layout = 'themeshop/home';
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
							\$this->layout = 'themeshop/home';
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
							\$this->layout = 'themeshop/home';
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
							\$this->layout = 'themeshop/home';
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
							\$this->layout = 'themeshop/home';
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
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/home';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET names utf8\" );
							
							if (! \$id) {
								\$this->Session->setFlash ( __ ( 'Không tồn tại', true ) );
								\$this->redirect ( array (
										'action' => 'index' 
								) );
							}
							\$x = \$this->Estore_news->read ( null, \$id );
							// echo \"x :\";pr(\$x);
							\$this->set ( 'views', \$x );
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
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/home';
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
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/home';
							\$this->set ( 'title_for_layout', 'e-shop' );
							// list danh sach tin tuc
							mysql_query ( \"SET names utf8\" );
							\$x = \$this->Estore_setting->read ( null, 1 );
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
							\$this->layout = 'themeshop/home';
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
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							\$this->layout = 'themeshop/home';
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
						// them danh muc moi
						function addcomments() {
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/home';
							\$this->set ( 'title_for_layout', 'e-shop' );
							if (! empty ( \$this->data )) {
								// if(\$this->Session->read('security_code')==\$_POST['security']){
								
								\$data ['Estore_comments'] = \$this->data ['Estore_comments'];
								if (\$this->Estore_comments->save ( \$data ['Estore_comments'] )) {
									\$this->Session->setFlash ( __ ( 'Thêm mới comments thành công', true ) );
									// \$this->redirect(array('action' => 'index'));
									echo '<script language=\"javascript\"> location.href=\"' . DOMAIN .\$shopname . '/indexcomments\";</script>';
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
							\$shop = explode ( '/', \$this->params ['url'] ['url'] );
							\$shopname = \$shop [0];
							\$shoparr = \$this->get_shop_id ( \$shopname );
							foreach ( \$shoparr as \$key => \$value ) {
								\$shop_id = \$key;
							}
							\$this->set ( 'shopname', \$shopname );
							
							\$this->layout = 'themeshop/home';
							\$this->set ( 'title_for_layout', 'e-shop' );
							mysql_query ( \"SET NAMES 'utf8'\" );
							mysql_query ( \"SET character_set_client=utf8\" );
							mysql_query ( \"SET character_set_connection=utf8\" );
							\$x = \$this->Estore_setting->read ( null, 1 );
							if (isset ( \$_POST ['name'] )) {
								\$name = \$_POST ['name'];
								
								\$mobile = \$_POST ['phone'];
								\$email = \$_POST ['email'];
								\$title = \$_POST ['title'];
								\$content = \$_POST ['content'];
								
								\$this->Email->from = \$name . '<' . \$email . '>';
								\$this->Email->to = \$x ['Estore_setting'] ['email'];
								\$this->Email->subject = \$title;
								\$this->Email->template = 'default';
								\$this->Email->sendAs = 'both';
								\$this->set ( 'name', \$name );
								\$this->set ( 'mobile', \$mobile );
								\$this->set ( 'email', \$email );
								\$this->set ( 'content', \$content );
								
								// pr(\$this->Email->send());die;
								if (\$this->Email->send ()) {
									// \$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
									echo '<script language=\"javascript\"> alert(\"Gửi mail thành công\"); location.href=\"' . DOMAIN . '\";</script>';
								} else
									// \$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
									// echo '<script language=\"javascript\"> alert(\"gửi mail không thành công\"); //location.href=\"'.DOMAIN.'\";</script>';
									echo '<script language=\"javascript\"> alert(\"gửi mail không thành công\"); </script>';
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
							\$this->layout = 'themeshop/home';
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
					 }\n";
						$stringData .= "?>\n";
						
						fwrite ( $fh, $stringData );
						fclose ( $fh );
						//+++++++copy
						$fromfile = DOCUMENT_ROOT . 'app/controllers/estore_controller.php';
						$tofile = DOCUMENT_ROOT . 'app/controllers/' . $project_name. '_controller.php';
						
						if (file_exists ( $tofile )) {
							return $dir_and_name_estore = "Tên gian hàng đã tồn tại";
							//exit ();
						}
						copy ( $fromfile, $tofile );
						
						return $controller_estore ="50000565";
						break;
					}
				 case 50000564:
					{
						//phuc
						$myFile = DOCUMENT_ROOT . 'app/controllers/shops_controller.php';
						// $myFile = DOMAIN.'app/controllers/shops_controller.php';
						// pr($myFile);die;
						$fh = fopen ( $myFile, 'w' ) or die ( "can't open file" );
						$stringData = "";
						$stringData .= "<?php\n";
						$stringData .= "
						  class " . ucfirst ( $project_name) . "Controller extends AppController {
						  var \$name = '" . ucfirst ( $project_name) . "';
						  var \$uses=array('Product','Tems','Shop','Newshop','Productshop','Categoryshop','Userscms','Classifiedss','Banner','Background');
						  var \$helpers = array('Html', 'Form', 'Javascript');
					
						  function index() {
						  \$this->Session->write('menu','home');
						
						    \$pizza = \$_GET['url'];
						   \$urlshop = explode('/', \$pizza);
						   \$geturl=\$urlshop[0];
						    \$this->set('title_for_layout', 'Trang chủ');
						   \$sang = \$this->Tems->find('all');
						   \$this->layout='themeshop/template';
						   \$this->set('title_for_layout', '');
						   \$user = \$this->Session->read('id');
							\$temshop = \$this->Shop->findAllByName(\$geturl);
				           \$idshop = \$temshop[0]['Shop']['id'];
						   	\$this->paginate =array('conditions'=>array('Productshop.status'=>1,'Productshop.shop_id'=>\$idshop),'order'=>'Productshop.id DESC','limit'=>9);
							\$this->set('productshop',\$this->paginate('Productshop',array()));
						;
						 }
					
					  function tin_tuc() {
					  \$this->Session->write('menu','tintuc');
					      \$pizza = \$_GET['url'];
					     \$urlshop = explode('/', \$pizza);
					     \$geturl=\$urlshop[0];
						 \$temshop = \$this->Shop->findAllByName(\$geturl);
					     \$sang = \$this->Tems->find('all');
						\$this->layout='themeshop/template';
						 \$this->set('title_for_layout', 'Tin tức - '.\$temshop[0]['Shop']['namecompany']);
						 \$user = \$this->Session->read('id');
					
			            \$idshop = \$temshop[0]['Shop']['id'];
						 \$this->paginate = array('conditions'=>array('Newshop.shop_id'=>\$idshop,'Newshop.categorynewsshop_id'=>219,'Newshop.status'=>1),'limit' => '8','order' => 'Newshop.id DESC');
				        \$this->set('newsshop', \$this->paginate('Newshop',array()));
					 }
					
					
				
					  function khuyen_mai() {
					      \$pizza = \$_GET['url'];
					     \$urlshop = explode('/', \$pizza);
					     \$geturl=\$urlshop[0];
						 \$temshop = \$this->Shop->findAllByName(\$geturl);
					     \$sang = \$this->Tems->find('all');
						\$this->layout='themeshop/template';
						 \$this->set('title_for_layout', 'Tin tức - '.\$temshop[0]['Shop']['namecompany']);
						 \$user = \$this->Session->read('id');
						\$this->Session->write('menu','khuyenmai');
			            \$idshop = \$temshop[0]['Shop']['id'];
						 \$this->paginate = array('conditions'=>array('Newshop.shop_id'=>\$idshop,'Newshop.categorynewsshop_id'=>220,'Newshop.status'=>1),'limit' => '8','order' => 'Newshop.id DESC');
				        \$this->set('khuyenmai', \$this->paginate('Newshop',array()));
					 }
					
					  function chi_tiet_tin_tuc(\$id=null) {
					  \$this->set('menu','tintuc');
						 \$sang = \$this->Tems->find('all');
						 \$this->layout='themeshop/template';
						 \$this->set('title_for_layout', 'Chi tiết tin');
						if (!\$id) {
							\$this->Session->setFlash(__('Không tồn tại', true));
							\$this->redirect(array('action' => 'index'));
						}
						\$x=\$this->Newshop->read(null, \$id);
						\$this->set('views',\$x);
						\$this->set('list_others', \$this->Newshop->find('all',array('conditions'=>array('Newshop.status'=>1,'Newshop.categorynewsshop_id'=>\$x['Newshop']['categorynewsshop_id'],'Newshop.id <>'=>\$id),'limit'=>10)));
					}
					 // hien thi san phan trong gian hang
					 function san_pham() {
					\$this->Session->write('menu','sanpham');
					   \$pizza = \$_GET['url'];
					   \$urlshop = explode('/', \$pizza);
					   \$geturl=\$urlshop[0];
					   \$temshop = \$this->Shop->findAllByName(\$geturl);
					   \$sang = \$this->Tems->find('all');
					  \$this->layout='themeshop/template';
					   \$this->set('title_for_layout', 'Sản phẩm - '.\$temshop[0]['Shop']['namecompany']);
					   \$user = \$this->Session->read('id');
						 //----------------------------------
						 \$this->set('title_for_layout', 'Sản phẩm');
			            \$idshop = \$temshop[0]['Shop']['id'];
						\$product_shop = \$this->Productshop->find('all',array('conditions'=>array('Productshop.status'=>1,'Productshop.shop_id'=>\$idshop),'order'=>'Productshop.id DESC','limit'=>9));
						\$this->set('productshop',\$product_shop);
					 }
					function raovat() {
					   \$sang = \$this->Tems->find('all');
					   \$this->layout='themeshop/template';
					    \$sangurl = \$_SERVER['REQUEST_URI'];
						\$url = explode('/', \$sangurl);
					    \$geturl=\$url[1];
					    \$temshop = \$this->Shop->findAllByName(\$geturl);
			            \$idshop = \$temshop[0]['Shop']['user_id'];
						\$this->set('title_for_layout', 'Rao vặt - '.\$temshop[0]['Shop']['namecompany']);
						\$this->paginate = array('conditions'=>array('Classifiedss.status'=>1,'Classifiedss.user_id'=>\$idshop),'order'=>'Classifiedss.id DESC','limit'=>12);
						\$this->set('raovat', \$this->paginate('Classifiedss',array()));
					 }
					
					 // cai dat giao dien
					function bannerheader() {
					   \$sang = \$this->Tems->find('all');
					 \$this->layout='themeshop/template';
					    \$sangurl = \$_SERVER['REQUEST_URI'];
						\$url = explode(\"/\", \$sangurl);
					    \$geturl= \$url[2];
					    \$temshop = \$this->Shop->findAllByName(\$geturl);
			            \$idshop = \$temshop[0]['Shop']['user_id'];
						return \$this->Banner->find('all',array('conditions'=>array('Banner.user_id'=>\$idshop),'order'=>'Banner.id DESC','limit'=>1));
					 }
					function background() {
					   \$sang = \$this->Tems->find('all');
					  \$this->layout='themeshop/template';
					    \$sangurl = \$_SERVER['REQUEST_URI'];
						\$url = explode(\"/\", \$sangurl);
					    \$geturl=\$url[1];
					    \$temshop = \$this->Shop->findAllByName(\$geturl);
			            \$idshop = \$temshop[0]['Shop']['user_id'];
						return \$this->Background->find('all',array('conditions'=>array('Background.user_id'=>\$idshop),'order'=>'Background.id DESC','limit'=>1));
					 }
					
					 function raovatnews() {
					   \$sang = \$this->Tems->find('all');
					   \$this->layout='themeshop/template';
					    \$sangurl = \$_SERVER['REQUEST_URI'];
						\$url = explode('/', \$sangurl);
					    \$geturl=\$url[1];
					    \$temshop = \$this->Shop->findAllByName(\$geturl);
			            \$idshop = \$temshop[0]['Shop']['user_id'];
						 return \$temshop = \$this->Classifiedss->find('all',array('conditions'=>array('Classifiedss.status'=>1,'Classifiedss.user_id'=>\$idshop),'order'=>'Classifiedss.id DESC','limit'=>7));
					 }
					
					 function chi_tiet_rao_vat(\$id=null) {
					 \$this->set('menu','tintuc');
						 \$sang = \$this->Tems->find('all');
						\$this->layout='themeshop/template';
						if (!\$id) {
							\$this->Session->setFlash(__('Không tồn tại', true));
							\$this->redirect(array('action' => 'index'));
						}
						\$x=\$this->Classifiedss->read(null, \$id);
						\$this->set('views',\$x);
						\$this->set('list_others', \$this->Classifiedss->find('all',array('conditions'=>array('Classifiedss.status'=>1,'Classifiedss.scop_id'=>\$x['Classifiedss']['scop_id'],'Classifiedss.id <>'=>\$id),'limit'=>10)));
					}
					  function search(\$search_name=null) {
					   \$pizza = \$_GET['url'];
					   \$urlshop = explode('/', \$pizza);
					   \$geturl=\$urlshop[0];
					 
					   \$sang = \$this->Tems->find('all');
					   \$this->layout='themeshop/template';
					   \$this->set('title_for_layout', '');
					   \$user = \$this->Session->read('id');
						 //----------------------------------
						\$temshop = \$this->Shop->findAllByName(\$geturl);
			            \$idshop = \$temshop[0]['Shop']['id'];
						\$product_shop = \$this->Productshop->find('all',array('conditions'=>array('Productshop.status'=>1,'Productshop.shop_id'=>\$idshop,'Productshop.title like'=>'%'.\$search_name.'%'),'order'=>'Productshop.id DESC','limit'=>9));
						\$this->set('search',\$product_shop);
					 }
					
					 //list product
					 function danh_sach_san_pham(\$id=null) {
					 \$this->Session->write('menu','sanpham');
				
					   \$pizza = \$_GET['url'];
					   \$urlshop = explode('/', \$pizza);
					   \$geturl=\$urlshop[0];
					   \$this->set('title_for_layout', 'Danh sách sản phẩm');
					   \$sang = \$this->Tems->find('all');
					  \$this->layout='themeshop/template';
					   \$this->set('title_for_layout', '');
					   \$user = \$this->Session->read('id');
						\$temshop = \$this->Shop->findAllByName(\$geturl);
			            \$idshop = \$temshop[0]['Shop']['id'];
						if(\$id==null) {
						\$this->paginate=array('conditions'=>array('Productshop.status'=>1,'Productshop.shop_id'=>\$idshop,'Productshop.user_id'=>\$user),'order'=>'Productshop.id DESC','limit'=>9);
						}
						else
						\$this->paginate=array('conditions'=>array('Productshop.status'=>1,'Productshop.categoryshop_id'=>\$id,'Productshop.shop_id'=>\$idshop),'order'=>'Productshop.id DESC','limit'=>9);
						\$this->set('productshop',\$this->paginate('Productshop',array()));
					
					
						\$cat=\$this->Categoryshop->read(null, \$id);
					    \$this->set('catid',\$cat);
					 }
					
					 function chi_tiet_san_pham(\$id=null) {
					 \$this->set('title_for_layout', 'Chi tiết sản phẩm');
					  \$shop=explode('/',\$this->params['url']['url']);
						\$shopname=\$shop[0];
							\$shop=\$this->requestAction('comment/get_shop_id/'.\$shopname);
							foreach(\$shop as \$key=>\$value){
							\$user=\$key;
							}
					
					
					 \$this->Session->write('menu','sanpham');
					
						 \$sang = \$this->Tems->find('all');
						 \$this->layout='themeshop/template';
						if (!\$id) {
							\$this->Session->setFlash(__('Không tồn tại', true));
							\$this->redirect(array('action' => 'index'));
						}
						\$x1=\$this->Productshop->findById(\$id);
				
				
							\$catproduct_id=\$x1['Productshop']['categoryshop_id'];
				
						\$this->set('views',\$x1);
						\$this->set('list_others', \$this->Productshop->find('all',array('conditions'=>array('Productshop.status'=>1,'Productshop.categoryshop_id'=>\$catproduct_id,'Productshop.id <>'=>\$id,'Productshop.shop_id'=>\$user),'limit'=>10)));
						\$this->set('title_for_layout', 'Chi tiết sản phẩm');
					}
				
					 function khuyen_mai1() {
					    \$pizza = \$_GET['url'];
					   \$urlshop = explode('/', \$pizza);
					   \$geturl=\$urlshop[0];
					   \$temshop = \$this->Shop->findAllByName(\$geturl);
					   \$sang = \$this->Tems->find('all');
			         \$this->layout='themeshop/template';
					  \$this->set('title_for_layout', 'Khuyến mại - '.\$temshop[0]['Shop']['namecompany']);
					 }
					
					 function chinh_sach() {
					   \$sang = \$this->Tems->find('all');
					  \$this->layout='themeshop/template';
					   \$this->set('title_for_layout', '');
					 }
					
					function ban_do() {
					   \$sang = \$this->Tems->find('all');
						\$this->layout='themeshop/template';
							\$this->set('title_for_layout', '');
					 }
					function gioi_thieu() {
					\$this->Session->write('menu','gioithieu');
				
			            \$pizza = \$_GET['url'];
					   \$urlshop = explode('/', \$pizza);
					   \$geturl=\$urlshop[0];
					 
					   \$sang = \$this->Tems->find('all');
					  \$this->layout='themeshop/template';
				
					   \$temshop = \$this->Shop->findAllByName(\$geturl);
			            \$idshop = \$temshop[0]['Shop']['id'];
						\$temshop = \$this->Shop->find('all',array('conditions'=>array('Shop.status'=>1,'Shop.id'=>\$idshop),'order'=>'Shop.id DESC'));
						 \$this->set('title_for_layout','Giới thiệu- '.\$temshop[0]['Shop']['namecompany']);
						 \$this->set('gioithoi',\$temshop);
					}
				
					function lien_he() {
					\$this->Session->write('menu','lienhe');
				
					   \$sang = \$this->Tems->find('all');
					   \$this->set('title_for_layout', 'Liên hệ');
					 \$this->layout='themeshop/template';
					  // hien ti thong tin shop
					   \$pizza = \$_GET['url'];
					   \$urlshop = explode('/', \$pizza);
					   \$geturl=\$urlshop[0];
					    \$temshop = \$this->Shop->findAllByName(\$geturl);
			            \$idshop = \$temshop[0]['Shop']['id'];
						\$temshop = \$this->Shop->find('all',array('conditions'=>array('Shop.status'=>1,'Shop.id'=>\$idshop),'order'=>'Shop.id DESC'));
						\$this->set('infomationshop',\$temshop);
						\$this->set('title_for_layout','Liên hệ - '.\$temshop[0]['Shop']['namecompany']);
				
					 }
				 function send() {
					   \$sang = \$this->Tems->find('all');
					   \$this->layout='themeshop/template';
					  // hien ti thong tin shop
					   \$pizza = \$_GET['url'];
					   \$urlshop = explode('/', \$pizza);
					   \$geturl=\$urlshop[0];
					    \$temshop = \$this->Shop->findAllByName(\$geturl);
			            \$idshop = \$temshop[0]['Shop']['id'];
						\$temshop = \$this->Shop->find('all',array('conditions'=>array('Shop.status'=>1,'Shop.id'=>\$idshop),'order'=>'Shop.id DESC'));
						\$emailshop = \$temshop[0]['Shop']['email'];
						// cau hinh gui mail
						mysql_query('SET NAMES utf8');
						mysql_query('SET character_set_client=utf8');
						mysql_query('SET character_set_connection=utf8');
						if(isset(\$_POST['name']))
						{
						\$name=\$_POST['name'];
						\$mobile=\$_POST['phone'];
						\$email=\$_POST['email'];
						\$title=\$_POST['title'];
						\$content=\$_POST['content'];
					
						\$this->Email->from = \$name.'<'.\$email.'>';
						\$this->Email->to = \$emailshop;
						\$this->Email->subject = \$title;
						\$this->Email->template = 'default';
						\$this->Email->sendAs = 'both';
						\$this->set('name',\$name);
						\$this->set('mobile',\$mobile);
						\$this->set('email',\$email);
						\$this->set('content',\$content);
					
						if(\$this->Email->send())
						{
								\$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
								  echo '<script language=\"javascript\"> alert(\"Gửi email thành công\"); location.href='.DOMAIN.';</script>';
						}
						else
							   \$this->Session->setFlash(__(\"Thêm mơi danh mục thất bại. Vui long thử lại\", true));
								  echo '<script language=\"javascript\"> alert(\"gửi email không thành công\"); location.href='.DOMAIN.';</script>';
						}
				
					 }
					
					 //sidebar phai
					function helponline(){
						\$sangurl = \$_SERVER['REQUEST_URI'];
						\$url = explode('/', \$sangurl);
					    \$geturl=\$url[1];
					    \$temshop = \$this->Shop->findAllByName(\$geturl);
			            \$idshop = \$temshop[0]['Shop']['user_id'];
					    return \$temshop = \$this->Userscms->find('all',array('conditions'=>array('Userscms.id'=>\$idshop),'order'=>'Userscms.id DESC'));
					}
				
				// danh muc menu ben trai
					function categoryproduct(){
						\$sangurl = \$_SERVER['REQUEST_URI'];
						\$url = explode('/', \$sangurl);
					    \$geturl=\$url[1];
					    \$temshop = \$this->Shop->findAllByName(\$geturl);
			            \$idshop = \$temshop[0]['Shop']['id'];
					    return \$this->Categoryshop->find('all',array('conditions'=>array('Categoryshop.status'=>1,'Categoryshop.shop_id'=>\$idshop),'order'=>'Categoryshop.id DESC'));
					}
				
					function categoryproductsub(\$id=null){
						\$sangurl = \$_SERVER['REQUEST_URI'];
						\$url = explode('/', \$sangurl);
					    \$geturl=\$url[1];
					    \$temshop = \$this->Shop->findAllByName(\$geturl);
			            \$idshop = \$temshop[0]['Shop']['id'];
					    return \$this->Categoryshop->find('all',array('conditions'=>array('Categoryshop.status'=>1,'Categoryshop.parent_id'=>\$id,'Categoryshop.shop_id'=>\$idshop),'order'=>'Categoryshop.id DESC'));
					}
				 }
				 \n";
						$stringData .= "?>\n";
						fwrite ( $fh, $stringData );
						fclose ( $fh );
						
						$fromfile = DOCUMENT_ROOT . 'app/controllers/shops_controller.php';
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
	 * checkLanguageCode :$$language_code 
	 * Return : $sql + langue 
	*/
	function checkLanguageCode($project_name,$language_code,$layout_code,$shop_id)
	{
		$sql_langue = Null ;
		$languagecode_layoutcode = $layout_code.'_'.$language_code;
		if($languagecode_layoutcode !='')
		{
			switch ($languagecode_layoutcode)
			{  
				// theme 50000565 : bepga eshop
					case "50000565_vi" :
					case "50000565_en" :
						{   
							// Truong hop dau tien nen tao 2 ngon ngu co san
							//return $sql_langue ="vao den vi va EN".$shop_id;break;
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
									
							$arrSql[]="INSERT INTO `estore_helpsd` (`estore_id`, `name`, `name1`, `name2`, `title`, `sdt`, `sdt1`, `sdt2`, `yahoo`, `yahoo1`, `yahoo2`, `skype`, `skype1`, `skype2`, `created`, `modified`, `status`) VALUES
								($shop_id, 'Kỹ thuật 1', '', '', '', NULL, '04 38515107', '09 38515108', NULL, 'vulamnguyen', 'vulamnguyen', 'haihs26', '', '', '2011-12-06 10:08:49', '2012-06-14 10:25:11', 1);";
							
							$arrSql[]="INSERT INTO `estore_infomationdetails` (`estore_id`, `infomations_id`, `product_id`, `name`, `images`, `quantity`, `price`) VALUES
								($shop_id, 36, 19, 'sp14', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_27.jpg', 1, 200),
								($shop_id, 36, 20, 'sp13', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 1, 400),
								($shop_id, 37, 20, 'sp13', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 2, 400),
								($shop_id, 37, 19, 'sp14', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_27.jpg', 1, 200),
								($shop_id, 38, 21, 'sp2', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_17.jpg', 1, 300),
								($shop_id, 38, 27, 'sp3', '/khieuvu/estoreadmin/webroot/upload/image/files/3.jpg', 1, 200),
								($shop_id, 39, 27, 'sp3', '/khieuvu/estoreadmin/webroot/upload/image/files/3.jpg', 23, 200),
								($shop_id, 40, 25, 'sp1', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_09.jpg', 3, 120),
								($shop_id, 40, 26, 'sp43', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 1, 120000),
								($shop_id, 41, 21, 'sp2', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_17.jpg', 2, 300),
								($shop_id, 41, 19, 'sp14', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_27.jpg', 1, 200),
								($shop_id, 41, 26, 'sp43', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 1, 120000),
								($shop_id, 42, 26, 'sp43', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 5, 120000),
								($shop_id, 43, 32, 'sp565', '/khieuvu/estoreadmin/webroot/upload/image/files/bg_menu_20.jpg', 2, 20000),
								($shop_id, 44, 64, 'sp5', '/estoreadmin/webroot/upload/image/files/vietsys_53.jpg', 1, 40000),
								($shop_id, 44, 48, 'sp4', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
								($shop_id, 44, 61, 'sp2', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
								($shop_id, 44, 49, 'sp5', '/estoreadmin/webroot/upload/image/files/vietsys_53.jpg', 1, 40000),
								($shop_id, 45, 63, 'sp4', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
								($shop_id, 46, 49, 'sp5', '/estoreadmin/webroot/upload/image/files/vietsys_53.jpg', 1, 40000),
								($shop_id, 46, 50, 'sp6', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
								($shop_id, 47, 64, 'sp5', '/estoreadmin/webroot/upload/image/files/vietsys_53.jpg', 1, 40000),
								($shop_id, 47, 78, 'sp4', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
								($shop_id, 48, 73, 'sp4', '/estoreadmin/webroot/upload/image/files/vietsys_55.jpg', 1, 300000),
								($shop_id, 51, 243, 'Tủ chữ L nhiều ngăn', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', 1, 4500000),
								($shop_id, 51, 245, 'Bếp cho quán ăn vừa và nhỏ', 'img/upload/3007b340574bcfd67cc42fd18c74d9b0.jpg', 1, 160000),
								($shop_id, 52, 243, 'Tủ chữ L nhiều ngăn', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', 1, 4500000),
								($shop_id, 52, 232, 'Bếp trung bình chữ I', 'img/upload/06e0bd26dd69280f9c14e247b49a3ec6.jpg', 2, 2300000),
								($shop_id, 53, 218, 'Bến nhà hàng', 'img/upload/3007b340574bcfd67cc42fd18c74d9b0.jpg', 3, 3500000),
								($shop_id, 53, 243, 'Tủ chữ L nhiều ngăn', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', 1, 4500000),
								($shop_id, 54, 243, 'Tủ chữ L nhiều ngăn', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', 1, 4500000),
								($shop_id, 54, 231, 'Bếp trung bình chữ I', 'img/upload/06e0bd26dd69280f9c14e247b49a3ec6.jpg', 3, 2300000);";
							
							$arrSql[]="INSERT INTO `estore_infomations` (`estore_id`, `idnew`, `user_id`, `name`, `email`, `address`, `mobile`, `comment`, `deal`, `company`, `phone`, `fax`, `country`, `datereturn`, `fullname_male`, `fullname_female`, `questions_day`, `wedding_day`, `title_question`, `wedding_title`, `name_product`, `images`, `sl`, `price`, `total`, `orther`, `created`, `status`) VALUES
								($shop_id, 0, 'id173768', 'Hoang Cong Phuc', 'phuca4@gmail.com', 'Ha Noi', 2147483647, '', NULL, '', '84972607988', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '9100000', NULL, '2014-07-25 08:57:55', 0),
								($shop_id, 0, 'id98603', 'Hoang Phuc', 'phuca4@gmail.com', 'Ha Noi', 2147483647, '', NULL, '', '84972607988', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '15000000', NULL, '2014-07-25 09:04:11', 0),
								($shop_id, 0, 'id686188', 'Hoang Cong Phuc', 'phuca4@gmail.com', 'Ha Noi', 2147483647, '', NULL, '', '84972607988', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '11400000', NULL, '2014-07-25 09:10:40', 0);";
							
							$arrSql[]="INSERT INTO `estore_manufacturers` (`estore_id`, `parent_id`, `lft`, `rght`, `name`, `created`, `modified`, `status`, `char`) VALUES
								($shop_id, NULL, 1, 28, 'Rigth', '2012-05-18', '2012-09-13 17:55:06', 1, NULL),
								($shop_id, NULL, 29, 62, 'Toyota', '2012-05-18', '2012-06-04 06:57:18', 1, NULL),
								($shop_id, NULL, 63, 80, 'Daewoo', '2012-05-18', '2012-06-21 06:25:09', 1, NULL),
								($shop_id, NULL, 81, 92, 'Ford', '2012-05-18', '2012-06-19 13:11:22', 1, NULL),
								($shop_id, NULL, 93, 116, 'BMW', '2012-05-18', '2012-05-18 13:50:13', 1, NULL),
								($shop_id, NULL, 117, 130, 'Nissan', '2012-05-18', '2012-05-18 13:50:25', 1, NULL),
								($shop_id, NULL, 131, 144, 'Suzuki', '2012-05-18', '2012-05-18 13:50:51', 1, NULL),
								($shop_id, NULL, 145, 168, 'Audi', '2012-05-24', '2012-05-24 08:07:17', 1, NULL),
								($shop_id, NULL, 169, 184, 'Mitsubishi', '2012-05-24', '2012-05-24 08:08:10', 1, NULL),
								($shop_id, NULL, 185, 200, 'Kia', '2012-05-24', '2014-07-27 10:05:08', 1, NULL),
								($shop_id, NULL, 201, 214, 'Ford', '2012-05-24', '2012-06-21 06:11:02', 0, NULL),
								($shop_id, NULL, 215, 230, 'Hyundai', '2012-05-24', '2012-06-19 13:00:19', 1, NULL),
								($shop_id, NULL, 231, 244, 'Mercedes ', '2012-05-28', '2012-05-28 07:49:40', 1, NULL);";
							
							$arrSql[]="INSERT INTO `estore_orders` (`estore_id`, `user_id`, `pid`, `pname`, `images`, `quantity`, `price`, `total_price`) VALUES
								($shop_id, 'id366822', 21, 'Ống công nghiệp inox ', '/tana/estoreadmin/webroot/upload/image/images/index_29.jpg', 1, 300, 300),
								($shop_id, 'id366822', 20, 'Ống công nghiệp inox', '/tana/estoreadmin/webroot/upload/image/images/index_33.jpg', 1, 400, 400),
								($shop_id, 'id366822', 19, 'Ống công nghiệp inox ', '/tana/estoreadmin/webroot/upload/image/images/index_31.jpg', 1, 200, 200),
								($shop_id, 'id47761', 25, 'Ống công nghiệp inox ', '/tana/estoreadmin/webroot/upload/image/images/index_27.jpg', 5, 120, 600),
								($shop_id, 'id47761', 20, 'Ống công nghiệp inox', '/tana/estoreadmin/webroot/upload/image/images/index_33.jpg', 5, 400, 2000),
								($shop_id, 'id717636', 25, 'sp1', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_09.jpg', 1, 120, 120),
								($shop_id, 'id881866', 21, 'sp2', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_17.jpg', 1, 300, 300),
								($shop_id, 'id503470', 26, 'sp43', '/khieuvu/estoreadmin/webroot/upload/image/images/bg_menu_20.jpg', 1, 120000, 120000),
								($shop_id, 'id67517', 27, 'sp3', '/khieuvu/estoreadmin/webroot/upload/image/files/3.jpg', 1, 200, 200);";
							
							$arrSql[]="INSERT INTO `estore_partners` (`estore_id`, `name`, `phone`, `email`, `website`, `fax`, `address`, `images`, `content`, `created`, `modified`, `status`) VALUES
								($shop_id, 'Công ty bcds', '', '', 'http://google.com', NULL, '', 'img/upload/a26d66b1322c320201a5a6c01e9f004f.jpg', NULL, '2012-07-29', '2012-07-29', 1),
								($shop_id, 'Công ty bcd', '', '', 'http://google.com', NULL, '', 'img/upload/aded75138b945d987476ee4beaa48400.jpg', NULL, '2012-07-29', '2012-07-29', 1),
								($shop_id, 'Công ty dcb', '', '', 'http://google.com', NULL, '', 'img/upload/65756cba90775ab2b30a744199a7c84a.jpg', NULL, '2012-07-29', '2012-07-29', 1),
								($shop_id, 'Công ty abc', '', '', 'http://eximbank.com.vn', NULL, '', 'img/upload/61c692bbd3e8c4f8cb24ca87e9ff3d92.jpg', NULL, '2012-07-29', '2012-07-29', 1),
								($shop_id, 'ádasd', '', '', 'http://google.com', NULL, '', 'img/upload/36e21b2e6d68b65741d004886e5223cb.jpg', NULL, '2012-09-16', '2012-09-16', 1),
								($shop_id, 'hhhh', '', '', 'http://google.com', NULL, '', 'img/upload/97fea11d1a80d7ccfad25eccdd7d031e.jpg', NULL, '2012-09-16', '2012-09-16', 1),
								($shop_id, 'hhh', '', '', 'http://google.com', NULL, '', 'img/upload/f6c03d67fe500b1ac80f32c87c60ec59.jpg', NULL, '2012-09-16', '2012-09-16', 1),
								($shop_id, 'h', '', '', 'http://google.com', NULL, '', 'img/upload/8f9fa526eff662129d81b1fb55d07676.jpg', NULL, '2012-09-16', '2012-09-16', 1),
								($shop_id, 'hhh', '', '', 'http://google.com', NULL, '', 'img/upload/74b21a268eb187c89772e79f91895d62.jpg', NULL, '2012-09-16', '2012-09-16', 1),
								($shop_id, 'á', '', '', 'http://google.com', NULL, '', 'img/upload/ff76a40ba32dfb0687988e0bdbc15765.jpg', NULL, '2012-09-16', '2012-09-16', 1),
								($shop_id, 'ádas', '', '', 'http://google.com', NULL, '', 'img/upload/cb18c77ef1e964033f5e9b33c991411d.jpg', NULL, '2012-09-16', '2012-09-16', 1);";
							
							$arrSql[]="INSERT INTO `estore_products` (`estore_id`, `title`, `title_en`, `price`, `manufacturer`, `introduction`, `content`, `content_en`, `images`, `images_en`, `catproduct_id`, `display`, `created`, `modified`, `sptieubieu`, `status`, `alias`, `code`, `kichthuoc`, `chatlieu`, `khoanggia`, `spkuyenmai`) VALUES
								($shop_id, 'Bến chữ U cho bếp rộng', 'U-shaped cabinet for large kitchen', 12500000, '144', '', '<p>\r\n	đang cập nhật</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '', 'img/upload/434d3a69764058750f0f6b59e7c2e0e3.jpg', '', 112, 0, '2012-08-23 10:30:03', '2012-09-14 10:58:18', 1, 1, 'ben-chu-u-cho-bep-rong', 'able 02', '30 x 30 cm ', 'Cây cọ', 10, 0),
								($shop_id, 'Tủ chữ L', 'L-shaped kitchen cabinet', 4500000, '', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', '', 110, 0, '2012-08-23 10:55:17', '2012-09-14 10:55:27', 1, 1, 'tu-chu-l', 'h4322', '20 x 40 cm', 'Mây, Tre', 5, 1),
								($shop_id, 'kids product 123', 'kids product 123', 210000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/7aa2d4c620cba46145faf03c72afb234.jpg', '', 105, 0, '2012-08-23 11:11:53', '2012-08-23 18:17:45', 1, 1, 'kids-product-123', '123123', '30 x 30 cm', 'gỗ', NULL, 0),
								($shop_id, 'adults product 12', 'adults product 12', 321000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/a024674425c52d5d93bcfa308f9dc244.png', '', 104, 0, '2012-08-23 11:13:56', '2012-08-23 11:13:56', 1, 1, 'adults-product 12', '5645', '30 x 30 cm', 'da', NULL, 0),
								($shop_id, 'Máy khử mùi Nsaka', 'Nsaka machine hood', 120000, '', '', '<p>\r\n	đang cập nhật</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '', 'img/upload/de7ed01c7b9dbb1bbdb2711a21176e49.jpg', '', 114, 0, '2012-08-23 10:30:03', '2012-09-14 10:51:51', 1, 1, 'may-khu-mui-nsaka', 'able 02', '30 x 30 cm ', 'Cây cọ', 1, 0),
								($shop_id, 'Bình + Van 14kg', 'Gas Container + Valve 14kg', 400000, '148', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/00687fc01e05574a7182ab1761b81ab3.jpg', '', 118, 0, '2012-08-23 10:55:17', '2012-09-14 10:53:32', 1, 1, 'bình-van-14kg', 'BV1232', '20 x 40 cm', 'Mây, Tre', 0, 1),
								($shop_id, 'Bến nhà hàng', 'Gas stove for restaurant', 3500000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/3007b340574bcfd67cc42fd18c74d9b0.jpg', '', 119, 0, '2012-08-23 11:11:53', '2012-09-13 18:39:19', 1, 1, 'bén-nhà-hàng', 'B1123', '100 x 200 m', 'gỗ', 2, 0),
								($shop_id, 'adults product 2', 'adults product 2', 321000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/de76e83506ffb367e04f84696b80c962.jpg', '', 104, 0, '2012-08-23 11:13:56', '2012-08-23 18:17:15', 1, 1, 'adults-product 12', '564500', '30 x 30 cm', 'da', NULL, 0),
								($shop_id, 'Bếp nướng Mỹ', 'American Grill Stove', 5000000, '145', '', '<p>\r\n	đang cập nhật</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '', 'img/upload/872b06396ec7593b99032bd001c8a508.jpg', '', 120, 0, '2012-08-23 10:30:03', '2012-09-14 10:50:06', 1, 1, 'bep-nuong-my', 'able 02', '30 x 30 cm ', 'Cây cọ', 6, 0),
								($shop_id, 'Bình 13kg', 'Gas container 13kg', 312000, '144', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/d9745f770c64999ec1cd9111f2031fc6.jpg', '', 117, 0, '2012-08-23 10:55:17', '2012-09-14 10:52:55', 0, 1, 'bình-13kg', 'B123', '100 x 40 cm', 'Mây, Tre', 0, 0),
								($shop_id, 'Bếp ga RinNight', 'RinNight gas stove', 900000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/06e53cdfec18eaa1af6e79a1d3231a15.jpg', '', 105, 0, '2012-08-23 11:11:53', '2012-09-13 18:34:42', 1, 1, 'bép-ga-rinnight', 'R123123', '300 x 300 cm', 'gỗ', 0, 0),
								($shop_id, 'Bếp ga âm Hàn Quốc', 'Korean negative gas stove', 1500000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/face1fafd07a42b87dfe77dd92f048c4.jpg', '', 104, 0, '2012-08-23 11:13:56', '2012-09-14 10:24:36', 1, 1, 'bép-ga-am-hàn-quóc', 'HQ5645', '30 x 30 cm', '', 1, 1),
								($shop_id, 'Bếp trung bình chữ I', 'I-shaped medium gas stove', 2300000, '139', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/06e0bd26dd69280f9c14e247b49a3ec6.jpg', '', 111, 0, '2012-09-14 10:57:02', '2012-09-14 10:57:02', 1, 1, 'bep-trung-binh-chu-i', 'B56I', NULL, NULL, 2, 0),
								($shop_id, 'Bến chữ U đẹp', 'U-shaped gas stove', 12500000, '144', '', '<p>\r\n	đang cập nhật</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '', 'img/upload/434d3a69764058750f0f6b59e7c2e0e3.jpg', '', 112, 0, '2012-08-23 10:30:03', '2012-09-14 10:58:18', 1, 1, 'ben-chu-u-cho-bep-rong', 'able 02', '30 x 30 cm ', 'Cây cọ', 10, 0),
								($shop_id, 'Tủ chữ L nhiều ngăn', 'L-shaped gas stove with drawers', 4500000, '', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', '', 110, 0, '2012-08-23 10:55:17', '2012-09-14 10:55:27', 1, 1, 'tu-chu-l', 'h4322', '20 x 40 cm', 'Mây, Tre', 5, 1),
								($shop_id, 'kids product 123', 'kids product 123', 21, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/7aa2d4c620cba46145faf03c72afb234.jpg', '', 105, 0, '2012-08-23 11:11:53', '2012-08-23 18:17:45', 1, 1, 'kids-product-123', '123123', '30 x 30 cm', 'gỗ', NULL, 0),
								($shop_id, 'adults product 12', 'adults product 12', 321000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/a024674425c52d5d93bcfa308f9dc244.png', '', 104, 0, '2012-08-23 11:13:56', '2012-08-23 11:13:56', 1, 1, 'adults-product 12', '5645', '30 x 30 cm', 'da', NULL, 0),
								($shop_id, 'Máy khử mùi Nsaka', 'Nsaka machine hood', 120000, '', '', '<p>\r\n	đang cập nhật</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '', 'img/upload/de7ed01c7b9dbb1bbdb2711a21176e49.jpg', '', 114, 0, '2012-08-23 10:30:03', '2012-09-14 10:51:51', 1, 1, 'may-khu-mui-nsaka', 'able 02', '30 x 30 cm ', 'Cây cọ', 1, 0),
								($shop_id, 'Bình + Van 14kg', 'Gas Container + Valve 14kg', 400000, '148', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/00687fc01e05574a7182ab1761b81ab3.jpg', '', 118, 0, '2012-08-23 10:55:17', '2012-09-14 10:53:32', 1, 1, 'bình-van-14kg', 'BV1232', '20 x 40 cm', 'Mây, Tre', 0, 1),
								($shop_id, 'Bến nhà hàng', 'Gas stove for restaurant', 3500000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/3007b340574bcfd67cc42fd18c74d9b0.jpg', '', 119, 0, '2012-08-23 11:11:53', '2012-09-13 18:39:19', 1, 1, 'bén-nhà-hàng', 'B1123', '100 x 200 m', 'gỗ', 2, 0),
								($shop_id, 'adults product 2', 'adults product 2', 321000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/de76e83506ffb367e04f84696b80c962.jpg', '', 104, 0, '2012-08-23 11:13:56', '2012-08-23 18:17:15', 1, 1, 'adults-product 12', '5645', '30 x 30 cm', 'da', NULL, 0),
								($shop_id, 'Bếp nướng Mỹ', 'American Grill Stove', 5000000, '145', '', '<p>\r\n	đang cập nhật</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '', 'img/upload/872b06396ec7593b99032bd001c8a508.jpg', '', 120, 0, '2012-08-23 10:30:03', '2012-09-14 10:50:06', 1, 1, 'bep-nuong-my', 'able 02', '30 x 30 cm ', 'Cây cọ', 6, 0),
								($shop_id, 'Bình 13kg', 'Gas container 13kg', 312000, '144', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/d9745f770c64999ec1cd9111f2031fc6.jpg', '', 117, 0, '2012-08-23 10:55:17', '2012-09-14 10:52:55', 0, 1, 'bình-13kg', 'B123', '100 x 40 cm', 'Mây, Tre', 0, 0),
								($shop_id, 'Bếp ga RinNight', 'RinNight gas stove', 900000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/06e53cdfec18eaa1af6e79a1d3231a15.jpg', '', 105, 0, '2012-08-23 11:11:53', '2012-09-13 18:34:42', 1, 1, 'bép-ga-rinnight', 'R123123', '300 x 300 cm', 'gỗ', 0, 0),
								($shop_id, 'Bếp ga âm Hàn Quốc', 'Korean negative gas stove', 1500000, '', '', '<p>\r\n	update...</p>\r\n', '', 'img/upload/face1fafd07a42b87dfe77dd92f048c4.jpg', '', 104, 0, '2012-08-23 11:13:56', '2012-09-14 10:24:36', 1, 1, 'bép-ga-am-hàn-quóc', 'HQ5645', '30 x 30 cm', '', 1, 1),
								($shop_id, 'Bếp trung bình chữ I', 'I-shaped medium gas stove', 2300000, '139', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/06e0bd26dd69280f9c14e247b49a3ec6.jpg', '', 111, 0, '2012-09-14 10:57:02', '2012-09-14 10:57:02', 1, 1, 'bep-trung-binh-chu-i', 'B56I', NULL, NULL, 2, 0),
								($shop_id, 'Bếp cho quán ăn vừa và nhỏ', 'Gas stove for small and medium restaurant', 160000, '141', '', '<p>\r\n	đang c&acirc;p nhật</p>\r\n', '', 'img/upload/3007b340574bcfd67cc42fd18c74d9b0.jpg', '', 119, 0, '2012-09-14 11:33:00', '2012-09-14 11:33:00', 0, 1, 'bep-cho-quan-an-vua-va-nho', 'B912', NULL, NULL, 1, 1),
								($shop_id, 'Bếp nấu ăn nhà hàng 5 sao', 'Gas stove for 5-star restaurant', 17500000, '', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/92cecb0fc068b89020e492ecf4c673ea.jpg', '', 120, 0, '2012-09-14 11:34:37', '2012-09-14 11:34:37', 0, 1, 'bep-nau-an-nha-hang-5-sao', 'Vi89', NULL, NULL, 10, 1),
								($shop_id, 'Tủ chữ L', 'L-shaped kitchen cabinet', 4500000, '', '', '<p>\r\n	đang cập nhật</p>\r\n', '', 'img/upload/e06b30abc2aa67efdccf89e55f45cafc.jpg', '', 110, 0, '2012-08-23 10:55:17', '2012-09-14 10:55:27', 1, 1, 'tu-chu-l', 'h4322', '20 x 40 cm', 'Mây, Tre', 5, 1);";
							
							$arrSql[]="INSERT INTO `estore_settings` (`estore_id`, `name`, `title`, `info_other`, `address`, `phone`, `mobile`, `email`, `server`, `username`, `password`, `url`, `keyword`, `description`, `content`, `created`, `modified`, `name_en`, `address_eg`, `title_en`, `descriptions`, `footer`) VALUES
								($shop_id, 'Công ty cổ phần Demo', 'CÔNG TY TNHH DEMO', 'Copyright © 2011 Bản quyền thuộc Vinaconex 12', 'Nguyễn Văn Linh - Q. Long Biên - Hà Nội', '04.38517532', '0979 644 688', 'servic@demo.vn', 'localhost', 'root', NULL, 'demo.vn', 'CONG TY TNHH  DEMO', 'CONG TY TNHH  DEMO', '<p>\r\n	<span style=\"font-size:14px;\"><tt>Hoặc vui l&ograve;ng điền đầy đủ th&ocirc;ng tin v&agrave;o đơn h&agrave;ng, sau khi ho&agrave;n th&agrave;nh qu&yacute; kh&aacute;ch lick &quot;Gửi đơn h&agrave;ng&quot;<br />\r\n	Sau khi nhận được đơn h&agrave;ng, trong v&ograve;ng 24h ch&uacute;ng t&ocirc;i sẽ li&ecirc;n hệ với qu&yacute; kh&aacute;ch để x&aacute;c nhận. </tt></span></p>\r\n', '0000-00-00', '1406477611', 'CONG TY TNHH DAU TU THUONG MAI & DICH VỤ VIET NAM TOAN CAU', '', 'CONG TY TNHH  DEMO', '<p>\r\n	đang cập nhật</p>\r\n', '<p style=\"text-align: center; \">\r\n	&nbsp;</p>\r\n<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" style=\"width: 980px; \">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n				<div>\r\n					<span style=\"color: rgb(255, 255, 255); \">Head office: 4A No, Lang Ha street - Ba Dinh district - HN City</span></div>\r\n				<div>\r\n					<span style=\"color: rgb(255, 255, 255); \">Showroom 1: 128C No, Dai La street - HN City</span></div>\r\n				<div>\r\n					<span style=\"color: rgb(255, 255, 255); \">Tel: (+84) 4 37 53 3004 - (+84) 4 59 22 27 - Fax: (+84) 4 37 53 3004</span></div>\r\n			</td>\r\n			<td>\r\n				<div>\r\n					<span style=\"color: rgb(255, 255, 255); \">Showroom 2: 128c ,street &nbsp;- Dong Tam district - HN City</span></div>\r\n				<div>\r\n					<span style=\"color: rgb(255, 255, 255); \">Tel: (+84) 4 36 74 1073 &nbsp;- Fax: (+84) 4 37 59 3004</span></div>\r\n				<div>\r\n					<span style=\"color: rgb(255, 215, 0); \">Website: www.alatca.vn</span></div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p style=\"text-align: center; \">\r\n	&nbsp;</p>\r\n');";
							
							$arrSql[]="INSERT INTO `estore_slideshows` (`estore_id`, `name`, `images`, `created`, `status`) VALUES
								($shop_id, 'slide4', 'img/gallery/529ef1813f7eb5638314a9814bdf4371.png', '2012-07-29 15:36:03', 1),
								($shop_id, 'slide', 'img/gallery/784197959d177a4062b681bcda56ebe0.jpg', '2012-09-13 12:52:02', 1);";
							
							$arrSql[]="INSERT INTO `estore_users` (`estore_id`, `password`, `name`, `email`, `phone`, `birth_date`, `sex`, `images`, `created`, `modified`, `active_key`, `status`) VALUES
								($shop_id, 'e10adc3949ba59abbe56e057f20f883e', 'admin', 'estoreadmin@estoreadmin', 2147483647, '18-11-1968', '1', '', '2011-05-17 14:33:04', '2012-07-08 10:07:43', '70c639df5e30bdee440e4cdf599fec2b', 1),
								($shop_id, 'e10adc3949ba59abbe56e057f20f883e', 'tung', 'phuca4@gmail.com', 972943090, '2012-07-18', '1', '', '2012-07-10 08:56:46', '2012-07-10 08:56:46', 'd58072be2820e8682c0a27c0518e805e', 0);";
							
							$arrSql[]="INSERT INTO `estore_videos` (`estore_id`, `name`, `video`, `LinkUrl`, `created`, `status`, `left`, `right`) VALUES
								($shop_id, 'Gala trong ngay', 'video/upload/c67b28f317fe8740ada0a80316a0559c.flv', 'http://www.youtube.com/watch?v=5z7DEE70dEs&feature=related', '2011-10-02 18:51:33', 1, 0, 0),
								($shop_id, 'Clip gala Bên phải', 'video/upload/64c23f4052d6626521caef72b1bc067f.flv', 'http://www.youtube.com/watch?v=76ZqkGxe_Mc&feature=g-vrec', '2012-06-14 14:46:38', 1, 1, 0);";
							
							$arrSql[]="INSERT INTO `estore_weblinks` (`estore_id`, `name`, `link`, `created`, `modified`, `status`) VALUES
								($shop_id, 'Google', 'http://google.vn', '0000-00-00', '0000-00-00', 1),
								($shop_id, 'Dân trí', 'http://dantri.com.vn', '0000-00-00', '2012-08-04', 1),
								($shop_id, '24h', 'http://24h.com.vn', '2012-08-04', '2012-08-04', 1),
								($shop_id, 'quản trị mạng', 'http://quantrimang.com.vn', '2012-08-04', '2012-08-04', 1);"; 
							
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
			case 50000565:
				{
					// Copy views shops to views
						
					$source = DOCUMENT_ROOT . 'app/views/bepga/';
					$destination = DOCUMENT_ROOT . 'app/views/' . $project_name;
					// $source = DOMAIN.'app/views/shops/';
					// $destination = DOMAIN.'app/views/'.$project_name;
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
