<?php
class ProductsController extends AppController {
	var $name = 'Products';
	var $helpers = array (
			'Html',
			'Form',
			'Javascript',
			'TvFck' 
	);
	var $uses = array (
			'Product',
			'Shop',
			'Catproduct',
			'Manufacturer' 
	);
	function loadModelNew($Model) {
		// ++++++++++++connection data +++++++++++++++++
		$nameeshop = $this->Session->read ( "name" );
		$shop_id = $this->Session->read ( "id" );
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
		
		if (is_array ( $shoparr ) and ! empty ( $shoparr )) {
			foreach ( $shoparr as $shop ) {
				$databasename = $shop ['Shop'] ['databasename'];
				$password = $shop ['Shop'] ['password'];
				$username = $shop ['Shop'] ['username'];
				$hostname = $shop ['Shop'] ['hostname'];
				$shop_id = $shop ['Shop'] ['id'];
				$nameproject = $shop ['Shop'] ['name']; // $nameproject is name Ctronller
				$email = trim ( $shop ['Shop'] ['email'] );
				$userpass = $shop ['Shop'] ['userpass'];
			}
		}
		$this->$Model->setDataEshop ( $hostname, $username, $password, $databasename );
	}
	function index() {
		$this->account ();
		// $conditions=array('News.status'=>1);
		$this->loadModelNew("Product");
		$this->paginate = array (
				'limit' => '15',
				'order' => 'Product.id DESC' 
		);
		$this->set ( 'product', $this->paginate ( 'Product', array () ) );
		$this->loadModelNew("Catproduct" );
		$this->set ( 'cat', $this->Catproduct->find ( 'all', array (
				'conditions' => array (
						'Catproduct.status' => 1 
				) 
		) ) );
		$this->loadModelNew("Catproduct" );
		$this->set ( 'catcon', $this->Catproduct->find ( 'all', array (
				'conditions' => array (
						'Catproduct.status' => 1 
				) 
		) ) );
		
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
	
	// Them bai viet
	function add() {
		$this->account ();
		$this->loadModelNew ( "Product" );
		if (! empty ( $this->data )) {
			//pr($this->data);die;
			$this->Product->create ();
			$data ['Product'] = $this->data ['Product'];
			$data ['Product'] ['images'] = $_POST ['userfile'];
			$data ['Product'] ['images1'] = $_POST ['images1'];
			$data ['Product'] ['images2'] = $_POST ['images2'];
			$data ['Product'] ['images3'] = $_POST ['images3'];
			$data ['Product'] ['images4'] = $_POST ['images4'];
			if ($this->Product->save ( $data ['Product'] )) {
				$this->Session->setFlash ( __ ( 'Thêm mới danh mục thành công', true ) );
				$this->redirect ( array (
						'action' => 'index' 
				) );
			} else {
				$this->Session->setFlash ( __ ( 'Thêm mơi danh mục thất bại. Vui long thử lại', true ) );
			}
		}
		$this->loadModelNew ( "Catproduct" );
		$list_cat = $this->Catproduct->generatetreelist ( null, null, null, " _ " );
		$this->set ( compact ( 'list_cat' ) );
		$this->loadModelNew ( "Manufacturer" );
		$list_cat1 = $this->Manufacturer->generatetreelist ( null, null, null, " _ " );
		$this->set ( compact ( 'list_cat1' ) );
		$gia = array (
				'0' => '0 đến 1 triệu',
				'1' => '1 đến 2 triệu',
				'2' => '2 đến 3 triệu',
				'4' => '3 đến 4 triệu',
				'5' => '4 đến 5 triệu',
				'6' => '5 đến 6 triệu',
				'7' => '6 đến 7 triệu',
				'8' => '7 đến 8 triệu',
				'9' => '8 đến 9 triệu',
				'10' => 'Trên 10 triệu' 
		);
		$this->set ( compact ( 'gia' ) );
		
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
	// view mot tin
	function view($id = null) {
		$this->loadModelNew ( "Product" );
		if (! $id) {
			$this->Session->setFlash ( __ ( 'Không tồn tại', true ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		$this->set ( 'views', $this->Product->read ( null, $id ) );
	}
	// close tin tuc
	function close($id = null) {
		$this->account ();
		$this->loadModelNew ( "Product" );
		if (empty ( $id )) {
			$this->Session->setFlash ( __ ( 'Khôn tồn tại bài viết này', true ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		$data ['Product'] = $this->data ['Product'];
		$data ['Product'] ['id'] = $id;
		$data ['Product'] ['status'] = 0;
		if ($this->Product->save ( $data ['Product'] )) {
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
		$this->loadModelNew ( "Product" );
		if (empty ( $id )) {
			$this->Session->setFlash ( __ ( 'Không tồn tại bài viết này', true ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		$data ['Product'] = $this->data ['Product'];
		$data ['Product'] ['id'] = $id;
		$data ['Product'] ['status'] = 1;
		if ($this->Product->save ( $data ['Product'] )) {
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
	// tim kiem san pham
	/*
	 * function search() { $data['Product']=$this->data['Product']; $category=$data['Product']['catproduct_id']; $this->paginate = array('conditions'=>array('Product.catproduct_id'=>$category),'limit' => '15','order' => 'Product.id DESC'); $this->set('product', $this->paginate('Product',array())); $this->loadModel("Catproduct"); $list_cat = $this->Catproduct->generatetreelist(null,null,null," _ "); $this->set(compact('list_cat')); }
	 */
	function search() {
		$keyword = "";
		$list_cat = "";
		
		if (isset ( $_POST ['keyword'] ))
			$keyword = $_POST ['keyword'];
		
		if (isset ( $_POST ['system'] ))
			
			$list_cat = $_POST ['system'];
		if (($keyword === "") && ($list_cat === "")) {
			// DEFAULT seach
			$this->paginate = array (
					'limit' => '15',
					'order' => 'Product.id DESC'
			);
			$this->set ( 'product', $this->paginate ( 'Product', array () ) );
			$this->loadModelNew ( "Catproduct" );
			$this->set ( 'cat', $this->Catproduct->find ( 'all', array (
					'conditions' => array (
							'Catproduct.status' => 1
					)
			) ) );
			$this->set ( 'catcon', $this->Catproduct->find ( 'all', array (
					'conditions' => array (
							'Catproduct.status' => 1
					)
			) ) );
		}// END 
		
		if (($keyword != "") && ($list_cat == "")) {
			// ['Product.title LIKE']='%'.$keyword.'%';
			$this->loadModelNew( "Product" );
			$this->paginate = array (
					'conditions' => array (
							'Product.title LIKE' => '%' . $keyword . '%' 
					),
					'limit' => '15',
					'order' => 'Product.id DESC' 
			);
			$this->set ( 'product', $this->paginate ( 'Product', array () ) );
		}
		
		if (($keyword == "") && ($list_cat != "")) {
			$this->loadModelNew( "Catproduct" );
			$portfolio = $this->Catproduct->find ( 'list', array (
					'conditions' => array (
							'Catproduct.parent_id' => $list_cat 
					),
					'fields' => array (
							'Catproduct.id' 
					) 
			) );
			if ($portfolio != null) {
				$this->loadModelNew ( "Product" );
				$this->paginate = array (
						'conditions' => array (
								'Product.catproduct_id' => $portfolio 
						),
						'limit' => '15',
						'order' => 'Product.id DESC' 
				);
				$this->set ( 'product', $this->paginate ( 'Product', array () ) );
			} else {
				$this->loadModelNew ( "Product" );
				$this->paginate = array (
						'conditions' => array (
								'Product.catproduct_id' => $list_cat 
						),
						'limit' => '15',
						'order' => 'Product.id DESC' 
				);
				$this->set ( 'product', $this->paginate ( 'Product', array () ) );
			}
		}
		if (($keyword != "") && ($list_cat != "")) {
			$this->loadModelNew ( "Catproduct" );
			$portfolio = $this->Catproduct->find ( 'list', array (
					'conditions' => array (
							'Catproduct.parent_id' => $list_cat 
					),
					'fields' => array (
							'Catproduct.id' 
					) 
			) );
			if ($portfolio != null) {
				$this->loadModelNew ( "Product" );
				$this->paginate = array (
						'conditions' => array (
								'Product.title LIKE' => '%' . $keyword . '%',
								'Product.catproduct_id' => $portfolio 
						),
						'limit' => '15',
						'order' => 'Product.id DESC' 
				);
				$this->set ( 'product', $this->paginate ( 'Product', array () ) );
			} else {
				$this->loadModelNew ( "Product" );
				$this->paginate = array (
						'conditions' => array (
								'Product.title LIKE' => '%' . $keyword . '%',
								'Product.catproduct_id' => $list_cat 
						),
						'limit' => '15',
						'order' => 'Product.id DESC' 
				);
				$this->set ( 'product', $this->paginate ( 'Product', array () ) );
			}
		}
		$this->loadModelNew( "Catproduct" );
		$this->set ( 'cat', $this->Catproduct->find ( 'all', array (
				'conditions' => array (
						'Catproduct.status' => 1 
				) 
		) ) );
		$this->loadModelNew( "Catproduct" );
		$this->set ( 'catcon', $this->Catproduct->find ( 'all', array (
				'conditions' => array (
						'Catproduct.status' => 1 
				) 
		) ) );
		
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
	// sua tin da dang
	function edit($id = null) {
		$this->account ();
		$this->loadModelNew ( "Product" );
		if (! $id && empty ( $this->data )) {
			$this->Session->setFlash ( __ ( 'Không tồn tại ', true ) );
			$this->redirect ( array (
					'action' => 'index' 
			) );
		}
		if (! empty ( $this->data )) {
			//pr($this->data ['Product']);//die;
			$data ['Product'] = $this->data ['Product'];
			$data ['Product'] ['images'] = $_POST ['userfile'];
			
			//pr($data ['Product']);die;
			$this->loadModelNew ( "Product" );
			if ($this->Product->save ( $data ['Product'] )) {
				$this->Session->setFlash ( __ ( 'Bài viết sửa thành công', true ) );
				$this->redirect ( array (
						'action' => 'index' 
				) );
			} else {
				$this->Session->setFlash ( __ ( 'Bài viết này không sửa được vui lòng thử lại.', true ) );
			}
		}
		if (empty ( $this->data )) {
			$this->data = $this->Product->read ( null, $id );
		}
		$this->loadModelNew( "Catproduct" );
		$list_cat = $this->Catproduct->generatetreelist ( null, null, null, " _ " );
		$this->set ( compact ( 'list_cat' ) );
		$this->loadModelNew( "Manufacturer" );
		$list_cat1 = $this->Manufacturer->generatetreelist ( null, null, null, " _ " );
		$this->set ( compact ( 'list_cat1' ) );
		$this->set ( 'edit', $this->Product->findById ( $id ) );
		$gia = array (
				'0' => '0 đến 1 triệu',
				'1' => '1 đến 2 triệu',
				'2' => '2 đến 3 triệu',
				'4' => '3 đến 4 triệu',
				'5' => '4 đến 5 triệu',
				'6' => '5 đến 6 triệu',
				'7' => '6 đến 7 triệu',
				'8' => '7 đến 8 triệu',
				'9' => '8 đến 9 triệu',
				'10' => 'Trên 10 triệu' 
		);
		$this->set ( compact ( 'gia' ) );
		
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
		$this->account ();
		$this->loadModelNew( "Product" );
		if (isset ( $_POST ['dropdown'] ))
			$select = $_POST ['dropdown'];
		
		if (isset ( $_POST ['checkall'] )) {
			
			switch ($select) {
				case 'active' :
					$product = ($this->Product->find ( 'all' ));
					foreach ( $product as $product ) {
						$product ['Product'] ['status'] = 1;
						$this->Product->save ( $product ['Product'] );
					}
					// vong lap active
					break;
				case 'notactive' :
					// vong lap huy
					$product = ($this->Product->find ( 'all' ));
					foreach ( $product as $product ) {
						$product ['Product'] ['status'] = 0;
						$this->Product->save ( $product ['Product'] );
					}
					break;
				case 'delete' :
					$product = ($this->Product->find ( 'all' ));
					foreach ( $product as $product ) {
						$this->News->delete ( $product ['Product'] ['id'] );
					}
					if ($this->Product->find ( 'count' ) < 1)
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
					$product = ($this->Product->find ( 'all' ));
					foreach ( $product as $product ) {
						if (isset ( $_POST [$product ['Product'] ['id']] )) {
							$product ['Product'] ['status'] = 1;
							$this->Product->save ( $product ['Product'] );
						}
					}
					$this->redirect ( array (
							'action' => 'index' 
					) );
					// vong lap active
					break;
				case 'notactive' :
					// vong lap huy
					$product = ($this->Product->find ( 'all' ));
					foreach ( $product as $product ) {
						if (isset ( $_POST [$product ['Product'] ['id']] )) {
							$product ['Product'] ['status'] = 0;
							$this->Product->save ( $product ['Product'] );
						}
					}
					$this->redirect ( array (
							'action' => 'index' 
					) );
					break;
				case 'delete' :
					$product = ($this->Product->find ( 'all' ));
					foreach ( $product as $product ) {
						if (isset ( $_POST [$product ['Product'] ['id']] )) {
							$this->Product->delete ( $product ['Product'] ['id'] );
						}
					}
					$this->redirect ( array (
							'action' => 'index' 
					) );
					
					// vong lap xoa
					break;
			}
		}
		$this->redirect ( array (
				'action' => 'index' 
		) );
	}
	// Xoa cac dang
	function delete($id = null) {
		$this->account ();
		$this->loadModelNew ( "Product" );
		if (empty ( $id )) {
			$this->Session->setFlash ( __ ( 'Khôn tồn tại bài viết này', true ) );
			// $this->redirect(array('action'=>'index'));
		}
		if ($this->Product->delete ( $id )) {
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
		$this->loadModelNew( "Catproduct" );
		return $this->Catproduct->generatetreelist ( null, null, null, '__' );
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
}
?>
