 <link type="text/css" href="<?php echo DOMAIN ?>css/content.css" rel="stylesheet" /> 

  <style type="text/css">
.d-d a:hover{
color:red;
}
.a-cuoi{color:#008301;}
.divnd{margin-left:10px;float:left;
overflow:hidden;}
.input{width:250px;}
.submit:hover{
cursor:pointer;
}
.content-nd{
padding-bottom:26px;
overflow:hidden;
}
#tttk{display:none;}

.a-huy{color:black; font-size:14px; font-weight:bold;padding: 0px 20px;
}
.a-huy:hover{text-decoration:underline; }
  </style>

   <?php echo $javascript->link('jquery.validate', true); ?>

   
   <script type="text/javascript">
$().ready(function() {
	// validate signup form on keyup and submit
	$("#ckform").validate({
		rules: {
				email: {
				required: true,
				email:true
				
						},
				name: {
				required: true,
				minlength: 5
						},
			
				
				phone: {
							required: true,
							number: true,
							minlength: 5
						},
			address: {
				required: true,
				minlength: 5
						}
	
		
		},
		messages: {
				name: {
				required: "<br><span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px; ' >Xin vui lòng nhập họ tên của bạn	</span>",
				minlength: "<br><span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px; ' > Họ tên phải ít nhất 5 ký tự!</span>"
			},
			
			
			email:{
					required: "<br><span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px; ' >Xin vui lòng nhập email của bạn!</span>",
						email: "<br> <span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px;' >Email không chính xác </span> "
						
			},
			
			phone: {
				required: "<br><span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px; ' >Xin vui lòng nhập điện thoại!</span>",
				
				number: "<br> <span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px;' >Số điện thoại phải là các số 0-9</span> ",
				minlength: "<br><span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px; ' > Họ tên phải ít nhất 5 ký tự!</span>"
			},
	
				address: {
				required: "<br><span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px; ' >Xin vui lòng nhập địa chỉ của bạn</span>",
				minlength: "<br><span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px; ' > Địa chỉ phải ít nhất 5 ký tự!</span>"
		
					}
			
			
			
		}
	});
	
	function tt(tien){
	var n=0;
	var t=0;
	var mang='';
	a=''+tien;
	


	//alert(tien.length);
	for(i=a.length-1;i>=0;i--){
	
	if(t==3){t=0;
	mang+='.';
	}
	t++;
	mang+=a[i];
	}
	n=0;var b='';
		for(i=mang.length-1;i>=0;i--){
		b+=mang[i];
		}
	return b+" đ";
	}
	
	$('#soluong').change(
	function(){
	
	var tien=$('#soluong').val() *$('#tt').val();
	
	$('#tien').html(tt(tien));
	
	}
	);
	
	
	
	$('')
	
});


</script>
   
 <script language="javascript" type="text/javascript">
$(document).ready(function(){
   $("#check1").click(function(){
     if($("#check1:checked").val()!=true){
	
         $('#tttk').show();
     }
	 
   });
   
    $(".check").click(function(){ 
	
	$('#tttk').hide();
	});
   
 });
 
</script>

 
 <div id="main-content">
 

   
	 
	 <div class="content-top">

	 	<?php echo $this->element('menu_top');?>
	
	 <div class="content-top-body">
	  <div class="d-d">
	 <?php foreach($product as $row){
	 	$id= $row['Product']['id'];
	 	?>
	 
	 <ul>
	 	<li class="li-dau"><a href="<?php echo DOMAIN?>">Trang chủ</a></li>
			<?php $cat=$this->requestAction('comment/get_name_catproduct/'.$row['Product']['catproduct_id']);
	 	foreach ($cat as $cat){ 
		if($cat['Catproduct']['id']==82){
		?>
	 	<li class="li-dau"><a href="<?php echo DOMAIN?>tieu-dung">
	 <?php
	 } else{?>
	 
	 <li class="li-dau"><a href="<?php echo DOMAIN?>du-lich">
	 <?php
	 }
	 		echo $cat['Catproduct']['name']; 
	 	}
	 	?>
	 	
	 	</a></li>
	 	<li ><a href="" class="a-cuoi"><?php echo $row['Product']['title']?></a></li>
	 </ul>
	 
	 </div><!--End d-d-->
	 
	 <div style="background:white;overflow:hidden;padding-bottom:20px;">
	 <div class="div-tit">
	 <p style="text-align:right;">
	 	<?php echo $row['Product']['title']?>:
	 </p>
	 </div>
	 
	  <div class="div-mota">
	  <p>
	  	<?php echo $row['Product']['content']?>
	 </p>
	 </div>
	 </div>
	 </div><!-- End content-top-body -->
	 
	 <div class="hang1">
	 <div class="div-datmua">
	<table width="100%" style="text-align:center;margin-top:10px;overflow:hidden;">
		<tr><td style="color:#fef500; text-align:center;overflow:hidden;"><span style="font-size:37px;font-weight:bold;">
		<?php echo number_format($row['Product']['price'],0,'.','.');?></span><span style="font-size:16px;">  vnđ</span></td></tr>
		<tr><td style="color:white;text-align:center;text-decoration: line-through;overflow:hidden;"><span style="font-size:22px;font-weight:bold;">
		<?php echo number_format($row['Product']['price_old'],0,'.','.');?></span><span style="font-size:16px;">  vnđ</span></td></tr>
		<tr><td style="padding-top:10px;overflow:hidden;">
			<a href=""><img src="<?php echo DOMAIN?>images/datmua.png"/></a></td>
		</tr>
		<tr><td style="font-size:14px; color:white; font-weight:bold;padding-top:16px;">
				<span style="width:40%; text-align:center;float:left;margin-left:25px;">
				
				<?php
					$ngay=explode('-',$row['Product']['date1']);
					$ngay1=explode('-',$row['Product']['date2']);
					$t=$ngay[2].'/'.$ngay[1].' - '.$ngay1[2].'/'.$ngay1[1];
					
				echo $t;?></span>
				<span style="width:40%; text-align:center;float:left;">
					<?php
					$ngay=explode('-',$row['Product']['date3']);
					$ngay1=explode('-',$row['Product']['date4']);
					$t=$ngay[2].'/'.$ngay[1].' - '.$ngay1[2].'/'.$ngay1[1];
					
				echo $t;?>
				</span>	</td>
		
		<tr><td style="font-size:18px; color:#efe601; font-weight:bold;">
				<span style="width:40%; text-align:center;float:left;margin-left:25px;">
					<?php 
	 			echo number_format($row['Product']['price1'],0,'.','.');
	 			?>
				
				</span>
				<span style="width:40%; text-align:center;float:left;">
					<?php 
	 			echo number_format($row['Product']['price2'],0,'.','.');
	 			?>
				</span>
		</td>
		</tr>
		
		<tr><td style="font-size:24px;  font-weight:bold;padding-top:27px;">
				<span style="width:36%; text-align:center;float:left;color:#7c7c7c;margin-left:33px;"><?php echo $row['Product']['daban']?></span>
				<span style="width:36%; text-align:center;float:left;color:#e56b1f;margin-left:13px;"><?php echo $row['Product']['conlai']?></span>
		</td>
		</tr>
	</table>
	 
	 </div><!-- End div-datmua-->


	 
	
						<div class="divnd">
	 

	 					<h2>ĐẶT HÀNG</h2>
					
	 					<div class="content-nd">
	 	  <form class="cmxform" id="ckform" method="POST" action="<?php echo DOMAIN?>product/xuly">
	
	
					<table style="float:left; width:290px; overflow:hidden;">
						<tr><td colspan="2" style="color:red;font-size:14px;"> Chọn hình thức thanh toán</td></tr>
						<tr>
						<td style="padding-top:10px;"><input class="check" type="radio" name="hinhthucthanhtoan" value="Thanh toán và nhận hàng trực tiếp tại văn phòng công ty" checked >
							
						</td>
						<td ><p style="width:250px;">Thanh toán và nhận hàng trực tiếp tại văn phòng công ty</p></td>
						</tr>
						<tr>
						<td><input class="check" type="radio"  name="hinhthucthanhtoan" value="Giao hàng và thanh toán" ></td>
						<td>Giao hàng và thanh toán</td>
						</tr>
						<tr>
						<td>
					<input type="radio" id="check1" name="hinhthucthanhtoan" value="Thanh toán chuyển khoản qua ngân hàng" >
						</td>
						<td>Thanh toán chuyển khoản qua ngân hàng</td>
						</tr>
						<tr>
				<tr><td colspan="2" style="padding-top:10px;">
					<div id="tttk">
					<ul><li>
						Xin vui lòng chuyển đến số tài khoản sau: </li>
						<li>
						141 061 639</li>
						
						<li>
						Ngân hàng thương mại cổ phần á châu
						</li><li>
						Chi nhánh Bạch Mai
						</li>
						<li>
						Tên tài khoản: </li><li>Công ty cổ phần đầu tư Khang Tuấn</li></ul>
						
					</div>
				
					
					</td></tr>
					</table>
				
			<table class="guimail" style="float:left width:300px;">
					<?php 
							$name=$this->Session->read('nameuser');
							$user=$this->requestAction('comment/get_user/'.$name);
							
					
						?>
					<tr><td colspan="2" style="color:red;font-size:14px;"> Thông tin khách hàng</td></tr>
					
                    <tr><td>Họ và tên (<span style="color:red">*</span>): </td><td><input id="name" name="name" class="name input" value="<?php echo $user['Userscm']['shopname']?>" type="text">
						
					</td></tr>
					
					<tr><td>Email (<span style="color:red">*</span>):</td><td><input id="email" type="text" class="email input" name="email" value="<?php echo $user['Userscm']['email'];?>"></td></tr>
                      <tr><td>Số điện thoại(<span style="color:red">*</span>):</td><td><input id="phone" type="text" class="phone input" name="phone" value="<?php echo $user['Userscm']['phone'];?>"></td></tr>
					  <tr><td>Địa chỉ giao hàng(<span style="color:red">*</span>):</td><td>
					  <input id="input" type="address" class="address input" name="address" value="<?php echo $user['Userscm']['address']?>">
					  
					  </td></tr>
				
                     <tr><td>Số lượng (<span style="color:red">*</span>) :</td>
					 
					 <td><select name="soluong" style="width:50px;" id="soluong">
					 <?php for($i=1; $i<=$row['Product']['conlai']; $i++){?>
						<option><?php echo $i;?></option>
						<?php }?>
						
					 </select>
			
					 </td></tr>
					 <tr><td>Tiền phải trả:</td>
					 <td>
					 
					 <?php 
					$tien=$row['Product']['price'];
	 				$ngay1 =  explode('-',$row['Product']['date1']);
	 				$date1=floor(mktime(0,0,0,$ngay1['1'],$ngay1['2'],$ngay1['0'])/86400);
					
					$ngay2 =  explode('-',$row['Product']['date2']);
	 				$date2=floor(mktime(0,0,0,$ngay2['1'],$ngay2['2'],$ngay2['0'])/86400);
					
					$ngay3 =  explode('-',$row['Product']['date3']);
	 				$date3=floor(mktime(0,0,0,$ngay3['1'],$ngay3['2'],$ngay3['0'])/86400);
					
					$ngay4 =  explode('-',$row['Product']['date4']);
	 				$date4=floor(mktime(0,0,0,$ngay4['1'],$ngay4['2'],$ngay4['0'])/86400);
					
	 				$now=floor(mktime()/86400);
					
	 			
	 				if($now>=$date1 && $now<=$date2){$tien=$row['Product']['price1'];}
	 				elseif ($now>=$date3 && $now<=$date4){$tien=$row['Product']['price2'];}
	 			
	 			
					 
					 ?>
					 <input type="hidden" id="tt" value="<?php echo $tien;?>"/>
					  
					 <label id="tien" style="color:red; font-weight:bold;">
						<?php echo number_format($tien,0,'.','.').' đ' ?>
						</lable>
					 </td>
					 
					 </tr>
                <input type="hidden" name="product_id" value="<?php echo $row['Product']['id']?>"/>
                   <input type="hidden" name="product_title" value="<?php echo $row['Product']['title']?>"/> 
				   
				   
				   <tr>
				   <td style=";padding-top:38px;"> <input type="submit" value=" ĐẶT HÀNG " class="submit"></td>
				   <td> <p style="margin-top:38px;"><a class="a-huy" href="<?php echo DOMAIN?>">Hủy đặt hàng</a></p></td>
				   </tr>
				   
                </table>
			 
			  
			  
                    
	 					
	 					</div><!-- end content-nd -->
	 					
	 			</div><!-- ENd divnd -->
	 	
	 		 </form>
	 <?php }?>
	 </div><!-- end hang1 -->
	 

	
	 <div class="bgbottom"></div>
	 </div><!-- End content-top -->
	 
	 

	  
</div><!-- ENd main content -->
