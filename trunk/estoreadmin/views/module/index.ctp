<?php echo $form->create(null, array( 'url' => DOMAINAD.'module/search','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?> 
<div id="khung">
	<div id="main">
		<div class="toolbar-list" id="toolbar">
                    <ul>
                        <li id="toolbar-new">
                            <a href="<?php echo DOMAINAD?>module/add" class="toolbar">
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
                            <a href="<?php echo DOMAINAD?>home" class="toolbar">
                                <span class="icon-32-unpublish"></span>
                                Đóng
                            </a>
                        </li>
                    </ul>
                    <div class="clr"></div>
                </div>
        <div class="pagetitle icon-48-nhomtin"><h2>Quản lý module</h2></div>
		<div class="clr"></div>
	</div>
</div>
<div class="content-box">
    <div class="content-box-header">
     
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Module</a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2"></a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        
        <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
            <table>
                
                <thead>
                    <tr style="text-align:center;">
                       <th width="1%"><input class="check-all" type="checkbox" /></th>
                       <th width="7%">STT</th>
                       <th><?php echo $this->Paginator->sort('Tên module','id');?></th>
                       <th style="text-align:center;">Tình trạng</th>
                       <th style="text-align:center;"><?php echo $this->Paginator->sort('Cập nhật','created');?></th>
                       <th>Xử lý</th>
                       <th width="3%">ID</th>
                    </tr>
                    
                </thead>
             
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <div class="bulk-actions align-left">
                                <select name="dropdown">
                                    <option value="">Lựa chọn</option>
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
                   <?php $i=1; foreach ($module as $key =>$value){?>
                    <tr>
                        <td><input type="checkbox" name="check_id[]" /></td>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td>
							<?php echo $value['Module']['name'];?>
                        </td>
                        <td style="text-align:center;">
                          <?php if($value['Module']['status']==1){ echo "Đã kích hoạt";}else{echo"Đang tạm ngừng";}?>  
                        </td>
                        <td style="text-align:center;"><?php echo date('d-m-Y h:i:s', strtotime($value['Module']['created'])); ?></td>
                        <?php if($value['Module']['status']==0){?>  
                        <td>
                             <a href="<?php echo DOMAINAD?>module/edit/<?php echo $value['Module']['id'] ?>" title="Sửa mục này"><img src="<?php echo DOMAINAD?>images/icons/pencil.png" alt="Sửa" /></a>
                             <a href="javascript:confirmDelete('<?php echo DOMAINAD?>module/delete/<?php echo $value['Module']['id'] ?>')" title="Xóa mục này"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Xóa" /></a> 
                             <a href="<?php echo DOMAINAD?>module/active/<?php echo $value['Module']['id'] ?>" title="Kích hoạt" class="icon-5 info-tooltip"><img src="<?php echo DOMAINAD?>images/icons/Play-icon.png" alt="Kích hoạt" /></a>
                        </td>
                        <?php } else {?> 
                          <td>
                            <!-- Icons -->
                             <a href="<?php echo DOMAINAD?>module/edit/<?php echo $value['Module']['id'] ?>" title="Sửa mục này"><img src="<?php echo DOMAINAD?>images/icons/pencil.png" alt="Sửa" /></a>
                             <a href="javascript:confirmDelete('<?php echo DOMAINAD?>module/delete/<?php echo $value['Module']['id'] ?>')" title="Xóa mục này"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Xóa" /></a> 
                             <a href="<?php echo DOMAINAD?>module/close/<?php echo $value['Module']['id'] ?>" title="Tích vào để không hiển thị mục này" class="icon-4 info-tooltip"><img src="<?php echo DOMAINAD?>images/icons/success-icon.png" alt="Ngắt kích hoạt" /></a>
                        </td>
                        <td align="right"><?php echo $value['Module']['id'];?></td>
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
