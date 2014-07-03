<?php
	echo $this->Html->script(array('ckeditor/ckeditor','ckfinder/ckfinder'));
?>
  <link type="text/css" href="<?php echo DOMAIN ?>css/jquery.datepick.css" rel="stylesheet" /> 
<!-- Chon ngay -->
		<script type="text/javascript" src="<?php echo DOMAINAD?>js/date.js"></script>

	<!-- jquery.datePicker.js -->
		<script type="text/javascript" src="<?php echo DOMAINAD?>js/jquery.datePicker.js"></script>
	<script type="text/javascript" src="<?php echo DOMAIN;?>js/jquery.datepick.js"></script>	
		<script type="text/javascript" charset="utf-8">
	            $(function()
	            {
			$('.date-pick').datePicker({clickInput:true})
	            });
				
				
				$(function() {
	$('.popupDatepicker').datepick();

			});
				$(function() {
	$('.popupDatepicker1').datepick();

			});
			
			$(function() {
	$('.popupDatepicker2').datepick();

			});
			$(function() {
	$('.popupDatepicker3').datepick();

			});
			$(function() {
	$('.popupDatepicker4').datepick();

			});
			$(function() {
	$('.popupDatepicker5').datepick();

			});

		</script>
		
		<!-- datePicker required styles -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo DOMAINAD?>css/datePicker.css">
	
<!-- End chon ngay -->
<div class="content-box"><!-- Start Content Box -->
    <div class="content-box-header">
        
        <h3>Thêm mới</h3>
        
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
        
             <?php echo $form->create(null, array( 'url' => DOMAINAD.'products/add','type' => 'post','enctype'=>'multipart/form-data','name'=>'image')); ?>       
               
                <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                    <p>
                        <label>Tên sản phẩm (VN)</label>
                           <?php echo $form->input('Product.title',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    
                    
                    <p>
                        <label>Danh mục</label>  
                        <?php echo $this->Form->input('catproduct_id',array('type'=>'select','options'=>$list_cat,'empty'=>'Chọn danh mục','class'=>'small-input','label'=>''));?>
                    </p>
                    
                       <p>
                        <label>Tỉnh/Thành phố</label>  
                        
                        <?php echo $this->Form->input('city_id', array('type'=>'select', 'label'=>'', 'options'=>$list_cat1, 'default'=>'','empty'=>'Chọn thành phố'));?>
                    </p>
    
                    
                    <p>
                        <label>Giá mới</label>
                           <?php echo $form->input('Product.price',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    
                     <p>
                        <label>Giá cũ</label>
                           <?php echo $form->input('Product.price_old',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    
                    
                    <p>
              
                  <label for="date1">Ngày bắt đầu giảm giá:</label>
                     <input type="text" name="date_batdau" class="popupDatepicker datepicker" style="width:200px;"/>
                        
                 </p>   
                 
                   <p>
              
                  <label for="date2">Ngày kết thúc giảm giá:</label>
                  <input type="text" name="date_ketthuc" class="popupDatepicker1 datepicker" style="width:200px;"/>
                   
             
                 </p>   
                      <p>
              
                  <label for="date2">Từ ngày:</label>
                  <input type="text" name="date1" class="popupDatepicker2 datepicker" style="width:200px;"/>
                   
             
                 </p>   
				 <p>
              
                  <label for="date2">Đến ngày:</label>
                  <input type="text" name="date2" class="popupDatepicker3 datepicker" style="width:200px;"/>
                   
             
                 </p>   
                    
                     <p>
                        <label>Giá</label>
                           <?php echo $form->input('Product.price1',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    
                     <p>
              
                  <label for="date2">Từ ngày:</label>
                  <input type="text" name="date3" class="popupDatepicker4 datepicker" style="width:200px;"/>
                   
             
                 </p>   
				 <p>
              
                  <label for="date2">Đến ngày:</label>
                  <input type="text" name="date4" class="popupDatepicker5 datepicker" style="width:200px;"/>
                   
             
                 </p>   
                    
                     <p>
                        <label>Giá</label>
                           <?php echo $form->input('Product.price2',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    
                      <p>
                        <label>Số lượng sản phẩm</label>
                           <?php echo $form->input('Product.soluong',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    <p>
                        <label>Số lượng đã bán</label>
                           <?php echo $form->input('Product.daban',array( 'label' => '','class'=>'text-input medium-input datepicker'));?>
                    </p>
                    
                    
                    
                    <p>
                        <label>Mô tả tóm tắt sản phẩm </label>
                        <?php  echo $this->Form->input('Product.introduction',array('label' => '','type'=>'textarea')).$this->TvFck->create('Product.introduction',array('toolbar'=>'extra','height'=>'300px','width'=>'900')); ?>
                    </p>
                   
                       <p>
                        <label>Mô tả chi tiết sản phẩm </label>
                        <?php  echo $this->Form->input('Product.content',array('label' => '','type'=>'textarea')).$this->TvFck->create('Product.content',array('toolbar'=>'extra','height'=>'300px','width'=>'900')); ?>
                    </p>
                   
                   
                    <p>
                        <label>Nội dung 1</label>
                        <?php  echo $this->Form->input('Product.content_1',array('label' => '','type'=>'textarea')).$this->TvFck->create('Product.content_1',array('toolbar'=>'extra','height'=>'300px','width'=>'900')); ?>
                    </p>
                    <p>
                        <label>Nội dung 2</label>
                        <?php  echo $this->Form->input('Product.content_2',array('label' => '','type'=>'textarea')).$this->TvFck->create('Product.content_2',array('toolbar'=>'extra','height'=>'300px','width'=>'900')); ?>
                    </p>
                     <p>
                        <label>Nội dung 3</label>
                        <?php  echo $this->Form->input('Product.content_3',array('label' => '','type'=>'textarea')).$this->TvFck->create('Product.content_3',array('toolbar'=>'extra','height'=>'300px','width'=>'900')); ?>
                    </p>
                    
                    
                    <p>
                        <label>Ảnh đại diện </label>
                         <input type="text" size="50" class="text-input medium-input datepicker" name="userfile1" readonly="true"> &nbsp;<font color="#FF0000"> <a href="javascript:window.open('<?php echo DOMAINAD; ?>upload_pic.php?stt=1','userfile1','width=500,height=300');window.history.go(1)" >[ upload ]</a> </font><font color="#FF0000">*</font>(jpg, jpeg, gif, png)
                    </p>
					
					 <p>
                        <label>Background </label>
                         <input type="text" size="50" class="text-input medium-input datepicker" name="userfile2" readonly="true"> &nbsp;<font color="#FF0000"> <a href="javascript:window.open('<?php echo DOMAINAD; ?>upload_pic.php?stt=2','userfile2','width=500,height=300');window.history.go(1)" >[ upload ]</a> </font><font color="#FF0000">*</font>(jpg, jpeg, gif, png)
                    </p>
                   
                     
                      <p>
                        <label>Trạng thái</label>
                         <?php echo $form->radio('Product.status', array(0 => 'Chưa Active', 1 => 'Đã Active'), array('value' => '1','legend'=>'')); ?>
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

