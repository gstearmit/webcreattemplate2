<?php
$shop = explode ( '/', $this->params ['url'] ['url'] );
$shopname = $shop [0];
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $setting = $this -> requestAction('/'.$shopname.'/setting');?>
<?php foreach($setting as $settings){?>
<link href="http://<?php echo $settings['Eshopdaquysetting']['url'];?>/feed" title="<?php echo $settings['Eshopdaquysetting']['title'];?> » Feed" type="application/rss+xml" rel="alternate">
<link href="http://<?php echo $settings['Eshopdaquysetting']['url'];?>/comments/feed" title="<?php echo $settings['Eshopdaquysetting']['title'];?> » Comments Feed" type="application/rss+xml" rel="alternate">
<link href="http://<?php echo $settings['Eshopdaquysetting']['url'];?>" title="<?php echo $settings['Eshopdaquysetting']['title'];?>" rel="index">
<meta content="<?php echo $settings['Eshopdaquysetting']['keyword'];?>" name="keywords">
<meta content="<?php echo $settings['Eshopdaquysetting']['description'];?>" name="description">
<title><?php echo $settings['Eshopdaquysetting']['title'];?></title>
<?php }?>
<meta content="noodp,noydir" name="robots">