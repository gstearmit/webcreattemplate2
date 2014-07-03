<?php
class ListproductsController extends AppController {
	var $name = 'Listproducts';
	var $uses=array('Product','Category','Category2','Helps');
	var $helpers = array('Session','Html','Form'); 
	var $components = array('Email');
	function index($id) {
		$this->set('title-for-layout','Sản Phẩm - Thành Trung');
		$this->paginate = array('conditions'=>array('Product.status'=>1,'Product.category_id'=>$id),'limit' => '15','order' => 'Product.id DESC');//limit =2 này thể hiện chỗ xem tất cả của 1 danh mục
	    $this->set('products', $this->paginate('Product',array()));
		 $detailproduct=$this->Product->findById($id);
		 $this->set('views',$detailproduct);
		 $this->set('nameparent',$this->Category->find('all',array('conditions'=>array('Category.id'=>$id))));
	}	
	function view($id=null) {
	$detailproduct=$this->Product->findById($id);
	 $this->set('views',$detailproduct);
	 $this->set('nameparent',$this->Category->findById($detailproduct['Product']['category_id']));
	}
	function index_product() {
		$this->set('title-for-layout','Sản Phẩm - Thành Trung');
		$this->paginate = array('conditions'=>array('Product.status'=>1),'limit' => '15','order' => 'Product.id DESC');
		$this->set('products', $this->paginate('Product',array()));		
	}
function addshoping($id=null) {
/*	$product=$this->Product->read(null,$id);		
		if(isset($_SESSION['giohang'])){
			$giohang= (array)$_SESSION['giohang'];
		}
		else 
		   {	
		   $_SESSION['giohang']=array();
			$giohang= (array)$_SESSION['giohang'];
		   }			   	  
			$count=count($giohang);
			$giohang[$count]['id']=$product['Product']['id'];
			$giohang[$count]['sl']=1;	
			$count=count($giohang);		
			$_SESSION['giohang']=$giohang;	
			$_SESSION['count']=$count;
			$str='<script language="javascript"> alert("Them hang thanh cong");
			window.location.href="'.DOMAIN.'"; </script>';
			echo $str;	
*/
	/////////////////////
	$product=$this->Product->read(null,$id);	
	/*
	Neu co ma san pham
	 $shopingcart[$id]['name']=$product['Product']['title'];	
	 */
	 	
	 if(isset($_SESSION['giohang']))	 
	 {   $giohang=$_SESSION['giohang'];
		 if(isset($giohang[$id]))
		 {
			 echo '<script language="javascript"> if(!confirm("Da co san pham nay trong gio hang. Ban co muon tiep tuc mua san pham nay khong ?")) window.back(); </script>';
			 $giohang[$id]['sl']= $giohang[$id]['sl']+1;
			 $giohang[$id]['total']=$giohang[$id]['price']*$giohang[$id]['sl'];			
			 $_SESSION['giohang']=$giohang;			
	echo '<script language="javascript"> alert("San pham nay da duoc tang so luong them 1 chiec"); window.location.replace("'.DOMAIN.'"); </script>'; // co the thay DOMAIN bang url ban muon chay toi
		 }
	 }
	
	$giohang[$id]['name']=$product['Product']['title'];	
	$giohang[$id]['images']=DOMAINAD.$product['Product']['images'];	
	$giohang[$id]['sl']=1;
	$giohang[$id]['price']=$product['Product']['price'];
	$giohang[$id]['total']=$giohang[$id]['price'];
	
	$_SESSION['giohang']=$giohang;
	echo '<script language="javascript"> alert("Them thanh cong"); window.location.replace("'.DOMAIN.'"); </script>';	
	}
	function updateshoping2($id=null) {	 
			mysql_query("SET NAMES 'utf8'");
			mysql_query("SET character_set_client=utf8");
			mysql_query("SET character_set_connection=utf8"); 
			$sl=$_POST['sl'];			
			if(isset($_SESSION['giohang']))
			{$giohang=(array)$_SESSION['giohang'];
			$count=count($giohang);
			for($i=0;$i<$count;$i++)
			 if($giohang[$i]['id']==$id)
			  {  
				$giohang[$i]['id']=$id;
				$giohang[$i]['sl']=$sl;
			}
			$_SESSION['giohang']=$giohang; }
			 
		 	 $str='<script language="javascript"> alert("Sửa thành công");			 
			 window.location.href="'.DOMAIN.'listproducts/viewshoping'.'"; </script>';
			echo $str;						
	}
	function updateshoping($id){
		$this->set('id',$id);
		$product=$this->Product->read(null,$id);
		$this->set('name',$product['Product']['title']);
		}
	function removeshoping($id=null) {
			if(isset($id)){
			$product=$this->Product->read(null,$id);
			$giohang= (array)$_SESSION['giohang'];
			$count=count($giohang);
			 for($i=0;$i<$count;$i++)
			 if($giohang[$i]['id']==$id)
			  { if($i!=$count-1)				  
				   for($j=$i;$j<$count-1;$j++)
					{ 
						$giohang[$j]['id']=$giohang[$j+1]['id'];
						$giohang[$j]['sl']=$giohang[$j+1]['sl'];						
					}					
					 	unset($giohang[$count-1]);	
					  $_SESSION['giohang']=$giohang;		
					  $str='<script language="javascript"> alert("Xóa thành công");
				     window.location.href="'.DOMAIN.'"; </script>';
			    	echo $str;
					 }
			}
	}
	function viewshoping() {
	}
	function check_out() {
	}

function send()
 {      mysql_query("SET NAMES 'utf8'");
		mysql_query("SET character_set_client=utf8");
		mysql_query("SET character_set_connection=utf8");
		$x=$this->Helps->read(null,1);
		if(isset($_POST['name']))
			{
				$name=$_POST['name']; 
				
				$mobile=$_POST['phone'];
				$email=$_POST['email'];
				//$title=$_POST['title'];*/
				$content=$_POST['content'];
				
				$this->Email->from = $name.'<'.$email.'>';
				$this->Email->to = $x['Helps']['mail']; 
				//$this->Email->subject = $title;
				$this->Email->template = 'default';
				$this->Email->sendAs = 'both';
				$this->set('name',$name);
				$this->set('mobile',$mobile);
				$this->set('email',$email);
				$this->set('content',$content);		
				if($this->Email->send())
					{
						$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
						  echo '<script language="javascript"> alert("Gửi đơn hàng thành công"); location.href="'.DOMAIN.'";</script>';
					}
					else  
					   $this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
						  echo '<script language="javascript"> alert("Gửi đơn hàng không thành công"); location.href="'.DOMAIN.'";</script>';
			}
	
	

}

}
?>

