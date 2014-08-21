<div class="title-content">
   <p>
   <?php
  
    foreach ($namecategory as $namecategoryss)
    {
    	echo $namecategoryss['Eshopdaquycategory']['name'];
    }
    ?>
   
   </p>
</div>
<div class="list-text">
   <div class="text-main">
    <?php
    echo $this->Help->getdaquy($news,array('url'=>$shopname.'/viewnew','image'=>true,'introduction'=>true));
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