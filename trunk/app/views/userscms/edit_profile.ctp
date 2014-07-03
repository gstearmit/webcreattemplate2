<style>
  #uploadcontent {
    color: #333333;
    height: 20px;
	float:right;
    width: 372px;
}
#uploadcontent a {
    color: #258294;
    text-decoration: none;
}

.right table span{
	padding-left:0px !important;
	padding-top:4px;
	}
	input{padding:2px;}
h3.page-title, h2.title-backend {
    border-bottom: 1px solid #EA6F1F;
    color: #222222;
    font-size: 18px;
    font-weight: normal;
    margin-bottom: 20px;
    padding-bottom: 8px;
    
    text-transform: uppercase;
}
td{padding-top:5px;}
.text{width:200px;}
</style>
<?php echo $javascript->link('jquery.validate', true); ?>
<script type="text/javascript" src="<?php echo DOMAIN;?>js/jquery.datepick.js"></script>
<script type="text/javascript" src="<?php echo DOMAIN;?>js/checkform.js"></script>
<script>
function reload()
{
	var random1= Math.random()*5
	jQuery.ajax({
		type: "GET", 
		url: "<?php echo DOMAIN;?>"+'userscms/create_image1/'+random1,
		data: null,
		success: function(msg){	
		jQuery('#abc').find('img').remove().end();
		 jQuery('#abc').append('<img alt="" id="captcha" src="<?php echo DOMAIN?>userscms/create_image1/'+random1+'" />');				
		}
	});	
}


$(function() {
	$('.popupDatepicker').datepick();
	
});



</script>

 <style>
 p{text-align:justify;}
 
 </style>
 
  <link type="text/css" href="<?php echo DOMAIN ?>css/jquery.datepick.css" rel="stylesheet" /> 
 <link type="text/css" href="<?php echo DOMAIN ?>css/content.css" rel="stylesheet" /> 
  <link type="text/css" href="<?php echo DOMAIN ?>css/phantrang.css" rel="stylesheet" /> 
  <?php echo $html->css('classifiedss'); ?>
 
  
 <div id="main-content">
	 
	 <div class="content-top">
	 <?php echo $this->element('menu_top');?>
	 <div class="content-top-body">
	 		<form method="post" action="<?php echo DOMAIN?>userscms/edit_profile"  id="myform" name="image" enctype="multipart/form-data">
<div class="member_register">
            	
                	<?php echo $this->element('shopleft');?>
            
                <div class="right">
				<div id="classifieds">
	<div id="title-1">Thông tin tài khoản</div>
                	
                    <table>
                    	<tr>
                        	<td align="left" width="35%" valign="top" style="padding-top:6px;">
								Tên đăng nhập <font color="red">(*)</font>
							</td>
                            <td align="left" width="70%">
							<?php echo $edit['Userscms']['shopname'];
                            	  echo $form->input('Userscms.shopname',array('value'=>$edit['Userscms']['shopname'],'label'=>'','type'=>'hidden','style'=>'width:200px;'));
								  
								   echo $form->input('Userscms.id',array('value'=>$edit['Userscms']['id'],'label'=>'','type'=>'hidden','style'=>'width:200px;'));?>
           
							
          
								
							</td>
                        </tr>
						<?php 
                         echo $form->input('Userscms.password',array('value'=>$edit['Userscms']['password'],'label'=>'','type'=>'hidden','style'=>'width:200px;'));?>
          
                        </tr>
                       <tr>
                        	<td align="left">
								Địa chỉ email<font color="red">(*)</font>
							</td>
                            <td>
                            	<?php echo $edit['Userscms']['email']?>
                            	  <input class="text" type="hidden" value="<?php echo $edit['Userscms']['email']?>" name="email"/>
							
                            </td>
                        </tr>
					   
                        <tr>
                        	<td align="left">
								Họ tên<font color="red">(*)</font>
							</td>
                            <td>
							 <input class="text" type="text" value="<?php echo $edit['Userscms']['name']?>" name="name"/>
							
                            	</td>
                        </tr>
                        
						<tr>
                        	<td align="left">
								Số điện thoại
							</td>
                            <td>
                            		<?php 
                            	  echo $form->input('Userscms.phone',array('value'=>$edit['Userscms']['phone'],'label'=>'','type'=>'text','style'=>'width:200px;'));?>
            </td>
                        </tr>
                        <tr>
                        	<td align="left">
								Nick Yahoo
							</td>
                            <td>
                            <?php 
                            	  echo $form->input('Userscms.yahoo',array('value'=>$edit['Userscms']['yahoo'],'label'=>'','type'=>'text','style'=>'width:200px;'));?>
               </td>
                        </tr>
                        <tr>
                        	<td align="left">
								Nick Skype
							</td>
                            <td>
                            	<?php 
                            	  echo $form->input('Userscms.skype',array('value'=>$edit['Userscms']['skype'],'label'=>'','type'=>'text','style'=>'width:200px;'));?>
           </td>
                        </tr>
                        <tr>
                        	<td align="left">
								Giới tính
							</td>
                            <td>
                            	<select size="1" name="sex" id="sex" title="Giơi thính" style="width:123px;margin-left:10px;">
								
									<?php if($edit['Userscms']['sex']==1){?>
									 <option value="1" title="Nam">Nam</option>
                                    <option value="0" title="Nữ">Nữ</option>
                                   
									
									<?php } else{?>
									<option value="0" title="Nữ">Nữ</option>
									 <option value="1" title="Nam">Nam</option>
                                    
									<?php }?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                        	<td align="left">
								Ngày sinh
							</td>
                            <td>
                             <?php
                          	   $date=date('d-m-Y');
                       		 ?>
                          <input type="text" value="<?php echo $edit['Userscms']['birth_date'];?>" name="date" class="popupDatepicker datepicker" style="width:200px;"/>
                            </td>
                        </tr>
                        <tr>
                        	<td align="left">
								Tỉnh/TP
							</td>
                            <td>
                            	<select name="city" id="tinhthanh" style="margin-left:10px;">
                                    <option value="<?php echo $edit['Userscms']['city'];?>">  
									<?php $city1=$this->requestAction('userscms/get_namecity/'.$edit['Userscms']['city']);
									foreach($city1 as $row){
									echo $row['City']['name'];
									}
									?>
									</option>
                                    <?php foreach($city as $citys){
									if($citys['City']['id'] !=$edit['Userscms']['city'] ){
									?>
                                     <option value="<?php echo $citys['City']['id'];?>"><?php echo $citys['City']['name'];?></option>
                                    <?php } }?>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <table width="400" align="center" style="padding-top:20px;margin:auto;">
						
						<tr>
							<td align="left" width="35%">
								Nhập mã an toàn 
								<input type="text" style="width: 100px;" class="textField" name="security" id="security">
							</td>	
							<td align="left" width="65%">
                              <a id="abc">
                               <img alt="" id="captcha" src="<?php echo DOMAIN?>userscms/create_image" /></a1>&nbsp;&nbsp;<a href="javascript: reload()"><img src="<?php echo DOMAIN?>images/change-image.gif"/>
                             </a>
							</td>
						</tr>
						<tr>
							<td colspan="2" align="center">
                            	<br />
                            	<input type="submit" name="btsub" value=" Sửa " />
							</td>
						</tr>
					</table>
                </div>
                <div class="clr"></div>
            </div>
</form>
	 </div>
	 		
	</div><!-- End content-top-body -->
	</div><!-- End content-top -->
	 
	 
	 </div><!-- ENd main content -->





