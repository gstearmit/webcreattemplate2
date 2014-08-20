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
<div id="khung">
	<div id="main">
		<div class="toolbar-list" id="toolbar">
                    <ul>
                        <li id="toolbar-new">
                            <a href="<?php echo DOMAINADESTORE?>catproducts/add" class="toolbar">
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
                            <a href="<?php echo DOMAINADESTORE?>home" class="toolbar">
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
        <?php echo $form->create(null, array( 'url' => DOMAINADESTORE.'catproducts/search','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?> 
        <table class="timkiem">
        	<tr>
            	<td valign="top"><?php __('Search')?></td>
            	<td><input type="text" id="field2c" name="name_search" class="text-input"></td>
                <td><input type="submit" name="" value="<?php __('Search')?>" class="button" /></td>
            </tr>
        </table>
         <?php echo $form->end(); ?>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab"><?php __('News_list')?></a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2"></a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
         <form action="<?php echo DOMAINADESTORE; ?>catproducts/processing" name="form1" method="post">
        <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
            <table>
                
                <thead>
                    <tr>
                       <th width="1%"><input class="check-all" type="checkbox" name="checkall" /></th>
                       <th width="7%"><?php __('No.')?></th>
                       <th><?php echo $this->Paginator->sort($cat,'id');?></th>
                       <th><?php __('Big_category')?></th>
<!--                       <th style="text-align:center;">Vị trí</th>-->
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
                            </div> <!-- End .pagination -->
                            <div class="clear"></div>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                   <?php $i=1; foreach ($Catproduct as $key =>$value){?>
                    <tr>
                        <td><input type="checkbox" name="<?php echo $value['Catproduct']['id'] ?>" /></td>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td><a href="<?php echo DOMAINADESTORE?>catproducts/edit/<?php echo $value['Catproduct']['id'] ?>" title="Edit">
							<?php //echo $value['Catproduct']['name'];?>
							  <?php if(is_array($value['Catproduct']) and !empty($value['Catproduct'])) { echo $value['Catproduct']['name'];}?>
							 <?php if(is_array($value['Catproduct']) and empty($value['Catproduct'])) { echo "Null";}?>
                       
                            </a>
                        </td>
                         <td>
							<?php if(is_array($value['ParentCat']) and !empty($value['ParentCat'])) { echo $value['ParentCat']['name'];}?>
							<?php if(is_array($value['ParentCat']) and empty($value['ParentCat'])) { echo "Null";}?>
                        </td>
<!--                        <td style="text-align:center;"><input class="text-input medium-input datepicker" style="text-align:center; width:30% !important;" type="text" value="<?php echo $value['Catproduct']['order'];?>" name="order" /></td>-->
                        <td><?php echo date('d-m-Y h:i:s', strtotime($value['Catproduct']['created'])); ?></td>
                        
                        <td>
                             <a href="<?php echo DOMAINADESTORE?>catproducts/edit/<?php echo $value['Catproduct']['id'] ?>" title="Sửa mục này"><img src="<?php echo DOMAINADESTORE?>images/icons/pencil.png" alt="Sửa" /></a>
                             <a href="javascript:confirmDelete('<?php echo DOMAINADESTORE?>catproducts/delete/<?php echo $value['Catproduct']['id'] ?>')" title="Xóa mục này"><img src="<?php echo DOMAINADESTORE?>images/icons/cross.png" alt="Xóa" /></a> 
                             <?php if($value['Catproduct']['status']==0){?>  
                             <a href="<?php echo DOMAINADESTORE?>catproducts/active/<?php echo $value['Catproduct']['id'] ?>" title="Kích hoạt" class="icon-5 info-tooltip"><img src="<?php echo DOMAINADESTORE?>images/icons/Play-icon.png" alt="Kích hoạt" /></a>
                              <?php } else {?> 
                              <a href="<?php echo DOMAINADESTORE?>catproducts/close/<?php echo $value['Catproduct']['id'] ?>" title="Tích vào để không hiển thị mục này" class="icon-4 info-tooltip"><img src="<?php echo DOMAINADESTORE?>images/icons/success-icon.png" alt="Ngắt kích hoạt" /></a>
                               <?php }?>
                        </td>
                        <td align="right"><?php echo $value['Catproduct']['id'];?></td>
                       
                    </tr>
                   <?php }?>
                </tbody>
                
            </table>
            
        </div> <!-- End #tab1 -->
        </form>
         <!-- End #tab2 -->        
        
    </div> <!-- End .content-box-content -->
 </div>

