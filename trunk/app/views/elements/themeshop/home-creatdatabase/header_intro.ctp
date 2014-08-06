  <div class="logo">
            <div  style="width:970px; height:45px; position: absolute;margin-top: 0px;">
                 <div align="right" >
                 <style>
                 a:hover{
                    color: #237BA0;
                 }
                 </style>
                 <a href="<?php echo DOMAIN?>xem-gio-hang">Giỏ hàng <img src="<?php echo DOMAIN?>images/giohang.png"/> | </a>
                 <?php if (isset($_SESSION['name'])&&($_SESSION['name']!='admin')){?>
                 <font color='#9c9c9c'>Chào mừng:</font> <font color="#237BA0"><?php echo $_SESSION['name'];?></font><a style="color: red;" href="<?php echo DOMAIN;?>thoat"> | Đăng xuất </a>
                 <?php }else{?>
                 <?php if (isset($_SESSION['name'])){?>
                 <font color='#9c9c9c'>Chào mừng:</font> <font color="#237BA0"><?php echo $_SESSION['name'];?></font><a style="color: red;" href="<?php echo DOMAIN;?>thoat"> | Đăng xuất</a>
                 <?php }else{?>
                 <a href="<?php echo DOMAIN?>dang-ky">Đăng ký | </a><a href="<?php echo DOMAIN?>dang-nhap">Đăng nhập</a>
                 <?php }}?>
                 </div>
              	</div>   
            <div style="width:1006px;height:45px; position: absolute; display:block; margin-top: 60px;">
            <form action="<?php echo DOMAIN;?>products/search" method="post" style=" ; padding-top:8px;padding-left:15px; height:44px;width: 298px; background:url(<?php echo DOMAIN;?>images/timkiem.png) no-repeat; float:right">
                <input type="text" value="---Nhập Từ Khóa Tìm Kiếm---" onclick="this.value=''" size="25" style="background:none; margin-left:20px;height:15px; border:0 #fefdf6; color:#8a8a8a;" name="name_search" id="txt_search" />
                <input class="buttons" type="hidden" id="btnSearch" />
                <input type="submit" style="float:right; border:0; margin:-5px; display:block; color:#000; background:url(<?php echo DOMAIN;?>images/icontk.png) no-repeat; width:57px; height:28px" value=""/>
             </form>
             </div>            
               <?php $banner = $this -> requestAction('/comment/banner');?>
   <?php foreach($banner as $banner){ ?>
      <object width="1000" height="110" title="" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" viewastext="">
         <param name="_cx" value="14552">
         <param name="_cy" value="4577">
         <param name="FlashVars" value="">
         <param name="Movie" value="<?php echo DOMAINAD?><?php echo $banner['Banner']['images'];?>">
         <param name="Src" value="<?php echo DOMAINAD?><?php echo $banner['Banner']['images'];?>">
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
         <embed width="1000" height="110" src="<?php echo DOMAINAD?><?php echo $banner['Banner']['images'];?>" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" wmode="transparent">
</object><?php }?>
             </div> 
