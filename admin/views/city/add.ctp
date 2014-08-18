<script>
function confirmDelete(delUrl)
{
if (confirm("Bạn có muốn xóa danh mục này không!"))
{
	document.location = delUrl;
}
}
</script>

<?php echo $form->create(null, array( 'url' => DOMAINAD.'city/search','type' => 'post','enctype'=>'multipart/form-data','name'=>'image'));
$not_active ='Chưa Active';
$active ='Đã Active';
if(isset($_GET['language'])){
	if($_GET['language']=='eng'){
		$not_active ='Not Active';
		$active =' Active';
	}else {
		$not_active ='Chưa Active';
		$active ='Đã Active';
	}
}
?> 
     <fieldset class="search">
        <legend><?php __('search')?></legend>

        <div class="field">
            <label for="field2c"><?php __('City')?></label>
            <input type="text" id="field2c" name="keyword" class="text-search">
        </div>
        <p style="text-align:center;"> <input type="submit" name="" value="<?php __('search')?>" class="button" /></p>
       
    </fieldset>
 <?php echo $form->end(); ?>

<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
    
    
        
        <h3><?php __('City')?></h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1"></a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2" class="default-tab"><?php __('Add_New')?> </a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        
        <div class="tab-content" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
        </div> <!-- End #tab1 -->
        
        <div class="tab-content default-tab" id="tab2">
        
             <?php echo $form->create(null, array( 'url' => DOMAINAD.'city/add','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>       
                
                <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                    <p>
                        <label><?php __('City')?></label>
                           <?php echo $form->input('City.name',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    <p>
                        <label><?php __('location')?></label>
                           <?php echo $form->input('City.char',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                   
                    <p>
                        <label><?php __('status')?></label>
                         <?php echo $form->radio('City.status', array(0 => $not_active, 1 => $active), array('value' => '1','legend'=>'')); ?>  
                         <?php echo $form->input('City.id',array('label'=>''));?>
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