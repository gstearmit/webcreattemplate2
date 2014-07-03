<?php
class PartnersController extends AppController {

	var $name = 'Partners';
	function index() {
		  $this->paginate = array('limit' => '15','order' => 'Partner.id DESC');
	      $this->set('Partners', $this->paginate('Partner',array()));

	}
	

}
?>
