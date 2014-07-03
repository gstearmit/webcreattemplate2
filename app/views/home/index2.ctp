<style>
      p{text-align:justify;}
     .aghang:hover{
            text-decoration:underline;
          }
    .a-ten{
         color:#2FB34B;
         }
    .a-ten:hover {
        text-decoration:underline;
        font-weight:bold;
        }
    
    .li-chon a:hover{text-decoration:underline;color:#fff;}
</style>
  
 
<!-- slide -->
        <script src="<?php echo DOMAIN ?>js/jquery.bxSlider.min.js" type="text/javascript"></script>
        <script type="text/javascript">
              $(document).ready(function(){
                $('#slider1').bxSlider(
            	auto:false,
            	);
              });
        </script>
        
        <script src="<?php echo DOMAIN ?>js/easySlider1.5.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?php echo DOMAIN ?>js/jquery.jcarousel.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?php echo DOMAIN ?>js/js-func.js" type="text/javascript" charset="utf-8"></script>
          <link type="text/css" href="<?php echo DOMAIN?>css/slider.css" rel="stylesheet">
<!-- End slide -->

<script src="<?php echo DOMAIN?>js/fancybox/jquery.fancybox-1.3.2.js" type="text/javascript"></script>
<script src="<?php echo DOMAIN?>js/jcarousellite.js" type="text/javascript"></script>

<link rel="stylesheet" href="<?php echo DOMAIN ?>css/jquery-ui-1.8.19.custom.css" type="text/css" media="all" />
<script type="text/javascript" src="<?php echo DOMAIN ?>js/jquery-ui-1.8.19.custom.min.js"></script>

<script type="text/javascript">

        $(function() {
        
         $( "#dialog:ui-dialog" ).dialog( "destroy" );
        
                $( "#dialog-modal" ).dialog({
                    height: 140,
                    modal: true
                });
        
        	$(".newsticker-jcarousellite").jCarouselLite({
        			btnNext: "#next",
                    btnPrev: "#pre",
                    mouseWheel: true,
                    visible: 4,
                    scroll: 1,
                    liWidth: 225,
                    liHeight: 235,
                    circular: true,
                    speed: 2000,
                    auto: false,
        			items:5
        			
        	});
        });
</script>
 
 <script>
    	function test1(){		
            emailRegExp = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.([a-z]){2,4})$/;
    		var email = document.getElementById("txtdangky1").value;
            if(!emailRegExp.test(email)){
    			$('#test1').html('Hãy nhập đúng email');	
    			return false;			
                }
    		else
    		 
    			return true;
    		
                }
			
</script>
  <link rel="stylesheet" type="text/css" href="<?php echo DOMAIN ?>css/jcarousellite.css" />
  <link type="text/css" href="<?php echo DOMAIN ?>css/phantrang.css" rel="stylesheet" /> 
 
