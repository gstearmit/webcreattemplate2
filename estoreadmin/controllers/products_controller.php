<?php
class ProductsController extends AppController {

	var $name = 'Products';
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
	function index() {
		  $this->account();
		 // $conditions=array('News.status'=>1);
		  $this->paginate = array('limit' => '15','order' => 'Product.id DESC');
	      $this->set('product', $this->paginate('Product',array()));
		  $this->loadModel("Catproduct");
        $this->set('cat', $this->Catproduct->find('all',array('conditions'=>array('Catproduct.status'=>1))));
        $this->set('catcon', $this->Catproduct->find('all',array('conditions'=>array('Catproduct.status'=>1))));
	}
	
	//Them bai viet
	function add() {
		$this->account();
		if (!empty($this->data)) {
			$this->Product->create();
			$data['Product'] = $this->data['Product'];
            $data['Product']['images'] = $_POST['userfile'];
			if ($this->Product->save($data['Product'])) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		}
		$this->loadModel("Catproduct");
        $list_cat = $this->Catproduct->generatetreelist(null,null,null," _ ");
        $this->set(compact('list_cat'));
        $this->loadModel("Manufacturer");
        $list_cat1 = $this->Manufacturer->generatetreelist(null,null,null," _ ");
        $this->set(compact('list_cat1'));
        $gia = array('0'=>'0 đến 1 triệu','1'=>'1 đến 2 triệu','2'=>'2 đến 3 triệu','4'=>'3 đến 4 triệu','5'=>'4 đến 5 triệu','6'=>'5 đến 6 triệu','7'=>'6 đến 7 triệu','8'=>'7 đến 8 triệu','9'=>'8 đến 9 triệu','10'=>'Trên 10 triệu');
        $this->set(compact('gia'));
	}
	//view mot tin 
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Không tồn tại', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('views', $this->Product->read(null, $id));
	}
	//close tin tuc
	function close($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Product'] = $this->data['Product'];
		$data['Product']['status']=0;
		if ($this->Product->save($data['Product'])) {
			$this->Session->setFlash(__('Bài viết không được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không close được', true));
		$this->redirect(array('action' => 'index'));

	}
	
	// active tin bai viêt
	function active($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Không tồn tại bài viết này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Product'] = $this->data['Product'];
		$data['Product']['status']=1;
		if ($this->Product->save($data['Product'])) {
			$this->Session->setFlash(__('Bài viết được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không hiển được bài viết', true));
		$this->redirect(array('action' => 'index'));
	}
	// tim kiem san pham
	/*function search() {
		$data['Product']=$this->data['Product'];
		$category=$data['Product']['catproduct_id'];
		$this->paginate = array('conditions'=>array('Product.catproduct_id'=>$category),'limit' => '15','order' => 'Product.id DESC');
	    $this->set('product', $this->paginate('Product',array()));
		 $this->loadModel("Catproduct");
        $list_cat = $this->Catproduct->generatetreelist(null,null,null," _ ");
        $this->set(compact('list_cat'));
		
	}*/
	function search() {
		$this->loadModel("Catproduct");
	   $keyword="";
	   $list_cat="";
	  
	   if(isset($_POST['keyword']))
		$keyword=$_POST['keyword'];
		
		if(isset($_POST['system']))
        
		$list_cat=$_POST['system'];
        //print_r($list_cat); exit();
		if(($keyword!="")&&($list_cat=="")){
		//['Product.title LIKE']='%'.$keyword.'%';
		$this->paginate = array('conditions'=>array('Product.title LIKE'=>'%'.$keyword.'%'),'limit' => '15','order' => 'Product.id DESC');
	   $this->set('product', $this->paginate('Product',array()));
        }
				
		 if(($keyword=="")&&($list_cat!="")){
		$portfolio=$this->Catproduct->find('list',array('conditions'=>array('Catproduct.parent_id'=>$list_cat),'fields' => array('Catproduct.id')));
        if($portfolio!=null){
		$this->paginate = array('conditions'=>array('Product.catproduct_id'=>$portfolio),'limit' => '15','order' => 'Product.id DESC');
	       $this->set('product', $this->paginate('Product',array()));
           }else{
            $this->paginate = array('conditions'=>array('Product.catproduct_id'=>$list_cat),'limit' => '15','order' => 'Product.id DESC');
	       $this->set('product', $this->paginate('Product',array()));
           }
        }
       if(($keyword!="")&&($list_cat!="")){
		$portfolio=$this->Catproduct->find('list',array('conditions'=>array('Catproduct.parent_id'=>$list_cat),'fields' => array('Catproduct.id')));
        if($portfolio!=null){
		$this->paginate = array('conditions'=>array('Product.title LIKE'=>'%'.$keyword.'%','Product.catproduct_id'=>$portfolio),'limit' => '15','order' => 'Product.id DESC');
	       $this->set('product', $this->paginate('Product',array()));
           }else{
            $this->paginate = array('conditions'=>array('Product.title LIKE'=>'%'.$keyword.'%','Product.catproduct_id'=>$list_cat),'limit' => '15','order' => 'Product.id DESC');
	       $this->set('product', $this->paginate('Product',array()));
           }
        }
         $this->set('cat', $this->Catproduct->find('all',array('conditions'=>array('Catproduct.status'=>1))));
        $this->set('catcon', $this->Catproduct->find('all',array('conditions'=>array('Catproduct.status'=>1))));
	}
	// sua tin da dang
	function edit($id = null) {
		$this->account();
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại ', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$data['Product'] = $this->data['Product'];
            $data['Product']['images'] = $_POST['userfile'];
			if ($this->Product->save($data['Product'])) {
				$this->Session->setFlash(__('Bài viết sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Bài viết này không sửa được vui lòng thử lại.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Product->read(null, $id);
		}
		$this->loadModel("Catproduct");
        $list_cat = $this->Catproduct->generatetreelist(null,null,null," _ ");
        $this->set(compact('list_cat'));
        $this->loadModel("Manufacturer");
        $list_cat1 = $this->Manufacturer->generatetreelist(null,null,null," _ ");
        $this->set(compact('list_cat1'));
		$this->set('edit',$this->Product->findById($id));
        $gia = array('0'=>'0 đến 1 triệu','1'=>'1 đến 2 triệu','2'=>'2 đến 3 triệu','4'=>'3 đến 4 triệu','5'=>'4 đến 5 triệu','6'=>'5 đến 6 triệu','7'=>'6 đến 7 triệu','8'=>'7 đến 8 triệu','9'=>'8 đến 9 triệu','10'=>'Trên 10 triệu');
        $this->set(compact('gia'));
	}
function processing() {
		$this->account();
		if(isset($_POST['dropdown']))
			$select=$_POST['dropdown'];
			
		if(isset($_POST['checkall']))
				{
			
			switch ($select){
				case 'active':
				$product=($this->Product->find('all'));
				foreach($product as $product) {
					$product['Product']['status']=1;
					$this->Product->save($product['Product']);					
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$product=($this->Product->find('all'));
				foreach($product as $product) {
					$product['Product']['status']=0;
					$this->Product->save($product['Product']);					
				}
				break;
				case 'delete':
				$product=($this->Product->find('all'));
				foreach($product as $product) {
					$this->News->delete($product['Product']['id']);					
				}
				if($this->Product->find('count')<1)
				$this->redirect(array('action' => 'index'));
				 else
				 {
					$this->Session->setFlash(__('Danh mục không close được', true));
					$this->redirect(array('action' => 'index'));
				 }
				//vong lap xoa
				break;
				
			}
		}
		else{
			
			switch ($select){
				case 'active':
				$product=($this->Product->find('all'));
				foreach($product as $product) {
					if(isset($_POST[$product['Product']['id']]))
					{
						$product['Product']['status']=1;
						$this->Product->save($product['Product']);						
					}
                    
				}$this->redirect(array('action'=>'index'));
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$product=($this->Product->find('all'));
				foreach($product as $product) {
					if(isset($_POST[$product['Product']['id']]))
					{
						$product['Product']['status']=0;
						$this->Product->save($product['Product']);						
					}
                    
				}$this->redirect(array('action'=>'index'));
				break;
				case 'delete':
				$product=($this->Product->find('all'));
				foreach($product as $product) {
					if(isset($_POST[$product['Product']['id']]))
					{
					    $this->Product->delete($product['Product']['id']);						
					}										
				}
				$this->redirect(array('action'=>'index'));
				
				//vong lap xoa
				break;
				
			}
			
		}
		$this->redirect(array('action' => 'index'));
		
	}
	// Xoa cac dang
	function delete($id = null) {
		$this->account();		
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Product->delete($id)) {
			$this->Session->setFlash(__('Xóa bài viết thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không xóa được', true));
		$this->redirect(array('action' => 'index'));
	}
	function _find_list() {
		return $this->Catproduct->generatetreelist(null, null, null, '__');
	}
	//check ton tai tai khoan
	function account(){
		if(!$this->Session->read("id") || !$this->Session->read("name")){
			$this->redirect('/');
		}
	}
	// chon layout
	function beforeFilter(){
		$this->layout='admin';
	}

}
?>
