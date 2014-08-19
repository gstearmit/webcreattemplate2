<style>
#thumblist img{
	margin:auto !important;
	}
</style>
<div class="title-content">
       <p><?php echo $views['Eshopdaquyproduct']['title']?></p>
    </div>
<div class="list-text">
    <div class="detail">
       <div class="san-pham-chi-tiet">
    
            <div class="san-pham-chi-tiet-trai floatleft">
                 <div class="clearfix">
                <div class="bg-top-ha-chi-tiet"></div>
    
                <div class="bg-center-ha-chi-tiet">
                    <div class="clearfix">
                        <a href="<?php echo DOMAINADBUSINISS;?><?php echo $views['Eshopdaquyproduct']['images']?>" class="jqzoom" rel='gal1'  title="triumph" >
                            <img style="width:320px;" src="<?php echo DOMAINADBUSINISS;?><?php echo $views['Eshopdaquyproduct']['images']?>"  title="triumph"/>
                        </a>
                    </div>
                 </div>
                <div class="bg-bottom-ha-chi-tiet">
                    
				  </div>
                  <div class="clearfix" style="margin-bottom:20px;" >
                        <ul id="thumblist" class="clearfix" >
                        <?php if($views['Eshopdaquyproduct']['images']){?>
                            <li>
                               <a class="zoomThumbActive" href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo DOMAINADBUSINISS;?><?php echo $views['Eshopdaquyproduct']['images']?>',largeimage: '<?php echo DOMAINADBUSINISS;?><?php echo $views['Eshopdaquyproduct']['images']?>'}"><img style="width:50px; height:40px;" src='<?php echo DOMAINADBUSINISS;?><?php echo $views['Eshopdaquyproduct']['images']?>'></a>
                            </li>
                            <?php }if($views['Eshopdaquyproduct']['images1']){?>
                            <li>
                               <a href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo DOMAINADBUSINISS;?><?php echo $views['Eshopdaquyproduct']['images1']?>',largeimage: '<?php echo DOMAINADBUSINISS;?><?php echo $views['Eshopdaquyproduct']['images1']?>'}"><img style="width:50px; height:40px;" src='<?php echo DOMAINADBUSINISS;?><?php echo $views['Eshopdaquyproduct']['images1']?>'></a>
                            </li>
                            <?php }if($views['Eshopdaquyproduct']['images2']){?>
                            <li>
                               <a  href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo DOMAINADBUSINISS;?><?php echo $views['Eshopdaquyproduct']['images2']?>',largeimage: '<?php echo DOMAINADBUSINISS;?><?php echo $views['Eshopdaquyproduct']['images2']?>'}"><img style="width:50px; height:40px;" src='<?php echo DOMAINADBUSINISS;?><?php echo $views['Eshopdaquyproduct']['images2']?>'></a>
                            </li>
                            <?php }if($views['Eshopdaquyproduct']['images3']){?>
                            <li>
                               <a href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo DOMAINADBUSINISS;?><?php echo $views['Eshopdaquyproduct']['images3']?>',largeimage: '<?php echo DOMAINADBUSINISS;?><?php echo $views['Eshopdaquyproduct']['images3']?>'}"><img style="width:50px; height:40px;" src='<?php echo DOMAINADBUSINISS;?><?php echo $views['Eshopdaquyproduct']['images3']?>'></a>
                            </li>
                            <?php }if($views['Eshopdaquyproduct']['images4']){?>
                            <li>
                              <a  href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo DOMAINADBUSINISS;?><?php echo $views['Eshopdaquyproduct']['images4']?>',largeimage: '<?php echo DOMAINADBUSINISS;?><?php echo $views['Eshopdaquyproduct']['images4']?>'}"><img style="width:50px; height:40px;" src='<?php echo DOMAINADBUSINISS;?><?php echo $views['Eshopdaquyproduct']['images4']?>'></a>
                            </li>
                            <?php }?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="san-pham-chi-tiet-phai floatleft">
                <div class="title-chi-tiet-sp"><?php echo $views['Eshopdaquyproduct']['title']?></div>
                    <div class="gia-chi-tiet-sp"><b>Giá: </b><font color="red"><?php echo $views['Eshopdaquyproduct']['price']?> VNĐ</font></div>
                    <div class="so-luong-chi-tiet-sp">     </div>                
 
    
                    <div style="text-align:center; border-top:1px solid #DDD; margin:5px; padding-top:10px;">
    
                        
    
                   </div> 
    
            </div>
    
             <div class="clearfix"></div>
    
        </div>
          <!-- AddThis Button BEGIN -->
                <div class="addthis_toolbox addthis_default_style ">
                <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                <a class="addthis_button_tweet"></a>
                <a class="addthis_button_pinterest_pinit"></a>
                <a class="addthis_counter addthis_pill_style"></a>
                </div>
               <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4ff39d2d10b64660"></script>
        <!-- AddThis Button END -->
        
       <div class="thong-tin-chi-tiet">    
    
            <div class="bg-top-chi-tiet">
    
       
            <div class="title-thong-tin-chi-tiet">
                  <ul class="tabs">
                     <li class="active"><a href="#tab1">THÔNG TIN CHI TIẾT</a></li>
                  <!--  <li><a href="#tab2">Ý kiến khách hàng</a></li> -->
                  </ul>
            </div>        
    
            <div class="bg-center-chi-tiet">            
    
                <div class="chi-tiet-san-pham">
                   <div style="display: none;" id="tab1" class="tab_content">
                   <p><?php echo $views['Eshopdaquyproduct']['content']?></p>
                   </div> 
                   <div style="display: none;" id="tab2" class="tab_content">
                      <div style="float:left;">
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
                            </style>
                            <form method="post" id="check_form" action="<?php echo DOMAIN; ?>contacts/send">
                                <table class="guimail">
                                    <tr><td>Tên </td><td><input id="input" name="name" class="validate[required]" type="text"/></td></tr>
                                    <tr><td>Điện thoại</td><td><input id="input" type="text" class="validate[required,custom[telephone]]" name="phone"/></td></tr>
                                    <tr><td>Email</td><td><input id="input" type="text" name="email"/></td></tr>
                                    <tr><td>Tiêu đề</td><td><input id="input" type="text" class="validate[required]" name="title"/></td></tr>
                                    <tr><td>Nôi dung</td><td><textarea name="content" cols="50" rows="10"></textarea></td></tr>
                                    <tr><td></td><td><input type="submit" value=" Gửi đi "/>&nbsp;<input type="reset" value=" Soạn lai "/></td></tr>
                                </table>
                            </form>
                     </div>
                   </div> 
               </div>
    
            </div>
    
            </div>
    
                <div class="bg-bottom-chi-tiet" style="overflow:hidden; height:auto !important;">
                  
                
                </div>
    
             </div>
             
                   
    </div>
    
