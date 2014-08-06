	<!--slide-->
	 <div id="slider" class="nivoSlider">
     <?php $slide = $this -> requestAction('/bepga/slideshow');
//      pr($slide);die;?>
		<?php foreach($slide as $slide){?>
		<a href="#"><img class="img-sl" src="<?php echo DOMAINADESTORE;?><?php echo $slide['Estore_slideshow']['images'];?>" width="783" height="297"/></a>
		<?php } ?>
	</div>
    <!--end slide-->