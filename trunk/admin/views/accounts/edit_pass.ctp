<div id="news">
              <div style="top:180px;" id="title-news"><p><?php __('Change_account')?></p></div>
                 <div class="list-news">
                    
                <?php echo $form->create(null, array( 'url' => DOMAINAD.'accounts/check_pass','type' => 'post')); ?>	
                <table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                  <tr>
                    <td><?php __('Username')?></td>
                    <td>
                    <?php echo $form->input('User.id',array( 'label' => '','type'=>'hidden','style'=>'width:250px;height:25px;'));?> 
                    <?php echo $form->input('User.name',array( 'label' => '','style'=>'width:250px;height:25px;'));?>
                    </td>
                  </tr>
                   <tr  class="alternate-row">
                    <td><?php __('Email_password_retrieval')?></td>
                    <td > <?php echo $form->input('User.email',array( 'label' => '','style'=>'width:250px;height:25px;'));?> </td>
                  </tr>
                  <tr >
                    <td><?php __('Old_password')?></td>
                    <td>
                      <?php echo $form->input('User.pass_old',array( 'label' => '','type'=>'password','style'=>'width:250px;height:25px;'));?>
                    </td>
                  </tr>
                  <tr  class="alternate-row">
                    <td><?php __('New_password')?></td>
                    <td > <?php echo $form->input('User.pass_new',array( 'label' => '','type'=>'password','style'=>'width:250px;height:25px;'));?> 					                    </td>
                  </tr>
                                   
                 <tr>
                    <td colspan="2"><input type="submit" class="submit-login" value="<?php __('Edit')?>"  /></td>
				</tr>
                </table>
                <!--  end product-table................................... -->
                 <?php echo $form->end(); ?>	
              </div>
</div>
