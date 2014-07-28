<div class="content-box">
    <div class="content-box-header">
        
        <h3>Thêm mới </h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1"></a></li> 
            <li><a href="#tab2" class="default-tab">Thêm mới</a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div> 
    <div class="content-box-content">
        
        <div class="tab-content" id="tab1"> 
        </div>
        
        <div class="tab-content default-tab" id="tab2">
        
              <?php echo $form->create(null, array( 'url' => DOMAINAD.'manufacturers/add','type' => 'post','name'=>'image')); ?>	    
                
                <fieldset> 
                    <p>
                        <label>Tên Hãng</label>
                        <?php echo $form->input('Manufacturer.name',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                     <!--<p>
                        <label>Tên Danh mục lọc cha</label>              
                        <?php 
                              echo $form->select('Manufacturer.parent_id', $list_cat, null,array('empty'=>'Chọn danh mục lọc cha','class'=>'small-input'));
                         ?>
                    </p>-->

                    <p>
                        <label>Trạng thái</label>
                         <?php echo $form->radio('Manufacturer.status', array(0 => 'Chưa Active', 1 => 'Đã Active'), array('value' => '1','legend'=>'')); ?>
                    </p>
                    <p>
                        <input class="button" type="submit" value="Thêm mới" />
                    </p>
                    
                </fieldset>
                
                <div class="clear"></div>
                
            <?php echo $form->end(); ?>
            
        </div>
        
    </div>
 </div>
