<?php
class Hienmenus extends AppModel {
	var $name = 'Hienmenu';
	var $displayField = 'title';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'catproduct' => array(
			'className' => 'catproduct',
			'foreignKey' => 'catproduct_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>