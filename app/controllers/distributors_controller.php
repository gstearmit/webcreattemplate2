<?php
class DistributorsController extends AppController {

	var $name = 'Distributors';
	function index() {
		  $this->paginate = array('limit' => '15','order' => 'Distributor.id DESC');
	      $this->set('distributors', $this->paginate('Distributor',array()));
	}
	

}
?>