<div id="main-content">
   <?php  $email=$this->Session->read('email');
          @session_start();
          $email1=isset($_SESSION['email'])?$_SESSION['email']:'';
           if($email!='true' && $email1 ==null) 
             {
              $_SESSION['email']='true';

   ?>         
                  <!-- bat ra hop thoai de dang ki mail -->
                    <div id="dialog-modal"  title="Đăng ký email ngay để nhận giá trị tốt nhất" >
                            <form action="<?php echo DOMAIN?>dang-ky-email" method="post" name="formdk" onsubmit="return test1();">
                    				<input style="width:260px;" type="text" name="txtdk"  id="txtdangky1" value="Đăng nhập email để nhận giá trị tốt nhất" onclick="this.value=''" onblur="if (this.value == '')  {this.value = 'Đăng nhập email để nhận giá trị tốt nhất';}"/>
                    				
                    				<input type="hidden" name="url" value="<?php echo $this->params['url']['url'];?>">
                    				<lable style="float:left; width:220px;margin-left:28px; overflow:hidden; margin-top:5px; color:red;" id="test1"></lable>
                    				<br/>
                    				<input type="submit" value="ĐĂNG NHẬP" class="subdk" />
                    				
                    		</form>
                    
                  </div><!-- id="dialog-modal" -->
                 
	   <?php   } //end if($email!='true' && $email1 ==null)   ?>
       
	 <div class="content-top">
    
	 
            	 <?php echo $this->element('menu_top'); // hien thi menu
														// trong menu có chỉ rõ biến id của thành phố nào để hiển thị
				 ?>
                 
      <!-- lap toan bo san pham-->
            	 <div class="content-top-body">
                         <?php 
                    	 foreach ($product as $product)   // truy vấn và phân trang trong Home_controller vi được viết trong home
                           {      
                        ?>
                           
                         <a href="<?php echo DOMAIN?>san-pham/<?php echo $product['Product']['id']?>">
                         
                        	 	                    <div class="s-p"> 
                                            	 		<ul class="ulsp"> 
                                            	 			<li class="s-p-tit"> <?php echo $product['Product']['title'];?></li> <!--tieu de -->
                                            	 			<li class="li-img"><img src="<?php echo DOMAINAD.$product['Product']['images']?>"/></li> <!-- anh  -->
                                                            <!-- noi dung -->
                                            	 			<li class="li-introduction" style="height:70px;padding-top:10px; overflow:hidden; color:black; text-align:justify;">
                                            	 				<?php $s=$product['Product']['introduction'];
                                            	 			        	$tr=$s;
                                            	 			        	if(strlen($s)>350){ $tr=$this->Help->catchu($s,350);}   // cat 350 tu thoi
                                            	 			        	echo $tr;
                                            	 				?>
                                                            </li> 
                                                            
  <!--Kẻ bảng cho xem : giá , giảm giá , tiet kiệm --><div style="height:75px;"> <!-- dinh dang cho : Mua , giam gia , Tiết Kiệm ,....-->
                                                		<table>
                                           				   <tr> <!-- bảng Chỉ có 1 ô : chia thành 2 cột  -->
                                                                <!-- Cột 1 :  Ảnh XEM -->
                                          					    <td> <img style="float:left;width:100px; height:50px;"src="<?php echo DOMAIN?>images/xem1.png"/></td>
                                                                
                                                				<td>  <!-- Cột 2 : bên trái Giá : VNĐ-->
                                                                      <!--       : Tiết Kiệm : Số ngày Còn lại chạy deal -->
                                                                    <p class="p-gia">
                                                                        <span style="text-align:right;font-size:25px;font-weight:bold;">
                                                                	 			<?php 
                                                                	 			    echo number_format($product['Product']['price'],0,'.','.');
                                                                	 			?>
                                                        	 			</span>
                                                        	 			<span style="margin-left: 0px; position: relative; float: right; font-size: 16px; top: 5px; right: 12px;">VNĐ </span>
                                                                    </p>
                                                                    
                                                                    <!-- Chia bảng tiếp thành 2 cột-->
                                               	 			        <table width="205px" style="overflow:hidden;text-align:center;">
                                                        	 				<tr> 
                                                                                     <td style="border-right:1px solid #b6b6b6;color:black;width:70px;">
                                                                                         <b style="font-size:18px;">
                                                                        	 				<?php 
                                                                        	 				$giacu=$product['Product']['price_old'];
                                                                        	 				$giamoi=$product['Product']['price'];
                                                                        	 				
                                                                        	 				   echo round(($giacu-$giamoi)*100/$giacu);
                                                                        	 				
                                                                        	 				?>
                                                                                             %
                                                                                        </b> 
                                                                                        <br/>
                                                                                           Tiết kiệm
                                                                                        <br/>
                                                                                      </td>
                                                                                      
                                                                	 				<td style="padding-left:2px;text-align:left;color:black;">
                                                                                       <b style="font-size:18px;margin-left:10px;">
                                                                        	 				<?php 
                                                                        	 				$ngay =  explode('-',$product['Product']['date_ketthuc']);
                                                                        	 				$lastdate=mktime(0,0,0,$ngay['1'],$ngay['2'],$ngay['0']);
                                                                        	 				$now=mktime();
                                                                        	 				$d=$lastdate-$now;
                                                                        	 				$days=floor($d/86400);
                                                                            	 				if($days<0){$days=0;}
                                                                            	 				echo $days;;
                                                                            	 			
                                                                            	 				?>   ngày
                                                                    	 				  </b><br/>Thời gian còn lại
                                                                                       </td>
                                                                               </tr>
                                                            	 				
                                                           	 			</table>
                                                    				</td>
                                               				   </tr>
<!-- end. ke bang cho xem : giá , giảm giá , tiet kiệm --> </table>
                                        	 			
                                        	 		
                                        	 			</div>
                                                        
                                   	 	            	</ul> <!-- kết thúc dinh dang cho các thuộc tính của 1 sản phẩm   -->
                                    	 		
                                    	 	</div><!-- kết thúc định dạng cho Ô  sản phẩm thứ nhất  -->
                    	 	</a> <!-- cu di chuot vao dau cũng click ra được -->
                            
                            
                            
                    	 	<?php }?>
                    	 		
                                
                                
                    	       	<div class="pt"> <!-- phan trang trong home_controller.php-->
                                  <div class="pt-pagi">
                                  
                                   <ul>
                                                <li class="li-prev">
                    							     <?php 
                    							     echo $paginator->prev('<');?>
           							            </li>
                    							     
                  							     <li class="pt-so">
                    								<?php    echo $paginator->numbers();?>
                   								 </li>
                    								<li class="li-next">
                    								<?php  echo $paginator->next('>'); ?>	
                                                </li>
                                  </ul>
                                  </div><!-- End pt-pagi-->
                               </div><!-- End pt-->
                    	
            	       
            	
            	 </div><!-- End content-top-body -->
                 
     
     
     
     
	 
	 </div><!-- End content-top -->
	 
	 
	  <div class="content-center">
	  <div class="content-center-tit">
	  <ul class="ulspnb">
	  	<li class="li-chon">
		<a href="<?php echo DOMAIN?>san-pham-con-ban"> <p style="color:white;">CÁC SẢN PHẨM CÒN BÁN</p></a></li>
	  	</ul>
	  </div>
	  <div class="content-center-body">
	  
 <!-- Sản Phẩm Bán Chạy -->
 <div id="slide-show">
  
     <div class="slider1">
  
                                        <div class="content">
                                            <ul>
                                       <?php 
                                       	$i=0;$j=0;
                                       foreach ($product_nb as $product_nb)
									   { 
									   $i++;
                                       if($i==1)
									      {
                                       	   $j++;
                                          ?>
                                       
                                                <li> 
                                                <div style="float:left">
															
                                                    <div class="spnb">
                                     <?php } else {?>
                                                			<div style="float:left">
                                                            	   <div class="spnb spnb1">
                                             <?php }?>
																	<a style="color:black;"href="<?php echo DOMAIN?>san-pham/<?php echo $product_nb['Product']['id']?>">
																		<table style="padding-left:7px; padding-right:7px;">
																			<tr>
																				<td style="height:42px; color:#2fb34b; font-weight:bold;" >
																					<?php $str=$this->Help->catchu( $product_nb['Product']['title'],40);
																						echo $str;
																					?>
																				</td>
																			</tr>
																			<tr><td style="border:1px solid #d7d7d7; overflow:hidden; padding:1px;"><img class="img-spnb" src="<?php echo DOMAINAD.$product_nb['Product']['images'];?>"/></td></tr>
																			<tr><td style="padding-top:5px; padding-bottom:5px;height:60px; overflow:hidden;">
																				<?php 
																				$str=$this->Help->catchu( $product_nb['Product']['introduction'],140);
																				echo $str;
																				?>
																			
																			</td></tr>
																			<tr><td style="color:red;text-align:center;"><span style="font-size:25px;font-weight:bold;">
																				 <?php 
																			echo number_format($product_nb['Product']['price'],0,'.','.');
																			?>
																			</span> <span style="margin-left:5px;">vnđ</span></td></tr>
																			<tr> 
																		</table>
																		
																		<table style="text-align:center; margin-left:10px;" >
																		<tr> <td style="border-right:1px solid #b6b6b6;color:black;width:85px;"><b style="font-size:15px;">
																		<?php 
																			$giacu=$product_nb['Product']['price_old'];
																			$giamoi=$product_nb['Product']['price'];
																			
																			 echo round(($giacu-$giamoi)*100/$giacu)."%";
																			
																			?>
																		</b><br>Tiết kiệm</br></td>
																			<td style="padding-left:10px;"><b style="font-size:15px;">
																			<?php 
																			$ngay =  explode('-',$product_nb['Product']['date_ketthuc']);
																			$lastdate=mktime(0,0,0,$ngay['1'],$ngay['2'],$ngay['0']);
																			$now=mktime();
																			$d=$lastdate-$now;
																			$days=floor($d/86400);
																			if($days<0){$days=0;}
																			echo $days. " ngày";
																		
																			?>
																			</b><br/>Thời gian còn lại</td></tr>
																		</table>
																		 
																		</tr>
																		<table width="100%">
																		<tr><td>
																		 
																		<img style="margin-left:67px; margin-top:5px;"src="<?php echo DOMAIN?>images/xem.png"/>
																		
																		</td></tr>
																		</table>
																		</a>
																	  </div><!-- End spnb -->
																	 
																	  
																						  
																				 </div>
																				 
																				 <?php if($i==4){ $i=0;?>
																	</li>
																	<?php }}?>
																</ul>
                                                          </div> <!-- class="spnb" -->
                                        
                                         
                                                             
                                                             
                                        <?php  // phân trang dạng kiểu silde show cho sản phẩm bán chạy?>
                                            <div class="slider-nav">
                                                <ul>
                                                <li><a href="#" class="carousel-prev"></a></li>
                                                <?php for($t=1; $t<=$j;$t++) {?>
                                                    <li><a href="#"><?php echo $t?></a></li>
                                                 <?php }?>   
                                                    <li><a href="#" class="carousel-next"></a></li>
                                                </ul>
                                            </div><!-- end slider-nav-->
   
                        </div><!-- end slider 2 -->
 </div><!-- Sản Phẩm Bán Chạy -->

	  </div><!-- End content-center-body -->
	
	
	 </div><!-- End content-center -->
	