</div>	

<div class="title-content">
       <p>Các sản phẩm liên quan</p>
 </div>
  <div class="product">
       <ul>
         <?php 
		 $a = array();
		 $i = 2;
		 $j = 0;
		 
		 foreach($list_others as $listproduct){ $a[$j++] = $listproduct; ?>
          <li>
        <h1>
          <a href="<?php echo DOMAIN.$shopname;?>/viewproduct/<?php echo $listproduct['Eshopdaquyproduct']['id'];?>" data-tooltip="sticky<?php echo $i; ?>">
           <div style=" overflow:hidden; width:160px; height:128px; background-image:url(<?php echo DOMAINADBUSINISS?>/timthumb.php?src=<?php echo $listproduct['Eshopdaquyproduct']['images'];?>&amp;h=128&amp;w=160&amp;zc=1); background-position:center center; background-repeat:no-repeat; background-color:#fff; margin:auto;" class="img">             
           </div> 
        </h1>
        <h2><a style="color:#0266A8;" href="<?php echo DOMAIN.$shopname;?>/viewproduct/<?php echo $listproduct['Eshopdaquyproduct']['id'];?>"><?php echo $listproduct['Eshopdaquyproduct']['title'];?></a></h2>
        
        <div class="div"><a href="<?php echo DOMAIN.$shopname;?>/viewproduct/<?php echo $listproduct['Eshopdaquyproduct']['id'];?>"><img src="<?php echo DOMAIN;?>daquybusniss/images/detail1.png" style="margin-top:10px;" /></a></h2>
        </div>
      </li>
	  <?php $i++ ?>
          <?php }?>
       </ul>
        
    </div>
	
	<div id="mystickytooltip" class="stickytooltip">
<div style="padding:5px">
<?php $i=2; 
foreach($a as $listproduct) {
?>
<div id="sticky<?php echo $i; ?>" class="atip" style=" display: block;">	
<img src="<?php echo DOMAINADBUSINISS; ?><?php echo $listproduct['Eshopdaquyproduct']['images']; ?>">
</div>
<?php $i++ ?>
<?php } ?>
</div>
</div>