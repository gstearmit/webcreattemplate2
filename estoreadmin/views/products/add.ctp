<?php echo $javascript->link('jquery.datepick', true); ?>
<?php echo $html->css('jquery.datepick'); ?>
<style>
</style>
<script type="text/javascript">
$(function() {
	$('.popupDatepicker').datepick();
	});
</script>
<script language="javascript">
 function display(status){
	 if(status=='1')
	 $('#domain').css('display','block');
	 else
	 $('#domain').css('display','none');
	 
 }
 function change(obj){
	 switch(obj.options[obj.selectedIndex].value){
		 case '4':
		 case '3':
		 case '2':
		 display(1);
		 break;
		 default:
		 display(2);
	 }                  
 }
 
  function check(obj,id){
		// alert('hello');
		 	if(obj.checked==true)
				$('#'+ id).css('display','block');				
	 else
	           $('#'+ id).css('display','none'); 
	 }

 function check1(obj,id){
		// alert('hello');
		 	if(obj.checked==true)
				$('#'+ id).css('display','none');				
	 else
	           $('#'+ id).css('display','none'); 
	 }
	
 
</script>
<?php echo $form->create(null, array( 'url' => DOMAINADESTORE.'products/add','type' => 'post','name' => 'adminForm', 'inputDefaults' => array('label' => false,'div' => false)));?>
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
                    <a href="<?php echo DOMAINADESTORE?>products" class="toolbar">
                        <span class="icon-32-cancel"></span>
                        Hủy
                    </a>
                </li>
            </ul>
            <div class="clr"></div>
        </div>
		<div class="pagetitle icon-48-category-add"><h2>Quản lý sản phẩm</h2></div>
		<div class="clr"></div>
	</div>
