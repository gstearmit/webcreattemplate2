    <div id="sidebar">
       <div id="sidebar-wrapper"> 
        
        <h1 id="sidebar-title"><a href="#"></a></h1>
        <a href="#"><img id="logo" src="<?php echo DOMAINADESTORE?>images/logo.png" alt="Design by Quảng cáo vip" /></a>
      
        <div id="profile-links">
             Xin chào, <a href="#" title="Edit your profile"><?php echo $this->Session->read('name'); ?></a><br />
            <br />
            <a href="<?php echo DOMAIN;?>" title="View the Site" target="_blank">Xem trang chủ</a> | <a href="<?php echo DOMAINADESTORE?>login/logout" title="Sign Out">Thoát</a>
        </div>        
        <div id="list">
          <ul id="main-nav"> 
            
            <li id="arrayorder_1">
                <a href="<?php echo DOMAINADESTORE?>home" class="nav-top-item no-submenu">
                     <?php __('slogan')?> Trang chủ
                </a>       
            </li>
<!--             <li id="arrayorder_2">-->
<!--                <a href="#" class="nav-top-item"> -->
<!--                  Menu-->
<!--                </a>-->
<!--                <ul>-->
<!--                    <li><a href="<?php echo DOMAINADESTORE?>menu/index">Danh sách menu</a></li>-->
<!--                    <li><a href="<?php echo DOMAINADESTORE?>menu/add">Thêm mới menu</a></li>-->
<!--                </ul>-->
<!--            </li>-->
            <li id="arrayorder_2">
                <a href="#" class="nav-top-item"> 
                  Sản phẩm
                </a>
                <ul>
                    <li><a class="current" href="<?php echo DOMAINADESTORE?>catproducts/index">Danh mục sản phẩm</a></li>
                    <li><a href="<?php echo DOMAINADESTORE?>catproducts/add">Thêm mới danh mục</a></li>
                    <li><a href="<?php echo DOMAINADESTORE?>products/index">Danh sách sản phẩm</a></li>
                    <li><a href="<?php echo DOMAINADESTORE?>products/add">Thêm mới sản phẩm</a></li>
                </ul>
            </li>
            <li id="arrayorder_4">
                <a href="#" class="nav-top-item">
                    Hãng sản xuất
                </a>
                <ul>
                    <li><a href="<?php echo DOMAINADESTORE?>manufacturers">Danh sách</a></li>
                    <li><a href="<?php echo DOMAINADESTORE?>manufacturers/add">Thêm mới</a></li>
                </ul>
            </li>
            <li id="arrayorder_7">
                <a href="<?php echo DOMAINADESTORE?>infomations" class="nav-top-item no-submenu">Đơn hàng</a>
            </li> 
            <li id="arrayorder_3">
                <a href="#" class="nav-top-item"> 
                  Tin tức
                </a>
                <ul>
                    <li><a class="current" href="<?php echo DOMAINADESTORE?>category/index">Danh mục tin tức</a></li>
                    <li><a href="<?php echo DOMAINADESTORE?>category/add">Thêm mới danh mục tin</a></li>
                    <li><a href="<?php echo DOMAINADESTORE?>news/index">Danh sách tin tức</a></li>
                    <li><a href="<?php echo DOMAINADESTORE?>news/add">Thêm mới tin</a></li>
                </ul>
            </li>
             <li id="arrayorder_4">
                <a href="#" class="nav-top-item">
                    Quản lý góp ý
                </a>
                <ul>
                    <li><a href="<?php echo DOMAINADESTORE?>comments">Danh sách góp y</a></li>
                   
                </ul>
            </li>
            <li id="arrayorder_4">
                <a href="#" class="nav-top-item">
                    Quản lý Quảng cáo
                </a>
                <ul>
                    <li><a href="<?php echo DOMAINADESTORE?>advertisements">Danh sách quảng cáo</a></li>
                    <li><a href="<?php echo DOMAINADESTORE?>advertisements/add">Thêm mới</a></li>
                </ul>
            </li>
            <li id="arrayorder_4">
                <a href="#" class="nav-top-item">
                    Quản lý Slideshow
                </a>
                <ul>
                    <li><a href="<?php echo DOMAINADESTORE?>slideshow">Ảnh slide</a></li>
                    <li><a href="<?php echo DOMAINADESTORE?>slideshow/add">Thêm mới</a></li>
                </ul>
            </li>
            <li id="arrayorder_4">
                <a href="#" class="nav-top-item">
                    Quản lý video
                </a>
                <ul>
                    <li><a href="<?php echo DOMAINADESTORE?>videos">Danh sách video</a></li>
                   <li><a href="<?php echo DOMAINADESTORE?>videos/add">Thêm video</a></li>
                </ul>
            </li>
<!--            <li id="arrayorder_3">-->
<!--                <a href="#" class="nav-top-item">-->
<!--                    Thư viện ảnh-->
<!--                </a>-->
<!--                <ul>-->
<!--                    <li><a href="<?php echo DOMAINADESTORE?>album">Danh sách Album</a></li>-->
<!--                    <li><a href="<?php echo DOMAINADESTORE?>album/add">Thêm Album</a></li>-->
<!--                    <li><a href="<?php echo DOMAINADESTORE?>gallery/index">Danh sách ảnh Ablum</a></li>-->
<!--                    <li><a href="<?php echo DOMAINADESTORE?>gallery/add">Thêm ảnh vào Ablum</a></li>-->
<!--                </ul>-->
<!--            </li>-->
             
             
            <li id="arrayorder_8">
                <a href="#" class="nav-top-item">Tài khoản</a>
                <ul>
                    <li><a href="<?php echo DOMAINADESTORE?>accounts">Tài khoản</a></li>
                    <li><a href="<?php echo DOMAINADESTORE?>accounts/add">Tạo tài khoản</a></li>
                </ul>
            </li>   
             <li id="arrayorder_10">
                <a href="#" class="nav-top-item">Đối tác</a>
                <ul>
                    <li><a href="<?php echo DOMAINADESTORE?>partners">Danh sách đối tác</a></li>
                    <li><a href="<?php echo DOMAINADESTORE?>partners/add">Thêm mới</a></li>
                </ul>
            </li> 
             <li id="arrayorder_10">
                <a href="#" class="nav-top-item">Liên kết website</a>
                <ul>
                    <li><a href="<?php echo DOMAINADESTORE?>weblinks">Danh sách link</a></li>
                    <li><a href="<?php echo DOMAINADESTORE?>weblinks/add">Thêm mới</a></li>
                </ul>
            </li> 
            <li id="arrayorder_9">
                <a href="#" class="nav-top-item">Hot line</a>
                <ul>
                    <li><a href="<?php echo DOMAINADESTORE?>helps/edit/7">Thay đổi hotline</a></li>
                   
                </ul>
            </li>
            <li id="arrayorder_12">
                <a href="<?php echo DOMAINADESTORE?>banners/edit/1" class="nav-top-item no-submenu">Banner</a>
            </li>  
            <li id="arrayorder_7">
                <a href="<?php echo DOMAINADESTORE?>settings/edit/1" class="nav-top-item no-submenu">Cấu hình website </a>
            </li> 
        </ul> 
        </div>
    </div>
    </div>
