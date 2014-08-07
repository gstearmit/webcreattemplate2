<?php
$shop = explode ( '/', $this->params ['url'] ['url'] );
$shopname = $shop [0];
$shop = $this->requestAction ( 'comment/get_shop_id/' . $shopname );
foreach ( $shop as $key => $value ) {
	$shop_id = $key;
}



$user = $this->requestAction ( 'comment/get_user_id/' . $shop_id );
foreach ( $user as $user ) {
	$user_id = $user ['Shop'] ['user_id'];
}

$banner = $this->requestAction ( 'comment/get_banner/' . $user_id );

$tem = $this->requestAction ( 'comment/get_tem/' . $user_id );

foreach ( $tem as $tem ) {
	$template = $tem ['Tem']['linktems'];
}

// pr($shopname);
// echo "shop_id ";pr($shop_id);
// echo "user_id ";pr($user_id);
// echo "banner ";pr($banner);
// echo "tem ";pr($tem);
// echo "template ";pr($template);

?>
<style>
 #translate-this .translate-this-button {
    background: url("<?php echo DOMAIN?>home/images/flat.png") no-repeat scroll 0 0 transparent !important;
    height: 20px !important;
    width: 56px !important;
    float: right;
}

</style>
 <?php //if($session->read('lang')==1){?>
	<div id="menus">
              <ul id="nav">
              	<li><a href="<?php echo DOMAIN.$shopname?>">TRANG CHỦ</a></li>
                <?php $root = $this->requestAction('/'.$shopname.'/menucategory');	
 //pr($root); die;				
                    foreach ($root as $value){?>
               <?php $category = $this->requestAction('/'.$shopname.'/showcategory/'.$value['Estore_category']['id']);?>
			
               <?php foreach($category as $k=>$subcat){?>
			     
               <li><a href="<?php echo DOMAIN?><?php echo $shopname ;?>/listnews/<?php echo $subcat['Estore_category']['id'];?>"><?php echo $subcat['Estore_category']['name'];?></a></li> 
                <?php }}?>
                 <li><a href="<?php echo DOMAIN?><?php echo $shopname ;?>/indexcomments">GÓP Ý</a></li> 
                 <li><a href="<?php echo DOMAIN?><?php echo $shopname ;?>/thongtin">THÔNG TIN TÀI KHOẢN</a></li>                
                 <li><a href="<?php echo DOMAIN?><?php echo $shopname ;?>/sendcontacts">LIÊN HỆ</a></li>
                                
</ul>		

</div>

    <?php //} 
      if($session->read('lang')==2){?>
    	<div id="menus">
              <ul id="nav"><li style="background:none; margin-top:5px; margin-left: 10px;"><img align="absbottom" src="<?php echo DOMAIN?>home/images/home.png" /></li>
              	<li><a href="<?php echo DOMAIN?>">Home</a></li>                                              
                 <li><a href="<?php echo DOMAIN?>gioi-thieu">About us</a></li>
                 <li><a href="<?php echo DOMAIN?>san-pham">Products</a></li>
                 <li><a href="<?php echo DOMAIN?>tin-tuc">News - Event</a></li>
                 <li><a href="<?php echo DOMAIN?>tuyen-dung">Recruitment</a></li>
                 <li><a href="<?php echo DOMAIN?>lien-he">Contact us</a></li>               
</ul>	            
          </div>
    <?php }?>

