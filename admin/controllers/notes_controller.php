<?php
class NotesController extends AppController {
	var $name = 'Notes';
	var $uses = array (
			'Catproduct',
			'Note' 
	);
	var $helpers = array (
			'Html',
			'Form',
			'Javascript',
			'TvFck' 
	);
	function index() {
		$this->account ();
		// $conditions=array('News.status'=>1);
		$this->paginate = array (
				'limit' => '10',
				'order' => 'Note.id DESC' 
		);
		$this->set ( 'Notes', $this->paginate ( 'Note', array () ) );
		
		$this->loadModel ( "Catproduct" );
		$list_cat = $this->Catproduct->generatetreelist ( null, null, null, " _ " );
		$this->set ( compact ( 'list_cat' ) );
		// print_r($list_cat);
	}
	// Them bai viet
	function add() {
		$this->account ();
		if (! empty ( $this->data )) {
			$this->Note->create ();
			$data ['Note'] = $this->data ['Note'];
			$data ['Note'] ['images'] = $_POST ['userfile'];
			//pr($data);die();
			if ($this->Note->save ( $data ['Note'] )) {
				$this->Session->setFlash ( __ ( 'Thêm mới danh mục thành công', true ) );
				$this->redirect ( array (
						'action' => 'index' 
				) );
			} else {
				$this->Session->setFlash ( __ ( 'Thêm mơi danh mục thất bại. Vui long thử lại', true ) );
			}
		}
		$this->loadModel ( "Catproduct" );
		$list_cat = $this->Catproduct->generatetreelist ( null, null, null, " _ " );
		$this->set ( compact ( 'list_cat' ) );
	}
	// view mot tin
	function view($id = null) {
		if (! $id) {
			$this->Session->setFlash ( __ ( 'Không tồn tại', true ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		$this->set ( 'views', $this->Note->read ( null, $id ) );
	}
	
	/*
	 * function search() { $data['News']=$this->data['News']; $category=$data['News']['category_id']; $this->paginate = array('conditions'=>array('News.category_id'=>$category),'limit' => '15','order' => 'News.id DESC'); $this->set('news', $this->paginate('News',array())); }
	 */
	function search() {
		$keyword = "";
		if (isset ( $_POST ['keyword'] ))
			$keyword = $_POST ['keyword'];
		
		$x ['News.title like'] = '%' . $keyword . '%';
		
		// $this->set('products', $this->paginate('Product',array()));
		// pr($x);
		$this->paginate = array (
				'conditions' => $x,
				'limit' => '12',
				'order' => 'News.id DESC' 
		);
		$this->set ( 'news', $this->paginate ( 'News', array () ) );
		// $ketquatimkiem=$this->Product->find('all',array('conditions'=>$x,'order' => 'Product.id DESC','limit'=>3));
		// pr($ketquatimkiem); die;
		// $this->set('products',$category);
	}
	function processing() {
		$this->account ();
		if (isset ( $_POST ['dropdown'] ))
			$select = $_POST ['dropdown'];
		
		if (isset ( $_POST ['checkall'] )) {
			
			switch ($select) {
				case 'active' :
					$news = ($this->Note->find ( 'all' ));
					foreach ( $news as $new ) {
						$new ['Note'] ['status'] = 1;
						$this->Note->save ( $new ['Note'] );
					}
					// vong lap active
					break;
				case 'notactive' :
					// vong lap huy
					$news = ($this->Note->find ( 'all' ));
					foreach ( $news as $new ) {
						$new ['Note'] ['status'] = 0;
						$this->Note->save ( $new ['Note'] );
					}
					break;
				case 'delete' :
					$news = ($this->Note->find ( 'all' ));
					foreach ( $news as $new ) {
						$this->Note->delete ( $new ['Note'] ['id'] );
					}
					if ($this->Note->find ( 'count' ) < 1)
						$this->redirect ( array (
								'action' => 'index' 
						) );
					else {
						$this->Session->setFlash ( __ ( 'Danh mục không close được', true ) );
						$this->redirect ( array (
								'action' => 'index' 
						) );
					}
					// vong lap xoa
					break;
			}
		} else {
			
			switch ($select) {
				case 'active' :
					$news = ($this->Note->find ( 'all' ));
					foreach ( $news as $new ) {
						if (isset ( $_POST [$new ['Note'] ['id']] )) {
							$new ['Note'] ['status'] = 1;
							$this->Note->save ( $new ['Note'] );
						}
					}
					// vong lap active
					break;
				case 'notactive' :
					// vong lap huy
					$news = ($this->Note->find ( 'all' ));
					foreach ( $news as $new ) {
						if (isset ( $_POST [$new ['Note'] ['id']] )) {
							$new ['Note'] ['status'] = 0;
							$this->Note->save ( $new ['Note'] );
						}
					}
					break;
				case 'delete' :
					$news = ($this->Note->find ( 'all' ));
					foreach ( $news as $new ) {
						if (isset ( $_POST [$new ['Note'] ['id']] )) {
							$this->Note->delete ( $new ['Note'] ['id'] );
							$this->redirect ( array (
									'action' => 'index' 
							) );
						}
					}
					
					die ();
					// vong lap xoa
					break;
			}
		}
		$this->redirect ( array (
				'action' => 'index' 
		) );
	}
	
	// close tin tuc
	function close($id = null) {
		$this->account ();
		if (empty ( $id )) {
			$this->Session->setFlash ( __ ( 'Khôn tồn tại bài viết này', true ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		$data ['Note'] = $this->data ['Note'];
		$data['Note']['id']=$id;
		$data ['Note'] ['status'] = 0;
		if ($this->Note->save ( $data ['Note'] )) {
			$this->Session->setFlash ( __ ( 'Bài viết không được hiển thị', true ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		$this->Session->setFlash ( __ ( 'Bài viết không close được', true ) );
		$this->redirect ( array (
				'action' => 'index' 
		) );
	}
	// active tin bai viêt
	function active($id = null) {
		$this->account ();
		if (empty ( $id )) {
			$this->Session->setFlash ( __ ( 'Khôn tồn tại bài viết này', true ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		$data ['Note'] = $this->data ['Note'];
		$data['Note']['id']=$id;
		$data ['Note'] ['status'] = 1;
		if ($this->Note->save ( $data ['Note'] )) {
			$this->Session->setFlash ( __ ( 'Bài viết được hiển thị', true ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		
		$this->Session->setFlash ( __ ( 'Bài viết không hiển được bài viết', true ) );
		$this->redirect ( array (
				'action' => 'index' 
		) );
	}
	// sua tin da dang
function edit($id = null) {
		$this->account();
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại ', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$data['Note'] = $this->data['Note'];
			
			
			if ($this->Note->save($data['Note'])) {
				$this->Session->setFlash(__('Bài viết sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Bài viết này không sửa được vui lòng thử lại.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Note->read(null, $id);
		}
	
	    $this->loadModel("Catproduct");
        $list_cat = $this->Catproduct->generatetreelist(null,null,null," _ ");
        $this->set(compact('list_cat'));
		$this->set('edit',$this->Note->findById($id));
	}
	// Xoa cac dang
	function delete($id = null) {
		$this->account ();
		if (empty ( $id )) {
			$this->Session->setFlash ( __ ( 'Khôn tồn tại bài viết này', true ) );
			// $this->redirect(array('action'=>'index'));
		}
		if ($this->Note->delete ( $id )) {
			$this->Session->setFlash ( __ ( 'Xóa bài viết thành công', true ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		$this->Session->setFlash ( __ ( 'Bài viết không xóa được', true ) );
		$this->redirect ( array (
				'action' => 'index' 
		) );
	}
	function _find_list() {
		return $this->Category->generatetreelist ( null, null, null, '__' );
	}
	// check ton tai tai khoan
	function account() {
		if (! $this->Session->read ( "id" ) || ! $this->Session->read ( "name" )) {
			$this->redirect ( '/' );
		}
	}
	// chon layout
	function beforeFilter() {
		$this->layout = 'admin';
	}
	function get_name($id = null) {
		return $this->Catproduct->find ( 'all', array (
				'conditions' => array (
						'Catproduct.id' => $id,
						'Catproduct.status' => 1 
				),
				'limit' => 1 
		) );
	}
}
?>
