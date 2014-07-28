<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        
        <h3>Video</h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1"></a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2" class="default-tab">Sửa</a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        
        <div class="tab-content" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
        </div> <!-- End #tab1 -->
        
        <div class="tab-content default-tab" id="tab2">
        
             <?php echo $form->create(null, array( 'url' => DOMAINAD.'videos/edit','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>       
                
                <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                    <p>
                        <label>Tên công ty</label>
                           <?php echo $form->input('Video.name',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    
                   <p>
                        <label>LinkUrl Youtube.com</label>
                       <?php echo $form->input('Video.LinkUrl',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    <p><label>Vị trí đặt</label>
                    <input type="radio" value="0" id="ProductStatus0" name="data[Video][left]"> Bên Trái 
                    	&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="1" id="ProductStatus1" name="data[Video][left]"> Bên phải
                    
                	</p>
                     <p>
                        <label>Trạng thái</label>
                        <?php echo $form->input('Video.id',array('label' => '','type'=>'hidden'));?>
                         
                         <input type="radio" value="0" id="ProductStatus0" name="data[Video][status]"/> Chưa Active 
                    	&nbsp;&nbsp;&nbsp;<input type="radio" checked="checked" value="1" id="ProductStatus1" name="data[Video][status]"/> Đã Active
                      
                    </p>
                    <p>
                        <input class="button" type="submit" value=" Sửa " />
                    </p>
                    
                </fieldset>
                
                <div class="clear"></div><!-- End .clear -->
                
            <?php echo $form->end(); ?>
            
        </div> <!-- End #tab2 -->        
        
    </div> <!-- End .content-box-content -->
 </div>

