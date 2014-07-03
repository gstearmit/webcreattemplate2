﻿<script>
function confirmDelete(delUrl)
{
if (confirm("Bạn có muốn xóa danh mục này không!"))
{
	document.location = delUrl;
}
}
</script>
 <?php echo $form->create(null, array( 'url' => DOMAINAD.'userscms/search','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?> 
     <fieldset class="search">
        
        <legend>Tìm kiếm</legend>

       
        <div class="field">
            <label for="field2c">Tiêu đề</label>
            <input type="text" id="field2c" name="name" class="text-search">
        </div>
        <p style="text-align:center;"> <input type="submit" name="" value="Tìm kiếm" class="button" /></p>
       
    </fieldset>
     <?php echo $form->end(); ?>
     
    
<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        
        <h3>Danh sách tài khoản</h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Danh sách tài khoản</a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2"></a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        
        <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
            <table>
                 <form action="<?php echo DOMAINAD; ?>userscms/processing" name="form1" method="post">
                <thead>
                    <tr>
                       <th><input class="check-all" name="checkall" type="checkbox" /></th>
                       <th>STT</th>
                       <th><?php echo $this->Paginator->sort('Tên Userscm','id');?></th>
                       <th>Tên shop</th>
						<th>Gian hàng nổi bật</th>
										   
                       <th><?php echo $this->Paginator->sort('Ngày tạo','created');?></th>
                       <th>Xử lý</th>
                    </tr>
                    
                </thead>
           
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <div class="bulk-actions align-left">
                                <select name="dropdown">
                                    <option value="option1">Lựa chọn</option>
                                    <option value="active">Active</option>
                                    <option value="notactive">Hủy Active</option>
                                    <option value="delete">Delete</option>
                                </select>
                                <a class="button" href="#" onclick="document.form1.submit();">Thực hiện</a>
                            </div>
                             <div class="pagination">
                                <a href="#" title="First Page">
                                   <?php
                                        $paginator->options(array('url' => $this->passedArgs));
                                       echo "&laquo "; echo $paginator->prev('Về trước');
							       ?> 
                                </a>
							     <?php 
								   echo $paginator->numbers();
                                   echo $paginator->next('Tiếp theo'); echo "&raquo";
                                ?>
                              </div>
                            </div> <!-- End .pagination -->
                            <div class="clear"></div>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                   <?php  
				  
				   foreach ($Userscm as $key =>$value){
				   
				   ?>
                    <tr>
                        <td><input type="checkbox" name="<?php echo $value['Userscm']['id'] ?>" /></td>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td> <?php echo $html->link( $value['Userscm']['name'], '/Userscms/view/'.$value['Userscm']['id']);?></td>
                      
						
						 <td>
						<?php 
					$shop=$this->requestAction('userscms/get_shop/'.$value['Userscm']['id']);
					$loai=0;
					foreach($shop as $shop){
					echo $shop['Shop']['name']; 
				$loai=$shop['Shop']['loai'];
					}
					?>
					
				
						</td>
					
							 <td>
								<?php 	if($loai==1){ echo "YES";} else echo "NO";?>
						</td>
						
						
                        <td><?php echo date('d-m-Y', strtotime($value['Userscm']['created'])); ?></td>
                        <td>
                             <?php if($value['Userscm']['status']==0){?>
							 
							     
                              	    <a href="javascript:confirmDelete('<?php echo DOMAINAD?>Userscms/delete/<?php echo $value['Userscm']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a> 
                           
                                 <a href="<?php echo DOMAINAD?>Userscms/active/<?php echo $value['Userscm']['id'] ?>" title="Kích hoạt" class="icon-5 info-tooltip"><img src="<?php echo DOMAINAD?>images/icons/Play-icon.png" alt="Kích hoạt" /></a>
                            <?php } else {?>
							
                             	  <a href="javascript:confirmDelete('<?php echo DOMAINAD?>Userscms/delete/<?php echo $value['Userscm']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a> 
                           
                                 <a href="<?php echo DOMAINAD?>Userscms/close/<?php echo $value['Userscm']['id'] ?>" title="Đóng" class="icon-4 info-tooltip"><img src="<?php echo DOMAINAD?>images/icons/success-icon.png" alt="Ngắt kích hoạt" /></a>

                            <?php }?>
                        </td>
                    </tr>
                   <?php }?>
                </tbody>
                <?php echo $form->end(); ?>
            </table>
            
        </div> <!-- End #tab1 -->
        
         <!-- End #tab2 -->        
        
    </div> <!-- End .content-box-content -->
 </div>