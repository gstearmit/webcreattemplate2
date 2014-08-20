<?php echo $form->create(null, array( 'url' => DOMAINADBUSINISS.'products/search','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>
<br />
<div id="khung">
	<div id="main">
		<div class="toolbar-list" id="toolbar">
                    <ul>
                        <li id="toolbar-new">
                            <a href="<?php echo DOMAINADBUSINISS?>products/add" class="toolbar">
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
                            <a href="<?php echo DOMAINADBUSINISS?>home" class="toolbar">
                                <span class="icon-32-unpublish"></span>
                                Đóng
                            </a>
                        </li>
                    </ul>
                    <div class="clr"></div>
                </div>
        <div class="pagetitle icon-48-nhomtin"><h2>Sản phẩm</h2></div>
		<div class="clr"></div>
	</div>
</div>
<div class="content-box">
    <div class="content-box-header">
        <table class="timkiem">
        	<tr>
            	<td valign="top">Tìm kiếm</td>
            	<td><input type="text" id="field2c" name="name" class="text-input"></td>

                <td><?php echo $this->Form->input('parent_id',array('type'=>'select','options'=>$list_cat,'empty'=>'chọn danh mục','class'=>'select-search','label'=>''));?></td>

                    <td><input type="submit" name="" value="Tìm kiếm" class="button" /></td>
            </tr>
        </table>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Danh sách tin</a></li> 
            <li><a href="#tab2"></a></li>
        </ul>
        <div class="clear"></div>
    </div>
    <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1"> 
            <table>
            
            	<thead>
                    <tr>
                       <th width="1%"><input class="check-all" type="checkbox" /></th>
                       <th width="7%">STT</th>
                       <th><?php echo $this->Paginator->sort('Tên bài viết','id');?></th>
                       <!-- <th>Danh mục cha</th> -->
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
                            </div> 
                            <div class="clear"></div>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                   <?php  foreach ($product as $key =>$value){?>
                    <tr>
                        <td><input type="checkbox" /></td>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td><a href="<?php echo DOMAINADBUSINISS?>products/edit/<?php echo $value['Eshopdaquyproduct']['id'] ?>" title="Edit"><?php echo $value['Eshopdaquyproduct']['title']; ?></a></td>
                      <!--  <td>
					          <?php  //echo $value['Eshopdaquycatproduct']['name'];?>
							  <?php //if(is_array($value['Eshopdaquycatproduct']) and !empty($value['Eshopdaquycatproduct'])) { echo $value['Eshopdaquycatproduct']['name'];}?>
							  <?php //if(is_array($value['Eshopdaquycatproduct']) and empty($value['Eshopdaquycatproduct'])) { echo "Null";}?>
                       </td> -->
                        <td><?php echo date('d-m-Y', strtotime($value['Eshopdaquyproduct']['modified'])); ?></td>
                        <td>
                             <a href="<?php echo DOMAINADBUSINISS?>products/edit/<?php echo $value['Eshopdaquyproduct']['id'] ?>" title="Edit"><img src="<?php echo DOMAINADBUSINISS?>images/icons/pencil.png" alt="Edit" /></a>
                             <a href="javascript:confirmDelete('<?php echo DOMAINADBUSINISS?>products/delete/<?php echo $value['Eshopdaquyproduct']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINADBUSINISS?>images/icons/cross.png" alt="Delete" /></a>
                        <?php 
							if($value['Eshopdaquyproduct']['status']==0)
							{
						?>
                             <a href="<?php echo DOMAINADBUSINISS?>products/active/<?php echo $value['Eshopdaquyproduct']['id'] ?>" title="Kích hoạt" class="icon-5 info-tooltip"><img src="<?php echo DOMAINADBUSINISS?>images/icons/Play-icon.png" alt="Kích hoạt" /></a>
                        <?php 
							}else 
							{
						?>
                            <a href="<?php echo DOMAINADBUSINISS?>products/close/<?php echo $value['Eshopdaquyproduct']['id'] ?>" title="Đóng" class="icon-4 info-tooltip"><img src="<?php echo DOMAINADBUSINISS?>images/icons/success-icon.png" alt="Ngắt kích hoạt" /></a>
                        <?php 
							}
						?>
                        </td>
                        <td align="right"><?php echo $value['Eshopdaquyproduct']['id'];?></td>
                    </tr>
                   <?php }?>
                </tbody>
            </table>
        </div> <!-- End #tab1 -->
        <!-- End #tab2 -->        
    </div> <!-- End .content-box-content -->
 </div>
<?php echo $form->end(); ?>