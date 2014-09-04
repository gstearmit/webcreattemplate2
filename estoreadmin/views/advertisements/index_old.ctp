<?php 
$web ='Tên website';
$update='Cập nhật';
$back='Về trước';
$next='Tiếp theo';
if(isset($_GET['language'])){
	if($_GET['language']=='eng'){
		$web ='Website name';
		$update='Update';
		$back='Back';
		$next='Next';
	}else {
		$web ='Tên website';
		$update='Cập nhật';
		$back='Về trước';
		$next='Tiếp theo';
	}
	
}
?>
<?php echo $form->create(null, array( 'url' => DOMAINADESTORE.'advertisements/search','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>
<br />
<div id="khung">
	<div id="main">
		<div class="toolbar-list" id="toolbar">
                    <ul>
                        <li id="toolbar-new">
                            <a href="<?php echo DOMAINADESTORE?>advertisements/add" class="toolbar">
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
        <div class="pagetitle icon-48-nhomtin"><h2><?php __('Advertisement')?></h2></div>
		<div class="clr"></div>
	</div>
</div>
<div class="content-box">
    <div class="content-box-header">
        <table class="timkiem">
        	<tr>
            	<td valign="top"><?php __('Search')?></td>
            	<td><input type="text" id="field2c" name="name" class="text-input"></td>


                    <td><input type="submit" name="" value="<?php __('Search')?>" class="button" /></td>
            </tr>
        </table>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab"><?php __('Vertical_advertisement')?></a></li> 
            <li><a href="#tab2"></a></li>
        </ul>
        <div class="clear"></div>
    </div>
    <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1"> 
            <table>
                
                <thead>
                    <tr>
                       <th><input class="check-all" type="checkbox" /></th>
                       <th>STT</th>
                       <th><?php echo $this->Paginator->sort($web,'id');?></th>
                       <th><?php __('Image')?></th>  
                       <th><?php __('Position')?></th>
                       <th><?php __('Creat_date')?></th>                         
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
                   <?php  foreach ($Advertisements as $key =>$value){?>
                    <tr>
                        <td><input type="checkbox" /></td>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td><?php  echo $value['Advertisement']['name'];?></td>                        
                        <td><img src="<?php echo DOMAINADESTORE?>/timthumb.php?src=<?php echo $value['Advertisement']['images']; ?>&amp;h=70&amp;w=140&amp;zc=1" alt="thumbnail" /></td>
                        <td>
                        <?php 
							if($value['Advertisement']['display']==null){?>
                            &nbsp;
                        <?php }?>
                        <?php 
							if($value['Advertisement']['display']==0){?>
                            Chạy bên trái
                        <?php }?>
                        <?php 
							if($value['Advertisement']['display']==1){?>
                            Chạy bên phải
                        <?php }?>
                        <?php 
							if($value['Advertisement']['display']==2){?>
                            Sidebar trái
                        <?php }?>
                        <?php 
							if($value['Advertisement']['display']==3){?>
                            Sidebar phải
                        <?php }?>
						</td>
                        <td><?php echo date('d-m-Y', strtotime($value['Advertisement']['created'])); ?></td>
                        <td>
                             <a href="<?php echo DOMAINADESTORE?>advertisements/edit/<?php echo $value['Advertisement']['id'] ?>" title="Edit"><img src="<?php echo DOMAINADESTORE?>images/icons/pencil.png" alt="Edit" /></a>
                             <a href="javascript:confirmDelete('<?php echo DOMAINADESTORE?>advertisements/delete/<?php echo $value['Advertisement']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINADESTORE?>images/icons/cross.png" alt="Delete" /></a>
                        <?php 
							if($value['Advertisement']['status']==0)
							{
						?>
                             <a href="<?php echo DOMAINADESTORE?>advertisements/active/<?php echo $value['Advertisement']['id'] ?>" title="Kích hoạt" class="icon-5 info-tooltip"><img src="<?php echo DOMAINADESTORE?>images/icons/Play-icon.png" alt="Kích hoạt" /></a>
                        <?php 
							}else 
							{
						?>
                            <a href="<?php echo DOMAINADESTORE?>advertisements/close/<?php echo $value['Advertisement']['id'] ?>" title="Đóng" class="icon-4 info-tooltip"><img src="<?php echo DOMAINADESTORE?>images/icons/success-icon.png" alt="Ngắt kích hoạt" /></a>
                        <?php 
							}
						?>
                        </td>
                    </tr>
                   <?php }?>
                </tbody>
                
            </table>
        </div> <!-- End #tab1 -->
        <!-- End #tab2 -->        
    </div> <!-- End .content-box-content -->
 </div>
<?php echo $form->end(); ?>