<script>
function confirmDelete(delUrl)
{
if (confirm("Bạn có muốn xóa danh mục này không!"))
{
	document.location = delUrl;
}
}
<?php 
$select="Chọn danh mục";
$category="Tên danh mục";
$date ="Ngày tạo";
$next = 'Tiếp theo';
		$pre ='Về trước';
if(isset($_GET['language'])){
	if($_GET['language']=='vie'){
		$select="Chọn danh mục";
		$category="Tên danh mục";
		$date ="Ngày tạo";
		$next = 'Tiếp theo';
		$pre ='Về trước';
	}else {
		$select="Select Category";
		$category="Category name";
		$date ="Creat date";
		$next = 'Next';
		$pre ='Previous';
	}

}

?>
</script>
<?php echo $form->create(null, array( 'url' => DOMAINAD.'catproducts/search','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?> 
     <fieldset class="search">
        
        <legend><?php __('search')?></legend>

        <div class="field required">
            <label for="field1c"><?php __('Category')?></label>
             <?php echo $this->Form->input('parent_id',array('type'=>'select','options'=>$list_cat,'empty'=>$select,'class'=>'select-search','label'=>''));?>
        </div>
        <div class="field">
            <label for="field2c"><?php __('Title')?></label>
            <input type="text" id="field2c" name="name" class="text-search">
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
                       <th><input class="check-all" type="checkbox" /></th>
                       <th><?php __('STT')?></th>
                       <th><?php echo $this->Paginator->sort($category,'id');?></th>
                       
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
                                    <option value="option2"><?php __('Active')?></option>
                                    <option value="option2"><?php __('Del_active')?></option>
                                    <option value="option3"><?php __('Delete')?></option>
                                </select>
                                <a class="button" href="#"><?php __('perform')?></a>
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
                   <?php $i=1; foreach ($catproduct as $key =>$value){?>
                    <tr>
                        <td><input type="checkbox" /></td>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td><?php echo $value['Catproduct']['name'];?></td>
                        
                        <td><?php echo $value['Catproduct']['char'];?></td>
                        <td><?php echo date('d-m-Y', strtotime($value['Catproduct']['created'])); ?></td>
                        <?php if($value['Catproduct']['status']==0){?>  
                          <td>
                             <a href="<?php echo DOMAINAD?>catproducts/edit/<?php echo $value['Catproduct']['id'] ?>" title="Edit"><img src="<?php echo DOMAINAD?>images/icons/pencil.png" alt="Edit" /></a>
                             <a href="javascript:confirmDelete('<?php echo DOMAINAD?>catproducts/delete/<?php echo $value['Catproduct']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a> 
                             <a href="<?php echo DOMAINAD?>catproducts/active/<?php echo $value['Catproduct']['id'] ?>" title="Kích hoạt" class="icon-5 info-tooltip"><img src="<?php echo DOMAINAD?>images/icons/Play-icon.png" alt="Kích hoạt" /></a>
                        </td>
                        <?php } else {?> 
                          <td>
                            <!-- Icons -->
                             <a href="<?php echo DOMAINAD?>catproducts/edit/<?php echo $value['Catproduct']['id'] ?>" title="Edit"><img src="<?php echo DOMAINAD?>images/icons/pencil.png" alt="Edit" /></a>
                             <a href="javascript:confirmDelete('<?php echo DOMAINAD?>catproducts/delete/<?php echo $value['Catproduct']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a> 
                             <a href="<?php echo DOMAINAD?>catproducts/close/<?php echo $value['Catproduct']['id'] ?>" title="Đóng" class="icon-4 info-tooltip"><img src="<?php echo DOMAINAD?>images/icons/success-icon.png" alt="Ngắt kích hoạt" /></a>
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
