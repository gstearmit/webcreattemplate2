<?php 
$pizza = $_GET['url'];
$urlshop = explode("/", $pizza);
$geturl=$urlshop[0];
?>
<div class="wrapper_body_views">
	<div class="body_module">
		<div class="title_module">
			<div class="left_icon"></div>
			<div class="title"><span><?php echo $views['Classifiedss']['title']?></span></div>
			<div class="right_icon"></div>
		</div>
		<div class="list-text">
           <div class="detail">
               <div class="san-pham-chi-tiet">
                        <div class="san-pham-chi-tiet-trai floatleft">
                            <div class="bg-top-ha-chi-tiet"></div>
                            <div class="bg-center-ha-chi-tiet" id="vlightbox">
                              <a href="<?php echo DOMAINAD;?><?php echo $views['Classifiedss']['images']; ?>" class="vlightbox" rel="colorbox">
                                  <img style="width:300px;border-width:0px;" src="<?php echo DOMAINAD;?><?php echo $views['Classifiedss']['images']; ?>" alt="<?php echo $views['Classifiedss']['title']?>" id="ctl08_imgChitiet">  
                               </a>
                             </div>
							<script type="text/javascript">
                                var $VisualLightBoxParams$ = {autoPlay:true,borderSize:21,enableSlideshow:true,overlayOpacity:0.4,startZoom:true};
                            </script>
                            <script type="text/javascript" src="<?php echo DOMAIN?>themeshop/template1/js/visuallightbox.js"></script>
                            <div class="bg-bottom-ha-chi-tiet"></div>
                        </div>
                        <div class="san-pham-chi-tiet-phai floatleft">
                               <div class="title-chi-tiet-sp"><?php echo $views['Classifiedss']['title']?></div>
                               <div class="gia-chi-tiet-sp"><b>Giá sản phẩm: </b><font color="red"><?php echo $views['Classifiedss']['price']?> VNĐ</font></div>
                               </div>    
                               <div class="so-luong-chi-tiet-sp">
                                  Hình thức: 
                                   <?php if($views['Classifiedss']['needs']==1){?>
                                    Cần bán
                                    <?php }else{?>
                                    Cần mua
                                    <?php }?>
                               </div>   
                               <div class="so-luong-chi-tiet-sp">
                                  Nơi đăng: <?php echo $views['City']['name'];?>
                               </div>
                               <div class="so-luong-chi-tiet-sp">
                                <div style="text-align:center; border-top:1px solid #DDD; margin:5px; padding-top:10px;">
                                     &nbsp;
                                    
                               </div> 
                        </div>
                         <div class="clearfix"></div>
                        </div>
                 <div class="thong-tin-chi-tiet">    
                    <div class="bg-top-chi-tiet">
                    <div class="title-thong-tin-chi-tiet">THÔNG TIN CHI TIẾT VỀ SẢN PHẨM</div>        
                    <div class="bg-center-chi-tiet">            
                        <div class="chi-tiet-san-pham"><p><?php echo $views['Classifiedss']['content']?></p></div>
                    </div>
                </div>
                    <div class="bg-bottom-chi-tiet"></div>
                 </div>
           </div>
        </div>
        <div class="body_module" style="width:97%; margin:auto; padding-top:10px;">
		<div class="title_module">
			<div class="left_icon"></div>
			<div class="title"><span>Các sản phẩm liên quan</span></div>
			<div class="right_icon"></div>
		</div>
		<div class="content_module">
			<ul class="list-product clearfix">
               <?php 
			     foreach($list_others as $Classifiedsss){?>
				<li>
					<table class="img-124">
						<tr valign="middle">
							<td>
								<a href="<?php echo DOMAIN;?><?php echo $geturl;?>/chi_thiet_san_pham/<?php echo $Classifiedsss['Classifiedss']['id'];?>"><img alt="" class="" src="<?php echo DOMAIN;?><?php echo $Classifiedsss['Classifiedss']['images'];?>" /></a>
							</td>
						</tr>
					</table>
					<h4><a href="<?php echo DOMAIN;?><?php echo $geturl;?>/chi_thiet_san_pham/<?php echo $Classifiedsss['Classifiedss']['id'];?>"><?php echo $Classifiedsss['Classifiedss']['title'];?></a></h4>
					<p class="price"><?php echo $Classifiedsss['Classifiedss']['price'];?> <?php echo $Classifiedsss['Classifiedss']['money'];?></p>
				</li>
			   <?php }?>		
		    </ul>
			<div class="clr"></div>
		</div>
	</div>
	</div>
</div>