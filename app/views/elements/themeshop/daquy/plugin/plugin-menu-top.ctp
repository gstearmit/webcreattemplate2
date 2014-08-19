<?php 
echo $this->Html->css('menu');
?>
<?php echo $javascript->link('script'); ?>
<div id="menu-header">
    <ul class="menu" id="menu"> 
       <li><a href="<?php echo DOMAIN;?>">Trang chủ</a></li>
      <li><a href="<?php echo DOMAIN;?>gioi-thieu">Giới thiệu</a>
       <li><a class="menulink" href="#">Sản phẩm</a>
         <ul style="z-index:99999999;">
             <?php $categoryproduct = $this->requestAction('/plugin/categoryproduct');?>
			 <?php foreach($categoryproduct as $categoryproduct){?>
                <li><a href="<?php echo DOMAIN;?>danh-muc-san-pham/<?php echo $categoryproduct['Catproduct']['alias'];?>"><?php echo $categoryproduct['Catproduct']['name'];?></a>
                   <ul>
                     <?php $submenuproduct = $this->requestAction('/plugin/submenuproduct/'.$categoryproduct['Catproduct']['id']);?>
			 		<?php 
					     foreach($submenuproduct as $submenuproduct){
						 if($submenuproduct['Catproduct']['parent_id']==$categoryproduct['Catproduct']['id']){
						?>
                    <li><a href="<?php echo DOMAIN;?>danh-muc-san-pham/<?php echo $categoryproduct['Catproduct']['alias'];?>"><?php echo $submenuproduct['Catproduct']['name'];?></a></li>
                    <?php }}?>      
                    </ul>
                </li>
              <?php }?>
         </ul>
      </li>
     <?php  echo $this->Help->getmenutop(NULL,'danh-muc-san-pham',true);?>
     
     </ul>
</div>
<script type="text/javascript">
	var menu=new menu.dd("menu");
	menu.init("menu","menuhover");
</script>