<div class="content-box">
    <div class="content-box-header">
        
        <h3>Sửa  tỉnh / thành phố</h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1"></a></li> 
            <li><a href="#tab2" class="default-tab">Sửa  tỉnh / thành phố</a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div>
    <div class="content-box-content">
        
        <div class="tab-content" id="tab1"> 
        </div>
        
        <div class="tab-content default-tab" id="tab2">
        
             <?php echo $form->create(null, array( 'url' => DOMAINAD.'cities/edit','type' => 'post')); ?>	     
                
                <fieldset>
                    <p>
                        <label>Tên tỉnh / thành phố</label>
                        <?php echo $form->input('City.name',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                        <?php echo $form->input('City.id',array( 'label' => '','style'=>'display:none;'));?>
                    </p>
                   
                    <p>
                        <label>Trạng thái</label>
                        <?php echo $form->radio('City.status', array(0 => 'Chưa Active', 1 => 'Đã Active'), array('value' => '1','legend'=>'')); ?>
                    </p>
                    <p>
                        <input class="button" type="submit" value=" Sửa " />
                    </p>
                    
                </fieldset>
                
                <div class="clear"></div>
                
            <?php echo $form->end(); ?>
            
        </div>  
        
    </div> 
 </div>