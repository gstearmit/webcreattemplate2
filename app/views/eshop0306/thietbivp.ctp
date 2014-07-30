<div id="main-center">
    <div id="khuyenmai" style="width: 750px !important;">
    <div class="list_carousels">
        <ul id="foo">
        <?php $tinkhuyenmai = $this->requestAction('/comment/tinkhuyenmai');											
        foreach ($tinkhuyenmai as $value){?>
            <li>
            <div class="img"><img src="<?php echo DOMAIN;?>images/vietsys_31.jpg" width="82" height="34" /></div>
            <div class="tt"  ><b style="float: left;"><?php echo $value['News']['title']?> </b><img src="<?php echo DOMAIN;?>images/vietsys_34.jpg" /><div class="clearfix"></div>
            <a style="float: left;" href="<?php echo DOMAIN?>tin-tuc/chi-tiet-tin/<?php echo $value['News']['id']?>"><u><i>Xem chi tiết</i></u></a>
            </div>
            </li>
        <?php }?>
        </ul>
    </div>
    </div>                
 	 <!--sanpham-->    
                	
    <div id="sanphams">
    	<div class="top">Thiết bị văn phòng</div>
        <?php foreach($products as $pr){?>	
        <div id="dssanpham" align="center">
        	<div class="img" align="center">
            <a href="<?php echo DOMAIN;?>chi-tiet-san-pham/<?php echo $pr['Product']['id'];?>"><img src="<?php echo DOMAINAD.'timthumb.php?src='.$pr['Product']['images']?>&amp;h=119&amp;w=154&amp;zc=1" width="154" alt="<?php echo $pr['Product']['title'];?>" height="119" /></a>
            </div>
            <div class="name" align="center">
            	<h5><a href="<?php echo DOMAIN;?>chi-tiet-san-pham/<?php echo $pr['Product']['id'];?>"><?php echo $pr['Product']['title'];?></a></h5>
                <h6>Mã SP: 01218</h6>
                <h6><a href="<?php echo DOMAIN;?>chi-tiet-san-pham/<?php echo $pr['Product']['id'];?>">Giá: <font color="#FF6600"><?php echo $pr['Product']['price']?> VNĐ</font></a></h6>
                <a href="<?php echo DOMAIN?>mua-hang/<?php echo $pr['Product']['id'];?>"><img src="<?php echo DOMAIN?>images/vietsys_111.jpg"/></a>
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
      <!--sanpham2-->              	
    <div id="sanphams">
    	<div class="top">Sản phẩm bán chạy</div>
        <div class="list_carouselss">
            <ul id="foo5">                                
        <?php foreach($newsproducts as $pr){?>
        <li>	
        <div id="dssanpham" align="center">
        	<div class="img" align="center">
            <a href="<?php echo DOMAIN;?>chi-tiet-san-pham/<?php echo $pr['Product']['id'];?>"><img src="<?php echo DOMAINAD.'timthumb.php?src='.$pr['Product']['images']?>&amp;h=119&amp;w=154&amp;zc=1" width="154" alt="<?php echo $pr['Product']['title'];?>" height="119" /></a>
            </div>
            <div class="name" align="center">
            	<h5><a href="<?php echo DOMAIN;?>chi-tiet-san-pham/<?php echo $pr['Product']['id'];?>"><?php echo $pr['Product']['title'];?></a></h5>
                <h6>Mã SP: 01218</h6>
                <h6><a href="<?php echo DOMAIN;?>chi-tiet-san-pham/<?php echo $pr['Product']['id'];?>">Giá: <font color="#FF6600"><?php echo $pr['Product']['price']?> VNĐ</font></a></h6>
                <a href="<?php echo DOMAIN?>mua-hang/<?php echo $pr['Product']['id'];?>"><img src="<?php echo DOMAIN?>images/vietsys_111.jpg"/></a>
            </div>
        </div>
        </li>
        <?php }?> 
        
        </ul>
        </div>
     </div>
    <!--end sanpham2-->  
</div>    

