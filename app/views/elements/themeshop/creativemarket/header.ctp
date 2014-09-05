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
<link href="<?php echo DOMAIN ?>creativemarket/css/font-awesome.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo DOMAIN ?>creativemarket/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo DOMAIN ?>creativemarket/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo DOMAIN ?>creativemarket/js/scripts.js"></script>

<!-- new estore -->
<link href="<?php echo DOMAIN ?>creativemarket/css/core.css" rel="stylesheet">
<link href="<?php echo DOMAIN ?>creativemarket/css/tfingi-megamenu-frontend.css" rel="stylesheet">
<link href="<?php echo DOMAIN ?>creativemarket/css/turquoise.css" rel="stylesheet">
<?php // validate login?>
<link href="<?php echo DOMAIN ?>creativemarket/css/bootstrapValidator.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo DOMAIN ?>creativemarket/js/bootstrapValidator.js"></script>

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
      <a href="<?php echo DOMAIN.$shopname ?>/buy"  class="btn-primary topbasketbutton"><span class="glyphicon glyphicon-credit-card"></span> Checkout</a> 
        <?php if(!isset($_SESSION['id'])) {?> <button class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Login</button> <?php }?>
        <?php  if(isset($_SESSION['name']) and isset($_SESSION['id'])){ echo "<div style='background-color: #fff;height: 43px; width: 60%;border-radius: 4px; float: left; padding: 3px;'><span >Hello,".$_SESSION['name'].'</span></br><span>SO TT: '.$_SESSION['id'].'</sapn></div>'; }?>
        
			<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header btn-primary">
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                <h4 class="modal-title ">Login</h4>
			            </div>
			
			            <div class="modal-body">
			                <!-- The form is placed inside the body of modal -->
			                <form id="loginForm" method="post"  action="<?php echo DOMAIN.$shopname?>/login" class="form-horizontal">
			                    <div class="form-group">
			                        <label class="col-md-3 control-label">Email</label>
			                        <div class="col-md-5">
			                            <input type="text" name="email" class="form-control" data-bv-field="email">
			                        </div>
			                    </div>
			                    <div class="form-group">
			                        <label class="col-md-3 control-label">Password</label>
			                        <div class="col-md-5">
			                            <input type="password" name="password" class="form-control" data-bv-field="password">
			                        </div>
			                    </div>
			                     <div class="form-group">
			                        <label class="col-md-3 control-label">Number Eshop (So TT:)</label>
			                        <div class="col-md-5">
			                            <input type="number" class="form-control" name="numbereshopnew" data-bv-field="numbereshopnew" />
			                        </div>
			                    </div>
			                    <div class="form-group">
			                        <div class="col-md-5 col-md-offset-3">
			                            <button type="submit" class="btn btn-default">Login</button>
			                        </div>
			                    </div>
			                </form>
			            </div>
			        </div>
			    </div>
			</div>
			<script type="text/javascript">
				$(document).ready(function() {
				    $('#loginForm').bootstrapValidator({
				        message: 'This value is not valid',
				        feedbackIcons: {
				            valid: 'glyphicon glyphicon-ok',
				            invalid: 'glyphicon glyphicon-remove',
				            validating: 'glyphicon glyphicon-refresh'
				        },
				        fields: {
				        	email: {
				                validators: {
				                    emailAddress: {
				                        message: 'The input is not a valid email address'
				                    }
				                }
				            },
				            numbereshopnew: {
				                validators: {
				                    notEmpty: {
				                        message: 'The Number E-Shop is required'
				                    }
				                }
				            },
				            password: {
				                validators: {
				                    notEmpty: {
				                        message: 'The password is required and cannot be empty'
				                    },
				                    identical: {
				                        field: 'confirmPassword',
				                        message: 'The password and its confirm are not the same'
				                    },
				                    different: {
				                        field: 'username',
				                        message: 'The password cannot be the same as username'
				                    }
				                }
				            }
				           
				        }
				    });
				});
			</script>
			
      </div>
      <div class="basket"> <span class="glyphicon glyphicon-shopping-cart"></span><a href="<?php echo DOMAIN.$shopname ?>/viewshopingcart"> <b>Your Cart </b><?php if(isset($_SESSION['shopingcart']))
                                            { $sl=count($_SESSION['shopingcart']) ;
                                            echo $sl;
                                            }else {echo "0"; }?> </b> items</a> 
     </div> <!-- items - &pound;0.00 -->
    </div>
  </div>
</div>


<?php echo $this->element('themeshop/creativemarket/menu')?>

<?php echo $this->element('themeshop/creativemarket/slide')?>

