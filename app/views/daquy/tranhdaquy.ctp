﻿<div class="title-content">
   <p>TRANH ĐÁ QUÝ</p>
</div>
<div class="product">
   <ul>
     <?php
     foreach($listproducts as $listproduct){?>
      <li>
        <h1>
          <a href="<?php echo DOMAIN.$shopname;?>/viewproduct/<?php echo $listproduct['Eshopdaquyproduct']['id'];?>">
           <div style=" overflow:hidden; width:160px; height:128px; background-image:url(<?php echo DOMAINAD?>/timthumb.php?src=<?php echo $listproduct['Eshopdaquyproduct']['images'];?>&amp;h=128&amp;w=160&amp;zc=1); background-position:center center; background-repeat:no-repeat; background-color:#fff; margin:auto;" class="img">             
           </div> 
        </h1>
        <h2><a style="color:#0266A8;" href="<?php echo DOMAIN.$shopname;?>/viewproduct/<?php echo $listproduct['Eshopdaquyproduct']['id'];?>"><?php echo $listproduct['Eshopdaquyproduct']['title'];?></a></h2>
        
        <div class="div"><a href="<?php echo DOMAIN.$shopname;?>/viewproduct/<?php echo $listproduct['Eshopdaquyproduct']['id'];?>"><img src="<?php echo DOMAIN;?>images/detail1.png" style="margin-top:10px;" /></a></h2>
        </div>
      </li>
      <?php }?>
   </ul>
</div>
<div id='link_page'>
      <?php
            $paginator->options(array('url' => $this->passedArgs));
            echo "<span class='page_link'><b>Trang :</b> &nbsp;";
            echo $paginator->prev('Về trước');echo "&nbsp;&nbsp;&nbsp;";
            echo $paginator->numbers();echo "&nbsp;&nbsp;&nbsp;";
            echo $paginator->next('Tiếp theo');
            echo "</span>";
        ?>
    </div>