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


// echo "shop_id ";pr($shop_id);
// echo "user_id ";pr($user_id);
// echo "banner ";pr($banner);
// echo "tem ";pr($tem);
// echo "template ";pr($template);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $setting = $this -> requestAction('/bepga/setting');?>
<?php foreach($setting as $settings){?>
<link href="http://<?php echo $settings['Estore_setting']['url'];?>/feed" title="<?php echo $settings['Estore_setting']['title'];?> » Feed" type="application/rss+xml" rel="alternate"/>
<link href="http://<?php echo $settings['Estore_setting']['url'];?>/bepgas/feed" title="<?php echo $settings['Estore_setting']['title'];?> » Comments Feed" type="application/rss+xml" rel="alternate"/>
<link href="http://<?php echo $settings['Estore_setting']['url'];?>" title="<?php echo $settings['Estore_setting']['title'];?>" rel="index">
<meta content="<?php echo $settings['Estore_setting']['keyword'];?>" name="keywords"/>
<meta content="<?php echo $settings['Estore_setting']['description'];?>" name="description"/>
<?php if($session->read('lang')==1){?>
<title><?php echo $settings['Estore_setting']['title'];?></title>
             <?php } if($session->read('lang')==2){?>
<title><?php echo $settings['Estore_setting']['title_en'];?></title>
             <?php }?>

<?php }?>
<meta content="noodp,noydir" name="robots"/>
<link href="<?php echo DOMAIN ?>home/images/logo.png" type="images/png" rel="icon"/>
<link href="<?php echo DOMAIN;?>home/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo DOMAIN;?>home/css//style_main_center.css" rel="stylesheet" type="text/css" />
<link href="<?php echo DOMAIN;?>home/css/style_left.css" rel="stylesheet" type="text/css" />
<link href="<?php echo DOMAIN;?>home/css/style_right.css" rel="stylesheet" type="text/css" />
<link href="<?php echo DOMAIN;?>home/css/style_footer.css" rel="stylesheet" type="text/css" />
<link href="<?php echo DOMAIN;?>home/css/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" charset="utf-8" src="<?php echo DOMAIN;?>home/js/jquery.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo DOMAIN;?>home/js/dropdown.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo DOMAIN;?>home/js/jquery.nivo.slider.js"></script>
<link rel="stylesheet" href="<?php echo DOMAIN;?>home/css/nivo-slider.css" type="text/css" media="screen" />

<script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>
    <script src="<?php echo DOMAIN ?>home/js/floater_xlib.js" type="text/javascript"></script>
    <script type="text/javascript">

var slideTime = 700;
var floatAtBottom = false;

function pepsi_floating_init()
{
	xMoveTo('floating_banner_right', 887 - (1024-screen.width), 0);

	winOnResize(); // set initial position
	xAddEventListener(window, 'resize', winOnResize, false);
	xAddEventListener(window, 'scroll', winOnScroll, false);
}
function winOnResize() {
	checkScreenWidth();
	winOnScroll(); // initial slide
}
function winOnScroll() {
  var y = xScrollTop();
  if (floatAtBottom) {
    y += xClientHeight() - xHeight('floating_banner_left');
  }
  
  xSlideTo('floating_banner_left', (screen.width - (1050-772) - 770)/2-115 , y, slideTime);  // Chỉnh khoảng cách bên trái
  xSlideTo('floating_banner_right', (screen.width - (530-795) + 770)/2, y, slideTime); // // Chỉnh khoảng cách bên Phải
}
	
function checkScreenWidth()
{
	if( document.body.clientWidth <= 1024 )
	{	
		document.getElementById('floating_banner_left').style.display = 'none';
		document.getElementById('floating_banner_right').style.display = 'none';
	}
	else
	{
		document.getElementById('floating_banner_left').style.display = '';
		document.getElementById('floating_banner_right').style.display = '';	
	}
}

</script>
 <script type="text/javascript" src="<?php echo DOMAIN;?>home/js/jquery.carouFredSel-5.1.3-packed.js"></script>
    <script type="text/javascript" language="javascript">
    	$(function() {    
    		$("#foo").carouFredSel({
    		    prev: '#prev',
	            next: '#next',
                auto: true,
    	        items: 3,                
                direction : "up",
                scroll : {
                items           : 1,
                effect          : "",
                duration        : 400,                        
                pauseOnHover    : true
                }                  
	       });
           $("#foo1").carouFredSel({
    		    prev: '#prev',
	            next: '#next',
                auto: true,
    	        items: 3,                
                direction : "up",
                scroll : {
                items           : 1,
                effect          : "",
                duration        : 400,                        
                pauseOnHover    : true
                }                  
	       });
           $("#foo2").carouFredSel({
                auto: true,
    	        items: 3,                
                direction: "left",
                scroll : {
                items           : 1,
                effect          : "",
                duration        : 400,                        
                pauseOnHover    : true
                }                  
	       });    
            $("#foo5").carouFredSel({
                auto: true,
    	        items: 3,                
                direction: "left",
                scroll : {
                items           : 1,
                effect          : "",
                duration        : 400,                        
                pauseOnHover    : true
                }                  
	       });   
            $("#foo6").carouFredSel({
                auto: true,
    	        items: 10,                
                direction: "left",
                scroll : {
                items           : 1,
                effect          : "",
                duration        : 400,                        
                pauseOnHover    : true
                }                  
	       });            
	    });
    </script>

