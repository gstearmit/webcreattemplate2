<?php 
			
			$shop=explode('/',$this->params['url']['url']); 
			$shopname=$shop[0];
				$shop=$this->requestAction('comment/get_shop_id/'.$shopname);
				
				
				foreach($shop as $key=>$value){
				$shop_id=$key;
				}
			
?>
<style>
  #detail {
    font-size: 16px;
	font-weight:bold !important;
}
#deal-stuff .main .blk {
    margin: 7px 0 30px;
}
.coupons-table {
    border-bottom: 1px solid #CCCCCC;
    border-left: 1px solid #CCCCCC;
    border-right: 1px solid #CCCCCC;
    margin: 10px;
    width: 100%;
}
.cf:after {
    clear: both;
    content: "";
    display: block;
    height: 0;
    overflow: hidden;
    visibility: hidden;
}
.avatar {
    background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #CCCCCC;
    padding: 2px;
}
div.author {
    background-color: #EAEAEA;
    padding: 2px 5px;
}
</style>
<link rel="stylesheet" href="<?php echo DOMAIN;?>css/index.css" type="text/css" media="screen" charset="utf-8">
<div id="content-body">
     <div id="content-main">
         <div class="title-detail">
             <p><span>Du lịch PattayYa :</span>
                <?php echo $views['Estore_news']['introduction'];?>
             </p>
         </div>
         <div class="view-detail-buy">
              <div class="button-buy">
                   <div class="center-buy">
                         <table border="1" cellpadding="0" cellspacing="0">
                              <tr>
                                 <td style="padding-top:0px !important; padding-bottom:0px !important; border:none !important;" colspan="2">
                                     <div class="title-price">
                                         <h2>
                                            <?php 
                                                $a=$views['Estore_news']['price'];
                                                $b=$views['Estore_news']['discount'];
                                                $tong = $a - (($b * $a)/100);
                                                echo (number_format($tong));
                                              ?>
                                          VND </h2>
                                     </div>
                                 </td>
                              </tr>
                              <tr>
                                 <td colspan="2">
                                     <h1>Giá gốc : <?php echo number_format($views['Estore_news']['price']);?> VND </h1>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                     <p>Giảm giá</p>
                                     <p><?php echo $views['Estore_news']['discount'];?> %</p>
                                 </td>
                                 <td>
                                     <p>Tiết kiệm </p>
                                     <p>
                                       <?php 
                                        $a=$views['Estore_news']['price'];
                                        $b=$views['Estore_news']['discount'];
                                        $conlai = $a - (($b * $a)/100);
                                        $tietkiem= ($a - $conlai);
                                        echo (number_format($tietkiem));
                                      ?> VNĐ
                                     </p>
                                 </td>
                              </tr>
                         </table>
                         <div class="date-begin">
                            <h4>Thời gian còn lại :
                                    <?php
                                          $date2 = $views['Estore_news']['end_time'];
                                          $dayend = strtotime($date2);
                                          //so sanh ngay thang
                                          $date1 = date("Y-m-d");
                                          $datenow = strtotime($date1);
                                      ?>
                                      
                                      <?php if($dayend <= $datenow ){ ?>
                                               Hết hạn
                                      <?php }else {?>
                                          <script type="text/javascript">
                                        $(document).ready(function(){
                                            var i = <?php echo $dayend;?> - <?php echo time();?>;
                                            $(function() {
                                                setInterval(function(){
                                                    var h = parseInt(i / 3600);
                                                    var m = parseInt((i- (3600 * h)) / 60);
                                                    var s = parseInt(i - ((3600 * h) + (60 * m)));
                                                    $('#clock').html(h+' : '+m+' : '+s);
                                                    i--;
                                                }, 1000);
                                            });
                                        });	
                                        </script>
                                          <span style="font-weight:bold;" id="clock"></span>
                                      <?php }?>
                                </h4>
                            <div style="width:222px; margin:20px auto auto;">
                                   <script>
                                  $(document).ready(function() {
                                    $("#progressbar").progressbar({ value: <?php echo $views['Estore_news']['view'];?> });
                                  });
                                  </script>
                                  <div style="font-size:40.5%;">
                                       <div id="progressbar"></div>
                                  </div>
                                  <p style="padding-top:6px; padding-left:10px; padding-bottom:6px;">Cần <span style="color:#ff6600;"><?php echo $views['Estore_news']['numberview'];?></span> người để đạt giá tốt </p>
                            </div>
                         </div>
                         <div class="mua"><a href="<?php echo DOMAIN;?>mua-hang/<?php echo $views['Estore_news']['id'];?>"><img src="<?php echo DOMAIN?>images/buy.png" /></a></div>
                 </div>
              </div>
              <div class="detail-right">
                   <div class="img-news">
                       <div style=" width:450px; height:262px; background-image:url(<?php echo DOMAINAD?>/timthumb.php?src=<?php echo $views['Estore_news']['images'];?>&amp;h=262&amp;w=450&amp;zc=1); background-position:center center; background-repeat:no-repeat; margin:auto;" class="img">                      	
                           </div>
                   </div>
                   <div class="news-content-detail">
                        <ul>
                           <li>
                               <div class="title-news-text">
                                  <p>Điểm nổi bật</p>
                               </div>
                               <div class="text-news">
                                  <p>
                                     <?php echo $views['Estore_news']['highlights'];?>
                                  </p>
                               </div>
                           </li>
                           <li style="border-right:none;">
                               <div class="title-news-text">
                                  <p>Điều kiện</p>
                               </div>
                               <div class="text-news">
                                  <p>
                                     <?php echo $views['Estore_news']['conditions'];?>
                                  </p>
                               </div>
                           </li>
                        </ul>
                   </div>
              </div>
         </div>
     </div>
    <div class="box clear">
          <div class="box-top"></div>
          <div class="box-content"> <a name="entry-read"></a>
            <div class="head">
              <p style="line-height:18px;" align="justify"><strong style=" font-size:18px">Quy định về bình luận</strong><br>
                Sunmart24 hoan nghênh tất cả các góp ý mang tính chất  xây
 dựng của các bạn để Sunmart24 cũng như các đối tác có thể mang đến cho 
