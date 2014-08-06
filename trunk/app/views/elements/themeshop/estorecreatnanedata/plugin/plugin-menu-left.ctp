<!--menu site left -->
<style type="text/css">
	.sidebarmenu ul{
	margin: 0;
	padding: 0;
	list-style-type: none;
	font: bold 13px Verdana;
	width: 100%; /*chiều rộng của Main Menu Item*/
	}
	.sidebarmenu ul li{
	position: relative;
	}
	/* Top level menu links style */
	.sidebarmenu ul li a{
	display: block;
	overflow: auto; /*force has Layout in IE7 */
	text-decoration: none;
	}
	.sidebarmenu ul li a:link, .sidebarmenu ul li a:visited, .sidebarmenu ul li a:active{
	}
	.sidebarmenu ul li a:visited{
	color: white;
	}
	.sidebarmenu ul li a:hover{
	}
	/*Sub level menu items */
	.sidebarmenu ul li ul{
	position: absolute;
	border-top:1px solid #9dd8f0;
	border-left:1px solid #9dd8f0;
	border-right:1px solid #9dd8f0;
	width: 170px; /*Chiều rộng Sub Menu Items */
	top: 0;
	visibility: hidden;
	background:#FFF;
	}
	
	/* Holly Hack for IE \*/
	* html .sidebarmenu ul li { float: left; height: 1%; }
	* html .sidebarmenu ul li a { height: 1%; }
/* End */
</style>
<script type="text/javascript">
	var menuids=["sidebarmenu1"] 
	function initsidebarmenu(){
	for (var i=0; i<menuids.length; i++){
	var ultags=document.getElementById(menuids[i]).getElementsByTagName("ul")
	for (var t=0; t<ultags.length; t++){
	ultags[t].parentNode.getElementsByTagName("a")[0].className+=" subfolderstyle"
	if (ultags[t].parentNode.parentNode.id==menuids[i]) 
	ultags[t].style.left=ultags[t].parentNode.offsetWidth+"px"
	else //else if this is a sub level submenu (ul)
	ultags[t].style.left=ultags[t-1].getElementsByTagName("a")[0].offsetWidth+"px" //position menu to the right of menu item that activated it
	ultags[t].parentNode.onmouseover=function(){
	this.getElementsByTagName("ul")[0].style.display="block"
	}
	ultags[t].parentNode.onmouseout=function(){
	this.getElementsByTagName("ul")[0].style.display="none"
	}
	}
	for (var t=ultags.length-1; t>-1; t--){ 
	ultags[t].style.visibility="visible"
	ultags[t].style.display="none"
	}
	}
	}
	if (window.addEventListener)
	window.addEventListener("load", initsidebarmenu, false)
	else if (window.attachEvent)
	window.attachEvent("onload", initsidebarmenu)
</script>
<!--end-->
<div class="sidebarmenu" style="padding-top:15px; padding-bottom:15px;">
  <?php  echo $this->Help->getMultiMenu(NULL,'danh-muc-san-pham',true);?>
</div>
<!--end-->