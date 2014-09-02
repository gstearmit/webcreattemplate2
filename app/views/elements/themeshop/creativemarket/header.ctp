<?php
$shop = explode ( '/', $this->params ['url'] ['url'] );
$shopname = $shop [0];
$shop = $this->requestAction ( 'comment/get_shop_id/' . $shopname );
foreach ( $shop as $key => $value ) {
	$shop_id = $key;
}



$user = $this->requestAction ( 'comment/get_user_id/' . $shop_id );
foreach ( $user as $user ) {
	$user_id = $user ['Shop'] ['user_id'];
}

$banner = $this->requestAction ( 'comment/get_banner/' . $user_id );

$tem = $this->requestAction ( 'comment/get_tem/' . $user_id );

foreach ( $tem as $tem ) {
	$template = $tem ['Tem']['linktems'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>E-commerce Template</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<link href="<?php echo DOMAIN ?>creativemarket/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo DOMAIN ?>creativemarket/css/style.css" rel="stylesheet">
<link href="<?php echo DOMAIN ?>creativemarket/css/animate.css" rel="stylesheet">

<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo DOMAIN ?>creativemarket/img/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo DOMAIN ?>creativemarket/img/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo DOMAIN ?>creativemarket/img/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="<?php echo DOMAIN ?>creativemarket/img/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="<?php echo DOMAIN ?>creativemarket/img/favicon.png">
<link href="<?php echo DOMAIN ?>creativemarket///netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo DOMAIN ?>creativemarket/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo DOMAIN ?>creativemarket/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo DOMAIN ?>creativemarket/js/scripts.js"></script>

<!-- new estore -->
<link href="<?php echo DOMAIN ?>creativemarket/css/core.css" rel="stylesheet">
<link href="<?php echo DOMAIN ?>creativemarket/css/tfingi-megamenu-frontend.css" rel="stylesheet">
<link href="<?php echo DOMAIN ?>creativemarket/css/turquoise.css" rel="stylesheet">

</head>

<body>
<div class="container">
  <div class="row clearfix">
    <div class="col-md-4 col-sm-4 col-xs-12 column"> <a href="<?php echo DOMAIN.$shopname ?>"><img src="<?php echo DOMAIN ?>creativemarket/img/uglogo.png" class="img-responsive" id="logo" alt=""></a> </div>
    <div class="col-md-8 col-sm-8 col-xs-12 column">
      <div class="account">
        <!--  <button type="button" class="btn-primary topbasketbutton"><span class="glyphicon glyphicon-pencil"></span> My Account</button>
             <button type="button" class="btn-primary topbasketbutton"><span class="glyphicon glyphicon glyphicon-briefcase"></span> Sign In</button>
        -->
        <button type="button" class="btn-primary topbasketbutton"><span class="glyphicon glyphicon-credit-card"></span> Checkout</button>
      </div>
      <div class="basket"> <span class="glyphicon glyphicon-shopping-cart"></span><a href="<?php echo DOMAIN ?>creativemarket/viewshopingcart"> <b>Your Cart </b><?php if(isset($_SESSION['shopingcart']))
                                            { $sl=count($_SESSION['shopingcart']) ;
                                            echo $sl;
                                            }else {echo "0"; }?> </b> items</a> </div> <!-- items - &pound;0.00 -->
    </div>
  </div>
</div>


<?php echo $this->element('themeshop\creativemarket\menu')?>

<?php echo $this->element('themeshop\creativemarket\slide')?>

