<?php echo $form->create(null, array( 'url' => DOMAINADESTORE.'settings/edit','type' => 'post','name' => 'adminForm', 'inputDefaults' => array('label' => false,'div' => false)));?>
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
                    <a href="<?php echo DOMAINADESTORE?>settings" class="toolbar">
                        <span class="icon-32-cancel"></span>
                        Hủy
                    </a>
                </li>
            </ul>
            <div class="clr"></div>
        </div>
		<div class="pagetitle icon-48-category-add"><h2>Cấu hình website</h2></div>
		<div class="clr"></div>
	</div>
</div>
<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        <h3>Thông tin liên hệ</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Tiếng việt</a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2">Tiếng anh</a></li>
        </ul>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
        	<table class="input">
               	<tr>
                   	<td width="120" class="label">Tên công ty: (Việt)</td>
                    <td>
                     <?php echo $form->input('Setting.id',array('label'=>''));?>
                    <?php echo $form->input('Setting.name',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </td>
                </tr>
                <!--<tr>
                   	<td width="120" class="label">Tên công ty: (Anh)</td>
                    <td>
                    
                    <?php echo $form->input('Setting.name_en',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </td>
                </tr>-->
                <tr>
                  	<td class="label">Địa chỉ: (Việt)</td>
                    <td>
                     <?php echo $form->input('Setting.address',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </td>
                </tr>
                <!--<tr>
                  	<td class="label">Địa chỉ: (Anh)</td>
                    <td>
                     <?php echo $form->input('Setting.address_eg',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </td>
                </tr>-->
                <tr>
                  	<td class="label">Điện thoại:</td>
                    <td>
					   <?php echo $form->input('Setting.phone',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>  
					</td>
                </tr>
                <tr>
                  	<td class="label">Hotline:</td>
                    <td>
                       <?php echo $form->input('Setting.mobile',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </td>
                </tr>
                <tr>
                  	<td class="label">Email:</td>
                    <td>
                    <?php echo $form->input('Setting.email',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </td>
                </tr>
                <tr>
                  	<td class="label">Link website:</td>
                    <td>
                    <?php echo $form->input('Setting.url',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </td>
                </tr>
                <tr>
                  	<td class="label">Tiêu đề website: (Việt)</td>
                    <td>
                    <?php echo $form->input('Setting.title',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </td>
                </tr>
                
                <tr>
                  	<td class="label">Tiêu đề website: (Anh)</td>
                    <td>
                    <?php echo $form->input('Setting.title_en',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </td>
                </tr>
                <tr>
                  	<td class="label">Trang thái:</td>
                    <td>
                    <input type="radio" value="0" id="NewsStatus0" name="data[News][status]"> Chưa Active 
                    	&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="1" id="NewsStatus1" name="data[News][status]"> Đã Active
                    </td>
                </tr>
                <tr>
                	<td class="label">Thông tin khác</td>
                	<td>
                    <?php  echo $this->Form->input('Setting.content',array('label' => '','type'=>'textarea')).$this->TvFck->create('Setting.content',array('toolbar'=>'extra','skin'=>'kama','height'=>'200px','width'=>'700')); ?>
                    </td>
                </tr>
                 <tr>
                	<td class="label">Thông tin tài hoản</td>
                	<td>
                    <?php  echo $this->Form->input('Setting.descriptions',array('label' => '','type'=>'textarea')).$this->TvFck->create('Setting.descriptions',array('toolbar'=>'extra','skin'=>'kama','height'=>'200px','width'=>'700')); ?>
                    </td>
                </tr>
                 <tr>
                	<td class="label">Thông tin footter</td>
                	<td>
                    <?php  echo $this->Form->input('Setting.footer',array('label' => '','type'=>'textarea')).$this->TvFck->create('Setting.footer',array('toolbar'=>'extra','skin'=>'kama','height'=>'200px','width'=>'800')); ?>
                    </td>
                </tr>
                <tr>
                  	<td class="label">Từ khóa (SEO):</td>
                    <td>
                    <?php  echo $this->Form->input('keyword',array('type'=>'textarea','rows' => '2')); ?>
                    </td>
                </tr>
                <tr>
                  	<td class="label">Mô tả (SEO):</td>
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
                    <a href="<?php echo DOMAINADESTORE?>settings" class="toolbar">
                        <span class="icon-32-cancel"></span>
                        Hủy
                    </a>
                </li>
            </ul>
            <div class="clr"></div>
        </div>
		<div class="pagetitle icon-48-category-add"><h2>Thêm mới danh mục</h2></div>
		<div class="clr"></div>
	</div>
</div>
<?php echo $form->end(); ?>