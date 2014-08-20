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
        <a id="langgue" href="<?php echo $urlcart;?>?language=vie"><img id="langgue" align="absmiddle" src="<?php echo DOMAIN ?>images/vietnam.gif" />Tiếng Việt</a>
	<a  id="langgue" href="<?php echo $urlcart; ?>?language=eng"><img  id="langgue" align="absmiddle" src="<?php echo DOMAIN ?>images/english.gif" />English</a>
        <h1 id="sidebar-title"><a href="#"></a></h1>
        <a href="#"><img id="logo" src="<?php echo DOMAINADESTORE?>images/logo.png" alt="Design by Quảng cáo vip" /></a>
      
        <div id="profile-links">
             <?php __('hello')?>, <a href="#" title="Edit your profile"><?php echo $this->Session->read('name'); ?></a><br />
            <br />
            <a href="<?php echo DOMAIN;?>" title="View the Site" target="_blank"><?php __('home_page')?></a> | <a href="<?php echo DOMAINADESTORE?>login/logout" title="Sign Out">Thoát</a>
        </div>        
        <div id="list">
          <ul id="main-nav"> 
            
            <li id="arrayorder_1">
                <a href="<?php echo DOMAINADESTORE?>home<?php echo $langs ?>" class="nav-top-item no-submenu">
                     <?php __('home')?> 
                </a>       
            </li>
<!--             <li id="arrayorder_2">-->
<!--                <a href="#" class="nav-top-item"> -->
<!--                  Menu-->
<!--                </a>-->
<!--                <ul>-->
<!--                    <li><a href="<?php echo DOMAINADESTORE?>menu/index">Danh sách menu</a></li>-->
<!--                    <li><a href="<?php echo DOMAINADESTORE?>menu/add">Thêm mới menu</a></li>-->
<!--                </ul>-->
<!--            </li>-->
            <li id="arrayorder_2">
                <a href="#" class="nav-top-item"> 
                  <?php __('product')?> 
                </a>
                <ul>
                    <li><a class="current" href="<?php echo DOMAINADESTORE?>catproducts/index<?php echo $langs ?>"><?php __('Category_product')?></a></li>
                    <li><a href="<?php echo DOMAINADESTORE?>catproducts/add<?php echo $langs ?>"><?php __('Add_Category')?></a></li>
                    <li><a href="<?php echo DOMAINADESTORE?>products/index<?php echo $langs ?>"><?php __('Product_list')?></a></li>
                    <li><a href="<?php echo DOMAINADESTORE?>products/add<?php echo $langs ?>"><?php __('Add_product')?></a></li>
                </ul>
            </li>
            <li id="arrayorder_4">
                <a href="#" class="nav-top-item">
                    <?php __('Producer')?>
                </a>
                <ul>
                    <li><a href="<?php echo DOMAINADESTORE?>manufacturers<?php echo $langs ?>"><?php __('Producers_list')?></a></li>
                    <li><a href="<?php echo DOMAINADESTORE?>manufacturers/add<?php echo $langs ?>"><?php __('Add_new')?>i</a></li>
                </ul>
            </li>
            <li id="arrayorder_7">
                <a href="<?php echo DOMAINADESTORE?>infomations<?php echo $langs ?>" class="nav-top-item no-submenu"><?php __('Orders')?></a>
            </li> 
            <li id="arrayorder_3">
                <a href="#" class="nav-top-item"> 
                  <?php __('News')?>
                </a>
                <ul>
                    <li><a class="current" href="<?php echo DOMAINADESTORE?>category/index<?php echo $langs ?>"><?php __('News_category')?></a></li>
                    <li><a href="<?php echo DOMAINADESTORE?>category/add<?php echo $langs ?>"><?php __('Add_category_news')?></a></li>
                    <li><a href="<?php echo DOMAINADESTORE?>news/index<?php echo $langs ?>"><?php __('News_list')?></a></li>
                    <li><a href="<?php echo DOMAINADESTORE?>news/add<?php echo $langs ?>"><?php __('Add_news')?></a></li>
                </ul>
            </li>
             <li id="arrayorder_4">
                <a href="#" class="nav-top-item">
                    <?php __('Comments_management')?>
                </a>
                <ul>
                    <li><a href="<?php echo DOMAINADESTORE?>comments<?php echo $langs ?>"><?php __('Comments_list')?></a></li>
                   
                </ul>
            </li>
            <li id="arrayorder_4">
                <a href="#" class="nav-top-item">
                   <?php __('Ad_management')?>
                </a>
                <ul>
                    <li><a href="<?php echo DOMAINADESTORE?>advertisements<?php echo $langs ?>"><?php __('Ad_list')?></a></li>
                    <li><a href="<?php echo DOMAINADESTORE?>advertisements/add<?php echo $langs ?>"><?php __('Add_new')?></a></li>
                </ul>
            </li>
            <li id="arrayorder_4">
                <a href="#" class="nav-top-item">
                    <?php __('Slideshow_management')?>
                </a>
                <ul>
                    <li><a href="<?php echo DOMAINADESTORE?>slideshow<?php echo $langs ?>"><?php __('Slide_image')?></a></li>
                    <li><a href="<?php echo DOMAINADESTORE?>slideshow/add<?php echo $langs ?>"><?php __('Add_new')?></a></li>
                </ul>
            </li>
            <li id="arrayorder_4">
                <a href="#" class="nav-top-item">
                    <?php __('Video_management')?>
                </a>
                <ul>
                    <li><a href="<?php echo DOMAINADESTORE?>videos<?php echo $langs ?>"><?php __('Video_list')?></a></li>
                   <li><a href="<?php echo DOMAINADESTORE?>videos/add<?php echo $langs ?>"><?php __('Add_video')?></a></li>
                </ul>
            </li>
