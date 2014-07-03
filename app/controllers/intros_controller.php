<?php //die;
class IntrosController extends AppController {

    var $name = 'Intro';
    var $helpers = array('Html','Ajax', 'Form', 'Javascript', 'TvFck');
    var $uses=array('Slideshow','News','Category','Catproduct');
    function index() {

        $a = $this->Slideshow->find('all');
        $this->set('slideshows',$a);


        $a = $this->Category->find('all',array('conditions'=>array('Category.id'=> 228)));
        $this->set('gioithieu',$a);

        $a = $this->Category->find('all',array('conditions'=>array('Category.id'=> 229)));
        $this->set('khuyenmai',$a);

        $a = $this->Category->find('all',array('conditions'=>array('Category.id'=> 230)));
        $this->set('lienhe',$a);
    }
    //Them bai viet


    // chon layout
    function beforeFilter(){
        $this->layout='index';
    }

}
?>
