<style>
  #goi-thieu h1,h2,h3{
	  font-size:12px;
	  font-weight:normal;
	  }

    #main-register input, .text-main input {
    border: 1px solid #CCC;
    border-radius: 5px;
    }
    input {
    padding: 3px;
    margin-bottom: 10px;
    font-size: 14px;
    color: #333;

}
</style>
<script>
function confirmDelete(delUrl)
{
if (confirm("Bạn có chắc muốn xóa sản phẩm này không?"))
{
	document.location = delUrl;
}
}
</script> 
<div id="main-center">
<div id="sanphams">
    	<div class="top">Sản phẩm trong giỏ hàng
        </div>
        <div class="m3" style="padding-left: 20px;">            
             <div class="clearfix"> 		                   
                <div class="roundBoxBody">
                     <div class="text-main" style="padding-top:20px; padding-bottom:20px;">
                        <?php if($shopingcart){?>
                         <table  class="tblGrid wf" border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse">
                            <tr>
                                <th width="100">Hình ảnh</th>
                                <th width="200">Tên sản phẩm</th>
                                <th width="70">Số lượng</th>
                                <th width="130">Giá</th>
                                <th width="130">Tổng giá</th>
                                <th width="50">Xử lý</th>
                            </tr>
                            
                            <?php $total=0; $i=0; foreach($shopingcart as $key=>$product) {?>
                            <?php if($product['name']!=null){?>
                            <tr>       
                                <td align="center"><img width="70" src="<?php echo DOMAINADESTORE;?><?php echo $product['images']; ?>" /></td>
                                <td style="padding-left: 5px;"><?php echo $product['name']; ?></td>
                                <td class="tal">
                                <form name="view<?php echo $i; ?>" action="<?php echo DOMAIN;?>bepga/updateshopingcart/<?php echo $key;?>" method="post">
                                <input style="width:50px;" type="text" name="soluong" value="<?php echo $product['sl']; ?>" />
                                </form>
                                </td>
                               
                                <td class="tal"><font color="red"><?php echo number_format( $product['price'],3); ?> VNĐ</font></td>
                                <td class="tal"><font color="red"><?php echo number_format($product['total'],3); ?> VNĐ</font></td>
                                <td class="tal">
                                <input onclick="document.view<?php echo $i; ?>.submit();"  type="image" src="<?php echo DOMAINADESTORE?>images/refresh.png" alt="Cập nhật"/>
                                <a href="javascript:confirmDelete('<?php echo DOMAIN;?>bepga/deleteshopingcart/<?php echo $key;?>')"><img src="<?php echo DOMAINAD?>images/icons/cross.png" alt="Delete" /></a>
                                </td>        
                            </tr>
                            <?php $total +=$product['total']; $i++; }} ?> 
                           
                        </table>
                         <?php }else{ echo"<b>Không có sản phẩm trong giỏ</b>";}?> 
                        <div style="float:left; padding-top:15px; padding-right:20px;"><a href="<?php echo DOMAIN?>bepga/index" onclick=""><input type="button" value="Tiếp tục mua" /></a></div>
                        <?php if($shopingcart){?>
                        <div style="float:left; padding-top:15px;"><a href="<?php echo DOMAIN?>bepga/buy"><input type="button" value="Hoàn tất" /></a></div>
                        <?php }?>
                      </div>
                </div>                  
             </div>            
             <div class="clearfix"></div>
        </div> 
        <div class="b3"><div class="b3"><div class="b3"></div></div></div>
    </div>
    
 </div>



