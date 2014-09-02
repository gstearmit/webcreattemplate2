	<?php
$shop = explode ( '/', $this->params ['url'] ['url'] );
$shopname = $shop [0];
$shop = $this->requestAction ( 'comment/get_shop_id/' . $shopname );
foreach ( $shop as $key => $value ) {
	$shop_id = $key;
}?>
<div class="container-fluid sliderback">
  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel"> 
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-generic" data-slide-to="1"></li>
      <li data-target="#carousel-example-generic" data-slide-to="2"></li>
      <li data-target="#carousel-example-generic" data-slide-to="3"></li>
    </ol>
    
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active"> <img src="<?php echo DOMAIN ?>creativemarket/img/slide1.png" alt="...">
        <div class="carousel-caption"> </div>
      </div>
      <div class="item"> <img src="<?php echo DOMAIN ?>creativemarket/img/slide2.png" alt="...">
        <div class="carousel-caption"> </div>
      </div>
      <div class="item"> <img src="<?php echo DOMAIN ?>creativemarket/img/slide3.png" alt="...">
        <div class="carousel-caption"> </div>
      </div>
      <div class="item"> <img src="<?php echo DOMAIN ?>creativemarket/img/slide4.png" alt="...">
        <div class="carousel-caption"> </div>
      </div>
    </div>
  </div>
  
  <!-- Controls --> 
  <a class="left carousel-control" href="<?php echo DOMAIN.$shopname ?>#carousel-example-generic" data-slide="prev"> 
  <span class="glyphicon glyphicon-chevron-left"></span> </a> 
  <a class="right carousel-control" href="<?php echo DOMAIN.$shopname ?>#carousel-example-generic" data-slide="next"> 
  <span class="glyphicon glyphicon-chevron-right"></span> </a> 
 </div>