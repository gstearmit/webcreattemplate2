<?php 
			
			$shop=explode('/',$this->params['url']['url']); 
			$shopname=$shop[0];
				$shop=$this->requestAction('comment/get_shop_id/'.$shopname);
				
				
				foreach($shop as $key=>$value){
				$shop_id=$key;
				}
			
?>
<div id="main-center">
<div id="sanphamchitiet">
    <div class="tops"><?php
    foreach ($cat as $catvl){
     echo $catvl['estore_catproducts']['name']; }?>
     </div>
        <div class="m1" style="padding:20px 10px !important;min-height: 985px !important;">            
             <div class="clearfix"> 		                   
                <div class="roundBoxBody">
                     <?php  if($listnews){?>
                        <?php  foreach($listnews as $itm){ ?>
                            <div class="intro-content" style="margin: 10px 0; padding: 5px 0;">                           
                                	<?php if ($itm['estore_news']['images'] !="") { ?>
                                        <span class="picBox" style="width:128px; height: 98px; float: left;"> 
                                             <a href="<?php echo DOMAIN?><?php echo $shopname ;?>/indexnews/<?php echo $itm['estore_news']['id']?>">
                                                	<img src="<?php echo DOMAINADESTORE.'timthumb.php?src='.$itm['estore_news']['images']?>&amp;h=103&amp;w=128&amp;zc=1" width="128" height="103"/>
                                             </a>
                                        </span> 
                                   <?php } ?>   
                                   <div style="padding-left: 140px;"> 
                                    <h3>
                                        <a  style="color: #237BA0 !important;" href="<?php echo DOMAIN?><?php echo $shopname ;?>/viewnews/<?php echo $itm['estore_news']['id']?>">
                                            <?php echo strip_tags($this->Text->truncate( $itm['estore_news']['title'],130,array('ending' => '...','exact' => false)));?></a>
                                        </a>
                                    </h3>     
                                    <div>	                                                        		
                                   		<?php echo strip_tags($this->Text->truncate( $itm['estore_news']['introduction'],290,array('ending' => '...','exact' => false)));?>
                                    </div>
                                    </div>
                                    <div class="detail" align="right">
                                    	<a href="<?php echo DOMAIN?><?php echo $shopname ;?>/viewnews/<?php echo $itm['estore_news']['id']?>">
                                    	      <u><i>Chi tiết</i></u> 
    			                      	 </a> 
                                         
                                    </div> 
                             </div>
                             
                              <div class="clearfix"></div><br /><div style="border-bottom: 1px dotted black;"></div>   
                        <?php } }else{?> 
                            <div id="noidung">
                                <p>Chưa có tin</p>
                            </div>
                        <?php }?>
     	
                   <div id="page" style="float: right;">        	
                        <?php if($paginator->numbers()!=null){
            				$paginator->options(array('url' => $this->passedArgs));
            				echo $paginator->prev('<<', null, null, array('class' => 'disabled'));echo "&nbsp;&nbsp;&nbsp;";
            				echo $paginator->numbers();echo "&nbsp;&nbsp;&nbsp;";
            				echo $paginator->next('>>' , null, null, array('class' => 'disabled'));
            				echo "</span>";
                        }?>
                   </div>                             
                                            
                </div>
             </div>            
             <div class="clearfix"></div>
        </div> 
        <div class="b"><div class="b"><div class="b"></div></div></div>
    </div>
</div>