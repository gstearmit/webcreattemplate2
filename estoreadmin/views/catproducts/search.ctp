<?php echo $form->create(null, array( 'url' => DOMAINADESTORE.'catproducts/search','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?> 
<div id="khung">
	<div id="main">
		<div class="toolbar-list" id="toolbar">
                    <ul>
                        <li id="toolbar-new">
                            <a href="<?php echo DOMAINADESTORE?>catproducts/add" class="toolbar">
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
        <div class="pagetitle icon-48-nhomtin"><h2>Danh mục sản phẩm</h2></div>
		<div class="clr"></div>
	</div>
</div>
<div class="content-box">
    <div class="content-box-header">
        
        <table class="timkiem">
        	<tr>
            	<td valign="top">Tìm kiếm</td>
            	<td><input type="text" id="field2c" name="name_search" class="text-input"></td>
                <td><input type="submit" name="" value="Tìm kiếm" class="button" /></td>
            </tr>
        </table>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Danh sách tin</a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2"></a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        
        <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
            <table>
                
                <thead>
                    <tr>
                       <th width="1%"><input class="check-all" type="checkbox" /></th>
                       <th width="7%">STT</th>
                       <th><?php echo $this->Paginator->sort('Tên danh mục','id');?></th>
                       <th>Danh mục cha</th>
                       <!--<th style="text-align:center;">Vị trí</th>-->
                       <th><?php echo $this->Paginator->sort('Cập nhật','modified');?></th>
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
                   <?php $i=1; foreach ($listsearch as $key =>$value){?>
                    <tr>
                        <td><input type="checkbox" name="check_id[]" /></td>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td><a href="<?php echo DOMAINADESTORE?>catproducts/edit/<?php echo $value['Catproduct']['id'] ?>" title="Edit">
							<?php 
							
								echo $value['Catproduct']['name'];?>
                            </a>
                        </td>
                         <td>
							<?php echo $value['ParentCat']['name'];?>
                        </td>
                        <!--<td style="text-align:center;"><input class="text-input medium-input datepicker" style="text-align:center; width:30% !important;" type="text" value="<?php echo $value['Catproduct']['order'];?>" name="order" /></td>-->
                        <td><?php echo date('d-m-Y h:i:s', strtotime($value['Catproduct']['modified'])); ?></td>
                        <?php if($value['Catproduct']['status']==0){?>  
                        <td>
                             <a href="<?php echo DOMAINADESTORE?>catproducts/edit/<?php echo $value['Catproduct']['id'] ?>" title="Sửa mục này"><img src="<?php echo DOMAINADESTORE?>images/icons/pencil.png" alt="Sửa" /></a>
                             <a href="javascript:confirmDelete('<?php echo DOMAINADESTORE?>catproducts/delete/<?php echo $value['Catproduct']['id'] ?>')" title="Xóa mục này"><img src="<?php echo DOMAINADESTORE?>images/icons/cross.png" alt="Xóa" /></a> 
                             <a href="<?php echo DOMAINADESTORE?>Catproducts/active/<?php echo $value['Catproduct']['id'] ?>" title="Kích hoạt" class="icon-5 info-tooltip"><img src="<?php echo DOMAINADESTORE?>images/icons/Play-icon.png" alt="Kích hoạt" /></a>
                        </td>
                        <?php } else {?> 
                          <td>
                            <!-- Icons -->
                             <a href="<?php echo DOMAINADESTORE?>catproducts/edit/<?php echo $value['Catproduct']['id'] ?>" title="Sửa mục này"><img src="<?php echo DOMAINADESTORE?>images/icons/pencil.png" alt="Sửa" /></a>
                             <a href="javascript:confirmDelete('<?php echo DOMAINADESTORE?>catproducts/delete/<?php echo $value['Catproduct']['id'] ?>')" title="Xóa mục này"><img src="<?php echo DOMAINADESTORE?>images/icons/cross.png" alt="Xóa" /></a> 
                             <a href="<?php echo DOMAINADESTORE?>catproducts/close/<?php echo $value['Catproduct']['id'] ?>" title="Tích vào để không hiển thị mục này" class="icon-4 info-tooltip"><img src="<?php echo DOMAINADESTORE?>images/icons/success-icon.png" alt="Ngắt kích hoạt" /></a>
                        </td>
                        <td align="right"><?php echo $value['Catproduct']['id'];?></td>
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
