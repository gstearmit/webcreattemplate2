<?php
class InfomationsController extends AppController {

	var $name = 'Infomations';
	var $uses=array('Infomation','News','Infomationdetail');
	//var $uses=array('Estore_infomation','Estore_news','Estore_infomationdetails');
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
		
		$this->set('information',$this->Infomationdetail->find('all',array('conditions'=>array('Infomationdetail.infomations_id'=>$id),'order'=>'Infomationdetail.id ASC')));
		
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
		$title = $_POST['name_search'];
		$this->paginate = array('conditions'=>array('Infomation.name LIKE'=>'%'.$title.'%'),'limit' => '15','order' => 'Infomation.id DESC');
	   $this->set('infomations', $this->paginate('Infomation',array()));
	}
    function processing() {
		$this->account();
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
