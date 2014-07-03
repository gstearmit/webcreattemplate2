<script src="<?php echo DOMAINAD; ?>js/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="<?php echo DOMAINAD; ?>js/ckfinder/ckfinder.js" type="text/javascript"></script>
<?php echo $html->css('classifiedss'); ?>
<style>
#fck{
	font-family:"Times New Roman", Times, serif;
	}
</style>
<div id="classifiedsadd" style="border: none;">
    <table width="100%" style="background: #F2F5F7;">
        <tr>
            <td valign="top" width="100%">
                <div id="j_idt143">
                    <div id="j_idt143_header" class="ui-panel-titlebar ui-widget-header ui-corner-all">
                        <span class="ui-panel-title">Sửa tin rao vặt 
                        </span>
                    </div>
                    <div id="j_idt143_content" class="ui-panel-content ui-widget-content"> 
                        <?php echo $form->create(null, array( 'url' => DOMAIN.'classifiedss/edit','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>  
                             <?php echo $form->input('Classifiedss.id',array( 'label' => ''));?>			  
				                <table width="100%" border="0">
							   	   <tr>
				                         <td width="15%">
				                         	Tỉnh thành<span class="lbRed">(*)</span>:
				                         </td>
				                         <td valign="top" width="85%">
                                             <select name="cities" size="1" style="width: 200px;font-weight: bold;">
                                                <option value="0">Toàn quốc</option>
                                                <?php foreach($city as $citys){?>
                                                 <option value="<?php echo $citys['City']['id'];?>"><?php echo $citys['City']['name'];?></option>
                                                <?php }?>
                                            </select>
										 </td>
				                   </tr>
				                   <tr>
				                         <td class="fieldName lbGrey lbBold">
				                         	Loại<span class="lbRed">(*)</span>:
				                         </td>
				                         <td valign="top" width="80%" class="fieldValue">
                                             <?php echo $this->Form->input('scop_id',array('type'=>'select','options'=>$list_cat,'empty'=>'Loại sản phẩm','style'=>'width: 200px;font-weight: bold;','label'=>''));?>
										 </td>
				                   </tr>
                                    <tr>
				                         <td class="fieldName lbGrey lbBold">
				                         	Loại sản phẩm<span class="lbRed">(*)</span>:
				                         </td>
				                         <td valign="top" width="80%" class="fieldValue"><select name="needs" size="1" style="width: 200px;font-weight: bold;">
                                            <option value="1">Cần bán</option>
                                            <option value="2">Cần mua</option>
                                            </select>
										 </td>
				                   </tr>
							   	   <tr>
				                         <td>
				                         	Tiêu đề<span class="lbRed">(*)</span>:
				                         </td>
				                         <td valign="top" width="80%" class="fieldValue"><span id=":raovatArea">
                                          <?php echo $form->input('Classifiedss.title',array( 'label' => '','style'=>'width: 330px; height: 18px; font-weight: bold;'));?>
                                         </span>  
										 </td>
				                   </tr>
							       <tr>
			                         <td valign="top" class="fieldName lbGrey lbBold" style="padding-right: 5px;"> 
										 Upload ảnh<span class="lbRed">(*)</span>: 
									</td>
			                         <td valign="top" class="fieldValue">                         	  	 
			                         	  <p> 
                                              <input type="text" size="80" style="height:25px;" name="userfile" readonly="true"  value="<?php echo $edit['Classifiedss']['images']; ?>"/> &nbsp;<font color="#FF0000"> <a href="javascript:window.open('<?php echo DOMAINAD; ?>upload_pic.php','userfile','width=500,height=300');window.history.go(1)" >[ upload ]</a> </font><font color="#FF0000">*</font>(jpg, jpeg, gif, png)
                                            </p>
									  </td>
			                       </tr>
			                       <tr>
			                         <td class="fieldName lbBold lbGrey">Giá<span class="lbRed"></span>:</td>
			                         <td class="fieldValue">
                                        <?php echo $form->input('Classifiedss.price',array( 'label' => '','class'=>'textField textField100','style'=>'float:left; height: 17px;'));?>
									    <select size="1" style="width:70px; margin-left:2px; font-weight: bold; float:left;">
                                        <option value="1">VND</option>
                                        <option value="2">USD</option>
                                        </select>
									 </td>
			                       </tr> 
			                       <tr>
			                         <td class="fieldName">
			                         	<span class="lbBold lbGrey">Nội dung<span class="lbRed">(*)</span>:</span><br />
			                         </td>
			                         <td class="fieldValue" style=" font-family:'Times New Roman', Times, serif !important;">
                                        <div style="background-color: white;">
											 <?php echo $this->Form->textarea('Productshop.content',array('class'=>'textField','label'=>'','style' => 'width: 550px; height: 300px;','id'=>'myArea1'));?>
                                        </div>
										<?php echo $javascript->link('nicEdit-latest', true); ?> 
                                        <script type="text/javascript">
                                        //<![CDATA[
                                        var area1, area2;
                                         
                                        function toggleArea1() {
                                        if(!area1) {
                                        area1 = new nicEditor({fullPanel : true}).panelInstance('myArea1',{hasPanel : true});
                                        } else {
                                        area1.removeInstance('myArea1');
                                        area1 = null;
                                        }
                                        }
                                         
                                        function addArea2() {
                                        area2 = new nicEditor({fullPanel : true}).panelInstance('myArea2');
                                        }
                                        function removeArea2() {
                                        area2.removeInstance('myArea2');
                                        }
                                         
                                        bkLib.onDomLoaded(function() { toggleArea1(); });
                                        //]]>
                                        </script>
                                     </td>
			                       </tr>  
                                                         
			                       <tr>
			                         <td align="left"></td>
			                         <td><input onclick="removeArea2();" type="submit" name="save" value="Sửa rao vặt"/>
									 </td>
			                       </tr>
			                  </table> 
                       <?php echo $form->end(); ?>
                    </div>
                </div>
   	   	    </td> 
	   </tr>
   </table>
</div> 