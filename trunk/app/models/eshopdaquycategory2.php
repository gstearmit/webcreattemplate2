<?php
class Eshopdaquycategory2 extends AppModel {
    var $name = 'Eshopdaquycategory2';
	var $displayField = 'name';
    var $useTable = 'eshop_categories';
	//eshop_banners
	var $hasMany = array(
		'Eshopdaquyproduct' => array(
		'className' => 'Eshopdaquyproduct',
		'foreignKey' => 'category_id',
		'conditions' => array('Eshopdaquyproduct.status' => '1','Eshopdaquyproduct.rank' => '1'),
		'limit' => '8',
		'order' => 'Eshopdaquyproduct.created DESC',
		'dependent'=> true
		)
	); 
}
?>
