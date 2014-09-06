<?php //if($session->read('lang')==1){?>
  <style>
.promos .box {
color: #939694;
width: 90%;
height: 100px;

}
.modalphuc {
position: relative; top: auto; left: auto; right: auto; margin: 0 auto 20px; z-index: 1; max-width: 100%;
}
.modalphuchidden {
position: relative; top: auto; left: auto; right: auto; margin: 0 auto 20px; z-index: 1; max-width: 100%;
}
</style>
  <script type="text/javascript">
function clickviewpopup()
{
	// var s2 = document.getElementsByClassName('fade').remove();
	 var s3= document.getElementsByClassName('modal fade selectWindow');
	 var   assignedTabName = document.getElementById("myModal").className='selectWindow';
	 // alert(assignedTabName);
}

function closepopup()
{  
	 var   assignedTabName23 = document.getElementById("addedmodel").className='modal modalphuchidden'; //modal hide fade in phucmodel
	 alert(assignedTabName23);
}
</script>
            <!-- Content section -->		
            <section class="main">
                
                <!-- Home content -->
                <section class="home">

<!-- End class="promos" -->                                                           
                    <section class="featured">
                        <div class="container">
                            
                            <div class="row">
                                <div class="span9">                                                                        
                                       <?php if(empty($products)) {?>
										<div id="addedmodel" class="modal modalphuc">
							              <div class="modal-header">
							                <button aria-hidden="true" data-dismiss="modal" class="close" type="button" onclick="closepopup()">×</button>
							                <h3>Categories/<?php echo $cat['Estore_catproducts']['name']?></h3>
							              </div>
							              <div class="modal-body">
							                <p>There are no products in this category…</p>
							              </div>
							              <div class="modal-footer">
							                <a class="btn" href="<?php echo DOMAIN;?><?php echo $shopname ;?>">Close</a>
							                
							              </div>
							            </div>
					                    <?php }?>
										 <!-- Products list --> <?php // san pham trung cao cap?>
										<ul class="product-list isotope">
										  <?php foreach($products as $pr){?>
										    <li class="standard" data-price="58">
										        <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php echo $pr['Estore_products']['id'];?>" title="<?php echo $pr['Estore_products']['title']?>">
										            <div class="image">
										               <?php if($pr['Estore_products']['images'] !='') {?> <img class="primary" src="<?php echo DOMAINADESTORE.$pr['Estore_products']['images']?>" alt="<?php echo $pr['Estore_products']['title']?>" /><?php }?>
										               <?php if($pr['Estore_products']['images1'] !='') {?> <img class="secondary" src="<?php echo DOMAINADESTORE.$pr['Estore_products']['images1']?>" alt="<?php echo $pr['Estore_products']['title']?>" /><?php }?>
										            </div>
										
										            <div class="title">
										                <div class="prices">
										                    <span class="price">£<?php echo $pr['Estore_products']['price']?></span>
										                </div>
										                <h3><?php echo $pr['Estore_products']['title']?></h3>
										            </div>
										
										        </a>
										    </li>
										   <?php }?> 
										   
										</ul>
										 <div style="float: left; text-align:right;width: 572px;color: black; font-size: 12px;">
								         <?php if($paginator->numbers()!=null){?>
								            
								            <div class="page">
								            <?php
												$paginator->options(array('url' => $this->passedArgs));                                    
												echo $paginator->numbers();
												?>
												</div>
								        <?php }?>
								        </div>  
										<!-- End class="product-list isotope" -->                                                       
                                </div>

                                <div class="span3">
                                     <?php echo $this->element('themeshop\clothingstore\right')?>  
                                </div>
                            </div>	
                            
                        </div>
                    </section>	
                    
                    
                </section>
                <!-- End class="home" -->
                
            </section>
            <!-- End class="main" -->  
 <?php //} 
 if($session->read('lang')==2){?>
 <div id="main-center">              	
    <div id="sanphams" style="min-height: 680px !important;">
    	<div class="top"><?php echo $cat['Estore_catproducts']['name_en']?></div>
        <?php foreach($products as $pr){?>	
        <div id="dssanpham" align="center">
        	<div class="img" >
            <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php echo $pr['Estore_products']['id'];?>"><img src="<?php echo DOMAINAD.'timthumb.php?src='.$pr['Estore_products']['images']?>&amp;h=105&amp;w=199&amp;zc=1" width="199" height="105"/></a>
            </div>
            <div class="name" align="center">
            	<h5><a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php echo $pr['Estore_products']['id'];?>"><?php echo $pr['Estore_products']['title_en'];?></a></h5>
                <h6><a href="#tips">Price: <font color="#FF6600">Contact </font></a>
                <!--<h6><a href="#tips">Giá: <font color="#FF6600"><?php echo number_format( $pr['Estore_products']['price'],3); ?> VNĐ</font></a></h6>-->
                <h4><a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php echo $pr['Estore_products']['id'];?>">Detail</a></h4>
            </div>
        </div>
        <?php }?> 
        <div style="float: left; text-align:right;width: 750px; padding-right: 50px; color: black; font-size: 12px;">
         <?php if($paginator->numbers()!=null){?>
            <style>
            a{
             color: green;
            }
            </style>
            <?php
				$paginator->options(array('url' => $this->passedArgs));                                    
				echo $paginator->prev('<<', null, null, array('class' => 'disabled'));echo "&nbsp;&nbsp;&nbsp;";
				echo $paginator->numbers();echo "&nbsp;&nbsp;&nbsp;";
				echo $paginator->next('>>' , null, null, array('class' => 'disabled'));
            }?>
        </div>
    </div>                          
         <!--end sanpham-->      
</div>  
 <?php }?>
