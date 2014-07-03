<link type="text/css" href="<?php echo DOMAIN?>css/new.css" rel="stylesheet" />
<link style="text/css" rel="stylesheet" href="<?php echo DOMAIN?>css/style1.css"/>
  <?php if($session->read('lang')==1) {?>
            <div id="content">
             <div class="dd">
      
         
            	<ul><li><a href="<?php echo DOMAIN?>">Trang chủ /</a></li>
            		 <?php $row=$this->requestAction('/comment/catproduct');
					  
					  foreach ($row as $row){
					  ?>
					  
					<li class="li-cuoi"><a href="<?php echo DOMAIN?>danh-sach-du-an">Dự án</a>
					<?php break;}?>
            	</ul>
            </div><!-- End dd -->
           
            <div class="bor-content">
            
            
            
            	<div class="content-left">
            	
            	<div class="menu-left">
            		<div class="video-title"><h2>DANH MỤC DỰ ÁN</h2></div>
            		<div class="mn-bd">
            		
            			<ul>
            			 <?php $catproduct=$this->requestAction('/comment/catproduct');
					  
					  foreach ($catproduct as $catproduct){
					  ?>
					  <li class="li-mn">
					  	<a href="<?php echo DOMAIN?>du-an/<?php echo $catproduct['Catproduct']['id']?>">
					  		<?php echo $catproduct['Catproduct']['name']?>
					  	</a>
					  </li>
					  <?php }?>
            				
            			</ul>
            			</div>
            		</div><!-- End menu-left -->
            		<div style="margin-top:20px;">
            		<?php echo $this->element('help');?>
            		</div>
            			
            		<?php echo $this->element('video');?>
            		<?php echo $this->element('tigia');?>  	
            	</div><!-- End content-left -->
            	
            	
            	
            	<div class="content-right">
            		<div class="tit-right">
            			<h2 style="font-size:18px; font-wight:bold;color:#65390d;padding-top:15px;">KẾT QUẢ TÌM KIẾM DỰ ÁN</h2>
            		</div>
            	
            		<div class="bd-right">
            		
            		   <?php foreach($prod as $row) {?>
                                    <div class="new" style="border-bottom:1px solid #f1e1bf; padding-bottom:10px;">
                                        <div class="new-img">
                                            <img src="<?php echo DOMAINAD.$row['Catproduct']['images'];?>" />
                                        </div><!-- End new-img-->
                                        
                                        <div class="new-content">
                                        	<ul>
                                            	<li><p style="color:#65390d; font-weight:bold; font-size:14px;">
                                                	<?php echo $row['Catproduct']['name'];?>
                                                </p></li>
                                                <li style="color:#65390d;"><?php echo $row['Catproduct']['introduction'];?></li>
                                                <li><a class="a-ct" href="<?php echo DOMAIN?>du-an/<?php echo $row['Catproduct']['id']?>">Chi tiết</a></li>
                                            </ul>
                                        </div><!-- End new-content-->
                                    
                                    </div><!-- End new-->
                                    
                                  <?php }?>  
                                  
                                  
                                    <div class="pt">
                                   	<div class="pt-pagi">
                                   	     
							    
							     <?php 
							echo $paginator->numbers();
							     
							     
                                   	
		 							?>		
                                      </div><!-- End pt-pagi-->
                                     </div><!-- End pt-->
            		</div>
            	
            	</div><!-- ENd content-right -->
            		
            </div><!-- End bor-content -->		
          <?php echo $this->element('partner');?>  		
            		
            </div><!-- End content-->
            <?php }?>
            
            
            
            <?php if($session->read('lang')==2) {?>
            <div id="content">
             <div class="dd">
      
         
            	<ul><li><a href="<?php echo DOMAIN?>">Home /</a></li>
            		 <?php $row=$this->requestAction('/comment/catproduct');
					  
					  foreach ($row as $row){
					  ?>
					  
					<li class="li-cuoi"><a href="<?php echo DOMAIN?>danh-sach-du-an">Project</a>
					<?php break;}?>
            	</ul>
            </div><!-- End dd -->
           
            <div class="bor-content">
            
            
            
            	<div class="content-left">
            	
            	<div class="menu-left">
            		<div class="video-title"><h2>LIST OF PROJECTS</h2></div>
            		<div class="mn-bd">
            		
            			<ul>
            			 <?php $catproduct=$this->requestAction('/comment/catproduct');
					  
					  foreach ($catproduct as $catproduct){
					  ?>
					  <li class="li-mn">
					  	<a href="<?php echo DOMAIN?>du-an/<?php echo $catproduct['Catproduct']['id']?>">
					  		<?php echo $catproduct['Catproduct']['name_eg']?>
					  	</a>
					  </li>
					  <?php }?>
            				
            			</ul>
            			</div>
            		</div><!-- End menu-left -->
            		<div style="margin-top:20px;">
            		<?php echo $this->element('help');?>
            		</div>
            			
            		<?php echo $this->element('video');?>
            		<?php echo $this->element('tigia');?>  	
            	</div><!-- End content-left -->
            	
            	
            	
            	<div class="content-right">
            		<div class="tit-right">
            			<h2 style="font-size:18px; font-wight:bold;color:#65390d;padding-top:15px;">SEARCH RESULTS</h2>
            		</div>
            	
            		<div class="bd-right">
            		
            		   <?php foreach($prod as $row) {?>
                                    <div class="new" style="border-bottom:1px solid #f1e1bf; padding-bottom:10px;">
                                        <div class="new-img">
                                            <img src="<?php echo DOMAINAD.$row['Catproduct']['images'];?>" />
                                        </div><!-- End new-img-->
                                        
                                        <div class="new-content">
                                        	<ul>
                                            	<li><p style="color:#65390d; font-weight:bold; font-size:14px;">
                                                	<?php echo $row['Catproduct']['name_eg'];?>
                                                </p></li>
                                                <li style="color:#65390d;"><?php echo $row['Catproduct']['introduction_eg'];?></li>
                                                <li><a class="a-ct" href="<?php echo DOMAIN?>du-an/<?php echo $row['Catproduct']['id']?>">Details</a></li>
                                            </ul>
                                        </div><!-- End new-content-->
                                    
                                    </div><!-- End new-->
                                    
                                  <?php }?>  
                                  
                                  
                                    <div class="pt">
                                   	<div class="pt-pagi">
                                   	     
							    
							     <?php 
							echo $paginator->numbers();
							     
							     
                                   	
		 							?>		
                                      </div><!-- End pt-pagi-->
                                     </div><!-- End pt-->
            		</div>
            	
            	</div><!-- ENd content-right -->
            		
            </div><!-- End bor-content -->		
          <?php echo $this->element('partner');?>  		
            		
            </div><!-- End content-->
            <?php }?>
		
		