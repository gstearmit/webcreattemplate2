<?php echo $form->create(null, array( 'url' => DOMAINAD.'partners/edit','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?> 
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
                       <?php __('Save')?>
					</a>
                </li>
                <li id="toolbar-refresh">
                    <a href="javascript:void(0);" class="toolbar" onclick="javascript:document.image.reset();">
                    <span class="icon-32-refresh">
                    </span>
                   <?php __('Reset')?>
                    </a>
                </li>
                <li class="divider"></li>
                <li id="toolbar-help">
                    <a href="#messages" rel="modal" class="toolbar">
                        <span class="icon-32-help"></span>
                       <?php __('Help')?>
                    </a>
                </li>
                <li id="toolbar-unpublish">
                    <a href="<?php echo DOMAINAD?>partners" class="toolbar">
                        <span class="icon-32-cancel"></span>
                        <?php __('Cancel')?>
                    </a>
                </li>
            </ul>
            <div class="clr"></div>
        </div>
		<div class="pagetitle icon-48-category-add"><h2><?php __('Partners')?></h2></div>
		<div class="clr"></div>
	</div>
</div>
<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        <h3><?php __('Edit')?></h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab"><?php __('Edit')?></a></li> <!-- href must be unique and match the id of target div -->
        </ul>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
        	<table class="input">
               	<tr>
                   	<td width="120" class="label"><?php __('Partner_name')?>:</td>
                    <td>
                    <?php echo $this->Form->input('Partner.name',array('class'=>'text-input medium-input datepicker','maxlength' => '250','onchange' => 'get_alias()','id' => 'idtitle'));?>
                     <?php echo $this->Form->input('Partner.id',array());?>
                    </td>
                </tr>
                <tr>
                   	<td width="120" class="label"><?php __('Telephone_number')?>:</td>
                    <td>
                    <?php echo $this->Form->input('Partner.phone',array('class'=>'text-input medium-input datepicker','maxlength' => '250','onchange' => 'get_alias()','id' => 'idtitle'));?>
                    </td>
                </tr>
                <tr>
                   	<td width="120" class="label"><?php __('Email')?>:</td>
                    <td>
                    <?php echo $this->Form->input('Partner.email',array('class'=>'text-input medium-input datepicker','maxlength' => '250','onchange' => 'get_alias()','id' => 'idtitle'));?>
                    </td>
                </tr>
                <tr>
                   	<td width="120" class="label"><?php __('Address')?>:</td>
                    <td>
                    <?php echo $this->Form->input('Partner.address',array('class'=>'text-input medium-input datepicker','maxlength' => '250','onchange' => 'get_alias()','id' => 'idtitle'));?>
                    </td>
                </tr>
                <tr>
                   	<td width="120" class="label"><?php __('Website')?>:</td>
                    <td>
                    <?php echo $this->Form->input('Partner.website',array('class'=>'text-input medium-input datepicker','maxlength' => '250','onchange' => 'get_alias()','id' => 'idtitle'));?>
                    </td>
                </tr>
                <tr>
                  	<td class="label"><?php __('Image')?>:</td>
                    <td>
                    <input type="text" size="50" style="height:25px;"  value="<?php echo $edit['Partner']['images']?>" name="userfile" readonly="true"> &nbsp; <a href="javascript:window.open('<?php echo DOMAINAD; ?>gallery.php','userfile','width=500,height=300');window.history.go(1)" ><input type="button" value="<?php __('Select_image')?>" class="button" /></a>
                    	
                    </td>
                </tr>
             <tr>
                  	<td class="label"><?php __('Status')?>:</td>
                    <td>
                    <input type="radio" value="0" id="PartnerStatus0" name="data[Partner][status]"> <?php __('Unactive')?>
                    	&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="1" id="PartnerStatus1" name="data[Partner][status]"><?php __('Activated')?>
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
                         <?php __('Save')?>
					</a>
                </li>
                <li id="toolbar-refresh">
                    <a href="javascript:void(0);" class="toolbar" onclick="javascript:document.image.reset();">
                    <span class="icon-32-refresh">
                    </span>
                    <?php __('Reset')?>
                    </a>
                </li>
                <li class="divider"></li>
                <li id="toolbar-help">
                    <a href="#messages" rel="modal" class="toolbar">
                        <span class="icon-32-help"></span>
                       <?php __('Help')?>
                    </a>
                </li>
                <li id="toolbar-unpublish">
                    <a href="<?php echo DOMAINAD?>partners" class="toolbar">
                        <span class="icon-32-cancel"></span>
                        <?php __('Cancel')?>
                    </a>
                </li>
            </ul>
            <div class="clr"></div>
        </div>
		<div class="pagetitle icon-48-category-add"><h2><?php __('Partners')?></h2></div>

		<div class="clr"></div>
	</div>
</div>
<?php echo $form->end(); ?>