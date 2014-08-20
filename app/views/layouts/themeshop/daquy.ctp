<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta name="robots" content="index, follow" />
<meta name="revisit-after" content="4" /> 
<meta name="distribution" content="global" />

<?php echo $this->element('themeshop/daquy/plugin/plugin-seo');?>

<link href="<?php echo DOMAIN ?>daquybusniss/images/logo.png" type="images/png" rel="icon">

<script src="<?php echo DOMAIN ?>daquybusniss/js/jquery-1.6.js" type="text/javascript"></script>
<script src="<?php echo DOMAIN ?>daquybusniss/js/jquery.jqzoom-core.js" type="text/javascript"></script>
<script type="text/javascript">

$(document).ready(function() {
	$('.jqzoom').jqzoom({
            zoomType: 'reverse',
            lens:true,
            preloadImages: false,
            alwaysOn:false
        });
	//$('.jqzoom').jqzoom();
});


</script>
<link rel="stylesheet" type="text/css" href="<?php echo DOMAIN ?>daquybusniss/css/style.css" />
<link rel="stylesheet" type="text/css"  href="<?php echo DOMAIN ?>daquybusniss/css/validationEngine.jquery.css" />
<link rel="stylesheet" type="text/css"  href="<?php echo DOMAIN ?>daquybusniss/css/stickytooltip.css" />
<script type="text/javascript" src="<?php echo DOMAIN ?>daquybusniss/js/stickytooltip.js"></script>
<script type="text/javascript" src="<?php echo DOMAIN ?>daquybusniss/js/ddaccordion.js"></script>
<script type="text/javascript">

//Initialize Arrow Side Menu:
ddaccordion.init({
	headerclass: "menuheaders", //Shared CSS class name of headers group
	contentclass: "menucontents", //Shared CSS class name of contents group
	revealtype: "clickgo", //Reveal content when user clicks or onmouseover the header? Valid value: "click", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content.
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["unselected", "selected"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["none", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: 500, //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})

</script>
<script type="text/javascript" src="<?php echo DOMAIN ?>daquybusniss/js/s3Slider.js"></script>
<script type="text/javascript">

    $(document).ready(function() {

        $('#slider').s3Slider({

            timeOut: 3000

        });

    });

</script>
<script type="text/javascript">

$(document).ready(function() {

	//Default Action
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content
	
	//On Click Event
	$("ul.tabs li").click(function() {
		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content
		var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active content
		return false;
	});

});
</script>

<link rel="stylesheet" href="<?php echo DOMAIN ?>daquybusniss/css/jquery.jqzoom.css" type="text/css">
<style type"text/css">

body{margin:0px;padding:0px;font-family:Arial;}
a img,:link img,:visited img { border: none; }
table { border-collapse: collapse; border-spacing: 0; }
:focus { outline: none; }
*{margin:0;padding:0;}
p, blockquote, dd, dt{margin:0 0 8px 0;line-height:1.5em;}
fieldset {padding:0px;padding-left:7px;padding-right:7px;padding-bottom:7px;}
fieldset legend{margin-left:15px;padding-left:3px;padding-right:3px;color:#333;}
dl dd{margin:0px;}
dl dt{}

.clearfix:after{clear:both;content:".";display:block;font-size:0;height:0;line-height:0;visibility:hidden;}
.clearfix{display:block;zoom:1}


ul#thumblist{display:block;}
ul#thumblist li{float:left;margin-right:2px;list-style:none;}
ul#thumblist li a{display:block;border:1px solid #CCC;}
ul#thumblist li a.zoomThumbActive{
    border:1px solid red;
}

.jqzoom{

	text-decoration:none;
	float:left;
}

</style>


</head>

<body>
<?php echo $this->element('themeshop/daquy/plugin/plugin-adv-left-right');?>
    <div id="wrapper-background">
        <div id="wrapper">
            	   <div id="header">
                       <?php echo $this->element('themeshop/daquy/plugin/plugin-header');?>
                   </div> <!---id="header"-->
				   
                        <?php echo $this->element('themeshop/daquy/menu');?>
						
                        <div id="boder-content">
                            <div id="body">
                            
                                    <div id="content">
									
                                          <div id="main">
										  
                                                <div class="center-main">
												
                                                   <?php echo $this->element('themeshop/daquy/slide');?>
												   
                                                       <?php echo $content_for_layout; ?>
												   
                                                </div> <!--class="center-main"-->
												
                                        </div> <!--id="main"-->
										
										
                                       <?php echo $this->element('themeshop/daquy/sidebar-left');?> 
									   
                                    </div><!---id="content"-->
                                    
                          </div> <!--id="body"-->
                          
                          
                          <div id="footer" style="background:url(../images/bg-footer.png)">
						  
                                  <div id="menu-footer">
                                      <ul>
                                            <li><a href="<?php echo DOMAIN ?>daquybusniss/">Trang chủ</a></li>
                                            <li><a href="<?php echo DOMAIN.$shopname;?>/aboutus">Giới thiệu</a></li>
                                            <li><a href="<?php echo DOMAIN.$shopname;?>/indexproduct">Sản phẩm</a></li>
                                            <li><a href="<?php echo DOMAIN.$shopname;?>/indexnew/">Tin tức</a></li>
                                            <li><a href="<?php echo DOMAIN.$shopname;?>/sendcontacts">Liên hệ</a></li>
                                      </ul>
                                  </div> <!---id="menu-footer"-->
                    				
                                <div style="width:800px;float:left;">
                                
                                          <div id="text-footer">
                            			  <?php	
                              $mapssettings = $this->requestAction ( '/' . $shopname . '/mapssetting' );
                              foreach ( $mapssettings as $settings ) {?>
								<p><?php echo $settings['Eshopdaquysetting']['content'];?></p>
                              <?php }  ?>
                            		
                                          </div> <!--- id="text-footer"--->
                                          
                    			  </div> <!--end .style="width:800px;float:left;"-->
                                  
                    			  <div style="width:195px; float:left; margin-top:20px; background:none; ">	
                                  
                                       <!-- AddThis Button BEGIN -->
                                        			   Thiết kế web bởi ALATCA
                                        <div class="addthis_toolbox addthis_default_style ">
                                                <a class="addthis_button_preferred_1"></a>
                                                <a class="addthis_button_preferred_2"></a>
                                                <a class="addthis_button_preferred_3"></a>
                                                <a class="addthis_button_preferred_4"></a>
                                                <a class="addthis_button_compact"></a>
                                                <a class="addthis_counter addthis_bubble_style"></a>
                                        </div>
                                        <script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=xa-507b97c86755c349"></script>
                                        <!-- AddThis Button END -->
                                        
             		          </div> <!---style="width:195px; float:left; margin-top:20px; background:none; "-->
                              
                          </div> <!--end. id="footer"--->
                          
                    </div> <!--id="boder-content"--->
                    
    </div> <!---end. id="wrapper"-->
    </div> <!---id="wrapper-background"-->
</body>

</html>

