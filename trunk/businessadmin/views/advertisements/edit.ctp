<?php echo $form->create(null, array( 'url' => DOMAINAD.'advertisements/edit','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?> 
<br />  
<?php
	//echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
?>
<div id="khung">
	<div id="main">
		<div class="toolbar-list" id="toolbar">
			<ul>
				<li id="toolbar-new">
					<a href="javascript:void(0);" onclick="javascript:document.image.submit();" class="toolbar">
                        <span class="icon-32-save"></span>
                        Lưu
					</a>
                </li>
                <li id="toolbar-refresh">
                    <a href="javascript:void(0);" class="toolbar" onclick="javascript:document.image.reset();">
                    <span class="icon-32-refresh">
                    </span>
                    Reset
                    </a>
                </li>
                <li class="divider"></li>
                <li id="toolbar-help">
                    <a href="#messages" rel="modal" class="toolbar">
                        <span class="icon-32-help"></span>
                        Trợ giúp
                    </a>
                </li>
                <li id="toolbar-unpublish">
                    <a href="<?php echo DOMAINAD?>advertisements" class="toolbar">
                        <span class="icon-32-cancel"></span>
                        Hủy
                    </a>
                </li>
            </ul>
            <div class="clr"></div>
        </div>
		<div class="pagetitle icon-48-category-add"><h2>Download</h2></div>
		<div class="clr"></div>
	</div>
</div>
<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        <h3>Download</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Download</a></li> <!-- href must be unique and match the id of target div -->
        </ul>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
        	<table class="input">
               	<tr>
                   	<td width="120" class="label">Tên :</td>
                    <td>
                    <?php echo $this->Form->input('Advertisement.name',array('class'=>'text-input medium-input datepicker','maxlength' => '250','onchange' => 'get_alias()','id' => 'idtitle'));?>
                    <?php echo $this->Form->input('Advertisement.id',array());?>
                    </td>
                </tr>
                <tr>
                  	<td class="label">Banner:</td>
                    <td>
                     <input type="text" size="50" style="height:25px;"  value="<?php echo $edit['Advertisement']['images']?>" name="userfile" readonly="true"> &nbsp;<a href="javascript:window.open('<?php echo DOMAINAD; ?>data.php','userfile','width=500,height=300');window.history.go(1)" ><input type="button" value="Chọn ảnh" class="button" /></a>
                    	
                    </td>
                </tr>
                <tr>
                  	<td class="label">Vị trí quảng cáo:</td>
                    <td>
                    <input type="radio" value="0" <?php if($this->data['Advertisement']['display'] == 0 ) echo "checked='checked'"; ?> id="AdvertisementDisplay0" name="data[Advertisement][display]"> Quảng cáo trái
                    	&nbsp;&nbsp;&nbsp;<input type="radio" <?php if($this->data['Advertisement']['display'] == 1 ) echo "checked='checked'"; ?> value="1" id="AdvertisementDisplay1" name="data[Advertisement][display]"> Quảng cáo phải
                    </td>
                </tr>
                <tr>
         
                  	<td class="label">Trang thái:</td>
                    <td>
                    <input type="radio" value="0" id="AdvertisementStatus0" name="data[Advertisement][status]"> Chưa Active 
                    	&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="1" id="AdvertisementStatus1" name="data[Advertisement][status]"> Đã Active
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
					<a href="javascript:void(0);" onclick="javascript:document.image.submit();" class="toolbar">
                        <span class="icon-32-save"></span>
                        Lưu
					</a>
                </li>
                <li id="toolbar-refresh">
                    <a href="javascript:void(0);" class="toolbar" onclick="javascript:document.image.reset();">
                    <span class="icon-32-refresh">
                    </span>
                    Reset
                    </a>
                </li>
                <li class="divider"></li>
                <li id="toolbar-help">
                    <a href="#messages" rel="modal" class="toolbar">
                        <span class="icon-32-help"></span>
                        Trợ giúp
                    </a>
                </li>
                <li id="toolbar-unpublish">
                    <a href="<?php echo DOMAINAD?>advertisements" class="toolbar">
                        <span class="icon-32-cancel"></span>
                        Hủy
                    </a>
                </li>
            </ul>
            <div class="clr"></div>
        </div>
		<div class="pagetitle icon-48-category-add"><h2>Download</h2></div>

		<div class="clr"></div>
	</div>
</div>
<?php echo $form->end(); ?>