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
                       <?php __('Web_Configuration')?>
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
                      <div class='title'><?php __('Web_Configuration')?></div>
                      <div class='actions'>
                        <a class="btn box-remove btn-xs btn-link" href="#"><i class='icon-remove'></i>
                        </a>
                        
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                    <div class='box-content'>
                      <form action="<?php echo DOMAINAD ?>settings/edit" enctype="multipart/form-data" name="image" method="post" accept-charset="utf-8" class='form form-horizontal validate-form' style='margin-bottom: 0;'>
                       <input type="hidden" name="_method" value="POST" />
                        <input type="hidden" name="data[Setting][id]" value="<?php echo $edit['Setting']['id'];?>" />
                        <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Company_name')?> (VN)</label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' value='<?php echo $edit['Setting']['name'];?>' data-rule-minlength='2' data-rule-required='true' id='validation_name' name="data[Setting][name]" placeholder='<?php __('Company_name')?> (VN) ' type='text'>
                          </div>
                        </div>
                         <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Headquarters')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' value='<?php echo $edit['Setting']['address'];?>' data-rule-minlength='2' data-rule-required='true' id='validation_name1' name="data[Setting][address]" placeholder='<?php __('Headquarters')?>' type='text'>
                          </div>
                        </div>
                         <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Trading_Office')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' value='<?php echo $edit['Setting']['address_eg'];?>' data-rule-minlength='2' data-rule-required='true' id='validation_name2' name="data[Setting][address_eg]" placeholder='<?php __('Trading_Office')?>' type='text'>
                          </div>
                        </div>
                      
                          <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Phone')?> </label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' value='<?php echo $edit['Setting']['phone'];?>' data-rule-minlength='2' data-rule-required='true' id='validation_name3' name="data[Setting][phone]" placeholder='<?php __('Phone')?>' type='text'>
                          </div>
                        </div>
                        
                       <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_numbers'><?php __('Mobile')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control'   value='<?php echo $edit['Setting']['mobile'];?>' data-rule-number='true' data-rule-required='true' id='validation_numbers1' name='data[Setting][mobile]' placeholder='<?php __('Mobile')?>' type='text'>
                          </div>
                          </div>
                           <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Fax')?> </label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' value='<?php echo $edit['Setting']['fax'];?>' data-rule-minlength='2' data-rule-required='true' id='validation_name4' name="data[Setting][fax]" placeholder='<?php __('Fax')?>' type='text'>
                          </div>
                        </div>
                         <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Email')?> </label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' value='<?php echo $edit['Setting']['email'];?>' data-rule-minlength='2' data-rule-required='true' id='validation_name5' name="data[Setting][email]" placeholder='<?php __('Email')?>' type='text'>
                          </div>
                        </div>
                         <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Website')?> </label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' value='<?php echo $edit['Setting']['url'];?>' data-rule-minlength='2' data-rule-required='true' id='validation_name6' name="data[Setting][url]" placeholder='<?php __('Website')?>' type='text'>
                          </div>
                        </div>
                         <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Tile_website')?> </label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' value='<?php echo $edit['Setting']['title'];?>' data-rule-minlength='2' data-rule-required='true' id='validation_name7' name="data[Setting][title]" placeholder='<?php __('Website')?>' type='text'>
                          </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Copyright')?> </label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' value='<?php echo $edit['Setting']['info_other'];?>' data-rule-minlength='2' data-rule-required='true' id='validation_name8' name="data[Setting][info_other]" placeholder='<?php __('Copyright')?>' type='text'>
                          </div>
                        </div>
                          <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_numbers'><?php __('Keyword')?> (SEO)</label>
                           <div class='box-content col-sm-8'>
                      		<textarea class='form-control ckeditor' id='wysiwyg1' name="data[Setting][keyword]" rows='5'><?php echo $edit['Setting']['keyword'];?></textarea>
                    		</div>
                          </div>
                          <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_numbers'><?php __('Description')?> (SEO)</label>
                           <div class='box-content col-sm-8'>
                      		<textarea class='form-control ckeditor' id='wysiwyg1' name="data[Setting][description]" rows='5'><?php echo $edit['Setting']['description'];?></textarea>
                    		</div>
                          </div>
                          <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_numbers'><?php __('Sign_up')?></label>
                           <div class='box-content col-sm-8'>
                      		<textarea class='form-control ckeditor' id='wysiwyg1' name="data[Setting][about]" rows='5'><?php echo $edit['Setting']['about'];?></textarea>
                    		</div>
                          </div>
                          <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_numbers'><?php __('Sign_up_shop')?></label>
                           <div class='box-content col-sm-8'>
                      		<textarea class='form-control ckeditor' id='wysiwyg1' name="data[Setting][about_eg]" rows='5'><?php echo $edit['Setting']['about_eg'];?></textarea>
                    		</div>
                          </div>
                         
                         <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'><?php __('Img_header')?> </label>
                          <div>
                        <div class=' input-group col-sm-4 controls' >
                          <input class='form-control' value='<?php echo $edit['Setting']['image_header'];?>'  readonly='readonly' name='userfile1' placeholder='<?php __('Avatar')?>' type='text'>
                          <span class='input-group-addon ' style="padding:0px">
                            <span>
                            <a href="javascript:window.open('<?php echo DOMAINAD; ?>upload_pic.php?stt=1','userfile1','width=500,height=300');window.history.go(1)" >
                            <input class="btn btn-success" style="padding: 5px;"  value="<?php __('Select_image')?>" type="button">
                            </a>
                            </span>
                          </span>
                        </div>
                      </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'><?php __('Img_body')?></label>
                          <div>
                        <div class=' input-group col-sm-4 controls' >
                          <input class='form-control'  value='<?php echo $edit['Setting']['image_body'];?>'  readonly='readonly' name='userfile2' placeholder='<?php __('Background')?>' type='text'>
                          <span class='input-group-addon ' style="padding:0px">
                            <span>
                            <a href="javascript:window.open('<?php echo DOMAINAD; ?>upload_pic.php?stt=2','userfile2','width=500,height=300');window.history.go(1)" >
                            <input class="btn btn-success" style="padding: 5px;"  value="<?php __('Select_image')?>" type="button">
                         	</a>
                         	</span>
                          </span>
                        </div>
                      </div>
                        </div>
                         <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'><?php __('Img_footer')?></label>
                          <div>
                        <div class=' input-group col-sm-4 controls' >
                          <input class='form-control'  value='<?php echo $edit['Setting']['image_footer'];?>'  readonly='readonly' name='userfile3' placeholder='<?php __('Background')?>' type='text'>
                          <span class='input-group-addon ' style="padding:0px">
                            <span>
                            <a href="javascript:window.open('<?php echo DOMAINAD; ?>upload_pic.php?stt=3','userfile3','width=500,height=300');window.history.go(1)" >
                            <input class="btn btn-success" style="padding: 5px;"  value="<?php __('Select_image')?>" type="button">
                         	</a>
                         	</span>
                          </span>
                        </div>
                      </div>
                        </div>
                                                        
                       
                        <div class='form-actions' style='margin-bottom:0'>
                          <div class='row'>
                            <div class='col-sm-9 col-sm-offset-3'>
                              <button class='btn btn-primary' type='submit' value="<?php __('Add_New');?> " >
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