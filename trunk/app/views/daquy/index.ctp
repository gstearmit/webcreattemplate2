  <?php 
 //die('hoang pjuca');
//echo "view da quy ";pr($shopname);

 
 // pr($sanphamtieubieu);
  //die;
  ?>
  
  <script>
    $(function() {
	
        $( "#dialog" ).dialog({
            height: 675,
			width: 450,
            modal: true
			
        });
    });
    </script>
	
   <link rel="stylesheet" href="<?php echo DOMAIN;?>css/jquery-ui.css" />

    <script src="<?php echo DOMAIN;?>js/jquery.bgiframe-2.1.2.js"></script>
    <script src="<?php echo DOMAIN;?>js/jquery-ui.js"></script>
	
  <?php
/*
  $result = mysql_query("SELECT images FROM banners WHERE status = '1'");
		while($row = mysql_fetch_array($result)) 
		{
   ?>
			<?php if($row['status'] =1) 
					 { // hiển thị silde anh chạy  ?>
						<div id="dialog" title=" ">
						  <embed  width="400px;" height= "600px;" src="<?php echo DOMAINAD; ?><?php echo $row['images']; ?>" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" wmode="transparent">
						</div>
			   <?php }   ?> 
			 <?php if($row['status'] =0) { ?> <?php } ?>

   <?php } // end . while($row = mysql_fetch_array($result)) 
*/
   ?> 


<?php /*
<div class="title-content"><?php ?>
   <p>GIỚI THIỆU VỀ ĐÁ QUÝ NGỌC SƠN</p>
</div>

<div class="product">
<?php $gioithieu = $this->requestAction('home/gioithieu'); ?>
     <?php foreach($gioithieu as $gioithieu){?>
<div class="hinhanhgioithieu"><img src="<?php echo DOMAINAD; ?><?php echo $gioithieu['Eshopdaquynew']['images'] ?>" style="height:110px; width:130px; margin-left:50px; float:left;" ></div>
<p class="noidunggioithieu" style="float:left; padding-left:50px; width:526px;"><a href="<?php echo DOMAIN; ?>tin-tuc/chi-tiet-tin/97" ><font style="font-weight:700; color:#CCCCC; font-size:14px;"><?php echo $gioithieu['Eshopdaquynew']['title']; ?></font></a> </p>
<div class="noidunggioithieu" style="float:left; padding-left:50px; width:526px;"><?php echo $gioithieu['Eshopdaquynew']['introduction']; ?></div>
<p><a href="<?php echo DOMAIN; ?>tin-tuc/chi-tiet-tin/97" style="float:right; margin-right:20px;"> Xem chi tiết >> </a></p>
<?php } ?>

</div>

*/  ?>

<div class="title-content">
   <p>
    SẢN PHẨM MỚI <?php  // Hiện Thị Nút xem tất cả ?>
	 <a href="<?php echo DOMAIN.$shopname;?>/tranhdaquy" style=" margin-right:10px; float:right; backgrond:none;">
	     <img src="<?php echo DOMAIN;?>images/xemtatca.png" style="margin-top:8px; backgrond:none;">
	 </a>
  </p>
