<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        
        <h3>Video</h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1"></a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2" class="default-tab">Thêm</a></li>
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
                        <label>Tên công ty</label>
                           <?php echo $form->input('Video.name',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    <p>
                        <label>LinkUrl Youtube.com</label>
                       <?php echo $form->input('Video.LinkUrl',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    <p><label>Vị trí đặt</label>
                    <?php echo $form->radio('Video.left', array(0 => 'Trái', 1 => 'Phải'), array('value' => '1','legend'=>'',,'class'=>'text-input medium-input datepicker')); ?>
                	</p>
                    <input type="radio" value="0" id="ProductStatus0" name="data[Product][status]"> Chưa Active 
                    	&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="1" id="ProductStatus1" name="data[Product][status]"> Đã Active
                     <p>
                        <label>Trạng thái</label>
                         <?php echo $form->radio('Video.status', array(0 => 'Chưa Active', 1 => 'Đã Active'), array('value' => '1','legend'=>'','class'=>'text-input medium-input datepicker')); ?>  
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

