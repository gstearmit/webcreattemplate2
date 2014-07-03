<?php
	echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
?>
<script type="text/javascript" src="<?php echo DOMAIN;?>js/jquery.validate.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
	
	$("#myform").validate({
		rules: {
		
			data[Newshop][title]: {
				required: true,
			
			},
			categorynewsshop_id: {
				required: true,
				
			},
		userfile:{
		required: true,
		
		},
		
		introduction:{
		required: true,
		
		},
			content:{
		required: true,
		
		},
		
		
			
		},
		messages: {
						
			data[Newshop][title]: {
				required: " <br><span style='color:#FF0000; font-size:12px;'>Xin vui lòng nhập tiêu đề tin!</span>"
				
			},
			categorynewsshop_id: {
				required: " <br><span style='color:#FF0000; font-size:12px; '>Xin vui lòng chọn danh mục tin!</span>"
				
			},
			
			userfile: {
				required: " <br><span style='color:#FF0000; font-size:12px; '>Xin vui lòng upload ảnh!</span>"
				
			},
			
			introduction: {
				required: " <br><span style='color:#FF0000; font-size:12px; '>Xin vui lòng nhập nội dung tóm tắt!</span>"
				
			},
			
			content: {
				required: " <br><span style='color:#FF0000; font-size:12px; '>Xin vui lòng nhập nội dung tin tức!</span>"
				
			},
		
			
		}
	});	
});


</script>
<?php echo $html->css('classifiedss'); ?>
<?php echo $html->css('theme'); ?>
<style>
#fck{
	font-family:"Times New Roman", Times, serif;
	}
.fieldName{text-align:right;}
</style>


<div id="leftraovat">
<div id="classifiedsadd" style="border: none;">

	<div id="j_idt143">
		<div id="j_idt143_header" class="ui-panel-titlebar ui-widget-header ui-corner-all">
			<span class="ui-panel-title">Tin tức</span>
		</div>
		<div id="j_idt143_content" class="ui-panel-content ui-widget-content"> 
              <?php echo $form->create(null, array( 'url' => DOMAIN.'newsshop/edit','type' => 'post','enctype'=>'multipart/form-data','id'=>'myform','name'=>'image')); ?>       
					<table width="100%" border="0" style="padding-top:15px;">
					   <tr>
                             <td class="fieldName lbGrey lbBold" ><label>Tiêu đề tin</label><span class="lbRed">(*)</span>:</td>
                             <td valign="top" width="80%" class="fieldValue">
                                 <span id=":raovatArea">
                                     <?php echo $this->Form->input('Newshop.title',array('class'=>'validate[required] title-raovat','label'=>'','style' => 'font-weight: bold;'));?>
                                      <?php echo $this->Form->input('Newshop.id',array('label'=>'','style' => 'font-weight: bold;'));?>
                                 </span>  
                             </td>
					   </tr>
					
					   
                       <tr>
                             <td class="fieldName lbGrey lbBold" ><label>Chọn danh mục</label><span class="lbRed">(*)</span>:</td>
                             <td valign="top" width="80%" class="fieldValue">
                             <p>
                        
                        <?php echo $this->Form->input('Newshop.categorynewsshop_id', array('type'=>'select', 'label'=>'', 'options'=>$list_cat, 'default'=>'','empty'=>'Chọn danh mục','name'=>'categorynewsshop_id'));?>
                    </p>
                             </td>
					   </tr>
					   <tr>
						 <td valign="top" class="fieldName lbGrey lbBold" style="padding-right: 5px;"><label>Upload ảnh</label><span class="lbRed">(*)</span>: 
						</td>
						 <td valign="top" class="fieldValue">                         	  	 
							   <p> 
							  
								  <input type="text" readonly="true" size="60" style="height:25px;" class="validate[required]" name="userfile"  value="<?php echo $edit['Newshop']['images'];?>"/> &nbsp;<font color="#FF0000"> <a href="javascript:window.open('<?php echo DOMAIN; ?>upload_pic_shop.php?id=<?php echo $nameshop[0]['Shop']['name']?>','userfile','width=500,height=300');window.history.go(1)" >[ upload ]</a> </font><font color="#FF0000">*</font>(jpg, jpeg, gif, png)
								</p>
						  </td>
					   </tr>
                      <tr>
                         <td valign="top" class="fieldName lbGrey lbBold">Nội dung tóm tắt<span class="lbRed">(*)</span>:</td>
                         <td class="fieldValue">
						  <?php  echo $this->Form->input('Newshop.introduction',array('label' => '','type'=>'textarea','class'=>'validate[required]')).$this->TvFck->create('Newshop.introduction',array('toolbar'=>'extra','height'=>'150px','width'=>'550','id'=>'myArea1','class'=>'validate[required]')); ?>
				
                                 <div id="updateProdForm:j_idt258"></div>
						 </td>
                       </tr>
                       
					   <tr>
						 <td class="fieldName">
							<span class="lbBold lbGrey"><label>Nội dung</label><span class="lbRed">(*)</span>:</span><br />
						 </td>
						 <td class="fieldValue" id="fck" style=" font-family:'Times New Roman', Times, serif !important;">
							<div>
                               	  <?php  echo $this->Form->input('Newshop.content',array('label' => '','type'=>'textarea','class'=>'validate[required]')).$this->TvFck->create('Newshop.content',array('toolbar'=>'extra','height'=>'300px','width'=>'550','id'=>'myArea1','class'=>'validate[required]')); ?>
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
						 <td><input onclick="removeArea2();" type="submit" name="save" value="Lưu tin"/>
						 </td>
					   </tr>
				  </table> 
			<?php echo $form->end(); ?>
		</div>
	</div>
</div> 
</div> 
<div id="rightraovat">
<?php echo $this->element('rightraovat');?>
</div>