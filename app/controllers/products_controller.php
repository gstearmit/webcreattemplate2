<?php
class ProductsController extends AppController {
	var $name = 'Products';
	var $uses=array('Product','Catproduct','Comment','Setting','Softwareproduct','Order','Hinhthucthanhtoan'); // bien Products su dung bang Catproduct ( danh muc cha san pham)
	var $helpers = array('Html','Ajax','Javascript');
    
	function index() {
		$this->paginate = array('conditions'=>array('Product.status'=>1),'limit' => '12','order' => 'Product.order ASC');
	    $this->set('listproduct', $this->paginate('Product',array()));
	}
    
    // hien thi menu - danh muc cac mon
	function listproduct($id=null) {  // danh muc menu 
        if($id==null){
            
            $a=array();
            $catproduct[0]['catproducts']['name']='Danh sách sản phẩm';
            $this->paginate=array('conditions'=>array('Product.status'=>1),'limit'=>15,);
        }else {
            $catproduct=$this->Catproduct->find('all', array('conditions'=>array('Catproduct.id'=>$id,'Catproduct.status'=>1)));
            //pr($catproduct); die;
            $this->paginate=array('conditions'=>array('Product.status'=>1,'Product.catproduct_id'=>$id),'limit'=>15,);
        }
        /*get list product*/
        $this->set('catproduct',$catproduct);/*get tên của loại hàng*/
        $this->set('product',$this->paginate('Product',array()));
	}


// hien thi menu cuon sach menu
 function cuonmenu($id=null) {  
        
	}
 function  cuonsachmenu($id=null) {  
        // chi có file text thoi
	}

    function newproduct(){
        /*get list newproduct*/
        $this->paginate=array('conditions'=>array('Product.status'=>1,'Product.newsproduct'=>1));
        $this->set('product',$this->paginate('Product',array()));

    }
    function khuyenmai(){
        /*get list newproduct*/
        $this->paginate=array('conditions'=>array('Product.status'=>1,'Product.saleoff'=>1));
        $this->set('product',$this->paginate('Product',array()));
    }

	function search($search_product=null){

	$search_product = $_POST['search_product'];		
	$this->paginate = array('conditions'=>array('Product.status'=>1,'Product.title like'=>'%'.$search_product.'%'),'limit'=>9);		
    $this->set('listproduct', $this->paginate('Product',array()));
	}

	function view($id=null) {
		if (!$id) {
			$this->Session->setFlash(__('Không tồn tại', true));
			$this->redirect(array('action' => 'index'));
		}
        //lấy thông tin sản phẩm theo id
        $x=$this->Product->read(null, $id);

        //set sản phẩm ra view
        $this->set('views',$x);

       //lấy thông tin sản phẩm cùng loại
        $cungloai = $this->Product->find('all',array('conditions'=>array('Product.catproduct_id'=>$x['Product']['catproduct_id'])));
        //set sản phẩm ra view
        $this->set('cungloai',$cungloai);
	}
	
   function addshopingcart($id=null){	}
      
	function viewshopingcart(){
		if(isset($_SESSION['shopingcart']))
		 {   
			 $shopingcart=$_SESSION['shopingcart'];
			 $this->set(compact('shopingcart'));
		 }
		 else
		 {
			 echo '<script language="javascript"> alert("Chua co san pham nao trong gio hang"); window.location.replace("'.DOMAIN.'"); </script>';
		 }
	}
	function deleteshopingcart($id=null){
		if(isset($_SESSION['shopingcart'])){
			 $shopingcart=$_SESSION['shopingcart'];			 
			  if(isset($shopingcart[$id]))
			  unset($shopingcart[$id]);
			  $_SESSION['shopingcart']=$shopingcart;
			  $this->redirect('viewshopingcart');
		 }
		
	}
	function updateshopingcart($id=null){
		
		if(isset($_SESSION['shopingcart']))
		 {   
			 $shopingcart=$_SESSION['shopingcart'];			 
			  if(isset($shopingcart[$id]))
			  {
				  $shopingcart[$id]['sl']=$_POST['soluong'];
				  $shopingcart[$id]['total']=$shopingcart[$id]['sl']*$shopingcart[$id]['price'];
			  }
			  $_SESSION['shopingcart']=$shopingcart;
			 
			  $this->redirect('viewshopingcart');
		 }
	}
	function buy(){

	}


