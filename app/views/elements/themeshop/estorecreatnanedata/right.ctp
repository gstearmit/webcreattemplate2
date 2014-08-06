<?php
$shop = explode ( '/', $this->params ['url'] ['url'] );
$shopname = $shop [0];
$shop = $this->requestAction ( 'comment/get_shop_id/' . $shopname );
foreach ( $shop as $key => $value ) {
	$shop_id = $key;
}

?>
<!--hotline-->
    <div id="hotline">
       <h3>TÌM KIẾM</h3>
      <form action="<?php echo DOMAIN;?><?php echo $shopname ;?>/search" method="post" style="width: 200px;">
                <select style="width: 185px;margin-left: 10px;margin-top:10px; height: 20px; margin-bottom: 5px;" name="system">
                           <option value="" >Chọn loại sản phẩm</option>
                            <?php 
                            $cat = $this->requestAction('/'.$shopname.'/cat');
	                      //pr($cat);
                            ?>
                            <?php foreach($cat as $Catproduct) {?>
                            <?php if($Catproduct['Estore_catproducts']['parent_id']==11) {?>
                             <option value="<?php echo $Catproduct['Estore_catproducts']['id']; ?>"><?php echo $Catproduct['Estore_catproducts']['name']; ?></option>
                             <?php $catcon = $this->requestAction('/'.$shopname.'/catcon') ?>
                             <?php foreach($catcon as $Catproducts) {?>
                             <?php if($Catproducts['Estore_catproducts']['parent_id']==$Catproduct['Estore_catproducts']['id']){?>
                             <option value="<?php echo $Catproducts['Estore_catproducts']['id']; ?>">--<?php echo $Catproducts['Estore_catproducts']['name']; ?></option>
                                <?php $catcons = $this->requestAction('/'.$shopname.'/catcon') ?>
                             <?php foreach($catcons as $Catproductss) {?>
                             <?php if($Catproductss['Estore_catproducts']['parent_id']==$Catproducts['Estore_catproducts']['id']){?>
                             <option value="<?php echo $Catproductss['Estore_catproducts']['id']; ?>">----<?php echo $Catproductss['Estore_catproducts']['name']; ?></option>
                         }
                            <?php }}}}
                            }
                            }?>
                 </select>
                 <select style="width: 185px;margin-left: 10px;margin-top:5px; height: 20px; margin-bottom: 5px;" name="hsx">
                           <option value="" >Chọn hãng sản xuất</option>
                            <?php $hsx = $this->requestAction('/'.$shopname.'/hsx') ?>
                            <?php foreach($hsx as $hsx) {?>
                             <option value="<?php echo $hsx['Estore_manufacturers']['id']; ?>"><?php echo $hsx['Estore_manufacturers']['name']; ?></option>                             
                            <?php }?>
                 </select>
                 <select style="width: 185px;margin-left: 10px;margin-top:5px; height: 20px; margin-bottom: 5px;" name="gia">
                           <option value="" >Chọn giá</option>
    
                            <?php for($i=0;$i<9;$i++){?>
                             <option value="<?php echo $i; ?>"><?php echo $i; ?> đến <?php echo $a=$i+1; ?> triệu</option>                             
                            <?php }?>
                             <option value="10">Trên 10 triệu</option>
                 </select>                
                <input class="buttons" type="hidden" id="btnSearch" />
                <input type="image" src="<?php echo DOMAIN;?>home/images/tk.jpg" style="border: 0; height: 27px; width: 60px; float: right; margin: 5px;"/>
             </form> 
    </div> 
                       	

 <!--hotline-->
    <div id="hotline">
       <h3>HỖ TRỢ TRỰC TUYẾN</h3>
      <ul style="padding-top:10px;" >
            <ul>
           <?php 
           $support = $this->requestAction('/'.$shopname.'/helpsonline');?>
             <?php  foreach($support as $itm ){?>                   
           <li style="margin: 5px 7px;"><font style="font-size: 12px; color: #4f4444; "><b><?php echo $itm['Estore_helps']['title']?> </b></font><a href="ymsgr:sendIM?<?php echo $itm['Estore_helps']['user_yahoo']?>" style="margin: 0 10px; float: right;"><img align="absmiddle"  src="http://opi.yahoo.com/online?u=<?php echo $itm['Estore_helps']['user_yahoo']?>&amp;m=g&amp;t=1"/></a></li>
           <li style="margin: 5px 7px;"><font style="font-size: 12px; color: #4f4444; "><b><?php echo $itm['Estore_helps']['user_support']?> </b></font><a href="skype:<?php echo $itm['Estore_helps']['user_skype'] ?>?call" style="margin: 0 10px; float: right;"><img src="<?php echo DOMAIN?>home/images/skype.png"/></a></li>
           <li style="margin: 10px 100px; line-height:16px;"><font style="font-size: 12px; color: #000; "><b></b></font><p align="right"> <font style="font-size: 12px; color: #4f4444;"><b ><?php echo $itm['Estore_helps']['user_mobile']?></b></font></p></li>
           <?php }?>
           </ul>
           <?php $setting = $this->requestAction('/'.$shopname.'/setting') ?>
            <?php foreach($setting as $settings ){  ?>
            <ul>
           <li style="margin: 10px 2px;"><img src="<?php echo DOMAIN?>home/images/hotline.png" align="absmiddle" /><font  style="font-size: 12px; color: #d00000; padding-left:10px;"><b>Hotline : <?php echo $settings['Estore_setting']['mobile'] ?></b></font></li>
           </ul>
            <?php }?>  
    </div> 
    <div id="video">
    <?php $video = $this->requestAction('/'.$shopname.'/videosright') ?>
        <?php  foreach($video as $video){?> 
        <?php 
        $url = $video['Estore_video']['LinkUrl'];
        parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );     
        ?>
       <iframe width="202px" height="202px" src="http://www.youtube.com/embed/<?php echo $my_array_of_vars['v'];?>" frameborder="0" allowfullscreen></iframe>
       <?php }?>
    </div>
    
    <?php $advr= $this->requestAction('/'.$shopname.'/advr') ?>
    <?php foreach($advr as $advs1 ){  ?>
    <div id="video">
     <a href="<?php echo $advs1['Estore_advertisements']['link'] ?>" target="_blank"><img src="<?php echo DOMAINADESTORE.$advs1['Estore_advertisements']['images']?>" border="0" width="202px" alt="" /></a>  
     </div> 	
     <?php }?>
    <div id="hotline">
                           <h3>Thống kê</h3>
                           <div align="center" style="margin: 10px 0;" >
                             <!-- Histats.com  START (html only)-->
<a href="http://www.histats.com" alt="page hit counter" target="_blank" >
<embed src="http://s10.histats.com/306.swf"  flashvars="jver=1&acsid=2019084&domi=4"  quality="high"  width="118" height="60" name="306.swf"  align="middle" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" wmode="transparent" /></a>
<img  src="http://sstatic1.histats.com/0.gif?2019084&101" alt="website statistics" border="0">
<!-- Histats.com  END  -->
                            </div>
                       	</div> 
                       	
