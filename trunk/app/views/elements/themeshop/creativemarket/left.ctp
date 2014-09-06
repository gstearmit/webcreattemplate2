<?php
$shop = explode ( '/', $this->params ['url'] ['url'] );
$shopname = $shop [0];
$shop = $this->requestAction ( 'comment/get_shop_id/' . $shopname );
foreach ( $shop as $key => $value ) {
	$shop_id = $key;
}


?>

<script type="text/javascript">

// function reply_click(clicked_id,clicked_innertext)
// {
	
// 	alert(clicked_id);
	
	var ulrr = '<?php echo DOMAIN;?><?php echo $shopname.'/requets/';?>';
// 	 var url = ulrr +clicked_id;
// 	 //$('.modal-body').html(data);
//      $('#editadv').modal('show');
//      $.ajax({
//          url:url,
//          type:"POST",
//          data: {clicked_id},
//          success: function(data)
//          {
//            //alert(data);
        	 
//          }
//    });
  


// }

  
</script>

<div class="col-md-3 column">
	<ul class="nav nav-pills nav-stacked">
		<li class="active"><a
			href="<?php echo DOMAIN;?><?php echo $shopname ;?>"><span
				class="glyphicon glyphicon-chevron-right"></span> Home</a></li>
        <?php $root = $this->requestAction('/'.$shopname.'/danhmuc/'.$shopname);?>
       
        <?php  foreach ($root as $value){?>
        <li><?php if($value['estore_catproducts']['name'] !='') {?><a
			href='#' class="active2"><span
				class="glyphicon glyphicon-chevron-right"></span><?php echo $value['estore_catproducts']['name'];?></a> <?php }?></li>
        
        <?php $category = $this->requestAction('/'.$shopname.'/showsmenu1/'.$value['estore_catproducts']['id']);
             if(is_array($category) and !empty($category)){?>
               <?php foreach($category as $k=>$subcat){?>
                 <?php $categorys = $this->requestAction('/'.$shopname.'/showsmenu2/'.$subcat['estore_catproducts']['id']);?>
                      <?php  if(!empty($categorys)){?>
                              <?php foreach($categorys as $k=>$subcats){?>
                             <li class="submenu"><a href="#"> <span
				class="glyphicon glyphicon-plus"></span><?php echo $subcat['estore_catproducts']['name']?> </a>
						      <?php }?>
			         	    </li>
				<?php  }else{   ?>
                  <?php if($subcat['estore_catproducts']['name'] !='') {?>  <li><a
			href='<?php echo DOMAIN;?><?php echo $shopname ;?>/listproduct/<?php echo $subcat['estore_catproducts']['id']?>'><span
				class="glyphicon glyphicon-chevron-right"></span><?php echo $subcat['estore_catproducts']['name']?></a></li> <?php }?>
                <?php }?>
            <?php   }?>
		  <?php } ?>		 
      
        
        <?php }?>
      </ul>

	<!-- ADV  -->  
	<?php $advr= $this->requestAction('/'.$shopname.'/advapp') ?>
              <?php foreach($advr as $advs1 ){  ?>
									<div class="feature">
		<a href="<?php echo $advs1['Estore_advertisements']['link'] ?>"
			target="_blank"><img
			src="<?php echo DOMAINADESTORE.$advs1['Estore_advertisements']['images']?>"
			class="img-responsive" style="width: 373px; height: 100px;" alt="" /></a>
		<!--  
										<h4>WORLDWIDE <strong>DELIVERY</strong></h4>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
										-->	
										 <?php  if(isset($_SESSION['name']) and isset($_SESSION['id'])){ ?>
									        <div class="rowss "
												style="width: 94%; border-top: 2px solid #dadada; padding-top: 0px; margin-left: 3%;">
												<h5>Admin Editor</h5>
												 <a href="#" rel="<?php echo DOMAIN.$shopname.'/requets';?>" id="<?php echo $advs1['Estore_advertisements']['id'] ?>" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-sm btn-hover btn-primary viewedit"><span class="glyphicon glyphicon-edit"></span></a>
												 <a href="#" id="<?php echo $advs1['Estore_advertisements']['id'] ?>" onclick="reply_click(this.id,this.innerHTML)" data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-sm btn-hover btn-danger"><span class="glyphicon glyphicon glyphicon-trash"></span></a> 
												 <a href="#" id="<?php echo $advs1['Estore_advertisements']['id'] ?>"onclick="reply_click(this.id,this.innerHTML)" data-toggle="tooltip" data-placement="top" title="Status" class="btn btn-sm btn-hover btn-success"><span class="glyphicon glyphicon-check"></span></a> 
												 <a href="#" id="<?php echo $advs1['Estore_advertisements']['id'] ?>" onclick="reply_click(this.id,this.innerHTML)" data-toggle="tooltip" data-placement="top" title="Printer" class="btn btn-xs btn-hover btn-default">Print <span class="glyphicon glyphicon-print"></span></a>
											</div>
											
									     <?php }?>
									    						
									</div>
			 <?php }?>  
			             <script type="text/javascript">
											   $(document).ready(function(){
												  $('a.viewedit').click(function() {
													  var ID = $(this).attr('id');
													  var url = $(this).attr('rel');
												    $.post(url, { id:ID }, function(data) {
												        $('.modal-body').html(data);
												        $('#editadv').modal('show');
												    });
												    return false; // prevent default
												  });
												});
			            </script>						
			<div class="feature">
		<img src="<?php echo DOMAIN ?>creativemarket/img/fast.png"
			class="img-responsive" alt="" />
		<h4>
			FAST <strong>SERVICE</strong>
		</h4>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
			eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
	</div>

</div>


<div class="modal fade" id="editadv" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header btn-primary">
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true">&times;</button>
				<h4 class="modal-title ">
					<div class='title'><?php __('Edit')?></div>
				</h4>
			</div>

			<div class="modal-body"></div>
		</div>
	</div>
</div>
<script type="text/javascript">
				$(document).ready(function() {
				    $('#editadv').bootstrapValidator({
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