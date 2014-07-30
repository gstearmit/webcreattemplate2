<?php if($session->read('lang')==1){?>
<div id="main-center">
	<div id="sanphams"  style="min-height: 435px !important;">
    	<div class="top">Products</div>
        <div style="min-height: 634px;">
        <?php foreach($products as $pr){?>
        <div id="dssanpham" align="center">             
        	<div class="img"  id="yahoo" >
            <a href="<?php echo DOMAIN;?>chi-tiet-san-pham/<?php echo $pr['Product']['id'];?>" title="<p align='center'> <img src='<?php echo DOMAINAD.$pr['Product']['images']?>'/></p>"><img src="<?php echo DOMAINAD.'timthumb.php?src='.$pr['Product']['images']?>&amp;h=131&amp;w=164&amp;zc=1" width="164" height="131"/></a>
            </div>
            <div class="name" align="center">
            	<h5><a href="<?php echo DOMAIN;?>chi-tiet-san-pham/<?php echo $pr['Product']['id'];?>"><?php echo $pr['Product']['title'];?></a><br />
                Code:<?php echo $pr['Product']['code'];?>
                </h5>                
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
    </div>      
 
</div>    
 <?php } if($session->read('lang')==2){?>
 <div id="main-center">
	
    <div id="sanphams">
    	<div class="top">Product</div>
        <?php foreach($products as $pr){?>	
         <div id="dssanpham" align="center">
        	<div class="img" >
            <a href="<?php echo DOMAIN;?>chi-tiet-san-pham/<?php echo $pr['Product']['id'];?>"><img src="<?php echo DOMAINAD.'timthumb.php?src='.$pr['Product']['images']?>&amp;h=105&amp;w=199&amp;zc=1" width="199" height="105"/></a>
            </div>
            <div class="name" align="center">
            	<h5><a href="<?php echo DOMAIN;?>chi-tiet-san-pham/<?php echo $pr['Product']['id'];?>"><?php echo $pr['Product']['title_en'];?></a></h5>
                <h6><a href="#tips">Price: <font color="#FF6600">Contact </font></a>
                <!--<h6><a href="#tips">Giá: <font color="#FF6600"><?php echo number_format( $pr['Product']['price'],3); ?> VNĐ</font></a></h6>-->
                <h4><a href="<?php echo DOMAIN;?>chi-tiet-san-pham/<?php echo $pr['Product']['id'];?>">Detail</a></h4>
            </div>
        </div>
        <?php }?> 
        <div style="float: left; text-align:right;width: 750px; padding-right: 50px; color: black; font-size: 12px;">
         <?php if($paginator->numbers()!=null){?>
            <style>
            a{
             color: green;
            }
            </style>
            <?php
				$paginator->options(array('url' => $this->passedArgs));                                    
				echo $paginator->prev('<<', null, null, array('class' => 'disabled'));echo "&nbsp;&nbsp;&nbsp;";
				echo $paginator->numbers();echo "&nbsp;&nbsp;&nbsp;";
				echo $paginator->next('>>' , null, null, array('class' => 'disabled'));
            }?>
        </div>
    </div>                          
         <!--end sanpham-->  
  </div>
 <?php }?>
