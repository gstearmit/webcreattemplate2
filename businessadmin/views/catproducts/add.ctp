<?php echo $form->create(null, array( 'url' => DOMAINADBUSINISS.'catproducts/add','type' => 'post','name' => 'adminForm', 'inputDefaults' => array('label' => false,'div' => false)));?>	   
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
                    <a href="<?php echo DOMAINADBUSINISS?>catproducts" class="toolbar">
                        <span class="icon-32-cancel"></span>
                        <?php __('Cancel')?>
                    </a>
                </li>
            </ul>
            <div class="clr"></div>
        </div>
		<div class="pagetitle icon-48-category-add"><h2><?php __('Manage_products_category')?></h2></div>
		<div class="clr"></div>
	</div>
</div>
<div class="content-box">
    <div class="content-box-header">
        <h3><?php __('Add_category')?></h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab"><?php __('Content')?></a></li>
            
        </ul>
        <div class="clear"></div>
    </div> 
    <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">  
            <table class="input">
               	<tr>
                   	<td width="120" class="label"><?php __('Category_name')?>:</td>
                    <td>
                    <?php echo $this->Form->input('Eshopdaquycatproduct.name',array('class'=>'text-input medium-input datepicker','maxlength' => '250','onchange' => 'get_alias()','id' => 'idtitle'));?>
                    </td>
                </tr>
                <tr>
                  	<td class="label"><?php __('Static_linking')?>:</td>
                    <td>
                    <?php echo $this->Form->input('Eshopdaquycatproduct.alias',array('class'=>'text-input alias-input datepicker','maxlength' => '250','id' => 'idalias'));?>
                    <img width="16" height="16" alt="" onclick="get_alias();" style="cursor: pointer; vertical-align: middle;" src="<?php echo DOMAINADBUSINISS; ?>images/refresh.png">
                    </td>
                </tr>
                
                <tr>
                  	<td class="label"><?php __('Big_category')?></td>
                    <td>
                    <?php  echo $form->select('Eshopdaquycatproduct.parent_id', $Eshopdaquycatproductlist, null,array('empty'=>'Chọn danh mục','class'=>'small-input')); ?>
                    </td>
                </tr>
               
                <tr>
                  	<td class="label"><?php __('STT')?>:</td>
                    <td>
                    <?php echo $this->Form->input('Eshopdaquycatproduct.order',array('class'=>'text-input medium-input datepicker','maxlength' => '10','style' => 'width:100px !important','value' => '0'));?>
					</td>
                </tr>
                <tr>
                  	<td class="label"><?php __('Status')?>:</td>
                    <td>
                    <input type="radio" value="0" id="EshopdaquycatproductStatus0" name="data[Eshopdaquycatproduct][status]"> <?php __('Unactive')?>
                    	&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="1" id="EshopdaquycatproductStatus1" name="data[Eshopdaquycatproduct][status]"> <?php __('Activated')?>
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
                    <a href="<?php echo DOMAINADBUSINISS?>catproducts" class="toolbar">
                        <span class="icon-32-cancel"></span>
                        <?php __('Cancel')?>
                    </a>
                </li>
            </ul>
            <div class="clr"></div>
        </div>
		<div class="clr"></div>
	</div>
</div> 
<?php echo $form->end(); ?>