<?php  //gian hàng nổi bật được đẩy lên đây và không có phân trang ?>	
	 <div class="content-center-bot">
	  <div class="c-c-b-tit">
		<p class="p-gh">
	  
		<a style="color:white;" href="<?php echo DOMAIN?>san-pham-gian-hang"> GIAN HÀNG NỔI BẬT</a>
		</p>
	  
	  <p style="float:left; overflow:hidden;margin-left:280px;font-weight:bold;overflow:hidden;">
	  <a id="next" href="javascript:void(0);" class="click_right_by_843_400">
	  <span style="margin-top:1px; float:left;margin-right:5px;color:#000;">Xem thêm</span> 
	  <img src="<?php echo DOMAIN?>images/xemthem.png"/></a></p>
	  </div>
	  
	    <div id="newsticker-demo">   
	
		
                                            <div class="newsticker-jcarousellite">
                                                <ul>
                                                  
												  <?php
														$gianhang=$this->requestAction('comment/gianhang_nb');
														 $i=0;
													foreach($gianhang as $gianhang){
														$sp_gianhang_nb =$this->requestAction('comment/sp_gianhang_nb/'.$gianhang['Shop']['id']);
												 //pr($sp_gianhang_nb);
														 foreach($sp_gianhang_nb as $sp_gianhang_nb)
														 {
													 
																 $i++;
													  ?>
													   <li>
														   
															  <div class="gianhang">
															  <table width="100%">
																<tr><td class="img-gianhang"><a target="_blank" href="<?php echo DOMAIN.$gianhang['Shop']['name']?>/chi_tiet_san_pham/<?php echo $sp_gianhang_nb['Productshop']['id']?>"><img src="<?php echo DOMAIN.$sp_gianhang_nb['Productshop']['images']?>"/></a></td></tr>
																<tr><td style="margin-top:10px;"><a class="a-ten" target="_blank" href="<?php echo DOMAIN.$gianhang['Shop']['name']?>/chi_tiet_san_pham/<?php echo $sp_gianhang_nb['Productshop']['id']?>"><?php echo $sp_gianhang_nb['Productshop']['title']?></a></td></tr>
																<tr><td style="margin-top:5px;color:#2FB34B;font-weight:bold;">GIÁ: <span style="color:red"><?php echo $sp_gianhang_nb['Productshop']['price']." ". $sp_gianhang_nb['Productshop']['money'] ?> </span></td></tr>
															  </table>
															  </div>
															<div class="clear"></div>
														</li>
                                                    <?php } }?>
                                                 
                                                </ul>
                                            </div><!-- End newsticker-jcarousetiltl-->
                                            
         </div><!-- End newsticker-demo-->

	 
	  
	  </div><!-- End content-center-bot -->
	 
	 
	 </div><!-- ENd main content -->
