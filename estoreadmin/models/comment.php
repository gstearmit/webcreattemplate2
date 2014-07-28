<?php
class Comment extends AppModel {
    var $name = 'Comment';
    var $displayField = 'name';
	var $useTable = 'estore_comments';
    var $actsAs = array('Tree');
}
?>
