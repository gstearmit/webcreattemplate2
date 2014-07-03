<style>

 .pt {
 	margin-top:10px;
 	margin-bottom: 10px;
 	margin-left: 10px;
 	overflow: hidden;
 }
 .pt-pagi {
 	margin-right: 10px;
 	text-align: right;
 }
 .pt-pagi > span {

 	padding: 5px;
 }
 .pt-pagi span a {
 	color: #676767;
 }
 .current {
 	color:#3AB833;
 }

</style>

<?php 
			
			$shop=explode('/',$this->params['url']['url']); 
			$shopname=$shop[0];
				$shop=$this->requestAction('comment/get_shop_id/'.$shopname);
				
				
				foreach($shop as $key=>$value){
				$shop_id=$key;
				}
			
			?>
 <div id='content'>
           
            <div id='new-product' style="margin-top:1px;">
                <h2>DANH SÁCH SẢN PHẨM</h2>
				
				<?php 
				
				foreach($productshop as $productshop){?>
                <div class="product" >
                    <a href="<?php echo DOMAIN.$shopname?>/chi_tiet_san_pham/<?php echo $productshop['Productshop']['id']?>">
					<img style="width:122px; height:122px;" src="<?php echo DOMAIN.$productshop['Productshop']['images']?>" alt="copy MP827"></a>
                    <p><?php echo $productshop['Productshop']['title']?></p><br/>
                        <span class='price'><?php echo $productshop['Productshop']['price']." ".$productshop['Productshop']['money'];?> 
						
						</span><br/>
                        <a style="margin-top:5px;" href="<?php echo DOMAIN.$shopname?>/lien_he">
						<img src="<?php echo DOMAIN?>image_template1/dat_hang.png"/>
						</a>
                    </p>
                </div>
              <?php }?>
                <div class="clear"></div>
						<div class="pt">
                                   	<div class="pt-pagi">
		 									<?php echo $paginator->numbers();?>
                                      </div><!-- End pt-pagi-->
                                     </div><!-- End pt-->
            </div><!--end #new-product-->
        </div><!--end #content-->


