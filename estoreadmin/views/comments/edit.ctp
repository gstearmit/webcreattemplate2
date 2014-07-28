 <div id="news">
              <div style="top:180px;" id="title-news" style="top:180px;"><p>Thêm mới</p></div>
                 <div  class="list-news" >
                    <?php echo $form->create(null, array( 'url' => DOMAINAD.'comments/edit','type' => 'post')); ?>	
                <table style="text-align:left;" border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                  <tr>
                    <td>Tiêu đề</td>
                    <td>
                   <?php echo $form->input('Comments.name',array('label'=>'','style'=>'width:400px;hieght:25px;'));?>
                    <?php echo $form->input('Comments.id',array('label'=>'','style'=>'width:400px;hieght:25px;'));?>
                   </td>
                  </tr>
                   <tr  class="alternate-row">
                    <td>Email</td>
                   <td >
                    <?php echo $form->input('Comments.email',array('label'=>'','style'=>'width:400px;hieght:25px;'));?>
                    </td>
                  </tr>
                   <tr  class="alternate-row">
                    <td>Nội Dung</td>
                   <td >
                    <?php echo $form->textarea('Comments.content',array('label'=>'','style'=>'width:400px;'));?>
                    </td>
                  </tr>
                  <tr>
                    <td>Trạng thái</td>
                    <td>
                    	<?php echo $form->radio('Comments.status',array(0=>'Chưa Active',1=>'Đã Active'),array('legend'=>'')) ?>                      
                    </td>
                       
                  </tr>
                 <tr>
                    <td colspan="2"><input type="submit" class="submit-login" value="Sửa"  /></td>
		</tr>
                </table>
                <!--  end product-table................................... -->
              <?php echo $form->end(); ?>	
            </div>
              </div>
</div>
