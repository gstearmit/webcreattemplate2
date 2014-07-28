<?php echo $form->create(null, array( 'url' => DOMAINAD.'helps/edit','type' => 'post','name' => 'adminForm', 'inputDefaults' => array('label' => false,'div' => false)));?>
<br />  
<?php
	//echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
?>
<div id="khung">
	<div id="main">
	
		<div class="pagetitle icon-48-category-add"><h2>Chỉnh sửa hotline</h2></div>
		<div class="clr"></div>
	</div>
</div>
<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        <h3> Hot line </h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Sửa</a></li> <!-- href must be unique and match the id of target div -->
        </ul>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
        	<table class="input">
               	<tr>
                       <td width="120" class="label">Tiêu đề:</td>
	                    <td>
							<?php echo $this->Form->input('Help.title',array('class'=>'text-input medium-input datepicker','maxlength' => '250','onchange' => 'get_alias()','id' => 'idtitle'));?>
							<?php echo $this->Form->input('Help.id',array());?>                   	
				      </td>
                </tr>
             	<tr>
                   	<td width="120" class="label">Tên người hỗ trợ:</td>
                    <td>
                    	<?php echo $this->Form->input('Help.user_support',array('class'=>'text-input medium-input datepicker','maxlength' => '250','onchange' => 'get_alias()','id' => 'idtitle'));?>
                    </td>
                </tr>
                <tr>
                  	<td class="label">Tên Yahoo</td>
                    <td>
                     <?php echo $this->Form->input('Help.user_yahoo',array('class'=>'text-input medium-input datepicker','maxlength' => '250','onchange' => 'get_alias()','id' => 'idtitle'));?>
                    </td>
                </tr>               
                <tr>
                  	<td class="label">Tên Skype:</td>
                    <td>
                     <?php echo $this->Form->input('Help.user_skype',array('class'=>'text-input medium-input datepicker','maxlength' => '250','onchange' => 'get_alias()','id' => 'idtitle'));?>
                    </td>
                </tr>
                <tr>
                  	<td class="label">Điện thoại:</td>
                    <td>
                     <?php echo $this->Form->input('Help.user_mobile',array('class'=>'text-input medium-input datepicker','maxlength' => '250','onchange' => 'get_alias()','id' => 'idtitle'));?>
                    </td>
                </tr>
                <tr>
                  	<td class="label">Email:</td>
                    <td>
                     <?php echo $this->Form->input('Help.user_email',array('class'=>'text-input medium-input datepicker','maxlength' => '250','onchange' => 'get_alias()','id' => 'idtitle'));?>
                    </td>
                </tr>
             <tr>
                  	<td class="label">Trang thái:</td>
                    <td>
                    <input type="radio" value="0" id="HelpStatus0" name="data[Help][status]"> Chưa Active 
                    	&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="1" id="HelpStatus1" name="data[Help][status]"> Đã Active
                    </td>
                </tr>
               
            </table>
			<div class="clear"></div>
        </div> <!-- End #tab1 -->
        <div class="tab-content" id="tab2">
			<div class="clear"></div><!-- End .clear -->
        </div> <!-- End #tab2 -->        
    </div> <!-- End .content-box-content -->
 </div>
 
<div id="khung">
	<div id="main">
		<div class="toolbar-list" id="toolbar">
			<ul>
				<li id="toolbar-new">
					<a href="javascript:void(0);" onclick="javascript:document.adminForm.submit();" class="toolbar">
                        <span class="icon-32-save"></span>
                        Lưu
					</a>
                </li>
                
                <li id="toolbar-unpublish">
                    <a href="<?php echo DOMAINAD?>" class="toolbar">
                        <span class="icon-32-cancel"></span>
                        Thoát
                    </a>
                </li>
            </ul>
            <div class="clr"></div>
        </div>
		<div class="pagetitle icon-48-category-add"><h2>Quản lý hotline</h2></div>

		<div class="clr"></div>
	</div>
</div>
<?php echo $form->end(); ?>