</div>
<div class="product">
<ul>
     <?php 
    
     
	 $a= array();
	 $i = 2;  // luu tru de hien thi toolstip
	 $j = 0;  
	 foreach($sanphammoi as $listproduct) // pr($listproduct);die; // giong mang $tranhdaquy
	 {
	 
     	 $a[$j++] = $listproduct; ?>
		                       <?php //pr($a[0]); die; ?>
		                          <?php  //pr($listproduct['Eshopdaquyproduct']['id']);die;?>
			 <p>
				  <li>
					<h1>
					  <!-- ảnh của san phẩm-->
					  <a href="<?php echo DOMAIN.$shopname;?>/viewproduct/<?php echo $listproduct['Eshopdaquyproduct']['id'];?>" 
						 data-tooltip="sticky<?php  echo $i; ?> ">
						 <!-- chế độ thumbnail -->
						   <div 
							   style=" overflow:hidden; width:160px; height:127px; background-image:url(<?php echo DOMAINAD?>/timthumb.php?src=<?php echo $listproduct['Eshopdaquyproduct']['images'];?>&amp;h=127&amp;w=160&amp;zc=1); background-position:center center; background-repeat:no-repeat; background-color:#fff; margin:auto;" class="img">             
						   </div>
					   </a>
					</h1>
					
					<h2>
					  <a style="color:#5a5152;" href="<?php echo DOMAIN.$shopname;?>/viewproduct/<?php echo $listproduct['Eshopdaquyproduct']['id'];?>" >
					      <?php echo $listproduct['Eshopdaquyproduct']['title']; // tiêu dề sản phẩm   ?>
					  </a>
					</h2>
					
				     <!-- class="div": hiển thị hình xem tiếp -->
					<div class="div" style="text-align:center;"><a href="<?php echo DOMAIN.$shopname;?>/viewproduct/<?php echo $listproduct['Eshopdaquyproduct']['id'];?>"><img src="<?php echo DOMAIN;?>images/detail1.png" style="margin-top:10px;"/></a></h2>
					</div>
				  </li>
			  </p>
	       <?php $i++ ?>
  <?php } ?>
 </ul>
</div>





<div class="title-content">
   <p>
     TRANH ĐÁ QUÝ     <?php  // Hiện Thị Nút xem tất cả ?>
	 <a href="<?php echo DOMAIN;?>daquy/tranhdaquy" style=" margin-right:10px; float:right; backgrond:none;">
	     <img src="<?php echo DOMAIN;?>images/xemtatca.png" style="margin-top:8px; backgrond:none;">
	 </a>
  </p>
</div>
<div class="product">
<ul>
<?php $tranhdaquy = $this->requestAction('/'.$shopname.'/tranhdaquy'); 
 
	 $a= array();
	 $i = 2;  // luu tru de hien thi toolstip
	 $j = 0;  
	 
	 foreach($tranhdaquy as $listproduct) // pr($listproduct);die; // giong mang $tranhdaquy
	 {
     	 $a[$j++] = $listproduct; ?>
		                       <?php //pr($a[0]); die; ?>
		                          <?php  //pr($listproduct['Eshopdaquyproduct']['id']);die;?>
			 <p>
				  <li>
					<h1>
					  <!-- ảnh của san phẩm-->
					  <a href="<?php echo DOMAIN.$shopname;?>/viewproduct/<?php echo $listproduct['Eshopdaquyproduct']['id'];?>" 
						 data-tooltip="sticky<?php  echo $i; ?> ">
						 <!-- chế độ thumbnail -->
						   <div 
							   style=" overflow:hidden; width:160px; height:127px; background-image:url(<?php echo DOMAINAD?>/timthumb.php?src=<?php echo $listproduct['Eshopdaquyproduct']['images'];?>&amp;h=127&amp;w=160&amp;zc=1); background-position:center center; background-repeat:no-repeat; background-color:#fff; margin:auto;" class="img">             
						   </div>
					   </a>
					</h1>
					
					<h2>
					  <a style="color:#5a5152;" href="<?php echo DOMAIN.$shopname;?>/viewproduct/<?php echo $listproduct['Eshopdaquyproduct']['id'];?>" >
					      <?php echo $listproduct['Eshopdaquyproduct']['title']; // tiêu dề sản phẩm   ?>
					  </a>
					</h2>
					
				     <!-- class="div": hiển thị hình xem tiếp -->
					<div class="div" style="text-align:center;"><a href="<?php echo DOMAIN.$shopname;?>/viewproduct/<?php echo $listproduct['Eshopdaquyproduct']['id'];?>"><img src="<?php echo DOMAIN;?>images/detail1.png" style="margin-top:10px;"/></a></h2>
					</div>
				  </li>
			  </p>
	       <?php $i++ ?>
  <?php } ?>
 </ul>
