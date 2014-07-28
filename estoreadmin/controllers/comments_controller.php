<?php
class CommentsController extends AppController {

	var $name = 'Comments';
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
	//list danh sach cac danh muc
	function index() {	
			$this->loadModel("Comments");

	   $this->account();
	  // $conditions=array('Comments.status'=>1);	
	   $this->paginate = array('limit' => '15','order' => 'Comments.id DESC');
	   $this->set('comments', $this->paginate('Comments',array()));
	}
	//them danh muc moi
	function add() {
		$this->account();
		
		if (!empty($this->data)) {
			// tao slug url			
			$cat=$this->Comments->read(null,$this->data['Comments']['parent_id']);
			if($cat)
			$this->data['Comments']['slug']=$cat['Comments']['slug'].'/'.$this->Common->unicode_convert($this->data['Comments']['name']);
			else
			$this->data['Comments']['slug']=$this->Common->unicode_convert($this->data['Comments']['name']);
			
			$this->Comments->create();			
			if ($this->Comments->save($this->data)) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		}
		$this->loadModel("Comments");
        $Commentslist = $this->Comments->generatetreelist(null,null,null," _ ");
        $this->set(compact('Commentslist'));
	}
	//Sua danh muc
	function edit($id = null) {
		$this->loadModel("Comments");
		 $permission=$this->Session->read('permission');
	   if($permission!='admin')
	   echo '<script language="javascript"> alert("Bạn không có quyền sử dụng chức năng nay"); window.history.back(); </script>';
		$this->account();
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại danh mục này', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			
			// tao slug url			
			if ($this->Comments->save($this->data)) {
				$this->Session->setFlash(__('Sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Sủa không thành công. Vui long thử lại', true));
				$this->data = $this->Comments->read(null, $id);
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Comments->read(null, $id);
		}
	}
    	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Không tồn tại', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('views', $this->Comments->read(null, $id));
	}
	//dong danh muc
	function close($id=null) {
		$this->loadModel("Comments");
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Comments'] = $this->data['Comments'];
		$data['Comments']['id']=$id;
		$data['Comments']['status']=0;		
		if ($this->Comments->save($data['Comments'])) {
			$this->Session->setFlash(__('Danh mục không được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không close được', true));
		$this->redirect(array('action' => 'index'));

	}
	// kich hoat
	function active($id=null) {
		$this->loadModel("Comments");
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Comments'] = $this->data['Comments'];
		$data['Comments']['id']=$id;
		$data['Comments']['status']=1;
		if ($this->Comments->save($data['Comments'])) {
			$this->Session->setFlash(__('Danh mục kích hoạt thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không kich hoạt được', true));
		$this->redirect(array('action' => 'index'));

	}

	//Xoa danh muc
	function delete($id = null) {	
	$this->loadModel("Comments");
		$this->account();	
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Comments->delete($id)) {
			$this->Session->setFlash(__('Xóa danh mục thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không xóa được', true));
		$this->redirect(array('action' => 'index'));
	}
	//list danh sach cac danh muc
	function _find_list() {
		return $this->Comments->generatetreelist(null, null, null, '__');
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
	function addmenu(){
		$x=$this->Comments->find('list');
		//pr($x); die;
		$item=array();
		$this->LoadModel('Itemmenusidebar');
		foreach($x as $k=>$v){
			if(isset($_POST[$k])){
				$this->Itemmenusidebar->create();
				$item['name']=$v;
				$item['item_id']=$k;
				$item['type']='Comments';
				$this->Itemmenusidebar->save($item);
			}
		}
		$this->redirect(array('controller'=>'Itemmenusidebars','action'=>'menu'));
		
	}

}
?>
