  <!-- Content section -->		
            <section class="main">
                
                <!-- Login / Register -->
                <section class="login_register">


                    <div class="container">
                        <div class="row">
                            <div class="span6">
                                <!-- Login -->
<div class="login">
    <div class="box">
        <form onsubmit="return false;" enctype="multipart/form-data" action="#" method="post">

            <div class="hgroup title">
                <h3>Customer login</h3>
                <h5>Please login using your existing account</h5>
            </div>

            <div class="box-content">
                <div class="row-fluid">
                    <div class="span6">
                        <div class="control-group">
                            <label class="control-label" for="login_email">Email</label>
                            <div class="controls">
                                <input class="span12" id="login_email" type="text" name="email" value="" />
                            </div>
                        </div>
                    </div>

                    <div class="span6">	
                        <div class="control-group">					
                            <label class="control-label" for="login_password">Password</label>
                            <div class="controls">
                                <input class="span12" id="login_password" type="password" name="password" />
                            </div>
                        </div>
                    </div>
                </div>	
            </div>

            <div class="buttons">
                <div class="pull-left">
                    <button type="submit" class="btn btn-primary btn-small" name="login" value="Login">
                        Login
                    </button>
                    <a href="reset-password.html" class="btn btn-small">
                        Reset my password
                    </a>
                </div>
            </div>		           
        </form>		
    </div>
</div>
<!-- End class="login" -->                                
                            </div>
                            
                            <div class="span6">                                
                                <!-- Register -->
<div class="register">
    <div class="box">
        <div class="hgroup title">
            <h3>Want to Register?</h3>
            <h5>Registration allows you to avoid filling in billing and shipping forms every time you checkout on this website. You'll also be able to track your orders with ease!</h5>
        </div>

        <div class="buttons">
            <div class="pull-left">
                <a href="#register" class="btn btn-small" data-toggle="modal">
                    Register now &nbsp; <i class="icon-chevron-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- End class="register" -->                            </div>	
                        </div>
                    </div>

                    <!-- Register modal window -->
<div id="register" class="modal hide fade" tabindex="-1">

    <form onsubmit="return false;" enctype="multipart/form-data" action="#" method="post">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <div class="hgroup title">
                <h3>Register now</h3>
                <h5>Registered users get access to features such as order history and so much more!</h5>
            </div>
        </div>

        <div class="modal-body">

            <div class="row-fluid">
                <div class="span6">
                    <div class="control-group">
                        <label class="control-label" for="first_name">First name</label>
                        <div class="controls">
                            <input class="span12" type="text" id="first_name" name="first_name" value="" />
                        </div>
                    </div>
                </div>

                <div class="span6">
                    <div class="control-group">
                        <label class="control-label" for="last_name">Last name</label>
                        <div class="controls">
                            <input class="span12" type="text" id="last_name" name="last_name" value="" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span12">
                    <div class="control-group">
                        <label class="control-label" for="email">Email address</label>
                        <div class="controls">
                            <input class="span12" type="text" id="email" name="email" value="" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row-fluid">	
                <div class="span6">
                    <div class="control-group">
                        <label class="control-label" for="password">Password</label>
                        <div class="controls">
                            <input class="span12" type="password" id="password"  name="password" autocomplete="off" />
                        </div>
                    </div>
                </div>

                <div class="span6">
                    <div class="control-group">
                        <label class="control-label" for="password_confirm">Password confirm</label>
                        <div class="controls">
                            <input class="span12" type="password" id="password_confirm"  name="password_confirm" autocomplete="off" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-small" name="signup" value="Register">
                Register now &nbsp; <i class="icon-ok"></i>
            </button>
        </div>                           

    </form>
</div>
<!-- End Register modal window -->                     
                </section>                
                <!-- End Login / Register -->
                
            </section>
            <!-- End class="main" -->
