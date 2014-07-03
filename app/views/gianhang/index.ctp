<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>GIAN-HÀNG-NỔI-BẬT</title>
    <link rel="stylesheet" href="<?php echo DOMAIN?>css/style_template3.css">
	<script src="<?php echo DOMAIN?>js/jquery-latest.js" type="text/javascript"></script>
	<?php echo $javascript->link('jquery.validate', true); ?>
<script type="text/javascript">
$().ready(function() {
	// validate signup form on keyup and submit
	$("#signupForm").validate({
		rules: {
				password: {
				required: true,
				minlength: 5
			},
			
			shopname: {
				required: true,
				
			},
			
			agree: "required"
		},
		messages: {
				password: {
				required: "<br><span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px; ' >Xin vui lòng nhập password!</span>",
				minlength: "<br><span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px; ' > Password lớn hơn 5 ký tự!</span>"
			},
			
			shopname:{
						required: "<br> <span style='color:#FF0000; font-family:Arial, Helvetica, sans-serif; font-size:11px;' >Xin vui lòng nhập tên đăng nhập</span> ",
						
			}
		}
	});
});
</script>
<style>
.a-footer{color:black; font-weight:bold;}
.a-footer:hover{
color:red !important;
}
.ul-mn li{
padding:7px 4px 7px 0px !important;
}
.name-sp{color:black; font-weight:bold;}
.name-sp:hover{
color:red;
}
</style>
</head>
<body>
    <div id='main'>
	
        <div id='header'>
	
		<img style="width:1000px; height:174px;" src="<?php echo DOMAIN?>image_template3/header.png"/>
            <ul class="ul-mn">
			
			<li><a href="<?php echo DOMAIN ?>">HOME</a></li>
			
			<?php $categoryshop =$this->requestAction('comment/categoryshop');
			
			
			$shop=explode('/',$this->params['url']['url']); 
			$cat='';
			if(isset($shop[1])) {
			$cat= $shop[1]; }
			
			foreach($categoryshop  as $row){
			if($cat==''){$cat=$row['Categoryshop']['id'];}
			
			
			?>
                <li <?php if($row['Categoryshop']['id']==$cat){ echo 'id="home"'; $catname=$row['Categoryshop']['name'];}?>><a href="<?php echo DOMAIN ?>gian-hang/<?php echo $row['Categoryshop']['id']?>"><?php echo $row['Categoryshop']['name']?></a></li>
               
            <?php }
		
			?>
              
            </ul>
        </div><!--end #header-->
      
	  
	  <?php echo $this->element('content_left');?>
	  
     <div id='content'>
	
           
			
		
            <div id='new-product'>
                <h2>SẢN PHẨM MỚI THUỘC <?php echo $this->Help->upper($catname);?></h2>
				
				<?php 
				
				foreach($productshop as $productshop){
				$kt=$this->requestAction('gianhang/kt_shop/'.$productshop['Productshop']['shop_id']);
				foreach( $kt as $kt){
			
				if($kt) {
				
				$nameshop=$this->requestAction('comment/get_name_shop/ '.$productshop['Productshop']['shop_id']);
					//pr($nameshop); die;
					foreach($nameshop as $name){  
				
				
				?>
                <div class="product" >
                    <a target="_blank" href="<?php echo DOMAIN.$name?>/chi_tiet_san_pham/<?php echo $productshop['Productshop']['id']?>"><img style="width:122px; height:122px;" src="<?php echo DOMAIN.$productshop['Productshop']['images']?>"></a>
                    <a class="name-sp" target="_blank" href="<?php echo DOMAIN.$name?>/chi_tiet_san_pham/<?php echo $productshop['Productshop']['id']?>">
					<p><?php echo $productshop['Productshop']['title']?></p>
					</a>
					<br/>
                        <span class='price'><?php echo $productshop['Productshop']['price']." ".$productshop['Productshop']['money'];?> 
						
						</span><br/>
                       
                    </p>
                </div>
              <?php }
			  }
			  
			  }
			  }?>
                <div class="clear"></div>
            </div><!--end #new-product-->
        </div><!--end #content-->
		
		
		<?php echo $this->element('content_right');?>
     
        <div id='footer'>
            <ul>
			
			<?php $categoryshop =$this->requestAction('comment/categoryshop');
			
			//pr($categoryshop); die;
			$i=0;
			foreach($categoryshop  as $row){
			$i++
			?>
                <li><a class="a-footer" href="<?php echo DOMAIN ?>gian-hang/<?php echo $row['Categoryshop']['id']?>"><?php echo $row['Categoryshop']['name']?> |</a></li>
               
            <?php }
		
			?>
               
            </ul>

        </div><!--end #footer-->
    </div><!--end #main-->
</body>
</html>