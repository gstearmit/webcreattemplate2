<div class="title-content">
       <p><?php echo $views['Eshopdaquynew']['title']?></p>
    </div>
    <div class="list-text">
       <div class="detail">
        <p><?php echo $views['Eshopdaquynew']['content']?></p>
       </div>
       <div class="news-other">
          <h1>Các tin liên quan</h1>
            <?php foreach($list_other as $list_others ){?>
              <p>>> <a href="<?php echo DOMAIN.$shopname;?>/viewnew/<?php echo $list_others['Eshopdaquynew']['id'];?>"><?php echo $list_others['Eshopdaquynew']['title'];?></a></p>
           <?php }?>
       </div>
    </div>