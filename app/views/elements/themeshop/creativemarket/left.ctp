<?php
$shop = explode ( '/', $this->params ['url'] ['url'] );
$shopname = $shop [0];
$shop = $this->requestAction ( 'comment/get_shop_id/' . $shopname );
foreach ( $shop as $key => $value ) {
	$shop_id = $key;
}

?>
 <div class="col-md-3 column">
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="<?php echo DOMAIN;?><?php echo $shopname ;?>"><span class="glyphicon glyphicon-chevron-right"></span> Home</a></li>
        <?php $root = $this->requestAction('/'.$shopname.'/danhmuc/'.$shopname);?>
       
        <?php  foreach ($root as $value){?>
        <li><?php if($value['estore_catproducts']['name'] !='') {?><a href='#' class="active2"><span class="glyphicon glyphicon-chevron-right"></span><?php echo $value['estore_catproducts']['name'];?></a> <?php }?></li>
        
        <?php $category = $this->requestAction('/'.$shopname.'/showsmenu1/'.$value['estore_catproducts']['id']);
             if(is_array($category) and !empty($category)){?>
               <?php foreach($category as $k=>$subcat){?>
                 <?php $categorys = $this->requestAction('/'.$shopname.'/showsmenu2/'.$subcat['estore_catproducts']['id']);?>
                      <?php  if(!empty($categorys)){?>
                              <?php foreach($categorys as $k=>$subcats){?>
                             <li class="submenu"><a href="#">
						    	 <span class="glyphicon glyphicon-plus"></span><?php echo $subcat['estore_catproducts']['name']?> </a>
						      <?php }?>
			         	    </li>
				<?php  }else{   ?>
                  <?php if($subcat['estore_catproducts']['name'] !='') {?>  <li><a href='<?php echo DOMAIN;?><?php echo $shopname ;?>/listproduct/<?php echo $subcat['estore_catproducts']['id']?>'><span class="glyphicon glyphicon-chevron-right"></span><?php echo $subcat['estore_catproducts']['name']?></a></li> <?php }?>
                <?php }?>
            <?php   }?>
		  <?php } ?>		 
      
        
        <?php }?>
      </ul>
    
	  
	
									<div class="feature">	
										<img src="<?php echo DOMAIN ?>creativemarket/img/world.png" class="img-responsive" alt="" />
										<h4>WORLDWIDE <strong>DELIVERY</strong></h4>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>									
									</div><div class="feature">	
										<img src="<?php echo DOMAIN ?>creativemarket/img/fast.png" class="img-responsive" alt="" />
										<h4>FAST <strong>SERVICE</strong></h4>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>									
									</div>
							
	   </div>