<?php $setting = $this -> requestAction('/comment/setting');?>
<?php foreach($setting as $settings){?>


 <link type="text/css" href="<?php echo DOMAIN ?>css/footer.css" rel="stylesheet" /> 
 <div id="bor-footer" style="background:url('<?php echo DOMAINAD.$settings['Setting']['image_footer']?>')">
 <?php
 //pr($settings['Setting']);
 //die;
 ?>
 <div id="footer">
 <div class="footer-left">
   <div class="menu-footer">
   
   			<ul>
					<li><a href="<?php echo DOMAIN?>"><?php __('home') ?></a></li>
					
					<li><a href="<?php echo DOMAIN?>du-lich"><?php __('tour') ?></a>
					</li>
				
					<li><a href="<?php echo DOMAIN?>tieu-dung"><?php __('consumer') ?></a>
			
					<li><a href="<?php echo DOMAIN?>gian-hang"><?php __('store') ?></a>
				
					<li style="border:none;"><a href="<?php echo DOMAIN?>lien-he"><?php __('support21') ?></a></li>
			</ul>
			<p style="font-weight:bold; color:#ffffff; margin-top:36px;overflow:hidden; "><?php echo $settings['Setting']['name']?></p>
			<p style="color:#dde6a1;margin-top:10px;"><?php __('office') ?> : <?php echo $settings['Setting']['address']?>
			<br>
			<?php __('Trading_Office') ?> :<?php echo $settings['Setting']['address']?>
			<br>
			<?php __('telephone') ?> : <?php echo $settings['Setting']['phone']?>
			<br>
			Website : <?php echo $settings['Setting']['mobile']?>
			</p>

   </div><!-- ENd menu-footer -->
   
 </div><!--End footer-left-->
 

 <div class="footer-right">
 	<img src="<?php echo DOMAIN?>images/khancom.png"/>
 	<p style="color:#dde6a1; margin-left:343px;margin-top:10px;">Công Ty Công Nghệ  Alataca</p>
 </div><!-- ENd footer-right -->
 
  </div><!-- End footer -->
</div><!-- ENd bor-footer -->


<?php }?>

</body>
</html>
   