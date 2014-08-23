<?php 
$name ='Nhân Viên';
$update='Cập nhật';
$back='Về trước';
$next='Tiếp theo';
if(isset($_GET['language'])){
	if($_GET['language']=='eng'){
		$name ='Staff';
		$update='Update';
		$back='Back';
		$next='Next';
	}else {
		$name ='Nhân viên';
		$update='Cập nhật';
		$back='Về trước';
		$next='Tiếp theo';
	}
	
}
?>
<?php echo $form->create(null, array( 'url' => DOMAINADESTORE.'helps/search','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?> 
<div id="khung">
	<div id="main">
		<div class="toolbar-list" id="toolbar">
                    <ul>
                        <li id="toolbar-new">
                            <a href="<?php echo DOMAINADESTORE?>helps/add" class="toolbar">
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
        <div class="pagetitle icon-48-nhomtin"><h2><?php __('Hotline_management')?></h2></div>
		<div class="clr"></div>
	</div>
</div>
<div class="content-box">
    <div class="content-box-header">
        
        <!--<table class="timkiem">
        	<tr>
            	<td valign="top">Tìm kiếm</td>
            	<td><input type="text" id="field2c" name="name" class="text-input"></td>
                <td><input type="submit" name="" value="Tìm kiếm" class="button" /></td>
            </tr>
        </table>-->
        
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab"><?php __('Hotline_list')?></a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2"></a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        
        <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
            <table>
                
                <thead>
                    <tr>
                       <th><input class="check-all" type="checkbox" /></th>
                        <th><?php __('No.')?></th>
                       <th><?php __('Title')?></th>
                       <th><?php echo $this->Paginator->sort($name,'id');?></th>
                       <th><?php __('Yahoo_name')?></th>                      
                       <th><?php __('Skype_name')?></th>
                       <th><?php __('Telephone_number')?></th> 
                       <th><?php __('Email')?></th> 
                        <th><?php __('Creat_date')?></th>                     
                       <th><?php __('Tackle')?></th>
                    </tr>
                    
                </thead>
             
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <div class="bulk-actions align-left">
                                <select name="dropdown">
                                    
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
                   <?php  foreach ($Helps as $key =>$Help){?>
                    <tr>
                        <td><input type="checkbox" /></td>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td><?php echo $Help['Help']['title']; ?></td> 
                        <td><?php echo $Help['Help']['user_support']; ?></td> 
                        <td><?php echo $Help['Help']['user_yahoo']; ?></td>
                        <td><?php echo $Help['Help']['user_skype']; ?></td>
                        <td><?php echo $Help['Help']['user_mobile']; ?></td>
                        <td><?php echo $Help['Help']['user_email']; ?></td>   
                        <td><?php echo date('d-m-Y', strtotime($Help['Help']['created'])); ?></td>
                        <td>
                             <a href="<?php echo DOMAINADESTORE?>helps/edit/<?php echo $Help['Help']['id'] ?>" title="Edit"><img src="<?php echo DOMAINADESTORE?>images/icons/pencil.png" alt="Edit" /></a>
                             <a href="javascript:confirmDelete('<?php echo DOMAINADESTORE?>helps/delete/<?php echo $Help['Help']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINADESTORE?>images/icons/cross.png" alt="Delete" /></a>
                        <?php 
							if($Help['Help']['status']==0)
							{
						?>
                             <a href="<?php echo DOMAINADESTORE?>helps/active/<?php echo $Help['Help']['id'] ?>" title="Kích hoạt" class="icon-5 info-tooltip"><img src="<?php echo DOMAINADESTORE?>images/icons/Play-icon.png" alt="Kích hoạt" /></a>
                        <?php 
							}else 
							{
						?>
                            <a href="<?php echo DOMAINADESTORE?>helps/close/<?php echo $Help['Help']['id'] ?>" title="Đóng" class="icon-4 info-tooltip"><img src="<?php echo DOMAINADESTORE?>images/icons/success-icon.png" alt="Ngắt kích hoạt" /></a>
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
