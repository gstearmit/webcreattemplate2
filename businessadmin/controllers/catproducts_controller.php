<?php
class CatproductsController extends AppController {

	var $name = 'Catproducts';	
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
	//list danh sach cac danh muc
	function index() {	
	   $this->account();	 
	   $this->paginate = array('conditions'=>array('Catproduct.status'=>1),'limit' => '15','order' => 'Catproduct.id DESC');
	   $this->set('Catproduct', $this->paginate('Catproduct',array()));
	   
	   $this->paginate = array('conditions'=>array('Catproduct.status'=>0),'limit' => '15','order' => 'Catproduct.id DESC');
	   $this->set('Catproduct1', $this->paginate('Catproduct',array()));
	   
       $list_cat = $this->Catproduct->generatetreelist(null,null,null," _ ");
	   $this->set(compact('list_cat'));
	}
	//tim kiem

	function search($name_search=null){
		mysql_query("SET names utf8");
		$title = $_POST['name_search'];
		$this->paginate = array('conditions'=>array('Catproduct.status'=>1,'Catproduct.name LIKE'=>'%'.$title.'%'),'limit' => '15','order' => 'Catproduct.id DESC');
	   $this->set('listsearch', $this->paginate('Catproduct',array()));
	}
	//them danh muc moi
	function add() {
		$this->account();
		if (!empty($this->data)) {
			$this->Catproduct->create();
			if ($this->Catproduct->save($this->data)) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		}
		$this->loadModel("Catproduct");
        $Catproductlist = $this->Catproduct->generatetreelist(null,null,null," _ ");
        $this->set(compact('Catproductlist'));
	}
	//Sua danh muc
	function edit($id = null) {
		$this->account();
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại danh mục này', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Catproduct->save($this->data)) {
				$this->Session->setFlash(__('Sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Sủa không thành công. Vui long thử lại', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Catproduct->read(null, $id);
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
		$data['Catproduct'] = $this->data['Catproduct'];
		$data['Catproduct']['id']=$id;
		$data['Catproduct']['status']=0;		
		if ($this->Catproduct->save($data['Catproduct'])) {
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
		$data['Catproduct'] = $this->data['Catproduct'];
		$data['Catproduct']['id']=$id;
		$data['Catproduct']['status']=1;
		if ($this->Catproduct->save($data['Catproduct'])) {
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
		if ($this->Catproduct->delete($id)) {
			$this->Session->setFlash(__('Xóa danh mục thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không xóa được', true));
		$this->redirect(array('action' => 'index'));
	}
	//list danh sach cac danh muc
	function _find_list() {
		return $this->Catproduct->generatetreelist(null, null, null, '__');
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
