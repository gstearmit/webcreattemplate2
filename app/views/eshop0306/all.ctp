
<div id="main-center">              	
        <div id="sanphams" >
    	<div class="top"><?php echo $cat['Catproduct']['name']?></div>
        <div style="min-height: 460px;">
        <?php foreach($products as $pr){?>
        <div id="dssanpham" align="center">             
        	<div class="img"  id="yahoo" >
            <a href="<?php echo DOMAIN;?>chi-tiet-san-pham/<?php echo $pr['Product']['id'];?>" title="<p align='center'> <img src='<?php echo DOMAINAD.$pr['Product']['images']?>'/></p>"><img src="<?php echo DOMAINAD.'timthumb.php?src='.$pr['Product']['images']?>&amp;h=113&amp;w=168&amp;zc=1" width="168" height="113"/></a>
            </div>
            <div class="name" align="center">
            	<h5><a href="<?php echo DOMAIN;?>chi-tiet-san-pham/<?php echo $pr['Product']['id'];?>"><?php echo $pr['Product']['title'];?></a><br />
                Mã:<?php echo $pr['Product']['code'];?>
                </h5>
                <h6>Giá: <?php echo number_format( $pr['Product']['price'],0); ?> VNĐ
                <a href="<?php echo DOMAIN?>mua-hang/<?php echo $pr['Product']['id'];?>"><img src="<?php echo DOMAIN?>images/datmua.jpg"/></a>
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
