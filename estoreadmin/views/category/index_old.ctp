<?php 
$cat ='Tên danh mục';
$date='Ngày tạo';
$back='Về trước';
$next='Tiếp theo';
if(isset($_GET['language'])){
	if($_GET['language']=='eng'){
		$cat ='Category name';
		$date='Creat date';
		$back='Back';
		$next='Next';
	}else {
		$cat ='Tên danh mục';
		$date='Ngày tạo';
		$back='Về trước';
		$next='Tiếp theo';
	}
	
}
?>
<?php echo $form->create(null, array( 'url' => DOMAINADESTORE.'category/search','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?> 
<div id="khung">
	<div id="main">
		<div class="toolbar-list" id="toolbar">
                    <ul>
                        <li id="toolbar-new">
                            <a href="<?php echo DOMAINADESTORE?>category/add" class="toolbar">
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
        <div class="pagetitle icon-48-nhomtin"><h2><?php __('News_category')?></h2></div>
		<div class="clr"></div>
	</div>
</div>
<div class="content-box">
    <div class="content-box-header">
        
        <table class="timkiem">
        	<tr>
            	<td valign="top"><?php __('Search')?></td>
            	<td><input type="text" id="field2c" name="name_search" class="text-input"/></td>
                <td><input type="submit" name="" value="<?php __('Search')?>" class="button" /></td>
            </tr>
        </table>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab"><?php __('News_list')?></a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2"><?php __('Trash')?></a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        
         <div class="content-box-content">
        
        <div class="tab-content default-tab" id="tab1"> 
            <table>
               <form action="<?php echo DOMAINADESTORE; ?>category/processing" name="form1" method="post">
                <thead>
                    <tr>
                       <th><input class="check-all" type="checkbox" /></th>
                       <th><?php __('No.')?></th>
                       <th><?php __('ID')?></th>
                       <th><?php echo $this->Paginator->sort($cat,'id');?></th>
                       <th><?php __('Big_category')?></th>
                       <th><?php __('Position')?></th>
                       <th><?php echo $this->Paginator->sort($date,'created');?></th>
                       <th><?php __('Tackle')?></th>
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
                   <?php $i=1; foreach ($category as $key =>$value){?>
                    <tr>
                        <td><input type="checkbox" name="<?php echo $value['Category']['id'] ?>" /></td>
                        <td><?php $j=$key+1; echo $j;?></td>
                         <td><?php echo $value['Category']['id'];?></td>
                        <td><?php echo $value['Category']['name'];?></td>
                        <td>
                           <?php
                            if(is_array($value['ParentCat']) and !empty($value['ParentCat'])) { echo $value['ParentCat']['name'];}?>
							<?php if(is_array($value['ParentCat']) and empty($value['ParentCat'])) { echo "Null";}?>
                        </td>
                        <td><?php echo $value['Category']['tt'];?></td>
                        <td><?php echo date('d-m-Y', strtotime($value['Category']['created'])); ?></td>
                        <td>
                         <a href="<?php echo DOMAINADESTORE?>category/edit/<?php echo $value['Category']['id'] ?>" title="Edit"><img src="<?php echo DOMAINADESTORE?>images/icons/pencil.png" alt="Edit" /></a>
                         <a href="<?php echo DOMAINADESTORE?>category/close/<?php echo $value['Category']['id'] ?>" title=" Thùng rác " class="icon-4 info-tooltip"><img src="<?php echo DOMAINADESTORE?>images/icons/cross.png" alt="Delete" /></a>

                        </td>
                    </tr>
                   <?php }?>
                </tbody>
                </form>
            </table>
            
        </div> <!-- End #tab1 -->
        <div class="tab-content" id="tab2"> 
            <table>
               <form action="<?php echo DOMAINADESTORE; ?>category/processing" name="form1" method="post">
                <thead>
                    <tr>
                       <th><input class="check-all" type="checkbox" /></th>
                       <th>STT</th>
                       <th><?php echo $this->Paginator->sort('Tên danh mục','id');?></th>
                       <th>Danh mục cha</th>
                       <th>Vị trí</th>
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
                            </div> 
                            <div class="clear"></div>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                   <?php $i=1; foreach ($category1 as $key =>$value){?>
                    <tr>
                        <td><input type="checkbox" name="<?php echo $value['Category']['id'] ?>" /></td>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td><?php echo $value['Category']['name'];?></td>
                        <td><?php echo $value['ParentCat']['name'];?></td>
                        <td><?php echo $value['Category']['tt'];?></td>
                        <td><?php echo date('d-m-Y', strtotime($value['Category']['created'])); ?></td>
                        <td>
                             <a href="javascript:confirmDelete('<?php echo DOMAINADESTORE?>category/delete/<?php echo $value['Category']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINADESTORE?>images/icons/cross.png" alt="Delete" /></a>
                             <a href="<?php echo DOMAINADESTORE?>category/active/<?php echo $value['Category']['id'] ?>" title="Kích hoạt" class="icon-5 info-tooltip"><img src="<?php echo DOMAINADESTORE?>images/icons/Play-icon.png" alt="Phục hồi" /></a>
                        </td>
                    </tr>
                   <?php }?>
                </tbody>
                </form>
            </table>
            
        </div> <!-- End #tab1 -->
         <!-- End #tab2 -->        
        
    </div> <!-- End .content-box-content -->
 </div>
 <?php echo $form->end(); ?>
