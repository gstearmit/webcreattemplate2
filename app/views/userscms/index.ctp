<style>
  #uploadcontent {
    color: #333333;
    height: 20px;
	float:right;
    width: 372px;
}
#uploadcontent a {
    color: #258294;
    text-decoration: none;
}

.right table span{
	padding-left:0px !important;
	padding-top:4px;
	}
	input{padding:2px;}
h3.page-title, h2.title-backend {
    border-bottom: 1px solid #EA6F1F;
    color: #222222;
    font-size: 18px;
    font-weight: normal;
    margin-bottom: 20px;
    padding-bottom: 8px;
    position: relative;
    text-transform: uppercase;
}
td{padding-top:5px;}
</style>
<?php echo $javascript->link('jquery.validate', true); ?>
<script type="text/javascript" src="<?php echo DOMAIN;?>js/jquery.datepick.js"></script>
<script type="text/javascript" src="<?php echo DOMAIN;?>js/checkform.js"></script>
<script>
function reload()
{
	var random1= Math.random()*5
	jQuery.ajax({
		type: "GET", 
		url: "<?php echo DOMAIN;?>"+'userscms/create_image2/'+random1,
		data: null,
		success: function(msg){	
			//alert(msg);return;
		jQuery('#capterchar').find('img').remove().end();
		 jQuery('#capterchar').append('<img alt="" id="captcha" src="<?php echo DOMAIN?>userscms/create_image2/'+random1+'" />');				
		}
	});	
}


$(function() {
	$('.popupDatepicker').datepick();
	
});



</script>

 <style>
 p{text-align:justify;}
 
 </style>
 
  <link type="text/css" href="<?php echo DOMAIN ?>css/jquery.datepick.css" rel="stylesheet" /> 
 <link type="text/css" href="<?php echo DOMAIN ?>css/content.css" rel="stylesheet" /> 
  <link type="text/css" href="<?php echo DOMAIN ?>css/phantrang.css" rel="stylesheet" /> 
 
  
 <div id="main-content">
	 
	 <div class="content-top">
	 <?php echo $this->element('menu_top');?>
	 <div class="content-top-body">
	 		<form method="post" action="<?php echo DOMAIN?>userscms/add"  id="myform" name="image" enctype="multipart/form-data">
<div class="member_register">
            	<div class="left">
                	<h3 class="title">Đăng ký thành viên</h3>
                    <div>
                    	<p><b>Là 1 thành viên của CHOGIARE bạn có thể: </b></p>
                        <ul>
							<?php $setting = $this -> requestAction('/comment/setting');?>
