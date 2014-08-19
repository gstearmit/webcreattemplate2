<?php echo $form->create(null, array( 'url' => DOMAINAD.'products/add','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>       
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
                    <a href="<?php echo DOMAINAD?>products" class="toolbar">
                        <span class="icon-32-cancel"></span>
                        Hủy
                    </a>
                </li>
            </ul>
            <div class="clr"></div>
        </div>
		<div class="pagetitle icon-48-category-add"><h2>Thêm mới sản phảm</h2></div>
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
                    <?php echo $this->Form->input('Product.title',array('label'=>'','class'=>'text-input medium-input datepicker','maxlength' => '250','onchange' => 'get_alias()','id' => 'idtitle'));?>
                    </td>
                </tr>
               
                <tr>
                  	<td class="label">Liên kết tĩnh:</td>
                    <td>
                    <?php echo $this->Form->input('Product.alias',array('label'=>'','class'=>'text-input alias-input datepicker','maxlength' => '250','id' => 'idalias'));?>
                    <img width="16" height="16" alt="" onclick="get_alias();" style="cursor: pointer; vertical-align: middle;" src="<?php echo DOMAINAD; ?>images/refresh.png">
                    </td>
                </tr>
                 
                <tr>
                  	<td class="label">Thuộc danh mục:</td>
                    <td><?php echo $this->Form->input('catproduct_id',array('type'=>'select','options'=>$list_cat,'empty'=>'Chọn danh mục','class'=>'small-input','label'=>''));?></td>
                </tr>
                <tr>
                   	<td width="120" class="label">Giá :</td>
                    <td>
                    <?php echo $this->Form->input('Product.price',array('label'=>'','class'=>'text-input medium-input datepicker','maxlength' => '250','style' => 'width:200px !important'));?>
                    </td>
                </tr>

				<!--
                <tr>
                  	<td class="label">Hiện trang chủ:</td>
                    <td>
                    <input type="radio" value="1" id="ProductHomeproduct1" name="data[Product][homeproduct]"> Có 
                    	&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="0" id="ProductHomeproduct0" name="data[Product][homeproduct]"> Không
                    </td>
                </tr>
				-->
                <tr>
                  	<td class="label">Sản phẩm nổi bật:</td>
                    <td>
                    <input type="radio" value="1" id="ProductStatus0" name="data[Product][speproduct]"> Có
                    	&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="0" id="ProductStatus1" name="data[Product][speproduct]"> Không
                    </td>
                </tr>
				<tr>
                  	<td class="label">Tranh đá quý:</td>
                    <td>
                    <input type="radio" value="1" id="ProductStatus0" name="data[Product][tranhdaquy]"> Có 
                    	&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="0" id="ProductStatus1" name="data[Product][tranhdaquy]"> Không
                    </td>
                </tr>
				<tr>
                  	<td class="label">Đá quý thô:</td>
                    <td>
                    <input type="radio" value="1" id="ProductStatus0" name="data[Product][daquytho]"> Có
                    	&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="0" id="ProductStatus1" name="data[Product][daquytho]"> Không
                    </td>
                </tr>
				
				
                <tr>
                  	<td class="label">Đá phong thủy:</td>
                    <td>
                    <input type="radio" value="1" id="ProductStatus0" name="data[Product][daphongthuy]"> Có
                    	&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="0" id="ProductStatus1" name="data[Product][daphongthuy]"> Không
                    </td>
                </tr>
				   <tr>
                  	<td class="label">Trang sức:</td>
                    <td>
                    <input type="radio" value="1" id="ProductStatus0" name="data[Product][trangsuc]"> Có 
                    	&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="0" id="ProductStatus1" name="data[Product][trangsuc]"> Không
                    </td>
                </tr>
				
				   <tr>
                  	<td class="label">Trạng thái:</td>
                    <td>
                    <input type="radio" value="0" id="ProductStatus0" name="data[Product][status]"> Ẩn
                    	&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="1" id="ProductStatus1" name="data[Product][status]"> Hiện
                    </td>
                </tr>
                <tr>
                  	<td class="label">Hình ảnh đại diện:</td>
                    <td>
                        <input type="text" size="50" class="text-input medium-input datepicker" name="userfile" readonly="true"> &nbsp;<a href="javascript:window.open('<?php echo DOMAINAD; ?>upload_pic.php','userfile','width=500,height=300');window.history.go(1)" ><input type="button" value="Chọn ảnh" class="button" /></a>
                    </td>
                </tr>
                <tr>
                  	<td class="label">Hình ảnh 1:</td>
                    <td>
                        <input type="text" size="50" class="text-input medium-input datepicker" name="userfile1" readonly="true"> &nbsp;<a href="javascript:window.open('<?php echo DOMAINAD; ?>upload_pic1.php','userfile1','width=500,height=300');window.history.go(1)" ><input type="button" value="Chọn ảnh" class="button" /></a>
                    </td>
                </tr>
                <tr>
                  	<td class="label">Hình ảnh 2:</td>
                    <td>
                        <input type="text" size="50" class="text-input medium-input datepicker" name="userfile2" readonly="true"> &nbsp;<a href="javascript:window.open('<?php echo DOMAINAD; ?>upload_pic2.php','userfile2','width=500,height=300');window.history.go(1)" ><input type="button" value="Chọn ảnh" class="button" /></a>
                    </td>
                </tr>
                <tr>
                  	<td class="label">Hình ảnh 3:</td>
                    <td>
                        <input type="text" size="50" class="text-input medium-input datepicker" name="userfile3" readonly="true"> &nbsp;<a href="javascript:window.open('<?php echo DOMAINAD; ?>upload_pic3.php','userfile3','width=500,height=300');window.history.go(1)" ><input type="button" value="Chọn ảnh" class="button" /></a>
                    </td>
                </tr>
                <tr>
                  	<td class="label">Hình ảnh 4:</td>
                    <td>
                        <input type="text" size="50" class="text-input medium-input datepicker" name="userfile4" readonly="true"> &nbsp;<a href="javascript:window.open('<?php echo DOMAINAD; ?>upload_pic4.php','userfile4','width=500,height=300');window.history.go(1)" ><input type="button" value="Chọn ảnh" class="button" /></a>
                    </td>
                </tr>
                <tr>
                	<td class="label">Mô tả sản phẩm</td>
                	<td>
                    <?php  echo $this->Form->input('content',array('label' => '','type'=>'textarea')).$this->TvFck->create('Product.content',array('toolbar'=>'extra','skin'=>'kama','height'=>'300px','width'=>'98%')); ?>
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
                    <a href="<?php echo DOMAINAD?>products" class="toolbar">
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