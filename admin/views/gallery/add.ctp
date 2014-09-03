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
                         <?php __('Image')?>
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
                      <div class='title'><?php __('Add_img')?></div>
                      <div class='actions'>
                        <a class="btn box-remove btn-xs btn-link" href="#"><i class='icon-remove'></i>
                        </a>
                        
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                    <div class='box-content'>
                      <form action="<?php echo DOMAINAD ?>gallery/add" enctype="multipart/form-data" name="image" method="post" accept-charset="utf-8" class='form form-horizontal validate-form' style='margin-bottom: 0;'>
                       <input type="hidden" name="_method" value="POST" />
                        <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Images_name')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' data-rule-minlength='2' data-rule-required='true' id='validation_name' name="data[Gallery][name]" placeholder='<?php __('Images_name')?>' type='text'>
                          </div>
                        </div>
                        
                       <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_select'><?php __('In_product')?></label>
                          <div class='col-sm-4 controls'>
                           <?php  //pr($Catproductlist);die();?>                  
                          
                            <select class='form-control' data-rule-required='true' id='validation_select' name="data[Gallery][product_id]" >
                              <option value="0"><?php __('Select_product')?></option> 
                              <?php foreach ($list_cat as $key =>$value){?>
                              <option value="<?php  echo $key ?>"><?php  echo $value ?></option>
                           <?php }?>               
                            </select>
                           
                          </div>
                        </div>
                         <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'><?php __('Avatar')?></label>
                          <div>
                        <div class=' input-group col-sm-4 controls' >
                          <input class='form-control' readonly='readonly' name='userfile' placeholder='<?php __('Avatar')?>' type='text'>
                          <span class='input-group-addon ' style="padding:0px">
                            <span>
                            <a href="javascript:window.open('<?php echo DOMAINAD; ?>upload_pic1.php?','userfile','width=500,height=300');window.history.go(1)" >
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
                            <input  name="data[Gallery][status]" type='radio' value='1' checked="checked">
                            <?php __('Actived')?>
                          </label>
                          <label class='radio radio-inline'>
                            <input  name="data[Gallery][status]" type='radio' value='0' >
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