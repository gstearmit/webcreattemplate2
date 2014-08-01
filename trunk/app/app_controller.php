<?php
class AppController extends Controller {
	var $helpers = array (
			'Html',
			'Form',
			'Session',
			'Text',
			'Js',
			'Time',
			'Javascript',
			'Help' 
	);
	var $_sessionUsername  = "Username";
	var $_sessionID = 'id';
	var $layout = false;
	var $uses = array('Config','Category','Banner','News','Video','Gallery'); // 'Group','Catnew','Factory','Level','Support','Introduce',
	
	
	function beforeFilter() {

		//$this->layout = 'home';
		//creattemplate
		//$this->layout = 'creattemplate';
		
		//ajax
		//$this->set('isAjax', $this->RequestHandler->isAjax());
// 		pr(DOCUMENT_ROOT);
// 		pr(GIANHANG);
// 		pr(realpath(dirname(__FILE__)));
// 		die;
		$urlTmp = $_SERVER['REQUEST_URI'];
		if (stripos($urlTmp, "?language")) {
			$urlTmp = explode("?", $urlTmp);
			$lang = explode("=", $urlTmp[1]);
			$lang = $lang[1];
			if (isset($lang)) {
				$this->Session->write('language', $lang);
			} else {
				$this->Session->delete('language');
			}
		}

		// set language
		if($this->Session->read('language') == 'vie' || $this->Session->read('language') == "") {
			Configure::write('Config.language', 'vie');
		} else {
			Configure::write('Config.language', $this->Session->read('language'));
		}
	
		
	}
	
	
	
	
	
	
	// function _setErrorLayout() {
	// if ($this->name == 'AppEror') {
	// $this->layout = 'error';
	// }
	// }
	
	// function beforeRender () {
	// $this->_setErrorLayout();
	// }
}

?>