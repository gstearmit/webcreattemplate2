<?php
$shop = explode ( '/', $this->params ['url'] ['url'] );
$shopname = $shop [0];
$shop = $this->requestAction ( 'comment/get_shop_id/' . $shopname );
foreach ( $shop as $key => $value ) {
	$shop_id = $key;
}

?>
<!-- Categories widget -->
<div class="widget Categories">
	<h3 class="widget-title widget-title ">Categories</h3>
	<?php $root = $this->requestAction('/'.$shopname.'/danhmuc/'.$shopname);
	//pr($root);//die;?>
  
	<ul>
	<?php  foreach ($root as $value){?>
		<li><?php if($value['estore_catproducts']['name'] !='') {?><a href='#' class="title"><?php echo $value['estore_catproducts']['name'];?></a> <?php }?>
        <?php $category = $this->requestAction('/'.$shopname.'/showsmenu1/'.$value['estore_catproducts']['id']);
             if(is_array($category) and !empty($category)){?>
			<ul>
			   <?php foreach($category as $k=>$subcat){?>
                 <?php $categorys = $this->requestAction('/'.$shopname.'/showsmenu2/'.$subcat['estore_catproducts']['id']);
                   if(!empty($categorys)){?>
                        <?php foreach($categorys as $k=>$subcats){?>
                         <li><a href='#' class="title"><?php echo $subcat['estore_catproducts']['name']?></a>
			               <ul>
                             <li><a href='<?php echo DOMAIN;?><?php echo $shopname ;?>/listproduct/<?php echo $subcats['estore_catproducts']['id']?>' class="title"><?php echo $subcats['estore_catproducts']['name']?></a></li>
                           </ul>
		                 </li>
                       <?php }?>
				<?php  }else{   ?>
                  <?php if($subcat['estore_catproducts']['name'] !='') {?>  <li><a href='<?php echo DOMAIN;?><?php echo $shopname ;?>/listproduct/<?php echo $subcat['estore_catproducts']['id']?>'class="title"><?php echo $subcat['estore_catproducts']['name']?></a></li> <?php }?>
                <?php }?>
            <?php   }?>
			</ul>
			<?php } ?>
		</li>
<?php }?>		
	</ul>
</div>
<!-- End class="widget Categories" -->
<!-- TopSellingProducts -->
<div class="widget TopSellingProducts">
    <h3 class="widget-title widget-title ">Top selling products</h3>
    <ul class="product-list-small">
     <?php foreach($products as $pr){?>
        <li>			
            <div class="image">
                <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php echo $pr['Estore_products']['id'];?>" title="<?php echo $pr['Estore_products']['title']?>">
                    <?php if($pr['Estore_products']['images'] !='') {?>  <img src="<?php echo DOMAINADESTORE.$pr['Estore_products']['images']?>" alt="<?php echo $pr['Estore_products']['title']?>" /><?php }else  {?><img src="<?php echo DOMAINAD?>/clothingstore/img/defaultnoimg.jpg"/> <?php } ?>
                </a>
            </div>

            <div class="desc">
                <h6>
                    <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php echo $pr['Estore_products']['id'];?>" title="<?php echo $pr['Estore_products']['title']?>"><?php echo $pr['Estore_products']['title']?></a>
                </h6>

                <div class="price">
                    £<?php echo $pr['Estore_products']['price']?>								
                </div>

                 <div class="rating rating-3">
                    <i class="icon-heart"></i>
                    <i class="icon-heart"></i>
                    <i class="icon-heart"></i>
                </div>
            </div>
        </li>
       <?php }?>  
    </ul>
</div>
 <div style="float: left; text-align:right;width: 572px;color: black; font-size: 12px;">
								         <?php if($paginator->numbers()!=null){?>
								            
								            <div class="page">
								            <?php
												$paginator->options(array('url' => $this->passedArgs));                                    
												echo $paginator->numbers();
												?>
												</div>
								        <?php }?>
	</div> 
<!-- End  class="widget TopSellingProducts" -->		
<!-- This month only! widget -->

<div class="widget Text">
<h3 class="widget-title widget-title ">SUPPORT ONLINE</h3>
 <ul style="padding-top:10px;" >
            <ul>
           <?php 
           $support = $this->requestAction('/'.$shopname.'/helpsonline');?>
             <?php  foreach($support as $itm ){?>                   
           <li style="margin: 5px 7px;"><font style="font-size: 12px; color: #4f4444; "><b><?php echo $itm['Estore_helps']['title']?> </b></font><a href="ymsgr:sendIM?<?php echo $itm['Estore_helps']['user_yahoo']?>" style="margin: 0 10px; float: right;"><img align="absmiddle"  src="http://opi.yahoo.com/online?u=<?php echo $itm['Estore_helps']['user_yahoo']?>&amp;m=g&amp;t=1"/></a></li>
           <li style="margin: 5px 7px;"><font style="font-size: 12px; color: #4f4444; "><b><?php echo $itm['Estore_helps']['user_support']?> </b></font><a href="skype:<?php echo $itm['Estore_helps']['user_skype'] ?>?call" style="margin: 0 10px; float: right;"><img src="<?php echo DOMAIN?>home/images/skype.png"/></a></li>
           <li style="margin: 5px 7px; line-height:16px;"><font style="font-size: 12px; color: #000; "><b></b></font><p align="right"> <font style="font-size: 12px; color: #4f4444;"><b ><?php echo $itm['Estore_helps']['user_mobile']?></b></font></p></li>
           <?php }?>
           </ul>
           <?php $setting = $this->requestAction('/'.$shopname.'/setting') ?>
            <?php foreach($setting as $settings ){  ?>
            <ul>
           <li style="margin: 10px 2px;"><img src="<?php echo DOMAIN?>home/images/hotline.png" align="absmiddle" /><font  style="font-size: 12px; color: #d00000; padding-left:10px;"><b>Hotline : <?php echo $settings['Estore_settings']['mobile'] ?></b></font></li>
           </ul>
            <?php }?> 
</div>