<?php 
			
			$shop=explode('/',$this->params['url']['url']); 
			$shopname=$shop[0];
				$shop=$this->requestAction('comment/get_shop_id/'.$shopname);
				
				
				foreach($shop as $key=>$value){
				$shop_id=$key;
				}
			
?>
 <div id="main-center">
<div id="sanphamchitiet">
    <div class="tops">Thông tin tài khoản</div>
    <div class="clearfix" style="font-size: 12px;"> 	
                <p><h3 style="text-transform: uppercase;"><b><?php echo $views['Estore_settings']['name'] ?></b></h3></p><br />
				<p><h1>Address: <?php echo $views['Estore_settings']['address'] ?></h1></p><br />
			    <p><h1>Phone: <?php echo $views['Estore_settings']['phone'] ?>   Hotline: <?php echo $views['Estore_settings']['mobile'] ?>   Email: <?php echo $views['Estore_settings']['email'] ?></h1></p><br />
			    <div class="roundBoxBody" style="padding:20px 10px !important;min-height: 545px !important;">
                        <?php echo $views['Estore_settings']['descriptions']?>
                </div>                  
             </div>            
             
                            
</div>   
</div>



