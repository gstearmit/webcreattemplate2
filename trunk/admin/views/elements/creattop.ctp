 <?php  $langs= null;
                    $urlcart ="";
                    if(isset($_GET['language'])){
                    $abc=$_GET['language'];
                    if($abc =='vie'){
                    	$langs="?language=vie";
                    }
                    if($abc=='eng'){
						$langs ="?language=eng";
					}
					$url = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
					$de=DOMAIN.$langs;
					if($url!=$de){
					$url1 = str_replace(DOMAIN, "", $url);
					$url12 = split("[?]", $url1);
					//$urlcart1 = split("[/]", $url12[0]);
					$urlcart = DOMAIN.$url12[0];
					}
					}else{
						$url = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
						$urlcart=$url;
					}
					
					
					 
                    ?>
<header>
      <nav class='navbar navbar-default'>
        <a class='navbar-brand' href='#'>
         ADMIN
        </a>
        <a class='toggle-nav btn pull-left' href='#'>
          <i class='icon-reorder'></i>
        </a>
        <ul class='nav'>
          <li class='dropdown light only-icon new'>
            <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
              <i class='icon-cog'></i>
            </a>
            <ul class='dropdown-menu color-settings'>
              <li class='color-settings-body-color'>
                <div class='color-title'>Body color</div>
                <a data-change-to='assets/stylesheets/light-theme.css' href='#'>
                  Light
                  <small>(default)</small>
                </a>
                <a data-change-to='assets/stylesheets/dark-theme.css' href='#'>
                  Dark
                </a>
                <a data-change-to='assets/stylesheets/dark-blue-theme.css' href='#'>
                  Dark blue
                </a>
              </li>
              <li class='divider'></li>
              <li class='color-settings-contrast-color'>
                <div class='color-title'>Contrast color</div>
                            <a data-change-to="contrast-red" href="#"><i class='icon-cog text-red'></i>
                Red
                <small>(default)</small>
                </a>
    
                            <a data-change-to="contrast-blue" href="#"><i class='icon-cog text-blue'></i>
                Blue
                </a>
    
                            <a data-change-to="contrast-orange" href="#"><i class='icon-cog text-orange'></i>
                Orange
                </a>
    
                            <a data-change-to="contrast-purple" href="#"><i class='icon-cog text-purple'></i>
                Purple
                </a>
    
                            <a data-change-to="contrast-green" href="#"><i class='icon-cog text-green'></i>
                Green
                </a>
    
                            <a data-change-to="contrast-muted" href="#"><i class='icon-cog text-muted'></i>
                Muted
                </a>
    
                            <a data-change-to="contrast-fb" href="#"><i class='icon-cog text-fb'></i>
                Facebook
                </a>
    
                            <a data-change-to="contrast-dark" href="#"><i class='icon-cog text-dark'></i>
                Dark
                </a>
    
                            <a data-change-to="contrast-pink" href="#"><i class='icon-cog text-pink'></i>
                Pink
                </a>
    
                            <a data-change-to="contrast-grass-green" href="#"><i class='icon-cog text-grass-green'></i>
                Grass green
                </a>
    
                            <a data-change-to="contrast-sea-blue" href="#"><i class='icon-cog text-sea-blue'></i>
                Sea blue
                </a>
    
                            <a data-change-to="contrast-banana" href="#"><i class='icon-cog text-banana'></i>
                Banana
                </a>
    
                            <a data-change-to="contrast-dark-orange" href="#"><i class='icon-cog text-dark-orange'></i>
                Dark orange
                </a>
    
                            <a data-change-to="contrast-brown" href="#"><i class='icon-cog text-brown'></i>
                Brown
                </a>
    
              </li>
            </ul>
          </li>
          <li class='dropdown medium only-icon widget new'>
            <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
              <i class='icon-rss'></i>
              <div class='label'>5</div>
            </a>
            <ul class='dropdown-menu'>
              <li>
                <a href='#'>
                  <div class='widget-body'>
                    <div class='pull-left icon'>
                      <i class='icon-user text-success'></i>
                    </div>
                    <div class='pull-left text'>
                      John Doe signed up
                      <small class='text-muted'>just now</small>
                    </div>
                  </div>
                </a>
              </li>
              <li class='divider'></li>
              <li>
                <a href='#'>
                  <div class='widget-body'>
                    <div class='pull-left icon'>
                      <i class='icon-inbox text-error'></i>
                    </div>
                    <div class='pull-left text'>
                      New Order #002
                      <small class='text-muted'>3 minutes ago</small>
                    </div>
                  </div>
                </a>
              </li>
              <li class='divider'></li>
              <li>
                <a href='#'>
                  <div class='widget-body'>
                    <div class='pull-left icon'>
                      <i class='icon-comment text-warning'></i>
                    </div>
                    <div class='pull-left text'>
                      America Leannon commented Flatty with veeery long text.
                      <small class='text-muted'>1 hour ago</small>
                    </div>
                  </div>
                </a>
              </li>
              <li class='divider'></li>
              <li>
                <a href='#'>
                  <div class='widget-body'>
                    <div class='pull-left icon'>
                      <i class='icon-user text-success'></i>
                    </div>
                    <div class='pull-left text'>
                      Jane Doe signed up
                      <small class='text-muted'>last week</small>
                    </div>
                  </div>
                </a>
              </li>
              <li class='divider'></li>
              <li>
                <a href='#'>
                  <div class='widget-body'>
                    <div class='pull-left icon'>
                      <i class='icon-inbox text-error'></i>
                    </div>
                    <div class='pull-left text'>
                      New Order #001
                      <small class='text-muted'>1 year ago</small>
                    </div>
                  </div>
                </a>
              </li>
              <li class='widget-footer'>
                <a href='#'>All notifications</a>
              </li>
            </ul>
          </li>
          <li class='dropdown dark user-menu'>
            <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
              <img width="23" height="23" alt="Mila Kunis" src="<?php echo DOMAINAD?>/html/assets/images/avatar.jpg" />
              <span class='user-name'><?php echo $this->Session->read('name'); ?></span>
              <b class='caret'></b>
            </a>
            <ul class='dropdown-menu'>
              <li>
                <a href='user_profile.html'>
                  <i class='icon-user'></i>
                  Profile
                </a>
              </li>
              <li>
                <a href='user_profile.html'>
                  <i class='icon-cog'></i>
                  Settings
                </a>
              </li>
              <li class='divider'></li>
              <li>
                <a href='<?php echo DOMAINAD?>login/logout'>
                  <i class='icon-signout'></i>
                  Sign out
                </a>
              </li>
            </ul>
          </li>
        </ul>
        <form action='search_results.html' class='navbar-form navbar-right hidden-xs' method='get'>
          <button class='btn btn-link icon-search' name='button' type='submit'></button>
          <div class='form-group'>
            <input value="" class="form-control" placeholder="Search..." autocomplete="off" id="q_header" name="q" type="text" />
          </div>
        </form>
         <ul class='nav'>
         <li class='dropdown dark user-menu news'>
            <a class='dropdown-toggle'  href='<?php echo $urlcart ?>?language=vie'>
             <img id="langgue" align="absmiddle" src="<?php echo DOMAIN ?>images/vietnam.gif" />
              <span class='user-name'>Tiếng Việt</span>             
            </a>
          </li>
          <li class='dropdown dark user-menu news'>
            <a class='dropdown-toggle'  href='<?php echo $urlcart ?>?language=eng'>
             <img id="langgue" align="absmiddle" src="<?php echo DOMAIN ?>images/english.gif" />
              <span class='user-name'>Tiếng Anh</span>             
            </a>
          </li>    
         </ul>
      </nav>
      
    </header>