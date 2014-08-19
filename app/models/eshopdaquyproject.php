<?php
class Eshopdaquyproject extends AppModel {
    var $name = 'Eshopdaquyproject';
    var $displayField = 'name';
	var $useTable = 'eshop_project';
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
				'category_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Xin vui lòng chọn danh mục',
				'allowEmpty' => false,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	 var $belongsTo = array( 
					'Eshopdaquycategory' => array(
							'className'     => 'Eshopdaquycategory', 
							'foreignKey'    => 'category_id' 				 
												 
					)				
			); 
}
?>
