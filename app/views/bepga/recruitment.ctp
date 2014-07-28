<?php if($session->read('lang')==1){?>
<div id="sanphamchitiet">
    <div class="top">Tin tuyển dụng</div>
        <div class="m1" style="padding:20px 10px !important;min-height: 985px !important;">            
             <div class="clearfix"> 		                   
                <div class="roundBoxBody">
                     <?php  if($news){?>
                        <?php  foreach($news as $itm){ ?>
                            <div class="intro-content">                           
                                	<?php if ($itm['Estore_news']['images'] !="") { ?>
                                        <span class="picBox" style="width:128px; height: 98px; float: left;"> 
                                             <a href="<?php echo DOMAIN?>tin-tuc/chi-tiet-tin/<?php echo $itm['Estore_news']['id']?>">
                                                	<img src="<?php echo DOMAINAD.'timthumb.php?src='.$itm['Estore_news']['images']?>&amp;h=103&amp;w=128&amp;zc=1" width="128" height="103"/>
                                             </a>
                                        </span> 
                                   <?php } ?>   
                                   <div style="padding-left: 10px;"> 
                                    <h3>
                                        <a  style="color: #237BA0 !important;" href="<?php echo DOMAIN?>tin-tuc/chi-tiet-tin/<?php echo $itm['Estore_news']['id']?>">
                                            <?php echo strip_tags($this->Text->truncate( $itm['Estore_news']['title'],130,array('ending' => '...','exact' => false)));?></a>
                                        </a>
                                    </h3>     
                                    <div>	                                                        		
                                   		<?php echo strip_tags($this->Text->truncate( $itm['Estore_news']['introduction'],290,array('ending' => '...','exact' => false)));?>
                                    </div>
                                    </div>
                                    <div class="detail" align="right">
                                    	<a href="<?php echo DOMAIN?>tin-tuc/chi-tiet-tin/<?php echo $itm['Estore_news']['id']?>">
                                    	      <u><i>Chi tiết</i></u> 
    			                      	 </a> 
                                         <img width="10" height="9" title="Chi tiết" src="<?php echo DOMAIN?>/images/around_chitiet.gif" border="0" />
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
<?php } if($session->read('lang')==2){?>
<div id="sanphamchitiet">
    <div class="top">Recruitment</div>
        <div class="m1" style="padding:20px 10px !important;min-height: 985px !important;">            
             <div class="clearfix"> 		                   
                <div class="roundBoxBody">
                     <?php  if($news){?>
                        <?php  foreach($news as $itm){ ?>
                            <div class="intro-content">                           
                                	<?php if ($itm['Estore_news']['images'] !="") { ?>
                                        <span class="picBox" style="width:128px; height: 98px; float: left;"> 
                                             <a href="<?php echo DOMAIN?>tin-tuc/chi-tiet-tin/<?php echo $itm['Estore_news']['id']?>">
                                                	<img src="<?php echo DOMAINAD.'timthumb.php?src='.$itm['Estore_news']['images']?>&amp;h=103&amp;w=128&amp;zc=1" width="128" height="103"/>
                                             </a>
                                        </span> 
                                   <?php } ?>   
                                   <div style="padding-left: 10px;"> 
                                    <h3>
                                        <a  style="color: #237BA0 !important;" href="<?php echo DOMAIN?>tin-tuc/chi-tiet-tin/<?php echo $itm['Estore_news']['id']?>">
                                            <?php echo strip_tags($this->Text->truncate( $itm['Estore_news']['title_en'],130,array('ending' => '...','exact' => false)));?></a>
                                        </a>
                                    </h3>     
                                    <div>	                                                        		
                                   		<?php echo strip_tags($this->Text->truncate( $itm['Estore_news']['introduction_en'],290,array('ending' => '...','exact' => false)));?>
                                    </div>
                                    </div>
                                    <div class="detail" align="right">
                                    	<a href="<?php echo DOMAIN?>tin-tuc/chi-tiet-tin/<?php echo $itm['Estore_news']['id']?>">
                                    	      <u><i>Detail</i></u> 
    			                      	 </a> 
                                         
                                    </div> 
                             </div>
                             
                              <div class="clearfix"></div><br /><div style="border-bottom: 1px dotted black;"></div>   
                        <?php } }else{?> 
                            <div id="noidung">
                                <p>No Information</p>
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
<?php }?>