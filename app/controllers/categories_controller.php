<?php
class CategoriesController extends AppController {

	var $name = 'Categories';
	function index() {
		//list danh sach tin tuc
		mysql_query("SET names utf8");
		$this->set('categories',$this->Category->find('all',array('conditions'=>array('Category.status'=>1,'parent_id'=>98),'order'=>'Category.id asc')));
	}
	function view($id=null) {
		mysql_query("SET names utf8");
		if (!$id) {
			$this->Session->setFlash(__('Không tồn tại', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('views', $this->Product->read(null, $id));
	}

function getCategories($id=null){
     mysql_query("SET names utf8");
		if (!$id) {
			$this->Session->setFlash(__('Không tồn tại', true));
			$this->redirect(array('action' => 'index'));
		}
	return	$this->Category->find('all',array('conditions'=>array('Category.status'=>1,'parent_id'=>$id),'order'=>'Category.id asc'));
		

}

}
?>
