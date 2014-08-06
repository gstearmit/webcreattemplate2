<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $setting = $this -> requestAction('/comment/setting');?>
<?php foreach($setting as $settings){?>
<link href="http://<?php echo $settings['Setting']['url'];?>/feed" title="<?php echo $settings['Setting']['title'];?> » Feed" type="application/rss+xml" rel="alternate"/>
<link href="http://<?php echo $settings['Setting']['url'];?>/comments/feed" title="<?php echo $settings['Setting']['title'];?> » Comments Feed" type="application/rss+xml" rel="alternate"/>
<link href="http://<?php echo $settings['Setting']['url'];?>" title="<?php echo $settings['Setting']['title'];?>" rel="index">
<meta content="<?php echo $settings['Setting']['keyword'];?>" name="keywords"/>
<meta content="<?php echo $settings['Setting']['description'];?>" name="description"/>
<title><?php echo $settings['Setting']['title'];?></title>
<?php }?>
<meta content="noodp,noydir" name="robots"/>
<link href="<?php echo DOMAIN ?><?php echo DOMAIN;?>images/logo.png" type="images/jpg" rel="icon"/>
<link href="<?php echo DOMAIN;?>css/style_intro.css" rel="stylesheet" type="text/css" />
<link href="<?php echo DOMAIN;?>css/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" charset="utf-8" src="<?php echo DOMAIN;?>js/jquery.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo DOMAIN;?>js/dropdown.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo DOMAIN;?>js/jquery.nivo.slider.js"></script>
<link rel="stylesheet" href="<?php echo DOMAIN;?>css/nivo-slider.css" type="text/css" media="screen" />

<script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>
 <script type="text/javascript" src="<?php echo DOMAIN;?>js/jquery.carouFredSel-5.1.3-packed.js"></script>
    <script type="text/javascript" language="javascript">
    	$(function() {    
    		$("#foo").carouFredSel({
    		    prev: '#prev',
	            next: '#next',
                auto: true,
    	        items: 1,                
                direction : "up",
                scroll : {
                items           : 1,
                effect          : "",
                duration        : 400,                        
                pauseOnHover    : true
                }                  
	       });
           $("#foo2").carouFredSel({
                prev: '#prev',
	            next: '#next',
                auto: true,
    	        items: 1,                
                direction : "up",
                scroll : {
                items           : 1,
                effect          : "",
                duration        : 400,                        
                pauseOnHover    : true
                }                     
	       });               
	    });
    </script>

</head>
<body>
    <div id="wrapper">  
		<div id="header">
         <?php echo $this->element('header_intro');?> 
         </div>
         <div id="menu">
        	<?php echo $this->element('menu_intro');?>
         </div>
         <div id="body">
               <div id="content">
               <div id="mains">
               <?php echo $this->element('slide');?>
               <div id="khuyenmai">
                        <div id="t1">
                            <div class="list_carousels">
                            <ul id="foo">
                            <?php $tinkhuyenmai = $this->requestAction('/comment/tinkhuyenmaile');											
                            foreach ($tinkhuyenmai as $value){?>
                                <li>
                            <div class="tt">
    							<a style="float: left !important;" href="<?php echo DOMAIN?>tin-tuc/chi-tiet-tin/<?php echo $value['News']['id']?>"><?php echo strip_tags($this->Text->truncate( $value['News']['title'],65,array('ending' => '...','exact' => false)));?></a>
                            </div>
                            </li>
                            <?php }?>
                                </ul>
                            </div>  
                            </div>
                        <div id="t2">
                            <div class="list_carousels">
                            <ul id="foo2">
                            <?php $tinkhuyenmai = $this->requestAction('/comment/tinkhuyenmai');											
                            foreach ($tinkhuyenmai as $value){?>
                                <li>
                                <div class="img"><img src="<?php echo DOMAIN;?>images/vietsys_31.jpg" width="82" height="34" /></div>
                                <div class="tt" ><p style="float: left !important;" ><?php echo strip_tags($this->Text->truncate( $value['News']['title'],51,array('ending' => '...','exact' => false)));?></p><img src="<?php echo DOMAIN;?>images/vietsys_34.jpg" /><div class="clearfix"></div>
                                <a style="float: left;" href="<?php echo DOMAIN?>tin-tuc/chi-tiet-tin/<?php echo $value['News']['id']?>"><u><i>Xem chi tiết</i></u></a>
                                </div>
                                </li>
                            <?php }?>
                            </ul>
                        </div>
                        </div>
                        </div>
                        <div id="danhmuc">
                         <style>
                         .name a{
                            color: white !important;
                         } 
                         .name a:hover{
                            color: #237BA0 !important;
                            text-shadow:1px 1px 1px white;
                         }
                         </style>
                        	<div id="vpp">                                
                            	<div class="name">
                                <a href="<?php echo DOMAIN?>van-phong-pham">Văn phòng phẩm</a>
                                </div>
                            </div>
                            
                            <div id="tbvp">
                            	<div class="name">
                                <a href="<?php echo DOMAIN?>thiet-bi-van-phong">Thiết bị văn phòng</a>
                                </div>	
                            </div>
                            <div id="tbcn">
                                <div class="name">
                                    <a href="<?php echo DOMAIN?>thiet-bi-cntt-vl">Thiết bị cntt- vt</a>
                                    </div>
                            </div>
                            <div id="dichvu">
                            	<div class="name">
                                <a href="<?php echo DOMAIN?>dich-vu">Dịch vụ</a>
                                </div>
                            </div>
                        </div>  
                </div>
              </div>  <!--end content-->
   		
            <div id="footer">
                <div id="img">
                	<div class="intro">
                    <?php $setting = $this->requestAction('/comment/setting') ?>
                    <?php foreach($setting as $settings ){  ?>
    				<p><h3><b><?php echo $settings['Setting']['name'] ?></b></h3></p><br />
    				<p><h1>Địa chỉ: <?php echo $settings['Setting']['address'] ?></h1></p><br />
                    <p><h1>ĐT: <?php echo $settings['Setting']['phone'] ?>   Hotline: <?php echo $settings['Setting']['mobile'] ?>   Email: <?php echo $settings['Setting']['email'] ?></h1></p><br />
                    <?php }?>
                    <p align="right"><font color="#deac9c" >Thiết kế website & Quản trị bởi VTM</font> </p>
    			     </div>
                 </div>
            </div><!--end footer--> 
        </div><!--end body-->  
    </div><!--end wrapper-->

</body>
</html>
