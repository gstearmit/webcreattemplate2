    <div id="sidebar">
       <div id="sidebar-wrapper"> 
        
        <h1 id="sidebar-title"><a href="#"></a></h1>
        <a href="#"><img id="logo" src="<?php echo DOMAINAD?>images/logo.png" alt="Design by Quảng cáo vip" /></a>
      
        <div id="profile-links">
             Xin chào, <a href="#" title="Edit your profile"><?php echo $this->Session->read('name'); ?></a><br />
            <br />
            <a href="<?php echo DOMAIN;?>" title="View the Site" target="_blank">Xem trang chủ</a> | <a href="<?php echo DOMAINAD?>login/logout" title="Sign Out">Thoát</a>
        </div>        
        <div id="list">
          <ul id="main-nav"> 
            
            <li id="arrayorder_1">
                <a href="<?php echo DOMAINADBUSINISS?>home" class="nav-top-item no-submenu">
                    Trang chủ
                </a>       
            </li>
           
            <li id="arrayorder_2">
                <a href="#" class="nav-top-item"> 
                  Sản phẩm
                </a>
                <ul>
                    <li><a class="current" href="<?php echo DOMAINADBUSINISS?>catproducts/index">Danh mục sản phẩm</a></li>
                    <li><a href="<?php echo DOMAINADBUSINISS?>catproducts/add">Thêm mới danh mục</a></li>
                    <li><a href="<?php echo DOMAINADBUSINISS?>products/index">Danh sách sản phẩm</a></li>
                    <li><a href="<?php echo DOMAINADBUSINISS?>products/add">Thêm mới sản phẩm</a></li>
                </ul>
            </li>
            
            <li id="arrayorder_3">
                <a href="#" class="nav-top-item"> 
                  Tin tức
                </a>
                <ul>
                    <li><a class="current" href="<?php echo DOMAINADBUSINISS?>category/index">Danh mục tin tức</a></li>
                    <li><a href="<?php echo DOMAINADBUSINISS?>category/add">Thêm mới danh mục tin</a></li>
                    <li><a href="<?php echo DOMAINADBUSINISS?>news/index">Danh sách tin tức</a></li>
                    <li><a href="<?php echo DOMAINADBUSINISS?>news/add">Thêm mới tin</a></li>
                </ul>
            </li>
            <li id="arrayorder_4">
                <a href="#" class="nav-top-item">
                    Slideshow
                </a>
                <ul>
                    <li><a href="<?php echo DOMAINADBUSINISS?>slideshow">Ảnh slide</a></li>
                    <li><a href="<?php echo DOMAINADBUSINISS?>slideshow/add">Thêm mới</a></li>
                </ul>
            </li>
           <li id="arrayorder_7">
                <a href="<?php echo DOMAINADBUSINISS?>settings/edit/1" class="nav-top-item no-submenu">Cấu hình</a>
            </li>   
            <li id="arrayorder_8">
                <a href="#" class="nav-top-item">Tài khoản</a>
                <ul>
                    <li><a href="<?php echo DOMAINADBUSINISS?>accounts">Tài khoản</a></li>
                    <li><a href="<?php echo DOMAINADBUSINISS?>accounts/add">Tạo tài khoản</a></li>
                </ul>
            </li>  
            <li id="arrayorder_10">
                <a href="#" class="nav-top-item">Quảng cáo dọc</a>
                <ul>
                    <li><a href="<?php echo DOMAINADBUSINISS?>advertisements">Danh sách</a></li>
                    <li><a href="<?php echo DOMAINADBUSINISS?>advertisements/add">Thêm mới</a></li>
                </ul>
            </li> 
            <li id="arrayorder_9">
                <a href="#" class="nav-top-item">Hot line</a>
                <ul>
                    <li><a href="<?php echo DOMAINADBUSINISS?>helps">Danh sách</a></li>
                    <li><a href="<?php echo DOMAINADBUSINISS?>helps/add">Thêm mới</a></li>
                </ul>
            </li>
			 <li id="arrayorder_9">
                <a href="#" class="nav-top-item">Đối tác</a>
                <ul>
                    <li><a href="<?php echo DOMAINADBUSINISS?>partners">Danh sách</a></li>
                    <li><a href="<?php echo DOMAINADBUSINISS?>partners/add">Thêm mới</a></li>
                </ul>
            </li>
			 <li id="arrayorder_9">
                <a href="#" class="nav-top-item">Video</a>
                <ul>
                    <li><a href="<?php echo DOMAINADBUSINISS?>videos/index">Danh sách</a></li>
                    <li><a href="<?php echo DOMAINADBUSINISS?>videos/add">Thêm mới</a></li>
                </ul>
            </li>
			
            <li id="arrayorder_12">
                <a href="<?php echo DOMAINADBUSINISS?>banners/edit/1" class="nav-top-item no-submenu">Banner</a>
            </li>  
        </ul> 
        </div>
    </div>
    </div>
