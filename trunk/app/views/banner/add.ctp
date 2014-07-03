<?php echo $html->css('classifiedss'); ?>
<script type="text/javascript" src="<?php echo DOMAIN;?>js/fancybox/jquery.fancybox-1.3.2.js"></script>
<script type="text/javascript" src="<?php echo DOMAIN;?>js/jquery.validationEngine1.js"></script>
<?php echo $html->css('validationEngine.jquery.css'); ?>
<script>
  $(document).ready(function(){
    $("#check_form").validationEngine();
  });
</script>

<div class="member_register">
	<?php echo $this->element('shopleft');?>
	<div class="right" style="border-radius: 6px 6px 6px 6px;">
		<div id="classifieds">
			<div>
             <?php echo $form->create(null, array( 'url' => DOMAIN.'banner/add','type' => 'post','enctype'=>'multipart/form-data','id'=>'check_form','name'=>'image')); ?>       
                <table width="100%" border="0" style="padding-top:15px;">
					  
                       
					   <tr>
						 <td valign="top" class="fieldName lbGrey lbBold" style="padding-right: 5px;"><label>Upload ảnh</label><span class="lbRed">(*)</span>: 
						</td>
						 <td valign="top" class="fieldValue">                         	  	 
							   <p> 
								  <input type="text" readonly="true" size="45" style="height:25px;" class="validate[required]" name="userfile"  value=""/> &nbsp;<font color="#FF0000"> <a href="javascript:window.open('<?php echo DOMAIN; ?>upload_pic_shop.php?id=<?php echo $nameshop[0]['Shop']['name']?>','userfile','width=500,height=300');window.history.go(1)" >[ upload ]</a> </font><font color="#FF0000">*</font>(jpg, jpeg, gif, png)
								</p>
						  </td>
					   </tr>
					   <tr>
						 <td align="left"></td>
						 <td><input onclick="removeArea2();" type="submit" name="save" value="Cài đặt"/>
						 </td>
					   </tr>
				  </table>
                  <?php echo $form->end(); ?>
            </div>
			
	    </div>
   </div>