    /*báo giá*/
    function baogia(){

    }

    function camon(){
       // chỗ này chỉ có text mà thôi. hhee
    }

    function phanmem(){
        if(!empty($_POST)){
            $this->Order->save($_POST);
            $this->redirect('camon');
        }else{
            $software=$this->Softwareproduct->find('all',array('fields'=>array('Softwareproduct.id','Softwareproduct.name')));
            $this->set('software',$software);
        }
    }

    function phancung(){
        if(!empty($_POST)){
            pr($_POST);die;
        }
/*
        //lấy gốc catproduct
        $parrenListProduct = $this->Catproduct->find('all',array('fields'=>array('Catproduct.id','Catproduct.name'),'conditions'=>array('Catproduct.status'=>1,'Catproduct.parent_id '=>null)));
        $this->set('parrenCatproduct',$parrenListProduct);


        /*lấy danh sách catproduct* /
        $listProduct = $this->Catproduct->find('list',array('fields'=>array('id','name'),'conditions'=>array('Catproduct.status'=>1,'Catproduct.parent_id '=>$parrenListProduct[0]['Catproduct']['id'])));
        $this->set('catproduct',$listProduct);

        //lấy product
        $mang = array();
        foreach($listProduct as $key=>$value){
            $mang[$key] = $this->Product->find('list',array('fields'=>array('Product.id','Product.title','Product.price_new'),'conditions'=>array('Product.status'=>1,'Product.catproduct_id'=>$key),'order'=>'Product.order asc'));
        }
        $this->set('product',$mang);*/

        /*lấy danh sách catproduct*/
        $listProduct = $this->Catproduct->find('list',array('fields'=>array('id','name'),'conditions'=>array('Catproduct.status'=>1)));
        $this->set('catproduct',$listProduct);

        //lấy product
        $mang = array();
        foreach($listProduct as $key=>$value){
            $mang[$key] = $this->Product->find('all',array('fields'=>array('Product.id','Product.title','Product.price_new'),'conditions'=>array('Product.status'=>1,'Product.catproduct_id'=>$key),'order'=>'Product.order asc'));
        }

        //pr($mang);die;
        $this->set('product',$mang);
    }

    function ajaxPhanCungCat(){
        /*lấy danh sách catproduct*/
        $sql='SELECT id,name FROM catproducts WHERE STATUS =1 AND parent_id ='.$_POST['id'];
        $listProduct = $this->Catproduct->query($sql);
        $mang = array();
        foreach($listProduct as $key=>$value){
            $sql = 'select id,title,price_new from products where status = 1 and catproduct_id = '.$value['catproducts']['id'];
            $mang[$key] = $this->Product->query($sql);
        }

        echo json_encode($mang);
        die;
    }

    function ajaxPhanCungParren(){
        /*lấy danh sách catproduct*/
        $sql = 'select id, name from catproducts where parent_id = '.$_POST['id'].' and status = 1';
        $listProduct = $this->Catproduct->query($sql);
        echo json_encode($listProduct);
        die;
    }

    /*00------------------------thanh toán-----------------------------*/
    function thanhtoan(){
            $thanhtoan= $this->Hinhthucthanhtoan->find('all',array('condition'=>array('Hinhthucthanhtoan.status'=>1)));
            $this->set('thanhtoan',$thanhtoan);
    }
    function listSoftwere(){
        $this->paginate=array('conditions'=>array('Softwareproduct.status'=>1));
        $this->set('Softwareproduct',$this->paginate('Softwareproduct',array()));
    }

    function viewShofwere($id){
        mysql_query("SET names utf8");
        if (!$id) {
            $this->Session->setFlash(__('Không tồn tại', true));
            $this->redirect(array('action' => 'index'));
        }
        $x=$this->Softwareproduct->read(null, $id);
        $this->set('views',$x);
        $this->set('list_other', $this->Softwareproduct->find('all',array('conditions'=>array('Softwareproduct.status'=>1),'limit'=>10)));

    }
}
?>
