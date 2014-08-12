<?php
class AppModel extends Model {

	function setLanguage($locale) {
		$this->locale = $locale;
	}
   
	function setDataEshop($hostname,$username,$password,$databasename)
	{
		//++++++++++++++++++++++++++++++++++++++++
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
	
		if ( $name = ConnectionManager::getDataSource($databasename)) {
			$this->useDbConfig  = $databasename;
			$this->cacheQueries = false;
			return true;
		}
	
		return false;
	}
	
	
	public function setDatabase($database, $datasource = 'default')
	{
		$nds = $database;
		$db  = &ConnectionManager::getDataSource($datasource);
	
		$db->setConfig(array(
				'name'       => $nds,
				'database'   => $database,
				'persistent' => false
		));
	
		if ( $ds = ConnectionManager::create($nds, $db->config) ) {
			$this->useDbConfig  = $nds;
			$this->cacheQueries = false;
			return true;
		}
	
		return false;
	
		 
	}
}
