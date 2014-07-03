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
//$pizza = $_GET['url'];

//$urlshop = explode("/", $pizza);
//$geturl=$urlshop[0];
?>

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
                    <h2>KHUYẾN MẠI MỚI NHẤT</h2>
					<?php 
					
					$tinkhuyenmai=$this->requestAction('comment/tinkhuyenmai/'.$shop_id);
					$i=0;
					foreach($tinkhuyenmai as $row){$i++;
					?>
                    <div style="width:100%">

                        <a href="<?php echo DOMAIN.$shopname?>/chi_tiet_tin_tuc/<?php echo $row['Newshop']['id']?>">
						
					    
						<img style="width:140px; height:90px;" src="<?php echo DOMAIN.$row['Newshop']['images'];?>"></a>

                        <a style="color:black; font-weight:bold;"href="<?php echo DOMAIN.$shopname?>/chi_tiet_tin_tuc/<?php echo $row['Newshop']['id']?>">
						<span>
						<?php echo $row['Newshop']['title'];?>
						</span></a></br>
                        <span>(Từ 07-12-2011 đến 30-12-2011)</span>
                        <p>
							<?php echo $row['Newshop']['introduction'];?>
						</p>

                    </div><!--end div-->
					
                    <?php 
					if($i==2) break;
					}?>
                </div><!--end #promotions-->
                <div class="clear"></div>
            </div><!--end #main-promotion-->
            <div id='new-product'>
                <h2>SẢN PHẨM MỚI</h2>
				
				<?php foreach($productshop as $productshop){?>
                <div class="product" >
                    <a href="<?php echo DOMAIN.$shopname?>/chi_tiet_san_pham/<?php echo $productshop['Productshop']['id']?>">
						
						<img style="width:122px; height:122px;"src="<?php echo DOMAIN?>/timthumb.php?src=<?php echo $productshop['Productshop']['images'];?>&amp;h=122&amp;w=122&amp;zc=1" alt="thumbnail" />
                     <p>
					<a style="color:black; font-weight:bold;"href="<?php echo DOMAIN.$shopname?>/chi_tiet_san_pham/<?php echo $productshop['Productshop']['id']?>">
					<?php echo $productshop['Productshop']['title']?>
					</a>
					</p><br/>
                        <span class='price'><?php echo $productshop['Productshop']['price']." ".$productshop['Productshop']['money'];?> 
						
						</span><br/>
                        <a href="#"><span>.</span></a>
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