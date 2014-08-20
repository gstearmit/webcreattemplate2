<?php
class Eshopdaquynew extends AppModel {
    var $name = 'Eshopdaquynew';
    var $displayField = 'name';
	var $useTable = 'eshop_news';
	var $belongsTo = array( 
					'Eshopdaquycategory' => array(
							'className'     => 'Eshopdaquycategory', 
							'foreignKey'    => 'category_id' 				 
												 
					)				
			); 
	
	
}
?>
