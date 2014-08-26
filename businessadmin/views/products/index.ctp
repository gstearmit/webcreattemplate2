<?php 
$select='Chọn danh mục';
$cat ='Tên bài viết';
$update='Cập nhật';
$back='Về trước';
$next='Tiếp theo';
if(isset($_GET['language'])){
	if($_GET['language']=='eng'){
		$select='Select Category';
		$cat ='Title article';
		$update='Update';
		$back='Back';
		$next='Next';
	}else {
		$select='Chọn danh mục';
		$cat ='Tên bài viết';
		$update='Cập nhật';
		$back='Về trước';
		$next='Tiếp theo';
	}
	
}
?>
<?php echo $form->create(null, array( 'url' => DOMAINADBUSINISS.'products/search','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>
<br />
<div id="khung">
	<div id="main">
		<div class="toolbar-list" id="toolbar">
                    <ul>
                        <li id="toolbar-new">
                            <a href="<?php echo DOMAINADBUSINISS?>products/add" class="toolbar">
                                <span class="icon-32-new"></span>
                                <?php __('Add_new')?>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li id="toolbar-help">
                            <a href="#messages" rel="modal" class="toolbar">
                                <span class="icon-32-help"></span>
                               <?php __('Help')?>
                            </a>
                        </li>
                        <li id="toolbar-unpublish">
                            <a href="<?php echo DOMAINADBUSINISS?>home" class="toolbar">
                                <span class="icon-32-unpublish"></span>
                             <?php __('Close')?>
                            </a>
                        </li>
                    </ul>
                    <div class="clr"></div>
                </div>
        <div class="pagetitle icon-48-nhomtin"><h2><?php __('product')?></h2></div>
		<div class="clr"></div>
	</div>
</div>
<div class="content-box">
    <div class="content-box-header">
        <table class="timkiem">
        	<tr>
            	<td valign="top"><?php __('Search')?></td>
            	<td><input type="text" id="field2c" name="name" class="text-input"></td>

                <td><?php echo $this->Form->input('parent_id',array('type'=>'select','options'=>$list_cat,'empty'=>$select,'class'=>'select-search','label'=>''));?></td>

                    <td><input type="submit" name="" value="<?php __('Search')?>" class="button" /></td>
            </tr>
        </table>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab"><?php __('Product_list')?></a></li> 
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
                       <th width="7%"><?php __('No.')?></th>
                       <th><?php echo $this->Paginator->sort($cat,'id');?></th>
                       <!-- <th>Danh mục cha</th> -->
                       <th><?php echo $this->Paginator->sort($update,'modified');?></th>
                       <th><?php __('Tackle')?></th>
                       <th width="3%"><?php __('ID')?></th>
                    </tr>
                </thead>
             
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <div class="bulk-actions align-left">
                                <select name="dropdown">
                                     <option value="option1"><?php __('Select')?></option>
                                    <option value="active"><?php __('Active')?></option>
                                    <option value="notactive"><?php __('Cancel_Active')?></option>
                                    <option value="delete"><?php __('Delete')?></option>
                                </select>
                                <a class="button" href="#" onclick="document.form1.submit();"><?php __('Implement')?></a>
                            </div>
                             <div class="pagination">
                                <a href="#" title="First Page">
                                   <?php
                                        $paginator->options(array('url' => $this->passedArgs));
                                       echo "&laquo "; echo $paginator->prev($back);
							       ?> 
                                </a>
							     <?php 
								   echo $paginator->numbers();
                                   echo $paginator->next($next); echo "&raquo";
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