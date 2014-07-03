<?php
class RegisterstoreController extends AppController {

	var $name = 'Registerstore';
	var $uses=array('Shops','News','City','Userscms');
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
	function index() {
		  
// 		die('dang ki mo gian hang');
		
			//$this->checkIfLogged();
			$city=$this->City->find('all');
			$this->set('city',$city);
			
			$shops=$this->Shops->find('all');
			//pr($shops);die;
			$this->set('shops',$shops);
			
	}
	
	function profile() {
		$this->layout='home2';
		$this->checkIfLogged();
		$member_id=$this->Session->read('id');
		$edit=$this->Shops->findByUser_id ($member_id);
		//pr($member_id);die;
		$this->set('edit',$edit);
	}
	function editshop() {
		$this->layout='home2';
		$this->checkIfLogged();
	$member_id=$this->Session->read('id');
		
		$iduser = $this->Shops->find('all',array('conditions'=>array('Shops.user_id'=>$member_id)));
		//pr($iduser);die;
		$this->set('edit', $iduser);
		$city=$this->City->find('all');
		$this->set('city',$city);
		
		// --------------------------
		
	}
	
	// dang ky gian hang 
	function add() {
		// $this->checkIfLogged(); // ham checki nay bi loi
		 
   // kiem tra ton tai gian hang
		//echo ($_POST['tengianhang']);die;
	    $name=$this->Shops->findAllByName($_POST['tengianhang']);  // pr(count($name));die;
		if(count($name)==1){
				echo "<script>alert('".json_encode('Tên gian hàng đã tồn tại!')."');</script>";
				echo "<script>history.back(-1);</script>";
	    }else {
	    	
	    	
	    $myFile = DOCUMENT_ROOT.'app/controllers/shops_controller.php';
		//$myFile = DOMAIN.'app/controllers/shops_controller.php';
		//pr($myFile);die;
		$fh = fopen($myFile, 'w') or die("can't open file");
		//gan du lieu thanh 1 file khac
		$stringData = "";
		$stringData .= "<?php\n";
		$stringData .= "
		  class ".ucfirst($_POST['tengianhang'])."Controller extends AppController {
		  var \$name = '".ucfirst($_POST['tengianhang'])."';
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
		    \$geturl=\$url[2];
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
		    \$geturl=\$url[2];
		    \$temshop = \$this->Shop->findAllByName(\$geturl);
            \$idshop = \$temshop[0]['Shop']['user_id'];
			return \$this->Background->find('all',array('conditions'=>array('Background.user_id'=>\$idshop),'order'=>'Background.id DESC','limit'=>1));
		 } 
		 
		 function raovatnews() {	
		   \$sang = \$this->Tems->find('all');
		   \$this->layout='themeshop/template';
		    \$sangurl = \$_SERVER['REQUEST_URI'];
			\$url = explode('/', \$sangurl);
		    \$geturl=\$url[2];
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
		    \$geturl=\$url[2];
		    \$temshop = \$this->Shop->findAllByName(\$geturl);
            \$idshop = \$temshop[0]['Shop']['user_id'];
		    return \$temshop = \$this->Userscms->find('all',array('conditions'=>array('Userscms.id'=>\$idshop),'order'=>'Userscms.id DESC'));
		}
		
	// danh muc menu ben trai
		function categoryproduct(){
			\$sangurl = \$_SERVER['REQUEST_URI'];
			\$url = explode('/', \$sangurl);
		    \$geturl=\$url[2];
		    \$temshop = \$this->Shop->findAllByName(\$geturl);
            \$idshop = \$temshop[0]['Shop']['id'];
		    return \$this->Categoryshop->find('all',array('conditions'=>array('Categoryshop.status'=>1,'Categoryshop.shop_id'=>\$idshop),'order'=>'Categoryshop.id DESC'));
		}
		
		function categoryproductsub(\$id=null){
			\$sangurl = \$_SERVER['REQUEST_URI'];
			\$url = explode('/', \$sangurl);
		    \$geturl=\$url[2];
		    \$temshop = \$this->Shop->findAllByName(\$geturl);
            \$idshop = \$temshop[0]['Shop']['id'];
		    return \$this->Categoryshop->find('all',array('conditions'=>array('Categoryshop.status'=>1,'Categoryshop.parent_id'=>\$id,'Categoryshop.shop_id'=>\$idshop),'order'=>'Categoryshop.id DESC'));
		}
	 }
	 \n";
	     $stringData.="?>\n";
		 // ket thuc
		 
		fwrite($fh, $stringData);
		fclose($fh);
		
		//Copy shop_controller to shopname_controller
		$fromfile = DOCUMENT_ROOT.'app/controllers/shops_controller.php';
		$tofile = DOCUMENT_ROOT.'app/controllers/'.$_POST['tengianhang'].'_controller.php';
		
		if (file_exists($tofile)){
			print "Tên gian hàng đã tồn tại";
			exit;
		}
		copy ( $fromfile , $tofile );
		
		//Copy views shops to views 
		
	    $source = DOCUMENT_ROOT.'app/views/shops/';
		$destination = DOCUMENT_ROOT.'app/views/'.$_POST['tengianhang'];
		//$source = DOMAIN.'app/views/shops/';
		//$destination = DOMAIN.'app/views/'.$_POST['tengianhang'];
		mkdir($destination, 0777); // so you get the sticky bit set 
		$dir_handle = @opendir($source) or die("Unable to open");
		while ($file = readdir($dir_handle)) 
		{
		if($file!="." && $file!=".." && !is_dir("$source/$file"))
		copy("$source/$file","$destination/$file");
		}
		closedir($dir_handle);
		//------------
		// open file and write file
		
		//
		//exit;
       
		//echo($this->Common->unicode_convert($_POST['name']));
		//pr($_POST);
		//die;
		
		  $x=array();
			$x['name']=$_POST['tengianhang'];
			//$x['user_id']=$this->Session->read("id");
			$x['user_id']= 99; // 99 ma khach hang dang ki 
			$x['slug']=$this->unicode_convert($_POST['tengianhang']);
			$x['link']=$_POST['link'];
			$x['business']=$_POST['business'];
			$x['phone']=$_POST['phone'];
			$x['email']=$_POST['email'];
			$x['address']=$_POST['address'];
			$x['city']=$_POST['city'];
			$x['namecompany']=$_POST['namecompany'];
			$x['mobile']=$_POST['mobile'];
			$x['fax']=$_POST['fax'];
			$x['ckshops']=1;
			$x['status']=1;
			//mkdir("/path/to/my/dir", 0700);
			
// 			echo "lay gia tri </br>";
// 			pr($x);
// 			die;
			
		   $structure = GIANHANG.$_POST['tengianhang'].'/';
		  
		   // octal; correct value of mode
		   $this->Shops->save($x);
		  // echo($structure);die;
		// To create the nested structure, the $recursive parameter 
		// to mkdir() must be specified.
       

		if (!mkdir($structure, 0, true)) {
			echo "<script language='javascript'>alert('Bạn đăng ký không thành công, xem lại');window.location.back(-1);</script>";
		}else{
			
			echo "<script language='javascript'>alert('Chúc mừng bạn đăng ký gian hàng công');window.location.replace('".DOMAIN."thanh-vien');</script>";
			chmod($structure, 0777); 
			}
		
		 }
				
		}
	
	// dang ky gian hang 
	function edit() {
		 
		  $x=array();
			$x['user_id']=$this->Session->read("id");
			$x['link']=$_POST['link'];
			$x['business']=$_POST['business'];
			$x['phone']=$_POST['phone'];
			$x['email']=$_POST['email'];
			$x['address']=$_POST['address'];
			$x['images']=$_POST['userfile'];
			$x['city']=$_POST['city'];
			$x['mobile']=$_POST['mobile'];
			$x['id']=$_POST['id'];
			$x['content']=$this->data['Shops']['content'];
			$x['fax']=$_POST['fax'];
			$x['ckshops']=1;
			//mkdir("/path/to/my/dir", 0700);
		   $this->Shops->save($x);
		  // echo($structure);die;
		// To create the nested structure, the $recursive parameter 
		// to mkdir() must be specified.

			echo "<script language='javascript'>alert('Chúc mừng bạn cập nhật thành công');window.location.replace('".DOMAIN."thanh-vien');</script>";
	
		}
	
	function account() {
	
		$this->checkIfLogged();
		$member_id=$this->Session->read('id');
		
		$edit=$this->Shops->findByUser_id ($member_id);
		//pr($member_id);die;
		$this->set('edit',$edit);
	   
	}
	
	//cai dat giao dien
	function settingshop() {
		  if(!$this->Session->read("id")){
			 echo "<script>location.href='".DOMAIN."login'</script>";
		}else
			{
			$this->layout='home2';
			}
	   
	}
			
	
	 /* Ham check mail ton tai khi dang ky thanh vien */
	function ck_name_register(){
		 $this->checkIfLogged();
		$this->layout= 'ajax';
		//$this->Shops->unbindModel(array('hasMany' => array('Shops')));
		$name=$this->Shops->findAllByName($_GET['name']);
		if(count($name)==0){
			echo "<span style='color:#00FF33;padding-left:0px;'>Gian hàng hợp lệ ! </span>"; 
		}
		
		if(count($name)>0){
			foreach($name as $name1){
				 if($name1['Shops']['name'] == 1){
							$check = 1;	
							//break;
				 }
				else
				{
						$check = 0;	
						//break;
				}
			}
				if($check==1){
					echo "<span style='color:#00FF33;padding-left:0px;'>Gian hàng hợp lệ </span>";
				}
				elseif($check==0){
					echo "<span style='color:#FF0000;padding-left:0px;'>Gian hàng đã tồn tại </span>";
				}
					
			}
        }
		
	function checkIfLogged(){
		if(!$this->Session->read("shopname") || !$this->Session->read("id")){
			 $this->redirect('/dang-nhap');
		}
	}
