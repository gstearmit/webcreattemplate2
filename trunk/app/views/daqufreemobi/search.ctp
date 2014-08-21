<style>
.seacrch_li{
margin: 4px 0px 25px 0px;
}
h1.style_h1 {
margin: 4px;
}
</style>
<div id="main">
     <div id="product-views" style="padding-bottom:5px;">
         <h2 class="style_h2"> </b> <span> SẢN PHẨM TÌM THẤY</span></h2>
            <ul>
             <?php foreach ($products as $productview):?>
                    <li class="seacrch_li">
                     <?php  if($productview['Eshopdaquyproduct']['images']!='') {?>
                        <a href="<?php echo DOMAIN.$shopname;?>/viewproduct/<?php echo $productview['Eshopdaquyproduct']['id']?>">   <img src="<?php echo DOMAINADBUSINISS.$productview['Eshopdaquyproduct']['images'];?>"  alt="<?php echo $productview['Eshopdaquyproduct']['title']?>"/> </a>
                         <?php }
                         else {?>
                         <div class="style_img"></div>
                         <?php }?> 
                    <h1 class="style_h1"> <a href="<?php echo DOMAIN.$shopname;?>/viewproduct/<?php echo $productview['Eshopdaquyproduct']['id']?>">
                     <?php echo strip_tags($this->Text->truncate( $productview['Eshopdaquyproduct']['title'],20,array('ending' => '...','exact' => false)));?></a></h1>
                    <h4 style="font-weight:bold; color:#cacaca;"><span style="float:left"> Giá: </span><span style="color:#FF5E24; float:left;"><?php echo $productview['Eshopdaquyproduct']['price'];?></span></h4> 
                    </li>
            <?php endforeach; ?> 
            </ul>
         <p style="margin-left:658px; line-height:0px; padding:0px; margin-top:10px;"><input type="button" value=" Quay lai " onclick="javascript: window.back();" style="float:left;"></p>     
     </div>
     <div id="page">        	
             <?php
            $paginator->options(array('url' => $this->passedArgs));
            echo "<span class='page_link'><b>Trang :</b> &nbsp;";
            echo $paginator->prev('Về trước');echo "&nbsp;&nbsp;&nbsp;";
            echo $paginator->numbers();echo "&nbsp;&nbsp;&nbsp;";
            echo $paginator->next('Tiếp theo');
            echo "</span>";
        ?>
                
      </div>   

                      
</div>