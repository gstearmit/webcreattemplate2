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
	 var   assignedTabName23 = document.getElementById("modelshoppingstring").className='modal hide fade in'; //modal hide fade in phucmodel
	 //alert(assignedTabName23);
}
function dieclose()
{  

	alert('dsdssdsdsdsd');
	 var   assignedTabName234 = document.getElementById("modelshopping").className='modal hide fade in'; //modal hide fade in phucmodel
	 alert(assignedTabName234);
	 var redirect = <?php echo DOMAIN .$shopname;?>;
	 window.location.replace(redirect);
}
//
</script>
<style>
.shipmethod {
    margin-left: 33%;
    margin-top: 5%;
}
.phucmodel {
display: block;
}
</style>
<!-- Content section -->		
            <section class="main">
             <!-- Cart container -->
                <section class="cart">



                    <div class="container">
                        <div class="row">

                            <div class="span9">
									<?php  
									// echo "khong co san pham nao";
									if($textstring !='') { ?>
										<div id="modelshopping" class="modal hide fade in phucmodel" tabindex="-1" aria-hidden="false" >
									                        <div class="modal-header">
									                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="dieclose()">×</button>
									                            <div class="hgroup title">
									                                <h3>Information Order!</h3>
									                                <h5><?php echo $textstring;?></h5>
									                            </div>
									                        </div>
									                        <div class="modal-footer">	
									                            <div class="pull-right">				
									                                <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>" class="btn btn-primary btn-small">
									                                   OK &nbsp; <i class="icon-chevron-right"></i>
									                                </a>
									                            </div>
									                        </div>
									                    </div>
									<?php 	
									}?>
									
									<?php  
									// echo "khong co san pham nao";
									/*
									if($shopingcart =='') { ?>
										<div id="modelshoppingstring" class="modal hide fade in phucmodel" tabindex="-1" aria-hidden="false" >
									                        <div class="modal-header">
									                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="closepopup()">×</button>
									                            <div class="hgroup title">
									                                <h3>Information Cart!</h3>
									                                <h5>Currently no products in your shopping cart</h5>
									                            </div>
									                        </div>
									                        <div class="modal-footer">	
									                            <div class="pull-right">				
									                                <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>" class="btn btn-primary btn-small">
									                                    Click for by Product &nbsp; <i class="icon-chevron-right"></i>
									                                </a>
									                            </div>
									                        </div>
									                    </div>
									<?php 	
									}
									*/
									?>
									
							
                        </div>
                    </div>	
                  </div>	  
                </section>   
              </section>            
                <!-- End main -->		