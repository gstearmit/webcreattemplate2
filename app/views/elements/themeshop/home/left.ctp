<?php
//echo "lefefsssdsd";

$shop = explode ( '/', $this->params ['url'] ['url'] );
$shopname = $shop [0];
$shop = $this->requestAction ( 'comment/get_shop_id/' . $shopname );
foreach ( $shop as $key => $value ) {
	$shop_id = $key;
}

$user = $this->requestAction ( 'comment/get_user_id/' . $shop_id );
foreach ( $user as $user ) {
	$user_id = $user ['Shop'] ['user_id'];
}

$banner = $this->requestAction ( 'comment/get_banner/' . $user_id );

$tem = $this->requestAction ( 'comment/get_tem/' . $user_id );

foreach ( $tem as $tem ) {
	$template = $tem ['Tem']['linktems'];
}

// pr($shopname);
// echo "shop_id ";pr($shop_id);
// echo "user_id ";pr($user_id);
// echo "banner ";pr($banner);
// echo "tem ";pr($tem);
// echo "template ";pr($template);

?>
<link rel="stylesheet" href="<?php echo DOMAIN;?>home/lib/jquery.tooltip.css" />
<link rel="stylesheet" href="<?php echo DOMAIN;?>home/lib/screen.css" />

<script src="<?php echo DOMAIN;?>home/lib/jquery.bgiframe.js" type="text/javascript"></script>
<script src="<?php echo DOMAIN;?>home/lib/jquery.dimensions.js" type="text/javascript"></script>
<script src="<?php echo DOMAIN;?>home/lib/jquery.tooltip.js" type="text/javascript"></script>

<script src="<?php echo DOMAIN;?>home/lib/chili-1.7.pack.js" type="text/javascript"></script>

<script type="text/javascript">
$(function() {
$('#set1 *').tooltip();

$("#foottip a").tooltip({
	bodyHandler: function() {
		return $($(this).attr("href")).html();
	},
	showURL: false
});

$('#tonus').tooltip({
    track: true,
	delay: 0,
	showURL: false,
    fade: 250,
	bodyHandler: function() {
		return $("<img />").attr("src", this.src);
	}
});

$('#yahoo a').tooltip({
	track: true,
	delay: 0,
	showURL: false,
	showBody: " - ",
	fade: 250
});

$("select").tooltip({
	left: 25
});

$("map > area").tooltip({ positionLeft: true });

$("#fancy, #fancy2").tooltip({
	track: true,
	delay: 0,
	showURL: false,
	fixPNG: true,
	showBody: " - ",
	extraClass: "pretty fancy",
	top: -15,
	left: 5
});

$('#pretty').tooltip({
	track: true,
	delay: 0,
	showURL: false,
	showBody: " - ",
	extraClass: "pretty",
	fixPNG: true,
	left: -120
});

$('#right a').tooltip({
	track: true,
	delay: 0,
	showURL: false,
	extraClass: "right"
});
$('#right2 a').tooltip({ showURL: false, positionLeft: true });

$("#block").click($.tooltip.block);

});
</script>
<!--menu left
<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN;?>css/menuleft/ddlevelsmenu-base.css" />
<script type="text/javascript" src="<?php echo DOMAIN;?>css/menuleft/ddlevelsmenu.js"></script>

