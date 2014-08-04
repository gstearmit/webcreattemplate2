<?php
class Catnote extends AppModel {
    var $name = 'Catnote';
    var $displayField = 'name';
    var $actsAs = array('Tree');
	var $belongsTo = array(
        'ParentCat' => array(
            'className' => 'Catnote',
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
        'Product' =>
        array('className' => 'Product',
                         'conditions'    => array('Product.status'=>1),
                         'order'         => '',
                         'limit'         => '',
                         'foreignKey'    => 'catproduct_id',
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
