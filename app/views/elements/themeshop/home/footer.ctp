
<?php if($session->read('lang')==1){?>
<div id="img">
<?php echo "foooter";?>
    <div class="img"><img src="<?php echo DOMAIN;?>home/images/footer_banner.jpg"/></div>

    <?php $setting = $this->requestAction('/bepga/setting');pr($setting);die; ?>
    <?php foreach($setting as $settings ){  ?>
	<?php echo $settings['Estore_setting']['footer'];?>
    <?php }?>

 </div>
  <?php }if($session->read('lang')==2){?>                
 <div id="img">
	<div class="intro">
    <?php $setting = $this->requestAction('/bepga/setting') ?>
    <?php foreach($setting as $settings ){  ?>
	<p><h3 style="text-transform: uppercase;"><b><?php echo $settings['Estore_setting']['name_en'] ?></b></h3></p><br />
	<p><h1>Address: <?php echo $settings['Estore_setting']['address_eg'] ?></h1></p><br />
    <p><h1>Phone: <?php echo $settings['Estore_setting']['phone'] ?>   Hotline: <?php echo $settings['Estore_setting']['mobile'] ?>   Email: <?php echo $settings['Estore_setting']['email'] ?></h1></p><br />
    <?php }?>
    <p align="right" style="padding-right: 10px;"><font color="#deac9c" >Web Design & Management by alatca</font> </p>
     </div>
 </div>
 <?php }?>