 <?php echo $form->create(null, array( 'url' => DOMAINAD.'news/edit','type' => 'post','name' => 'adminForm', 'inputDefaults' => array('label' => false,'div' => false)));?>
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
                    <a href="<?php echo DOMAINAD?>news" class="toolbar">
                        <span class="icon-32-cancel"></span>
                        Hủy
                    </a>
                </li>
            </ul>
            <div class="clr"></div>
        </div>
		<div class="pagetitle icon-48-category-add"><h2>Quản trị tin tức</h2></div>
		<div class="clr"></div>
	</div>
</div>
<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        <h3>Chỉnh sửa</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Nội dung</a></li> <!-- href must be unique and match the id of target div -->
        </ul>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
        	<table class="input">
               	<tr>
                   	<td width="120" class="label">Tiêu đề bài viết: </td>
                    <td>
                    <?php echo $this->Form->input('News.title',array('class'=>'text-input medium-input datepicker','maxlength' => '250','onchange' => 'get_alias()','id' => 'idtitle'));?>
                    </td>
                </tr>
                <!--<tr>
                   	<td width="120" class="label">Tiêu đề bài viết: (Anh)</td>
                    <td>
                    <?php echo $this->Form->input('News.title_en',array('class'=>'text-input medium-input datepicker','maxlength' => '250'));?>
                    </td>
                </tr>-->
                <tr>
                  	<td class="label">Liên kết tĩnh:</td>
                    <td>
                    <?php echo $this->Form->input('News.alias',array('class'=>'text-input alias-input datepicker','maxlength' => '250','id' => 'idalias'));?>
                    <img width="16" height="16" alt="" onclick="get_alias();" style="cursor: pointer; vertical-align: middle;" src="<?php echo DOMAINAD; ?>images/refresh.png">
                    </td>
                </tr>
                <tr>
                  	<td class="label">Thuộc danh mục:</td>
                    <td><?php echo $this->Form->input('category_id',array('type'=>'select','options'=>$list_cat,'empty'=>'Chọn danh mục','class'=>'small-input','label'=>''));?></td>
                </tr>
                <tr>
                    <td class="label">Hình ảnh cũ:</td>
                    <td><img src="<?php echo DOMAINAD?><?php echo $edit['News']['images']?>" width="200"/></td>
                </tr>
                <tr>
                  	<td class="label">Hình ảnh:</td>
                    <td>
                        <?php echo $this->Form->input('News.images',array('class'=>'text-input image-input datepicker','name' => 'userfile'));?> &nbsp;<font color="#FF0000"> <a href="javascript:window.open('<?php echo DOMAINAD; ?>upload.php','userfile','width=500,height=300');window.history.go(1)" >[ upload ]</a> </font><font color="#FF0000">*</font>(jpg, jpeg, gif, png)
                    </td>                    
                    <!--<td>
                    <?php echo $this->Form->input('News.images',array('class'=>'text-input image-input datepicker','id' => 'xFilePath'));?>
                    	<input type="button" value="Chọn ảnh" onclick="BrowseServer();" class="button" />
                                                
                    </td>-->
                                        
                </tr>
                <tr>
                	<td class="label">Mô tả tóm tắt</td>
                    <td><?php  echo $this->Form->input('introduction').$this->TvFck->create('News.introduction',array('height'=>'100px','width'=>'750px')); ?></td>
                </tr>
                <!--<tr>
                	<td class="label">Mô tả tóm tắt (Anh)</td>
                    <td><?php  echo $this->Form->input('introduction_en').$this->TvFck->create('News.introduction_en',array('height'=>'100px','width'=>'750px')); ?></td>
                </tr>-->
                <tr>
                	<td class="label">Nội dung bài viết </td>
                	<td>
                	<?php  echo $this->Form->input('content',array('label' => '','type'=>'textarea')).$this->TvFck->create('News.content',array('toolbar'=>'extra','height'=>'300px','width'=>'750px')); ?>	

                    </td>
                </tr>
                <!--<tr>
                	<td class="label">Nội dung bài viết (Anh)</td>
                	<td>
                	<?php  echo $this->Form->input('content_en',array('label' => '','type'=>'textarea')).$this->TvFck->create('News.content_en',array('toolbar'=>'extra','height'=>'300px','width'=>'750px')); ?>	

                    </td>
                </tr>-->
                  <tr>
                  	<td class="label">Trạng thái:</td>
                    <td>
                    <input type="radio" value="0" id="NewsStatus0" name="data[News][status]"> Chưa Active 
                    	&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="1" id="NewsStatus1" name="data[News][status]"> Đã Active
                    </td>
                </tr>
            </table>
            <?php echo $form->input('id',array('label'=>''));?>
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
                    <a href="<?php echo DOMAINAD?>news" class="toolbar">
                        <span class="icon-32-cancel"></span>
                        Hủy
                    </a>
                </li>
            </ul>
            <div class="clr"></div>
        </div>
		<div class="pagetitle icon-48-category-add"><h2>Quản trị tin tức</h2></div>
		<div class="clr"></div>
	</div>
</div>
<?php echo $form->end(); ?>