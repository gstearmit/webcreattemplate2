   <script type="text/javascript" src="<?php echo DOMAIN?>js/fancybox/jquery.fancybox-1.3.2.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN?>js/fancybox/jquery.fancybox-1.3.2.css" media="screen" />
 	<link rel="stylesheet" href="style.css" />
	<script type="text/javascript">
		$(document).ready(function() {
			

			$("a[rel=example_group]").fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
			});

		});
	</script>
 
 <link type="text/css" href="<?php echo DOMAIN ?>css/content.css" rel="stylesheet" /> 
 
   <link rel="stylesheet" type="text/css" href="<?php echo DOMAIN?>css/jquery.ad-gallery.css">
  <script type="text/javascript" src="<?php echo DOMAIN?>js/jquery.ad-gallery.js"></script>
  <script type="text/javascript">
  $(function() {
    $('img.image1').data('ad-desc', 'Whoa! This description is set through elm.data("ad-desc") instead of using the longdesc attribute.<br>And it contains <strong>H</strong>ow <strong>T</strong>o <strong>M</strong>eet <strong>L</strong>adies... <em>What?</em> That aint what HTML stands for? Man...');
    $('img.image1').data('ad-title', 'Title through $.data');
    $('img.image4').data('ad-desc', 'This image is wider than the wrapper, so it has been scaled down');
    $('img.image5').data('ad-desc', 'This image is higher than the wrapper, so it has been scaled down');
    var galleries = $('.ad-gallery').adGallery();
    $('#switch-effect').change(
      function() {
        galleries[0].settings.effect = $(this).val();
        return false;
      }
    );
    $('#toggle-slideshow').click(
      function() {
        galleries[0].slideshow.toggle();
        return false;
      }
    );
    $('#toggle-description').click(
      function() {
        if(!galleries[0].settings.description_wrapper) {
          galleries[0].settings.description_wrapper = $('#descriptions');
        } else {
          galleries[0].settings.description_wrapper = false;
        }
        return false;
      }
    );


	
	
	$('a.them').click(function(){
	
	$('a.them').attr('href',$('.ad-image img').attr('src'));
		
	
	});

  });
  </script>

  

  
  <style type="text/css">
.d-d a:hover{
color:red;
}
.a-cuoi{color:#008301;}
  </style>
 
 
 
	
 
 <div id="main-content">
	 
	 <div class="content-top">

	 	<?php echo $this->element('menu_top');?>
	
	 <div class="content-top-body">
	 <div class="d-d">
	 <?php foreach($product as $row){
	 	$id= $row['Product']['id'];
	 	?>
	 
	 <ul>
	 	<li class="li-dau"><a href="<?php echo DOMAIN?>">Trang chủ</a></li>
			<?php $cat=$this->requestAction('comment/get_name_catproduct/'.$row['Product']['catproduct_id']);
	 	foreach ($cat as $cat){ 
		if($cat['Catproduct']['id']==82){
		?>
	 	<li class="li-dau"><a href="<?php echo DOMAIN?>tieu-dung">
	 <?php
	 } else{?>
	 
	 <li class="li-dau"><a href="<?php echo DOMAIN?>du-lich">
	 <?php
	 }
	 		echo $cat['Catproduct']['name']; 
	 	}
	 	?>
	 	
	 	</a></li>
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
	 </div><!-- End content-top-body -->
	 
	 
	 
	 
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
	 	
	 	<div id="gallery" class="ad-gallery">

		<div class="gallery1">
	
	 
	 
	  	   <a rel="example_group" href="" class="them">
	 	   
         <div class="ad-image-wrapper">
		
		 
      </div>
	    </a>
	
	  
      </div>
      
 
     
      <div class="ad-nav">
        <div class="ad-thumbs">
          <ul class="ad-thumb-list">
          
          <?php $gallery=$this->requestAction('comment/gallery/'.$id);
          $i=0;
          foreach ($gallery as $gallery){
          ?>
            <li>
         
              <a href="<?php echo DOMAINAD.$gallery['Gallery']['images']?>">
              
              <img class="image<?php echo $i++;?>" src="<?php echo DOMAINAD?>/timthumb.php?src=<?php echo $gallery['Gallery']['images'];?>&amp;h=72&amp;w=89&amp;zc=1" alt="thumbnail" />
              
                
              </a>
                
            </li>
           <?php }?>
            
           
          </ul>
        </div>
      </div>
    </div>

	 	
	 </div><!-- ENd div-slider -->
	 
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
		<img class="img-ya" width="120" height="25" border="0" src="http://opi.yahoo.com/online?u=<?php echo $helpsonline['Helps']['yahoo'];?>&amp;m=g&amp;t=2&amp;l=us"></a>
			
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
