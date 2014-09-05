<div class="container margintop20">
  <div class="row clearfix">
    <!-- menu -->
    <?php echo $this->element('themeshop/creativemarket/left')?>
    <div class="col-md-9 column">
      <ol class="breadcrumb">
        <li><a href="index.html"><i class="glyphicon glyphicon-home"></i></a></li>
        <li><a href="categories.html">Category</a></li>
       <li><a href="#">Product Listing</a></li>
      </ol>
      <div class="well well-sm">
        <div class="pull-right">
          <form class="form-inline" role="form">
            <div class="form-group">
              <select class="form-control">
                <option>--- sort ---</option>
                <!-- 
                <option>Price: Ascending</option>
                <option>Price: Descending</option>
                <option>Rating: Ascending</option>
                <option>Rating: Descending</option>
                 -->
              </select>
            </div>
          </form>
        </div>
        <strong>Category View</strong>
        <div class="btn-group"> 
        <!--  
        <a href="productlist-long.html" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list"> </span> List</a> 
        <a href="productlist.html" id="grid" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th"></span> Grid</a>
          -->
         </div>
      
      </div>
      
     
       <?php foreach($products as $pr){?>
      
      <div class="col-md-4 column productbox"> 
        <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php echo $pr['Estore_products']['id'];?>" title="<?php echo $pr['Estore_products']['title']?>">
            <?php if($pr['Estore_products']['images'] !='') {?> <img style="width: 265px; height:320px;" class="img-responsive" alt="Product Image" src="<?php echo DOMAINADESTORE.$pr['Estore_products']['images']?>" alt="<?php echo $pr['Estore_products']['title']?>" /><?php }?>
            <?php if($pr['Estore_products']['images'] =='') {?> <img style="width: 265px; height:320px;" class="img-responsive" alt="Product Image" src="<?php echo DOMAIN ?>creativemarket/img/product_noimg.jpg" alt="<?php echo $pr['Estore_products']['title']?>" /><?php }?>
            
	   </a>   
        <div class="producttitle"><?php echo $pr['Estore_products']['title']?></div> 
        <!--  <div class="action"> <b>Rating:</b> <i class="fa fa-star gold"></i><i class="fa fa-star gold"></i><i class="fa fa-star gold"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i> </div> -->
        <div class="productprice" style="margin: 3%;">
          <div class="pull-right" >
	          <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php echo $pr['Estore_products']['id'];?>" class="btn btn btn-sm wishlist" role="button" data-toggle="tooltip" data-original-title="Add to Wishlist"><span class="glyphicon glyphicon-heart"></span></a>
	          <a href="<?php echo DOMAIN?><?php echo $shopname ;?>/addshopingcart/<?php  echo $pr['Estore_products']['id'];?>" class="btn btn-danger btn-sm" role="button" >
	          <span class="glyphicon glyphicon-shopping-cart"></span> BUY</a>
          </div>
          <div class="pricetext">$<?php echo $pr['Estore_products']['price']?></div>
        </div>
         <?php  if(isset($_SESSION['name']) and isset($_SESSION['id'])){ ?>
	        <div class="rowss " style="width: 94%;border-top: 2px solid #dadada; padding-top: 0px;margin-left: 3%;">
		      <h5>Admin Editor</h5>
		      <a href="#" onclick="$('#editproduct').modal('show')" data-toggle="tooltip" data-placement="top" title="Edit Product" alt ="" class="btn btn-sm btn-hover btn-primary"><span class="glyphicon glyphicon-edit"></span></a>
		      <a href="#" data-toggle="tooltip" data-placement="top" title="Delete Product" class="btn btn-sm btn-hover btn-danger"><span class="glyphicon glyphicon glyphicon-trash"></span></a>
		      <a href="#" data-toggle="tooltip" data-placement="top" title="Status Product"  class="btn btn-sm btn-hover btn-success"><span class="glyphicon glyphicon-check"></span></a>
		      <a href="#" data-toggle="tooltip" data-placement="top" title="Printer Product"  class="btn btn-xs btn-hover btn-default">Print <span class="glyphicon glyphicon-print"></span></a>
		    </div>
	     <?php }?>
      </div>
      
	  <?php }?> 
	  
	 
      <div class="col-md-12 column ">
        <ul class="pagination">
         <?php if($paginator->numbers()!=null){?>
          <li><a href="#">&laquo;</a></li>
          <li><a href="#"> <?php $paginator->options(array('url' => $this->passedArgs)); echo $paginator->numbers(); ?></a></li>
          <li><a href="#">&raquo;</a></li>
          <?php }?> 
        </ul>
      </div>
    </div>
  </div>
</div>


    <div class="modal fade" id="editproduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header btn-primary">
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                <h4 class="modal-title ">Login</h4>
			            </div>
			
			            <div class="modal-body">
			                <!-- The form is placed inside the body of modal -->
			                <form id="loginForm" method="post"  action="<?php echo DOMAIN.$shopname?>/login" class="form-horizontal">
			                    <div class="form-group">
			                        <label class="col-md-3 control-label">Email</label>
			                        <div class="col-md-5">
			                            <input type="text" name="email" class="form-control" data-bv-field="email">
			                        </div>
			                    </div>
			                    <div class="form-group">
			                        <label class="col-md-3 control-label">Password</label>
			                        <div class="col-md-5">
			                            <input type="password" name="password" class="form-control" data-bv-field="password">
			                        </div>
			                    </div>
			                     <div class="form-group">
			                        <label class="col-md-3 control-label">Number Eshop (So TT:)</label>
			                        <div class="col-md-5">
			                            <input type="number" class="form-control" name="numbereshopnew" data-bv-field="numbereshopnew" />
			                        </div>
			                    </div>
			                    <div class="form-group">
			                        <div class="col-md-5 col-md-offset-3">
			                            <button type="submit" class="btn btn-default">Login</button>
			                        </div>
			                    </div>
			                </form>
			            </div>
			        </div>
			    </div>
			</div>
			<script type="text/javascript">
				$(document).ready(function() {
				    $('#editproduct').bootstrapValidator({
				        message: 'This value is not valid',
				        feedbackIcons: {
				            valid: 'glyphicon glyphicon-ok',
				            invalid: 'glyphicon glyphicon-remove',
				            validating: 'glyphicon glyphicon-refresh'
				        },
				        fields: {
				        	email: {
				                validators: {
				                    emailAddress: {
				                        message: 'The input is not a valid email address'
				                    }
				                }
				            },
				            numbereshopnew: {
				                validators: {
				                    notEmpty: {
				                        message: 'The Number E-Shop is required'
				                    }
				                }
				            },
				            password: {
				                validators: {
				                    notEmpty: {
				                        message: 'The password is required and cannot be empty'
				                    },
				                    identical: {
				                        field: 'confirmPassword',
				                        message: 'The password and its confirm are not the same'
				                    },
				                    different: {
				                        field: 'username',
				                        message: 'The password cannot be the same as username'
				                    }
				                }
				            }
				           
				        }
				    });
				});
			</script>