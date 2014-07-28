 <?php if($session->read('lang')==1){?>
<div id="main-center">              	
    <div id="sanphams" style="min-height: 680px !important;">
    	<div class="top"><?php echo $cat['Estore_catproduct']['name']?></div>
		<?php //var_dump($products);die;?>
		<?php if(empty($products)) {?>
		<div id="" align="center">             
        	<h3 style="text-align: center;margin-top: 7%;"> Không có sản phẩm nào trong dang mục này</h3>
        </div><?php }?>
        <?php foreach($products as $pr){?>	
        <div id="dssanpham" align="center">             
        	<div class="img"  id="yahoo" >
            <a href="<?php echo DOMAIN;?>bepga/view/<?php echo $pr['Estore_product']['id'];?>" title="<p align='center'> <img src='<?php echo DOMAINAD.$pr['Estore_product']['images']?>'/></p>"><img src="<?php echo DOMAINAD.'timthumb.php?src='.$pr['Estore_product']['images']?>&amp;h=113&amp;w=168&amp;zc=1" width="168" height="113"/></a>
            </div>
            <div class="name" align="center">
            	<h5><a href="<?php echo DOMAIN;?>bepga/view/<?php echo $pr['Estore_product']['id'];?>"><?php echo $pr['Estore_product']['title'];?></a><br />
                Mã:<?php echo $pr['Estore_product']['code'];?>
                </h5>
                <h6>Giá: <?php echo number_format( $pr['Estore_product']['price'],3); ?> VNĐ
                <a href="<?php echo DOMAIN?>bepga/addshopingcart/<?php echo $pr['Estore_product']['id'];?>"><img src="<?php echo DOMAIN?>images/datmua.jpg"/></a>
                </h6>                
            </div>
        </div><?php }?>
        <div style="float: left; text-align:right;width: 579px; padding-right: 50px; color: black; font-size: 12px;">
         <?php if($paginator->numbers()!=null){?>
            <style>
            a{
             color: green;
            }
            </style>
            <?php
				$paginator->options(array('url' => $this->passedArgs));
                echo "Trang: ";                                    
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
    	<div class="top"><?php echo $cat['Estore_catproduct']['name_en']?></div>
        <?php foreach($products as $pr){?>	
        <div id="dssanpham" align="center">
        	<div class="img" >
            <a href="<?php echo DOMAIN;?>bepga/view/<?php echo $pr['Estore_product']['id'];?>"><img src="<?php echo DOMAINAD.'timthumb.php?src='.$pr['Estore_product']['images']?>&amp;h=105&amp;w=199&amp;zc=1" width="199" height="105"/></a>
            </div>
            <div class="name" align="center">
            	<h5><a href="<?php echo DOMAIN;?>bepga/view/<?php echo $pr['Estore_product']['id'];?>"><?php echo $pr['Estore_product']['title_en'];?></a></h5>
                <h6><a href="#tips">Price: <font color="#FF6600">Contact </font></a>
                <!--<h6><a href="#tips">Giá: <font color="#FF6600"><?php echo number_format( $pr['Estore_product']['price'],3); ?> VNĐ</font></a></h6>-->
                <h4><a href="<?php echo DOMAIN;?>bepga/view/<?php echo $pr['Estore_product']['id'];?>">Detail</a></h4>
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
