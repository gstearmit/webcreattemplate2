<?php 
	$active='Đã Active';
	$not_active='Chưa Active';
if(isset($_GET['language'])){
	if($_GET['language']=='eng'){
		$active='Active';
		$not_active='Not Active';
	}else {
		$active='Đã Active';
		$not_active='Chưa Active';
	}
}
?>
<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        
        <h3><?php __('support')?></h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1"></a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2" class="default-tab"><?php __('Add_New')?></a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        
        <div class="tab-content" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
        </div> <!-- End #tab1 -->
        
        <div class="tab-content default-tab" id="tab2">
        
            <?php echo $form->create(null, array( 'url' => DOMAINAD.'helps/add','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>       
                
                <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                    <p>
                        <label><?php __('Name')?></label>
                        <?php echo $form->input('Help.name',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                 
                    <p>
                        <label><?php __('Skype')?></label>              
                        <?php echo $form->input('Help.skype',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    <p>
                        <label><?php __('Phone')?></label>              
                        <?php echo $form->input('Help.sdt',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    <p>
                        <label><?php __('status')?></label>
                        <?php echo $form->radio('Help.status', array(0 => $not_active, 1 => $active), array('value' => '1','legend'=>'')); ?>
                    </p>
                    <p>
                        <input class="button" type="submit" value="<?php __('Add_New')?>" />
                    </p>
                    
                </fieldset>
                
                <div class="clear"></div><!-- End .clear -->
                
            <?php echo $form->end(); ?>
            
        </div> <!-- End #tab2 -->        
        
    </div> <!-- End .content-box-content -->
 </div>


