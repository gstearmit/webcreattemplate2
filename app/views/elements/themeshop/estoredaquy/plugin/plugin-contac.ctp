<?php echo $this->Html->css('validationEngine.jquery');?>
<script type="text/javascript" src="<?php echo DOMAIN;?>js/jquery.validationEngine.js"></script>
<script>
  $(document).ready(function(){
    $("#check_form").validationEngine();
  });
</script>
 <style>
    #input{
		width:250px;
		border: 1px solid #C2C2C2;
		height:22px;
		}
   .guimail tr td{
	   padding-top:10px;
	   padding-right:20px;
	   }
	.guimail textarea{
		border: 1px solid #C2C2C2;
		}
</style>
<form method="post" id="check_form" action="<?php echo DOMAIN; ?>contacts/send">
    <table class="guimail">
        <tr><td>Tên </td><td><input id="input" name="name" class="validate[required]" type="text"></td></tr>
        <tr><td>Điện thoại</td><td><input id="input" type="text" class="validate[required,custom[telephone]]" name="phone"></td></tr>
        <tr><td>Email</td><td><input id="input" type="text" name="email"></td></tr>
        <tr><td>Tiêu đề</td><td><input id="input" type="text" class="validate[required]" name="title"></td></tr>
        <tr><td>Nôi dung</td><td><textarea name="content" cols="50" rows="10"></textarea></td></tr>
        <tr><td></td><td><input type="submit" value=" Gửi đi ">&nbsp;<input type="reset" value=" Soạn lai "></td></tr>
    </table>
</form>