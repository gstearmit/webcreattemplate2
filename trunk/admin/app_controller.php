<?php

class AppController extends Controller {
 public $helpers = array(
	'Html',
	'Form',
	'Session',
	'Text',
	'Js',
	'Time',	
	'Javascript'	
    );
 function beforeFilter() {
 
 	$urlTmp = $_SERVER['REQUEST_URI'];
 	if (stripos($urlTmp, "?languages")) {
 		$urlTmp = explode("?", $urlTmp);
 		$lang = explode("=", $urlTmp[1]);
 		$lang = $lang[1];
 		if (isset($lang)) {
 			$this->Session->write('languages', $lang);
 		} else {
 			$this->Session->delete('languages');
 		}
 		
 	}
 
 	// set language
 	if($this->Session->read('languages') == 'vie' || $this->Session->read('languages') == "") {
 		Configure::write('Config.languages', 'vie');
 	} else {
 		Configure::write('Config.languages', $this->Session->read('languages'));
 	}
 
 
    }
 var $_sessionUsername  = "Username";
 var $_sessionID = 'id';
 var $layout = false;
// var $uses = array('Config','Category','Banner','News','Video','Gallery'); // 'Group','Catnew','Factory','Level','Support','Introduce',
 
 
//  function beforeFilter() {
 	
//  //	die("controllller");
 	
//  	$this->layout = 'admin';
// 	$urlTmp = $_SERVER['REQUEST_URI'];
	
// 	pr($urlTmp);die;
	
//  	if (stripos($urlTmp, "?language")) {
//  		$urlTmp = explode("?", $urlTmp);
//  		$lang = explode("=", $urlTmp[1]);
//  		$lang = $lang[1];
//  		if (isset($lang)) {
//  			$this->Session->write('language', $lang);
//  		} else {
//  			$this->Session->delete('language');
//  		}
//  	}
 
//  	// set language
//  	if($this->Session->read('language') == 'vie' || $this->Session->read('language') == "") {
//  		Configure::write('Config.language', 'vie');
//  	} else {
//  		Configure::write('Config.language', $this->Session->read('language'));
//  	}
 
 
//  }
 
 
}

?>