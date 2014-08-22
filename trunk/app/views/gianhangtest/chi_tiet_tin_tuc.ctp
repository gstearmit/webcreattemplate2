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
                    <h2>TIN TỨC</h2>
					<ul style="margin:20px;">
						<li style="font-size:20px; color:#134bc3;">
									<?php echo $views['Newshop']['title'];?>
									
						
						</li>
						<li>( Ngày đăng: <?php 
						$ngay =explode(' ',$views['Newshop']['created']);
						
						echo $ngay[0];?>)</li>
						<li style="margin-top:10px;"> <?php echo $views['Newshop']['content'];?></li>
					
					</ul>
						
                    </div><!--end div-->
					
                 
               
                <div class="clear"></div>
            </div><!--end #main-promotion-->
          
        </div><!--end #content-->