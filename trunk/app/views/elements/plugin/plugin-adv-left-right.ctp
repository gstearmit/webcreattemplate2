<?php echo $javascript->link('floater_xlib'); ?>
<script type=text/javascript>

var slideTime = 700;
var floatAtBottom = false;

function pepsi_floating_init()
{
	xMoveTo('floating_banner_right', 900 - (1024-screen.width), 0);

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
  
  xSlideTo('floating_banner_left', (screen.width - (1100-775) - 770)/2-115 , y, slideTime);  // Chỉnh khoảng cách bên trái
  xSlideTo('floating_banner_right', (screen.width - (350-795) +595)/2, y, slideTime); // // Chỉnh khoảng cách bên Phải
}
	
function checkScreenWidth()
{
	if( document.body.clientWidth < 926 )
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
<div id="floating_banner_left" style="text-align:right; position:absolute; overflow:hidden; margin-top:15px !important; left: -3px; width: 125px !important; border: 0px solid #000;">
<div id="floating_banner_left_content">
 <?php $advleft = $this -> requestAction('/plugin/advleft');?>
     <?php foreach($advleft as $advlefts){?>
        <a href="" target="_blank" ><img src="<?php echo $advlefts['Advertisement']['images'];?>" border="0" width="120px" height="399px" alt="" /></a><br />
     <?php }?>
</div>
</div>
<div id="floating_banner_right" style="text-align:left; position:absolute; overflow:hidden; margin-top:15px !important; right: 0px; width: 125px; border: 0px solid #000;">
	<div id="floating_banner_right_content"  >
    <?php $advright = $this -> requestAction('/plugin/advright');?>
     <?php foreach($advright as $advrights){?>
        <a href="" target="_blank" ><img src="<?php echo $advrights['Advertisement']['images'];?>" border="0" width="120px" height="399px" alt="" /></a>
     <?php }?>
</div>
</div>
<script>
    runQuery();
</script>
<script>
    pepsi_floating_init();
</script>