<div id="hotro">
                        
                        	<div id="bong">
                                <div class="top"><h3>List Products</h3></div>
                                <div id="ddsidemenubar">
                                    <ul >
                                    <?php
                                    $root = $this->requestAction('/'.$shopname.'/danhmuc/'.$shopname);
                                    // pr($root);
                                    /*
                                         $i=1;	foreach ($root as $value){?>
                                 		<li ><a rel="ddsubmenuside<?php echo $i;?>" href="<?php echo DOMAIN;?>danh-muc-san-pham/<?php echo $value['Estore_catproduct']['id']?>"><?php echo $value['Estore_catproduct']['name']?></a>                    	 
                                 			<?php $category = $this->requestAction('/'.$shopname.'/showsmenu1/'.$value['Estore_catproduct']['id']);?>                                 			                                            
                                 				<ul id="ddsubmenuside<?php echo $i;?>" class="ddsubmenustyle blackwhite">
                         							<?php foreach($category as $k=>$subcat){?>
                         									<li><a  href="<?php echo DOMAIN;?>danh-muc-san-pham/<?php echo $subcat['Estore_catproduct']['id']?>"><img src="<?php echo DOMAIN;?>images/menubullet1.png" align="absmiddle"/>&nbsp;&nbsp;<?php echo $subcat['Estore_catproduct']['name']?></a>
                                                             <?php $categorys = $this->requestAction('/'.$shopname.'/showsmenu1/'.$subcat['Estore_catproduct']['id']);?>
                                                     			                                               
                                                     				<ul>
                                             							<?php foreach($categorys as $k=>$subcats){?>
                                             									<li><a  href="<?php echo DOMAIN;?><?php echo $shopname ;?>/listproduct/<?php echo $subcats['Estore_catproduct']['id']?>"><img src="<?php echo DOMAIN;?>images/menubullet1.png" align="absmiddle"/>&nbsp;&nbsp;<?php echo $subcats['Estore_catproduct']['name']?></a></li>
                                             							<?php }?>
                                                                              						 
                                                 					</ul>
                                                     		
                                                             </li>
                                                            
                         							<?php }  ?>
                                                          						 
                             					</ul>
                               	
                                        </li>
                        				<?php $i++;}    */ ?>	
                                    
                                    <br/> &nbsp;                           
                                    </ul>
                                </div>
                                <script type="text/javascript">
                                                ddlevelsmenu.setup("ddsidemenubar", "sidebar")
                                                </script>
                           </div>
                        </div> --><!--enddanhmucsanpham--> 

<script type="text/javascript">

$(document).ready(function()
{
	//slides the element with class "menu_body" when paragraph with class "menu_head" is clicked 

	$("#secondpane p.menu_head").click(function()
    {
	     $(this).next("div.menu_body").slideDown(500).siblings("div.menu_body").slideUp("slow");
         $(this).siblings();
	});
});
</script>

<style>
.menu_list {	
	width: 195px;
}
.menu_head {
	padding: 6px 16px;
	cursor: pointer;
	position: relative;
	margin:1px 0px;
    font-weight:bold;
    font-size: 12px;
    background: #e3e3e3 url(<?php echo DOMAIN;?>home/images//left_menu_li.jpg) no-repeat left;
    color:#363636;
    width: 170px;
}
.menu_body {
	display:block;
}
.menu_body a{
  display:block;
  color:#363636;
  padding-left:20px;
  font-weight:bold;
  text-decoration:none;
  margin: 0px 0px;
  border-top:1px solid #e3e3e3;
  border-bottom:1px solid #e3e3e3;
  font-size: 12px;
  line-height: 30px;
    width: 182px;
}
.menu_body a:hover{
  color: #850000;
background: #e3e3e3;
  
  }
.menu_bodys{
    display: none;
}
  .menu_bodys a{
  display:block;
  color:#363636;
  padding-left:20px;
  font-weight:bold;
  text-decoration:none;
  margin: 0px 20px;
  font-size: 12px;
  line-height: 30px;
  border-top:none;
  border-bottom:none;
  background: url(<?php echo DOMAIN;?>home/images/li_menu.png) no-repeat left;
  width: 162px;
}

.menu_bodys a:hover{
  color: #850000;
background: #e3e3e3 url(<?php echo DOMAIN;?>home/images/li_menu.png) no-repeat left;
  
  }
