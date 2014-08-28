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
	<h3 class="widget-title widget-title ">This month only!</h3>
	<h5>Free UK shipping!</h5>
	<h6>
		<i class="icon-gift"> &nbsp; </i> Free gift wrap
	</h6>

	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque
		beatae tempore porro officiis!</p>
	<a class="btn btn-primary" href="#"> BUY NOW <em>for</em> $85
	</a>
</div>
<!-- End class="widget Text" -->

