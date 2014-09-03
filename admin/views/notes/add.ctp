<?php //pr($list_cat);die();?>
<?php include 'views/elements/language.ctp';?>
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
                         <?php __('Notes')?>
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
                      <div class='title'><?php __('Add_notes')?></div>
                      <div class='actions'>
                        <a class="btn box-remove btn-xs btn-link" href="#"><i class='icon-remove'></i>
                        </a>
                        
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                    <div class='box-content'>
                      <form action="<?php echo DOMAINAD ?>notes/add<?php echo $langs ?>" enctype="multipart/form-data" name="image" method="post" accept-charset="utf-8" class='form form-horizontal validate-form' style='margin-bottom: 0;'>
                       <input type="hidden" name="_method" value="POST" />
                        <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('News_name')?>(VN)</label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' data-rule-minlength='2' data-rule-required='true' id='validation_name' name="data[Note][title]" placeholder='<?php __('News_name')?>(VN)' type='text'>
                          </div>
                        </div>
                         <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('News_name')?> (ENG)</label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' data-rule-minlength='2' data-rule-required='true' id='validation_name1' name="data[Note][title_eg]" placeholder='<?php __('News_name')?>(ENG)' type='text'>
                          </div>
                        </div>
                       <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_select'><?php __('Category')?></label>
                          <div class='col-sm-4 controls'>
                           <?php  //pr($Catproductlist);die();?>                  
                          
                            <select class='form-control' data-rule-required='true' id='validation_select' name="data[Note][category_id]" >
                              <option value="0"><?php __('Select_category')?></option> 
                              <?php foreach ($list_cat as $key =>$value){?>
                              <option value="<?php  echo $key ?>"><?php  echo $value ?></option>
                           <?php }?>               
                            </select>                           
                          </div>
                        </div>
                       
                           <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_numbers'><?php __('location')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' data-rule-number='true' data-rule-required='true' id='validation_numbers' name='data[Note][location]' placeholder='<?php __('location')?>' type='text'>
                          </div>
                          </div>
                      
                          <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_numbers'><?php __('Summary_content')?> (VN)</label>
                           <div class='box-content col-sm-8'>
                      		<textarea class='form-control ckeditor' id='wysiwyg1' name="data[Note][introduction]" rows='5'></textarea>
                    		</div>
                          </div>
                          <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_numbers'><?php __('Summary_content')?> (ENG)</label>
                           <div class='box-content col-sm-8'>
                      		<textarea class='form-control ckeditor' id='wysiwyg1' name="data[Note][introduction_eg]" rows='5'></textarea>
                    		</div>
                          </div>
                          <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_numbers'><?php __('content')?> (VN)</label>
                           <div class='box-content col-sm-8'>
                      		<textarea class='form-control ckeditor' id='wysiwyg1' name="data[Note][content]" rows='5'></textarea>
                    		</div>
                          </div>
                         <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_numbers'><?php __('content')?> (ENG)</label>
                           <div class='box-content col-sm-8'>
                      		<textarea class='form-control ckeditor' id='wysiwyg1' name="data[Note][content_eg]" rows='5'></textarea>
                    		</div>
                          </div>
                          
                         <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'><?php __('Avatar')?></label>
                          <div>
                        <div class=' input-group col-sm-4 controls' >
                          <input class='form-control' readonly='readonly' name='userfile' placeholder='<?php __('Avatar')?>' type='text'>
                          <span class='input-group-addon ' style="padding:0px">
                            <span>
                            <a href="javascript:window.open('<?php echo DOMAINAD; ?>upload_pic1.php','userfile','width=500,height=300');window.history.go(1)" >
                            <input class="btn btn-success" style="padding: 5px;"  value="<?php __('Select_image')?>" type="button">
                            </a>
                            </span>
                          </span>
                        </div>
                      </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Source_article')?>(VN)</label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' data-rule-minlength='2' data-rule-required='true' id='validation_name2' name="data[Note][source]" placeholder='<?php __('Source_article')?>(VN)' type='text'>
                          </div>
                        </div>
                         <div class='form-group'>
                        <label class='control-label col-sm-3' for='validation_select'><?php __('status')?></label>
                        <div class='col-sm-4 controls'>
                          <label class='radio radio-inline'>
                            <input  name="data[Note][status]" type='radio' value='1' checked="checked">
                            <?php __('Actived')?>
                          </label>
                          <label class='radio radio-inline'>
                            <input  name="data[Note][status]" type='radio' value='0' >
                             <?php __('Unactive')?>
                          </label>
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