<?php
	echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
?>
<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        
        <h3>Thêm mới sản phẩm</h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1"></a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2" class="default-tab">Thêm mới</a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        
        <div class="tab-content" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
        </div> <!-- End #tab1 -->
        
        <div class="tab-content default-tab" id="tab2">
        
             <?php echo $form->create(null, array( 'url' => DOMAINAD.'abouts/add','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>       
               
                <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                    <p>
                        <label>Tiêu đề (VN)</label>
                           <?php echo $form->input('name',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    <p>
                        <label>Tiêu đề (ENG)</label>
                           <?php echo $form->input('name_eg',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                  
                    <p>
                        <label>Nội dung (VN)</label>
                        <?php  echo $this->Form->input('content',array('label' => '','type'=>'textarea')).$this->TvFck->create('About.content',array('toolbar'=>'extra','height'=>'300px','width'=>'900')); ?>
                    </p>
                    <p>
                        <label>Nội dung (ENG)</label>
                        <?php  echo $this->Form->input('content_eg',array('label' => '','type'=>'textarea')).$this->TvFck->create('About.content_eg',array('toolbar'=>'extra','height'=>'300px','width'=>'900')); ?>
                    </p>
                    
                    
					
					<p>
                        <label>Vị trí</label>
                           <?php echo $form->input('char',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                
                      <p>
                        <label>Trạng thái</label>
                         <?php echo $form->radio('status', array(0 => 'Chưa Active', 1 => 'Đã Active'), array('value' => '1','legend'=>'')); ?>
                    </p>
                     
                    
                    <p>
                        <input class="button" type="submit" value="Thêm mới" />
                    </p>
                    
                </fieldset>
                
                <div class="clear"></div><!-- End .clear -->
                
            <?php echo $form->end(); ?>
            
        </div> <!-- End #tab2 -->        
        
    </div> <!-- End .content-box-content -->
 </div>

