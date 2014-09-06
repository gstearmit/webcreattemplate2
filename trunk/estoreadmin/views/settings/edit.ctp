<?php //pr($edit);die();?>
<?php include 'views/elements/language.ctp';?>
<div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='page-header'>
                    <h1 class='pull-left' style='font-family: Arial, Helvetica, sans-serif;'>
                      <i class='icon-ok'></i>
                      <?php __('Website_configuration')?>
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
                          <a href='<?php echo DOMAINADESTORE?>home<?php echo  $langs ?>'>
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
                      <div class='title'><?php __('Edit')?></div>
                      <div class='actions'>
                        <a class="btn box-remove btn-xs btn-link" href="#"><i class='icon-remove'></i>
                        </a>
                        
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                    <div class='box-content'>
                      <form action="<?php echo DOMAINADESTORE; ?>settings/edit" enctype="multipart/form-data" name="adminForm" method="post" accept-charset="utf-8" class='form form-horizontal validate-form' style='margin-bottom: 0;'>
                       <input type="hidden" name="_method" value="POST" />
                       <input type="hidden" name="data[Category][id]" value="<?php echo $edit['Setting']['id'];?>" />
                        <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Company_name')?>: (<?php __('Vietnamese')?>)</label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' value="<?php echo $edit['Setting']['name'];?>" data-rule-minlength='2' data-rule-required='true' id='validation_name' name="data[Category][name]" placeholder='<?php __('Company_name')?>' type='text'>
                          </div>
                        </div>  
                        <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Address') ?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' value="<?php echo $edit['Setting']['address'];?>" data-rule-minlength='2' data-rule-required='true' id='validation_name2' name="data[Category][name_en]" placeholder='<?php __('Address')?>' type='text'>
                          </div>
                        </div>  
                         <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Telephone_number')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' value="<?php echo $edit['Setting']['phone'];?>" data-rule-minlength='2' data-rule-required='true' id='validation_name1' name="data[Category][alias]" placeholder='<?php __('Telephone_number')?>' type='text'>
                          </div>
                        </div> 
                         <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Hotline') ?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' value="<?php echo $edit['Setting']['mobile'];?>" data-rule-minlength='2' data-rule-required='true' id='validation_name2' name="data[Category][name_en]" placeholder='<?php __('Hotline')?>' type='text'>
                          </div>
                        </div> 
                         <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_email'><?php __('Email')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' value="<?php echo $edit['Setting']['email'];?>" data-rule-email='true' data-rule-required='true' id='validation_email' name='data[Help][user_email]' placeholder='<?php __('Email')?>' type='text'>
                          </div>
                        </div>   
                         <div class='form-group'>
                          <div class='control-label col-sm-3'>
                            <label for='validation_url'><?php __('Link Website')?></label>
                            <small class='help-block'>http://</small>
                          </div>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' value="<?php echo $edit['Setting']['url'];?>" data-rule-required='true' data-rule-url='true' id='validation_url' name='data[Partner][website]' placeholder='<?php __('Link Website')?>' type='text'>
                          </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Website_title')?>: (<?php __('Vietnamese')?>)</label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' value="<?php echo $edit['Setting']['title'];?>" data-rule-minlength='2' data-rule-required='true' id='validation_name2' name="data[Category][name_en]" placeholder='<?php __('Website_title')?>' type='text'>
                          </div>
                        </div> 
                         <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Website_title')?>: (<?php __('English')?>)</label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' value="<?php echo $edit['Setting']['title_en'];?>" data-rule-minlength='2' data-rule-required='true' id='validation_name2' name="data[Category][name_en]" placeholder='<?php __('Website_title')?>' type='text'>
                          </div>
                        </div> 
                       <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_numbers'><?php __('Other_information')?> </label>
                           <div class='box-content col-sm-8'>
                      		<textarea class='form-control ckeditor' id='wysiwyg1'  name="data[Product][content]" rows='5'><?php echo $edit['Setting']['content'];?></textarea>
                    		</div>
                          </div>  
                           <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_numbers'><?php __('User_information')?> </label>
                           <div class='box-content col-sm-8'>
                      		<textarea class='form-control ckeditor' id='wysiwyg1'  name="data[Product][content]" rows='5'><?php echo $edit['Setting']['descriptions'];?></textarea>
                    		</div>
                          </div>  
                           <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_numbers'><?php __('Footter_information')?> </label>
                           <div class='box-content col-sm-8'>
                      		<textarea class='form-control ckeditor' id='wysiwyg1'  name="data[Product][content]" rows='5'><?php echo $edit['Setting']['footer'];?></textarea>
                    		</div>
                          </div> 
                          <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_numbers'><?php __('Keyword')?> </label>
                           <div class='box-content col-sm-8'>
                      		<textarea class='form-control ckeditor' id='wysiwyg1'  name="data[Product][content]" rows='5'><?php echo $edit['Setting']['keyword'];?></textarea>
                    		</div>
                          </div>   
                           <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_numbers'><?php __('Description')?> </label>
                           <div class='box-content col-sm-8'>
                      		<textarea class='form-control ckeditor' id='wysiwyg1'  name="data[Product][content]" rows='5'><?php echo $edit['Setting']['description'];?></textarea>
                    		</div>
                          </div>      
                        <div class='form-group'>
                        <label class='control-label col-sm-3' for='validation_select'><?php __('Status')?></label>
                        <div class='col-sm-4 controls'>
                          <label class='radio radio-inline'>
                            <input  name="data[Category][status]" type='radio' value='1' checked="checked">
                            <?php __('Actived')?>
                          </label>
                          <label class='radio radio-inline'>
                            <input  name="data[Category][status]" type='radio' value='0'  >
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
                      <?php __('Website_configuration')?>
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
                          <a href='<?php echo DOMAINADESTORE?>home<?php echo  $langs ?>'>
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