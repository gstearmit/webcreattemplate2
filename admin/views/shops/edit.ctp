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
                         <?php __('Category_product')?>
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
                      <div class='title'><?php __('Cấu hình shop')?></div>
                      <div class='actions'>
                        <a class="btn box-remove btn-xs btn-link" href="#"><i class='icon-remove'></i>
                        </a>
                        
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                    <div class='box-content'>
                     <form action="<?php echo DOMAINAD ?>shops/edit" enctype="multipart/form-data" name="image" method="post" accept-charset="utf-8" class='form form-horizontal validate-form' style='margin-bottom: 0;'>
                       <input type="hidden" name="_method" value="POST" />
                        <input type="hidden" name="data[Shop][id]" value="<?php echo $edit['Shop']['id']?>" id="CatproductId" />
                        <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'>Tên gian hàng:</label>
                          <div class='col-sm-4 controls'>                      	
                            <?php echo  $edit['Shop']['name']; ?>
                          </div>
                        </div>
                         <div class='form-group'>
                        <label class='control-label col-sm-3 col-sm-3'>Gian hàng nổi bật:</label>
                        <div class='col-sm-4 controls'>
                          <label class='checkbox-inline'>
                          <?php if($edit['Shop']['loai']==1){ echo " <input name='data[Shop][loai]' type='checkbox' value='1' checked='checked'> ";}
                          else { echo " <input name='data[Shop][loai]' type='checkbox' value='0'>";}
                          ?>
                                                     
                          </label>                                                 
                        </div>
                      </div>
                         <div class='form-group'>
                        <label class='control-label col-sm-3' for='validation_select'><?php __('status')?></label>
                        <div class='col-sm-4 controls'>
                         
                           <label class='radio radio-inline'>
                            <input  name="data[Shop][status]" type='radio' value='1' <?php if($edit['Shop']['status']=='1'){ echo 'checked'; } ?> >
                            <?php __('Actived')?>
                          </label>
                          <label class='radio radio-inline'>
                            <input  name="data[Shop][status]" type='radio' value='0' <?php if($edit['Shop']['status']=='0'){ echo 'checked'; } ?> >
                             <?php __('Unactive')?>
                          </label>
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