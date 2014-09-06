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
                        <li class='active'><?php __('Orders_list')?></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
           
          
             
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box bordered-box orange-border' style='margin-bottom:0;'>
                    <div class='box-header ' style=" background:#f34541;">
                      <div class='title' style="color: #fff; bacground:#f34541;"><?php __('Orders_list')?>.</div>
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
                        <form action=" " name="form1" method="post">
                          <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;'>
                          
                            <thead>
                              <tr>
                              	 <th>
                              	 <input style="width:20px; height:20px;"  class="check-all" type="checkbox" />
                              	 </th>
                              	<th><?php __('No.')?></th>
			                       <th><?php __('Custommer_name')?></th>
			                       <th><?php __('Telephone_number')?></th>
			                       <th><?php __('Address')?></th>
			                       <th><?php __('Tackle')?></th>
                              </tr>
                            </thead>
                            <tbody>
                             <?php $i=1; foreach ($infomations as $key =>$value){?>
                              <tr>
                              	<td><input style="width:20px; height:20px;" type="checkbox" name="<?php echo $value['Infomation']['id'] ?>" /></td>
                              	<td><?php $j=$key+1; echo $j;?></td>
                                 <td>
                                 <a href="<?php echo DOMAINADESTORE?>infomations/view/<?php echo $value['Infomation']['id'] ?>">
                           		 <?php echo  $value['Infomation']['name'];?>
                           		 </a>
                        		</td>
                        		<td><?php  echo $value['Infomation']['mobile'];?></td>
                        		<td><?php  echo $value['Infomation']['address'];?></td>
                                <td class="text-center">                               
                                  <div class='text-right'>                                   
                                    <a class='btn btn-danger btn-xs' href="javascript:confirmDelete('<?php echo DOMAINADESTORE?>infomations/delete/<?php echo $value['Infomation']['id'] ?><?php echo  $langs ?>')">
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
                           
                                  
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>