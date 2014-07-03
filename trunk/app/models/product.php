<?php
class Product extends AppModel {
    var $name = 'Product';
    var $displayField = 'name';
    var $actsAs = array('Tree');
	
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
		'title' => array(
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
    // luu nhiêu hình ảnh
    // thừa chỗ này thì phải : Gallery : là silde ảnh chạy
    // ko có băng banof tên như này luôn
	var $hasMany = array(
        'Gallery' =>
        array('className' => 'Gallery',
                         'conditions'    => array('Gallery.status'=>1),
                         'order'         => '',
                         'limit'         => '',
                         'foreignKey'    => 'product_id', //  ko có thuoc tinh này
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
