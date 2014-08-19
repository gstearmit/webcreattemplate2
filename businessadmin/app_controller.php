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
	
	function diachi(){
		$adr = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https://' : 'http://';
		$adr .= isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : getenv('HTTP_HOST');
		$adr .= isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : getenv('REQUEST_URI');
		return $adr;
	}
   
}

?>