/* Ham khoi tao capcha*/
	function create_image(){
		$md5_hash = md5(rand(0,999));
		$security_code = substr($md5_hash, 15, 5);
		$this->Session->write('security_code',$security_code);
		$width = 80;
		$height = 22;
		$image = ImageCreate($width, $height);
		$black = ImageColorAllocate($image, 37, 170, 226);
		$white = ImageColorAllocate($image, 255, 255, 255);
		ImageFill($image, 0, 0, $black);
		ImageString($image, 5, 18, 3, $security_code, $white);
		header("Content-Type: image/jpeg");
		ImageJpeg($image);
		ImageDestroy($image);
	}	
	
	
	function create_image1($random){
		
		$md5_hash = md5(rand(0,999));
		$security_code = substr($md5_hash, 15, 5);
		$this->Session->write('security_code',$security_code);
		$width = 80;
		$height = 22;
		$image = ImageCreate($width, $height);
		$black = ImageColorAllocate($image, 37, 170, 226);
		$white = ImageColorAllocate($image, 255, 255, 255);
		ImageFill($image, 0, 0, $black);
		ImageString($image, 5, 18, 3, $security_code, $white);
		header("Content-Type: image/jpeg");
		ImageJpeg($image);
		ImageDestroy($image);
		
	}
	// ham chuyen doi ky tu
function unicode_convert($str){
		if(!$str) return false;
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
  }
?>
