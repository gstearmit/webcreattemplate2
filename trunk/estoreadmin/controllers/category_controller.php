<?php
class CategoryController extends AppController {

	var $name = 'Category';
	var $uses=array('Category','Shop');
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
	   $this->loadModelNew('Category');
	  // $conditions=array('Category.status'=>1);	
	   $this->paginate = array('limit' => '15','order' => 'Category.id DESC');
	   $this->paginate = array('conditions'=>array('Category.status'=>1),'limit' => '15','order' => 'Category.id DESC');
	   $this->set('category', $this->paginate('Category',array()));
	   
	   // thung rac
	   $this->paginate = array('limit' => '15','order' => 'Category.id DESC');
	   $this->paginate = array('conditions'=>array('Category.status'=>0),'limit' => '15','order' => 'Category.id DESC');
	   $this->set('category1', $this->paginate('Category',array()));
	   
	   $this->loadModel("Category");
       $list_cat = $this->Category->generatetreelist(null,null,null," _ ");
	   $this->set(compact('list_cat'));
	   //NGÔN NGỮ
	   $urlTmp = $_SERVER['REQUEST_URI'];
	    
	   if (stripos($urlTmp, "?language"))
	   {
	   	$urlTmp = explode ( "?", $urlTmp );
	   	$lang = explode ( "=", $urlTmp [1] );
	   	$lang = $lang [1];
	   
	   	if (isset ( $lang )) {
	   		//$this->Session->write ( 'language', $lang );
	   		Configure::write('Config.language', $lang);
	   	} else {
	   		$this->Session->delete ( 'language' );
	   	}
	   } else {
	   
	   	$lang = "vie"; // default
	   	//$this->Session->write ( 'language', $lang );
	   	Configure::write('Config.language', $lang);
	   }
	   
	   // +++++ check Langue
	   $langue = $this->Session->read ( 'language' );
	    
	   if ($langue == null) {
	   	$urlTmp = $_SERVER ['REQUEST_URI'];
	   	if (stripos ( $urlTmp, "?language" )) {
	   		$urlTmp = explode ( "?", $urlTmp );
	   		$lang = explode ( "=", $urlTmp [1] );
	   		$lang = $lang [1];
	   		if (isset ( $lang )) {
	   			//$this->Session->write ( 'language', $lang );
	   			Configure::write('Config.language', $lang);
	   		} else {
	   			$this->Session->delete ( 'language' );
	   		}
	   	} else {
	   		$lang = "vie"; // default
	   		//$this->Session->write ( 'language', $lang );
	   		Configure::write('Config.language', $lang);
	   	}
	   }
	   $this->set ( 'langue', $langue );
	}
	function search($name_search=null){
		mysql_query("SET names utf8");
		$title = $_POST['name_search'];
		$this->loadModelNew('Category');
		$this->paginate = array('conditions'=>array('Category.status'=>1,'Category.name LIKE'=>'%'.$title.'%'),'limit' => '15','order' => 'Category.id DESC');
	   $this->set('category', $this->paginate('Category',array()));
	}
	//them danh muc moi
	function add() {
		$this->account();    
		$this->loadModelNew('Category');
		if (!empty($this->data)) {
			$this->Category->create();
			$data['Category'] = $this->data['Category'];
            $data['Category']['images'] = $_POST['userfile'];	
			if ($this->Category->save($data['Category']))
            {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		}
		$this->loadModel("Category");
        $categorylist = $this->Category->generatetreelist(null,null,null," _ ");
        $this->set(compact('categorylist'));
	}
	//Sua danh muc
	function edit($id = null) {
		$this->account();
		$this->loadModelNew('Category');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại danh mục này', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$data['Category'] = $this->data['Category'];
            $data['Category']['images'] = $_POST['userfile'];	
			if ($this->Category->save($data['Category'])){
				$this->Session->setFlash(__('Sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Sủa không thành công. Vui long thử lại', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Category->read(null, $id);
		}
		$this->set('list_cat',$this->_find_list());
	}
	//dong danh muc
	function close($id=null) {
		$this->account();
		$this->loadModelNew('Category');
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Category'] = $this->data['Category'];
		$data['Category']['id']=$id;
		$data['Category']['status']=0;		
		if ($this->Category->save($data['Category'])) {
			$this->Session->setFlash(__('Danh mục không được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không close được', true));
		$this->redirect(array('action' => 'index'));

	}
	// kich hoat
	function active($id=null) {
		$this->account();
		$this->loadModelNew('Category');
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Category'] = $this->data['Category'];
		$data['Category']['id']=$id;
		$data['Category']['status']=1;
		if ($this->Category->save($data['Category'])) {
			$this->Session->setFlash(__('Danh mục kích hoạt thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không kich hoạt được', true));
		$this->redirect(array('action' => 'index'));

	}

	//Xoa danh muc
	function delete($id = null) {	
		$this->account();	
		$this->loadModelNew('Category');
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Category->delete($id)) {
			$this->Session->setFlash(__('Xóa danh mục thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không xóa được', true));
		$this->redirect(array('action' => 'index'));
	}
	function processing() {
		$this->account();
		$this->loadModelNew('Category');
		if(isset($_POST['dropdown']))
			$select=$_POST['dropdown'];
			
		if(isset($_POST['checkall']))
				{
			
			switch ($select){
				case 'active':
				$category=($this->Category->find('all'));
				foreach($category as $category) {
					$category['Category']['status']=1;
					$this->Category->save($category['Category']);					
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$category=($this->Category->find('all'));
				foreach($category as $category) {
					$category['Category']['status']=0;
					$this->Category->save($category['Category']);					
				}
				break;
				case 'delete':
				$category=($this->Category->find('all'));
				foreach($category as $category) {
					$this->News->delete($category['Category']['id']);					
				}
				if($this->Category->find('count')<1)
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
				$category=($this->Category->find('all'));
				foreach($category as $category) {
					if(isset($_POST[$category['Category']['id']]))
					{
						$category['Category']['status']=1;
						$this->Category->save($category['Category']);
						$this->redirect(array('action'=>'index'));
					}
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$category=($this->Category->find('all'));
				foreach($category as $category) {
					if(isset($_POST[$category['Category']['id']]))
					{
						$category['Category']['status']=0;
						$this->Category->save($category['Category']);
						$this->redirect(array('action'=>'index'));
					}
				}
				break;
				case 'delete':
				$category=($this->Category->find('all'));
				foreach($category as $category) {
					if(isset($_POST[$category['Category']['id']]))
					{
					    $this->Category->delete($category['Category']['id']);
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
		$this->loadModelNew('Category');
		return $this->Category->generatetreelist(null, null, null, '__');
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
