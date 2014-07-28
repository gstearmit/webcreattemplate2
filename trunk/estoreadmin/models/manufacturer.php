<?php
class Manufacturer extends AppModel {
    var $name = 'Manufacturer';
	var $useTable = 'estore_manufacturers';
    var $displayField = 'name';
    var $actsAs = array('Tree');
	var $belongsTo = array(
        'ParentCats' => array(
            'className' => 'Manufacturer',
            'foreignKey' => 'parent_id'
        )
    );
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
	);
	var $hasMany = array(
        'Estore_product' =>
        array('className' => 'Estore_product',
                         'conditions'    => array('Estore_product.status'=>1),
                         'order'         => '',
                         'limit'         => '',
                         'foreignKey'    => 'manufacturer',
                         'dependent'     => true,
                         'exclusive'     => false,
                         'finderQuery'   => '',
                         'fields'        => '',
                         'offset'        => '',
                         'counterQuery'  => ''
    )
	);
	
}
?>
