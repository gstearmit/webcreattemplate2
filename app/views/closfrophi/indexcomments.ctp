<?php 
			
			$shop=explode('/',$this->params['url']['url']); 
			$shopname=$shop[0];
				$shop=$this->requestAction('comment/get_shop_id/'.$shopname);
				
				
				foreach($shop as $key=>$value){
				$shop_id=$key;
				}
			
?>

<!-- Content section -->		
            <section class="main">
                
                <!-- Blog post -->
                <section class="blog_post">


                    <div class="container">
                        <div class="row">

                            <div class="span9">

                                <section class="post-list">
                                    <article class="post post-grid">
                                        <div class="box">
                                            <div class="box-image">
                                                <a href="#">
                                                    <img src="<?php echo DOMAIN ?>clothingstore/img/thumbnails/db_file_img_272_640xauto.jpg" alt="" title="" />
                                                </a>
                                            </div>
                                            <div class="box-header">
                                                <h3>
                                                    <a href="#">
                                                        Cold Front									
                                                    </a>
                                                </h3>
                                                <ul class="post-meta">
                                                    <li><i class="icon-user"></i> &nbsp; Sicilia Tfingi</li>
                                                    <li><i class="icon-calendar"></i> &nbsp; 05/01/2013</li>
                                                    <li><i class="icon-comment-alt"></i> &nbsp; 3 comments</li>
                                                </ul>
                                            </div>

                                            <div class="box-content">
                                                <p>Sweet cookie muffin drag&eacute;e donut. Tart icing chocolate tiramisu wafer. Chocolate cake jelly drag&eacute;e I love marshmallow.</p>
                                            </div>

                                            <div class="box-footer">
                                                <div class="pull-right">
                                                    <a class="btn btn-small" href="#" title="">
                                                        Read more &nbsp; <i class="icon-chevron-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="post post-grid">
                                        <div class="box">
                                            <div class="box-image">
                                                <a href="#">
                                                    <img src="<?php echo DOMAIN ?>clothingstore/img/thumbnails/db_file_img_273_640xauto.jpg" alt="" title="" />
                                                </a>
                                            </div>
                                            <div class="box-header">
                                                <h3>
                                                    <a href="#">
                                                        Properly Position a Brand to Gain Optimal Benefits									
                                                    </a>
                                                </h3>
                                                <ul class="post-meta">
                                                    <li><i class="icon-user"></i> &nbsp; Sicilia Tfingi</li>
                                                    <li><i class="icon-calendar"></i> &nbsp; 03/14/2013</li>
                                                </ul>
                                            </div>

                                            <div class="box-content">
                                                <p>Unless one has a clear notion of the underlying concepts of brand identity design, it is difficult to understand the true significance of it. For the common man, this can be best described as the logo of a company that enables a business organization or a product manufacturer to garner and generate the popularity that it should attain.</p>
                                            </div>

                                            <div class="box-footer">
                                                <div class="pull-right">
                                                    <a class="btn btn-small" href="#" title="">
                                                        Read more &nbsp; <i class="icon-chevron-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="post post-grid">
                                        <div class="box">
                                            <div class="box-image">
                                                <a href="#">
                                                    <img src="<?php echo DOMAIN ?>clothingstore/img/thumbnails/db_file_img_274_640xauto.jpg" alt="" title="" />
                                                </a>
                                            </div>
                                            <div class="box-header">
                                                <h3>
                                                    <a href="#">
                                                        Summer 2014									
                                                    </a>
                                                </h3>
                                                <ul class="post-meta">
                                                    <li><i class="icon-user"></i> &nbsp; Sicilia Tfingi</li>
                                                    <li><i class="icon-calendar"></i> &nbsp; 01/31/2013</li>
                                                    <li><i class="icon-comment-alt"></i> &nbsp; 0 comments</li>
                                                </ul>
                                            </div>

                                            <div class="box-content">
                                                <p>Muffin carrot cake sweet roll icing. Sesame snaps gummi bears drag&eacute;e tart cheesecake jelly-o pie. Muffin cookie pie fruitcake I love I love brownie. Sweet roll croissant cookie lollipop tootsie roll caramels jelly-o.</p>
                                            </div>

                                            <div class="box-footer">
                                                <div class="pull-right">
                                                    <a class="btn btn-small" href="#" title="">
                                                        Read more &nbsp; <i class="icon-chevron-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </section>

                                

                                

                            </div>

                            <div class="span3">                                
                                <!-- Blog categories -->
<div class="widget Menu">
    <h3 class="widget-title widget-title ">Fashion playground</h3>
    <ul class='menu-widget'>
        <li class="level1"><a href="blog.html" title="Trends" class="title">Trends</a></li>
        <li class="level1"><a href="blog.html" title="Get the look" class="title">Get the look</a></li>
        <li class="level1"><a href="blog.html" title="Miscellaneous" class="title">Miscellaneous</a></li>
        <li class="level1"><a href="blog.html" title="New collection" class="title">New collection</a></li>
    </ul>
</div>
<!-- End class="widget Menu" -->	
<!-- TopSellingProducts -->
<div class="widget TopSellingProducts">
    <h3 class="widget-title widget-title ">Top selling products</h3>
    <ul class="product-list-small">
        <li>			
            <div class="image">
                <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php //echo $pr['Estore_product']['id'];?>" title="El Silencio">
                    <img src="<?php echo DOMAIN ?>clothingstore/img/thumbnails/db_file_img_32_160xauto.jpg" alt="El Silencio" />
                </a>
            </div>

            <div class="desc">
                <h6>
                    <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php //echo $pr['Estore_product']['id'];?>" title="El Silencio">El Silencio</a>
                </h6>

                <div class="price">
                    £55.00										
                </div>

                 <div class="rating rating-3">
                    <i class="icon-heart"></i>
                    <i class="icon-heart"></i>
                    <i class="icon-heart"></i>
                </div>
            </div>
        </li>
        <li>			
            <div class="image">
                <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php //echo $pr['Estore_product']['id'];?>" title="Lisette Dress">
                    <img src="<?php echo DOMAIN ?>clothingstore/img/thumbnails/db_file_img_48_160xauto.jpg" alt="Lisette Dress" />
                </a>
            </div>

            <div class="desc">
                <h6>
                    <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php //echo $pr['Estore_product']['id'];?>" title="Lisette Dress">Lisette Dress</a>
                </h6>

                <div class="price">
                    £58.00										
                </div>

                <div class="rating rating-0">
                    <a href="#">No reviews &mdash; be the first?</a>
                </div>
            </div>
        </li>
        <li>			
            <div class="image">
                <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php //echo $pr['Estore_product']['id'];?>" title="Dustbowl Snapback">
                    <img src="<?php echo DOMAIN ?>clothingstore/img/thumbnails/db_file_img_34_160xauto.jpg" alt="Dustbowl Snapback" />
                </a>
            </div>

            <div class="desc">
                <h6>
                    <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php //echo $pr['Estore_product']['id'];?>" title="Dustbowl Snapback">Dustbowl Snapback</a>
                </h6>

                <div class="price">
                    £28.00										
                </div>

                <div class="rating rating-0">
                    <a href="#">No reviews &mdash; be the first?</a>
                </div>
            </div>
        </li>
    </ul>
</div>
<!-- End  class="widget TopSellingProducts" -->											
                            </div>

                        </div>
                    </div>
                </section>                
                <!-- End class="blog_post" -->
                
            </section>
          <!-- End class="main" -->