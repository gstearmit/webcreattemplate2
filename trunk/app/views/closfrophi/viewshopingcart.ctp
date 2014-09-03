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





<!-- Content section -->		
            <section class="main">
                
                <!-- Cart container -->
                <section class="cart">



                    <div class="container">
                        <div class="row">

                            <div class="span9">
                                
                                <!-- Cart -->
                                <div class="box">
                                  
                                        
                                        <div class="box-header">
                                            <h3>Shopping cart</h3>
                                            <h5>You currently have <strong><?php if(isset($_SESSION['shopingcart']))
                                            { $sl=count($_SESSION['shopingcart']) ;
                                            echo $sl;
                                            }else {echo "0"; }?></strong> item(s) in your cart</h5>
                                        </div>

                                        <div class="box-content">
                                            <div class="cart-items">
                                               <?php $total = 0;if($shopingcart){?>
                                                <table class="styled-table">
                                                    <thead>
                                                        <tr>
                                                            <th class="col_product text-left">Product</th>
                                                            <th class="col_remove text-right">Update</th>
                                                             <th class="col_remove text-right">Delete</th>
                                                            <th class="col_qty text-right">Qty</th>
                                                            <th class="col_single text-right">Single</th>
                                                            <th class="col_discount text-right">Discount</th>
                                                            <th class="col_total text-right">Total</th>
                                                        </tr>
                                                    </thead>
													
                                                    <tbody>		
                                                     <?php $total=0; $i=0; foreach($shopingcart as $key=>$product) {?>
                                                     <?php if($product['name']!=null){?>							
                                                        <tr>
                                                            <td data-title="Product" class="col_product text-left">
                                                                <div class="image "><!--  visible-desktop -->
                                                                    <a href="<?php echo DOMAINAD.$shopname;?>/view<?php echo $product['pid']; ?>">
                                                                        <img src="<?php echo DOMAINADESTORE;?><?php echo $product['images']; ?>" style="width: 70px;" alt="<?php echo $product['name']; ?>">
                                                                    </a>
                                                                </div>

                                                                <h5>
                                                                    <a href="<?php echo DOMAINAD.$shopname;?>/view<?php echo $product['pid']; ?>"><?php echo $product['name']; ?></a>
                                                                </h5>

                                                            </td>
                                                             <td data-title="Update" class="col_remove text-right">
                                                               <input class="btn btn-small" onclick="document.view<?php echo $i; ?>.submit();"  type="image" src="<?php echo DOMAINADESTORE?>images/refresh.png" alt="Cập nhật"/>
                                                            </td>
                                                            <td data-title="Remove" class="col_remove text-right">
                                                              <button class="btn btn-small" onclick="$('#removemodal').modal('show')">
                                                                    <i class="icon-trash icon-small"></i>
                                                              </button>
                                                                
                                                            </td>
                                                            

                                                            <td data-title="Qty" class="col_qty text-right">
                                                               <form name="view<?php echo $i; ?>" action="<?php echo DOMAIN;?><?php echo $shopname ;?>/updateshopingcart/<?php echo $key;?>" method="post">
                                                                  <input type="text" name="soluong" value="<?php echo $product['sl']; ?>" />
                                                                </form>
                                                            </td>

                                                            <td data-title="Single" class="col_single text-right">
                                                                <span class="single-price">£<?php echo number_format( $product['price'],3); ?></span>
                                                            </td>

                                                            <td data-title="Discount" class="col_discount text-right">
                                                                <span class="discount">£0.00</span>
                                                            </td>

                                                            <td data-title="Total" class="col_total text-right">
                                                                <span class="total-price">£<?php echo number_format($product['total'],3); ?></span>
                                                            </td>
                                                        </tr>
                                                       
                                                         <?php $total +=$product['total']; $i++; } }?>
                                                    </tbody>
                                                   
                                                </table>
                                                <?php }?>
                                            </div>
                                        </div>

                                        <div class="box-footer col-md-12">
                                            <div class="pull-left col-md-4 col-sm-4 col-xs-12">
                                                <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>" class="btn btn-small">
                                                    <i class="icon-chevron-left"></i> &nbsp; Continue shopping
                                                </a>			
                                            </div>

                                            <div class="pull-right col-md-8">
                                               <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/viewshopingcart" class="btn btn-small mm20 col-md-6 col-sm-6 col-xs-12" style="margin: 0px 10px 10px 0px;">
                                                    <i class="icon-undo"></i> &nbsp; Update cart
                                                </a>
										<?php if(isset($_SESSION['shopingcart']) and !empty($_SESSION['shopingcart'])){ ?>
                                                <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/buy" name="checkout" value="1" class="btn btn-primary btn-small mm20 col-md-6 col-sm-6 col-xs-12" style="margin: 0px 10px 10px 0px;">
                                                    Proceed to checkout &nbsp; <i class="icon-chevron-right"></i>
                                                </a>
                                       <?php }?>         
                                            </div>
                                        </div>
                                   
                                </div>
                                <!-- End Cart -->

                                <!-- Shipping estimator -->
                                <div class="box">
                                    <form enctype="multipart/form-data" action="#" method="post" onsubmit="return false;">

                                        <div class="box-header">
                                            <h3>Shipping estimator</h3>
                                            <h5>Get an estimated shipping cost for your order</h5>
                                        </div>

                                        <div class="box-content">
                                            <div class="row-fluid">

                                                <div class="span4">
                                                    <label for="country">Country</label>
                                                    <select class="span12" id="country" name="country">
                                                        <option value="3" >Australia</option>
                                                        <option value="2" >Canada</option>
                                                        <option value="17" selected="selected">United Kingdom</option>
                                                        <option value="1" >United States</option>
                                                    </select>
                                                </div>

                                                <div class="span4">
                                                    <label for="state">State</label>
                                                    <div id="shipping_states">
                                                        <select class="span12" id="state" name="state">
                                                            
                                                        </select>				
                                                    </div>
                                                </div>

                                                <div class="span4">
                                                    <label>ZIP</label>
                                                    <input class="span12 zip" type="text" name="zip" value=""/>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="box-footer">
                                            <a class="btn btn-small" href="#" onclick="$('#shipping').modal('show');return false;">Estimate shipping cost</a>
                                        </div>
                                    </form>
                                </div>                                
                                <!-- End Shipping estimator -->

                                <!-- Shipping modal -->
                                <div id="shipping" class="modal hide fade" tabindex="-1">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <div class="hgroup title">
                                            <h3>Shipping estimator</h3>
                                            <h5>Get an estimated shipping cost for your order</h5>
                                        </div>
                                    </div>

                                    <div class="modal-body">
                                        <div id="shipping_options">
                                            <table class="table table-striped table-bordered">                                         
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Price</th>
                                                </tr>
                                                <tr>
                                                    <td>Free shipping</td>
                                                    <td>Delivered to your letterbox within 7-14 working days</td>
                                                    <td>£0.00</td>
                                                </tr>
                                                <tr>
                                                    <td>Standard</td>
                                                    <td>Delivered to your letterbox within 5 working days</td>
                                                    <td>£4.95</td>
                                                </tr>
                                                <tr>
                                                    <td>Speedy</td>
                                                    <td>Delivered to your letterbox within 3 working days</td>
                                                    <td>£8.95</td>
                                                </tr>                                                
                                            </table>
                                            
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <div class="pull-right">
                                            <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/buy" class="btn btn-primary btn-small">
                                                Proceed to checkout &nbsp; <i class="icon-chevron-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>		
                                <!-- End Shipping modal -->
                                
                            </div>

                            <div class="span3">
                                
                                <!-- Cart details -->
                                <div class="cart-details">
                                    <div class="box">
                                        <div class="hgroup title">
                                            <h3>Order totals</h3>
                                            <h5>Shipping costs and taxes will be evaluated during checkout</h5>
                                        </div>

                                        <ul class="price-list">
                                            <li>Subtotal: <strong>£<?php echo number_format( $total,3);?></strong></li>
                                            <li class="important">Total: <strong>£<?php echo number_format( $total,3);?></strong></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- End class="cart-details" -->
                                
                                <!-- Coupon -->
                                <div class="coupon">
                                    <div class="box">
                                        <div class="hgroup title">
                                            <h3>Coupon code</h3>
                                            <h5>Enter your coupon here to redeem</h5>
                                        </div>

                                        <form enctype="multipart/form-data" action="#" method="post" onsubmit="return false;">
                                            
                                            <label for="coupon_code">Coupon code</label>
                                            <div class="input-append">
                                                <input id="coupon_code" value="" type="text" name="coupon" />

                                                <button type="submit" class="btn" value="Apply" name="set_coupon_code" >
                                                    <i class="icon-ok"></i>
                                                </button>
                                            </div>

                                        </form>				
                                    </div>
                                </div>
                                <!-- End class="coupon" -->
                                
                            </div>

                        </div>
                    </div>	
                </section>         
                <!-- End Cart container -->
                
            </section>
            <!-- End class="main" -->
            
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

