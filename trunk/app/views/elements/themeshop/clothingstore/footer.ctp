<?php
$shop = explode ( '/', $this->params ['url'] ['url'] );
$shopname = $shop [0];
$shop = $this->requestAction ( 'comment/get_shop_id/' . $shopname );
foreach ( $shop as $key => $value ) {
	$shop_id = $key;
}
?>
<!-- Twitter bar -->
<div class="twitter-bar">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="icon">
                    <i class="icon-twitter"></i>
                </div>
                <div id="tweets" data-username="lemonstand">

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End class="twitter-bar" -->            
<!-- Footer -->
<?php /* ?>
<div class="footer">

    <div class="container">
        <div class="row">	
                        
            <div class="span2">
                <!-- Support -->
                <div class="support">
                    <h6>Support</h6>

                    <ul class="links">
                        <li>
                            <a href="about-us.html" title="About us" class="title">About us</a>
                        </li>
                        <li>
                            <a href="typography.html" title="Typography" class="title">Typography</a>
                        </li>
                        <li>
                            <a href="retina-ready-icons.html" title="Retina-ready icons" class="title">Retina-ready icons</a>
                        </li>
                        <li>
                            <a href="buttons.html" title="Buttons" class="title">Buttons</a>
                        </li>
                        <li>
                            <a href="elements.html" title="Elements" class="title">Elements</a>
                        </li>
                        <li>
                            <a href="grids.html" title="Grids" class="title">Grids</a>
                        </li>
                        <li>
                            <a href="store-locator.html" title="Store locator" class="title">Store locator</a>
                        </li>
                        <li>
                            <a href="contact-us.html" title="Contact us" class="title">Contact us</a>
                        </li>											
                    </ul>
                </div>
                <!-- End class="support" -->

                <hr />

                <!-- My account -->
                <div class="account">
                    <h6>My account</h6>

                    <ul class="links">								
                        <li>
                            <a href="<?php echo DOMAIN?><?php echo $shopname ;?>/loginregister" title="Login / Register">Login / Register</a>									
                        </li>
                    </ul>
                </div>
                <!-- End class="account"-->
                
            </div>

            <div class="span2">
                
                <!-- Categories -->
                <div class="categories">
                    <h6>Shop</h6>

                    <ul class="links">
                        <li>
                            <a href="category.html" title="Women">Women</a>
                        </li>
                        <li>
                            <a href="category.html" title="Men">Men</a>
                        </li>
                        <li>
                            <a href="category.html" title="Girls">Girls</a>
                        </li>
                        <li>
                            <a href="category.html" title="Boys">Boys</a>
                        </li>
                      <li>
                            <a href="category.html" title="Sale"><strong>Sale</strong></a>
                        </li>
                    </ul>
                </div>
                <!-- End class="categories" -->

                <hr />

                <!-- Pay with confidence -->
                <div class="confidence">
                    <h6>Pay with confidence</h6>

                    <img src="<?php echo DOMAIN ?>clothingstore/img/stripe.png" alt="We accept all major credit cards" /> 
                </div>
                <!-- End class="confidence" -->
            </div>

            <div class="span4">
                <h6>From the blog</h6>

                <ul class="list-chevron links">
                    <li>
                        <a href="blog-post.html">Article with video</a>
                        <small>05/01/2013</small>
                    </li>
                    <li>
                        <a href="blog-post.html">Article with images</a>
                        <small>03/14/2013</small>
                    </li>
                    <li>
                        <a href="blog-post.html">Article with style!</a>
                        <small>08/31/2013</small>
                    </li>
                </ul>
            </div>

            <div class="span4">				

                <!-- Newsletter subscription -->
                <div class="newsletter">
                    <h6>Newsletter subscription</h6>

                    <form onsubmit="$('#newsletter_subscribe').modal('show'); return false;" enctype="multipart/form-data" action="index.html" method="post">                       
                        
                        <div class="input-append">
                            <input type="text" class="span3" name="email" />
                            <button class="btn" type="submit">Go!</button>
                        </div>                       

                    </form>								

                    <p>Sign up to receive our latest news and updates direct to your inbox</p>
                </div>
                <!-- End class="newsletter" -->
                

                <hr />
                
                <!-- Social icons -->
                <div class="social">
                    <h6>Socialize with us</h6>

                    <ul class="social-icons">

                        <li>
                            <a class="twitter" href="#" title="Twitter">Twitter</a>								
                        </li>

                        <li>
                            <a class="facebook" href="#" title="Facebook">Facebook</a>								
                        </li>

                        <li>
                            <a class="pinterest" href="#" title="Pinterest">Pinterest</a>								
                        </li>

                        <li>
                            <a class="youtube" href="#" title="YouTube">YouTube</a>								
                        </li>

                        <li>
                            <a class="vimeo" href="#" title="Vimeo">Vimeo</a>								
                        </li>

                        <li>
                            <a class="flickr" href="#" title="Flickr">Flickr</a>								
                        </li>

                        <li>
                            <a class="googleplus" href="#" title="Google+">Google+</a>								
                        </li>

                        <li>
                            <a class="dribbble" href="#" title="Dribbble">Dribbble</a>								
                        </li>

                        <li>
                            <a class="tumblr" href="#" title="Tumblr">Tumblr</a>								
                        </li>

                        <li>
                            <a class="digg" href="#" title="Digg">Digg</a>								
                        </li>

                        <li>
                            <a class="linkedin" href="#" title="LinkedIn">LinkedIn</a>								
                        </li>

                        <li>
                            <a class="instagram" href="#" title="Instagram">Instagram</a>								
                        </li>

                    </ul>
                </div>
                <!-- End class="social" -->

            </div>
        </div>
    </div>
  
</div>
  <?php */ ?>
