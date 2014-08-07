<?php
$shop = explode ( '/', $this->params ['url'] ['url'] );
$shopname = $shop [0];
$shop = $this->requestAction ( 'comment/get_shop_id/' . $shopname );
foreach ( $shop as $key => $value ) {
	$shop_id = $key;
}

?>
<?php // if($session->read('lang')==1){?>
<div id="img">
    <div class="img"><img src="<?php echo DOMAIN;?>home/images/footer_banner.jpg"/></div>

    <?php $setting = $this->requestAction('/'.$shopname.'/setting'); ?>

    <?php foreach($setting as $settings ){  ?>
	<?php echo $settings['Estore_settings']['footer'];?>
    <?php }?>

 </div>
  <?php // }
  if($session->read('lang')==2){?>                
 <div id="img">
	<div class="intro">
    <?php $setting = $this->requestAction('/'.$shopname.'/setting/'.$shop_id) ?>
    <?php foreach($setting as $settings ){  ?>
	<p><h3 style="text-transform: uppercase;"><b><?php echo $settings['Estore_settings']['name_en'] ?></b></h3></p><br />
	<p><h1>Address: <?php echo $settings['Estore_settings']['address_eg'] ?></h1></p><br />
    <p><h1>Phone: <?php echo $settings['Estore_settings']['phone'] ?>   Hotline: <?php echo $settings['Estore_settings']['mobile'] ?>   Email: <?php echo $settings['Estore_settings']['email'] ?></h1></p><br />
    <?php }?>
    <p align="right" style="padding-right: 10px;"><font color="#deac9c" >Web Design & Management by alatca</font> </p>
     </div>
 </div>
 <?php }?>