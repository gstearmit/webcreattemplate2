<?php
session_start();
class ListproductController extends AppController{
	var $name='Listproduct';
	var $uses=array('Catproduct','Product','Shop','Productshop');
	
	function index()
	{	
	                                                                   // 'Product.conlai > 0' : so luong khuyen mai cua 1 san pham  > 0
		
		$this->paginate = array('conditions'=>array('Product.status'=>1,'Product.conlai > 0'),'limit' => '32','order' => 'Product.title DESC');
		$this->set('prod', $this->paginate('Product',array()));
		
	
	}
	
	
	function dulich()
	{
		$this->Session->write('link',$_GET['url']);
	
		$this->paginate = array('conditions'=>array('Product.catproduct_id'=>81, 'Product.status'=>1),'limit' => '24','order' => 'Product.title DESC');
		$this->set('prod', $this->paginate('Product',array()));
	
	
	}
	
	
	function tieudung()
	{
		$this->Session->write('link',$_GET['url']);
	
		$this->paginate = array('conditions'=>array('Product.catproduct_id'=>82, 'Product.status'=>1),'limit' => '24','order' => 'Product.title DESC');
		$this->set('prod', $this->paginate('Product',array()));
	
	
	}
	
	
	
	function search($search_product=null){
	
		$search_product = isset($_POST['search_product'])?$_POST['search_product']:'';
	
		$this->paginate = array('conditions'=>array('Catproduct.status'=>1,'Catproduct.name like'=>'%'.$search_product.'%'),'limit'=>12);
		$this->set('prod', $this->paginate('Catproduct',array()));
		$this->set('txt',$search_product);
		$this->set('result', $this->Product->getNumRows());
	
	}
	
	
	
	function dsda(){
	
		$this->paginate = array('conditions'=>array('Catproduct.status'=>1),'limit'=>12);
		$this->set('prod', $this->paginate('Catproduct',array()));
	
	
	}
	
	function search_eg($search_product=null){
	
		$search_product = isset($_POST['search_product'])?$_POST['search_product']:'';
	
		$this->paginate = array('conditions'=>array('Catproduct.status'=>1,'Catproduct.name_eg like'=>'%'.$search_product.'%'),'limit'=>12);
		$this->set('prod', $this->paginate('Catproduct',array()));
		$this->set('txt',$search_product);
		$this->set('result', $this->Product->getNumRows());
		$this->render('search');
	}
	
	

	function spgh()
    { // spgh: san pham gian hang
	    $id=$this->Shop->find('list',array('fields'=>array('id'),'conditions'=>array('Shop.loai'=>1),'order'=>'Shop.created DESC'));
    	$this->paginate = array('conditions'=>array('Productshop.shop_id'=>$id),'limit'=>48,'order'=>'Productshop.created');
		$this->set('prod', $this->paginate('Productshop',array()));
	}
	
	function getnameproduct($id=null){
		$a=array();
		$i=0;
		$lap=$id;
		return $this->Catproduct->find('all',array('conditions'=>array('Catproduct.id'=>$id)));
	/* 	echo '<pre>';
		print_r($row);
		die(); */
// 		while($lap!=null)
// 		{
// 			$row=$this->Catproduct->find('all',array('conditions'=>array('Catproduct.id'=>$id)));
// 			$a[$i++]['nam']=$row['Catproduct']['name'];
// 			$lap=$row['Catproduct']['parent_id'];
// 		}
		
// 		return $a;
	
	
}

}