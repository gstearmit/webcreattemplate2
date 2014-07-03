<?php 
			
			$shop=explode('/',$this->params['url']['url']); 
			$shopname=$shop[0];
				$shop=$this->requestAction('comment/get_shop_id/'.$shopname);
				
				
				foreach($shop as $key=>$value){
				$shop_id=$key;
				}
			
			?>
<!--
			<script type="text/javascript">

$(document).ready(function(){


$('.li-sp').click(function(){

var id = $(this).attr('id');

$('.ul-sau').hide();
$('.ul-'+ id ).show();
});

});


</script>			-->
        <div id='side-left'>
            <div class='boxes'>
                <h2>DANH MỤC SẢN PHẨM</h2>
                <ul>
				<?php 
				$shop=$this->requestAction('comment/get_shop_id/'.$shopname);
				
				
				foreach($shop as $key=>$value){
				$shop_id=$key;
				}
				$categoryshop=$this->requestAction('comment/categoryshop/'.$shop_id);
				$i=0;
				foreach( $categoryshop as $categoryshop){
				$i++;
				?>
                    <li id="<?php echo $i;?>" class="li-sp"><a class="superior" href="<?php echo DOMAIN.$shopname?>/danh_sach_san_pham/<?php echo $categoryshop['Categoryshop']['id'] ?>"><?php echo $categoryshop['Categoryshop']['name'];?></a>
                  
                        <ul class="ul-sau ul-<?php echo $i;?>">
						<?php $productshop = $this->requestAction('comment/categoryshop_child/'.$categoryshop['Categoryshop']['id']);
						foreach($productshop as $productshop){
						?>
                            <li><a href="<?php echo DOMAIN.$shopname?>/danh_sach_san_pham/<?php echo $productshop['Categoryshop']['id'] ?>"><?php echo $productshop['Categoryshop']['name'];?></a></li>
							<?php }?>
                           
                        </ul>
                    </li>
                  
					<?php }?>
                </ul>
            </div><!--end #boxes-->
           
            <div class='boxes'>
                <h2>THỐNG KÊ TRUY CẬP</h2>
                <ul id='access'>
				<?php $shop=$this->requestAction('comment/get_shop_theo_ten/'.$shopname);
				
				foreach($shop as $shop){
				$date=explode(' ',$shop['Shop']['created']);
				$ngay=explode('-',$date[0]);
				?>
                    <span>Tham gia từ: <?php echo $ngay[2]."/".$ngay[1]."/".$ngay[0]?> </span><br/><br/>
                    <span>Lượt xem: 3252465</span><br/>
					<?php }?>
                      </ul>
            </div><!--end #boxes-->
        </div><!--end #side-left-->