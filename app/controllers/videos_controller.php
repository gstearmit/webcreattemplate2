<?php
class VideosController extends AppController {

    var $name = 'Video';
    var $uses =array('Video');
    //var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');

    var $components = array('Global','Email','SmtpEmail','Upload');
    function index() {
        $this->paginate=array('conditions'=>array('Video.status'=>1),'limit'=>7);
        $this->set('video',$this->paginate('Video',array()));
    }
}