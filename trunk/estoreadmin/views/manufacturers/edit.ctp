<?php 
$Active ='Đã Active';
$not_Active ='Chưa Active';
if(isset($_GET['language'])){
	if($_GET['language']=='eng'){
		$Active ='Active';
		$not_Active ='Not Active';
	}else {
		$Active ='Đã Active';
		$not_Active ='Chưa Active';
	}
	
}
?>
<div class="content-box">
    <div class="content-box-header">
        
        <h3><?php __('Edit_information')?></h3>
        
        <ul class="content-box-tabs">
            <li><a href="#tab1"></a></li>
            <li><a href="#tab2" class="default-tab"><?php __('Edit')?></a></li>
        </ul>
        
        <div class="clear"></div>
        
    </div>
    <div class="content-box-content">
        
        <div class="tab-content" id="tab1">
        </div>
        
        <div class="tab-content default-tab" id="tab2">
        
               <?php echo $form->create(null, array( 'url' => DOMAINADESTORE.'manufacturers/edit/Catproduct.id','type' => 'post','name'=>'image')); ?>	
                
                <fieldset> 
                    <p>
                        <label><?php __('Brand_name')?></label>
                        <?php echo $form->input('Manufacturer.name',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                     <!--<p>
                        <label>Tên Danh mục lọc cha</label>              
                        <?php 
                              echo $form->select('Manufacturer.parent_id', $list_cat, null,array('empty'=>'Chọn danh mục lọc cha','class'=>'small-input'));
                         ?>-->
                    </p>

                    <p>
                        <label><?php __('Status')?></label>
                        <?php echo $form->input('Manufacturer.id',array('label' => '','type'=>'hidden'));?>
                        <?php echo $form->radio('Manufacturer.status',array(0=>$not_Active,1=>$Active),array('legend'=>'')) ?> 
                    </p>
                    <p>
                        <input class="button" type="submit" value="<?php __('Edit')?>" />
                    </p>
                    
                </fieldset>
                
                <div class="clear"></div>
                
            <?php echo $form->end(); ?>
            
        </div>
        
    </div> 
 </div>
