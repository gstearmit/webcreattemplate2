   <?php  $langs= null;
                    $urlcart ="";
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
					$urlcart = DOMAIN.$url12[0];
					}
					}else{
						$url = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
						$urlcart=$url;
					}
					
					
					 
                    ?>
    <div id="sidebar">
       <div id="sidebar-wrapper"> 
         <a id="langgue" href="<?php echo $urlcart ?>?language=vie"><img id="langgue" align="absmiddle" src="<?php echo DOMAIN ?>images/vietnam.gif" />Tiếng Việt</a>
	<a  id="langgue" href="<?php echo $urlcart ?>?language=eng"><img  id="langgue" align="absmiddle" src="<?php echo DOMAIN ?>images/english.gif" />English</a>
        <h1 id="sidebar-title"><a href="#"></a></h1>
        <a href="#"><img id="logo" src="<?php echo DOMAINAD?>images/logo.png" alt="Design by Quảng cáo vip" /></a>
      
        <div id="profile-links">
             <?php __('hello')?>, <a href="#" title="Edit your profile"><?php echo $this->Session->read('name'); ?></a><br />
            <br />
            <a href="<?php echo DOMAIN;?>" title="View the Site" target="_blank"><?php __('home_page')?></a> | <a href="<?php echo DOMAINAD?>login/logout" title="Sign Out"><?php __('Logout')?></a>
        </div>        
        <div id="list">
          <ul id="main-nav"> 
            
            <li id="arrayorder_1">
                <a href="<?php echo DOMAINADBUSINISS?>home<?php echo $langs ?>" class="nav-top-item no-submenu">
                    <?php __('home')?>
                </a>       
            </li>
           
            <li id="arrayorder_2">
                <a href="#" class="nav-top-item"> 
                 <?php __('product')?>
                </a>
                <ul>
                    <li><a class="current" href="<?php echo DOMAINADBUSINISS?>catproducts/index<?php echo $langs ?>"><?php __('Category_product')?></a></li>
                    <li><a href="<?php echo DOMAINADBUSINISS?>catproducts/add<?php echo $langs ?>"><?php __('Add_Category')?></a></li>
                    <li><a href="<?php echo DOMAINADBUSINISS?>products/index<?php echo $langs ?>"><?php __('Product_list')?></a></li>
                    <li><a href="<?php echo DOMAINADBUSINISS?>products/add<?php echo $langs ?>"><?php __('Add_product')?></a></li>
                </ul>
            </li>
            
            <li id="arrayorder_3">
                <a href="#" class="nav-top-item"> 
                  <?php __('News')?>
                </a>
                <ul>
                    <li><a class="current" href="<?php echo DOMAINADBUSINISS?>category/index<?php echo $langs ?>"><?php __('News_category')?></a></li>
                    <li><a href="<?php echo DOMAINADBUSINISS?>category/add<?php echo $langs ?>"><?php __('Add_category_news')?></a></li>
                    <li><a href="<?php echo DOMAINADBUSINISS?>news/index<?php echo $langs ?>"><?php __('News_list')?></a></li>
                    <li><a href="<?php echo DOMAINADBUSINISS?>news/add<?php echo $langs ?>"><?php __('Add_news')?></a></li>
                </ul>
            </li>
            <li id="arrayorder_4">
                <a href="#" class="nav-top-item">
                    <?php __('Slideshow_management')?>
                </a>
                <ul>
                    <li><a href="<?php echo DOMAINADBUSINISS?>slideshow<?php echo $langs ?>"><?php __('Slide_image')?></a></li>
                    <li><a href="<?php echo DOMAINADBUSINISS?>slideshow/add<?php echo $langs ?>"><?php __('Add_new')?></a></li>
                </ul>
            </li>
           <li id="arrayorder_7">
                <a href="<?php echo DOMAINADBUSINISS?>settings/edit/1<?php echo $langs ?>" class="nav-top-item no-submenu"><?php __('Website_configuration')?></a>
            </li>   
            <li id="arrayorder_8">
                <a href="#" class="nav-top-item"><?php __('Account')?></a>
                <ul>
                    <li><a href="<?php echo DOMAINADBUSINISS?>accounts<?php echo $langs ?>"><?php __('Account')?></a></li>
                    <li><a href="<?php echo DOMAINADBUSINISS?>accounts/add<?php echo $langs ?>"><?php __('Creat_account')?></a></li>
                </ul>
            </li>  
            <li id="arrayorder_10">
                <a href="#" class="nav-top-item"><?php __('Vertical_advertisement')?></a>
                <ul>
                    <li><a href="<?php echo DOMAINADBUSINISS?>advertisements<?php echo $langs ?>"><?php __('List')?></a></li>
                    <li><a href="<?php echo DOMAINADBUSINISS?>advertisements/add<?php echo $langs ?>"><?php __('Add_new')?></a></li>
                </ul>
            </li> 
            <li id="arrayorder_9">
                <a href="#" class="nav-top-item"><?php __('Hot line')?></a>
                <ul>
                    <li><a href="<?php echo DOMAINADBUSINISS?>helps<?php echo $langs ?>"><?php __('List')?></a></li>
                    <li><a href="<?php echo DOMAINADBUSINISS?>helps/add<?php echo $langs ?>"><?php __('Add_new')?></a></li>
                </ul>
            </li>
			 <li id="arrayorder_9">
                <a href="#" class="nav-top-item"><?php __('Partners')?></a>
                <ul>
                    <li><a href="<?php echo DOMAINADBUSINISS?>partners<?php echo $langs ?>"><?php __('List')?></a></li>
                    <li><a href="<?php echo DOMAINADBUSINISS?>partners/add<?php echo $langs ?>"><?php __('Add_new')?></a></li>
                </ul>
            </li>
			 <li id="arrayorder_9">
                <a href="#" class="nav-top-item"><?php __('Video')?></a>
                <ul>
                    <li><a href="<?php echo DOMAINADBUSINISS?>videos/index<?php echo $langs ?>"><?php __('List')?></a></li>
                    <li><a href="<?php echo DOMAINADBUSINISS?>videos/add<?php echo $langs ?>"><?php __('Add_new')?></a></li>
                </ul>
            </li>
			
            <li id="arrayorder_12">
                <a href="<?php echo DOMAINADBUSINISS?>banners/edit/1<?php echo $langs ?>" class="nav-top-item no-submenu"><?php __('Banner')?></a>
            </li>  
        </ul> 
        </div>
    </div>
    </div>
