 <?php echo $form->create(null, array( 'url' => DOMAINADBUSINISS.'products/edit','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>       

<br />
<div id="khung">
	<div id="main">
		<div class="toolbar-list" id="toolbar">
			<ul>
				<li id="toolbar-new">
					<a href="javascript:void(0);" onclick="javascript:document.image.submit();" class="toolbar">
                        <span class="icon-32-save"></span>
                         <?php __('Save')?>
					</a>
                </li>
                <li id="toolbar-refresh">
                    <a href="javascript:void(0);" class="toolbar" onclick="javascript:document.image.reset();">
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
                    <a href="<?php echo DOMAINADBUSINISS?>products" class="toolbar">
                        <span class="icon-32-cancel"></span>
                       <?php __('Cancel')?>
                    </a>
                </li>
            </ul>
            <div class="clr"></div>
        </div>
		<div class="pagetitle icon-48-nhomtin"><h2><?php __('Edit_product')?></h2></div>
		<div class="clr"></div>
	</div>
</div>
<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        <h3><?php __('Edit_product')?></h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab"><?php __('Edit')?></a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2"></a></li>
        </ul>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
        	<table class="input">
               		<tr>
                   	<td width="120" class="label"><?php __('Product_name')?>:</td>
                    <td>
                    <?php echo $this->Form->input('Eshopdaquyproduct.title',array('label'=>'','class'=>'text-input medium-input datepicker','maxlength' => '250','onchange' => 'get_alias()','id' => 'idtitle'));?>
                    </td>
                </tr>
               
                <tr>
                  	<td class="label"><?php __('Static_linking')?>:</td>
                    <td>
                    <?php echo $this->Form->input('Eshopdaquyproduct.alias',array('label'=>'','class'=>'text-input alias-input datepicker','maxlength' => '250','id' => 'idalias'));?>
                    <img width="16" height="16" alt="" onclick="get_alias();" style="cursor: pointer; vertical-align: middle;" src="<?php echo DOMAINADBUSINISS; ?>images/refresh.png">
                    </td>
                </tr>
                 
                <tr>
                  	<td class="label"><?php __('In_category')?>:</td>
                    <td><?php echo $this->Form->input('catproduct_id',array('type'=>'select','options'=>$list_cat,'empty'=>'Chọn danh mục','class'=>'small-input','label'=>''));?></td>
                </tr>
                 <!--detail product-->

                
                

                

                <!--end-->
                <tr>
                   	<td width="120" class="label"><?php __('Product_price')?>:</td>
                    <td>
                    <?php echo $this->Form->input('Eshopdaquyproduct.price',array('label'=>'','class'=>'text-input medium-input datepicker','maxlength' => '250','style' => 'width:200px !important'));?>
                    </td>
                </tr>
                <!-- 
                <tr>
                  	<td class="label">Hiện trang chủ:</td>
                    <td>
                    <input type="radio" value="1" id="EshopdaquyproductHomeproduct1" <?php if($this->data['Eshopdaquyproduct']['homeproduct'] == 1 ) echo "checked='checked'"; ?> name="data[Eshopdaquyproduct][homeproduct]"> Có 
                    	&nbsp;&nbsp;&nbsp;<input type="radio" <?php if($this->data['Eshopdaquyproduct']['homeproduct'] == 0 ) echo "checked='checked'"; ?> value="0" id="EshopdaquyproductHomeproduct0" name="data[Eshopdaquyproduct][homeproduct]"> Không
                    </td>
                </tr>
                -->
				  <tr>
                  	<td class="label"><?php __('Featured_products')?>:</td>
                    <td><input type="radio" value="0" id="EshopdaquyproductStatus0" name="data[Eshopdaquyproduct][speproduct]" <?php if($this->data['Eshopdaquyproduct']['tranhdaquy'] == 0 ) echo "checked"; ?>> <?php __('No')?>
                    	&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="1" id="EshopdaquyproductStatus1" name="data[Eshopdaquyproduct][speproduct]" <?php if($this->data['Eshopdaquyproduct']['speproduct'] == 1 ) echo "checked"; ?>> <?php __('Yes')?>
                    </td>
                </tr>
				
				   <tr>
                  	<td class="label"><?php __('Gemstone_paintings')?>:</td>
                    <td><input type="radio" value="1" id="EshopdaquyproductStatus0" name="data[Eshopdaquyproduct][tranhdaquy]" <?php if($this->data['Eshopdaquyproduct']['tranhdaquy'] == 0 ) echo "checked"; ?>> <?php __('Yes')?> 
                    	&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="0" id="EshopdaquyproductStatus1" name="data[Eshopdaquyproduct][tranhdaquy]" <?php if($this->data['Eshopdaquyproduct']['tranhdaquy'] == 1 ) echo "checked"; ?>>  <?php __('No')?>
                    </td>
                </tr>
				   <tr>
                  	<td class="label"><?php __('Rough_gems')?>:</td>
                    <td><input type="radio" value="1" id="EshopdaquyproductStatus0" name="data[Eshopdaquyproduct][daquytho]" <?php if($this->data['Eshopdaquyproduct']['tranhdaquy'] == 0 ) echo "checked"; ?>><?php __('Yes')?>
                    	&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="0" id="EshopdaquyproductStatus1" name="data[Eshopdaquyproduct][daquytho]" <?php if($this->data['Eshopdaquyproduct']['daquytho'] == 1 ) echo "checked"; ?>>  <?php __('No')?>
                    </td>
                </tr>
				   <tr>
                  	<td class="label"><?php __('Stone_fengshui')?>:</td>
                    <td><input type="radio" value="1" id="EshopdaquyproductStatus0" name="data[Eshopdaquyproduct][daphongthuy]" <?php if($this->data['Eshopdaquyproduct']['tranhdaquy'] == 0 ) echo "checked"; ?>> <?php __('Yes')?>
                    	&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="0" id="EshopdaquyproductStatus1" name="data[Eshopdaquyproduct][daphongthuy]" <?php if($this->data['Eshopdaquyproduct']['daphongthuy'] == 1 ) echo "checked"; ?>> <?php __('No')?>
                    </td>
                </tr>
				   <tr>
                  	<td class="label"><?php __('Jewelry')?>:</td>
                    <td><input type="radio" value="1" id="EshopdaquyproductStatus0" name="data[Eshopdaquyproduct][trangsuc]" <?php if($this->data['Eshopdaquyproduct']['trangsuc'] == 0 ) echo "checked"; ?>><?php __('Yes')?>
                    	&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="0" id="EshopdaquyproductStatus1" name="data[Eshopdaquyproduct][trangsuc]" <?php if($this->data['Eshopdaquyproduct']['trangsuc'] == 1 ) echo "checked"; ?>>  <?php __('No')?>
                    </td>
                </tr>
				
				
                <tr>
                  	<td class="label"><?php __('Status')?>:</td>
                    <td><input type="radio" value="0" id="EshopdaquyproductStatus0" name="data[Eshopdaquyproduct][status]" <?php if($this->data['Eshopdaquyproduct']['status'] == 0 ) echo "checked"; ?>><?php __('Hide')?>
                    	&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="1" id="EshopdaquyproductStatus1" name="data[Eshopdaquyproduct][status]" <?php if($this->data['Eshopdaquyproduct']['status'] == 1 ) echo "checked"; ?>> <?php __('Show')?>
                    </td>
                </tr>
                <tr>
                  		<td class="label"><?php __('Avatar')?>:</td>
                    <td>
                    <input type="text" size="50" class="text-input medium-input datepicker" value="<?php echo $edit['Eshopdaquyproduct']['images'];?>" name="userfile" readonly="true"> &nbsp;<a href="javascript:window.open('<?php echo DOMAINADBUSINISS; ?>upload_pic.php','userfile','width=500,height=300');window.history.go(1)" ><input type="button" value="<?php __('Select_image')?>" class="button" /></a>
                    </td>
                </tr>
                <tr>
                  	<td class="label"><?php __('Image')?>  1:</td>
                    <td>
                    <input type="text" size="50" class="text-input medium-input datepicker" value="<?php echo $edit['Eshopdaquyproduct']['images1'];?>" name="userfile1" readonly="true"> &nbsp;<a href="javascript:window.open('<?php echo DOMAINADBUSINISS; ?>upload_pic1.php','userfile1','width=500,height=300');window.history.go(1)" ><input type="button" value="<?php __('Select_image')?>" class="button" /></a>
                    </td>
                </tr>
                <tr>
                  	<td class="label"><?php __('Image')?>  2:</td>
                    <td>
                    <input type="text" size="50" class="text-input medium-input datepicker" value="<?php echo $edit['Eshopdaquyproduct']['images2'];?>" name="userfile2" readonly="true"> &nbsp;<a href="javascript:window.open('<?php echo DOMAINADBUSINISS; ?>upload_pic2.php','userfile2','width=500,height=300');window.history.go(1)" ><input type="button" value="<?php __('Select_image')?>" class="button" /></a>
                    </td>
                </tr>
                <tr>
                  	<td class="label"><?php __('Image')?>  3:</td>
                    <td>
                    <input type="text" size="50" class="text-input medium-input datepicker" value="<?php echo $edit['Eshopdaquyproduct']['images3'];?>" name="userfile3" readonly="true"> &nbsp;<a href="javascript:window.open('<?php echo DOMAINADBUSINISS; ?>upload_pic3.php','userfile3','width=500,height=300');window.history.go(1)" ><input type="button" value="<?php __('Select_image')?>" class="button" /></a>
                    </td>
                </tr>
                <tr>
                  	<td class="label"><?php __('Image')?>  4:</td>
                    <td>
                    <input type="text" size="50" class="text-input medium-input datepicker" value="<?php echo $edit['Eshopdaquyproduct']['images4'];?>" name="userfile4" readonly="true"> &nbsp;<a href="javascript:window.open('<?php echo DOMAINADBUSINISS; ?>upload_pic4.php','userfile4','width=500,height=300');window.history.go(1)" ><input type="button" value="<?php __('Select_image')?>" class="button" /></a>
                    </td>
                </tr>

                <tr>
                	<td class="label"><?php __('Product_description')?></td>
                	<td>
                    <?php  echo $this->Form->input('content',array('label' => '','type'=>'textarea')).$this->TvFck->create('Eshopdaquyproduct.content',array('toolbar'=>'extra','skin'=>'kama','height'=>'300px','width'=>'98%')); ?>
                    </td>
                </tr>
                
            </table>
            <?php echo $form->input('Eshopdaquyproduct.id',array('label'=>''));?>
            <div class="clr"></div>
        </div> <!-- End #tab1 -->
        <div class="tab-content" id="tab2">
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
                        <?php __('Save')?>
					</a>
                </li>
                <li id="toolbar-refresh">
                    <a href="javascript:void(0);" class="toolbar" onclick="javascript:document.image.reset();">
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
                    <a href="<?php echo DOMAINADBUSINISS?>products" class="toolbar">
                        <span class="icon-32-cancel"></span>
                         <?php __('Cancel')?>
                    </a>
                </li>
            </ul>
            <div class="clr"></div>
        </div>
		<div class="pagetitle icon-48-nhomtin"><h2><?php __('Edit_product')?></h2></div>
		<div class="clr"></div>
	</div>
</div>
<?php echo $form->end(); ?>