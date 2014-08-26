<?php 
$cat ='Tên danh mục';
$update='Cập nhật';
$back='Về trước';
$next='Tiếp theo';
if(isset($_GET['language'])){
	if($_GET['language']=='eng'){
		$cat ='Category';
		$update='Update';
		$back='Back';
		$next='Next';
	}else {
		$cat ='Tên danh mục';
		$update='Cập nhật';
		$back='Về trước';
		$next='Tiếp theo';
	}
	
}
?>
<?php echo $form->create(null, array( 'url' => DOMAINAD.'catproducts/search','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?> 
<div id="khung">
	<div id="main">
		<div class="toolbar-list" id="toolbar">
                    <ul>
                        <li id="toolbar-new">
                            <a href="<?php echo DOMAINADBUSINISS?>catproducts/add" class="toolbar">
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
        <div class="pagetitle icon-48-nhomtin"><h2><?php __('Category_product')?></h2></div>
		<div class="clr"></div>
	</div>
</div>
<div class="content-box">
    <div class="content-box-header">
        
        <table class="timkiem">
        	<tr>
            	<td valign="top"><?php __('Search')?></td>
            	<td><input type="text" id="field2c" name="name_search" class="text-input"></td>
                <td><input type="submit" name="" value="<?php __('Search')?>" class="button" /></td>
            </tr>
        </table>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab"><?php __('News_list')?></a></li> <!-- href must be unique and match the id of target div -->
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
                       <th width="7%"><?php __('No.')?></th>
                       <th><?php echo $this->Paginator->sort($cat,'id');?></th>
                      <!-- <th>Danh mục cha</th> -->
                       <th style="text-align:center;"><?php __('Position')?></th>
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
                                <a class="button" href="#"><?php __('Implement')?></a>
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
                        <td><a href="<?php echo DOMAINADBUSINISS?>catproducts/edit/<?php echo $value['Eshopdaquycatproduct']['id'] ?>" title="Edit">
							<?php //echo $value['Eshopdaquycatproduct']['name'];?>
							 <?php if(is_array($value['Eshopdaquycatproduct']) and !empty($value['Eshopdaquycatproduct'])) { echo $value['Eshopdaquycatproduct']['name'];}?>
							 <?php if(is_array($value['Eshopdaquycatproduct']) and empty($value['Eshopdaquycatproduct'])) { echo "Null";}?>
                            </a>
                        </td>
						<!--
                         <td>
							<?php //echo $value['ParentCatNew']['name'];?>
							<?php //if(is_array($value['ParentCatNew']) and !empty($value['ParentCatNew'])) { echo $value['ParentCatNew']['name'];}?>
							<?php //if(is_array($value['ParentCatNew']) and empty($value['ParentCatNew'])) { echo "Null";}?>
                        
                        </td>
						-->
                        <td style="text-align:center;"><input class="text-input medium-input datepicker" style="text-align:center; width:30% !important;" type="text" value="<?php echo $value['Eshopdaquycatproduct']['order'];?>" name="order" /></td>
                        <td><?php echo date('d-m-Y h:i:s', strtotime($value['Eshopdaquycatproduct']['modified'])); ?></td>
                        <?php if($value['Eshopdaquycatproduct']['status']==0){?>  
                        <td>
                             <a href="<?php echo DOMAINADBUSINISS?>catproducts/edit/<?php echo $value['Eshopdaquycatproduct']['id'] ?>" title="Sửa mục này"><img src="<?php echo DOMAINADBUSINISS?>images/icons/pencil.png" alt="Sửa" /></a>
                             <a href="javascript:confirmDelete('<?php echo DOMAINADBUSINISS?>catproducts/delete/<?php echo $value['Eshopdaquycatproduct']['id'] ?>')" title="Xóa mục này"><img src="<?php echo DOMAINADBUSINISS?>images/icons/cross.png" alt="Xóa" /></a> 
                             <a href="<?php echo DOMAINADBUSINISS?>Eshopdaquycatproducts/active/<?php echo $value['Eshopdaquycatproduct']['id'] ?>" title="Kích hoạt" class="icon-5 info-tooltip"><img src="<?php echo DOMAINADBUSINISS?>images/icons/Play-icon.png" alt="Kích hoạt" /></a>
                        </td>
                        <?php } else {?> 
                          <td>
                            <!-- Icons -->
                             <a href="<?php echo DOMAINADBUSINISS?>catproducts/edit/<?php echo $value['Eshopdaquycatproduct']['id'] ?>" title="Sửa mục này"><img src="<?php echo DOMAINADBUSINISS?>images/icons/pencil.png" alt="Sửa" /></a>
                             <a href="javascript:confirmDelete('<?php echo DOMAINADBUSINISS?>catproducts/delete/<?php echo $value['Eshopdaquycatproduct']['id'] ?>')" title="Xóa mục này"><img src="<?php echo DOMAINADBUSINISS?>images/icons/cross.png" alt="Xóa" /></a> 
                             <a href="<?php echo DOMAINADBUSINISS?>catproducts/close/<?php echo $value['Eshopdaquycatproduct']['id'] ?>" title="Tích vào để không hiển thị mục này" class="icon-4 info-tooltip"><img src="<?php echo DOMAINADBUSINISS?>images/icons/success-icon.png" alt="Ngắt kích hoạt" /></a>
                        </td>
                        <td align="right"><?php echo $value['Eshopdaquycatproduct']['id'];?></td>
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
