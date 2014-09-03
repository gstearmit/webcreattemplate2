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
                  	<a href="<?php echo DOMAINAD;?>helps/add<?php echo  $langs ?>">
                  	 <h1 class='pull-left' style="font-weight: normal;font-family: Arial, Helvetica, sans-serif;">                 
                    <input class="btn btn-success" value="<?php __('Add_New')?>" type="button" onclick="document.form1.submit();">
                    </h1>
                    </a>
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
                        <li class='active'><?php __('Online_list')?></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
           
          
             
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box bordered-box orange-border' style='margin-bottom:0;'>
                    <div class='box-header ' style=" background:#f34541;">
                      <div class='title' style="color: #fff; bacground:#f34541;"><?php __('Online_list')?>.</div>
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
                      
                          <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;'>
                          
                            <thead>
                              <tr>
                              	 <th>
                              	 <input style="width:20px; height:20px;"  class="check-all" type="checkbox" />
                              	 </th>
                              	 <th>
                              	 <?php __('STT')?>
                              	 </th>
                              	 <th>
                              	 <?php __('Nhân viên')?>
                              	 </th>
                              	 <th><?php __('Skype')?></th>
			                       <th><?php __('Phone')?></th>
			                       <th><?php __('Creat_date')?></th>
			                       <th><?php __('handling')?></th>
                              </tr>
                            </thead>
                            <tbody>
                             <?php $i=1; foreach ($Helps as $key =>$value){?>
                              <tr>
                              	<td><input style="width:20px; height:20px;" type="checkbox" name="<?php echo $value['Help']['id'] ?>" /></td>
                              	<td><?php $j=$key+1; echo $j;?></td>
                                <td><?php echo $value['Help']['name'];?></td>
                                <td><?php echo $value['Help']['skype'];?></td>
                                 <td><?php  echo $value['Help']['sdt'];?></td>
                                <td><?php echo date('d-m-Y', strtotime($value['Help']['created'])); ?></td>
                                <td class="text-center">
                                
                                     <div class='text-right'>
                                 
                                    <a class='btn btn-warning btn-xs' href='<?php echo DOMAINAD?>helps/edit/<?php echo $value['Help']['id'] ?><?php echo  $langs ?>'>
                                      <i class='icon-edit'></i>
                                    </a>
                                    <a class='btn btn-danger btn-xs' href="javascript:confirmDelete('<?php echo DOMAINAD?>helps/delete/<?php echo $value['Help']['id'] ?><?php echo  $langs ?>')">
                                      <i class='icon-remove'></i>
                                    </a>
                                  </div>
                                 
                                
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
                           
                        
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>