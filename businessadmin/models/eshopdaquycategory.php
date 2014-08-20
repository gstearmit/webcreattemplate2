<?php
class Eshopdaquycategory extends AppModel {
    var $name = 'Eshopdaquycategory';
    var $displayField = 'name';
    var $actsAs = array('Tree');
	var $useTable = 'eshop_categories';
	/*
	var $belongsTo = array(
        'ParentCat' => array(
            'className' => 'Eshopdaquycategory',
            'foreignKey' => 'parent_id'
        )
    );
	
	
	var $hasMany = array(
        'Eshopdaquycategory' =>
        array('className' => 'Eshopdaquycategory',
                         'conditions'    => array('Eshopdaquycategory.status'=>1),
                         'order'         => '',
                         'limit'         => '',
                         'foreignKey'    => 'category_id',
                         'dependent'     => true,
                         'exclusive'     => false,
                         'finderQuery'   => '',
                         'fields'        => '',
                         'offset'        => '',
                         'counterQuery'  => ''
    )
	);
	*/
}
?>
