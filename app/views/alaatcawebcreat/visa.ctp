
<?php if($session->read('lang')==1){?>

<div id="intro" style="border: 2px solid #c6c6c6; margin-top: 10px; padding-top: 0px;; width: 96%;">
<div class="title_tile"><p>HỘ CHIẾU - VISA</p></div>

<div id="view_body_new">
   		<div id="text-news">
   			<div class="detail-text">
               <ul>
                 <?php $i=1; foreach($visa as $visa){ ?>
                          <li>
                            <form method="post" name="form<?php echo $i;?>" action="<?php echo DOMAIN; ?>news/addview">
                              <input type="hidden" name="id" value="<?php echo $visa['Estore_news']['id']?>" />
                              <a href="<?php echo DOMAIN;?>ho-chieu/chi-tiet/<?php echo $visa['Estore_news']['id'];?>" onclick="document.form<?php echo $i;?>.submit();"><?php echo $visa['Estore_news']['title'];?></a>
                              <a href="<?php echo DOMAIN;?>ho-chieu/chi-tiet/<?php echo $visa['Estore_news']['id'];?>" onclick="document.form<?php echo $i;?>.submit();"><img alt="<?php echo $visa['Estore_news']['title'];?>" src="<?php echo DOMAINAD;?><?php echo $visa['Estore_news']['images'];?>" /></a>
                              <?php $i++;?>
                              </form>
                            <div class="pindex">
                              <p><?php echo strip_tags($this->Text->truncate( $visa['Estore_news']['introduction'],500,array('ending' => '...','exact' => false)));?></p>
                            </div>
                           </li>
                           <?php } ?>
               </ul>
        	</div>
        </div>	
        <div id="link_page">        	
            <?php
				$paginator->options(array('url' => $this->passedArgs));
				echo $paginator->prev('Back', null, null, array('class' => 'disabled'));echo "&nbsp;&nbsp;&nbsp;";
				echo $paginator->numbers();echo "&nbsp;&nbsp;&nbsp;";
				echo $paginator->next('Next' , null, null, array('class' => 'disabled'));
				echo "</span>";
            ?>
            
    	</div>
     </div>
</div>

<?php } if($session->read('lang')==2){?>     

<div id="intro" style="border: 2px solid #c6c6c6; margin-top: 10px; padding-top: 0px;; width: 96%;">
<div class="title_tile"><p>PASSPORT - VISA</p></div>

<div id="view_body_new">
   		<div id="text-news">
   			<div class="detail-text">
               <ul>
                 <?php $i=1; foreach($visa as $visa){ ?>
                          <li>
                            <form method="post" name="form<?php echo $i;?>" action="<?php echo DOMAIN; ?>news/addview">
                              <input type="hidden" name="id" value="<?php echo $visa['Estore_news']['id']?>" />
                              <a href="<?php echo DOMAIN;?>ho-chieu/chi-tiet/<?php echo $visa['Estore_news']['id'];?>" onclick="document.form<?php echo $i;?>.submit();"><?php echo $visa['Estore_news']['title_en'];?></a>
                              <a href="<?php echo DOMAIN;?>ho-chieu/chi-tiet/<?php echo $visa['Estore_news']['id'];?>" onclick="document.form<?php echo $i;?>.submit();"><img alt="<?php echo $visa['Estore_news']['title_en'];?>" src="<?php echo DOMAINAD;?><?php echo $visa['Estore_news']['images_en'];?>" /></a>
                              <?php $i++;?>
                              </form>
                            <div class="pindex">
                              <p><?php echo strip_tags($this->Text->truncate( $visa['Estore_news']['introduction_en'],500,array('ending' => '...','exact' => false)));?></p>
                            </div>
                           </li>
                           <?php } ?>
               </ul>
        	</div>
        </div>	
        <div id="link_page">        	
            <?php
				$paginator->options(array('url' => $this->passedArgs));
				echo $paginator->prev('Back', null, null, array('class' => 'disabled'));echo "&nbsp;&nbsp;&nbsp;";
				echo $paginator->numbers();echo "&nbsp;&nbsp;&nbsp;";
				echo $paginator->next('Next' , null, null, array('class' => 'disabled'));
				echo "</span>";
            ?>
            
    	</div>
     </div>
</div>

<?php }?>