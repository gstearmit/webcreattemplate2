<?php echo $form->create(null, array( 'url' => DOMAINAD.'settings/edit','type' => 'post','name' => 'adminForm', 'inputDefaults' => array('label' => false,'div' => false)));?>
<br />  
<?php
	//echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
?>
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
                <li id="toolbar-refresh">
                    <a href="javascript:void(0);" class="toolbar" onclick="javascript:document.adminForm.reset();">
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
                    <a href="<?php echo DOMAINAD?>settings" class="toolbar">
                        <span class="icon-32-cancel"></span>
                       <?php __('Cancel')?>
                    </a>
                </li>
            </ul>
            <div class="clr"></div>
        </div>
		<div class="pagetitle icon-48-category-add"><h2><?php __('Website_configuration')?></h2></div>
		<div class="clr"></div>
	</div>
</div>
<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        <h3>Cấu hình</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab"><?php __('Vietnamese')?></a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2"><?php __('English')?></a></li>
        </ul>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
        	<table class="input">
               	<tr>
                   	<td width="120" class="label"><?php __('Company_name')?>:</td>
                    <td>
                    <?php echo $form->input('Setting.name',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    <?php echo $form->input('Setting.id',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </td>
                </tr>
                <tr>
                  	<td class="label"><?php __('Address')?>:</td>
                    <td>
                     <?php echo $form->input('Setting.address',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </td>
                </tr>
                <tr>
                  	<td class="label"><?php __('Telephone_number')?>:</td>
                    <td>
					   <?php echo $form->input('Setting.phone',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>  
					</td>
                </tr>
                <tr>
                  	<td class="label"><?php __('Mobile')?>:</td>
                    <td>
                       <?php echo $form->input('Setting.mobile',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </td>
                </tr>
                <tr>
                  	<td class="label"><?php __('Email')?>:</td>
                    <td>
                    <?php echo $form->input('Setting.email',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </td>
                </tr>
                <tr>
                  	<td class="label"><?php __('Link Website')?>:</td>
                    <td>
                    <?php echo $form->input('Setting.url',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </td>
                </tr>
                <tr>
                  	<td class="label"><?php __('Website_title')?>:</td>
                    <td>
                    <?php echo $form->input('Setting.title',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </td>
                </tr>
                <tr>
                  	<td class="label"><?php __('Status')?>:</td>
                    <td>
                    <input type="radio" value="0" id="NewsStatus0" name="data[News][status]"> <?php __('Unactive')?>
                    	&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="1" id="NewsStatus1" name="data[News][status]"> <?php __('Activated')?>
                    </td>
                </tr>
                <tr>
                	<td class="label"><?php __('About_Us')?></td>
                	<td>
                    <?php  echo $this->Form->input('introduction',array('label' => '','type'=>'textarea')).$this->TvFck->create('Setting.introduction',array('toolbar'=>'extra','skin'=>'kama','height'=>'200px','width'=>'98%')); ?>
                    </td>
                </tr>
                <tr>
                	<td class="label"><?php __('Footer')?></td>
                	<td>
                    <?php  echo $this->Form->input('content',array('label' => '','type'=>'textarea')).$this->TvFck->create('Setting.content',array('toolbar'=>'extra','skin'=>'kama','height'=>'200px','width'=>'98%')); ?>
                    </td>
                </tr>
                <tr>
                  	<td class="label"><?php __('Keyword')?> (SEO):</td>
                    <td>
                    <?php  echo $this->Form->input('keyword',array('type'=>'textarea','rows' => '2')); ?>
                    </td>
                </tr>
                <tr>
                  	<td class="label"><?php __('Description')?> (SEO):</td>
                    <td>
                    <?php  echo $this->Form->input('description',array('type'=>'textarea','rows' => '2')); ?>
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
                <li id="toolbar-refresh">
                    <a href="javascript:void(0);" class="toolbar" onclick="javascript:document.adminForm.reset();">
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
                    <a href="<?php echo DOMAINAD?>settings" class="toolbar">
                        <span class="icon-32-cancel"></span>
                       <?php __('Cancel')?>
                    </a>
                </li>
            </ul>
            <div class="clr"></div>
        </div>
		<div class="pagetitle icon-48-category-add"><h2><?php __('Website_configuration')?></h2></div>
		<div class="clr"></div>
	</div>
</div>
<?php echo $form->end(); ?>