<?php //pr($edit);die();?>
<div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='page-header'>
                   <!--  <h1 class='pull-left'>
                      <i class='icon-ok'></i>
                      <span>Validations</span>
                    </h1>-->
                    <div class='pull-right'>
                      <ul class='breadcrumb'>
                        <li>
                          <a href='index.html'>
                            <i class='icon-bar-chart'></i>
                          </a>
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li>
                         <?php __('acount')?>
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'><?php __('Edit')?></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box'>
                    <div class='box-header blue-background'>
                      <div class='title'><?php __('Change_account')?></div>
                      <div class='actions'>
                        <a class="btn box-remove btn-xs btn-link" href="#"><i class='icon-remove'></i>
                        </a>
                        
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                    <div class='box-content'>
                      <form action="<?php echo DOMAINAD ?>accounts/check_pass" enctype="multipart/form-data" name="image" method="post" accept-charset="utf-8" class='form form-horizontal validate-form' style='margin-bottom: 0;'>
                       <input type="hidden" name="_method" value="POST" />
                       <input type="hidden" name="data[User][id]" value="<?php echo $edit['User']['id'];?>" />
                        <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Username')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' data-rule-minlength='2' value='<?php echo $edit['User']['name'];?>' data-rule-required='true' id='validation_name' name="data[User][name]" placeholder='<?php __('Username')?>' type='text'>
                          </div>
                        </div>
                       <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_email'><?php __('Email_password_retrieval')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' data-rule-email='true' value='<?php echo $edit['User']['email'];?>' data-rule-required='true' id='validation_email' name='data[User][email]' placeholder='<?php __('Email_password_retrieval')?>' type='text'>
                          </div>
                        </div>
                         <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'><?php __('Old_password')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' data-rule-minlength='6' data-rule-password='true' data-rule-required='true' id='validation_password' name='data[User][pass_old]' placeholder='<?php __('Password')?>' type='password'>
                          </div>
                        </div>
                         <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'><?php __('New_password')?></label>
                           <div class='col-sm-4 controls'>
                            <input class='form-control' data-rule-minlength='6' data-rule-password='true' data-rule-required='true' id='validation_password1' name='data[User][pass_new]' placeholder='<?php __('Password')?>' type='password'>
                          </div>
                        </div>
                      
                         
                        <div class='form-actions' style='margin-bottom:0'>
                          <div class='row'>
                            <div class='col-sm-9 col-sm-offset-3'>
                              <button class='btn btn-primary' type='submit' value="<?php __('Edit');?> " >
                                <i class='icon-save'></i>
                                 <?php __('Edit')?>
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