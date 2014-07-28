<?php
class Comments extends AppModel {
    var $name = 'Comments';
    var $displayField = 'name';
	var $useTable = 'estore_comments';
    var $actsAs = array('Tree');
}
?>
