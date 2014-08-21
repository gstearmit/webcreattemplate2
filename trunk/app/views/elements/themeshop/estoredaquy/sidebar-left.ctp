<?php
$shop = explode ( '/', $this->params ['url'] ['url'] );
$shopname = $shop [0];
?>
<div id="sidebar"><?php ?>
    <div class="center-sidebar">
		<div class="title-sidebar">
			<p>
				pDanh mục sản phẩm <img
					src="<?php echo DOMAIN; ?>daquybusniss/images/hinhanh1.png">
			</p>

		</div>
		<!-- class="title-sidebar" -->
		<div class="category-product">
			<div class="arrowsidemenu">
                 <?php
																	
																	$categoryproduct = $this->requestAction ( '/' . $shopname . '/categoryproduct' );
																	$i = 0;
																	foreach ( $categoryproduct as $categoryproduct ) 

																	{
																		?> 
								<div class="menuheaders" headerindex="<?php echo $i;?>h">
					<a
						href="<?php echo DOMAIN;?><?php echo $shopname;?>/listproduct/<?php echo $categoryproduct['Estore_catproduct']['id'];?>/<?php echo $categoryproduct['Estore_catproduct']['alias'];?>.html"><?php echo $categoryproduct['Estore_catproduct']['name'];?>
								   </a>
				</div>
				<ul class="menucontents" contentindex="<?php echo $i;?>c"
					style="display: none;">
					                         <?php
																		$submenuproduct = $this->requestAction ( '/' . $shopname . '/submenuproduct/' . $categoryproduct ['Estore_catproduct'] ['id'] );
																		
																		foreach ( $submenuproduct as $submenuproduct ) {
																			if ($submenuproduct ['Estore_catproduct'] ['parent_id'] == $categoryproduct ['Estore_catproduct'] ['id']) {
																				?>
												<li><a
						href="<?php echo DOMAIN;?><?php echo $shopname;?>/listproduct/<?php echo $submenuproduct['Estore_catproduct']['id'];?>/<?php echo $submenuproduct['Estore_catproduct']['alias'];?>.html">
													 <?php echo $submenuproduct['Estore_catproduct']['name'];?>
													</a></li>
								<?php
																			}
																		} // foreach($submenuproduct as $submenuproduct)																		?> 
								  </ul>
                     <?php
																		
																		$i ++;
																	} // end foreach($categoryproduct as $categoryproduct)																	?>
            </div>
			<!-- class="arrowsidemenu" -->
		</div>
		<!-- class="category-product -->

		<a href="<?php echo DOMAIN; ?><?php echo $shopname;?>/viewnew/98"><img
			src="<?php echo DOMAIN; ?>daquybusniss/images/nhandathangtheoyeucau.png"
			style="margin-bottom: 10px;"></a>

		<div class="title-sidebar">
			<p>video clip</p>

		</div>

		<script>
		function load_video_ajax(id) 
		{		
				$.ajax({
				url: '<?php echo DOMAIN.$shopname; ?>/get_video/'+id,
				success: function(data)
				{
				            $('#play_video').html(data);
			    }
				});
		}
