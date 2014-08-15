<script>
function confirmDelete(delUrl)
{
if (confirm("Bạn có muốn xóa danh mục này không!"))
{
	document.location = delUrl;
}
}
</script>
<?php 
$galary = 'Tên ảnh';
$date ='Ngày tạo';
$next = 'Tiếp theo';
$pre ='Về trước';
if(isset($_GET['language'])){
	if($_GET['language']=='eng'){
		$galary = 'Gallery name';
		$date ='Creat date';
		$next = 'Next';
		$pre ='Previous';
	}else {
		$galary = 'Tên ảnh';
		$date ='Ngày tạo';
		$next = 'Tiếp theo';
		$pre ='Về trước';
	}
}

?>
<p><a href="<?php echo DOMAINAD;?>gallery/add"> <input type="submit" name="" value="<?php __('Add_New')?>" class="button" /></a></p>

<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        
        <h3><?php __('List_images')?></h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab"><?php __('List')?></a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2"></a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        
        <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
            <table>
                 <form action="<?php echo DOMAINAD; ?>gallery/processing" name="form1" method="post">
                <thead>
                    <tr>
                       <th><input class="check-all" name="checkall" type="checkbox" /></th>
                       <th><?php __('STT')?></th>
                       <th><?php echo $this->Paginator->sort($galary,'id');?></th>
                      <th><?php __('In_product')?></th>
                       <th><?php echo $this->Paginator->sort($date,'created');?></th>
                       <th><?php __('handling')?></th>
                    </tr>
                    
                </thead>
             
                <tfoot>
                    <tr>
                        <td colspan="6">
                          
                             <div class="pagination">
                                <a href="#" title="First Page">
                                   <?php
                                        $paginator->options(array('url' => $this->passedArgs));
                                       echo "&laquo "; echo $paginator->prev($pre);
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
                    <?php $i=1; foreach ($Gallery as $key =>$value){?>
                    <tr>
                        <td><input type="checkbox" name="<?php echo $value['Gallery']['id'] ?>" /></td>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td><?php echo $value['Gallery']['name'];?></td>
                        <td><?php  echo $value['Product']['title'];?></td>
                         <td><?php echo date('d-m-Y', strtotime($value['Gallery']['created'])); ?></td>
                        <td>
                             <?php if($value['Gallery']['status']==0){?>
                                 <a href="<?php echo DOMAINAD?>gallery/edit/<?php echo $value['Gallery']['id'] ?>" title="Edit"><img src="<?php echo DOMAINAD?>images/icons/pencil.png" alt="Edit" /></a>
                                 <a href="javascript:confirmDelete('<?php echo DOMAINAD?>gallery/delete/<?php echo $value['Gallery']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a> 
                                 <a href="<?php echo DOMAINAD?>gallery/active/<?php echo $value['Gallery']['id'] ?>" title="Kích hoạt" class="icon-5 info-tooltip"><img src="<?php echo DOMAINAD?>images/icons/Play-icon.png" alt="Kích hoạt" /></a>
                            <?php } else {?>
                                 <a href="<?php echo DOMAINAD?>gallery/edit/<?php echo $value['Gallery']['id'] ?>" title="Edit"><img src="<?php echo DOMAINAD?>images/icons/pencil.png" alt="Edit" /></a>
                                 <a href="javascript:confirmDelete('<?php echo DOMAINAD?>gallery/delete/<?php echo $value['Gallery']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a> 
                                 <a href="<?php echo DOMAINAD?>gallery/close/<?php echo $value['Gallery']['id'] ?>" title="Đóng" class="icon-4 info-tooltip"><img src="<?php echo DOMAINAD?>images/icons/success-icon.png" alt="Ngắt kích hoạt" /></a>

                            <?php }?>
                        </td>
                    </tr>
                   <?php }?>
                </tbody>
                <?php echo $form->end(); ?>
            </table>
            
        </div> <!-- End #tab1 -->
        
         <!-- End #tab2 -->        
        
    </div> <!-- End .content-box-content -->
 </div>