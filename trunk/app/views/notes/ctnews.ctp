
<link style="text/css" rel="stylesheet" href="<?php echo DOMAIN?>css/style1.css"/>
<link style="text/css" rel="stylesheet" href="<?php echo DOMAIN?>css/new.css"/>
<style>
.tin-moi {
    margin-bottom: 30px;
    margin-left: 20px;
    overflow: hidden;
    
    width: 685px;
}
.tin-moi ul {
    margin-top: 10px;
}
.tin-moi li {
    float: left;
    margin-top: 5px;
    width: 695px;
}
.tin-moi li a {
    color: #65390d;
}
.tin-moi li a:hover {
    color: red;
}
.td-timmoi{border-top:6px solid #cdaf7a; overflow:hidden;padding-bottom:10px;}

</style>


  <?php if($session->read('lang')==1) {?>

            <div id="content">
            <div class="dd">
            <?php foreach ($new as $new)
            {$n=$new['New']['category_id'];
            $id=$new['New']['id'];
            $r=$this->requestAction('news/get_category/'.$n);
            foreach ($r as $r){ 
            	$name=$r['Category']['name'];
            
            ?>
            	<ul><li><a href="<?php echo DOMAIN?>">Trang chủ /</a></li>
            	<li><a href="<?php echo DOMAIN?>gioithieu">Tin tức /</a></li>
            	<li><a href="<?php echo DOMAIN?>tin-tuc/<?php echo $r['Category']['id'];?>"><?php echo $r['Category']['name'];?> /</a></li>
            	<li class="li-cuoi"><a href="<?php echo DOMAIN?>tin-tuc/chi-tiet/<?php echo $new['New']['id'];?>"><?php echo $new['New']['title'];?></a></li>
            	
            	</ul><?php }?>
            </div><!-- End dd -->
           
            <div class="bor-content">
            
            
            <div class="content-left">
            		<div class="menu-left">
            		<div class="title"><h2>DANH MỤC TIN TỨC</h2></div>
            		<div class="mn-bd">
            		
            			<ul>
            			 <?php $row=$this->requestAction('/comment/category');
					  
					  foreach ($row as $row){
					  ?>
					  <li class="li-mn <?php if($n==$row['Category']['id']) echo "li-1";?>"><a href="<?php echo DOMAIN?>tin-tuc/<?php echo $row['Category']['id']?>"><?php echo $row['Category']['name']?></a></li>
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
            			<h2 style="font-size:18px; font-wight:bold;color:#65390d;padding-top:15px;"><?php echo $name;?></h2>
            		</div>
            		
            		<div class="bd-right" style="color:#65390d;">
            		<p style="font-size:18px;margin-bottom:10px;"><?php echo $new['New']['title']?></p>
            		<?php echo $new['New']['content'];?></div>
            		
            		<?php }?>
            		
            		<div class="tin-moi">
                                    		
                                            	<div class="td-timmoi"><p style="color:#65390d;padding-top:10px;font-weight:bold; font-size:18px;">CÁC TIN LIÊN QUAN</p></div>								<ul>
                                                
                                               
                                                    <?php 
													$row= $this->requestAction("news/news3/$id");
													foreach($row as $row){
													?>
                                
                                                <li class="li-news">
                                                	
                                                    <a style="float:left;" href="<?php echo DOMAIN?>news/ctnews/<?php echo $row['New']['id']?>">
                                                    <?php echo $row['New']['title'];?></a>
                                                     
                                                </li>
                                                <?php }?>
                                               
                                            </ul>
                                    </div><!--End tin-moi-->
            	</div><!-- ENd content-right -->
            		
            </div><!-- End bor-content -->		
          <?php echo $this->element('partner');?>  		
            		
            </div><!-- End content-->
            <?php }?>
            
            
            
              <?php if($session->read('lang')==2) {?>

            <div id="content">
            <div class="dd">
            <?php foreach ($new as $new)
            {$n=$new['New']['category_id'];
            $id=$new['New']['id'];
            $r=$this->requestAction('news/get_category/'.$n);
            foreach ($r as $r){ 
            	$name=$r['Category']['name_eg'];
            
            ?>
            	<ul><li><a href="<?php echo DOMAIN?>">Home /</a></li>
            	<li><a href="<?php echo DOMAIN?>gioithieu">News /</a></li>
            	<li><a href="<?php echo DOMAIN?>tin-tuc/<?php echo $r['Category']['id'];?>"><?php echo $r['Category']['name_eg'];?> /</a></li>
            	<li class="li-cuoi"><a href="<?php echo DOMAIN?>tin-tuc/chi-tiet/<?php echo $new['New']['id'];?>"><?php echo $new['New']['title_eg'];?></a></li>
            	
            	</ul><?php }?>
            </div><!-- End dd -->
           
            <div class="bor-content">
            
            
            <div class="content-left">
            		<div class="menu-left">
            		<div class="title"><h2>NEWS LIST</h2></div>
            		<div class="mn-bd">
            		
            			<ul>
            			 <?php $row=$this->requestAction('/comment/category');
					  
					  foreach ($row as $row){
					  ?>
					  <li class="li-mn <?php if($n==$row['Category']['id']) echo "li-1";?>"><a href="<?php echo DOMAIN?>tin-tuc/<?php echo $row['Category']['id']?>"><?php echo $row['Category']['name_eg']?></a></li>
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
            			<h2 style="font-size:18px; font-wight:bold;color:#65390d;padding-top:15px;"><?php echo $name;?></h2>
            		</div>
            		
            		<div class="bd-right" style="color:#65390d;">
            		<p style="font-size:18px;margin-bottom:10px;"><?php echo $new['New']['title_eg']?></p>
            		<?php echo $new['New']['content_eg'];?></div>
            		
            		<?php }?>
            		
            		<div class="tin-moi">
                                    		
                                            	<div class="td-timmoi"><p style="color:#65390d;padding-top:10px;font-weight:bold; font-size:18px;">RELATED NEWS</p></div>								<ul>
                                                
                                               
                                                    <?php 
													$row= $this->requestAction("news/news3/$id");
													foreach($row as $row){
													?>
                                
                                                <li class="li-news">
                                                	
                                                    <a style="float:left;" href="<?php echo DOMAIN?>news/ctnews/<?php echo $row['New']['id']?>">
                                                    <?php echo $row['New']['title_eg'];?></a>
                                                     
                                                </li>
                                                <?php }?>
                                               
                                            </ul>
                                    </div><!--End tin-moi-->
            	</div><!-- ENd content-right -->
            		
            </div><!-- End bor-content -->		
          <?php echo $this->element('partner');?>  		
            		
            </div><!-- End content-->
            <?php }?>
		