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
 
 .a-chitiet{
 color:#398ce6;
 font-weight:bold;
font-style:italic;

 }
 .a-chitiet:hover{
 color:red;
 }
</style>


                                 

<?php 
$pizza = $_GET['url'];
$urlshop = explode("/", $pizza);
$geturl=$urlshop[0];
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
                    <h2>DANH SÁCH KHUYẾN MẠI</h2>
					<?php 
				
					$i=0;
					foreach($khuyenmai as $row){$i++;
					?>
                    <div style="width:95%;border-bottom:1px solid #9e9e9e;">

                       <img src="<?php echo DOMAIN.$row['Newshop']['images']?>">

                      <span>
						<?php echo $row['Newshop']['title'];?> 
						</span></br>
                        <span>(Đăng ngày: <?php echo $row['Newshop']['created'] ?>)</span>
                        <p>
							<?php echo $row['Newshop']['introduction'];?>
						</p>  
						
						<p style="text-align:right;">
							<a class="a-chitiet" href="<?php echo DOMAIN.$shopname?>/chi_tiet_tin_tuc/<?php echo $row['Newshop']['id']?>">
								>> Chi tiết
							</a>
						</p> 

                    </div><!--end div-->
					
                    <?php 
					
					}?>
                </div><!--end #promotions-->
                <div class="clear"></div>
				
									<div class="pt">
                                   	<div class="pt-pagi">
		 									<?php echo $paginator->numbers();?>
                                      </div><!-- End pt-pagi-->
                                     </div><!-- End pt-->
            </div><!--end #main-promotion-->
            
        </div><!--end #content-->