<style>
            a{
             color: black;
            }
  .page{
 float:right;
 margin-right:20px;
  padding-bottom:0;
  height:30px;
 
 } 
.page a{
 text-align:center;
 padding:3px 5px;
 background:#fff;
 border:1px solid silver;
 margin-left:5px;

 }
.page a:hover{
 background:#3960ab;
 border:1px solid #ae4e04;
 color: #FFF;
 } 
.page span.current {
 padding:3px 5px;
 background:#FFF;
 border:1px solid  silver;
 
 } 
.page span.current a{
 
 background:#fbdc70;
 border:1px solid #ae4e04;
 
 }
            </style>
</head>
<body>
<div id="floating_banner_left" style="position:absolute; z-index: 99999; overflow:hidden; margin: 217px 0px; left: 0px; width: 105px; border: 0px solid #000;">
<div id="floating_banner_left_content">
<?php $adv1= $this->requestAction('/bepga/adv1') ; //pr($adv1);die;?>
    <?php foreach($adv1 as $advs1 ){  ?>
    <a href="<?php echo $advs1['Estore_advertisement']['link'] ?>" target="_blank"><img src="<?php echo DOMAINADESTORE.$advs1['Estore_advertisement']['images']?>" border="0" width="105px" height="336" alt="" /></a>
    <!--<a href="<?php echo $advs1['Estore_advertisement']['link'] ?>" target="_blank" style="float:left;width:336px; height:120px;background-position:center center; background-image:url(<?php echo DOMAINAD.$advs1['Estore_advertisement']['images']?>&amp;h=336&amp;w=120&amp;zc=1); background-repeat:no-repeat;"> </a>-->
    <br />
   <?php } ?>
    <!--<a href="#" target="_blank"><img src="lien1.jpg" border="0" width="105px" alt="" /></a><br />-->
</div>
</div>



<div id="floating_banner_right" style="position:absolute;z-index: 99999; overflow:hidden; margin: 217px 0; right: 0px; width: 105px; border: 0px solid #000;">
	<div id="floating_banner_right_content"  >
    <?php $adv2= $this->requestAction('/bepga/adv2') ?>
    <?php foreach($adv2 as $advs2 ){  ?>
    <a href="<?php echo $advs2['Estore_advertisement']['link'] ?>" target="_blank"><img src="<?php echo DOMAINADESTORE.$advs2['Estore_advertisement']['images']?>" border="0" width="105px" height="336" alt="" /></a><br />
   <?php } ?>
</div>
</div>
<script>
	runQuery();
</script>
<script>
	pepsi_floating_init();
</script>

    <div id="wrapper">  
		<div id="header">
         <?php echo $this->element('/themeshop/home/header');?> 
         </div>
         <div id="menu">
        	<?php echo $this->element('/themeshop/home/menu');?>
         </div>
         <div id="bgiohang">
            <div id="giohang">
                <div class="solo">
                <marquee width="700" height="35" onmouseout="this.start();" onmouseover="this.stop();" scrollamount="2" scrolldelay="1" direction="left">
                    KitHomeStar - Nhà cung cấp chuyên nghiệp tổng thể thiết bị bếp Hàng đầu Việt Nam.
                    </marquee>
                </div>
                <div class="giohang">
                <a href="<?php echo DOMAIN?>bepga/viewshopingcart">GIỎ HÀNG</a>
                <?php if(isset($_SESSION['shopingcart'])){ $sl=count($_SESSION['shopingcart']);?>
                <p>Có {<?php echo $sl;?>} sản phẩm</p>
                <?php }else{?>
                <p>Có {0} sản phẩm</p>
                <?php }?>
                </div> 
            </div>
         </div>
         <div id="body">
         <div id="content">
               <div id="menu-left">
               <?php echo $this->element('/themeshop/home/left');?>
               </div>
                <?php echo $this->element('/themeshop/home/slide');?>
   		       <div id="main">
               
               <?php echo $content_for_layout; ?>

               </div>
               <div id="menu-right">
               <?php echo $this->element('/themeshop/home/right'); ?>
               </div>
                  <div class="clearfix"></div> 
                    <div id="doitac">
                        <h3 style="background: #E2E2E2; height: 25px;color: #850000;padding: 5px;">Đối tác - Khách hàng</h3>
                        <div class="list_carousels">
                        <ul id="foo6">                        
                        <?php $dt = $this->requestAction('/bepga/doitac') ?>									
                         <?php foreach ($dt as $value){?>
                        	<li>
                        	<div class="img">
                            	<a href="<?php echo $value['Estore_partner']['website']?>" target="_blank"><img src="<?php echo DOMAINADESTORE;?><?php echo $value['Estore_partner']['images']?>"  width="121" height="81" /></a>
                            </div>
                            </li>
                           <?php }?>
                            </ul>
                            </div>
                        </div><!--end doi tac-->                  
               </div>  <!--end content-->
               <div class="clearfix"></div> 
                 
            
        </div><!--end body-->  
        <div id="footer">
                <?php echo $this->element('/themeshop/home/footer');?>                
            </div><!--end footer--> 
    </div><!--end wrapper-->
</body>
</html>