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
              	<li><a href="<?php echo DOMAIN?>">TRANG CHỦ</a></li>
                <?php $root = $this->requestAction('/bepga/menucategory');	
 //pr($root); die;				
                    foreach ($root as $value){?>
               <?php $category = $this->requestAction('/bepga/showcategory/'.$value['Estore_category']['id']);?>
			
               <?php foreach($category as $k=>$subcat){?>
			     
               <li><a href="<?php echo DOMAIN?>bepga/listnews/<?php echo $subcat['Estore_category']['id'];?>"><?php echo $subcat['Estore_category']['name'];?></a></li> 
                <?php }}?>
                 <li><a href="<?php echo DOMAIN?>bepga/indexcomments">GÓP Ý</a></li> 
                 <li><a href="<?php echo DOMAIN?>bepga/thongtin">THÔNG TIN TÀI KHOẢN</a></li>                
                 <li><a href="<?php echo DOMAIN?>bepga/sendcontacts">LIÊN HỆ</a></li>
                                
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

