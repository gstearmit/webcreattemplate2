<?php
class Eshopdaquypoll extends AppModel {
    var $name = 'EshopdaquyPoll';
    var $displayField = 'name';
    var $useTable = 'eshop_polls';
	var $validate = array(
	'id' => array(
		'notempty' => array(
			'rule' => array('notempty'),
			//'message' => 'Your custom message here',
			//'allowEmpty' => false,
			//'required' => false,
			//'last' => false, // Stop validation after this rule
			//'on' => 'create', // Limit validation to 'create' or 'update' operations
		),
	),
	'name' => array(
		'notempty' => array(
			'rule' => array('notempty'),
			'message' => 'Xin vui lòng điển thông tin',
			'allowEmpty' => false,
			'required' => false,
			//'last' => false, // Stop validation after this rule
			//'on' => 'create', // Limit validation to 'create' or 'update' operations
		),
	),
	'composition' => array(
		'notempty' => array(
			'rule' => array('notempty'),
			'message' => 'Xin vui lòng điển thông tin',
			'allowEmpty' => false,
			'required' => false,
			//'last' => false, // Stop validation after this rule
			//'on' => 'create', // Limit validation to 'create' or 'update' operations
		),
	),
	 );
	
}
?>
