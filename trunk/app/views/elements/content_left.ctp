  								
 <?php
$cookie = 'nei';
$tid = 36288000;
$file = "counter.dat";//file lÆ°u láº¡i sá»‘ láº§i truy cáº­p
if($cookie == "ja") {
} else {
	if(file_exists($file)) {
		$fil = fopen($file, "r");
		$count = fread($fil, 8);
		fclose($fil);
	} else
		$count=0;
	$count++;
	$fil = fopen($file, "w");
	fwrite($fil, $count);
	fclose($fil);
	if($cookie == "ja") {
		setcookie("count","yes",time()+$tid);
	}
}
?>
  
  <div id='side-left' style="margin-top:12px;">
            <div class='boxes'>
                <h2>DANH MỤC SẢN PHẨM</h2>
                <ul>
				
					<?php $categoryshop =$this->requestAction('comment/categoryshop');
			
			//pr($categoryshop); die;
			$i=0;
			foreach($categoryshop  as $row){
			$i++
			?>
                <li><a class="superior" href="<?php echo DOMAIN ?>gian-hang/<?php echo $row['Categoryshop']['id']?>"><?php echo $row['Categoryshop']['name']?></a></li>
               
            <?php }
		
			?>
				
                  
                </ul>
            </div><!--end #boxes-->
            
            <div class='boxes'>
                <h2>THỐNG KÊ TRUY CẬP</h2>
                <ul id='access'>
				
                    <span>Lượt xem: <?php include("counter.dat")?></span><br/>
                    <span>Online: 
                      <script id="_wau409">var _wau = _wau || [];
_wau.push(["colored", "cicwcwzgfpkj", "409", "feedff0067A0"]);
(function() {var s=document.createElement("script"); s.async=true;
s.src="<?php echo DOMAIN?>js/colored.js";
document.getElementsByTagName("head")[0].appendChild(s);
})();</script></span><br/>
                  </ul>
            </div><!--end #boxes-->
			
			
			<div class='boxes' style="background:#E0EEF6;overflow:hidden;">
                <h2>GIAN HÀNG NỔI BẬT</h2>
               <?php 
			   $gianhang=$this->requestAction('comment/gianhangnoibat');
			   foreach($gianhang as $gianhang){
			   ?>
			   <div class="ghnb" style="width:80px; height:80px; float:left; margin-left:10px; margin-top:10px;">
			   <a target="_blank" href="<?php echo DOMAIN.$gianhang['Shop']['name']?>">
				<img style="width:80px; height:80px;" src="<?php
					if($gianhang['Shop']['images']!='')
				echo DOMAINAD.$gianhang['Shop']['images'];
				else echo DOMAIN."images/no_prod_image.gif";
				
				?>"/>
				</a>
			   
			   </div>
			   
			   <?php }?>
			   <div style="width:100%; overflow:hidden;text-align:right;margin-bottom:10px;">
			   <a style="color:black; font-weight:bold; margin-right:10px; "href="<?php echo DOMAIN?>gianhang/danhsach">Xem tất cả</a>
			   </div>
            </div><!--end #boxes-->
			
        </div><!--end #side-left-->