các bạn  những dịch vụ và sản phẩm tốt nhất.<br>
                Mỗi deal sẽ có mục thảo luận để các bạn đóng góp,  trao 
đổi, đưa ra các thắc mắc. Sunmart24 sẽ ghi nhận tất cả và cố gắng xử lý 
thỏa  đáng nhất trong thời gian sớm nhất với các yêu cầu của khách 
hàng.&nbsp; <br><br>
                Sunmart24 tin tưởng và tôn trọng tất cả những bình luận  
của các bạn nên không dùng chế độ xét duyệt trước khi đăng bình luận nên
 các bạn  vui lòng chỉ gởi đến những thông tin và góp ý mà các bạn thực 
sự đã trải nghiệm  và cảm nhận. Sunmart24 cũng mong nhận được những phản 
ánh chân thành cùng với sự  tôn trọng đối với Sunmart24 và đối tác của 
Sunmart24.<br><br>
                Tuy nhiên, Sunmart24 cũng xin nêu rõ quan điểm và cách  xử lý với một số trường hợp đặc biệt sau:</p>
              <ul style="padding-left:15px;">
                <li>- Các bình luận mang tính chỉ trích tiêu cực,  các 
lời phê bình không có dẫn chứng xác đáng, các nội dung tranh luận thiếu 
tôn  trọng, sai sự thật hoặc về các vấn đề nhạy cảm</li>
                <li>- Các bình luận có tính quảng cáo cho các  website khác dưới mọi hình thức</li>
                <li>- Các deal không đúng chủ đề: sau khi  Sunmart24 xử lý hoặc giải đáp sẽ xóa bớt.</li>
                <li>- Các yêu cầu hủy đơn hàng: Sunmart24 sau  khi xử lý sẽ xóa bớt.</li>
                <li>- Các bình luận mang tính kích động( vì  quan&nbsp; điểm bình luận là của cá nhân mỗi  người)</li>
              </ul><br>
              <p align="justify">Sunmart24 sẽ  xóa khỏi mục tranh luận. 
