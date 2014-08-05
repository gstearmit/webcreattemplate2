<?php
class Notes extends AppModel {
    var $name = 'Notes';
    var $displayField = 'name';
    var $useTable = 'notes';
    /*
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
				'message' => 'Xin vui lÃ²ng Ä‘iá»ƒn thÃ´ng tin',
				'allowEmpty' => false,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'content' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Xin vui lÃ²ng Ä‘iá»ƒn thÃ´ng tin',
				'allowEmpty' => false,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'category_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Xin vui lÃ²ng chá»�n danh má»¥c',
				'allowEmpty' => false,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	 var $belongsTo = array( 
					'Category' => array(
							'className'     => 'Category', 
							'foreignKey'    => 'category_id' 				 
												 
					)				
			); 
			*/
}
?>
