<div id="khung">
	<div id="main">
		<div class="toolbar-list" id="toolbar">
                    <ul>
                        <li id="toolbar-new">
                            <a href="<?php echo DOMAINAD?>menu/add" class="toolbar">
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
        <div class="pagetitle icon-48-nhomtin"><h2>Quản lý menu</h2></div>
		<div class="clr"></div>
	</div>
</div>
<div class="content-box">
    <div class="content-box-header">
        <?php echo $form->create(null, array( 'url' => DOMAINAD.'menu/search','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?> 
        <table class="timkiem">
        	<tr>
            	<td valign="top">Tìm kiếm</td>
            	<td><input type="text" id="field2c" name="name" class="text-input"></td>
                <td><input type="submit" name="" value="Tìm kiếm" class="button" /></td>
            </tr>
        </table>
         <?php echo $form->end(); ?>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Menu</a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2"></a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
         <form action="<?php echo DOMAINAD; ?>menu/processing" name="form1" method="post">
        <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
            <table>
               
                <thead>
                    <tr style="text-align:center;">
                       <th width="1%"><input class="check-all" type="checkbox" name="checkall" /></th>
                       <th width="7%">STT</th>
                       <th><?php echo $this->Paginator->sort('Tên menu','id');?></th>
                       <th>Menu cha</th>
                       <th style="text-align:center;">Vị trí</th>
                       <th><?php echo $this->Paginator->sort('Cập nhật','created');?></th>
                       <th>Xử lý</th>
                       <th width="3%">ID</th>
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
                            <div class="clear"></div>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                   <?php $i=1; foreach ($menu as $key =>$value){?>
                    <tr>
                        <td><input type="checkbox"  name="<?php echo $value['Menu']['id'] ?>" /></td>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td><a href="<?php echo DOMAINAD?>menu/edit/<?php echo $value['Menu']['id'] ?>" title="Edit">
							<?php echo $value['Menu']['name'];?>
                            </a>
                        </td>
                        <td><?php echo $value['ParentCat']['name'];?></td>
                        <td style="text-align:center;"><input class="text-input medium-input datepicker" style="text-align:center; width:30% !important;" type="text" value="<?php echo $value['Menu']['order'];?>" name="order" /></td>
                        <td><?php echo date('d-m-Y h:i:s', strtotime($value['Menu']['created'])); ?></td>
                        <?php if($value['Menu']['status']==0){?>  
                        <td>
                             <a href="<?php echo DOMAINAD?>menu/edit/<?php echo $value['Menu']['id'] ?>" title="Sửa mục này"><img src="<?php echo DOMAINAD?>images/icons/pencil.png" alt="Sửa" /></a>
                             <a href="javascript:confirmDelete('<?php echo DOMAINAD?>menu/delete/<?php echo $value['Menu']['id'] ?>')" title="Xóa mục này"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Xóa" /></a> 
                             <a href="<?php echo DOMAINAD?>menu/active/<?php echo $value['Menu']['id'] ?>" title="Kích hoạt" class="icon-5 info-tooltip"><img src="<?php echo DOMAINAD?>images/icons/Play-icon.png" alt="Kích hoạt" /></a>
                        </td>
                        <?php } else {?> 
                          <td>
                            <!-- Icons -->
                             <a href="<?php echo DOMAINAD?>menu/edit/<?php echo $value['Menu']['id'] ?>" title="Sửa mục này"><img src="<?php echo DOMAINAD?>images/icons/pencil.png" alt="Sửa" /></a>
                             <a href="javascript:confirmDelete('<?php echo DOMAINAD?>menu/delete/<?php echo $value['Menu']['id'] ?>')" title="Xóa mục này"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Xóa" /></a> 
                             <a href="<?php echo DOMAINAD?>menu/close/<?php echo $value['Menu']['id'] ?>" title="Tích vào để không hiển thị mục này" class="icon-4 info-tooltip"><img src="<?php echo DOMAINAD?>images/icons/success-icon.png" alt="Ngắt kích hoạt" /></a>
                        </td>
                        <td align="right"><?php echo $value['Menu']['id'];?></td>
                        <?php }?>
                    </tr>
                   <?php }?>
                </tbody>
                 
            </table>
            
        </div> <!-- End #tab1 -->
        </form>
         <!-- End #tab2 -->        
        
    </div> <!-- End .content-box-content -->
 </div>

