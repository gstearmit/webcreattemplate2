<script>
function confirmDelete(delUrl)
{
if (confirm("Bạn có muốn xóa danh mục này không!"))
{
	document.location = delUrl;
}
}
</script>
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
                          <a href='#'>
                              <input class="btn btn-success" value="<?php __('Add_new')?>" type="button">
                          </a>
                            <a href='#'>
                              <input class="btn btn-warning" value="<?php __('Help')?>" type="button">
                          </a>
                          <a href='#'>
                              <input class="btn btn-danger" value="<?php __('Close')?>" type="button">
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
                      <div class='title'><?php __('search')?></div>
                      <div class='actions'>
                        <a class="btn box-remove btn-xs btn-link" href="#"><i class='icon-remove'></i>
                        </a>
                        
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                    <div class='box-content'>
                      <form action="<?php echo DOMAINAD ?>products/search<?php echo  $langs ?>" enctype="multipart/form-data" name="image" method="post" accept-charset="utf-8" class='form form-horizontal validate-form' style='margin-bottom: 0;'>
                       <input type="hidden" name="_method" value="POST" />
                         
                       <div class='form-group'>
                          <label class='control-label col-sm-3' for='validation_select'><?php __('Category')?></label>
                          <div class='col-sm-4 controls'>
                           <?php  //pr($Catproductlist);die();?>                  
                          
                            <select class='form-control' data-rule-required='true' id='validation_select' name="data[Catproduct][parent_id]" >
                              <option value="0">chọn <?php __('Category')?></option> 
                              <?php foreach ($list_cat as $key =>$value){?>
                              <option value="<?php  echo $key ?>"><?php  echo $value ?></option>
                           <?php }?>               
                            </select>
                           
                          </div>
                        </div>    
                        <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Title')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' data-rule-minlength='2' data-rule-required='true' id='validation_name' name="keyword" placeholder='<?php __('Title')?>' type='text'>
                          </div>
                        </div>
                                         
                        <div class='form-actions' style='margin-bottom:0'>
                          <div class='row'>
                            <div class='col-sm-9 col-sm-offset-3'>
                              <button class='btn btn-primary' type='submit' value="<?php __('search');?> " >
                                <i class='icon-save'></i>
                                 <?php __('search')?>
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
<div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='page-header'>
                  	
                    <div class='pull-right'>
                      <ul class='breadcrumb'>
                        <li>
                          <a href='#'>
                            <i class='icon-bar-chart'></i>
                          </a>
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'><?php __('Product_List')?></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
           
          
             
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box bordered-box orange-border' style='margin-bottom:0;'>
                    <div class='box-header ' style=" background:#f34541;">
                      <div class='title' style="color: #fff; bacground:#f34541;"><?php __('Product_List')?>.</div>
                      <div class='actions'>
                        <a class="btn box-remove btn-xs btn-link" href="#"><i class='icon-remove'></i>
                        </a>
                        
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                    <div class='box-content box-no-padding'>
                      <div class='responsive-table'>
                        <div class='scrollable-area'>
                        <form action="<?php echo DOMAINAD;?>products/processing<?php echo  $langs ?>" name="form1" method="post">
                          <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;'>
                          
                            <thead>
                              <tr>
                              	 <th>
                              	 <input style="width:20px; height:20px;"  class="check-all" type="checkbox" />
                              	 </th>
                              	 <th>
                              	<?php __('No.')?>
                              	 </th>
                              	 <th>
                              	 <?php __('Category')?>
                              	 </th>
                              	 <th>
                              	 <?php __('Big_category')?>
                              	 </th>
                                <th>
                                  <?php __('Update')?>
                                </th>
                                 <th>
                                 <?php __('Tackle')?>
                                 </th>
                      			 <th >
                      			 <?php __('ID')?>
                      			 </th>
                              </tr>
                            </thead>
                            <tbody>
                             <?php $i=1; foreach ($product as $key =>$value){?>
                              <tr>
                              	<td><input style="width:20px; height:20px;" type="checkbox" name="<?php echo $value['Product']['id'] ?>" /></td>
                              	<td><?php $j=$key+1; echo $j;?></td>
                                <td><?php echo $value['Product']['title'];?></td>
                                <td>
                                <?php if(is_array($value['Catproduct']) and !empty($value['Catproduct'])) { echo $value['Catproduct']['name'];}?>
								<?php if(is_array($value['Catproduct']) and empty($value['Catproduct'])) { echo "Null";}?>
                                </td>
                                 <td><?php echo date('d-m-Y', strtotime($value['Product']['created'])); ?></td>                              
                                <td class="text-center">
                                <?php if($value['Product']['status']==0){?>
                                  <div class='text-right'>
                                    <a class='btn btn-inverse btn-xs' href='<?php echo DOMAINAD?>products/active/<?php echo $value['Product']['id'] ?><?php echo  $langs ?>'>
                                      <i class='icon-minus-sign'></i>
                                    </a>
                                    <a class='btn btn-warning btn-xs' href='<?php echo DOMAINAD?>products/edit/<?php echo $value['Product']['id'] ?><?php echo  $langs ?>'>
                                      <i class='icon-edit'></i>
                                    </a>
                                    <a class='btn btn-danger btn-xs' href="javascript:confirmDelete('<?php echo DOMAINAD?>products/delete/<?php echo $value['Product']['id'] ?><?php echo  $langs ?>')">
                                      <i class='icon-remove'></i>
                                    </a>
                                  </div>
                                  <?php }else {?>
                                  <div class='text-right'>
                                    <a class='btn btn-success btn-xs' href='<?php echo DOMAINAD?>products/close/<?php echo $value['Product']['id'] ?><?php echo  $langs ?>'>
                                      <i class=' icon-ok'></i>
                                    </a>
                                    <a class='btn btn-warning btn-xs' href='<?php echo DOMAINAD?>products/edit/<?php echo $value['Product']['id'] ?><?php echo  $langs ?>'>
                                      <i class='icon-edit'></i>
                                    </a>
                                    <a class='btn btn-danger btn-xs' href="javascript:confirmDelete('<?php echo DOMAINAD?>products/delete/<?php echo $value['Product']['id'] ?><?php echo  $langs ?>')">
                                      <i class='icon-remove'></i>
                                    </a>
                                  </div>
                                  <?php }?>
                                </td>
                                <td align="right"><?php echo $value['Product']['id'];?></td>
                              </tr>
                             <?php }?>
                             
                            </tbody>
                            <tfoot>
                              <tr>
                              	<th></th>
                              	<th></th>
                                <th>Name</th>
                                <th>E-mail</th>
                                <th colspan='2'>Status</th>
                               
                              </tr>
                              
                            </tfoot>
                          </table>
                           
                                  <select name="dropdown" style="max-width:110px; height:33px; border-radius:5px; margin:10px;">
                                    <option value="option1"><?php __('select')?></option>
                                    <option value="active"><?php __('Active')?></option>
                                    <option value="notactive"><?php __('Del_active')?></option>
                                    <option value="delete"><?php __('Delete')?></option>
                                </select>
                               <input class="btn btn-success" value="<?php __('perform')?>" type="button" onclick="document.form1.submit();">
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>