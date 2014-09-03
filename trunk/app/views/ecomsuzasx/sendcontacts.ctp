<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN ?>clothingstore/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN ?>clothingstore/css/bootstrap-responsive.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN ?>clothingstore/css/font-awesome.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN ?>clothingstore/css/flexslider.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN ?>clothingstore/css/tfingi-megamenu-frontend.css" />


	<!-- Comment following two lines to use LESS -->
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN ?>clothingstore/css/core.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN ?>clothingstore/css/turquoise.css" id="color_scheme" />

	<!--
	<meta http-equiv="X-UA-Compatible" content="IE=7; IE=8" />-->
	<link rel="icon" href="favicon.ico" type="image/x-icon" />
	<link href="http://fonts.googleapis.com/css?family=Lato:300,300italic,400,400italic,700,700italic|Shadows+Into+Light" rel="stylesheet" type="text/css">
	
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
	<?php // sendcontacts?>
	<?php echo $this->Html->css('validationEngine.jquery');?>
	<script type="text/javascript" src="<?php echo DOMAIN;?>js/jquery.validationEngine.js"></script>
	<script>
	  $(document).ready(function(){
	    $("#check_form").validationEngine();
	  });
	</script>
	
	
	<!-- <link href="<?php echo DOMAIN ?>webcreathtml/css/bootstrap.min.css" rel="stylesheet">   -->
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
			
			$shop=explode('/',$this->params['url']['url']); 
			$shopname=$shop[0];
				$shop=$this->requestAction('comment/get_shop_id/'.$shopname);
				
				
				foreach($shop as $key=>$value){
				$shop_id=$key;
				}
			
?>

				               
				                 
				                        <div class="dsdsdss" style="
    margin-left: 5%;
    padding: 10px;
    width :600px;
">
				                            <form  id="check_form" action="<?php echo DOMAIN.$shopname; ?>/sendcontacts" method="post" class="wpcf7-form" novalidate="novalidate">
				                                <label>Your Name (required)</label>
				                                <input type="text"  id="input" name="name" class="validate[required]" type="text" value="" size="40"  aria-required="true" />
				                                <label>Your Email (required)</label>
				                                <input type="email" id="input" type="text"  class="validate[required,custom[email]]" name="email" value="" size="40" aria-required="true" />
				                                <label>Subject</label>
				                                <input type="text"  id="input" type="text" class="validate[required]" name="title" value="" size="40"  />
				                                <label>Your Message</label>
				                                <textarea  name="content" cols="40" rows="10" ></textarea>
				
				                                <input type="submit" value="Send" class="btn btn-primary" />
				                                <input type="reset" value="reset" class="btn btn-primary" />
				                            </form>
				                        </div>
				                 


 <?php

if( $message=="succesfuly")
{
?>

<div class="bodymesage">
	<a ><div class="opacity_cart"></div><a>
    <div class"body_cart" style="background-color: #fff;
    border-radius: 8px;
    box-shadow: 5px 5px 10px #666;
    height: 25%;
    margin-left: 28%;
    padding: 1.5% 1.5% 1.5% 10px;
    position: fixed;
    top: 32%;
    width: 37%;
    z-index: 99999;">

    		<a><button type="button" class="close" data-dismiss="modal">
    		<span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></a>
    		<h4 style="margin-top: -2%;margin-left: auto;text-align: center;"><span style="color:red;font-weight:bold">Sending contact your success! </span></h4>

    		<div class="thongbao" style="font-size:13px;margin-top: -2px;text-align: center;">
    			<p> <strong> Thank you have sent  contact the system </strong></p>
	    		
    			<p>Your information will be early feedback !!!</p>
	    		
	    		<p class="mesage">Any questions please contact the administrator!</p>
	    	</div>
	</div>
</div>	

<?php }
 else if(isset($message) && $message!="succesfuly" && $message!=""){?>
	<div class="bodymesage">
	<a ><div class="opacity_cart"></div><a>
    <div class"body_cart" style="width:37%;height:25%;background-color:#ffffff;z-index:99999; top:10%;
    position:fixed;margin-left:0%; border-radius:8px;box-shadow: 5px 5px 10px #666;padding:1.5%;padding-left:10px;">

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
 }

?>


