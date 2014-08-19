<br />
<?php echo $form->create(null, array( 'url' => DOMAINAD.'bgmenu/edit','type' => 'post','name' => 'adminForm', 'inputDefaults' => array('label' => false,'div' => false)));?>	   
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
                <li id="toolbar-refresh">
                    <a href="javascript:void(0);" class="toolbar" onclick="javascript:document.adminForm.reset();">
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
                    <a href="<?php echo DOMAINAD?>bgmenu" class="toolbar">
                        <span class="icon-32-cancel"></span>
                        Hủy
                    </a>
                </li>
            </ul>
            <div class="clr"></div>
        </div>
		<div class="pagetitle icon-48-category-add"><h2>Cài đặt Bgmenu</h2></div>
		<div class="clr"></div>
	</div>
</div>
<div class="content-box">
    <div class="content-box-header">
        <h3>Thêm mới danh mục</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1"></a></li> 
            <li><a href="#tab2" class="default-tab">Cài đặt</a></li>
        </ul>
        <div class="clear"></div>
    </div> 
    <div class="content-box-content">
        <div class="tab-content" id="tab1"> 
        </div>
        <div class="tab-content default-tab" id="tab2">   
            <table class="input">
               	<tr>
                   	<td width="120" class="label">Bgmenu</td>
                    <td>
                     <?php echo $this->Form->input('Bgmenu.images',array('class'=>'text-input image-input datepicker','id' => 'xFilePath'));?>
                    	<input type="button" value="Chọn ảnh" onclick="BrowseServer();" class="button" />
                    </td>
                </tr>
                <tr>
                  	<td class="label">Mã mầu:</td>
                    <td>
                       <p class="fieldValue" style="color:#000 !important;">
                       <span id="jPicker">
							<?php echo $this->Form->input('Bgmenu.color',array('class'=>'text-input medium-input datepicker','label'=>'','id' => 'Binded'));?>
                       </span>
                       </p>
                    </td>
                </tr>
                <tr>
                  	<td class="label">Width ( px , % ):</td>
                    <td>
						<?php echo $this->Form->input('Bgmenu.width',array('class'=>'text-input medium-input','label'=>''));?>
                    </td>
                </tr>
                <tr>
                  	<td class="label">Height ( px , % ):</td>
                    <td>
						<?php echo $this->Form->input('Bgmenu.height',array('class'=>'text-input medium-input','label'=>''));?>
                    </td>
                </tr>
                
                <tr class="display_background">
                  	<td class="label">Trạng thái</td>
                    <td>
                    <?php echo $form->radio('Bgmenu.status', array(0 => 'Chưa Active', 1 => 'Đã Active'), array('value' => '1','legend'=>'')); ?>  
					</td>
                </tr>
               
            </table>
			<div class="clear"></div>
        </div>
    </div>
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
                <li id="toolbar-refresh">
                    <a href="javascript:void(0);" class="toolbar" onclick="javascript:document.adminForm.reset();">
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
                    <a href="<?php echo DOMAINAD?>bgmenu" class="toolbar">
                        <span class="icon-32-cancel"></span>
                        Hủy
                    </a>
                </li>
            </ul>
            <div class="clr"></div>
        </div>
		<div class="clr"></div>
	</div>
</div> 
<?php echo $form->end(); ?>