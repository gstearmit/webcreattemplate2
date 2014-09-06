<?php
class InfomationsController extends AppController {

	var $name = 'Infomations';
	var $uses=array('Infomation','News','Infomationdetail','Shop');
	//var $uses=array('Estore_infomation','Estore_news','Estore_infomationdetails');
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
		  $this->loadModelNew('Infomation');
		  $this->paginate = array('limit' => '15','order' => 'Infomation.id DESC');
	      $this->set('infomations', $this->paginate('Infomation',array()));
	      
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
	function delete($id = null) {	
		$this->loadModelNew('Infomation');
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
		$this->loadModelNew('Infomationdetail');
		$this->set('information',$this->Infomationdetail->find('all',array('conditions'=>array('Infomationdetail.infomations_id'=>$id),'order'=>'Infomationdetail.id ASC')));
		$this->loadModelNew('Infomation');
		$this->set('views', $this->Infomation->read(null, $id));
	}
	//check ton tai tai khoan
	function account(){
		if(!$this->Session->read("id") || !$this->Session->read("name")){
			$this->redirect('/');
		}
	}
	function beforeFilter(){
		$this->layout='adminnew';
	}
	function search($name_search=null){
		mysql_query("SET names utf8");
		$title = $_POST['name_search'];
		$this->loadModelNew('Infomation');
		$this->paginate = array('conditions'=>array('Infomation.name LIKE'=>'%'.$title.'%'),'limit' => '15','order' => 'Infomation.id DESC');
	   $this->set('infomations', $this->paginate('Infomation',array()));
	   
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
    function processing() {
		$this->account();
		$this->loadModelNew('Infomation');
		if(isset($_POST['dropdown']))
			$select=$_POST['dropdown'];
			
		if(isset($_POST['checkall']))
				{
			
			switch ($select){
				case 'active':
				$infomation=($this->Infomation->find('all'));
				foreach($infomation as $infomation) {
					$infomation['Infomation']['status']=1;
					$this->Infomation->save($infomation['Infomation']);					
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$infomation=($this->Infomation->find('all'));
				foreach($infomation as $infomation) {
					$infomation['Infomation']['status']=0;
					$this->Infomation->save($infomation['Infomation']);					
				}
				break;
				case 'delete':
				$infomation=($this->Infomation->find('all'));
				foreach($infomation as $infomation) {
					$this->News->delete($infomation['Infomation']['id']);					
				}
				if($this->Infomation->find('count')<1)
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
			$this->loadModelNew('Infomation');
			switch ($select){
				case 'active':
				$infomation=($this->Infomation->find('all'));
				foreach($infomation as $infomation) {
					if(isset($_POST[$infomation['Infomation']['id']]))
					{
						$infomation['Infomation']['status']=1;
						$this->Infomation->save($infomation['Infomation']);						
					}
                    
				}$this->redirect(array('action'=>'index'));
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$infomation=($this->Infomation->find('all'));
				foreach($infomation as $infomation) {
					if(isset($_POST[$infomation['Infomation']['id']]))
					{
						$infomation['Infomation']['status']=0;
						$this->Infomation->save($infomation['Infomation']);						
					}
                    
				}$this->redirect(array('action'=>'index'));
				break;
				case 'delete':
				$infomation=($this->Infomation->find('all'));
				foreach($infomation as $infomation) {
					if(isset($_POST[$infomation['Infomation']['id']]))
					{
					    $this->Infomation->delete($infomation['Infomation']['id']);						
					}										
				}
				$this->redirect(array('action'=>'index'));
				
				//vong lap xoa
				break;
				
			}
			
		}
		$this->redirect(array('action' => 'index'));
		
	}
    	function close($id=null) {
		$this->account();
		$this->loadModelNew('Infomation');
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Infomation'] = $this->data['Infomation'];
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
		$this->loadModelNew('Infomation');
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Infomation'] = $this->data['Infomation'];
		$data['Infomation']['status']=1;
		if ($this->Infomation->save($data['Infomation'])) {
			$this->Session->setFlash(__('Bài viết được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không hiển được bài viết', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
