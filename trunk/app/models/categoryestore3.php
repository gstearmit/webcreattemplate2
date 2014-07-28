<?php
class Categoryestore3 extends AppModel {
    var $name = 'Categoryestore3';//ten cua mode bang contacts
	var $useTable = 'estore_categories';	
	var $hasMany = array(
		'Estore_product' => array(
		'className' => 'Estore_product',
		'foreignKey' => 'category_id',
		'conditions' => array('Estore_product.status' => '1'),
		'limit' => '4',
		'order' => 'Estore_product.created DESC',
		'dependent'=> true
		)
	); 
}
?>
