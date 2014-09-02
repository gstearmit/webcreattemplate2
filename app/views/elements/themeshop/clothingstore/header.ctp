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
                            <!-- <a href="<?php echo DOMAIN?><?php echo $shopname ;?>/loginregister" title="Login / Register">Login / Register</a>  -->
                            <a href="<?php echo DOMAINADESTORE?>" title="Login / Register">Login / Register</a>
                            									
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

                                    <form method="post" action="<?php echo DOMAIN;?><?php echo $shopname ;?>/search">
                                        <input type="text" name="query" id="query" placeholder="Search&hellip;" autocomplete="off" value="">
                                    </form>

                                    <!-- Autocomplete results -->
                                    <div id="autocomplete-results" style="display: none;">	
                                        <ul>
                                        	<?php 
                                        	$allproduct = $this->requestAction('/'.$shopname.'/validatesearch');
                                        	 ?>
                                        	 <?php foreach($allproduct as $product ){  ?>
                                            <li>
                                                <a title="Lisette Dress" href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php echo $product['Estore_products']['id'];?>">
                                                    <div class="image">
                                                        <img src="<?php echo DOMAINADESTORE.$product['Estore_products']['images']?>" alt="" />
                                                    </div>
                                                    <h6><?php echo $product['Estore_products']['title'] ;?></h6>
                                                </a>
                                            </li>
                                            <?php }?>
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
                                    <span><?php if(isset($_SESSION['shopingcart']))
                                            { $sl=count($_SESSION['shopingcart']) ;
                                            echo $sl;
                                            }else {echo "0"; }?></span>
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
				            <li class="menu-item-has-children"><a href="#">Products</a>
				              <?php $root = $this->requestAction('/'.$shopname.'/danhmuc/'.$shopname); ?>
				                <?php  foreach ($root as $value){?>
				                <ul class="sub-menu">
				                    <li class="menu-item-has-children"><?php if($value['estore_catproducts']['name'] !='') {?><a href='#' class="title"><?php echo $value['estore_catproducts']['name'];?></a> <?php }?>
				                     <?php $category = $this->requestAction('/'.$shopname.'/showsmenu1/'.$value['estore_catproducts']['id']);
                                           if(is_array($category) and !empty($category)){?>
				                        <ul class="sub-menu">
				                         <?php foreach($category as $k=>$subcat){?>
							                 <?php $categorys = $this->requestAction('/'.$shopname.'/showsmenu2/'.$subcat['estore_catproducts']['id']);
							                   if(!empty($categorys)){?>
							                      <li class="menu-item-has-children"><a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/listproduct/<?php echo $subcat['estore_catproducts']['id']?>" title="<?php echo $subcat['estore_catproducts']['name']?>"><?php echo $subcat['estore_catproducts']['name']?></a>
                                                       <ul>
						                                  <?php foreach($categorys as $k=>$subcats){?>
							                                    <li><a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/listproduct/<?php echo $subcats['estore_catproducts']['id']?>" title="<?php echo $subcats['estore_catproducts']['name']?>"><?php echo $subcats['estore_catproducts']['name']?></a></li>
							                                     <?php } ?>
						                                </ul>
						
						                            </li> 
							                   <?php }else {
				                                	?>
				                                	  <?php if($subcat['estore_catproducts']['name'] !='') {?>  <li><a href='<?php echo DOMAIN;?><?php echo $shopname ;?>/listproduct/<?php echo $subcat['estore_catproducts']['id']?>'><?php echo $subcat['estore_catproducts']['name']?></a></li> <?php }?>
				                              <?php  } }?>
				                               
				                        </ul>
				                    <?php  }?>   
				                    </li>		                    
				                </ul>
				             <?php }//end for?> 
				            </li>
				            
				            <!-- 
				             <li class="menu-item-has-children"><a href="category.html">Products</a>
				                <ul class="sub-menu">
				                <?php $root = $this->requestAction('/'.$shopname.'/danhmuc/'.$shopname); ?>
				                <?php  foreach ($root as $value){?>
				                    <li class="menu-item-has-children"><?php if($value['estore_catproducts']['name'] !='') {?><a href='#' class="title"><?php echo $value['estore_catproducts']['name'];?></a> <?php }?>
				                      <?php $category = $this->requestAction('/'.$shopname.'/showsmenu1/'.$value['estore_catproducts']['id']);
                                           if(is_array($category) and !empty($category)){?>
				                        <ul class="sub-menu">
				                           <?php foreach($category as $k=>$subcat){?>
							                 <?php $categorys = $this->requestAction('/'.$shopname.'/showsmenu2/'.$subcat['estore_catproducts']['id']);
							                   if(!empty($categorys)){?>
							                        <li class="menu-item-has-children"><a href="#_" title="<?php echo $subcat['estore_catproducts']['name']?>"><?php echo $subcat['estore_catproducts']['name']?></a>
				                                            <ul>
							                                   <?php foreach($categorys as $k=>$subcats){?>
							                                    <li><a href="category.html" title="Hats">Hats</a></li>
							                                     <?php } ?>
							                                </ul>
							                        </li> 
												<?php }else {
				                                	?>
				                                	  <?php if($subcat['estore_catproducts']['name'] !='') {?>  <li><a href='<?php echo DOMAIN;?><?php echo $shopname ;?>/listproduct/<?php echo $subcat['estore_catproducts']['id']?>'class="title"><?php echo $subcat['estore_catproducts']['name']?></a></li> <?php }?>
				                              <?php  }?>
				                        
				                        </ul>
				                        <?php }}?>
				                    </li>
				                   <?php }//end for?> 
				                    
				                   
				                   
				                </ul>
				            </li>
				             -->
				            
				            
				            <!-- <li ><a href="<?php echo DOMAIN?><?php echo $shopname ;?>/indexcomments">Blog</a></li>  -->
				            <li ><a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/viewshopingcart">Cart</a></li>
				            <li class="menu-item-has-children megamenu-parent" data-width="400">
				                <a href="#">Contact Us</a>
				                <ul class="sub-menu">
				                    <li class="megamenu-column"><a href="#MegaMenuColumn">Mega Menu Column</a></li>
				                    <li class="megamenu-heading"><a href="#MegaMenuHeading">Contact Us</a></li>
				                    <li class="megamenu-content">
				                        <div class="wpcf7">
				                            <form  id="check_form" action="<?php echo DOMAIN.$shopname; ?>/sendcontacts" method="post" class="wpcf7-form" novalidate="novalidate">
				                                <label>Your Name (required)</label>
				                                <input type="text"  id="input" name="name" class="validate[required]" type="text" value="" size="40"  aria-required="true" />
				                                <label>Your Email (required)</label>
				                                <input type="email" id="input" type="text"  class="validate[required,custom[email]]" name="email" value="" size="40" aria-required="true" />
				                                <label>Subject</label>
				                                <input type="text"  id="input" type="text" class="validate[required]" name="title" value="" size="40"  />
				                                <label>Your Message</label>
				                                <textarea  name="content" cols="40" rows="10" ></textarea>
				
				                                <input type="submit" value="Send" class="btn btn-primary" />
				                                <input type="reset" value="reset" class="btn btn-primary" />
				                            </form>
				                        </div>
				                    </li>
				                </ul>
				            </li>
				        </ul>
				    </div>    
				</div>    


            </div>

            <div class="span3 visible-desktop"></div>
        </div>        
    
    </div>
</nav>
<!-- End class="navigation" -->

