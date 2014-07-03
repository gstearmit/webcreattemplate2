 <style>
    #input{
		width:250px;
		border: 1px solid #C2C2C2;
		height:22px;
		
		}
   .guimail tr td{
	   padding-top:10px;
	   padding-right:20px;
	   }
	.guimail textarea{
		border: 1px solid #C2C2C2;
		
		}
		.bd-right p{color:#65390d;
		
		}
		.title-content{border-bottom:1px solid #f1e1bf;
		overflow:hiden;
		
		}	
		
</style>
 

 
 	<?php echo $this->Html->css('validationEngine.jquery');?>

<script src="<?php echo DOMAIN?>js/fancybox/jquery.fancybox-1.3.2.js" type="text/javascript"></script>
  <link rel="stylesheet" href="<?php echo DOMAIN?>css/jquery-ui-1.8.20.custom.css">
	
	<script src="<?php echo DOMAIN?>js/jquery-ui-1.8.20.custom.min.js"></script>
	

	<script type="text/javascript" src="<?php echo DOMAIN;?>js/jquery.validationEngine.js"></script>
<script>
  $(document).ready(function(){
    $("#check_form").validationEngine();
  });
</script>

 <style>
 p{text-align:justify;}
 
 </style>
 

  <link type="text/css" href="<?php echo DOMAIN ?>css/phantrang.css" rel="stylesheet" /> 
 
  
 <div id="main-content">
	 
	 <div class="content-top">
	  <div class="menu-top" style="background: url(<?php echo DOMAIN?>/images/menu_lienhe.png) no-repeat;">
	 
	 	<ul>
	 		<li class="home"><a style="color:white;"href="<?php echo DOMAIN?>">HOME</a></li>
	 		<li class="li-menu" style="margin-left:80px;"><a  href="<?php echo DOMAIN?>du-lich">DU LỊCH</a></li>
	 		<li class="li-menu" style="margin-left:62px;"><a  href="<?php echo DOMAIN?>tieu-dung">TIÊU DÙNG</a></li>
	 		<li class="li-menu" style="margin-left:45px;"><a href="<?php echo DOMAIN?>gian-hang">GIAN HÀNG</a></li>
	 		<li class="li-menu" style="margin-left:60px;"><a  style="color:#30b44c;" href="<?php echo DOMAIN?>lien-he">LIÊN HỆ</a></li>
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
	<div class="content-right" style="margin:20px;background:white;padding:20px;">
            		<div class="tit-right">
            			<h2 style="font-size:18px; font-wight:bold;color:#65390d;padding-top:15px;">LIÊN HỆ</h2>
            		</div>
            		
            		<div class="bd-right">
            		
  
 
 

<div class="title-content" >
<?php $setting=$this->requestAction('comment/setting');
foreach ($setting as $setting){
?>
   <p style="font-weight:bold;">
   <?php echo $setting['Setting']['name'];?>
      </p>
   <p style="margin-top:5px;margin-bottom:10px;">

    Trụ sở: <?php echo $setting['Setting']['address'];?>
    <br>
	  Văn phòng giao dịch: <?php echo $setting['Setting']['address_eg'];?>
    <br>
    Điện thoại: <?php echo $setting['Setting']['phone'];?> - Fax: <?php echo $setting['Setting']['fax'];?>
    <br>
    Email: <?php echo $setting['Setting']['email'];?><br>
     </p>
     
   <?php }?>
</div>
<p style="font-weight:bold;margin-top:10px;">Để gửi thư cho chúng tôi, bạn vui lòng điền thông tin chi tiết vào form sau: </p>
        <form method="post" id="check_form" action="<?php echo DOMAIN; ?>contacts/send">
                <table class="guimail">
                    <tr><td>Họ và tên (*): </td><td><input id="input" name="name" class="validate[required] name" type="text"></td></tr>
					<tr><td>Email (*):</td><td><input id="input" type="text"  class="validate[required,custom[email]] email" name="email"></td></tr>
                      <tr><td>Số điện thoại(*):</td><td><input id="input" type="text" class="validate[required,custom[telephone]]" name="phone_dd"></td></tr>
                     <tr><td>Tiêu đề (*) :</td><td><input id="input" type="text" class="validate[required] title" name="title"></td></tr>
                    <tr><td>Nội dung (*) :</td><td><textarea name="content" class="validate[required] nd" cols="50" rows="10"></textarea></td></tr>
                   <tr><td></td><td style="color:red;">Chú ý: Bạn phải điền đủ thông tin vào các ô có dấu *</td></tr>
                    <tr><td></td>
                    <td>
                    <input type="submit" value=" GỬI ĐI ">
                    <input type="reset" value=" LÀM LẠI " >
                    </td></tr>
                </table>
           </form>
   </div>

            		
            	</div><!-- ENd content-right -->
            		
	       
	
	 </div><!-- End content-top-body -->
	 <div class="bgbottom"></div>
	 </div><!-- End content-top -->
	 
	 
	 </div><!-- ENd main content -->


 