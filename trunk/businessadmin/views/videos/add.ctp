<?php 
$active='Đã Active';
$not_active='Chưa Active';
if(isset($_GET['language'])){
	if($_GET['language']=='eng'){
	$active='Active';
	$not_active='UnActive';
	}else {
	$active='Đã Active';
	$not_active='Chưa Active';
	}
}
?>
<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        
        <h3><?php __('Video')?></h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1"></a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2" class="default-tab"><?php __('Add_new')?></a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        
        <div class="tab-content" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
        </div> <!-- End #tab1 -->
        
        <div class="tab-content default-tab" id="tab2">
        
             <?php echo $form->create(null, array( 'url' => DOMAINAD.'videos/add','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>       
                
                <fieldset> 
                    <p>
                        <label><?php __('Company_name')?></label>
                           <?php echo $form->input('Video.name',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    <p>
                        <label><?php __('Video')?></label>
                        <input type="text" size="50" style="height:25px;" name="video" readonly="true"> &nbsp;<font color="#FF0000"> <a href="javascript:window.open('<?php echo DOMAINAD; ?>video.php','video','width=500,height=300');window.history.go(1)" >[ upload ]</a> </font><font color="#FF0000">*</font>(flv,mp4)
                    </p>
                   
                     <p>
                        <label><?php __('Status')?></label>
                         <?php echo $form->radio('Video.status', array(0 => $not_active, 1 => $active), array('value' => '1','legend'=>'')); ?>  
                    </p>
                    <p>
                        <input class="button" type="submit" value="<?php __('Add_new')?>" />
                    </p>
                    
                </fieldset>
                
                <div class="clear"></div><!-- End .clear -->
                
            <?php echo $form->end(); ?>
            
        </div> <!-- End #tab2 -->        
        
    </div> <!-- End .content-box-content -->
 </div>

