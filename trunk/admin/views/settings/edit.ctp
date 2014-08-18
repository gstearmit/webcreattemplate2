<?php
	echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
?>


<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        
        <h3><?php __('Web_Configuration')?></h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1"></a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2" class="default-tab"><?php __('Web_Configuration')?></a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        
        <div class="tab-content" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
        </div> <!-- End #tab1 -->
        
        <div class="tab-content default-tab" id="tab2">
        
             <?php echo $form->create(null, array( 'url' => DOMAINAD.'settings/edit','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>       
                
                <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                    <p>
                        <label><?php __('Company_name')?>(VN)</label>
                           <?php echo $form->input('Setting.name',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    
                   
                    <p>
                        <label><?php __('Headquarters')?></label>
                           <?php echo $form->input('Setting.address',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                     <p>
                        <label><?php __('Trading_Office')?></label>
                           <?php echo $form->input('Setting.address_eg',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    <p>
                        <label><?php __('Phone')?></label>
                            <?php echo $form->input('Setting.phone',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    <p>
                        <label><?php __('Mobile')?></label>
                           <?php echo $form->input('Setting.mobile',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    
                     <p>
                        <label><?php __('Fax')?></label>
                           <?php echo $form->input('Setting.fax',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    
                    <p>
                        <label><?php __('Email')?></label>  
                          <?php echo $form->input('Setting.email',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    <p>
                        <label><?php __('Website')?></label>  
                          <?php echo $form->input('Setting.url',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    <p>
                        <label><?php __('Tile_Website')?></label>
                       <?php echo $form->input('Setting.title',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    
                     <p>
                        <label><?php __('Copyright')?></label>
                        <?php echo $form->input('Setting.info_other',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    <p>
                        <label><?php __('Keyword')?> (SEO)</label>
                        <?php echo $form->input('Setting.keyword',array('label' => '','cols'=>70,'rows'=>3));?> 
                    </p>
                    <p>
                        <label><?php __('Description')?> (SEO)</label>
                         <?php echo $form->input('Setting.description',array('label' => '','cols'=>70,'rows'=>5));?> 
                    </p>
					
					 <p>
                        <label><?php __('Sign_up')?></label>
                        <?php  echo $this->Form->input('about',array('label' => '','type'=>'textarea')).$this->TvFck->create('Setting.about',array('toolbar'=>'extra','height'=>'300px','width'=>'900')); ?>
                    </p>
                   
				   
				    <p>
                        <label><?php __('Sign_up_shop')?></label>
                        <?php  echo $this->Form->input('about_eg',array('label' => '','type'=>'textarea')).$this->TvFck->create('Setting.about_eg',array('toolbar'=>'extra','height'=>'300px','width'=>'900')); ?>
                    </p>
                   
                    
					
					  
                    <p>
                        <label><?php __('Img_header')?> </label>
                         <input type="text" size="50" class="text-input medium-input datepicker" value="<?php echo $edit['Setting']['image_header']?>" name="userfile1" readonly="true"> &nbsp;<font color="#FF0000"> <a href="javascript:window.open('<?php echo DOMAINAD; ?>upload_pic.php?stt=1','userfile1','width=500,height=300');window.history.go(1)" >[ upload ]</a> </font><font color="#FF0000">*</font>(jpg, jpeg, gif, png)
                    </p>
                    <p>
                        <label><?php ('Img_body')?> </label>
                         <input type="text" size="50" class="text-input medium-input datepicker" value="<?php echo $edit['Setting']['image_body']?>" name="userfile2" readonly="true"> &nbsp;<font color="#FF0000"> <a href="javascript:window.open('<?php echo DOMAINAD; ?>upload_pic.php?stt=2','userfile2','width=500,height=300');window.history.go(1)" >[ upload ]</a> </font><font color="#FF0000">*</font>(jpg, jpeg, gif, png)
                    </p>
                    <p>
                        <label><?php __('Img_footer')?> </label>
                         <input type="text" size="50" class="text-input medium-input datepicker" value="<?php echo $edit['Setting']['image_footer']?>" name="userfile3" readonly="true"> &nbsp;<font color="#FF0000"> <a href="javascript:window.open('<?php echo DOMAINAD; ?>upload_pic.php?stt=3','userfile3','width=500,height=300');window.history.go(1)" >[ upload ]</a> </font><font color="#FF0000">*</font>(jpg, jpeg, gif, png)
                    </p>
					
					
                     <p>
                       
                        <?php echo $form->input('Setting.id',array('label' => '','type'=>'hidden'));?>
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

