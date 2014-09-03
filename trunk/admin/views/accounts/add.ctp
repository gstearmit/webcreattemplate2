<?php //pr($Catproductlist);die();?>
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
                        <li class='active'><?php __('Add_New')?></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box'>
                    <div class='box-header blue-background'>
                      <div class='title'><?php __('Create_acount')?></div>
                      <div class='actions'>
                        <a class="btn box-remove btn-xs btn-link" href="#"><i class='icon-remove'></i>
                        </a>
                        
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                    <div class='box-content'>
                      <form action="<?php echo DOMAINAD ?>accounts/add" enctype="multipart/form-data" name="image" method="post" accept-charset="utf-8" class='form form-horizontal validate-form' style='margin-bottom: 0;'>
                       <input type="hidden" name="_method" value="POST" />
                        <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Username')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' data-rule-minlength='2' data-rule-required='true' id='validation_name' name="data[User][name]" placeholder='<?php __('Username')?>' type='text'>
                          </div>
                        </div>
                       <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_email'><?php __('Email_password_retrieval')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' data-rule-email='true' data-rule-required='true' id='validation_email' name='data[User][email]' placeholder='<?php __('Email_password_retrieval')?>' type='text'>
                          </div>
                        </div>
                         <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'><?php __('Password')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' data-rule-minlength='6' data-rule-password='true' data-rule-required='true' id='validation_password' name='data[User][password]' placeholder='<?php __('Password')?>' type='password'>
                          </div>
                        </div>
                         <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password_confirmation'><?php __('Enter_your_password_again')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' data-rule-equalto='#validation_password' data-rule-required='true' id='validation_password_confirmation' name='data[User][pass2]' placeholder='<?php __('Enter_your_password_again')?>' type='password'>
                          </div>
                        </div>
                      
                         
                        <div class='form-actions' style='margin-bottom:0'>
                          <div class='row'>
                            <div class='col-sm-9 col-sm-offset-3'>
                              <button class='btn btn-primary' type='submit' value="<?php __('Add_New');?> " >
                                <i class='icon-save'></i>
                                 <?php __('Add_New')?>
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