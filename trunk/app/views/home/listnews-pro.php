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


$shop = explode ( '/', $this->params ['url'] ['url'] );
$shopname = $shop [0];
$shoparr = $this->get_shop_id ( $shopname );
//pr($shoparr);//die;
	
// 							//++++++++++Connect  data +++++++++++++++++
// 							foreach($shoparr as $shop){
// 								$databasename = $shop['Shop']['databasename'];
// 								$password = $shop['Shop']['password'];
// 								$username = $shop['Shop']['username'];
// 								$hostname = $shop['Shop']['hostname'];

// 							}
// 							$db = new ConnectionManager;
// 							$config = array(
// 									//'className' => 'Cake\Database\Connection',
// 									'driver' => 'mysql',
// 									'persistent' => false,
// 									'host' =>$hostname,
// 									'login' =>$username,
// 									'password' =>$password,
// 									'database' =>$databasename,
// 									'prefix' => false,
// 									'encoding' => 'utf8',
// 									'timezone' => 'UTC',
// 									'cacheMetadata' => true
// 							);
// 							$db->create($databasename,$config);
// 							$shop_id = "9999";
// 							$sql= "INSERT INTO `estore_videos` (`estore_id`, `name`, `video`, `LinkUrl`, `created`, `status`, `left`, `right`) VALUES
// 									($shop_id, 'Gala trong ngay', 'video/upload/c67b28f317fe8740ada0a80316a0559c.flv', 'http://www.youtube.com/watch?v=5z7DEE70dEs&feature=related', '2011-10-02 18:51:33', 1, 0, 0),
// 									($shop_id, 'Clip gala Bên phải', 'video/upload/64c23f4052d6626521caef72b1bc067f.flv', 'http://www.youtube.com/watch?v=76ZqkGxe_Mc&feature=g-vrec', '2012-06-14 14:46:38', 1, 1, 0);";
	
// 							$name = ConnectionManager::getDataSource($databasename);
// 							pr($name->config);die;
// 							$resul = $name->rawQuery($sql);

	
// 							pr($resul);
// 							die;
	
// 							pr($name);
// 							echo "99999999999999999</br>";
// 							pr($name->config);
// 							echo "defaulll</br>";
// 							pr($dbdefault->config);
// 							$dbdefault->rawQuery($sql);
// 							die;

	
/*
 require_once 'app/Config/database.php';
 $database = new DATABASE_CONFIG;
 try{
 $dblink = new PDO('mysql:host='.$database->default['host'].';dbname='.$database->default['database'], $database->default['login'],  $database->default['password'], array(PDO::ATTR_PERSISTENT => false));
 $dblink->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $dblink->exec('SET CHARACTER SET '.$database->default['encoding']);
 } catch (Exception $e) {
 die('DB Error'. $e->getMessage());
 }
 pr($database->default['host']);
 die;

 	
 foreach ( $shoparr as $key => $value ) {
 $shop_id = $key;
 }
 */