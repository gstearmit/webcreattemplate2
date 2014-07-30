
<script src="<?php echo DOMAIN;?>home/js/jquery.jqzoom-core.js" type="text/javascript"></script>

<link rel="stylesheet" href="<?php echo DOMAIN;?>home/css/jquery.jqzoom.css" type="text/css">

<script type="text/javascript">

$(document).ready(function() {
	$('.jqzoom').jqzoom({
            zoomType: 'innerzoom',
            preloadImages: false,
            alwaysOn:false
        });
});


</script>

 <?php //if($session->read('lang')==1){?>
 <div id="main-center">
<div id="sanphamchitiet">
    
    <div class="top"><?php echo $views['Estore_product']['title'];?></div>
    <div id="dssanpham" style="min-height: 636px  !important;">
        <div class="img">              
    <div class="clearfix">
        <a href="<?php echo DOMAINADESTORE;?><?php echo $views['Estore_product']['images'];?>" class="jqzoom" rel='gal1'  title="triumph" >
            <img src="<?php echo DOMAINADESTORE.'timthumb.php?src='.$views['Estore_product']['images']?>&amp;w=264&amp;zc=1"  title="triumph"  style="border: 4px solid #666;">
        </a>
    </div>

        </div>
        <div class="name">
            <span>Thông tin chi tiết: </span><br /><br />
            <div class="detail" style="line-height: 30px !important;">
            <b>Tên sản phẩm:</b>  <?php echo $views['Estore_product']['title'];?><br/>
            <b>Mã sản phẩm: </b>  <?php echo $views['Estore_product']['code'];?><br/>
            <b>Kích thước: </b>  <?php echo $views['Estore_product']['kichthuoc'];?><br/>            
            <b>Giá:</b>  <?php echo number_format( $views['Estore_product']['price'],0); ?> VNĐ<br/></p>
        </div>
            <div class="chitiet"><br />
            <a href="<?php echo DOMAIN?>bepga/addshopingcart/<?php echo $views['Estore_product']['id'];?>"><img src="<?php echo DOMAIN?>home/images/datmua.jpg"/></a>
            </div>
            <!--<b>Giá sản phẩm:</b>  <?php echo number_format( $views['Estore_product']['price'],3); ?> VNĐ<br/></p>
            </div>
            <div class="chitiet"><a href="<?php echo DOMAIN?>bepga/addshopingcart/<?php echo $views['Estore_product']['id'];?>"><img src="<?php echo DOMAIN?>home/images/vietsys_111.jpg"/></a></div><br /><br />
            -->
        </div>
        <div class="clearfix"></div>
        <div class="noidung">
            <?php echo $views['Estore_product']['content'];?>
        </div>
    </div>
                            
</div> 
</div> 
<?php if($sanphamkhac){?> 
<div id="main-center">
<div id="sanphams" >
    	<div class="top">Sản phẩm liên quan</div>
            <?php foreach($sanphamkhac as $pr){?>
         <div id="dssanpham" align="center">             
        	<div class="img"  id="yahoo" >
            <a href="<?php echo DOMAIN;?>bepga/view/<?php echo $pr['Estore_product']['id'];?>" title="<p align='center'> <img src='<?php echo DOMAINADESTORE.$pr['Estore_product']['images']?>'/></p>"><img src="<?php echo DOMAINADESTORE.'timthumb.php?src='.$pr['Estore_product']['images']?>&amp;h=113&amp;w=168&amp;zc=1" width="168" height="113"/></a>
            </div>
            <div class="name" align="center">
            	<h5><a href="<?php echo DOMAIN;?>bepga/view/<?php echo $pr['Estore_product']['id'];?>"><?php echo $pr['Estore_product']['title'];?></a><br />
                Mã:<?php echo $pr['Estore_product']['code'];?>
                </h5>
                <h6>Giá: <?php echo number_format( $pr['Estore_product']['price'],3); ?> VNĐ
                <a href="<?php echo DOMAIN?>bepga/addshopingcart/<?php echo $pr['Estore_product']['id'];?>"><img src="<?php echo DOMAIN?>home/images/datmua.jpg"/></a>
                </h6>                
            </div>
        </div><?php }?>                                    
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
    <!--end sanpham2-->                                                  
</div>
<?php }?>
 <?php //} 
            if($session->read('lang')==2){?>
    <div id="sanphamchitiet">
    <div class="top">Product <?php echo $views['Estore_product']['title_en'];?></div>
    <div id="dssanpham" style="min-height: 732px !important;">
        <div class="img">
                <img src="<?php echo DOMAINAD.'timthumb.php?src='.$views['Estore_product']['images']?>&amp;h=325&amp;w=330&amp;zc=1" />
        </div>
        <div class="name">
            <span>Details : </span><br /><br />
            <div class="detail" style="line-height: 30px !important;">
            <b>Product Name:</b>  <?php echo $views['Estore_product']['title_en'];?><br/>
            <b>Product Code: </b>  <?php echo $views['Estore_product']['id'];?><br/>
            <b>Price:</b> Contact<br/></p>
        </div>
            <div class="chitiet"><br />&nbsp;<br /><br />
            </div>
            <!--<b>Giá sản phẩm:</b>  <?php echo number_format( $views['Estore_product']['price'],3); ?> VNĐ<br/></p>
            </div>
            <div class="chitiet"><a href="<?php echo DOMAIN?>bepga/addshopingcart/<?php echo $views['Estore_product']['id'];?>"><img src="<?php echo DOMAIN?>home/images/vietsys_111.jpg"/></a></div><br /><br />
            -->
        </div>
        <div class="noidung">
            <?php echo $views['Estore_product']['content_en'];?>
        </div>
    </div>
                            
</div> 
<?php if($sanphamkhac){?>
<div id="main-center">
<div id="sanphams" >
    	<div class="top">Related Products</div>
        <div class="list_carousels">
            <ul id="foo5">   
            <?php foreach($sanphamkhac as $pr){?>
            <li>
        <div id="dssanpham" align="center">
        	<div class="img" >
            <a href="<?php echo DOMAIN;?>bepga/view/<?php echo $pr['Estore_product']['id'];?>"><img src="<?php echo DOMAINAD.'timthumb.php?src='.$pr['Estore_product']['images']?>&amp;h=105&amp;w=199&amp;zc=1" width="199" height="105"/></a>
            </div>
            <div class="name" align="center">
            	<h5><a href="<?php echo DOMAIN;?>bepga/view/<?php echo $pr['Estore_product']['id'];?>"><?php echo $pr['Estore_product']['title_en'];?></a></h5>
                <h6><a href="#tips">Price: <font color="#FF6600">Contact </font></a>
                <!--<h6><a href="#tips">Giá: <font color="#FF6600"><?php echo $pr['Estore_product']['price'];?> VNĐ</font></a></h6>
                <h4><a href="<?php echo DOMAIN;?>bepga/view/<?php echo $pr['Estore_product']['id'];?>">Detail</a></h4>-->
            </div>
        </div></li><?php }?>                                    
        
        </ul>
        </div>
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
    <!--end sanpham2-->                                                  
</div><?php }?>
 <?php }?>