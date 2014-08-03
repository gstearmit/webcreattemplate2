<div id="main-center">              	
        <div id="sanphams" >
    	<div class="top"><?php echo $cat['Estore_catproduct']['name']?></div>
        <div style="min-height: 460px;">
        <?php foreach($products as $pr){?>
        <div id="dssanpham" align="center">             
        	<div class="img"  id="yahoo" >
            <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php echo $pr['Estore_product']['id'];?>" title="<p align='center'> <img src='<?php echo DOMAINADESTORE.$pr['Estore_product']['images']?>'/></p>"><img src="<?php echo DOMAINADESTORE.'timthumb.php?src='.$pr['Estore_product']['images']?>&amp;h=113&amp;w=168&amp;zc=1" width="168" height="113"/></a>
            </div>
            <div class="name" align="center">
            	<h5><a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php echo $pr['Estore_product']['id'];?>"><?php echo $pr['Estore_product']['title'];?></a><br />
                Mã:<?php echo $pr['Estore_product']['code'];?>
                </h5>
                <h6>Giá: <?php echo number_format( $pr['Estore_product']['price'],0); ?> VNĐ
                <a href="<?php echo DOMAIN?><?php echo $shopname ;?>/addshopingcart/<?php echo $pr['Estore_product']['id'];?>"><img src="<?php echo DOMAIN?>home/images/datmua.jpg"/></a>
                </h6>                
            </div>
        </div><?php }?>
        </div>
        <div style="float: left; text-align:right;width: 572px;color: black; font-size: 12px;">
         <?php if($paginator->numbers()!=null){?>
            
            <div class="page">
            <?php
				$paginator->options(array('url' => $this->passedArgs));                                    
				echo $paginator->numbers();
            }?></div>
        </div>  
    </div><!--end newstop-->
