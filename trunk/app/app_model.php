<?php
class AppModel extends Model {
  //var $locale;
	function setLanguage($locale) {
		$this->locale = $locale;
	}
// 	public function setDatabase($database, $datasource = 'default')
//     {
//       $nds = $datasource ;//. '_' . $database;      
//       $db  = &ConnectionManager::getDataSource($datasource);

//       $db->setConfig(array(
//         'name'       => $nds,
//         'database'   => $database,
//         'persistent' => false
//       ));

// 	  //return $db->config;die;
//       if ( $ds = ConnectionManager::create($nds, $db->config) ) {
//         $this->useDbConfig  = $nds;
//         $this->cacheQueries = false;
//         return true;
//       }

//       return false;
//     }
	
// 	public function setDatabaseTwoNew($database, $datasource = 'default')
// 	{
//             $db_config = ConnectionManager::getDataSource('default')->config;
             
//             $link = mysql_connect($db_config['host'], $db_config['login'], $db_config['password']);
//             mysql_select_db($db_config['database'], $link);
//             $res = mysql_query('SELECT * FROM ecosstore WHERE 1=1');
//             $row = mysql_fetch_assoc($res);
             
//             if(isset($row['hostname'])){
//                 $dbName = $row['database_name'];
// 				if( $database === $dbName )
// 				{
//                 $config = array();
//                 // Set correct database name
//                 $config['driver'] = 'mysql';
//                 $config['persistent'] = false;
//                 $config['hostname'] = $row['hostname'];
//                 $config['username'] = $row['username'];
//                 $config['password'] = $row['password'];
//                 $config['database'] = $dbName;
//                 $config['prefix'] = '';
                 
//                 // Add new config to registry
//                 ConnectionManager::create($dbName, $config);
//                 // Point model to new config
//                 $this->useDbConfig = $dbName;
// 				// return true;
// 				return $dbName;
// 				}
// 	       }
// 		   return false;	
//     }
}
