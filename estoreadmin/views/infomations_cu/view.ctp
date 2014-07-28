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
            echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
        ?>
            <?php echo $form->create(null, array( 'url' => DOMAINAD.'news/add','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>     
            <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
            <tr>
                <td width="250">Ngày đặt</td>
                <td>                      
                     <?php echo $views['Infomation']['created']?>
                </td>
              </tr>
            <tr>
                <td width="250">Tên khách hàng</td>
                <td>                      
                     <?php echo $views['Infomation']['tenkhachhang']?>
                </td>
              </tr>
              <tr>
                <td width="250">Tên sản phẩm</td>
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
                <td width="250">Số lượng</td>
                <td>                      
                     <?php echo $views['Infomation']['number']?>
                </td>
              </tr>
              <tr>
                <td width="250">Đơn giá</td>
                <td>                      
                    <?php echo $views['Infomation']['price']?> VNĐ
                </td>
              </tr>
              <tr>
                <td width="250">Giá được giám</td>
                <td>                      
                    <?php echo $views['Infomation']['discount']?> %
                </td>
              </tr>
               <tr class="alternate-row">
                <td width="100">Tổng số tiền</td>
                <td>
                   <?php 
				        $c=$views['Infomation']['number'];
						$a=$views['Infomation']['price'];
						$b=$views['Infomation']['discount'];
						$t=$c * $a;
						//echo ($b * $t);
						$tong = $t - (($b * $t)/100);
						echo ($tong);
					  ?> VNĐ
                </td>
              </tr>
               <tr>
                <td width="250">Tình trạng</td>
                <td>                      
                   <?php if($views['Infomation']['status']==0){?>
                    <?php echo "Đơn hàng chưa xử lý";?><br />
                    <a href="<?php echo DOMAINAD?>infomations/active/<?php echo $views['Infomation']['id'] ?>" title="Xử lý đơn hàng" class="icon-5 info-tooltip">Xử lý đơn hàng<img src="<?php echo DOMAINAD?>images/icons/Play-icon.png" alt="Xử lý đơn hàng" /></a>
                     <?php } else {?>
                   <?php echo "Đơn hàng đã xử lý";?>
                     <?php }?>
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