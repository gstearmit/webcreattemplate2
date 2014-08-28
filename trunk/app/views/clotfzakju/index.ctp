            <!-- Content section -->		
            <section class="main">
                
                <!-- Home content -->
                <section class="home">
                    
                    
<!-- Slider -->
<?php $slide = $this -> requestAction('/'.$shopname.'/slideshow');
     // pr($slide);die;?>
		
<section class="flexslider">
    <ul class="slides">
    <?php foreach($slide as $slide){?>
        <li>
            <img src="<?php echo DOMAINADESTORE;?><?php echo $slide['Estore_slideshows']['images'];?>" alt="" />
            <div class="caption">
                <div class="container">
                    <div class="span6">
                        <h3><?php echo $slide['Estore_slideshows']['name'];?></h3>
                        <br />
                        <!-- <p>The iconic Font Awesome for Bootstrap</p>  -->
                        <br /> 
                        <a class="btn btn-small" title="" href="/retina-ready-icons">Find out more</a> 
                        <a class="btn btn-primary btn-small" title="" href="<?php echo DOMAIN?><?php echo $shopname ;?>/addshopingcart/<?php  //echo $pr['Estore_product']['id'];?>">
                            Buy now &nbsp; <em class="icon-chevron-right"></em>
                        </a>
                    </div>
                </div>
            </div>
        </li>
   <?php } ?>     
    </ul>
</section>


<!-- End class="flexslider" -->      
<section class="promos">
    <div class="container">
        <div class="row">
            <div class="span4">
                <div class="free-shipping">
                    <div class="box border-top">
                        <img src="<?php echo DOMAIN ?>clothingstore/img/free-shipping.png" alt="" />
                        <div class="hgroup title">
                            <h3>Free UK shipping!</h3>
                            <h5>This is a snappy sub-title</h5>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque beatae tempore porro officiis!</p>
                    </div>
                </div>
            </div>

            <div class="span4">
                <div class="world-shipping">
                    <div class="box border-top">
                        <img src="<?php echo DOMAIN ?>clothingstore/img/world-shipping.png" alt="" />
                        <div class="hgroup title">
                            <h3>We're now global!</h3>
                            <h5>This is a snappy sub-title</h5>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque beatae tempore porro officiis!</p>
                    </div>
                </div>
            </div>

            <div class="span4">
                <div class="low-price">
                    <div class="box border-top">
                        <img src="<?php echo DOMAIN ?>clothingstore/img/low-price.png" alt="" />
                        <div class="hgroup title">
                            <h3>Lowest price guarantee!</h3>
                            <h5>This is a snappy sub-title</h5>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque beatae tempore porro officiis!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End class="promos" -->                                                           
                    <section class="featured">
                        <div class="container">
                            
                            <div class="row">
                                <div class="span9">                                                                        
                                    <!-- Products list --> <?php // san pham trung va cao cap?>
										<ul class="product-list isotope">
										  <?php foreach($spvip as $pr){?>
										    <li class="standard" data-price="58">
										        <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php echo $pr['Estore_products']['id'];?>" title="<?php echo $pr['Estore_products']['title']?>">
										            <div class="image">
										               <?php if($pr['Estore_products']['images'] !='') {?>  <img class="primary" src="<?php echo DOMAINADESTORE.$pr['Estore_products']['images']?>" alt="<?php echo $pr['Estore_products']['title']?>" /><?php }?>
										               <?php if($pr['Estore_products']['images1'] !='') {?> <img class="secondary" src="<?php echo DOMAINADESTORE.$pr['Estore_products']['images1']?>" alt="<?php echo $pr['Estore_products']['title']?>" /> <?php }?>
										            </div>
										
										            <div class="title">
										                <div class="prices">
										                    <span class="price">£<?php echo $pr['Estore_products']['price']?></span>
										                </div>
										                <h3><?php echo $pr['Estore_products']['title']?></h3>
										            </div>
										
										        </a>
										    </li>
										   <?php }?> 
										</ul>
										<!-- End class="product-list isotope" -->
										
										<?php // san pham khuyem mai?>
										 <!-- Products list --> <?php // san pham trung cao cap?>
										<ul class="product-list isotope">
										  <?php foreach($products as $pr){?>
										    <li class="standard" data-price="58">
										        <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php echo $pr['Estore_products']['id'];?>" title="<?php echo $pr['Estore_products']['title']?>">
										            <div class="image">
										               <?php if($pr['Estore_products']['images'] !='') {?> <img class="primary" src="<?php echo DOMAINADESTORE.$pr['Estore_products']['images']?>" alt="<?php echo $pr['Estore_products']['title']?>" /><?php }?>
										               <?php if($pr['Estore_products']['images1'] !='') {?> <img class="secondary" src="<?php echo DOMAINADESTORE.$pr['Estore_products']['images1']?>" alt="<?php echo $pr['Estore_products']['title']?>" /><?php }?>
										            </div>
										
										            <div class="title">
										                <div class="prices">
										                    <span class="price">£<?php echo $pr['Estore_products']['price']?></span>
										                </div>
										                <h3><?php echo $pr['Estore_products']['title']?></h3>
										            </div>
										
										        </a>
										    </li>
										   <?php }?> 
										   
										</ul>
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
										<!-- End class="product-list isotope" -->                                                       
                                </div>

                                <div class="span3">
                                     <?php echo $this->element('themeshop\clothingstore\right')?>  
                                </div>
                            </div>	
                            
                        </div>
                    </section>	
                    
                    
                </section>
                <!-- End class="home" -->
                
            </section>
            <!-- End class="main" -->

      