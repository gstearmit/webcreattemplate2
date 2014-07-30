 <?php if($session->read('lang')==1){?>
<div id="main-center">              	
    <div id="sanphams" style="min-height: 665px !important;">
    	<div class="top"><?php echo $cat['Catproduct']['name']?></div>
        <?php if($catproduct){?>
        <?php foreach($catproduct as $pr){?>	
        <div id="dssanpham" align="center" style="height: 165px !important;">
        	<div class="img" >
            <a href="<?php echo DOMAIN;?>danh-muc-san-pham/<?php echo $pr['Catproduct']['id'];?>"><img src="<?php echo DOMAINAD.'timthumb.php?src='.$pr['Catproduct']['images']?>&amp;h=131&amp;w=164&amp;zc=1" width="164" height="131"/></a>
            </div>
            <div class="name" align="center" >
            	<h5><a href="<?php echo DOMAIN;?>danh-muc-san-pham/<?php echo $pr['Catproduct']['id'];?>"><?php echo $pr['Catproduct']['name'];?></a></h5>                               
            </div>
        </div>
        <?php }}else{?> 
        
        <?php foreach($products as $pr){?>	
        <div id="dssanpham" align="center">             
        	<div class="img"  id="yahoo" >
            <a href="<?php echo DOMAIN;?>chi-tiet-san-pham/<?php echo $pr['Product']['id'];?>" title="<p align='center'> <img src='<?php echo DOMAINAD.$pr['Product']['images']?>'/></p>"><img src="<?php echo DOMAINAD.'timthumb.php?src='.$pr['Product']['images']?>&amp;h=113&amp;w=168&amp;zc=1" width="168" height="113"/></a>
            </div>
            <div class="name" align="center">
            	<h5><a href="<?php echo DOMAIN;?>chi-tiet-san-pham/<?php echo $pr['Product']['id'];?>"><?php echo $pr['Product']['title'];?></a><br />
                Mã:<?php echo $pr['Product']['code'];?>
                </h5>
                <h6>Giá: <?php echo number_format( $pr['Product']['price'],3); ?> VNĐ
                <a href="<?php echo DOMAIN?>mua-hang/<?php echo $pr['Product']['id'];?>"><img src="<?php echo DOMAIN?>images/datmua.jpg"/></a>
                </h6>                
            </div>
        </div>
        <?php }}?>
        <div style="float: left; text-align:right;width: 579px; padding-right: 50px; color: black; font-size: 12px;">
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
 <?php } if($session->read('lang')==2){?>
 <div id="main-center">              	
    <div id="sanphams" style="min-height: 680px !important;">
    	<div class="top"><?php echo $cat['Catproduct']['name_en']?></div>
        <?php if($catproduct){?>
        <?php foreach($catproduct as $pr){?>	
        <div id="dssanpham" align="center">
        	<div class="img" >
            <a href="<?php echo DOMAIN;?>danh-muc-san-pham/<?php echo $pr['Catproduct']['id'];?>"><img src="<?php echo DOMAINAD.'timthumb.php?src='.$pr['Catproduct']['images']?>&amp;h=105&amp;w=199&amp;zc=1" width="199" height="105"/></a>
            </div>
            <div class="name" align="center">
            	<h5><a href="<?php echo DOMAIN;?>danh-muc-san-pham/<?php echo $pr['Catproduct']['id'];?>"><?php echo $pr['Catproduct']['name_en'];?></a></h5>                
                <h4><a href="<?php echo DOMAIN;?>danh-muc-san-pham/<?php echo $pr['Catproduct']['id'];?>">Chi tiết</a></h4>
            </div>
        </div>
        <?php }}else{?> 
        
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
        <?php }}?> 
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
