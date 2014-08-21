<?php
class Slideshow extends AppModel {
    var $name = 'Slideshow';
    var $displayField = 'name';
	var $useTable = 'slideshows';
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
