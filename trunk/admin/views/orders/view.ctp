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
  <div id="title-new"><p>Chi tiết đặt hàng</p></div>
     <div class="list-new">
    
        <?php
            echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
        ?>
            <?php echo $form->create(null, array( 'url' => DOMAINAD.'Orders/add','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>     
            <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
              <tr>
                <td width="250">Tên khách hàng</td>
                <td>                      
                     <?php echo $views['Order']['name']?>
                </td>
              </tr>
			   <tr>
                <td class="alternate-row">Địa chỉ</td>
                <td>                      
                     <?php echo $views['Order']['address'] ?>
                </td>
              </tr>
              
			    <tr >
                <td width="100">Email</td>
                <td ><?php echo $views['Order']['email']; ?></td>
              </tr>
		
              <tr >
			    <td class="alternate-row">Số điện thoại </td>
				                <td>                      
			  <?php 
			  echo $views['Order']['phone'];
			 ?>

                </td>
			  
              
               <tr >
                <td width="100">Ngày đặt</td>
                <td ><?php echo $views['Order']['created']; ?></td>
              </tr>
		
              <tr >
			    <td class="alternate-row">Tên sản phẩm </td>
				                <td>                      
			  <?php 
			  echo $views['Order']['product_title'];
			 ?>

                </td>
              </tr>
             
              <tr>
                <td >Số lượng</td>
                <td>
                  <?php echo $views['Order']['soluong'];?>
                </td>
              </tr>
			  
			   
              <tr >
                <td class="alternate-row">Tổng tiền</td>
                <td>
              	 <?php   echo $views['Order']['tongtien'];; ?>
						
                </td>
              </tr>
			   <tr >
                <td class="alternate-row">Hình thức thanh toán</td>
                <td>
              	 <?php   echo $views['Order']['hinhthucthanhtoan'];; ?>
						
                </td>
              </tr>
			   <tr >
                <td class="alternate-row">Thanh toán:</td>
                <td>
              	 <?php   if($views['Order']['status']) echo "Đã thanh toán"; else echo "Chưa thanh toán"; ?>
						
                </td>
              </tr>
              
               <tr>
                <td >Trạng thái</td>
                <td>
                    <?php if($views['Order']['dagiaohang']==1){
                            echo 'Đã giao hàng';
                        }else echo 'Chưa giao hàng';?>
					
                </td>
              </tr>
			 
             <tr>                 
                 <td colspan="2"><input class="submit" type="button" name = "" value="Quay lại" onclick ="javascript: window.history.go(-1);" /></td>
                
            </tr>
            </table>
            <!--  end product-table................................... -->
          <?php echo $form->end(); ?>
  </div>
</div>       