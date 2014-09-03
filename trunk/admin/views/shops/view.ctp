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
                        <li class='active'><?php __('Detail_shop')?></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
 				<div class='row'>
                <div class='col-sm-12'>
                  <div class='box bordered-box green-border' style='margin-bottom:0;'>
                    <div class='box-header green-background'>
                      <div class='title'><?php __('Detail_shop')?>: <?php echo $views['Shop']['name']?> </div>
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
                 <td width="250"><?php __('Shop_name')?></td>
                <td>                      
                     <?php echo $views['Shop']['name']?>
                </td>
              </tr>
			   <tr>
                <td class="alternate-row"><?php __('Featured_booth')?></td>
                <td>                      
                     <?php if ($views['Shop']['name']) echo "YES"; else echo "NO"; ?>
                </td>
              </tr>
              <td width="100"><?php __('Creat_date')?></td>
                <td ><?php echo $views['Shop']['created']; ?></td>
              </tr>
		
              <tr >
			     <td class="alternate-row"><?php __('Name')?> </td>
				                <td>                      
			  <?php 
			  echo $views['Shop']['user_id'];
			  $cat= $this->requestAction('shops/get_userscms/'.$views['Shop']['user_id']);
			
			  foreach($cat as $cat){
			    echo $cat['Userscms']['name']; ?>
			  </td>
              
               <tr >
               <td >Email</td>
                <td>
                <?php echo $cat['Userscms']['email']; ?>
                </td>
              </tr>
		
              <tr >
			     <td class="alternate-row">Điện thoại</td>
                <td>
              	 <?php echo $cat['Userscms']['phone']; ?>
						
                </td>
              </tr>
             
              <tr>
                 <td >Giới tính</td>
                <td>
					<?php if($cat['Userscms']['sex']==1) echo "Nam"; else echo "Nữ"; ?>
				</td>
              </tr>
			  
			   
              <tr >
                <td class="alternate-row">Ngày đăng ký</td>
                <td>                      
                     <?php echo $cat['Userscms']['created'];?>
                </td>
              </tr>
			   <tr>
                <td >Trạng thái</td>
                <td>
                    <?php if($cat['Userscms']['status']==1){
                            echo 'Đã active';
                        }else echo 'Chưa ative';?>
                </td>
              </tr>
			  <?php }?>
			  
			 
             <tr>                 
                 <td colspan="2">
                 <a href='<?php echo DOMAINAD ?>shops/index<?php echo  $langs ?> '>
                 <input class="btn btn-success" style="margin-bottom:5px" value="<?php __('Back')?>i" type="button">
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