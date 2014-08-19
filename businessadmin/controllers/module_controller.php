<?php
class ModuleController extends AppController {

	var $name = 'Module';
	var $uses=array('Module');
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
	//list danh sach cac danh muc
	function index() {	
	   $this->account();
	  // $conditions=array('Module.status'=>1);	
	   $this->paginate = array('limit' => '15','order' => 'Module.id DESC');
	   $this->paginate = array('conditions'=>array(),'limit' => '15','order' => 'Module.id DESC');
	   $this->set('module', $this->paginate('Module',array()));
	   
	   
	}
	//them danh muc moi
	function add() {
		$this->account();
		if (!empty($this->data)) {
			$this->Module->create();
			if ($this->Module->save($this->data)) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		}
	}
	//Sua danh muc
	function edit($id = null) {
		$this->account();
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại danh mục này', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Module->save($this->data)) {
				$this->Session->setFlash(__('Sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Sủa không thành công. Vui long thử lại', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Module->read(null, $id);
		}
	}
	//dong danh muc
	function close($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Module'] = $this->data['Module'];
		$data['Module']['id']=$id;
		$data['Module']['status']=0;		
		if ($this->Module->save($data['Module'])) {
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
		$data['Module'] = $this->data['Module'];
		$data['Module']['id']=$id;
		$data['Module']['status']=1;
		if ($this->Module->save($data['Module'])) {
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
		if ($this->Module->delete($id)) {
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
				$Module=($this->Module->find('all'));
				foreach($Module as $Module) {
					$Module['Module']['status']=1;
					$this->Module->save($Module['Module']);					
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Module=($this->Module->find('all'));
				foreach($Module as $Module) {
					$Module['Module']['status']=0;
					$this->Module->save($Module['Module']);					
				}
				break;
				case 'delete':
				$Module=($this->Module->find('all'));
				foreach($Module as $Module) {
					$this->News->delete($Module['Module']['id']);					
				}
				if($this->Module->find('count')<1)
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
				$Module=($this->Module->find('all'));
				foreach($Module as $Module) {
					if(isset($_POST[$Module['Module']['id']]))
					{
						$Module['Module']['status']=1;
						$this->Module->save($Module['Module']);
						$this->redirect(array('action'=>'index'));
					}
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Module=($this->Module->find('all'));
				foreach($Module as $Module) {
					if(isset($_POST[$Module['Module']['id']]))
					{
						$Module['Module']['status']=0;
						$this->Module->save($Module['Module']);
						$this->redirect(array('action'=>'index'));
					}
				}
				break;
				case 'delete':
				$Module=($this->Module->find('all'));
				foreach($Module as $Module) {
					if(isset($_POST[$Module['Module']['id']]))
					{
					    $this->Module->delete($Module['Module']['id']);
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
