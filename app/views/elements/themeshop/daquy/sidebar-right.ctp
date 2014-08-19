<div id="slidebar-right"><?php ?>

<div id="content-sidebar-right">

    <div class="title-sidebar-right">

        <p>Tin tức nổi bật</p>

    </div>

    <div class="detail-sidebar-right">

         <?php $tintucnoibat = $this->requestAction('/comment/tintucnoibat');?>

			  <?php foreach($tintucnoibat as $tintucnoibat){?>

                <p><a href="<?php echo DOMAIN;?>tin-tuc/chi-tiet-tin/<?php echo $tintucnoibat['News']['id'];?>/<?php echo $tintucnoibat['News']['alias'];?>.html"><?php echo $tintucnoibat['News']['title'];?></a></p>

             <?php }?>

    </div>

</div>



<div id="content-sidebar-right">

    <div class="title-sidebar-right">

        <p>Sản phẩm bán chạy</p>

    </div>

    <div class="detail-sidebar-right">

    <div id="conten_main_right-jcarousellite">

	   <ul>

           <?php $sanphambanchay = $this->requestAction('/comment/sanphambanchay');?>

           <?php foreach($sanphambanchay as $listproduct){?>

          <li style="margin-bottom:10px; padding-bottom:10px;">

             <div class="boder-img"><a href="<?php echo DOMAIN;?>chi-tiet-san-pham/<?php echo $listproduct['Product']['id'];?>/<?php echo $listproduct['Product']['alias'];?>">

             <div style=" overflow:hidden; width:156px; height:107px; background-image:url(<?php echo DOMAINADBUSINISS?>/timthumb.php?src=<?php echo $listproduct['Product']['images'];?>&amp;h=107&amp;w=156&amp;zc=1); background-position:center center; background-repeat:no-repeat; background-color:#FFF; margin:auto;" class="img">             

                   </div>

             </a></div>

             <div class="detailproduct" style="padding-top:10px;">

             <h2><a href="<?php echo DOMAIN;?>chi-tiet-san-pham/<?php echo $listproduct['Product']['id'];?>/<?php echo $listproduct['Product']['alias'];?>.html"><?php echo $listproduct['Product']['title'];?></a></h2>

             

             </div>

          </li>

          <?php }?>

       </ul>

	</div>

    </div>

</div>

<div id="content-sidebar-right">

    <div class="title-sidebar-right">

        <p>Thống kê truy cập</p>

    </div>

    <div class="detail-sidebar-right" style="padding-top:15px;">
    <center>
      <!-- Histats.com  START  (standard)-->
<script type="text/javascript">document.write(unescape("%3Cscript src=%27http://s10.histats.com/js15.js%27 type=%27text/javascript%27%3E%3C/script%3E"));</script>
<a href="http://www.histats.com" target="_blank" title="free web site hit counter" ><script  type="text/javascript" >
try {Histats.start(1,1989004,4,424,112,75,"00011101");
Histats.track_hits();} catch(err){};
</script></a>
<noscript><a href="http://www.histats.com" target="_blank"><img  src="http://sstatic1.histats.com/0.gif?1989004&101" alt="free web site hit counter" border="0"></a></noscript>
<!-- Histats.com  END  -->
    </center>
         

    </div>

</div>

</div>