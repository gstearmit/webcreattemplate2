<?php echo $form->create(null, array( 'url' => DOMAINADBUSINISS.'catproducts/edit','type' => 'post','name' => 'adminForm', 'inputDefaults' => array('label' => false,'div' => false)));?>	   
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
                    <a href="<?php echo DOMAINADBUSINISS?>catproducts" class="toolbar">
                        <span class="icon-32-cancel"></span>
                        Hủy
                    </a>
                </li>
            </ul>
            <div class="clr"></div>
        </div>
		<div class="pagetitle icon-48-category-add"><h2>Quản lý danh mục sản phẩm</h2></div>
		<div class="clr"></div>
	</div>
</div>
<div class="content-box">
    <div class="content-box-header">
        <h3>Sửa danh mục</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Nội dung tiếng Việt</a></li>
            <li><a href="#tab2">Nội dung tiếng Anh</a></li>
        </ul>
        <div class="clear"></div>
    </div> 
    <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">  
            <table class="input">
               	<tr>
                   	<td width="120" class="label">Tên Danh mục:</td>
                    <td>
                    <?php echo $this->Form->input('Eshopdaquycatproduct.name',array('class'=>'text-input medium-input datepicker','maxlength' => '250','onchange' => 'get_alias()','id' => 'idtitle'));?>
                    <?php echo $this->Form->input('Eshopdaquycatproduct.id',array());?>
                    </td>
                </tr>
                <tr>
                  	<td class="label">Liên kết tĩnh:</td>
                    <td>
                    <?php echo $this->Form->input('Eshopdaquycatproduct.alias',array('class'=>'text-input alias-input datepicker','maxlength' => '250','id' => 'idalias'));?>
                    <img width="16" height="16" alt="" onclick="get_alias();" style="cursor: pointer; vertical-align: middle;" src="<?php echo DOMAINADBUSINISS; ?>images/refresh.png">
                    </td>
                </tr>
                
                <tr>
                  	<td class="label">Tên Danh mục cha</td>
                    <td>
                    <?php  echo $form->select('Eshopdaquycatproduct.parent_id', $list_cat, null,array('empty'=>'Chọn danh mục','class'=>'small-input')); ?>
                    </td>
                </tr>
               
                <tr>
                  	<td class="label">Số thứ tự:</td>
                    <td>
                    <?php echo $this->Form->input('Eshopdaquycatproduct.order',array('class'=>'text-input medium-input datepicker','maxlength' => '10','style' => 'width:100px !important','value' => '0'));?>
					</td>
                </tr>
                <tr>
                  	<td class="label">Trang thái:</td>
                    <td>
                    <input type="radio" value="0" id="EshopdaquycatproductStatus0" name="data[Eshopdaquycatproduct][status]"> Chưa Active 
                    	&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="1" id="EshopdaquycatproductStatus1" name="data[Eshopdaquycatproduct][status]"> Đã Active
                    </td>
                </tr>
                
            </table>
			<div class="clear"></div>
        </div>
         <div class="tab-content" id="tab2">
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
                    <a href="<?php echo DOMAINADBUSINISS?>catproducts" class="toolbar">
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