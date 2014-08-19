<?php echo $form->create(null, array( 'url' => DOMAINAD.'news/add','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>       
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
                    <a href="<?php echo DOMAINAD?>news" class="toolbar">
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
<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        <h3>Thêm mới sản phẩm</h3>
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
                   	<td width="120" class="label">Tên sản phẩm:</td>
                    <td>
                    <?php echo $this->Form->input('News.title',array('class'=>'text-input medium-input datepicker','maxlength' => '250','onchange' => 'get_alias()','id' => 'idtitle'));?>
                    </td>
                </tr>
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
                  	<td class="label">Tin trang chủ:</td>
                    <td>
                    <input type="radio" value="1" id="NewsHomenews1" name="data[News][homenews]"> Có 
                    	&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="0" id="NewsHomenews0" name="data[News][homenews]"> Không
                    </td>
                </tr>
                <tr>
                  	<td class="label">Tin mới:</td>
                    <td>
                    <input type="radio" value="1" id="NewsNews1" name="data[News][news]"> Có 
                    	&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="0" id="NewsNews0" name="data[News][news]"> Không
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
                  	<td class="label">Hình ảnh:</td>
                    <td>
                    <input type="text" size="50" class="text-input medium-input datepicker" name="userfile" readonly="true"> &nbsp;<a href="javascript:window.open('<?php echo DOMAINAD; ?>upload_pic.php','userfile','width=500,height=300');window.history.go(1)" ><input type="button" value="Chọn ảnh" class="button" /></a>
                   	
                    </td>
                </tr>
                <tr>
                	<td class="label">Mô tả tóm tắt</td>
                    <td><?php  echo $this->Form->input('introduction').$this->TvFck->create('News.introduction',array('height'=>'100px','width'=>'98%')); ?></td>
                </tr>
                <tr>
                	<td class="label">Nội dung bài viết</td>
                	<td>
                    <?php  echo $this->Form->input('content',array('label' => '','type'=>'textarea')).$this->TvFck->create('News.content',array('toolbar'=>'extra','skin'=>'kama','height'=>'300px','width'=>'98%')); ?>
                    </td>
                </tr>
                <tr>
                  	<td class="label">Từ khóa (SEO):</td>
                    <td>
                    <?php  echo $this->Form->input('meta_key',array('type'=>'textarea','rows' => '2')); ?>
                    </td>
                </tr>
                <tr>
                  	<td class="label">Mô tả (SEO):</td>
                    <td>
                    <?php  echo $this->Form->input('meta_des',array('type'=>'textarea','rows' => '2')); ?>
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
                    <a href="<?php echo DOMAINAD?>news" class="toolbar">
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