<?php
class productsController extends AppController {

	var $name = 'products';    
   
    function hienmenu($catproduct_id=null){
        //truy van du lieu
    	$products = $this->Hienmenu->find('all', array('conditions'=>array('catproduct_id'=>$catproduct_id)));
        pr($products); die;
        
                
        //goi du lieu len view
    	$this->set('hienmenus',$products);
    }    
}
?>