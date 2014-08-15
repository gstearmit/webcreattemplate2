<?php
	echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
	
	$not_active="Chưa Active";
	$Active_s="Đã Active";
	if(isset($_GET['language'])){
		if($_GET['language']=='vie'){
			
			$not_active="Chưa Active";
			$Active_s="Đã Active";
		}else {
			
			$city="Select City";
			$not_active="Not Active";
			$Active_s="Active";
		}
	
	}
?>

<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">  
        
        <h3>Gallery</h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1"></a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2" class="default-tab"><?php __('Edit')?></a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        
        <div class="tab-content" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
        </div> <!-- End #tab1 -->
        
        <div class="tab-content default-tab" id="tab2">
        
             <?php echo $form->create(null, array( 'url' => DOMAINAD.'gallery/edit','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>       
                
                <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                    <p>
                        <label><?php __('Images_name')?></label>
                           <?php echo $form->input('Gallery.name',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    <p>
                        <label><?php __('In_product')?></label>  
                        <?php echo $this->Form->input('Gallery.product_id', array('type'=>'select', 'label'=>'', 'options'=>$list_cat, 'default'=>''));?>
                    </p>
                    
                    <p>
                        <label><?php __('Avatar')?></label>
                        <input type="text" size="80" style="height:25px;" name="userfile"  value="<?php echo $edit['Gallery']['images']?>"> &nbsp;<font color="#FF0000"> <a href="javascript:window.open('<?php echo DOMAINAD; ?>upload_pic1.php','userfile','width=500,height=300');window.history.go(1)" >[ upload ]</a> </font><font color="#FF0000">*</font>(jpg, jpeg, gif, png)
                    </p>

                    
                    <p>
                        <label><?php __('status')?></label>
                         <?php echo $form->radio('Gallery.status', array(0 => $not_active, 1 => $Active_s), array('value' => '1','legend'=>'')); ?>  
                         <?php echo $form->input('Gallery.id',array('label'=>''));?>
                    </p>
                    <p>
                        <input class="button" type="submit" value="<?php __('Edit')?>" />
                    </p>
                    
                </fieldset>
                
                <div class="clear"></div><!-- End .clear -->
                
            <?php echo $form->end(); ?>
            
        </div> <!-- End #tab2 -->        
        
    </div> <!-- End .content-box-content -->
 </div>