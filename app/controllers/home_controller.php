<?php
session_start();
class HomeController extends AppController {

	var $name = 'Home';
	var $uses=array('News','Product','Slideshows','Guest');

	
	
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
	  pr($_POST);
	  die;
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