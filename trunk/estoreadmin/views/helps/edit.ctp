<?php echo $form->create(null, array( 'url' => DOMAINADESTORE.'helps/edit','type' => 'post','name' => 'adminForm', 'inputDefaults' => array('label' => false,'div' => false)));?>
<br />  
<?php
	//echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
?>
<div id="khung">
	<div id="main">
	
		<div class="pagetitle icon-48-category-add"><h2><?php __('Hotline_change')?></h2></div>
		<div class="clr"></div>
	</div>
</div>
<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        <h3><?php __('Hotline_change')?></h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab"><?php __('Edit')?></a></li> <!-- href must be unique and match the id of target div -->
        </ul>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
        	<table class="input">
               	<tr>
                       <td width="120" class="label"><?php __('Title')?>:</td>
	                    <td>
							<?php echo $this->Form->input('Help.title',array('class'=>'text-input medium-input datepicker','maxlength' => '250','onchange' => 'get_alias()','id' => 'idtitle'));?>
							<?php echo $this->Form->input('Help.id',array());?>                   	
				      </td>
                </tr>
             	<tr>
                   	<td width="120" class="label"><?php __('Name_support')?>:</td>
                    <td>
                    	<?php echo $this->Form->input('Help.user_support',array('class'=>'text-input medium-input datepicker','maxlength' => '250','onchange' => 'get_alias()','id' => 'idtitle'));?>
                    </td>
                </tr>
                <tr>
                  	<td class="label"><?php __('Yahoo_name')?></td>
                    <td>
                     <?php echo $this->Form->input('Help.user_yahoo',array('class'=>'text-input medium-input datepicker','maxlength' => '250','onchange' => 'get_alias()','id' => 'idtitle'));?>
                    </td>
                </tr>               
                <tr>
                  	<td class="label"><?php __('Skype_name')?>:</td>
                    <td>
                     <?php echo $this->Form->input('Help.user_skype',array('class'=>'text-input medium-input datepicker','maxlength' => '250','onchange' => 'get_alias()','id' => 'idtitle'));?>
                    </td>
                </tr>
                <tr>
                  	<td class="label"><?php __('Telephone_number')?>:</td>
                    <td>
                     <?php echo $this->Form->input('Help.user_mobile',array('class'=>'text-input medium-input datepicker','maxlength' => '250','onchange' => 'get_alias()','id' => 'idtitle'));?>
                    </td>
                </tr>
                <tr>
                  	<td class="label"><?php __('Email')?>:</td>
                    <td>
                     <?php echo $this->Form->input('Help.user_email',array('class'=>'text-input medium-input datepicker','maxlength' => '250','onchange' => 'get_alias()','id' => 'idtitle'));?>
                    </td>
                </tr>
             <tr>
                  	<td class="label"><?php __('Status')?>:</td>
                    <td>
                    <input type="radio" value="0" id="HelpStatus0" name="data[Help][status]"><?php __('Unactive')?>
                    	&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="1" id="HelpStatus1" name="data[Help][status]"> <?php __('Activated')?>
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
                       <?php __('Save')?>
					</a>
                </li>
                
                <li id="toolbar-unpublish">
                    <a href="<?php echo DOMAINADESTORE?>" class="toolbar">
                        <span class="icon-32-cancel"></span>
                        <?php __('Close')?>
                    </a>
                </li>
            </ul>
            <div class="clr"></div>
        </div>
		<div class="pagetitle icon-48-category-add"><h2><?php __('Hotline_management')?></h2></div>

		<div class="clr"></div>
	</div>
</div>
<?php echo $form->end(); ?>