<?php foreach($setting as $settings){
echo $settings['Setting']['about'];
?>
		

                        </ul>
                    </div>
                    <h3 class="title">Đăng ký dành cho cửa hàng</h3>
                    <div>
                        <ul>
							<?php echo  $settings['Setting']['about_eg']; ?>
							
                        </ul>
                    </div>
					<?php }?>
                </div>
                <div class="right">
                	<h3 class="page-title">Đăng ký thành viên</h3>
                    <table>
                    	<tr>
                        	<td align="left" width="30%" valign="top" style="padding-top:6px;">
								Tên đăng nhập <font color="red">(*)</font>
							</td>
                            <td align="left" width="70%">
                            	<input type="text" class="textField" name="shopname" id="nickname" style="width:200px;" class="text-input-register">
								<div><span id="val_nickname"><div id="nickname1"></div>
								<span class="lbComment">Tên đăng nhập phải là  các ký tự 0-9,_,a-z</span>
								<span class="lbComment">Nếu bạn đăng ký cửa hàng, bạn nên chọn tên đăng nhập là tên công ty bạn.</span></span>
								</div>
							</td>
                        </tr>
                        <tr>
                        	<td align="left">
								Mật khẩu<font color="red">(*)</font>
							</td>
                            <td>
                            	<input id="password" class="textField" name="password" type="password" style="width:200px;" class="text-input-register"/>
                            </td>
                        </tr>
                        <tr>
                        	<td align="left">
								Xác nhận mật khẩu<font color="red">(*)</font>
							</td>
                            <td>
                            	<input id="confirm_password" class="textField" name="confirm_password" type="password" class="text-input-register" style="width:200px;"/>
                            </td>
                        </tr>
                        <tr>
                        	<td align="left">
								Họ tên<font color="red">(*)</font>
							</td>
                            <td>
                            	<input id="name" class="textField" name="name" type="text" style="width:200px;" class="text-input-register"/>
                            </td>
                        </tr>
                        <tr>
                        	<td align="left">
								Email<font color="red">(*)</font>
							</td>
                            <td>
                            	<input name="email" type="text" style="width:200px;" id="register-email" class="text-input-register textField"/>
                                <div id="validate-emai-register"><span id="error"></span></div>
                            </td>
                        </tr>
						<tr>
                        	<td align="left">
								Số điện thoại
							</td>
                            <td>
                            	<input id="phone" class="textField" name="phone" type="text" style="width:200px;"/>
                            </td>
                        </tr>
                        <tr>
                        	<td align="left">
								Địa chỉ
							</td>
                            <td>
                            	<input id="yahoo" class="textField" name="address" type="text" style="width:200px;"/>
                            </td>
                        </tr>
                        
                        <tr>
                        	<td align="left">
								Giới tính
							</td>
                            <td>
                            	<select size="1" name="sex" id="sex" title="Giơi thính" style="width:123px;">
                                    <option selected="selected" value="-1" title="- Chọn -">-- Giới tính --</option>
                                    <option value="1" title="Nam">Nam</option>
                                    <option value="0" title="Nữ">Nữ¯</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                        	<td align="left">
								Ngày sinh
							</td>
                            <td>
                             <?php
                          	   $date=date('d-m-Y');
                       		 ?>
                          <input type="text" value="<?php echo $date;?>" name="date" class="popupDatepicker datepicker" style="width:200px;"/>
                            </td>
                        </tr>
                        <tr>
                        	<td align="left">
								Tỉnh/TP
							</td>
                            <td>
                            	<select name="city" id="tinhthanh">
                                    <option value="0"> -- Chọn tỉnh -- </option>
                                    <?php foreach($city as $citys){?>
                                     <option value="<?php echo $citys['City']['id'];?>"><?php echo $citys['City']['name'];?></option>
                                    <?php }?>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <table width="400" align="center" style="padding-top:20px;margin:auto;">
						<tr>
							<td colspan="2">
                            <p><input type="checkbox" name="mainForm:agreeTerm" id="mainForm:agreeTerm"> Chấp nhập các điều khoản thành viên trên Creat Website</p>
                            <p style="padding-left:20px; padding-top:5px;">
                            (<a href="#">Xem điều khoản thành viên</a>)
                            </p>
							</td>
						</tr>
						<!-- 
						<tr>
							<td align="left" width="120">
								Nhập mã an toàn 
								<input type="text" style="width: 100px;" class="textField" name="security" id="security">
							</td>	
							<td align="left" width="100">
                              <a id="capterchar">
                               <img alt="" id="captcha" src="<?php echo DOMAIN?>userscms/create_image" />
                               </a>
                               &nbsp;&nbsp;<a href="javascript: reload()"><img src="<?php echo DOMAIN?>images/change-image.gif"/>
                             </a>
							</td>
						</tr>
						-->
						
						<tr>
							<td colspan="2" align="center">
                            	<br />
                            	<input type="submit" name="btsub" value="Đăng ký" />
							</td>
						</tr>
					</table>
                </div>
                <div class="clr"></div>
            </div>
</form>
	 
	 		
	</div><!-- End content-top-body -->
	</div><!-- End content-top -->
	 
	 
	 </div><!-- ENd main content -->





