<style>

</style>
<div id="partner"><!--begin partner-->
    <div id="title">
 <?php if($session->read('lang')==1){?>

        <p>ĐỐI TÁC - KHÁCH HÀNG</p>
    
    <?php } if($session->read('lang')==2){?>
<p>PARTNERS - CLIENTS</p>
    <?php }?>	
    </div>
                    <!-- ĐỐi tác -->
                <script language="javascript" type="text/javascript">
					$(function() {
						$("#amazon_scroller2").amazon_scroller({
							scroller_title_show: 'disable',
							scroller_time_interval: '3000',
							scroller_window_background_color: "none",
							scroller_window_padding: '0',
							scroller_border_size: '0',
							scroller_border_color: '#CCC',
							scroller_images_width: '130',
							scroller_images_height: '77',
							scroller_title_size: '12',
							scroller_title_color: 'black',
							scroller_show_count: '4',
							directory: 'images'
						});
					});
				</script>
                    <div class="module-noidung" style="padding:0; padding-top:10px;">
						<div id="amazon_scroller2" class="amazon_scroller">
                        	<div class="amazon_scroller_mask">
                               <ul>
                                   <?php $doitac = $this->requestAction('/comment/doitac');?>
                                        <?php foreach($doitac as $doitac){?>
                                        <li> 
                                            <a href="<?php echo $doitac['Partner']['website'];?>" target="_blank">
                                            <img src="<?php echo DOMAINADESTORE;?><?php echo $doitac['Partner']['images'];?>"  width="104" height="77"/></a>
                                        </li>
                                    <?php }?>
                                   
                                   <!--<li><a href="link1" title="title1"><img src="images/doitact2.png" width="104" height="77" alt="title"/></a></li>
                                   <li><a href="link2" title="title2"><img src="images/doitact2.png" width="104" height="77" alt="title"/></a></li>
                                   <li><a href="link3" title="title3"><img src="images/doitact2.png" width="104" height="77" alt="title"/></a></li>
                                   <li><a href="link4" title="title4"><img src="images/doitact2.png" width="104" height="77" alt="title"/></a></li>
                                   <li><a href="link1" title="title5"><img src="images/doitact2.png" width="104" height="77" alt="title"/></a></li>
                                   <li><a href="link2" title="title6"><img src="images/doitact2.png" width="104" height="77" alt="title"/></a></li>
                                   <li><a href="link3" title="title7"><img src="images/doitact2.png" width="104" height="77" alt="title"/></a></li>
                                   <li><a href="link4" title="title8"><img src="images/doitact2.png" width="104" height="77" alt="title"/></a></li>-->
                               
                               </ul>
                           	</div>
                           	<ul class="amazon_scroller_nav">
                               <li style="margin-left:0;"></li>
                               <li style="margin-right:0;"></li>
                           	</ul>
                           	<div style="clear: both"></div>
            			</div>
                    </div>
                    <div class="module-footer"></div>

                <!-- End doi tac -->
</div><!--end partner--><?php ?>