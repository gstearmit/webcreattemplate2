<?php
$shop = explode ( '/', $this->params ['url'] ['url'] );
$shopname = $shop [0];
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $setting = $this -> requestAction('/'.$shopname.'/setting');?>
<?php foreach($setting as $settings){?>
<link href="http://<?php echo $settings['Estore_settings']['url'];?>/feed" title="<?php echo $settings['Estore_settings']['title'];?> » Feed" type="application/rss+xml" rel="alternate">
<link href="http://<?php echo $settings['Estore_settings']['url'];?>/comments/feed" title="<?php echo $settings['Estore_settings']['title'];?> » Comments Feed" type="application/rss+xml" rel="alternate">
<link href="http://<?php echo $settings['Estore_settings']['url'];?>" title="<?php echo $settings['Estore_settings']['title'];?>" rel="index">
<meta content="<?php echo $settings['Estore_settings']['keyword'];?>" name="keywords">
<meta content="<?php echo $settings['Estore_settings']['description'];?>" name="description">
<title><?php echo $settings['Estore_settings']['title'];?></title>
<?php }?>
<meta content="noodp,noydir" name="robots">