</script>

		<div class="main-sidebar">
			<p align="center">
				<span id="play_video">
							
							  <?php
									
									$videos = $this->requestAction ( '/' . $shopname . '/videoslish1' );
									
									$video = isset ( $_GET ['video'] ) ? $_GET ['video'] : '';
									foreach ( $videos as $videos ) {
										?>
								   <embed width="195" height="140"
						type="application/x-shockwave-flash"
						src="<?php echo DOMAIN?>daquybusniss/images/mediaplayer.swf" style=""
						id="playlist" name="playlist" quality="high"
						allowfullscreen="true" wmode="transparent"
						flashvars=" file=<?php echo DOMAINADESTORE?><?php echo $videos['Estore_video']['video'];?>&amp;displayheight=125&amp;width=195&amp;height=140&amp;">
					<?php }     ?>
							
						   <?php
									
									$videos = $this->requestAction ( '/' . $shopname . '/videoslish' );
									
									$video = isset ( $_GET ['video'] ) ? $_GET ['video'] : '';
									foreach ( $videos as $videos ) {
										?>
								
					
					
					
					<embed width="195" height="140"
						type="application/x-shockwave-flash"
						src="<?php echo DOMAIN?>daquybusniss/images/mediaplayer.swf" style=""
						id="playlist" name="playlist" quality="high"
						allowfullscreen="true" wmode="transparent"
						flashvars=" file=<?php echo DOMAINADESTORE?><?php echo $videos['Estore_video']['video'];?>&amp;displayheight=125&amp;width=195&amp;height=140&amp;">
						<?php }    ?>
					
				
				
				
				</span>	
						<?php
						
						$videos = $this->requestAction ( '/' . $shopname . '/videos1' );
						
						foreach ( $videos as $videos ) {
							?>
						     
			
			
			
			
			
			<p
				style="text-decoration: none; margin-left: 5px; line-height: 15px;">
				<a
					href="javascript:load_video_ajax(<?php echo $videos['Estore_video']['id']; ?>)"
					style="text-decoration: none; margin-left: 5px; line-height: 22px; font-size: 13px;"><img
					src="<?php echo DOMAIN; ?>daquybusniss/images/tron2.png"
					style="float: left; margin-top: 6px;" /> <?php echo $videos['Estore_video']['name'];?> </a>
			</p>
                     <?php }?>
					 
			</div>
		<!-- class="main-sidebar" -->

		<div class="title-sidebar">
			<p>Hỗ trợ trực tuyến</p>
		</div>
		<div class="main-sidebar">
			<table width="98%" style="margin: auto;">
               <?php
															$helpsonline = $this->requestAction ( '/' . $shopname . '/helpsonline' );
															// pr($helpsonline);
															?>
              <?php foreach($helpsonline as $helpsonline){?>
			  <tr>
					<td width="25%"><p
							style="color: #545454; padding-top: 8px; padding-left: 10px; font-weight: bold;">Hotline:
						</p></td>
					<td width="75%"><b style="color: #079300; font-size: 19px;"><?php echo $helpsonline['Estore_helps']['hotline'];?></b></td>
				</tr>
				<tr>
					<td><p
							style="color: #545454; font-weight: bold; padding-left: 10px;">Email
							:</p></td>
					<td width="75%"><p
							style="color: #545454; font-weight: bold; font-size: 11px;"><?php echo $helpsonline['Estore_helps']['user_email'];?></p></td>
				</tr>
				<tr>
					<td>
						<p style="margin-left: 19px;">
							<a
								href="ymsgr:sendIM?<?php echo $helpsonline['Estore_helps']['user_yahoo'];?>"><img
								border="0"
								src="http://opi.yahoo.com/online?u=<?php echo $helpsonline['Estore_helps']['user_yahoo'];?>&amp;m=g&amp;t=1&amp;l=us"></a>
						</p>
					</td>
					<td>
						<p>
							<a
								href="skype:<?php echo $helpsonline['Estore_helps']['user_skype'];?>?call"><img
								border="0" src="<?php echo DOMAIN?>daquybusniss/images/skype.png"></a>
						</p>
					</td>

				</tr>
				<tr>
					<p
						style="color: #545454; margin-top: 7px; margin-left: 10px; font-weight: bold;">Tư vấn:<?php echo $helpsonline['Estore_helps']['title'];?></p>
					<p
						style="color: #545454; margin-top: 7px; margin-left: 10px; font-weight: bold;">Tel: <?php echo $helpsonline['Estore_helps']['hotline'];?></p>
				</tr>
               <?php }?>
           </table>
		</div>

		<div class="title-sidebar">
			<p>Tin tức mới</p>
		</div>
		<div class="main-sidebar">
			<ul style="overflow: hidden;">
              <?php
				$tintucnoibats = $this->requestAction ( '/' . $shopname . '/tintucnoibat' );
			?>
              <?php foreach($tintucnoibats as $tintucnoibat){?>
               <li>
					<h1>
						<a href="<?php echo DOMAIN;?><?php echo $shopname;?>/viewnew/<?php echo $tintucnoibat['Estore_news']['id'];?>"><div style=" overflow:hidden; width:67px; height:67px; background-image:url(<?php echo DOMAINADESTORE?>/timthumb.php?src=<?php echo $tintucnoibat['Estore_news']['images'];?>&amp;h=67&amp;w=67&amp;zc=1); background-position:center center; background-repeat:no-repeat; background-color:#fff; margin:auto;" class="img"></div></a>
					</h1>
					<p>
						<a href="<?php echo DOMAIN;?><?php echo $shopname;?>/viewnew/<?php echo $tintucnoibat['Estore_news']['id'];?>"><?php echo $tintucnoibat['Estore_news']['title'];?></a>
					</p>
				</li>
               <?php } ?>
           </ul>
			<p style="float: right; padding-right: 5px;">
				<a href="<?php echo DOMAIN;?><?php echo $shopname;?>/indexnew"><img
					src="<?php echo DOMAIN;?>daquybusniss/images/detail-news.png" /></a>
			</p>
		</div>
		<!-- class="main-sidebar" -->

		<div class="title-sidebar">
			<p>Đối tác khách hàng</p>
		</div>

		<div class="main-showroom">
			<marquee direction="down" style="height: 350px; width: 195px;"
				onmouseover="this.stop();" onmouseout="this.start();">

				<ul style="text-align: center; text-decoration: none;"> 
								<?php
								$doitacs = $this->requestAction ( '/' . $shopname . '/doitac' );
								foreach ( $doitacs as $doitac ) {
									?>
											<li><a
						href="<?php echo $doitac['Estore_partner']['website']; ?>"
						style="text-decoration: none;" target="_blank"><img
							src="<?php echo DOMAINADESTORE; ?><?php echo $doitac['Estore_partner']['images']; ?>"
							style="width: 184px; margin-left: 7px; margin-top: 3px; border: 10px solid:#FF0000;" /></a>


					</li>


								<?php
								}
								?>

						</ul>

			</marquee>
		</div>
		<!-- class="main-showroom" -->
        <?php 
        $maps = $this->requestAction ( '/' . $shopname . '/mapssetting' );
