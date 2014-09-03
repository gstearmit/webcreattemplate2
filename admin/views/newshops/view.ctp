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
                        <li class='active'><?php __('Detail_News')?></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
 				<div class='row'>
                <div class='col-sm-12'>
                  <div class='box bordered-box green-border' style='margin-bottom:0;'>
                    <div class='box-header green-background'>
                      <div class='title'><?php __('Detail_News')?></div>
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
               <td width="250"><?php __('Title')?></td>
                <td>                      
                     <?php echo $views['Newshop']['title']?>
                </td>
              </tr>
			   <tr>
               <td width="100"><?php __('Summary_content')?></td>
                <td ><?php echo $views['Newshop']['introduction']; ?></td>
              </tr>
              
			    <tr >
                <td><?php __('Content')?></td>
                <td>                      
                    <?php echo $views['Newshop']['content']; ?>                                 
                </td>
              </tr>		
              <tr >
			   <td><?php __('Category')?></td>
                <td>
               <?php $cat= $this->requestAction('newshops/get_name/'.$views['Newshop']['categorynewsshop_id']);
						foreach($cat as $cat){
						echo $cat['Categorynewsshop']['name'];
						}
						?>
                </td> 
                <tr>
                 <td><?php __('Shop_name')?></td>
                <td>
              	<?php 
						
						$cat= $this->requestAction('newshops/get_shop/'.$views['Newshop']['user_id']);
					
						foreach($cat as $cat){
						echo $cat['Shop']['name'];
						}
						?>
						
                </td>
              </tr>
		
              <tr >
			    <td><?php __('Avatar')?></td>
                <td><img src="<?php echo DOMAINAD;?>/timthumb.php?src=<?php echo $views['Newshop']['images'];?>&amp;h=70&amp;w=100&amp;zc=1" alt="thumbnail" />
                </td>
              </tr>
             
              <tr>
                 <td><?php __('Source_article')?></td>
                <td>                      
                     <?php echo $views['Newshop']['source'];?>
                </td>
              </tr>			  			   
              <tr >
                <td><?php __('status')?></td>
                <td>
                    <?php if($views['Newshop']['status']==1){
                            echo 'Đã active';
                        }else echo 'Chưa ative';?>
                </td>
              </tr>
			  
			 
             <tr>                 
                 <td colspan="2">
                 <a href='<?php echo DOMAINAD ?>Newshops/index<?php echo  $langs ?> '>
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