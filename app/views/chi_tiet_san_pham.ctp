<?php 
			
			$shop=explode('/',$this->params['url']['url']); 
			$shopname=$shop[0];
				$shop=$this->requestAction('comment/get_shop_id/'.$shopname);
				
				
				foreach($shop as $key=>$value){
				$shop_id=$key;
				}
			
			?>
<style>
.body_module .title_module {
    background: url("../images/1x100.png") repeat-x scroll center bottom transparent;
    border: 1px solid #AED0EA;
    border-radius: 6px 6px 6px 6px;
    color: #222222;
    font-weight: bold;
    height: 26px;
    line-height: 26px;
    overflow: hidden;
    padding-left: 10px;
}
.body_module .khuyen_mai {
    line-height: 150%;
    padding: 5px;
}
.body_module .khuyen_mai ul {
    list-style: none outside none;
    margin: 0;
    padding: 0;
}
.body_module .khuyen_mai li {
    border-bottom: 1px dotted #CCCCCC;
    padding: 3px 0 5px;
}
.body_module .khuyen_mai li img {
    float: left;
    height: 60px;
    margin-right: 5px;
    width: 60px;
}


.thong-tin-chi-tiet {
    margin: auto;
    width: 98%;
}
.bg-top-chi-tiet {
    width: 90%;
}
.title-thong-tin-chi-tiet {
    border-bottom: 1px solid #CCCCCC;
    color: Red;
    font-weight: bold;
    padding: 10px 0 0 10px;
    text-transform: uppercase;
}
.bg-center-chi-tiet {
    margin-top: 10px;
    width: 663px;
}
.bg-bottom-chi-tiet {
    height: 5px;
    width: 90%;
}
.chi-tiet-san-pham {
    padding: 5px;
    text-align: justify;
}


.bg-center-ha-chi-tiet {
    background: none repeat scroll 0 0 #FFFFFF;
     padding: 5px 0;
    text-align: center;
    width: 200px;
}

.san-pham-chi-tiet-phai {
    float: left;
    font-size: 12px;
    font-weight: bold;
    line-height: 20px;
    text-align: left;
    width: 288px;
	overflow:hidden;
	height:230px;
}

.san-pham-chi-tiet-trai {
    float: left;
    text-align: left;
    width: 220px;
	overflow:hidden;
}

ul.list-product li .img-124 {
    height: 125px;
    vertical-align: middle;
    width: 100%;
}
ul.list-product li .img-124 img {
    max-height: 110px;
    max-width: 124px;
}
ul.list-product li h4 {
    color: #313131;
    font-size: 12px;
    font-weight: normal;
    height: 32px;
    line-height: 15px;
    overflow: hidden;
}
ul.list-product li h4 a {
}
ul.list-product li .price {
    color: #FF0000;
    font-weight: bold;
    padding-bottom: 5px;
}
ul.list-product .clr-bg {
    background: none repeat scroll 0 0 transparent;
}

ul.list-product li {
    float: left;
    height: 205px;
    padding: 5px;
    text-align: center;
    width: 180px;
}
.wrapper_body_views{overflow:hidden;}
</style>

<script type="text/javascript" src="<?php echo DOMAIN?>js/jquery-1.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN?>css/visuallightbox.css" />

 <div id='content'>
           
            <div id='new-product'>
                <h2><?php echo $views['Productshop']['title']?></h2>
				<div class="wrapper_body_views">
	<div class="body_module">
		
		<div class="list-text" style="margin-top:20px;">
           <div class="detail">
               <div class="san-pham-chi-tiet">
                        <div class="san-pham-chi-tiet-trai floatleft">
                     
                            
                              <a href="<?php echo DOMAIN;?><?php echo $views['Productshop']['images']; ?>" class="vlightbox" rel="colorbox">
                                  <img style="width:200px;border-width:0px;margin-left:10px;" src="<?php echo DOMAIN;?><?php echo $views['Productshop']['images']; ?>" alt="<?php echo $views['Productshop']['title']?>" id="ctl08_imgChitiet">  
                               </a>
                            
							<script type="text/javascript">
                                var $VisualLightBoxParams$ = {autoPlay:true,borderSize:21,enableSlideshow:true,overlayOpacity:0.4,startZoom:true};
                            </script>
                            <script type="text/javascript" src="<?php echo DOMAIN?>js/visuallightbox.js"></script>
                            <div class="bg-bottom-ha-chi-tiet"></div>
                        </div>
                        <div class="san-pham-chi-tiet-phai floatleft">
                               <div class="title-chi-tiet-sp"><?php echo $views['Productshop']['title']?></div>
                               <div class="gia-chi-tiet-sp"><b>Giá sản phẩm: </b><font color="red"><?php echo $views['Productshop']['price']?> <?php echo $views['Productshop']['money']?></font></div>
                               <div class="so-luong-chi-tiet-sp">
                                  Hãng sản xuất: <?php echo $views['Productshop']['maker']?>
                               </div> 
                               <div class="so-luong-chi-tiet-sp">
                                  Số lượng: <?php echo $views['Productshop']['number']?>
                               </div>    
                               <?php if($views['Productshop']['quality']){?>
                               <div class="so-luong-chi-tiet-sp">
                                  Chất lượng: <?php echo $views['Productshop']['quality']?>
                               </div>   
                               <?php }if($views['Productshop']['made']){?>
                               <div class="so-luong-chi-tiet-sp">
                                  Xuất xứ: <?php echo $views['Productshop']['made']?>
                               </div>
                               <?php }if($views['Productshop']['warranty']){?>
                               <div class="so-luong-chi-tiet-sp">
                                  Bảo hành: <?php echo $views['Productshop']['warranty']?>
                               </div>    
                               <?php }if($views['Productshop']['link']!="http://"){?>            
                               <div class="so-luong-chi-tiet-sp">
                                  Link sản phẩm: <?php echo $views['Productshop']['link']?>
                               </div>     
                               <?php }?>
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
                        <div class="chi-tiet-san-pham"><p><?php echo $views['Productshop']['content']?></p></div>
                    </div>
                </div>
                    <div class="bg-bottom-chi-tiet"></div>
                 </div>
				 <p style="margin-left:60px; text-align:left;width:150px; margin-top:20px;">
				 
				<a style="margin-top:5px;" href="<?php echo DOMAIN.$shopname?>/lien_he">
				 <img src="<?php echo DOMAIN;?>image_template1/dat_hang.png" /></a>
				 </p>
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
			  // pr($list_others); die;
			     foreach($list_others as $productshops){?>
				<li>
					<table class="img-124">
						<tr valign="middle">
							<td>
								<a href="<?php echo DOMAIN.$shopname;?>/chi_tiet_san_pham/<?php echo $productshops['Productshop']['id'];?>"><img alt="" class="" src="<?php echo DOMAIN;?><?php echo $productshops['Productshop']['images'];?>" /></a>
							</td>
						</tr>
					</table>
					<h4><a href="<?php echo DOMAIN.$shopname?>/chi_tiet_san_pham/<?php echo $productshops['Productshop']['id'];?>"><?php echo $productshops['Productshop']['title'];?></a></h4>
					<p class="price"><?php echo $productshops['Productshop']['price'];?> <?php echo $productshops['Productshop']['money'];?></p>
					<p><a style="margin-top:5px;" href="<?php echo DOMAIN.$shopname?>/lien_he"><img src="<?php echo DOMAIN;?>image_template1/dat_hang.png" /></a></p>
				</li>
			   <?php }?>		
		    </ul>
			<div class="clr"></div>
		</div>
	</div>
	</div>
</div>
            </div><!--end #new-product-->
        </div><!--end #content-->



