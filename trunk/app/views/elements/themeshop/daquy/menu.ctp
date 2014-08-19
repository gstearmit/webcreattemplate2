<?php
$shop = explode ( '/', $this->params ['url'] ['url'] );
$shopname = $shop [0];
?>
<div id="menu">

	<ul id="nav">

		<li style="margin-right: 20px; margin-left: 6px;"><a href="<?php echo DOMAIN; ?>"><span>TRANG CHỦ<span></a></li>
		<li><img src="<?php echo DOMAIN; ?>images/chuv.png"></li>
		<li><a href="<?php echo DOMAIN.$shopname;?>/aboutus"><span> GIỚI THIỆU </span></a></li>
		<li><img src="<?php echo DOMAIN; ?>images/chuv.png"></li>
		<li><a href="<?php echo DOMAIN.$shopname;?>/indexproduct"><span> SẢN PHẨM</span> </a></li>
		<li><img src="<?php echo DOMAIN; ?>images/chuv.png"></li>
				 <?php $menupro1 = $this->requestAction('/'.$shopname.'/menucategory')?>
   <?php foreach($menupro1 as $menupro1){?>
				<li><a
			href="<?php echo DOMAIN; ?><?php echo $shopname ; ?>/indexnew/<?php echo $menupro1['Eshopdaquycategory']['id']; ?>">

				<span> <?php echo $menupro1['Eshopdaquycategory']['name'];?></span>
		</a></li>
		<li><img src="<?php echo DOMAIN; ?>images/chuv.png"></li>
				<?php } ?>
					
				<li><a href="<?php echo DOMAIN.$shopname;?>/send"><span> LIÊN HỆ </span></a></li>
		<li style="margin-top: 0px;"><img
			src="<?php echo DOMAIN; ?>images/chuv.png"></li>

	</ul>
</div>