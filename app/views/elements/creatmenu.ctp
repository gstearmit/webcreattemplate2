 <?php 
//  echo "Hoang PHucs";
//  //if(isset($this->Session->read('language')))
//  pr($this->Session->read('language'));//die;
//  pr( __('home'));
 ?>
 <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
   <div class="container">
                <div class="navbar-header header-sty">
                  <a href="<?php echo DOMAIN ?>" class="navbar-brand"><img class='logo_ez img-responsive' src="<?php echo DOMAIN ?>webcreathtml/img/layout3-1/AlatcaLogo2.png" ></a>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
               </div><!-- class="navbar-header" --> 

                <div class="collapse navbar-collapse navbar-ex1-collapse menu-scrool " role="navigation">
                <!-- id="headerMenu" -->
                    <ul  class="nav navbar-nav navbar-right nav_top menu-top">
                    <?php  $langs= null;
                    $urlcart = DOMAIN;
                    if(isset($_GET['language'])){
                    $abc=$_GET['language'];
                    if($abc =='vie'){
                    	$langs="?language=vie";
                    }
                    if($abc=='eng'){
						$langs ="?language=eng";
					}
					$url = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
					$de=DOMAIN.$langs;
					if($url!=$de){
					$url1 = str_replace(DOMAIN, "", $url);
					$url12 = split("[?]", $url1);
					//$urlcart1 = split("[/]", $url12[0]);
					$urlcart = $url12[0];
					}
					}else{
						$url = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
						$urlcart=$url;
					}
					
					
					 
                    ?>
                        <li class="active"><a href="<?php echo DOMAIN ?><?php echo $langs; ?>"><?php __('home') ?></a></li>
                        <li><a rel="bookmark" href="<?php echo DOMAIN ?>personal-websites/<?php echo $langs; ?> "><span><?php __('Personalwebsite') ?></span><i></i></a></li>
						<li><a rel="bookmark" href="<?php echo DOMAIN ?>business-websites/<?php echo $langs; ?>"><span><?php __('Businesswebsite') ?></span><i> </i></a></li>
						<li><a rel="bookmark" href="<?php echo DOMAIN ?>e-commerce/<?php echo $langs; ?> "><span><?php __('ecommerce') ?></span><i> </i></a></li>
						<li id="loginLink"><a href="<?php echo DOMAIN ?>sign-in" id="loginLinkBtn" ><span><?php __('signin') ?></span><i> </i></a></li>
						<li id="languediv"><a href="<?php echo $urlcart ?>?language=vie"><img id="langgue" align="absmiddle" src="<?php echo DOMAIN ?>images/vietnam.gif" />Tiếng Việt</a></li>
					   <li id="languediv"><a href="<?php echo $urlcart ?>?language=eng"><img  id="langgue" align="absmiddle" src="<?php echo DOMAIN ?>images/english.gif" />English</a></li>
						
						<!--
                        <li><a href="pricing.html" id='color1-menu'>M'INSCRIRE</a></li>
                        <li><a href="pricing.html" id='color-menu'>CONNEXION</a></li>
						-->
						
                    </ul>
                </div><!--  class="collapse navbar-collapse navbar-ex1-collapse" role="navigation" -->

            </div><!-- class="container"-->


</div><!-- class="navbar navbar-inverse navbar-fixed-top" role="navigation" -->