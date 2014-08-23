<div class="title-content">
   <p><?php echo $cat['Estore_catproduct']['name'];?></p> <!-- lay dươc cha cua sản phẩm -->
</div>
<div class="product"><!-- div nay co tac dung do het san pham ra ngoai thoi-->
   <ul>
     <?php 
	 $a= array();
	 $i = 2;
	 $j = 0;
	 
	 foreach($listproducts as $listproduct){ $a[$j++] = $listproduct;?>
      <li>
        <h1>
          <a href="<?php echo DOMAIN.$shopname;?>/viewproduct/<?php echo $listproduct['Estore_products']['id'];?>" data-tooltip="sticky<?php echo $i; ?>">
           <div style=" overflow:hidden; width:160px; height:128px; background-image:url(<?php echo DOMAINADESTORE?>/timthumb.php?src=<?php echo $listproduct['Estore_products']['images'];?>&amp;h=128&amp;w=160&amp;zc=1); background-position:center center; background-repeat:no-repeat; background-color:#fff; margin:auto;" class="img">             
           </div> 
        </h1>
        <h2><a style="color:#0266A8;" href="<?php echo DOMAIN.$shopname;?>/viewproduct/<?php echo $listproduct['Estore_products']['id'];?>"><?php echo $listproduct['Estore_products']['title'];?></a></h2>
        
        <div class="div"><a href="<?php echo DOMAIN.$shopname;?>/viewproduct/<?php echo $listproduct['Estore_products']['id'];?>"><img src="<?php echo DOMAIN;?>daquybusniss/images/detail1.png" style="margin-top:10px;" /></a></h2>
        </div>
      </li>
	  <?php $i++ ?>
      <?php }?>
   </ul>
</div><!-- class="product"> -->


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
	
	
	
<div id="mystickytooltip" class="stickytooltip">
		<div style="padding:5px">
			<?php $i=2; 
			foreach($a as $listproduct) {
			?>
			<div id="sticky<?php echo $i; ?>" class="atip" style=" display: block;">	
			<img src="<?php echo DOMAINADESTORE; ?><?php echo $listproduct['Estore_products']['images']; ?>">
			</div>
			<?php $i++ ?>
			<?php } ?>
		</div>
</div>