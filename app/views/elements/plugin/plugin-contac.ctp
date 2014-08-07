<?php 
			
			$shop=explode('/',$this->params['url']['url']); 
			$shopname=$shop[0];
				$shop=$this->requestAction('comment/get_shop_id/'.$shopname);
				
				
				foreach($shop as $key=>$value){
				$shop_id=$key;
				}
			
?>
<?php echo $this->Html->css('validationEngine.jquery');?>
<script type="text/javascript" src="<?php echo DOMAIN;?>js/jquery.validationEngine.js"></script>
<script>
  $(document).ready(function(){
    $("#check_form").validationEngine();
  });
</script>

 <?php // if($session->read('lang')==1){?>
 <br /><br /><br />
<form method="post" id="check_form" action="<?php echo DOMAIN.$shopname; ?>/sendcontacts" style=";">
    <table class="guimail" align="left" width="600px">
        <tr><td>Tên </td><td><input size="40" id="input" name="name" class="validate[required]" type="text"></td></tr>
        <tr><td>Điện thoại</td><td><input size="40" id="input" type="text" class="validate[required,custom[telephone]]" name="phone"></td></tr>
        <tr><td>Email</td><td><input size="40" id="input" type="text"  class="validate[required,custom[email]]" name="email"></td></tr>
        <tr><td>Tiêu đề</td><td><input size="40" id="input" type="text" class="validate[required]" name="title"></td></tr>
        <tr><td>Nôi dung</td><td><textarea name="content" cols="45" rows="10"></textarea></td></tr>
        <tr><td></td><td><input type="submit" value=" Gửi đi ">&nbsp;<input type="reset" value=" Soạn lại "></td></tr>
    </table>
</form>
 <?php //}
 if($session->read('lang')==2){?>
 <form method="post" id="check_form" action="<?php echo DOMAIN; ?>contacts/send">
    <table class="guimail" align="left" width="600px">
        <tr><td>Full name</td><td><input id="input" name="name" class="validate[required]" type="text"></td></tr>
        <tr><td>Phone</td><td><input id="input" type="text" class="validate[required,custom[telephone]]" name="phone"></td></tr>
        <tr><td>Email</td><td><input id="input" type="text"  class="validate[required,custom[email]]" name="email"></td></tr>
        <tr><td>Title</td><td><input id="input" type="text" class="validate[required]" name="title"></td></tr>
        <tr><td>Content</td><td><textarea name="content" cols="45" rows="10"></textarea></td></tr>
        <tr><td></td><td><input type="submit" value=" Send ">&nbsp;<input type="reset" value=" Reset "></td></tr>
    </table>
</form>
 <?php }?>