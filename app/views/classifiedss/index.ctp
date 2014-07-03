<script language="JavaScript">
function confirmDelete(delUrl)
{
if (confirm("Bạn có muốn xóa danh mục này không!"))
{
	document.location = delUrl;
}
}
</script>
<?php echo $html->css('classifiedss'); ?>
<div class="member_register">
	<?php echo $this->element('shopleft');?>
	<div class="right" style="border-radius: 6px 6px 6px 6px;">
		<div id="classifieds">
			<div id="title-1">Quản lý tin rao vặt</div>
			<div style="padding: 20px 10px; font-size:13px; float:left;width:370px;">Tìm kiếm <input type="text" size="30px"/>
			<input type="submit" value="Tìm kiếm"/></div>
			<div style="float:right; width:130px; padding:20px 10px">
			<a href="<?php echo DOMAIN?>classifiedss/add">Đăng tin</a>
			
			</div>
			<div style="padding: 10px;">
				<table width="750px" border="0">
					<tr id="title-1">
						<td width="52" style="width:25px;">STT</td>
						<td width="96" style="width:20px;">Ảnh đại diện</td>
						<td width="238" style="width:470px;">Tiêu đề</td>
						<td width="56" style="width:25px;">Xem</td>
						<td width="65" style="width:60px;">Phản hồi</td>
						<td width="119" style="width:50px;">Xử lý</td>
					</tr>
					<?php $i = 1; foreach($classifiedss as $classifiedss){?>
					<tr>
						<td align="center" style="text-align:center;"><?php echo $i; ?></td>
						<td align="center" style="text-align:center; width:90px;">
				  			<a href="<?php echo DOMAIN;?>rao-vat/view/<?php echo $classifiedss['Classifiedss']['id'];?>" target="_blank"><img width="80" height="" src="<?php echo DOMAINAD;?><?php echo $classifiedss['Classifiedss']['images'];?>"/>
				  			</a>
						</td>
						<td align="center">
						   <p><a href="<?php echo DOMAIN;?>rao-vat/view/<?php echo $classifiedss['Classifiedss']['id'];?>"><?php echo $classifiedss['Classifiedss']['title'];?></a></p>
							<p>
								<?php $categoryproductchild = $this->requestAction('/comment/getnameproduct/'.$classifiedss['Classifiedss']['scop_id']);?>
								<?php foreach($categoryproductchild as $categoryproductchild){?>
								<?php echo $categoryproductchild['Catproduct']['name']; }?>
							</p>
					  </td>
						<td align="center" style="text-align:center;"><?php echo $classifiedss['Classifiedss']['veiwed'];?></td>
						<td align="center" style="text-align:center;"><?php echo '0'; ?></td> 
						<td align="center" style="text-align:center;"><a href="<?php echo DOMAIN?>rao-vat/edit/<?php echo $classifiedss['Classifiedss']['id'] ?>"><img src="<?php ?>images/pencil.png"/>Sửa</a><br /><a href="javascript:confirmDelete('<?php echo DOMAIN?>rao-vat/delete/<?php echo $classifiedss['Classifiedss']['id'] ?>')"><img src="<?php ?>images/icon_delete.gif"/>Xóa</a></td>
					</tr>
					<?php $i++; } ?>
					<div style="padding: 10px; width:750px;margin-top: 60px;">Tổng số sản phẩm: <span style="color: red; font-weight:bold"><?php echo ($i - 1); ?></span></div>
				</table>
			</div>
		</div>
	</div>
</div>