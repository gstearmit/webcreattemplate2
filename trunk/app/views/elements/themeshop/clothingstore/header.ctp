<?php
$shop = explode ( '/', $this->params ['url'] ['url'] );
$shopname = $shop [0];
$shop = $this->requestAction ( 'comment/get_shop_id/' . $shopname );
foreach ( $shop as $key => $value ) {
	$shop_id = $key;
}



$user = $this->requestAction ( 'comment/get_user_id/' . $shop_id );
foreach ( $user as $user ) {
	$user_id = $user ['Shop'] ['user_id'];
}

$banner = $this->requestAction ( 'comment/get_banner/' . $user_id );

$tem = $this->requestAction ( 'comment/get_tem/' . $user_id );

foreach ( $tem as $tem ) {
	$template = $tem ['Tem']['linktems'];
}

?>

<!DOCTYPE html>
<html dir="ltr" lang="en" class="no-js">

    <head>
        <meta charset="UTF-8">

	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="Alatca" />

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<title>Home | La Boutique</title>


	<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN ?>clothingstore/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN ?>clothingstore/css/bootstrap-responsive.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN ?>clothingstore/css/font-awesome.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN ?>clothingstore/css/flexslider.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN ?>clothingstore/css/tfingi-megamenu-frontend.css" />


	<!-- Comment following two lines to use LESS -->
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN ?>clothingstore/css/core.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN ?>clothingstore/css/turquoise.css" id="color_scheme" />

	<!--
	<meta http-equiv="X-UA-Compatible" content="IE=7; IE=8" />-->
	<link rel="icon" href="favicon.ico" type="image/x-icon" />
	<link href="http://fonts.googleapis.com/css?family=Lato:300,300italic,400,400italic,700,700italic|Shadows+Into+Light" rel="stylesheet" type="text/css">
    </head>
    <body>

        <div class="wrapper">

<!-- Header -->
<div class="header">
    <!-- Top bar -->
    <div class="top">
        <div class="container">
            <div class="row">
                <div class="span6">
                    <p>
                       FreeMobiwe.mobi&mdash; <a href="http://freemobiweb.mobi/"><strong>Creat Now!</strong></a>
                    </p>
                </div>
                <div class="span6 hidden-phone">
                    <ul class="inline pull-right">
                        <li>
                            <a href="<?php echo DOMAIN?><?php echo $shopname ;?>/loginregister" title="Login / Register">Login / Register</a>									
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End class="top" -->

    <!-- Logo & Search bar -->
    <div class="bottom">
        <div class="container">
            <div class="row">
                <div class="span8">							
                    <div class="logo">
                        <a href="<?php echo DOMAIN.$shopname?>" title="&larr; Back home">
                            <img src="<?php echo DOMAIN ?>clothingstore/img/logo.png" alt="La Boutique" />
                        </a>
                    </div>
                </div>

                <div class="span4">
                    <div class="row-fluid">
                        <div class="span10">
                            
                            <!-- Search -->
                            <div class="search">
                                <div class="qs_s">

                                    <form method="post" action="#">
                                        <input type="text" name="query" id="query" placeholder="Search&hellip;" autocomplete="off" value="">
                                    </form>

                                    <!-- Autocomplete results -->
                                    <div id="autocomplete-results" style="display: none;">	
                                        <ul>
                                            <li>
                                                <a title="Lisette Dress" href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php //echo $pr['Estore_product']['id'];?>">
                                                    <div class="image">
                                                        <img src="<?php echo DOMAIN ?>clothingstore/img/db_file_img_48_60x60.jpg" alt="" />
                                                    </div>
                                                    <h6>Lisette Dress</h6>
                                                </a>
                                            </li>
                                            <li>
                                                <a title="Malta Dress" href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php //echo $pr['Estore_product']['id'];?>">
                                                    <div class="image">
                                                        <img src="<?php echo DOMAIN ?>clothingstore/img/db_file_img_137_60x60.jpg" alt="" />
                                                    </div>
                                                    <h6>Malta Dress</h6>
                                                </a>
                                            </li>
                                            <li>
                                                <a title="Marais Dress" href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php //echo $pr['Estore_product']['id'];?>">
                                                    <div class="image">
                                                        <img src="<?php echo DOMAIN ?>clothingstore/img/db_file_img_42_60x60.jpg" alt="" />
                                                    </div>
                                                    <h6>Marais Dress</h6>
                                                </a>
                                            </li>
                                            <li>
                                                <a title="Millay Dress" href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php //echo $pr['Estore_product']['id'];?>">
                                                    <div class="image">
                                                        <img src="<?php echo DOMAIN ?>clothingstore/img/db_file_img_107_60x60.jpg" alt="" />
                                                    </div>
                                                    <h6>Millay Dress</h6>
                                                </a>
                                            </li>
                                            <li>
                                                <a title="Momoko Dress" href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php //echo $pr['Estore_product']['id'];?>">
                                                    <div class="image">
                                                        <img src="<?php echo DOMAIN ?>clothingstore/img/db_file_img_132_60x60.jpg" alt="" />
                                                    </div>
                                                    <h6>Momoko Dress</h6>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- End id="autocomplete-results" -->
                                    
                                    
                                    
                                </div>
                            </div>
                            <!-- End class="search"-->
                            
                        </div>

                        <div class="span2">
                            
                            <!-- Mini cart -->
                            <div class="mini-cart">
                                <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/viewshopingcart" title="Go to cart &rarr;">
                                    <span>3</span>
                                </a>									
                            </div>
                            <!-- End class="mini-cart" -->
                            
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- End class="bottom" -->
    
