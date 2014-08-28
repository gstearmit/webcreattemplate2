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
                
                <!-- Product content -->
                <section class="product">


                    <!-- Product info -->
                    <section class="product-info">
                        <div class="container">
                            <div class="row">

                                <div class="span4">
                                    <div class="product-images">
                                        <div class="box">
                                            <div class="primary">
                                               <?php if($views['Estore_products']['images']!=''){?> <img src="<?php echo DOMAINADESTORE;?><?php echo $views['Estore_products']['images'];?>" data-zoom-image="<?php echo DOMAINADESTORE;?><?php echo $views['Estore_products']['images'];?>" alt="Chaser Overalls" /><?php }?>
                                               <?php if($views['Estore_products']['images']==''){?> <img src="<?php echo DOMAINAD;?>clothingstore/img/db_file_img_no.jpg" data-zoom-image="<?php echo DOMAINAD;?>clothingstore/img/db_file_img_no.jpg" alt="Chaser Overalls" /><?php }?>
                                               
                                            </div>

                                            <div class="thumbs" id="gallery">
                                                <ul class="thumbs-list">
                                                    <li>
                                                        <a class="active" href="#" data-image="<?php echo DOMAINADESTORE;?><?php echo $views['Estore_products']['images1'];?>" title="Chaser Overalls" data-zoom-image="<?php echo DOMAINADESTORE;?><?php echo $views['Estore_products']['images1'];?>">
                                                           <?php if($views['Estore_products']['images1']!=''){?>  <img src="<?php echo DOMAINADESTORE;?><?php echo $views['Estore_products']['images1'];?>" alt="Chaser Overalls" /><?php }?>
                                                            <?php if($views['Estore_products']['images1']==''){?> <img src="<?php echo DOMAINAD;?>clothingstore/img/db_file_img_2.jpg" data-zoom-image="<?php echo DOMAINAD;?>clothingstore/img/db_file_img_2.jpg" alt="Chaser Overalls" /><?php }?>
                                               
                                                        </a>
                                                    </li>
                                                     <?php if($views['Estore_products']['images2']!=''){?>
	                                                    <li>
	                                                        <a  href="#" data-image="<?php echo DOMAINADESTORE;?><?php echo $views['Estore_products']['images2'];?>" title="Chaser Overalls" data-zoom-image="<?php echo DOMAINADESTORE;?><?php echo $views['Estore_products']['images2'];?>">
	                                                            <img src="<?php echo DOMAINADESTORE;?><?php echo $views['Estore_products']['images2'];?>" alt="Chaser Overalls" />
	                                                            
	                                                        </a>
	                                                    </li>
                                                    <?php }?>
                                                    <?php if($views['Estore_products']['images3']!=''){?> 
                                                    <li>
                                                        <a  href="#" data-image="<?php echo DOMAINADESTORE;?><?php echo $views['Estore_products']['images3'];?>" title="Chaser Overalls" data-zoom-image="<?php echo DOMAINADESTORE;?><?php echo $views['Estore_products']['images3'];?>">
                                                            <img src="<?php echo DOMAINADESTORE;?><?php echo $views['Estore_products']['images3'];?>" alt="Chaser Overalls" />
                                                        </a>
                                                    </li>
                                                    <?php }?>
                                                    <?php if($views['Estore_products']['images4']!=''){?>
                                                    <li>
                                                        <a  href="#" data-image="<?php echo DOMAINADESTORE;?><?php echo $views['Estore_products']['images4'];?>" title="Chaser Overalls" data-zoom-image="<?php echo DOMAINADESTORE;?><?php echo $views['Estore_products']['images4'];?>">
                                                            <img src="<?php echo DOMAINADESTORE;?><?php echo $views['Estore_products']['images4'];?>" alt="Chaser Overalls" />
                                                        </a>
                                                    </li>
                                                    <?php }?>
                                                </ul>
                                            </div>

                                            <div class="social">
                                                <div id="sharrre">
                                                    <div class="facebook"> </div>
                                                    <div class="twitter"> </div>
                                                    <div class="googleplus"> </div>                                                   
                                                    <div class="pinterest"> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="span8">
                                    
                                    <!-- Product content -->
                                    <div class="product-content">
                                        <div class="box">

                                            <!-- Tab panels' navigation -->
                                            <ul class="nav nav-tabs">
                                                <li class="active">
                                                    <a href="#product" data-toggle="tab">
                                                        <i class="icon-reorder icon-large"></i>
                                                        <span class="hidden-phone">Product</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#description" data-toggle="tab">
                                                        <i class="icon-info-sign icon-large"></i>
                                                        <span class="hidden-phone">Info</span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="#shipping" data-toggle="tab">
                                                        <i class="icon-truck icon-large"></i>
                                                        <span class="hidden-phone">Shipping</span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="#returns" data-toggle="tab">
                                                        <i class="icon-undo icon-large"></i>
                                                        <span class="hidden-phone">Returns</span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="#ratings" data-toggle="tab">
                                                        <i class="icon-heart icon-large"></i>
                                                        <span class="hidden-phone">Ratings</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <!-- End Tab panels' navigation -->
                                            

                                            <!-- Tab panels container -->
                                            
                                            <div class="tab-content">
                                                
                                                <!-- Product tab -->
                                                <div class="tab-pane active" id="product">
                                                    <form enctype="multipart/form-data" action="#" onsubmit="return false;" method="post">
                                                        
                                                        <div class="details">
                                                            <h1><?php echo $views['Estore_products']['title'];?></h1>
                                                            <div class="prices"><span class="price">£<?php echo $views['Estore_products']['price'];?></span></div>

                                                            <div class="meta">
                                                                <div class="sku">
                                                                    <i class="icon-pencil"></i>
                                                                    <span rel="tooltip" title="SKU is <?php echo $views['Estore_products']['price'];?>"><?php echo $views['Estore_products']['price'];?></span>
                                                                </div>
															<!--  
                                                                <div class="categories">
                                                                    <span><i class="icon-tags"></i><a href="category.html" title="Dresses">Dresses</a></span>, <a href="category.html" title="Womens">Womens</a>
                                                                </div>
                                                           -->     
                                                            </div>
                                                        </div>

                                                        <div class="short-description">
                                                            <p><?php echo $views['Estore_products']['content'];?></p>
                                                        </div>
                                                        
                                                        <div class="options">
                                                            <div class="row-fluid">
                                                                <div class="span6">
                                                                    <div class="control-group">

                                                                        <label for="product_options" class="control-label">Leather</label>
                                                                        <div class="controls">
                                                                            <select id="product_options" name="product_options[]" class="span12">
                                                                                <option value="Brown">Brown</option>
                                                                                <option value="Black" selected="selected">Black</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="add-to-cart">
                                                            <button class="btn btn-primary btn-large" onclick="$('#added').modal('show')">
                                                                <i class="icon-plus"></i> &nbsp; Add to cart
                                                            </button>
                                                        </div>
                                                    </form>						
                                                </div>
                                                <!-- End id="product" -->
                                                
                                                <!-- Description tab -->
                                                <div class="tab-pane" id="description">
                                                    <p><span>Vintage-style faux leather short overalls. Long adjustable straps with brass detailing, exposed zip at back, and side slant pockets with single rear welt pocket.</span><br /><br />
                                                        <span>100% Polyester</span>
                                                    </p>						
                                                </div>
                                                <!-- End id="description" -->

                                                <!-- Shipping tab -->
                                                <div class="tab-pane" id="shipping">
                                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>
                                                    <p><img class="img-polaroid" src="<?php echo DOMAIN ?>clothingstore/http://www.tfingi.com/repo/royal-mail.png" alt="" /><img class="img-polaroid" src="<?php echo DOMAIN ?>clothingstore/http://www.tfingi.com/repo/ups-logo.png" alt="" /></p>
                                                    <p>Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                                                    <h6><em class="icon-gift"></em> Giftwrap?</h6>
                                                    <p>Let us take care of giftwrapping your presents by selecting <strong>Giftwrap</strong> in the order process. Eligible items can be giftwrapped for as little as &pound;0.99, and larger items may be presented in gift bags.</p>						
                                                </div>
                                                <!-- End id="shipping" -->

                                                <!-- Returns tab -->
                                                <div class="tab-pane" id="returns">
                                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                                                    <p class="lead">For any unwanted goods La Boutique offers a <strong>21-day return policy</strong>.</p>
                                                    <p>If you receive items from us that differ from what you have ordered, then you must notify us as soon as possible using our <a href="#">online contact form</a>.</p>
                                                    <p>If you find that your items are faulty or damaged on arrival, then you are entitled to a repair, replacement or a refund. Please note that for some goods it may be disproportionately costly to repair, and so where this is the case, then we will give you a replacement or a refund.</p>
                                                    <p>Please visit our <a href="#">Warranty section</a> for more details.</p>						
                                                </div>
                                                <!-- End id="returns" -->

                                                
                                                <!-- Ratings tab -->
                                                <div class="tab-pane" id="ratings">
                                                    <div class="ratings-items">

                                                        <article class="rating-item">
                                                            <div class="row-fluid">
                                                                <div class="span9">
                                                                    <h5>Shaped for crush</h5>
                                                                    <p>I hope they release some more colours of this dress. It feels great and looks sexier.<br>
                                                                        <br>
                                                                        I love it!</p>
                                                                </div>

                                                                <div class="span3">
                                                                    <img src="<?php echo DOMAIN ?>clothingstore/img/thumbnails/avatar.png" class="gravatar" alt="" />
                                                                    <h6>Sam Ritora</h6>
                                                                    <small>08/30/2013</small>
                                                                    <div  class="rating rating-5">
                                                                        <i class="icon-heart"></i>
                                                                        <i class="icon-heart"></i>
                                                                        <i class="icon-heart"></i>
                                                                        <i class="icon-heart"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </article>


                                                        <hr>
                                                    </div>

                                                    <div class="well">
                                                        <div class="row-fluid">
                                                            <div class="span8">
                                                                <h6><i class="icon-comment-alt"></i> &nbsp; Share your opinion!</h6>
                                                                <p>Let other people know your thoughts on this product!</p>
                                                            </div>
                                                            <div class="span4">
                                                                <button class="btn btn-seconary btn-block" onclick="$('#review_form').modal('show')">Rate this product</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Review modal window -->
                                                    <div id="review_form" class="modal hide fade" tabindex="-1" role="dialog">
                                                        <form enctype="multipart/form-data" action="/product/chaser-overalls" method="post">

                                                            <input type="hidden" name="ls_session_key" value="lsk52286509c22077.63404603"/>		
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <div class="hgroup title">
                                                                    <h3>Modal header</h3>
                                                                    <h5>Modal header</h5>
                                                                </div>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="row-fluid">
                                                                    <div class="span6">
                                                                        <div class="control-group">
                                                                            <label class="control-label">Rating</label>
                                                                            <div class="controls">
                                                                                <select  class="span12" name="rate">
                                                                                    <option value="1">1</option>
                                                                                    <option value="2">2</option>
                                                                                    <option value="3">3</option>
                                                                                    <option value="4">4</option>
                                                                                    <option value="5">5</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="span6">
                                                                        <div class="control-group">
                                                                            <label for="review_title" class="control-label">Review title</label>
                                                                            <div class="controls">
                                                                                <input class="span12" id="review_title" name="review_title" type="text"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row-fluid">
                                                                    <div class="span6">
                                                                        <div class="control-group">
                                                                            <label for="review_author_name" class="control-label">Your name</label>
                                                                            <div class="controls">
                                                                                <input class="span12" id="review_author_name" name="review_author_name" type="text" value=""/>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="span6">
                                                                        <div class="control-group">
                                                                            <label for="review_author_email" class="control-label">Your email</label>
                                                                            <div class="controls">
                                                                                <input class="span12" id="review_author_email" name="review_author_email" type="text" value="" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row-fluid">
                                                                    <div class="span12">
                                                                        <div class="control-group">
                                                                            <label for="review_text" class="control-label">Review</label>
                                                                            <div class="controls">
                                                                                <textarea class="span12" id="review_text" name="review_text"></textarea>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="modal-footer">
                                                                <div class="pull-right">
                                                                    <button class="btn btn-primary" type="submit" onclick="">Submit product review</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    
                                                    <!-- End id="review_form" -->

                                                </div>
                                                <!-- End id="ratings" -->
                                                
                                                
                                            </div>                                            
                                            <!-- End tab panels container -->
                                            
                                        </div>
                                        
                                    </div>                                    
                                    <!-- End class="product-content" -->
                                    
                                </div>


                            </div>
                        </div>
                    </section>
                    <!-- End class="product-info" -->

                    <!-- Product Reviews -->
                    <section class="product-reviews">
                        <div class="container">
                            <div class="span8 offset2">
                                <h5>Tell us why you <span class="script">love&#10084;</span> this product</h5>

                                <!-- Facebook comments -->
                                <div id="fb-root"></div>
                                <script>                            
                                    (function(d, s, id) {
                                        var js, fjs = d.getElementsByTagName(s)[0];
                                        if (d.getElementById(id))
                                            return;
                                        js = d.createElement(s);
                                        js.id = id;
                                        js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=460821237293986";
                                        fjs.parentNode.insertBefore(js, fjs);
                                    }(document, 'script', 'facebook-jssdk'));
                                </script>

                                <div class="fb-comments" data-width="730" data-href="http://la-boutique.twindots.com/product/chaser-overalls" data-num-posts="10"></div>
                                <!-- End Facebook comments -->
                                
                            </div>
                        </div>		
                    </section>
                    <!-- End class="product-reviews" -->
                    
                    <!-- Related products -->
                    <section class="product-related">
                        <div class="container">
                            <div class="span12">

                                <h5>Can't find what you're looking for? Why not try these&hellip;</h5>

                                <ul class="product-list isotope">
                                    <li class="standard" data-price="160">
                                        <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php //echo $pr['Estore_product']['id'];?>" title="1300 in Grey">

                                            <div class="image">
                                                <img class="primary" src="<?php echo DOMAIN ?>clothingstore/img/thumbnails/db_file_img_48_640xauto.jpg" alt="Lisette Dress" />
                                                <img class="secondary" src="<?php echo DOMAIN ?>clothingstore/img/thumbnails/db_file_img_49_640xauto.jpg" alt="Lisette Dress" />

                                            </div>

                                            <div class="title">
                                                <div class="prices"><span class="price">£160.00</span></div>
                                                <h3>1300 in Grey</h3>

                                            </div>

                                        </a>
                                    </li>
                                    <li class="standard" data-price="75">
                                        <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php //echo $pr['Estore_product']['id'];?>" title="574 In Navy">

                                            <div class="image">
                                                <img class="primary" src="<?php echo DOMAIN ?>clothingstore/img/thumbnails/db_file_img_32_640xauto.jpg" alt="El Silencio" />
                                                <img class="secondary" src="<?php echo DOMAIN ?>clothingstore/img/thumbnails/db_file_img_33_640xauto.jpg" alt="El Silencio" />

                                            </div>

                                            <div class="title">
                                                <div class="prices"><span class="price">£75.00</span></div>
                                                <h3>574 In Navy</h3>

                                            </div>

                                        </a>
                                    </li>
                                    <li class="standard" data-price="70">
                                        <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php //echo $pr['Estore_product']['id'];?>" title="574 In Red">

                                            <div class="image">
                                                <img class="primary" src="<?php echo DOMAIN ?>clothingstore/img/thumbnails/db_file_img_137_640xauto.jpg" alt="" />
                                                <img class="secondary" src="<?php echo DOMAIN ?>clothingstore/img/thumbnails/db_file_img_138_640xauto.jpg" alt="" />

                                            </div>

                                            <div class="title">
                                                <div class="prices"><span class="price">£70.00</span></div>
                                                <h3>574 In Red</h3>

                                            </div>

                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>	
                    </section>                    
                    <!-- End class="products-related" -->

                    <!-- Added to cart modal window -->
                    <div id="added" class="modal hide fade" tabindex="-1">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <div class="hgroup title">
                                <h3>You're one step closer to owning this product!</h3>
                                <h5>"Chaser Overalls" has been added to your cart</h5>
                            </div>
                        </div>
                        <div class="modal-footer">	
                            <div class="pull-right">				
                                <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/addshopingcart/<?php  //echo $pr['Estore_product']['id'];?>" class="btn btn-primary btn-small">
                                    Go to cart &nbsp; <i class="icon-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- End id="added" -->

                </section>
                <!-- End class="product-info" -->
                
            </section>
            <!-- End class="main" -->