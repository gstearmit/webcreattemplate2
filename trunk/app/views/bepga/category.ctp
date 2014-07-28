<div class="sanpham-title"><img src="<?php echo DOMAIN?>images/tittle-sanpham.png" width="67" height="16" /></div>
	
<div class="sanpham"><!--begin san pham-->
<?php foreach($products as $pr) { ?>
        <div class="sp-item"><!--begin sp item-->
            <div class="image"><img alt="<?php echo $pr['Product']['title'];?>" src="<?php echo DOMAINAD?><?php echo $pr['Product']['images'];?>" width="160" height="128" /></div>
            <div class="sp-noidung">
                <p style="font-weight:bold;"><?php echo $pr['Product']['title'];?></p>
                <p>Loai : <?php echo $pr['Product']['type'];?> <br>	
                Hãng sản xuất : <?php echo $pr['Product']['producer'];?> <br>	
				Chất liệu : <?php echo $pr['Product']['material'];?> <br>
                Kiểu dáng :<?php echo $pr['Product']['style'];?> <br>
                Xuất xứ :<?php echo $pr['Product']['origin'];?> <br>
                </p>
            </div>
            <div class="chitiet"><a href="<?php echo DOMAIN?>products/view/<?php echo $pr['Product']['id'];?>">Xem chi tiết</a></div>
            <span class="price">Giá : <?php echo $pr['Product']['price'];?></span>
        </div><!--end sp-item-->
    <?php } ?>  
</div><!--end san pham--> 