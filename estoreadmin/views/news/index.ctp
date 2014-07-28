<?php echo $form->create(null, array( 'url' => DOMAINAD.'news/search','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>
<br />
<div id="khung">
	<div id="main">
		<div class="toolbar-list" id="toolbar">
                    <ul>
                        <li id="toolbar-new">
                            <a href="<?php echo DOMAINAD?>news/add" class="toolbar">
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
        <div class="pagetitle icon-48-nhomtin"><h2>Quản trị tin tức</h2></div>
		<div class="clr"></div>
	</div>
</div>
<div class="content-box">
    <div class="content-box-header">
    <table class="timkiem">
        	<tr>
            	<td valign="top">Tìm kiếm</td>
            	<td><input type="text" id="field2c" name="keyword" class="text-input"></td>

                <td>
                <select style="margin-left:15px;" name="system">
                           <option value="">-- Danh mục --</option>
                            <?php foreach($cat as $Category) {?>
                            <?php if($Category['Category']['parent_id']==null){?>
                             <option value="<?php echo $Category['Category']['id']; ?>"><?php echo $Category['Category']['name']; ?></option>
                             <?php foreach($catcon as $Categorys) {?>
                             <?php if($Categorys['Category']['parent_id']==$Category['Category']['id']){?>
                             <option value="<?php echo $Categorys['Category']['id']; ?>">--<?php echo $Categorys['Category']['name']; ?></option>
                            <?php }}}}?>
                 </select>
                </td>
                    <td><input type="submit" name="" value="Tìm kiếm" class="button" /></td>
            </tr>
        </table>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Danh sách tin</a></li> 
            <li><a href="#tab2"></a></li>
        </ul>
        <div class="clear"></div>
    </div>
    <?php echo $form->end(); ?>
    <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1"> 
            <table>
            <form action="<?php echo DOMAINAD; ?>news/processing" name="form1" method="post">
            	<thead>
                    <tr>
                       <th width="1%"><input class="check-all" type="checkbox" /></th>
                       <th width="7%">STT</th>
                       <th><?php echo $this->Paginator->sort('Tên bài viết','id');?></th>
                       <th>Danh mục cha</th>
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
                   <?php  foreach ($news as $key =>$value){?>
                    <tr>
                        <td><input type="checkbox" name="<?php echo $value['News']['id'] ?>"  /></td>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td><a href="<?php echo DOMAINAD?>news/edit/<?php echo $value['News']['id'] ?>" title="Edit"><?php echo $value['News']['title']; ?></a></td>
                        <td><?php  echo $value['Category']['name'];?></td>
                        <td><?php echo date('d-m-Y', strtotime($value['News']['modified'])); ?></td>
                        <td>
                             <a href="<?php echo DOMAINAD?>news/edit/<?php echo $value['News']['id'] ?>" title="Edit"><img src="<?php echo DOMAINAD?>images/icons/pencil.png" alt="Edit" /></a>
                             <a href="javascript:confirmDelete('<?php echo DOMAINAD?>news/delete/<?php echo $value['News']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a>
                        <?php 
							if($value['News']['status']==0)
							{
						?>
                             <a href="<?php echo DOMAINAD?>news/active/<?php echo $value['News']['id'] ?>" title="Kích hoạt" class="icon-5 info-tooltip"><img src="<?php echo DOMAINAD?>images/icons/Play-icon.png" alt="Kích hoạt" /></a>
                        <?php 
							}else 
							{
						?>
                            <a href="<?php echo DOMAINAD?>news/close/<?php echo $value['News']['id'] ?>" title="Đóng" class="icon-4 info-tooltip"><img src="<?php echo DOMAINAD?>images/icons/success-icon.png" alt="Ngắt kích hoạt" /></a>
                        <?php 
							}
						?>
                        </td>
                        <td align="right"><?php echo $value['News']['id'];?></td>
                    </tr>
                   <?php }?>
                </tbody>
                </form>
            </table>
        </div> <!-- End #tab1 -->
        <!-- End #tab2 -->        
    </div> <!-- End .content-box-content -->
 </div>
