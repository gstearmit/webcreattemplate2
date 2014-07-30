<div id="text-main">
   <div class="title-news">
   		<p>Sổ lưu niệm</p>
   </div>
   <div class="text-news">
   		<div class="text-main">
           <ul>
             <?php $i=1; foreach($news as $listnews){ ?>
              <li>
                <form method="post" name="form<?php echo $i;?>" action="<?php echo DOMAIN; ?>news/addview">
                 <?php if($listnews['Estore_news']['images']!=''){?>
                  <a href="<?php echo DOMAIN;?>chi-tiet-tin/<?php echo $listnews['Estore_news']['id'];?>" onclick="document.form<?php echo $i;?>.submit();"><img alt="<?php echo $listnews['Estore_news']['title'];?>" src="<?php echo DOMAINAD;?><?php echo $listnews['Estore_news']['images'];?>" /></a>
                  <?php }?>
                  
                  <input type="hidden" name="id" value="<?php echo $listnews['Estore_news']['id']?>" />
                  <a href="<?php echo DOMAIN;?>chi-tiet-tin/<?php echo $listnews['Estore_news']['id'];?>" onclick="document.form<?php echo $i;?>.submit();"><span><?php echo $listnews['Estore_news']['title'];?></span></a>
                  <?php $i++;?>
                  </form>
                   <p style="color:#999999; font-size:11px;"> Ngày đăng (<?php echo $listnews['Estore_news']['created'];?>) Số truy cập: <?php echo $listnews['Estore_news']['view'];?> 
                </p>
                
                <div class="pindex">
                  <p><?php echo strip_tags($this->Text->truncate( $listnews['Estore_news']['introduction'],500,array('ending' => '...','exact' => false)));?></p>
                </div>
               </li>
               <?php } ?>
           </ul>
        </div>
        <div id="page">        	
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
                         