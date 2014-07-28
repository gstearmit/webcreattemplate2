<?php
class NewsController extends AppController {

	var $name = 'News';
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
	function index() {
		  $this->account();
		 // $conditions=array('News.status'=>1);
		  $this->paginate = array('limit' => '10','order' => 'News.id DESC');
	      $this->set('news', $this->paginate('News',array()));
		  $this->loadModel("Category");
        $this->set('cat', $this->Category->find('all',array('conditions'=>array('Category.status'=>1))));
        $this->set('catcon', $this->Category->find('all',array('conditions'=>array('Category.status'=>1))));
		  
	}
	//Them bai viet

    	function add() {
		$this->account();
		if (!empty($this->data)) {
			$this->News->create();
			$data['News'] = $this->data['News'];
            $data['News']['images'] = $_POST['userfile'];	
			if ($this->News->save($data['News'])) {
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		}
		$this->loadModel("Category");
        $list_cat = $this->Category->generatetreelist(array('Category.status'=>1),null,null," _ ");
        $this->set(compact('list_cat'));
	}
	//view mot tin 
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Không tồn tại', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('views', $this->News->read(null, $id));
	}
	
	/*function search() {
		$data['News']=$this->data['News'];
		$category=$data['News']['category_id'];
		$this->paginate = array('conditions'=>array('News.category_id'=>$category),'limit' => '15','order' => 'News.id DESC');
	    $this->set('news', $this->paginate('News',array()));
		
	}
	*/
    function search() {
		$this->loadModel("Category");
	   $keyword="";
	   $list_cat="";
	  
	   if(isset($_POST['keyword']))
		$keyword=$_POST['keyword'];
		
		if(isset($_POST['system']))
        
		$list_cat=$_POST['system'];
        //print_r($list_cat); exit();
		if(($keyword!="")&&($list_cat=="")){
		//['Product.title LIKE']='%'.$keyword.'%';
		$this->paginate = array('conditions'=>array('News.title LIKE'=>'%'.$keyword.'%'),'limit' => '15','order' => 'News.id DESC');
	   $this->set('news', $this->paginate('News',array()));
        }
				
		 if(($keyword=="")&&($list_cat!="")){
		$portfolio=$this->Category->find('all',array('conditions'=>array('Category.parent_id'=>$list_cat)));
        if($portfolio!=null){
		$this->paginate = array('conditions'=>array('News.category_id'=>$portfolio),'limit' => '15','order' => 'News.id DESC');
	       $this->set('news', $this->paginate('News',array()));
           }else{
            $this->paginate = array('conditions'=>array('News.category_id'=>$list_cat),'limit' => '15','order' => 'News.id DESC');
	       $this->set('news', $this->paginate('News',array()));
           }
        }
       if(($keyword!="")&&($list_cat!="")){
		$portfolio=$this->Category->find('all',array('conditions'=>array('Category.parent_id'=>$list_cat)));
        if($portfolio!=null){
		$this->paginate = array('conditions'=>array('News.title LIKE'=>'%'.$keyword.'%','News.category_id'=>$portfolio),'limit' => '15','order' => 'News.id DESC');
	       $this->set('news', $this->paginate('News',array()));
           }else{
            $this->paginate = array('conditions'=>array('News.title LIKE'=>'%'.$keyword.'%','News.category_id'=>$list_cat),'limit' => '15','order' => 'News.id DESC');
	       $this->set('news', $this->paginate('News',array()));
           }
        }
         $this->set('cat', $this->Category->find('all',array('conditions'=>array('Category.status'=>1))));
        $this->set('catcon', $this->Category->find('all',array('conditions'=>array('Category.status'=>1))));
	}

	function processing() {
		$this->account();
		if(isset($_POST['dropdown']))
			$select=$_POST['dropdown'];
			
		if(isset($_POST['checkall']))
				{
			
			switch ($select){
				case 'active':
				$news=($this->News->find('all'));
				foreach($news as $new) {
					$new['News']['status']=1;
					$this->News->save($new['News']);					
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$news=($this->News->find('all'));
				foreach($news as $new) {
					$new['News']['status']=0;
					$this->News->save($new['News']);					
				}
				break;
				case 'delete':
				$news=($this->News->find('all'));
				foreach($news as $new) {
					$this->News->delete($new['News']['id']);					
				}
				if($this->News->find('count')<1)
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
				$news=($this->News->find('all'));
				foreach($news as $new) {
					if(isset($_POST[$new['News']['id']]))
					{
						$new['News']['status']=1;
						$this->News->save($new['News']);
					}
				}
				//vong lap active
                $this->redirect(array('action'=>'index'));	
				break;
				case 'notactive':	
				//vong lap huy
				$news=($this->News->find('all'));
				foreach($news as $new) {
					if(isset($_POST[$new['News']['id']]))
					{
						$new['News']['status']=0;
						$this->News->save($new['News']);
					}
				}
                $this->redirect(array('action'=>'index'));	
				break;
				case 'delete':
				$news=($this->News->find('all'));
				foreach($news as $new) {
					if(isset($_POST[$new['News']['id']]))
					{
					    $this->News->delete($new['News']['id']);
					
					}
										
				}
				
				$this->redirect(array('action'=>'index'));	
				//vong lap xoa
				break;
				
			}
			
		}
		$this->redirect(array('action' => 'index'));
		
	}
	//close tin tuc
	function close($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['News'] = $this->data['News'];
		$data['News']['status']=0;
		if ($this->News->save($data['News'])) {
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
		$data['News'] = $this->data['News'];
		$data['News']['status']=1;
		if ($this->News->save($data['News'])) {
			$this->Session->setFlash(__('Bài viết được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không hiển được bài viết', true));
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
			$data['News'] = $this->data['News'];
		      $data['News']['images'] = $_POST['userfile'];
			if ($this->News->save($data['News'])) {
				$this->Session->setFlash(__('Bài viết sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Bài viết này không sửa được vui lòng thử lại.', true));
			}
		}
        
        if (empty($this->data)) {
            $this->data = $this->News->read(null, $id);
        }

		$this->loadModel("Category");
        $list_cat = $this->Category->generatetreelist(null,null,null," _ ");
        $this->set(compact('list_cat'));       
		$this->set('edit',$this->News->findById($id));
	}
	// Xoa cac dang
	function delete($id = null) {
		$this->account();		
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->News->delete($id)) {
			$this->Session->setFlash(__('Xóa bài viết thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không xóa được', true));
		$this->redirect(array('action' => 'index'));
	}
	function _find_list() {
		return $this->Category->generatetreelist(null, null, null, '__');
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
    /**
 * uploads files to the server
 * @params:
 *		$folder 	= the folder to upload the files e.g. 'img/files'
 *		$formdata 	= the array containing the form files
 *		$itemId 	= id of the item (optional) will create a new sub folder
 * @return:
 *		will return an array with the success of each file upload
 */
    function __upload($file_array){
  
        $file = new File($file_array['tmp_name']);
        $file_base = pathinfo($file_array['name']);
        var_dump($file_base);exit;
        $ext = strtolower($file_base['extension']);
        if ($ext != 'jpg' && $ext != 'jpeg' && $ext != 'gif' && $ext != 'png') {
            $this->Session->setFlash('You may only upload image files.');
            $this->render();
        } else {
            $data = $file->read();
            $file->close();
            $full_path = '/upload/images/'.$file_array['name'];
            $file = new File(WWW_ROOT.$full_path, true);
            $file->write($data);
            $file->close();
             return $full_path;
        }
        return 'Ouch!';
    }

}
?>
