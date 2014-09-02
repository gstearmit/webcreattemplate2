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
	 var   assignedTabName23 = document.getElementById("addedmodel").className='modal hide fade in'; //modal hide fade in phucmodel
	 //alert(assignedTabName23);
}
</script>
<style>
.phucmodel {
display: block;
}
</style>
<?php 
			
			$shop=explode('/',$this->params['url']['url']); 
			$shopname=$shop[0];
				$shop=$this->requestAction('comment/get_shop_id/'.$shopname);
				
				
				foreach($shop as $key=>$value){
				$shop_id=$key;
				}
			
?>
<?php  
// echo "khong co san pham nao";
if($shopingcart =='') { ?>
	<div id="addedmodel" class="modal hide fade in phucmodel" tabindex="-1" aria-hidden="false" >
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
}?>
          
 <!-- Added to cart modal window -->
                    <div id="removemodal" class="modal hide fade" tabindex="-1">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <div class="hgroup title">
                                <h3>Do you want to remove this product from the cart!</h3>
                             </div>
                        </div>
                        <div class="modal-footer" style="float:left;display:inline-block; width: 93%;">	
                            <div class="pull-right" style="float:left; margin-right:2%;margin-left:2%">				
                                <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/deleteshopingcart/<?php echo $key;?>" class="btn btn-primary btn-small">
                                    Delete &nbsp; <i class="icon-chevron-right"></i>
                                </a>
                            </div>
                            <div class="pull-left" style="float:left;">				
                                 <button   class="btn btn-primary btn-small" type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-chevron-right"></i> Cancel</button>
                            </div>
                        </div>
                    </div>
<!-- End id="added" -->
                    
                    
<div class="container">
  <div class="row clearfix">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
          <h1>Shopping cart infomation</h1>
           <h5>You currently have <strong><?php if(isset($_SESSION['shopingcart']))
                                            { $sl=count($_SESSION['shopingcart']) ;
                                            echo $sl;
                                            }else {echo "0"; }?></strong> item(s) in your cart</h5>
           <?php $total = 0;if($shopingcart){?>
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th class="text-center">Price</th>
                <th class="text-center">Total</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php $total=0; $i=0; foreach($shopingcart as $key=>$product) {?>
               <?php if($product['name']!=null){?>
              <tr>
                <td class="col-sm-8 col-md-6"><div class="media">
                 <a class="thumbnail pull-left" href="#">
                 <img class="media-object" src="<?php echo DOMAINADESTORE;?><?php echo $product['images']; ?>" style="width: 72px; height: 72px;" alt="<?php echo $product['name']; ?>"> 
                 </a>
                    <div class="media-body">
                      <h4 class="media-heading"><a href="<?php echo DOMAINAD.$shopname;?>/view<?php echo $product['pid']; ?>"><?php echo $product['name']; ?></a></h4>
                      <h5 class="media-heading"> by <a href="<?php echo DOMAINAD.$shopname;?>/view<?php echo $product['pid']; ?>">Brand name</a></h5>
                      <span>Status: </span><span class="text-success"><strong>In Stock</strong></span> </div>
                  </div></td>
                <td class="col-sm-1 col-md-1" style="text-align: center">
                 <form name="view<?php echo $i; ?>" action="<?php echo DOMAIN;?><?php echo $shopname ;?>/updateshopingcart/<?php echo $key;?>" method="post">
                   <input  class="form-control" type="text" name="soluong" value="<?php echo $product['sl']; ?>">
                  </form>  
                </td>
                <td class="col-sm-1 col-md-1 text-center"><strong>&pound;<?php echo number_format( $product['price'],3); ?></strong></td>
                <td class="col-sm-1 col-md-1 text-center"><strong>&pound;<?php echo number_format($product['total'],3); ?></strong></td>
                <td class="col-sm-1 col-md-1"><button type="button" class="btn btn-danger" onclick="$('#removemodal').modal('show')"> <span class="glyphicon glyphicon-remove"></span> Remove </button></td>
                <td class="col-sm-1 col-md-1"><input class="btn btn-small" onclick="document.view<?php echo $i; ?>.submit();"  type="image" src="<?php echo DOMAINADESTORE?>images/refresh.png" alt="Cập nhật"/><span class="glyphicon icon-edit"></span> Update</td>
             
              </tr>
              <?php $total +=$product['total']; $i++; } }?>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><h5>Subtotal</h5></td>
                <td class="text-right"><h5><strong>&pound;<?php echo number_format( $total,3);?></strong></h5></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><h5>Estimated shipping</h5></td>
                <td class="text-right"><h5><strong>&pound;0.0</strong></h5></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><h3>Total</h3></td>
                <td class="text-right"><h3><strong>&pound;<?php echo number_format( $total,3);?></strong></h3></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td> <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>" class="btn btn-default"> <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping </a></td>
                <td> <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/buy" class="btn btn-primary"> Checkout <span class="glyphicon glyphicon-play"></span> </a></td>
              </tr>
            </tbody>
          </table>
          <?php }?>
        </div>
      </div>
    </div>
  </div>
</div>
