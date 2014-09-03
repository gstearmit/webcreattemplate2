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
                  	<h1 class='pull-left' style="font-weight: normal;font-family: Arial, Helvetica, sans-serif;">
                  	<?php __('Category_product')?>                
                    </h1>
                    </a>
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
                  <div class='box bordered-box orange-border' style='margin-bottom:0;'>
                    <div class='box-header ' style=" background:#f34541;">
                      <div class='title' style="color: #fff; bacground:#f34541;">
                      <form class="form form-horizontal" style="margin-bottom: 0;" method="post" action="#" accept-charset="UTF-8">
                          <input style='border:1px solid #ccc; font-size:14px; border-radius:7px; height:33px; margin-right:5px;' class='col-md-7 col-xs-6'  id='inputText1' placeholder='Search' type='text'>
                      		 <input class="btn btn-success" value="<?php __('Search')?>" type="button">
                     
                      </form>
                      </div>
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
                                  <?php __('Update')?>
                                </th>
                                 <th>
                                <?php __('Tackle')?>
                                </th>
                                <th><?php __('ID')?></th>
                              </tr>
                            </thead>
                            <tbody>
                             <?php $i=1; foreach ($Catproduct as $key =>$value){?>
                              <tr>
                              	<td><input style="width:20px; height:20px;" type="checkbox" name="<?php echo $value['Catproduct']['id'] ?>" /></td>
                              	<td><?php $j=$key+1; echo $j;?></td>
                                <td>
                                	 <?php if(is_array($value['Catproduct']) and !empty($value['Catproduct'])) { echo $value['Catproduct']['name'];}?>
							 		<?php if(is_array($value['Catproduct']) and empty($value['Catproduct'])) { echo "Null";}?>
                                </td>                               
                                <td><?php echo date('d-m-Y', strtotime($value['Catproduct']['created'])); ?></td>
                                <td class="text-center">
                                <?php if($value['Catproduct']['status']==0){?>
                                  <div class='text-right'>
                                    <a class='btn btn-inverse btn-xs' href='<?php echo DOMAINAD?>products/active/<?php echo $value['Catproduct']['id'] ?><?php echo  $langs ?>'>
                                      <i class='icon-minus-sign'></i>
                                    </a>
                                    <a class='btn btn-warning btn-xs' href='<?php echo DOMAINAD?>products/edit/<?php echo $value['Catproduct']['id'] ?><?php echo  $langs ?>'>
                                      <i class='icon-edit'></i>
                                    </a>
                                    <a class='btn btn-danger btn-xs' href="javascript:confirmDelete('<?php echo DOMAINAD?>products/delete/<?php echo $value['Catproduct']['id'] ?><?php echo  $langs ?>')">
                                      <i class='icon-remove'></i>
                                    </a>
                                  </div>
                                  <?php }else {?>
                                  <div class='text-right'>
                                    <a class='btn btn-success btn-xs' href='<?php echo DOMAINAD?>products/close/<?php echo $value['Catproduct']['id'] ?><?php echo  $langs ?>'>
                                      <i class=' icon-ok'></i>
                                    </a>
                                    <a class='btn btn-warning btn-xs' href='<?php echo DOMAINAD?>products/edit/<?php echo $value['Catproduct']['id'] ?><?php echo  $langs ?>'>
                                      <i class='icon-edit'></i>
                                    </a>
                                    <a class='btn btn-danger btn-xs' href="javascript:confirmDelete('<?php echo DOMAINAD?>products/delete/<?php echo $value['Catproduct']['id'] ?><?php echo  $langs ?>')">
                                      <i class='icon-remove'></i>
                                    </a>
                                  </div>
                                  <?php }?>
                                </td>
                                <td><?php echo $value['Catproduct']['id'];?></td>
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