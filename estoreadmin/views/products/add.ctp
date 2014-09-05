<?php //pr($Catproductlist);die();?>
<?php include 'views/elements/language.ctp';?>
<div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='page-header'>
                    <h1 class='pull-left' style='font-family: Arial, Helvetica, sans-serif;'>
                      <i class='icon-ok'></i>
                      <?php __('Product_Manage')?>
                    </h1>
                    <div class='pull-right'>
                      <ul class='breadcrumb'>
                        <li>
                          
                           <a href="javascript:void(0);" onclick="javascript:document.adminForm.reset();">
                              <input class="btn btn-info" value="<?php __('Reset')?>" type="button">
                          </a>
                            <a href='#' rel="modal" id='show-help'>
                              <input class="btn btn-warning" value="<?php __('Help')?>" type="button">
                          </a>
                          <a href='<?php echo DOMAINADESTORE?>products<?php echo  $langs ?>'>
                              <input class="btn btn-danger" value="<?php __('Cancel')?>" type="button">
                          </a>
                        </li>                       
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box'>
                    <div class='box-header blue-background'>
                      <div class='title'><?php __('Add_new')?></div>
                      <div class='actions'>
                        <a class="btn box-remove btn-xs btn-link" href="#"><i class='icon-remove'></i>
                        </a>
                        
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                    <div class='box-content'>
                      <form action="<?php echo DOMAINADESTORE; ?>products/add" enctype="multipart/form-data" name="adminForm" method="post" accept-charset="utf-8" class='form form-horizontal validate-form' style='margin-bottom: 0;'>
                       <input type="hidden" name="_method" value="POST" />
                        <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Product_name')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' data-rule-minlength='2' data-rule-required='true' id='validation_name' name="data[Product][title]" placeholder='<?php __('Product_name')?>' type='text'>
                          </div>
                        </div>  
                        <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Product_code')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' data-rule-minlength='2' data-rule-required='true' id='validation_name1' name="data[Product][code]" placeholder='<?php __('Product_code')?>' type='text'>
                          </div>
                        </div> 
                         <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Static_linking')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' data-rule-minlength='2' data-rule-required='true' id='validation_name2' name="data[Product][alias]" placeholder='<?php __('Static_linking')?>' type='text'>
                          </div>
                        </div>  
                         <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_select'><?php __('In_category')?></label>
                          <div class='col-sm-4 controls'>
                           <?php  //pr($Catproductlist);die();?>                  
                          
                            <select class='form-control' data-rule-required='true' id='validation_select' name="data[Product][catproduct_id]" >
                              <option value="0"><?php __('Select_category')?></option> 
                              <?php foreach ($list_cat as $key =>$value){?>
                              <option value="<?php  echo $key ?>"><?php  echo $value ?></option>
                           <?php }?>               
                            </select>                           
                          </div>
                        </div>
                         <div class='form-group'>
                        <label class='col-sm-3 control-label'></label>
                        <div class='col-sm-4'>
                          <div class='checkbox'>
                            <label>
                              <input type='checkbox' value='1' name='data[Product][sptieubieu]'>
                              <?php __('Medium_and_premium_products')?>
                            </label>
                          </div>
                          <div class='checkbox'>
                            <label>
                              <input type='checkbox' value='1' name="data[Product][spkuyenmai]" >
                              <?php __('Promotional_products')?>
                            </label>
                          </div>
                         
                        </div>
                      </div>
                      <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_select'><?php __('Producer')?></label>
                          <div class='col-sm-4 controls'>
                           <?php  //pr($Catproductlist);die();?>                  
                          
                            <select class='form-control' data-rule-required='true' id='validation_select' name="data[Product][manufacturer]" >
                              <option value="0"><?php __('Select_producer')?></option> 
                              <?php foreach ($list_cat1 as $key =>$value){?>
                              <option value="<?php  echo $key ?>"><?php  echo $value ?></option>
                           <?php }?>               
                            </select>                           
                          </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_numbers'><?php __('Price')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' data-rule-number='true' data-rule-required='true' id='validation_numbers' name='data[Product][price]' placeholder='<?php __('Price')?>' type='text'>
                          </div>
                          </div>
                          <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_select'><?php __('Price_level')?></label>
                          <div class='col-sm-4 controls'>
                           <?php  //pr($Catproductlist);die();?>                  
                          
                            <select class='form-control' data-rule-required='true' id='validation_select' name="data[Product][khoanggia]" >
                              <option value="0"><?php __('Price_level')?></option> 
                              <?php foreach ($gia as $key =>$value){?>
                              <option value="<?php  echo $key ?>"><?php  echo $value ?></option>
                           <?php }?>               
                            </select>                           
                          </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'><?php __('Product_image')?></label>
                          <div>
                        <div class=' input-group col-sm-4 controls' >
                          <input class='form-control' readonly='readonly' name='userfile' placeholder='<?php __('Product_image')?>' type='text'>
                          <span class='input-group-addon ' style="padding:0px">
                            <span>
                            <a href="javascript:window.open('<?php echo DOMAINADESTORE; ?>upload.php','userfile','width=500,height=300');window.history.go(1)" >
                            <input class="btn btn-success" style="padding: 5px;"  value="<?php __('Select_image')?>" type="button">
                            </a>
                            </span>
                          </span>
                        </div>
                      </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'><?php __('Product_image')?> 1</label>
                          <div>
                        <div class=' input-group col-sm-4 controls' >
                          <input class='form-control' readonly='readonly' name='images1' placeholder='<?php __('Product_image')?>' type='text'>
                          <span class='input-group-addon ' style="padding:0px">
                            <span>
                            <a href="javascript:window.open('<?php echo DOMAINADESTORE; ?>upload1.php','images1','width=500,height=300');window.history.go(1)" >
                            <input class="btn btn-success" style="padding: 5px;"  value="<?php __('Select_image')?>" type="button">
                            </a>
                            </span>
                          </span>
                        </div>
                      </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'><?php __('Product_image')?> 2</label>
                          <div>
                        <div class=' input-group col-sm-4 controls' >
                          <input class='form-control' readonly='readonly' name='images2' placeholder='<?php __('Product_image')?>' type='text'>
                          <span class='input-group-addon ' style="padding:0px">
                            <span>
                            <a href="javascript:window.open('<?php echo DOMAINADESTORE; ?>upload2.php','images2','width=500,height=300');window.history.go(1)" >
                            <input class="btn btn-success" style="padding: 5px;"  value="<?php __('Select_image')?>" type="button">
                            </a>
                            </span>
                          </span>
                        </div>
                      </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'><?php __('Product_image')?> 3</label>
                          <div>
                        <div class=' input-group col-sm-4 controls' >
                          <input class='form-control' readonly='readonly' name='images3' placeholder='<?php __('Product_image')?>' type='text'>
                          <span class='input-group-addon ' style="padding:0px">
                            <span>
                            <a href="javascript:window.open('<?php echo DOMAINADESTORE; ?>upload3.php','images3','width=500,height=300');window.history.go(1)" >
                            <input class="btn btn-success" style="padding: 5px;"  value="<?php __('Select_image')?>" type="button">
                            </a>
                            </span>
                          </span>
                        </div>
                      </div>
                        </div>
                         <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'><?php __('Product_image')?> 4</label>
                          <div>
                        <div class=' input-group col-sm-4 controls' >
                          <input class='form-control' readonly='readonly' name='images4' placeholder='<?php __('Product_image')?>' type='text'>
                          <span class='input-group-addon ' style="padding:0px">
                            <span>
                            <a href="javascript:window.open('<?php echo DOMAINADESTORE; ?>upload4.php','images4','width=500,height=300');window.history.go(1)" >
                            <input class="btn btn-success" style="padding: 5px;"  value="<?php __('Select_image')?>" type="button">
                            </a>
                            </span>
                          </span>
                        </div>
                      </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_numbers'><?php __('Product_description')?> 2</label>
                           <div class='box-content col-sm-8'>
                      		<textarea class='form-control ckeditor' id='wysiwyg1'  name="data[Product][content]" rows='5'></textarea>
                    		</div>
                          </div>
                        
                         <div class='form-group'>
                        <label class='control-label col-sm-3' for='validation_select'><?php __('Status')?></label>
                        <div class='col-sm-4 controls'>
                          <label class='radio radio-inline'>
                            <input  name="data[Product][status]" type='radio' value='1' checked="checked">
                            <?php __('Actived')?>
                          </label>
                          <label class='radio radio-inline'>
                            <input  name="data[Product][status]" type='radio' value='0' >
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
              
              
            </div>
          </div>         
 <!-- Bottom -->
          <div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='page-header'>
                    <h1 class='pull-left' style='font-family: Arial, Helvetica, sans-serif;'>
                      <i class='icon-ok'></i>
                      <?php __('Product_Manage')?>
                    </h1>
                    <div class='pull-right'>
                      <ul class='breadcrumb'>
                        <li>                         
                          
                           <a href="javascript:void(0);" onclick="javascript:document.adminForm.reset();">
                              <input class="btn btn-info" value="<?php __('Reset')?>" type="button">
                          </a>
                            <a href='#' rel="modal" id='show-help'>
                              <input class="btn btn-warning" value="<?php __('Help')?>" type="button">
                          </a>
                          <a href='<?php echo DOMAINADESTORE?>products<?php echo  $langs ?>'>
                              <input class="btn btn-danger" value="<?php __('Cancel')?>" type="button">
                          </a>
                        </li>                       
                      </ul>
                    </div>
                  </div>
                </div>
              </div>                             
            </div>
          </div>