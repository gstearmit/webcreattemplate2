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
    <!-- Slider -->
<?php $slide = $this -> requestAction('/'.$shopname.'/slideshow'); // pr($slide);die;?>
    <div class="carousel-inner">
     <?php foreach($slide as $slide){?>
      <div class="item active"> <img src="<?php echo DOMAINADESTORE;?><?php echo $slide['Estore_slideshows']['images'];?>" alt="...">
        <div class="carousel-caption"> </div>
      </div>
      <?php break;}?>
      <?php $slide = $this -> requestAction('/'.$shopname.'/slideshow'); // pr($slide);die;?>
      <?php foreach($slide as $slide){?>
      <div class="item"> <img src="<?php echo DOMAINADESTORE;?><?php echo $slide['Estore_slideshows']['images'];?>" alt="...">
        <div class="carousel-caption"> </div>
      </div>
      <?php }?>
      
    </div>
  </div>
  
  <!-- Controls --> 
  <a class="left carousel-control" href="<?php echo DOMAIN.$shopname ?>#carousel-example-generic" data-slide="prev"> 
  <span class="glyphicon glyphicon-chevron-left"></span> </a> 
  <a class="right carousel-control" href="<?php echo DOMAIN.$shopname ?>#carousel-example-generic" data-slide="next"> 
  <span class="glyphicon glyphicon-chevron-right"></span> </a> 
 </div>