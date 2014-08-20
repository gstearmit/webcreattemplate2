<?php
class CategoryController extends AppController {

	var $name = 'Category';
	var $uses=array(
			'Eshopdaquycategory',
			'Shop',
	             );
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
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
	   $this->loadModelNew('Eshopdaquycategory');	   
	  // $conditions=array('Eshopdaquycategory.status'=>1);	
	   $this->paginate = array('limit' => '15','order' => 'Eshopdaquycategory.id DESC');
	   $this->paginate = array('conditions'=>array('Eshopdaquycategory.status'=>1),'limit' => '15','order' => 'Eshopdaquycategory.id DESC');
	   $this->set('category', $this->paginate('Eshopdaquycategory',array()));
	   
	   // thung rac
	   $this->paginate = array('limit' => '15','order' => 'Eshopdaquycategory.id DESC');
	   $this->paginate = array('conditions'=>array('Eshopdaquycategory.status'=>0),'limit' => '15','order' => 'Eshopdaquycategory.id DESC');
	   $this->set('category1', $this->paginate('Eshopdaquycategory',array()));
	   
	   $this->loadModelNew("Eshopdaquycategory");
       $list_cat = $this->Eshopdaquycategory->generatetreelist(null,null,null," _ ");
	   $this->set(compact('list_cat'));
	}
	//tim kiem
	function search($id=null) {
	    $this->loadModelNew('Eshopdaquycategory');
		$data['Eshopdaquycategory']=$this->data['Eshopdaquycategory'];
		$category=$data['Eshopdaquycategory']['parent_id'];
		$this->paginate = array('conditions'=>array('Eshopdaquycategory.id'=>$category),'limit' => '15','order' => 'Eshopdaquycategory.id DESC');
	    $this->set('category', $this->paginate('Eshopdaquycategory',array()));
		
		$this->loadModelNew("Eshopdaquycategory");
        $list_cat = $this->Eshopdaquycategory->generatetreelist(null,null,null," _ ");
	    $this->set(compact('list_cat'));
		
	}
	//them danh muc moi
	function add() {
		$this->account();
		 $this->loadModelNew('Eshopdaquycategory');
		if (!empty($this->data)) {
			$this->Eshopdaquycategory->create();
			if ($this->Eshopdaquycategory->save($this->data)) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		}
		$this->loadModelNew("Eshopdaquycategory");
        $categorylist = $this->Eshopdaquycategory->generatetreelist(null,null,null," _ ");
        $this->set(compact('categorylist'));
	}
	//Sua danh muc
	function edit($id = null) {
		$this->account();
		 $this->loadModelNew('Eshopdaquycategory');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại danh mục này', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Eshopdaquycategory->save($this->data)) {
				$this->Session->setFlash(__('Sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Sủa không thành công. Vui long thử lại', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Eshopdaquycategory->read(null, $id);
		}
		$this->set('list_cat',$this->_find_list());
	}
	//dong danh muc
	function close($id=null) {
		$this->account();
		$this->loadModelNew('Eshopdaquycategory');
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Eshopdaquycategory'] = $this->data['Eshopdaquycategory'];
		$data['Eshopdaquycategory']['id']=$id;
		$data['Eshopdaquycategory']['status']=0;		
		if ($this->Eshopdaquycategory->save($data['Eshopdaquycategory'])) {
			$this->Session->setFlash(__('Danh mục không được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không close được', true));
		$this->redirect(array('action' => 'index'));

	}
	// kich hoat
	function active($id=null) {
		$this->account();
		 $this->loadModelNew('Eshopdaquycategory');
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Eshopdaquycategory'] = $this->data['Eshopdaquycategory'];
		$data['Eshopdaquycategory']['id']=$id;
		$data['Eshopdaquycategory']['status']=1;
		if ($this->Eshopdaquycategory->save($data['Eshopdaquycategory'])) {
			$this->Session->setFlash(__('Danh mục kích hoạt thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không kich hoạt được', true));
		$this->redirect(array('action' => 'index'));

	}

	//Xoa danh muc
	function delete($id = null) {	
		$this->account();	
		$this->loadModelNew('Eshopdaquycategory');
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Eshopdaquycategory->delete($id)) {
			$this->Session->setFlash(__('Xóa danh mục thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không xóa được', true));
		$this->redirect(array('action' => 'index'));
	}
	function processing() {
		$this->account();
		$this->loadModelNew('Eshopdaquycategory');
		if(isset($_POST['dropdown']))
			$select=$_POST['dropdown'];
			
		if(isset($_POST['checkall']))
				{
			
			switch ($select){
				case 'active':
				$category=($this->Eshopdaquycategory->find('all'));
				foreach($category as $category) {
					$category['Eshopdaquycategory']['status']=1;
					$this->Eshopdaquycategory->save($category['Eshopdaquycategory']);					
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$category=($this->Eshopdaquycategory->find('all'));
				foreach($category as $category) {
					$category['Eshopdaquycategory']['status']=0;
					$this->Eshopdaquycategory->save($category['Eshopdaquycategory']);					
				}
				break;
				case 'delete':
				$category=($this->Eshopdaquycategory->find('all'));
				foreach($category as $category) {
					$this->News->delete($category['Eshopdaquycategory']['id']);					
				}
				if($this->Eshopdaquycategory->find('count')<1)
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
				$category=($this->Eshopdaquycategory->find('all'));
				foreach($category as $category) {
					if(isset($_POST[$category['Eshopdaquycategory']['id']]))
					{
						$category['Eshopdaquycategory']['status']=1;
						$this->Eshopdaquycategory->save($category['Eshopdaquycategory']);
						$this->redirect(array('action'=>'index'));
					}
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$category=($this->Eshopdaquycategory->find('all'));
				foreach($category as $category) {
					if(isset($_POST[$category['Eshopdaquycategory']['id']]))
					{
						$category['Eshopdaquycategory']['status']=0;
						$this->Eshopdaquycategory->save($category['Eshopdaquycategory']);
						$this->redirect(array('action'=>'index'));
					}
				}
				break;
				case 'delete':
				$category=($this->Eshopdaquycategory->find('all'));
				foreach($category as $category) {
					if(isset($_POST[$category['Eshopdaquycategory']['id']]))
					{
					    $this->Eshopdaquycategory->delete($category['Eshopdaquycategory']['id']);
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
	    $this->loadModelNew('Eshopdaquycategory');
		return $this->Eshopdaquycategory->generatetreelist(null, null, null, '__');
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
