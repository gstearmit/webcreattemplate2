<?php //pr($list_cat);die();?>
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
                         <?php __('product')?>
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
                      <div class='title'><?php __('Add_product')?></div>
                      <div class='actions'>
                        <a class="btn box-remove btn-xs btn-link" href="#"><i class='icon-remove'></i>
                        </a>
                        
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                    <div class='box-content'>
                      <form action="<?php echo DOMAINAD ?>products/add" enctype="multipart/form-data" name="image" method="post" accept-charset="utf-8" class='form form-horizontal validate-form' style='margin-bottom: 0;'>
                       <input type="hidden" name="_method" value="POST" />
                        <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Product_name')?> (VN)</label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' data-rule-minlength='2' data-rule-required='true' id='validation_name' name="data[Product][title]" placeholder='<?php __('Product_name')?>' type='text'>
                          </div>
                        </div>
                        
                       <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_select'><?php __('Category')?></label>
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
                          <label class='control-label col-sm-3' for='validation_select'><?php __('City')?></label>
                          <div class='col-sm-4 controls'>                                   
                          
                            <select class='form-control' data-rule-required='true' id='validation_select' name="data[Product][city_id]" >
                              <option value="0"><?php __('Select_city')?></option> 
                              <?php foreach ($list_cat1 as $key =>$value){?>
                              <option value="<?php  echo $key ?>"><?php  echo $value ?></option>
                           <?php }?>               
                            </select>                           
                          </div>
                        </div>
                           <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_numbers'><?php __('New_price')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' data-rule-number='true' data-rule-required='true' id='validation_numbers' name='data[Product][price]' placeholder='<?php __('New_price')?>' type='text'>
                          </div>
                          </div>
                       <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_numbers'><?php __('Old_price')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' data-rule-number='true' data-rule-required='true' id='validation_numbers1' name='data[Product][price_old]' placeholder='<?php __('Old_price')?>' type='text'>
                          </div>
                          </div>
                         <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'><?php __('date_discounts')?></label>
                          <div>
                        <div class='datepicker input-group col-sm-4 controls' id='datepicker'>
                          <input class='form-control' data-format='yyyy-MM-dd' name='date_batdau' placeholder='<?php __('date_discounts')?>' type='text'>
                          <span class='input-group-addon'>
                            <span data-date-icon='icon-calendar' data-time-icon='icon-time'></span>
                          </span>
                        </div>
                      </div>
                        </div>
                         <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'><?php __('End_date_discounts')?></label>
                          <div>
                        <div class='datepicker input-group col-sm-4 controls' id='datepicker'>
                          <input class='form-control' data-format='yyyy-MM-dd' name='date_ketthuc' placeholder='<?php __('End_date_discounts')?>' type='text'>
                          <span class='input-group-addon'>
                            <span data-date-icon='icon-calendar' data-time-icon='icon-time'></span>
                          </span>
                        </div>
                      </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'><?php __('From_day')?></label>
                          <div>
                        <div class='datepicker input-group col-sm-4 controls' id='datepicker'>
                          <input class='form-control' data-format='yyyy-MM-dd' name='date1' placeholder='<?php __('From_day')?>' type='text'>
                          <span class='input-group-addon'>
                            <span data-date-icon='icon-calendar' data-time-icon='icon-time'></span>
                          </span>
                        </div>
                      </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'><?php __('To_day')?></label>
                          <div>
                        <div class='datepicker input-group col-sm-4 controls' id='datepicker'>
                          <input class='form-control' data-format='yyyy-MM-dd' name='date2' placeholder='<?php __('To_day')?>' type='text'>
                          <span class='input-group-addon'>
                            <span data-date-icon='icon-calendar' data-time-icon='icon-time'></span>
                          </span>
                        </div>
                      </div>
                        </div>
                         <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_numbers'><?php __('Price')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' data-rule-number='true' data-rule-required='true' id='validation_numbers2' name='data[Product][price1]' placeholder='<?php __('Price')?>' type='text'>
                          </div>
                          </div>
                           <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'><?php __('From_day')?></label>
                          <div>
                        <div class='datepicker input-group col-sm-4 controls' id='datepicker'>
                          <input class='form-control' data-format='yyyy-MM-dd' name='date3' placeholder='<?php __('From_day')?>' type='text'>
                          <span class='input-group-addon'>
                            <span data-date-icon='icon-calendar' data-time-icon='icon-time'></span>
                          </span>
                        </div>
                      </div>
                        </div>
                        <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'><?php __('To_day')?></label>
                          <div>
                        <div class='datepicker input-group col-sm-4 controls' id='datepicker'>
                          <input class='form-control' data-format='yyyy-MM-dd' name='date4' placeholder='<?php __('To_day')?>' type='text'>
                          <span class='input-group-addon'>
                            <span data-date-icon='icon-calendar' data-time-icon='icon-time'></span>
                          </span>
                        </div>
                      </div>
                        </div>
                         <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_numbers'><?php __('Price')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' data-rule-number='true' data-rule-required='true' id='validation_numbers3' name='data[Product][price2]' placeholder='<?php __('Price')?>' type='text'>
                          </div>
                          </div>
                          <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_numbers'><?php __('Number_product')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' data-rule-number='true' data-rule-required='true' id='validation_numbers4' name='data[Product][soluong]' placeholder='<?php __('Number_product')?>' type='text'>
                          </div>
                          </div>
                          <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_numbers'><?php __('Quantity_sold')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' data-rule-number='true' data-rule-required='true' id='validation_numbers5' name='data[Product][daban]' placeholder='<?php __('Quantity_sold')?>' type='text'>
                          </div>
                          </div>
                          <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_numbers'><?php __('Description_products')?></label>
                           <div class='box-content col-sm-8'>
                      		<textarea class='form-control ckeditor' id='wysiwyg1' name="data[Product][introduction]" rows='5'></textarea>
                    		</div>
                          </div>
                          <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_numbers'><?php __('Detail_description_products')?></label>
                           <div class='box-content col-sm-8'>
                      		<textarea class='form-control ckeditor' id='wysiwyg1' name="data[Product][content]" rows='5'></textarea>
                    		</div>
                          </div>
                          <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_numbers'><?php __('content')?> 1</label>
                           <div class='box-content col-sm-8'>
                      		<textarea class='form-control ckeditor' id='wysiwyg1' name="data[Product][content_1]" rows='5'></textarea>
                    		</div>
                          </div>
                          <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_numbers'><?php __('content')?> 2</label>
                           <div class='box-content col-sm-8'>
                      		<textarea class='form-control ckeditor' id='wysiwyg1' name="data[Product][content_2]" rows='5'></textarea>
                    		</div>
                          </div>
                          <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_numbers'><?php __('content')?> 3</label>
                           <div class='box-content col-sm-8'>
                      		<textarea class='form-control ckeditor' id='wysiwyg1' name="data[Product][content_3]" rows='5'></textarea>
                    		</div>
                          </div>
                         <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'><?php __('Avatar')?></label>
                          <div>
                        <div class=' input-group col-sm-4 controls' >
                          <input class='form-control' readonly='readonly' name='userfile1' placeholder='<?php __('Avatar')?>' type='text'>
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
                          <label class='control-label col-sm-3' for='validation_password'><?php __('Background')?></label>
                          <div>
                        <div class=' input-group col-sm-4 controls' >
                          <input class='form-control'  readonly='readonly' name='userfile2' placeholder='<?php __('Background')?>' type='text'>
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
                        <label class='control-label col-sm-3' for='validation_select'><?php __('status')?></label>
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