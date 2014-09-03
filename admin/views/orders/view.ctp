<?php include 'views/elements/language.ctp';?>
<div class='row' id='content-wrapper'>
            <div class='col-xs-12'>
              <div class='row'>
                <div class='col-sm-12'>
                  <div class='page-header'>
                  	
                    <div class='pull-right'>
                      <ul class='breadcrumb'>
                        <li>
                          <a href='#'>
                            <i class='icon-bar-chart'></i>
                          </a>
                        </li>
                        <li class='separator'>
                          <i class='icon-angle-right'></i>
                        </li>
                        <li class='active'><?php __('Oder_detail')?></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
 				<div class='row'>
                <div class='col-sm-12'>
                  <div class='box bordered-box green-border' style='margin-bottom:0;'>
                    <div class='box-header green-background'>
                      <div class='title'><?php __('Oder_detail')?></div>
                      <div class='actions'>
                        <a class="btn box-remove btn-xs btn-link" href="#"><i class='icon-remove'></i>
                        </a>
                        
                        <a class="btn box-collapse btn-xs btn-link" href="#"><i></i>
                        </a>
                      </div>
                    </div>
                    <div class='box-content box-no-padding'>
                      <div class='responsive-table'>
                        <div class='scrollable-area'>
                          <table class='table table-bordered table-hover table-striped' style='margin-bottom:0;'>
                            <thead>
                              <tr>
                                <th>                          
                                </th>
                                <th>                                 
                                </th>                               
                              </tr>
                            </thead>
                            <tbody>                           
                             <tr>
                <td width="250"><?php __('Customer_Name')?></td>
                <td>                      
                     <?php echo $views['Order']['name']?>
                </td>
              </tr>
			   <tr>
                <td class="alternate-row"><?php __('Address')?></td>
                <td>                      
                     <?php echo $views['Order']['address'] ?>
                </td>
              </tr>
              
			    <tr >
                <td width="100"><?php __('Email')?></td>
                <td ><?php echo $views['Order']['email']; ?></td>
              </tr>
		
              <tr >
			    <td class="alternate-row"><?php __('Phone')?> </td>
				                <td>                      
			  <?php 
			  echo $views['Order']['phone'];
			 ?>

                </td>
			  
              
               <tr >
                <td width="100"><?php __('Date_set')?></td>
                <td ><?php echo $views['Order']['created']; ?></td>
              </tr>
		
              <tr >
			    <td class="alternate-row"><?php __('product_name')?> </td>
				                <td>                      
			  <?php 
			  echo $views['Order']['product_title'];
			 ?>

                </td>
              </tr>
             
              <tr>
                <td ><?php __('Number_product')?></td>
                <td>
                  <?php echo $views['Order']['soluong'];?>
                </td>
              </tr>
			  
			   
              <tr >
                <td class="alternate-row"><?php __('Total_amount')?></td>
                <td>
              	 <?php   echo $views['Order']['tongtien'];; ?>
						
                </td>
              </tr>
			   <tr >
                <td class="alternate-row"><?php __('Forms_payment')?></td>
                <td>
              	 <?php   echo $views['Order']['hinhthucthanhtoan'];; ?>
						
                </td>
              </tr>
			   <tr >
                <td class="alternate-row"><?php __('Payment')?>:</td>
                <td>
              	 <?php   if($views['Order']['status']) echo "Đã thanh toán"; else echo "Chưa thanh toán"; ?>
						
                </td>
              </tr>
              
               <tr>
                <td ><?php __('status')?></td>
                <td>
                    <?php if($views['Order']['dagiaohang']==1){
                            echo 'Đã giao hàng';
                        }else echo 'Chưa giao hàng';?>
					
                </td>
              </tr>
			 
             <tr>                 
                 <td colspan="2">
                 <a href='<?php echo DOMAINAD ?>orders/index<?php echo  $langs ?> '>
                 <input class="btn btn-success" style="margin-bottom:5px" value="<?php __('Back')?>" type="button">
                 </a>
                 </td>
                
            </tr>
                              
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
           </div>