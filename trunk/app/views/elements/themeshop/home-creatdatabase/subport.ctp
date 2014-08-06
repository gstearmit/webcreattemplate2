
<?php if($session->read('lang')==1){?>

<div id="subport"><!--begin subport-->
    <div id="title"></div>
    <div id="list-support">
        <div id="subport-business"><?php ?>
        	<ul>
				 <?php $new = $this->requestAction('/comment/business'); 
				 //pr($new);die;
                 foreach($new as $ns){?>    	
    				<li><?php echo $html->link( $this->Text->truncate($ns['News']['title'],50,array('ending' => '...','exact' => true)), '/chi-tiet-tin/'.$ns['News']['id'].'/'.char($ns['News']['title'].'.html'));?></li>

		<?php }?>
            
        	</ul>
            <!--<ul>
                <li><a href="#">Điều khoản giao dịch</a></li>
                <li><a href="#">Phương thức thanh toán</a></li>
                <li><a href="#">Vận chuyển giao nhận</a></li>
                <li><a href="#">Chính sách bảo hành</a></li>
            </ul>-->
        </div>
        <div id="subport-customers">
        	<ul>
				 <?php $new = $this->requestAction('/comment/customers'); 
				 //pr($new);die;
                 foreach($new as $ns){?>    	
    				<li><?php echo $html->link( $this->Text->truncate($ns['News']['title'],50,array('ending' => '...','exact' => true)), '/chi-tiet-tin/'.$ns['News']['id'].'/'.char($ns['News']['title'].'.html'));?></li>

		<?php }?>
            
        	</ul>
            <!--<ul>
                <li><a href="#">Điều khoản giao dịch</a></li>
                <li><a href="#">Phương thức thanh toán</a></li>
                <li><a href="#">Vận chuyển giao nhận</a></li>
                <li><a href="#">Chính sách bảo hành</a></li>
            </ul>-->
        </div>
        <div id="subport-science">
        	<ul>
				 <?php $new = $this->requestAction('/comment/science'); 
				 //pr($new);die;
                 foreach($new as $ns){?>    	
    				<li><?php echo $html->link( $this->Text->truncate($ns['News']['title'],50,array('ending' => '...','exact' => true)), '/chi-tiet-tin/'.$ns['News']['id'].'/'.char($ns['News']['title'].'.html'));?></li>

		<?php }?>
            
        	</ul>
            <!--<ul>
                <li><a href="#">Điều khoản giao dịch</a></li>
                <li><a href="#">Phương thức thanh toán</a></li>
                <li><a href="#">Vận chuyển giao nhận</a></li>
                <li><a href="#">Chính sách bảo hành</a></li>
            </ul>-->
        </div>
    </div>
</div><!--end subport-->

<?php } if($session->read('lang')==2){?>

<div id="subport"><!--begin subport-->
    
    <div id="title" style="background: url(<?php echo DOMAIN;?>images/title-subport-en.png) no-repeat;"></div>
    <div id="list-support">
        <div id="subport-business"><?php ?>
        	<ul>
				 <?php $new = $this->requestAction('/comment/business'); 
				 //pr($new);die;
                 foreach($new as $ns){?>    	
    				<li><?php echo $html->link( $this->Text->truncate($ns['News']['title_en'],50,array('ending' => '...','exact' => true)), '/chi-tiet-tin/'.$ns['News']['id'].'/'.char($ns['News']['title_en'].'.html'));?></li>

		<?php }?>
            
        	</ul>
            <!--<ul>
                <li><a href="#">Điều khoản giao dịch</a></li>
                <li><a href="#">Phương thức thanh toán</a></li>
                <li><a href="#">Vận chuyển giao nhận</a></li>
                <li><a href="#">Chính sách bảo hành</a></li>
            </ul>-->
        </div>
        <div id="subport-customers">
        	<ul>
				 <?php $new = $this->requestAction('/comment/customers'); 
				 //pr($new);die;
                 foreach($new as $ns){?>    	
    				<li><?php echo $html->link( $this->Text->truncate($ns['News']['title_en'],50,array('ending' => '...','exact' => true)), '/chi-tiet-tin/'.$ns['News']['id'].'/'.char($ns['News']['title_en'].'.html'));?></li>

		<?php }?>
            
        	</ul>
            <!--<ul>
                <li><a href="#">Điều khoản giao dịch</a></li>
                <li><a href="#">Phương thức thanh toán</a></li>
                <li><a href="#">Vận chuyển giao nhận</a></li>
                <li><a href="#">Chính sách bảo hành</a></li>
            </ul>-->
        </div>
        <div id="subport-science">
        	<ul>
				 <?php $new = $this->requestAction('/comment/science'); 
				 //pr($new);die;
                 foreach($new as $ns){?>    	
    				<li><?php echo $html->link( $this->Text->truncate($ns['News']['title_en'],50,array('ending' => '...','exact' => true)), '/chi-tiet-tin/'.$ns['News']['id'].'/'.char($ns['News']['title_en'].'.html'));?></li>

		<?php }?>
            
        	</ul>
            <!--<ul>
                <li><a href="#">Điều khoản giao dịch</a></li>
                <li><a href="#">Phương thức thanh toán</a></li>
                <li><a href="#">Vận chuyển giao nhận</a></li>
                <li><a href="#">Chính sách bảo hành</a></li>
            </ul>-->
        </div>
    </div>
</div><!--end subport-->

<?php }?>