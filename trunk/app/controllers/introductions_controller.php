<?php
class IntroductionsController extends AppController {

	var $name = 'Introductions';
	var $uses=array('Setting');
	function index() {
    mysql_query("SET names utf8");
		$this->set('about',$this->Setting->find('all',array('conditions'=>array(),'order'=>'Setting.id DESC','limit'=>1)));
	}
}
?>
