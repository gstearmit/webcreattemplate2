<?php echo $form->create(null, array( 'url' => DOMAINADESTORE.'advertisements/edit','type' => 'post','name' => 'adminForm', 'inputDefaults' => array('label' => false,'div' => false)));?>
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
                    <a href="<?php echo DOMAINADESTORE?>advertisements" class="toolbar">
                        <span class="icon-32-cancel"></span>
                       <?php __('Cancel')?>
                    </a>
                </li>
            </ul>
            <div class="clr"></div>
        </div>
		<div class="pagetitle icon-48-category-add"><h2><?php __('Advertisement')?></h2></div>
		<div class="clr"></div>
	</div>
</div>
<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        <h3> <?php __('Edit_advertisement')?> </h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab"><?php __('Edit_advertisement')?></a></li> <!-- href must be unique and match the id of target div -->
        </ul>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
        	<table class="input">
               	<tr>
                   	<td width="120" class="label"><?php __('Image_name')?>:</td>
                    <td>
                    <?php echo $this->Form->input('Advertisement.name',array('class'=>'text-input medium-input datepicker','maxlength' => '250','onchange' => 'get_alias()','id' => 'idtitle'));?>
                    <?php echo $this->Form->input('Advertisement.id',array());?>
                    </td>
                </tr>
                <tr>
                   	<td width="120" class="label"><?php __('Website_name')?>:</td>
                    <td>
                    <?php echo $this->Form->input('Advertisement.link',array('class'=>'text-input medium-input datepicker','maxlength' => '250','onchange' => 'get_alias()','id' => 'idtitle'));?>
                    </td>
                </tr>
                <tr>
                  	<td class="label"><?php __('Image')?>:</td>
                    <td>
                    <?php echo $this->Form->input('Advertisement.images',array('class'=>'text-input image-input datepicker','name' => 'userfile'));?> &nbsp;<font color="#FF0000"> <a href="javascript:window.open('<?php echo DOMAINADESTORE; ?>upslide.php','userfile','width=500,height=300');window.history.go(1)" >[ upload ]</a> </font><font color="#FF0000">*</font>(jpg, jpeg, gif, png)
                    
                    </td>
                </tr>
                <tr>
                  	<td class="label"><?php __('Ad_position')?>:</td>
                    <td>
                    
                    <label><?php __('Current_location')?>:</label> <?php 
							if($edit['Advertisement']['display']==0){?>
                            Chạy bên trái
                        <?php }?>
                        <?php 
							if($edit['Advertisement']['display']==1){?>
                            Chạy bên phải
                        <?php }?>
                        <?php 
							if($edit['Advertisement']['display']==2){?>
                            Sidebar bên trái
                        <?php }?>
                        <?php 
							if($edit['Advertisement']['display']==3){?>
                            Sidebar bên phải
                        <?php }?><br /><br /><br />
                        <label> Vị trí thay thế tại:</label>
                    <input type="radio" value="0" name="data[Advertisement][display]"  /> <?php __('Advertisement_running_in_the_left')?><br />
                    <input type="radio" value="1" name="data[Advertisement][display]"/> <?php __('Advertisement_running_in_the_right')?><br />
                    <input type="radio" value="2"  name="data[Advertisement][display]"/><?php __('Advertisement_in_the_left')?><br />
                    <input type="radio" value="3"  name="data[Advertisement][display]"/>  <?php __('Advertisement_in_the_right')?><br />
                    </td>
                </tr>
             <tr>
                  	<td class="label"><?php __('Status')?>:</td>
                    <td>
                    <input type="radio" value="0" id="AdvertisementStatus0" name="data[Advertisement][status]"> <?php __('Unactive')?>
                    	&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="1" id="AdvertisementStatus1" name="data[Advertisement][status]"> <?php __('Activated')?>
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
                    <a href="<?php echo DOMAINADESTORE?>advertisements" class="toolbar">
                        <span class="icon-32-cancel"></span>
                       <?php __('Cancel')?>
                    </a>
                </li>
            </ul>
            <div class="clr"></div>
        </div>
		<div class="pagetitle icon-48-category-add"><h2><?php __('Advertisement')?></h2></div>

		<div class="clr"></div>
	</div>
</div>
<?php echo $form->end(); ?>