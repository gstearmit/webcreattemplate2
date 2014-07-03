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
		
// 		// mysql_query("SET names utf8");
// 		$s_id = session_id ();
// 		$this->layout = 'home';
// 		if (isset ( $_GET ['lang'] )) {
// 			if ($_GET ['lang'] == "eng") {
// 				$this->Session->write ( 'lang', 2 );
// 			} else {
// 				$this->Session->write ( 'lang', 1 );
// 			}
// 		} else {
// 			if ($this->Session->read ( 'lang' )) {
// 				$this->Session->write ( 'lang', $this->Session->read ( 'lang' ) );
// 			} else {
// 				$this->Session->write ( 'lang', 1 );
// 			}
// 		}

		
		
		
		//$this->layout = 'home';
		//creattemplate
		$this->layout = 'creattemplate';
		
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
	
	
	
	function _checkLanguage()
	{
		if(!$this->Session->check('Config.language') || $this->name == "Switchto")
		{
				
			$supported_lang = Configure::read('LANGUAGE.supported');
			$default_lang   = Configure::read('LANGUAGE.default');
			$lang = null;
			if($this->name == "Switchto")
				$lang = $this->action;
	
				
	
	
			// we need the Cookie
			App::Import('Component', 'Cookie');
			$cookie = & new CookieComponent;
			$cookie->domain = '';
			$cookie->name   = 'MYAPP';
			$cookie->time   = '+360 days';
			$cookie->key    = 'whatever-key-you-wish';
			$cookie->startup();
	
			// and L10n object
			if(!class_exists("L10n"))
				uses('l10n');
	
			$l10n = & new L10n();
	
			if(!$lang || !in_array($lang, $supported_lang))
			{
				if($cookie->read('tutolanguage.lang') )
				{
					$lang = $cookie->read('tutolang/lang');
					if(!in_array($lang, $supported_lang))
						$lang = null;
				}
				/* try to find a language from browser that we support */
				if(!$lang)
				{
					$browserLang = split ('[,;]', env('HTTP_ACCEPT_LANGUAGE'));
					foreach($browserLang as $langKey )
					{
						if(isset($l10n->__l10nCatalog[$langKey]) &&
						in_array($l10n->__l10nCatalog[$langKey]['locale'], $supported_lang) )
						{
							$lang = $l10n->__l10nCatalog[$langKey]['locale'];
							break;
						}
					}
				}
			}
	
			// still no language, get first supported
	
			if(!$lang)
				$lang = $default_lang;
	
			// set the language, and write in cookie
	
			$l10n->__setLanguage($lang);
			$cookie->write(array('tutolanguage.lang' => $lang));
			$this->Session->write('Config.language',$lang);
				
			if($this->name == "Switchto")
				return true;
		}
	
		return false;
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