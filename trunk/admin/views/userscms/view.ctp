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
                        <li class='active'><?php __('Detail_account')?></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
 				<div class='row'>
                <div class='col-sm-12'>
                  <div class='box bordered-box green-border' style='margin-bottom:0;'>
                    <div class='box-header green-background'>
                      <div class='title'><?php __('Detail_account')?>: "<?php echo $views['Userscm']['name']?>" </div>
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
                <td> <?php __('Username')?> </td>
                <td>                      
                     <?php echo $views['Userscm']['shopname']?>
                </td>
              </tr>
			   <tr>
                 <td class="alternate-row"><?php __('Shop_name')?></td>
                <td>                      
                     <?php
					$cat= $this->requestAction('userscms/get_shop/'.$views['Userscm']['id']);
					$loai="NO";$date='Chưa tạo';
					$name="Chưa đăng ký mở gian hàng";
					foreach($cat as $cat){
					$date=$cat['Shop']['created'];
					$name= $cat['Shop']['name'];
					if($cat['Shop']['loai']) $loai="YES";
					}
					echo $name;
					 ?>
                </td>
              </tr>
              
			    <tr >
                <td width="100"> <?php __('Featured_booth')?></td>
                <td ><?php echo $loai; ?></td>
              </tr>
		
              <tr >
			    <td class="alternate-row"><?php __('Creat_date')?></td>
				 <td>                      
			  <?php 
			  echo $date;?>
			      
                </td>
			                
               <tr >
                <td ><?php __('Email')?></td>
                <td>
                <?php echo $views['Userscm']['email']; ?>
                </td>
              </tr>
		
              <tr >
			    <td class="alternate-row"><?php __('Phone')?></td>
                <td>
              	 <?php echo $views['Userscm']['phone']; ?>
						
                </td>
              </tr>
             
              <tr>
               <td ><?php __('Sex')?></td>
                <td>
					<?php if($views['Userscm']['sex']==1) echo "Nam"; else echo "Nữ"; ?>
				</td>
              </tr>
			  
			   
              <tr >
               <td class="alternate-row"><?php __('Date_Registration')?></td>
                <td>                      
                     <?php echo $views['Userscm']['created'];?>
                </td>
              </tr>
			   <tr >
                 <td ><?php __('status')?></td>
                <td>
                    <?php if($views['Userscm']['status']==1){
                            echo 'Đã active';
                        }else echo 'Chưa ative';?>
                </td>
              </tr>
			                 
               
             <tr>                 
                 <td colspan="2">
                 <a href='<?php echo DOMAINAD ?>userscms/index<?php echo  $langs ?> '>
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