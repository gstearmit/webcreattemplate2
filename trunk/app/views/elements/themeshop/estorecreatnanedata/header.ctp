<?php
$shop = explode ( '/', $this->params ['url'] ['url'] );
$shopname = $shop [0];
$shop = $this->requestAction ( 'comment/get_shop_id/' . $shopname );
foreach ( $shop as $key => $value ) {
	$shop_id = $key;
}



$user = $this->requestAction ( 'comment/get_user_id/' . $shop_id );
foreach ( $user as $user ) {
	$user_id = $user ['Shop'] ['user_id'];
}

$banner = $this->requestAction ( 'comment/get_banner/' . $user_id );

$tem = $this->requestAction ( 'comment/get_tem/' . $user_id );

foreach ( $tem as $tem ) {
	$template = $tem ['Tem']['linktems'];
}
// pr($shop_id);
// pr($shopname);
?>
<?php $banner = $this -> requestAction('/'.$shopname.'/banner/'.$shop_id);?>
   <?php foreach($banner as $banner){ ?>
      <object width="1000" height="178" title="" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" viewastext="">
         <param name="_cx" value="14552">
         <param name="_cy" value="4577">
         <param name="FlashVars" value="">
         <param name="Movie" value="<?php echo DOMAINADESTORE?><?php echo $banner['estore_banners']['images'];?>">
         <param name="Src" value="<?php echo DOMAINADESTORE?><?php echo $banner['estore_banners']['images'];?>">
         <param name="WMode" value="transparent">
         <param name="Play" value="-1">
         <param name="Loop" value="-1">
         <param name="Quality" value="High">
         <param name="SAlign" value="">

         <param name="Menu" value="-1">
         <param name="Base" value="">
         <param name="AllowScriptAccess" value="">
         <param name="Scale" value="ShowAll">
         <param name="DeviceFont" value="0">
         <param name="EmbedMovie" value="0">
         <param name="BGColor" value="FFFFFF">
         <param name="SWRemote" value="">
         <param name="MovieData" value="">

         <param name="SeamlessTabbing" value="1">
         <param name="Profile" value="0">
         <param name="ProfileAddress" value="">
         <param name="ProfilePort" value="0">
         <param name="AllowNetworking" value="all">
         <param name="AllowFullScreen" value="false">
         <embed width="1000" height="178" src="<?php echo DOMAINADESTORE?><?php echo $banner['estore_banners']['images'];?>" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" wmode="transparent">
      </object>
<?php }?>
