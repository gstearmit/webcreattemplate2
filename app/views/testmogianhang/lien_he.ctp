<?php 
			
			$shop=explode('/',$this->params['url']['url']); 
			$shopname=$shop[0];
				$shop=$this->requestAction('comment/get_shop_id/'.$shopname);
				
				
				foreach($shop as $key=>$value){
				$shop_id=$key;
				}
			
			?>
	<script src="<?php echo DOMAIN?>js/jquery-latest.js" type="text/javascript"></script>		
<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN?>/css/validationEngine.jquery.css" />
<script type="text/javascript" src="<?php echo DOMAIN?>/js/jquery.validationEngine.js"></script>
<script>
  $(document).ready(function(){
    $("#check_form").validationEngine();
  });
</script>


 <style>
   .guimail{
	   width:80%;
	   padding-left:20px;
	   padding-bottom:30px;
	   }
    #input{
		width:250px;
		border: 1px solid #C2C2C2;
		height:22px;
		}
   .guimail tr td{
	   padding-top:10px;
	   
	   }
	.guimail textarea{
		border: 1px solid #C2C2C2;
		}
	.label {
    color: #0078AE;
}
.label {
    color: #0078AE;
}
.lbBold {
    font-size: 12px;
    font-weight: bold;
}
.dongke {
    border: 1px solid #77D5F7;
    color: #FFFFFF;
    font-weight: normal;
    margin: auto;
    width: 96%;
	margin-bottom:20px;
}
</style>
			
  <div id='content'>
            <div id='main-promotion'>
                <div class='promotions'>
                    <h2>Liên hệ</h2>
					  
					  	<div class="list-text">
             <table style="padding-left:10px; padding-top:20px;" width="100%">
					<?php foreach($infomationshop as $infomationshops){?>
                    <tr>
						<td align="left" colspan="2">
							<span class="lbBold label">Thông tin nhà cung cấp</span>
						</td>
					</tr>
					<tr>
						<td width="130" align="left">
							Tên Doanh Nghiệp
						</td>
						<td align="left">
							<?php echo $infomationshops['Shop']['namecompany'];?>
						</td>
					</tr>
					<tr>
						<td align="left">
							Địa chỉ
						</td>
						<td align="left">
							<?php echo $infomationshops['Shop']['address'];?> - <?php echo $infomationshops['Shop']['namecity'];?>
						</td>
					</tr>
					<tr>
						<td align="left">
							Điện thoại
						</td>
						<td align="left">
							<?php echo $infomationshops['Shop']['phone'];?>
						</td>
					</tr>
					<tr>
						<td align="left">
							Email
						</td>
						<td align="left">
							<span class="nav">
								<?php echo $infomationshops['Shop']['email'];?>
							</span>
						</td>
					</tr>
					<tr>
						<td align="left">
							Website
						</td>
						<td align="left">
							<span class="nav">
								<a href="<?php echo $infomationshops['Shop']['link'];?>"><?php echo $infomationshops['Shop']['link'];?></a>
							</span>
						</td>
					</tr>
					
				  <?php }?>
                </table>
                <hr class="dongke" id="mainForm:j_idt300">
			 <form method="post" id="check_form" action="<?php echo DOMAIN.$shopname?>/send" >
                <table class="guimail" style="overflow:hidden;" width="100%">
                    <tr><td style="width:200px !important; overflow:hidden;text-align:right;">Họ tên ( <span style="color:red;">*</span>):</td>
					<td><input id="input" name="name" class="validate[required]" type="text"></td></tr>
                    <tr><td style="width:200px !important; overflow:hidden; text-align:right;">Điện thoại</td><td><input id="input" type="text" class="validate[required,custom[telephone]]" name="phone"></td></tr>
                    <tr><td style="width:200px !important; overflow:hidden;text-align:right;">Email ( <span style="color:red;">*</span>):</td><td><input id="input" type="text"  class="validate[required,custom[email]]" name="email"></td></tr>
                    <tr><td style="width:200px !important; overflow:hidden;text-align:right;">Tiêu đề ( <span style="color:red;">*</span>):</td><td><input id="input" type="text" class="validate[required]" name="title"></td></tr>
                    <tr><td style="width:200px !important; overflow:hidden;text-align:right;">Nôi dung ( <span style="color:red;">*</span>):</td><td><textarea name="content" cols="38" rows="10"></textarea></td></tr>
                    <tr><td></td><td><input type="submit" value=" Gửi đi ">&nbsp;<input type="reset" value=" Soạn lai "></td></tr>
                </table>
           </form>
		</div>
					  
			   
                <div class="clear"></div>
            </div><!--end #new-product-->
			</div>
        </div><!--end #content-->


