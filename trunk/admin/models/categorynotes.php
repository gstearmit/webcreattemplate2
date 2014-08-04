<?php
class Categorynotesshop extends AppModel {
    var $name = 'Categorynotes';
    var $displayField = 'name';
    var $actsAs = array('Tree');
	var $belongsTo = array(
        'ParentCat' => array(
            'className' => 'Categorynotes',
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
        'Note' =>
        array('className' => 'Note',
                         'conditions'    => array('Note.status'=>1),
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
