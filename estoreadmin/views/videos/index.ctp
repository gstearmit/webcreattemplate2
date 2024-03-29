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
                          <a href='<?php echo DOMAINADESTORE?>videos/add<?php echo  $langs ?>'>
                              <input class="btn btn-success" value="<?php __('Add_new')?>" type="button">
                          </a>
                            <a href='#' rel="modal" id='show-help'>
                              <input class="btn btn-warning" value="<?php __('Help')?>" type="button">
                          </a>
                          <a href='<?php echo DOMAINADESTORE?>home<?php echo  $langs ?>'>
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
                  		<?php __('Video_list')?>            
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
                        <form action="" name="form1" method="post">
                          <table class='data-table-column-filter table table-bordered table-striped' style='margin-bottom:0;'>
                          
                            <thead>
                              <tr>
                              	 
                              	 <th>
                              	 <?php __('No.')?>
                              	 </th>
                              	 <th>
                              	 <?php __('Title')?>
                              	 </th>                              	
                                <th>
                                 <?php __('LinkUrl')?>
                                </th>
                                 <th>
                                <?php __('Position')?>
                                </th>
                                <th>
                               <?php __('Creat_date')?>
                                </th>
                                <th>
                               <?php __('Tackle')?>
                                </th>
                              </tr>
                            </thead>
                            <tbody>
                             <?php $i=1; foreach ($videos as $key =>$value){?>
                              <tr>
                              	
                              	<td>
                              	<?php $j=$key+1; echo $j;?>
                              	</td>
                                <td>
                                <?php  echo  $value['Video']['name'];?>
                                </td>                               
                                <td>
                                <?php echo $value['Video']['LinkUrl'];?>
                                </td>   
                                <td>
                            <?php if($value['Video']['left']==0){?>
                                Bên trái
                            <?php } else {?>
                                Bên phải
                            <?php }?>
                       			 </td>                            
                                 <td>
                                 <?php echo date('d-m-Y', strtotime($value['Video']['created'])); ?>
                                 </td>
                                <td class="text-center">
                                <?php if($value['Video']['status']==0){?>
                                  <div class='text-right'>
                                    <a class='btn btn-inverse btn-xs' href='<?php echo DOMAINADESTORE?>videos/active/<?php echo $value['Video']['id'] ?><?php echo  $langs ?>'>
                                      <i class='icon-minus-sign'></i>
                                    </a>
                                    <a class='btn btn-warning btn-xs' href='<?php echo DOMAINADESTORE?>videos/edit/<?php echo $value['Video']['id'] ?><?php echo  $langs ?>'>
                                      <i class='icon-edit'></i>
                                    </a>
                                    <a class='btn btn-danger btn-xs' href="javascript:confirmDelete('<?php echo DOMAINADESTORE?>videos/delete/<?php echo $value['Video']['id'] ?><?php echo  $langs ?>')">
                                      <i class='icon-remove'></i>
                                    </a>
                                  </div>
                                  <?php }else {?>
                                  <div class='text-right'>
                                    <a class='btn btn-success btn-xs' href='<?php echo DOMAINADESTORE?>videos/close/<?php echo $value['Video']['id'] ?><?php echo  $langs ?>'>
                                      <i class=' icon-ok'></i>
                                    </a>
                                    <a class='btn btn-warning btn-xs' href='<?php echo DOMAINADESTORE?>videos/edit/<?php echo $value['Video']['id'] ?><?php echo  $langs ?>'>
                                      <i class='icon-edit'></i>
                                    </a>
                                    <a class='btn btn-danger btn-xs' href="javascript:confirmDelete('<?php echo DOMAINADESTORE?>videos/delete/<?php echo $value['Video']['id'] ?><?php echo  $langs ?>')">
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
          	