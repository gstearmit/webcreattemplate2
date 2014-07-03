<?php
class AlbumsController extends AppController {

    var $name = 'Albums';

    var $helpers = array('Html','Ajax', 'Form', 'Javascript', 'TvFck');
    var $uses=array('Albums','Catalbums','Catproduct');


    function index($id=null) {
        mysql_query("SET names utf8");
        if($id==null){
            $a=array();
            $a[0]['Catalbums']['name']='Danh mục album';
            $this->set('null',$a);
            $this->set('Catalbums',$this->Catalbums->find('all',array('conditions'=>array('Catalbums.status'=>1,'Catalbums.parentId'=>null))));
            $this->set('danhmuc',0);
        }else{
            $this->set('null',$this->Catalbums->find('all',array('conditions'=>array('Catalbums.status'=>1,'Catalbums.id'=>$id))));
            $this->set('Catalbums',$this->Catalbums->find('all',array('conditions'=>array('Catalbums.status'=>1,'Catalbums.parentId'=>$id))));
            $this->set('danhmuc',1);
        }
    }


    function view($id=null) {
        mysql_query("SET names utf8");
        if (!$id) {
            $this->Session->setFlash(__('Không tồn tại', true));
            $this->redirect(array('action' => 'index'));
        }
        $a= $this->Albums->find('all',array('conditions'=>array('Albums.status'=>1,'Albums.parentId'=>$id)));
        //pr($a);die;
        $this->set('views', $a);
    }
}
?>
