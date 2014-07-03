<?php
class CategorynewsshopController extends AppController {

	var $name = 'Categorynewsshop';
	var $uses=array('Categorynewsshop');
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
	//list danh sach cac danh muc
	function index() {	
	   $this->account();
	  // $conditions=array('Categorynewsshop.status'=>1);	
	   $this->paginate = array('limit' => '15','order' => 'Categorynewsshop.id DESC');
	   $this->paginate = array('limit' => '15','order' => 'Categorynewsshop.id DESC');
	   $this->set('Categorynewsshop', $this->paginate('Categorynewsshop',array()));
	   
	   // thung rac
	   $this->paginate = array('limit' => '15','order' => 'Categorynewsshop.id DESC');
	   $this->paginate = array('conditions'=>array('Categorynewsshop.status'=>0),'limit' => '15','order' => 'Categorynewsshop.id DESC');
	   $this->set('Categorynewsshop1', $this->paginate('Categorynewsshop',array()));
	   
	   $this->loadModel("Categorynewsshop");
       $list_cat = $this->Categorynewsshop->generatetreelist(null,null,null," _ ");
	   $this->set(compact('list_cat'));
	}
	//tim kiem
	function search($id=null) {
		$data['Categorynewsshop']=$this->data['Categorynewsshop'];
		$Categorynewsshop=$data['Categorynewsshop']['parent_id'];
		$this->paginate = array('conditions'=>array('Categorynewsshop.id'=>$Categorynewsshop),'limit' => '15','order' => 'Categorynewsshop.id DESC');
	    $this->set('Categorynewsshop', $this->paginate('Categorynewsshop',array()));
		
		$this->loadModel("Categorynewsshop");
        $list_cat = $this->Categorynewsshop->generatetreelist(null,null,null," _ ");
	    $this->set(compact('list_cat'));
		
	}
	//them danh muc moi
	function add() {
		$this->account();
		if (!empty($this->data)) {
			$this->Categorynewsshop->create();
			if ($this->Categorynewsshop->save($this->data)) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		}
		$this->loadModel("Categorynewsshop");
        $Categorynewsshoplist = $this->Categorynewsshop->generatetreelist(null,null,null," _ ");
        $this->set(compact('Categorynewsshoplist'));
	}
	//Sua danh muc
	function edit($id = null) {
		$this->account();
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại danh mục này', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Categorynewsshop->save($this->data)) {
				$this->Session->setFlash(__('Sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Sủa không thành công. Vui long thử lại', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Categorynewsshop->read(null, $id);
		}
		$this->set('list_cat',$this->_find_list());
	}
	//dong danh muc
	function close($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Categorynewsshop'] = $this->data['Categorynewsshop'];
		$data['Categorynewsshop']['id']=$id;
		$data['Categorynewsshop']['status']=0;		
		if ($this->Categorynewsshop->save($data['Categorynewsshop'])) {
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
		$data['Categorynewsshop'] = $this->data['Categorynewsshop'];
		$data['Categorynewsshop']['id']=$id;
		$data['Categorynewsshop']['status']=1;
		if ($this->Categorynewsshop->save($data['Categorynewsshop'])) {
			$this->Session->setFlash(__('Danh mục kích hoạt thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không kich hoạt được', true));
		$this->redirect(array('action' => 'index'));

	}

	//Xoa danh muc
	function delete($id = null) {	
		$this->account();	
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Categorynewsshop->delete($id)) {
			$this->Session->setFlash(__('Xóa danh mục thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không xóa được', true));
		$this->redirect(array('action' => 'index'));
	}
	function processing() {
		$this->account();
		if(isset($_POST['dropdown']))
			$select=$_POST['dropdown'];
			
		if(isset($_POST['checkall']))
				{
			
			switch ($select){
				case 'active':
				$Categorynewsshop=$this->Categorynewsshop->find('all');
				foreach($Categorynewsshop as $Categorynewsshop) {
					$Categorynewsshop['Categorynewsshop']['status']=1;
				
					$this->Categorynewsshop->save($Categorynewsshop['Categorynewsshop']);					
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Categorynewsshop=$this->Categorynewsshop->find('all');
				foreach($Categorynewsshop as $Categorynewsshop) {
					$Categorynewsshop['Categorynewsshop']['status']=0;
					$this->Categorynewsshop->save($Categorynewsshop['Categorynewsshop']);					
				}
				break;
				case 'delete':
				$Categorynewsshop=($this->Categorynewsshop->find('all'));
				foreach($Categorynewsshop as $Categorynewsshop) {
					$this->News->delete($Categorynewsshop['Categorynewsshop']['id']);					
				}
				if($this->Categorynewsshop->find('count')<1)
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
				$Categorynewsshop=($this->Categorynewsshop->find('all'));
				foreach($Categorynewsshop as $Categorynewsshop) {
					if(isset($_POST[$Categorynewsshop['Categorynewsshop']['id']]))
					{
						$Categorynewsshop['Categorynewsshop']['status']=1;
						$this->Categorynewsshop->save($Categorynewsshop['Categorynewsshop']);
						$this->redirect(array('action'=>'index'));
					}
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Categorynewsshop=($this->Categorynewsshop->find('all'));
				foreach($Categorynewsshop as $Categorynewsshop) {
					if(isset($_POST[$Categorynewsshop['Categorynewsshop']['id']]))
					{
						$Categorynewsshop['Categorynewsshop']['status']=0;
						$this->Categorynewsshop->save($Categorynewsshop['Categorynewsshop']);
						$this->redirect(array('action'=>'index'));
					}
				}
				break;
				case 'delete':
				$Categorynewsshop=($this->Categorynewsshop->find('all'));
				foreach($Categorynewsshop as $Categorynewsshop) {
					if(isset($_POST[$Categorynewsshop['Categorynewsshop']['id']]))
					{
					    $this->Categorynewsshop->delete($Categorynewsshop['Categorynewsshop']['id']);
						$this->redirect(array('action'=>'index'));
					}
										
				}
				
				die;	
				//vong lap xoa
				break;
				
			}
			
		}
		$this->redirect(array('action' => 'index'));
		
	}
	//list danh sach cac danh muc
	function _find_list() {
		return $this->Categorynewsshop->generatetreelist(null, null, null, '__');
	}
	//check ton tai tai khoan
	function account(){
		if(!$this->Session->read("id") || !$this->Session->read("name")){
			$this->redirect('/');
		}
	}
	function beforeFilter(){
		$this->layout='admin';
	}

}
?>
