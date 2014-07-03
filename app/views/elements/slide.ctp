  <style>
  .p-top a{color:white;}
  .p-top a:hover{color:red;}
  </style>
   <link type="text/css" href="<?php echo DOMAIN?>css/slider.css" rel="stylesheet">
    <?php if($session->read('lang')==1) {?>      		
      			
      												<div class="content">
                                                                <ul>
                                                                
                                                                	 <?php
												                        $sqnb=$this->requestAction('comment/spnb');
												                       
												                        foreach ($sqnb as $sqnb){
												                     
												                        	
												                     ?>
                                                              
                                                                    <li>    
                                                                                <div style="float:left">
                                                                                <a href="<?php echo DOMAIN?>spnb/index/<?php echo $sqnb['Spnb']['id'] ?>">
                                                                                    <img class="img-sl" src="<?php echo DOMAINAD.$sqnb['Spnb']['images1']?>"/>
                                                                                    </a>
                                                                                 </div>
                                                                                 
                                                                              
                                                          
                                                                    </li>
                                                                    
                                                                    <li>    
                                                                                <div style="float:left">
                                                                                <a href="<?php echo DOMAIN?>spnb/index/<?php echo $sqnb['Spnb']['id'] ?>">
                                                                                    <img class="img-sl" src="<?php echo DOMAINAD.$sqnb['Spnb']['images2']?>"/>
                                                                                    </a>
                                                                                 </div>
                                                                                 
                                                                              
                                                          
                                                                    </li>
                                                                    <li>    
                                                                                <div style="float:left">
                                                                                <a href="<?php echo DOMAIN?>spnb/index/<?php echo $sqnb['Spnb']['id'] ?>">
                                                                                    <img class="img-sl" src="<?php echo DOMAINAD.$sqnb['Spnb']['images3']?>"/>
                                                                                    </a>
                                                                                 </div>
                                                                                 
                                                                              
                                                          
                                                                    </li>
                                                                    <li>    
                                                                                <div style="float:left">
                                                                                <a href="<?php echo DOMAIN?>spnb/index/<?php echo $sqnb['Spnb']['id'] ?>">
                                                                                    <img class="img-sl" src="<?php echo DOMAINAD.$sqnb['Spnb']['images4']?>"/>
                                                                                    </a>
                                                                                 </div>
                                                                                 
                                                                              
                                                          
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            
                                                            <a href="#" class="carousel-prev"></a> 
                                                            <a href="#" class="carousel-next"></a>  
                                                            
                                                          
                                                            				<div class="product-display">
                                                                                  
                                                                                 <div class="p-top" style="text-align:center;"> 
                                                                                 
                                                                                 <p style="font-size:40px; font-family:Time New Roman; margin-top:40px;text-align:center;">
                                                                                 <a  href="<?php echo DOMAIN?>spnb/index/<?php echo $sqnb['Spnb']['id'] ?>">
                                                                                 <?php echo $sqnb['Spnb']['name']?></a></p>
                                                                                 <p style="font-size:16px; margin-top:10px;text-align:center;">
                                                                                <?php echo $sqnb['Spnb']['introduction']?>
                                                                                </p>
                                                                                </div>
                                                                               <div class="p-bot">Sản phẩm nổi bật</div>
                                                                               </div>
                                                                               
                                                                               <?php }?>
                                                            
             <?php }?> 
             
             
                <?php if($session->read('lang')==2) {?>      		
      				<div class="content">
                                                                <ul>
                                                                
                                                                	 <?php
												                        $sqnb=$this->requestAction('comment/spnb');
												                       
												                        foreach ($sqnb as $sqnb){
												                     
												                        	
												                     ?>
                                                              
                                                                    <li>    
                                                                                <div style="float:left">
                                                                                <a href="<?php echo DOMAIN?>spnb/index/<?php echo $sqnb['Spnb']['id'] ?>">
                                                                                    <img class="img-sl" src="<?php echo DOMAINAD.$sqnb['Spnb']['images1']?>"/>
                                                                                    </a>
                                                                                 </div>
                                                                                 
                                                                              
                                                          
                                                                    </li>
                                                                    
                                                                    <li>    
                                                                                <div style="float:left">
                                                                                <a href="<?php echo DOMAIN?>spnb/index/<?php echo $sqnb['Spnb']['id'] ?>">
                                                                                    <img class="img-sl" src="<?php echo DOMAINAD.$sqnb['Spnb']['images2']?>"/>
                                                                                    </a>
                                                                                 </div>
                                                                                 
                                                                              
                                                          
                                                                    </li>
                                                                    <li>    
                                                                                <div style="float:left">
                                                                                <a href="<?php echo DOMAIN?>spnb/index/<?php echo $sqnb['Spnb']['id'] ?>">
                                                                                    <img class="img-sl" src="<?php echo DOMAINAD.$sqnb['Spnb']['images3']?>"/>
                                                                                    </a>
                                                                                 </div>
                                                                                 
                                                                              
                                                          
                                                                    </li>
                                                                    <li>    
                                                                                <div style="float:left">
                                                                                <a href="<?php echo DOMAIN?>spnb/index/<?php echo $sqnb['Spnb']['id'] ?>">
                                                                                    <img class="img-sl" src="<?php echo DOMAINAD.$sqnb['Spnb']['images4']?>"/>
                                                                                    </a>
                                                                                 </div>
                                                                                 
                                                                              
                                                          
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            
                                                            <a href="#" class="carousel-prev"></a> 
                                                            <a href="#" class="carousel-next"></a>  
                                                            
                                                          
                                                            				<div class="product-display">
                                                                                  
                                                                                 <div class="p-top" style="text-align:center;"> 
                                                                                 
                                                                                 <p style="font-size:25px; margin-top:40px;text-align:center;">
                                                                                 <a  href="<?php echo DOMAIN?>spnb/index/<?php echo $sqnb['Spnb']['id'] ?>">
                                                                                 <?php echo $sqnb['Spnb']['name_eg']?></a></p>
                                                                                 <p style="font-size:16px; margin-top:10px;text-align:center;">
                                                                                <?php echo $sqnb['Spnb']['introduction_eg']?>
                                                                                </p>
                                                                                </div>
                                                                               <div class="p-bot">Product Highlights</div>
                                                                               </div>
                                                                               
                                                                               <?php }?>
                                                            
             <?php }?>                                                                            
                                                               