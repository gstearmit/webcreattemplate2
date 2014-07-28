<?php
class InfomationsController extends AppController {

	var $name = 'Infomations';
	var $uses=array('Infomation','News');
	function index() {
		  $this->account();
		  $this->paginate = array('limit' => '15','order' => 'Infomation.id DESC');
	      $this->set('infomations', $this->paginate('Infomation',array()));

	}
	function delete($id = null) {	
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Infomation->delete($id)) {
			$this->Session->setFlash(__('Xóa danh mục thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không xóa được', true));
		$this->redirect(array('action' => 'index'));
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Không tồn tại', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('views', $this->Infomation->read(null, $id));
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
	function search($name_search=null){
		mysql_query("SET names utf8");
        $name_search=$_POST['name_search'];
		$this->paginate = array('conditions'=>array('Infomation.tenkhachhang like'=>'%'.$name_search.'%'),'order'=>'Infomation.id DESC','limit'=>7);
        
        $this->set('infomations', $this->paginate('Infomation',array()));
        
	}
	function close($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Infomation'] = $this->data['Infomation'];
        $data['Infomation']['id']=$id;
		$data['Infomation']['status']=0;
		if ($this->Infomation->save($data['Infomation'])) {
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
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Infomation'] = $this->data['Infomation'];
        $data['Infomation']['id']=$id;
		$data['Infomation']['status']=1;
		if ($this->Infomation->save($data['Infomation'])) {
			$this->Session->setFlash(__('Bài viết được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không hiển được bài viết', true));
		$this->redirect(array('action' => 'index'));
	}
	// sua tin da dang

}
?>
