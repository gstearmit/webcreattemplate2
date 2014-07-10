<?php
class HomeController extends AppController {

	var $name = 'Home';
	var $uses=array('News','Product','Slideshows','Guest','Shops','Langgues');
	//$this->layout = 'creattemplate';
	var $layout = "creattemplate";
	
	
	//creattemplate
	function index($id=null)
	{
		//echo $this->Session->read('nameuser'); die;
		$id1=$this->Session->read('city');   //
		//read($name): Dùng để lấy giá trị của Session dựa vào tên của nó
	
		if($id==null && $id1!=null) $id=$id1;
		if($id==null && $id1==null) $id=2;
		$this->Session->write('city',$id);	//write($name,$value): Dùng để lưu một giá trị $value vào session đặt tên là $name
	
		// các sản phẩm bán chạy
		// không giới hạn và phân trang theo kiểu silde show
		// mỗi 1 slide hiển thị 4 sản phẩm
		$this->set('product_nb',$this->Product->find('all', array('conditions'=>array('Product.conlai > 0','Product.city_id'=>$id),'order' => 'Product.created DESC')));
	
		// các sản phẩm trên trang chủ
		// hiển thị limit là 24 sản phẩm
		$this->paginate = array('conditions'=>array('Product.status'=>1, 'Product.city_id'=>$id),'limit'=>24,'order' => 'Product.created DESC');
		$this->set('product',$this->paginate('Product',array()));
	}
	
	function businesswebsites()
	{
		
	}
	
	function ecommerce()
	{
	
	}
	
	function personalwebsites()
	{
	
	}
	function signin()
	{
	
	}
	
	//launchyoursite
	function launchyoursite()
	{
	
		// ++langgue
		$this->set('Langgue',$this->Langgues->find('all', array('conditions'=>array('langgues.id > 0'),'order' => 'langgues.id DESC')));

	$this->layout = 'launchyoursite';
	if(isset($_POST['storename']))
	{
		$name=$this->Shops->findAllByName($_POST['storename']);  //echo ($_POST['tengianhang']);die;
		if(count($name)==1){
			echo "<script>alert('".json_encode('Tên gian hàng đã tồn tại!')."');</script>";
			echo "<script>history.back(-1);</script>";
		}else{
			$Store = array ();
			$Store ['name'] = $_POST ['storename'];
			$Store ['slug'] = $this->unicode_convert ( $_POST ['storename'] );
			$Store ['email'] = $_POST ['mail'];
			$Store ['user_id'] = 999; // 999 ma khach hang dang ki
			//$Store ['link'] = '';
			// 			$Store ['business'] ='';
			// 			$Store ['phone'] = '';
			// 			$Store ['address'] = '';
			// 			$Store ['city'] = '';
			// 			$Store ['namecompany'] = '';
			// 			$Store ['mobile'] = $_POST ['mobile'];
			// 			$Store ['fax'] = $_POST ['fax'];
			// 			$Store ['ckshops'] = 1;
			// 			$Store ['status'] = 1;
			// 			// $Store['user_id']=$this->Session->read("id");
			
			//mkdir("/path/to/my/dir", 0700);
			//pr($Store);die;
			 
			//$this->Shops->save($Store);
			
			// ++Start Session Eshop
			$this->Session->write('eshop.storename', $_POST ['storename']);
			$this->Session->write('eshop.email', $_POST ['mail']);
			$this->Session->write('eshop.signup-sent', $_POST ['signup-sent']);
			$this->Session->write('eshop.domain', $_POST ['domain']);
			$this->Session->write('eshop.aa62a6988a6', $_POST ['aa62a6988a6']);
			$eshop_tmp = $this->Session->read('eshop');
			$this->set('title_for_layout', '::Lauch Site');
			//pr($this->Session->read('eshop'));die;
			//$this->set('eshop',$this->Session->read('eshop'));

			
		}
		
	} 
	


	function launchyoursitestep2()
	{
		echo 'launchyoursitestep2';
		pr($_POST);
		die;
	}
	 
	 
	  
	  
	}
	
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
	function index2($id=null)
	{
		//echo $this->Session->read('nameuser'); die;
		$id1=$this->Session->read('city');   //
		//read($name): Dùng để lấy giá trị của Session dựa vào tên của nó
	
		if($id==null && $id1!=null) $id=$id1;
		if($id==null && $id1==null) $id=2;
		$this->Session->write('city',$id);	//write($name,$value): Dùng để lưu một giá trị $value vào session đặt tên là $name
	
		// các sản phẩm bán chạy
		// không giới hạn và phân trang theo kiểu silde show
		// mỗi 1 slide hiển thị 4 sản phẩm
		$this->set('product_nb',$this->Product->find('all', array('conditions'=>array('Product.conlai > 0','Product.city_id'=>$id),'order' => 'Product.created DESC')));
	
		// các sản phẩm trên trang chủ
		// hiển thị limit là 24 sản phẩm
		$this->paginate = array('conditions'=>array('Product.status'=>1, 'Product.city_id'=>$id),'limit'=>24,'order' => 'Product.created DESC');
		$this->set('product',$this->paginate('Product',array()));
	
	}
	
   function kt($email){
		$this->Guest->find('all',array('conditions'=>array('Guest.email'=>$email)));
		if($this->Guest->getNumRows()) return  1;
		else
			return 0;
	
	}
	function register(){
	
		$data['email']=$_POST['txtdk'];
		
		$url=$_POST['url'];
		if($this->kt($data['email'])==0)  // lấy function kt(); trên đó
		{
			$this->Guest->save($data);
			echo '<script>alert("Ðăng ký thành công" ) ;window.location="'.DOMAIN.$url.'"; </script>';
			$this->Session->write('email','true');
		
		}
		else{
			echo '<script>alert("Email này đã được đăng ký" );window.location="'.DOMAIN.$url.'"; </script>';
	
		}
	
	
}
}

?>