<?php
class ShopsController extends AppController {

	var $name = 'Shops';
	var $uses=array('Shop','Userscms');
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
	function index() {
		  $this->account();
		 // $conditions=array('Shop.status'=>1);
		  $this->paginate = array('limit' => '10','order' => 'Shop.id DESC');
	      $this->set('Shop', $this->paginate('Shop',array()));
	
		
		
		  
	}
	//Them bai viet
	function add() {
		$this->account();
		if (!empty($this->data)) {
			$this->Shop->create();
			$data['Shop'] = $this->data['Shop'];
			$data['Shop']['images']=$_POST['userfile'];
			
			if ($this->Shop->save($data['Shop'])) {
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
		$this->set('views', $this->Shop->read(null, $id));
	}
	
	/*function search() {
		$data['Shop']=$this->data['Shop'];
		$Categorynewsshop=$data['Shop']['Categorynewsshop_id'];
		$this->paginate = array('conditions'=>array('Shop.Categorynewsshop_id'=>$Categorynewsshop),'limit' => '15','order' => 'Shop.id DESC');
	    $this->set('Shop', $this->paginate('Shop',array()));
		
	}
	*/
function search() {
		$this->loadModel("Categorynewsshop");
	   $keyword="";
	   $list_cat="";
	  
	   if(isset($_POST['keyword']))
		$keyword=$_POST['keyword'];
		
		if(isset($this->data['Shop']['list_cat']))
		$list_cat=$this->data['Shop']['list_cat'];
		$x=array();
		if($keyword!="")
		$x['Shop.title like']='%'.$keyword.'%';
		
		
		
		
		$a['Shop.Categorynewsshop_id']=$list_cat;
		//pr($x);exit;
		$tt =array();
		$portfolio=$this->Categorynewsshop->find('all',array('conditions'=>array('Categorynewsshop.parent_id'=>$a,'Categorynewsshop.status'=>1)));
		//pr($portfolio);exit;
		foreach($portfolio as $key){
			$tt[]=$key['Categorynewsshop']['id'];
		}
		//pr($tt);exit;
		$x['Shop.Categorynewsshop_id'][]=$list_cat;
		foreach($tt as $tt){
			$x['Shop.Categorynewsshop_id'][]=$tt;
		}
		
		
		
		
		

 		
		//
	    //$this->set('products', $this->paginate('Product',array()));	
		//pr($x);
		$this->paginate = array('conditions'=>$x,'limit' => '12','order' => 'Shop.id DESC');
		$this->set('Shop', $this->paginate('Shop',array()));	
		//$ketquatimkiem=$this->Product->find('all',array('conditions'=>$x,'order' => 'Product.id DESC','limit'=>3));	
		//pr($ketquatimkiem); die;
		//$this->set('products',$Categorynewsshop);
		 $this->loadModel("Categorynewsshop");
        $list_cat = $this->Categorynewsshop->generatetreelist(null,null,null," _ ");
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
				$Shop=($this->Shop->find('all'));
				foreach($Shop as $new) {
					$new['Shop']['status']=1;
					$this->Shop->save($new['Shop']);					
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Shop=($this->Shop->find('all'));
				foreach($Shop as $new) {
					$new['Shop']['status']=0;
					$this->Shop->save($new['Shop']);					
				}
				break;
				case 'delete':
				$Shop=($this->Shop->find('all'));
				foreach($Shop as $new) {
					$this->Shop->delete($new['Shop']['id']);					
				}
				if($this->Shop->find('count')<1)
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
				$Shop=($this->Shop->find('all'));
				foreach($Shop as $new) {
					if(isset($_POST[$new['Shop']['id']]))
					{
						$new['Shop']['status']=1;
						$this->Shop->save($new['Shop']);
					}
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Shop=($this->Shop->find('all'));
				foreach($Shop as $new) {
					if(isset($_POST[$new['Shop']['id']]))
					{
						$new['Shop']['status']=0;
						$this->Shop->save($new['Shop']);
					}
				}
				break;
				case 'delete':
				$Shop=($this->Shop->find('all'));
				foreach($Shop as $new) {
					if(isset($_POST[$new['Shop']['id']]))
					{
					    $this->Shop->delete($new['Shop']['id']);
						
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
		$data['Shop'] = $this->data['Shop'];
		$data['Shop']['id']=$id;
		$data['Shop']['status']=0;		
		if ($this->Shop->save($data['Shop'])) {
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
		$data['Shop'] = $this->data['Shop'];
		$data['Shop']['id']=$id;
		$data['Shop']['status']=1;
		if ($this->Shop->save($data['Shop'])) {
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
			$data['Shop'] = $this->data['Shop'];
			
			
			if ($this->Shop->save($data['Shop'])) {
				$this->Session->setFlash(__('Bài viết sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Bài viết này không sửa được vui lòng thử lại.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Shop->read(null, $id);
		}
		
		$this->set('edit',$this->Shop->findById($id));
	}
	// Xoa cac dang
	function delete($id = null) {
		$this->account();		
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Shop->delete($id)) {
			$this->Session->setFlash(__('Xóa bài viết thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không xóa được', true));
		$this->redirect(array('action' => 'index'));
	}
	function _find_list() {
		return $this->Categorynewsshop->generatetreelist(null, null, null, '__');
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
