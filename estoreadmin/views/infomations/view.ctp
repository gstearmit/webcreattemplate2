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
                        <li class='active'><?php __('Chi tiết hóa đơn')?></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
 				<div class='row'>
                <div class='col-sm-12'>
                  <div class='box bordered-box green-border' style='margin-bottom:0;'>
                    <div class='box-header green-background'>
                      <div class='title'><?php __('Chi tiết hóa đơn')?></div>
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
                <td colspan="3">                      
                    <?php echo $views['Infomation']['name']?>
                </td>
              </tr>
			   <tr>
                <td class="alternate-row"><?php __('Address')?></td>
                <td colspan="3">                      
                     <?php echo $views['Infomation']['address']?>
                </td>
              </tr>
              
			    <tr >
                <td width="100"><?php __('Email')?></td>
                <td colspan="3"> <?php echo $views['Infomation']['email']?></td>
              </tr>
		
              <tr >
			    <td class="alternate-row"><?php __('Phone')?> </td>
				 <td colspan="3">                      
			   <?php echo $views['Infomation']['mobile']?>

                </td>
			  </tr>
			  <tr><td colspan="4"><b><h3>THÔNG TIN ĐƠN HÀNG</h3></b></td></tr>
			
			<tr>			
				<td>Tên sản phẩm</td>				
				<td>Ảnh sản phẩm</td>				
				<td>Số lượng</td>				
				<td>Giá</td>				
			</tr>
			<?php foreach($information as $view){?>
			<tr>
				<td><?php echo $view['Infomationdetail']['name'];?></td>							
				<td><img width="100" src="<?php echo DOMAINADESTORE;?><?php echo $view['Infomationdetail']['images'];?>" /></td>				
				<td><?php echo $view['Infomationdetail']['quantity']?></td>				
				<td><?php echo $view['Infomationdetail']['price']?></td>				
			</tr>
			<?php }?>
			 <tr>
                <td width="250">Tổng tiền</td>
                <td colspan="3">                      
                     <?php echo $views['Infomation']['total']?>
                </td>
              </tr>
              
               
			  
			 
			 
             <tr>                 
                 <td colspan="2">
                 <a href='<?php echo DOMAINADESTORE ?>infomations/index<?php echo  $langs ?> '>
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