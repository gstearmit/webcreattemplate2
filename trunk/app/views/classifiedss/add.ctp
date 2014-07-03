<?php echo $html->css('classifiedss'); ?>
<div id="leftraovat">
<div id="classifiedsadd" style="border: none;">
<table width="100%" style="background: #F2F5F7;">
<tr>
<td valign="top" width="100%">
	<div id="j_idt143">
		<div id="j_idt143_header" class="ui-panel-titlebar ui-widget-header ui-corner-all">
			<span class="ui-panel-title">Đăng tin rao vặt 
				<?php echo $nameproduct['Catproduct']['name']; ?></span>
		</div>
		<div id="j_idt143_content" class="ui-panel-content ui-widget-content"> 
			<form id="myform" name="image" method="post" action="<?php echo $nameproduct['Catproduct']['id'];;?>" enctype="multipart/form-data">
				<input type="hidden" name="" value="" /> 			  
					<table width="100%" border="0">
					   <tr>
							 <td width="15%">
							   <label>Tỉnh thành</label><span class="lbRed">(*)</span>:
							 </td>
							 <td valign="top" width="85%"><select name="cities" size="1" style="width: 336px;font-weight: bold;">
								<option value="0">Toàn quốc</option>
								
								<?php $cities = $this->requestAction('/comment/cities');?>
								<?php foreach($cities as $cities){?>
								<option value="<?php echo $cities['Cities']['id']; ?>"><?php echo $cities['Cities']['name']; ?></option>
								<?php } ?>
								</select>
							 </td>
					   </tr>
					   <tr>
							 <td class="fieldName lbGrey lbBold"><label>Loại</label><span class="lbRed">(*)</span>:
							 </td>
							 <td valign="top" width="80%" class="fieldValue"><select name="needs" size="1" style="width: 336px;font-weight: bold;">
								<option value="1">Cần bán</option>
								<option value="2">Cần mua</option>
								</select>
							 </td>
					   </tr>
					   <tr>
							 <td><label>Tiêu đề</label><span class="lbRed">(*)</span>:
							 </td>
							 <td valign="top" width="80%" class="fieldValue">
							     <span id=":raovatArea"><input type="text" name="title" class="title-raovat" style="font-weight: bold;" /></span>  
							 </td>
					   </tr>
					   <tr>
						 <td valign="top" class="fieldName lbGrey lbBold" style="padding-right: 5px;"><label>Upload ảnh</label><span class="lbRed">(*)</span>: 
						</td>
						 <td valign="top" class="fieldValue">                         	  	 
							   <p> 
									  <input type="text" readonly="true" size="60" style="height:18px;" name="userfile"  value=""/> &nbsp;<font color="#FF0000"> <a href="javascript:window.open('<?php echo DOMAINAD; ?>upload_pic.php','userfile','width=500,height=300');window.history.go(1)" >[ upload ]</a> </font><font color="#FF0000">*</font>(jpg, jpeg, gif, png)
								</p>
						  </td>
					   </tr>
					   <tr>
						 <td class="fieldName lbBold lbGrey"><label>Giá</label><span class="lbRed"></span>:</td>
						 <td class="fieldValue"><input type="text" name="price" class="textField textField100" style="font-weight: bold;" />
							  
							<select size="1" style="width: 70px;font-weight: bold;">
							<option value="1">VND</option>
							<option value="2">USD</option>
							</select>
						 </td>
					   </tr> 
						
					   <tr>
						 <td class="fieldName">
							<span class="lbBold lbGrey"><label>Nội dung</label><span class="lbRed">(*)</span>:</span><br />
						 </td>
						 <td class="fieldValue">
							<div style="background-color: white;">
								<textarea name="content" style="width: 550px; height: 300px; " id="myArea2"></textarea>	
							</div>
								<?php echo $javascript->link('nicEdit', true); ?> 
								<script>
								var area1, area2;
								
								function addArea2() {
									area2 = new nicEditor({fullPanel : true}).panelInstance('myArea2');
								}
								function removeArea2() {
									area2.removeInstance('myArea2');
									
								}
								
								bkLib.onDomLoaded(function() { addArea2(); });
							</script>	

						 </td>
					   </tr>                          
					   <tr>
						 <td align="left"></td>
						 <td><input onclick="removeArea2();" type="submit" name="save" value="Lưu rao vặt"/>
						 </td>
					   </tr>
				  </table> 
			</form> 
		</div>
	</div>
</td> 
</tr>
</table>
</div> 
</div> 
<div id="rightraovat">
<?php echo $this->element('rightraovat');?>
</div>