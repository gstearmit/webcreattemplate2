<?php
class CatproductsController extends AppController {

	var $name = 'Catproducts';	
	var $uses=array(
			'Catproduct',
			'Shop',
	             );
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
	function loadModelNew()
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
		$this->Catproduct->setDataEshop($hostname,$username,$password,$databasename);
	}
	function index() {	
	   $this->account();
       // $this->Session->read("id") || !$this->Session->read("name")
	   $this->loadModelNew();
	   $this->paginate = array('conditions'=>array(),'limit' => '20','order' => 'Catproduct.id DESC');
	   $this->set('Catproduct', $this->paginate('Catproduct',array()));
	   //pr($this->paginate('Catproduct',array()));die;
       $list_cat = $this->Catproduct->generatetreelist(null,null,null," _ ");
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
	//tim kiem

	function search($name_search=null){
		mysql_query("SET names utf8");
		$title = $_POST['name_search'];
		$this->loadModelNew();
		$this->paginate = array('conditions'=>array('Catproduct.status'=>1,'Catproduct.name LIKE'=>'%'.$title.'%'),'limit' => '15','order' => 'Catproduct.id DESC');
	   $this->set('listsearch', $this->paginate('Catproduct',array()));
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
	//them danh muc moi
	function add() {
		$this->account();
		$this->loadModelNew();
		if (!empty($this->data)) {
			//pr($this->data);die;
			$this->Catproduct->create();
			$data['Catproduct'] = $this->data['Catproduct'];
            $data['Catproduct']['images'] = $_POST['userfile'];	
			if ($this->Catproduct->save($data['Catproduct'])){
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		}
		//$this->loadModel("Catproduct");
		$this->loadModelNew();
        $Catproductlist = $this->Catproduct->generatetreelist(null,null,null," _ ");
        $this->set(compact('Catproductlist'));
        
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
	//Sua danh muc
	function edit($id = null) {
		
		$this->account();
		$this->loadModelNew();
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại danh mục này', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			//pr($this->data['Catproduct']);die;
		     $data['Catproduct'] = $this->data['Catproduct'];
             $data['Catproduct']['images'] = $_POST['userfile'];	
			if ($this->Catproduct->save($data['Catproduct'])){
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
	
	//dong danh muc
	function close($id=null) {
		
		$this->account();
		
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			$this->redirect(array('action'=>'index'));
		}
			
		$this->loadModelNew();
     	$catproduct=($this->Catproduct->find ( 'all', array (
		'conditions' => array (
		'Catproduct.id' => $id,
		))));
		
		//pr($catproduct);die;
		foreach($catproduct as $catproduct) {
			$catproduct['Catproduct']['status']=0;
			$flag = $this->Catproduct->save($catproduct['Catproduct']);
		}
		if ($flag) {
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
		
		$this->loadModelNew();
		$catproduct=($this->Catproduct->find ( 'all', array (
		'conditions' => array (
		'Catproduct.id' => $id,
		))));
		
		//pr($catproduct);die;
		foreach($catproduct as $catproduct) {
			$catproduct['Catproduct']['status']=1;
			$flag = $this->Catproduct->save($catproduct['Catproduct']);
		}
		if ($flag) {
			$this->Session->setFlash(__('Danh mục không được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không close được', true));
		$this->redirect(array('action' => 'index'));

	}
   
	//Xoa danh muc
	function delete($id = null) {	
		
		$this->account();	
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			//$this->redirect(array('action'=>'index'));
		}
		$this->loadModelNew();
		if ($this->Catproduct->delete($id)) {
			$this->Session->setFlash(__('Xóa danh mục thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không xóa được', true));
		$this->redirect(array('action' => 'index'));
	}
	 function processing() {
		$this->account();
		$this->loadModelNew();
		if(isset($_POST['dropdown']))
			$select=$_POST['dropdown'];
			
		if(isset($_POST['checkall']))
				{
			
			switch ($select){
				case 'active':
				$catproduct=($this->Catproduct->find('all'));
				foreach($catproduct as $catproduct) {
					$catproduct['Catproduct']['status']=1;
					$this->Catproduct->save($catproduct['Catproduct']);					
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$catproduct=($this->Catproduct->find('all'));
				foreach($catproduct as $catproduct) {
					$catproduct['Catproduct']['status']=0;
					$this->Catproduct->save($catproduct['Catproduct']);					
				}
				break;
				case 'delete':
				$catproduct=($this->Catproduct->find('all'));
				foreach($catproduct as $catproduct) {
					$this->News->delete($catproduct['Catproduct']['id']);					
				}
				if($this->Catproduct->find('count')<1)
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
				$catproduct=($this->Catproduct->find('all'));
				foreach($catproduct as $catproduct) {
					if(isset($_POST[$catproduct['Catproduct']['id']]))
					{
						$catproduct['Catproduct']['status']=1;
						$this->Catproduct->save($catproduct['Catproduct']);						
					}
                    
				}$this->redirect(array('action'=>'index'));
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$catproduct=($this->Catproduct->find('all'));
				foreach($catproduct as $catproduct) {
					if(isset($_POST[$catproduct['Catproduct']['id']]))
					{
						$catproduct['Catproduct']['status']=0;
						$this->Catproduct->save($catproduct['Catproduct']);						
					}
                    
				}$this->redirect(array('action'=>'index'));
				break;
				case 'delete':
				$catproduct=($this->Catproduct->find('all'));
				foreach($catproduct as $catproduct) {
					if(isset($_POST[$catproduct['Catproduct']['id']]))
					{
					    $this->Catproduct->delete($catproduct['Catproduct']['id']);						
					}										
				}
				$this->redirect(array('action'=>'index'));
				
				//vong lap xoa
				break;
				
			}
			
		}
		$this->redirect(array('action' => 'index'));
		
	}
	//list danh sach cac danh muc
	function _find_list() {
		$this->loadModelNew();
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
