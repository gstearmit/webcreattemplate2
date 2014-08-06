<?php echo $this->Html->css('global');?>
<script>
		$(function(){
			$('#slides').slides({
				preload: true,
				preloadImage: 'img/loading.gif',
				play: 5000,
				pause: 2500,
				hoverPause: true,
				animationStart: function(current){
					$('.caption').animate({
						bottom:-35
					},100);
					if (window.console && console.log) {
						// example return of current slide number
						console.log('animationStart on slide: ', current);
					};
				},
				animationComplete: function(current){
				$('.caption').animate({
					bottom:0
				},200);
				if (window.console && console.log) {
					// example return of current slide number
					console.log('animationComplete on slide: ', current);
				};
			},
			slidesLoaded: function() {
				$('.caption').animate({
					bottom:0
				},200);
			}
		});
	});
</script>
<div class="slideshow">
     <div class="left"></div>
      <div id="content-side">
			<div id="slides">
				<div class="slides_container">
                    <?php $slideshow = $this->requestAction('/plugin/slideshow');?>
				   <?php foreach($slideshow as $slideshow){?>
					<div class="slide">
						<a href="#" ><img src="<?php echo $slideshow['Slideshow']['images'];?>" width="753" height="248" alt="Slide 1"></a>
					</div>
                    <?php }?>                   
				</div>
				<a href="#" class="prev"><img src="<?php echo DOMAIN;?>images/left.png" alt=""></a>
				<a href="#" class="next"><img src="<?php echo DOMAIN;?>images/right.png" alt=""></a>
			</div>
      </div>
      <div class="right"></div>
 </div>