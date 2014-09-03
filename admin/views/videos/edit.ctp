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
                         <?php __('Video')?>
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
                      <div class='title'><?php __('Edit')  ?> Video</div>
                      <div class='actions'>
                        <a class="btn box-remove btn-xs btn-link" href="#"><i class='icon-remove'></i>
                        </a>
                        
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                    <div class='box-content'>
                      <form action="<?php echo DOMAINAD ?>videos/add" enctype="multipart/form-data" name="image" method="post" accept-charset="utf-8" class='form form-horizontal validate-form' style='margin-bottom: 0;'>
                       <input type="hidden" name="_method" value="POST" />
                        <input type="hidden" name="data[Video][id]" value="<?php echo $edit['Video']['id'];?>" />
                        <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Company_name')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' value="<?php echo $edit['Video']['name'];?>" data-rule-minlength='2' data-rule-required='true' id='validation_name' name="data[Video][name]" placeholder='<?php __('Name')?>' type='text'>
                          </div>
                        </div>
                       <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_password'><?php __('Video')?></label>
                          <div>
                        <div class=' input-group col-sm-4 controls' >
                          <input class='form-control' value="<?php echo $edit['Video']['video'];?>"  readonly='readonly' name='video' placeholder='<?php __('Video')?>' type='text'>
                          <span class='input-group-addon ' style="padding:0px">
                            <span>
                            <a href="javascript:window.open('<?php echo DOMAINAD; ?>video.php','video','width=500,height=300');window.history.go(1)" >
                            <input class="btn btn-success" style="padding: 5px;"  value="<?php __('Upload')?>" type="button">
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
                            <input  name="data[Video][status]" type='radio' value='1' <?php if($edit['Video']['status']=='1'){ echo 'checked="checked" ';} ?>>
                            <?php __('Actived')?>
                          </label>
                          <label class='radio radio-inline'>
                            <input  name="data[Video][status]" type='radio' value='0' <?php if($edit['Video']['status']=='0'){ echo 'checked="checked" ';} ?> >
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