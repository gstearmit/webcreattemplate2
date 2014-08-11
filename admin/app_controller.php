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
}

?>