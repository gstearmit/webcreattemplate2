
  <div class="login-box clearfix animated flipInY">
			       		<div class="page-icon animated bounceInDown">
			       			<img class="img-responsive" src="<?php echo DOMAINADESTORE?>html/login/img/login-key-icon.png" alt="Key icon" />
			       		</div>
			        	<div class="login-logo">
			        		<a href="#"><img src="<?php echo DOMAINADESTORE?>html/login/img/login-logo.png" alt="Company Logo" /></a>
			        	</div> 
			        	<hr />
			        	<div class="login-form">
			        		<div class="alert alert-error hide">
								  <button type="button" class="close" data-dismiss="alert">&times;</button>
								  <h4>Error!</h4>
								   Your Error Message goes here
							</div>
			        		<form action="<?php echo DOMAINADESTORE?>login/login" method="post"  >
						   		 <input type="text" placeholder="User name"  name="data[Shop][email]" class="input-field" required/> 
						   		 <input type="password"  placeholder="Password" name="data[Shop][userpass]" class="input-field" required/> 
						   		  <input type="text" placeholder="STT Shop"  name="data[Shop][id]" class="input-field" required/> 
						   		 <button type="submit" value='Sign In' class="btn btn-login">Login</button> 
							</form>	
							 <div class="login-links"> 
					            <!-- <a href="forgot-password.html">
					          	   Forgot password?
					            </a>
					            <br />
					            <a href="sign-up.html">
					              Don't have an account? <strong>Sign Up</strong>
					            </a>-->     	
							</div> 	
			        	</div> 			        	
			       </div>