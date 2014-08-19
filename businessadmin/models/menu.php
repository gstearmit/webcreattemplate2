<?php
class Menu extends AppModel {
    var $name = 'Menu';
    var $displayField = 'name';
    var $actsAs = array('Tree');
	var $belongsTo = array(
        'ParentCat' => array(
            'className' => 'Menu',
            'foreignKey' => 'parent_id'
        )
    );
}
?>
