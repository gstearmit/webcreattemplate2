<?php 
			
			$shop=explode('/',$this->params['url']['url']); 
			$shopname=$shop[0];
				$shop=$this->requestAction('comment/get_shop_id/'.$shopname);
				
				
				foreach($shop as $key=>$value){
				$shop_id=$key;
				}
			
?>
<div id="main-center">              	
        <div id="sanphams" >
    	<div class="top"><?php echo $cat;?></div>
        <div style="min-height: 460px;">
        <?php
//pr($products);
        foreach($products as $pr){?>
        <div id="dssanpham" align="center">             
        	<div class="img"  id="yahoo" >
            <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php echo $pr['Estore_products']['id'];?>" title="<p align='center'> <img src='<?php echo DOMAINADESTORE.$pr['Estore_products']['images']?>'/></p>"><img src="<?php echo DOMAINADESTORE.'timthumb.php?src='.$pr['Estore_products']['images']?>&amp;h=113&amp;w=168&amp;zc=1" width="168" height="113"/></a>
            </div>
            <div class="name" align="center">
            	<h5><a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php echo $pr['Estore_products']['id'];?>"><?php echo $pr['Estore_products']['title'];?></a><br />
                Mã:<?php echo $pr['Estore_products']['code'];?>
                </h5>
                <h6>Giá: <?php echo number_format( $pr['Estore_products']['price'],0); ?> VNĐ
                <a href="<?php echo DOMAIN?><?php echo $shopname ;?>/addshopingcart/<?php echo $pr['Estore_products']['id'];?>"><img src="<?php echo DOMAIN?>home/images/datmua.jpg"/></a>
                </h6>                
            </div>
        </div><?php }?>
        
        <div style="float: left; text-align:right;width: 572px;color: black; font-size: 12px;">
         <?php if($paginator->numbers()!=null){?>
            
            <div class="page">
            <?php
				$paginator->options(array('url' => $this->passedArgs));                                    
				echo $paginator->numbers();
            }?></div>
        </div>  
    </div><!--end newstop-->
</div>