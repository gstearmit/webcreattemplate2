<div id="content-body">
    <div id="content-main">
     <div class="title-detail">
         <p><span>Đơn hàng của bạn</span></p>
     </div>
     <div class="order-select">
          
      <form action="/team/buy.php?id=2099" method="post" class="validator" name="teambuy" onsubmit="return checkform()">
        <input id="deal-per-number" value="9" type="hidden">
         <div class="sect">
              <table class="order-table">
                <tr>
                  <th class="deal-buy-desc">Deal</th>
                  <th class="deal-buy-quantity">Số lượng</th>
                  <th class="deal-buy-multi"></th>
                  <th class="deal-buy-price">Đơn giá (<span class="money">VNĐ</span>)</th>
                  <th class="deal-buy-equal"></th>
                  <th class="deal-buy-total">Thành tiền (<span class="money">VNĐ</span>)</th>
                </tr>
                <tr>
                  <td class="deal-buy-desc">
                     <?php echo $buy['Estore_news']['introduction'];?>
                  </td>
                  <td class="deal-buy-quantity">
                    <input type="text" id="deal-buy-quantity-input" ff="0" value="1" name="quantity" maxlength="4" class="input-text f-input">
                   </td>
                  <td class="deal-buy-multi">x</td>
                  <td class="deal-buy-price"><span id="deal-buy-price"><?php echo number_format($buy['Estore_news']['price']);?>VNĐ<input name="price" type="hidden" value="<?php echo $buy['Estore_news']['price'];?>" id="deal-buy-price-hidden"></span></td>
                  <td class="deal-buy-equal">=</td>
                  <td class="deal-buy-total"><span id="deal-buy-total"><?php echo number_format($buy['Estore_news']['price']);?>VNĐ</span><input name="total_price" type="hidden" value="<?php echo $buy['Estore_news']['price'];?>" id="deal-buy-total-hidden"></td>
                </tr>
                  <tr class="order-total">
                  <td class="deal-buy-desc"></td>
                  <td class="deal-buy-quantity"></td>
                  <td class="deal-buy-multi"></td>
                  <td nowrap="nowrap" class="deal-buy-price"><strong>Tổng số tiền:</strong></td>
                  <td class="deal-buy-equal">=</td>
                  <td class="deal-buy-total"><strong id="deal-buy-total-t"><?php echo number_format($buy['Estore_news']['price']);?>VNĐ</strong>&nbsp;<span class="money">VNĐ</span></td>
                </tr>
          </table>
              <div class="paytype">
                <form class="validator" method="post" action="/order/pay.php">
										<div class="clear"></div>
					<p class="check-act">
					<input type="hidden" value="1218528" name="order_id">
                    <input type="hidden" value="cashdelivery" name="service">
					<input type="hidden" value="2103" name="team_id">
					<input type="hidden" value="" name="cardcode">
					<input type="hidden" value="6" name="quantity">
					<input type="hidden" value="33 trtretrtetrtetre" name="address">
					<input type="hidden" value="N" name="express">
					<input type="hidden" value="" name="remark">
					<input type="submit" class="formbutton" value="Xác nhận đơn hàng, đặt mua">
                        &nbsp;&nbsp;&nbsp;<input type="button" onclick="location.href='index.php';" class="formbutton" value="Quay về">
                        <a style="margin-left:1em;" href="/team/buy.php?id=2103">Sửa đơn đặt hàng<!--back to edit order--></a></p>
                    </form>
				</div>
            </div>
      </form>
     </div>
 </div>
</div>
