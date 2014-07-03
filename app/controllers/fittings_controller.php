<?php
class FittingsController extends AppController {
	var $name = 'Fittings';
	var $uses =array('Product','Category2');
	function index() {
		$this->set('title_for_layout', 'Phụ kiện - Thành Trung');
		$this->paginate = array('conditions'=>array('Product.status'=>1,'Product.category_id'=>145),'limit' => '12','order' => 'Product.id DESC');
   		$this->set('menshoes', $this->paginate('Product',array()));
	}
	function list_sevice($id=null) {
		$service2=$this->Category2->findById($id);
		$this->set('service2',   $service2);
		$this->set('title_for_layout', 'Phụ kiện- thành Trung');
		$this->paginate = array('conditions'=>array('Category2.status'=>1,'Category2.id'=>$id),'limit' => '12','order' => 'Category2.id DESC');	
		$this->set('services', $this->paginate('Category2',array()));	
	}
	function view($id=null) {
	 $detailproduct=$this->Product->findById($id);
	 $this->set('views',$detailproduct);
	 $this->set('nameparent',$this->Category2->findById($detailproduct['Product']['category_id']));
	}
}
?>

