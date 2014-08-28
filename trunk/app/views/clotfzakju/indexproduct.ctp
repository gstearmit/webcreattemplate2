<?php 
			
			$shop=explode('/',$this->params['url']['url']); 
			$shopname=$shop[0];
				$shop=$this->requestAction('comment/get_shop_id/'.$shopname);
				
				
				foreach($shop as $key=>$value){
				$shop_id=$key;
				}
			
?>
<?php //if($session->read('lang')==1){?>
<div id="main-center">
	<div id="sanphams"  style="min-height: 435px !important;">
    	<div class="top">DANH SÁCH SẢN PHẨM</div>
        <div style="min-height: 634px;">
        <?php foreach($products as $pr){?>
        <div id="dssanpham" align="center">             
        	<div class="img"  id="yahoo" >
            <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php echo $pr['Estore_products']['id'];?>" title="<p align='center'> <img src='<?php echo DOMAINADESTORE.$pr['Estore_products']['images']?>'/></p>"><img src="<?php echo DOMAINADESTORE.'timthumb.php?src='.$pr['Estore_products']['images']?>&amp;h=131&amp;w=164&amp;zc=1" width="168" height="111"/></a>
            </div>
            <div class="name" align="center">
            	<h5><a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php echo $pr['Estore_products']['id'];?>"><?php echo $pr['Estore_products']['title'];?></a><br />
                Code:<?php echo $pr['Estore_products']['code'];?>
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
 <?php  // }
             if($session->read('lang')==2){?>
 <div id="main-center">
	
    <div id="sanphams">
    	<div class="top">PRODUCTS</div>
        <?php foreach($products as $pr){?>	
         <div id="dssanpham" align="center">
        	<div class="img" >
            <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php echo $pr['Estore_products']['id'];?>"><img src="<?php echo DOMAINADESTORE.'timthumb.php?src='.$pr['Estore_products']['images']?>&amp;h=105&amp;w=199&amp;zc=1" width="168" height="111"/></a>
            </div>
            <div class="name" align="center">
            	<h5><a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php echo $pr['Estore_products']['id'];?>"><?php echo $pr['Estore_products']['title_en'];?></a></h5>
                <h6><a href="#tips">Price: <font color="#FF6600">Contact </font></a>
                <!--<h6><a href="#tips">Giá: <font color="#FF6600"><?php echo number_format( $pr['Estore_products']['price'],3); ?> VNĐ</font></a></h6>-->
                <h4><a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php echo $pr['Estore_products']['id'];?>">Detail</a></h4>
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
