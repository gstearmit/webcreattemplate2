<?php
class GioHangController extends AppController {

	var $name = 'GioHang';
	var $uses= array('GioHang','HoaDon','HoadonSanpham');
	function index() {
		$lang=$this->Session->read('lag');
		//pr($infomationall);die();
		$infomationall = $this->requestAction('/comment/infomationall');
		$this->set('keyword',$infomationall['0']['CongTy']['congty_keyword']);
		$this->set('desc',$infomationall['0']['CongTy']['congty_des']);
		$this->set('title_for_layout',$infomationall['0']['CongTy']['congty_title']);
		
		$ip=getenv("REMOTE_ADDR");
		$gio_hang=$this->GioHang->find('all',array('condition'=>array('GioHang.lang_id'=>$lang,'GioHang.giohang_ip'=>$ip)));
		if(count($gio_hang)==0){
			$this->redirect('/');
		}
		else {$this->set('gio_hang',$gio_hang);}
	}
	function delete($id) {
		$this->GioHang->delete($id);
		$this->Session->setFlash(__('Bạn Delete thành công', true));
			$name=$_SERVER['HTTP_REFERER'];
			$this->redirect($name);
		
	}
	function thanh_toan() {
		$lang=$this->Session->read('lag');
		$infomationall = $this->requestAction('/comment/infomationall');
		$this->set('keyword',$infomationall['0']['CongTy']['congty_keyword']);
		$this->set('desc',$infomationall['0']['CongTy']['congty_des']);
		$this->set('title_for_layout',$infomationall['0']['CongTy']['congty_title']);
		$ip=getenv("REMOTE_ADDR");
		if(!empty($_POST['add_sp']) && isset($_POST['add_sp'])){
			$giohang=array(
			'GioHang'=>array(
					'id'=>$_POST['id_sp'],
					'sp_sl'=>$_POST['sl']					
					)
			);
			if($this->GioHang->save($giohang)){
				$this->redirect('index');
			}
		}
		$gio_hang=$this->GioHang->find('all',array('condition'=>array('GioHang.lang_id'=>$lang,'GioHang.giohang_ip'=>$ip)));
		if(count($gio_hang)==0){
			$this->redirect('/');
			}
		else{$this->set('gio_hang',$gio_hang);}
	}
	function add() {
		$infomationall = $this->requestAction('/comment/infomationall');
		$this->set('keyword',$infomationall['0']['CongTy']['congty_keyword']);
		$this->set('desc',$infomationall['0']['CongTy']['congty_des']);
		$this->set('title_for_layout',$infomationall['0']['CongTy']['congty_title']);
		$lang=$this->Session->read('lag');
		$hodon=array(
			'HoaDon'=>array(
					'hoten'=>$_POST['hoten'],
					'diachi'=>$_POST['diachi'],
					'dienthoai'=>$_POST['dienthoai'],
					'email'=>$_POST['email'],
					'mota'=>$_POST['noidung'],
					'lang_id'=>$lang,
					'tongtien'=>$_POST['tong_tien']
					)
			);
			$this->HoaDon->save($hodon);
			$check=$this->HoaDon->find('all');
			foreach($check as $key){
				$brr[]=$key['HoaDon']['id'];
			}
			$id_sp=$_POST['id_sp'];
			$i=1;
			foreach($id_sp as $key){
			$cos[$i]=$this->GioHang->findBySpId($key);				
			$hodon_sanpham[$i]=array(
			'HoadonSanpham'=>array(
					'hoadon_id'=>max($brr),
					'sp_id'=>$key,
					'sp_gia'=>$cos[$i]['GioHang']['sp_gia'],
					'soluong'=>$cos[$i]['GioHang']['sp_sl'],
					'name'=>$cos[$i]['GioHang']['sp_ten'],
					'image'=>$cos[$i]['GioHang']['sp_anh']
					)
			);
			$i++;
		
		}
		$this->HoadonSanpham->saveall($hodon_sanpham);
		$this->GioHang->deleteall($key);
		//pr($cos);
		//pr($hodon_sanpham);die();
		echo "<script>alert('".json_encode('Bạn đã mua hàng thành công')."');</script>";
		echo "<script>location.href='".UrL."'</script>";	
	}
}
?>