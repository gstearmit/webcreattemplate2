<?php //pr($edit);die();?>
<?php include 'views/elements/language.ctp';?>
<div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='page-header'>
                    <h1 class='pull-left' style='font-family: Arial, Helvetica, sans-serif;'>
                      <i class='icon-ok'></i>
                      <?php __('Hotline_management')?>
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
                          <a href='<?php echo DOMAINADESTORE?>helps<?php echo  $langs ?>'>
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
                      <form action="<?php echo DOMAINADESTORE; ?>helps/edit" enctype="multipart/form-data" name="adminForm" method="post" accept-charset="utf-8" class='form form-horizontal validate-form' style='margin-bottom: 0;'>
                       <input type="hidden" name="_method" value="POST" />
                       <input type="hidden" name="data[Help][id]" value="<?php echo  $edit['Help']['id'];?>" />
                        <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Title')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' value="<?php echo  $edit['Help']['title'];?>" data-rule-minlength='2' data-rule-required='true' id='validation_name' name="data[Help][title]" placeholder='<?php __('Title')?>' type='text'>
                          </div>
                        </div>  
                         <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Name_support')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' value="<?php echo  $edit['Help']['user_support'];?>" data-rule-minlength='2' data-rule-required='true' id='validation_name1' name="data[Help][user_support]" placeholder='<?php __('Name_support')?>' type='text'>
                          </div>
                        </div> 
                        <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Yahoo_name')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' value="<?php echo  $edit['Help']['user_yahoo'];?>" data-rule-minlength='2' data-rule-required='true' id='validation_name2' name="data[Help][user_yahoo]" placeholder='<?php __('Yahoo_name')?>' type='text'>
                          </div>
                        </div>  
                         <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Skype_name')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' value="<?php echo  $edit['Help']['user_skype'];?>" data-rule-minlength='2' data-rule-required='true' id='validation_name3' name="data[Help][user_skype]" placeholder='<?php __('Skype_name')?>' type='text'>
                          </div>
                        </div> 
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_numbers'><?php __('Telephone_number')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' value="<?php echo  $edit['Help']['user_mobile'];?>" data-rule-number='true' data-rule-required='true' id='validation_numbers' name='data[Help][user_mobile]' placeholder='<?php __('Telephone_number')?>' type='text'>
                          </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_email'><?php __('Email')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' value="<?php echo  $edit['Help']['user_email'];?>" data-rule-email='true' data-rule-required='true' id='validation_email' name='data[Help][user_email]' placeholder='E-mail' type='text'>
                          </div>
                        </div>                     
                        <div class='form-group'>
                        <label class='control-label col-sm-3' for='validation_select'><?php __('Status')?></label>
                        <div class='col-sm-4 controls'>
                          <label class='radio radio-inline'>
                            <input  name="data[Help][status]" type='radio' value='1' <?php if($edit['Help']['status']==1){ echo 'checked="checked"';}?>>
                            <?php __('Actived')?>
                          </label>
                          <label class='radio radio-inline'>
                            <input  name="data[Help][status]" type='radio' value='0' <?php if($edit['Help']['status']==0){ echo 'checked="checked"';}?> >
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
                      <?php __('Account')?>
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
                          <a href='<?php echo DOMAINADESTORE?>helps<?php echo  $langs ?>'>
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