<!--            <li id="arrayorder_3">-->
<!--                <a href="#" class="nav-top-item">-->
<!--                    Thư viện ảnh-->
<!--                </a>-->
<!--                <ul>-->
<!--                    <li><a href="<?php echo DOMAINADESTORE?>album">Danh sách Album</a></li>-->
<!--                    <li><a href="<?php echo DOMAINADESTORE?>album/add">Thêm Album</a></li>-->
<!--                    <li><a href="<?php echo DOMAINADESTORE?>gallery/index">Danh sách ảnh Ablum</a></li>-->
<!--                    <li><a href="<?php echo DOMAINADESTORE?>gallery/add">Thêm ảnh vào Ablum</a></li>-->
<!--                </ul>-->
<!--            </li>-->
             
             
            <li id="arrayorder_8">
                <a href="#" class="nav-top-item"><?php __('Account')?></a>
                <ul>
                    <li><a href="<?php echo DOMAINADESTORE?>accounts<?php echo $langs ?>"><?php __('Account')?></a></li>
                    <li><a href="<?php echo DOMAINADESTORE?>accounts/add<?php echo $langs ?>"><?php __('Creat_account')?></a></li>
                </ul>
            </li>   
             <li id="arrayorder_10">
                <a href="#" class="nav-top-item"><?php __('Partners')?></a>
                <ul>
                    <li><a href="<?php echo DOMAINADESTORE?>partners<?php echo $langs ?>"><?php __('Partners_list')?></a></li>
                    <li><a href="<?php echo DOMAINADESTORE?>partners/add<?php echo $langs ?>"><?php __('Add_new')?></a></li>
                </ul>
            </li> 
             <li id="arrayorder_10">
                <a href="#" class="nav-top-item"><?php __('Link_website')?></a>
                <ul>
                    <li><a href="<?php echo DOMAINADESTORE?>weblinks<?php echo $langs ?>"><?php __('Link_list')?></a></li>
                    <li><a href="<?php echo DOMAINADESTORE?>weblinks/add<?php echo $langs ?>"><?php __('Add_new')?></a></li>
                </ul>
            </li> 
            <li id="arrayorder_9">
                <a href="#" class="nav-top-item"><?php __('Hotline')?></a>
                <ul>
                    <li><a href="<?php echo DOMAINADESTORE?>helps/edit/7<?php echo $langs ?>"><?php __('Hotline_change')?></a></li>
                   
                </ul>
            </li>
            <li id="arrayorder_12">
                <a href="<?php echo DOMAINADESTORE?>banners/edit/1<?php echo $langs ?>" class="nav-top-item no-submenu">Banner</a>
            </li>  
            <li id="arrayorder_7">
                <a href="<?php echo DOMAINADESTORE?>settings/edit/1<?php echo $langs ?>" class="nav-top-item no-submenu"><?php __('Website_configuration')?></a>
            </li> 
        </ul> 
        </div>
    </div>
    </div>