</div>



<div class="title-content"><?php ?>
   <p>ĐÁ QUÝ THÔ <a href="<?php echo DOMAIN;?>daquy/daquytho" style=" margin-right:10px; float:right; backgrond:none;"><img src="<?php echo DOMAIN;?>images/xemtatca.png" style="margin-top:8px; backgrond:none;"></a></p>
</div>
<div class="product">
<ul>
<?php  
 $b= array();
	 $i = 100;
	 $j = 0;

$daquytho = $this->requestAction('/'.$shopname.'/daquytho'); ?>
     <?php foreach($daquytho as $listproduct){ $b[$j++] = $listproduct; ?>
      <li>
        <h1>
          <a href="<?php echo DOMAIN.$shopname;?>/viewproduct/<?php echo $listproduct['Eshopdaquyproduct']['id'];?>" data-tooltip="sticky<?php echo $i; ?>">
           <div style=" overflow:hidden; width:160px; height:127px; background-image:url(<?php echo DOMAINAD?>/timthumb.php?src=<?php echo $listproduct['Eshopdaquyproduct']['images'];?>&amp;h=127&amp;w=160&amp;zc=1); background-position:center center; background-repeat:no-repeat; background-color:#fff; margin:auto;" class="img">             
           </div> 
        </h1>
        <h2><a style="color:#5a5152;" href="<?php echo DOMAIN.$shopname;?>/viewproduct/<?php echo $listproduct['Eshopdaquyproduct']['id'];?>"><?php echo $listproduct['Eshopdaquyproduct']['title'];?></a></h2>
       
        <div class="div" style="text-align:center;"><a href="<?php echo DOMAIN.$shopname;?>/viewproduct/<?php echo $listproduct['Eshopdaquyproduct']['id'];?>"><img src="<?php echo DOMAIN;?>images/detail1.png" style="margin-top:10px;"/></a></h2>
        </div>
      </li>
	  <?php $i++ ?>
      <?php }?>
   </ul>
</div>

<div class="title-content"><?php ?>
   <p>ĐÁ PHONG THỦY<a href="<?php echo DOMAIN;?>daquy/daphongthuy" style=" margin-right:10px; float:right; backgrond:none;"><img src="<?php echo DOMAIN;?>images/xemtatca.png" style="margin-top:8px; backgrond:none;"></a></p>
</div>
<div class="product">
<ul>
<?php 
 $c= array();
	 $i = 200;
	 $j = 0;



$daphongthuy = $this->requestAction('/'.$shopname.'/daphongthuy'); ?>
     <?php foreach($daphongthuy as $listproduct){ $c[$j++] = $listproduct;?>
      <li>
        <h1>
          <a href="<?php echo DOMAIN.$shopname;?>/viewproduct/<?php echo $listproduct['Eshopdaquyproduct']['id'];?>" data-tooltip="sticky<?php echo $i; ?>">
           <div style=" overflow:hidden; width:160px; height:127px; background-image:url(<?php echo DOMAINAD?>/timthumb.php?src=<?php echo $listproduct['Eshopdaquyproduct']['images'];?>&amp;h=127&amp;w=160&amp;zc=1); background-position:center center; background-repeat:no-repeat; background-color:#fff; margin:auto;" class="img">             
           </div> 
        </h1>
        <h2><a style="color:#5a5152;" href="<?php echo DOMAIN.$shopname;?>/viewproduct/<?php echo $listproduct['Eshopdaquyproduct']['id'];?>"><?php echo $listproduct['Eshopdaquyproduct']['title'];?></a></h2>
       
        <div class="div" style="text-align:center;"><a href="<?php echo DOMAIN.$shopname;?>/viewproduct/<?php echo $listproduct['Eshopdaquyproduct']['id'];?>"><img src="<?php echo DOMAIN;?>images/detail1.png" style="margin-top:10px;"/></a></h2>
        </div>
      </li>
	  <?php $i++ ?>
      <?php }  ?>
   </ul>