</style>   

                        <div id="hotro">                        
                        	<div id="bong">
                                <div class="top"><h3>Danh mục sản phẩm</h3></div>
                                <div class="menu_list" >
                                 <?php 
                                 $root = $this->requestAction('/'.$shopname.'/danhmuc/'.$shopname);	
                                // pr($root);		
                                         foreach ($root as $value){?>
                                 		<p class="menu_head"><?php echo $value['estore_catproducts']['name']?></p>                	 
                                 			<?php $category = $this->requestAction('/'.$shopname.'/showsmenu1/'.$value['estore_catproducts']['id']);
                                 				if($category){?>
                                 				<div class="menu_body">
                         							<?php foreach($category as $k=>$subcat){?>
                                                    <?php $categorys = $this->requestAction('/'.$shopname.'/showsmenu2/'.$subcat['estore_catproducts']['id']);
                                             				if($categorys){?>
                         								<a href="#tip"><li onClick="cogian('Auto');"><?php echo $subcat['estore_catproducts']['name']?></li></a>
                                                        
                                             				<div class="menu_bodys" id="Auto">
                                     							<?php foreach($categorys as $k=>$subcats){?>
                                     								<a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/listproduct/<?php echo $subcats['estore_catproducts']['id']?>"><?php echo $subcats['estore_catproducts']['name']?></a>
                                     							<?php }?>
                                         					</div>
                                             			<?php  }else{?>
                                                        <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/listproduct/<?php echo $subcat['estore_catproducts']['id']?>"><li><?php echo $subcat['estore_catproducts']['name']?></li></a>
                         							<?php }}?>
                             					</div>
                                 			<?php  }?>	
                         
                        				<?php } ?>
                                </div>
                            </div>
                         </div>
                         
                     
                                <script type="text/javascript">
                    
                    function cogian(objID){
                    var obj=document.getElementById(objID);
                    if(obj.style.display=='') {obj.style.display='block';} else {obj.style.display='';}
                    }
                    </script> 
                        <!--<div id="visa" >
                            <div id="bong">
                               <div class="top"> <h3>News Products</h3></div>
                                <div class="list_carousels">

                                <ul id="foo"style="min-height: 700px;">
                                <?php $productnew = $this->requestAction('/'.$shopname.'/typical/'.$shop_id); 
                                ?>
                                <?php foreach($productnew as $value){?>
                                <li ><div class="sanpham" id="yahoo">
                            	<a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php echo $value['Estore_product']['id'];?>" title="<p align='center'> <img src='<?php echo DOMAINADESTORE.$value['Estore_product']['images']?>'/></p>">
                                <img src="<?php echo DOMAINADESTORE.'timthumb.php?src='.$value['Estore_product']['images']?>&amp;h=131&amp;w=164&amp;zc=1"  width="164" height="131"/></a>
                                <h4>
                                    <a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/view/<?php echo $value['Estore_product']['id'];?>"><?php echo $value['Estore_product']['title'];?></a><br />
                                    Code:<?php echo $value['Estore_product']['code'];?>
                                </h4>
                                
                                </div></li>
                                
                                <?php }?>                             
                                 </ul>
                                 </div>
                            </div>
                        </div>-->
                        <div id="info"> 
                        	<h3>Tin tức khuyến mại</h3>      
                            <?php $hotnew = $this->requestAction('/'.$shopname.'/hotnew/'.$shop_id);?>                 	
                            <ul><?php foreach($hotnew as $value){?>
                            	<li><a href="<?php echo DOMAIN;?><?php echo $shopname ;?>/viewnews/<?php echo $value['estore_news']['id'];?>"><?php echo $value['estore_news']['title'];?> </a></li>                               
                                <?php }?>
                            </ul>
                        </div>  
                        <div id="video">
                        <?php $video = $this->requestAction('/'.$shopname.'/videos/'.$shop_id) ?>
                            <?php  foreach($video as $video){?> 
                            <?php 
                            $url = $video['estore_videos']['LinkUrl'];
                            parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );     
                            ?>
                           <iframe width="202px" height="202px" src="http://www.youtube.com/embed/<?php echo $my_array_of_vars['v'];?>" frameborder="0" allowfullscreen></iframe>
                           <?php }?>
                        </div>
                        
                        <?php $advf= $this->requestAction('/'.$shopname.'/advf/'.$shop_id) ;
                       // pr($advf);
                        ?>
                        <?php foreach($advf as $advs1 ){  ?>
                        <div id="video">
                         <a href="<?php echo $advs1['estore_advertisements']['link'] ?>" target="_blank"><img src="<?php echo DOMAINADESTORE.$advs1['estore_advertisements']['images']?>" border="0" width="202px" alt="" /></a>  
                         </div> 	
                         <?php }?>
