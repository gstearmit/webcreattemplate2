<?php 
			
			$shop=explode('/',$this->params['url']['url']); 
			$shopname=$shop[0];
				$shop=$this->requestAction('comment/get_shop_id/'.$shopname);
				
				
				foreach($shop as $key=>$value){
				$shop_id=$key;
				}
			
			?>
  <div id='content'>
            <div id='main-promotion'>
                <div class='promotions'>
                    <h2>Giới thiệu công ty</h2>
					   <?php foreach($gioithoi as $gioithoi){?>
               <?php echo $gioithoi['Shop']['content'];?>
               <?php }?>
			   
                <div class="clear"></div>
            </div><!--end #new-product-->
			</div>
        </div><!--end #content-->

