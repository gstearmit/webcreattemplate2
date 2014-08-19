<?php
class EshopdaquycatPollVote extends AppModel {
        var $name = 'EshopdaquycatPollVote';
        var $useTable = 'eshop_polls';
        var $belongsTo = array(
                'EshopdaquycatPoll' => array(
                        'className' => 'EshopdaquycatPoll',
                        'foreignKey' => 'poll_id'
                )
        );
}
?>
