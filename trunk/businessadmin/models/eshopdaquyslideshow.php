<?php
class Eshopdaquyslideshow extends AppModel {
    var $name = 'Eshopdaquyslideshow';
    var $displayField = 'name';
	var $useTable = 'eshop_slideshows';
   	var $validate = array(
		'id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Xin vui lòng điển thông tin',
				'allowEmpty' => false,
				'required' => false,
			),
		),
		'images' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Xin vui lòng điển thông tin',
				'allowEmpty' => false,
				'required' => false,
			),
		),
	);
	
}
?>
