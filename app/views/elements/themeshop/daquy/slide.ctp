<?php
$shop = explode ( '/', $this->params ['url'] ['url'] );
$shopname = $shop [0];
?>
<style type="text/css" media="screen">

#slider {

    width: 100%; /* important to be same as image width */

    height: 270px; /* important to be same as image height */

    position: relative; /* important */

	overflow: hidden; /* important */


}



#sliderContent {

    width: 763px; /* important to be same as image width or wider */

    position: absolute;

	top: 0;

	margin-left: 0;

}

#sliderContent img{

	 width: 763px; /* important to be same as image width */

    height: 270px; /* important to be same as image height */

	}

.sliderImage {

    float: left;

    position: relative;

	display: none;

}

.sliderImage span {

    position: absolute;

	font: 10px/15px Arial, Helvetica, sans-serif;

    padding: 10px 13px;

    width: 763px;

    filter: alpha(opacity=70);

    -moz-opacity: 0.7;

	-khtml-opacity: 0.7;

    opacity: 0.7;

    color: #fff;

    display: none;

}

.clear {

	clear: both;

}

.sliderImage span strong {

    font-size: 14px;

}

.top {

	top: 0;

	left: 0;

}

.bottom {

	bottom: 0;

    left: 0;

}

ul { list-style-type: none;}

</style>

 <div class="bannerslide">

   <div id="slider">

        <ul id="sliderContent">

          <?php $slideshow = $this->requestAction('/'.$shopname.'/slideshow');//?>

				   <?php foreach($slideshow as $slideshows){?>

                <li class="sliderImage">

                    <a href=""><img alt="<?php echo $slideshows['Eshopdaquyslideshow']['name']?>" title="<?php echo $slideshows['Eshopdaquyslideshow']['name']?>" src="<?php echo DOMAINAD;?><?php echo $slideshows['Eshopdaquyslideshow']['images']?>" /></a>

                    <span class="top"><a style="color:#fff;" href=""></a></span>

                </li>

            <?php }?>

            <div class="clear sliderImage"></div>

        </ul>

    </div>

 </div>
