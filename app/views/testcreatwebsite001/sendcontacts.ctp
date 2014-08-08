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
			
			$shop=explode('/',$this->params['url']['url']); 
			$shopname=$shop[0];
				$shop=$this->requestAction('comment/get_shop_id/'.$shopname);
				
				
				foreach($shop as $key=>$value){
				$shop_id=$key;
				}
			
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
    	<div class="top">Liên hệ</div>
        <div class="m3">            
             <div class="clearfix"> 		                   
                <div class="roundBoxBody">
                           <div style="width: 400px; margin: 0 auto;">
                             <?php echo $this->element('plugin/plugin-contac');?>
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
                             <?php echo $this->element('plugin/plugin-contac');?>
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
    <div class"body_cart" style="width:37%;height:25%;background-color:#ffffff;z-index:99999; top:10%;
    position:fixed;margin-left:0%; border-radius:8px;box-shadow: 5px 5px 10px #666;padding:1.5%;padding-left:10px;">

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


