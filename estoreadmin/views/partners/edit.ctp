<?php //pr($edit);die();?>
<?php include 'views/elements/language.ctp';?>
<div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='page-header'>
                    <h1 class='pull-left' style='font-family: Arial, Helvetica, sans-serif;'>
                      <i class='icon-ok'></i>
                      <?php __('Partners')?>
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
                          <a href='<?php echo DOMAINADESTORE?>partners<?php echo  $langs ?>'>
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
                      <form action="<?php echo DOMAINADESTORE; ?>partners/edit" enctype="multipart/form-data" name="adminForm" method="post" accept-charset="utf-8" class='form form-horizontal validate-form' style='margin-bottom: 0;'>
                       <input type="hidden" name="_method" value="POST" />
                       <input type="hidden" name="data[Partner][id]" value="<?php echo $edit['Partner']['id'];?>" />
                        <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Partner_name')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control'  value="<?php echo $edit['Partner']['name'];?>" data-rule-minlength='2' data-rule-required='true' id='validation_name' name="data[Partner][name]" placeholder='<?php __('Partner_name')?>' type='text'>
                          </div>
                        </div>  
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_numbers'><?php __('Telephone_number')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control'  value="<?php echo $edit['Partner']['phone'];?>" data-rule-number='true' data-rule-required='true' id='validation_numbers' name='data[Partner][phone]' placeholder='<?php __('Telephone_number')?>' type='text'>
                          </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_email'><?php __('Email')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control'  value="<?php echo $edit['Partner']['email'];?>" data-rule-email='true' data-rule-required='true' id='validation_email' name='data[Partner][email]' placeholder='E-mail' type='text'>
                          </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Address')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control'  value="<?php echo $edit['Partner']['address'];?>" data-rule-minlength='2' data-rule-required='true' id='validation_name' name="data[Partner][address]" placeholder='<?php __('Address')?>' type='text'>
                          </div>
                        </div>  
                        <div class='form-group'>
                          <div class='control-label col-sm-3'>
                            <label for='validation_url'><?php __('Website')?></label>
                            <small class='help-block'>http://</small>
                          </div>
                          <div class='col-sm-4 controls'>
                            <input class='form-control'  value="<?php echo $edit['Partner']['website'];?>" data-rule-required='true' data-rule-url='true' id='validation_url' name='data[Partner][website]' placeholder='<?php __('Address')?>' type='text'>
                          </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'><?php __('Image')?></label>
                          <div>
                        <div class=' input-group col-sm-4 controls' >
                          <input class='form-control'  value="<?php echo $edit['Partner']['images'];?>" readonly='readonly' name='userfile' placeholder='<?php __('Image')?>' type='text'>
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
                        <label class='control-label col-sm-3' for='validation_select'><?php __('Status')?></label>
                        <div class='col-sm-4 controls'>
                          <label class='radio radio-inline'>
                            <input  name="data[Partner][status]" type='radio' value='1' <?php if($edit['Partner']['status']==1){ echo 'checked="checked"';}?>>
                            <?php __('Actived')?>
                          </label>
                          <label class='radio radio-inline'>
                            <input  name="data[Partner][status]" type='radio' value='0' <?php if($edit['Partner']['status']==0){ echo 'checked="checked"';}?> >
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
                          <a href='<?php echo DOMAINADESTORE?>partners<?php echo  $langs ?>'>
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