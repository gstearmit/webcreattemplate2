<?php 
			
			$shop=explode('/',$this->params['url']['url']); 
			$shopname=$shop[0];
				$shop=$this->requestAction('comment/get_shop_id/'.$shopname);
				
				
				foreach($shop as $key=>$value){
				$shop_id=$key;
				}
// 				echo "Estoreshopnews</br>";pr($Estoreshopnews);
// 	echo "products</br>";pr($products);		
?>
<style>
.promos .box {
    color: #939694;
    width: 323px;
    height: 100px;
}
</style>
            <!-- Content section -->		
            <section class="main">
                
                <!-- Home content -->
                <section class="home">
           
                    <section class="featured">
                        <div class="container">
                            
                            <div class="row">
                            <?php if(!empty($products)){?>
                                <div class="span9">                                                                        
                                    
										 <!-- Products list --> <?php // Result Saech?>
										<ul class="product-list isotope">
										  <?php 
										  
										  foreach($products as $pr){?>
										    <li class="standard" data-price="58">
										        <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php echo $pr['Estore_products']['id'];?>" title="<?php echo $pr['Estore_products']['title']?>">
										            <div class="image">
										               <?php if($pr['Estore_products']['images'] !='') {?> <img class="primary" src="<?php echo DOMAINADESTORE.$pr['Estore_products']['images']?>" alt="<?php echo $pr['Estore_products']['title']?>" /><?php }?>
										               <?php if($pr['Estore_products']['images1'] !='') {?> <img class="secondary" src="<?php echo DOMAINADESTORE.$pr['Estore_products']['images1']?>" alt="<?php echo $pr['Estore_products']['title']?>" /><?php }?>
										            </div>
										
										            <div class="title">
										                <div class="prices">
										                    <span class="price">£<?php echo $pr['Estore_products']['price']?></span>
										                </div>
										                <h3><?php echo $pr['Estore_products']['title']?></h3>
										            </div>
										
										        </a>
										    </li>
										   <?php }?> 
										   
										</ul>
										 <div style="float: left; text-align:right;width: 572px;color: black; font-size: 12px;">
								         <?php if($paginator->numbers()!=null){?>
								            
								            <div class="page">
								            <?php
												$paginator->options(array('url' => $this->passedArgs));                                    
												echo $paginator->numbers();
												?>
												</div>
								        <?php }?>
								        </div>  
										<!-- End class="product-list isotope" -->                                                       
                                </div>

                                <div class="span3">
                                     <?php echo $this->element('themeshop\clothingstore\right')?>  
                                </div>
                                <?php }else echo "<h3 style='color: red;
    font-size: 36px;
    font-weight: bold;
    line-height: 45px;
    text-align: center;'>Not Found Reslult</h3>"?>
                            </div>	
                            
                        </div>
                    </section>	
                    
                    
                </section>
                <!-- End class="home" -->
                
            </section>
            <!-- End class="main" -->

      