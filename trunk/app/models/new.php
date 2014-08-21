<?php
class News extends AppModel {
    var $name = 'News';
    var $displayField = 'name';
	var $useTable = 'news';
	var $belongsTo = array( 
					'Category' => array(
							'className'     => 'Category', 
							'foreignKey'    => 'category_id' 				 
												 
					)				
			); 
	
	
}
?>
