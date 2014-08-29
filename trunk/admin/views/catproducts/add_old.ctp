<?php
	echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
	
		$select="Chọn danh mục";
		$not_active="Chưa Active";
		$Active_s="Đã Active";
	if(isset($_GET['language'])){
		if($_GET['language']=='eng'){
		$select ="Select Category";
		$not_active="Not Active";
		$Active_s="Active";
	}else {
		
		$select="Chọn danh mục";
		$not_active="Chưa Active";
		$Active_s="Đã Active";
	}
	}
?>
<div class="content-box">
    <div class="content-box-header">
        
        <h3><?php __('Add_Category')?></h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1"></a></li> 
            <li><a href="#tab2" class="default-tab"><?php __('Add_New')?></a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div> 
    <div class="content-box-content">
        
        <div class="tab-content" id="tab1"> 
        </div>
        
        <div class="tab-content default-tab" id="tab2">
        
              <?php echo $form->create(null, array( 'url' => DOMAINAD.'catproducts/add','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>	    
                
                <fieldset> 
                    <p>
                        <label><?php __('Category')?> (VN)</label>
                        <?php echo $form->input('Catproduct.name',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                   
                  <p>
                        <label><?php __('Main_category')?></label>              
                        <?php 
                              echo $form->select('Catproduct.parent_id', $Catproductlist, null,array('empty'=>$select,'class'=>'small-input'));
                         ?>
                    </p>
                     <p>
                        <label><?php __('No.')?></label>   
                        <?php echo $form->input('Catproduct.char',array( 'label' => '','style'=>'width:100px !important;','class'=>'text-input medium-input datepicker'));?>       
                    </p>
                    <p>
                        <label><?php __('status')?></label>
                         <?php echo $form->radio('Catproduct.status', array(0 => $not_active, 1 => $Active_s), array('value' => '1','legend'=>'')); ?>
                    </p>
                    <p>
                        <input class="button" type="submit" value="<?php __('Add_New');?> " />
                    </p>
                    
                </fieldset>
                
                <div class="clear"></div>
                
            <?php echo $form->end(); ?>
            
        </div>
        
    </div>
 </div>
