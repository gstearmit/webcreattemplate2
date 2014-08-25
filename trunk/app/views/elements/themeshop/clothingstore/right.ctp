<?php
$shop = explode ( '/', $this->params ['url'] ['url'] );
$shopname = $shop [0];
$shop = $this->requestAction ( 'comment/get_shop_id/' . $shopname );
foreach ( $shop as $key => $value ) {
	$shop_id = $key;
}

?>
<!-- Categories widget -->
<div class="widget Categories">
	<h3 class="widget-title widget-title ">Categories</h3>
	<ul>
		<li><a href='category.html' class="title">Mens</a>

			<ul>
				<li><a href='category.html' class="title">T-Shirts</a></li>
				<li><a href='category.html' class="title">Jackets</a></li>
				<li><a href='category.html' class="title">Jumpers</a></li>
				<li><a href='category.html' class="title">Shoes</a></li>
				<li><a href='category.html' class="title">Shirts</a></li>
				<li><a href='category.html' class="title">Accesories</a></li>
			</ul></li>
		<li><a href='category.html' class="title">Womens</a>
			<ul>
				<li><a href='category.html' class="title">Shoes</a></li>
				<li><a href='category.html' class="title">Dresses</a></li>
				<li><a href='category.html' class="title">Bags</a></li>
				<li><a href='category.html' class="title">Trousers</a></li>
				<li><a href='category.html' class="title">Tops</a></li>
				<li><a href='category.html' class="title">Accessories</a></li>
			</ul></li>
	</ul>
</div>
<!-- End class="widget Categories" -->

<!-- This month only! widget -->
<div class="widget Text">
	<h3 class="widget-title widget-title ">This month only!</h3>
	<h5>Free UK shipping!</h5>
	<h6>
		<i class="icon-gift"> &nbsp; </i> Free gift wrap
	</h6>

	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque
		beatae tempore porro officiis!</p>
	<a class="btn btn-primary" href="#"> BUY NOW <em>for</em> $85
	</a>
</div>
<!-- End class="widget Text" -->

