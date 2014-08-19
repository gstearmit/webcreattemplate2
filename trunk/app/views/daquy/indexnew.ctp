<div class="title-content">
   <p>Tin tức</p>
</div>
<div class="list-text">
   <div class="text-main">
    <?php
    echo $this->Help->getData($news,array('url'=>$shopname.'/viewnew','image'=>true,'introduction'=>true));
    ?>
</div>
   
</div>
<div id='link_page'>
      <?php
            $paginator->options(array('url' => $this->passedArgs));
            echo "<span class='page_link'><b>Trang :</b> &nbsp;";
            echo $paginator->prev('Về trước');echo "&nbsp;&nbsp;&nbsp;";
            echo $paginator->numbers();echo "&nbsp;&nbsp;&nbsp;";
            echo $paginator->next('Tiếp theo');
            echo "</span>";
        ?>
    </div>