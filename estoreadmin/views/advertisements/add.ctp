<?php //pr($Catproductlist);die();?>
<?php include 'views/elements/language.ctp';?>
<div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='page-header'>
                    <h1 class='pull-left' style='font-family: Arial, Helvetica, sans-serif;'>
                      <i class='icon-ok'></i>
                      <?php __('Advertisement')?>
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
                          <a href='<?php echo DOMAINADESTORE?>advertisements<?php echo  $langs ?>'>
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
                      <form action="<?php echo DOMAINADESTORE; ?>advertisements/add" enctype="multipart/form-data" name="adminForm" method="post" accept-charset="utf-8" class='form form-horizontal validate-form' style='margin-bottom: 0;'>
                       <input type="hidden" name="_method" value="POST" />
                        <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Image_name')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' data-rule-minlength='2' data-rule-required='true' id='validation_name' name="data[Advertisement][name]" placeholder='<?php __('Image_name')?>' type='text'>
                          </div>
                        </div>   
                        <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Website_name')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' data-rule-minlength='2' data-rule-required='true' id='validation_name1' name="data[Advertisement][link]" placeholder='<?php __('Website_name')?>' type='text'>
                          </div>
                        </div> 
                         <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'><?php __('Image')?></label>
                          <div>
                        <div class=' input-group col-sm-4 controls' >
                          <input class='form-control' readonly='readonly' name='userfile' placeholder='<?php __('Image')?>' type='text'>
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
                        <label class='col-sm-3 col-sm-3 control-label'><?php __('Ad_position')?>:</label>
                        <div class='col-sm-4 controls'>
                          <div class='radio'>
                            <label>
                              <input name="data[Advertisement][display]" type='radio' value='0'>
                             <?php __('Advertisement_running_in_the_left')?>
                            </label>
                          </div>
                          <div class='radio'>
                            <label>
                              <input name="data[Advertisement][display]" type='radio' value='1'>
                               <?php __('Advertisement_running_in_the_right')?>
                            </label>
                          </div>
                          <div class='radio'>
                            <label>
                              <input name="data[Advertisement][display]" type='radio' value='2'>
                              <?php __('Advertisement_in_the_left')?>
                            </label>
                          </div>
                           <div class='radio'>
                            <label>
                              <input name="data[Advertisement][display]" type='radio' value='3'>
                               <?php __('Advertisement_in_the_right')?>
                            </label>
                          </div>
                        </div>
                      </div>                 
                        <div class='form-group'>
                        <label class='control-label col-sm-3' for='validation_select'><?php __('Status')?></label>
                        <div class='col-sm-4 controls'>
                          <label class='radio radio-inline'>
                            <input  name="data[Advertisement][status]" type='radio' value='1' checked="checked">
                            <?php __('Actived')?>
                          </label>
                          <label class='radio radio-inline'>
                            <input  name="data[Advertisement][status]" type='radio' value='0' >
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
                      <?php __('Advertisement')?>
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
                          <a href='<?php echo DOMAINADESTORE?>advertisements<?php echo  $langs ?>'>
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