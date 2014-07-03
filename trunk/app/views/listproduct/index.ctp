<!-- dổ chi tiết  san pham ra trang chu phần : Sản phẩm còn bán -->
    
<style> p{text-align:justify;} </style>
<link type="text/css" href="<?php echo DOMAIN ?>css/phantrang.css" rel="stylesheet" />

<div id="main-content">
	 <div class="content-top">
    	 <?php echo $this->element('menu_top');?>
    	 <div class="content-top-body">
        	 <h2 style="margin-left:20px;margin-top:20px;">CÁC SẢN PHẨM CÒN BÁN</h2>
        	     <!-- lay dư lieu tu con troller : listproduct_controller.php de tien hanh lặp foreach--> 
        	 <?php foreach ($prod as $product){
        	    //$prod ??? : tại function xuly()  cua product_controller
                //$prod=$this->Product->find('all',array('conditions'=>array('Product.id'=>$_POST['product_id'],'Product.status'=>1)));
               //$prod ??? : tim tat ca product co id bang id nhap vao va status = 1
                 //   xuat hien bien $prod tai controllor : product_controller
                 //   $product : xuat hien o dau : 
        	   ?>
        	 	
        	 		<a href="<?php echo DOMAIN?>san-pham/<?php echo $product['Product']['id']?>">
                    	 		<div style="float:left;">
            															
                                                                        	   <div class="spnb" style="background:white;margin-left:18px;">
                                                                        
                                                                        	    
                                                           
            																	<a style="color:black;"href="<?php echo DOMAIN?>san-pham/<?php echo $product['Product']['id']?>">
            			  	<table style="padding-left:7px; padding-right:7px;">
            			  	<tr><td style="height:42px; color:#2fb34b; font-weight:bold;" >
            			  		<?php $str=$this->Help->catchu( $product['Product']['title'],40);
            			  			echo $str;
            			  		?>
            			  	</td></tr>
            			  	<tr><td style="border:1px solid #d7d7d7; overflow:hidden; padding:1px;"><img class="img-spnb" src="<?php echo DOMAINAD.$product['Product']['images'];?>"/></td></tr>
            			  	<tr><td style="padding-top:5px; padding-bottom:5px;height:60px; overflow:hidden;">
            			  		<?php 
            			  		$str=$this->Help->catchu( $product['Product']['introduction'],140);
            			  		echo $str;
            			  		?>
            			  	
            			  	</td></tr>
            			  	<tr><td style="color:red;text-align:center;"><span style="font-size:25px;font-weight:bold;">
            			  		 <?php 
            	 			echo number_format($product['Product']['price'],0,'.','.');
            	 			?>
            			  	</span> <span style="margin-left:5px;">vnđ</span></td></tr>
            			  	<tr> 
            			  	</table>
            			  	<table style="text-align:center; margin-left:10px;" >
            			  	<tr> <td style="border-right:1px solid #b6b6b6;color:black;width:85px;"><b style="font-size:15px;">
            			  	<?php 
            	 				$giacu=$product['Product']['price_old'];
            	 				$giamoi=$product['Product']['price'];
            	 				
            	 				 echo round(($giacu-$giamoi)*100/$giacu)."%";
            	 				
            	 				?>
            			  	</b><br>Tiết kiệm</br></td>
            	 				<td style="padding-left:10px;"><b style="font-size:15px;">
            	 				<?php 
            	 				$ngay =  explode('-',$product['Product']['date_ketthuc']);
            	 				$lastdate=mktime(0,0,0,$ngay['1'],$ngay['2'],$ngay['0']);
            	 				$now=mktime();
            	 				$d=$lastdate-$now;
            	 				$days=floor($d/86400);
            	 				if($days<0){$days=0;}
            	 				echo $days. " ngày";
            	 			
            	 				?>
            	 				</b><br>Thời gian còn lại</td></tr>
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
