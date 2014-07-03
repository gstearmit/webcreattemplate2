<?php
class PollsController extends AppController {

	var $name = 'Polls';
	var $uses=array('Poll');


	function index() {
		$this->paginate = array('conditions'=>array('Poll.status'=>1),'limit' => '9','order' => 'Poll.id DESC');	   
		$this->set('polls', $this->paginate('Poll',array()));
		$poll= $this->Poll->find('all',array('Poll.status'=>1));
		 $count=0;
		 for($i=0;$i<count($poll);$i++)
		 {
			 $count = $count + $poll[$i]['Poll']['count'];
		 }
		 $this->set('count',$count);
	

	}

}
?>