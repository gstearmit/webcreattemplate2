<?php
class WeblinksController extends AppController {

	var $name = 'Weblinks';
	var $uses=array('Weblink');
	var $helpers=array('Html','Javascript');
	function index(){
		$this->account();
		$this->paginate=array('order'=>'Weblink.id DESC');
		$this->set('weblinks',$this->paginate('Weblink',array()));
	}
	function add(){
		$this->account();
		if(!empty($this->data)){
			$this->Weblink->create();
			$data['Weblink']=$this->data['Weblink'];
			if($this->Weblink->save($data['Weblink'])){
				$this->Session->setFlash(__('Thêm mới thành công',true));
				$this->redirect(array('action'=>'index'));
			}
			else{
				$this->Session->setFlash(__('Thêm mới thất bại'));
			}
		}
	}
	
	function delete($id = null) {	
		$this->account();	
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Weblink->delete($id)) {
			$this->Session->setFlash(__('Xóa danh mục thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không xóa được', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function edit($id = null) {
		$this->account();
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại danh mục này', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Weblink->save($this->data)) {
				$this->Session->setFlash(__('Sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Sủa không thành công. Vui long thử lại', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Weblink->read(null, $id);
		}
		
	}
	
	
		function _find_list() {
		return $this->Weblink->generatetreelist(null, null, null, '__');
	}
	//check ton tai tai khoan
	function account(){
		if(!$this->Session->read("id") || !$this->Session->read("name")){
			$this->redirect('/');
		}
	}
	function active($id=null) {	
		//$this->account();	
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Weblink'] = $this->data['Weblink'];
		$data['Weblink']['id']=$id;
		$data['Weblink']['status']=1;
		if ($this->Weblink->save($data['Weblink'])) {
			$this->Session->setFlash(__('Danh mục kích hoạt thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không kich hoạt được', true));
		$this->redirect(array('action' => 'index'));

	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Không tồn tại', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('views', $this->Weblink->read(null, $id));
	}
	function close($id=null) {
		///$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Weblink'] = $this->data['Weblink'];
		$data['Weblink']['id']=$id;
		$data['Weblink']['status']=0;		
		if ($this->Weblink->save($data['Weblink'])) {
			$this->Session->setFlash(__('Danh mục không được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không close được', true));
		$this->redirect(array('action' => 'index'));

	}
	function beforeFilter(){
		$this->layout='admin';
	}

}
?>