<div class="text-footer" style="height:170px; padding-left:0px !important; overflow:hidden;">
<div style="width:200px; float:left;">			 
				 <!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=xa-507b97c86755c349"></script>
<!-- AddThis Button END -->
            </div>


<div style="width:800px;float:left;">
                <?php $setting = $this -> requestAction('/plugin/setting');?>
<?php foreach($setting as $settings){?>
                  <div><?php echo $settings['Setting']['content'];?></div>
                 <?php }?>
				 </div>
	
			</div>