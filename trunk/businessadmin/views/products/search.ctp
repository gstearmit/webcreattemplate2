<?php 
$select='Chọn danh mục';
$cat ='Tên bài viết';
$update='Cập nhật';
$back='Về trước';
$next='Tiếp theo';
if(isset($_GET['language'])){
	if($_GET['language']=='eng'){
		$select='Select Category';
		$cat ='Title article';
		$update='Update';
		$back='Back';
		$next='Next';
	}else {
		$select='Chọn danh mục';
		$cat ='Tên bài viết';
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
  <?php echo $form->create(null, array( 'url' => DOMAINADBUSINISS.'products/search','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?> 
     <fieldset class="search">
        <legend><?php __('Search')?></legend>
		<p style="text-align:center;">
        	<input type="text" id="field2c" name="keyword" class="text-search"><br/>
            <?php echo $this->Form->input('category_id',array('type'=>'select','options'=>$list_cat,'empty'=>$select,'class'=>'select-search','label'=>''));?>
        	<input type="submit" name="" value="<?php __('Search')?>" class="button" />
       	</p>
    </fieldset>
     <?php echo $form->end(); ?>
<div class="content-box">
    <div class="content-box-header">
        
        <h3><?php __('Product_list')?></h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab"><?php __('Product_list')?></a></li> 
            <li><a href="#tab2"></a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div>
    <div class="content-box-content">
        
        <div class="tab-content default-tab" id="tab1"> 
            <table>
                <form action="<?php echo DOMAINADBUSINISS; ?>products/processing" name="form1" method="post">
                <thead>
                    <tr>
                       <th><input class="check-all" name="checkall" type="checkbox" /></th>
                       <th><?php __('No.')?></th>
                       <th><?php echo $this->Paginator->sort($cat,'id');?></th>
                      <!-- <th>Danh mục cha</th> -->
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
                   <?php  foreach ($product as $key =>$value){?>
                    <tr>
                        <td><input type="checkbox" /></td>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td> <?php echo $html->link( $value['Eshopdaquyproduct']['title'], '/products/view/'.$value['Eshopdaquyproduct']['id']);?></td>
                        <!-- <td><?php  //echo $value['Catproduct']['name'];?></td> -->
                        <td><?php echo date('d-m-Y', strtotime($value['Eshopdaquyproduct']['created'])); ?></td>
                        <td>
                           <?php if($value['Eshopdaquyproduct']['status']==0){?>
                                 <a href="<?php echo DOMAINADBUSINISS?>products/edit/<?php echo $value['Eshopdaquyproduct']['id'] ?>" title="Edit"><img src="<?php echo DOMAINADBUSINISS?>images/icons/pencil.png" alt="Edit" /></a>
                                 <a href="javascript:confirmDelete('<?php echo DOMAINADBUSINISS?>products/delete/<?php echo $value['Eshopdaquyproduct']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINADBUSINISS?>images/icons/cross.png" alt="Delete" /></a> 
                                 <a href="<?php echo DOMAINADBUSINISS?>products/active/<?php echo $value['Eshopdaquyproduct']['id'] ?>" title="Kích hoạt" class="icon-5 info-tooltip"><img src="<?php echo DOMAINADBUSINISS?>images/icons/Play-icon.png" alt="Kích hoạt" /></a>
                            <?php } else {?>
                                 <a href="<?php echo DOMAINADBUSINISS?>products/edit/<?php echo $value['Eshopdaquyproduct']['id'] ?>" title="Edit"><img src="<?php echo DOMAINADBUSINISS?>images/icons/pencil.png" alt="Edit" /></a>
                                 <a href="javascript:confirmDelete('<?php echo DOMAINADBUSINISS?>news/delete/<?php echo $value['Eshopdaquyproduct']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINADBUSINISS?>images/icons/cross.png" alt="Delete" /></a> 
                                 <a href="<?php echo DOMAINADBUSINISS?>products/close/<?php echo $value['Eshopdaquyproduct']['id'] ?>" title="Đóng" class="icon-4 info-tooltip"><img src="<?php echo DOMAINADBUSINISS?>images/icons/success-icon.png" alt="Ngắt kích hoạt" /></a>

                            <?php }?>
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


