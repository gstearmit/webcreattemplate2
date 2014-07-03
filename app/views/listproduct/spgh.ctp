
 <style>
 p{text-align:justify;}
 
 </style>
 

  <link type="text/css" href="<?php echo DOMAIN ?>css/phantrang.css" rel="stylesheet" /> 
 
  
 <div id="main-content">
	 
	 <div class="content-top">
	 <?php echo $this->element('menu_top');?>
	 <div class="content-top-body">
	 <h2 style="margin-left:20px;margin-top:20px;">GIAN HÀNG NỔI BẬT</h2>
	     <ul style="margin-left:28px; overflow:hidden;">                                       
	  <?php
			//pr($prod); die;
			$i=0;
	  foreach($prod as $sp_gianhang_nb){
	 
	  $i++;
	  ?>
                                                   <li style="margin-top:20px; overflow:hidden; width:234px; height:240px; float:left;">
                                                       
	  <div class="gianhang">
	  <table width="100%">
	  	<tr><td class="img-gianhang"><a target="_blank" href="<?php echo DOMAIN.$sp_gianhang_nb['Shop']['name']?>/chi_tiet_san_pham/<?php echo $sp_gianhang_nb['Productshop']['id']?>"><img src="<?php echo DOMAIN.$sp_gianhang_nb['Productshop']['images']?>"/></a></td></tr>
	  	<tr><td style="margin-top:10px;"><a class="a-ten" target="_blank" href="<?php echo DOMAIN.$sp_gianhang_nb['Shop']['name']?>/chi_tiet_san_pham/<?php echo $sp_gianhang_nb['Productshop']['id']?>"><?php echo $sp_gianhang_nb['Productshop']['title']?></a></td></tr>
	  	<tr><td style="margin-top:5px;color:#2FB34B;font-weight:bold;">GIÁ: <span style="color:red"><?php echo $sp_gianhang_nb['Productshop']['price']." ". $sp_gianhang_nb['Productshop']['money'] ?> </span></td></tr>
	  </table>
	  </div>
                                                        <div class="clear"></div>
                                                    </li>
                                                    <?php  }?>
	 		</ul>
	       	<div class="pt">
              <div class="pt-pagi">
              
							<ul><li class="li-prev">
							     <?php 
							     echo $paginator->prev('<');?>
							     </li>
							     
							     <li class="pt-so">
							     
								<?php    echo $paginator->numbers();?>
								</li>
								<li class="li-next">
								<?php 
                                   echo $paginator->next('>'); 
              ?>	</li>
              </ul>
              </div><!-- End pt-pagi-->
           </div><!-- End pt-->
	
	       
	
	 </div><!-- End content-top-body -->
	 <div class="bgbottom"></div>
	 </div><!-- End content-top -->
	 
	 
	 </div><!-- ENd main content -->
