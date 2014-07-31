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
    <div class="clearfix"> 		                   
                <div class="roundBoxBody" style="padding:20px 10px !important;min-height: 545px !important;">
                        <?php echo $views['Estore_setting']['descriptions']?>
                </div>                  
             </div>            
             
                            
</div>   
</div>



