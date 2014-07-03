<?php
class Categorynewsshop extends AppModel {
    var $name = 'Categorynewsshop';
    var $displayField = 'name';
    var $actsAs = array('Tree');
	var $belongsTo = array(
        'ParentCat' => array(
            'className' => 'Categorynewsshop',
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
        'Newshop' =>
        array('className' => 'Newshop',
                         'conditions'    => array('Newshop.status'=>1),
                         'order'         => '',
                         'limit'         => '',
                         'foreignKey'    => 'Categorynewsshop_id',
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
