  
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
    <div id="sidebar">
       <div id="sidebar-wrapper"> 
        <a id="langgue" href="<?php echo DOMAIN.$urlcart ?>?language=vie"><img id="langgue" align="absmiddle" src="<?php echo DOMAIN ?>images/vietnam.gif" />Tiếng Việt</a>
	   <a id="langgue" href="<?php echo DOMAIN.$urlcart ?>?language=eng"><img  id="langgue" align="absmiddle" src="<?php echo DOMAIN ?>images/english.gif" />English</a>
        <h1 id="sidebar-title"><a href="#"></a></h1>
        <a href="#"><img id="logo" src="<?php echo DOMAINAD?>images/logo.png" alt="" /></a>
      
        <div id="profile-links">
             <?php __('hello')?>, <a href="#" title="Edit your profile"><?php echo $this->Session->read('name'); ?></a><br />
            <br />
            <a href="<?php echo DOMAIN;?>" title="View the Site"><?php __('home_page')?></a> | <a href="<?php echo DOMAINAD?>login/logout" title="Sign Out">Sign Out</a>
        </div>        
        <div id="list">
          <ul id="main-nav"> 
            
            <li id="arrayorder_1">
                <a href="<?php echo DOMAINAD?>home<?php echo $langs; ?>" class="nav-top-item no-submenu">
                    <?php __('home')?> 
                </a>       
            </li>
          
		    
            <li id="arrayorder_2">
                <a href="#" class="nav-top-item"> 
                   <?php __('product')?> 
                </a>
                <ul>
                    <li><a class="current" href="<?php echo DOMAINAD?>catproducts/index<?php echo $langs; ?>"><?php __('Category_product')?></a></li>
                    <li><a href="<?php echo DOMAINAD?>catproducts/add<?php echo $langs; ?>"><?php __('Add_Category')?></a></li>
                    <li><a href="<?php echo DOMAINAD?>products/index<?php echo $langs; ?>"><?php __('Product_List')?></a></li>
                    <li><a href="<?php echo DOMAINAD?>products/add<?php echo $langs; ?>"><?php __('Add_product')?></a></li>
                     <li><a href="<?php echo DOMAINAD?>gallery/index<?php echo $langs; ?>"><?php __('list_img')?></a></li>
                    <li><a href="<?php echo DOMAINAD?>gallery/add<?php echo $langs; ?>"><?php __('Add_img')?></a></li>
                </ul>
            </li>
            <li id="arrayorder_2">
                <a href="#" class="nav-top-item"> 
                 <?php __('Notes')?>
                </a>
                <ul>
                    <li><a class="current" href="<?php echo DOMAINAD?>catproducts/index"><?php __('Category_notes')?></a></li>
                    <li><a href="<?php echo DOMAINAD?>catproducts/add"><?php __('Add_Category')?></a></li>
                    <li><a href="<?php echo DOMAINAD?>Notes/index"><?php __('Notes_List')?></a></li>
                    <li><a href="<?php echo DOMAINAD?>Notes/add"><?php __('Add_notes')?></a></li>
                </ul>
            </li>
            <li id="arrayorder_3">
                <a href="#" class="nav-top-item"> 
                 <?php __('Management_shop')?>
                </a>
                <ul>
				
                <!--    <li><a href="<?php echo DOMAINAD?>categorynewsshop/index">Danh mục tin tức</a></li> -->
                   
                    <li><a href="<?php echo DOMAINAD?>newshops/index"> <?php __('News_management')?></a></li>
					<li><a href="<?php echo DOMAINAD?>shops/index"><?php __('Management_shop')?></a></li>
					<li><a href="<?php echo DOMAINAD?>userscms/index"> <?php __('Customer_Management')?></a></li>
					
					
                    
                </ul>
            </li>
           
		     <li id="arrayorder_4">
                <a href="#" class="nav-top-item"> 
                 <?php __('Oder_Management')?>
                </a>
                <ul>
                    
                    <li><a href="<?php echo DOMAINAD?>orders/index"><?php __('Oder_List')?></a></li>
                    
                </ul>
            </li>
           
		   
              <li id="arrayorder_5">
                <a href="#" class="nav-top-item"> 
                 <?php __('City')?>
                </a>
                <ul>
                    
                    <li><a href="<?php echo DOMAINAD?>city/index"><?php __('City_List')?></a></li>
                    <li><a href="<?php echo DOMAINAD?>city/add"><?php __('Add_city')?></a></li>
                </ul>
            </li>
           
           
           
          
          
             <li id="arrayorder_7">
                <a href="#" class="nav-top-item"><?php __('Configuration')?></a>
                <ul>
                    <li><a href="<?php echo DOMAINAD?>settings/edit/1"><?php __('Web_Configuration')?></a></li>
                </ul>
            </li> 
            
            <li id="arrayorder_8">
                <a href="#" class="nav-top-item"><?php __('acount')?></a>
                <ul>
                    <li><a href="<?php echo DOMAINAD?>accounts"><?php __('acount')?></a></li>
                    <li><a href="<?php echo DOMAINAD?>accounts/add"><?php __('Create_acount')?></a></li>
                </ul>
            </li>   
            
            <li id="arrayorder_9">
                <a href="#" class="nav-top-item"><?php __('Online_support')?></a>
                <ul>
                    <li><a href="<?php echo DOMAINAD?>helps"><?php __('Online_list')?></a></li>
                    <li><a href="<?php echo DOMAINAD?>helps/add"><?php __('Add_Online')?></a></li>
                </ul>
            </li>
            
           
             
          <li id="arrayorder_11">
                <a href="#"class="nav-top-item">Video sidebar</a>
                <ul>
                    <li><a href="<?php echo DOMAINAD?>videos/edit/1">video</a></li>
                </ul>
            </li>
             
            
            
        </ul> 
        </div>
    </div>
    </div>
