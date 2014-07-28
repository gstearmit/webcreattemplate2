<?php
class GalleryController extends AppController {

	var $name = 'Gallery'; 
   
    var $uses=array('Gallery','Album');
	function index() {         
		  $this->account();  
		  $this->paginate = array('limit' => '15','order' => 'Gallery.id DESC');
	      $this->set('gallerys', $this->paginate('Gallery',array()));

	} 
  function getAlbum($id = null){
        mysql_query("SET names utf8");          
        return $this->Album->find('all',array('conditions'=>array('Album.status'=>1,'Album.id'=>$id),'limit' => '1','order' => 'Album.id ASC'));
    }
         

	function add(){                                        
		$this->account();
        $this->set('Album',$this->Album->find('all',array('order'=>'Album.id ASC')));
      
		if (!empty($this->data)) {
			$this->Gallery->create();
			$data['Gallery'] = $this->data['Gallery'];
			$data['Gallery']['images']=$_POST['userfile'];
           
			if ($this->Gallery->save($data['Gallery'])) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		}
	}
	
	function close($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại ', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Gallery'] = $this->data['Gallery'];
		$data['Gallery']['status']=0;
		if ($this->Gallery->save($data['Gallery'])) {
			$this->Session->setFlash(__('Hình ảnh không được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Hình ảnh không close được', true));
		$this->redirect(array('action' => 'index'));

	}
	
	function active($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại ', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Gallery'] = $this->data['Gallery'];
		$data['Gallery']['status']=1;
		if ($this->Gallery->save($data['Gallery'])) {
			$this->Session->setFlash(__('Hình ảnh được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Hình ảnh không active được', true));
		$this->redirect(array('action' => 'index'));

	}

	function edit($id = null) {
		$this->account();
        $this->set('Album',$this->Album->find('all',array('order'=>'Album.id ASC'))); 
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại ', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$data['Gallery'] = $this->data['Gallery'];
			$data['Gallery']['images']=$_POST['userfile'];
			if ($this->Gallery->save($data['Gallery'])) {
				$this->Session->setFlash(__('Bài viết sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Bài viết này không sửa được vui lòng thử lại.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Gallery->read(null, $id);
		}
		
		$this->set('edit',$this->Gallery->findById($id));
	}
	// Xoa hinh anh
	function delete($id = null) {
		$this->account();		
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại hình ảnh này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Gallery->delete($id)) {
			$this->Session->setFlash(__('Xóa  thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Không xóa được', true));
		$this->redirect(array('action' => 'index'));
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
