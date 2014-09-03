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
                  <a href='<?php echo DOMAINAD?>catproducts/<?php echo $langs; ?>'>
                    <i class='icon-caret-right'></i>
                    <span><?php __('Category_product')?></span>
                  </a>
                </li>
                <li class=''>
                  <a href='<?php echo DOMAINAD?>catproducts/add<?php echo $langs; ?>'>
                    <i class='icon-caret-right'></i>
                    <span><?php __('Add_Category')?></span>
                  </a>
                </li>
                <li class=''>
                  <a href='<?php echo DOMAINAD?>products/index<?php echo $langs; ?>'>
                    <i class='icon-caret-right'></i>
                    <span><?php __('Product_List')?></span>
                  </a>
                </li>
                <li class=''>
                  <a href='<?php echo DOMAINAD?>products/add<?php echo $langs; ?>'>
                    <i class='icon-caret-right'></i>
                    <span><?php __('Add_product')?></span>
                  </a>
                </li>
                 <li class=''>
                  <a href='<?php echo DOMAINAD?>gallery/index<?php echo $langs; ?>'>
                    <i class='icon-caret-right'></i>
                    <span><?php __('list_img')?></span>
                  </a>
                </li>
                <li class=''>
                  <a href='<?php echo DOMAINAD?>gallery/add<?php echo $langs; ?>'>
                    <i class='icon-caret-right'></i>
                    <span><?php __('Add_img')?></span>
                  </a>
                </li>
              </ul>
            </li> <!-- END PRODUCT -->
            <li>
              <a class='dropdown-collapse ' href='#'>
                <i class='icon-cog'></i>
                <span> <?php __('Notes')?> </span>
                <i class='icon-angle-down angle-down'></i>
              </a>
              <ul class='nav nav-stacked'>
                <li class=''>
                  <a href='<?php echo DOMAINAD?>catproducts/index<?php echo $langs; ?>'>
                    <i class='icon-caret-right'></i>
                    <span><?php __('Category_notes')?></span>
                  </a>
                </li>
                <li class=''>
                  <a href='<?php echo DOMAINAD?>catproducts/add<?php echo $langs; ?>'>
                    <i class='icon-caret-right'></i>
                    <span><?php __('Add_Category')?></span>
                  </a>
                </li>
                <li class=''>
                  <a href='<?php echo DOMAINAD?>Notes/index<?php echo $langs; ?>'>
                    <i class='icon-caret-right'></i>
                    <span><?php __('Notes_List')?></span>
                  </a>
                </li>
                <li class=''>
                  <a href='<?php echo DOMAINAD?>Notes/add<?php echo $langs; ?>'>
                    <i class='icon-caret-right'></i>
                    <span><?php __('Add_notes')?></span>
                  </a>
                </li>
              </ul>
            </li>  <!-- END NOTE -->
             <li>
              <a class='dropdown-collapse ' href='#'>
                <i class='icon-cog'></i>
                <span>    <?php __('Management_shop')?> </span>
                <i class='icon-angle-down angle-down'></i>
              </a>
              <ul class='nav nav-stacked'>
                <li class=''>
                  <a href='<?php echo DOMAINAD?>newshops/index<?php echo $langs; ?>'>
                    <i class='icon-caret-right'></i>
                    <span><?php __('News_management')?></span>
                  </a>
                </li>
                <li class=''>
                  <a href='<?php echo DOMAINAD?>shops/index<?php echo $langs; ?>'>
                    <i class='icon-caret-right'></i>
                    <span><?php __('Management_shop')?></span>
                  </a>
                </li>
                <li class=''>
                  <a href='<?php echo DOMAINAD?>userscms/index<?php echo $langs; ?>'>
                    <i class='icon-caret-right'></i>
                    <span><?php __('Customer_Management')?></span>
                  </a>
                </li>   
                </ul> 
            </li> <!-- END MANAGERSHOP -->
             <li>
              <a class='dropdown-collapse ' href='#'>
                <i class='icon-cog'></i>
                <span> <?php __('Oder_Management')?> </span>
                <i class='icon-angle-down angle-down'></i>
              </a>
              <ul class='nav nav-stacked'>
                <li class=''>
                  <a href='<?php echo DOMAINAD?>orders/index<?php echo $langs; ?>'>
                    <i class='icon-caret-right'></i>
                    <span><?php __('Oder_List')?></span>
                  </a>
                </li>
                </ul> 
            </li><!-- END ODER -->
            <li>
              <a class='dropdown-collapse ' href='#'>
                <i class='icon-cog'></i>
                <span>  <?php __('City')?> </span>
                <i class='icon-angle-down angle-down'></i>
              </a>
              <ul class='nav nav-stacked'>
                <li class=''>
                  <a href='<?php echo DOMAINAD?>city/index<?php echo $langs; ?>'>
                    <i class='icon-caret-right'></i>
                    <span><?php __('City_List')?></span>
                  </a>
                </li>
                <li class=''>
                  <a href='<?php echo DOMAINAD?>city/add<?php echo $langs; ?>'>
                    <i class='icon-caret-right'></i>
                    <span><?php __('Add_city')?></span>
                  </a>
                </li>
                </ul> 
            </li><!-- END CITY -->
             <li>
              <a class='dropdown-collapse ' href='#'>
                <i class='icon-cog'></i>
                <span> <?php __('Configuration')?></span>
                <i class='icon-angle-down angle-down'></i>
              </a>
              <ul class='nav nav-stacked'>
                <li class=''>
                  <a href='<?php echo DOMAINAD?>settings/edit/1<?php echo $langs; ?>'>
                    <i class='icon-caret-right'></i>
                    <span><?php __('Web_Configuration')?></span>
                  </a>
                </li>
             </ul> 
            </li><!-- END CONFIGURE -->
            <li>
              <a class='dropdown-collapse ' href='#'>
                <i class='icon-cog'></i>
                <span><?php __('acount')?></span>
                <i class='icon-angle-down angle-down'></i>
              </a>
              <ul class='nav nav-stacked'>
                <li class=''>
                  <a href='<?php echo DOMAINAD?>accounts<?php echo $langs; ?>'>
                    <i class='icon-caret-right'></i>
                    <span><?php __('acount')?></span>
                  </a>
                </li>
                 <li class=''>
                  <a href='<?php echo DOMAINAD?>accounts/add<?php echo $langs; ?>'>
                    <i class='icon-caret-right'></i>
                    <span><?php __('Create_acount')?></span>
                  </a>
                </li>
             </ul> 
            </li><!-- END ACCOUNT -->
            <li>
              <a class='dropdown-collapse ' href='#'>
                <i class='icon-cog'></i>
                <span><?php __('Online_support')?></span>
                <i class='icon-angle-down angle-down'></i>
              </a>
              <ul class='nav nav-stacked'>
                <li class=''>
                  <a href='<?php echo DOMAINAD?>helps<?php echo $langs; ?>'>
                    <i class='icon-caret-right'></i>
                    <span><?php __('Online_list')?></span>
                  </a>
                </li>
                 <li class=''>
                  <a href='<?php echo DOMAINAD?>helps/add<?php echo $langs; ?>'>
                    <i class='icon-caret-right'></i>
                    <span><?php __('Add_Online')?></span>
                  </a>
                </li>
             </ul> 
            </li><!-- END SUPPORT -->
             <li>
              <a class='dropdown-collapse ' href='#'>
                <i class='icon-cog'></i>
                <span><?php __('Video')?></span>
                <i class='icon-angle-down angle-down'></i>
              </a>
              <ul class='nav nav-stacked'>
                <li class=''>
                  <a href='<?php echo DOMAINAD?>videos/index<?php echo $langs; ?>'>
                    <i class='icon-caret-right'></i>
                    <span><?php __('Video')?></span>
                  </a>
                </li>
                <li class=''>
                  <a href='<?php echo DOMAINAD?>videos/add<?php echo $langs; ?>'>
                    <i class='icon-caret-right'></i>
                    <span><?php __('Add_New')?></span>
                  </a>
                </li>
             </ul> 
            </li>
         </ul>
      
        </div>
      </nav>