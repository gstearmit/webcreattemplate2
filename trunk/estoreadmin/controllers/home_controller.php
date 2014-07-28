<?php
class HomeController extends AppController {

	var $name = 'Home';
	
	var $helpers = array('Html','Ajax', 'Form', 'Javascript', 'TvFck');
	var $uses=array('Estore_user');
	function index() {
		  $this->account();
		 
	}
	//Them bai viet
	
	function account(){
		if(!$this->Session->read("id") || !$this->Session->read("name")){
			$this->redirect('/');
		}
	}
	// chon layout
	function beforeFilter(){
		$this->layout='admin';
	}

}
?>
