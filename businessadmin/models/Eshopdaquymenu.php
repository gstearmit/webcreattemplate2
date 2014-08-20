<?php
class Eshopdaquymenu extends AppModel {
    var $name = 'Eshopdaquymenu';
    var $displayField = 'name';
    var $actsAs = array('Tree');
	var $useTable = 'eshop_menus';
	var $belongsTo = array(
        'ParentCat' => array(
            'className' => 'Eshopdaquymenu',
            'foreignKey' => 'parent_id'
        )
    );
}
?>
