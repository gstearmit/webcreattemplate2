<div class="title-content">
       <p><?php echo $views['Estore_news']['title']?></p>
    </div>
    <div class="list-text">
       <div class="detail">
        <p><?php echo $views['Estore_news']['content']?></p>
       </div>
       <div class="news-other">
          <h1>Các tin liên quan</h1>
            <?php foreach($list_other as $list_others ){?>
              <p>>> <a href="<?php echo DOMAIN.$shopname;?>/viewnew/<?php echo $list_others['Estore_news']['id'];?>"><?php echo $list_others['Estore_news']['title'];?></a></p>
           <?php }?>
       </div>
    </div>