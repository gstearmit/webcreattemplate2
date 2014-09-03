<?php //pr($city);die();?>
<script>
function confirmDelete(delUrl)
{
if (confirm("Bạn có muốn xóa danh mục này không!"))
{
	document.location = delUrl;
}
}
</script>
<?php echo $form->create(null, array( 'url' => DOMAINAD.'city/search','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); 
$city='Ten tỉnh/Thành phố';
$date='Ngày tạo';
$next='Tiếp theo';
$pre='Về trước';
if(isset($_GET['language'])){
	if($_GET['language']=='eng'){
		$city='City';
		$date='Creat date';
		$next='Next';
		$pre='Previous';
	}else {
		$city='Ten tỉnh/Thành phố';
		$date='Ngày tạo';
		$next='Tiếp theo';
		$pre='Về trước';
	}
}
?> 
    <fieldset class="search">
        <legend><?php __('search')?></legend>

        <div class="field">
            <label for="field2c"><?php __('City')?></label>
            <input type="text" id="field2c" name="keyword" class="text-search">
        </div>
        <p style="text-align:center;"> <input type="submit" name="" value="<?php __('search')?>" class="button" /></p>
       
    </fieldset>
 <?php echo $form->end(); ?>
<div class="content-box">
    <div class="content-box-header">
        
        <h3><?php __('Content')?></h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab"><?php __('List')?></a></li> 
            <li><a href="#tab2"></a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div> 
    <div class="content-box-content">
        
        <div class="tab-content default-tab" id="tab1"> 
            <table>
                
                <thead>
                    <tr>
                       <th><input class="check-all" name="checkall" type="checkbox" /></th>
                       <th><?php __('STT')?></th>
                       <th><?php echo $this->Paginator->sort($city,'id');?></th>
                      <th><?php __('location')?></th>
                       <th><?php echo $this->Paginator->sort($date,'created');?></th>
                       <th><?php __('handling')?></th>
                    </tr>
                    
                </thead>
             
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <div class="bulk-actions align-left">
                                 <select name="dropdown">
                                   <option value="option1"><?php __('select')?></option>
                                    <option value="active"><?php __('Active')?></option>
                                    <option value="notactive"><?php __('Del_active')?></option>
                                    <option value="delete"><?php __('Delete')?></option>
                                </select>
                                <a class="button" href="#" onclick="document.form1.submit();"><?php __('perform')?></a>
                            </div>
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
                
                   <?php $i=1; foreach ($city as $key =>$value){?>
                  
                    <tr>
                        <td><input type="checkbox" /></td>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td><?php echo $value['City']['name'];?></td>
                        
                        <td><?php echo $value['City']['char'];?></td>
                        <td><?php echo date('d-m-Y', strtotime($value['City']['created'])); ?></td>
                        <?php if($value['City']['status']==0){?>  
                          <td>
                             <a href="<?php echo DOMAINAD?>city/edit/<?php echo $value['City']['id'] ?>" title="Edit"><img src="<?php echo DOMAINAD?>images/icons/pencil.png" alt="Edit" /></a>
                             <a href="javascript:confirmDelete('<?php echo DOMAINAD?>city/delete/<?php echo $value['City']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a> 
                             <a href="<?php echo DOMAINAD?>city/active/<?php echo $value['City']['id'] ?>" title="Kích hoạt" class="icon-5 info-tooltip"><img src="<?php echo DOMAINAD?>images/icons/Play-icon.png" alt="Kích hoạt" /></a>
                        </td>
                        <?php } else {?> 
                          <td>
                            <!-- Icons -->
                             <a href="<?php echo DOMAINAD?>city/edit/<?php echo $value['City']['id'] ?>" title="Edit"><img src="<?php echo DOMAINAD?>images/icons/pencil.png" alt="Edit" /></a>
                             <a href="javascript:confirmDelete('<?php echo DOMAINAD?>city/delete/<?php echo $value['City']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a> 
                             <a href="<?php echo DOMAINAD?>city/close/<?php echo $value['City']['id'] ?>" title="Đóng" class="icon-4 info-tooltip"><img src="<?php echo DOMAINAD?>images/icons/success-icon.png" alt="Ngắt kích hoạt" /></a>
                        </td>
                        <?php }?>
                    </tr>
                   <?php }?>
                </tbody>
                
            </table>
            
        </div> <!-- End #tab1 -->
        
         <!-- End #tab2 -->        
        
    </div> <!-- End .content-box-content -->
 </div>
