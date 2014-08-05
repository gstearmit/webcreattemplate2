<?php
class Catproduct extends AppModel {
    var $name = 'Catproduct';
    var $displayField = 'name';
      var $actsAs = array('Translate' => array('name'=>'nameTranslation'),'Tree',
						'Sluggable' => array(					 
							'label' => 'name',
							'scope' => false,
							'conditions' => false,
							'slugfield' => 'slug',
							'separator' => '-',
							'overwrite' => false,
							'length' => 256,
							'translation' => 'utf-8',
							'lower' => true)
							
						);

	var $belongsTo = array(
        'ParentCat' => array(
            'className' => 'Catproduct',
            'foreignKey' => 'parent_id'
        )
    );
    
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
		'name' => array(
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
    
    
    // 1 danh muc thì có nhiều sản phẩm  . Nên Quan Hệ cửa nó là hasMany
	var $hasMany = array(
        'Product' =>
        array('className' => 'Product',
                         'conditions'    => array('Product.status'=>1),
                         'order'         => '',
                         'limit'         => '',
                         'foreignKey'    => 'catproduct_id',
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
