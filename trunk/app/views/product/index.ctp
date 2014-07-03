<!-- lay list product ra trang chủ va phân trang -->

<link rel="stylesheet" href="<?php echo DOMAIN;?>css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
<script src="<?php echo DOMAIN;?>js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
        
 	<link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo DOMAIN;?>css/style1_slide.css" />
    <script language="javascript" type="text/javascript" src="<?php echo DOMAIN;?>js/jquery.easing.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo DOMAIN;?>js/script.js"></script>
	<script type="text/javascript">
 $(document).ready( function(){	
		// buttons for next and previous item						 
		var buttons = { previous:$('#jslidernews1 .button-previous') ,
						next:$('#jslidernews1 .button-next') };			
		 $('#jslidernews1').lofJSidernews( { interval : 4000,
											direction		: 'opacitys',	
											easing			: 'easeInOutExpo',
											duration		: 1200,
											auto		 	: false,
											maxItemDisplay  : 4,
											navPosition     : 'horizontal', // horizontal
											navigatorHeight : 55,
											navigatorWidth  : 80,
											mainWidth		: 698,
											buttons			: buttons } );	
	});
</script>
 
 <link type="text/css" href="<?php echo DOMAIN ?>css/content.css" rel="stylesheet" /> 
 
   <link rel="stylesheet" type="text/css" href="<?php echo DOMAIN?>css/jquery.ad-gallery.css">
  

 <div id="main-content">
	 
	 <div class="content-top">

	 	<?php echo $this->element('menu_top'); // danh muc menu hien thị o day ?> 
	
	    <div class="content-top-body"> <!-- toan bo san phẩm top dau trang chu dươc hien thi o day -->
       
                	 <div class="d-d">
                    	 <?php foreach($product as $row) {
                    	 	$id= $row['Product']['id'];
                   	 	 ?>
                    	 
                    	 <ul>
                        	 	<li class="li-dau"><a href="<?php echo DOMAIN?>">Trang chủ</a></li>
             			        <?php $cat=$this->requestAction('comment/get_name_catproduct/'.$row['Product']['catproduct_id']);
                        	 	foreach ($cat as $cat)
                                  { 
                        		      if($cat['Catproduct']['id']==82)
                                       {
                        		 ?>
                                    	 	<li class="li-dau"><a href="<?php echo DOMAIN?>tieu-dung">
                                    	 <?php
                        	           } else { ?>
                        	 
                                            	 <li class="li-dau">
                                                   <a href="<?php echo DOMAIN?>du-lich">
                                <?php
                        	                   }
                                               
                                               
                        	 	  	echo $cat['Catproduct']['name']; 
                        	   	} // end for 
                                
                        	 	?>
                        	 	
                        	 	               </a>
                                              </li> <!-- end. class="li-dau" -->
                                              
                        	 	<li ><a href="" class="a-cuoi"><?php echo $row['Product']['title']?></a></li>
                    	 </ul>
                	 
                	 </div><!--End d-d-->
            	 
            	 	<div style="background:white;overflow:hidden;padding-bottom:20px;">
            	 <div class="div-tit">
            	 <p style="text-align:right;">
            	 	<?php echo $row['Product']['title']?>:
            	 </p>
            	 </div>
            	 
            	  <div class="div-mota">
            	  <p>
            	  	<?php echo $row['Product']['content']?>
            	 </p>
            	 </div>
            	 </div>
	 </div><!-- End content-top-body --><!-- toan bo san phẩm top dau trang chu dươc hien thi o day -->
	  
	 
	 
	 
	    <div id="div-a" style="display:none;">
	     <?php $gallery=$this->requestAction('comment/gallery/'.$id);
          $i=0;
          foreach ($gallery as $gallery){
          ?>
         
         
              <a  rel="example_group" href="<?php echo DOMAINAD.$gallery['Gallery']['images']?>">
              
          
   
           </a>
           <?php }?>
            
	</div> 
	 <div class="hang1">
	 <div class="div-datmua">
	<table width="100%" style="text-align:center;margin-top:10px;overflow:hidden;">
		<tr><td style="color:#fef500; text-align:center;overflow:hidden;"><span style="font-size:37px;font-weight:bold;">
		<?php echo number_format($row['Product']['price'],0,'.','.');?></span><span style="font-size:16px;">  vnđ</span></td></tr>
		<tr><td style="color:white;text-align:center;text-decoration: line-through;overflow:hidden;"><span style="font-size:22px;font-weight:bold;">
		<?php echo number_format($row['Product']['price_old'],0,'.','.');?></span><span style="font-size:16px;">  vnđ</span></td></tr>
		<tr><td style="padding-top:10px;overflow:hidden;">
			<a href="<?php echo DOMAIN?>dat-mua/<?php echo $row['Product']['id']?>"><img src="<?php echo DOMAIN?>images/datmua.png"/></a></td>
		</tr>
		<tr><td style="font-size:14px; color:white; font-weight:bold;padding-top:16px;">
				<span style="width:40%; text-align:center;float:left;margin-left:25px;">
				
				<?php
					$ngay=explode('-',$row['Product']['date1']);
					$ngay1=explode('-',$row['Product']['date2']);
					$t=$ngay[2].'/'.$ngay[1].' - '.$ngay1[2].'/'.$ngay1[1];
					
				echo $t;?></span>
				<span style="width:40%; text-align:center;float:left;">
					<?php
					$ngay=explode('-',$row['Product']['date3']);
					$ngay1=explode('-',$row['Product']['date4']);
					$t=$ngay[2].'/'.$ngay[1].' - '.$ngay1[2].'/'.$ngay1[1];
					
				echo $t;?>
				</span>
		</td>
		
		<tr><td style="font-size:18px; color:#efe601; font-weight:bold;">
				<span style="width:40%; text-align:center;float:left;margin-left:25px;">
					<?php 
	 			echo number_format($row['Product']['price1'],0,'.','.');
	 			?>
				
				</span>
				<span style="width:40%; text-align:center;float:left;">
					<?php 
	 			echo number_format($row['Product']['price2'],0,'.','.');
	 			?>
				</span>
		</td>
		</tr>
		
		<tr><td style="font-size:24px;  font-weight:bold;padding-top:27px;">
				<span style="width:36%; text-align:center;float:left;color:#7c7c7c;margin-left:33px;"><?php echo $row['Product']['daban']?></span>
				<span style="width:36%; text-align:center;float:left;color:#e56b1f;margin-left:13px;"><?php echo $row['Product']['conlai']?></span>
		</td>
		</tr>
	</table>
	<div class="gio-hang">
	<?php if($this->Session->check('nameuser')) { ?>
	
	<p>
	Đã mua <?php echo $this->requestAction('comment/giohang/'.$this->Session->read('nameuser'));?>
	sản phẩm
	</p>
	

	<?php } else {?>
	<p>
	<a href="<?php echo DOMAIN?>dang-nhap">
	Đăng nhập để có giỏ hàng
	</a></p>
	<?php }?>
		</div>
	<div class="like">
	<!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style ">
            <a class="addthis_button_facebook_like" fb:like:layout="box_count"></a>
            <a class="addthis_button_tweet" tw:count="vertical"></a>
            <a class="addthis_button_google_plusone" g:plusone:size="tall"></a>
            <a class="addthis_counter"></a>
            
            </div>
            <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-5008e04b0fe3f627"></script>
    <!-- AddThis Button END -->

	</div>
	 
	 </div><!-- End div-datmua-->
	 <div class="div-slider">
     	<div id="jslidernews1" class="lof-slidecontent" style="width:698px; height:448px;">
	
    		 <!-- MAIN CONTENT --> 
              <div class="main-slider-content" style="width:698px; height:368px;">
                <ul class="gallery clearfix sliders-wrap-inner" >
                   <?php 
				      $gallery=$this->requestAction('comment/gallery/'.$id);
					  $i=0;
					  foreach ($gallery as $gallery){
					?>
                    <li>
                       <a href="<?php echo DOMAINAD;?><?php echo $gallery['Gallery']['images'];?>" rel="prettyPhoto[gallery1]">
                            <img src="<?php echo DOMAINAD?><?php echo $gallery['Gallery']['images'];?>">           
                            </a>
                          
                    </li> 
                   <?php }?>
                  </ul>  
                  	<script type="text/javascript" charset="utf-8">
			$(document).ready(function(){
				$("area[rel^='prettyPhoto']").prettyPhoto();
				
				$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: false});
				$(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
		
				$("#custom_content a[rel^='prettyPhoto']:first").prettyPhoto({
					custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
					changepicturecallback: function(){ initialize(); }
				});

				$("#custom_content a[rel^='prettyPhoto']:last").prettyPhoto({
					custom_markup: '<div id="bsap_1259344" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div><div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>',
					changepicturecallback: function(){ _bsap.exec(); }
				});
			});
			</script>
            </div>
            
 		   <!-- END MAIN CONTENT --> 
           <!-- NAVIGATOR -->
           	<div class="navigator-content">
                  <div class="button-next">Next</div>
                  <div class="navigator-wrapper">
                        <ul class="navigator-wrap-inner">
                          <?php 
							  $gallery=$this->requestAction('comment/gallery/'.$id);
							  $i=0;
							  foreach ($gallery as $gallery){
							?>
                           <li><img src="<?php echo DOMAINAD?>/timthumb.php?src=<?php echo $gallery['Gallery']['images'];?>&amp;h=50&amp;w=70&amp;zc=1" /></li>       		
                           <?php }?>
                        </ul>
                  </div>
                  <div  class="button-previous">Previous</div>
             </div> 
        
 		</div>   
     </div>
	 </div><!-- end hang1 -->
	 
	 <div class="hang2">
	 		<div class="cot1">
	 		<?php
	 		$i=0;
	 		if($row['Product']['content_1']!=""){$i++;?>
	 			<div class="divnd">
	 					<h2>Nội dung <?php echo $i;?></h2>
	 					<div class="content-nd">
	 					<?php echo $row['Product']['content_1']?>
	 					
	 					</div><!-- end content-nd -->
	 					
	 			</div><!-- ENd divnd -->
	 			<?php }?>
	 			
	 			<?php if($row['Product']['content_2']!=""){$i++;?>
	 			<div class="divnd divnd2">
	 					<h2>Nội dung <?php echo $i;?></h2>
	 					<div class="content-nd">
	 					<?php echo  $row['Product']['content_2']?>
	 					
	 					</div><!-- end content-nd -->
	 					
	 			</div><!-- ENd divnd -->
	 			<?php }?>
	 			<?php if($row['Product']['content_3']!=""){$i++;?>
	 			<div class="divnd divnd2">
	 					<h2>Nội dung <?php echo $i;?></h2>
	 					<div class="content-nd">
	 					<?php echo $row['Product']['content_3']?>
	 					
	 					</div><!-- end content-nd -->
	 					
	 			</div><!-- ENd divnd -->
	 			<?php }?>
	 				<?php }?>
	 			
	 		</div><!-- End cot2 -->
	 		
	 		<div class="bor-cot2">
			
			<div class="help">
		
			<?php $setting=$this->requestAction('comment/setting');
			foreach($setting as $setting){
			?>
	<p style="color:#FF0000; font-size:18px;text-align:center;"> Hotline:
	<?php echo $setting['Setting']['phone'];?>
	</p>
	<p style="margin-top:10px;">
		<?php }?>
		
			<?php $setting=$this->requestAction('comment/helpsonline');
			foreach($setting as $helpsonline){
			?>
			
	<a   border="0" class="a-ya" href="ymsgr:sendIM?<?php echo $helpsonline['Helps']['yahoo'];?>">
		<img class="img-ya" width="105" height="25" border="0" src="http://opi.yahoo.com/online?u=<?php echo $helpsonline['Helps']['yahoo'];?>&amp;m=g&amp;t=2&amp;l=us"></a>
			
			<?php }?>
		</p>	
			
			</div>
			
			
	 		<div class="cot2">
	 			<div class="tit-cot2">
	 			
	 			<ul><li class="t-lt-chon">
	 			<p>
	 			<a>
	 			CÁC SẢN PHẨM CÒN BÁN
	 			</a>
	 			</p>
	 			</li>
	 		
	 			
	 			</ul>
	 			
	 			</div><!-- ENd tit-cot2 -->
	 			
	 			<?php $row=$this->requestAction('comment/sp_conban');
	 			$i=0;
	 				foreach($row as $row){$i++;
	 				if($i==1){
	 			?>
	 			
	 			<div class="spcn">
	 			<?php }
	 			else{
	 			?>
	 			<div class="spcn1">
	 			<?php }?>
	 			<table style="margin-left:4px;">
	 				<tr> 
	 					<td height="39px" style="color:#2fb34b; font-weight:bold;" ><?php echo $this->Help->catchu($row['Product']['title'],30) ?></td>
	 				
	 				</tr>
	 				<tr> 
	 					<td>
	 					<a href="<?php echo DOMAIN?>san-pham/<?php echo $row['Product']['id']?>">
	 					<img  style="width:210px; height:144px;"src="<?php echo DOMAINAD.$row['Product']['images']?>"/>
	 					</a>
	 					</td>
	 				
	 				</tr>
	 				
	 				<tr>
	 					<td><p style="color:white;  width:115px; text-align:center;overflow:hidden;float:left;"> 
	 					<span style="font-size:24px; font-weight:bold;">
	 						<?php 
	 			echo number_format($row['Product']['price'],0,'.','.');
	 			?>
	 					</span>
	 				
	 					<span style="color:white; font-size:14px; width:100px; text-align:right;overflow:hidden;float:left;margin-top:-5px; padding-right:5px;"> VNĐ</p>
	 					</span>
	 							<p style="width:85px; text-align:center;overflow:hidden;float:left; margin-top:5px;" >
	 							
	 							Tiết kiệm <br><span style="font-weight:bold; font-size:18px;">
	 							<?php 
	 				$giacu=$row['Product']['price_old'];
	 				$giamoi=$row['Product']['price'];
	 				
	 				 echo round(($giacu-$giamoi)*100/$giacu);
	 				
	 				?>
	 							%</span></p>
	 					</td>
	 				</tr>
	 				
	 				
	 				
	 			</table>
	 			
	 			</div><!-- End spcb -->
	 			
	 		
	 			<?php }?>
	 			
	 			<p class="x-t"> <a href="<?php echo DOMAIN?>san-pham-con-ban">Xem thêm </a></p>
	 		</div>
	 		</div><!-- End cot2 -->
	 		</div>
	 </div><!-- ENd hang2 -->
	
	 <div class="bgbottom"></div>
	 </div><!-- End content-top -->
	 
	 
	 
	 
	 
	  
</div><!-- ENd main content -->