//         pr($maps);
        foreach ( $maps as $map ) 
		{
		echo $map['Estore_settings']['map'];
		}
        ?>
  <div class="title-sidebar">
			<p>thống kê truy cập</p>
		</div>

		<center>
			<!-- Histats.com  START  (standard)-->
			<script type="text/javascript">document.write(unescape("%3Cscript src=%27http://s10.histats.com/js15.js%27 type=%27text/javascript%27%3E%3C/script%3E"));</script>
			<a href="http://www.histats.com" target="_blank"
				title="site hit counter"><script type="text/javascript">
try {Histats.start(1,2092780,4,306,118,60,"00011111");
Histats.track_hits();} catch(err){};
</script></a>
			<noscript>
				<a href="http://www.histats.com" target="_blank"><img
					src="http://sstatic1.histats.com/0.gif?2092780&101"
					alt="site hit counter" border="0"></a>
			</noscript>
			<!-- Histats.com  END  -->
		</center>


		<div class="title-sidebar">
			<p>Sản phẩm nổi bật</p>
		</div>

		<div class="main-showroom">
			<marquee direction="down" style="height: 350px; width: 195px;"
				onmouseover="this.stop();" onmouseout="this.start();">
				<?php
				$sanphamnoibats = $this->requestAction ( '/' . $shopname . '/sanphamnoibat' );
				foreach ( $sanphamnoibats as $sanphamnoibat ) {
					?>
				<a href="<?php echo DOMAIN.$shopname;?>/viewproduct/<?php echo $sanphamnoibat['Estore_products']['id']; ?>"
					style="text-decoration: none;"><img src="<?php echo DOMAINADESTORE; ?>
					<?php echo $sanphamnoibat['Estore_products']['images']; ?>" style="height: 110px; width: 155px; margin-left: 20px; margin-top: 3px;" /></a>
				<p style="text-align: center;">
					<a href="<?php echo DOMAIN.$shopname;?>/viewproduct/<?php echo $sanphamnoibat['Estore_products']['id']; ?>" style="text-decoration: none;"><?php echo $sanphamnoibat['Estore_products']['title']; ?></a>
				</p> 
				<?php
				}
				?>
			</marquee>
		</div>

	</div>
</div>