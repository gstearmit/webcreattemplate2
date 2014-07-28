<div class="content-box">
    <div class="content-box-header">
        
        <h3>Chỉnh sửa tên Album</h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1"></a></li>
            <li><a href="#tab2" class="default-tab">Sửa</a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div>
    <div class="content-box-content">
        
        <div class="tab-content" id="tab1">
        </div>
        
        <div class="tab-content default-tab" id="tab2">
        
               <?php echo $form->create(null, array( 'url' => DOMAINAD.'album/edit/Catproduct.id','type' => 'post','name'=>'image')); ?>	
                
                <fieldset> 
                    <p>
                        <label>Tên Album</label>
                        <?php echo $form->input('Album.name',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
              
                    <p>
                        <label>Ảnh đại diện( Chú ý nên up ảnh cỡ chuẩn: width: 105px - height:105px)</label>            
                         <input type="text" size="50" style="height:25px;"  value="<?php echo $edit['Album']['images']?>" name="userfile" readonly="true"/> &nbsp;<font color="#FF0000"> <a href="javascript:window.open('<?php echo DOMAINAD; ?>upload_pic.php','userfile','width=500,height=300');window.history.go(1)" >[ upload ]</a> </font><font color="#FF0000">*</font>(jpg, jpeg, gif, png)
                    </p>

                    <p>
                        <label>Trạng thái</label>
                        <?php echo $form->input('Album.id',array('label' => '','type'=>'hidden'));?>
                        <?php echo $form->radio('Album.status',array(0=>'Chưa Active',1=>'Đã Active'),array('legend'=>'')) ?> 
                    </p>
                    <p>
                        <input class="button" type="submit" value="Cập nhật" />
                    </p>
                    
                </fieldset>
                
                <div class="clear"></div>
                
            <?php echo $form->end(); ?>
            
        </div>
        
    </div> 
 </div>
