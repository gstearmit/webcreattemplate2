<style>
#uploadcontent {
	color: #333333;
	height: 20px;
	float: right;
	width: 372px;
}

#uploadcontent a {
	color: #258294;
	text-decoration: none;
}

.error span {
	padding-left: 0px !important;
}

.ui-datagrid-column img {
	border: 1px solid #CCC;
}
</style>
<div class="member_register">
	<?php echo $this->element('shopleft');?>
	<div class="right" style="border-radius: 6px 6px 6px 6px;">
		<div class="ui-widget-header">Trang thành viên</div>
		<div
			style="padding-left: 10px; padding-right: 10px; padding-top: 10px;">
			<div
				style="border-bottom: 1px solid lightgrey; font-weight: bold; padding-bottom: 2px;">Chọn
				theme gian hàng:</div>
			<div id="container">
				<form method="post" action="<?php echo DOMAIN?>temshop/add"
					id="myform" name="image" enctype="multipart/form-data">
                 <?php $sang=$this->Session->read("shop_id"); foreach($imagestems as $imagestems){?>
                 <div style="text-align: center; padding: 5px;" id="row">
						<table width="100%">
							<tr>
								<td align="center"><img width="180" height="180"
									src="<?php echo $imagestems['Tems']['imagestems'];?>"></td>
							</tr>
						</table>
					</div>
                   <?php $shop_id = $imagestems['Tems']['shop_id'];?>
                     <?php if($sang == $shop_id){?>
                        <input type="hidden" name="id"
						value="<?php echo $imagestems['Tems']['id'];?>" />
                     <?php }?>
                   <?php }?>
                   
                 <div class="ui-datagrid ui-widget"
						id="mainForm:themeList">

						<div class="ui-datagrid-content" id="mainForm:themeList_content"
							style="padding-top: 20px;">
							<table class="ui-datagrid-data">
								<tr class="ui-datagrid-row">
									<td class="ui-datagrid-column">
										<table>
											<tr>
												<td width="5%"><input type="radio" value="team_1"
													checked="checked" name="themeRadio" id="themeRadio" /></td>
												<td width="95%">
													<p>
														<img width="180" height="180"
															src="<?php echo DOMAIN;?>images/themes/template1.png">
													</p> <input type="hidden"
													value="<?php echo DOMAIN;?>images/themes/template1.png"
													name="imagestems"> <input type="hidden" name="linktems"
													value="template1" />
													<p
														style="text-align: center; font-weight: bold; padding-top: 5px;">Giao
														diện 1</p>
												</td>
											</tr>
										</table>
									</td>
									<td class="ui-datagrid-column">
										<table>
											<tr>
												<td width="5%"><input type="radio" value="team_2"
													name="themeRadio" id="themeRadio"></td>
												<td width="95%">
													<p>
														<img width="180" height="180"
															src="<?php echo DOMAIN;?>images/themes/template2.png">
													</p> <input type="hidden"
													value="<?php echo DOMAIN;?>images/themes/template2.png"
													name="imagestems1"> <input type="hidden" name="linktems1"
													value="template2" />
													<p
														style="text-align: center; font-weight: bold; padding-top: 5px;">Giao
														diện 2</p>
												</td>
											</tr>
										</table>
									</td>
									<td class="ui-datagrid-column">
										<table>
											<tr>
												<td width="5%"><input type="radio" value="team_3"
													name="themeRadio" id="themeRadio"></td>
												<td width="95%">
													<p>
														<img width="180" height="180"
															src="<?php echo DOMAIN;?>images/themes/template3.png">
													</p> <input type="hidden"
													value="<?php echo DOMAIN;?>images/themes/template3.png"
													name="imagestems2"> <input type="hidden" name="linktems2"
													value="template3" />
													<p
														style="text-align: center; font-weight: bold; padding-top: 5px;">Giao
														diện 3</p>
												</td>
											</tr>
										</table>
									</td>

								</tr>

							</table>
						</div>

						<div
							style="padding-top: 30px; padding-left: 10px; padding-bottom: 20px;">
							<input type="submit" name="btsub" value="Đăng ký" />
						</div>
				
				</form>
			</div>
		</div>
	</div>
</div>
<div class="clr"></div>
</div>
