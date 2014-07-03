<?php
	echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
?>

<script type="text/javascript" src="<?php echo DOMAIN;?>js/jquery.js"></script>
<script language="JavaScript">
function confirmDelete(delUrl)
{
if (confirm("Bạn có muốn xóa danh mục này không!"))
{
	document.location = delUrl;
}
}
</script>

<script type="text/javascript">

$(document).ready(function() {

	//Default Action
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content
	
	//On Click Event
	$("ul.tabs li").click(function() {
		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content
		var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active content
		return false;
	});

});
</script>
<?php echo $html->css('classifiedss'); ?>
<?php echo $html->css('newsshop'); ?>
<?php echo $html->css('theme'); ?>
<div class="member_register">
	<?php echo $this->element('shopleft');?>
	<div class="right" style="border-radius: 6px 6px 6px 6px;">
		<div id="classifieds">
			<div id="title-1" style="overflow:hidden; padding:0px !important; border-bottom:1px solid lightgrey;">
                <ul class="tabs">
                     <li><a href="#tab1">Tin khuyến mại</a></li>
                     <li><a href="#tab2">Tin tức</a></li>
					 <li><a href="#tab3">Tin giao vặt</a></li>
                     
                  </ul>
            </div>
			
			
            <div class="tab_container" style="padding: 10px;">
                
                <div style="display: none;" id="tab1" class="tab_content">
                  <div style="width:100%; padding:20px 5px; overflow:hidden;">
                      <p style="float:right;">
                         <a href="<?php echo DOMAIN;?>newsshop/add"><input type="submit" value=" Thêm mới "/></a>
                      </p>
                   </div>
				   <table width="750px" border="0">
					<tr id="title-1">
						<td width="52" style="width:25px;">STT</td>
						<td width="238" style="width:100px;">Ảnh</td>
                        <td width="238" style="width:200px;">Tiêu đề</td>
                        <td width="238" style="width:100px;">Danh mục</td>
						<td width="119" style="width:50px;">Xử lý</td>
					</tr>
                    <?php $i=1; 
					
					
					foreach($tinkhuyenmai as $key =>$value){?>
                    <tr>
						<td width="52" style="width:25px; text-align:center; padding:0px;"><?php echo $i;?></td>
						<td width="238" style="width:88px; text-align:center;"><img style="max-height:80px; max-width:80px;" src="<?php echo DOMAIN.$value['Newshop']['images'];?>" /></td>
                   <td width="238" style="width:100px; text-align:center;"><?php echo $value['Newshop']['title'];?></td>
                        <td width="238" style="width:100px; text-align:center;"><?php echo $value['Categorynewsshop']['name'];?></td>
						<td width="119" style="width:50px; text-align:center; padding:0px;">
                           <a href="<?php echo DOMAIN?>newsshop/edit/<?php echo $value['Newshop']['id'] ?>"><img src="<?php ?>images/pencil.png"/>Sửa</a> <br /> <a href="javascript:confirmDelete('<?php echo DOMAIN?>newsshop/delete/<?php echo $value['Newshop']['id'] ?>')"><img src="<?php ?>images/icon_delete.gif"/>Xóa</a>
                        </td>
					</tr>
                    <?php $i++; }?>
				</table>
                </div>
                <div style="display: none;" id="tab2" class="tab_content">
                    <div style="width:100%; padding:20px 5px; overflow:hidden;">
                      <p style="float:right;">
                         <a href="<?php echo DOMAIN;?>newsshop/add"><input type="submit" value=" Thêm mới "/></a>
                      </p>
                   </div>
				   <table width="750px" border="0">
					<tr id="title-1">
						<td width="52" style="width:25px;">STT</td>
						<td width="238" style="width:88px;">Ảnh</td>
                        <td width="238" style="width:200px;">Tiêu đề</td>
                        <td width="238" style="width:100px;">Danh mục</td>
						<td width="119" style="width:50px;">Xử lý</td>
					</tr>
                    <?php $i=1; foreach($tintuc as $key =>$value){?>
                    <tr>
						<td width="52" style="width:25px; text-align:center; padding:0px;"><?php echo $i;?></td>
						<td width="238" style="width:88px; text-align:center;"><img style="max-height:80px; max-width:80px;" src="<?php echo DOMAIN.$value['Newshop']['images'];?>" /></td>
                        <td width="238" style="width:100px; text-align:center;"><?php echo $value['Newshop']['title'];?></td>
                        <td width="238" style="width:100px; text-align:center;"><?php echo $value['Categorynewsshop']['name'];?></td>
						<td width="119" style="width:50px; text-align:center; padding:0px;">
                           <a href="<?php echo DOMAIN?>newsshop/edit/<?php echo $value['Newshop']['id'] ?>"><img src="<?php ?>images/pencil.png"/>Sửa</a> <br /> <a href="javascript:confirmDelete('<?php echo DOMAIN?>newsshop/delete/<?php echo $value['Newshop']['id'] ?>')"><img src="<?php ?>images/icon_delete.gif"/>Xóa</a>
                        </td>
					</tr>
                    <?php $i++; }?>
				</table>
                </div>
                <div style="display: none;" id="tab3" class="tab_content">
                    <div style="width:100%; padding:20px 5px; overflow:hidden;">
                      <p style="float:right;">
                         <a href="<?php echo DOMAIN;?>newsshop/add"><input type="submit" value=" Thêm mới "/></a>
                      </p>
                   </div>
				   <table width="750px" border="0">
					<tr id="title-1">
						<td width="52" style="width:25px;">STT</td>
						<td width="238" style="width:88px;">Ảnh</td>
                        <td width="238" style="width:200px;">Tiêu đề</td>
                        <td width="238" style="width:100px;">Danh mục</td>
						<td width="119" style="width:50px;">Xử lý</td>
					</tr>
                    <?php $i=1; foreach($tingiaovat as $key =>$value){?>
                    <tr>
						<td width="52" style="width:25px; text-align:center; padding:0px;"><?php echo $i;?></td>
						<td width="238" style="width:88px; text-align:center;"><img style="max-height:80px; max-width:80px;" src="<?php echo DOMAIN.$value['Newshop']['images'];?>" /></td>
                        <td width="238" style="width:100px; text-align:center;"><?php echo $value['Newshop']['title'];?></td>
                        <td width="238" style="width:100px; text-align:center;"><?php echo $value['Categorynewsshop']['name'];?></td>
						<td width="119" style="width:50px; text-align:center; padding:0px;">
                           <a href="<?php echo DOMAIN?>newsshop/edit/<?php echo $value['Newshop']['id'] ?>"><img src="<?php ?>images/pencil.png"/>Sửa</a> <br /> <a href="javascript:confirmDelete('<?php echo DOMAIN?>newsshops/delete/<?php echo $value['Newshop']['id'] ?>')"><img src="<?php ?>images/icon_delete.gif"/>Xóa</a>
                        </td>
					</tr>
                    <?php $i++; }?>
				</table>
                </div>
		
			</div>
	</div>
</div>
</div>