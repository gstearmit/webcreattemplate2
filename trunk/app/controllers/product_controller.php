<?php
session_start();
class ProductController extends AppController{
	var $name='Product';
	
	var $uses=array('Product','Catproduct','Order','Setting');

	
	function index($id=null)
	{
		//$thisid = $id;
		//$this->Session->write('abctest',$thisid);
        // dua du lieu het ra view/product
		$this->set('product',$this->Product->find('all',array('conditions'=>array('Product.id'=>$id,'Product.status'=>1))));  // viet tat truy van luon
	}
	
	function prarent_product($id=null){ // lay danh muc cha cua san pham
		
		$row=$this->Product->find('all',array('conditions'=>array('Product.id'=>$id)));
		$catproduct_id=$row[0]['Product']['catproduct_id'];
		                                                                                 // => so sanh bằng
		return $this->Product->find('all',array('conditions'=>array('Product.catproduct_id'=>$catproduct_id,'NOT'=>array('Product.id'=>$id))));
		
	}

	
	function search($search_product=null){

		$search_product = isset($_POST['search_product'])?$_POST['search_product']:'';
		
		$this->paginate = array('conditions'=>array('Product.status'=>1,'Product.title like'=>'%'.$search_product.'%'),'limit'=>4);
		$this->set('prod', $this->paginate('Product',array()));
		$this->set('txt',$search_product);
		$this->set('result', $this->Product->getNumRows());
		
	}
	
	
	function search_eg($search_product=null){
		
		$search_product = isset($_POST['search_product'])?$_POST['search_product']:'';
		$this->paginate = array('conditions'=>array('Product.status'=>1,'Product.title_eg like'=>'%'.$search_product.'%'),'limit'=>9);
		$this->set('prod', $this->paginate('Product',array()));
		$this->set('result', $this->Product->getNumRows());
		$this->set('txt',$search_product);
		$this->render('search');
	}
	
	
	function spnb(){  //spnb : hàm cua các sản phảm còn bán
		
		return $this->Product->find('all',array('conditions'=>array('Product.display'=>1),'limit'=>20));
		
	}
	
	
		
	function datmua($id=null)
	{
		//echo $this->Session->read('abctest')."<br>"; 
		//echo $this->Session->read('abcd2')."<br>"; die;
		//print $id."<br>";
		$this->Session->write('link',$_GET['url']);
		$this->Session->write('productid',$id);
		$nameuser=	$this->Session->read('nameuser');

		if($nameuser=='') // hien thi ra 1 cua so va nguoi dùng clik vao đăng nhập thì hiện trang đăng nhập
        echo '<script>alert("Hãy đăng nhập để mua hàng" );window.location="'.DOMAIN.'dang-nhap"; </script>';
	
	
		$this->set('product',$this->Product->find('all',array('conditions'=>array('Product.id'=>$id,'Product.status'=>1))));
	
	}
function xuly()
{			
	// xu li don hang
	$prod=$this->Product->find('all',array('conditions'=>array('Product.id'=>$_POST['product_id'],'Product.status'=>1)));
    //$prod ??? : tim tat ca product co id bang id nhap vao va status = 1
	foreach($prod as $prod){
				$this->Order->create();     // tao 1 don hàng
			
				$data['Order']['hinhthucthanhtoan']=$_POST['hinhthucthanhtoan'];
				$data['Order']['name']=$_POST['name'];
				$data['Order']['nameuser']=$this->Session->read('nameuser');  // nameuser : nguoi dàng da dang ki  roi
				$data['Order']['email']=$_POST['email'];
				$data['Order']['phone']=$_POST['phone'];
				$data['Order']['address']=$_POST['address'];
				$data['Order']['soluong']=$_POST['soluong'];
				$data['Order']['product_id']=$_POST['product_id'];
				$data['Order']['product_title']=$_POST['product_title'];
				$data['Order']['dagiaohang']=0;
				$data['Order']['tongtien']=$_POST['soluong']*$prod['Product']['price'];
				$tien=number_format($data['Order']['tongtien'],0,'.','.');
				
				$this->Session->write('thongtin',$data['Order']);
				
			if ($this->Order->save($data['Order'])) {
		
				echo '<script>alert("Đặt hàng thành công" );window.location="'.DOMAIN.'don-hang"; </script>';
				
				
				//$this->redirect(array('controller'=>'home','action'=>'index'));
			} else {
				$this->Session->setFlash(__('Đặt hàng thất bại', true));
                // theo minh se chuyen huong o day
			}
	
}
	
}

	function get_sp($id=null)
	{
    	return $this->Product->find('all',array('conditions'=>array('Product.id'=>$id,'Product.status'=>1)));
		
	}

// tinh tu day chua xem ki
	
	function datmua3()  
	{
	$nameuser =	$this->Session->read('nameuser');
	
	//$order['email']='';
	//$this->Session->write('thongtin',$order);
	if($nameuser=='') echo '<script>alert("Bạn chưa có đơn hàng hãy nhập email để nhận đơn hàng" );window.location="'.DOMAIN.'dang-nhap"; </script>';
	
	$s=$this->Order->find('all',array('conditions'=>array('Order.nameuser'=>$nameuser)));
	$this->set('result',count($s));
	
	
	$this->paginate = array('conditions'=>array('Order.nameuser'=>$nameuser),'limit' => '10','order' => 'Order.id DESC');
		$this->set('order', $this->paginate('Order',array()));
	
	}
	
	
	
	function delete($id = null) {
		
		
		if ($this->Order->delete($id)) {
	
			$this->redirect(array('controller'=>'product','action' => 'datmua3'));
		echo '<script>alert("Xóa đơn hàng thành công" );window.location="'.DOMAIN.'don-hang"; </script>';
		}
		else{
		
		echo '<script>window.location="'.DOMAIN.'don-hang; </script>';
	}
	}
		
	
	
	
}