</div>

<div class="title-content"><?php ?>
   <p>TRANG SỨC <a href="<?php echo DOMAIN;?>daquy/trangsuc" style=" margin-right:10px; float:right; backgrond:none;"><img src="<?php echo DOMAIN;?>images/xemtatca.png" style="margin-top:8px; backgrond:none;"></a></p>
</div>
<div class="product">
<ul>
<?php 
 $d= array();
	 $i = 300;
	 $j = 0;

$trangsuc = $this->requestAction('/'.$shopname.'/trangsuc'); ?>
     <?php foreach($trangsuc as $listproduct){ $d[$j++] = $listproduct;?>
      <li>
        <h1>
          <a href="<?php echo DOMAIN.$shopname;?>/viewproduct/<?php echo $listproduct['Eshopdaquyproduct']['id'];?>" data-tooltip="sticky<?php echo $i; ?>">
           <div style=" overflow:hidden; width:160px; height:127px; background-image:url(<?php echo DOMAINAD?>/timthumb.php?src=<?php echo $listproduct['Eshopdaquyproduct']['images'];?>&amp;h=127&amp;w=160&amp;zc=1); background-position:center center; background-repeat:no-repeat; background-color:#fff; margin:auto;" class="img">             
           </div> 
        </h1>
        <h2><a style="color:#5a5152;" href="<?php echo DOMAIN.$shopname;?>/viewproduct/<?php echo $listproduct['Eshopdaquyproduct']['id'];?>"><?php echo $listproduct['Eshopdaquyproduct']['title'];?></a></h2>
       
        <div class="div" style="text-align:center;"><a href="<?php echo DOMAIN.$shopname;?>/viewproduct/<?php echo $listproduct['Eshopdaquyproduct']['id'];?>"><img src="<?php echo DOMAIN;?>images/detail1.png" style="margin-top:10px;"/></a></h2>
        </div>
      </li>
	  <?php $i++ ?>
      <?php } ?>
   </ul>
</div>


<div id="mystickytooltip" class="stickytooltip">
<div style="padding:5px">
<?php $i=2; 
foreach($a as $listproduct) {
?>
<div id="sticky<?php echo $i; ?>" class="atip" style=" display: block;">	
<img src="<?php echo DOMAINAD; ?><?php echo $listproduct['Eshopdaquyproduct']['images']; ?>">
</div>
<?php $i++ ?>
<?php } ?>
<?php $i = 100;
foreach($b as $listproduct) {
?>
<div id="sticky<?php echo $i; ?>" class="atip" style=" display: block;">	
<img src="<?php echo DOMAINAD; ?><?php echo $listproduct['Eshopdaquyproduct']['images']; ?>">
</div>
<?php $i++ ?>
<?php } ?>
<?php $i = 200;
foreach($c as $listproduct) {
?>
<div id="sticky<?php echo $i; ?>" class="atip" style=" display: block;">	
<img src="<?php echo DOMAINAD; ?><?php echo $listproduct['Eshopdaquyproduct']['images']; ?>">
</div>
<?php $i++ ?>
<?php } ?>
<?php $i = 300;
foreach($d as $listproduct) {
?>
<div id="sticky<?php echo $i; ?>" class="atip" style=" display: block;">	
<img src="<?php echo DOMAINAD; ?><?php echo $listproduct['Eshopdaquyproduct']['images']; ?>">
</div>
<?php $i++ ?>
<?php } ?>

</div>
</div>


<?php
/*

<div id='link_page'>
      <?php
	
            $paginator->options(array('url' => $this->passedArgs));
            echo "<span class='page_link'><b>Trang :</b> &nbsp;";
            echo $paginator->prev('Về trước');echo "&nbsp;&nbsp;&nbsp;";
            echo $paginator->numbers();echo "&nbsp;&nbsp;&nbsp;";
            echo $paginator->next('Tiếp theo');
            echo "</span>";
        ?>
    </div>
	*/
	
	//die;

?>