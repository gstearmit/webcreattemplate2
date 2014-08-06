<?php
function listnews($id=null) {
	//layout
    $this->layout = 'themeshop/estorecreatnanedata';
	$this->set ( 'title_for_layout', 'e-shop' );
		
	$nameeshop = $this->shopname;
	$shoparr = $this->Shop->find ( 'all', array (
			'conditions' => array (
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
					'Shop.ipserver'
			)
	) );
		
	//++++++++++Connect  data +++++++++++++++++
	foreach($shoparr as $shop){
		$databasename = $shop['Shop']['databasename'];
		$password = $shop['Shop']['password'];
		$username = $shop['Shop']['username'];
		$hostname = $shop['Shop']['hostname'];
		$shop_id = $shop['Shop']['id'];
			
	}
		
	$this->Estore_news->setDataEshop($hostname,$username,$password,$databasename);
		
	//$Estoreshopnews = $this->Estore_news->find('all');
	//pr($Estoreshopnews);
		
	mysql_query("SET names utf8");
	$this->paginate = array (
			'conditions' => array (
					'Estore_news.status' => 1,
					'Estore_news.category_id' => $id
			),
			'limit' => '10',
			'order' => 'Estore_news.id DESC'
	);

	$this->set('listnews', $this->paginate('Estore_news',array()));
		
	$this->Estorecategories->setDataEshop($hostname,$username,$password,$databasename);
	$this->set('cat',$this->Estorecategories->read(null,$id));
}



//--------------------------------------------------
function danhmuc($shopname) {
		
	$shoparr = $this->Shop->find ( 'all', array (
			'conditions' => array (
					'Shop.name' => $shopname,
					'Shop.status' => 1
			),
			'fields' => array (
					'Shop.id',
					'Shop.created',
					'Shop.databasename',
					'Shop.username',
					'Shop.password',
					'Shop.hostname',
					'Shop.ipserver'
			)
	) );

	//++++++++++Connect  data +++++++++++++++++
	foreach($shoparr as $shop){
		$databasename = $shop['Shop']['databasename'];
		$password = $shop['Shop']['password'];
		$username = $shop['Shop']['username'];
		$hostname = $shop['Shop']['hostname'];
		$shop_id = $shop['Shop']['id'];
			
	}
	$db = new ConnectionManager;
	$config = array(
			//'className' => 'Cake\Database\Connection',
			'driver' => 'mysql',
			'persistent' => false,
			'host' =>$hostname,
			'login' =>$username,
			'password' =>$password,
			'database' =>$databasename,
			'prefix' => false,
			'encoding' => 'utf8',
			'timezone' => 'UTC',
			'cacheMetadata' => true
	);
	$db->create($databasename,$config);
	$name = ConnectionManager::getDataSource($databasename);
	// 							                                    echo "99999999</br>";
	// 							                                    pr($name->config);die;
	$sql = "SELECT estore_catproducts.*
									 FROM  estore_catproducts
									 WHERE estore_catproducts.parent_id= 11 AND estore_catproducts.estore_id =".(int)$shop_id." ORDER BY  estore_catproducts.name ASC ";
	//$resul = $name->rawQuery($sql);
	$resul = $name->fetchAll($sql);
		
	//pr($resul);
	return $resul;
		
}