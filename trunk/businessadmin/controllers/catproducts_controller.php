<?php
class CatproductsController extends AppController {

	var $name = 'Catproducts';	
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
	var $uses=array(
			'Eshopdaquycatproduct',
			'Shop',
	             );
	function loadModelNew($Model)
	{
		//++++++++++++connection data +++++++++++++++++
		$nameeshop = $this->Session->read("name");
		$shop_id = $this->Session->read("id");
		$shoparr = $this->Shop->find ( 'all', array (
				'conditions' => array (
						'Shop.id' => $shop_id,
						'Shop.name' => $nameeshop,
						'Shop.status' => 1
				),
				'fields' => array (
						'Shop.id',
						'Shop.created',
						'Shop.databasename',
						'Shop.username',
						'Shop.password',
						'Shop.hostname',
						'Shop.name',
						'Shop.email',
						'Shop.userpass',
						'Shop.ipserver'
				)
		) );
			
		if(is_array($shoparr) and !empty($shoparr))
		{
			foreach($shoparr as $shop){
				$databasename = $shop['Shop']['databasename'];
				$password = $shop['Shop']['password'];
				$username = $shop['Shop']['username'];
				$hostname = $shop['Shop']['hostname'];
				$shop_id = $shop['Shop']['id'];
				$nameproject = $shop['Shop']['name'];           // $nameproject is name Ctronller
				$email = trim($shop['Shop']['email']);
				$userpass = $shop['Shop']['userpass'];
			}
		}
		$this->$Model->setDataEshop($hostname,$username,$password,$databasename);
	}
	function index() {	
	   $this->account();
       $this->loadModelNew('Eshopdaquycatproduct');	   
	   $this->paginate = array('conditions'=>array(),'limit' => '15','order' => 'Eshopdaquycatproduct.id DESC'); //
	   $this->set('Eshopdaquycatproduct', $this->paginate('Eshopdaquycatproduct',array()));
	   //pr($this->paginate('Eshopdaquycatproduct',array()));die;
	   $this->loadModelNew('Eshopdaquycatproduct');	   
       $list_cat = $this->Eshopdaquycatproduct->generatetreelist(null,null,null," _ ");
	   $this->set(compact('list_cat'));
	}
	//tim kiem

	function search($name_search=null){
		mysql_query("SET names utf8");
		$title = $_POST['name_search'];
		 $this->loadModelNew('Eshopdaquycatproduct');	   
		$this->paginate = array('conditions'=>array('Eshopdaquycatproduct.status'=>1,'Eshopdaquycatproduct.name LIKE'=>'%'.$title.'%'),'limit' => '15','order' => 'Eshopdaquycatproduct.id DESC');
	   $this->set('listsearch', $this->paginate('Eshopdaquycatproduct',array()));
	}
	//them danh muc moi
	function add() {
		$this->account();
		 $this->loadModelNew('Eshopdaquycatproduct');
		if (!empty($this->data)) {
			$this->Eshopdaquycatproduct->create();
			if ($this->Eshopdaquycatproduct->save($this->data)) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		}
		 $this->loadModelNew('Eshopdaquycatproduct');
        $Eshopdaquycatproductlist = $this->Eshopdaquycatproduct->generatetreelist(null,null,null," _ ");
        $this->set(compact('Eshopdaquycatproductlist'));
	}
	//Sua danh muc
	function edit($id = null) {
		$this->account();
		$this->loadModelNew('Eshopdaquycatproduct');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại danh mục này', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Eshopdaquycatproduct->save($this->data)) {
				$this->Session->setFlash(__('Sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Sủa không thành công. Vui long thử lại', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Eshopdaquycatproduct->read(null, $id);
		}
		$this->set('list_cat',$this->_find_list());
	}
	//dong danh muc
	function close($id=null) {
		$this->account();
		 $this->loadModelNew('Eshopdaquycatproduct');
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Eshopdaquycatproduct'] = $this->data['Eshopdaquycatproduct'];
		$data['Eshopdaquycatproduct']['id']=$id;
		$data['Eshopdaquycatproduct']['status']=0;		
		if ($this->Eshopdaquycatproduct->save($data['Eshopdaquycatproduct'])) {
			$this->Session->setFlash(__('Danh mục không được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không close được', true));
		$this->redirect(array('action' => 'index'));

	}
	// kich hoat
	function active($id=null) {
		$this->account();
		$this->loadModelNew('Eshopdaquycatproduct');
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Eshopdaquycatproduct'] = $this->data['Eshopdaquycatproduct'];
		$data['Eshopdaquycatproduct']['id']=$id;
		$data['Eshopdaquycatproduct']['status']=1;
		$this->loadModelNew('Eshopdaquycatproduct');
		if ($this->Eshopdaquycatproduct->save($data['Eshopdaquycatproduct'])) {
			$this->Session->setFlash(__('Danh mục kích hoạt thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không kich hoạt được', true));
		$this->redirect(array('action' => 'index'));

	}

	//Xoa danh muc
	function delete($id = null) {	
		$this->account();	
		 $this->loadModelNew('Eshopdaquycatproduct');
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Eshopdaquycatproduct->delete($id)) {
			$this->Session->setFlash(__('Xóa danh mục thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không xóa được', true));
		$this->redirect(array('action' => 'index'));
	}
	//list danh sach cac danh muc
	function _find_list() {
	 $this->loadModelNew('Eshopdaquycatproduct');
		return $this->Eshopdaquycatproduct->generatetreelist(null, null, null, '__');
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