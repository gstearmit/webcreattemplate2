<div class="container-fluid bottomback margintop10">
  <div class="container"> </div>
</div>
<div class="container">
  <div class="row clearfix">
     <?php $setting = $this->requestAction('/'.$shopname.'/setting'); ?>

    <?php foreach($setting as $settings ){  ?>
	<?php echo $settings['Estore_settings']['footer'];?>
    <?php }?>
    
   
  </div>
</div>
<div class="container-fluid bottomfooter">
  <div class="container"> Terms of Service  - Privacy Policy  -   Contact Us  -  Support & FAQ </div>
</div>
</body>
</html>