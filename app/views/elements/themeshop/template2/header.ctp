<?php 
			
			$shop=explode('/',$this->params['url']['url']); 
			$shopname=$shop[0];
				$shop=$this->requestAction('comment/get_shop_id/'.$shopname);
		foreach($shop as $key=>$value){
				$shop_id=$key;
				}
			
			$user=$this->requestAction('comment/get_user_id/'.$shop_id);
			foreach($user as $user){
			$user_id=$user['Shop']['user_id'];
			}
			
			$banner=$this->requestAction('comment/get_banner/'.$user_id);
			
			$tem=$this->requestAction('comment/get_tem/'.$user_id);
			
			foreach($tem as $tem){
			$template=$tem['Tem']['linktems'];
			}
			
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $title_for_layout; ?></title>
    <link rel="stylesheet" href="<?php echo DOMAIN?>css/style_<?php echo $template;?>.css">
	<script src="<?php echo DOMAIN?>js/jquery-latest.js" type="text/javascript"></script>
</head>
<?php 

$Background_img = $this->requestAction($shopname.'/background');

// pr($Background_img);
// die;
if (is_array($Background_img) and !empty($Background_img)) 
{
	foreach($Background_img as $mau){
	?>
	<body style="background:<?php if($mau['Background']['images']!='') echo"url(".DOMAIN."/".$mau['Background']['images'].") fixed no-repeat;";
	else {echo "#".$mau['Background']['color'];}
	?>">
	<?php } 
	}else {
		?>
		<body>
	<?php
	}
?>


    <div id='main'>
        <div id='header'>
		<?php $ok=0;
				foreach($banner as $banner){
			
			if($banner['Banner']['images']!=''){
			$ok=1;
			
		?>
		<img style="width:1000px; height:174px;" src="<?php echo DOMAIN.$banner['Banner']['images'];?>"/>
		<?php 
		}}
		
		if($ok==0){
		?>
		<img style="width:1000px; height:174px;" src="<?php echo DOMAIN?>image_<?php echo $template;?>/header.png"/>
		<?php }?>
		
		<?php $menu=$this->Session->read('menu');
		if($menu=='') $menu='home';
		?>
            <ul>
			
                <li <?php if($menu=='home') echo 'id="home"' ?>><a href="<?php echo DOMAIN.$shopname?>">Trang chủ </a></li>
                <li <?php if($menu=='gioithieu') echo 'id="home"' ?>><a href="<?php echo DOMAIN.$shopname?>/gioi_thieu">Giới thiệu  </a></li>
                <li <?php if($menu=='sanpham') echo 'id="home"' ?>><a href="<?php echo DOMAIN.$shopname?>/danh_sach_san_pham">Sản phẩm </a></li>
                <li <?php if($menu=='khuyenmai') echo 'id="home"' ?>><a href="<?php echo DOMAIN.$shopname?>/khuyen_mai">Khuyến mại </a></li>
                <li <?php if($menu=='tintuc') echo 'id="home"' ?>><a href="<?php echo DOMAIN.$shopname?>/tin_tuc">Tin tức </a></li>
                <li <?php if($menu=='lienhe') echo 'id="home"' ?>><a href="<?php echo DOMAIN.$shopname?>/lien_he">Liên hệ  </a></li>
            </ul>
        </div><!--end #header--> 