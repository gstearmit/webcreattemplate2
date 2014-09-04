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
                        <li class='active'><?php __('Comments_list')?></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
           
          
             
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='box bordered-box orange-border' style='margin-bottom:0;'>
                    <div class='box-header ' style=" background:#f34541;">
                      <div class='title' style="color: #fff; bacground:#f34541;"><?php __('Comments_list')?>.</div>
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
                              	<?php __('No.')?>
                              	 </th>
                              	 <th>
                              	 <?php __('Name')?>
                              	 </th>
                              	 <th>
                              	<?php __('Email')?>
                              	 </th>
                                <th>
                                  <?php __('Content')?>
                                </th>
                                 <th>
                                 <?php __('Creat_date')?>
                                </th>
                                <th><?php __('Tackle')?></th>
                              </tr>
                            </thead>
                            <tbody>
                             <?php $i=1; foreach ($comments as $key =>$value){?>
                              <tr>
                              	<td><?php $j=$key+1; echo $j;?></td>
                                <td><?php echo $value['Comments']['name'];?></td>
                                <td><?php echo $value['Comments']['email'];?></td>
                                 <td><?php echo $value['Comments']['content'];?></td>
                                <td><?php echo date('d-m-Y', strtotime($value['Comments']['created'])); ?></td>
                                <td class="text-center">
                                <?php if($value['Comments']['status']==0){?>
                                  <div class='text-right'>
                                    <a class='btn btn-inverse btn-xs' href='<?php echo DOMAINADESTORE?>comments/active/<?php echo $value['Comments']['id'] ?><?php echo  $langs ?>'>
                                      <i class='icon-minus-sign'></i>
                                    </a>
                                     <a class='btn btn-danger btn-xs' href="javascript:confirmDelete('<?php echo DOMAINADESTORE?>comments/delete/<?php echo $value['Comments']['id'] ?><?php echo  $langs ?>')">
                                      <i class='icon-remove'></i>
                                    </a>
                                  </div>
                                  <?php }else {?>
                                  <div class='text-right'>
                                    <a class='btn btn-success btn-xs' href='<?php echo DOMAINADESTORE?>comments/close/<?php echo $value['Comments']['id'] ?><?php echo  $langs ?>'>
                                      <i class=' icon-ok'></i>
                                    </a>                                    
                                    <a class='btn btn-danger btn-xs' href="javascript:confirmDelete('<?php echo DOMAINADESTORE?>comments/delete/<?php echo $value['Comments']['id'] ?><?php echo  $langs ?>')">
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
                                  
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>