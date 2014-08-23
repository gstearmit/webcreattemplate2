<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        
        <h3><?php __('Video')?></h3>
        
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
        
             <?php echo $form->create(null, array( 'url' => DOMAINADESTORE.'videos/edit','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>       
                
                <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                    <p>
                        <label><?php __('Company_name')?></label>
                           <?php echo $form->input('Video.name',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    
                   <p>
                        <label><?php __('LinkUrl Youtube.com')?></label>
                       <?php echo $form->input('Video.LinkUrl',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    <p><label><?php __('Position')?></label>
                    <input type="radio" value="0" id="ProductStatus0" name="data[Video][left]"> <?php __('Left')?>
                    	&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="1" id="ProductStatus1" name="data[Video][left]"> <?php __('Right')?>
                    
                	</p>
                     <p>
                        <label><?php __('Status')?></label>
                        <?php echo $form->input('Video.id',array('label' => '','type'=>'hidden'));?>
                         
                         <input type="radio" value="0" id="ProductStatus0" name="data[Video][status]"/> <?php __('Unactive')?> 
                    	&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="1" id="ProductStatus1" name="data[Video][status]"/><?php __('Unactivated')?>
                      
                    </p>
                    <p>
                        <input class="button" type="submit" value=" <?php __('Edit')?> " />
                    </p>
                    
                </fieldset>
                
                <div class="clear"></div><!-- End .clear -->
                
            <?php echo $form->end(); ?>
            
        </div> <!-- End #tab2 -->        
        
    </div> <!-- End .content-box-content -->
 </div>

