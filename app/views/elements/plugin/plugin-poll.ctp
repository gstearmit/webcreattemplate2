<form method="post" action="home/add">
     <table>
         <tr>
            <td colspan="2" style="color:#000; font-weight:bold;">Bạn đánh giá sản phẩm của Matte?</td>
         </tr>
         
         <?php $binhchon = $this->requestAction('/plugin/binhchon'); ?>   
          <?php for($i=0;$i<count($binhchon);$i++){ ?>
         <tr>
            <td width="14"><input type="radio" name="ykien" value="<?php echo $binhchon[$i]['Poll']['id']; ?>" checked="checked" /></td>
            <td width="135"><?php echo $binhchon[$i]['Poll']['name']; ?></td>
         </tr>
          <?php } ?>
         <tr>
            <td colspan="2">
              <input type="image" src="<?php echo DOMAIN;?>images/binhchon.gif" />
              <a href="<?php echo DOMAIN;?>binh-chon"><img src="<?php echo DOMAIN;?>images/ketqua.png"></a>
            </td>
         </tr>
       
     </table>
      </form>