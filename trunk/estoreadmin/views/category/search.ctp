<script>
function confirmDelete(delUrl)
{
if (confirm("Bạn có muốn xóa danh mục này không!"))
{
	document.location = delUrl;
}
}
</script>
<?php echo $form->create(null, array( 'url' => DOMAINADESTORE.'category/search','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?> 
<div id="khung">
	<div id="main">
		<div class="toolbar-list" id="toolbar">
                    <ul>
                        <li id="toolbar-new">
                            <a href="<?php echo DOMAINADESTORE?>category/add" class="toolbar">
                                <span class="icon-32-new"></span>
                                Thêm mới
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li id="toolbar-help">
                            <a href="#messages" rel="modal" class="toolbar">
                                <span class="icon-32-help"></span>
                                Trợ giúp
                            </a>
                        </li>
                        <li id="toolbar-unpublish">
                            <a href="<?php echo DOMAINADESTORE?>home" class="toolbar">
                                <span class="icon-32-unpublish"></span>
                                Đóng
                            </a>
                        </li>
                    </ul>
                    <div class="clr"></div>
                </div>
        <div class="pagetitle icon-48-nhomtin"><h2>Danh mục tin tức</h2></div>
		<div class="clr"></div>
	</div>
</div>
<div class="content-box">
    <div class="content-box-header">
        
        <table class="timkiem">
        	<tr>
            	<td valign="top">Tìm kiếm</td>
            	<td><input type="text" id="field2c" name="name_search" class="text-input"/></td>
                <td><input type="submit" name="" value="Tìm kiếm" class="button" /></td>
            </tr>
        </table>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Danh sách tin</a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2">Thùng rác</a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        
        <div class="tab-content default-tab" id="tab1"> 
            <table>
                
                <thead>
                    <tr>
                       <th><input class="check-all" type="checkbox" /></th>
                       <th>STT</th>
                       <th><?php echo $this->Paginator->sort('Tên danh mục','id');?></th>
                       <th>Danh mục cha</th>
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
                                    <option value="option2">Active</option>
                                    <option value="option2">Hủy Active</option>
                                    <option value="option3">Delete</option>
                                </select>
                                <a class="button" href="#">Thực hiện</a>
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
                   <?php $i=1; foreach ($category as $key =>$value){?>
                    <tr>
                        <td><input type="checkbox" /></td>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td>
                        <?php //echo $value['Category']['name'];?>
                         <?php if(is_array($value['Category']) and !empty($value['Category'])) { echo $value['Category']['name'];}?>
						 <?php if(is_array($value['Category']) and empty($value['Category'])) { echo "Null";}?>
                      
                        </td>
                        <td>
                        <?php //echo $value['ParentCat']['name'];?>
                        <?php if(is_array($value['ParentCat']) and !empty($value['ParentCat'])) { echo $value['ParentCat']['name'];}?>
						<?php if(is_array($value['ParentCat']) and empty($value['ParentCat'])) { echo "Null";}?>
                      
                        </td>
                        <td><?php echo date('d-m-Y', strtotime($value['Category']['created'])); ?></td>
                        <?php if($value['Category']['status']==0){?>  
                          <td>
                             <a href="<?php echo DOMAINADESTORE?>category/edit/<?php echo $value['Category']['id'] ?>" title="Edit"><img src="<?php echo DOMAINADESTORE?>images/icons/pencil.png" alt="Edit" /></a>
                             <a href="javascript:confirmDelete('<?php echo DOMAINADESTORE?>category/delete/<?php echo $value['Category']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINADESTORE?>images/icons/cross.png" alt="Delete" /></a> 
                             <a href="<?php echo DOMAINADESTORE?>category/active/<?php echo $value['Category']['id'] ?>" title="Kích hoạt" class="icon-5 info-tooltip"><img src="<?php echo DOMAINADESTORE?>images/icons/Play-icon.png" alt="Kích hoạt" /></a>
                        </td>
                        <?php } else {?> 
                          <td>
                            <!-- Icons -->
                             <a href="<?php echo DOMAINADESTORE?>category/edit/<?php echo $value['Category']['id'] ?>" title="Edit"><img src="<?php echo DOMAINADESTORE?>images/icons/pencil.png" alt="Edit" /></a>
                             <a href="javascript:confirmDelete('<?php echo DOMAINADESTORE?>category/delete/<?php echo $value['Category']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINADESTORE?>images/icons/cross.png" alt="Delete" /></a> 
                             <a href="<?php echo DOMAINADESTORE?>category/close/<?php echo $value['Category']['id'] ?>" title="Đóng" class="icon-4 info-tooltip"><img src="<?php echo DOMAINADESTORE?>images/icons/success-icon.png" alt="Ngắt kích hoạt" /></a>
                        </td>
                        <?php }?>
                    </tr>
                   <?php }?>
                </tbody>
                
            </table>
            
        </div> <!-- End #tab1 -->
        
         <!-- End #tab2 -->        
        
    </div> <!-- End .content-box-content -->
 </div>
 <?php echo $form->end(); ?>