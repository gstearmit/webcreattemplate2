<?php
class NewshopsController extends AppController {

	var $name = 'Newshops';
	var $uses=array('Newshop','Categorynewsshop','Shop');
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
	function index() {
		  $this->account();
		 // $conditions=array('Newshop.status'=>1);
		  $this->paginate = array('limit' => '10','order' => 'Newshop.id DESC');
	      $this->set('Newshop', $this->paginate('Newshop',array()));
	
		 
        $_list_part=$this->Categorynewsshop->find('list',array('fields' => array('id', 'name')));
		$this->set('list_cat',$_list_part);
        $this->set(compact('list_cat'));
		  
		
		  
	}
	//Them bai viet
	function add() {
		$this->account();
		if (!empty($this->data)) {
			$this->Newshop->create();
			$data['Newshop'] = $this->data['Newshop'];
			$data['Newshop']['images']=$_POST['userfile'];
			
			if ($this->Newshop->save($data['Newshop'])) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		}
		$this->loadModel("Categorynewsshop");
        $list_cat = $this->Categorynewsshop->generatetreelist(null,null,null," _ ");
        $this->set(compact('list_cat'));
	}
	//view mot tin 
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Không tồn tại', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('views', $this->Newshop->read(null, $id));
	}
	
	/*function search() {
		$data['Newshop']=$this->data['Newshop'];
		$Categorynewsshop=$data['Newshop']['Categorynewsshop_id'];
		$this->paginate = array('conditions'=>array('Newshop.Categorynewsshop_id'=>$Categorynewsshop),'limit' => '15','order' => 'Newshop.id DESC');
	    $this->set('Newshop', $this->paginate('Newshop',array()));
		
	}
	*/
function search() {
		$this->loadModel("Categorynewsshop");
	   $keyword="";
	   $list_cat="";
	  
	   if(isset($_POST['keyword']))
		$keyword=$_POST['keyword'];
		
		if(isset($this->data['Newshop']['list_cat']))
		$list_cat=$this->data['Newshop']['list_cat'];
		$x=array();
		if($keyword!="")
		$x['Newshop.title like']='%'.$keyword.'%';
		
		
		
		
		$a['Newshop.Categorynewsshop_id']=$list_cat;
		//pr($x);exit;
		$tt =array();
		$portfolio=$this->Categorynewsshop->find('all',array('conditions'=>array('Categorynewsshop.parent_id'=>$a,'Categorynewsshop.status'=>1)));
		//pr($portfolio);exit;
		foreach($portfolio as $key){
			$tt[]=$key['Categorynewsshop']['id'];
		}
		//pr($tt);exit;
		$x['Newshop.Categorynewsshop_id'][]=$list_cat;
		foreach($tt as $tt){
			$x['Newshop.Categorynewsshop_id'][]=$tt;
		}
		
		
		
		
		

 		
		//
	    //$this->set('products', $this->paginate('Product',array()));	
		//pr($x);
		$this->paginate = array('conditions'=>$x,'limit' => '12','order' => 'Newshop.id DESC');
		$this->set('Newshop', $this->paginate('Newshop',array()));	
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
				$Newshop=($this->Newshop->find('all'));
				foreach($Newshop as $new) {
					$new['Newshop']['status']=1;
					$this->Newshop->save($new['Newshop']);					
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Newshop=($this->Newshop->find('all'));
				foreach($Newshop as $new) {
					$new['Newshop']['status']=0;
					$this->Newshop->save($new['Newshop']);					
				}
				break;
				case 'delete':
				$Newshop=($this->Newshop->find('all'));
				foreach($Newshop as $new) {
					$this->Newshop->delete($new['Newshop']['id']);					
				}
				if($this->Newshop->find('count')<1)
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
				$Newshop=($this->Newshop->find('all'));
				foreach($Newshop as $new) {
					if(isset($_POST[$new['Newshop']['id']]))
					{
						$new['Newshop']['status']=1;
						$this->Newshop->save($new['Newshop']);
					}
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Newshop=($this->Newshop->find('all'));
				foreach($Newshop as $new) {
					if(isset($_POST[$new['Newshop']['id']]))
					{
						$new['Newshop']['status']=0;
						$this->Newshop->save($new['Newshop']);
					}
				}
				break;
				case 'delete':
				$Newshop=($this->Newshop->find('all'));
				foreach($Newshop as $new) {
					if(isset($_POST[$new['Newshop']['id']]))
					{
					    $this->Newshop->delete($new['Newshop']['id']);
						
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
		$data['Newshop'] = $this->data['Newshop'];
		$data['Newshop']['id']=$id;
		$data['Newshop']['status']=0;		
		if ($this->Newshop->save($data['Newshop'])) {
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
		$data['Newshop'] = $this->data['Newshop'];
		$data['Newshop']['id']=$id;
		$data['Newshop']['status']=1;
		if ($this->Newshop->save($data['Newshop'])) {
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
			$data['Newshop'] = $this->data['Newshop'];
			$data['Newshop']['images']=$_POST['userfile'];
			
			if ($this->Newshop->save($data['Newshop'])) {
				$this->Session->setFlash(__('Bài viết sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Bài viết này không sửa được vui lòng thử lại.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Newshop->read(null, $id);
		}
		$this->loadModel("Categorynewsshop");
        $list_cat = $this->Categorynewsshop->generatetreelist(null,null,null," _ ");
        $this->set(compact('list_cat'));
		$this->set('edit',$this->Newshop->findById($id));
	}
	// Xoa cac dang
	function delete($id = null) {
		$this->account();		
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Newshop->delete($id)) {
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
	
	function get_name($id=null){
	
	return $this->Categorynewsshop->find('all',array('conditions'=>array('Categorynewsshop.id'=>$id,'Categorynewsshop.status'=>1),'limit'=>1));
	}
	function get_shop($id=null){
	
	return $this->Shop->find('all',array('conditions'=>array('Shop.user_id'=>$id,'Shop.status'=>1),'limit'=>1));
	}

}
?>
