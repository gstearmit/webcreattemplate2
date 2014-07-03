 <style>
 table{
	 text-align:left !important;
	 border:1px solid #999 !important;
	 }
 table td{
	 border:1px solid #999 !important;
	 padding-left:20px;
	 }
</style>
 <div id="new">
  <div id="title-new"><p>Chi tiết Shop</p></div>
     <div class="list-new">
    
        <?php
            echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
        ?>
            <?php echo $form->create(null, array( 'url' => DOMAINAD.'shops/add','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>     
            <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
              <tr>
                <td width="250">Tên shop</td>
                <td>                      
                     <?php echo $views['Shop']['name']?>
                </td>
              </tr>
			   <tr>
                <td class="alternate-row">Gian hàng nổi bật</td>
                <td>                      
                     <?php if ($views['Shop']['name']) echo "YES"; else echo "NO"; ?>
                </td>
              </tr>
              
              
               <tr >
                <td width="100">Ngày tạo</td>
                <td ><?php echo $views['Shop']['created']; ?></td>
              </tr>
		
              <tr >
			    <td class="alternate-row">Họ tên </td>
				                <td>                      
			  <?php 
			  echo $views['Shop']['user_id'];
			  $cat= $this->requestAction('shops/get_userscms/'.$views['Shop']['user_id']);
			
			  foreach($cat as $cat){
			    echo $cat['Userscms']['name']; ?>
			
              

                   
                  
                    
                </td>
              </tr>
             
              <tr>
                <td >Email</td>
                <td>
                <?php echo $cat['Userscms']['email']; ?>
                </td>
              </tr>
			  
			   
              <tr >
                <td class="alternate-row">Điện thoại</td>
                <td>
              	 <?php echo $cat['Userscms']['phone']; ?>
						
                </td>
              </tr>
               <tr>
                <td >Giới tính</td>
                <td>
					<?php if($cat['Userscms']['sex']==1) echo "Nam"; else echo "Nữ"; ?>
				</td>
              </tr>
               <tr  >
                <td class="alternate-row">Ngày đăng ký</td>
                <td>                      
                     <?php echo $cat['Userscms']['created'];?>
                </td>
              </tr>
              
               <tr>
                <td >Trạng thái</td>
                <td>
                    <?php if($cat['Userscms']['status']==1){
                            echo 'Đã active';
                        }else echo 'Chưa ative';?>
                </td>
              </tr>
			  <?php }?>
             <tr>                 
                 <td colspan="2"><input class="submit" type="button" name = "" value="Quay lại" onclick ="javascript: window.history.go(-1);" /></td>
                
            </tr>
            </table>
            <!--  end product-table................................... -->
          <?php echo $form->end(); ?>
  </div>
</div>       