<!-- End id="footer" -->
            <!-- Credits bar -->
<div class="credits">
    <div class="container">
        <div class="row">
            <div class="span8">
                <p>&copy; 2014 <a href="http://freemobiweb.mobi" title="Terms &amp; Conditions">Alatca &amp; Freemobi.mobi</a> &middot; <a href="http://freemobiweb.mobi" title="Privacy policy">Freemobiweb</a> &middot; All Rights Reserved. </p>
            </div>
            <div class="span4 text-right hidden-phone">
                <p><a href="http://freemobiweb.mobi/e-commerce/" title="Eshop Creat template">Eshop Creat template</a></p>
            </div>
        </div>
    </div>
</div>
<!-- End class="credits" -->            <!-- Options panel -->
<div class="options-panel">
    <div class="options-panel-content">

        <div class="row-fluid">
            <div class="span12">
                <div class="control-group">
                    <label for="option_color_scheme" class="control-label">Color scheme</label>
                    <div class="controls">
                        <select name="option_color_scheme" id="option_color_scheme" class="span12">
                            <option value="css/turquoise.css">Turquoise</option>
                            <option value="css/greensea.css">Green sea</option>
                            <option value="css/emerland.css">Emerland</option>
                            <option value="css/nephritis.css">Nephritis</option>
                            <option value="css/peterriver.css">Peter river</option>
                            <option value="css/belizehole.css">Belizehole</option>
                            <option value="css/amethyst.css">Amethyst</option>
                            <option value="css/wisteria.css">Wisteria</option>
                            <option value="css/wetasphalt.css">Wet asphalt</option>
                            <option value="css/midnightblue.css">Midnight blue</option>
                            <option value="css/sunflower.css">Sunflower</option>
                            <option value="css/orange.css">Orange</option>
                            <option value="css/carrot.css">Carrot</option>
                            <option value="css/pumpkin.css">Pumpkin</option>
                            <option value="css/alizarin.css">Alizarin</option>
                            <option value="css/pomegranate.css">Pomegranate</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- End class="options-panel" -->
            
<!-- Newsletter modal window -->
<div id="newsletter_subscribe" class="modal hide fade" tabindex="-1">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <div class="hgroup title">
            <h3>You are now subscribed to our newsletter</h3>
            <h5>All the latest deals and offers will be making their way to your inbox shortly!</h5>
        </div>
    </div>

    <div class="modal-footer">	
        <div class="pull-left">
            <button data-dismiss="modal" aria-hidden="true" class="btn btn-small">
                Close &nbsp; <i class="icon-ok"></i>
            </button>
        </div>
    </div>
</div>
<!-- End id="newsletter_subscribe" -->          
        </div>
        <!-- BEGIN JAVASCRIPTS -->
<!--[if lt IE 9]>
<script src="<?php echo DOMAIN ?>clothingstore/js/html5shiv.js"></script>
<![endif]-->
<script type="text/javascript" src="<?php echo DOMAIN ?>clothingstore/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo DOMAIN ?>clothingstore/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo DOMAIN ?>clothingstore/http://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>


<script type="text/javascript" src="<?php echo DOMAIN ?>clothingstore/js/jquery-ui-1.10.2.custom.js"></script>
<script type="text/javascript" src="<?php echo DOMAIN ?>clothingstore/js/jquery.easing-1.3.min.js"></script>
<script type="text/javascript" src="<?php echo DOMAIN ?>clothingstore/js/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo DOMAIN ?>clothingstore/js/jquery.isotope.min.js"></script>
<script type="text/javascript" src="<?php echo DOMAIN ?>clothingstore/js/jquery.flexslider.js"></script>
<script type="text/javascript" src="<?php echo DOMAIN ?>clothingstore/js/jquery.elevatezoom.js"></script>
<script type="text/javascript" src="<?php echo DOMAIN ?>clothingstore/js/jquery.sharrre-1.3.4.js"></script>
<script type="text/javascript" src="<?php echo DOMAIN ?>clothingstore/js/jquery.gmap3.js"></script>
<script type="text/javascript" src="<?php echo DOMAIN ?>clothingstore/js/jquery.tweet.js"></script>
<script type="text/javascript" src="<?php echo DOMAIN ?>clothingstore/js/imagesloaded.js"></script>
<script type="text/javascript" src="<?php echo DOMAIN ?>clothingstore/js/la_boutique.js"></script>
<script type="text/javascript" src="<?php echo DOMAIN ?>clothingstore/js/tfingi-megamenu-frontend.js"></script>



<!--preview only-->
<script type="text/javascript" src="<?php echo DOMAIN ?>clothingstore/js/jquery.cookie.js"></script>
<!-- END JAVASCRIPTS -->    </body>
</html>