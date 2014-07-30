  <?php
  function char1($str) {
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ|Ì|Í|Ị|Ỉ|Ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ|Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'y', $str);
    $str = preg_replace("/(đ|Đ)/", 'd', $str);
    $str = preg_replace("/(B)/", 'b', $str);
	$str = preg_replace("/( - )/", '-', $str);
	$str = preg_replace("/( )/", '-', $str);
	$str = preg_replace("/(  )/", '-', $str);
	$str = preg_replace("/(   )/", '-', $str);
	$str = preg_replace("/(    )/", '-', $str);
    $str = preg_replace("/(C)/", 'c', $str);
    $str = preg_replace("/(G)/", 'g', $str);
    $str = preg_replace("/(L)/", 'l', $str);
    $str = preg_replace("/(M)/", 'm', $str);
    $str = preg_replace("/(N)/", 'n', $str);
    $str = preg_replace("/(H)/", 'h', $str);
    $str = preg_replace("/(T)/", 't', $str);
    $str = preg_replace("/(K)/", 'k', $str);
    $str = preg_replace("/(S)/", 's', $str);
    $str = preg_replace("/(R)/", 'r', $str);
    $str = preg_replace("/(V)/", 'v', $str);
    $str = preg_replace("/(Y)/", 'y', $str);
    $str = preg_replace("/(W)/", 'w', $str);
	
    return trim($str);
}
?> 
    
 <div id="equipment"><!--begin equiment-->
	<div class="title">
		<p><?php echo $cat['Category']['name'];?></p>
	</div>
    <div id="list-equipment">
        <ul>
        <?php foreach($news as $news){?>
            <li>
                <img class="img" src="<?php echo DOMAINAD;?><?php echo $news['Estore_news']['images'];?>" />
                <h4><?php echo $this->Text->truncate($news['Estore_news']['title'],20,array('ending' => '...','exact' => true));?></h4>
                <p>Giá bán:<span><?php echo number_format($news['Estore_news']['price']);?> VNĐ</span></p>
                <span>Mã số:<?php echo $this->Text->truncate($news['Estore_news']['ma'],20,array('ending' => '...','exact' => true));?></span>
                <div class="details">
                    <a href="<?php echo DOMAIN;?>chi-tiet-san-pham/<?php echo $news['Estore_news']['id']?>">Chi tiết</a>
                </div>
            </li>
            <?php }?>
        </ul>
        
        <div id='link_page' style="float: right; margin-top: 7px;">
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
</div><!--end equiment-->
