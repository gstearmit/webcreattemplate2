<style>
tr{
height:15px;}

#profile_index {
    border: 1px solid #0066FF;
    border-radius: 8px 8px 8px 8px;
    color: #000000;
    font-size: 10pt;
    margin: 10px auto 20px;
    overflow: hidden;
    padding-bottom: 30px;
    width: 98%;
}
#profile_index table input {
    border: 1px solid #22A8E1;
}
#profile_index table a {
    color: #22A8E1;
}
#profile_index table {
    font-size: 12px;
    margin-left: 20px;
}
#profile_index .edit:hover{
    cursor:pointer;
}

</style>


 <style>
 p{text-align:justify;}
 
 </style>
 
 <?php echo $html->css('classifiedss'); ?>

  
<script language="JavaScript">
function confirmDelete(delUrl)
{
if (confirm("Bạn có muốn xóa danh mục này không!"))
{
	document.location = delUrl;
}
}
</script>
<?php echo $html->css('classifiedss'); ?>


<div id="main-content">
	 
	 <div class="content-top">
	 <?php echo $this->element('menu_top');?>
	 <div class="content-top-body">
	 
<div class="member_register">
	<?php echo $this->element('shopleft');?>
	<div class="right" style="border-radius: 6px 6px 6px 6px;">
	<div id="classifieds">
	<div id="title-1">Tài khoản cá nhân</div>
			
   <div id="text-main">
	<?php echo $form->create(null, array( 'url' => DOMAIN.'userscms/change_pass','type' => 'post')); ?>	
    <div id="profile_index">
    <table>
        <tr><td  style="padding:20px; padding-left:200px;"colspan="2"><h3>Thay đổi Password</h3></td></tr>
        
        <tr>
            <td>Email </td>
            <td >
            
            <?php echo $this->Form->input('Userscms.email',array('label'=>'','value'=>$edit['Userscms']['email'],'readonly'=>'true','style'=>'width:250px;height:25px;'));?>
            </td>
        </tr>
        <tr height="25"></tr>
        <tr>
            <td>Mật khẩu cũ</td>
            <td>
            
            <?php echo $this->Form->input('Userscms.password_old',array('label'=>'','type'=>'password','style'=>'width:250px;height:25px;'));?>
            </td>
        </tr>
        <tr height="25"></tr>
        <tr>
            <td>Mật khẩu mới</td>
            <td>
            
            <?php echo $this->Form->input('Userscms.password',array('label'=>'','type'=>'password','style'=>'width:250px;height:25px;'));?>
            </td>
        </tr>
        <td>
             <?php echo $this->Form->input('Userscms.id',array('label'=>'','value'=>$edit['Userscms']['id'],'typy'=>'hidden'));?>
        </td></tr>
        <tr>
            <td style="padding-left:140px; padding-top:10px;" colspan="2">
			<input class="edit" type="submit" value="Thay đổi" />
			
			</td>
        </tr>
    </table>
    </div>
  <?php echo $form->end(); ?>
 </div>
</div>
	 </div>
	 </div>
	 </div>
	 
	 		
	</div><!-- End content-top-body -->
	</div><!-- End content-top -->
	 
	 
	 </div><!-- ENd main content -->





  






