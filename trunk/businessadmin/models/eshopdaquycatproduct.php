<?php
class Eshopdaquycatproduct extends AppModel {
    var $name = 'Eshopdaquycatproduct';
    var $displayField = 'name';
    var $actsAs = array('Tree');
	var $useTable = 'eshop_catproducts';
	
	var $belongsTo = array(
        'ParentCatNew' => array(
            'className' => 'Eshopdaquycatproduct',
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
	// product- quan hệ n -1 voi catproduct
	var $hasMany = array(
        'Eshopdaquyproduct' =>
        array('className' => 'Eshopdaquyproduct',
                         'conditions'    => array('Eshopdaquyproduct.status'=>1),
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
