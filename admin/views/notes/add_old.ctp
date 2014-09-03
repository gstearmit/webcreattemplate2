<?php
	echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
	
	$select = 'Chọn danh mục';
	$name ='Tên bài viết';
	$not_active='Chưa kích hoạt';
	$active='Đã kích hoạt';
	if(isset($_GET['language'])){
		if($_GET['language']=='eng'){
			$select = 'Select Category';
			$date ='Creat date';
			$name ='News name';
			$not_active='Not Active';
			$active='Active';
		}else {
			$select = 'Chọn danh mục';
			$name ='Tên bài viết';
			$not_active='Chưa kích hoạt';
			$active='Đã kích hoạt';
		}
	}
	
	
?>
<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        
        <h3><?php __('Add_New')?></h3>
        
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
        
             <?php echo $form->create(null, array( 'url' => DOMAINAD.'notes/add','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>       
                
                <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                    <p>
                        <label><?php __('News_name')?> (VN)</label>
                           <?php echo $form->input('Note.title',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                            
                    </p>
                   <p>
                        <label><?php __('News_name')?> (ENG)</label>
                           <?php echo $form->input('Note.title_eg',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                           
                    </p>
                     <p>
                        <label><?php __('Category')?></label>              
                        <?php echo $this->Form->input('Note.category_id',array('type'=>'select','options'=>$list_cat,'empty'=>$select,'class'=>'small-input','label'=>''));?>
                    </p>
                     
                    <p>
                        <label><?php __('location')?> </label>
                           <?php echo $form->input('Note.location',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                           
                    </p>
                    <p>
                        <label><?php __('Summary_content')?> (VN)</label>
                         <?php 	echo $this->Form->input('Note.introduction',array('type'=>'textarea','label' => '')).$this->TvFck->create('Note.introduction',array('height'=>'100px','width'=>'900')); ?>
                    </p>
                    <p>
                        <label> <?php __('Summary_content')?> (ENG)</label>
                         <?php 	echo $this->Form->input('Note.introduction_eg',array('type'=>'textarea','label' => '')).$this->TvFck->create('Note.introduction_eg',array('height'=>'100px','width'=>'900')); ?>
                    </p>
                    <p>
                        <label><?php __('Content')?> (VN)</label>
                        <?php  echo $this->Form->input('Note.content',array('label' => '','type'=>'textarea')).$this->TvFck->create('Note.content',array('toolbar'=>'extra','height'=>'300px','width'=>'900')); ?>
                    </p>
                    <p>
                        <label><?php __('Content')?> (ENG)</label>
                        <?php  echo $this->Form->input('Note.content_eg',array('label' => '','type'=>'textarea')).$this->TvFck->create('Note.content_eg',array('toolbar'=>'extra','height'=>'300px','width'=>'900')); ?>
                    </p>
                     
                    <p>
                        <label><?php __('Avatar')?></label>
                         <input type="text" size="50" class="text-input medium-input datepicker" name="userfile" readonly="true"> &nbsp;<font color="#FF0000"> <a href="javascript:window.open('<?php echo DOMAINAD; ?>upload_pic1.php','userfile','width=500,height=300');window.history.go(1)" >[ upload ]</a> </font><font color="#FF0000">*</font>(jpg, jpeg, gif, png)
                    </p>
                    <p>
                        <label><?php __('Source_article')?></label>
                         <?php echo $form->input('Note.source',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    <p>
                        <label><?php __('status')?></label>
                         <?php echo $form->radio('Note.status', array(0 =>$not_active, 1 => $active), array('value' => '1','legend'=>'')); ?>
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