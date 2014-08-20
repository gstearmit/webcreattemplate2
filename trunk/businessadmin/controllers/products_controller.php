<?php
class ProductsController extends AppController {

	var $name = 'Products';
	var $uses=array(
			'Eshopdaquyproduct',
			'Eshopdaquycatproduct',
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
		  $this->loadModelNew('Eshopdaquyproduct');	   
		 // $conditions=array('News.status'=>1);
		  $this->paginate = array('limit' => '15','order' => 'Eshopdaquyproduct.id DESC');
	      $this->set('product', $this->paginate('Eshopdaquyproduct',array()));
		
		$this->loadModelNew('Eshopdaquycatproduct');	   
        $list_cat = $this->Eshopdaquycatproduct->generatetreelist(null,null,null," _ ");
        $this->set(compact('list_cat'));
	}
	
	//Them bai viet
	function add() {
		$this->account();
		$this->loadModelNew('Eshopdaquyproduct');	   
		if (!empty($this->data)) {
			$this->Eshopdaquyproduct->create();
			$data['Eshopdaquyproduct'] = $this->data['Eshopdaquyproduct'];
			$data['Eshopdaquyproduct']['images']=$_POST['userfile'];
			$data['Eshopdaquyproduct']['images1']=$_POST['userfile1'];
			$data['Eshopdaquyproduct']['images2']=$_POST['userfile2'];
			$data['Eshopdaquyproduct']['images3']=$_POST['userfile3'];
			$data['Eshopdaquyproduct']['images4']=$_POST['userfile4'];
			if ($this->Eshopdaquyproduct->save($data['Eshopdaquyproduct'])) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		}
		$this->loadModelNew("Eshopdaquycatproduct");
        $list_cat = $this->Eshopdaquycatproduct->generatetreelist(null,null,null," _ ");
        $this->set(compact('list_cat'));
	}
	//view mot tin 
	function view($id = null) {
	    $this->loadModelNew('Eshopdaquyproduct');	   
		if (!$id) {
			$this->Session->setFlash(__('Không tồn tại', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('views', $this->Eshopdaquyproduct->read(null, $id));
	}
	//close tin tuc
	function close($id=null) {
		$this->account();
		$this->loadModelNew('Eshopdaquyproduct');	   
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Eshopdaquyproduct'] = $this->data['Eshopdaquyproduct'];
		$data['Eshopdaquyproduct']['status']=0;
		if ($this->Eshopdaquyproduct->save($data['Eshopdaquyproduct'])) {
			$this->Session->setFlash(__('Bài viết không được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không close được', true));
		$this->redirect(array('action' => 'index'));

	}
	
	// active tin bai viêt
	function active($id=null) {
		$this->account();
		$this->loadModelNew('Eshopdaquyproduct');	   
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Eshopdaquyproduct'] = $this->data['Eshopdaquyproduct'];
		$data['Eshopdaquyproduct']['status']=1;
		if ($this->Eshopdaquyproduct->save($data['Eshopdaquyproduct'])) {
			$this->Session->setFlash(__('Bài viết được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không hiển được bài viết', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function search() {
	   $this->loadModelNew("Eshopdaquycatproduct");
	   $keyword="";
	   $list_cat="";
	  
	   if(isset($_POST['keyword'])) $keyword=$_POST['keyword'];
	   if(isset($_POST['list_cat'])) $list_cat=$_POST['list_cat'];
	   
		$x=array();
		if($keyword!="") $x['Eshopdaquyproduct.title like']='%'.$keyword.'%'; 
		if($list_cat!="") $x['Eshopdaquyproduct.catproduct_id']=$list_cat;
		//pr($x);exit;
		$tt =array();
		$portfolio=$this->Eshopdaquycatproduct->find('all',array('conditions'=>array('Eshopdaquycatproduct.parent_id'=>$x)));		
		//pr($portfolio);
		foreach($portfolio as $key){
		$tt[]=$key['Eshopdaquycatproduct']['id'];
		}
		for($i=0;$i<count($tt);$i++)
		 if($list_cat==$tt[$i])
		 $list_cat=$this->Eshopdaquycatproduct->find('list',array('conditions'=>array('Eshopdaquycatproduct.parent_id'=>$tt[$i]),'fields'=>array('Eshopdaquycatproduct.id')));	
		 if($list_cat!="")
		$x['Eshopdaquyproduct.catproduct_id']=$list_cat;
		//pr($x); die;
		//
	    //$this->set('products', $this->paginate('Eshopdaquyproduct',array()));	
		//pr($x);
		$this->loadModelNew("Eshopdaquyproduct");
		$this->paginate = array('conditions'=>$x,'limit' => '12','order' => 'Eshopdaquyproduct.id DESC');
		$this->set('product', $this->paginate('Eshopdaquyproduct',array()));	
		//$ketquatimkiem=$this->Eshopdaquyproduct->find('all',array('conditions'=>$x,'order' => 'Eshopdaquyproduct.id DESC','limit'=>3));	
		//pr($ketquatimkiem); die;
		//$this->set('products',$category);
		$this->loadModelNew("Eshopdaquycatproduct");
        $list_cat = $this->Eshopdaquycatproduct->generatetreelist(null,null,null," _ ");
        $this->set(compact('list_cat'));
		
	}
	// sua tin da dang
	function edit($id = null) {
		$this->account();
		$this->loadModelNew("Eshopdaquyproduct");
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại ', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$data['Eshopdaquyproduct'] = $this->data['Eshopdaquyproduct'];
			$data['Eshopdaquyproduct']['images']=$_POST['userfile'];
			$data['Eshopdaquyproduct']['images1']=$_POST['userfile1'];
			$data['Eshopdaquyproduct']['images2']=$_POST['userfile2'];
			$data['Eshopdaquyproduct']['images3']=$_POST['userfile3'];
			$data['Eshopdaquyproduct']['images4']=$_POST['userfile4'];
			if ($this->Eshopdaquyproduct->save($data['Eshopdaquyproduct'])) {
				$this->Session->setFlash(__('Bài viết sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Bài viết này không sửa được vui lòng thử lại.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Eshopdaquyproduct->read(null, $id);
		}
		$this->loadModelNew("Eshopdaquycatproduct");
        $list_cat = $this->Eshopdaquycatproduct->generatetreelist(null,null,null," _ ");
        $this->set(compact('list_cat'));
		$this->set('edit',$this->Eshopdaquyproduct->findById($id));
	}
	function processing() {
		$this->account();
		$this->loadModelNew("Eshopdaquyproduct");
		if(isset($_POST['dropdown']))
			$select=$_POST['dropdown'];
			
		if(isset($_POST['checkall']))
				{
			
			switch ($select){
				case 'active':
				$products=($this->Eshopdaquyproduct->find('all'));
				foreach($products as $product) {
					$product['Eshopdaquyproduct']['status']=1;
					$this->Eshopdaquyproduct->save($product['Eshopdaquyproduct']);					
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$products=($this->Eshopdaquyproduct->find('all'));
				foreach($products as $product) {
					$new['Eshopdaquyproduct']['status']=0;
					$this->Eshopdaquyproduct->save($product['Eshopdaquyproduct']);					
				}
				break;
				case 'delete':
				$products=($this->Eshopdaquyproduct->find('all'));
				foreach($products as $product) {
					$this->Eshopdaquyproduct->delete($product['Eshopdaquyproduct']['id']);					
				}
				if($this->Eshopdaquyproduct->find('count')<1)
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
				$products=($this->Eshopdaquyproduct->find('all'));
				foreach($products as $product) {
					if(isset($_POST[$product['Eshopdaquyproduct']['id']]))
					{
						$product['Eshopdaquyproduct']['status']=1;
						$this->Eshopdaquyproduct->save($product['Eshopdaquyproduct']);
					}
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$products=($this->Eshopdaquyproduct->find('all'));
				foreach($products as $product) {
					if(isset($_POST[$product['Eshopdaquyproduct']['id']]))
					{
						$new['Eshopdaquyproduct']['status']=0;
						$this->Eshopdaquyproduct->save($product['Eshopdaquyproduct']);
					}
				}
				break;
				case 'delete':
				$products=($this->Eshopdaquyproduct->find('all'));
				foreach($products as $product) {
					if(isset($_POST[$product['Eshopdaquyproduct']['id']]))
					{
					    $this->Eshopdaquyproduct->delete($product['Eshopdaquyproduct']['id']);
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
	// Xoa cac dang
	function delete($id = null) {
		$this->account();
        $this->loadModelNew("Eshopdaquyproduct");		
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Eshopdaquyproduct->delete($id)) {
			$this->Session->setFlash(__('Xóa bài viết thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không xóa được', true));
		$this->redirect(array('action' => 'index'));
	}
	function _find_list() {
	    $this->loadModelNew("Eshopdaquyproduct");
		return $this->Eshopdaquycatproduct->generatetreelist(null, null, null, '__');
	}
	//check ton tai tai khoan
	function account(){
		if(!$this->Session->read("id") || !$this->Session->read("name")){
			$this->redirect('/');
		}
	}
	// chon layout
	function beforeFilter(){
		$this->layout='admin';
	}

}
?>
