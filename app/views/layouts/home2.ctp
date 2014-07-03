<script>
	  jQuery(document).ready(function($){
		$("#register-email").change(function(){
			var email=$("#register-email").val();
			$.ajax({
				type: "GET", 
				url: "<?php echo DOMAIN;?>"+'userscms/ck_mail_register/',
				data: 'email='+email,
				success: function(msg){	
					//alert (msg);	
					$('#validate-emai-register').find('span').remove().end();										
					$('#validate-emai-register').append(msg);					
				}
			});
			
		});
		<!--check shop-->
		$("#register-usershop").change(function(){
			var name=$("#register-usershop").val();
			$.ajax({
				type: "GET", 
				url: "<?php echo DOMAIN;?>"+'registrationshop/ck_name_register/',
				data: 'name='+name,
				success: function(msg){	
					//alert (msg);	
					$('#validate-usershop-register').find('span').remove().end();										
					$('#validate-usershop-register').append(msg);					
				}
			});
			
		});
		<!--end check-->
		$("#city").change(function(){			
			
			var citiesId = $("#city").val();			
			
			$.ajax({
				type: "GET", 
				url: "<?php echo DOMAIN;?>"+'userscms/district/',
				data: 'citiesId='+ citiesId ,
				success: function(msg){	
					//alert (msg);	
					$('#district').find('option').remove().end();										
					$('#district').append(msg);					
				}
			});			
			
			});
		
	});
	  
  </script>


<script type="text/javascript" src="<?php echo DOMAIN;?>js/jquery.validate.js"></script>

<script type="text/javascript" src="<?php echo DOMAIN;?>js/checkform.js"></script>



<?php echo $this->element('header')?>

<div id="main-content">
	 
	 <div class="content-top">
	 <?php echo $this->element('menu_top');?>
	 <div class="content-top-body">
	 

<?php echo $content_for_layout; ?>
	 		
	</div><!-- End content-top-body -->
	</div><!-- End content-top -->
	 
	 
	 </div><!-- ENd main content -->







<?php echo $this->element('footer')?>

