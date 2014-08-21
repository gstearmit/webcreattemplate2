<?php
$shop = explode ( '/', $this->params ['url'] ['url'] );
$shopname = $shop [0];
?>
<div class="search">
       <div class="text-search" style="float:right;">
          <form action="<?php echo DOMAIN.$shopname;?>/search" method="post">
          <input onfocus="if(this.value=='Tìm kiếm...') this.value='';" onblur="if(this.value=='') this.value='Tìm kiếm...';" value="Tìm kiếm..." style="color:#797979; width:258px; height:29px; margin-right:72px; margin-top:10px;" name="search_product" class="box-search">
          
          <!-- <input class="button-search" type="image" src="<?php echo DOMAIN;?>images/search.png" /> -->
          </form>
       </div>
   </div>