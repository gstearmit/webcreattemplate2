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
                          <a href='<?php echo DOMAINADESTORE?>advertisements/add<?php echo  $langs ?>'>
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
                  		<?php __('Advertisement')?>            
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
                              	 <input style="width:20px; height:20px;"  class="check-all" type="checkbox" />
                              	 </th>
                              	 <th>
                              	 <?php __('No.')?>
                              	 </th>
                              	 <th>
                              	 <?php __('Website_name')?>
                              	 </th>                              	
                                <th>
                                 <?php __('Image')?>
                                </th>
                                <th>
                                <?php __('Position')?>
                                </th>
                                 <th>
                                <?php __('Creat_date')?>
                                </th>
                                <th><?php __('Tackle')?></th>
                              </tr>
                            </thead>
                            <tbody>
                             <?php $i=1; foreach ($Advertisements as $key =>$value){?>
                              <tr>
                              	<td><input style="width:20px; height:20px;" type="checkbox" name="<?php echo $value['Advertisement']['id'] ?>" /></td>
                              	<td><?php $j=$key+1; echo $j;?></td>
                                <td><?php  echo $value['Advertisement']['name'];?>
                                </td>                               
                                <td><img src="<?php echo DOMAINADESTORE?>/timthumb.php?src=<?php echo $value['Advertisement']['images']; ?>&amp;h=70&amp;w=140&amp;zc=1" alt="thumbnail" /></td>
                                <td>
		                                 <?php 
									if($value['Advertisement']['display']==null){?>
		                            &nbsp;
		                        <?php }?>
		                        <?php 
									if($value['Advertisement']['display']==0){?>
		                            Chạy bên trái
		                        <?php }?>
		                        <?php 
									if($value['Advertisement']['display']==1){?>
		                            Chạy bên phải
		                        <?php }?>
		                        <?php 
									if($value['Advertisement']['display']==2){?>
		                            Sidebar trái
		                        <?php }?>
		                        <?php 
									if($value['Advertisement']['display']==3){?>
		                            Sidebar phải
		                        <?php }?>
                                </td>
                                 <td><?php echo date('d-m-Y', strtotime($value['Advertisement']['created'])); ?></td>
                                <td class="text-center">
                                <?php if($value['Advertisement']['status']==0){?>
                                  <div class='text-right'>
                                    <a class='btn btn-inverse btn-xs' href='<?php echo DOMAINADESTORE?>advertisements/active/<?php echo $value['Advertisement']['id'] ?><?php echo  $langs ?>'>
                                      <i class='icon-minus-sign'></i>
                                    </a>
                                    <a class='btn btn-warning btn-xs' href='<?php echo DOMAINADESTORE?>advertisements/edit/<?php echo $value['Advertisement']['id'] ?><?php echo  $langs ?>'>
                                      <i class='icon-edit'></i>
                                    </a>
                                    <a class='btn btn-danger btn-xs' href="javascript:confirmDelete('<?php echo DOMAINADESTORE?>advertisements/delete/<?php echo $value['Advertisement']['id'] ?><?php echo  $langs ?>')">
                                      <i class='icon-remove'></i>
                                    </a>
                                  </div>
                                  <?php }else {?>
                                  <div class='text-right'>
                                    <a class='btn btn-success btn-xs' href='<?php echo DOMAINADESTORE?>advertisements/close/<?php echo $value['Advertisement']['id'] ?><?php echo  $langs ?>'>
                                      <i class=' icon-ok'></i>
                                    </a>
                                    <a class='btn btn-warning btn-xs' href='<?php echo DOMAINADESTORE?>advertisements/edit/<?php echo $value['Advertisement']['id'] ?><?php echo  $langs ?>'>
                                      <i class='icon-edit'></i>
                                    </a>
                                    <a class='btn btn-danger btn-xs' href="javascript:confirmDelete('<?php echo DOMAINADESTORE?>advertisements/delete/<?php echo $value['Advertisement']['id'] ?><?php echo  $langs ?>')">
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
          	