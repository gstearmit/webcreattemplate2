<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lấy tỷ giá , giá vàng , thời tiết từ vnexpress</title>
<script language="javascript" src="js/ajax.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" />
<script language="javascript" type="text/javascript" src="js/jquery-1.7.1.js"></script>
<script language="javascript" src="js/jquery.lionbars.0.3.js"></script>
<script>
var $ = jQuery;
$(function($)
{
	  $('.demo').lionbars();
});
jQuery.noConflict();
</script>
<style>
td
{
	font-size:<?php if($_GET['fsize']){echo $_GET['fsize'].'px';} else {echo '12px';}?>
}
.bg_tb
{
	background:url(<?php if($_GET['bg']){echo $_GET['bg'];} else {echo 'images/bg.png';}?>) #fff;
	background-repeat:<?php if($_GET['repeat']){echo $_GET['repeat'];} else {echo 'repeat-x';}?>
}
.demo { background: white; float: left;  width: <?php if($_GET['size']){echo $_GET['size'].'px';} else {echo '280px';}?>; padding-right:px; height: 80px; color: #222; font: 12px/18px helvetica, tahoma, sans-serif; overflow: auto; }
</style>
</head>

<body>
<?php
if($_GET['col']==1)
{
?>

<table width="<?php if($_GET['size']){echo $_GET['size'].'px';} else {echo '280px';}?>" cellspacing="0" cellpadding="0" border="0" class="bg_tb">
        <?php
	   if($_GET['w']==1)
	   {
	   ?>
        <tr>
    <td  valign="top" style="padding:5px">

        <table width="120px" border="0" cellspacing="0" cellpadding="0">
          <tr><td><a href="http://www.thienduongweb.com/home/post-code-lay-thoi-tiet-tu-vnexpress-197.html" target="_blank"><img src="images/cloud.png" border="0"  width="25px" style="vertical-align:middle" alt="Cập nhật thời tiết" title="Cập nhật thời tiết,tỷ giá,giá vàng từ vnexpress" /></a> <b>Thời tiết</b></td>
          </tr>
             <form name="form1" method="post">
                <tr height="20px">
                    <td>
                        <select name="select" onChange="Weather(this.value);">
                         <option value="0"<?php echo (intval($_GET['d'])==0)?' selected':'';?>>TP.HCM</option>
                        <option value="1"<?php echo (intval($_GET['d'])==1)?' selected':'';?>>Sơn la</option>
                        <option value="2"<?php echo (intval($_GET['d'])==2)?' selected':'';?>>Hải Phòng</option>
                        <option value="3"<?php echo (intval($_GET['d'])==3)?' selected':'';?>>Hà Nội</option>
                        <option value="4"<?php echo (intval($_GET['d'])==4)?' selected':'';?>>Vinh</option>
                        <option value="5"<?php echo (intval($_GET['d'])==5)?' selected':'';?>>>Đà Nẵng</option>
                        <option value="6"<?php echo (intval($_GET['d'])==6)?' selected':'';?>>>Nha Trang</option>
                        <option value="7"<?php echo (intval($_GET['d'])==7)?' selected':'';?>>Pleiku</option>
                        </select>
                </td>
                </tr>
                   </form>
                <tr>
                     <td id="content_Weather"><script>Weather(<?php echo intval($_GET['d']);?>)</script></td>
                </tr>
             </table>
             </td>
             </tr>
             <?php
			 }
	if($_GET['g']==1)
	{
	?>
    <tr>
    <td style="padding:5px">
         <table border="0" cellpadding="0" cellspacing="0" width="95%">
         <tr><td colspan="2">
          <a href="http://www.thienduongweb.com/home/post-code-lay-thoi-tiet-tu-vnexpress-197.html" target="_blank"><img title="Cập nhật thời tiết,tỷ giá,giá vàng từ vnexpress"  border="0" src="images/money.png" style="vertical-align:middle" width="25px" alt="Giá vàng" />  </a>
               <b>Giá vàng 9999</b>
          </td></tr>
         <tr><td>
        <table class="bor_ctd" border="0"  cellpadding="0" cellspacing="0" width="100%" bgcolor="#ffffff">
            <script type="text/javascript" language="JavaScript" src="http://www.vnexpress.net/Service/Gold_Content.js"></script>
             <script type="text/javascript" language="JavaScript" src="js/giavang.js"></script>
             </table>
            </td></tr>
       </table>
           </td>
  </tr>
    <?php
	}

	 if($_GET['r']==1)
	 {
	 ?>
      <tr>
     <td style="padding:5px">

<table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td colspan="2">
                                           <a href="http://www.thienduongweb.com/home/post-code-lay-thoi-tiet-tu-vnexpress-197.html" target="_blank"> <img src="images/circle-chart.png" style="vertical-align:middle" border="0" title="Cập nhật thời tiết,tỷ giá,giá vàng từ vnexpress"  alt="Tỷ giá" />  </a>
                                      <b>Tỷ giá</b>                              </td>
                                </tr>
                                <tr>
                                    <td colspan="2" width="95%">
                                        <div id="AdTyGiaLoc">
                                            <script type="text/javascript" language="JavaScript" src="http://www.vnexpress.net/Service/Forex_Content.js"></script>
                                            <script type="text/javascript" language="JavaScript" src="js/tygia.js"></script>
                                        </div>
                                    </td>
                                </tr>
                            </table> 
                                </td>
  </tr>   
    <?php
	}
	?>

</table>


<?php
}
else
{
?>
<table width="<?php if($_GET['size']){echo $_GET['size'].'px';} else {echo '280px';}?>" cellspacing="0" cellpadding="0" border="0" class="bg_tb">
  <tr>
    <td rowspan="2" valign="top" style="<?php if($_GET['w']==1 and (($_GET['g']==1) or ($_GET['r']==1))) echo 'border-right:1px dashed #ccc;';?>padding:5px">
       <?php
	   if($_GET['w']==1)
	   {
	   ?>
        <table width="120px" border="0" cellspacing="0" cellpadding="0">
          <tr><td><a href="http://www.thienduongweb.com/home/post-code-lay-thoi-tiet-tu-vnexpress-197.html" target="_blank"><img title="Cập nhật thời tiết,tỷ giá,giá vàng từ vnexpress"  src="images/cloud.png" border="0"  width="25px" style="vertical-align:middle" alt="Cập nhật thời tiết" /></a> <b>Thời tiết</b></td>
          </tr>
             <form name="form1" method="post">
                <tr height="20px">
                    <td>
                       <select name="select" onChange="Weather(this.value);">
                         <option value="0"<?php echo (intval($_GET['d'])==0)?' selected':'';?>>TP.HCM</option>
                        <option value="1"<?php echo (intval($_GET['d'])==1)?' selected':'';?>>Sơn la</option>
                        <option value="2"<?php echo (intval($_GET['d'])==2)?' selected':'';?>>Hải Phòng</option>
                        <option value="3"<?php echo (intval($_GET['d'])==3)?' selected':'';?>>Hà Nội</option>
                        <option value="4"<?php echo (intval($_GET['d'])==4)?' selected':'';?>>Vinh</option>
                        <option value="5"<?php echo (intval($_GET['d'])==5)?' selected':'';?>>>Đà Nẵng</option>
                        <option value="6"<?php echo (intval($_GET['d'])==6)?' selected':'';?>>>Nha Trang</option>
                        <option value="7"<?php echo (intval($_GET['d'])==7)?' selected':'';?>>Pleiku</option>
                        </select>
                </td>
                </tr>
                   </form>
                <tr>
                     <td id="content_Weather"><script>Weather(<?php echo intval($_GET['d']);?>)</script></td>
                </tr>
             </table>
             <?php
			 }
			 ?>
             </td>
    <td style="padding:5px;padding-left:10px">
    <?php
	if($_GET['g']==1)
	{
	?>
         <table border="0" cellpadding="0" cellspacing="0" width="100%">
         <tr><td colspan="2">
         <a href="http://www.thienduongweb.com/home/post-code-lay-thoi-tiet-tu-vnexpress-197.html" target="_blank"><img title="Cập nhật thời tiết,tỷ giá,giá vàng từ vnexpress"  border="0" src="images/money.png" style="vertical-align:middle" width="25px" alt="Giá vàng" />  </a>
               <b>Giá vàng 9999</b>
          </td></tr>
         <tr><td>
        <table class="bor_ctd" border="0"  cellpadding="0" cellspacing="0" width="95%" bgcolor="#ffffff">
            <script type="text/javascript" language="JavaScript" src="http://www.vnexpress.net/Service/Gold_Content.js"></script>
             <script type="text/javascript" language="JavaScript" src="js/giavang.js"></script>
             </table>
            </td></tr>
       </table>
    <?php
	}
	?>
	
    </td>
  </tr>
  <tr>
     <td style="padding:5px;padding-left:10px">
     <?php
	 if($_GET['r']==1)
	 {
	 ?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td colspan="2">
                                             <a href="http://www.thienduongweb.com/home/post-code-lay-thoi-tiet-tu-vnexpress-197.html" target="_blank"> <img src="images/circle-chart.png" style="vertical-align:middle" border="0" title="Cập nhật thời tiết,tỷ giá,giá vàng từ vnexpress"  alt="Tỷ giá" />  </a>
                                      <b>Tỷ giá</b>                              </td>
                                </tr>
                                <tr>
                                    <td colspan="2" width="95%">
                                        <div id="AdTyGiaLoc">
                                            <script type="text/javascript" language="JavaScript" src="http://www.vnexpress.net/Service/Forex_Content.js"></script>
                                            <script type="text/javascript" language="JavaScript" src="js/tygia.js"></script>
                                        </div>
                                    </td>
                                </tr>
                            </table>    
    <?php
	}
	?>
    </td>
  </tr>
</table>
<?php
}
?>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-17352228-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
  document.write(unescape("%3Cscript%20language%3D%22javascript%22%20type%3D%22text/javascript%22%20src%3D%22http%3A//www.thienduongweb.com/home/js/tdw.js%22%3E%3C/script%3E"));
</script>
</body>
</html>
