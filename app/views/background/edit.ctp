
<?php echo $html->css('classifiedss'); ?>
<?php echo $javascript->link('jquery.min', true); ?>
<?php echo $html->css(array('jPicker-1.1.6.min','jPicker')); ?>
  <script src="<?php echo DOMAIN;?>js/jquery-1.4.4.min.js" type="text/javascript"></script>
  <script src="<?php echo DOMAIN;?>js/jpicker-1.1.6.min.js" type="text/javascript"></script>
  <script type="text/javascript">
    $(function()
      {
        $.fn.jPicker.defaults.images.clientPath='<?php echo DOMAIN;?>images/';
        var LiveCallbackElement = $('#Live'),
            LiveCallbackButton = $('#LiveButton');
        $('#Inline').jPicker({window:{title:'Inline Example'}});
        $('#Expandable').jPicker({window:{expandable:true,title:'Expandable Example'}});
        $('#Alpha').jPicker({window:{expandable:true,title:'Alpha (Transparency) Example)',alphaSupport:true},color:{active:new $.jPicker.Color({ahex:'99330099'})}});
        $('#Binded').jPicker({window:{title:'Binded Example'},color:{active:new $.jPicker.Color({ahex:'993300ff'})}});
        $('.Multiple').jPicker({window:{title:'Multiple Binded Example'}});
        $('#Callbacks').jPicker(
          {window:{title:'Callback Example'}},
          function(color, context)
          {
            var all = color.val('all');
            alert('Color chosen - hex: ' + (all && '#' + all.hex || 'none') + ' - alpha: ' + (all && all.a + '%' || 'none'));
            $('#Commit').css({ backgroundColor: all && '#' + all.hex || 'transparent' });
          },
          function(color, context)
          {
            if (context == LiveCallbackButton.get(0)) alert('Color set from button');
            var hex = color.val('hex');
            LiveCallbackElement.css({ backgroundColor: hex && '#' + hex || 'transparent' });
          },
          function(color, context)
          {
            alert('"Cancel" Button Clicked');
          });
        $('#LiveButton').click(
          function()
          {
            $.jPicker.List[7].color.active.val('hex', 'e2ddcf', this);
          });
        $('#AlterColors').jPicker({window:{title:'Color Interaction Example'}});
        $('#GetActiveColor').click(
          function()
          {
            alert($.jPicker.List[8].color.active.val('ahex'));
          });
        $('#GetRG').click(
          function()
          {
            var rg=$.jPicker.List[8].color.active.val('rg');
            alert('red: ' + rg.r + ', green: ' + rg.g);
          });
        $('#SetHue').click(
          function()
          {
            $.jPicker.List[8].color.active.val('h', 133);
          });
        $('#SetValue').click(
          function()
          {
            $.jPicker.List[8].color.active.val('v', 38);
          });
        $('#SetRG').click(
          function()
          {
            $.jPicker.List[8].color.active.val('rg', { r: 213, g: 118 });
          });
      });
	  </script>


<?php echo $html->css('classifiedss'); ?>
<div class="member_register">
	<?php echo $this->element('shopleft');?>
	<div class="right" style="border-radius: 6px 6px 6px 6px;">
		<div id="classifieds">
        <div id="title-1">Cài đặt Background</div>
			<div>
             <?php echo $form->create(null, array( 'url' => DOMAIN.'background/edit','type' => 'post','enctype'=>'multipart/form-data','id'=>'check_form','name'=>'image')); ?>       
                <table width="100%" border="0" style="padding-top:15px;">
					   
                        <tr>
                             <td class="fieldName lbGrey lbBold"><label>Màu Background</label></td>
                             <td valign="top" width="80%" class="fieldValue">
                                  <span id="jPicker">
                                     <?php echo $this->Form->input('Background.color',array('class'=>'title-raovat','label'=>'','id' => 'Binded'));?>
                                 </span>
                             </td>
					   </tr>
					   <tr>
						 <td valign="top" class="fieldName lbGrey lbBold" style="padding-right: 5px;"><label>Upload ảnh</label>: 
						</td>
						 <td valign="top" class="fieldValue">                         	  	 
							   <p> 
								  <input type="text" readonly="true" size="45" style="height:25px;" name="userfile"  value="<?php echo $edit['Background']['images'];?>"/> &nbsp;<font color="#FF0000"> <a href="javascript:window.open('<?php echo DOMAIN; ?>upload_pic_shop.php?id=<?php echo $nameshop[0]['Shop']['name']?>','userfile','width=500,height=300');window.history.go(1)" >[ upload ]</a> </font><font color="#FF0000">*</font>(jpg, jpeg, gif, png)
								</p>
						  </td>
					   </tr>
					   <tr>
						 <td align="left"></td>
						 <td><input onclick="removeArea2();" type="submit" name="save" value=" Sửa background"/>
						 </td>
					   </tr>
				  </table>
                  <?php echo $form->end(); ?>
            </div>
			
	    </div>
   </div>