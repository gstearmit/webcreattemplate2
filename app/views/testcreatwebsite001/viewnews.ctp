<?php 
			
			$shop=explode('/',$this->params['url']['url']); 
			$shopname=$shop[0];
				$shop=$this->requestAction('comment/get_shop_id/'.$shopname);
				
				
				foreach($shop as $key=>$value){
				$shop_id=$key;
				}
			
?>
<?php 
//if($session->read('lang')==1){?>
 <div id="main-center">
<div id="sanphamchitiet">
<?php foreach ($views as $view) {?>
    <div class="top"><?php echo $view['estore_news']['title']?></div>
    <div class="clearfix"> 		                   
                <div class="roundBoxBody" style="padding:20px 10px !important;min-height: 545px !important;">
                        <?php echo $view['estore_news']['content']?>
                </div>                  
             </div>   
   <?php }?>         
             <div class="clearfix"></div>
             <?php if($list_other!=null){?>                      
                            <div style="padding: 10px !important;">
                                <h2>Tin tức liên quan</h2> <hr style="width: 200px;" />
                            
                            <div style="margin:10px; text-align:justify;" class="imf-product">
                            	<ul class="list-news" style="list-style: none outside none;">
                                    <?php foreach($list_other as $news){ ?>
                                		<li><a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/viewnews/<?php echo $news['estore_news']['id'];?>">- <?php echo $news['estore_news']['title']?></a></li>
                                    <?php } ?>
                                </ul>
                            </div> 
                            </div>                       
                <?php } ?>
                            
</div>   
</div>
<?php //} 
if($session->read('lang')==2){?>
<div id="sanphamchitiet">
    <div class="top"><?php echo $views['estore_news']['title_en']?></div>
    <div class="clearfix"> 		                   
                <div class="roundBoxBody" style="padding:20px 10px !important;min-height: 845px !important;">
                        <?php echo $views['estore_news']['content_en']?>
                </div>                  
             </div>            
             <div class="clearfix"></div>
             <?php if($list_other!=null){?>                      
                            <div style="padding: 10px !important;">
                                <h2>Related News</h2> <hr style="width: 200px;" />
                            
                            <div style="margin:10px; text-align:justify;" class="imf-product">
                            	<ul class="list-news" style="list-style: none outside none;">
                                    <?php foreach($list_other as $news){ ?>
                                		<li><a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/viewnews/<?php echo $news['estore_news']['id'];?>">- <?php echo $news['estore_news']['title_en']?></a></li>
                                    <?php } ?>
                                </ul>
                            </div> 
                            </div>                       
                <?php } ?>
                            
</div>   
<?php }?>



