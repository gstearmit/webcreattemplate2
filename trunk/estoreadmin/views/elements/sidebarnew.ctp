 <?php include 'views/elements/language.ctp';?>
<nav id='main-nav'>
        <div class='navigation'>
          <div class='search'>
            <form action='search_results.html' method='get'>
              <div class='search-wrapper'>
                <input value="" class="search-query form-control" placeholder="Search..." autocomplete="off" name="q" type="text" />
                <button class='btn btn-link icon-search' name='button' type='submit'></button>
              </div>
            </form>
          </div>
          <ul class='nav nav-stacked'>
            <li class='active'>
              <a href='<?php echo DOMAINAD?>home<?php echo $langs; ?>'>
                <i class='icon-dashboard'></i>
                <span><?php __('home')?></span>
              </a>
            </li>
            <li>
              <a class='dropdown-collapse ' href='#'>
                <i class='icon-cog'></i>
                <span> <?php __('product')?> </span>
                <i class='icon-angle-down angle-down'></i>
              </a>
              <ul class='nav nav-stacked'>
                <li class=''>
                  <a href="<?php echo DOMAINADESTORE?>catproducts/index<?php echo $langs ?>">
                    <i class='icon-caret-right'></i>
                    <span><?php __('Category_product')?></span>
                  </a>
                </li>
                <li class=''>
                  <a href="<?php echo DOMAINADESTORE?>catproducts/add<?php echo $langs ?>">
                    <i class='icon-caret-right'></i>
                    <span><?php __('Add_Category')?></span>
                  </a>
                </li>
                <li class=''>
                  <a href="<?php echo DOMAINADESTORE?>products/index<?php echo $langs ?>">
                    <i class='icon-caret-right'></i>
                    <span><?php __('Product_list')?></span>
                  </a>
                </li>
                <li class=''>
                  <a href="<?php echo DOMAINADESTORE?>products/add<?php echo $langs ?>">
                    <i class='icon-caret-right'></i>
                    <span><?php __('Add_product')?></span>
                  </a>               
              </ul>
            </li> <!-- END PRODUCT -->
            <li>
              <a class='dropdown-collapse ' href='#'>
                <i class='icon-cog'></i>
                <span> <?php __('Producer')?> </span>
                <i class='icon-angle-down angle-down'></i>
              </a>
              <ul class='nav nav-stacked'>
                <li class=''>
                  <a href="<?php echo DOMAINADESTORE?>manufacturers<?php echo $langs ?>">
                    <i class='icon-caret-right'></i>
                    <span><?php __('Producers_list')?></span>
                  </a>
                </li>
                <li class=''>
                  <a href="<?php echo DOMAINADESTORE?>manufacturers/add<?php echo $langs ?>">
                    <i class='icon-caret-right'></i>
                    <span><?php __('Add_new')?></span>
                  </a>
                </li>                
              </ul>
            </li>  <!-- END NOTE -->
             <li>
              <a class='dropdown-collapse ' href='#'>
                <i class='icon-cog'></i>
                <span><?php __('Orders')?></span>
                <i class='icon-angle-down angle-down'></i>
              </a>
              <ul class='nav nav-stacked'>
                <li class=''>
                 <a href="<?php echo DOMAINADESTORE?>infomations<?php echo $langs ?>">
                    <i class='icon-caret-right'></i>
                    <span><?php __('Orders')?></span>
                  </a>
                </li>
               </ul> 
            </li> <!-- END MANAGERSHOP -->
             <li>
              <a class='dropdown-collapse ' href='#'>
                <i class='icon-cog'></i>
                <span><?php __('News')?> </span>
                <i class='icon-angle-down angle-down'></i>
              </a>
              <ul class='nav nav-stacked'>
                <li class=''>
                  <a href="<?php echo DOMAINADESTORE?>category/index<?php echo $langs ?>">
                    <i class='icon-caret-right'></i>
                    <span><?php __('News_category')?></span>
                  </a>
                </li>
                <li class=''>
                  <a href="<?php echo DOMAINADESTORE?>category/add<?php echo $langs ?>">
                    <i class='icon-caret-right'></i>
                    <span><?php __('Add_category_news')?></span>
                  </a>
                </li>
                <li class=''>
                  <a href="<?php echo DOMAINADESTORE?>news/index<?php echo $langs ?>">
                    <i class='icon-caret-right'></i>
                    <span><?php __('News_list')?></span>
                  </a>
                </li>
                <li class=''>
                  <li><a href="<?php echo DOMAINADESTORE?>news/add<?php echo $langs ?>">
                    <i class='icon-caret-right'></i>
                    <span><?php __('Add_news')?></span>
                  </a>
                </li>
                </ul> 
            </li><!-- END ODER -->
            <li>
              <a class='dropdown-collapse ' href='#'>
                <i class='icon-cog'></i>
                <span>  <?php __('Comments_management')?> </span>
                <i class='icon-angle-down angle-down'></i>
              </a>
              <ul class='nav nav-stacked'>
                <li class=''>
                  <a href="<?php echo DOMAINADESTORE?>comments<?php echo $langs ?>">
                    <i class='icon-caret-right'></i>
                    <span><?php __('Comments_list')?></span>
                  </a>
                </li>               
                </ul> 
            </li><!-- END CITY -->
             <li>
              <a class='dropdown-collapse ' href='#'>
                <i class='icon-cog'></i>
                <span> <?php __('Ad_management')?></span>
                <i class='icon-angle-down angle-down'></i>
              </a>
              <ul class='nav nav-stacked'>
                <li class=''>
                  <a href="<?php echo DOMAINADESTORE?>advertisements<?php echo $langs ?>">
                    <i class='icon-caret-right'></i>
                    <span><?php __('Ad_list')?></span>
                  </a>
                </li>
                 <li class=''>
                  <a href="<?php echo DOMAINADESTORE?>advertisements/add<?php echo $langs ?>">
                    <i class='icon-caret-right'></i>
                    <span><?php __('Add_new')?></span>
                  </a>
                </li>
             </ul> 
            </li><!-- END CONFIGURE -->
            <li>
              <a class='dropdown-collapse ' href='#'>
                <i class='icon-cog'></i>
                <span><?php __('Slideshow_management')?></span>
                <i class='icon-angle-down angle-down'></i>
              </a>
              <ul class='nav nav-stacked'>
                <li class=''>
                  <a href="<?php echo DOMAINADESTORE?>slideshow<?php echo $langs ?>">
                    <i class='icon-caret-right'></i>
                    <span><?php __('Slide_image')?></span>
                  </a>
                </li>
                 <li class=''>
                  <a href="<?php echo DOMAINADESTORE?>slideshow/add<?php echo $langs ?>">
                    <i class='icon-caret-right'></i>
                    <span><?php __('Add_new')?></span>
                  </a>
                </li>
             </ul> 
            </li><!-- END ACCOUNT -->
            <li>
              <a class='dropdown-collapse ' href='#'>
                <i class='icon-cog'></i>
                <span> <?php __('Video_management')?></span>
                <i class='icon-angle-down angle-down'></i>
              </a>
              <ul class='nav nav-stacked'>
                <li class=''>
                  <a href="<?php echo DOMAINADESTORE?>videos<?php echo $langs ?>">
                    <i class='icon-caret-right'></i>
                    <span><?php __('Video_list')?></span>
                  </a>
                </li>
                 <li class=''>
                  <a href="<?php echo DOMAINADESTORE?>videos/add<?php echo $langs ?>">
                    <i class='icon-caret-right'></i>
                    <span><?php __('Add_video')?></span>
                  </a>
                </li>
             </ul> 
            </li><!-- END SUPPORT -->
             <li>
              <a class='dropdown-collapse ' href='#'>
                <i class='icon-cog'></i>
                <span><?php __('Account')?></span>
                <i class='icon-angle-down angle-down'></i>
              </a>
              <ul class='nav nav-stacked'>
                <li class=''>
                  <a href="<?php echo DOMAINADESTORE?>accounts<?php echo $langs ?>">
                    <i class='icon-caret-right'></i>
                    <span><?php __('Account')?></span>
                  </a>
                </li>
                <li class=''>
                  <a href="<?php echo DOMAINADESTORE?>accounts/add<?php echo $langs ?>">
                    <i class='icon-caret-right'></i>
                    <span><?php __('Creat_account')?></span>
                  </a>
                </li>
             </ul> 
            </li>
            <!-- ///////////////////// -->
            <li>
              <a class='dropdown-collapse ' href='#'>
                <i class='icon-cog'></i>
                <span><?php __('Partners')?></span>
                <i class='icon-angle-down angle-down'></i>
              </a>
              <ul class='nav nav-stacked'>
                <li class=''>
                 <a href="<?php echo DOMAINADESTORE?>partners<?php echo $langs ?>">
                    <i class='icon-caret-right'></i>
                    <span><?php __('Partners_list')?></span>
                  </a>
                </li>
                <li class=''>
                  <a href="<?php echo DOMAINADESTORE?>partners/add<?php echo $langs ?>">
                    <i class='icon-caret-right'></i>
                    <span><?php __('Add_new')?></span>
                  </a>
                </li>
             </ul> 
            </li>
            <!-- /////////////////////////////// -->
             <li>
              <a class='dropdown-collapse ' href='#'>
                <i class='icon-cog'></i>
                <span><?php __('Link_website')?></span>
                <i class='icon-angle-down angle-down'></i>
              </a>
              <ul class='nav nav-stacked'>
                <li class=''>
                <a href="<?php echo DOMAINADESTORE?>weblinks<?php echo $langs ?>">
                    <i class='icon-caret-right'></i>
                    <span><?php __('Link_list')?></span>
                  </a>
                </li>
                <li class=''>
                  <a href="<?php echo DOMAINADESTORE?>weblinks/add<?php echo $langs ?>">
                    <i class='icon-caret-right'></i>
                    <span><?php __('Add_new')?></span>
                  </a>
                </li>
             </ul> 
            </li>
             <!-- /////////////////////////////// -->
             <li>
              <a class='dropdown-collapse ' href='#'>
                <i class='icon-cog'></i>
                <span><?php __('Hotline')?></span>
                <i class='icon-angle-down angle-down'></i>
              </a>
              <ul class='nav nav-stacked'>
                <li class=''>
                <a href="<?php echo DOMAINADESTORE?>helps/<?php echo $langs ?>">
                    <i class='icon-caret-right'></i>
                    <span><?php __('Hotline')?></span>
                  </a>
                </li>
                <li class=''>
                  <a href="<?php echo DOMAINADESTORE?>helps/add<?php echo $langs ?>">
                    <i class='icon-caret-right'></i>
                    <span><?php __('Add_new')?></span>
                  </a>
                </li>
             </ul> 
            </li>
            <!-- /////////////////////////////// -->
             <li>
              <a class='dropdown-collapse ' href='#'>
                <i class='icon-cog'></i>
                <span><?php __('Banner')?></span>
                <i class='icon-angle-down angle-down'></i>
              </a>
              <ul class='nav nav-stacked'>
                <li class=''>
                <a href="<?php echo DOMAINADESTORE?>banners/<?php echo $langs ?>">
                    <i class='icon-caret-right'></i>
                    <span><?php __('List')?></span>
                  </a>
                </li>
                <li class=''>
                  <a href="<?php echo DOMAINADESTORE?>banners/add<?php echo $langs ?>">
                    <i class='icon-caret-right'></i>
                    <span><?php __('Add_new')?></span>
                  </a>
                </li>
             </ul> 
            </li>
            <!-- /////////////////////////////// -->
             <li>
              <a class='dropdown-collapse ' href='#'>
                <i class='icon-cog'></i>
                <span><?php __('Website_configuration')?></span>
                <i class='icon-angle-down angle-down'></i>
              </a>
              <ul class='nav nav-stacked'>
                <li class=''>
                <a href="<?php echo DOMAINADESTORE?>settings/edit/1<?php echo $langs ?>">
                    <i class='icon-caret-right'></i>
                    <span><?php __('Website_configuration')?></span>
                  </a>
                </li>                
             </ul> 
            </li>
         </ul>
      
        </div>
      </nav>