
 <style>
 p{text-align:justify;}
 </style>
 
  <link type="text/css" href="<?php echo DOMAIN ?>css/phantrang.css" rel="stylesheet" /> 
 
  
 <div id="main-content">
	 
	 <div class="content-top">
	 <div class="menu-top" style="background: url(<?php echo DOMAIN?>/images/bgdulich.png) no-repeat;">
	 
	 	<ul>
	 		<li class="home"><a style="color:white;"href="<?php echo DOMAIN?>">HOME</a></li>
	 		<li class="li-menu" style="margin-left:80px;"><a style="color:#30b44c;" href="<?php echo DOMAIN?>du-lich">DU LỊCH</a></li>
	 		<li class="li-menu" style="margin-left:62px;"><a  href="<?php echo DOMAIN?>tieu-dung">TIÊU DÙNG</a></li>
	 		<li class="li-menu" style="margin-left:45px;"><a href="<?php echo DOMAIN?>gian-hang">GIAN HÀNG</a></li>
	 		<li class="li-menu" style="margin-left:60px;"><a href="<?php echo DOMAIN?>lien-he">LIÊN HỆ</a></li>
	 		<li style="margin-left:50px; width:233px; overflow:hidden;">
	 			<ul class="ul-tp">
	 			<?php 
	 			$id=$this->Session->read('city');
	 		
	 			$row=$this->requestAction('comment/city/'.$id);
	 		
	 		
	 			foreach ($row as $row){
	 			
	 			?>
	 				<li class="chon" ><a href="<?php echo DOMAIN."home/".$row['City']['id']?>"><?php echo $row['City']['name'];?>
	 			
	 				</a></li>
	 					<?php }?>
	 				<?php 
	 				$row=$this->requestAction('comment/city2/'.$id);
	 				foreach ($row as $row){
	 				?>
	 				<li><a href="<?php echo DOMAIN."home/".$row['City']['id']?>"><?php echo $row['City']['name'];?></a></li>
	 				<?php }?>
	 				
	 			</ul>
	 		</li>
	 		
	 	</ul>
	 
	 </div><!-- ENd menu-top -->
	 <div class="content-top-body">
	 
	 	 
	  <div class="d-d">
	 
	 
	 <ul>
	 	<li class="li-dau"><a href="<?php echo DOMAIN?>">Trang chủ</a></li>

	 	</a></li>
	 	<li ><a href="<?php echo DOMAIN?>du-lich" class="a-cuoi">Du lịch</a></li>
	 </ul>
	 
	 </div><!--End d-d-->

	 <?php foreach ($prod as $product){?>
	 <a href="<?php echo DOMAIN?>san-pham/<?php echo $product['Product']['id']?>">
	 	<div class="s-p">
	 		<ul class="ulsp">
	 			<li class="s-p-tit"> <?php echo $product['Product']['title'];?></li>
	 			<li class="li-img"><img src="<?php echo DOMAINAD.$product['Product']['images']?>"/></li>
	 			<li class="li-introduction" style="height:70px;padding-top:10px; overflow:hidden; color:black; text-align:justify;">
	 			
	 				<?php $s=$product['Product']['introduction'];
	 				$tr=$s;
	 				if(strlen($s)>350){ $tr=$this->Help->catchu($s,350);} 
	 				echo $tr;
	 				?> </li>
	 			<div style="height:75px;">
				<table>
				<tr>
					<td> 
	 			<img style="float:left;width:100px; height:50px;"src="<?php echo DOMAIN?>images/xem1.png"/>
	 			</td>
				<td>
						<p class="p-gia"><span style="text-align:right;font-size:25px;font-weight:bold;">
	 			<?php 
	 			echo number_format($product['Product']['price'],0,'.','.');
	 			?>
	 			</span>
	 			<span style="color:font-size:16px;margin-left:5px;">vnđ</span> </p>
	 			<table width="205px" style="overflow:hidden;text-align:center;">
	 				<tr> <td style="border-right:1px solid #b6b6b6;color:black;width:70px;"><b style="font-size:18px;">
	 				<?php 
	 				$giacu=$product['Product']['price_old'];
	 				$giamoi=$product['Product']['price'];
	 				
	 				 echo round(($giacu-$giamoi)*100/$giacu);
	 				
	 				?>
	 				
	 				%</b><br>Tiết kiệm</br></td>
	 				<td style="padding-left:2px;text-align:left;color:black;"><b style="font-size:18px;margin-left:10px;">
	 				<?php 
	 				$ngay =  explode('-',$product['Product']['date_ketthuc']);
	 				$lastdate=mktime(0,0,0,$ngay['1'],$ngay['2'],$ngay['0']);
	 				$now=mktime();
	 				$d=$lastdate-$now;
	 				$days=floor($d/86400);
	 				if($days<0){$days=0;}
	 				echo $days;;
	 			
	 				?>
	 				ngày
	 				</b><br>Thời gian còn lại</td></tr>
	 				
	 			</table>
				</td>
				</tr>
				</table>
	 			
	 		
	 			</div>
	 		</ul>
	 		
	 	</div><!-- ENd s-p -->
	 	</a>
	 	<?php }?>
	 		
	       	<div class="pt">
              <div class="pt-pagi">
              
							<ul><li class="li-prev">
							     <?php 
							     echo $paginator->prev('<');?>
							     </li>
							     
							     <li class="pt-so">
							     
								<?php    echo $paginator->numbers();?>
								</li>
								<li class="li-next">
								<?php 
                                   echo $paginator->next('>'); 
              ?>	</li>
              </ul>
              </div><!-- End pt-pagi-->
           </div><!-- End pt-->
	
	       
	
	 </div><!-- End content-top-body -->
	 <div class="bgbottom"></div>
	 </div><!-- End content-top -->
	 
	 
	 </div><!-- ENd main content -->
