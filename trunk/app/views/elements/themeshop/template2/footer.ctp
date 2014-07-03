<?php 
			
			$shop=explode('/',$this->params['url']['url']); 
			$shopname=$shop[0];
	
			?>

 <div id='footer'>
            <ul>
                <li> <a href="<?php echo DOMAIN.$shopname?>">Trang chủ |</a> </li>
				<li> <a href="<?php echo DOMAIN.$shopname?>/danh_muc_san_pham">Sản phẩm |</a> </li>
                <li> <a href="<?php echo DOMAIN.$shopname?>/gioi-thieu">Giới thiệu |</a> </li>
                <li> <a href="<?php echo DOMAIN.$shopname?>/khuyen-mai">Khuyến mại |</a> </li>
                <li> <a href="<?php echo DOMAIN.$shopname?>/tuyen-dung">Tin tức </a> </li>
            </ul>

        </div><!--end #footer-->
    </div><!--end #main-->
</body>
</html>