<?php echo $this->Html->css('menu');?>
<!--<script src='<?php echo DOMAIN;?>js/ddsmoothmenu-namkna.js' type='text/javascript'></script>-->
<script type='text/javascript'>
	ddsmoothmenu.init({
	mainmenuid: "smoothmenu1", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
	})
	 
	ddsmoothmenu.init({
	mainmenuid: "smoothmenu2", //Menu DIV id
	orientation: 'v', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu-v', //class added to menu's outer DIV
	//customtheme: ["#804000", "#482400"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
	}) 
</script>

<div id="smoothmenu1" class="ddsmoothmenu">
<?php  echo $this->Help->getmenutop(NULL,'danh-muc-san-pham',true);?>
</div>