Đồng thời, sẽ liên hệ riêng với người bình luận để kiểm  chứng thông tin
 và ghi nhận ý kiến.</p>
              <p align="justify"><strong>Thông Tin Liên Hệ</strong><br>
                    <strong>VP. TP.HCM</strong><br>Hỗ Trợ Diễn Đàn: Hỗ_trợ_Sunmart24 &amp; Sales_Sunmart24<br>Tổng Đài Điện Thoại: 08-73055707<br>
                    Email: <a href="mailto:sales@Sunmart24.vn">sales@Sunmart24.vn</a><br>
                    <br><strong>VP.Hà Nội</strong><br>Hỗ Trợ Diễn Đàn: Hỗ_trợ1_Sunmart24HN , Hỗ_trợ2_Sunmart24HN , Hỗ_trợ3_Sunmart24HN<br>Tổng Đài Điện Thoại: 04-35747279<br>Email: <a href="mailto:cs-hanoi@Sunmart24.vn">cs-hanoi@Sunmart24.vn</a><br>
                    <br><strong>Thời gian hoạt động của diễn đàn:</strong></p><ul style="padding-left:15px;">
                <li><strong>Thứ 2 - thứ 7: 8h - 22h</strong></li><li><strong>Chủ nhật: 8h - 17h</strong></li></ul>
                Xin cảm ơn các bạn.<br>
  <strong>Sunmart24.vn</strong><p></p>
              
            </div>
            <a name="entry-reply" id="entry-reply"></a>
             <div style="border-bottom:dotted 1px #ccc;clear:both">&nbsp;</div>
            <div class="head" id="reply">
              <h2>Thảo luận</h2>
               <div style="padding-left:10px; padding-top:10px; padding-right:10px;">
                <?php echo $form->create(null, array( 'url' => DOMAIN.'comments/add','type' => 'post','class'=>'validator','id'=>'forum-reply-form')); ?>	
                  <input name="parent_id" value="132171" type="hidden">
                  <input id="CommentProduct_id" name="data[Comment][id_news]" type="hidden" value="<?php echo $views['Estore_news']['id'];?>" />  
                  <input name="city_id" value="440" type="hidden">
                  <textarea lastvalue="" style="width: 100%; height: 100px;" name="data[Comment][content]" id="forum-new-content" class="f-textarea errorInput" require="true" datatype="require"></textarea>
                  <p class="commit" style="padding-top:10px;" align="right">
                    <input value="  Gởi  " name="commit" id="leader-submit" class="formbutton" type="submit">
                  </p>
                </form>
                <div class="clear"></div>
              </div>
            </div>
             <div style="border-top:dotted 1px #ccc"></div>
             <div style="padding-left:10px; padding-top:10px;" class="sect">
              <table width="100%" cellspacing="0" cellpadding="0" border="0" id="replies-list">
                  <tbody>
                  <?php $comment=$this->Help->getComment($views['Estore_news']['id']); ?>
                      <?php foreach($comment as $cm){ ?>
                      <tr>
                      <td width="49" valign="top"><a name="entry-135464"></a>
                        <div class="avatar"><img width="48" height="48" src="<?php echo DOMAIN;?>images/user-no-avatar.gif"></div></td>
                      <td align="left" valign="top">
                         <div class="author"><span style="float:right;"></span><b>Luong Ngoc Sang</b>
                          <div class="clear"></div>
                        </div>
                        <div align="justify" class="topic-content"><?php echo $cm['Comment']['content'];?></div>
                       </td>
                    </tr>
                    
                <tr><td align="left" colspan="2"><hr width="100%" size="1" style="color:#CCCCCC;  margin-bottom: 5px; margin-top: 5px;"></td></tr>
                    <?php }?>                                                                                                <tr>
                  <td colspan="2"><ul class="paginator"><li>(2)</li><li class="current">1</li></ul></td>
                </tr>
              </tbody>
             </table>
            </div>
          </div>
          <div class="box-bottom"></div>
        </div>
</div>
