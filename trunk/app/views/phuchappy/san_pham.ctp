<?php 
$pizza = $_GET['url'];
$urlshop = explode("/", $pizza);
$geturl=$urlshop[0];
?>
<div class="wrapper_body">
	<div class="body_module">
		<div class="title_module">
			<div class="left_icon"></div>
			<div class="title"><span>Sản phẩm</span></div>
			<div class="right_icon"></div>
		</div>
		<div class="content_module">
			<ul class="list-product clearfix">
               <?php 
			    foreach($productshop as $productshops){?>
				<li>
					<table class="img-124">
						<tr valign="middle">
							<td>
								<a href="<?php echo DOMAIN;?><?php echo $geturl;?>/chi_tiet_san_pham/<?php echo $productshops['Productshop']['id'];?>"><img alt="" class="" src="<?php echo DOMAIN;?><?php echo $productshops['Productshop']['images'];?>" /></a>
							</td>
						</tr>
					</table>
					<h4><a href="<?php echo DOMAIN;?><?php echo $geturl;?>/chi_tiet_san_pham/<?php echo $productshops['Productshop']['id'];?>"><?php echo $productshops['Productshop']['title'];?></a></h4>
					<p class="price"><?php echo $productshops['Productshop']['price'];?> <?php echo $productshops['Productshop']['money'];?></p>
					<p><a href=""><img src="<?php echo DOMAIN;?>tem/images/addcart.jpg" /></a></p>
				</li>
			   <?php }?>		
		    </ul>
			<div class="clr"></div>
		</div>
	</div>
</div>