</div>
<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        <h3>Thêm mới sản phẩm</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Nội dung</a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2"></a></li>
        </ul>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
        	<table class="input">
               	<tr><?php echo $this->Form->input('Product.estore_id',array('label' => '','type'=>'hidden','class'=>'text-input medium-input datepicker','value'=>$this->Session->read("id")));?>
                   <td width="120" class="label">Tên sản phẩm: </td>
                    <td>
                    <?php echo $this->Form->input('Product.title',array('class'=>'text-input medium-input datepicker','maxlength' => '250','onchange' => 'get_alias()','id' => 'idtitle'));?>
                    </td>
                </tr>
                <tr>
                   	<td width="120" class="label">Mã sản phẩm:</td>
                    <td>
                    <?php echo $this->Form->input('Product.code',array('class'=>'text-input medium-input datepicker','maxlength' => '250','style' => 'width:200px !important'));?>
                    </td>
                </tr> 
                <!--<tr>
                   	<td width="120" class="label">Tên sản phẩm: (Anh)</td>
                    <td>
                    <?php echo $this->Form->input('Product.title_en',array('class'=>'text-input medium-input datepicker','maxlength' => '250'));?>
                    </td>
                </tr>-->
                <tr>
                  	<td class="label">Liên kết tĩnh:</td>
                    <td>
                    <?php echo $this->Form->input('Product.alias',array('class'=>'text-input alias-input datepicker','maxlength' => '250','id' => 'idalias'));?>
                    <img width="16" height="16" alt="" onclick="get_alias();" style="cursor: pointer; vertical-align: middle;" src="<?php echo DOMAINADESTORE; ?>images/refresh.png">
                    </td>
                </tr>
               
                <tr>
                  	<td class="label">Thuộc danh mục:</td>
                    <td><?php echo $this->Form->input('catproduct_id',array('type'=>'select','options'=>$list_cat,'empty'=>'Chọn danh mục','class'=>'small-input','label'=>''));?></td>
                </tr>
                <tr>
                	<td class="label"></td>
                	<td>
                		<?php echo $this->Form->input('Product.sptieubieu',array('type'=>'checkbox','style'=>'float:left; margin-left:10px;','label'=>'Sản phẩm trung & cao cấp'));?>
                        <br />
                        <?php echo $this->Form->input('Product.spkuyenmai',array('type'=>'checkbox','style'=>'float:left; margin-left:10px;','label'=>'Sản phẩm khuyến mại'));?>
                	<!--<br />
                		<?php echo $this->Form->input('Product.display',array('type'=>'checkbox','style'=>'float:left; margin-left:10px;','label'=>'Sản phẩm khuyến mại'));?>
                    -->    
                	</td>
                </tr>
                <!--<tr>
                   	<td width="120" class="label">Kích cỡ sản phẩm:</td>
                    
                    <td>
                    <?php echo $this->Form->input('Product.kichthuoc',array('class'=>'text-input medium-input datepicker','maxlength' => '250','style' => 'width:200px !important'));?>
                    </td>
                </tr>--> 
                <tr>
                    <td width="120" class="label">Hãng sản xuất</td>  
                    <td><?php echo $this->Form->input('manufacturer',array('type'=>'select','options'=>$list_cat1,'empty'=>'Chọn hãng sản xuất','class'=>'small-input','label'=>''));?>
                    </td>
                </tr>
                <tr>
                   	<td width="120" class="label">Giá sản phẩm:</td>
                    <td>
                    <?php echo $this->Form->input('Product.price',array('class'=>'text-input medium-input datepicker','maxlength' => '250','style' => 'width:200px !important'));?>
                    </td>
                </tr>              
               <tr>
                   	<td width="120" class="label">Thuộc khoản giá</td>
                    <td>
                    <?php echo $form->select('Product.khoanggia',$gia);?>
                    </td>
                </tr> 
               
                <tr>
                  	<td class="label">Ảnh sản phẩm:</td>
                    <td>
                        <?php echo $this->Form->input('Product.images',array('class'=>'text-input image-input datepicker','name' => 'userfile'));?> &nbsp;<font color="#FF0000"> <a href="javascript:window.open('<?php echo DOMAINADESTORE; ?>upload.php','userfile','width=500,height=300');window.history.go(1)" >[ upload ]</a> </font><font color="#FF0000">*</font>(jpg, jpeg, gif, png)
                    </td>
                    <!--<td>
                    <?php echo $this->Form->input('Product.images',array('class'=>'text-input image-input datepicker','id' => 'xFilePath'));?>
                    	<input type="button" value="Chọn ảnh" onclick="BrowseServer();" class="button" />
                    </td>-->
                </tr>
                <!--<tr>
                	<td class="label">Tóm tắt (Tiếng Việt)</td>
                    <td>
					 <?php  echo $this->Form->input('introduction').$this->TvFck->create('Product.introduction',array('height'=>'100px','width'=>'750px')); ?>
                     </td>
                </tr>
                <tr>
                	<td class="label">Tóm tắt (Tiếng Anh)</td>
                    <td>
					 <?php  echo $this->Form->input('introduction_en').$this->TvFck->create('Product.introduction_en',array('height'=>'100px','width'=>'750px')); ?>
                     </td>
                </tr>-->
                <tr>
                	<td class="label">Mô tả sản phẩm </td>
                	<td>
                    <?php  echo $this->Form->input('content',array('label' => '','type'=>'textarea')).$this->TvFck->create('Product.content',array('toolbar'=>'extra','skin'=>'kama','height'=>'300px','width'=>'700px')); ?>
                    </td>
                </tr>
                 <!--<tr>
                	<td class="label">Mô tả sản phẩm (Anh)</td>
                	<td>
                    <?php  echo $this->Form->input('content_en',array('label' => '','type'=>'textarea')).$this->TvFck->create('Product.content_en',array('toolbar'=>'extra','skin'=>'kama','height'=>'300px','width'=>'700px')); ?>
                    </td>
                </tr>-->
                <tr>
                  	<td class="label">Trạng thái:</td>
                    <td>
                    <input type="radio" value="0" id="ProductStatus0" name="data[Product][status]"> Chưa Active 
                    	&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="1" id="ProductStatus1" name="data[Product][status]"> Đã Active
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
                    <a href="<?php echo DOMAINADESTORE?>products" class="toolbar">
                        <span class="icon-32-cancel"></span>
                        Hủy
                    </a>
                </li>
            </ul>
            <div class="clr"></div>
        </div>
		<div class="pagetitle icon-48-category-add"><h2>Quản lý sản phẩm</h2></div>
		<div class="clr"></div>
	</div>
</div>
<?php echo $form->end(); ?>