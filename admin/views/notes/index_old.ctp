﻿<script>
function confirmDelete(delUrl)
{
if (confirm("Bạn có muốn xóa danh mục này không!"))
{
	document.location = delUrl;
}
}
<?php 
		$select = 'Chọn danh mục';
		$name ='Tên bài viết';
		$date ='Ngày tạo';
		$next = 'Tiếp theo';
		$pre ='Về trước';
		if(isset($_GET['language'])){
			if($_GET['language']=='eng'){
				$select = 'Select Category';
				$date ='Creat date';
				$name ='News name';
				$next = 'Next';
				$pre ='Previous';
			}else {
				$select = 'Chọn danh mục';
				$date ='Ngày tạo';
				$next = 'Tiếp theo';
				$pre ='Về trước';
				$name ='Tên bài viết';
			}
		}

		?>
</script>
 <?php echo $form->create(null, array( 'url' => DOMAINAD.'notes/search','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?> 
     <fieldset class="search">
        
        <legend><?php __('search')?></legend>

        <div class="field required">
            <label for="field1c"><?php __('Category')?></label>
             <?php echo $this->Form->input('list_cat',array('type'=>'select','options'=>$list_cat,'empty'=>$select,'class'=>'select-search','label'=>''));?>
        </div>
        <div class="field">
            <label for="field2c"><?php __('Title')?></label>
            <input type="text" id="field2c" name="keyword" class="text-search">
        </div>
        <p style="text-align:center;"> <input type="submit" name="" value="<?php __('search')?>" class="button" /></p>
       
    </fieldset>
     <?php echo $form->end(); ?>
     
    
<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        
        <h3><?php __('News_list')?></h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab"><?php __('News_list')?></a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2"></a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        
        <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
            <table>
                 <form action="<?php echo DOMAINAD; ?>notes/processing" name="form1" method="post">
                <thead>
                    <tr>
                       <th><input class="check-all" name="checkall" type="checkbox" /></th>
                       <th><?php __('STT')?></th>
                       <th><?php echo $this->Paginator->sort($name,'id');?></th>
                       <th><?php __('Category')?></th>
					   <th></th>
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
                   <?php  
				  
				   foreach ($Notes as $key =>$value){
				   
				   ?>
                    <tr>
                        <td><input type="checkbox" name="<?php echo $value['Note']['id'] ?>" /></td>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td> <?php echo $html->link( $value['Note']['title'], '/notes/view/'.$value['Note']['id']);?></td>
                        <td>
						<?php  $cat= $this->requestAction('notes/get_name/'.$value['Note']['category_id']);
						//echo pr($cat);die;
						foreach($cat as $cat){
						echo $cat['Catproduct']['name'];
						
						}
						?>
						
						</td>
                        <td></td>
                        <td><?php echo date('d-m-Y', strtotime($value['Note']['created'])); ?></td>
                        <td>
                             <?php if($value['Note']['status']==0){?>
                             		 <a href="<?php echo DOMAINAD?>notes/edit/<?php echo $value['Note']['id'] ?>" title="Edit"><img src="<?php echo DOMAINAD?>images/icons/pencil.png" alt="Edit" /></a>
                              	    <a href="javascript:confirmDelete('<?php echo DOMAINAD?>Notes/delete/<?php echo $value['Note']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a> 
                           
                                 <a href="<?php echo DOMAINAD?>Notes/active/<?php echo $value['Note']['id'] ?>" title="Kích hoạt" class="icon-5 info-tooltip"><img src="<?php echo DOMAINAD?>images/icons/Play-icon.png" alt="Kích hoạt" /></a>
                            <?php } else {?>
                            		<a href="<?php echo DOMAINAD?>notes/edit/<?php echo $value['Note']['id'] ?>" title="Edit"><img src="<?php echo DOMAINAD?>images/icons/pencil.png" alt="Edit" /></a>
                             	  <a href="javascript:confirmDelete('<?php echo DOMAINAD?>Notes/delete/<?php echo $value['Note']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a> 
                           
                                 <a href="<?php echo DOMAINAD?>notes/close/<?php echo $value['Note']['id'] ?>" title="Đóng" class="icon-4 info-tooltip"><img src="<?php echo DOMAINAD?>images/icons/success-icon.png" alt="Ngắt kích hoạt" /></a>

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