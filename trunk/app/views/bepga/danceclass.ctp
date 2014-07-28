 <div style="padding: 5px;">
   <div id="silver-title-box">
        <div class="t1"><div class="t1"><div class="t1"></div> </div></div>
        <div class="title">
              <strong>Lớp học khiêu vũ</strong>
        </div>
        <div class="m1">            
             <div class="clearfix"> 		                   
                <div class="roundBoxBody">
                     <?php  if($news){?>
                        <?php $i=1; foreach($news as $itm){ ?>
                            <div class="intro-content">                           
                                	<?php if ($itm['News']['images'] !="") { ?>
                                        <span class="picBox"> 
                                             <a href="<?php echo DOMAIN?>tin-tuc/chi-tiet-tin/<?php echo $itm['News']['id']?>">
                                                	<img src="<?php echo DOMAINAD.'timthumb.php?src='.$itm['News']['images']?>&amp;h=103&amp;w=128&amp;zc=1" width="128" height="103"/>
                                             </a>
                                        </span> 
                                   <?php } ?>    
                                    <h3>
                                        <a href="<?php echo DOMAIN?>tin-tuc/chi-tiet-tin/<?php echo $itm['News']['id']?>">
                                            <?php echo strip_tags($this->Text->truncate( $itm['News']['title'],130,array('ending' => '...','exact' => false)));?></a>
                                        </a>
                                    </h3>     
                                    <dt>	                                                        		
                                   		<?php echo strip_tags($this->Text->truncate( $itm['News']['introduction'],290,array('ending' => '...','exact' => false)));?>
                                    </dt>
                                    <div class="detail">
                                    	<a href="<?php echo DOMAIN?>tin-tuc/chi-tiet-tin/<?php echo $itm['News']['id']?>">
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
        <div class="b1"><div class="b1"><div class="b1"></div></div></div>
    </div>
 </div>

