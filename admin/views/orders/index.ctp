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
                          <a href='index.html'>
                            <i class='icon-bar-chart'></i>
                          </a>
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li>
                         <?php __('Oder_Management')?>
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'><?php __('search')?></li>
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
                      <form action="<?php echo DOMAINAD ?>orders/search<?php echo  $langs ?>" enctype="multipart/form-data" name="image" method="post" accept-charset="utf-8" class='form form-horizontal validate-form' style='margin-bottom: 0;'>
                       <input type="hidden" name="_method" value="POST" />
                        <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Customer_name')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' data-rule-minlength='2' data-rule-required='true' id='validation_name' name="name" placeholder='<?php __('Customer_name')?>' type='text'>
                          </div>
                        </div>
                            <div class='form-group'>
                          <label class='control-label col-sm-3 col-sm-3' for='validation_name'><?php __('Product_name')?></label>
                          <div class='col-sm-4 controls'>
                            <input class='form-control' data-rule-minlength='2' data-rule-required='true' id='validation_name' name="name" placeholder='<?php __('Product_name')?>' type='text'>
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
                        <li class='active'><?php __('Oder_List')?></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
           
          
             
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box bordered-box orange-border' style='margin-bottom:0;'>
                    <div class='box-header ' style=" background:#f34541;">
                      <div class='title' style="color: #fff; bacground:#f34541;"><?php __('Oder_List')?>.</div>
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
                        <form action="<?php echo DOMAINAD;?>Orders/processing<?php echo  $langs ?>" name="form1" method="post">
                          <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;'>
                          
                            <thead>
                              <tr>
                              	 <th><input style="width:20px; height:20px;" type="checkbox" name="name="checkall"" /></th>
                       <th><?php __('STT')?></th>
                       <th><?php __('Customer_Name')?></th>
                       <th><?php __('Product_name')?></th>
						<th><?php __('Number')?></th>
						<th><?php __('Total_money')?></th>				   
                       <th><?php __('Creat_date')?></th>
					    <th><?php __('Payment')?></th>
                       <th><?php __('handling')?></th>
                              </tr>
                            </thead>
                            <tbody>
                             <?php $i=1; foreach ($Order as $key =>$value){?>
                              <tr>
                              	<td><input style="width:20px; height:20px;" type="checkbox" name="<?php echo $value['Order']['id'] ?>" /></td>
                              	<td><?php $j=$key+1; echo $j;?></td>
                                <td><a href="<?php echo DOMAINAD?>orders/view/<?php echo $value['Order']['id'];?><?php echo  $langs ?>"><?php echo $value['Order']['name'];?></a></td>
                                <td><?php echo $value['Order']['product_title'];?></td>
                                 <td><?php echo $value['Order']['soluong'];?></td>
                                 <td><?php echo $value['Order']['tongtien'];?></td>
                                <td><?php echo date('d-m-Y', strtotime($value['Order']['created'])); ?></td>
                                 <td class="text-center">
                                <?php if($value['Order']['status']==0){?>
                                  <div class='text-right'>
                                    <a class='btn btn-inverse btn-xs' href='<?php echo DOMAINAD?>orders/active1/<?php echo $value['Order']['id'] ?><?php echo  $langs ?>'>
                                      <i class='icon-minus-sign'></i>
                                    </a>                                    
                                  </div>
                                  <?php }else {?>
                                  <div class='text-right'>
                                    <a class='btn btn-success btn-xs' href='<?php echo DOMAINAD?>orders/close1/<?php echo $value['Order']['id'] ?><?php echo  $langs ?>'>
                                      <i class=' icon-ok'></i>
                                    </a>   
                                    </div>                                 
                                  <?php }?>
                                </td>
                                <td class="text-center">
                                <?php if($value['Order']['dagiaohang']==0){?>
                                  <div class='text-right'>
                                    <a class='btn btn-inverse btn-xs' href='<?php echo DOMAINAD?>orders/active/<?php echo $value['Order']['id'] ?><?php echo  $langs ?>'>
                                      <i class='icon-minus-sign'></i>
                                    </a>                                   
                                    <a class='btn btn-danger btn-xs' href="javascript:confirmDelete('<?php echo DOMAINAD?>orders/delete/<?php echo $value['Order']['id'] ?><?php echo  $langs ?>')">
                                      <i class='icon-remove'></i>
                                    </a>
                                  </div>
                                  <?php }else {?>
                                  <div class='text-right'>
                                    <a class='btn btn-success btn-xs' href='<?php echo DOMAINAD?>orders/close/<?php echo $value['Order']['id'] ?><?php echo  $langs ?>'>
                                      <i class=' icon-ok'></i>
                                    </a>                                    
                                    <a class='btn btn-danger btn-xs' href="javascript:confirmDelete('<?php echo DOMAINAD?>orders/delete/<?php echo $value['Order']['id'] ?><?php echo  $langs ?>')">
                                      <i class='icon-remove'></i>
                                    </a>
                                  </div>
                                  <?php }?>
                                </td>
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
                                    <option value="active"><?php __('Has_delivered')?></option>
                                    <option value="notactive"><?php __('Not_yet_delivered')?></option>
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