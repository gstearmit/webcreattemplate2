<?php 
			
			$shop=explode('/',$this->params['url']['url']); 
			$shopname=$shop[0];
				$shop=$this->requestAction('comment/get_shop_id/'.$shopname);
				
				
				foreach($shop as $key=>$value){
				$shop_id=$key;
				}
			
			?>
<style>
a{color:black;font-weight:bold;}
a:hover{
color:red;
}

</style>
    <div id='side-right' style="margin-top:2px;">
	<?php $user=$this->requestAction($shopname.'/helponline');
	//pr($user); die;
	foreach($user as $user){
	
	?>
            <div class='boxes'>
                <h2>THÔNG TIN LIÊN HỆ</h2>
                <div id='call'>
                    <ul>
					<?php if ($user['Userscms']['phone']!=''){?>
                        <li style="height:23px;"><?php echo $user['Userscms']['phone']?></li>
						<?php }?>
                        <li style="height:23px;"><?php echo $user['Shops'][0]['phone']?></li>
                    </ul>
                </div><!--call-->
                <div id='edit'>
                    <ul>
                        <li style="height:23px;"><?php echo $user['Shops'][0]['mobile']?></li>
                       
                    </ul>
                </div><!--end #edit-->

                <div id='yahoo'>
                    <ul>
                        <li>
						<a class="a-ya" href="ymsgr:sendIM?<?php echo $user['Userscms']['yahoo']?>" border="0">
						Hỗ trợ online</a></li>
                      
                    </ul>
                </div><!--end #yahoo-->

                <div id='skype'>
                    <ul>
                        <li>
						 <a href="skype:<?php echo $user['Userscms']['skype']?>?call">
						Hỗ trợ online</a></li>
                        
                    </ul>
                </div><!--end #skype-->
            </div><!--end .boxes-->
			<?php }?>
            <div class='boxes'>
                <h2>KHUYẾN MẠI MỚI NHẤT</h2>
				
				<?php 
				$tinkhuyenmai=$this->requestAction('comment/tinkhuyenmai/'.$shop_id);
				$i=0;
					foreach($tinkhuyenmai as $row){$i++;
				?>
                <div class='promotion'>
                    <a style="float:left;"href="<?php echo DOMAIN.$shopname?>/chi_tiet_tin_tuc/<?php echo $row['Newshop']['id']?>" style="float:left">
					<img style="width:60px; height:60px;" src="<?php echo DOMAIN.$row['Newshop']['images']?>"></a>
                    <a href="<?php echo DOMAIN.$shopname?>/chi_tiet_tin_tuc/<?php echo $row['Newshop']['id']?>">
					<p style="float:left;width:100px; overflow:hidden;">  <?php echo $row['Newshop']['title'];?></p>
					
					</a>
                </div>
              <?php  if($i==3) break;}?>
                <div class="clear"></div>
            </div><!--end .boxes-->
            <div class='boxes'>
                <h2>RAO VẶT MỚI NHẤT</h2>
					
				<?php 
				$raovat=$this->requestAction('comment/raovat/'.$shop_id);
				$i=0;
					foreach($raovat as $row){$i++;
				?>
				
                <div class='promotion'>
                    <a style="float:left;" href="<?php echo DOMAIN.$shopname?>/chi_tiet_tin_tuc/<?php echo $row['Newshop']['id']?>">
					<img style="width:60px; height:60px;"src="<?php echo DOMAIN.$row['Newshop']['images']?>"></a>
                    <p style="float:left;width:100px; overflow:hidden;">  
					<a href="<?php echo DOMAIN.$shopname?>/chi_tiet_tin_tuc/<?php echo $row['Newshop']['id']?>">
					<?php echo $row['Newshop']['title'];?>
					</a>
					</p>
                </div>
               <?php 
			   if($i==3) break;
			   }?>
                <div class="clear"></div>
            </div><!--end .boxes-->
        </div><!--end #side-right-->