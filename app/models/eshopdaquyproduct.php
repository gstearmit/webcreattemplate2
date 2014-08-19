<?php
class Eshopdaquyproduct extends AppModel {
    var $name = 'Eshopdaquyproduct';
    var $displayField = 'name';
	var $useTable = 'eshop_products';
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
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Xin vui lòng điền thông tin',
				'allowEmpty' => false,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
		'catproduct_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Xin vui lòng điền thông tin',
				'allowEmpty' => false,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
	
	 var $belongsTo = array( 
					'Eshopdaquycatproduct' => array(
							'className'     => 'Eshopdaquycatproduct', 
							'foreignKey'    => 'catproduct_id' 				 
												 
					)				
			); 
}
?>
