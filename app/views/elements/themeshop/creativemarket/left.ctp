<?php
$shop = explode ( '/', $this->params ['url'] ['url'] );
$shopname = $shop [0];
$shop = $this->requestAction ( 'comment/get_shop_id/' . $shopname );
foreach ( $shop as $key => $value ) {
	$shop_id = $key;
}

?>
<script type="text/javascript">
function reply_click(clicked_id,clicked_innertext)
{
	$('#editadv').modal('show');
	alert(clicked_id);
}
  
</script>

 <div class="col-md-3 column">
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="<?php echo DOMAIN;?><?php echo $shopname ;?>"><span class="glyphicon glyphicon-chevron-right"></span> Home</a></li>
        <?php $root = $this->requestAction('/'.$shopname.'/danhmuc/'.$shopname);?>
       
        <?php  foreach ($root as $value){?>
        <li><?php if($value['estore_catproducts']['name'] !='') {?><a href='#' class="active2"><span class="glyphicon glyphicon-chevron-right"></span><?php echo $value['estore_catproducts']['name'];?></a> <?php }?></li>
        
        <?php $category = $this->requestAction('/'.$shopname.'/showsmenu1/'.$value['estore_catproducts']['id']);
             if(is_array($category) and !empty($category)){?>
               <?php foreach($category as $k=>$subcat){?>
                 <?php $categorys = $this->requestAction('/'.$shopname.'/showsmenu2/'.$subcat['estore_catproducts']['id']);?>
                      <?php  if(!empty($categorys)){?>
                              <?php foreach($categorys as $k=>$subcats){?>
                             <li class="submenu"><a href="#">
						    	 <span class="glyphicon glyphicon-plus"></span><?php echo $subcat['estore_catproducts']['name']?> </a>
						      <?php }?>
			         	    </li>
				<?php  }else{   ?>
                  <?php if($subcat['estore_catproducts']['name'] !='') {?>  <li><a href='<?php echo DOMAIN;?><?php echo $shopname ;?>/listproduct/<?php echo $subcat['estore_catproducts']['id']?>'><span class="glyphicon glyphicon-chevron-right"></span><?php echo $subcat['estore_catproducts']['name']?></a></li> <?php }?>
                <?php }?>
            <?php   }?>
		  <?php } ?>		 
      
        
        <?php }?>
      </ul>
    
	<!-- ADV  -->  
	<?php $advr= $this->requestAction('/'.$shopname.'/advapp') ?>
              <?php foreach($advr as $advs1 ){  ?>
									<div class="feature">	
										<a href="<?php echo $advs1['Estore_advertisements']['link'] ?>" target="_blank"><img src="<?php echo DOMAINADESTORE.$advs1['Estore_advertisements']['images']?>" class="img-responsive" style="width: 373px;height: 100px; " alt="" /></a>
										<!--  
										<h4>WORLDWIDE <strong>DELIVERY</strong></h4>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
										-->	
										 <?php  if(isset($_SESSION['name']) and isset($_SESSION['id'])){ ?>
									        <div class="rowss " style="width: 94%;border-top: 2px solid #dadada; padding-top: 0px;margin-left: 3%;">
										      <h5>Admin Editor</h5>
										      <a href="#" id="<?php echo $advs1['Estore_advertisements']['id'] ?>" onclick="reply_click(this.id,this.innerHTML)" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-sm btn-hover btn-primary"><span class="glyphicon glyphicon-edit"></span></a>
										      <a href="#" id="<?php echo $advs1['Estore_advertisements']['id'] ?>" onclick="reply_click(this.id,this.innerHTML)"  data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-sm btn-hover btn-danger"><span class="glyphicon glyphicon glyphicon-trash"></span></a>
										      <a href="#" id="<?php echo $advs1['Estore_advertisements']['id'] ?>" onclick="reply_click(this.id,this.innerHTML)"  data-toggle="tooltip" data-placement="top" title="Status"  class="btn btn-sm btn-hover btn-success"><span class="glyphicon glyphicon-check"></span></a>
										      <a href="#" id="<?php echo $advs1['Estore_advertisements']['id'] ?>" onclick="reply_click(this.id,this.innerHTML)"  data-toggle="tooltip" data-placement="top" title="Printer"  class="btn btn-xs btn-hover btn-default">Print <span class="glyphicon glyphicon-print"></span></a>
										    </div>
									     <?php }?>								
									</div>
			 <?php }?>  						
									<div class="feature">	
										<img src="<?php echo DOMAIN ?>creativemarket/img/fast.png" class="img-responsive" alt="" />
										<h4>FAST <strong>SERVICE</strong></h4>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>									
									</div>
							
	   </div>
	   
	   
	   <div class="modal fade" id="editadv" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header btn-primary">
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                <h4 class="modal-title "> <div class='title'><?php __('Edit')?></div></h4>
			            </div>
			
			            <div class="modal-body">
			                <!-- The form is placed inside the body of modal -->
			               
					                      <form action="<?php echo DOMAIN.$shopname; ?>/advertisementsedit" enctype="multipart/form-data" name="adminForm" method="post" accept-charset="utf-8" class='form form-horizontal validate-form' style='margin-bottom: 0;'>
					                      <?php 
					                      $id = 32;
					                      $edit = $this->requestAction('/'.$shopname.'/advertisementsedit/'.$id);
					                    //  pr($edit);
					                       ?>
					                       <input type="hidden" name="_method" value="POST" />
					                        <input type="hidden" name="data[Estore_advertisements][id]" value="<?php echo $edit['Estore_advertisements']['id']?>" />
					                        <div class='form-group'>
					                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Image_name')?></label>
					                          <div class='col-sm-4 controls'>
					                            <input class='form-control' value="<?php echo $edit['Estore_advertisements']['name']?>" data-rule-minlength='2' data-rule-required='true' id='validation_name' name="data[Estore_advertisements][name]" placeholder='<?php __('Image_name')?>' type='text'>
					                          </div>
					                        </div>   
					                        <div class='form-group'>
					                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Website_name')?></label>
					                          <div class='col-sm-4 controls'>
					                            <input class='form-control' value="<?php echo $edit['Estore_advertisements']['link']?>" data-rule-minlength='2' data-rule-required='true' id='validation_name1' name="data[Estore_advertisements][link]" placeholder='<?php __('Website_name')?>' type='text'>
					                          </div>
					                        </div> 
					                         <div class='form-group'>
					                          <label class='control-label col-sm-3' for='validation_password'><?php __('Image')?></label>
					                          <div>
					                        <div class=' input-group col-sm-4 controls' >
					                          <input class='form-control' value="<?php echo $edit['Estore_advertisements']['images']?>" readonly='readonly' name='userfile' placeholder='<?php __('Image')?>' type='text'>
					                          <span class='input-group-addon ' style="padding:0px">
					                            <span>
					                            <a href="javascript:window.open('<?php echo DOMAINADESTORE; ?>upslide.php','userfile','width=500,height=300');window.history.go(1)" >
					                            <input class="btn btn-success" style="padding: 5px;"  value="<?php __('Select_image')?>" type="button">
					                            </a>
					                            </span>
					                          </span>
					                        </div>
					                      </div>
					                        </div> 
					                        <div class='form-group'>
					                        <label class='col-sm-3 col-sm-3 control-label'><?php __('Current_location')?>:</label>
					                        <div class='col-sm-4 controls'>
					                          <div class='radio'>
					                            <label>                             
					                             <?php if($edit['Estore_advertisements']['display']==0){?>
					                              <?php __('Advertisement_running_in_the_left')?>
					                              <?php }elseif ($edit['Estore_advertisements']['display']==1){?>
					                               <?php __('Advertisement_running_in_the_right')?>
					                              <?php }elseif ($edit['Estore_advertisements']['display']==2){?>
					                               <?php __('Advertisement_in_the_left')?>
					                              <?php }elseif ($edit['Estore_advertisements']['display']==3){?>
					                              <?php __('Advertisement_in_the_right')?>
					                              <?php }?>
					                            </label>
					                          </div>                      
					                        </div>
					                      </div>                 
					                         <div class='form-group'>
					                        <label class='col-sm-3 col-sm-3 control-label'><?php __('Alternate_location')?>:</label>
					                        <div class='col-sm-4 controls'>
					                          <div class='radio'>
					                            <label>
					                              <input name="data[Estore_advertisements][display]" type='radio' value='0'>
					                              <?php __('Advertisement_running_in_the_left')?>
					                            </label>
					                          </div>
					                          <div class='radio'>
					                            <label>
					                              <input name="data[Estore_advertisements][display]" type='radio' value='1'>
					                                <?php __('Advertisement_running_in_the_right')?>
					                            </label>
					                          </div>
					                          <div class='radio'>
					                            <label>
					                              <input name="data[Estore_advertisements][display]" type='radio' value='2'>
					                              <?php __('Advertisement_in_the_left')?>
					                            </label>
					                          </div>
					                           <div class='radio'>
					                            <label>
					                              <input name="data[Estore_advertisements][display]" type='radio' value='3'>
					                               <?php __('Advertisement_in_the_right')?>
					                            </label>
					                          </div>
					                        </div>
					                      </div>                 
					                        <div class='form-group'>
					                        <label class='control-label col-sm-3' for='validation_select'><?php __('Status')?></label>
					                        <div class='col-sm-4 controls'>
					                          <label class='radio radio-inline'>
					                            <input  name="data[Estore_advertisements][status]" type='radio' value='1'  <?php if($edit['Estore_advertisements']['status']==1){ echo 'checked="checked" ';}?>>
					                            <?php __('Actived')?>
					                          </label>
					                          <label class='radio radio-inline'>
					                            <input  name="data[Estore_advertisements][status]" type='radio' value='0' <?php if($edit['Estore_advertisements']['status']==0){ echo 'checked="checked" ';}?> >
					                             <?php __('Unactive')?>
					                          </label>
					                          </div>
					                      </div>                                      
					                       <div class='form-actions' style='margin-bottom:0'>
					                          <div class='row'>
					                            <div class='col-sm-9 col-sm-offset-3'>
					                              <button class='btn btn-primary' type='submit' value="<?php __('Save');?> " >
					                                <i class='icon-save'></i>
					                                 <?php __('Save')?>
					                              </button>
					                               </div>
					                          </div>
					                        </div>
					                        
					                      </form>                      
					                
			            </div>
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