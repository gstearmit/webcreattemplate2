<?php echo $html->css('classifiedss'); ?>
<?php echo $html->css('theme'); ?>
<?php echo $html->css('newsshop'); ?>
<div class="member_register">
	<?php echo $this->element('shopleft');?>
	<div class="right" style="border-radius: 6px 6px 6px 6px;">
		<div id="classifieds">
			<div id="title-1">Danh mục sản phẩm</div>
			<div style="padding: 10px;">
                <div style="padding-bottom:10px;">
                    <span id="nav"><a href="#" class="ui-commandlink icon_back" onclick ="javascript: window.history.go(-1);" id="mainForm:j_idt287">Quay về</a>
                    </span>
                </div>
                 <?php echo $form->create(null, array( 'url' => DOMAIN.'newsshop/editcategory','type' => 'post','enctype'=>'multipart/form-data','id'=>'check_form','name'=>'image')); ?>    
                    <table>
                       <tr>
                            <td class="fieldName">Tên danh mục <span class="lbRed">(*)</span>:</td>
                            <td class="fieldValue">
                              <?php echo $this->Form->input('Categorynewsshop.name',array('class'=>'textField','label'=>'','style' => 'width:300px;','id' => 'updateCatForm:scName'));?>
                              <?php echo $this->Form->input('Categorynewsshop.id',array('class'=>'textField','label'=>''));?>
                                <div><div id="updateCatForm:j_idt213"></div>
                                </div>		
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="fieldName">Thứ tự <span class="lbRed">(*)</span>:</td>
                            <td class="fieldValue">
                             <?php echo $this->Form->input('Categorynewsshop.order',array('class'=>'textField','label'=>'','style' => 'width:50px;','id' => 'updateCatForm:scOrder'));?>
                                <div><div id="updateCatForm:j_idt222"></div>
                                </div>		
                            </td>
                        </tr>
                        <tr>
                            <td class="fieldName">Kích hoạt:</td>
                            <td class="fieldValue">
                              <?php echo $form->radio('Categorynewsshop.status', array(0 => 'Chưa Active', 1 => 'Đã Active'), array('value' => '1','legend'=>'')); ?>
                         
                            </td>
                        </tr>
                    
                        <tr>
                            <td></td>
                            <td><button type="submit" name=`"updateCatForm:j_idt227" id="updateCatForm:j_idt227" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text"> Sửa danh mục </span></button>
                                &nbsp;
                            </td>
                        </tr>
                    
                  </table>
				<?php echo $form->end(); ?>
			</div>
		
	</div>
</div>