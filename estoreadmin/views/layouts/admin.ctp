<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administractor</title>
<?php echo $this->Html->css("reset");?>
<?php echo $this->Html->css("style");?>
<?php echo $html->css(array('jPicker-1.1.6.min','jPicker')); ?>
<?php echo $this->Html->css("invalid");?>
<?php echo $javascript->link('jquery1.7'); ?>
<?php echo $javascript->link('simpla.jquery.configuration'); ?>
<?php echo $javascript->link('facebox'); ?>
<?php echo $javascript->link('jquery.wysiwyg'); ?>
<?php echo $javascript->link('jquery.datePicker'); ?>
<?php echo $javascript->link('jquery.date'); ?>

<?php echo $javascript->link('ckeditor/ckeditor'); ?>
<?php echo $javascript->link('ckfinder/ckfinder'); ?>
<?php echo $javascript->link('admin'); ?>
<?php echo $this->element('function'); ?>
<?php echo $this->element('define'); ?>
<script type="text/javascript">
$(document).ready(function(){ 	

	$(function() {
	$("#list ul").sortable({ opacity: 0.8, cursor: 'move', update: function() {
			
			var order = $(this).sortable("serialize") + '&update=update'; 
			$.post("", order, function(theResponse){
				$("#response").html(theResponse);
				$("#response").slideDown('slow');
				slideout();
			}); 															 
		}								  
		});
	});

});	
</script>
<?php echo $javascript->link('jquery-1.4.4.min'); ?>
<?php echo $javascript->link('jpicker-1.1.6.min'); ?>
  <script type="text/javascript">
    $(function()
      {
        $.fn.jPicker.defaults.images.clientPath='<?php echo DOMAINAD;?>images/';
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

<style>
   .jPicker table{
	   margin-top:100px;
	   }
	 #Binded{
		color:#000 !important; 
		 }
	.jPicker{
		margin-left:5px;
		}
</style>
</head>
<body>
      <div id="body-wrapper"> 
		<?php echo $this->element('sidebar'); ?>
		<div id="main-content"> 
			<noscript> 
				<div class="notification error png_bg">
					<div>
						
					</div>
				</div>
			</noscript>
			
			<?php echo $this->element('menu');?>
			
			<div class="clear"></div>
			<?php echo $content_for_layout; ?>
			
			<div id="footer">
				<small>
                	<?php echo $this->element('footer'); ?>
				</small>
			</div>
			
		</div> 
	</div>
    <?php echo $this->element('hotro'); ?>
</body>
</html>
