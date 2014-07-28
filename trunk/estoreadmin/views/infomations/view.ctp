
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
 <div id="news">
  <div id="title-news"><p>Chi tiết tin</p></div>
     <div class="list-news">
    
        <?php 
        ?>
            <?php echo $form->create(null, array( 'url' => DOMAINAD.'news/add','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>     
            <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">		
			
              <tr>
                <td width="250">Tên khách hàng</td>
                <td colspan="3">                      
                     <?php echo $views['Infomation']['name']?>
                </td>
              </tr>
              <tr>
                <td width="250">Số điện thoại</td>
                <td colspan="3">                      
                     <?php echo $views['Infomation']['mobile']?>
                </td>
              </tr>
              <tr>
                <td width="250">Địa chỉ</td>
                <td colspan="3">                      
                     <?php echo $views['Infomation']['address']?>
                </td>
              </tr>
              <tr>
                <td width="250">Email</td>
                <td colspan="3">                      
                     <?php echo $views['Infomation']['email']?>
                </td>
              </tr>
             
			<tr><td colspan="4"><b><h3>THÔNG TIN ĐƠN HÀNG</h3></b></td></tr>
			
			<tr>			
				<td>Tên sản phẩm</td>				
				<td>Ảnh sản phẩm</td>				
				<td>Số lượng</td>				
				<td>Giá</td>				
			</tr>
			<?php foreach($information as $view){?>
			<tr>
				<td><?php echo $view['Infomationdetail']['name'];?></td>							
				<td><img width="100" src="<?php echo DOMAINAD;?><?php echo $view['Infomationdetail']['images'];?>" /></td>				
				<td><?php echo $view['Infomationdetail']['quantity']?></td>				
				<td><?php echo $view['Infomationdetail']['price']?></td>				
			</tr>
			<?php }?>
			 <tr>
                <td width="250">Tổng tiền</td>
                <td colspan="3">                      
                     <?php echo $views['Infomation']['total']?>
                </td>
              </tr>
              
<!--
              <tr>
                <td width="250">Tổng tiền</td>
                <td>                      
                     <?php echo $views['Infomation']['total']?>
                </td>
              </tr>
              <tr>
                <td width="250">Tên khách hàng</td>
                <td>                      
                     <?php echo $views['Infomation']['name']?>
                </td>
              </tr>
              <tr>
                <td width="250">Số điện thoại</td>
                <td>                      
                     <?php echo $views['Infomation']['mobile']?>
                </td>
              </tr>
              <tr>
                <td width="250">Địa chỉ</td>
                <td>                      
                     <?php echo $views['Infomation']['address']?>
                </td>
              </tr>
              <tr>
                <td width="250">Email</td>
                <td>                      
                     <?php echo $views['Infomation']['email']?>
                </td>
              </tr>
              <tr>
                <td width="250">Tên chú rể</td>
                <td>                      
                     <?php echo $views['Infomation']['fullname_male']?>
                </td>
              </tr>
              <tr>
                <td width="250">Tên cô dâu</td>
                <td>                      
                    <?php echo $views['Infomation']['fullname_female']?> 
                </td>
              </tr>
              <tr>
                <td width="250">Tiêu đề ăn hỏi</td>
                <td>                      
                    <?php echo $views['Infomation']['title_question']?>
                </td>
              </tr>
               <tr class="alternate-row">
                <td width="100">Tiêu đề cưới</td>
                <td>
                   <?php 
				        echo $views['Infomation']['wedding_title'];

					  ?> 
                </td>
              </tr>
              <tr class="alternate-row">
                <td width="100">Yêu cầu khác</td>
                <td>
                   <?php 
				        echo $views['Infomation']['orther'];

					  ?> 
                </td>
              </tr>
-->
			
             <tr>                 
                 <td colspan="2"><input class="submit" type="button" name = "" value="Quay lại" onclick ="javascript: window.history.go(-1);" /></td>
                
            </tr>
            </table>
            <!--  end product-table................................... -->
          <?php echo $form->end(); ?>
  </div>
</div>       