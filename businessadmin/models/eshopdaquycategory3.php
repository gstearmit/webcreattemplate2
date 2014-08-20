<?php
class Eshopdaquycategory3 extends AppModel {
    var $name = 'Eshopdaquycategory3';
	var $displayField = 'name';
	var $useTable = 'eshop_categories';	
	
	// 1 sản phẩm quan hệ nhiều - một với danh mục san phẩm
	var $hasMany = array(
		'Eshopdaquyproduct' => array(
		'className' => 'Eshopdaquyproduct',
		'foreignKey' => 'category_id',
		'conditions' => array('Eshopdaquyproduct.status' => '1'),
		'limit' => '4',
		'order' => 'Eshopdaquyproduct.created DESC',
		'dependent'=> true
		)
	); 
}
?>
