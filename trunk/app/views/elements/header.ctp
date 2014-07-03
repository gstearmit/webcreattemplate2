<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $setting = $this -> requestAction('/comment/setting');?>
<?php foreach($setting as $settings){?>
<link href="http://<?php echo $settings['Setting']['url'];?>/feed" title="<?php echo $settings['Setting']['title'];?> » Feed" type="application/rss+xml" rel="alternate">
<link href="http://<?php echo $settings['Setting']['url'];?>/comments/feed" title="<?php echo $settings['Setting']['title'];?> » Comments Feed" type="application/rss+xml" rel="alternate">
<link href="http://<?php echo $settings['Setting']['url'];?>" title="<?php echo $settings['Setting']['title'];?>" rel="index">
<meta content="<?php echo $settings['Setting']['keyword'];?>" name="keywords">
<meta content="<?php echo $settings['Setting']['description'];?>" name="description">
<title><?php echo $settings['Setting']['title'];?></title>

<meta content="noodp,noydir" name="robots">
<link href="<?php echo DOMAIN ?>images/logo.png" type="images/png" rel="icon">

<script src="<?php echo DOMAIN;?>js/jquery.min.js"></script>
<link type="text/css" href="<?php echo DOMAIN ?>css/header.css" rel="stylesheet" />
 <link type="text/css" href="<?php echo DOMAIN ?>css/content.css" rel="stylesheet" /> 
<script src="<?php echo DOMAIN?>js/jquery-latest.js" type="text/javascript"></script>
 <script>
	function test(){		
        emailRegExp = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.([a-z]){2,4})$/;
		var email = document.getElementById("txtdangky").value;
        if(!emailRegExp.test(email)){
			$('#test').html('Hãy nhập đúng email');	
			return false;			
            }
		else
		
			return true;
		
            }
			
</script>
<?php

echo $this->Html->css('visuallightbox');

echo $this->Html->css('colorbox');

?>

</head>
<?php


$bg=$settings['Setting']['image_body'];
 $d=explode('/',$this->params['url']['url']);

if($d[0]=='san-pham' && isset($d[1])){

$sp=$this->requestAction('product/get_sp/'.$d[1]);
foreach($sp as $sp){
$bg= $sp['Product']['background'];
}
}
?>
<body style="background:url('<?php echo DOMAINAD.$bg;?>') fixed;" >

	<div id="bor-header" style="background:url('<?php echo DOMAINAD.$settings['Setting']['image_header']?>')">
		<div id="header">
			<div class="tenct">
			<img src="<?php echo DOMAIN?>images/hoicho.png"/>
			
			</div><!-- End tenct -->
			<div class="slogan">
			<img src="<?php echo DOMAIN?>images/slogan.png"/>
			</div>
			
			<div class="dangky">
			
			
			<form action="<?php echo DOMAIN?>dang-ky-email" method="post" name="formdk" onsubmit="return test();">
				<input type="text" name="txtdk"  id="txtdangky" value="Đăng ký email để nhận giá trị tốt nhất" onclick="this.value=''" onblur="if (this.value == '')  {this.value = 'Đăng ký email để nhận giá trị tốt nhất';}"/>
				
				<input type="hidden" name="url" value="<?php echo $this->params['url']['url'];?>">
				<lable style="float:left; width:220px;margin-left:28px; overflow:hidden; margin-top:5px; color:red;" id="test">
				
				</lable>
				<br>
				<input type="submit" value="Đăng ký email" class="subdk" />
				
			</form>
			<p style="height:22px; text-align:center;margin-top:30px; margin-left:15px; color:white;">
			<?php
				//echo "test".$this->Session->read('nameuser') ; 
			if($this->Session->check('nameuser')==1){?>
			Xin chào: <span ><?php echo $this->Session->read('nameuser');?></span> |
			
			<a class="a-dangky" href="<?php echo DOMAIN?>don-hang">Đơn hàng</a> |
			<a  class="a-dangky" href="<?php echo DOMAIN?>login/logout">Thoát</a> 
			<?php } else {?>
			
			<a class="a-dangky" href="<?php echo DOMAIN?>dang-nhap"><?php __('signin') ?> </a> |
			<a class="a-dangky" href="<?php echo DOMAIN?>dang-ky"><?php __('register') ?></a>
			<?php }?>
			</p>
			</div>
			
		</div><!-- End header -->
    	
    </div><!--ENd bor header-->
 
<?php }?>
	
	
