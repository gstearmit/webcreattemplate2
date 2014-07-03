<?php
class Product extends AppModel {
    var $name = 'Product';
    var $displayField = 'name';
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
		'content' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Xin vui lòng điền thông tin',
				'allowEmpty' => false,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
			'content_1' => array(
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
					'Catproduct' => array(
							'className'     => 'Catproduct', 
							'foreignKey'    => 'catproduct_id' 				 
												 
					)	,
	 		'City' => array(
	 				'className'     => 'City',
	 				'foreignKey'    => 'city_id'
	 					
	 		)
	 					
			); 
	 
	 
}
?>
