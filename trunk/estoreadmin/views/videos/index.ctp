<script>
function confirmDelete(delUrl)
{
if (confirm("Bạn có muốn xóa danh mục này không!"))
{
	document.location = delUrl;
}
}
</script>
<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        
        <h3><?php __('Content')?></h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Ảnh Video</a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2"></a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        
        <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
            <table>
                <thead>
                    <tr>
                       <th><?php __('No.')?></th>
                       <th><?php __('Title')?></th>
                        <th><?php __('LinkUrl')?></th>
                        <th><?php __('Position')?></th>
                       <th><?php __('Creat_date')?></th>
                       <th><?php __('Tackle')?></th>
                    </tr>
                    
                </thead>
                <tbody>
                   <?php $i=1; foreach ($videos as $key => $value){?>
                    <tr>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td><?php echo $value['Video']['name'];?></td>
                         <td><?php echo $value['Video']['LinkUrl'];?></td>
                          <td>
                            <?php if($value['Video']['left']==0){?>
                                Bên trái
                            <?php } else {?>
                                Bên phải
                            <?php }?>
                        </td>
                        <td><?php echo date('d-m-Y', strtotime($value['Video']['created'])); ?></td>
                        <td>
                            <?php if($value['Video']['status']==0){?>
                                 <a href="<?php echo DOMAINADESTORE?>videos/edit/<?php echo $value['Video']['id'] ?>" title="Edit"><img src="<?php echo DOMAINADESTORE?>images/icons/pencil.png" alt="Edit" /></a>
                                 <a href="javascript:confirmDelete('<?php echo DOMAINADESTORE?>videos/delete/<?php echo $value['Video']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINADESTORE?>images/icons/cross.png" alt="Delete" /></a> 
                                 <a href="<?php echo DOMAINADESTORE?>videos/active/<?php echo $value['Video']['id'] ?>" title="Kích hoạt" class="icon-5 info-tooltip"><img src="<?php echo DOMAINADESTORE?>images/icons/Play-icon.png" alt="Kích hoạt" /></a>
                            <?php } else {?>
                                 <a href="<?php echo DOMAINADESTORE?>videos/edit/<?php echo $value['Video']['id'] ?>" title="Edit"><img src="<?php echo DOMAINADESTORE?>images/icons/pencil.png" alt="Edit" /></a>
                                 <a href="javascript:confirmDelete('<?php echo DOMAINADESTORE?>videos/delete/<?php echo $value['Video']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINADESTORE?>images/icons/cross.png" alt="Delete" /></a> 
                                 <a href="<?php echo DOMAINADESTORE?>videos/close/<?php echo $value['Video']['id'] ?>" title="Đóng" class="icon-4 info-tooltip"><img src="<?php echo DOMAINADESTORE?>images/icons/success-icon.png" alt="Ngắt kích hoạt" /></a>
                            <?php }?>
                        </td>
                    </tr>
                   <?php }?>
                </tbody>
            </table>
         
        </div> 
    </div> 