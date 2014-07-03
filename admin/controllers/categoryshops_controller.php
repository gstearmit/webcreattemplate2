<?php
class CategoryshopsController extends AppController {

	var $name = 'Categoryshops';
	var $uses=array('Categoryshop','Productshop');
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
	function index() {
		  $this->account();
		 // $conditions=array('Categoryshop.status'=>1);
		  $this->paginate = array('limit' => '10','order' => 'Categoryshop.id DESC');
	      $this->set('Categoryshop', $this->paginate('Categoryshop',array()));
	
		
		
		  
	}
	//Them bai viet
	function add() {
		$this->account();
		if (!empty($this->data)) {
			$this->Categoryshop->create();
			$data['Categoryshop'] = $this->data['Categoryshop'];
			$data['Categoryshop']['images']=$_POST['userfile'];
			
			if ($this->Categoryshop->save($data['Categoryshop'])) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		}
		
	}
	//view mot tin 
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Không tồn tại', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('views', $this->Categoryshop->read(null, $id));
	}
	
	/*function search() {
		$data['Categoryshop']=$this->data['Categoryshop'];
		$CategorynewsCategoryshop=$data['Categoryshop']['CategorynewsCategoryshop_id'];
		$this->paginate = array('conditions'=>array('Categoryshop.CategorynewsCategoryshop_id'=>$CategorynewsCategoryshop),'limit' => '15','order' => 'Categoryshop.id DESC');
	    $this->set('Categoryshop', $this->paginate('Categoryshop',array()));
		
	}
	*/
function search() {
		$this->loadModel("CategorynewsCategoryshop");
	   $keyword="";
	   $list_cat="";
	  
	   if(isset($_POST['keyword']))
		$keyword=$_POST['keyword'];
		
		if(isset($this->data['Categoryshop']['list_cat']))
		$list_cat=$this->data['Categoryshop']['list_cat'];
		$x=array();
		if($keyword!="")
		$x['Categoryshop.title like']='%'.$keyword.'%';
		
		
		
		
		$a['Categoryshop.CategorynewsCategoryshop_id']=$list_cat;
		//pr($x);exit;
		$tt =array();
		$portfolio=$this->CategorynewsCategoryshop->find('all',array('conditions'=>array('CategorynewsCategoryshop.parent_id'=>$a,'CategorynewsCategoryshop.status'=>1)));
		//pr($portfolio);exit;
		foreach($portfolio as $key){
			$tt[]=$key['CategorynewsCategoryshop']['id'];
		}
		//pr($tt);exit;
		$x['Categoryshop.CategorynewsCategoryshop_id'][]=$list_cat;
		foreach($tt as $tt){
			$x['Categoryshop.CategorynewsCategoryshop_id'][]=$tt;
		}
		
		
		
		
		

 		
		//
	    //$this->set('products', $this->paginate('Product',array()));	
		//pr($x);
		$this->paginate = array('conditions'=>$x,'limit' => '12','order' => 'Categoryshop.id DESC');
		$this->set('Categoryshop', $this->paginate('Categoryshop',array()));	
		//$ketquatimkiem=$this->Product->find('all',array('conditions'=>$x,'order' => 'Product.id DESC','limit'=>3));	
		//pr($ketquatimkiem); die;
		//$this->set('products',$CategorynewsCategoryshop);
		 $this->loadModel("CategorynewsCategoryshop");
        $list_cat = $this->CategorynewsCategoryshop->generatetreelist(null,null,null," _ ");
        $this->set(compact('list_cat'));
		
	}
	
	
	
	function processing() {
		$this->account();
		if(isset($_POST['dropdown']))
			$select=$_POST['dropdown'];
			
		if(isset($_POST['checkall']))
				{
			
			switch ($select){
				case 'active':
				$Categoryshop=($this->Categoryshop->find('all'));
				foreach($Categoryshop as $new) {
					$new['Categoryshop']['status']=1;
					$this->Categoryshop->save($new['Categoryshop']);					
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Categoryshop=($this->Categoryshop->find('all'));
				foreach($Categoryshop as $new) {
					$new['Categoryshop']['status']=0;
					$this->Categoryshop->save($new['Categoryshop']);					
				}
				break;
				case 'delete':
				$Categoryshop=($this->Categoryshop->find('all'));
				foreach($Categoryshop as $new) {
					$this->Categoryshop->delete($new['Categoryshop']['id']);					
				}
				if($this->Categoryshop->find('count')<1)
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
				$Categoryshop=($this->Categoryshop->find('all'));
				foreach($Categoryshop as $new) {
					if(isset($_POST[$new['Categoryshop']['id']]))
					{
						$new['Categoryshop']['status']=1;
						$this->Categoryshop->save($new['Categoryshop']);
					}
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Categoryshop=($this->Categoryshop->find('all'));
				foreach($Categoryshop as $new) {
					if(isset($_POST[$new['Categoryshop']['id']]))
					{
						$new['Categoryshop']['status']=0;
						$this->Categoryshop->save($new['Categoryshop']);
					}
				}
				break;
				case 'delete':
				$Categoryshop=($this->Categoryshop->find('all'));
				foreach($Categoryshop as $new) {
					if(isset($_POST[$new['Categoryshop']['id']]))
					{
					    $this->Categoryshop->delete($new['Categoryshop']['id']);
						
					}
										
				}
				$this->redirect(array('action'=>'index'));
				die;	
				//vong lap xoa
				break;
				
			}
			
		}
		$this->redirect(array('action' => 'index'));
		
	}
	
		//dong danh muc
	function close($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Categoryshop'] = $this->data['Categoryshop'];
		$data['Categoryshop']['id']=$id;
		$data['Categoryshop']['status']=0;		
		if ($this->Categoryshop->save($data['Categoryshop'])) {
			$this->Session->setFlash(__('Danh mục không được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không close được', true));
		$this->redirect(array('action' => 'index'));

	}
	// kich hoat
	function active($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Categoryshop'] = $this->data['Categoryshop'];
		$data['Categoryshop']['id']=$id;
		$data['Categoryshop']['status']=1;
		if ($this->Categoryshop->save($data['Categoryshop'])) {
			$this->Session->setFlash(__('Danh mục kích hoạt thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không kich hoạt được', true));
		$this->redirect(array('action' => 'index'));

	}

	// sua tin da dang
	function edit($id = null) {
		$this->account();
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại ', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$data['Categoryshop'] = $this->data['Categoryshop'];
			
			
			if ($this->Categoryshop->save($data['Categoryshop'])) {
				$this->Session->setFlash(__('Bài viết sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Bài viết này không sửa được vui lòng thử lại.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Categoryshop->read(null, $id);
		}
		
		$this->set('edit',$this->Categoryshop->findById($id));
	}
	// Xoa cac dang
	function delete($id = null) {
		$this->account();		
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Categoryshop->delete($id)) {
			$this->Session->setFlash(__('Xóa bài viết thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không xóa được', true));
		$this->redirect(array('action' => 'index'));
	}
	function _find_list() {
		return $this->CategorynewsCategoryshop->generatetreelist(null, null, null, '__');
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
	
	function get_userscms($id=null){
	
	return $this->Userscms->find('all',array('conditions'=>array('Userscms.id'=>$id),'limit'=>1));
	}
	

}
?>
