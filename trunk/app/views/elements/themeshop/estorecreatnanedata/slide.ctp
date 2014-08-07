	<?php
$shop = explode ( '/', $this->params ['url'] ['url'] );
$shopname = $shop [0];
$shop = $this->requestAction ( 'comment/get_shop_id/' . $shopname );
foreach ( $shop as $key => $value ) {
	$shop_id = $key;
}?>
	<!--slide-->
	 <div id="slider" class="nivoSlider">
     <?php $slide = $this -> requestAction('/'.$shopname.'/slideshow');
//      pr($slide);die;?>
		<?php foreach($slide as $slide){?>
		<a href="#"><img class="img-sl" src="<?php echo DOMAINADESTORE;?><?php echo $slide['Estore_slideshows']['images'];?>" width="783" height="297"/></a>
		<?php } ?>
	</div>
    <!--end slide-->