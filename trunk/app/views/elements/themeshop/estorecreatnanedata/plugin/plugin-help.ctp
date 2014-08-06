<div class="content_cat">
   <?php $helpsonline = $this->requestAction('/plugin/helpsonline');?>
  <?php foreach($helpsonline as $helpsonline){?>
    <div class="list_support">
        <p><?php echo $helpsonline['Helps']['name'];?>: <a href="ymsgr:sendIM?<?php echo $helpsonline['Helps']['yahoo'];?>"><img border="0" src="http://opi.yahoo.com/online?u=<?php echo $helpsonline['Helps']['yahoo'];?>&amp;m=g&amp;t=1&amp;l=us"></a></p>
        <p>Phone: <span><?php echo $helpsonline['Helps']['sdt'];?></span></p>
    </div>
     <?php }?>
    
</div>