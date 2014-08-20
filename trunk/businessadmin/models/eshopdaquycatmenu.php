<?php
class Eshopdaquycatmenu extends AppModel {
    var $name = 'Eshopdaquycatmenu';
    var $displayField = 'name';
    var $actsAs = array('Tree');
	//var $useTable = 'eshop_bgmenus';
	var $belongsTo = array(
        'ParentCat' => array(
            'className' => 'Eshopdaquycatmenu',
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
        'Eshopdaquymenu' =>
        array('className' => 'Eshopdaquymenu',
                         'conditions'    => array('Eshopdaquymenu.status'=>1),
                         'order'         => '',
                         'limit'         => '',
                         'foreignKey'    => 'menu_id',
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
