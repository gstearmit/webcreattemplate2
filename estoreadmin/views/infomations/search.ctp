
<script>
function confirmDelete(delUrl)
{
if (confirm("Bạn có muốn xóa danh mục này không!"))
{
	document.location = delUrl;
}
}
</script>
 <?php echo $form->create(null, array( 'url' => DOMAINAD.'infomations/search','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?> 
     <fieldset class="search">
        
        <legend>Tìm kiếm</legend>
        <div class="field">
            <label for="field2c">Tiêu đề</label>
            <input type="text" id="field2c" name="name_search" class="text-search">
        </div>
        <p style="text-align:center;"> <input type="submit" name="" value="Tìm kiếm" class="button" /></p>
       
    </fieldset>
     <?php echo $form->end(); ?>
<div class="content-box">
    <div class="content-box-header">
        
        <h3>Danh sách đơn hàng</h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Danh sách tin</a></li> 
            <li><a href="#tab2"></a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div>
    <div class="content-box-content">
        
        <div class="tab-content default-tab" id="tab1"> 
            <table>
                 <form action="<?php echo DOMAINAD; ?>infomations/processing" name="form1" method="post">
                <thead>
                    <tr>
                       <th><input class="check-all" name="checkall" type="checkbox" /></th>
                       <th>STT</th>
                       <th>Tên khách hàng</th>
                       <th>Điện thoại</th>
                       <th>Địa chỉ</th>
                       <th>Xử lý</th>
                    </tr>
                </thead>
             
                <tfoot>
                    <tr>
                        <td colspan="6">
                           <div class="bulk-actions align-left">
                                <select name="dropdown">
                                    <option value="option1">Lựa chọn</option>

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
                  <?php  foreach ($infomations as $key =>$value){?>
                    <tr>
                        <td><input type="checkbox" name="<?php echo $value['Infomation']['id'] ?>" /></td>
                        <td><?php $j=$key+1; echo $j;?></td>
                        <td>
                            <?php echo $html->link( $value['Infomation']['name'], '/infomations/view/'.$value['Infomation']['id']);?>
                        </td>
                        <td><?php  echo $value['Infomation']['mobile'];?></td>
                        <td><?php  echo $value['Infomation']['address'];?></td>
                        <td>
                             <a href="javascript:confirmDelete('<?php echo DOMAINAD?>infomations/delete/<?php echo $value['Infomation']['id'] ?>')" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a> 
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


