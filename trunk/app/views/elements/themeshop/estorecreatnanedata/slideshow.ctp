<!--<div class="slider">
	 <div class="slider-info">
        	 		<link rel="stylesheet" href="<?PHP echo DOMAIN;?>css/default/default.css" type="text/css" media="screen" />
    				<link rel="stylesheet" href="<?PHP echo DOMAIN;?>css/nivo-slider.css" type="text/css" media="screen" />
   						<div class="slider-wrapper theme-default">
            				<div class="ribbon"></div>
            				<div id="slider" class="nivoSlider">
                            	<?php $slide = $this -> requestAction('/comment/slideshow');?>
                				<?php foreach($slide as $slide){?>
                					<img src="<?php echo $slide['Slideshow']['images'];?>" alt="" />
                				<?PHP } ?>
            				</div>
       					</div>
   					<script type="text/javascript" src="<?PHP echo DOMAIN;?>js/jquery.nivo.slider.pack.js"></script>
    				<script type="text/javascript">
//        				$(window).load(function() {
//            					$('#slider').nivoSlider();
//        					});    			
    				$(window).load(function() {
    				    $('#slider').nivoSlider({
    				        effect: 'fade', // Specify sets like: 'fold,fade,sliceDown,random'
    				        slices: 15, // For slice animations
    				        boxCols: 8, // For box animations
    				        boxRows: 4, // For box animations
    				        animSpeed: 500, // Slide transition speed
    				        pauseTime: 3000, // How long each slide will show
    				        startSlide: 0, // Set starting Slide (0 index)
    				        directionNav: true, // Next & Prev navigation
    				        directionNavHide: true, // Only show on hover
    				        controlNav: true, // 1,2,3... navigation
    				        controlNavThumbs: false, // Use thumbnails for Control Nav
    				        pauseOnHover: true, // Stop animation while hovering
    				        manualAdvance: false, // Force manual transitions
    				        prevText: 'Prev', // Prev directionNav text
    				        nextText: 'Next', // Next directionNav text
    				        randomStart: false, // Start on a random slide
    				        beforeChange: function(){}, // Triggers before a slide transition
    				        afterChange: function(){}, // Triggers after a slide transition
    				        slideshowEnd: function(){}, // Triggers after all slides have been shown
    				        lastSlide: function(){}, // Triggers when last slide is shown
    				        afterLoad: function(){} // Triggers when slider has loaded
    				    });
    				});
    				
    				</script>
	</div>
</div>
-->