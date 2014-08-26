<?php 
$select='Chọn danh mục';
$cat ='Tên danh mục';
$update='Cập nhật';
$back='Về trước';
$next='Tiếp theo';
if(isset($_GET['language'])){
	if($_GET['language']=='eng'){
		$select='Select Category';
		$cat ='Category';
		$update='Update';
		$back='Back';
		$next='Next';
	}else {
		$select='Chọn danh mục';
		$cat ='Tên danh mục';
		$update='Cập nhật';
		$back='Về trước';
		$next='Tiếp theo';
	}
	
}
?>
<script>
function confirmDelete(delUrl)
{
if (confirm("Bạn có muốn xóa danh mục này không!"))
{
	document.location = delUrl;
}
}
</script>
<?php echo $form->create(null, array( 'url' => DOMAINAD.'category/search','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?> 
     <fieldset class="search">
        
        <legend><?php __('Search')?></legend>

        <div class="field required">
            <label for="field1c"><?php __('Category')?></label>
             <?php echo $this->Form->input('parent_id',array('type'=>'select','options'=>$list_cat,'empty'=>$select,'class'=>'select-search','label'=>''));?>
        </div>
        <div class="field">
            <label for="field2c"><?php __('Title')?></label>
            <input type="text" id="field2c" name="name" class="text-search">
        </div>
        <p style="text-align:center;"> <input type="submit" name="" value="<?php __('Search')?>" class="button" /></p>
       
    </fieldset>
 <?php echo $form->end(); ?>
<div class="content-box">
    <div class="content-box-header">
        
        <h3><?php __('Content')?></h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab"><?php __('News_list')?></a></li> 
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
                       <th><?php __('No.')?></th>
                       <th><?php echo $this->Paginator->sort($cat,'id');?></th>
                       <th><?php __('Big_category')?></th>
                       <th><?php __('Position')?></th>
                       <th><?php echo $this->Paginator->sort($update,'created');?></th>
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
                   <?php $i=1; foreach ($category as $key =>$value){?>
                    <tr>
                        <td><input type="checkbox" /></td>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td><?php echo $value['Eshopdaquycategory']['name'];?></td>
                        <td><?php echo $value['ParentCat']['name'];?></td>
                        <td><?php echo $value['Eshopdaquycategory']['char'];?></td>
                        <td><?php echo date('d-m-Y', strtotime($value['Eshopdaquycategory']['created'])); ?></td>
                        <?php if($value['Eshopdaquycategory']['status']==0){?>  
                          <td>
                             <a href="<?php echo DOMAINAD?>categorys/edit/<?php echo $value['Eshopdaquycategory']['id'] ?>" title="Edit"><img src="<?php echo DOMAINAD?>images/icons/pencil.png" alt="Edit" /></a>
                             <a href="javascript:confirmDelete('<?php echo DOMAINAD?>category/delete/<?php echo $value['Eshopdaquycategory']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a> 
                             <a href="<?php echo DOMAINAD?>category/active/<?php echo $value['Eshopdaquycategory']['id'] ?>" title="Kích hoạt" class="icon-5 info-tooltip"><img src="<?php echo DOMAINAD?>images/icons/Play-icon.png" alt="Kích hoạt" /></a>
                        </td>
                        <?php } else {?> 
                          <td>
                            <!-- Icons -->
                             <a href="<?php echo DOMAINAD?>category/edit/<?php echo $value['Eshopdaquycategory']['id'] ?>" title="Edit"><img src="<?php echo DOMAINAD?>images/icons/pencil.png" alt="Edit" /></a>
                             <a href="javascript:confirmDelete('<?php echo DOMAINAD?>category/delete/<?php echo $value['Eshopdaquycategory']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a> 
                             <a href="<?php echo DOMAINAD?>category/close/<?php echo $value['Eshopdaquycategory']['id'] ?>" title="Đóng" class="icon-4 info-tooltip"><img src="<?php echo DOMAINAD?>images/icons/success-icon.png" alt="Ngắt kích hoạt" /></a>
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