</div>
<!-- End class="header" -->            <!-- Navigation -->
<nav class="navigation">
    <div class="container">
     
        <div class="row">
            <div class="span9">
                
				<a href="#" class="main-menu-button">Navigation</a>
				<!-- Begin Menu Container -->
				<div class="megamenu_container">
				    <div class="menu-main-navigation-container">
				        <ul id="menu-main-navigation" class="main-menu">
				            <li class="menu-item-home menu-item-has-children megamenu-parent " data-width=""><a href="<?php echo DOMAIN;?><?php echo $shopname ;?>">Home</a>
				                <ul class="sub-menu">
				                    <li class="megamenu-heading"><a href="#MegaMenuHeading"><h3>About Us</h3></a></li>
				                    <li class="menu-item-has-children megamenu-column">
				                        <a href="#MegaMenuColumn">Mega Menu Column</a>
				                          <ul class="sub-menu">
				                          <?php $setting = $this->requestAction('/'.$shopname.'/setting'); ?>
                                          <?php  foreach($setting as $settings ){  ?>
										    <li class="megamenu-heading"><a href="#MegaMenuHeading"><?php echo $settings['Estore_settings']['name_en'];?></a></li>
				                            <li class="megamenu-content">
				                                <p><img title="" alt="" src="<?php echo DOMAIN ?>clothingstore/img/img01.jpg"></p>
				                                <p><?php echo $settings['Estore_settings']['info_other'];?> </p>
				                            </li>
				                            <?php }?>
				                        </ul>
				                    </li>
				                    <?php //pr($session->read('language'));?>
				                     <?php $video = $this->requestAction('/'.$shopname.'/videos/'.$shop_id) ?>
			                         <li class="menu-item-has-children megamenu-column"><a href="#MegaMenuColumn">Mega Menu Column</a>
				                        <ul class="sub-menu">
				                         <?php  foreach($video as $video){?> 
			                            <?php 
			                            $url = $video['estore_videos']['LinkUrl'];
			                            parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );     
			                            ?>
			                          
				                            <li class="megamenu-heading"><a href="#MegaMenuHeading">videos</a></li>
				                            <li class="megamenu-content">
						                            <p> 
						                             <iframe width="202px" height="202px" src="http://www.youtube.com/embed/<?php echo $my_array_of_vars['v'];?>" frameborder="0" allowfullscreen></iframe>
					                               </p>
				                                <p><?php echo $video['estore_videos']['name'];?></p></li>
				                            <?php }?>
				                        </ul>
				                    </li>
				                   
													                    
				                    <li class="menu-item-has-children megamenu-column"><a href="#MegaMenuColumn">Mega Menu Column</a>
				                        <ul class="sub-menu">
				                            <li class="megamenu-heading"><a href="#MegaMenuHeading">And Google maps!</a></li>
				                            <li class="megamenu-content">
				                       <?php $setting = $this->requestAction('/'.$shopname.'/setting'); ?>
                                       <?php  foreach($setting as $settings ){  ?>
										 <p><?php echo $settings['Estore_settings']['map'];?>  </p>
				                                <p>
				                                    <strong><?php echo $settings['Estore_settings']['name_en'];?></strong><br>
				                                    <em class="icon-map-marker icon-large"></em><?php echo $settings['Estore_settings']['address_eg'];?><br>
				                                    <em class="icon-phone icon-large"></em> <?php echo $settings['Estore_settings']['phone'];?><br>
				                                    <em class="icon-eye-open icon-large"></em> <?php echo $settings['Estore_settings']['mobile'];?><br>
				                                    <em class="icon-envelope icon-large"></em> <?php echo $settings['Estore_settings']['email'];?><br>
				                               
				                               
				                                </p>
				                        <?php }?>
				                            </li>
				                        </ul>
				                    </li>
				                    
				                    
				                </ul>
				            </li>
				            <li class="menu-item-has-children"><a href="category.html">Shop</a>
				                <ul class="sub-menu">
				                    <li class="menu-item-has-children"><a href="category.html">Womens</a>
				                        <ul class="sub-menu">
				                            <li><a href="category.html">Dresses</a></li>
				                            <li><a href="category.html">Tops</a></li>
				                            <li>
				                                <a href="category.html" title="Shirts">Shirts</a>
				                            </li>
				                            <li>
				                                <a href="category.html" title="Shoes">Shoes</a>
				                            </li>
				                            <li class="menu-item-has-children"><a href="#_" title="Accesories">Accesories</a>
				
				                                <ul>
				
				                                    <li><a href="category.html" title="Hats">Hats</a></li>
				                                    <li><a href="category.html" title="Belts">Belts</a></li>
				                                    <li><a href="category.html" title="Socks">Socks</a></li>
				
				                                    <li class="menu-item-has-children"><a href="#_" title="More levels"><strong>And much more...</strong></a>
				
				                                        <ul>
				
				                                            <li><a href="#_" title="Earphones">Earphones</a></li>
				                                            <li><a href="#_" title="Headphones">Headphones</a></li>
				                                            <li><a href="#_" title="Sunglasses">Sunglasses</a></li>
				
				                                        </ul>
				
				                                    </li>
				
				                                </ul>
				
				                            </li> 
				
				                        </ul>
				                    </li>
				                    <li class="menu-item-has-children"><a href="category.html">Mens</a>
				                        <ul class="sub-menu">
				                            <li><a href="category.html">Shoes</a></li>
				                            <li ><a href="category.html">Accesories</a></li>
				                            <li>
				                                <a href="category.html" title="Shirts">Shirts</a>
				                            </li>
				                            <li>
				                                <a href="category.html" title="Shoes">Shoes</a>
				                            </li>
				                        </ul>
				                    </li>
				                    <li class="menu-item-has-children"><a href="category.html">Girls</a>
				                        <ul class="sub-menu">
				                            <li><a href="category.html">Dresses</a></li>
				                            <li><a href="category.html">Tops</a></li>
				                            <li>
				                                <a href="category.html" title="Shirts">Shirts</a>
				                            </li>
				                            <li>
				                                <a href="category.html" title="Shoes">Shoes</a>
				                            </li>
				                            <li class="menu-item-has-children"><a href="#_" title="Accesories">Accesories</a>
				
				                                <ul>
				
				                                    <li><a href="category.html" title="Hats">Hats</a></li>
				                                    <li><a href="category.html" title="Belts">Belts</a></li>
				                                    <li><a href="category.html" title="Socks">Socks</a></li>
				
				                                    <li class="menu-item-has-children"><a href="#_" title="More levels"><strong>And much more...</strong></a>
				
				                                        <ul>
				
				                                            <li><a href="#_" title="Earphones">Earphones</a></li>
				                                            <li><a href="#_" title="Headphones">Headphones</a></li>
				                                            <li><a href="#_" title="Sunglasses">Sunglasses</a></li>
				
				                                        </ul>
				
				                                    </li>
				
				                                </ul>
				
				                            </li> 
				
				                        </ul>
				                    </li>
				                    <li><a href="category.html" title="Sale">Sale</a></li>
				                </ul>
				            </li>
				            
				            
				            
				            
				            <li ><a href="<?php echo DOMAIN?><?php echo $shopname ;?>/indexcomments">Blog</a></li>
				            <li ><a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/viewshopingcart">Cart</a></li>
				            <li class="menu-item-has-children megamenu-parent" data-width="400">
				                <a href="contact-us.html">Contact Us</a>
				                <ul class="sub-menu">
				                    <li class="megamenu-column"><a href="#MegaMenuColumn">Mega Menu Column</a></li>
				                    <li class="megamenu-heading"><a href="#MegaMenuHeading">Contact Us</a></li>
				                    <li class="megamenu-content">
				                        <div class="wpcf7">
				                            <form action="" method="post" class="wpcf7-form" novalidate="novalidate">
				                                <label>Your Name (required)</label>
				                                <input type="text" name="your-name" value="" size="40"  aria-required="true" />
				                                <label>Your Email (required)</label>
				                                <input type="email" name="your-email" value="" size="40" aria-required="true" />
				                                <label>Subject</label>
				                                <input type="text" name="your-subject" value="" size="40"  />
				                                <label>Your Message</label>
				                                <textarea name="your-message" cols="40" rows="10" ></textarea>
				
				                                <input type="submit" value="Send" class="btn btn-primary" />
				                            </form>
				                        </div>
				                    </li>
				                </ul>
				            </li>
				        </ul>
				    </div>    
				</div>    


            </div>

            <div class="span3 visible-desktop">
                            </div>
        </div>        
    
    </div>
</nav>
<!-- End class="navigation" -->

