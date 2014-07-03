 <link type="text/css" href="<?php echo DOMAIN ?>css/product.css" rel="stylesheet" /> 
 
 
 
 <link type="text/css" href="<?php echo DOMAIN ?>css/content.css" rel="stylesheet" /> 
  <link type="text/css" href="<?php echo DOMAIN ?>css/phantrang.css" rel="stylesheet" /> 
  

 <div id="main-content">
	 
	 <div class="content-top">

	 	<?php echo $this->element('menu_top');?>
	
	 <div class="content-top-body">
	 <h2 style="margin-left:20px;margin-top:20px;">Đơn đặt hàng của <?php $t=$this->Session->read('nameuser'); echo '"'.$t;?>" gồm <?php echo $result?> đơn</h2>
	 
	<table class="tb-datmua" cellspacing="0" cellspadding="0" style="background:white;">
	<tr>
		<th width="50px">Ngày đặt</th>
		<th width="200px">Tên sản phẩm</th>
		<th width="100px">Hình ảnh</th>
		<th width="100px;">Đơn giá</th>
		<th width="50px">Số lượng</th>
		<th width="100px">Thành tiền</th>
		<th width="100px">Trạng thái</th>
		<th width="100px">Thanh toán</th>
		<th width="150px">Hình thức</th>
		<th width="50px">Xử lý</th>
	</tr>
	<?php 
	
	
	foreach($order as $row){?>
	<tr>
	<td width="50px" style="text-align:left;"><?php
	$date=explode('-',$row['Order']['created']);
	echo $date[2].'-'.$date[1].'-'.$date[0];?></td>
	<td width="200px" style="text-align:left;"><?php echo $row['Order']['product_title'];?></td>
	<td width="100px" style="text-align:left;"><?php 
	$prod=$this->requestAction('comment/get_product/'.$row['Order']['product_id']);
	 $images=$prod['Product']['images'];?>
	<img src="<?php echo DOMAINAD?>/timthumb.php?src=<?php echo $images;?>&amp;h=70&amp;w=100&amp;zc=1" alt="thumbnail" />
	</td>
		<td width="100px"><?php echo number_format($row['Order']['tongtien']/$row['Order']['soluong'],'0','.','.')."đ";?></td>
		<td width="50px"><?php echo $row['Order']['soluong'];?></td>
		<td width="100px"> 
		
	
					  
					 <label id="tien" style="color:#58595B; font-weight:bolder;font-size:13px;">
						<?php echo number_format($row['Order']['tongtien'],0,'.','.').'đ'; ?>
						</lable>
		</td>
		
		<td width="100px"><span style="font-size:13px; color:#58595B; font-weight:bolder;">
		<?php if($row['Order']['status']){?>
		Đã giao hàng 
		<?php } else { ?>
		Chờ giao
		<?php }?>
		</span></td>
	<td style="font-size:13px; color:#58595B; font-weight:bolder;" width="100px">
	<?php if($row['Order']['dagiaohang']==0) {?>
	Chưa thanh toán
	<?php } else {?>
	Đã thanh toán
	<?php }?>
	</td>
	<td width="150px"><span style="font-size:13px; color:#58595B; font-weight:bolder;"><?php  echo $row['Order']['hinhthucthanhtoan']; ?></span></td>
	
	<td  width="50px">  <a href="<?php echo DOMAIN?>product/delete/<?php echo $row['Order']['id'] ?>" title="Delete"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a> </td>
	
	</tr>
	
	
	
	
	<tr bgcolor="#EDEDEE">
	
	
	</tr>
	<?php }?>
	</table>
	
	
	       	<div class="pt">
              <div class="pt-pagi">
              
							<ul><li class="li-prev">
							     <?php 
							     echo $paginator->prev('<');?>
							     </li>
							     
							     <li class="pt-so">
							     
								<?php    echo $paginator->numbers();?>
								</li>
								<li class="li-next">
								<?php 
                                   echo $paginator->next('>'); 
              ?>	</li>
              </ul>
              </div><!-- End pt-pagi-->
           </div><!-- End pt-->
	
	 </div><!-- End content-top-body -->
	  
	 
	 
	 
	
	 <div class="bgbottom"></div>
	 </div><!-- End content-top -->

	  
</div><!-- ENd main content -->

 
 
 
 
 
 
 
 
 
 
 