<?php
class ProductsController extends AppController {

	var $name = 'Products';
	var $helpers = array('Html', 'Form', 'Javascript', 'TvFck');
	var $uses=array('Product','City','Setting','Guest');
	function index() {
		  $this->account();
		 // $conditions=array('News.status'=>1);
		  $this->paginate = array('limit' => '15','order' => 'Product.id DESC');
	      $this->set('product', $this->paginate('Product',array()));
		  $this->loadModel("Catproduct");
        $list_cat = $this->Catproduct->generatetreelist(null,null,null," _ ");
        $this->set(compact('list_cat'));
 
	}
	
	
	function date($date)
	{
		$ngay = explode("-", $date);
		$date1=$ngay['2'].'-'.$ngay['1'].'-'.$ngay['0'];
		return  $date1;
	}
	
	//Them bai viet
	function add() {
		$this->account();
		$this->set('city',$this->City->find('all'));
		if (!empty($this->data)) {
			$this->Product->create();
			$data['Product'] = $this->data['Product'];
			$data['Product']['images']=$_POST['userfile1'];
			$data['Product']['background']=$_POST['userfile2'];
			
			$data['Product']['date_batdau']=$this->date($_POST['date_batdau']);
			$data['Product']['date_ketthuc']=$this->date($_POST['date_ketthuc']);
			$data['Product']['date1']=$this->date($_POST['date1']);
			$data['Product']['date2']=$this->date($_POST['date2']);
			$data['Product']['date3']=$this->date($_POST['date3']);
			$data['Product']['date4']=$this->date($_POST['date4']);
			
			$data['Product']['price']=$this->chuantien($this->data['Product']['price']);
			
			$data['Product']['price_old']=$this->chuantien($this->data['Product']['price_old']);
			$data['Product']['price1']=$this->chuantien($this->data['Product']['price1']);
			$data['Product']['price2']=$this->chuantien($this->data['Product']['price2']);
			
			
		$data['Product']['conlai']= $this->data['Product']['soluong'] -  $this->data['Product']['daban'];
// 			echo '<pre>';
// 			print_r($data);die();
			
			//$data['Product']['images_eg']=$_POST['userfile_eg'];
		//	$data['Product']['display']=$_POST['display'];
			if ($this->Product->save($data['Product'])) {
			
			$sanpham=$this->Product->find('all',array('order'=>'Product.id DESC','limit'=>1));
			
			//ini_set("include_path", ".:/var/www/vhosts/backup.webteam.vn/httpdocs/");   
require("components/class.phpmailer.php");                                
$mailer = new PHPMailer();                                      // khởi tạo 1 đối tượng của PHPMailer 
//$mailer->IsSMTP();                                                  // gọi class smtp để authentication 
//$mailer->CharSet="windows-1251"; 
//$mailer->CharSet="utf-8";                                       // dành cho viết tiếng việt 
//$mailer->Host ='localhost';  
//$mailer->SMTPAuth = true;  
//$mailer->Username = 'doannam28@gmail.com';    

//$mailer->Password = '0974802368';                          
 
 $mailer->SMTPSecure =  "ssl";
$mailer->Host  =  "smtp.gmail.com";  
$mailer->Port  = 465;     
$mailer->Username = "doannam28@gmail.com";
$mailer->Password =  "0974802368";  
$mailer->From = "doannam28@gmail.com";
 
// $mailer->Username = 'info@gsi.com.vn';    

//$mailer->Password = '100000';     

$guest=$this->Guest->find('all',array('limit'=>1)) ;
foreach($guest as $guest){


  
//$mailer->FromName = "webnode.cz";           // tên người gửi 
//$mailer->From = $x['Setting']['email'];     
  // mail người gửi 
$mailer->AddAddress($guest['Guest']['email'],$guest['Guest']['email']);        //mail người nhậ
$mailer->Subject = $this->data['Product']['title']; 

$mailer->IsHTML(true);     //nhúng HTML 
//$mailer->AddEmbeddedImage('logo.jpg', 'logoimg', 'logo.jpg');                   //nhúng ảnh 

$mailer->Body = "<h1>Test 1 of PHPMailer html</h1> 
    <p>This is a test picture: <img src=\"cid:logoimg\" /></p>"; 

$mailer->Body = " 
webnode.cz có sản phẩm mới
<a target='_blank' href='http://localhost/websitetemplate/san-pham/".$sanpham[0]['Product']['id']."'>
".$this->data['Product']['title']."
</a>
";
//$mailer->AddAttachment('logo.jpg', 'logo.jpg');                             
$mailer->Send();
}

			
				$this->Session->setFlash(__('Thêm mới danh mục thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Thêm mơi danh mục thất bại. Vui long thử lại', true));
			}
		}
		$this->loadModel("Catproduct");
        $list_cat = $this->Catproduct->generatetreelist(null,null,null," _ ");
        $this->set(compact('list_cat'));
        
        
        $_list_part=$this->City->find('list',array('fields' => array('id', 'name')));
        $this->set('list_cat1',$_list_part);
        $this->set(compact('list_cat1'));
     
//         $list_cat1 = $this->City->find('all');
//         $this->set(compact('list_cat1'));
        
        
     
	}
	//view mot tin 
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Không tồn tại', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('views', $this->Product->read(null, $id));
	}
	//dong danh muc
	function close($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Product'] = $this->data['Product'];
		$data['Product']['id']=$id;
		$data['Product']['status']=0;		
		if ($this->Product->save($data['Product'])) {
			$this->Session->setFlash(__('Danh mục không được hiển thị', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không close được', true));
		$this->redirect(array('action' => 'index'));

	}
	// kich hoat
	function active($id=null) {
		$this->account();
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại danh mục này', true));
			$this->redirect(array('action'=>'index'));
		}
		$data['Product'] = $this->data['Product'];
		$data['Product']['id']=$id;
		$data['Product']['status']=1;
		if ($this->Product->save($data['Product'])) {
			$this->Session->setFlash(__('Danh mục kích hoạt thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Danh mục không kich hoạt được', true));
		$this->redirect(array('action' => 'index'));

	}
	// tim kiem san pham
	/*function search() {
		$data['Product']=$this->data['Product'];
		$category=$data['Product']['catproduct_id'];
		$this->paginate = array('conditions'=>array('Product.catproduct_id'=>$category),'limit' => '15','order' => 'Product.id DESC');
	    $this->set('product', $this->paginate('Product',array()));
		 $this->loadModel("Catproduct");
        $list_cat = $this->Catproduct->generatetreelist(null,null,null," _ ");
        $this->set(compact('list_cat'));
		
	}*/
	function search() {
		$this->loadModel("Catproduct");
	   $keyword="";
	   $list_cat="";
	  
	   if(isset($_POST['keyword']))
		$keyword=$_POST['keyword'];
		
		if(isset($_POST['list_cat']))
		$list_cat=$_POST['list_cat'];
		$x=array();
		if($keyword!="")
		$x['Product.title like']='%'.$keyword.'%';
		
		if($list_cat!="")
		$x['Product.catproduct_id']=$list_cat;
		//pr($x);exit;
		$tt =array();
		$portfolio=$this->Catproduct->find('all',array('conditions'=>array('Catproduct.parent_id'=>$x)));		
		//pr($portfolio);
		foreach($portfolio as $key){
		$tt[]=$key['Catproduct']['id'];
		}
		for($i=0;$i<count($tt);$i++)
		 if($list_cat==$tt[$i])
		 $list_cat=$this->Catproduct->find('list',array('conditions'=>array('Catproduct.parent_id'=>$tt[$i]),'fields'=>array('Catproduct.id')));	
		 if($list_cat!="")
		$x['Product.catproduct_id']=$list_cat;
		//pr($x); die;
		//
	    //$this->set('products', $this->paginate('Product',array()));	
		//pr($x);
		$this->paginate = array('conditions'=>$x,'limit' => '12','order' => 'Product.id DESC');
		$this->set('product', $this->paginate('Product',array()));	
		//$ketquatimkiem=$this->Product->find('all',array('conditions'=>$x,'order' => 'Product.id DESC','limit'=>3));	
		//pr($ketquatimkiem); die;
		//$this->set('products',$category);
		 $this->loadModel("Catproduct");
        $list_cat1 = $this->Catproduct->generatetreelist(null,null,null," _ ");
        $this->set(compact('list_cat'));
		
	}
	
	
	
	
	// sua tin da dang
	function edit($id = null) {
		$this->account();
	
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Không tồn tại ', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$data['Product'] = $this->data['Product'];
			
	
			$data['Product']['images']=$_POST['userfile1'];
			$data['Product']['background']=$_POST['userfile2'];
			
			$data['Product']['date_batdau']=$this->date($_POST['date_batdau']);
			$data['Product']['date_ketthuc']=$this->date($_POST['date_ketthuc']);
			$data['Product']['date1']=$this->date($_POST['date1']);
			$data['Product']['date2']=$this->date($_POST['date2']);
			$data['Product']['date3']=$this->date($_POST['date3']);
			$data['Product']['date4']=$this->date($_POST['date4']);
			
			 $this->chuantien($this->data['Product']['price']);
			
			$data['Product']['price']=$this->chuantien($this->data['Product']['price']);
			
			$data['Product']['price_old']=$this->chuantien($this->data['Product']['price_old']);
			$data['Product']['price1']=$this->chuantien($this->data['Product']['price1']);
			$data['Product']['price2']=$this->chuantien($this->data['Product']['price2']);
			
			$data['Product']['conlai']= $this->data['Product']['soluong'] -  $this->data['Product']['daban'];
		
			//$data['Product']['display']=$_POST['display'];
			if ($this->Product->save($data['Product'])) {
				$this->Session->setFlash(__('Bài viết sửa thành công', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Bài viết này không sửa được vui lòng thử lại.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Product->read(null, $id);
		}
		$this->loadModel("Catproduct");
        $list_cat = $this->Catproduct->generatetreelist(null,null,null," _ ");
        $this->set(compact('list_cat'));
		$this->set('edit',$this->Product->findById($id));
		
		$_list_part=$this->City->find('list',array('fields' => array('id', 'name')));
        $this->set('list_cat1',$_list_part);
        $this->set(compact('list_cat1'));
		
		
	}
	function processing() {
		$this->account();
		if(isset($_POST['dropdown']))
			$select=$_POST['dropdown'];
			
		if(isset($_POST['checkall']))
				{
			
			switch ($select){
				case 'active':
				$products=($this->Product->find('all'));
				foreach($products as $product) {
					$product['Product']['status']=1;
					$this->Product->save($product['Product']);					
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$products=($this->Product->find('all'));
				foreach($products as $product) {
					$product['Product']['status']=0;
					$this->Product->save($product['Product']);					
				}
				break;
				case 'delete':
				$products=($this->Product->find('all'));
				foreach($products as $product) {
					$this->Product->delete($product['Product']['id']);					
				}
				if($this->Product->find('count')<1)
					$this->redirect(array('action' => 'index'));	
				 else
				 {
					$this->Session->setFlash(__('Danh mục không close được', true));
					$this->redirect(array('action' => 'index'));
				 }
				//vong lap xoa
				break;
				
			}
		}
		else{
			
			switch ($select){
				case 'active':
				$products=($this->Product->find('all'));
				foreach($products as $product) {
					if(isset($_POST[$product['Product']['id']]))
					{
						$product['Product']['status']=1;
						$this->Product->save($product['Product']);
					}
				}
				//vong lap active
				break;
				case 'notactive':	
				//vong lap huy
				$products=($this->Product->find('all'));
				foreach($products as $product) {
					if(isset($_POST[$product['Product']['id']]))
					{
						$product['Product']['status']=0;
						$this->Product->save($product['Product']);
					}
				}
				break;
				case 'delete':
				$products=($this->Product->find('all'));
				foreach($products as $product) {
					if(isset($_POST[$product['Product']['id']]))
					{
					    $this->Product->delete($product['Product']['id']);
						
					}
										
				}
				$this->redirect(array('action'=>'index'));
				die;	
				//vong lap xoa
				break;
				
			}
			
		}
		$this->redirect(array('action' => 'index'));
		
	}
	// Xoa cac dang
	function delete($id = null) {
		$this->account();		
		if (empty($id)) {
			$this->Session->setFlash(__('Khôn tồn tại bài viết này', true));
			//$this->redirect(array('action'=>'index'));
		}
		if ($this->Product->delete($id)) {
			$this->Session->setFlash(__('Xóa bài viết thành công', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bài viết không xóa được', true));
		$this->redirect(array('action' => 'index'));
	}
	function _find_list() {
		return $this->Catproduct->generatetreelist(null, null, null, '__');
	}
	//check ton tai tai khoan
	function account(){
		if(!$this->Session->read("id") || !$this->Session->read("name")){
			$this->redirect('/');
		}
	}
	// chon layout
	function beforeFilter(){
		$this->layout='admin';
	}

	function dinhdangngay($date=null){
		$date=explode("-", $date);
		$date1=$date['2'].'-'.$date['1'].'-'.$date['0'];
		return $date1;
		
	}
	
	function chuantien($tien){
	$a='/[^0-9]/';
	$b='';
	return (int)preg_replace($a,$b,$tien);
	
	}
}
?>
