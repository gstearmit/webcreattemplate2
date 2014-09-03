<?php echo $javascript->link('jquery.validate', true); ?>
<script>
function confirmDelete(delUrl)
{
if (confirm("Are you sure you want to delete this product?"))
{
	document.location = delUrl;
}
}
</script>
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
.shipmethod {
    margin-left: 33%;
    margin-top: 5%;
}
.phucmodel {
display: block;
}
.boder-radius {border-radius: 4px;}
</style>

<script type="text/javascript">
$().ready(function() {
	// validate signup form on keyup and submit
	$("#signupForm").validate({
		rules: {
				name: {
				required: true,
				minlength: 2
			},
			phone: {
				required: true,
			},
            address: {
				required: true,
			},
			email: {
				required: true,
				email: true
			},
			
			agree: "required"
		},
		messages: {
				name: {
				required: "<br><span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px;margin:65px;' >Xin vui lòng nhập tên !</span>",
				minlength: "<br><span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px;margin:65px; ' > Tên lớn hơn 2 ký tự !</span>"
			},
            phone: {
				required: "<br><span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px;margin:65px;' >Xin vui lòng nhập số điện thoại để chúng tôi liên lạc khi giao hàng !</span>",
				
			},
			address: {
				required: "<br><span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px;margin:65px;' >Xin vui lòng nhập số địa chỉ để chúng tôi liên lạc khi giao hàng !</span>",
				
			},
			email:{
						required: "<br> <span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px;margin:65px;margin:65px; ' >Xin vui lòng nhập Email</span> ",
                        email: "<br><span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px;margin:65px; ' > Email không đúng !"

			}
		}
	});
});
</script>
<?php  
// echo "khong co san pham nao";
if(isset($_SESSION['shopingcart']) and empty($_SESSION['shopingcart'])) { ?>
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
                                                              <a href="javascript:confirmDelete('<?php echo DOMAIN;?><?php echo $shopname ;?>/deleteshopingcart/<?php echo $key;?>')" class="btn btn-small" >
                                                                 <img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" />
                                                              </a>
                                                                
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

                                        <div class="box-footer col-md-12"  style="margin: 8px; border-radius: 5px;">
                                            <div class="pull-left col-md-4 col-sm-4 col-xs-12">
                                                <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>" class="btn btn-danger btn-small boder-radius">
                                                    <i class="icon-chevron-left"></i> &nbsp; Continue shopping
                                                </a>			
                                            </div>

                                            <div class="pull-right col-md-8">
                                               <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/viewshopingcart" class="btn btn-danger btn-small boder-radius mm20 col-md-6 col-sm-6 col-xs-12" style="margin: 0px 10px 10px 0px;">
                                                    <i class="icon-undo"></i> &nbsp; Update cart
                                                </a>
                                            </div>
                                        </div>
                                   
                                </div>
                                <!-- End Cart -->

                             
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
                                            <a href="checkout.html" class="btn btn-primary btn-small">
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
                              
                            </div>

                        </div>
                    </div>	
                </section>         
                <!-- End Cart container -->
                    
                <!-- Checkout / Billing Address -->
                <section class="checkout">


                    <div class="container">
                        <form enctype="multipart/form-data" action="<?php echo DOMAIN;?><?php echo $shopname ;?>/addinfomations" method="post">
                           <input class="contacts" type="hidden" value="<?php echo $total; ?>" name="total"/>
                            <div class="row">
                                <div class="span9">
                                    <div class="box">
                                        
                                        <!-- Checkout progress -->
                                        <div id="checkout-progress">
                                            <ul class="nav nav-tabs">
                                                <li class="active">
                                                    <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/buy">
                                                        <i class="icon-map-marker icon-large"></i>
                                                        <span>Ordering</span>
                                                    </a>
                                                </li>
                                                <!--  
                                                <li>
                                                    <a href="#">
                                                        <i class="icon-envelope icon-large"></i>
                                                        <span>Shipping address</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <div>
                                                        <i class="icon-truck icon-large"></i>
                                                        <span>Shipping method</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div>
                                                        <i class="icon-money icon-large"></i>
                                                        <span>Payment method</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div>
                                                        <i class="icon-search icon-large"></i>
                                                        <span>Order review</span>
                                                    </div>
                                                </li>
                                                -->
                                            </ul>					
                                        </div>
                                        <!-- End id="checkout-progress" -->
                                        
                                        <!-- Checkout content -->
                                        
                                        <div id="checkout-content">
                                            <div class="box-header">
                                                <div class="row-fluid">
                                                    <div class="span8">
                                                        <h3>Ordering Information</h3>
                                                        <h5>Information details</h5>
                                                    </div>
                                                    <div class="span4">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-content">
                                                <div class="row-fluid">
                                                 <?php 
                                             // name khach hang : $this->Session->read('name'))    
                                             if(isset($_SESSION['shopingcart']) and !empty($_SESSION['shopingcart'])){?>
                                                    <div class="span6">
                                                        <div class="control-group">
                                                            <label for="first_name" class="control-label">First name Last name</label>
                                                            <div class="controls">
                                                                <input type="text" title="" name="name" id="Name"  value="<?php echo $this->Session->read('name'); ?>" class=" span12 validate[required] inputText w200 input-validation-error blur" aria-required="true" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label for="email" class="control-label">Email</label>
                                                            <div class="controls">
                                                                <input  type="text" value="<?php echo $this->Session->read('email'); ?>" title="" name="email" id="Email" class="span12 validate[required,custom[email]] inputText w200 valid" aria-required="true" />
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label for="phone" class="control-label">Phone <span style="color:#F00;">(*)</span></label>
                                                            <div class="controls">
                                                                <input  type="text" title="(xx)xxx&ndash;xxxxx" name="phone"  value="<?php echo $this->Session->read('phone'); ?>" id="Mobile" data-val="true" class=" span12 validate[required,custom[telephone]] inputText w200 valid" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="span6">
                                                       
                                                        <div class="control-group">
                                                            <label for="street_address" class="control-label">Street address <span style="color:#F00;">(*)</span></label>
                                                            <div class="controls">
                                                                <input  type="text" value="" name="address" id="FullAddress" class="span12 validate[required] inputText w500 valid" />
                                                        </div>

                                                        <div class="row-fluid">
                                                            <label for="street_address" class="control-label">Forms of payment </label>
                                                            <div class="controls">
                                                               <select name="payop" id="payop">
										                              <option value="0">Thanh toán khi nhận hàng</option>
										                              <option value="nl">Thanh toán qua ngân lượng</option>
										                      </select>
                                                        </div>
                                                        
                                                        <div class="row-fluid">
                                                            <div class="shipmethod">                                                    
			                                                   <input type="submit" class="btn btn-primary"
			                                                       value="SEND CHECK OUT" /> <i class="icon-chevron-right"></i>
			                                                   
			                                                </div>
                                                        </div>
                                                    </div>
                                                    <?php  }?>
                                                </div>	
                                            </div>

                                            <div class="box-footer">
                                               
                                                
                                            </div>					
                                        </div>	
                                        <!-- End id="checkout-content" -->
                                        
                                    </div>
                                </div>

                                <div class="span3">                                    </div>                                
                                </div>
                            </div>
                        </form>
                    </div>	
                </section>
                <!-- End class="checkout" -->
                
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