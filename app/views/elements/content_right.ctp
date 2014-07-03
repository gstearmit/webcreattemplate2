   <style>
   .a-link{
   color:black; font-weight:bold;
   
   }
   .red-bold{color:blue;}
   .a-link :hover , .red-bold:hover{color:red;}
   
   </style>
   <div id='side-right' style="margin-top:12px;">
            <div class='boxes'>
                <h2>ĐĂNG NHẬP</h2>
				<?php if($this->Session->read('shopname')!=''){ ?>
			<div style="margin-top:20px; overflow:hidden; text-align:center; margin-bottom:10px;">
			<b style="color:black;" >Xin chào: </b> 
			
			<span style="color:#124382; font-weight:bold;">
			<?php echo $this->Session->read('shopname');?>
			</span>
			<a style="color:black;" href="<?php echo DOMAIN?>userscms/logout">/ Thoát</a>
			
			<p style="width:100%; overflow:hidden; margin-top:10px;"> 
			<a class="red-bold" href="<?php echo DOMAIN?>thanh-vien">Quản trị gian hàng</a>
			</p>
			</div>
			<?php } else {?>
				
                <div class="form-login" style="margin-left:7px; padding-bottom:20px;">
				<form class="cmxform" id="signupForm" method="POST" action="<?php echo DOMAIN?>login/check_login">
                            <input type="hidden" value="1511" name="form_module_id">
                            <p class="clearfix"><label for="">&nbsp;</label><span class="red-bold"></span></p>
                            <p class="clearfix">
                                <label>Tên đăng nhập:</label>
                                <input type="text" tabindex="1" style="width: 180px; height:20px;" name="shopname" class="login-new-input" >
                            </p>
                            <p class="clearfix">
                                <label>Mật khẩu:</label>
                                <input type="password" tabindex="2" style="width: 180px; height:20px;" name="password" class="login-new-input">
                            </p>
                              
                         
                            <p class="clearfix" style="margin-top:5px;">
                                <label>&nbsp;</label>
                                <span style="margin-left: 50px; " class="btn-center">
                                	<button type="submit" class="submit-button-orange">Đăng nhập</button>
                                </span>
                                   
                            </p>
                            <p class="clearfix" style="margin-top:5px;">
                                <label for="">&nbsp;</label>
                                <span style="margin-left: 15px;"><a href="quen-mat-khau.html" class="red-bold">Quên mật khẩu?</a> | <a  class="red-bold" href="<?php echo DOMAIN;?>dang-ky">Đăng ký mới</a></span>
                                  
                            </p>
					</form>
                        </div>
                <?php }?>
            </div><!--end .boxes-->
            <div class='boxes'>
                <h2>KHUYẾN MẠI MỚI NHẤT</h2>
				
					<?php 
					
					$tinkhuyenmai=$this->requestAction('comment/tinkhuyenmai');
					$i=0;
					
					foreach($tinkhuyenmai as $row){
					
					$kt=$this->requestAction('comment/kt_shop/'.$row['Newshop']['shop_id']);
					if($kt){
					$i++;
					
					$nameshop=$this->requestAction('comment/get_name_shop/ '.$row['Newshop']['shop_id']);
					//pr($nameshop); die;
					foreach($nameshop as $name){  
					?>
				
                <div class='promotion' style="widht:100%; overflow:hidden;">
                    <a style="float:left" href="<?php echo DOMAIN.$name?>/chi_tiet_tin_tuc/<?php echo $row['Newshop']['id'] ?>">
					<img style="width:60px; height:60px;" src="<?php  echo DOMAIN.$row['Newshop']['images']?>" alt="Giảm Giá Máy Ảnh ">
					</a>
                    <p style="float:left;width:100px; overflow:hidden;">  
					
					<a class="a-link" href="<?php echo DOMAIN.$name?>/chi_tiet_tin_tuc/<?php echo $row['Newshop']['id'] ?>">
					<?php echo $row['Newshop']['title']?>
					<a>
					</p>
                </div>

				
				<?php 
				}
				}
				if($i==5) break;
				}?>
                <div class="clear"></div>
            </div><!--end .boxes-->
            <div class='boxes'>
                <h2>RAO VẶT MỚI NHẤT</h2>
				
				<?php 
				$raovat= $this->requestAction('comment/raovat');
				$i=0;
				
				foreach( $raovat as $row){
				
				$kt=$this->requestAction('comment/kt_shop/'.$row['Newshop']['shop_id']);
					if($kt){
					$i++;
				$nameshop=$this->requestAction('comment/get_name_shop/'.$row['Newshop']['shop_id']);
				foreach($nameshop as $nameshop)
				?>
				
              <div class='promotion' style="widht:100%; overflow:hidden;">
                    <a style="float:left"=href="<?php echo DOMAIN.$nameshop?>/chi_tiet_tin_tuc/<?php echo $row['Newshop']['id'] ?>">
					<img style="width:60px; height:60px;" src="<?php  echo DOMAIN.$row['Newshop']['images']?>" alt="Giảm Giá Máy Ảnh "></a>
                    <p style="float:left;width:100px; overflow:hidden;">  
					
					<a class="a-link" href="<?php echo DOMAIN.$nameshop?>/chi_tiet_tin_tuc/<?php echo $row['Newshop']['id'] ?>">
					<?php echo $row['Newshop']['title']?>
					<a>
					</p>
                </div>

				
              <?php }
			  if($i==3) break;
			  }
			  ?>
			  
                <div class="clear"></div>
            </div><!--end .boxes-->
        </div><!--end #side-right-->