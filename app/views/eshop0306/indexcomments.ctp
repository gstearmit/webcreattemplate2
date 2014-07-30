<?php 
			
			$shop=explode('/',$this->params['url']['url']); 
			$shopname=$shop[0];
				$shop=$this->requestAction('comment/get_shop_id/'.$shopname);
				
				
				foreach($shop as $key=>$value){
				$shop_id=$key;
				}
			
?>
<?php echo $html->css('register-news'); ?>
<?php echo $javascript->link('jquery.validate', true); ?>
<style>
.rowPost .col2 {
    float: left;
    margin-right: 5px;
    text-align: left;
    width: 30%;
}

.rowPost .col1 {
    float: left;
    margin-left: 120px;
    margin-right: 5px;
    text-align: left;
    width: 36%;
}
input {
    float: left;

}
</style>
 <div id="main-center">
                	<div id="sanphams" style="margin:1px 0 !important;">
                        	<div class="top">Góp ý</div>
    <div style="margin:10px; color: black;">
    <h2 style="padding-top: 20px;"><u>Góp ý của khách hàng:</u></h2>
                            <?php foreach($comment as $comment ){  ?>
                            <div class="noidung" style="border-bottom: 1px dotted silver; padding: 5px;" >                            
                            <div class="main">
                            <h3><?php echo $comment['Estore_comments']['name'];?> </h3><i>Email:<?php echo $comment['Estore_comments']['email'];?> - ( Ngày: <?php echo date('d-m-Y', strtotime($comment['Estore_comments']['created'])); ?>)</i> <br />
                            
                            <p><?php echo $comment['Estore_comments']['content'];?></p>
                            
                            </div>
                            </div>
                            <?php }?>
                            <?php if($paginator->numbers()!=null){?>
                    		   <h3 style="text-align:right; margin:7px 15px; color: green; font-size: 12px;">
                                <?php $paginator->options(array('url' => $this->passedArgs));
                                echo $paginator->prev('<<');echo "&nbsp;&nbsp;&nbsp;";
                                echo $paginator->numbers();echo "&nbsp;&nbsp;&nbsp;";
                                echo $paginator->next('>>');
                                echo "</span>";?>
                                </h3>
                            <?php }?>
           <div id="comment" style="padding:50px 10px;">

                <?php echo $form->create(null, array( 'url' => DOMAIN.'bepga/addcomments','type' => 'post')); ?>	
                    <h2 ><u>Gửi chia sẻ của bạn:</u></h2>
                    <div style="margin-bottom:6px; margin-top:15px; float:left; width:98%;">
                    <span style="float:left; margin-right:20px;">Họ tên:</span>
                    <?php echo $form->input('Estore_comments.name',array( 'label' => '','style'=>'width:200px;height:25px;float:left;'));?>
                     <span style="float:left; margin-right:6px; margin-left:6px;">Email:</span>
                     <?php echo $form->input('Estore_comments.email',array( 'label' => '','style'=>'width:200px;height:25px;float:left;'));?></div>
                     <span style="float:left; margin-right:6px; margin-left:0px;">Nội Dung:</span>
                    <p><?php echo $form->input('Estore_comments.content',array( 'label' => '','rows'=>10,'cols'=>60));?></p>           
                   
                    <div class="rowPost" style="padding-bottom: 45px !important;">
					<!--
                    <div class="captcha">
                        <label>
                            Nhập mã an toàn</label>(<span class="redfont">*</span>)
					</div>
					-->
                    <div class="inputcaptcha">
                        <!--
                        <div class="col1">
                        
                         <input id="security" class="required" name="security" />     
                               </div>
                               <div class="col2"><img alt="" id="captcha" src="<?php echo DOMAIN?>user/create_image" />
                               </div>
						-->
                        <div class="col1" style="padding-top: 20px;">
                         <input style="padding:5px;width: 50px;" type="submit" value="Gửi"/>
                        <input style="padding:5px;width: 70px;" type="reset" value="nhập lại" />
                        </div>
                        
                    </div>
					
                </div>
  </div>             
                    
                     
                </form>                            
             </div>
             </div></div>
