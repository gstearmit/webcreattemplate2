<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
class AppModel extends Model {

	function setLanguage($locale) {
		$this->locale = $locale;
	}
	public function setDatabase($database, $datasource = 'default')
    {
      $nds = $datasource ;//. '_' . $database;      
      $db  = &ConnectionManager::getDataSource($datasource);

      $db->setConfig(array(
        'name'       => $nds,
        'database'   => $database,
        'persistent' => false
      ));

	  //return $db->config;die;
      if ( $ds = ConnectionManager::create($nds, $db->config) ) {
        $this->useDbConfig  = $nds;
        $this->cacheQueries = false;
        return true;
      }

      return false;
    }
	
	public function setDatabaseTwoNew($database, $datasource = 'default')
	{
            $db_config = ConnectionManager::getDataSource('default')->config;
             
            $link = mysql_connect($db_config['host'], $db_config['login'], $db_config['password']);
            mysql_select_db($db_config['database'], $link);
            $res = mysql_query('SELECT * FROM ecosstore WHERE 1=1');
            $row = mysql_fetch_assoc($res);
             
            if(isset($row['hostname'])){
                $dbName = $row['database_name'];
				if( $database === $dbName )
				{
                $config = array();
                // Set correct database name
                $config['driver'] = 'mysql';
                $config['persistent'] = false;
                $config['hostname'] = $row['hostname'];
                $config['username'] = $row['username'];
                $config['password'] = $row['password'];
                $config['database'] = $dbName;
                $config['prefix'] = '';
                 
                // Add new config to registry
                ConnectionManager::create($dbName, $config);
                // Point model to new config
                $this->useDbConfig = $dbName;
				// return true;
				return $dbName;
				}
	       }
		   return false;	
    }
}
