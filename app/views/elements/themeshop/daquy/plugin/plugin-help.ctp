<table width="" border="0">
     <?php $setting = $this->requestAction('/plugin/setting');?>
     <?php foreach($setting as $setting){?>
     <tr>
        <td><img src="<?php echo DOMAIN;?>images/phone-hotline.png" /></td><td><h2><?php echo $setting['Setting']['phone'];?></h2></td>
     </tr>
     <tr>
        <td><img src="<?php echo DOMAIN;?>images/email.png" /><td><h2 style="font-size:13px;"><?php echo $setting['Setting']['email'];?></h2></td>
     </tr>
     <?php }?>
</table>
<table width="" border="0">
  <?php $helpsonline = $this->requestAction('/plugin/helpsonline');?>
  <?php foreach($helpsonline as $helpsonline){?>
   <tr>
      <td>
        <a href="ymsgr:sendIM?<?php echo $helpsonline['Helps']['yahoo'];?>"><img border="0" src="http://opi.yahoo.com/online?u=<?php echo $helpsonline['Helps']['yahoo'];?>&amp;m=g&amp;t=1&amp;l=us"></a>
      </td>
      <td class="phones">
        <?php echo $helpsonline['Helps']['sdt'];?>
      </td>
   </tr>
   <?php }?>
</table>