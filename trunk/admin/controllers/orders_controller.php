<?php
class OrdersController extends AppController {

	var $name = 'Orders';
	var $uses=array('Order','Userscms');
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
	function index() 
	{
		  $this->account();
		 // $conditions=array('Order.status'=>1);
		  $this->paginate = array('limit' => '10','order' => 'Order.id ASC');
	      $this->set('Order', $this->paginate('Order',array()));
	  
	}
	//Them bai viet
	function add() {
		$this->account();
		if (!empty($this->data)) {
			$this->Order->create();
			$data['Order'] = $this->data['Order'];
			$data['Order']['images']=$_POST['userfile'];
			
			if ($this->Order->save($data['Order'])) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		}
		
	}
	//view mot tin 
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Không tồn tại', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('views', $this->Order->read(null, $id));
	}
	
	/*function search() {
		$data['Order']=$this->data['Order'];
		$CategorynewsOrder=$data['Order']['CategorynewsOrder_id'];
		$this->paginate = array('conditions'=>array('Order.CategorynewsOrder_id'=>$CategorynewsOrder),'limit' => '15','order' => 'Order.id DESC');
	    $this->set('Order', $this->paginate('Order',array()));
		
	}
	*/
function search() {
	
		$keyword=isset($_POST['name'])? $_POST['name'] :'';
		
		$x['Order.name like']='%'.$keyword.'%';
	
		$this->paginate = array('conditions'=>$x,'limit' => '12','order' => 'Order.id DESC');
		$this->set('Order', $this->paginate('Order',array()));	
	
		
	}
	
	
	
	function processing() {
		$this->account();
		if(isset($_POST['dropdown']))
			$select=$_POST['dropdown'];
			
		if(isset($_POST['checkall']))
				{
			
			switch ($select){
				case 'active':
				$Order=($this->Order->find('all'));
				foreach($Order as $new) {
					$new['Order']['dagiaohang']=1;
					$data['Order']['status']=1;
					$this->Order->save($new['Order']);					
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Order=($this->Order->find('all'));
				foreach($Order as $new) {
					$new['Order']['dagiaohang']=0;
					$data['Order']['status']=0;
					$this->Order->save($new['Order']);					
				}
				break;
				case 'delete':
				$Order=($this->Order->find('all'));
				foreach($Order as $new) {
					$this->Order->delete($new['Order']['id']);					
				}
				if($this->Order->find('count')<1)
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
				$Order=($this->Order->find('all'));
				foreach($Order as $new) {
					if(isset($_POST[$new['Order']['id']]))
					{
						$new['Order']['dagiaohang']=1;
						$data['Order']['status']=1;
						$this->Order->save($new['Order']);
					}
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$Order=($this->Order->find('all'));
				foreach($Order as $new) {
					if(isset($_POST[$new['Order']['id']]))
					{
						$new['Order']['dagiaohang']=0;
						$data['Order']['status']=0;
						$this->Order->save($new['Order']);
					}
				}
				break;
				case 'delete':
				$Order=($this->Order->find('all'));
				foreach($Order as $new) {
					if(isset($_POST[$new['Order']['id']]))
					{
					    $this->Order->delete($new['Order']['id']);
						
					}
										
				}
				$this->redirect(array('action'=>'index'));
				die;	
				//vong lap xoa
				break;
				
			}
			
		}
		$this->redirect(array('action' => 'index'));
		
	}
	
		//dong danh muc
	function close($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Order'] = $this->data['Order'];
		$data['Order']['id']=$id;
		$data['Order']['dagiaohang']=0;	
		$data['Order']['status']=0;		
		if ($this->Order->save($data['Order'])) {
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
		$data['Order'] = $this->data['Order'];
		$data['Order']['id']=$id;
		$data['Order']['dagiaohang']=1;
		$data['Order']['status']=1;
		if ($this->Order->save($data['Order'])) {
			$this->Session->setFlash(__('Danh mục kích hoạt thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không kich hoạt được', true));
		$this->redirect(array('action' => 'index'));

	}
	
	
		//dong danh muc
	function close1($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Order'] = $this->data['Order'];
		$data['Order']['id']=$id;
		$data['Order']['status']=0;		
		if ($this->Order->save($data['Order'])) {
			$this->Session->setFlash(__('Danh mục không được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không close được', true));
		$this->redirect(array('action' => 'index'));

	}
	// kich hoat
	function active1($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Order'] = $this->data['Order'];
		$data['Order']['id']=$id;
		$data['Order']['status']=1;
		if ($this->Order->save($data['Order'])) {
			$this->Session->setFlash(__('Danh mục kích hoạt thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không kich hoạt được', true));
		$this->redirect(array('action' => 'index'));

	}

	

	// sua tin da dang
	function edit($id = null) {
		$this->account();
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại ', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$data['Order'] = $this->data['Order'];
			
			
			if ($this->Order->save($data['Order'])) {
				$this->Session->setFlash(__('Bài viết sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Bài viết này không sửa được vui lòng thử lại.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Order->read(null, $id);
		}
		
		$this->set('edit',$this->Order->findById($id));
	}
	// Xoa cac dang
	function delete($id = null) {
		$this->account();		
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Order->delete($id)) {
			$this->Session->setFlash(__('Xóa bài viết thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không xóa được', true));
		$this->redirect(array('action' => 'index'));
	}
	function _find_list() {
		return $this->CategorynewsOrder->generatetreelist(null, null, null, '__');
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
	
	function get_userscms($id=null){
	
	return $this->Userscms->find('all',array('conditions'=>array('Userscms.id'=>$id),'limit'=>1));
	}
	

}
?>
