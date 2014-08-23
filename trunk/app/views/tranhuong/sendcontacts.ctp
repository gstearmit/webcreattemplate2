<link href="<?php echo DOMAIN ?>webcreathtml/css/bootstrap.min.css" rel="stylesheet"> 
<script src="<?php echo DOMAIN ?>webcreathtml/js/bootstrap.js"></script>
<script src="<?php echo DOMAIN ?>webcreathtml/js/bootstrap.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('.close').click(function(){
			//alert("da duoc lcick");
			$('.bodymesage').css("display", "none");
		});
	});
	</script>
<?php 
//echo"vieeeeeee";pr($shopname);die;
?>
<style>
  #goi-thieu h1,h2,h3{
	  font-size:12px;
	  font-weight:normal;
	  }

    #main-register input, .text-main input {
    border: 1px solid #CCC;
    border-radius: 5px;
    }
    input {
    padding: 1px;
    margin-bottom: 10px;
    font-size: 14px;
    color: #333;

}
</style> 
 <?php //if($session->read('lang')==1){?>
<div id="main-center">
<div id="sanphams" style=";min-height: 668px !important;">
    	<div class="top"></div>
       <div class="title-content"> <p>Liên hệ </p></div>
    	
        <div class="m3">            
             <div class="clearfix"> 		                   
                <div class="roundBoxBody">
                           <div style="width: 400px; margin: 0 auto;">
                             <?php //echo $this->Html->css('validationEngine.jquery');?>
                                <link rel="stylesheet" type="text/css"  href="<?php echo DOMAIN ?>daquybusniss/css/validationEngine.jquery.css" />
								<!--  
								<script type="text/javascript" src="<?php echo DOMAIN;?>js/jquery.validationEngine.js"></script>
								<script>
								  $(document).ready(function(){
								    $("#check_formnew").validationEngine();
								  });
								</script>
								-->
								 <?php // if($session->read('lang')==1){?>
								 <br /><br /><br />
								<form method="post" id="check_formnew" action="<?php echo DOMAIN.$shopname; ?>/sendcontacts" style=";">
								    <table class="guimail" align="left" width="600px">
								        <tr><td>Tên </td><td><input size="40" id="input" name="name" class="validate[required]" type="text"></td></tr>
								        <tr><td>Điện thoại</td><td><input size="40" id="input" type="text" class="validate[required,custom[telephone]]" name="phone"></td></tr>
								        <tr><td>Email</td><td><input size="40" id="input" type="text"  class="validate[required,custom[email]]" name="email"></td></tr>
								        <tr><td>Tiêu đề</td><td><input size="40" id="input" type="text" class="validate[required]" name="title"></td></tr>
								        <tr><td>Nôi dung</td><td><textarea name="content" cols="45" rows="10"></textarea></td></tr>
								        <tr><td></td><td><input type="submit" value=" Gửi đi ">&nbsp;<input type="reset" value=" Soạn lại "></td></tr>
								    </table>
								</form>
								 <?php //}
								 if($session->read('lang')==2){?>
								 <form method="post" id="check_form" action="<?php echo DOMAIN; ?>contacts/send">
								    <table class="guimail" align="left" width="600px">
								        <tr><td>Full name</td><td><input id="input" name="name" class="validate[required]" type="text"></td></tr>
								        <tr><td>Phone</td><td><input id="input" type="text" class="validate[required,custom[telephone]]" name="phone"></td></tr>
								        <tr><td>Email</td><td><input id="input" type="text"  class="validate[required,custom[email]]" name="email"></td></tr>
								        <tr><td>Title</td><td><input id="input" type="text" class="validate[required]" name="title"></td></tr>
								        <tr><td>Content</td><td><textarea name="content" cols="45" rows="10"></textarea></td></tr>
								        <tr><td></td><td><input type="submit" value=" Send ">&nbsp;<input type="reset" value=" Reset "></td></tr>
								    </table>
								</form>
								 <?php }?>
                        </div>
                </div>                  
             </div>            
             <div class="clearfix"></div>
        </div> 
        <div class="b3"><div class="b3"><div class="b3"></div></div></div>
    </div>
</div>
 <?php // }
 if($session->read('lang')==2){?>
 <div id="sanphamchitiet">
    <div class="top">Contact us
        </div>
        <div class="m3">            
             <div class="clearfix"> 		                   
                <div class="roundBoxBody">

                           <div style="width: 400px; margin: 0 auto;">
                             <?php //echo $this->element('plugin/plugin-contac');?>
                        </div>
                </div>                  
             </div>            
             <div class="clearfix"></div>
        </div> 
        <div class="b3"><div class="b3"><div class="b3"></div></div></div>
    </div>
 <?php }?>

 <?php

if( $message=="succesfuly")
{
?>

<div class="bodymesage">
	<a ><div class="opacity_cart"></div><a>
    <div class"body_cart" style="background-color: #ffffff; border-radius: 8px;box-shadow: 5px 5px 10px #666;height: 25%; margin-left: 18%; padding: 1.5% 1.5% 1.5% 10px;  position: fixed;  top: 50%;  width: 37%; z-index: 99999;">
        <a><button type="button" class="close" data-dismiss="modal">
    		<span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></a>
    		<h4 style="margin-top: -2%;margin-left: auto;text-align: center;"><span style="color:red;font-weight:bold">Gửi liên hệ thành công!</span></h4>

    		<div class="thongbao" style="font-size:13px;margin-top: -2px;text-align: center;">
    			<p> <strong> Cảm ơn bạn đã gửi góp ý hoặc liên hệ </strong></p>
	    		
    			<p>Thông Tin của bạn sẽ được phản hồi sớm !!!</p>
	    		
	    		<p class="mesage">Mọi thắc mắc xin vui lòng liên hệ với ban quản trị!</p>
	    	</div>
	</div>
</div>	

<?php }
 else if(isset($message) && $message!="succesfuly" && $message!=""){?>
	<div class="bodymesage">
	<a ><div class="opacity_cart"></div><a>
    <div class"body_cart" style="background-color: #ffffff; border-radius: 8px;box-shadow: 5px 5px 10px #666;height: 25%; margin-left: 18%; padding: 1.5% 1.5% 1.5% 10px;  position: fixed;  top: 50%;  width: 37%; z-index: 99999;">

    		<a><button type="button" class="close" data-dismiss="modal">
    		<span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></a>
    		<h4 style="margin-top: -2%;margin-left: auto;text-align: center;"><span style="color:red;font-weight:bold">Gửi liên hệ Không thành công!</span></h4>

    		<div class="thongbao" style="font-size:13px;margin-top: -2px;text-align: center;">
    			<p> <strong>Thông Tin Gửi liên hệ của bạn bi lôi. Vui Lòng Thử lại !. Cảm ơn bạn đã gửi góp ý hoặc liên hệ </strong></p>
	    		
    			<p>Thông Tin của bạn sẽ được phản hồi sớm !!!</p>
	    		
	    		<p class="mesage">Mọi thắc mắc xin vui lòng liên hệ với ban quản trị!</p>
	    	</div>
	</div>
   </div>	

<?php
 }else echo $message;

?>


