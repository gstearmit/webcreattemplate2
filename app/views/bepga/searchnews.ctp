

 <div style="padding: 5px;">
   <div id="gray-title-box">
        <div class="t3"><div class="t3"><div class="t3"></div> </div></div>
        <div class="title">
              <strong>Kết quả tìm kiếm</strong>
        </div>
        <div class="m3">            
             <div class="clearfix"> 		                   
                <div class="roundBoxBody">
                     <?php  if($listsearch){?>
                        <?php $i=1; foreach($listsearch as $itm){ ?>
                            <div class="intro-content">                           
                                	<?php if ($itm['Estore_news']['images'] !="") { ?>
                                        <span class="picBox"> 
                                             <a href="<?php echo DOMAIN?>tin-tuc/chi-tiet-tin/<?php echo $itm['Estore_news']['id']?>">
                                                	<img src="<?php echo DOMAINAD.'timthumb.php?src='.$itm['Estore_news']['images']?>&amp;h=103&amp;w=128&amp;zc=1" width="128" height="103"/>
                                             </a>
                                        </span> 
                                   <?php } ?>    
                                    <h3>
                                        <a href="<?php echo DOMAIN?>tin-tuc/chi-tiet-tin/<?php echo $itm['Estore_news']['id']?>">
                                            <?php echo strip_tags($this->Text->truncate( $itm['Estore_news']['title'],130,array('ending' => '...','exact' => false)));?></a>
                                        </a>
                                    </h3>     
                                    <dt>	                                                        		
                                   		<?php echo strip_tags($this->Text->truncate( $itm['Estore_news']['introduction'],290,array('ending' => '...','exact' => false)));?>
                                    </dt>
                                    <div class="detail">
                                    	<a href="<?php echo DOMAIN?>tin-tuc/chi-tiet-tin/<?php echo $itm['Estore_news']['id']?>">
                                    	      Chi tiết 
    			                      	 </a> 
                                         <img width="10" height="9" title="Chi tiết" src="<?php echo DOMAIN?>/images/around_chitiet.gif" border="0" />
                                    </div> 
                             </div>
                              <div class="line"></div>   
                        <?php } }else{?> 
                            <div id="noidung">
                                <p>Chưa có tin</p>
                            </div>
                        <?php }?>
     	
                                    
                                            
                </div>
             </div>            
             <div class="clearfix"></div>
        </div> 
        <div class="b3"><div class="b3"><div class="b3"></div></div></div>
    </div>
 </div>

                  